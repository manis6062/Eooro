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
	# * FILE: /theme/contractors/frontend/results_pagination.php
	# ----------------------------------------------------------------------------------------------------
 
    if ($aux_module_items && !$hideResults && !$blogHome && ($pagination_bottom || $generalPagination)) { ?>

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
        
    <? }
    
    if ((($array_pages_code["total"] > $aux_items_per_page)) && !$hideResults && ($pagination_bottom || $generalPagination)) { ?>

        <div class="pagination">
            
            <div class="goto">
                
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
   

    if ($category_id && $aux_CategoryObj && !$pagination_bottom) {
        
        if ($aux_CategoryObj == "PromotionCategory") {
            $aux_CategoryObj = "ListingCategory";
        }

        $catObj = new $aux_CategoryObj($category_id);
        $categContent = $catObj->getString("content", false);

        if ($categContent) { ?>

            <div class="content-custom">
                <?=$catObj->getString("content", false);?>
            </div>

        <? }
    }
?>