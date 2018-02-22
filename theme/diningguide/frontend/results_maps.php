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
	# * FILE: /frontend/results_maps.php
	# ----------------------------------------------------------------------------------------------------

    if (GOOGLE_MAPS_ENABLED == "on" && $mapObj && $mapObj->getString("value") == "on") {
        
        if ($show_results && !$ajaxMap && $aux_module_items) { ?>

            <div id="resultsMap" class="map" style="display:<?=(($_COOKIE['showMap'] == 0) ? ('') : ('none'))?>"></div>
            
        <? } elseif ($ajaxMap && $array_pages_code["total"] <= $maxMarkers) {

            if ($openMap) { ?>
                <script type="text/javascript">
                    $(document).ready(function() {
                        showMapResults("<?=(defined("ACTUAL_MODULE_FOLDER") ? ACTUAL_MODULE_FOLDER : LISTING_FEATURE_FOLDER);?>");
                    });
                </script>
            <? } ?>

            <div id="content_mapView" style="display: none;">

                <div id="resultsVars" style="display:none;">
                    <? 
                    $auxKey = "";
                    $googleSettingObj = new GoogleSettings(GOOGLE_MAPS_SETTING, $_SERVER["HTTP_HOST"]);
                    
                    /* key for demodirectory.com */
                    if (DEMO_LIVE_MODE) {
                        $googleMapsKey = GOOGLE_MAPS_APP_DEMO;
                    } else {
                        $googleMapsKey = $googleSettingObj->getString("value");
                    }
                    
                    if ($googleMapsKey) {
                        $auxKey = "&amp;key=".$googleMapsKey;
                    }
                    
                    foreach ($_GET as $key => $value) {
                        if ($key != "screen" && $key != "letter") { ?>
                            <input type="hidden" name="<?=$key;?>" value="<?=htmlspecialchars($value);?>" />
                        <? }
                    } ?>
                    <input type="hidden" id="control_openMap"name="openMap" value="" />

                    <script src="<?="https://maps.google.com/maps/api/js?sensor=false$auxKey"?>" type="text/javascript"></script>
                    <script src="<?=DEFAULT_URL."/scripts/markerclusterer/src/markerclusterer.js"?>" type="text/javascript"></script>
                     
                </div>

                <div id="resultsMap" class="map">
                    <div class="cont-map">
                        <div class="map-loading"><?=system_showText(LANG_LABEL_LOADINGMAP);?></div>
                    </div>
                </div>

                <div id="summary_map" style="display: none;"></div>

            </div>

        <? }
    }
?>