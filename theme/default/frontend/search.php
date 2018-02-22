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
	# * FILE: /theme/default/frontend/search.php
	# ----------------------------------------------------------------------------------------------------

?>

    <form class="form" name="search_form" method="get" action="<?=$action;?>">
        
        <div class="search-advanced">

            <div class="row-fluid">
                
                 <div class="search-button text-center">
                    <button class="btn btn-info btn-search" type="submit"><?=system_showText(LANG_BUTTON_SEARCH);?></button>
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
                        <span id="advanced-search-label-close" style="display:none"><?=system_showText(LANG_CLOSE);?></span>
                    </a>

                </div>

                <div class="search-options row-fluid">

                    <div class="span12">

                        <div id="advanced-search" class="advanced-search-box" style="display:none;">

                            <? 
                            //Prepare code for advanced search form
                            $skipIncludeSearch = true;
                            include(EDIRECTORY_ROOT."/advancedsearch.php");
                            ?>
                            
                            <div class="row-fluid">

                                <div class="span2">
                                    <label><?=system_showText(LANG_SEARCH_LABELMATCH)?></label>
                                    <div><input type="radio" name="match" value="exactmatch" class="radio" /> <?=system_showText(LANG_SEARCH_LABELMATCH_EXACTMATCH)?></div>
                                    <div><input type="radio" name="match" value="anyword" class="radio" /> <?=system_showText(LANG_SEARCH_LABELMATCH_ANYWORD)?></div>
                                    <div><input type="radio" name="match" value="allwords" class="radio" /> <?=system_showText(LANG_SEARCH_LABELMATCH_ALLWORDS)?></div>
                                </div>

                                <div class="span10 row-fluid selectpicker">
                                    <div class="span4">
                                        <label><?=system_showText(LANG_SEARCH_LABELCATEGORY)?></label>
                                        <div id="advanced_search_category_dropdown">
                                            <?=$categoryDD;?>
                                        </div>
                                    </div>

                                    <?
                                    unset($showLoc);
                                    if ($_default_locations_info) {
                                        foreach ($_default_locations_info as $info) {
                                            if ($info["show"] == "y") {
                                                $showLoc = true;
                                                break;
                                            }
                                        }
                                    }

                                    if (${"locations".$_non_default_locations[0]} || $showLoc) { ?>
                                        <div class="span4">
                                            <div id="LocationbaseAdvancedSearch">
                                                <label><?=system_showText(LANG_SEARCH_LABELLOCATION)?></label>
                                                <?
                                                $advanced_search = true;
                                                $newLocStyle = true;
                                                include(EDIRECTORY_ROOT."/includes/code/load_location.php");
                                                ?>
                                            </div>
                                        </div>
                                    <? }

                                    if ($hasWhereSearch) { ?>

                                        <div class="span4">
                                            <label><?=string_ucwords(ZIPCODE_LABEL)?></label>
                                            <div class="row-fluid">
                                            <? if (ZIPCODE_PROXIMITY == "on") { ?>
                                                <div class="span5">
                                                    <input type="text" name="dist" value="" class="span6" />
                                                    <?=string_ucwords(ZIPCODE_UNIT_LABEL_PLURAL)." ".system_showText(LANG_SEARCH_LABELZIPCODE_OF)?>
                                                </div>
                                            <? } ?>
                                                <div class="span5">
                                                    <input type="text" name="zip" value="" class="span6" />
                                                    <?=(ZIPCODE_PROXIMITY == "on" ? string_ucwords(ZIPCODE_LABEL) : "")?>
                                                </div>
                                            </div>
                                        </div>
                                    <? } ?>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>
                
        <? } ?>
    </form>