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
	# * FILE: /theme/contractors/frontend/search.php
	# ----------------------------------------------------------------------------------------------------

?>

    <form class="form" name="search_form" method="get" action="<?=$action;?>">
        
        <div <?=($hasAdvancedSearch ? "class=\"search-advanced box-advancedsearch\"" : "class=\"search-advanced \"");?>>
                                    
            <div class="row-fluid">
                
                <div class="search-button text-center">
                    <button class="btn btn-success btn-search" type="submit"><?=system_showText(LANG_BUTTON_SEARCH);?></button>
                </div>
                
                <? if ($hasWhereSearch) { ?>
                <div class="search-location">
                    <input type="text" name="where" id="where<?=($searchResponsive ? "_resp" : "")?>" placeholder="<?=system_showText(LANG_SEARCH_LABELLOCATION);?>" value="<?=$where;?>" <?=($waitGeoIP ? "class=\"ac_loading\" disabled=\"disabled\"" : "class=\" \"")?> />
                </div>
                <? } ?>
                
                <div class="search-keyword">
                    <input type="text" name="keyword" id="keyword<?=($searchResponsive ? "_resp" : "")?>" placeholder="<?=system_showText(LANG_LABEL_SEARCHKEYWORD);?>" value="<?=$keyword;?>" />
                </div>

            </div>

            <? if ($hasAdvancedSearch && !$searchResponsive) { ?>
                
            <div id="divAdvSearchFields" class="hidden-phone advanced-search">

                <div class="btn-advanced-search text-right">
                    <small>
                    <a id="advanced-search-button" href="javascript:void(0);" onclick="showAdvancedSearch('<?=$advancedSearchItem?>', '', true, <?=$category_id ? $category_id : 0;?>);" class="btn-advanced">
                        <span id="advanced-search-label"><?=system_showText(LANG_SEARCH_ADVANCEDSEARCH);?></span>
                        <span id="advanced-search-label-close" style="display:none"><?=system_showText(LANG_CLOSE);?></span>
                    </a>
                    </small>
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

                                <div class="row-fluid">
                                    <label><?=system_showText(LANG_SEARCH_LABELMATCH)?></label>
                                    <div class="form-inline">
                                        <label><input type="radio" name="match" value="exactmatch" class="radio" /> <?=system_showText(LANG_SEARCH_LABELMATCH_EXACTMATCH)?></label>
                                        <label><input type="radio" name="match" value="anyword" class="radio" /> <?=system_showText(LANG_SEARCH_LABELMATCH_ANYWORD)?></label>
                                        <label><input type="radio" name="match" value="allwords" class="radio" /> <?=system_showText(LANG_SEARCH_LABELMATCH_ALLWORDS)?></label>
                                    </div>
                                </div>

                                <? if ($hasWhereSearch) { ?>

                                <div class="row-fluid">
                                    
                                    <label><?=string_ucwords(ZIPCODE_LABEL)?></label>
                                    
                                    <div class="row-fluid">
                                        
                                        <? if (ZIPCODE_PROXIMITY == "on") { ?>
                                        <div class="span5 form-inline">
                                            <label><input type="text" name="dist" value="" class="span6" />
                                            <?=string_ucwords(ZIPCODE_UNIT_LABEL_PLURAL)." ".system_showText(LANG_SEARCH_LABELZIPCODE_OF)?></label>
                                        </div>
                                        <? } ?>
                                        
                                        <div class="span5 form-inline">
                                            <label><input type="text" name="zip" value="" class="span6" />
                                            <?=(ZIPCODE_PROXIMITY == "on" ? string_ucwords(ZIPCODE_LABEL) : "")?></label>
                                        </div>
                                        
                                    </div>
                                    
                                </div>
                                
                                <? } ?>

                                <div class="row-fluid">
                                    <div class="span6 selectpicker">                                        
                                        <label><?=system_showText(LANG_SEARCH_LABELCATEGORY)?></label>
                                        <div id="advanced_search_category_dropdown">
                                            <div class="loading-category"><?=$categoryDD;?></div>
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
                                        <div class="span6 selectpicker">
                                            <div id="LocationbaseAdvancedSearch">
                                                <label><?=system_showText(LANG_SEARCH_LABELLOCATION)?></label>
                                                <?
                                                $advanced_search = true;
                                                $newLocStyle = true;
                                                include(EDIRECTORY_ROOT."/includes/code/load_location.php");
                                                ?>
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
            
        </div>

    </form>