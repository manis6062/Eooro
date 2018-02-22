<?php

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
	# * FILE: /controller/listing/rss_bestof.php
	# ----------------------------------------------------------------------------------------------------

    /**
     * Preparing to get category_id
     */
    $_GET["url_full"] = $_SERVER["REQUEST_URI"];
    
    if ($_GET["url_full"] && (string_strpos($_GET["url_full"], ALIAS_BESTOF_URL_DIVISOR) !== false )) {

        $url = string_replace_once(EDIRECTORY_FOLDER."/".ALIAS_BESTOF_URL_DIVISOR, "", $_GET["url_full"]);
        
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
            $categoryObj = new ListingCategory($category_id);
            $listingsIds = $categoryObj->getListingsByCategoryID();
      
        }
        
    }
    
    
    unset($searchReturn);
    $searchReturn["from_tables"]    = "Listing_Summary";
    $searchReturn["order_by"]       = "avg_review desc, level, title";
    $searchReturn["where_clause"]   = "status = 'A'".($listingsIds ? " and id in (".$listingsIds.") " : "") ;
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
            $listings[] = new ListingSummary($row["id"]);
        }
    }

    
	if (is_array($listings)) {
        
		$rssWriter = new RSSWriter();
        
        if($category_id){
            unset($categoryObj);
            $categoryObj = new ListingCategory($category_id);
            $channel_properties["title"]			= EDIRECTORY_TITLE." ".string_ucwords(LANG_MENU_BESTOF)." - ".$categoryObj->getString("title")." - RSS Feed";
            $channel_properties["link"]				= DEFAULT_URL;
            $channel_properties["description"]		= EDIRECTORY_TITLE." ".string_ucwords(LANG_MENU_BESTOF)." - ".$categoryObj->getString("summary_description");
        }else{
            $channel_properties["title"]			= EDIRECTORY_TITLE." ".string_ucwords(LANG_MENU_BESTOF)." - RSS Feed";
            $channel_properties["link"]				= DEFAULT_URL;
            $channel_properties["description"]		= EDIRECTORY_TITLE." ".string_ucwords(LANG_MENU_BESTOF);
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

        $levelObj = new ListingLevel();
        
		foreach ($listings as $each_listing) {

			unset($itens_properties);
			$itens_properties["title"]			= $each_listing->getString("title");
			if ($levelObj->getDetail($each_listing->getNumber("level")) == "y") {
				$itens_properties["link"]       = LISTING_DEFAULT_URL."/".$each_listing->getString("friendly_url");
			} else {
				$itens_properties["link"]		= LISTING_DEFAULT_URL."/results.php?id=".$each_listing->getNumber("id");
			}
			$itens_properties["description"]	= $each_listing->getString("description");
			$itens_properties["guid"]			= $itens_properties["link"];
			$itens_properties["phone"]			= $each_listing->getString("phone");
			$itens_properties["email"]			= $each_listing->getString("email");
			$itens_properties["url"]			= $each_listing->getString("url");
			$itens_properties["address"]		= $each_listing->getString("address");
			$itens_properties["pubDate"]		= date(DATE_RSS,strtotime($each_listing->updated));
			
			if ($each_listing->getNumber("image_id")) {
				$imageObj = new Image($each_listing->getNumber("image_id"));
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