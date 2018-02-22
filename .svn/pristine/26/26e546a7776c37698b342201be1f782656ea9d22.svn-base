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
	# * FILE: /controller/advertise.php
	# ----------------------------------------------------------------------------------------------------

	setting_get("commenting_edir", $commenting_edir);
	setting_get("review_listing_enabled", $review_enabled);
	customtext_get("payment_tax_label", $payment_tax_label);
	setting_get("payment_tax_status", $payment_tax_status);
	setting_get("payment_tax_value", $payment_tax_value);
	
	unset($activeTab);
	if (isset($_GET["event"]) && EVENT_FEATURE == "on" && CUSTOM_EVENT_FEATURE == "on") $activeTab = "event";
	elseif (isset($_GET["banner"]) && BANNER_FEATURE == "on" && CUSTOM_BANNER_FEATURE == "on") $activeTab = "banner";
	elseif (isset($_GET["classified"]) && CLASSIFIED_FEATURE == "on" && CUSTOM_CLASSIFIED_FEATURE == "on") $activeTab = "classified";
	elseif (isset($_GET["article"]) && ARTICLE_FEATURE == "on" && CUSTOM_ARTICLE_FEATURE == "on") $activeTab = "article";
	elseif (isset($_GET["listing"])) $activeTab = "listing";
	else  $activeTab = "listing";
?>