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
	# * FILE: /controller/deal/detail.php
	# ----------------------------------------------------------------------------------------------------

    ##################################################
	# PROMOTION
	##################################################
	if (!empty($aux_array_url[$searchPos_2])) {
        $aux_friendlyURL = $aux_array_url[$searchPos_2];
        $deal_url =  $aux_friendlyURL;
		$browsebyitem = true;

		$db = db_getDBObject();
		$sql = "SELECT Promotion.id as id FROM Promotion WHERE Promotion.friendly_url = ".db_formatString($deal_url)." LIMIT 1";
		$result = $db->query($sql);
		$aux = mysql_fetch_assoc($result);
		$_GET["id"] = $aux["id"];
		$_GET["item_id"] = $aux["id"];
		if (!$_GET["id"]) $failure = true;
	}

    # ----------------------------------------------------------------------------------------------------
	# VALIDATION
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/includes/code/validate_querystring.php");
	include(EDIRECTORY_ROOT."/includes/code/validate_frontrequest.php");
    
    # ----------------------------------------------------------------------------------------------------
	# PROMOTION
	# ----------------------------------------------------------------------------------------------------
    if (($_GET["id"]) || ($_POST["id"])) {
        $id = $_GET["id"] ? $_GET["id"] : $_POST["id"];
        $promotion = new Promotion($id);
        $listingObj = new Listing($promotion->getNumber("listing_id"));
        $levelObj = new ListingLevel(true);

		unset($promotionMsg);
        if ((!$promotion->getNumber("id")) || ($promotion->getNumber("id") <= 0)) {
			$promotionMsg = system_showText(LANG_MSG_NOTFOUND);
		} elseif ((!validate_date_deal($promotion->getDate("start_date"), $promotion->getDate("end_date"))) || (!validate_period_deal($promotion->getNumber("visibility_start"), $promotion->getNumber("visibility_end")))) {
			$promotionMsg = system_showText(LANG_MSG_NOTAVAILABLE);
		} elseif (!$listingObj->getNumber("id") || $listingObj->getNumber("id") <= 0 || $listingObj->getString("status") != "A" || $levelObj->getHasPromotion($listingObj->getNumber("level")) != "y") {
			$promotionMsg = system_showText(LANG_MSG_NOTAVAILABLE);
		} else {
			report_newRecord("promotion", $id, PROMOTION_REPORT_DETAIL_VIEW);
			$promotion->setNumberViews($id);
		}
    } else {
		header("Location: ".PROMOTION_DEFAULT_URL."/");
		exit;
	}

	# ----------------------------------------------------------------------------------------------------
	# REVIEWS
	# ----------------------------------------------------------------------------------------------------
	if ($id)  $sql_where[] = " item_type = 'promotion' AND item_id = ".db_formatNumber($id)." ";
	$sql_where[] = " review IS NOT NULL AND review != '' ";
	$sql_where[] = " approved = '1' ";
	if ($sql_where) $sqlwhere .= " ".implode(" AND ", $sql_where)." ";
	$pageObj  = new pageBrowsing("Review", $screen, 3, "`like` DESC, added DESC", "", "", $sqlwhere);
	$reviewsArr = $pageObj->retrievePage("object");

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	if (($listingObj->getNumber("id")) && ($listingObj->getNumber("id") > 0)) {
		$listCategs = $listingObj->getCategories(false, false, false, true, true);
		if ($listCategs) {
			foreach ($listCategs as $listCateg) {
				$category_id[] = $listCateg->getNumber("id");
			}
		}
	}
    $_POST["category_id"] = $category_id;
?>