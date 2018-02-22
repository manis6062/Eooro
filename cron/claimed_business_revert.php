#!/usr/bin/php -q
<?php
chdir(dirname(__FILE__));
	
    // ini_set('display_errors', 1);
    // error_reporting(E_ERROR | E_ALL);
    ////////////////////////////////////////////////////////////////////////////////////////////////////
    #ini_set("html_errors", FALSE);
    ////////////////////////////////////////////////////////////////////////////////////////////////////

//File Path
    ////////////////////////////////////////////////////////////////////////////////////////////////////

    $path = "";
    $full_name = "";
    $file_name = "";
    $full_name = $_SERVER["SCRIPT_FILENAME"];
    if (strlen($full_name) > 0) {
        $osslash = ((strtoupper(substr(PHP_OS, 0, 3)) == 'WIN') ? '\\' : '/');
        $file_pos = strpos($full_name, $osslash."cronjobs".$osslash);
        if ($file_pos !== false) {
            $file_name = substr($full_name, $file_pos);
        }
        $path = substr($full_name, 0, (strlen($file_name)*(-1)));
    }
    if (strlen($path) == 0) $path = "..";
    define("EDIRECTORY_ROOT", $path);
    define("BIN_PATH", EDIRECTORY_ROOT."/bin");

    ////////////////////////////////////////////////////////////////////////////////////////////////////
    $_inCron = true;
    include_once(EDIRECTORY_ROOT."/conf/config.inc.php");
    include_once(EDIRECTORY_ROOT."/functions/log_funct.php");
    //////////////////////////////////////////////////////////////////////////////////////
    function getmicrotime() {
        list($usec, $sec) = explode(" ", microtime());
        return ((float)$usec + (float)$sec);
    }   
    function  send_claimed_business_revert_conf_email($listing_id/*$itemObj*/){
        $listing_pending=new ListingPending($listing_id);
//        $account=new Account($listing_pending->account_id);
        $account_profile_contact=new AccountProfileContact(SELECTED_DOMAIN_ID,$listing_pending->account_id);
        $contactObj = new Contact($listing_pending->getNumber('account_id'));
        if($emailNotificationObj = system_checkEmail(REMOVE_CLAIMED_BUSINESS)) {
            cronLogToFile("Email Template loaded");// added a new log
            setting_get("sitemgr_send_email", $sitemgr_send_email);
            setting_get("sitemgr_email", $sitemgr_email);
            $sitemgr_emails = explode(",", $sitemgr_email);
            if ($sitemgr_emails[0]) $sitemgr_email = $sitemgr_emails[0];
            $subject   = $emailNotificationObj->getString("subject");
            $body      = $emailNotificationObj->getString("body");
            
            $body = str_replace("FIRST_NAME", $account_profile_contact->first_name, $body);
            $body = str_replace("LAST_NAME", $account_profile_contact->last_name, $body);
            $body = str_replace("BUSINESS_NAME", $listing_pending->title, $body);
            
            $body      = html_entity_decode($body);
            $subject   = html_entity_decode($subject);
            system_mail($contactObj->getString("email"), $subject, $body, EDIRECTORY_TITLE." <$sitemgr_email>", $emailNotificationObj->getString("content_type"), "", $emailNotificationObj->getString("bcc"), $error, "", "", "", $listing_id, $contactObj->account_id, SYSTEM_APPROVE_REVIEW);
        }
    }
    $time_start = getmicrotime();   
    ////////////////////////////////////////////////////////////////////////////////////////////////////
    $host = _DIRECTORYDB_HOST;
    $db   = _DIRECTORYDB_NAME;
    $user = _DIRECTORYDB_USER;
    $pass = _DIRECTORYDB_PASS;

    $link = mysql_connect($host, $user, $pass);
    mysql_query("SET NAMES 'utf8'", $link);
    mysql_query('SET character_set_connection=utf8', $link);
    mysql_query('SET character_set_client=utf8', $link);
    mysql_query('SET character_set_results=utf8', $link);
    mysql_select_db($db);

    // check if current cron control exists.
    $sqlDomain = "	SELECT
                                    D.`id`
                            FROM `Domain` AS D
                            LEFT JOIN `Control_Cron` AS CC ON (CC.`domain_id` = D.`id`)
                            WHERE CC.`running` = 'N'
                            AND CC.`type` = 'claimed_business_revert'
                            AND D.`status` = 'A'
                            AND (ADDDATE(CC.`last_run_date`, INTERVAL 1 DAY) <= NOW() OR CC.`last_run_date` = '0000-00-00 00:00:00')
                            ORDER BY
                                    IF (CC.`last_run_date` IS NULL, 0, 1),
                                    CC.`last_run_date`,
                                    D.`id`
                            LIMIT 1";
    $result = mysql_query($sqlDomain);

    // write to db that the cron is running
    if (mysql_num_rows($result) > 0) {
        $row = mysql_fetch_assoc($result);
        define("SELECTED_DOMAIN_ID", $row["id"]);

        $sqlUpdate = "UPDATE `Control_Cron` SET `running` = 'Y', `last_run_date` = NOW() WHERE `domain_id` = ".SELECTED_DOMAIN_ID." AND `type` = 'claimed_business_revert'";
        mysql_query($sqlUpdate, $link);

    $messageLog = "Starting cron";
    log_addCronRecord($link, "claimed_business_revert", $messageLog, false, $cron_log_id);
    cronLogToFile("Starting cron: claimed business revert");// added a new log
    } else {
            exit;//and if the result is greater than 0, it proceeds further, else stops cron
    }   

        $_inCron = false;
        include_once(EDIRECTORY_ROOT."/conf/loadconfig.inc.php"); // here domain1 is being connected thus below queries are possible
        ////////////////////////////////////////////////////////////////////////////////////////////////////
        $_inCron = true;

    $sql = "SELECT id,account_id FROM ListingPending
                    WHERE created_date <= (CURRENT_TIMESTAMP() - interval 7 day) AND status = 'P'
                    Order BY updated DESC";

    $result= mysql_query($sql);
    while ($rows = mysql_fetch_assoc($result)) {
            $elements[] = $rows;
    }

    foreach ($elements as $key => $value) {
            $id = $value['id'];

            // send email to account email belonging to id
            send_claimed_business_revert_conf_email($id);
            
            
            //run three queries with = operator.
            $sql1 = "DELETE FROM ListingPending WHERE id = " . $id ;
            $result= mysql_query($sql1);

            $sql2 = "UPDATE Listing SET status = 'A', account_id = '0', discount_id = null, custom_text2 = ' ', custom_checkbox3 = ' ' WHERE id =" . $id ; 
            $result= mysql_query($sql2);

            $sql3 = "UPDATE Listing_Summary SET status = 'A', account_id = '0', custom_text2 = ' ', custom_checkbox3 = ' '  WHERE id =". $id ;
            $result= mysql_query($sql3);
    }
    


    // cron job completed. change state in database
    
    $sqlUpdate = "UPDATE `Control_Cron` SET `running` = 'N' WHERE `domain_id` = ".SELECTED_DOMAIN_ID." AND `type` = 'claimed_business_revert'";
    mysql_query($sqlUpdate, $link);

    ////////////////////////////////////////////////////////////////////////////////////////////////////
    $time_end = getmicrotime();
    $time = $time_end - $time_start;
    print "claimed_business_revert Generator on Domain ".SELECTED_DOMAIN_ID." - ".date("Y-m-d H:i:s")." - ".round($time, 2)." seconds.\n";
    if (!setting_set("last_datetime_sitemap", date("Y-m-d H:i:s"))) {
        if (!setting_new("last_datetime_sitemap", date("Y-m-d H:i:s"))) {
            print "last_datetime_sitemap error - Domain - ".SELECTED_DOMAIN_ID." - ".date("Y-m-d H:i:s")."\n";
            $messageLog = "Database error - LINE: ".__LINE__;
            log_addCronRecord($link, "claimed_business_revert", $messageLog, true, $cron_log_id);
            cronLogToFile( $messageLog );
        }
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////////

    $messageLog = "Cron finished";
    log_addCronRecord($link, "claimed_business_revert", $messageLog, true, $cron_log_id, true, round($time, 2));
    cronLogToFile("Cron finished: claimed business revert");// added a new log

?>
<?php 
    function cronLogToFile( $message )
    {
        $filename   = EDIRECTORY_ROOT .'/cron/cron.log';
        $handle = fopen( $filename, "a+" );
        fwrite($handle, "\n".  gmdate('Y-m-d H:i:s').": ".$message);
        fclose( $handle );
    }
?>