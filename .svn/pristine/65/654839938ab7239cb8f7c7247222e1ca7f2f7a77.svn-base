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
	# * FILE: /mobile/search.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	if (string_strpos($_SERVER["PHP_SELF"], "/".LISTING_FEATURE_FOLDER) !== false) {
		$formAction = "listingresults.php";
	} elseif (string_strpos($_SERVER["PHP_SELF"], "/".EVENT_FEATURE_FOLDER) !== false) {
		$formAction = "eventresults.php";
	} elseif (string_strpos($_SERVER["PHP_SELF"], "/".CLASSIFIED_FEATURE_FOLDER) !== false) {
		$formAction = "classifiedresults.php";
	} elseif (string_strpos($_SERVER["PHP_SELF"], "/".ARTICLE_FEATURE_FOLDER) !== false) {
		$formAction = "articleresults.php";
    } elseif (string_strpos($_SERVER["PHP_SELF"], "/".PROMOTION_FEATURE_FOLDER) !== false) {
		$formAction = "dealresults.php";
	} elseif (string_strpos($_SERVER["PHP_SELF"], "/".BLOG_FEATURE_FOLDER) !== false) {
		$formAction = "blogresults.php";
	} else {
		$formAction = "listingresults.php";
	}
?>
	<div class="container">
		<form name="search" method="get" action="<?=MOBILE_DEFAULT_URL?>/<?=$formAction?>" class="navbar-search pull-right">
			<input type="search" class="search-query span12" id="keyword" name="keyword" placeholder="<?=system_showText(LANG_LABEL_SEARCHKEYWORD);?>" />
		</form>
	</div>