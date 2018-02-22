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

function sess_authenticateAccount($username, $password, &$authmessage) {//okk
    $main = DBConnection::getInstance()->getMain();
    return DBQuery::execute(function() use($username, $password, &$authmessage, $main) {
                $stmt = $main->prepare("SELECT faillogin_count, faillogin_datetime FROM Account WHERE foreignaccount = 'n' AND username = :username");
                $stmt->bindParam(':username', $username);
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                $faillogin_count = $row["faillogin_count"];
                $faillogin_datetime = $row["faillogin_datetime"];

                if (($faillogincount = (int) ($faillogin_count / (FAILLOGIN_MAXFAIL + 1))) > 0) {
                    if (($faillogin_count % (FAILLOGIN_MAXFAIL + 1)) == 0) {
                        $faillogindatetime = preg_split("/[-, ,:]+/", $faillogin_datetime);
                        $failloginnow = preg_split("/[-, ,:]+/", date("Y-m-d H:i:s"));
                        if (($failloginsec = (mktime($failloginnow[3], $failloginnow[4], $failloginnow[5], $failloginnow[1], $failloginnow[2], $failloginnow[0]) - mktime($faillogindatetime[3], $faillogindatetime[4], $faillogindatetime[5], $faillogindatetime[1], $faillogindatetime[2], $faillogindatetime[0]))) < ($faillogincount * FAILLOGIN_TIMEBLOCK * 60)) {
                            $authmessage = system_showText(LANG_MSG_ACCOUNTLOCKED1) . " " . (($faillogincount * FAILLOGIN_TIMEBLOCK) - (int) ($failloginsec / 60)) . " " . system_showText(LANG_MSG_ACCOUNTLOCKED2);
                            return false;
                        }
                    }
                }
                ####################################################################################################
                ### END - MEMBER
                ####################################################################################################
                $stmt = $main->prepare("SELECT * FROM Account WHERE (foreignaccount = 'n' AND username = :username AND password = :password) OR (foreignaccount = 'y' AND facebook_username LIKE 'facebook%' AND username = :username1 AND password = :password1)");

                $password = (((string_strtolower(PASSWORD_ENCRYPTION) == "on") ? md5($password) : $password));
                $stmt->bindParam(':username', $username);
                $stmt->bindParam(':password', $password);
                $stmt->bindParam(':username1', $username);
                $stmt->bindParam(':password1', $password);
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $row_count = $stmt->rowCount();
                if ($row_count) {
                    $stmt = $main->prepare("UPDATE Account SET"
                            . " faillogin_count = :faillogin_count,"
                            . " faillogin_datetime = :faillogin_datetime "
                            . " WHERE foreignaccount = :foreignaccount "
                            . " AND username = :username ");
                    $parameters = array(
                        ':faillogin_count' => '0',
                        ':faillogin_datetime' => '0000-00-00 00:00:01',
                        ':foreignaccount' => 'n',
                        ':username' => $username
                    );
                    $stmt->execute($parameters);
                    return true;
                } else {
                    $stmt = $main->prepare("UPDATE Account SET"
                            . " faillogin_count = :faillogin_count,"
                            . " faillogin_datetime = NOW() "
                            . " WHERE foreignaccount = :foreignaccount "
                            . " AND username = :username ");
                    $parameters = array(
                        ':faillogin_count' => faillogin_count + 1,
                        ':foreignaccount' => 'n',
                        ':username' => $username
                    );
                    $stmt->execute($parameters);
                    $authmessage = system_showText(LANG_MSG_USERNAME_OR_PASSWORD_INCORRECT);
                    return false;
                }
            });
}

function sess_registerAccountInSession($username, $facebook = false) {
    $domain = DBConnection::getInstance()->getDomain();
    DBQuery::execute(function() use($domain, $username, $facebook) {
        if (!isset($_SESSION)) {
            session_start(sess_generateSessIdString());
        }

        if (!$_SESSION[SM_LOGGEDIN]) {
            $dbLogoutObj = db_getDBObject();
            if ($_SESSION[SESS_SM_ID]) {
                $smacctObj = db_getFromDB("smaccount", "id", db_formatNumber($_SESSION[SESS_SM_ID]));
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
            } else {
                setting_get("sitemgr_username", $smusername);
                $stmt = $domain->prepare("INSERT INTO Report_Login"
                        . " ( datetime, ip, type, page, username)"
                        . " VALUES"
                        . " (NOW(),:ip, :type, :page, :username)");
                $parameters = array(
                    ':ip' => getenv("REMOTE_ADDR"),
                    ':type' => 'logout',
                    ':page' => $_SERVER["PHP_SELF"],
                    // ':username' => $smacctObj->getString("username")
                    ':username' => $smusername
                );
            }
            $stmt->execute($parameters);
        }

        unset($_SESSION[SM_LOGGEDIN]);
        unset($_SESSION[SESS_SM_ID]);
        unset($_SESSION[SESS_SM_PERM]);

        $_x_user_perm = $_SESSION["USER_PERM"];
        $_x_request_uri = $_SESSION["REQUEST_URI"];
        $_x_item_action = $_SESSION["ITEM_ACTION"];
        $_x_http_refer = $_SESSION["HTTP_REFER"];
        $_x_item_type = $_SESSION["ITEM_TYPE"];
        $_x_item_id = $_SESSION["ITEM_ID"];
        $_x_account_redirect = $_SESSION["ACCOUNT_REDIRECT"];

        unset($arrFBAux);
        foreach ($_SESSION as $key => $value) {
            if (string_strpos($key, "fb_") !== false) {
                $arrFBAux[$key] = $value;
            }
        }

        unset($arrGOAux);
        foreach ($_SESSION as $key => $value) {
            if (string_strpos($key, "go_") !== false) {
                $arrGOAux[$key] = $value;
            }
        }
        /**
         * Session Modification
         */
        $hash_session = $_SESSION['hash_sess_id'];
        $destiny = $_SESSION['red_destiny'];
        session_unset();

        $_SESSION['hash_sess_id'] = $hash_session;
        $_SESSION['red_destiny'] = $destiny;

        if (is_array($arrFBAux) && isset($arrFBAux)) {
            foreach ($arrFBAux as $key => $value) {
                $_SESSION[$key] = $value;
            }
        }

        if (is_array($arrGOAux) && isset($arrGOAux)) {
            foreach ($arrGOAux as $key => $value) {
                $_SESSION[$key] = $value;
            }
        }
        $_SESSION["USER_PERM"] = $_x_user_perm;
        $_SESSION["REQUEST_URI"] = $_x_request_uri;
        $_SESSION["ITEM_ACTION"] = $_x_item_action;
        $_SESSION["HTTP_REFER"] = $_x_http_refer;
        $_SESSION["ITEM_TYPE"] = $_x_item_type;
        $_SESSION["ITEM_ID"] = $_x_item_id;
        $_SESSION["ACCOUNT_REDIRECT"] = $_x_account_redirect;

        if ($facebook) {
            $acctObj = db_getFromDB("account", "facebook_username", db_formatString($username));
        } else {
            $acctObj = db_getFromDB("account", "username", db_formatString($username));
        }

        if ($acctObj)
            $acctObj->updateLastLogin();
        $_SESSION[SESS_ACCOUNT_ID] = $acctObj->getNumber("id");

        $dbLoginObj = db_getDBObject();
        $stmt = $domain->prepare("INSERT INTO Report_Login"
                . " ( datetime, ip, type, page, username)"
                . " VALUES"
                . " (NOW(),:ip, :type, :page, :username)");
        $parameters = array(
            ':ip' => getenv("REMOTE_ADDR"),
            ':type' => 'login',
            ':page' => $_SERVER["PHP_SELF"],
            // ':username' => $smacctObj->getString("username")
            ':username' => $username
        );

        $stmt->execute($parameters);
        activity_newActivity(SELECTED_DOMAIN_ID, sess_getAccountIdFromSession(), 0, "login");
    });
}

function sess_logoutAccount() {
    if (!isset($_SESSION)) {
        session_start();
    }
   
    if ($_SESSION[SESS_ACCOUNT_ID]) {
        $domain = DBConnection::getInstance()->getDomain();
        DBQuery::execute(function()use($domain) {
            $acctObj = db_getFromDB("account", "id", db_formatNumber($_SESSION[SESS_ACCOUNT_ID]));
            $stmt = $domain->prepare("INSERT INTO Report_Login"
                    . " ( datetime, ip, type, page, username)"
                    . " VALUES"
                    . " (NOW(),:ip, :type, :page, :username)");
            $parameters = array(
                ':ip' => getenv("REMOTE_ADDR"),
                ':type' => 'logout',
                ':page' => $_SERVER["PHP_SELF"],
                // ':username' => $smacctObj->getString("username")
                ':username' => $acctObj->getString("username")
            );
            $stmt->execute($parameters);
        });
    }
   
    session_unset();
    setcookie(session_name(), '', (time() - 2592000), '/', '', 0);
    setcookie("automatic_login_members", "false", time() + 60 * 60 * 24 * 30, "" . EDIRECTORY_FOLDER . "/");
    setcookie("complementary_info_members", "", 0, "" . EDIRECTORY_FOLDER . "/");

    $host = string_strtoupper(str_replace("www.", "", $_SERVER["HTTP_HOST"]));

    setcookie($host . "_DOMAIN_ID_MEMBERS", "", time() + 60 * 60 * 24 * 30, "" . EDIRECTORY_FOLDER . "/");
    setcookie($host . "_DOMAIN_ID", "", time() + 60 * 60 * 24 * 30, "" . EDIRECTORY_FOLDER . "/");

    session_destroy();

    if ($_SERVER['HTTP_X_REQUESTED_WITH']) {


        die("
				<script>
					window.location.href = '" . MEMBERS_LOGIN_PAGE . "';
				</script>
			");
    } else {

        header("Location: " . MEMBERS_LOGIN_PAGE);
        exit;
    }
}

function sess_validateSession() {//while login redirected to login page
    global $_COOKIE;
    if (!isset($_SESSION)) {
        session_start();
    }
    
    if ($_COOKIE["automatic_login_members"] == "true") {
        if ($_COOKIE["complementary_info_members"]) { 
            $main = DBConnection::getInstance()->getMain();
            DBQuery::execute(function()use($main) {
            // $sql = $main->prepare("SELECT * FROM Account WHERE username = " . db_formatString($_COOKIE["username_members"]) . " AND complementary_info = " . db_formatString($_COOKIE["complementary_info_members"]) . "");
            $sql = $main->prepare("SELECT * FROM Account WHERE username = :username_members AND complementary_info = :complementary_info_members");
            $sql->bindParam(':username_members', $_COOKIE["username_members"]);
            $sql->bindParam(':complementary_info_members', $_COOKIE["complementary_info_members"]);
            $sql->execute();
            
            $row = $sql->fetch(\PDO::FETCH_ASSOC);
            
            $row_count = $sql->rowCount();

            if ($row_count == 0) {
                sess_logoutAccount();
            }
            });
        } else {
            sess_logoutAccount();
        }
    }

    if (!empty($_SESSION[SESS_ACCOUNT_ID]) || ($_COOKIE["automatic_login_members"] == "true")) {
        if (!empty($_SESSION[SESS_ACCOUNT_ID])) {
            $acctObj = db_getFromDB("account", "id", db_formatNumber($_SESSION[SESS_ACCOUNT_ID]));
            if (!$acctObj || !$acctObj->getNumber("id") || ($acctObj->getNumber("id") <= 0))
                sess_logoutAccount();
        }
        if (($_COOKIE["automatic_login_members"] == "true") && empty($_SESSION[SESS_ACCOUNT_ID]))
            sess_registerAccountInSession($_COOKIE["username_members"]);
    } else {
        sess_logoutAccount();
    }

    $accountObj = db_getFromDB("account", "id", db_formatNumber($_SESSION[SESS_ACCOUNT_ID]));
    if ($accountObj->getNumber("id") > 0) {
        if (($accountObj->getString("foreignaccount") == "y") && ($accountObj->getString("foreignaccount_done") == "n")) {
            if ((string_strpos($_SERVER["PHP_SELF"], "/account/index.php") === false) && (string_strpos($_SERVER["PHP_SELF"], "/logout.php") === false)) {
                header("Location: " . DEFAULT_URL . "/" . MEMBERS_ALIAS . "/account/index.php?id=" . $accountObj->getNumber("id"));
                exit;
            }
        }
    }

    if ($accountObj->getString("is_sponsor") != "y") {

        if (string_strpos($_SERVER["PHP_SELF"], MEMBERS_ALIAS) == true) {
            if (string_strpos($_SERVER["PHP_SELF"], MEMBERS_ALIAS . "/login.php") === false && string_strpos($_SERVER["PHP_SELF"], MEMBERS_ALIAS . "/logout.php") === false && string_strpos($_SERVER["PHP_SELF"], MEMBERS_ALIAS . "/resetpassword.php") === false) {

                //TO DO:: added for member_status change 
                $accountObj = db_getFromDB("account", "id", db_formatNumber($_SESSION[SESS_ACCOUNT_ID]));
                $account = new Account($accountObj->id);
                $account->changeMemberStatus(true);

                // header("Location: ".MEMBERS_LOGIN_PAGE."?np=1");
                // exit;
            }
        }
    }
}

# ----------------------------------------------------------------------------------------------------
# * SITEMGR
# ----------------------------------------------------------------------------------------------------

function sess_authenticateSM($username, $password, &$authmessage) {//okk
    $domain = DBConnection::getInstance()->getDomain();
    $main = DBConnection::getInstance()->getMain();
    return DBQuery::execute(function() use ($username, $password, &$authmessage, $main, $domain) {
                $stmt = $main->prepare("SELECT * FROM Setting WHERE name= :sitemgr_username AND value=:value");
                $name = 'sitemgr_username';
                $stmt->bindParam(':value', $username);
                $stmt->bindParam(':sitemgr_username', $name);
                $stmt->execute();
                $row = $stmt->fetch(\PDO::FETCH_BOTH);
               
                if ($row) {
                    ### BEGIN - SUPER SITE MANAGER
                    ####################################################################################################
                    setting_get("sitemgr_faillogin_count", $faillogin_count);
                    setting_get("sitemgr_faillogin_datetime", $faillogin_datetime);
                    if (($faillogincount = (int) ($faillogin_count / (FAILLOGIN_MAXFAIL + 1))) > 0) {
                        if (($faillogin_count % (FAILLOGIN_MAXFAIL + 1)) == 0) {
                            $faillogindatetime = preg_split("/[-, ,:]+/", $faillogin_datetime);
                            $failloginnow = preg_split("/[-, ,:]+/", date("Y-m-d H:i:s"));
                            if (($failloginsec = (mktime($failloginnow[3], $failloginnow[4], $failloginnow[5], $failloginnow[1], $failloginnow[2], $failloginnow[0]) - mktime($faillogindatetime[3], $faillogindatetime[4], $faillogindatetime[5], $faillogindatetime[1], $faillogindatetime[2], $faillogindatetime[0]))) < ($faillogincount * FAILLOGIN_TIMEBLOCK * 60)) {
                                $authmessage = system_showText(LANG_MSG_ACCOUNTLOCKED1) . " " . (($faillogincount * FAILLOGIN_TIMEBLOCK) - (int) ($failloginsec / 60)) . " " . system_showText(LANG_MSG_ACCOUNTLOCKED2);
                                return false;
                            }
                        }
                    }
                    ####################################################################################################
                    ### END - SUPER SITE MANAGER
                    ####################################################################################################
                    $stmt = $main->prepare("SELECT * FROM Setting WHERE name = 'sitemgr_password' AND value = :password");
                    $password = md5($password);
                    $stmt->bindParam(':password', $password);
                    $stmt->execute();
                    $row = $stmt->fetch(\PDO::FETCH_BOTH);
                    if ($row) {
                        setting_set("sitemgr_faillogin_count", "0");
                        setting_set("sitemgr_faillogin_datetime", "0000-00-00 00:00:00");
                        return true;
                    } else {
                        setting_get("sitemgr_faillogin_count", $sitemgr_faillogin_count);
                        setting_set("sitemgr_faillogin_count", $sitemgr_faillogin_count + 1);
                        setting_set("sitemgr_faillogin_datetime", date("Y-m-d H:i:s"));
                    }
                } else {
                    ####################################################################################################
                    ### BEGIN - SITE MANAGER
                    ####################################################################################################
                    $stmt = $main->prepare("SELECT faillogin_count, faillogin_datetime FROM SMAccount WHERE username=:username");
                    $stmt->bindParam(':username', $username);
                    $stmt->execute();
                    $row = $stmt->fetch(\PDO::FETCH_ASSOC);
                    
                    $faillogin_count = $row["faillogin_count"];
                    $faillogin_datetime = $row["faillogin_datetime"];
                    if (($faillogincount = (int) ($faillogin_count / (FAILLOGIN_MAXFAIL + 1))) > 0) {
                        if (($faillogin_count % (FAILLOGIN_MAXFAIL + 1)) == 0) {
                            $faillogindatetime = preg_split("/[-, ,:]+/", $faillogin_datetime);
                            $failloginnow = preg_split("/[-, ,:]+/", date("Y-m-d H:i:s"));
                            if (($failloginsec = (mktime($failloginnow[3], $failloginnow[4], $failloginnow[5], $failloginnow[1], $failloginnow[2], $failloginnow[0]) - mktime($faillogindatetime[3], $faillogindatetime[4], $faillogindatetime[5], $faillogindatetime[1], $faillogindatetime[2], $faillogindatetime[0]))) < ($faillogincount * FAILLOGIN_TIMEBLOCK * 60)) {
                                $authmessage = system_showText(LANG_MSG_ACCOUNTLOCKED1) . " " . (($faillogincount * FAILLOGIN_TIMEBLOCK) - (int) ($failloginsec / 60)) . " " . system_showText(LANG_MSG_ACCOUNTLOCKED2);
                                return false;
                            }
                        }
                    }
                    ####################################################################################################
                    ### END - SITE MANAGER
                    ####################################################################################################
                    $stmt = $main->prepare("SELECT * FROM SMAccount WHERE username = :username AND password = :password");
                    $password = md5($password);
                    $stmt->bindParam(':username', $username);
                    $stmt->bindParam(':password', $password);
                    $stmt->execute();
                    $row = $stmt->fetch(\PDO::FETCH_ASSOC);
                    
                    if ($row) {
                        $hasAcessActive = false;
                        if ($row["active"] == 'y')
                            $hasAcessActive = true;

                        $hasAccess = false;
                        $remote_ipaddress = explode(".", $_SERVER["REMOTE_ADDR"]);
                        $iprestrictions = explode("\n", $row["iprestriction"]);
                        foreach ($iprestrictions as $iprestriction) {
                            $iprestriction = str_replace("\r", "", $iprestriction);
                            if ($iprestriction) {
                                $iprestriction = explode(".", $iprestriction);
                                if ($iprestriction[0] == "*") {
                                    $hasAccess = true;
                                } elseif (($remote_ipaddress[0] == $iprestriction[0]) && ($iprestriction[1] == "*")) {
                                    $hasAccess = true;
                                } elseif (($remote_ipaddress[0] == $iprestriction[0]) && ($remote_ipaddress[1] == $iprestriction[1]) && ($iprestriction[2] == "*")) {
                                    $hasAccess = true;
                                } elseif (($remote_ipaddress[0] == $iprestriction[0]) && ($remote_ipaddress[1] == $iprestriction[1]) && ($remote_ipaddress[2] == $iprestriction[2]) && ($iprestriction[3] == "*")) {
                                    $hasAccess = true;
                                } elseif (($remote_ipaddress[0] == $iprestriction[0]) && ($remote_ipaddress[1] == $iprestriction[1]) && ($remote_ipaddress[2] == $iprestriction[2]) && ($remote_ipaddress[3] == $iprestriction[3])) {
                                    $hasAccess = true;
                                }
                            } else {
                                $hasAccess = true;
                            }
                        }
                        if ($hasAccess && $hasAcessActive) {
                            // $sql = "UPDATE SMAccount SET faillogin_count = 0, faillogin_datetime = '0000-00-00 00:00:00' WHERE username = $username";
                            //$dbMain->query($sql);
                            //return true;
                            $faillogin_count = '0';
                            $faillogin_datetime = '0000-00-00 00:00:00';
                            $stmt = $main->prepare("UPDATE SMAccount SET"
                                    . " faillogin_count = :faillogin_count, "
                                    . " faillogin_datetime = NOW() "
                                    . " WHERE username = :username");
                            $parameters = array(
                                ':faillogin_count' => $faillogin_count,
                                ':username' => $username
                            );
                            $stmt->execute($parameters);
                            return true;
                        } else {
                            if (!$hasAcessActive) {
                                $authmessage = system_showText(LANG_MSG_ACCOUNT_DEACTIVE);
                            } else {
                                $authmessage = system_showText(LANG_MSG_YOUDONTHAVEACCESSFROMTHISIPADDRESS);
                            }
                            return false;
                        }
                    } else {
                        //$sql = "//SMAccount SET faillogin_count = faillogin_count + 1, faillogin_datetime = NOW() WHERE username = $username";
                        //$dbMain->query($sql);
                        $faillogin_count = faillogin_count + 1;
                        $faillogin_datetime = '0000-00-00 00:00:00';
                        $stmt = $main->prepare("UPDATE SMAccount SET"
                                . " faillogin_count = :faillogin_count, "
                                . " faillogin_datetime = NOW() "
                                . " WHERE username = :username");
                        $parameters = array(
                            ':faillogin_count' => $faillogin_count,
                            ':username' => $username
                        );
                        $stmt->execute($parameters);
                        return true;
                    }
                }

                $authmessage = system_showText(LANG_MSG_USERNAME_OR_PASSWORD_INCORRECT);
                return false;
            });
}

function sess_registerSMInSession($username) {//okk
    $domain = DBConnection::getInstance()->getDomain();
    DBQuery::execute(function()use($domain, $username) {
        if (!isset($_SESSION)) {
            session_start(sess_generateSessIdString());
        }
       
        if ($_SESSION[SESS_ACCOUNT_ID]) {

            $acctObj = db_getFromDB("account", "id", db_formatNumber($_SESSION[SESS_ACCOUNT_ID]));
            $stmt = $domain->prepare("INSERT INTO Report_Login"
                    . " ( datetime, ip, type, page, username)"
                    . " VALUES"
                    . " (NOW(),:ip, :type, :page, :username)");
            $parameters = array(
                ':ip' => getenv("REMOTE_ADDR"),
                ':type' => 'logout',
                ':page' => $_SERVER["PHP_SELF"],
                
                ':username' => $acctObj->getString("username")
            );
            $stmt->execute($parameters); 
        }

        unset($_SESSION[SESS_ACCOUNT_ID]);

        session_unset();

        $_SESSION[SM_LOGGEDIN] = "true";
        $smacctObj = db_getFromDB("smaccount", "username", db_formatString($username));
        
        if ($smacctObj->getNumber("id") > 0) {
            $_SESSION[SESS_SM_ID] = $smacctObj->getNumber("id");
            $_SESSION[SESS_SM_PERM] = $smacctObj->getString("permission");
            if ($smacctObj->getString("username") == ARCALOGIN_USERNAME) {
                $_SESSION["is_arcalogin"] = true;
            } else {
                $_SESSION["is_arcalogin"] = false;
            }
        }

        $stmt = $domain->prepare("INSERT INTO Report_Login"
                . " ( datetime, ip, type, page, username)"
                . " VALUES"
                . " (NOW(),:ip, :type, :page, :username)");
        $parameters = array(
            ':ip' => getenv("REMOTE_ADDR"),
            ':type' => 'login',
            ':page' => $_SERVER["PHP_SELF"],
            //':username' => $smacctObj->getString("username")
            ':username' => $username
        );
        $stmt->execute($parameters);
    });
}

function sess_logoutSM() {
    if (!isset($_SESSION)) {
        session_start();
    }
    if ($_SESSION[SM_LOGGEDIN]) {
        $main = DBConnection::getInstance()->getDomain();
        DBQuery::execute(function() use($main) {
            if ($_SESSION[SESS_SM_ID]) {
                $smacctObj = db_getFromDB("smaccount", "id", db_formatNumber($_SESSION[SESS_SM_ID]));
                //echo '<pre>'; print_r($smacctObj);die;
                $stmt = $main->prepare("INSERT INTO Report_Login "
                        . "(datetime, ip, type, page, username)"
                        . "values" . "(NOW(),:ip, :type,:page,:username )");
                $parameters = array(
                    ':ip' => getenv("REMOTE_ADDR"),
                    ':type' => 'logout',
                    ':page' => $_SERVER["PHP_SELF"],
                    ':username' => $smacctObj->getString("username")
                    //':username' => $username
                );
            } else {
                  setting_get("sitemgr_username", $username);
                  
                // $logoutSQL = "INSERT INTO Report_Login (datetime, ip, type, page, username) values (NOW(), " . db_formatString(getenv("REMOTE_ADDR")) . ", 'logout', " . db_formatString($_SERVER["PHP_SELF"]) . ", " . db_formatString($username) . ")";
                $smacctObj = db_getFromDB("smaccount", "id", db_formatNumber($_SESSION[SESS_SM_ID]));
                $stmt = $main->prepare("INSERT INTO Report_Login "
                        . "(datetime, ip, type, page, username)"
                        . "values" . "(NOW(),:ip, :type,:page,:username )");
                $parameters = array(
                    ':ip' => getenv("REMOTE_ADDR"),
                    ':type' => 'logout',
                    ':page' => $_SERVER["PHP_SELF"],
                    // ':username' => $smacctObj->getString("username")
                    ':username' => $username
                );
            }
            $stmt->execute($parameters); //echo'test'; die;
        });
    }
    session_unset();
    setcookie(session_name(), '', (time() - 2592000), '/', '', 0);
    setcookie("automatic_login_sitemgr", "false", time() + 60 * 60 * 24 * 30, "" . EDIRECTORY_FOLDER . "/");
    setcookie("complementary_info_sitemgr", "", 0, "" . EDIRECTORY_FOLDER . "/");

    $host = string_strtoupper(str_replace("www.", "", $_SERVER["HTTP_HOST"]));

    setcookie($host . "_DOMAIN_ID_SITEMGR", "", time() + 60 * 60 * 24 * 30, "" . EDIRECTORY_FOLDER . "/");

    session_destroy();
    header("Location: " . SM_LOGIN_PAGE);
    exit;
}

function sess_validateSMSession() {


    global $_COOKIE;

    if (!isset($_SESSION)) {
        session_start();
    }

    if (file_exists(EDIRECTORY_ROOT . "/" . SITEMGR_ALIAS . "/crsbrdb.php"))
        sess_logoutSM();

    $cookie = $_COOKIE["complementary_info_sitemgr"];

    
    if ($_COOKIE["automatic_login_sitemgr"] == "true") { 
       
       
        if ($cookie) {
            setting_get("sitemgr_username", $sitemgr_username);
           
            if (!$_SESSION["SESS_SM_ID"] && $sitemgr_username == $_COOKIE["username_sitemgr"]) {
                $_SESSION["is_arcalogin"] = false;
                setting_get("complementary_info", $complementary_info);
                if ($cookie != $complementary_info) {
                    sess_logoutSM();
                }
            } else { 
                $main = DBConnection::getInstance()->getMain();
                DBQuery::execute(function() use($main,$cookie) {
                    $sql = $main->prepare("SELECT * FROM SMAccount WHERE username = :username AND complementary_info = :cookie");
                    $sql->bindParam(':username', $_COOKIE["username_sitemgr"]);
                    $sql->bindParam(':cookie', $cookie);
                    $sql->execute();
                    $row = $sql->fetch(\PDO::FETCH_ASSOC);
                   
                    $row_count = $sql->rowCount();
                    if ($row_count == 0) {
                        $_SESSION["is_arcalogin"] = false;
                        sess_logoutSM();
                    } else {
                        $row = mysql_fetch_assoc($result);
                        if ($row["username"] == ARCALOGIN_USERNAME) {
                            $_SESSION["is_arcalogin"] = true;
                        } else {
                            $_SESSION["is_arcalogin"] = false;
                        }
                    }
                });
            }
        } else {
            $_SESSION["is_arcalogin"] = false;
            header("Location: " . SM_LOGIN_PAGE . "?destiny=" . $_SERVER["PHP_SELF"] . "&query=" . $_SERVER["QUERY_STRING"]);
            exit;
        }
    }

    if (!empty($_SESSION[SM_LOGGEDIN]) || ($_COOKIE["automatic_login_sitemgr"] == "true")) {
        if (!empty($_SESSION[SM_LOGGEDIN])) {
            if ($_SESSION[SESS_SM_ID]) {
                $smacctObj = db_getFromDB("smaccount", "id", db_formatNumber($_SESSION[SESS_SM_ID]));
                if (!$smacctObj || !$smacctObj->getNumber("id") || ($smacctObj->getNumber("id") <= 0)) {
                    $_SESSION["is_arcalogin"] = false;
                    sess_logoutSM();
                } else {
                    if ($smacctObj->getString("username") == ARCALOGIN_USERNAME) {
                        $_SESSION["is_arcalogin"] = true;
                    }
                }
            }
        }
        if (($_COOKIE["automatic_login_sitemgr"] == "true") && empty($_SESSION[SM_LOGGEDIN]))
            sess_registerSMInSession($_COOKIE["username_sitemgr"]);
    } else {
        $_SESSION["is_arcalogin"] = false;
        header("Location: " . SM_LOGIN_PAGE . "?destiny=" . $_SERVER["PHP_SELF"] . "&query=" . $_SERVER["QUERY_STRING"]);
        exit;
    }

    if (!DEMO_DEV_MODE && !DEMO_LIVE_MODE) {
        setting_get("sitemgr_first_login", $sitemgr_first_login);
        if ($sitemgr_first_login == "yes") {
            if ((string_strpos($_SERVER['PHP_SELF'], "/setlogin.php") === false) && (string_strpos($_SERVER['PHP_SELF'], "/logout.php") === false)) {
                $smusername = "";
                if ($_SESSION[SESS_SM_ID]) {
                    $smacctObj = db_getFromDB("smaccount", "id", db_formatNumber($_SESSION[SESS_SM_ID]));
                    $smusername = $smacctObj->getString("username");
                }
                if ($smusername != ARCALOGIN_USERNAME) {
                    header("Location: " . DEFAULT_URL . "/" . SITEMGR_ALIAS . "/setlogin.php?destiny=" . $_SERVER["PHP_SELF"] . "&query=" . $_SERVER["QUERY_STRING"]);
                    exit;
                }
            }
        }
    }

    todo_validatePage();
}

# ----------------------------------------------------------------------------------------------------
# *COMON
# ----------------------------------------------------------------------------------------------------

function sess_generateSessIdString() {
    $sid = time() * rand(1, 10000);
    $sid = md5($sid);
    return $sid;
}

function sess_getAccountIdFromSession() {
    session_start();

    //  var_dump($_SESSION[SESS_ACCOUNT_ID]);
    return $_SESSION[SESS_ACCOUNT_ID];
}

function sess_getSMIdFromSession() {
    return $_SESSION[SESS_SM_ID];
}

function sess_isAccountLogged($check_folder = false) {
    if ($check_folder) {
        if ($_SESSION[SESS_ACCOUNT_ID] && (string_strpos($_SERVER["PHP_SELF"], "/" . MEMBERS_ALIAS . "") !== false)) {
            return true;
        } else {
            return false;
        }
    } elseif ($_SESSION[SESS_ACCOUNT_ID]) {
        return true;
    } else {
        return false;
    }
}

function sess_isSitemgrLogged($check_folder = false) {
    if ($check_folder) {
        if ($_SESSION[SM_LOGGEDIN] && (string_strpos($_SERVER["PHP_SELF"], "/" . SITEMGR_ALIAS . "") !== false)) {
            return true;
        } else {
            return false;
        }
    } elseif ($_SESSION[SM_LOGGEDIN]) {
        return true;
    } else {
        return false;
    }
}

//-----------------------------------------
function sess_validateSessionFront() {
    global $_COOKIE;

    if (!isset($_SESSION)) {
        session_start();
    }
   
    if ($_COOKIE["automatic_login_members"] == "true") {       
       
        if ($_COOKIE["complementary_info_members"]) {

            // $db = db_getDBObject(DEFAULT_DB, true);
            $main = DBConnection::getInstance()->getMain();
            DBQuery::execute(function() use($main) { 
                $sql = $main->prepare("SELECT * FROM Account WHERE username = :username AND complementary_info = :info");
                $sql->bindParam(':username', $_COOKIE["username_members"]);
                $sql->bindParam(':info', $_COOKIE["complementary_info_members"]);
                $sql->execute();

                $row = $sql->fetch(\PDO::FETCH_ASSOC);
                
                $row_count = $sql->rowCount();
                if ($row_count == 0) {
                    setcookie("automatic_login_members", "false");
                    setcookie("username_members", "");

                    header("Location: " . DEFAULT_URL);
                    exit;
                }
            });
        } else {
            setcookie("automatic_login_members", "false");
            setcookie("username_members", "");

            header("Location: " . DEFAULT_URL);
            exit;
        }
    }

    if (!empty($_SESSION[SESS_ACCOUNT_ID]) || ($_COOKIE["automatic_login_members"] == "true")) {
        if (!empty($_SESSION[SESS_ACCOUNT_ID])) {
            $acctObj = db_getFromDB("account", "id", db_formatNumber($_SESSION[SESS_ACCOUNT_ID]));
            if (!$acctObj || !$acctObj->getNumber("id") || ($acctObj->getNumber("id") <= 0))
                sess_logoutAccount();
        }
        if (($_COOKIE["automatic_login_members"] == "true") && empty($_SESSION[SESS_ACCOUNT_ID]))
            sess_registerAccountInSession($_COOKIE["username_members"]);
    }
}

function sess_logoutAccountFront($url = "") {

    if (!isset($_SESSION)) {
        session_start();
    }
    session_unset();
    setcookie(session_name(), '', (time() - 2592000), '/', '', 0);
    setcookie("automatic_login_members", "false", time() + 60 * 60 * 24 * 30, "" . EDIRECTORY_FOLDER . "/");
    setcookie("complementary_info_members", "", 0, "" . EDIRECTORY_FOLDER . "/");

    $host = string_strtoupper(str_replace("www.", "", $_SERVER["HTTP_HOST"]));

    setcookie($host . "_DOMAIN_ID_MEMBERS", "", time() + 60 * 60 * 24 * 30, "" . EDIRECTORY_FOLDER . "/");
    setcookie($host . "_DOMAIN_ID", "", time() + 60 * 60 * 24 * 30, "" . EDIRECTORY_FOLDER . "/");

    session_destroy();

    if ($url) {
        header("Location: " . $url);
        exit;
    } else {
        header("Location: " . DEFAULT_URL . "/");
        exit;
    }
}

function sess_validateSessionItens($module, $type, $tbshow = true, $ref = "", $item_id = 0) {

    setting_social_network_get($module . "_" . $type, $status);

    if ($type == "print") {
        if ($status == "yes") {
            if (sess_getAccountIdFromSession()) {
                return false;
            } else {
                return true;
            }
        } else {
            return false;
        }
    }

    if (is_numeric($ref) && $ref == 0) {
        $status = "yes";
    }

    if ($status == "yes") {

        global $_COOKIE;

        if (!isset($_SESSION)) {
            session_start();
        }

        if (!empty($_SESSION[SESS_ACCOUNT_ID]) || ($_COOKIE["automatic_login_members"] == "true")) {
            if (!empty($_SESSION[SESS_ACCOUNT_ID])) {

                if ($_SESSION["check_member_logged"] != "checked") {
                    $acctObj = db_getFromDB("account", "id", db_formatNumber($_SESSION[SESS_ACCOUNT_ID]));

                    if ($acctObj && $acctObj->getNumber("id") && ($acctObj->getNumber("id") > 0)) {
                        $_SESSION["check_member_logged"] = "checked";
                    }
                    if (!$acctObj || !$acctObj->getNumber("id") || ($acctObj->getNumber("id") <= 0))
                        sess_logoutAccount();
                }
            }
            if (($_COOKIE["automatic_login_members"] == "true") && empty($_SESSION[SESS_ACCOUNT_ID]))
                sess_registerAccountInSession($_COOKIE["username_members"]);
            if ($tbshow == true) {
                return true;
            } else {
                return $ref;
            }
        } else {

            if ($item_id && $type == "rate" || $type == "redeem") {
                $replaceAmp = false;
                $destiny = str_replace("&", "&amp;", $_SERVER["REQUEST_URI"]) . "&amp;act=$type&amp;type=$module&amp;" . $type . "_item=$item_id";
            } else if ($type == "see_profile") {
                $replaceAmp = false;
                $destiny = $_SERVER["PHP_SELF"] . "?" . $_SERVER["QUERY_STRING"] . "&amp;act=$type&amp;type=$module";
            } else {
                $replaceAmp = true;
                $destiny = $_SERVER["PHP_SELF"] . "?" . $_SERVER["QUERY_STRING"];
            }

            if ($tbshow == true) {
                $destiny = str_replace("&amp;", "&", $destiny);
                ?>
                <a rel="nofollow" href="<?= DEFAULT_URL . "/popup/popup.php?pop_type=profile_login&" ?>destiny=<?= $destiny; ?>&auto=true" id="login_window" class="fancy_window_iframe_modal" style="display:none"></a>

                <script type="text/javascript">
                    $("a.fancy_window_iframe_modal").fancybox({
                    modal                   : true,
                            type                    : 'iframe',
                <? if (THEME_FLAT_FANCYBOX) { ?>

                        padding                 : 0,
                                margin                  : 0,
                                closeBtn                : false,
                                maxWidth                : 475

                <? } else { ?>

                        maxWidth                : 600

                <? } ?>
                    });
                            $(document).ready(function() {
                    $("#login_window").trigger('click');
                    });
                </script>
                <?
                return false;
            } else {
                if ($replaceAmp) {
                    $destiny = str_replace("&", "&amp;", $destiny);
                }
                return DEFAULT_URL . "/popup/popup.php?pop_type=profile_login&amp;destiny=" . $destiny;
            }
        }
    } else {

        if ($tbshow == true) {
            return true;
        } else {
            return $ref;
        }
    }
}
?>
