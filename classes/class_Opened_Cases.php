<?php
/**
 * @author          Subigya Jyoti Panta
 * @subpackage      Modules
 * @copyright (c) 2014, www.eooro.com
 * @version         1.0
 * @modification history original
 */

class Opened_Cases extends Handle
{
    public $case_id;
    protected $owner_id;
    protected $review_id;
    protected $listing_id;
    protected $review_comment;
    protected $case_status;
    protected $opened_date;
    protected $closed_date;
    protected $last_communication_on;
    public $discount_id;
    
    public function __construct( $case = '', $domain_id = false)
    {
        if (is_numeric($case) && ($case)) {
            $db     = $this->getDb( $domain_id );
            $select = array( 'case_id', 'owner_id', 'review_id', 'review_comment' ,'listing_id'
                        , 'case_status', 'opened_date', 'closed_date', 'last_communication_on','discount_id');
            $sql = "SELECT ".implode(',', $select)." FROM Opened_Cases WHERE case_id = $case";

            $row = mysql_fetch_assoc($db->query($sql));

            $this->makeFromRow( $row );
        }
        else if( is_array($case) || is_object($case) ){
            $this->makeFromRow( $case );
        }
        else{
            throw new InvalidArgumentException( 'variable "$case" should be a number, or valid array / object');
        }
    }
    
    public function makeFromRow( $data )
    {
        foreach( $data as $key => $value ){
            $this->$key = $value;
        }
    }
    
    public function save()
    {
        $dbObj = $this->getDb();

        $this->prepareToSave();
        
        $array = get_object_vars( $this );
        if ( is_numeric(trim($this->case_id, "'")) ) {
            // update code
            $sql = 'UPDATE Opened_Cases SET ';
            foreach ( $array as $key => $values ){
                if ( $key !== 'case_id' ) {
                    $sql .= " ".$key."=".$values.",";
                }
            }
            $sql = rtrim( $sql, ',' );
            $sql .= " WHERE case_id=$this->case_id";
        }
        else {
            // insert code
            // splitting field name and values
            $field_names    = array_keys( $array );
            $field_values   = array_values( $array );
            
            $sql = "INSERT INTO Opened_Cases (".implode(',', $field_names)
                    .") VALUES (".implode( ",", $field_values ).") ";           
        }
        $dbObj->query( $sql );
    }
    
    public function needToCheckOut()
    {
        if ( strtolower($this->case_status) === 'i' ) {
            return true;
        }
        else {
            return false;
        }
    }
    
    public function getPrice()
    {
        $db         = $this->getDb();
        $sql        = "SELECT value FROM Setting_Case WHERE name='price' AND is_enabled='1'";
        $resource   = $db->query( $sql );
        $row        = mysql_fetch_assoc( $resource );
        return $row['value'];
    }

    public function getLocationCase($case_id)
    {
    $db  = $this->getDb();
    $sql = "SELECT location_1 FROM Listing WHERE id = (
            SELECT rev.item_id FROM Opened_Cases oc
            LEFT OUTER JOIN Review rev
            ON oc.review_id = rev.id
            WHERE oc.case_id = ". $case_id.")";
    
        $result = mysql_fetch_assoc($db->query( $sql ));
        return $result['location_1'];
    }
    
    public function makeActive()
    {
        $this->case_status = 'A';
        $this->save();
        //Recalculate review average for listing and listing summary table 
        
        $listing_iid = str_replace("'","", $this->listing_id);
        $average = Review::getRateAvgByItem('listing',  $listing_iid, "count");
	$set     = Listing::setAvgReview($average['rate'], $listing_iid, $average['review_count']);
            }

    public function insertDiscountID($discount_id, $caseID){

        $dbObj = $this->getDb();
        $sql = "UPDATE Opened_Cases SET discount_id='".$discount_id."' WHERE case_id =" .$caseID;
        $dbObj->query( $sql );

    }

    public function getDiscountedPrice($discount_id,$price){

        $account = new Account(sess_getAccountIdFromSession());
        
        if ($discount_id) {

            $discountCodeObj = new DiscountCode($discount_id);

            if ($discountCodeObj->getString("id") && $discountCodeObj->expire_date >= date('Y-m-d')) {

                $listing    = $this->getThisCaseListing($this->case_id);
                $listingObj = new Listing($listing);

                //Multi Currency, Global Brand and Listing Pending for Case Price
                if($listingObj->status == "P"){
                    $listingPending = new ListingPending($listing);
                    if($listingPending->custom_checkbox1 == "y"){
                        $forex = CountryLoader::getForexRate("", $account->prefered_currency);
                    } else {
                        $forex = CountryLoader::getForexRate($listingPending->location_1, $account->prefered_currency);
                    }
                } else {
                    if($listingObj->custom_checkbox1 == "y"){
                        $forex = CountryLoader::getForexRate("", $account->prefered_currency);
                    } else {
                        $forex = CountryLoader::getForexRate($listingObj->location_1, $account->prefered_currency);
                    }
                }

                if ($discountCodeObj->getString("type") == "percentage") {
                    $price = $price * (1 - $discountCodeObj->getString("amount")/100);
                } elseif ($discountCodeObj->getString("type") == "monetary value") {
                    $discountCodeObj->amount = $discountCodeObj->amount * $forex;
                    $price = $price - $discountCodeObj->getString("amount");
                }
            } 
        }

        return $price;

    }

    public static function getThisCaseListing($case_id){
        $dbMain  = db_getDBObject(DEFAULT_DB, true);
        $dbObj   = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
        $sql    = "SELECT re.item_id FROM Opened_Cases cs
                     LEFT OUTER JOIN Review re on re.id = cs.review_id
                     WHERE cs.case_id = $case_id";
        
        $result = $dbObj->query( $sql );
        $row    = mysql_fetch_assoc($result);
        return $row['item_id'];
    }
    
    #-------------------------
    #   Dashboard Queries
    #-------------------------

    public static function getThisLisitngCasesCount($listing_id){
        $db  = db_getDBObject();
        $sql = "SELECT count(*) FROM Opened_Cases AS c
                INNER JOIN Review AS r 
                ON c.review_id=r.id
                WHERE r.item_id=$listing_id order by r.id desc";

        $result = $db->query($sql);
        $row = mysql_fetch_assoc($result);

        return $row['count(*)'];
    }

    public static function getThisLisitngCases($listing_id){
        $db  = db_getDBObject();
        $sql = "SELECT * FROM Opened_Cases AS c
                INNER JOIN Review AS r 
                ON c.review_id=r.id
                WHERE r.item_id=$listing_id order by r.id desc";

        $result = $db->query($sql);

        while ($row = mysql_fetch_assoc($result)) {
            $return[] = $row;
        }
        
        return $return;
    }

    public static function getThisLisitngCasesForPagination($listing_id, $start_from, $number_of_results_per_page){
        $db  = db_getDBObject();
        $sql = "SELECT * FROM Opened_Cases AS c
                INNER JOIN Review AS r 
                ON c.review_id=r.id
                WHERE r.item_id=$listing_id order by r.id desc LIMIT $start_from, $number_of_results_per_page";

        $result = $db->query($sql);

        while ($row = mysql_fetch_assoc($result)) {
            $return[] = $row;
        }
        
        return $return;
    }

    public static function getReasonToOpenThisCase($case_id){
        $db  = db_getDBObject();
        $sql = "SELECT message FROM Case_Messages where case_id = $case_id LIMIT 1";

        $result = $db->query($sql);
        $row  = mysql_fetch_assoc($result);

        return $row['message'];
    }

    #-------------------------
    #   Profile Queries
    #-------------------------
    
    public static function getThisUsersCasesCount($account_id){
        $db  = db_getDBObject();
            $sql = "
            SELECT count(*) FROM (
                SELECT R.*, O.*, L.title FROM Opened_Cases AS O "
                . "INNER JOIN Review AS R ON O.review_id=R.id "
                . "INNER JOIN Listing AS L ON L.id=R.item_id "
                . "WHERE R.member_id = $account_id AND (O.case_status='A' OR O.case_status='C') ORDER BY O.case_status ASC, O.opened_date DESC

            ) as subquery";
        $result = $db->query($sql);
        $row = mysql_fetch_assoc($result);
        
        return $row['count(*)'];
    }

    public static function getThisUsersCases($account_id){
        $db  = db_getDBObject();
            $sql = "SELECT R.*, O.*, L.title FROM Opened_Cases AS O "
            . "INNER JOIN Review AS R ON O.review_id=R.id "
            . "INNER JOIN Listing AS L ON L.id=R.item_id "
            . "WHERE R.member_id = $account_id AND (O.case_status='A' OR O.case_status='C') ORDER BY O.case_status ASC, O.opened_date DESC";

        $result = $db->query($sql);

        while ($row = mysql_fetch_assoc($result)) {
            $return[] = $row;
        }
        
        return $return;
    }

    public static function getThisUsersCasesForPagination($account_id, $start_from, $number_of_results_per_page){
        $db  = db_getDBObject();
            $sql = "SELECT R.*, O.*, L.title FROM Opened_Cases AS O "
            . "INNER JOIN Review AS R ON O.review_id=R.id "
            . "INNER JOIN Listing AS L ON L.id=R.item_id "
            . "WHERE R.member_id = $account_id AND (O.case_status='A' OR O.case_status='C') 
            ORDER BY O.case_status ASC, O.opened_date DESC LIMIT $start_from, $number_of_results_per_page";

        $result = $db->query($sql);

        while ($row = mysql_fetch_assoc($result)) {
            $return[] = $row;
        }
        
        return $return;
    }

}


