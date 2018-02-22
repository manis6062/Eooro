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
	# * FILE: /loadmap.php
	# ----------------------------------------------------------------------------------------------------
    
	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("./conf/loadconfig.inc.php");
    
    //Prepare Get
    if ($_POST["arrayGet"]) {
        foreach ($_POST["arrayGet"] as $key => $value) {
            $valInfo = explode(",", $value);
            if (get_magic_quotes_gpc()) {
                $valInfo[1] = stripslashes($valInfo[1]);
            }
            $_GET[$valInfo[0]] = $valInfo[1];
        }
        unset($_POST["arrayGet"]);
    }

	# ----------------------------------------------------------------------------------------------------
	# VALIDATION
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/includes/code/validate_querystring.php");
	include(EDIRECTORY_ROOT."/includes/code/validate_frontrequest.php");

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	header("Expires: Sat, 01 Jan 2000 00:00:00 GMT");
	header("Cache-Control: no-store, no-cache, must-revalidate");
	header("Cache-Control: post-check=0, pre-check=0", FALSE);
	header("Pragma: no-cache");
	header("Content-Type: text/html; charset=".EDIR_CHARSET, TRUE);

    if ($action == "summary") {
        
        echo "<script type=\"text/javascript\">loadToolTip('summary_ajax');</script>";
        
        if ($module == LISTING_FEATURE_FOLDER) {
            
            //Get listing information
            $searchReturn = search_frontListingSearch($array = array(), "listing_results");
            $sql = "SELECT ".$searchReturn["select_columns"]." FROM ".$searchReturn["from_tables"]." WHERE id = $id";
            $listingArray = db_getFromDBBySQL("Listing_Summary", $sql, "array");
            $listing = $listingArray[0];

            //Prepare variables used on view_listing_summary.php
            $user = true;
            $levelsWithReview = system_retrieveLevelsWithInfoEnabled("has_review");
            setting_get("commenting_edir", $commenting_edir);
            setting_get("review_listing_enabled", $review_enabled);
            $levelObj = new ListingLevel(true);
            $locationManager = new LocationManager();

            if (TWILIO_APP_ENABLED == "on") {
                if (TWILIO_APP_ENABLED_SMS == "on") {
                    $levelsWithSendPhone = system_retrieveLevelsWithInfoEnabled("has_sms");
                } else {
                    $levelsWithSendPhone = false;
                }
                if (TWILIO_APP_ENABLED_CALL == "on") {
                    $levelsWithClicktoCall = system_retrieveLevelsWithInfoEnabled("has_call");
                } else {
                    $levelsWithClicktoCall = false;
                }
            } else {
                $levelsWithSendPhone = false;
                $levelsWithClicktoCall = false;
            }

            include(INCLUDES_DIR."/views/view_listing_summary.php");

            report_newRecord("listing", $id, LISTING_REPORT_SUMMARY_VIEW);
        
        } elseif ($module == PROMOTION_FEATURE_FOLDER) {
            
            //Get deal information
            $searchReturn = search_frontPromotionSearch($array = array(), "promotion_results");
            $sql = "SELECT ".$searchReturn["select_columns"]." FROM ".$searchReturn["from_tables"]." WHERE id = $id";
            $promotionArray = db_getFromDBBySQL("Promotion", $sql);
            $promotion = $promotionArray[0];
            $summayDealAjax = true;

            //Prepare variables used on view_listing_summary.php
            $user = true;
            setting_get("commenting_edir", $commenting_edir);
            setting_get("review_promotion_enabled", $review_enabled);
            include(INCLUDES_DIR."/views/view_promotion_summary.php");
            
            report_newRecord("promotion", $id, PROMOTION_REPORT_SUMMARY_VIEW);
            
        } elseif ($module == EVENT_FEATURE_FOLDER) {
            
            //Get event information
            $searchReturn = search_frontEventSearch($array = array(), "event");
            $sql = "SELECT ".$searchReturn["select_columns"]." FROM ".$searchReturn["from_tables"]." WHERE id = $id";
            $eventArray = db_getFromDBBySQL("Event", $sql);
            $event = $eventArray[0];

            //Prepare variables used on view_event_summary.php
            $user = true;
            $level = new EventLevel(true);
            $locationManager = new LocationManager();
            include(INCLUDES_DIR."/views/view_event_summary.php");
            
            report_newRecord("event", $id, EVENT_REPORT_SUMMARY_VIEW);
            
        } elseif ($module == CLASSIFIED_FEATURE_FOLDER) {
            
            //Get classified information
            $searchReturn = search_frontClassifiedSearch($array = array(), "classified");
            $sql = "SELECT ".$searchReturn["select_columns"]." FROM ".$searchReturn["from_tables"]." WHERE id = $id";
            $classifiedArray = db_getFromDBBySQL("Classified", $sql);
            $classified = $classifiedArray[0];

            //Prepare variables used on view_classified_summary.php
            $user = true;
            $level = new ClassifiedLevel(true);
            $locationManager = new LocationManager();
            include(INCLUDES_DIR."/views/view_classified_summary.php");
            
            report_newRecord("classified", $id, CLASSIFIED_REPORT_SUMMARY_VIEW);
            
        }
        
        exit;
    }

    //Prepare results

    // replacing useless spaces in search by "where"
    if ($_GET["where"]) {
        while (string_strpos($_GET["where"], "  ") !== false) {
            str_replace("  ", " ", $_GET["where"]);
        }
        if ((string_strpos($_GET["where"], ",") !== false) && (string_strpos($_GET["where"], ", ") === false)) {
            str_replace(",", ", ", $_GET["where"]);
        }
    }
    
    $db = db_getDBObject();
    
    if ($module == LISTING_FEATURE_FOLDER) {
        
        $searchReturn = search_frontListingSearch($_GET, "listing_results");
        $sql = "SELECT id, title, latitude, longitude FROM ".$searchReturn["from_tables"]." WHERE ".$searchReturn["where_clause"]." AND latitude != '' AND longitude != ''";
    
    } elseif ($module == PROMOTION_FEATURE_FOLDER) {
        
        $searchReturn = search_frontPromotionSearch($_GET, "promotion_results");
        $sql = "SELECT id, name AS title, listing_latitude AS latitude, listing_longitude AS longitude FROM ".$searchReturn["from_tables"]." WHERE ".$searchReturn["where_clause"]." AND listing_latitude != '' AND listing_longitude != ''";
    
    } elseif ($module == EVENT_FEATURE_FOLDER) {
        
        $searchReturn = search_frontEventSearch($_GET, "event");
        $sql = "SELECT id, title, latitude, longitude FROM ".$searchReturn["from_tables"]." WHERE ".$searchReturn["where_clause"]." AND latitude != '' AND longitude != ''";
    
    } elseif ($module == CLASSIFIED_FEATURE_FOLDER) {
        
        $searchReturn = search_frontClassifiedSearch($_GET, "classified");
        $sql = "SELECT id, title, latitude, longitude FROM ".$searchReturn["from_tables"]." WHERE ".$searchReturn["where_clause"]." AND latitude != '' AND longitude != ''";
    
    }
    $result = $db->query($sql);

    $returnScript = "";
    
    if (mysql_num_rows($result)) {
        
        /**
        * Get pointer to theme
        */
        $pointer_path = THEMEFILE_URL."/".EDIR_THEME."/schemes/".(EDIR_SCHEME != "custom" ? EDIR_SCHEME : EDIR_THEME);
        $pointer_path_custom = DEFAULT_URL."/custom/domain_".SELECTED_DOMAIN_ID."/theme_images";
        setting_get("gmaps_scroll", $gmaps_scroll);
              
        $returnScript .= "var points = [";
        $totalPoints = 0;
        while ($row = mysql_fetch_assoc($result)) {
            $htmlCluster = "<a href=\"javascript: void(0);\" onclick=\"showSummary({$row["id"]});\">".addslashes($row["title"])."</a>";
            $returnScript .= "['".$row["latitude"]."', '".$row["longitude"]."', ".$row["id"].", '{$htmlCluster}'],";
            $totalPoints++;
        }
        $returnScript = substr($returnScript, 0, -1);
        
        $returnScript .= "];";
        
        $returnScript .= "  var totalPoints = ".$totalPoints.";
            
                            var clusterInfoWindow = new google.maps.InfoWindow();
            
                            var styles = [[{
                                    url: '".$pointer_path."/images/markers/m1.png',
                                    height: 27,
                                    width: 27,
                                    textColor: '#ffffff',
                                    textSize: 10
                                }, {
                                    url: '".$pointer_path."/images/markers/m2.png',
                                    height: 29,
                                    width: 29,
                                     textColor: '#ffffff',
                                    textSize: 10
                                }, {
                                    url: '".$pointer_path."/images/markers/m3.png',
                                    height: 34,
                                    width: 34,
                                    textColor: '#ffffff',
                                    textSize: 10
                                }, {
                                    url: '".$pointer_path."/images/markers/m4.png',
                                    height: 38,
                                    width: 38,
                                    textColor: '#ffffff',
                                    textSize: 10
                                }, {
                                    url: '".$pointer_path."/images/markers/m5.png',
                                    height: 46,
                                    width: 46,
                                    textColor: '#ffffff',
                                    textSize: 10
                                }]];
                                
                            var markerClusterer = null;
                            var map = null;";
                
        $returnScript .= "
            
            function showSummary(id) {
                var module = '".$module."';
                var current_id = $('#summarymap_current_id').val();
                var parameters = {
                    \"module\": module,
                    \"id\": id,
                    \"action\": 'summary'
                };
                $(\"#summary_map\").css('display', '');
                $('html, body').animate({
                    scrollTop: $('#summary_map').offset().top
                }, 'slow');

                var inputText = '<input type=\'hidden\' id=\'summarymap_current_id\' value=\''+id+'\'>';

                if (current_id != id) {
                    $(\"#summary_map\").html('<p class=\"text-center\">".system_showText(LANG_WAITLOADING)."</p>');
                    if ($('#summary_map_content_'+id).length && $('#summary_map_content_'+id).html()) {
                        $(\"#summary_map\").html($('#summary_map_content_'+id).html() + inputText);
                        $('#summary_map_content_'+id).html('');
                    } else {
                        $.post(DEFAULT_URL + \"/loadmap.php\", parameters, function (ret) {
                            $(\"#summary_map\").html(ret + inputText);
                        });
                    }
                    $('.summary-price a, .button-call img, .button-send img, .share-social img').tooltip({
                        animation: true
                    });

                }
        
            }
        
            function refreshMap() {
                if (markerClusterer) {
                    markerClusterer.clearMarkers();
                }

                var markers = [];
                var bounds = new google.maps.LatLngBounds();
                                                            
                for (i = 0; i < points.length; i++) {
                    var latLng = new google.maps.LatLng(points[i][0], points[i][1]);
                    var marker = new google.maps.Marker({
                        position: latLng,
                        draggable: true,
                        draggable: false
                    });
                    
                    marker.set('id', points[i][2]);
                    marker.set('module', '$module');
                    marker.set('html', points[i][3]);
                    
                    google.maps.event.addListener(marker, 'click', function() {
                        var id = this.get('id');
                        showSummary(id);
                    });

                    markers.push(marker);
                    bounds.extend(latLng);
                    map.fitBounds(bounds);
 
                }
                
                ";
                
                if (GOOGLE_MAPS_LIMITDRAGGABLE == "on") {
                    
        $returnScript .= "
                
                // Listen for the dragend event
                google.maps.event.addListener(map, 'dragend', function() {
                    
                    if (bounds.contains(map.getCenter())) return;

                    // We're out of bounds - Move the map back within the bounds

                    var c = map.getCenter(),
                        x = c.lng(),
                        y = c.lat(),
                        maxX = bounds.getNorthEast().lng(),
                        maxY = bounds.getNorthEast().lat(),
                        minX = bounds.getSouthWest().lng(),
                        minY = bounds.getSouthWest().lat();

                    if (x < minX) x = minX;
                    if (x > maxX) x = maxX;
                    if (y < minY) y = minY;
                    if (y > maxY) y = maxY;

                    map.setCenter(new google.maps.LatLng(y, x));
                });";
        
            }
                
        $returnScript .= "
                    
                markerClusterer = new MarkerClusterer(map, markers, {
                                        maxZoom: null,
                                        gridSize: null,
                                        styles: styles[0]
                                    });
                                    
                markerClusterer.openWindowMarkers = function() { return multiChoice(markerClusterer); }
            }
            
            function multiChoice(mc) {
                var cluster = mc.clusters_;
                var htmlContent = '';
                // if more than 1 point shares the same lat/long
                // the size of the cluster array will be 1 AND
                // the number of markers in the cluster will be > 1
                // REMEMBER: maxZoom was already reached and we can't zoom in anymore
                if (cluster.length == 1 && cluster[0].markers_.length > 1) {
                    var markers = cluster[0].markers_;
                    for (var i = 0; i < markers.length; i++) {
                        htmlContent = htmlContent + markers[i]['html'] + '<br />';
                    }
                    clusterInfoWindow.setContent(htmlContent);
                    clusterInfoWindow.open(map, markers[0]);
                    return false;
                }

                return true;
            }

            function initialize() {

                var myOptions = {
                    scrollwheel: ".($gmaps_scroll == "y" ? "true" : "false").",
                    scaleControl: true,   
                    zoom: 15,
                    center: new google.maps.LatLng(0, 0),
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                }

                map = new google.maps.Map(document.getElementById('resultsMap'), myOptions);

                refreshMap();
            }

            ";
    }
    
    echo $returnScript;
?>