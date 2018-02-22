#!/usr/bin/php -q
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
	# * FILE: /cron/populate_dashboard.php
	# ----------------------------------------------------------------------------------------------------

	##################################################
	# THIS SCRIPT IS ONLY NECESSARY TO POPULATE THE DASHBOARD AND TO BE APPROVED TABLES
	# WHEN SOME ITEM IS INSERTED/DELETED OUT OF EDIRECTORY PROCCESS.
	# IF IT HAPPENED, RUN THIS SCRIPT ONLY ONE TIME. TO RUN THIS
	# SCRIPT, REMOVE THE EXIT COMMAND BELOW.
	##################################################

	##################################################

	////////////////////////////////////////////////////////////////////////////////////////////////////
	ini_set("html_errors", FALSE);
	////////////////////////////////////////////////////////////////////////////////////////////////////

	////////////////////////////////////////////////////////////////////////////////////////////////////
	$path = "";
	$full_name = "";
	$file_name = "";
	$full_name = $_SERVER["SCRIPT_FILENAME"];
	if (strlen($full_name) > 0) {
		$osslash = ((strtoupper(substr(PHP_OS, 0, 3)) == 'WIN') ? '\\' : '/');
		$file_pos = strpos($full_name, $osslash."cron".$osslash);
		if ($file_pos !== false) {
			$file_name = substr($full_name, $file_pos);
		}
		$path = substr($full_name, 0, (strlen($file_name)*(-1)));
	}
	if (strlen($path) == 0) $path = "..";
	define("EDIRECTORY_ROOT", $path);
	define("BIN_PATH", EDIRECTORY_ROOT."/bin");
	////////////////////////////////////////////////////////////////////////////////////////////////////

	////////////////////////////////////////////////////////////////////////////////////////////////////
	$_inCron = true;
	include_once(EDIRECTORY_ROOT."/conf/config.inc.php");
	////////////////////////////////////////////////////////////////////////////////////////////////////

	////////////////////////////////////////////////////////////////////////////////////////////////////
	function getmicrotime() {
		list($usec, $sec) = explode(" ", microtime());
		return ((float)$usec + (float)$sec);
	}
	$time_start = getmicrotime();
	////////////////////////////////////////////////////////////////////////////////////////////////////

	////////////////////////////////////////////////////////////////////////////////////////////////////
	$host = _DIRECTORYDB_HOST;
	$db   = _DIRECTORYDB_NAME;
	$user = _DIRECTORYDB_USER;
	$pass = _DIRECTORYDB_PASS;
	////////////////////////////////////////////////////////////////////////////////////////////////////

	////////////////////////////////////////////////////////////////////////////////////////////////////
	$link = mysql_connect($host, $user, $pass);
	mysql_query("SET NAMES 'utf8'", $link);
	mysql_query('SET character_set_connection=utf8', $link);
	mysql_query('SET character_set_client=utf8', $link);
	mysql_query('SET character_set_results=utf8', $link);
	mysql_select_db($db);
	////////////////////////////////////////////////////////////////////////////////////////////////////

	////////////////////////////////////////////////////////////////////////////////////////////////////

	$sqlDomain = "	SELECT
						`id`, `database_host`, `database_port`, `database_username`, `database_password`, `database_name`, `url`
					FROM `Domain` WHERE `status` = 'A'";			

	$resDomain = mysql_query($sqlDomain, $link);
    
    $sql = "TRUNCATE TABLE `To_Approved`";
    mysql_query($sql, $link);
    
    //get one active domain, just to define constant SELECTED_DOMAIN_ID correctly
    $sqlDomainAux = "SELECT `id` FROM `Domain` WHERE `status` = 'A' LIMIT 1";
    $resDomainAux = mysql_query($sqlDomainAux, $link);
    $rowDomainAux = mysql_fetch_assoc($resDomainAux);
    $_inCron = false;
    
    if ($rowDomainAux["id"]) {
        define("SELECTED_DOMAIN_ID", $rowDomainAux["id"]);
        include_once(EDIRECTORY_ROOT."/conf/loadconfig.inc.php");
    } else {
        exit;
    }

	while ($rowDomain = mysql_fetch_assoc($resDomain)){


	////////////////////////////////////////////////////////////////////////////////////////////////////
		$domainHost = $rowDomain["database_host"].($rowDomain["database_port"]? ":".$rowDomain["database_port"]: "");
		$domainUser = $rowDomain["database_username"];
		$domainPass = $rowDomain["database_password"];
		$domainDBName = $rowDomain["database_name"];
		$domainURL = $rowDomain["url"];

		$linkDomain = mysql_connect($domainHost, $domainUser, $domainPass, true);
		mysql_query("SET NAMES 'utf8'", $linkDomain);
		mysql_query('SET character_set_connection=utf8', $linkDomain);
		mysql_query('SET character_set_client=utf8', $linkDomain);
		mysql_query('SET character_set_results=utf8', $linkDomain);
		mysql_select_db($domainDBName);
	////////////////////////////////////////////////////////////////////////////////////////////////////


		$count_contents = 0;

		$sql = "SELECT id FROM Listing";
		$resultCount = mysql_query($sql,$linkDomain);
		$count_listing = mysql_num_rows($resultCount);

		$sql = "SELECT id FROM Event";
		$resultCount = mysql_query($sql,$linkDomain);
		$count_event = mysql_num_rows($resultCount);

		$sql = "SELECT id FROM Classified";
		$resultCount = mysql_query($sql,$linkDomain);
		$count_classified = mysql_num_rows($resultCount);

		$sql = "SELECT id FROM Banner";
		$resultCount = mysql_query($sql,$linkDomain);
		$count_banner = mysql_num_rows($resultCount);

		$sql = "SELECT id FROM Article";
		$resultCount = mysql_query($sql,$linkDomain);
		$count_article = mysql_num_rows($resultCount);

		$count_contents = $count_event + $count_classified + $count_banner + $count_article;

		$sql = "SELECT SUM(transaction_amount) AS total FROM Payment_Log WHERE transaction_status in ('Completed', 'Approved', 'Accepted', 'Success', 'SIMPLEPAYSUCCESS', 'Y')";
		$resultRevenue = mysql_query($sql,$linkDomain);
		if (mysql_num_rows($resultRevenue) > 0) {
			$rowRevenue = mysql_fetch_assoc($resultRevenue);
			$total_payment = $rowRevenue['total'];
		}

		$sql = "SELECT SUM(amount) AS total FROM Invoice WHERE status = 'R'";
		$resultRevenue = mysql_query($sql,$linkDomain);
		if (mysql_num_rows($resultRevenue) > 0) {
			$rowRevenue = mysql_fetch_assoc($resultRevenue);
			$total_invoice = $rowRevenue['total'];
		}
		$total = $total_payment + $total_invoice;

		$sql = "UPDATE Dashboard SET number_listings = $count_listing, number_content = $count_contents, revenue = $total WHERE domain_id = ".$rowDomain["id"];
		mysql_query($sql,$link);

		$sql = "SELECT id, title, entered FROM Listing WHERE status = 'P'";
		$result2 = mysql_query($sql,$linkDomain);
		while ($row2 = mysql_fetch_assoc($result2)){
			$sql = "INSERT INTO To_Approved (domain_id, item_id, item_type, item_title, date) VALUES (".$rowDomain["id"].",".$row2["id"].",'listing',".db_formatString($row2["title"]).",'".$row2["entered"]."')";
			mysql_query($sql,$link);
		}

		$sql = "SELECT id, title, entered FROM Event WHERE status = 'P'";
		$result2 = mysql_query($sql,$linkDomain);
		while ($row2 = mysql_fetch_assoc($result2)){
			$sql = "INSERT INTO To_Approved (domain_id, item_id, item_type, item_title, date) VALUES (".$rowDomain["id"].",".$row2["id"].",'event',".db_formatString($row2["title"]).",'".$row2["entered"]."')";
			mysql_query($sql,$link);
		}

		$sql = "SELECT id, title, entered FROM Classified WHERE status = 'P'";
		$result2 = mysql_query($sql,$linkDomain);
		while ($row2 = mysql_fetch_assoc($result2)){
			$sql = "INSERT INTO To_Approved (domain_id, item_id, item_type, item_title, date) VALUES (".$rowDomain["id"].",".$row2["id"].",'classified',".db_formatString($row2["title"]).",'".$row2["entered"]."')";
			mysql_query($sql,$link);
		}

		$sql = "SELECT id, title, entered FROM Article WHERE status = 'P'";
		$result2 = mysql_query($sql,$linkDomain);
		while ($row2 = mysql_fetch_assoc($result2)){
			$sql = "INSERT INTO To_Approved (domain_id, item_id, item_type, item_title, date) VALUES (".$rowDomain["id"].",".$row2["id"].",'article',".db_formatString($row2["title"]).",'".$row2["entered"]."')";
			mysql_query($sql,$link);
		}

    	$sql = "SELECT id, caption, entered FROM Banner WHERE status = 'P'";

		$result2 = mysql_query($sql,$linkDomain);
		while ($row2 = mysql_fetch_assoc($result2)){
			$sql = "INSERT INTO To_Approved (domain_id, item_id, item_type, item_title, date) VALUES (".$rowDomain["id"].",".$row2["id"].",'banner',".db_formatString($row2["caption"]).",'".$row2["entered"]."')";
			mysql_query($sql,$link);
		}

		$sql = "SELECT id, item_id, review_title, rating, reviewer_name, review, response, added, approved FROM Review WHERE (approved = 0 OR (responseapproved = 0 AND response != '')) AND item_type = 'listing' AND status = 'A'";
		$result2 = mysql_query($sql,$linkDomain);
		while ($row2 = mysql_fetch_assoc($result2)){

			$sql = "SELECT title FROM Listing WHERE id = ".$row2["item_id"];
			$result3 = mysql_query($sql,$linkDomain);
			$row3 = mysql_fetch_assoc($result3);

            if ($row2["approved"] == 1) {
                $reply_id = 1;
                $row2["review"] = $row2["response"];
            } else {
                $reply_id = 0;
            }

			$sql = "INSERT INTO To_Approved (domain_id, item_id, item_type, item_title, content, assoc_item, rate, reviewer_name, review_content, date, reply_id) VALUES (".$rowDomain["id"].",".$row2["id"].",'review_listing',".db_formatString($row3["title"]).",".db_formatString($row2["review_title"]).",".$row2["item_id"].",".$row2["rating"].",".db_formatString($row2["reviewer_name"]).",".db_formatString($row2["review"]).",'".$row2["added"]."', $reply_id)";
            mysql_query($sql,$link);
		}

		$sql = "SELECT id, item_id, review_title, rating, reviewer_name, review, response, added, approved FROM Review WHERE (approved = 0 OR (responseapproved = 0 AND response != '')) AND item_type = 'article' AND status = 'A'";
		$result2 = mysql_query($sql,$linkDomain);
		while ($row2 = mysql_fetch_assoc($result2)){
			$sql = "SELECT title FROM Article WHERE id = ".$row2["item_id"];
			$result3 = mysql_query($sql,$linkDomain);
			$row3 = mysql_fetch_assoc($result3);
            
            if ($row2["approved"] == 1) {
                $reply_id = 1;
                $row2["review"] = $row2["response"];
            } else {
                $reply_id = 0;
            }

			$sql = "INSERT INTO To_Approved (domain_id, item_id, item_type, item_title, content, assoc_item, rate, reviewer_name, review_content, date, reply_id) VALUES (".$rowDomain["id"].",".$row2["id"].",'review_article',".db_formatString($row3["title"]).",".db_formatString($row2["review_title"]).",".$row2["item_id"].",".$row2["rating"].",".db_formatString($row2["reviewer_name"]).",".db_formatString($row2["review"]).",'".$row2["added"]."', $reply_id)";
			mysql_query($sql,$link);
		}
        
        $sql = "SELECT id, item_id, review_title, rating, reviewer_name, review, response, added, approved FROM Review WHERE (approved = 0 OR (responseapproved = 0 AND response != '')) AND item_type = 'promotion' AND status = 'A'";
		$result2 = mysql_query($sql,$linkDomain);
		while ($row2 = mysql_fetch_assoc($result2)){
			$sql = "SELECT name FROM Promotion WHERE id = ".$row2["item_id"];
			$result3 = mysql_query($sql,$linkDomain);
			$row3 = mysql_fetch_assoc($result3);
            
            if ($row2["approved"] == 1) {
                $reply_id = 1;
                $row2["review"] = $row2["response"];
            } else {
                $reply_id = 0;
            }

			$sql = "INSERT INTO To_Approved (domain_id, item_id, item_type, item_title, content, assoc_item, rate, reviewer_name, review_content, date, reply_id) VALUES (".$rowDomain["id"].",".$row2["id"].",'review_promotion',".db_formatString($row3["name"]).",".db_formatString($row2["review_title"]).",".$row2["item_id"].",".$row2["rating"].",".db_formatString($row2["reviewer_name"]).",".db_formatString($row2["review"]).",'".$row2["added"]."', $reply_id)";
			mysql_query($sql,$link);
		}

		$sql = "SELECT id, post_id, description, reply_id, added FROM Comments WHERE approved = 0";
		$result2 = mysql_query($sql,$linkDomain);
		while ($row2 = mysql_fetch_assoc($result2)){

			$sql = "SELECT title FROM Post WHERE id = ".$row2["post_id"];
			$result3 = mysql_query($sql,$linkDomain);
			$row3 = mysql_fetch_assoc($result3);

			$sql = "INSERT INTO To_Approved (domain_id, item_id, item_type, item_title, content, assoc_item, rate, reply_id, date) VALUES (".$rowDomain["id"].",".$row2["id"].",'blog_comment',".db_formatString($row3["title"]).",".db_formatString($row2["description"]).",".$row2["post_id"].",0,".$row2["reply_id"].",'".$row2["added"]."')";
			mysql_query($sql,$link);
		}

	} 
	////////////////////////////////////////////////////////////////////////////////////////////////////


	////////////////////////////////////////////////////////////////////////////////////////////////////
	$time_end = getmicrotime();
	$time = $time_end - $time_start;
	print "Dashboard/To be approved updated - ".date("Y-m-d H:i:s")." - ".round($time, 2)." seconds.\n";
	////////////////////////////////////////////////////////////////////////////////////////////////////