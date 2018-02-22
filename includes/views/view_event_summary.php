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
	# * FILE: /includes/views/view_event_summary.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# DEFINES
	# ----------------------------------------------------------------------------------------------------

    //Get fields according to level
    unset($array_fields);
    $array_fields = system_getFormFields("Event", $event->getNumber("level"));

    if (!$isMobileSummary) {
        $event_icon_navbar = "";
        include(EDIRECTORY_ROOT."/includes/views/icon_event.php");
        $event_icon_navbar = $icon_navbar;
        $icon_navbar = "";
    }

    if ($isMobileSummary) {
        $detailLink = "".MOBILE_DEFAULT_URL."/".EVENT_FEATURE_FOLDER."/".$event->getString("friendly_url");
    } else {
        $detailLink = "".EVENT_DEFAULT_URL."/".$event->getString("friendly_url");
    }
	
	$str_date = "";
	$str_date = $event->getDateString();
	$str_recurring = "";
	if ($event->getString("recurring")=="Y"){
		$str_recurring = $event->getDateStringRecurring();
	}
	
    $str_end = "";
    $str_end = $event->getDateStringEnd();
    
    $str_time = "";
    if (is_array($array_fields) && (in_array("start_time", $array_fields) || in_array("end_time", $array_fields))){
        $str_time = $event->getTimeString();
    }
    
	$friendly_url = $event->getString('friendly_url');
	
    if (!$isMobileSummary) {
        if ((string_strpos($_SERVER["REQUEST_URI"], "results.php") !== false || string_strpos($_SERVER["REQUEST_URI"], ALIAS_EVENT_MODULE."/".ALIAS_CATEGORY_URL_DIVISOR."/") !== false || string_strpos($_SERVER["REQUEST_URI"], ALIAS_EVENT_MODULE."/".ALIAS_LOCATION_URL_DIVISOR."/") !== false) && GOOGLE_MAPS_ENABLED == "on" && $mapObj->getString("value") == "on") { 
            if ($event->getString("latitude") && $event->getString("longitude")) {
                $show_map = true;
            }else{
                $show_map = false;
            }
        }
    }
	
	if (($user) && ($level->getDetail($event->getNumber("level")) == "y")) { 
		$show_detailLink = true;
	}else{
		$show_detailLink = false;
	}
	
	$distance_label = "";
	if (zipproximity_getDistanceLabel($zip, "event", $event->getNumber("id"), $distance_label)) {
		$distance_label = " (".$distance_label.")";
	}
	
	unset($title);
	if ($show_detailLink) {
		$title	= "<a href=\"".$detailLink."\">";
		$title .= $event->getString("title");
		$title .= "</a>";
		$title .= $distance_label;
        $itemLink = $detailLink;
	} else {
		$title = $event->getString("title").$distance_label;
        $itemLink = EVENT_DEFAULT_URL."/results.php?id=".$event->getNumber("id");
	}
    
	if ($tPreview) {
		$complementary_info = system_showText(LANG_IN)." "; 
		$complementary_info .= "<a href=\"javascript:void(0);\" style=\"cursor: default;\">".system_showText(LANG_LABEL_ADVERTISE_CATEGORY)."</a>";
	} else {
		if (EVENT_SCALABILITY_OPTIMIZATION == "on") {
			$complementary_info = "<a href=\"javascript: void(0);\" ".($user ? "onclick=\"showCategory(".htmlspecialchars($event->getNumber("id")).", 'event', ".($user ? true : false).", ".$event->getNumber("account_id").")\"" : "style=\"cursor: default;\"").">".system_showText(LANG_VIEWCATEGORY)."</a>";
		} else {
			$complementary_info = system_itemRelatedCategories($event->getNumber("id"), "event", $user);
        }	
	}
	
	$when = ($event->getString("recurring") != "Y" ? $str_date : $str_recurring);
	
	if ($tPreview) {
        $event_location = system_showText(LANG_LABEL_LOCATION_NAME);
		$location = system_getLocationStringPreview($event);
	} else {
        $event_location = $event->getString("location", true);
        if (!$isMobileSummary) {
            $locationsToshow = system_retrieveLocationsToShow();
            $locationsParam = system_formatLocation($locationsToshow.", z");
            $location = $event->getLocationString($locationsParam, true);
        } else {
            $event_fulllocation = system_getItemAddressString("Event", $event->getNumber("id"));
        }
	}
    
    $event_email = "";
    $contact_email = "";
    if (is_array($array_fields) && (in_array("email", $array_fields))) {
        $event_email = $event->getString("email");
        
        if ($user) {
            $contact_email = DEFAULT_URL."/popup/popup.php?pop_type=event_emailform&amp;id=".$event->getNumber("id")."&amp;receiver=owner";
        } else { 
            $contact_email = "javascript:void(0);";
            $contact_email_style = "cursor:default";  
        }
    }
    
    $event_url = "";
    if (is_array($array_fields) && (in_array("url", $array_fields))) {
        if (is_array($array_fields) && (in_array("url", $array_fields))) {
            if ($user) {
                $event_url = $event->getString("url");
            } else {
                $event_url = "javascript: void(0);";
            }
        }

        if ($event->getString("display_url")) {
            $dispurl = $event->getString("display_url");
        } else {
            $urlsize = 40;
            $dispurl = $event->getString("url", true, $urlsize);
        }
    }
	
	$address1 = $event->getString("address");
	$address2 = $event->getString("address2");
    $phone = "";
    if (is_array($array_fields) && in_array("phone", $array_fields)){
        $phone = $event->getString("phone");
    }
	
	if ($location) {
		$location = "<span>".$location."</span>";
	}
	if ($address1) {
		$address1 = "<span>".$address1."</span>";
	}
	if ($address2) {
		$address2 = "<span>".$address2."</span>";
	}

	unset($imageTag);
    
    if (is_array($array_fields) && in_array("main_image", $array_fields)){
        if ($tPreview) {
            $imageTag = "<span class=\"no-image\" style=\"cursor: default;\"></span>";
        } else {
            if($event->getNumber("thumb_id")){
                $imageObj = new Image($event->getNumber((THEME_USE_IMAGE_BIG ? "image_id" : "thumb_id")));
                if ($imageObj->imageExists()) {
                    if ($show_detailLink){
                        $imageTag  = "<a href=\"".$detailLink."\">";
                        $imageTag .= $imageObj->getTag(THEME_RESIZE_IMAGE, IMAGE_EVENT_THUMB_WIDTH, IMAGE_EVENT_THUMB_HEIGHT, $event->getString("title", false), THEME_RESIZE_IMAGE);
                        $imageTag .= "</a>";
                    } else {
                        $imageTag .= "<div class=\"no-link\">";
                        $imageTag .= $imageObj->getTag(THEME_RESIZE_IMAGE, IMAGE_EVENT_THUMB_WIDTH, IMAGE_EVENT_THUMB_HEIGHT, $event->getString("title", false), THEME_RESIZE_IMAGE);
                        $imageTag .= "</div>";
                    }
                }else{
                    if ($show_detailLink){
                        $imageTag =  "<a href=\"".$detailLink."\" class=\"image\">";
                        $imageTag .=  "<span class=\"no-image\"></span>";
                        $imageTag .=  "</a>";
                    } else {
                        $imageTag = "<span class=\"no-image no-link\"></span>";
                    }
                }
            } else {
                if ($show_detailLink){
                    $imageTag =  "<a href=\"".$detailLink."\" class=\"image\">";
                    $imageTag .=  "<span class=\"no-image\"></span>";
                    $imageTag .=  "</a>";
                } else {
                    $imageTag = "<span class=\"no-image no-link\"></span>";
                }

            }
        }
    }
    
    $description = "";
	if (is_array($array_fields) && in_array("summary_description", $array_fields)){
		$description = $event->getString("description", true);
	}
    
    if ($isFavorites) {
        include(INCLUDES_DIR."/views/view_favorite.php");
    } else {
        if (!$isMobileSummary) {
            $summaryFileName = INCLUDES_DIR."/views/view_event_summary_code.php";
            $themeSummaryFileName = INCLUDES_DIR."/views/view_event_summary_code_".EDIR_THEME.".php";

            if (file_exists($themeSummaryFileName)){
                include($themeSummaryFileName);
            } else {
                include($summaryFileName);
            }
        }
    }
	
?>
