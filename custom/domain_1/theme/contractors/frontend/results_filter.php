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
	# * FILE: /theme/contractors/frontend/results_filter.php
	# ----------------------------------------------------------------------------------------------------

    if ($aux_module_items && $show_results && $aux_module_itemRSSSection) {
        $itemRSSSection = $aux_module_itemRSSSection;
        include(EDIRECTORY_ROOT."/includes/code/rss.php");
        unset($itemRSSSection);
        
        if (is_array($aux_array_rss)) { ?>
            <a id="tip_rss" title="<?=LANG_LABEL_SUBSCRIBERSS?>" class="rss-feed" target="_blank" href="<?=$aux_array_rss["link"]?>"></a>
        <? }
    }

    if ($aux_module_items && !$hideResults && !$blogHome) { ?>

        <div class="filter-order">
            <div class="selectpicker ">
                <?=$orderbyDropDown?>
            </div>
        </div>

    <? }