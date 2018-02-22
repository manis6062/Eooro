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
	# * FILE: /frontend/filters.php
	# ----------------------------------------------------------------------------------------------------

?>    
    <script type="text/javascript">
        
        $(document).ready( function () {
            
            <? foreach ($availableFilters as $avFilter) { ?>
                    
                //Show/Hide Filter 
                $("#filter_<?=$avFilter?>").click(function() {
                    if ($("#list_<?=$avFilter?>").css("display") == "none") {
                        $(this).find("a").removeClass("icon-caret-right");
                        $(this).find("a").addClass("icon-caret-down");
                        $("#list_<?=$avFilter?>").slideDown("slow");
                    } else {
                        $(this).find("a").removeClass("icon-caret-down");
                        $(this).find("a").addClass("icon-caret-right");
                        $("#list_<?=$avFilter?>").slideUp("slow");
                    }
                });
            <? } ?>
        
        });
        
        function CloseFilters() {

            if ($("#return_filter").css("display") == "none") {
                
                <? foreach ($availableFilters as $avFilter) { ?>
                    $("#filter_<?=$avFilter?>").find("a").removeClass("icon-caret-down");
                    $("#filter_<?=$avFilter?>").find("a").addClass("icon-caret-right");
                    $("#list_<?=$avFilter?>").css("display", "none");
                <? } ?>
                    
                $("#return_filter").slideDown("slow");
                
            } else {
                
                $("#return_filter").slideUp("slow");
            }
            
        }
        
    </script>
    
    <? if (is_array($filters) && count($filters)) { ?>

        <? if (is_array($arrayRefinedBy) && count($arrayRefinedBy) > 0) { ?>
            
            <div>
    
                <h2><?=system_showText(LANG_LABEL_REFINEDBY);?></h2>

                <div class="filter-box">
                    <ul>
                        
                        <? foreach ($arrayRefinedBy as $infoRefined) { ?>
                        
                        <li>
                            <b><?=$infoRefined["label"]?></b>
                            <span>
                                <a rel="nofollow" href="<?=$infoRefined["link"]?>">x</a>
                            </span>
                        </li>
                        
                        <? } ?>
                        
                    </ul>
                    <a rel="nofollow" class="remove-all" href="<?=$filterLinkNoFilter;?>"><?=LANG_LABEL_REMOVE_ALL?></a>
                </div>
                
            </div>
        
        <? } ?>

        <h2><?=system_showText(LANG_LABEL_REFINEBY);?></h2>
        
        <ul>

        <? foreach ($filters as $filter) { ?>
            
            <li class="item-filter">
                
            <? if ($filter["type"] == "location") { ?>
                
                <h3 id="filter_location">
                    <b class="title-filter"><?=system_showText((@constant("LANG_LABEL_".constant("LOCATION".$_location_level."_SYSTEM"))))?></b>
                    <a class="icon-caret-down" href="javascript:void(0);"></a>
                </h3>
                                              
                <ul id="list_location" class="item-select">
                    
                <? foreach ($filter["filters"] as $filterLoc) {
                                        
                    $thisLink = system_prepareFilterUrl($_GET, $filterLink, "filter_location_".$filterLoc["level"], $filterLoc["id"]);

                    $thisActive = false;
                    if (in_array($filterLoc["id"], ${"aux_filter_location_".$filterLoc["level"]})) {
                        $thisActive = true;
                    } ?>
                    
                    <li <?=($thisActive ? "class=\"active\"" : "")?>>
                        <a rel="nofollow" href="<?=$thisLink?>"><?=$filterLoc["title"]?></a>
                    </li>
                    
                <? } ?>
                    
                </ul>
                
            <? } elseif ($filter["type"] == "category") { ?>
                
                <h3 id="filter_category">
                    <b class="title-filter"><?=system_showText(LANG_LABEL_CATEGORY);?></b>
                    <a class="icon-caret-down" href="javascript:void(0);"></a>
                </h3>
                
                <ul id="list_category" class="item-select">
                    <?=system_buildCategoriesFilter($arrayCategories, $arrayTotal, $categories, $filterLink, $_GET, false, ($category_id ? $category_id : 0), $filter_item, false, $_GET);?>
                </ul>
                
            <? } elseif ($filter["type"] == "deal") {
                
                $thisLink = system_prepareFilterUrl($_GET, $filterLink, "filter_deal", "yes");
                ?>
                
                <h3 id="filter_deal">
                    <b class="title-filter"><?=system_showText(LANG_LABEL_DEAL_FILTER);?></b>
                    <a class="icon-caret-down" href="javascript:void(0);"></a>
                </h3>
                               
                <ul id="list_deal" class="item-select">
                    <li <?=($filter_deal == "yes" ? "class=\"active\"" : "")?>>
                        <a rel="nofollow" href="<?=$thisLink?>"><?=system_showText(LANG_LABEL_FILTER_DEAL);?></a>
                    </li>
                </ul>
                
            <? } elseif ($filter["type"] == "price") { ?>
                
                <h3 id="filter_price">
                    <b class="title-filter"><?=ucwords(system_showText(LANG_LABEL_PRICE_RANGE));?></b>
                    <a class="icon-caret-down" href="javascript:void(0);"></a>
                </h3>

                <ul id="list_price" class="item-select price">

                <? foreach ($filter["filters"] as $filterPrice) {
                    
                    $thisLink = system_prepareFilterUrl($_GET, $filterLink, "filter_price", $filterPrice["price"]);
                    
                    $thisActive = false;
                    if (in_array($filterPrice["price"], $aux_filter_price)) {
                        $thisActive = true;
                    } ?>
                    
                    <li <?=($thisActive ? "class=\"active\"" : "")?>>
                        <a rel="nofollow" href="<?=$thisLink?>">
                            <? 
                            for ($k = 0; $k < $filterPrice["price"]; $k++) {
                                echo $listing_price_symbol;
                            } 
                            ?>
                            <span>(<?=$listing_price_symbol.system_showListingPrice($filterPrice["price"]);?>)</span>
                        </a>
                    </li>
                <? } ?>
                    
                </ul>

            <? } elseif ($filter["type"] == "rating") { ?>

                <h3 id="filter_rating">
                    <b class="title-filter"><?=ucfirst(system_showText(LANG_LABEL_RATING));?></b>
                    <a class="icon-caret-down" href="javascript:void(0);"></a>
                </h3>

                <ul id="list_rating" class="item-select">

                <? foreach ($filter["filters"] as $filterRating) {
                    
                    $thisLink = system_prepareFilterUrl($_GET, $filterLink, "rating", $filterRating["rating"]);

                    $thisActive = false;
                    if (in_array($filterRating["rating"], $ratingArray)) {
                        $thisActive = true;
                    }
                    ?>
                    
                    <li <?=($thisActive ? "class=\"active\"" : "")?>>
                        <a rel="nofollow" href="<?=$thisLink?>">
                            <?=$filterRating["rating"];?> <?=($filterRating["rating"] == 1 ? system_showText(LANG_LABEL_STAR) : system_showText(LANG_LABEL_STARS))?>
                        </a>
                    </li>
                <? } ?>
                    
                </ul>
                
            <? } elseif ($filter["type"] == "valid_for") { ?>
                
                <h3 id="filter_week_filter">
                    <b class="title-filter"><?=ucfirst(system_showText(LANG_LABEL_FILTER_VALID_FOR));?></b>
                    <a class="icon-caret-down" href="javascript:void(0);"></a>
                </h3>
                
                <ul id="list_week_filter" class="item-select">
                    
                <? foreach($filter["filters"] as $filter_valid) {
                    
                    $thisLink = system_prepareFilterUrl($_GET, $filterLink, "filter_valid_for", $filter_valid[0]);
                    ?>
                    <li <?=($filter_valid_for == $filter_valid[0] ? "class=\"active\"" : "")?>>
                        <a rel="nofollow" href="<?=$thisLink?>"><?=system_showText($filter_valid[1]);?></a>
                    </li>
                <? } ?>
                    
                </ul>
                
            <? } ?>
                
            </li>
            
        <? } ?>
            
        </ul>
        
    <? } ?>