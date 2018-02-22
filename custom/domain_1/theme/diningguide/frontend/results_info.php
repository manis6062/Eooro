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
	# * FILE: /theme/diningguide/frontend/results_info.php
	# ----------------------------------------------------------------------------------------------------

    if ($show_results) {
                
        /*
         * Prepare code for browse by category
         */
        $addSubCatDD = false;
        if ($category_id && $aux_CategoryObj && $aux_CategoryModuleURL && $aux_CategoryNumColumn) {
            
            if ($aux_CategoryObj == "PromotionCategory") {
                $aux_CategoryObj = "ListingCategory";
            }
            
            unset($catObj);
            $catObj = new $aux_CategoryObj($category_id);
            $subcategories = $catObj->retrieveAllSubCatById($category_id);
            if (is_array($subcategories)) {
                $addSubCatDD = true;
            }

            /**
            * Check url to use
            */
            if (string_strpos($_SERVER["REQUEST_URI"], "/results.php") !== false) {
                $aux_use_form = true;
            } else {
                $aux_use_form = false;
                $aux_url_category = substr($paging_url, 0, string_strpos($paging_url, "/".ALIAS_CATEGORY_URL_DIVISOR));
                $aux_url_category = $aux_url_category."/".ALIAS_CATEGORY_URL_DIVISOR."/".$catObj->getString("friendly_url");
            }

        }
        
        /*
        * Prepare $aux_array_rss to RSS 
        */
        if ($aux_module_items) {
            $itemRSSSection = $aux_module_itemRSSSection;
        }
        if ($itemRSSSection) {
           include(EDIRECTORY_ROOT."/includes/code/rss.php");
        }
        
        //Check if at least one content will be written to open div "line-top", otherwise a blank box can be shown
        $openLineTopDiv = false;
        if (
            ((is_array($aux_array_rss) && !$pagination_bottom) || $str_search) ||
            ($aux_module_items && !$hideResults) ||
            ($addSubCatDD)
            ) {
            $openLineTopDiv = true;
        }
        
        if ($openLineTopDiv) { ?>
        <div class="line-top">    
        <? }
        
        if ((is_array($aux_array_rss) && !$pagination_bottom) || $str_search) { ?>

            <div class="search-info">
                <? if (is_array($aux_array_rss) && !$pagination_bottom) { ?>
                    <a title="<?=LANG_LABEL_SUBSCRIBERSS?>" class="rss-feed" target="_blank" href="<?=$aux_array_rss["link"]?>">&nbsp;</a>
                <? }

                if ($str_search) { ?>
                    <span><?=system_showText(LANG_SEARCHRESULTS)?> <?=$str_search?></span>
                <? } ?>
            </div>

        <? }

        if ($aux_module_items && !$hideResults) { ?>

            <div class="filter-order">
                <?=$orderbyDropDown?>
            </div>

        <? }

        if ($addSubCatDD) { ?>

        <div class="filter-category">

            <? if ($aux_use_form) { ?>
                <form name="subcategory" id="subcategory" method="get" action="<?=$paging_url?>">
            <? }

                if ($_GET["where"] && $aux_use_form) { ?>
                    <input type="hidden" name="where" value="<?=$_GET["where"]?>">
                <? }

                if ($_GET["keyword"] && $aux_use_form) { ?>
                    <input type="hidden" name="keyword" value="<?=$_GET["keyword"]?>">
                <? }

                if ($_GET["orderby"] && $aux_use_form) { ?>
                    <input type="hidden" name="orderby" value="<?=$_GET["orderby"]?>">
                <? } ?>

                <label for="subcatDD"><?=LANG_LABEL_SUBCATEGORY?></label>

                <select id="subcatDD" class="select" name="category_id" onchange="<?=($aux_use_form ? "this.form.submit();" : "Redirect('".$aux_url_category."/'+this.value)")?>">
                    <option value="">
                        ------------------
                    </option>

                    <? foreach($subcategories as $subcategory) { ?>
                        <option value="<?=($aux_use_form ? $subcategory["id"] : $subcategory["friendly_url"])?>">
                            <?=$subcategory["title"]?>
                        </option>
                    <? } ?>
                </select>

            <? if ($aux_use_form) { ?>
                </form>
            <? } ?>

        </div>

        <? }
        
        if ($openLineTopDiv) { ?>
        </div>    
        <? } 
    }
?>