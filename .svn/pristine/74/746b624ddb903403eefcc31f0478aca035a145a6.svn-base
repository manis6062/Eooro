<?php

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
	# * FILE: /controller/listing/detail.php
	# ----------------------------------------------------------------------------------------------------

    ##################################################
    # LISTING
    ##################################################
    if (!empty($aux_array_url[$searchPos_2])) {
        $browsebyitem = true;
        $listing_url =  $aux_array_url[$searchPos_2];
        $sql = "SELECT Listing.id as id FROM Listing WHERE Listing.friendly_url = " . db_formatString($listing_url) . " LIMIT 1";
        $result = $dbObj->query($sql);
        $aux = mysql_fetch_assoc($result);
        $_GET["id"] = $aux["id"];
        $_GET["listing_id"] = $aux["id"];
        if (!$_GET["id"]) {
            $failure = true;
        }
    }

    # ----------------------------------------------------------------------------------------------------
	# VALIDATION
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/includes/code/validate_querystring.php");
	include(EDIRECTORY_ROOT."/includes/code/validate_frontrequest.php");

	include(EDIRECTORY_ROOT."/includes/code/listingcontact.php");

	# ----------------------------------------------------------------------------------------------------
	# LISTING
	# ----------------------------------------------------------------------------------------------------
	if (($_GET["id"]) || ($_POST["id"])) { 
		$id = $_GET["id"] ? $_GET["id"] : $_POST["id"];
		$listing = new Listing($id);
		$levelObj = new ListingLevel(true);
		unset($listingMsg);
		if ((!$listing->getNumber("id")) || ($listing->getNumber("id") <= 0)) {
			$listingMsg = system_showText(LANG_MSG_NOTFOUND);
		} elseif ($listing->getString("status") != "A" && $listing->getString("status") != "P" && $listing->getString("status") != "E") {
			$listingMsg = system_showText(LANG_MSG_NOTAVAILABLE);
		} elseif ($levelObj->getDetail($listing->getNumber("level")) != "y" && $levelObj->getActive($listing->getNumber("level")) == 'y') {
			$listingMsg = system_showText(LANG_MSG_NOTAVAILABLE);
		} else {
			report_newRecord("listing", $id, LISTING_REPORT_DETAIL_VIEW);
			$listing->setNumberViews($id);
		}			
	} else {
            
            header("Location: ".DEFAULT_URL."/error_page/index.php");
		exit;
	}

	# ----------------------------------------------------------------------------------------------------
	# REVIEWS
	# ----------------------------------------------------------------------------------------------------
	if ($id)  $sql_where[] = "Review.item_type = 'listing' AND Review.item_id = ".db_formatNumber($id)." ";
	$sql_where[] = " Review.review IS NOT NULL AND Review.review != '' ";
	$sql_where[] = " Review.approved = '1'";
        $sql_where[] = " Review.is_deleted='0'";
        $sql_where[] = " Account.active = 'y' ";
        $sql_where[] = " Review.status = 'A' ";
        $sql_where[] = " ifnull(case_status, '') != 'A'";
	if ($sql_where) $sqlwhere .= " ".implode(" AND ", $sql_where)." ";

	$Main = db_getDBObject(DEFAULT_DB, true);
       
        $Domain = db_getDBObject(DEFAULT_DB, FALSE); 
        $domain_arr = (array) $Domain;
	$array = (array) $Main;
        
        $pageObj  = new pageBrowsing("Review| LEFT OUTER JOIN {$array['db_name']}.Account on Review.member_id = Account.id LEFT OUTER JOIN {$domain_arr['db_name']}.Opened_Cases oc on Review.id = oc.review_id", $screen, THEME_MAX_REVIEWS, "added DESC", "", "", $sqlwhere);
	$reviewsArr = $pageObj->retrievePage("object");
       $total_items = $pageObj->getNumber('record_amount');
	# ----------------------------------------------------------------------------------------------------
	# CHECK INS
	// # ----------------------------------------------------------------------------------------------------
	if ($id)  $sql_where2[] = " item_id = ".db_formatNumber($id)." ";
	$sql_where2[] = " quick_tip IS NOT NULL AND quick_tip != '' ";
	if ($sql_where2) $sqlwhere2 .= " ".implode(" AND ", $sql_where2)." ";
	$pageObj  = new pageBrowsing("CheckIn", $screen, 3, "added DESC", "", "", $sqlwhere2);
	$checkinsArr = $pageObj->retrievePage("object");
    
    # ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
    if (($listing->getNumber("id")) && ($listing->getNumber("id") > 0)) {
        $listCategs = $listing->getCategories(false, false, false, true, true);
        if ($listCategs) {
            foreach ($listCategs as $listCateg) {
                $category_id[] = $listCateg->getNumber("id");
            }
        }
    }
    $_POST["category_id"] = $category_id;
?>
