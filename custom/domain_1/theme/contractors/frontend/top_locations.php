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
	# * FILE: /theme/contractors/frontend/top_locations.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
    # CODE
    # ----------------------------------------------------------------------------------------------------

    if (ACTUAL_MODULE_FOLDER == LISTING_FEATURE_FOLDER) {
        $moduleURL = LISTING_DEFAULT_URL;
        $moduleName = "listing";
    } elseif (ACTUAL_MODULE_FOLDER == CLASSIFIED_FEATURE_FOLDER) {
        $moduleURL = CLASSIFIED_DEFAULT_URL;
        $moduleName = "classified";
    } elseif (ACTUAL_MODULE_FOLDER == EVENT_FEATURE_FOLDER) {
        $moduleURL = EVENT_DEFAULT_URL;
        $moduleName = "event";
    } elseif (ACTUAL_MODULE_FOLDER == PROMOTION_FEATURE_FOLDER) {
        $moduleURL = PROMOTION_DEFAULT_URL;
        $moduleName = "promotion";
    } else {
        $moduleURL = LISTING_DEFAULT_URL;
        $moduleName = "listing";
    }

    /**
     * Location last level
     */
    $locationsArray = LocationCounter::getLastLevelLocationCounter(end(system_retrieveLocationsToShow("array")), $moduleName, "count desc, title", 24);

    if (is_array($locationsArray)) {
        
        $locTitle = array();
        foreach ($locationsArray as $key => $row) {
            $locTitle[$key] = $row['title'];
        }
        array_multisort($locTitle, SORT_ASC, $locationsArray);
    ?>

        <div class="span12 flex-box-list color-2">
        
            <h2>
                <?=system_showText(string_ucwords(@constant("LANG_LABEL_TOP_".@constant("LOCATION".end(system_retrieveLocationsToShow("array"))."_SYSTEM"))))?>
                <span><a class="view-more" href="<?=$moduleURL."/".ALIAS_ALLLOCATIONS_URL_DIVISOR.".php"?>" class="pull-right"><?=system_showText(LANG_LABEL_VIEW_ALL);?> »</a></span>
            </h2>

            <ul class="list-home">
                
                <? foreach ($locationsArray as $value) { ?>
                
                    <li>
                        <a href="<?=$moduleURL."/".ALIAS_LOCATION_URL_DIVISOR."/".$value["url"]?>"><?=$value["title"]?></a><span>(<?=$value["total"];?>)</span>
                    </li>

                <? } ?>
                    
            </ul>
            
        </div>

    <? } ?>