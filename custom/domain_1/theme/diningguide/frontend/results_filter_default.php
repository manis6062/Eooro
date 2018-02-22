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
	# * FILE: /theme/diningguide/frontend/results_filter_default.php
	# ----------------------------------------------------------------------------------------------------

    if ($aux_module_items && !$hideResults && !$blogHome) { ?>

        <div class="results-per-page">
            <div class="selectpicker numberperpage">
                <form class="form" method="post" action="<?=DEFAULT_URL.str_replace("&", "&amp;", $_SERVER["REQUEST_URI"])?>">
                    <select class="select" name="results_per_page" id="results_per_page" style="display:none;">
                        <option value="10" <?=($aux_items_per_page == 10 ? "selected=\"selected\"" : "")?>>10 <?=system_showText(LANG_PAGING_PER_PAGE);?></option>
                        <option value="20" <?=($aux_items_per_page == 20 ? "selected=\"selected\"" : "")?>>20 <?=system_showText(LANG_PAGING_PER_PAGE);?></option>
                        <option value="30" <?=($aux_items_per_page == 30 ? "selected=\"selected\"" : "")?>>30 <?=system_showText(LANG_PAGING_PER_PAGE);?></option>
                        <option value="40" <?=($aux_items_per_page == 40 ? "selected=\"selected\"" : "")?>>40 <?=system_showText(LANG_PAGING_PER_PAGE);?></option>
                    </select>
                </form>
            </div>
        </div>

        <div class="filter-order">
            <div class="selectpicker ">
                <?=$orderbyDropDown?>
            </div>
        </div>

    <? } ?>