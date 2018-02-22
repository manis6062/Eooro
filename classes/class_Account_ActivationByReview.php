<?php


class Account_ActivationByReview extends Handle
{
    /**
    * @var integer
    */
   var $id;
   /**
    * @var string 
    */
   var $campaign_id;
   /**
    * @var string
    */
   var $email;
   /**
    * @var integer
    */
   var $item_id;
   
   public function __construct($var = array()) 
   {
       if (is_numeric($var) && ($var)) {
            $db = db_getDBObject(DEFAULT_DB, true);
            $sql = "SELECT id, email, campaign_id, item_id FROM Account_ActivationByReview WHERE id = $var";
            $row = mysql_fetch_array($db->query($sql));
            $this->makeFromRow($row);
        } 
        else {
            if (!is_array($var)) {
                $var = array();
            }
            $this->makeFromRow($var);
        }
   }
   
   protected function makeFromRow($array)
   {
       $this->id = $array['id'];
       $this->email = $array['email'];
       $this->campaign_id = $array['campaign_id'];
       $this->item_id = $array['item_id'];
   }
   /**
    * To get the database row corresponding to campaign id, user email, 
    * and listing id.
    * 
    * @param type $campaign_id
    * @param type $email
    * @param type $item_id
    * @return type
    */
   public function getRecord($campaign_id, $email, $item_id)
   {
       $db = db_getDBObject(DEFAULT_DB, true);
       $sql = "SELECT id, campaign_id, email, item_id, used "
               . "FROM Account_ActivationByReview "
               . "WHERE campaign_id = '".mysql_real_escape_string($campaign_id)."' "
               . "AND email='".  mysql_real_escape_string($email)."' "
               . "AND item_id='".  mysql_real_escape_string($item_id)."' ";
       
       $row = mysql_fetch_assoc($db->query($sql));
       return $row;
   }
   
   /**
    * To check if database already has the campaign id.
    * 
    * @param string $campaign_id
    * @return boolean
    */
   public function hasCampaignId($campaign_id)
   {
       $db = db_getDBObject(DEFAULT_DB, true);
       $sql = "SELECT id "
               . "FROM Account_ActivationByReview "
               . "WHERE campaign_id = '".mysql_real_escape_string($campaign_id)."' ";
       
       $row = mysql_fetch_assoc($db->query($sql));
       return (boolean)$row;
   }
   
   public function save($campaign_id, $email, $item_id, $item)
   {
       $db = db_getDBObject(DEFAULT_DB, true);
       
       $email   = mysql_real_escape_string($email);
       $campid  = mysql_real_escape_string($campaign_id);
       $item_id    = mysql_real_escape_string($item_id);
       $now = date("Y-m-d H:i:s");
       
       $sql = "INSERT INTO Account_ActivationByReview "
               . "(email, campaign_id, item, item_id, created_ts) "
               . "VALUES ('$email', '$campid', '$item', '$item_id', '$now')";
       $db->query($sql);
   }
}
