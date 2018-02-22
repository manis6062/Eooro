<?

	/*==================================================================*\
	######################################################################
	#                                                                    #
	# Copyright 2005 Arca Solutions, Inc. All Rights Reserved.           #
	#                                                                    #
	# This file may not be redistributed in whole or part.               #
	# eDirectory is licensed on a per-domain basis.                      #
	#                                                                    #
	# ---------------- eDirectory IS NOT FREE SOFTWARE ----------------- #
	#                                                                    #
	# http://www.edirectory.com | http://www.edirectory.com/license.html #
	######################################################################
	\*==================================================================*/

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /classes/class_review.php
	# ----------------------------------------------------------------------------------------------------

class Review extends Handle {

        var $id;
        var $item_type;
        var $item_id;
        var $member_id;
        var $added;
        var $ip;
        var $rating;
        var $review_title;
        var $review;
        var $reviewer_name;
        var $reviewer_email;
        var $reviewer_location;
        var $approved;
        var $response;
        var $responseapproved;
        var $new;
        var $like;
        var $dislike;
        var $like_ips;
        var $dislike_ips;
        var $status;
        

        /**
         *
         * @var type 
         */
        var $case_status;

        var $is_deleted;
                
    function __construct($var="") {
        if (is_numeric($var) && ($var)) {
            DBQuery::execute(function() use ($var){
                $main = DBConnection::getInstance()->getDomain();
                $stmt = $main->prepare("SELECT a . * , b.case_status
                                 FROM  `Review` a
                                 LEFT OUTER JOIN Opened_Cases b ON a.id = b.review_id
                                 WHERE id = :var");
                $stmt->bindParam(':var', $var);
                $stmt->execute();

                $row = $stmt->fetch(\PDO::FETCH_ASSOC);
                $this->makeFromRow($row);
            });
        } 
        else {
            if (!is_array($var)) {
                $var = array();
            }
            $this->makeFromRow($var);
        }
    }

 

    function makeFromRow($row="") {

        $this->id                    = isset($row["id"])                     ? $row["id"]                    : (isset($this->id)                    ? $this->id                     : 0);
        $this->item_type             = isset($row["item_type"])              ? $row["item_type"]             : (isset($this->item_type)             ? $this->item_type              : "");
        $this->item_id               = isset($row["item_id"])                ? $row["item_id"]               : (isset($this->item_id)               ? $this->item_id                : 0);
        $this->member_id             = isset($row["member_id"])              ? $row["member_id"]             : (isset($this->member_id)             ? $this->member_id              : 0);
        $this->added                 = isset($row["added"])                  ? $row["added"]                 : (isset($this->added)                 ? $this->added                  : "");
        $this->ip                    = isset($row["ip"])                     ? $row["ip"]                    : (isset($this->ip)                    ? $this->ip                     : "");
        $this->rating                = isset($row["rating"])                 ? $row["rating"]                : (isset($this->rating)                ? $this->rating                 : "");
        $this->review_title          = isset($row["review_title"])           ? $row["review_title"]          : "";
        $this->review                = isset($row["review"])                 ? $row["review"]                : "";
        $this->reviewer_name         = isset($row["reviewer_name"])          ? $row["reviewer_name"]         : "";
        $this->reviewer_email        = isset($row["reviewer_email"])         ? $row["reviewer_email"]        : "";
        $this->reviewer_location     = isset($row["reviewer_location"])      ? $row["reviewer_location"]     : "";
        $this->approved              = isset($row["approved"])               ? $row["approved"]              : 0;
        $this->response              = isset($row["response"])               ? $row["response"]              : "";
        $this->responseapproved      = isset($row["responseapproved"])       ? $row["responseapproved"]      : 0;
        $this->new                   = isset($row["new"])                    ? $row["new"]                   : (isset($this->new )                  ? $this->new                    : "y");
        $this->like                  = isset($row["like"])                   ? $row["like"]                  : (isset($this->like )                 ? $this->like                   : 0);
        $this->dislike               = isset($row["dislike"])                ? $row["dislike"]               : (isset($this->dislike)               ? $this->dislike                : 0);
        $this->like_ips              = isset($row["like_ips"])               ? $row["like_ips"]              : (isset($this->like_ips)              ? $this->like_ips               : "");
        $this->dislike_ips           = isset($row["dislike_ips"])            ? $row["dislike_ips"]           : (isset($this->dislike_ips)           ? $this->dislike_ips            : "");
        $this->case_status          = isset($row['case_status']) ? $row['case_status'] : null;
        $this->is_deleted           = isset($row['is_deleted']) ? $row['is_deleted'] : 0;
        $this->status               = isset($row['status']) ? $row['status'] : 'A';
    }


    function Save() {
        return DBQuery::execute(function(){
            $main = DBConnection::getInstance()->getDomain();


            $this_status = $this->approved;
            $this_statusResponse = $this->responseapproved;
            $saved = false;
            if ($this->id) {
                $sql = $main->prepare("SELECT approved FROM Review WHERE id = :id");
                $sql->bindParam(':id', $this->id);
                $sql->execute();
                if ($row = $sql->fetch(\PDO::FETCH_ASSOC)) {
                    $last_status = $row["approved"];
                }

                $sql =  $main->prepare("UPDATE Review SET"
                    . " item_type           = :item_type,"
                    . " item_id             = :item_id,"
                    . " member_id           = :member_id,"
                    . " added               = :added,"
                    . " ip                  = :ip,"
                    . " rating              = :rating,"
                    . " review_title        = :review_title,"
                    . " review              = :review,"
                    . " reviewer_name       = :reviewer_name,"
                    . " reviewer_email      = :reviewer_email,"
                    . " reviewer_location   = :reviewer_location,"
                    . " approved            = :approved,"
                    . " response            = :response,"
                    . " responseapproved    = :responseapproved,"
                    . " new                 = :new ,"
                    . " `like`              = :like,"
                    . " dislike             = :dislike,"
                    . " like_ips            = :like_ips,"
                    . " dislike_ips         = :dislike_ips,"
                    . " is_deleted          = :is_deleted, "
                    ." status               = :status"
                    
                    . " WHERE id            = :id");
                $parameters = array(
                    ':item_type'	=> $this->item_type,    
                    ':item_id'		=> $this->item_id,
                    ':member_id'	=> $this->member_id,
                    ':added'            => $this->added,
                    ':ip'		=> $this->ip,
                    ':rating'		=> $this->rating,
                    ':review_title'	=> $this->review_title,
                    ':review'		=> $this->review,
                    ':reviewer_name'	=> $this->reviewer_name,
                    ':reviewer_email'	=> $this->reviewer_email,
                    ':reviewer_location'=> $this->reviewer_location,
                    ':approved'		=> $this->approved,
                    ':response'		=> $this->response,
                    ':responseapproved'	=> $this->responseapproved,
                    ':new'		=> $this->new,
                    ':like'		=> $this->like,
                    ':dislike'		=> $this->dislike,
                    ':like_ips'		=> $this->like_ips,
                    ':dislike_ips'      => $this->dislike_ips,
                    ':is_deleted'	=> $this->is_deleted,
                    ':status'           => $this->status,
                    
                     ':id'              => $this->id
                 );
                
                $sql->execute($parameters);
                
                if ($this->item_type == "'article'"){
                    $article = new Article(str_replace("'","",$this->item_id));
                    $item_title = $article->getString("title");
                    $item = "review_article";
                } else if($this->item_type == "'promotion'"){
                    $promotion = new Promotion(str_replace("'","",$this->item_id));
                    $item_title = $promotion->getString("name");
                    $item = "review_promotion";
                }else {
                    $listing = new Listing(str_replace("'","",$this->item_id));
                    $item_title = $listing->getString("title");
                    $item = "review_listing";
                }

                $skipResponse = false;

                if ($last_status != 0 && $this_status == 0) {
                        activity_newToApproved(SELECTED_DOMAIN_ID, $this->id, $item, db_formatString($item_title), $this->review_title, $this->item_id, $this->rating);
                } else if ($last_status == 0 && $this_status != 0) {
                        activity_deleteRecord(SELECTED_DOMAIN_ID, $this->id, $item);
                } else if ($last_status == $this_status) {
                    if (!$this_status) {
                        $skipResponse = true;
                    }
                activity_updateRecord(SELECTED_DOMAIN_ID, $this->id, $this->review_title, "content", $item, $this->rating, $this->reviewer_name, $this->review);
                }

                if (!$skipResponse) {
                    activity_deleteRecord(SELECTED_DOMAIN_ID, $this->id, $item, true);
                    if (!$this_statusResponse && $this->response != "''") {
                        activity_newToApproved(SELECTED_DOMAIN_ID, $this->id, $item, db_formatString($item_title), $this->review_title, $this->item_id, $this->rating, 1);
                    }
                }

            } 
            else {
                $stmt = $main->prepare("INSERT INTO Review"
                    . " (item_type,
                        item_id,
                        member_id,
                        added, "
                      ."ip,
                        rating,
                        review_title,
                        review,
                        reviewer_name, "
                    . "reviewer_email, "
                    . "reviewer_location, "
                    . "approved,"
                    . "response, "
                    . "status,"
                    
                    . "responseapproved ) "
                    . " VALUES"
                    . " (:item_type, "
                        . ":item_id, "
                        . ":member_id, "
                        . "NOW(),"
                        . ":ip, "
                        . ":rating, "
                        . ":review_title, "
                        . ":review, "
                        . ":reviewer_name, "
                        . ":reviewer_email, "
                        . ":reviewer_location, "
                        . ":approved, "
                        . ":response,"
                        . ":status,"
                        
                        . ":responseapproved)");
                $parameters = array(
                    ':item_type'    => $this->item_type,
                    ':item_id'      => $this->item_id,
                    ':member_id'    => $this->member_id,
                    ':ip'           => $this->ip,
                    ':rating'       => $this->rating,
                    ':review_title' => $this->review_title,
                    ':review'       => $this->review,
                    ':reviewer_name'=> $this->reviewer_name,
                    ':reviewer_email'   => $this->reviewer_email,
                    ':reviewer_location'=> $this->reviewer_location,
                    ':approved'      => $this->approved,
                    ':response'      => $this->response,
                    ':status'        => $this->status,
                    
                    ':responseapproved' => $this->responseapproved

                );
                
               $saved = $stmt->execute($parameters);
                $this->id = $main->lastInsertId();

                if ($this->item_type == "'article'"){
                        $article = new Article(str_replace("'","",$this->item_id));
                        $item_title = $article->getString("title");
                        $item = "review_article";
                } else if ($this->item_type == "'promotion'"){
                        $promotion = new Promotion(str_replace("'","",$this->item_id));
                        $item_title = $promotion->getString("name");
                        $item = "review_promotion";
                }else{
                        $listing = new Listing(str_replace("'","",$this->item_id));
                        $item_title = $listing->getString("title");
                        $item = "review_listing";
                }

                if ($this->approved == 0){
                        activity_newToApproved(SELECTED_DOMAIN_ID, $this->id, $item, db_formatString($item_title), $this->review_title, $this->item_id, $this->rating);
                }

            }
            return $saved;

        });

    }

    function Delete($domain_id = false) {

        $domain = DBConnection::getInstance()->getDomain();
        DBQuery::execute(function() use ($domain_id, $domain){
            $sql = $domain->prepare("DELETE FROM Review WHERE id = :id");
            $sql->bindParam(':id', $this->id);
            $sql->execute();

            if ($this->item_type == "article"){
                    $item = "review_article";
            } else if ($this->item_type == "listing") {
                    $item = "review_listing";
            } else {
                    $item = "review_promotion";
            }
            activity_deleteRecord(SELECTED_DOMAIN_ID, $this->id, $item);

        });
    }


    /**
     * <code>
     *		//Using this in forms or other pages.
     *		$reviewObj->deletePerAccount($account_id);
     * <br /><br />
     *		//Using this in Review() class.
     *		$this->deletePerAccount($account_id);
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name deletePerAccount
     * @access Public
     * @param integer $account_id
     * @param integer $domain_id
     */
    function deletePerAccount($account_id = 0, $domain_id = false) {
        if (is_numeric($account_id) && $account_id > 0) {
            DBQuery::execute(function() use ($account_id, $domain_id){
                $dbMain = DBConnection::getInstance()->getDomain();
                
                $sql = $dbMain->prepare("SELECT * FROM Review WHERE member_id = :account_id");
                $sql->bindParam(':account_id', $account_id);
                $result=  $sql->execute();
                
                while ($row  = $sql->fetch(\PDO::FETCH_ASSOC)) {
                    
                    $this->makeFromRow($row);
                    $this->Delete($domain_id);
                }
            });
        }
    }

    /**
     * @todo
     * @param type $item_type
     * @param type $item_id
     * @param type $count
     * @return type
     */
    function getRateAvgByItem($item_type, $item_id,$count=null) {
        return DBQuery::execute(function() use ($item_type, $item_id, $count){
            $domain = DBConnection::getInstance()->getDomain();
            $mainDb = DBConnection::getInstance()->getMainDatabaseName();
            if($count){
                $stmt = $domain->prepare("SELECT round(avg(rev.rating), 1 ) as rate, count(*) as review_count 
                    FROM Review as rev
                    LEFT OUTER JOIN $mainDb.Account acc on rev.member_id = acc.id 
                    LEFT OUTER JOIN Opened_Cases oc on rev.id = oc.review_id
                    WHERE acc.active='y' 
                    AND is_deleted = '0' 
                    AND ifnull(oc.case_status, '') != 'A'
                    AND item_id = :item_id
                    AND rev.status = 'A'");
                $stmt->bindParam(':item_id', $item_id);
                $stmt->execute();
                $row = $stmt->fetch(\PDO::FETCH_ASSOC);  
                return $row;
            } 
            else {
                $stmt = $domain->prepare("SELECT round(avg(rev.rating), 1 ) as rate FROM Review as rev
                                    LEFT OUTER JOIN $mainDb.Account acc on rev.member_id = acc.id
                                    LEFT OUTER JOIN Opened_Cases oc on rev.id = oc.review_id    
                                    WHERE acc.active='y' 
                                    AND is_deleted = '0' 
                                    AND ifnull(oc.case_status, '') != 'A'                                    
                                    AND item_id = :item_id
                                    AND rev.status = 'A'");
                
                $stmt->bindParam(':item_id', $item_id);
                $result = $stmt->execute();
                $row = $stmt->fetch(\PDO::FETCH_ASSOC); 
                
                if ($result) $rate = $row["rate"];
                return (isset($rate) && $rate != 0) ? round($rate, 1) : system_showText(LANG_NA);
            }   
        });
        
    }
    
    
    function getDeniedIpsByItem($item_type, $item_id) {
        $domain = DBConnection::getInstance()->getDomain();
        return DBQuery::execute(function() use ($domain,$item_id,$item_type){
            
            $sql = $domain->Prepare("SELECT ip FROM Review WHERE (added >= DATE_SUB(NOW(), INTERVAL '5' MINUTE)) AND item_type = :item_type AND item_id = :item_id");
            $sql->bindParam(':item_type', $item_type);
            $sql->bindParam(':item_id',$item_id);

            $result = $sql->execute();

            $ips = array();
            if ($result) {
                while ($row = $sql->fetch(\PDO::FETCH_ASSOC)) {
                    $ips[] = $row["ip"];
                }
            }
            return $ips;
        });
    }
        
    /**
     * Function to get all reviews from a item
     * @todo
     * @return array
     */
     function getReviewByItemID(){
        $domain = DBConnection::getInstance()->getDomain();
        $main  = DBConnection::getInstance()->getMain();
         

        $stmt = $domain->prepare("SELECT * FROM Review "
                . "WHERE item_type = :item_type"
                ." AND item_id = :item_id"
                ." AND review IS NOT NULL "
                ." AND review != '' "
                ." AND approved = 1 "
                ." AND status ='A'"
                ." ORDER BY added DESC");
        $stmt->bindParam(':item_type', $this->item_type);
        $stmt->bindParam(':item_id', $this->item_id);
//        $result = $db->query($sql);
        $result = $stmt->execute();
        if ($result) {

            unset($aux_array_reviews);
            $aux_array_reviews = array();
            while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
                unset($aux_fields);
                foreach ($row as $key => $value) {
                    if (API_IN_USE == "api2" && $key == "id") {
                        $key = "review_id";
                    }
                    $aux_fields[$key] = (is_numeric($value) && $key != "approved" && $key != "responseapproved" ? (float)$value : $value);
                }
                //Get user image
                if (SOCIALNETWORK_FEATURE == "on") {

                    if ($row["member_id"] > 0) {

                        $sql = $main->prepare("SELECT image_id, facebook_image, A.has_profile
                                FROM Profile
                                LEFT JOIN Account A ON (A.id = account_id)
                                WHERE account_id = :member_id");
//                        $resultImage = $dbMain->query($sql);
//                        $rowImage = mysql_fetch_assoc($resultImage);
                        $sql->bindParam(':member_id', $row["member_id"]);
                        $rowImage = $sql->fetch(\PDO::FETCH_ASSOC);

                        if ($rowImage["has_profile"] == "y") {
                            $imgObj = new Image($rowImage["image_id"], true);
                            if ($imgObj->imageExists()) {
                                $aux_fields["member_img"] = $imgObj->getPath();
                            //No image
                            } else {
                                if ($rowImage["facebook_image"]) {
                                    $aux_fields["member_img"] = $rowImage["facebook_image"];
                                } else {
                                    $aux_fields["member_img"] = THEMEFILE_URL."/".EDIR_THEME."/schemes/".EDIR_SCHEME."/images/iconography/icon-user-thumb.gif";
                                }
                            }
                        //No image
                        } else {
                            $aux_fields["member_img"] = THEMEFILE_URL."/".EDIR_THEME."/schemes/".EDIR_SCHEME."/images/iconography/icon-user-thumb.gif";
                        }

                    //No image
                    } else {
                        $aux_fields["member_img"] = THEMEFILE_URL."/".EDIR_THEME."/schemes/".EDIR_SCHEME."/images/iconography/icon-user-thumb.gif";
                    }
                } else {
                    $aux_fields["member_img"] = "";
                }
                $aux_array_reviews[] = $aux_fields;
            }

            if (is_array($aux_array_reviews)) {
                return $aux_array_reviews;
            } else {
                return false;
            }

        } else {
            return false;
        }
    }
        
    function GetInfoToApp($array_get, &$aux_returnArray,&$items){

        extract($array_get);

        $items = $this->getReviewByItemID();

        if (is_array($items)) {

            $aux_returnArray["type"]            = $resource;
            $aux_returnArray["total_results"]   = count($items);
            $aux_returnArray["total_pages"]     = ceil(count($items) / $aux_results_per_page);
            $aux_returnArray["results_per_page"]= $aux_results_per_page;

        } else {

            $aux_returnArray["type"]            = $resource;
            $aux_returnArray["total_results"]   = 0;
            $aux_returnArray["total_pages"]     = 0;
            $aux_returnArray["results_per_page"]= $aux_results_per_page;

        }

         $aux_returnArray["success"] = TRUE;
    }
        
    function GetReviewsToApp($array_get, &$aux_returnArray, &$aux_fields, &$items, &$auxTable, &$aux_Where) {

        extract($array_get);

        /**
         * Prepare columns with alias
         */
        if (is_array($aux_fields)) {

            unset($fields_to_map);

            foreach ($aux_fields as $key => $value) {
                if (strpos($value, " AS ") !== false) {
                    $fields_to_map[] = $value;
                } else {
                    $fields_to_map[] = $value." AS `".$key."`";
                }
            }
        }
        $levelsWithReview = system_retrieveLevelsWithInfoEnabled("has_review");
        $auxTable = "Review INNER JOIN  Listing_Summary ON Review.item_id = Listing_Summary.id LEFT JOIN AccountProfileContact Account ON (Account.account_id = member_id) ";
        $aux_Where[] = "item_type = 'listing'";
        $aux_Where[] = "approved = 1";
        $aux_Where[] = "Listing_Summary.status = 'A'";
        $aux_Where[] = "Listing_Summary.level IN (".implode(",", $levelsWithReview).")";

    }
    
    function GetTotalReviewsByItemID() {
       return DBQuery::execute(function(){
            $domain = DBConnection::getInstance()->getDomain();
            $stmt = $domain->prepare("SELECT count(*) AS count FROM Review WHERE item_type = :item_type AND item_id = :item_id AND approved = '1' AND status = 'A' ");

            $stmt->bindParam(':item_type',$this->item_type);
            $stmt->bindParam(':item_id', $this->item_id);
            $stmt->execute();
            $row = $stmt->fetch(\PDO::FETCH_ASSOC);
            if ($row) {
                return $row['count'];
            } 
            else {
                return NULL;
            }
        });

    }

        #-----------------------
        # Review Collctor
        #-----------------------

    public static function getReviewsByListingAndAccountID($listing_id, $account_id){
        return DBQuery::execute(function() use ($listing_id,$account_id){
             $main = DBConnection::getInstance()->getDomain();
             $stmt = $main->prepare("SELECT COUNT(*) as count FROM Review WHERE item_type = 'listing' AND item_id = :listing_id AND member_id = :account_id AND approved = '1' AND is_deleted ='0'  AND is_collected='1'");
             $stmt->bindParam(':listing_id', $listing_id);
             $stmt->bindParam(':account_id', $account_id);
             $stmt->execute();
             $row = $stmt->fetch(\PDO::FETCH_ASSOC);
             return $row['count'];

         });
    }
          
    public static function getCollectedReviewsCountByListingID($listing_id){
        return DBQuery::execute(function() use ($listing_id){
            $main = DBConnection::getInstance()->getDomain();
            $dbMain = DBConnection::getInstance()->getMainDatabaseName();
            $stmt = $main->prepare("SELECT count(*) as total From Review 
                         LEFT OUTER JOIN $dbMain.Account on Review.member_id = Account.id
                         where item_id = :listing_id and approved = 1 and is_deleted = 0 and Account.active ='y' AND is_collected='1'");
            $stmt->bindParam(':listing_id', $listing_id);
            $stmt->execute();
            $row = $stmt->fetch(\PDO::FETCH_ASSOC);

            return $row['total'];
        });
    }

    
    public static function GetCollectedReviews($account_id, $listing_id, $start_from , $number_of_results_per_page){//==================
        return DBQuery::execute(function() use ($account_id, $listing_id, $start_from , $number_of_results_per_page){
            $domain = DBConnection::getInstance()->getDomain();
            $mainDb = DBConnection::getInstance()->getMainDatabaseName();
            
            $stmt = $domain->prepare("SELECT Review.* FROM (Review, Listing) 
            			LEFT OUTER JOIN $mainDb.Account ON Review.member_id = $mainDb.Account.id
            			WHERE Review.item_type = 'listing' 
            			AND Review.item_id = :listing_id 
            			AND Review.item_id = Listing.id 
            			AND Listing.account_id = :account_id AND is_deleted=0 AND is_collected='1' 
            			AND $mainDb.Account.active = 'y' 
            		ORDER BY approved, added DESC LIMIT :start_from , :num_of_res");
            
            $stmt->bindParam(':listing_id', $listing_id);
            $stmt->bindParam(':account_id', $account_id);
            $stmt->bindValue(':start_from', (int)$start_from, \PDO::PARAM_INT);
            $stmt->bindValue(':num_of_res', (int)$number_of_results_per_page, \PDO::PARAM_INT);
            
            $stmt->execute();
            
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        });

    }

    public static function getReviewsCountByListingID($listing_id){
        return DBQuery::execute(function() use ($listing_id){
            $main = DBConnection::getInstance()->getDomain();
            $dbMain = DBConnection::getInstance()->getMainDatabaseName();
            $stmt = $main->prepare("SELECT count(*) as total From Review 
                         LEFT OUTER JOIN $dbMain.Account on Review.member_id = Account.id
                         where item_id = :listing_id and approved = 1 and is_deleted = 0 and Account.active ='y'");
            $stmt->bindParam(':listing_id', $listing_id);
            $stmt->execute();
            $row = $stmt->fetch(\PDO::FETCH_ASSOC);

            return $row['total'];
        });
    }


    public function UpdateIsCollected($review_id, $listing_id){

        DBQuery::execute(function() use ($review_id,$listing_id){
            $domain = DBConnection::getInstance()->getDomain();

            $stmt = $domain->prepare("UPDATE Review SET"               
                        . " is_collected = :is_collected "
                        . " WHERE id = :review_id "
                        ." AND item_id =:listing_id "
                  );
            $parameters = array(
                    ':is_collected'     => '1',
                    ':review_id'       => $review_id,
                    ':listing_id' =>$listing_id
                  );
            $stmt->execute($parameters);
        });
    }

    public function getAllListingsByReviewerId($user_id){
        return DBQuery::execute(function() use ($user_id){
            $domain = DBConnection::getInstance()->getDomain();
            $stmt = $domain->prepare("SELECT id, item_id, rating FROM Review where member_id = :member_id");
            $stmt->bindParam(':member_id', $user_id);
            $stmt->execute();
            
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        });
    }


        #---------------------------
        # Custom Created
        #---------------------------
    // this one
    public static function GetReviews($account_id, $listing_id, $start_from , $number_of_results_per_page){
        return DBQuery::execute(function() use ($account_id,$listing_id, $start_from , $number_of_results_per_page){
            $domain = DBConnection::getInstance()->getDomain();
            $dbMain = DBConnection::getInstance()->getMainDatabaseName();
            $stmt = $domain->prepare("SELECT Review.* FROM (Review, Listing) 
                     LEFT OUTER JOIN $dbMain.Account ON Review.member_id = $dbMain.Account.id
                     WHERE Review.item_type = 'listing' 
                     AND Review.item_id = :listing_id 
                     AND Review.item_id = Listing.id 
                     AND Listing.account_id = :account_id AND is_deleted=0 AND Review.status = 'A' 
                     AND $dbMain.Account.active = 'y' AND Review.id
                        NOT IN(select oc.review_id from Opened_Cases oc where oc.listing_id = :listing_id1)
                        ORDER BY Review.approved, Review.added DESC LIMIT :start_from , :num_of_res");
            $stmt->bindParam(':account_id', $account_id);
            $stmt->bindParam(':listing_id', $listing_id);
            $stmt->bindParam(':listing_id1', $listing_id);
            $stmt->bindValue(':start_from', (int)$start_from, \PDO::PARAM_INT);
            $stmt->bindValue(':num_of_res', (int)$number_of_results_per_page, \PDO::PARAM_INT);
            
            $stmt->execute();

            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        });
    }
    
    
    
    
   // NEW ONE WITH CASE
    
//           public static function GetReviews($account_id, $listing_id, $start_from , $number_of_results_per_page){
//        return DBQuery::execute(function() use ($account_id,$listing_id, $start_from , $number_of_results_per_page){
//            $domain = DBConnection::getInstance()->getDomain();
//            $dbMain = DBConnection::getInstance()->getMainDatabaseName();
//            $stmt = $domain->prepare("SELECT Review.* FROM (Review, Listing) 
//                     LEFT OUTER JOIN $dbMain.Account ON Review.member_id = $dbMain.Account.id
//                     LEFT OUTER JOIN $domain.Opened_Cases oc ON oc.review_id = Review.id
//                     WHERE Review.item_type = 'listing' 
//                     AND Review.item_id = :listing_id 
//                     AND Review.item_id = Listing.id 
//                     AND Listing.account_id = :account_id AND is_deleted=0 AND Review.status = 'A' 
//                     AND $dbMain.Account.active = 'y' 
//                     And oc.case_status = 'A'
//                     ORDER BY approved, added DESC LIMIT :start_from , :num_of_res");
//            $stmt->bindParam(':account_id', $account_id);
//            $stmt->bindParam(':listing_id', $listing_id);
//            $stmt->bindValue(':start_from', (int)$start_from, \PDO::PARAM_INT);
//            $stmt->bindValue(':num_of_res', (int)$number_of_results_per_page, \PDO::PARAM_INT);
//            
//            $stmt->execute();
//
//            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
//        });
//    }
    
    
    public static function giveMeTotalReviews($account_id, $listing_id){
	return DBQuery::execute(function() use ($account_id, $listing_id){
            $main = DBConnection::getInstance()->getDomain();
            $dbMain = DBConnection::getInstance()->getMainDatabaseName();
            $stmt = $main->prepare("SELECT count(*) as total 
                    FROM (
                            SELECT Review.* FROM (Review, Listing) 
                                            LEFT OUTER JOIN $dbMain.Account ON Review.member_id = $dbMain.Account.id
                            WHERE Review.item_type = 'listing' 
                            AND Review.item_id = :listing_id 
                            AND Review.item_id = Listing.id 
                            AND Listing.account_id = :account_id AND is_deleted=0 AND Review.status='A' 
                            AND $dbMain.Account.active = 'y' 

            ) as sub");
            $stmt->bindParam(':listing_id', $listing_id);
            $stmt->bindParam(':account_id', $account_id);
            $stmt->execute();
            $row = $stmt->fetch(\PDO::FETCH_ASSOC);
            return $row['total'];
        });
    }
    public static function getReviewsCountByAccountID($account_id){
        return DBQuery::execute(function() use ($account_id){
            $domain = DBConnection::getInstance()->getDomain();
            $stmt = $domain->prepare('SELECT count(*) as count FROM Review 
                   WHERE member_id = :account_id AND is_deleted = 0');
            $stmt->bindParam(':account_id', $account_id);
            $stmt->execute();
            $row = $stmt->fetch(\PDO::FETCH_ASSOC);
            return $row['count'];
        });

    }
              
    public static function getReviewsByAccountID($account_id){
        return DBQuery::execute(function() use ($account_id){
            $domain = DBConnection::getInstance()->getDomain();
            $stmt = $domain->prepare("SELECT * FROM Review 
                    WHERE member_id =:account_id AND is_deleted = 0 order by id desc");
            $stmt->bindParam(':account_id', $account_id);
            $stmt->execute();
            
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        });
    }
    
    public static function getReviewsByAccountIDForPagination($account_id, $start_from, $number_of_results_per_page){
        return DBQuery::execute(function() use ($account_id,$start_from, $number_of_results_per_page){
            $domain = DBConnection::getInstance()->getDomain();
            $stmt = $domain->prepare("SELECT * FROM Review 
                            WHERE member_id =:account_id AND is_deleted = 0 
                            order by id desc 
                            LIMIT :start,:no_of_res");
            $stmt->bindParam(':account_id', $account_id);
            $stmt->bindValue(':start', (int) $start_from, \PDO::PARAM_INT);
            $stmt->bindValue(':no_of_res', (int)$number_of_results_per_page, \PDO::PARAM_INT);
            $stmt->execute();
            
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        });
    }
        
            
    public static function getCasesByAccountID($account_id){
        return DBQuery::execute(function() use ($account_id){
            $domain = DBConnection::getInstance()->getDomain();
            $stmt = $domain->prepare("SELECT count(*) as total_cases FROM Review re
                        LEFT OUTER JOIN Opened_Cases oc 
                        on oc.review_id = re.id
                        WHERE  re.member_id = :account_id and case_status = 'A'");
            $stmt->bindParam(':account_id', $account_id);
            $stmt->execute();
            $row = $stmt->fetch(\PDO::FETCH_ASSOC);

            return $row['total_cases'];
        });
    }
    
    public static function HasCase($review_id){
        return DBQuery::execute(function() use ($review_id){
            $domain = DBConnection::getInstance()->getDomain();
            $stmt = $domain->prepare('SELECT case_status FROM Opened_Cases WHERE review_id=:review_id');
            $stmt->bindParam(':review_id', $review_id);
            $stmt->execute();
            $row = $stmt->fetch(\PDO::FETCH_ASSOC);
            return $row['case_status'];

        });
    }
    
    public static function checkIfReviewBelongsToUser($review_id, $reviewer_id){
        return DBQuery::execute(function() use ($review_id,$reviewer_id){
            $domain = DBConnection::getInstance()->getDomain();
            $stmt = $domain->prepare('SELECT count(*) as count FROM Review WHERE id=:review_id AND member_id=:reviewer_id');
            $stmt->bindParam(':review_id', $review_id);
            $stmt->bindParam(':reviewer_id', $reviewer_id);
            $stmt->execute();
            $row = $stmt->fetch(\PDO::FETCH_ASSOC);
            return $row['count'];

        });
    }
    
    public static function deleteReview($review_id){
        $domain = DBConnection::getInstance()->getDomain();
        DBQuery::execute(function() use ($domain,$review_id){
            $stmt = $domain->prepare("UPDATE Review SET"               
                    . " is_deleted = :is_deleted"
                . " WHERE id = :id");
            $parameters = array(
                    ':is_deleted'     => '1',
                    ':id'       => $review_id
                );
            $stmt->execute($parameters);
        });
    }
    public static function CloseCaseOfReview($review_id){
        	
        $main = DBConnection::getInstance()->getDomain();
        DBQuery::execute(function() use ($main,$review_id){
            $date = date("Y-m-d H:i:s");
            $case_status='C';
            $stmt = $main->prepare("UPDATE Opened_Cases SET"               
                    . " case_status = :case_status,"
                    . " closed_date = :closed_date"
                    . " WHERE review_id = :review_id");
            $parameters = array(
                    ':case_status'     => $case_status,
                    ':closed_date'     => $date,
                    ':review_id'       => $review_id
                );
            $stmt->execute($parameters);
        });
    }
    
        
    public static function activateReview($campaign_id, $email, $item_id, $item)
   {
        $main  = DBConnection::getInstance()->getMain(); 
       return DBQuery::execute(function() use ($main,$campaign_id, $email, $item_id,$item){
       $sql = $main->prepare("SELECT id, campaign_id, email, item_id, used "
               . "FROM Account_ActivationByReview "
               . "WHERE campaign_id = :campaign_id "
               . "AND email= :email "
               . "AND item_id= :item_id "
               . "AND item = :item");
       
        $sql->bindParam(':campaign_id', $campaign_id);
        $sql->bindParam(':email', $email);
        $sql->bindParam(':item_id', $item_id);
        $sql->bindParam(':item', $item);
       $result = $sql->execute();
       $row = $sql->fetch(\PDO::FETCH_ASSOC);
       if(count($row)>0){
        return true;
       }
       return false;
       });
   }
   
   public static function getListingIdFromReviewId($review_id){
       return DBQuery::execute(function() use ($review_id){
            $domain = DBConnection::getInstance()->getDomain();
            $stmt = $domain->prepare("SELECT item_id FROM Review 
                    WHERE id =:id AND is_deleted = 0 ");
            $stmt->bindParam(':id', $review_id);
            $stmt->execute();
            
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        });
   }
   
   
      public static function getReviewById($review_id){
       return DBQuery::execute(function() use ($review_id){
            $domain = DBConnection::getInstance()->getDomain();
            $stmt = $domain->prepare("SELECT * FROM Review 
                    WHERE id =:id AND is_deleted = 0");
            $stmt->bindParam(':id', $review_id);
            $stmt->execute();
            
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        });
   }
   
   
      function getRateAvgByItemCloseCase($item_type, $item_id,$count=null) {
        return DBQuery::execute(function() use ($item_type, $item_id, $count){
            $domain = DBConnection::getInstance()->getDomain();
            $mainDb = DBConnection::getInstance()->getMainDatabaseName();
            if($count){
                $stmt = $domain->prepare("SELECT round(avg(rev.rating), 1 ) as rate, count(*) as review_count 
                    FROM Review as rev
                    LEFT OUTER JOIN $mainDb.Account acc on rev.member_id = acc.id 
                    WHERE acc.active='y' 
                    AND is_deleted = '0' 
                    AND item_id = :item_id
                    AND rev.status = 'A'");
                $stmt->bindParam(':item_id', $item_id);
                $stmt->execute();
                $row = $stmt->fetch(\PDO::FETCH_ASSOC);  
                return $row;
            } 
            else {
                $stmt = $domain->prepare("SELECT round(avg(rev.rating), 1 ) as rate FROM Review as rev
                                    LEFT OUTER JOIN $mainDb.Account acc on rev.member_id = acc.id
                                    LEFT OUTER JOIN Opened_Cases oc on rev.id = oc.review_id    
                                    WHERE acc.active='y' 
                                    AND is_deleted = '0' 
                                    AND ifnull(oc.case_status, '') != 'A'                                    
                                    AND item_id = :item_id
                                    AND rev.status = 'A'");
                
                $stmt->bindParam(':item_id', $item_id);
                $result = $stmt->execute();
                $row = $stmt->fetch(\PDO::FETCH_ASSOC); 
                
                if ($result) $rate = $row["rate"];
                return (isset($rate) && $rate != 0) ? round($rate, 1) : system_showText(LANG_NA);
            }   
        });
        
    }
   
   
}
?>