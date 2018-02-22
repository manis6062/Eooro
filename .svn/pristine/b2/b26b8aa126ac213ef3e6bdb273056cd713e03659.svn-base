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
	# * FILE: /theme/default/frontend/detail_maps.php
	# ----------------------------------------------------------------------------------------------------

    if ((ACTUAL_MODULE_FOLDER == LISTING_FEATURE_FOLDER) || $signUpListing) {
        $moduleMessage = $listingMsg;
        $moduleMaps = $listingtemplate_google_maps;
        $signUpListing = false;
        $mapFull = false;
    } elseif ((ACTUAL_MODULE_FOLDER == CLASSIFIED_FEATURE_FOLDER) || $signUpClassified) {
        $moduleMessage = $classifiedMsg;
        $moduleMaps = $classified_googlemaps;
        $signUpClassified = false;
        $mapFull = true;
    } elseif ((ACTUAL_MODULE_FOLDER == EVENT_FEATURE_FOLDER) || $signUpEvent) {
        $moduleMessage = $eventMsg;
        $moduleMaps = $event_googlemaps;
        $signUpEvent = false;
        $mapFull = false;
    }
	
	if ($tPreview) { ?>
		<figure class="googleMap map" id="map">
            <img src="<?=THEMEFILE_URL."/".EDIR_THEME."/images/imagery/img-google-map".($mapFull ? "-full" : "")."-sample.gif"?>" alt="Sample" title=""/>
                </figure>
	<? } else {
		if (!$moduleMessage && !$hideDetail){
			if (GOOGLE_MAPS_ENABLED == "on" && $mapObj->getString("value") == "on" && $listingObj->location_1!=0) { ?>
				<figure class="googleMap map" id="map">&nbsp;</figure>
                <?=$moduleMaps?>
                <?=$GetFromGoogle?>
			<? }
		}
	}
?>