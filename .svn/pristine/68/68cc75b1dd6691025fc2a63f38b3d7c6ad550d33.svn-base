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
	# * FILE: /classes/class_account.php
	# ----------------------------------------------------------------------------------------------------

/**
 * <code>
 *		$accountObj = new Account($id);
 * <code>
 * @copyright Copyright 2005 Arca Solutions, Inc.
 * @author Arca Solutions, Inc.
 * @version 7.5.00
 * @package Classes
 * @name Account
 * @method Account
 * @method makeFromRow
 * @method Save
 * @method updateLastLogin
 * @method updatePassword
 * @method setForeignAccountAuth
 * @method setForeignAccountRedirect
 * @method getForeignAccountRedirect
 * @method Delete
 * @method getCustomInvoicesNumber
 * @method changeMemberStatus
 * @method changeProfileStatus
 * @access Public
 */
class Review_Account extends Handle {

        /**
         * @var integer
         * @access Private
         */
        var $id;
        /**
         * @var date
         * @access Private
         */
        var $entered;
        /**
         * @var date
         * @access Private
         */
        var $updated;
        /**
         * @var char
         * @access Private
         */
        var $agree_tou;
        /**
         * @var date
         * @access Private
         */
        var $lastlogin;
        /**
         * @var string
         * @access Private
         */
        var $facebook_username;
        /**
         * @var string
         * @access Private
         */
        var $username;
        /**
         * @var string
         * @access Private
         */
        var $password;
        /**
         * @var char
         * @access Private
         */
        var $foreignaccount;
        /**
         * @var char
         * @access Private
         */
        var $foreignaccount_done;
        /**
         * @var char
         * @access Private
         */
        var $is_sponsor;
        /**
         * @var char
         * @access Private
         */
        var $has_profile;
        /**
         * @var char
         * @access Private
         */
        var $publish_contact;
        /**
         * @var char
         * @access Private
         */
        var $facebook_firstname;
        /**
         * @var char
         * @access Private
         */
        var $facebook_lastname;
        /**
         * @var char
         * @access Private
         */
        var $notify_traffic_listing;
        /**
         * @var char
         * @access Private
         */
        var $active;
        /**
         * @var char
         * @access Private
         */
        var $newsletter;

        /**
         * @var char
         * @access Private
         */
        var $prefered_currency;

        /**
         * @var char
         * @access Private
         */
        var $currency_symbol;

        /**
         * @var char
         * @access Private
         */
        var $bt_customer_id;

    /**
     * <code>
     *		$accountObj = new Account($id);
     * <code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 7.5.00
     * @name Account
     * @access Public
     * @param integer $var
     */
    function __construct($var='') {
        if (is_numeric($var) && ($var)) {

            $row = DBQuery::execute(function() use ($var){
                $main = DBConnection::getInstance()->getMain();
                $stmt = $main->prepare('SELECT * FROM Review_login_credential WHERE id=:id');
                $stmt->bindParam(':id', $var);
                $stmt->execute();
                return $stmt->fetch(\PDO::FETCH_ASSOC);
            }); 
            $this->makeFromRow($row);
        } 
        else {
            if (!is_array($var)) {
                $var = array();
            }
            $this->makeFromRow($var);
        }
    }

    /**
     * <code>
     *		$this->makeFromRow($row);
     * <code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 7.5.00
     * @name makeFromRow
     * @access Public
     * @param array $row
     */
    function makeFromRow($row='') {
            if (isset($row["id"])) $this->id = $row["id"];
            else if (!$this->id) $this->id = 0;
           
            if (isset($row["updated_on"])) $this->updated = $row["updated_on"];
            else if (!$this->updated) $this->updated = 0;
            
            if (isset($row["last_login_on"])) $this->lastlogin = $row["last_login_on"];
            else if (!$this->lastlogin) $this->lastlogin = 0;
            if (isset($row["facebook_username"])) $this->facebook_username = $row["facebook_username"];
            else if (!$this->facebook_username) $this->facebook_username = "";
            if (isset($row["username"])) $this->username = $row["username"];
            else if (!$this->username) $this->username = "";
            if (isset($row["password"])) $this->password = $row["password"];
            else if (!$this->password) $this->password = "";
            if (isset($row["foreignaccount"])) $this->foreignaccount = $row["foreignaccount"];
            else if (!$this->foreignaccount) $this->foreignaccount = "n";
            if (isset($row["facebook_firstname"])) $this->facebook_firstname = $row["facebook_firstname"];
            else if (!$this->facebook_firstname) $this->facebook_firstname = "";
            if (isset($row["facebook_lastname"])) $this->facebook_lastname = $row["facebook_lastname"];
            else if (!$this->facebook_lastname) $this->facebook_lastname = "";
            if (isset($row["is_enable"])) $this->active = $row["is_enable"];
            else if (!$this->active) $this->active = "n";
           
            
    }


    /**
     * <code>
     *		//Using this in forms or other pages.
     *		$accountObj->Save();
     * <br /><br />
     *		//Using this in Account() class.
     *		$this->Save();
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 7.5.00
     * @name Save
     * @access Public
     */
    function Save() {

        $insert_password = $this->password;
        $aux_username = $this->username;
        $aux_password = $this->password;
        $main = DBConnection::getInstance()->getMain();
        DBQuery::execute(function() use ($main, $aux_username,$aux_password, $insert_password){
            if ($this->id) { 
                $stmt = $main->prepare("UPDATE Review_login_credentials SET"
                    . " updated_on = NOW(),"
                    . " facebook_username = :facebook_username,"
                    //. " username = :username,"
                    . " foreignaccount = :foreignaccount,"
                    . " is_enable = :active,"
                    . " WHERE id = :id");
                $parameters = array( 	
                    ':facebook_username' => $this->facebook_username,
                    ':foreignaccount'=>$this->foreignaccount,
                    ':active'=>$this->active,
                    ':id'=>$this->id,
                            );
                $stmt->execute($parameters);

            }  
            else {
                $stmt = $main->prepare("INSERT INTO Review_login_credentials"
                    . " (
                     created_on,
                     updated_on,
                     facebook_username,
                     username,
                     password,
                     foreignaccount,
                     is_enable)"
                    ." VALUES"
                    ." (NOW(),
                    NOW(),
                    :facebook_username,
                    :username,
                    :password,
                    :foreignaccount,
                    :active)");
                $parameters = array(
                    ':facebook_username'   => $this->facebook_username,
                    ':username'   => $this->username,
                    ':password'   => ((string_strtolower(PASSWORD_ENCRYPTION) == "on") ? md5($insert_password) : $insert_password),
                    ':foreignaccount'   => $this->foreignaccount,
                    ':active'   => $this->active,
                    
                );
                
                $stmt->execute($parameters);
                $this->id = $main->lastInsertId();
                
                activity_newActivity(SELECTED_DOMAIN_ID, $this->id, 0, "newserviceaccount");
            }

//            $this->prepareToUse();

        });
        return TRUE;
    }
    /**
     * <code>
     *		//Using this in forms or other pages.
     *		$accountObj->updateLastLogin();
     * <br /><br />
     *		//Using this in Account() class.
     *		$this->updateLastLogin();
     * <code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 7.5.00
     * @name updateLastLogin
     * @access Public
     */
    function updateLastLogin() {
        $main = DBConnection::getInstance()->getMain();
        DBQuery::execute(function() use ($main){
            $stmt = $main->prepare("UPDATE Review_login_credentials SET"
            . " lastlogin = NOW() "
            . " WHERE id = :id");

             $parameters = array(
            ':id' => $this->id,
            );

            $stmt->execute($parameters);
        });
    }
    /**
     * <code>
     *		//Using this in forms or other pages.
     *		$accountObj->updatePassword();
     * <br /><br />
     *		//Using this in Account() class.
     *		$this->updatePassword();
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 7.5.00
     * @name updatePassword
     * @access Public
     */
    function updatePassword() {
        $main = DBConnection::getInstance()->getMain();
        DBQuery::execute(function() use ($main){
            $stmt = $main->prepare("UPDATE Review_login_credentials SET"
                ." updated = NOW(),"
                ."password = :password,"
                
                ." WHERE id = :id");
            $parameters = array(
                    ':password' =>(((string_strtolower(PASSWORD_ENCRYPTION) == 'on') ? md5($this->password) : $this->password)),
                    
                    ':id'   => $this->id);
            $stmt->execute($parameters);
        });
    }
                
    /**
     * <code>
     *		//Using this in forms or other pages.
     *		$accountObj->setForeignAccountAuth($auth);
     * <br /><br />
     *		//Using this in Account() class.
     *		$this->setForeignAccountAuth($auth);
     * <code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 7.5.00
     * @name setForeignAccountAuth
     * @access Public
     * @param string $auth
     */
    function setForeignAccountAuth($auth, $first_name = "", $last_name = "") {

        $main = DBConnection::getInstance()->getMain();
        DBQuery::execute(function() use ($main,$auth,$first_name,$last_name){


            if ($first_name && $last_name){
                $stmt = $main->prepare("UPDATE Review_login_credentials SET"
                            ." foreignaccount_auth = :auth,"
                            ." facebook_firstname = :first_name,"
                            ." facebook_lastname = :last_name"
                            ." WHERE id = :id");
                $parameters = array(
                    ':auth' => $auth,
                    ':first_name' => $first_name,
                    ':last_name'  => $last_name,
                    ':id'   => $this->id
                );

            }else{

                $stmt = $main->prepare("UPDATE Review_login_credentials SET"
                    ." foreignaccount_auth = :auth"
                    ." WHERE id=:id");
                $parameters = array(
                    ':auth' => $auth,
                    ':id'=>$this->id);
                     //foreignaccount_auth = ".db_formatString($auth)." WHERE id = $this->id";
            }
            $stmt->execute($parameters);
        });
    }

    
    /**
     * <code>
     *		//Using this in forms or other pages.
     *		$accountObj->Delete();
     * <code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 7.5.00
     * @name Delete
     * @access Public
     */
    function Delete() {
        DBQuery::execute(function(){
            $domainDbObj = DBConnection::getInstance()->getDomain();
            if (is_numeric($this->id) && $this->id > 0) {
                $accDomainObj = new Account_Domain();
                $domains = $accDomainObj->getAll($this->id);

                /*
                 * Contact Cascade
                 */
                $contactObj = new Contact($this->id);
                $contactObj->Delete();
                unset($contactObj);

                /*
                 * Profile Cascade
                 */
                $profileObj = new Profile($this->id);
                $profile_name = addslashes($profileObj->getString("nickname"));
                $profileObj->Delete();
                unset($profileObj);

                            /*
                             * Redeem Profile Name Update
                             */
                            //$sql = "UPDATE `Promotion_Redeem` SET `profile_name` = ".db_formatString($profile_name)." WHERE `account_id` = $this->id";
                            //$dbDomain->Query($sql);

                $stmt = $domainDbObj->prepare("UPDATE Promotion_Redeem SET"
                            . " profile_name = :profile_name "
                            . " WHERE account_id = :account_id");	

                $parameters = array(
                        ':profile_name' => $profile_name,
                        ':account_id'  => $this->id);
                $stmt->execute($parameters);



                            // $sql = "UPDATE `Promotion_Redeem` SET `profile_name` = ".db_formatString($profile_name)." WHERE `account_id` = $this->id";
                            // $dbDomain->Query($sql);
                /*
                * Account Activation Cascade
                */
                $accActObj = new Account_Activation();
                $accActObj->deletePerAccount($this->id);
                unset($accActObj);

                /*
                 * Forgot Password Cascade
                 */
                $fgtPassObj = new forgotPassword();
                $fgtPassObj->deletePerAccount($this->id);
                unset($fgtPassObj);

                /*
                 * Aux Objects
                 */

                $auxObj = Array("Article", "Banner", "Classified", "Comments", "CustomInvoice", "Event", "Gallery", "Listing", "Promotion", "Review");

                foreach ($auxObj as $class) {
                        ${$class."Obj"} = new $class();
                                                                        }

                foreach ($domains as $domain) {
                        unset($dbObj);
                        $dbObj = db_getDBObjectByDomainID($domain, $dbObjMain);

                    foreach ($auxObj as $class) {
                            ${$class."Obj"}->deletePerAccount($this->id, $domain);
                    }

                    /*
                     * Invoice Cascade
                     */
                    $stmt = $domainDbObj->prepare("UPDATE Invoice SET"
                                . " account_id = :acc_id"
                                . " where account_id = :account_id");
                    $parameters = array(
                            ":acc_id" =>'0',
                            ':account_id'  => $this->id);
                    $stmt->execute($parameters);

                    /*
                     * Payment Log Cascade
                     */
                    $stmt = $domainDbObj->prepare("UPDATE Payment_Log SET"
                                . " account_id = :acc_id"
                                . " where account_id = :account_id");
                    $parameters = array(
                           ":acc_id" =>'0',
                            ':account_id'  => $this->id);
                    $stmt->execute($parameters);
                    /*
                     * Claim Cascade
                     */
                    $stmt = $domainDbObj->prepare("UPDATE Claim SET"
                                . " status = :incomplete"
                                . " where account_id = :account_id "
                                . " AND status=:status");
                    $parameters = array(
                           ":incomplete" =>'incomplete',
                            ':account_id'  => $this->id,
                            ':status' => 'progress');
                    $stmt->execute($parameters);



                    $stmt = $domainDbObj->prepare("UPDATE Claim SET"
                                . " account_id = :accountid"
                                . " where account_id = :account_id");
                    $parameters = array(
                           ":accountid" =>'0',
                            ':account_id'  => $this->id);
                    $stmt->execute($parameters);

                    /*
                     * Deleting Account from Import Setting
                     */
                    $stmt = $domainDbObj->prepare('SELECT value FROM Setting WHERE name="import_account_id"');
                    $stmt->execute();
                    $row = $stmt->fetch(\PDO::FETCH_ASSOC);



                    if ($row["value"] == $this->id) {
                        $stmt = $domainDbObj->prepare("UPDATE Setting SET"
                            . "value = '',"
                            . " where name = 'import_account_id'");
                        $stmt->execute();
                    }

                    /*
                     * Deleting Account from Import Setting
                     */
                    // $sql = "SELECT `value` FROM `Setting` WHERE `name` = 'import_account_id_event'";
                    // $result = $dbObj->Query($sql);

                    $stmt = $domainDbObj->prepare('SELECT value FROM Setting WHERE name="import_account_id_event"');
                    $stmt->execute();
                    $row = $stmt->fetch(\PDO::FETCH_ASSOC);

                    if ($row["value"] == $this->id) {
                        $stmt = $domainDbObj->prepare("UPDATE `Setting` "
                                . "SET `value` = '' "
                                . "WHERE `name` = 'import_account_id_event'");
                        $stmt->execute();
                    }
                    /*
                     * AccountProfileContact Cascade
                     */
                    $apcObj = new AccountProfileContact($domain, $this->id);
                    $apcObj->Delete();
                    $accDObj = new Account_Domain($this->id, $domain);
                    $accDObj->Delete();
                }
                foreach ($auxObj as $class) {
                        unset(${$class."Obj"});
                }
                /*
                 * This Account
                 */
                $stmt = $domainDbObj->prepare("DELETE FROM Account WHERE id = :id");
                $stmt->bindParam(':id', $this->id);
                $stmt->execute();


            }

        });
    }
    /**
     * <code>
     *		//Using this in forms or other pages.
     *		$accountObj->getCustomInvoicesNumber();
     * <br /><br />
     *		//Using this in Account() class.
     *		$this->getCustomInvoicesNumber();
     * <code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 7.5.00
     * @name getCustomInvoicesNumber
     * @access Public
     * @param integer $domain_id
     * @return integer
     */
    function getCustomInvoicesNumber($domain_id = false) {
        $main = DBConnection::getInstance()->getMain();
        return  DBQuery::execute(function() use ($domain_id,$main){
            $stmt = $main->prepare("SELECT COUNT(id) as custom_invoice_number FROM CustomInvoice WHERE account_id = :account_id AND paid != 'y' AND sent = 'y'");
            $stmt->bindParam(':account_id', $this->id);
            $stmt->execute();
            $row = $stmt->fetch(\PDO::FETCH_ASSOC);
            if ($row["custom_invoice_number"]) return $row["custom_invoice_number"];
            else return false;
        });
    }
		
    
    function getAccountItems(){

        $main = DBConnection::getInstance()->getDomain();
        return DBQuery::execute(function() use ($main){
            $accDomainObj = new Account_Domain();
            $domains = $accDomainObj->getAll($this->id);
            if ($domains && count($domains) > 0) {
                foreach ($domains as $domain_id) {
                    $dbObj = db_getDBObjectByDomainID($domain_id, $dbObjMain);
                    $stmt = "SELECT COUNT(id) AS COUNT FROM Listing WHERE account_id = :account_id";
                    $stmt->bindParam(':account_id', $this->id);
                    $row = $stmt->fetch(\PDO::FETCH_ASSOC);
                    $items = $row["COUNT"] > 0 ? true: false;
                    if (ARTICLE_FEATURE == "on" && CUSTOM_ARTICLE_FEATURE == "on" && !$items) {
                            $stmt = $main->prepare('SELECT COUNT(id) AS COUNT FROM Article WHERE account_id=:account_id');
                            $stmt->bindParam(':account_id', $this->id);
                            $stmt->execute();
                            $row = $stmt->fetch(\PDO::FETCH_ASSOC);

                            $items = $row["COUNT"] > 0 ? true: false;
                    }
                    if (BANNER_FEATURE == "on" && CUSTOM_BANNER_FEATURE == "on" && !$items) {
                            $stmt = $main->prepare('SELECT COUNT(id) AS COUNT FROM Banner WHERE account_id=:account_id');
                            $stmt->bindParam(':account_id', $this->id);
                            $stmt->execute();
                            $row = $stmt->fetch(\PDO::FETCH_ASSOC);
                            $items = $row["COUNT"] > 0 ? true: false;
                    }
                    if (CLASSIFIED_FEATURE == "on" && CUSTOM_CLASSIFIED_FEATURE == "on" && !$items) {
                            $stmt = $main->prepare('SELECT COUNT(id) AS COUNT FROM Classified WHERE account_id=:account_id');
                            $stmt->bindParam(':account_id', $this->id);
                            $stmt->execute();
                            $row = $stmt->fetch(\PDO::FETCH_ASSOC);
                            $items = $row["COUNT"] > 0 ? true: false;
                    }
                    if (EVENT_FEATURE == "on" && CUSTOM_EVENT_FEATURE == "on" && !$items) {
                            $stmt = $main->prepare('SELECT COUNT(id) AS COUNT FROM Event WHERE account_id=:account_id');
                            $stmt->bindParam(':account_id', $this->id);
                            $stmt->execute();
                            $row = $stmt->fetch(\PDO::FETCH_ASSOC);
                            $items = $row["COUNT"] > 0 ? true: false;
                             return $row;


                    }

                    if (PROMOTION_FEATURE == "on" && CUSTOM_PROMOTION_FEATURE == "on" && !$items) {
                    $stmt = $main->prepare('SELECT COUNT(id) AS COUNT FROM Promotion WHERE account_id=:account_id');
                    $stmt->bindParam(':account_id', $this->id);
                    $stmt->execute();
                    $row = $stmt->fetch(\PDO::FETCH_ASSOC);
                    $items = $row["COUNT"] > 0 ? true: false;
                    }

                    if (CUSTOM_INVOICE_FEATURE == "on" && !$items) {
                            $count = $this->getCustomInvoicesNumber($domain_id);
                            $items = $count > 0 ? true: false;
                    }
                    if ($items) break;
                }
            } else {

                $items = false;
            }
            return $items;
        });
    }
    
    public static function checkUser($email){
        $main = DBConnection::getInstance()->getMain();
        return DBQuery::execute(function() use ($main, $email){
            $stmt = $main->prepare("SELECT count(*) as total FROM Account WHERE username=:username");
            $stmt->bindParam(':username', $email);
            $stmt->execute();
            $return = $stmt->fetch(\PDO::FETCH_ASSOC);
            
            return $return['total'] > 0 ? true : false;
        });
    }	
    
    public static function getAccountIDFromEmail($email){
        $main = DBConnection::getInstance()->getMain();
        return DBQuery::execute(function() use ($main,$email){
            $stmt = $main->prepare('SELECT id  FROM Account WHERE username=:username');
            $stmt->bindParam(':username', $email);
            $stmt->execute();
            $row = $stmt->fetch(\PDO::FETCH_ASSOC);

            return $row['id'];
        });	
    }
}
?>