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
	# * FILE: /mobile/paging.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

    # ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	foreach ($_GET as $key=>$value) {
		$$key = str_replace("\\", "", $value);
		if ($key != "screen") $querystringMobile[] = $key."=".$$key;
	}
	if ($querystringMobile) {
		$query_string_mobile = implode("&", $querystringMobile);
	}

	if (($pos = string_strrpos($_SERVER["PHP_SELF"], "/")) !== false) {
		$selfpage = string_substr($_SERVER["PHP_SELF"], ($pos+1));
	} else {
		$selfpage = $_SERVER["PHP_SELF"];
	}

	if ($item_total_amount > MAX_ITEM_PER_PAGE) { ?>
        <ul class="pager">
            <? if ($screen > 1) { ?>
                <li>
                    <a href="<?=MOBILE_DEFAULT_URL?>/<?=$selfpage?>?<?=(($query_string_mobile) ? ($query_string_mobile."&") : (""))?>screen=<?=($screen-1)?>">&laquo; <?=system_showText(LANG_PAGING_PREVIOUSPAGEMOBILE);?></a>
                </li>
            <? }
            
			if (($screen*MAX_ITEM_PER_PAGE) < $item_total_amount) { ?>
                <li>
                    <a href="<?=MOBILE_DEFAULT_URL?>/<?=$selfpage?>?<?=(($query_string_mobile) ? ($query_string_mobile."&") : (""))?>screen=<?=($screen+1)?>"><?=system_showText(LANG_PAGING_NEXTPAGEMOBILE);?> &raquo;</a>
                </li>
            <? } ?>
        </ul>
    <? } ?>