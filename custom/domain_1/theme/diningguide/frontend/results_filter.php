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
	# * FILE: /theme/diningguide/frontend/results_filter.php
	# ----------------------------------------------------------------------------------------------------

	 if ($aux_module_items && !$hideResults) { ?>

        <div class="filter">			
			
            <? if ($show_results) {
                if (GOOGLE_MAPS_ENABLED == "on") {
                    if ($mapObj && $mapObj->getString("value") == "on") { ?>
                        <div class="map-control">
                            <a id="linkDisplayMap" href="javascript:void(0)" onclick="displayMap()">
                                <?=(($_COOKIE['showMap'] == 0) ? (system_showText(LANG_LABEL_HIDEMAP)) : (system_showText(LANG_LABEL_SHOWMAP)))?>
                            </a>
                        </div>
                    <? }
                }
            } ?>
				
            <p><?=$array_pages_code["total"] != 1 ? system_showText(LANG_PAGING_FOUND_PLURAL) : system_showText(LANG_PAGING_FOUND)?> <strong><?=$array_pages_code["total"]?></strong> <?=(($array_pages_code["total"] != 1) ? (system_showText(LANG_PAGING_RECORD_PLURAL)) : (system_showText(LANG_PAGING_RECORD)))?></p>
           
		</div>

    <? } ?>