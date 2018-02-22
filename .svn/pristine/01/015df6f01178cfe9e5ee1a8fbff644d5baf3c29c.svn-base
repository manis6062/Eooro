<?

/* ==================================================================*\
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
  \*================================================================== */

# ----------------------------------------------------------------------------------------------------
# * FILE: /functions/sess_funct.php
# ----------------------------------------------------------------------------------------------------
# ----------------------------------------------------------------------------------------------------
# * MEMBERS
# ----------------------------------------------------------------------------------------------------

function sess_authenticateServiceAccount($appId,$username, $password, &$authmessage) { 
    $main = DBConnection::getInstance()->getMain();
    return DBQuery::execute(function() use($appId , $username, $password, &$authmessage, $main) { 

        /*** system to check multiple login failed ***/
                $stmt = $main->prepare("SELECT faillogin_count, faillogin_datetime, is_enable FROM Review_login_credentials  WHERE app_id = :app_id AND username = :username ");
                $stmt->bindParam(':username', $username);
                $stmt->bindParam(':app_id', $appId);
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $faillogin_count = $row["faillogin_count"];
                $faillogin_datetime = $row["faillogin_datetime"];
                $fail = FAILLOGIN_MAXFAIL; 
                if($row['is_enable' == 0]){
                     $authmessage = system_showText(LANG_MSG_ACCOUNTNOTENABLED);
                return json_encode(array('listing_id' => null, 'msg' => $authmessage));
                
                } 
                if (($faillogincount = (int) ($faillogin_count / (FAILLOGIN_MAXFAIL + 1))) > 0) {
                    if (($faillogin_count % (FAILLOGIN_MAXFAIL + 1)) == 0) {
//                      
                        $sql = $main->prepare("UPDATE Review_login_credentials SET is_locked = 1 WHERE app_id = :app_id AND username = :username");
                        $parameters = array(':app_id'=>$appId,'username'=>$username);
                        $sql->execute($parameters);                        
                        $authmessage = system_showText(LANG_MSG_ACCOUNTLOCKED3);
                        return json_encode(array('listing_id' => null, 'msg' => $authmessage));
                    }
                }
               
                
               /*** end of code for multiple login failed check ***/

                /*** login check code start ***/
            $domain = DBConnection::getInstance()->getDomain();
            $domainDb = DBConnection::getInstance()->getDomainDatabaseName();
            $mainDb = DBConnection::getInstance()->getMainDatabaseName();
                $stmt = $main->prepare("SELECT r.* , l.status FROM $mainDb.Review_login_credentials r INNER JOIN $domainDb.Listing l on r.listing_id = l.id where r.app_id = :app_id AND r.username = :username AND r.password = :password");

                //$password = (((string_strtolower(PASSWORD_ENCRYPTION) == "on") ? ($password) : $password));
                $stmt->bindParam(':username', $username);
                $stmt->bindParam(':password', $password);
                $stmt->bindParam(':app_id', $appId);

                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $row_count = $stmt->rowCount();
                /*** once successful login reset faillogin_count to 0 ***/
                if ($row_count > 0) {
                    $stmt = $main->prepare("UPDATE Review_login_credentials SET"
                            . " faillogin_count = :faillogin_count,"
                            . " faillogin_datetime = :faillogin_datetime, "
                            . " last_login_on = NOW() "
                            . " WHERE app_id = :app_id "
                            . " AND username = :username ");
                    $parameters = array(
                        ':faillogin_count' => '0',
                        ':faillogin_datetime' => '0000-00-00 00:00:01',
                        ':app_id' => $appId,
                        ':username' => $username
                    );
                    $stmt->execute($parameters);
                    if (!isset($_SESSION)) {
                        session_start(sess_generateSessIdString());
                    }
                    sess_registerServiceAccountInSession($username);
                    /*  If success return listing id and success message */
                    
                    
                    if($row['status'] == 'A'){
                        return json_encode(array('listing_id' => $row['listing_id'], 'msg' => $authmessage));
                    }else{
                        $authmessage = 'Sorry, Your business is not active. Please login to eooro to check status.';
                        return json_encode(array('listing_id' => null, 'msg' => $authmessage));
                    }
                    
                    
                    
                } else { /// if login failed increment faillogin_count 
                    $stmt = $main->prepare("UPDATE Review_login_credentials SET"
                            . " faillogin_count = :faillogin_count,"
                            . " faillogin_datetime = NOW() "
                            . " WHERE app_id = :app_id "
                            . " AND username = :username ");
                    $parameters = array(
                        ':faillogin_count' => $faillogin_count + 1,
                        ':app_id' => $appId,
                        ':username' => $username
                    );
                    $stmt->execute($parameters);
                    $authmessage = system_showText(LANG_MSG_APP_WRONG_CREDINTIALS);
                    return json_encode(array('listing_id' => null, 'msg' => $authmessage));
                }
            });
}

function sess_registerServiceAccountInSession($username) {//okk
    $domain = DBConnection::getInstance()->getDomain();
    DBQuery::execute(function() use($domain, $username) {
       
       
                $stmt = $domain->prepare("INSERT INTO Report_Login"
                        . " ( datetime, ip, type, page, username)"
                        . " VALUES"
                        . " (NOW(),:ip, :type, :page, :username)");
                $parameters = array(
                    ':ip' => getenv("REMOTE_ADDR"),
                    ':type' => 'logout',
                    ':page' => $_SERVER["PHP_SELF"],
                    // ':username' => $smacctObj->getString("username")
                    ':username' => $username
                );
            
            $stmt->execute($parameters);
        
    });
}

function get_campaign_id(){
    $data = openssl_random_pseudo_bytes(16);
    $data[6] = chr(ord($data[6]) & 0x0f | 0x40); // set version to 0100
    $data[8] = chr(ord($data[8]) & 0x3f | 0x80); // set bits 6-7 to 10
    return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
}

?>
