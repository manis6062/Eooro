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
	# * FILE: /theme/diningguide/frontend/top_locations.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
    # CODE
    # ----------------------------------------------------------------------------------------------------
    /**
     * Location last level
     */
    $locationsArray = LocationCounter::getLastLevelLocationCounter(end(system_retrieveLocationsToShow("array")), "listing", "count desc, title", 15);

    if (is_array($locationsArray)) {
        
        $locTitle = array();
        foreach ($locationsArray as $key => $row) {
            $locTitle[$key] = $row['title'];
        }
        array_multisort($locTitle, SORT_ASC, $locationsArray);
    ?>

        <div class="<?=($twitter_widget ? "" : "span6 ")?>top-locations">
            
            <h2>
                <i class="i-top-locations"></i><?=system_showText(@constant("LANG_LABEL_".constant("LOCATION".end(system_retrieveLocationsToShow("array"))."_SYSTEM")."_PL"))?>
                <a rel="canonical" href="<?=LISTING_DEFAULT_URL."/".ALIAS_ALLLOCATIONS_URL_DIVISOR.".php"?>" class="pull-right"><?=system_showText(LANG_LABEL_VIEW_ALL);?></a>
            </h2>
            
            <ul class="list-home">
                <?
                $j = 0;
                foreach ($locationsArray as $value) {
                    $j++;
                    ?>
                    <li>
                        <a rel="canonical" href="<?=LISTING_DEFAULT_URL."/".ALIAS_LOCATION_URL_DIVISOR."/".$value["url"]?>"><?=$value["title"]?> <span>(<?=$value["total"]?>)</span></a>
                    </li>
                    
                    <? if ($j == 3) { ?>
                        <li class="clearfix"></li>
                    <?
                        $j = 0;
                    }
                }
                ?>
            </ul>
        </div>

    <? } ?>