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
	# * FILE: /theme/diningguide/frontend/results_pagination.php
	# ----------------------------------------------------------------------------------------------------

    if (($showLetter || ($array_pages_code["total"] > $aux_items_per_page)) && !$hideResults) { ?>

        <div <?=($paginationReviews ? "" : "class=\"pagination ".($pagination_bottom == true ? "pagination-bottom" : "")." \"")?>>
            
            <? if ($showLetter && $letters_menu) { ?>
            
            <ul class="letters">
                <?=$letters_menu?>
            </ul>
            
            <? } ?>
           
            <div <?=($paginationReviews ? "" : "class=\"goto\"")?>>
                
                <? if ($array_pages_code["previous"] || $array_pages_code["first"] || $array_pages_code["pages"] || $array_pages_code["last"] || $array_pages_code["next"]) { ?>
                
                <ul class="pages">
                    <?=($array_pages_code["previous"] ? $array_pages_code["previous"] : "<li class=\"disabled\"><a href='javascript:void(0);'>&laquo;</a></li>");?>
                    <?=$array_pages_code["first"];?>
                    <?=$array_pages_code["pages"];?>
                    <?=$array_pages_code["last"];?>
                    <?=($array_pages_code["next"] ? $array_pages_code["next"] : "<li class=\"disabled\"><a href='javascript:void(0);'>&raquo;</a></li>");?>
                </ul>
                
                <? } ?>
                
            </div>
            
        </div>

    <? }

    if ($pagination_bottom && $aux_module_items && !$hideResults) {
        
        if (!$blogHome) { ?>

        <div class="results-per-page">
            
            <form class="form" method="post" action="<?=DEFAULT_URL.str_replace("&", "&amp;", $_SERVER["REQUEST_URI"])?>">
                
                <label for="results_per_page"><?=system_showText(LANG_PAGING_RESULTS_PER_PAGE);?></label>
                
                <select class="select" name="results_per_page" id="results_per_page" disabled="disabled">
                    <? if ($aux_module_per_page == "bestof") { ?>
                    <option <?=($aux_items_per_page == 5 ? "selected=\"selected\"" : "")?>>5</option>
                    <? } ?>
                    <option <?=($aux_items_per_page == 10 ? "selected=\"selected\"" : "")?>>10</option>
                    <option <?=($aux_items_per_page == 20 ? "selected=\"selected\"" : "")?>>20</option>
                    <option <?=($aux_items_per_page == 30 ? "selected=\"selected\"" : "")?>>30</option>
                    <option <?=($aux_items_per_page == 40 ? "selected=\"selected\"" : "")?>>40</option>
                </select>
                
            </form>
            
        </div>

        <? }

    } ?>