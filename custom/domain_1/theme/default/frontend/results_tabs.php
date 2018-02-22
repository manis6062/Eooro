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
	# * FILE: /theme/default/frontend/results_tabs.php
	# ----------------------------------------------------------------------------------------------------

    if ((GOOGLE_MAPS_ENABLED == "on" && $aux_module_items && $mapObj && $mapObj->getString("value") == "on" && $show_results) || ($show_tabs_on_no_results) || (ACTUAL_MODULE_FOLDER == ARTICLE_FEATURE_FOLDER && $aux_module_items)) {
        
        setting_get("gmaps_max_markers", $maxMarkers);
        $maxMarkers = ($maxMarkers ? $maxMarkers : GOOGLE_MAPS_MAX_MARKERS);
    ?>
            
        <ul class="tabs nav nav-tabs">
            
            <? if ($show_tabs_on_no_results || ACTUAL_MODULE_FOLDER == ARTICLE_FEATURE_FOLDER) { ?>
            
                <li id="tab_listView" class="listView active no-link">
                    <a rel="nofollow" href="javascript: void(0);">
                        <?=system_showText(LANG_LABEL_LISTVIEW);?>
                    </a>
                </li>
                
                <? if (ACTUAL_MODULE_FOLDER != ARTICLE_FEATURE_FOLDER) { ?>
                
                <li id="tab_mapView" class="mapView disableMapTab">
                    <a rel="nofollow" href="javascript: void(0);">
                        <?=system_showText(LANG_LABEL_MAPVIEW);?>
                    </a>
                </li>
                
                <? } ?>
                
            <? } else { ?>
                
                <li id="tab_listView" class="listView <?=(!$openMap ? "active" : "");?> <?=($hideTabMap ? "no-link" : "");?>">
                    <a rel="nofollow" href="<?=($hideTabMap ? "javascript: void(0);" : $listViewURL);?>"><?=system_showText(LANG_LABEL_LISTVIEW);?></a>
                </li>
                
                <li id="tab_mapView" class="mapView <?=($openMap ? "active" : ($hideTabMap ? "disableMapTab" : ""));?>" <?=(!$hideTabMap ? "onclick=\"showMapResults('".(defined("ACTUAL_MODULE_FOLDER") ? ACTUAL_MODULE_FOLDER : LISTING_FEATURE_FOLDER)."')\"" : "  title=\"".system_showText(str_replace("[MAX_MARKERS]", $maxMarkers, LANG_LABEL_FILTER_MAP_MORE_THAN_1000_RESULTS))."\"");?>>
                    <a rel="nofollow" href="javascript: void(0);"><?=system_showText(LANG_LABEL_MAPVIEW);?></a>
                </li>
                
            <? } ?>
            
        </ul>

    <? } ?>