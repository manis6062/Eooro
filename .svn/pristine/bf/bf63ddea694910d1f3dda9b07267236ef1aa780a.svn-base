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
# * FILE: /classes/class_Profile.php
# ----------------------------------------------------------------------------------------------------

/**
 * <code>
 *        $profileObj = new Profile($id);
 * <code>
 * @copyright Copyright 2005 Arca Solutions, Inc.
 * @author Arca Solutions, Inc.
 * @version 8.0.00
 * @package Classes
 * @name Profile
 * @method Profile
 * @method makeFromRow
 * @method Save
 * @method profileExists
 * @method findUid
 * @method Delete
 * @method fUrl_Exists
 * @method deal_done
 * @access Public
 */

class Profile extends Handle
{
    
    /**
     * @var integer
     * @access Private
     */
    var $account_id;
    /**
     * @var integer
     * @access Private
     */
    var $image_id;
    /**
     * @var string
     * @access Private
     */
    var $facebook_image;
    /**
     * @var integer
     * @access Private
     */
    var $facebook_image_height;
    /**
     * @var integer
     * @access Private
     */
    var $facebook_image_width;
    /**
     * @var string
     * @access Private
     */
    var $nickname;
    /**
     * @var string
     * @access Private
     */
    var $friendly_url;
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
     * @var string
     * @access Private
     */
    var $personal_message;
    /**
     * @var string
     * @access Private
     */
    var $twitter_account;
    /**
     * @var string
     * @access Private
     */
    var $facebook_uid;
    /**
     * @var string
     * @access Private
     */
    var $tw_post;
    /**
     * @var string
     * @access Private
     */
    var $fb_post;
    /**
     * @var string
     * @access Private
     */
    var $tw_oauth_token;
    /**
     * @var string
     * @access Private
     */
    var $tw_oauth_token_secret;
    /**
     * @var string
     * @access Private
     */
    var $tw_screen_name;
    /**
     * @var string
     * @access Private
     */
    var $profile_exists;
    /**
     * @var string
     * @access Private
     */
    var $location;
    /**
     * @var string
     * @access Private
     */
    var $usefacebooklocation;
    /**
     * @var char
     * @access Private
     */
    var $profile_complete;
    
    /**
     * <code>
     *        $profileObj = new Profile($id);
     * <code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name Profile
     * @access Public
     * @param integer $var
     */
    function __construct($var = '')
    {
        
        if (is_numeric($var) && ($var)) {
            DBQuery::execute(function() use ($var)
            {
                $main = DBConnection::getInstance()->getMain();
                $stmt = $main->prepare('SELECT * FROM Profile WHERE account_id=:var');
                $stmt->bindParam(':var', $var);
                $stmt->execute();
                $row = $stmt->fetch(\PDO::FETCH_ASSOC);
                $this->makeFromRow($row);
            });
            
        } else {
            if (!is_array($var)) {
                $var = array();
            }
            $this->makeFromRow($var);
        }
    }
    
    
    /**
     * <code>
     *        $this->makeFromRow($row);
     * <code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name makeFromRow
     * @access Public
     * @param array $row
     */
    function makeFromRow($row = '')
    {
        isset($row["account_id"]) ? $this->account_id = $row["account_id"] : $this->account_id = 0;
        isset($row["image_id"]) ? $this->image_id = $row["image_id"] : $this->image_id = 0;
        isset($row["facebook_image"]) ? $this->facebook_image = $row["facebook_image"] : $this->facebook_image = "";
        isset($row["facebook_image_height"]) ? $this->facebook_image_height = $row["facebook_image_height"] : $this->facebook_image_height = 0;
        isset($row["facebook_image_width"]) ? $this->facebook_image_width = $row["facebook_image_width"] : $this->facebook_image_width = 0;
        isset($row["nickname"]) ? $this->nickname = $row["nickname"] : $this->nickname = "";
        isset($row["friendly_url"]) ? $this->friendly_url = $row["friendly_url"] : $this->friendly_url = "";
        isset($row["entered"]) ? $this->entered = $row["entered"] : $this->entered = '0000-00-00 00:00:00';
        isset($row["updated"]) ? $this->updated = $row["updated"] : $this->updated = '0000-00-00 00:00:00';
        isset($row["personal_message"]) ? $this->personal_message = $row["personal_message"] : $this->personal_message = "";
        isset($row["twitter_account"]) ? $this->twitter_account = $row["twitter_account"] : $this->twitter_account ? $this->twitter_account = $this->twitter_account : $this->twitter_account = "";
        if (isset($row["facebook_uid"]))
            $this->facebook_uid = $row["facebook_uid"];
        else if (!$this->facebook_uid)
            $this->facebook_uid = "";
        !empty($row["tw_post"]) ? $this->tw_post = 1 : $this->tw_post = 0;
        !empty($row["fb_post"]) ? $this->fb_post = 1 : $this->fb_post = 0;
        isset($row["tw_oauth_token"]) ? $this->tw_oauth_token = $row["tw_oauth_token"] : $this->tw_oauth_token = "";
        isset($row["tw_oauth_token_secret"]) ? $this->tw_oauth_token_secret = $row["tw_oauth_token_secret"] : $this->tw_oauth_token_secret = "";
        isset($row["tw_screen_name"]) ? $this->tw_screen_name = $row["tw_screen_name"] : $this->tw_screen_name = "";
        isset($row["location"]) ? $this->location = $row["location"] : $this->location = "";
        isset($row["usefacebooklocation"]) ? $this->usefacebooklocation = $row["usefacebooklocation"] : $this->usefacebooklocation = 0;
        $this->profile_complete = (isset($row["profile_complete"])) ? $row["profile_complete"] :  "n";
        
        $this->profileExists();
    }
    
    /**
     * <code>
     *        //Using this in forms or other pages.
     *        $profileObj->Save();
     * <br /><br />
     *        //Using this in Profile() class.
     *        $this->Save();
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name Save
     * @access Public
     */
    function Save()
    {
        
        $exists = $this->profile_exists;
        $main   = DBConnection::getInstance()->getMain();
        DBQuery::execute(function() use ($main, $exists)
        {
            
            if ($exists) {
                
                $stmt       = $main->prepare("UPDATE Profile SET" . " image_id = :image_id," . " facebook_image = :facebook_image," . " facebook_image_height = :facebook_image_height," . " facebook_image_width = :facebook_image_width," . " nickname = :nickname," . " friendly_url = :friendly_url," . " updated = NOW()," . " personal_message = :personal_message," . " twitter_account = :twitter_account," . " facebook_uid = :facebook_uid, " . " tw_post = :tw_post," . " tw_oauth_token = :tw_oauth_token," . " tw_oauth_token_secret = :tw_oauth_token_secret," . " tw_screen_name = :tw_screen_name," . " location = :location," . " usefacebooklocation = :usefacebooklocation," . " profile_complete = :profile_complete " . " WHERE account_id = :account_id");
                $parameters = array(
                    ':image_id' => $this->image_id,
                    ':facebook_image' => $this->facebook_image,
                    ':facebook_image_height' => $this->facebook_image_height,
                    ':facebook_image_width' => $this->facebook_image_width,
                    ':nickname' => $this->nickname,
                    ':friendly_url' => $this->friendly_url,
                    ':personal_message' => $this->personal_message,
                    ':twitter_account' => $this->twitter_account,
                    ':facebook_uid' => $this->facebook_uid,
                    ':tw_post' => $this->tw_post,
                    ':tw_oauth_token' => $this->tw_oauth_token,
                    ':tw_oauth_token_secret' => $this->tw_oauth_token_secret,
                    ':tw_screen_name' => $this->tw_screen_name,
                    ':location' => $this->location,
                    ':usefacebooklocation' => $this->usefacebooklocation,
                    ':profile_complete' => $this->profile_complete,
                    ':account_id' => $this->account_id
                );
                $stmt->execute($parameters);
            } else {
                $auxAccID = str_replace("'", "", $this->account_id);
                
                if ($auxAccID > 0) {
                    
                    if ($this->friendly_url == "") {
                        
                        $this->friendly_url = system_generateFriendlyURL(str_replace("'", "", $this->nickname));
                    }
                    
                    
                    $stmt = $main->prepare('SELECT account_id FROM Profile WHERE friendly_url=:friendly_url');
                    $stmt->bindParam(':friendly_url', $this->friendly_url);
                    $stmt->execute();
                    $row = $stmt->fetch(\PDO::FETCH_ASSOC);
                    
               //         $stmt = $main->prepare('SELECT account_id FROM Profile WHERE friendly_url=:friendly_url');
               //  $stmt->bindParam(':friendly_url', $fUrl);
               //  $stmt->execute();
               // $rows = $stmt->fetch(\PDO::FETCH_ASSOC);
			
                    if (($row) > 0) {
                        $this->friendly_url = $this->friendly_url . FRIENDLYURL_SEPARATOR . uniqid();
                    }
                    
                    $this->friendly_url = $this->friendly_url;
                    $stmt       = $main->prepare("INSERT INTO Profile" . " (account_id,
                    image_id,
                    facebook_image,
                    facebook_image_height, " . "facebook_image_width,
                    nickname,
                    friendly_url,
                    entered,
                    personal_message, " . "twitter_account, facebook_uid, tw_post,tw_oauth_token, tw_oauth_token_secret, tw_screen_name, location,usefacebooklocation,profile_complete)" 
                        . " VALUES" 
                        . " (:account_id,  :image_id, "
                        . ":facebook_image, :facebook_image_height, " 
                        . ":facebook_image_width, :nickname, "
                        . ":friendly_url, NOW(), :personal_message, "
                        . ":twitter_account,:facebook_uid, " 
                        . ":tw_post, :tw_oauth_token, "
                        . ":tw_oauth_token_secret,:tw_screen_name,"
                        . ":location,:usefacebooklocation,:profile_complete)");
                    $parameters = array(
                        ':account_id' => $this->account_id,
                        ':image_id' => $this->image_id,
                        ':facebook_image' => $this->facebook_image,
                        ':facebook_image_height' => $this->facebook_image_height,
                        ':facebook_image_width' => $this->facebook_image_width,
                        ':nickname' => $this->nickname,
                        ':friendly_url' => $this->friendly_url,
                        ':personal_message' => $this->personal_message,
                        ':twitter_account' => $this->twitter_account,
                        ':facebook_uid' => $this->facebook_uid,
                        ':tw_post' => $this->tw_post,
                        ':tw_oauth_token' => $this->tw_oauth_token,
                        ':tw_oauth_token_secret' => $this->tw_oauth_token_secret,
                        ':tw_screen_name' => $this->tw_screen_name,
                        ':location' => $this->location,
                        ':usefacebooklocation' => $this->usefacebooklocation,
                        ':profile_complete' => $this->profile_complete
                        
                    );
                    
                    
                    $stmt->execute($parameters);
                    
                    
                }
                
            }
            
        });
    }
    
    /**
     * <code>
     *        //Using this in forms or other pages.
     *        $profileObj->profileExists();
     * <br /><br />
     *        //Using this in Profile() class.
     *        $this->profileExists();
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name Save
     * @access Public
     */
    function profileExists()
    {
        if ($this->account_id > 0)
            $this->profile_exists = true;
        else
            $this->profile_exists = false;
    }
    
    /**
     * <code>
     *        //Using this in forms or other pages.
     *        $profileObj->findUid();
     * <br /><br />
     *        //Using this in Profile() class.
     *        $this->findUid();
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name Save
     * @access Public
     */
    function findUid($uid = false)
    {
        
        //if ($uid) return true;
        $main = DBConnection::getInstance()->getMain();
        return DBQuery::execute(function() use ($main, $uid)
        {
            $stmt = $main->prepare('SELECT * FROM Profile WHERE facebook_uid=:uid');
            $stmt->bindParam(':uid', $uid);
            $stmt->execute();
            $row = $stmt->fetch(\PDO::FETCH_ASSOC);
            if ($row["account_id"]) {
                $this->makeFromRow($row);
                return true;
            } else {
                return false;
            }
           });
        }
    
    /**
     * <code>
     *        //Using this in forms or other pages.
     *        $profileObj->Delete();
     * <br /><br />
     *        //Using this in Profile() class.
     *        $this->Delete();
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name Save
     * @access Public
     */
    function Delete()
    {
        DBQuery::execute(function()
        {
            $main = DBConnection::getInstance()->getMain();
            ### IMAGE
            if ($this->image_id) 
            {
                $image = new \Image($this->image_id, true);
                if ($image)
                $image->Delete();
            }
            $stmt = $main->prepare("DELETE FROM Profile WHERE account_id = :account_id");
            $stmt->bindParam(':account_id', $this->account_id);
            $stmt->execute();
        });
    }
    /**
     * <code>
     *        //Using this in forms or other pages.
     *        $profileObj->fUrl_Exists();
     * <br /><br />
     *        //Using this in Profile() class.
     *        $this->fUrl_Exists();
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name Save
     * @access Public
     */
    function fUrl_Exists($fUrl)
    {
        if (!empty($fUrl)){ 
            $main = DBConnection::getInstance()->getMain();
            return DBQuery::execute(function() use ($fUrl,$main)
            {
                $stmt = $main->prepare('SELECT account_id FROM Profile WHERE friendly_url=:friendly_url');
                $stmt->bindParam(':friendly_url', $fUrl);
                $stmt->execute();
               $rows = $stmt->fetch(\PDO::FETCH_ASSOC);
			
                if ($rows > 0){
                    if ($rows["account_id"] == sess_getAccountIdFromSession()){
                        return false;
                    }
                    else{
                        return true;
                    }

                } 
                else{
                    return false;
                }
            });
            
        } else{
            return false;
        }
    }
    
    /**
     * <code>
     *        //Using this in forms or other pages.
     *        $profileObj->deal_done();
     * <br /><br />
     *        //Using this in Profile() class.
     *        $this->deal_done();
     * </code>
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @version 8.0.00
     * @name Save
     * @access Public
     */
    //         function deal_done($dealtype = "twitter", $promotion_id = false, $network_response = false){
    
    //             if (!$promotion_id)  return false;
    
    //             if($dealtype == "profile"){
    //                 $twittered = 0;
    //                 $facebooked = 0;
    //             } else if($dealtype == "twitter"){
    //                 $twittered = 1;
    //                 $facebooked = 0;
    //             } else {
    //                 $twittered = 0;
    //                 $facebooked = 1;
    //             }
    
    //             $dbObj = db_getDBObject(DEFAULT_DB, true);
    //             $dbDomain = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbObj);
    
    //             $sqlRedeem = "SELECT id FROM `Promotion_Redeem` WHERE `account_id` = ".sess_getAccountIdFromSession()." AND `promotion_id` = $promotion_id LIMIT 1";
    //             $resRedeem = $dbDomain->query($sqlRedeem);
    
    //             if (mysql_num_rows($resRedeem) > 0) {
    //                 $rowRedeem = mysql_fetch_assoc($resRedeem);
    //                 $redeem_id = $rowRedeem["id"];
    
    //                 $arrayUpdate = array();
    
    //                 if ($dealtype == "twitter") $arrayUpdate[]= "twittered = 1";
    //                 if ($dealtype == "profile") $arrayUpdate[]= "facebooked = 1";
    
    //                 $sqlSet = implode(",",$arrayUpdate);
    //                 $sqlSet .= ", network_response = CONCAT(network_response, ".db_formatString("[|]".$network_response).")";
    
    //                 $sql = "UPDATE Promotion_Redeem SET ".$sqlSet." WHERE id = ".$redeem_id;
    //                 $result = $dbDomain->query($sql);
    //             } else {
    //                 $redeem_code = system_generatePassword();
    
    //                 $sql = "INSERT INTO Promotion_Redeem ( ";
    //                 $sql .= "account_id, promotion_id, twittered, facebooked, network_response, datetime, redeem_code";
    //                 $sql .= " ) VALUES (";
    //                 $sql .= (int)sess_getAccountIdFromSession().", ";
    //                 $sql .= (int)$promotion_id.", ";
    //                 $sql .= "$twittered, $facebooked, ";
    //                 $sql .= db_formatString($network_response).", ";
    //                 $sql .= "NOW(), ".db_formatString($redeem_code)."";
    //                 $sql .= ")";
    //                 $result = $dbDomain->query($sql);
    
    //                 $sql = "UPDATE Promotion SET amount = amount - 1 WHERE id = $promotion_id";
    //                 $dbDomain->query($sql);
    
    //                 //Notification to deal owner
    //                 $promotionObj = new Promotion($promotion_id);
    //                 $contactObj = new Contact($promotionObj->getNumber('account_id'));
    //                 if ($emailNotificationObj = system_checkEmail(SYSTEM_NEW_DEAL)) {
    //                     setting_get("sitemgr_email", $sitemgr_email);
    //                     $sitemgr_emails = explode(",", $sitemgr_email);
    //                     if ($sitemgr_emails[0]) $sitemgr_email = $sitemgr_emails[0];
    //                     $subject   = $emailNotificationObj->getString("subject");
    //                     $body      = $emailNotificationObj->getString("body");
    //                     $body      = system_replaceEmailVariables($body, $promotionObj->getNumber('id'), 'promotion');
    //                     $subject   = system_replaceEmailVariables($subject, $promotionObj->getNumber('id'), 'promotion');
    //                     $body      = html_entity_decode($body);
    //                     $subject   = html_entity_decode($subject);
    //                     $error = false;
    //                     system_mail($contactObj->getString("email"), $subject, $body, EDIRECTORY_TITLE." <$sitemgr_email>", $emailNotificationObj->getString("content_type"), "", $emailNotificationObj->getString("bcc"), $error, "", "", "", "", $contactObj->account_id, SYSTEM_NEW_DEAL);
    //                 }
    
    //                 //Notification to user
    //                 unset($contactObj);
    //                 $contactObj = new Contact(sess_getAccountIdFromSession());
    //                 if ($emailNotificationObj = system_checkEmail(SYSTEM_DEAL_DONE)) {
    //                     setting_get("sitemgr_email", $sitemgr_email);
    //                     $sitemgr_emails = explode(",", $sitemgr_email);
    //                     if ($sitemgr_emails[0]) $sitemgr_email = $sitemgr_emails[0];
    //                     $subject   = $emailNotificationObj->getString("subject");
    //                     $body      = $emailNotificationObj->getString("body");
    //                     $body      = system_replaceEmailVariables($body, $promotionObj->getNumber('id'), 'promotion', $redeem_code, $contactObj->getString('first_name').' '.$contactObj->getString('last_name'));
    //                     $subject   = system_replaceEmailVariables($subject, $promotionObj->getNumber('id'), 'promotion');
    //                     $body      = html_entity_decode($body);
    //                     $subject   = html_entity_decode($subject);
    //                     $error = false;
    //                     system_mail($contactObj->getString("email"), $subject, $body, EDIRECTORY_TITLE." <$sitemgr_email>", $emailNotificationObj->getString("content_type"), "", $emailNotificationObj->getString("bcc"), $error, "", "", "", "", $contactObj->account_id, SYSTEM_NEW_DEAL);
    //                 }
    //             }
    
    //             return $redeem_code;
    //         }  
    //     }
    // 
    function deal_done($dealtype = "twitter", $promotion_id = false)
    {
        if (!$promotion_id)
            return false;
        
        if ($dealtype == "profile") {
            $twittered  = 0;
            $facebooked = 0;
        } else if ($dealtype == "twitter") {
            $twittered  = 1;
            $facebooked = 0;
        } else {
            $twittered  = 0;
            $facebooked = 1;
        }
        $main = DBConnection::getInstance()->getDomain();
        return DBQuery::execute(function() use ($main)
        {
            // $sqlRedeem = "SELECT id FROM `Promotion_Redeem` WHERE `account_id` = ".sess_getAccountIdFromSession()." AND `promotion_id` = $promotion_id LIMIT 1";
            // $resRedeem = $dbDomain->query($sqlRedeem);
            
            $stmt = $main->prepare('SELECT id '
                    . 'FROM Promotion_Redeem '
                    . 'WHERE account_id=:account_id AND promotion_id =:promotion_id '
                    . 'LIMIT 1');
            $stmt->bindParam(':account_id', sess_getAccountIdFromSession());
            $stmt->bindParam(':promotion_id', $promotion_id);
            $stmt->execute();
            $row = $stmt->fetch(\PDO::FETCH_ASSOC);
            
            if ($row > 0) {
                
                $redeem_id   = $row["id"];
                $arrayUpdate = array();
                if ($dealtype == "twitter")
                    $arrayUpdate[] = "twittered = 1";
                if ($dealtype == "profile")
                    $arrayUpdate[] = "facebooked = 1";
                $sqlSet = implode(",", $arrayUpdate);
                $sqlSet .= ", network_response = CONCAT(network_response, " . db_formatString("[|]" . $network_response) . ")";
                echo $redeem_id;
                // $sql = "UPDATE Promotion_Redeem SET "
                // .$sqlSet." WHERE id = ".$redeem_id;
                // $result = $main->query($sql);
                $stmt       = $main->prepare("UPDATE Promotion_Redeem SET" 
                        . ":network_response " . " WHERE id = :redeem_id");
                $parameters = array(
                    ':network_response' => $sqlSet,
                    ':redeem_id' => $redeem_id
                );
            } else {
                
                $redeem_code = system_generatePassword();
                
                $sql = "INSERT INTO Promotion_Redeem ( ";
                $sql .= "account_id, promotion_id, twittered, facebooked, network_response, datetime, redeem_code";
                $sql .= " ) VALUES (";
                $sql .= (int) sess_getAccountIdFromSession() . ", ";
                $sql .= (int) $promotion_id . ", ";
                $sql .= "$twittered, $facebooked, ";
                $sql .= db_formatString($network_response) . ", ";
                $sql .= "NOW(), " . db_formatString($redeem_code) . "";
                $sql .= ")";
                $result     = $dbDomain->query($sql);
                $sql        = $main->prepare("UPDATE Promotion SET" . " amount = :amount - 1" . " WHERE id = :promotion_id");
                $parameters = array(
                    ':amount - 1' => promotion_id,
                    ':promotion_id' => $promotion_id
                );
                
                $dbDomain->query($sql);
                
                //Notification to deal owner
                $promotionObj = new Promotion($promotion_id);
                $contactObj   = new Contact($promotionObj->getNumber('account_id'));
                if ($emailNotificationObj = system_checkEmail(SYSTEM_NEW_DEAL)) {
                    
                    setting_get("sitemgr_email", $sitemgr_email);
                    $sitemgr_emails = explode(",", $sitemgr_email);
                    if ($sitemgr_emails[0])
                        $sitemgr_email = $sitemgr_emails[0];
                    $subject = $emailNotificationObj->getString("subject");
                    $body    = $emailNotificationObj->getString("body");
                    $body    = system_replaceEmailVariables($body, $promotionObj->getNumber('id'), 'promotion');
                    $subject = system_replaceEmailVariables($subject, $promotionObj->getNumber('id'), 'promotion');
                    $body    = html_entity_decode($body);
                    $subject = html_entity_decode($subject);
                    $error   = false;
                    system_mail($contactObj->getString("email"), $subject, $body, EDIRECTORY_TITLE . " <$sitemgr_email>", $emailNotificationObj->getString("content_type"), "", $emailNotificationObj->getString("bcc"), $error, "", "", "", "", $contactObj->account_id, SYSTEM_NEW_DEAL);
                }
                
                //Notification to user
                unset($contactObj);
                $contactObj = new Contact(sess_getAccountIdFromSession());
                if ($emailNotificationObj = system_checkEmail(SYSTEM_DEAL_DONE)) {
                    
                    setting_get("sitemgr_email", $sitemgr_email);
                    $sitemgr_emails = explode(",", $sitemgr_email);
                    if ($sitemgr_emails[0])
                        $sitemgr_email = $sitemgr_emails[0];
                    $subject = $emailNotificationObj->getString("subject");
                    $body    = $emailNotificationObj->getString("body");
                    $body    = system_replaceEmailVariables($body, $promotionObj->getNumber('id'), 'promotion', $redeem_code, $contactObj->getString('first_name') . ' ' . $contactObj->getString('last_name'));
                    $subject = system_replaceEmailVariables($subject, $promotionObj->getNumber('id'), 'promotion');
                    $body    = html_entity_decode($body);
                    $subject = html_entity_decode($subject);
                    $error   = false;
                    system_mail($contactObj->getString("email"), $subject, $body, EDIRECTORY_TITLE . " <$sitemgr_email>", $emailNotificationObj->getString("content_type"), "", $emailNotificationObj->getString("bcc"), $error, "", "", "", "", $contactObj->account_id, SYSTEM_NEW_DEAL);
                }
            }
            $stmt->execute($parameters);
            
            return $redeem_code;
        });
    }
}
?>