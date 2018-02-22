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
	# * FILE: /sitemgr/prefs/theme_categories.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
    if ($_GET["domain_id"]) define("SELECTED_DOMAIN_ID", $_GET["domain_id"]);
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	extract($_GET);
    
    //Create dining guide categories
    setting_get("theme_create_categories", $theme_create_categories);
    if (THEME_CATEGORY_IMAGE && $theme_create_categories != "done" && !DEMO_LIVE_MODE && !DEMO_DEV_MODE) {

        if (EDIR_LANGUAGE != "pt_br") {
            
            //English
            $categArray = array();
            $categArray[] = "Seafood";
            $categArray[] = "Barbecue";
            $categArray[] = "Spanish";
            $categArray[] = "Vegetarian";
            $categArray[] = "American";
            $categArray[] = "Chinese";
            $categArray[] = "Japanese";
            $categArray[] = "Mexican";
            $categArray[] = "Italian";
            $categArray[] = "French";
            $categArray[] = "Asian";
            $categArray[] = "Brazilian";
            $categArray[] = "Coffeehouse";
            $categArray[] = "Deli";
            $categArray[] = "Dessert";
            $categArray[] = "German";
            $categArray[] = "Hamburgers";
            $categArray[] = "Hawaiian";
            $categArray[] = "Health Food";
            $categArray[] = "Indian";
            $categArray[] = "Korean";
            $categArray[] = "Mediterranean";
            $categArray[] = "Pizza";
            $categArray[] = "Sandwiches";
            $categArray[] = "Steakhouse";
            $categArray[] = "Sushi";
            $categArray[] = "Tapas";
            $categArray[] = "Thai";
            $categArray[] = "Turkish";
            $categArray[] = "Vietnamese";
            $categArray[] = "Bakery";
            
        } else {
            
            //Portuguese
            $categArray[] = "Bares";
            $categArray[] = "Brasileira";
            $categArray[] = "Cafeterias";
            $categArray[] = "Cantinas";
            $categArray[] = "Chinesa";
            $categArray[] = "Churrascaria";
            $categArray[] = "Moderna";
            $categArray[] = "Americana";
            $categArray[] = "Frutos do Mar";
            $categArray[] = "Indiana";
            $categArray[] = "Italiana";
            $categArray[] = "Japonesa";
            $categArray[] = "Lanchonetes";
            $categArray[] = "Nordestina";
            $categArray[] = "Padarias";
            $categArray[] = "Pizzarias";
            $categArray[] = "Self-Service";
            $categArray[] = "Sorveterias";
            $categArray[] = "Vegetariana";
        }
        
        foreach ($categArray as $category) {
            
            $imgName = strtolower(str_replace(" ", "-", $category));
            
            $srcImgFull = EDIRECTORY_ROOT."/".SITEMGR_ALIAS."/images/categories_diningguide/".$imgName."_full.png";
            $srcImgThumb = EDIRECTORY_ROOT."/".SITEMGR_ALIAS."/images/categories_diningguide/".$imgName."_thumb.png";
            
            if (file_exists($srcImgFull) && file_exists($srcImgThumb)) {
                
                //Generate main image record
                $imgFull = getimagesize($srcImgFull);
                $arrayImg = array();
                $arrayImg["type"] = "PNG";
                $arrayImg["width"] = $imgFull[0];
                $arrayImg["height"] = $imgFull[1];
                $arrayImg["prefix"] = "sitemgr_";
                $imgMainObj = new Image($arrayImg);
                $imgMainObj->save();
                
                //Generate thumb image record
                $imgThumb = getimagesize($srcImgThumb);
                $arrayImg = array();
                $arrayImg["type"] = "PNG";
                $arrayImg["width"] = $imgThumb[0];
                $arrayImg["height"] = $imgThumb[1];
                $arrayImg["prefix"] = "sitemgr_";
                $imgThumbObj = new Image($arrayImg);
                $imgThumbObj->save();
                
                //Create category
                $categ = array();
                $categ["title"] = $category;
                $categ["category_id"] = 0;
                $categ["thumb_id"] = $imgThumbObj->getNumber("id");
                $categ["image_id"] = $imgMainObj->getNumber("id");
                $categ["featured"] = "y";
                $categ["page_title"] = $category;
                $categ["friendly_url"] = system_generateFriendlyURL($category);
                $categ["enabled"] = "y";
                $catObj = new ListingCategory($categ);
                $catObj->save();
                
                //Move images
                $dstImgFull = $imgMainObj->getPath(false);
                $dstImgThumb = $imgThumbObj->getPath(false);
                copy($srcImgFull, $dstImgFull);
                copy($srcImgThumb, $dstImgThumb);
                
            }

        }
        
        if (!setting_set("theme_create_categories", "done")) {
            setting_new("theme_create_categories", "done");
        }
        
    }

?>