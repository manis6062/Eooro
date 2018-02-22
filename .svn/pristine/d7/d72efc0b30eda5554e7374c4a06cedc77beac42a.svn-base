<?php

class PaymentCaseLog extends Handle
{
    protected $id;
    protected $payment_log_id;
    protected $case_id;
    protected $amount;
    
    function __construct( $id="", $domain_id = false)
    {
        if (is_numeric($id) && ($id)) {
            $db     = $this->getDb($domain_id);
            
            $select = array( 'id', 'payment_log_id', 'case_id', 'amount' );
            $sql = "SELECT ".implode(',', $select)." FROM Payment_Case_Log WHERE id = $id";

            $row = mysql_fetch_assoc($db->query($sql));

            $this->makeFromRow( $row );
        }
        else if( is_array($id) || is_object($id) ){
            $this->makeFromRow( $id );
        }
        else{
            throw new InvalidArgumentException( 'variable "$id" should be a number, or valid array / object');
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

//        $this->prepareToSave();
        
        $array = get_object_vars( $this );
        if ( is_numeric($this->id) ) {
            // update code
            $sql = "UPDATE Payment_Case_Log SET ";
            $array = get_object_vars( $this );
            foreach ( $array as $key => $values ){
                if ( $key !== 'id' ) {
                    $sql .= " ".$key."='".$values."',";
                }
            }
            $sql = rtrim( $sql, ',' );
            $sql .= " WHERE id='$this->id'";
        }
        else {
            // insert code
            // splitting field name and values
            $field_names    = array_keys( $array );
            $field_values   = array_values( $array );
            
            $sql = "INSERT INTO Payment_Case_Log (".implode(',', $field_names)
                    .") VALUES ('".implode( "','", $field_values )."') ";
        }
        $dbObj->query( $sql );
    }
    
    protected function getDb( $domain_id = false )
    {
        static $db;
        if ( !isset($db) ) {
            $dbMain = db_getDBObject(DEFAULT_DB, true);
            if ($domain_id){
                $db = db_getDBObjectByDomainID($domain_id, $dbMain);
            }else if (defined("SELECTED_DOMAIN_ID")) {
                $db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
            } else {
                $db = db_getDBObject();
            }
            unset($dbMain);
        }
        
        return $db;
    }
}
