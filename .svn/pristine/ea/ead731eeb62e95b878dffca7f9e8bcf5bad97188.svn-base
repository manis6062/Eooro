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
	# * FILE: /mobile/searchstatistics.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	echo "<p class=\"searchResults pull-left\">";
	echo "".(($item_total_amount == 1) ? (system_showText(LANG_PAGING_FOUND)) : (system_showText(LANG_PAGING_FOUND_PLURAL)))." <span class=\"bold\">".$item_total_amount."</span> ".(($item_total_amount == 1) ? (system_showText(LANG_PAGING_RECORD)) : (system_showText(LANG_PAGING_RECORD_PLURAL)))."";
	echo "</p>";
    
    if ($item_total_amount > MAX_ITEM_PER_PAGE) {
		echo "<p class=\"searchResults pull-right\"> ".system_showText(LANG_PAGING_SHOWINGPAGE)." <span class=\"bold\">".$screen."</span> ".system_showText(LANG_PAGING_PAGEOF)." <span class=\"bold\">".ceil($item_total_amount/MAX_ITEM_PER_PAGE)."</span> ".LANG_PAGING_PAGE_PLURAL."</p>";
	}

?>