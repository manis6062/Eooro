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
	# * FILE: /includes/views/view_classified_detail.php
	# ----------------------------------------------------------------------------------------------------

    //Get fields according to level
    unset($array_fields);
    $array_fields = system_getFormFields("Classified", $classified->getNumber("level"));

    if (!$isMobileDetail) {
        $classified_icon_navbar = "";
        include(EDIRECTORY_ROOT."/includes/views/icon_classified.php");
        $classified_icon_navbar = $icon_navbar;
        $favoritesLink = $links;
        $icon_navbar = "";
    }
	
	$classified_title = $classified->getString("title");
	
	$classified_category_tree = "";
	if ($tPreview) {
		$classified_category_tree = "<ul class=\"list list-category\">";
		$classified_category_tree .= "<li class=\"level-1\">";
		$classified_category_tree .= "<a href=\"javascript:void(0);\" style=\"cursor: default;\">";
		$classified_category_tree .= system_showText(LANG_LABEL_ADVERTISE_CATEGORY1)." ";
		$classified_category_tree .= "<span>(230)</span>";
		$classified_category_tree .= "</a>";
		$classified_category_tree .= "</li>";
		$classified_category_tree .= "<li class=\"level-2\">";
		$classified_category_tree .= "<a href=\"javascript:void(0);\" style=\"cursor: default;\">";
		$classified_category_tree .= system_showText(LANG_LABEL_ADVERTISE_CATEGORY1_2)." ";
		$classified_category_tree .= "<span>(200)</span>";
		$classified_category_tree .= "</a>";
		$classified_category_tree .= "</li>";
		$classified_category_tree .= "<li class=\"level-1\">";
		$classified_category_tree .= "<a href=\"javascript:void(0);\" style=\"cursor: default;\">";
		$classified_category_tree .= system_showText(LANG_LABEL_ADVERTISE_CATEGORY2)." ";
		$classified_category_tree .= "<span>(300)</span>";
		$classified_category_tree .= "</a>";
		$classified_category_tree .= "</li>";
		$classified_category_tree .= "<li class=\"level-2\">";
		$classified_category_tree .= "<a href=\"javascript:void(0);\" style=\"cursor: default;\">";
		$classified_category_tree .= system_showText(LANG_LABEL_ADVERTISE_CATEGORY2_2)." ";
		$classified_category_tree .= "<span>(230)</span>";
		$classified_category_tree .= "</a>";
		$classified_category_tree .= "</li>";
		$classified_category_tree .= "</ul>";
	} else {
		$categories = $classified->getCategories();
		if ($categories) {
			foreach ($categories as $categoryObj) {
                $arr_full_path[] = $categoryObj->getFullPath();
			}
			if ($arr_full_path) $classified_category_tree = system_generateCategoryTree($categories, $arr_full_path, "classified", $user);
		}
	}
    
    //Prepare location data to rich snippets
    $snippet_address = system_prepareRichSnippet("address", $classified);
		
	if ($tPreview) {
		$location = system_getLocationStringPreview($classified);
	} else {
        if (!$isMobileDetail) {
            $locationsToshow = system_retrieveLocationsToShow();
            $locationsParam = system_formatLocation($locationsToshow.", z");
            $location = $classified->getLocationString($locationsParam, true);
        } else {
            $location = system_getItemAddressString("Classified", $classified->getNumber("id"));
            
            if ($classified->getString("latitude") && $classified->getString("longitude")){
                $location_map = $classified->getString("latitude").",".$classified->getString("longitude");
                $location_map = urlencode($location_map);
            }
        }
	}
	
	$classified_address = $classified->getString("address");
	$classified_address2 = $classified->getString("address2");
	
    if (is_array($array_fields) && in_array("summary_description", $array_fields)){
        $classified_summary = nl2br($classified->getString("summarydesc", true));
    }
	
    $classified_price = "";
    if (is_array($array_fields) && (in_array("price", $array_fields))){
        $classified_price = $classified->getString("classified_price");
    }
	
    $classified_contactName = "";
    if (is_array($array_fields) && (in_array("contact_name", $array_fields))){
        $classified_contactName = $classified->getString("contactname");
    }
	
    $classified_phone = "";
    if (is_array($array_fields) && (in_array("contact_phone", $array_fields))){
        $classified_phone = $classified->getString("phone");
    }
	
    $classified_fax = "";
    if (is_array($array_fields) && (in_array("fax", $array_fields))){
        $classified_fax = $classified->getString("fax");
    }
    
    $classified_email = "";
	if (is_array($array_fields) && (in_array("contact_email", $array_fields))){
        $classified_email = $classified->getString("email");
    }
	
    $classified_url = "";
    if (is_array($array_fields) && (in_array("url", $array_fields))){
        $classified_url = $classified->getString("url");
    }
	
	if ($user) {
		$contact_email = DEFAULT_URL."/popup/popup.php?pop_type=classified_emailform&amp;id=".$classified->getNumber("id")."&amp;receiver=owner";
	} else { 
		$contact_email = "javascript:void(0);"; $contact_email_style = "cursor:default";  
	}
    
	$classified_description = "";
    if (is_array($array_fields) && (in_array("long_description", $array_fields))){
        $classified_description = nl2br($classified->getString("detaildesc", true));
    }
	
	$imageTag = "";
	$auxImgPath = "";
	$imageObj = new Image($classified->getNumber("image_id"));
    if (is_array($array_fields) && in_array("main_image", $array_fields) && !$isMobileDetail) {
        if ($imageObj->imageExists()) {

            $dbMain = db_getDBObject(DEFAULT_DB, true);
            $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
            $sql = "SELECT image_caption,thumb_caption FROM Gallery_Image WHERE image_id = ".$classified->getNumber("image_id");
            $r = $dbObj->query($sql);
            while ($row_aux = mysql_fetch_array($r)) {
                $imagecaption = $row_aux["image_caption"];
                $thumbcaption = $row_aux["thumb_caption"];
            }
            if (THEME_USE_BOOTSTRAP) {
                $thumbcaption = system_showTruncatedText($thumbcaption, 45);
                $imagecaption = system_showTruncatedText($imagecaption, 45);
            }

            $imageTag .= "<div class=\"no-link\" ".(RESIZE_IMAGES_UPGRADE == "off" ? "style=\"text-align:center\"" : "").">";
            $imageTag .= $imageObj->getTag(THEME_RESIZE_IMAGE, IMAGE_CLASSIFIED_FULL_WIDTH, IMAGE_CLASSIFIED_FULL_HEIGHT, ($thumbcaption ? $thumbcaption : $classified->getString("title", false)), THEME_RESIZE_IMAGE);
            $imageTag .= "</div>";
            $aux_thumbcaption = "<strong style=\"display:block\">$thumbcaption</strong>";
            if ($imagecaption) $imageTag .= "<p class=\"image-caption\">$aux_thumbcaption".$imagecaption."</p>";
            $auxImgPath = $imageObj->getPath();
        } else {
            $imageTag .= "<span class=\"no-image no-link\"></span>";
        }
    }
    
    $classifiedGallery = "";
    $arrayPaths = array();
    if (!$isMobileDetail) {
        $classifiedGallery = system_showFrontGalleryPlugin($classified->getGalleries(), $classified->getNumber("level"), $user, GALLERY_DETAIL_IMAGES, "classified", $tPreview, $onlyMain, $arrayPaths);
    } else {
        $classifiedGallery = system_showFrontGalleryMobile($classified->getGalleries(), $classified->getNumber("level"), "classified");
    }
    
    if (!$isMobileDetail) {
        /*
        * Google+ Button
        */
        if ($auxImgPath) {
            array_unshift($arrayPaths, $auxImgPath);
        }
        $classified_googleplus_button = share_getGoogleButton($tPreview, $user, false, "", false, $arrayPaths);

        /*
        * Pinterest Button
        */
        $classified_pinterest_button = share_getPinterestButton($auxImgPath, $classified->getFriendlyURL(false,CLASSIFIED_DEFAULT_URL), $classified_summary, $classified_title, $tPreview, $user);

        /*
        * Facebook Buttons
        */
        $classified_facebook_buttons = share_getFacebookButton(false, $likeObj, $tPreview, $user);

        $mapObj = new GoogleSettings(GOOGLE_MAPS_STATUS);
        if (GOOGLE_MAPS_ENABLED == "on" && $mapObj->getString("value") == "on") {
            $google_image_id = $classified->getNumber("thumb_id");
            $google_title = $classified->getString('title');
            if (is_array($array_fields) && in_array("contact_phone", $array_fields)){
                $google_phone = $classified->getString('phone');
            }
            $google_address = $classified->getString('address');
            $google_address2 = $classified->getString('address2');
            $google_zipcode = $classified->getString('zip_code');
            if ($classified->getString('latitude') && $classified->getString('longitude')){
                $google_maptuning = $classified->getString('latitude').",".$classified->getString('longitude');
            }
            $google_mapzoom = $classified->getString('map_zoom');
            $google_location1 = $classified->getLocationString("1", true);
            $google_location3 = $classified->getLocationString("3", true);
            $google_location4 = $classified->getLocationString("4", true);
            $google_zip = $classified->getLocationString("z", true);
            $google_location_showaddress = $classified->getLocationString("A, 4, 3, 1", true);
            $show_html = true;
            include(INCLUDES_DIR."/views/view_google_maps.php");
            $classified_googlemaps = $google_maps;
            $google_maps = "";
        }

        $detailFileName = INCLUDES_DIR."/views/view_classified_detail_code.php";
        $themeDetailFileName = INCLUDES_DIR."/views/view_classified_detail_code_".EDIR_THEME.".php";

        if (file_exists($themeDetailFileName)){
            include($themeDetailFileName);
        } else {
            include($detailFileName);
        }
    }

?>