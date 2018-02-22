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
	# * FILE: /controller/listing/rss_browsebycategories.php
	# ----------------------------------------------------------------------------------------------------
    //include(EDIRECTORY_ROOT."/includes/code/validate_querystring.php");
    //include(EDIRECTORY_ROOT."/includes/code/validate_frontrequest.php");
    
    
    /**
     * Preparing to get category_id
     */
    $_GET["url_full"] = $_SERVER["REQUEST_URI"];
    
    
    if ($_GET["url_full"] && (string_strpos($_GET["url_full"], ALIAS_LISTING_ALLCATEGORIES_URL_DIVISOR) !== false )) {

        $url = string_replace_once(EDIRECTORY_FOLDER."/".ALIAS_LISTING_MODULE."/".ALIAS_LISTING_ALLCATEGORIES_URL_DIVISOR, "", $_GET["url_full"]);
        
        $parts = explode("/", $url);
        
        /**
         * Get page or letter
         */
        for ($i = 0; $i < count($parts); $i++) {
            switch ($parts[$i]) {
                case 'page': $_GET["page"] = $parts[$i + 1];
                    break;
                case 'letter': $_GET["letter"] = $parts[$i + 1];
                    break;
                case 'orderby': $_GET["orderby"] = $parts[$i + 1];
                    break;
            }
        }
        
        /**
         * Preparing to get URL to search category
         */
        
        if($_GET["page"]){
            $url = string_replace_once("/page/".$_GET["page"], "", $url);
        }
        if($_GET["letter"]){
            $url = string_replace_once("/letter/".$_GET["letter"], "", $url);
        }
        
        $url = string_replace_once("/rss/", "/", $url);
        
        
        if($url){
            $category_id = ListingCategory::getObjectByFullFriendlyURL($url);
        }

        
    }
    
    
    unset($searchReturn);

    $searchReturn["from_tables"] = "ListingCategory";
    $searchReturn["order_by"] = "title";
    $searchReturn["where_clause"] = "category_id = ".($category_id ? $category_id : "0");
    
    if($_GET["letter"]){
        $searchReturn["where_clause"] .= " and title like '".$_GET["letter"]."%'";
    }
    
    $searchReturn["select_columns"] = "id";
    
    
    # ----------------------------------------------------------------------------------------------------
	# VALIDATION
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/includes/code/validate_querystring.php");
	include(EDIRECTORY_ROOT."/includes/code/validate_frontrequest.php");

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	$dbObj = db_getDBObJect();
    $sql = "select ".$searchReturn["select_columns"]." FROM ".$searchReturn["from_tables"]." where ".(($searchReturn["where_clause"])?($searchReturn["where_clause"]):(""))." limit 100";
    
    $result = $dbObj->query($sql);

	if (mysql_num_rows($result) > 0) {
        while ($row = mysql_fetch_assoc($result)) {
            $categories_array[] = new ListingCategory($row["id"]);
        }
    }

    
	if (is_array($categories_array)) {
        
		$rssWriter = new RSSWriter();
        
        if($category_id){
            unset($categoryObj);
            $categoryObj = new ListingCategory($category_id);
            $channel_properties["title"]			= EDIRECTORY_TITLE." ".string_ucwords(LANG_MENU_BYCUISINE)." - ".$categoryObj->getString("title")." - RSS Feed";
            $channel_properties["link"]				= DEFAULT_URL;
            $channel_properties["description"]		= EDIRECTORY_TITLE." ".string_ucwords(LANG_MENU_BYCUISINE)." - ".$categoryObj->getString("summary_description");
        }else{
            $channel_properties["title"]			= EDIRECTORY_TITLE." ".string_ucwords(LANG_MENU_BYCUISINE)." - RSS Feed";
            $channel_properties["link"]				= DEFAULT_URL;
            $channel_properties["description"]		= EDIRECTORY_TITLE." ".string_ucwords(LANG_MENU_BYCUISINE);
        }
        
		$rssWriter->addChannel($channel_properties);

		unset($image_properties);
		$image_properties["link"]		= DEFAULT_URL;
		if (file_exists(EDIRECTORY_ROOT.RSS_LOGO_PATH)) {
			$image_properties["url"]	= DEFAULT_URL.RSS_LOGO_PATH;
		} else {
			$image_properties["url"]	= DEFAULT_URL."/images/content/img_logo.png";
		}
		$image_properties["title"]		= EDIRECTORY_TITLE;
		$rssWriter->addChannelImage($image_properties);

		foreach ($categories_array as $each_category) {

			unset($itens_properties);
			$itens_properties["title"]			= $each_category->getString("title");
			if ($each_category->getNumber("active_listing") > 0) {
				$itens_properties["link"]       = LISTING_DEFAULT_URL."/".ALIAS_CATEGORY_URL_DIVISOR."/".$each_category->getString("full_friendly_url");
                $itens_properties["guid"]			= $itens_properties["link"];
			}
            
			$itens_properties["description"]	= $each_category->getString("summary_description");
			
			if ($each_category->getNumber("thumb_id")) {
				$imageObj = new Image($each_category->getNumber("thumb_id"));
				$itens_properties["img_src"]	= IMAGE_URL."/".$imageObj->getString("prefix")."photo_".$imageObj->getNumber("id").".".string_strtolower($imageObj->getString("type"));
				$itens_properties["img_width"]	= $imageObj->getNumber("width");
				$itens_properties["img_height"]	= $imageObj->getNumber("height");
			}

			$rssWriter->addItem($itens_properties);

			$rssWriter->buildItem();

		}		

		$rssWriter->buildChannel();

		$rssWriter->outputRSS();

	}
    
?>