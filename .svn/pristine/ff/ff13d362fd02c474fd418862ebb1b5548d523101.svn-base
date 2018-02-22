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
	# * FILE: /theme/diningguide/frontend/search.php
	# ----------------------------------------------------------------------------------------------------

    if ($hasAdvancedSearch) {
        
        $addCategSearch = false;

        if ($advancedSearchItem == "article" || $advancedSearchItem == "blog") {
            $addCategSearch = true;
        } else {
            $locationsArray = LocationCounter::getLastLevelLocationCounter(end(system_retrieveLocationsToShow("array")), $advancedSearchItem, "count DESC, title", 15);
        }
        
    }
    
    if ($hasRatingSearch && $advancedSearchItem == "listing") {
        $levelsWithReview = system_retrieveLevelsWithInfoEnabled("has_review");
        if (!$levelsWithReview) {
            $hasRatingSearch = false;
        }
    }
    
    if ($hasPriceSearch) {
        $fieldsListing = system_getFormFields("listing", "", "price");
        if (!is_array($fieldsListing)) {
            $hasPriceSearch = false;
        }
    }
?>

    <form class="form" name="search_form" method="get" action="<?=$action;?>">
        
        <div class="search-advanced">

            <div class="row-fluid">
                
                 <div class="search-button text-center">
                    <button class="btn btn-success btn-search" type="submit"><?=system_showText(LANG_BUTTON_SEARCH);?></button>
                </div>
                
                <? if ($hasWhereSearch) { ?>
                <div class="search-location">
                    <label class="title" for="where"><?=system_showText(LANG_LABEL_SEARCHINGFOR_WHERE);?></label>
                    <input type="text" name="where" id="where<?=($searchResponsive ? "_resp" : "")?>" placeholder="<?=system_showText(LANG_LABEL_LOCATIONSEARCH);?>" value="<?=$where;?>" <?=($waitGeoIP ? "class=\"ac_loading\" disabled=\"disabled\"" : "class=\" \"")?> />
                </div>
                <? } ?>
                
                <div class="search-keyword">
                    <label class="title" for="keyword"><?=system_showText(LANG_LABEL_SEARCHINGFOR);?></label>
                    <input type="text" name="keyword" id="keyword<?=($searchResponsive ? "_resp" : "")?>" placeholder="<?=system_showText(LANG_LABEL_KEYWORDSEARCH);?>" value="<?=$keyword;?>" />
                </div>

            </div>
            
        </div>

        <? if ($hasAdvancedSearch && !$searchResponsive) { ?>
                
            <div id="divAdvSearchFields" class="hidden-phone advanced-search">

                <div class="btn-advanced-search text-right">

                    <a id="advanced-search-button" href="javascript:void(0);" onclick="showAdvancedSearch('<?=$advancedSearchItem?>', '', true, <?=$category_id ? $category_id : 0;?>);" class="btn-advanced">
                        <span id="advanced-search-label"><?=system_showText(LANG_SEARCH_ADVANCEDSEARCH);?></span>
                        <span id="advanced-search-label-close" style="display:none"><?=system_showText(LANG_LABEL_ADVSEARCH_CLOSE);?></span>
                    </a>

                </div>

                <div class="search-options row-fluid">

                    <div class="span12">

                        <div id="advanced-search" class="advanced-search-box" style="display:none;">

                            <? if (!$addCategSearch) { ?>
                            
                            <div class="<?=(($hasRatingSearch && $hasPriceSearch) ? "span7-5 " : (($hasRatingSearch || $hasPriceSearch) ? "span9-5" : "span12"))?>">
                                
                                <? if (is_array($locationsArray)) { ?>
                                
                                <ul class="list-home">
                                    <?
                                    $j = 0;

                                    foreach ($locationsArray as $value) {
                                        $j++;

                                    ?>
                                        <li>
                                            <input onclick="checkRadio($(this).parent());" type="radio" name="location_<?=end(system_retrieveLocationsToShow("array"))?>" id="location_<?=$value["id"];?>" value="<?=$value["id"]?>" <?=(${"location_".end(system_retrieveLocationsToShow("array"))} == $value["id"] ? "checked=\"checked\"" : "")?> />
                                            <label <?=(${"location_".end(system_retrieveLocationsToShow("array"))} == $value["id"] ? " class=\"active\"" : "")?> for="location_<?=$value["id"];?>"><?=$value["title"]?> <span>(<?=$value["total"]?>)</span></label>
                                        </li>

                                        <? if ($j == 3) { ?>

                                            <li class="clearfix"></li>

                                        <?
                                            $j = 0;
                                        }
                                    }
                                    ?>
                                </ul>

                                <a class="seeall" href="<?=$moduleURL."/".ALIAS_ALLLOCATIONS_URL_DIVISOR.".php";?>"><?=system_showText(LANG_LABEL_SEE_LOCATIONS);?></a>
                                
                                <? } else { ?>
                                
                                    <p><?=system_showText(LANG_LABEL_NO_LOCATIONS_FOUND);?></p>
                                    
                                <? } ?>
                                
                            </div>
                            
                            <? }

                            if ($addCategSearch) { ?>

                            <div class="<?=(($hasRatingSearch && $hasPriceSearch) ? "span7-5 " : (($hasRatingSearch || $hasPriceSearch) ? "span9-5" : "span12"))?>">
                                <div id="advanced_search_category_dropdown">
                                    <img class="loading-location" src="<?=DEFAULT_URL."/theme/".EDIR_THEME."/images/iconography/icon-loading-location.gif"?>" alt="<?=system_showText(LANG_WAITLOADING)?>"/>
                                </div>
                            </div>

                            <? }

                            if ($hasRatingSearch) { ?>

                            <div class="span2-5">

                                <h5 class="range-title"><?=ucfirst(system_showText(LANG_LABEL_RATING));?></h5>

                                <ul class="list-search">

                                    <? for ($x = 5; $x >= 1; $x--) { ?>
                                        <li>
                                            <input type="radio" name="avg_review" id="rating<?=$x?>" value="<?=$x?>" <?=($avg_review == $x ? "checked=\"checked\"" : "");?> />
                                            <label for="rating<?=$x?>" class="stars-rate">
                                                <? for ($j = 1; $j <= $x; $j++) { ?>
                                                    <img src="<?=THEMEFILE_URL."/".EDIR_THEME."/images/iconography/img_rateMiniStarOn.png"?>" alt="Star On" />
                                                <? } ?>
                                            </label>
                                        </li>
                                    <? } ?>

                                </ul>

                            </div>

                            <? }

                            if ($hasPriceSearch) { ?>

                                <div class="span2-5 symbol">

                                    <h5><?=ucwords(system_showText(LANG_LABEL_PRICE_RANGE));?></h5>

                                    <ul class="list-search">
                                        <?
                                        setting_get("listing_price_symbol", $listing_price_symbol);

                                        for ($i = LISTING_PRICE_LEVELS; $i >= 1; $i--) { ?>
                                            <li>
                                                <input type="radio" name="price" id="range<?=$i?>" value="<?=$i?>" <?=($price == $i ? "checked=\"checked\"" : "");?> />

                                                <label for="range<?=$i?>" title="<?=$listing_price_symbol." ".system_showListingPrice($i);?>">
                                                    <? for ($j = 1; $j <= $i; $j++) {
                                                        echo $listing_price_symbol;
                                                    } ?>
                                                </label>
                                            </li>
                                        <? } ?>
                                    </ul>

                                </div>

                            <? } ?>

                            <a class="clearall" href="javascript: void(0);" onclick="clearAdvancedOptions();"><?=system_showText(LANG_LABEL_CLEAR_SELECT);?></a>

                        </div>

                    </div>

                </div>

            </div>
                
        <? } ?>
    </form>