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
                            AND CC.`type` = 'update_expired_listing_status'
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

        $sqlUpdate = "UPDATE `Control_Cron` SET `running` = 'Y', `last_run_date` = NOW() WHERE `domain_id` = ".SELECTED_DOMAIN_ID." AND `type` = 'update_expired_listing_status'";
        mysql_query($sqlUpdate, $link);

    $messageLog = "Starting cron";
    log_addCronRecord($link, "update_expired_listing_status", $messageLog, false, $cron_log_id);	
    } else {
            exit;//and if the result is greater than 0, it proceeds further, else stops cron
    }   

        $_inCron = false;
        include_once(EDIRECTORY_ROOT."/conf/loadconfig.inc.php"); // here domain1 is being connected thus below queries are possible
        ////////////////////////////////////////////////////////////////////////////////////////////////////
        $_inCron = true;

#################################################################################
        $date = date("Y-m-d");
        $sql = "SELECT id FROM Listing WHERE custom_text3!= '' and custom_text3 < '$date' "; 
        $result = mysql_query($sql);

        while ($rows = mysql_fetch_assoc($result)) {
                $elements[] = $rows;
        }

        $queryBuild = "";
        
        foreach ($elements as $key => $value) {
            $id  = $value['id'];
            if($elements[$key+1])
                $queryBuild .= $id.", ";
            else 
                $queryBuild .= $id;

    }  

    $sql = "UPDATE Listing SET status = 'E' WHERE id in(" . $queryBuild .")";
    mysql_query($sql);
    $sql = "UPDATE Listing_Summary SET status = 'E' WHERE id in(" . $queryBuild .")";
    mysql_query($sql);
    //////////////////////////////////////////////////////////////////////////////////

    $sqlUpdate = "UPDATE `Control_Cron` SET `running` = 'N' WHERE `domain_id` = ".SELECTED_DOMAIN_ID." AND `type` = 'update_expired_listing_status'";
    mysql_query($sqlUpdate, $link);

    ////////////////////////////////////////////////////////////////////////////////////////////////////
    $time_end = getmicrotime();
    $time = $time_end - $time_start;
    print "update_expired_listing_status Generator on Domain ".SELECTED_DOMAIN_ID." - ".date("Y-m-d H:i:s")." - ".round($time, 2)." seconds.\n";
    if (!setting_set("last_datetime_sitemap", date("Y-m-d H:i:s"))) {
        if (!setting_new("last_datetime_sitemap", date("Y-m-d H:i:s"))) {
            print "last_datetime_sitemap error - Domain - ".SELECTED_DOMAIN_ID." - ".date("Y-m-d H:i:s")."\n";
            $messageLog = "Database error - LINE: ".__LINE__;
            log_addCronRecord($link, "sitemap", $messageLog, true, $cron_log_id);
        }
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////////

    $messageLog = "Cron finished";
    log_addCronRecord($link, "update_expired_listing_status", $messageLog, true, $cron_log_id, true, round($time, 2));

###############################################################################

?>