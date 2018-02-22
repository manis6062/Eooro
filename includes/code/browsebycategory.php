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
	# * FILE: /includes/code/browsebycategory.php
	# ----------------------------------------------------------------------------------------------------

    if (string_strpos(ACTUAL_MODULE_FOLDER, LISTING_FEATURE_FOLDER) !== false) {
        $module = "listing";
        $categTable = "ListingCategory";
        $moduleScalability = LISTINGCATEGORY_SCALABILITY_OPTIMIZATION;
        $module_default_url = LISTING_DEFAULT_URL;
        $viewAllLabel = system_showText(LANG_LISTING_VIEWALLCATEGORIES);
        $categoryCount = SHOW_CATEGORY_COUNT;
        $alias_allcategories = ALIAS_LISTING_ALLCATEGORIES_URL_DIVISOR;
        $countBreak = 4;
    } elseif (string_strpos(ACTUAL_MODULE_FOLDER, CLASSIFIED_FEATURE_FOLDER) !== false) {
        $module = "classified";
        $categTable = "ClassifiedCategory";
        $moduleScalability = CLASSIFIEDCATEGORY_SCALABILITY_OPTIMIZATION;
        $module_default_url = CLASSIFIED_DEFAULT_URL;
        $viewAllLabel = system_showText(LANG_CLASSIFIED_VIEWALLCATEGORIES);
        $categoryCount = SHOW_CATEGORY_COUNT;
        $alias_allcategories = ALIAS_CLASSIFIED_ALLCATEGORIES_URL_DIVISOR;
        $countBreak = 1;
    } elseif (string_strpos(ACTUAL_MODULE_FOLDER, EVENT_FEATURE_FOLDER) !== false) {
        $module = "event";
        $categTable = "EventCategory";
        $moduleScalability = EVENTCATEGORY_SCALABILITY_OPTIMIZATION;
        $module_default_url = EVENT_DEFAULT_URL;
        $viewAllLabel = system_showText(LANG_EVENT_VIEWALLCATEGORIES);
        $categoryCount = SHOW_CATEGORY_COUNT;
        $alias_allcategories = ALIAS_EVENT_ALLCATEGORIES_URL_DIVISOR;
        $countBreak = 1;
    } elseif (string_strpos(ACTUAL_MODULE_FOLDER, ARTICLE_FEATURE_FOLDER) !== false) {
        $module = "article";
        $categTable = "ArticleCategory";
        $moduleScalability = ARTICLECATEGORY_SCALABILITY_OPTIMIZATION;
        $module_default_url = ARTICLE_DEFAULT_URL;
        $viewAllLabel = system_showText(LANG_ARTICLE_VIEWALLCATEGORIES);
        $categoryCount = SHOW_CATEGORY_COUNT;
        $alias_allcategories = ALIAS_ARTICLE_ALLCATEGORIES_URL_DIVISOR;
        $countBreak = 3;
    } elseif (string_strpos(ACTUAL_MODULE_FOLDER, PROMOTION_FEATURE_FOLDER) !== false) {
        $module = "listing";
        $categTable = "ListingCategory";
        $moduleScalability = LISTINGCATEGORY_SCALABILITY_OPTIMIZATION;
        $module_default_url = PROMOTION_DEFAULT_URL;
        $viewAllLabel = system_showText(LANG_PROMOTION_VIEWALLCATEGORIES);
        $categoryCount = "off";
        $alias_allcategories = ALIAS_PROMOTION_ALLCATEGORIES_URL_DIVISOR;
        $countBreak = 1;
    } elseif (string_strpos(ACTUAL_MODULE_FOLDER, BLOG_FEATURE_FOLDER) !== false) {
        $module = "blog";
        $categTable = "BlogCategory";
        $moduleScalability = BLOGCATEGORY_SCALABILITY_OPTIMIZATION;
        $module_default_url = BLOG_DEFAULT_URL;
        $viewAllLabel = system_showText(LANG_BLOG_VIEWALLCATEGORIES);
        $categoryCount = SHOW_CATEGORY_COUNT;
        $alias_allcategories = ALIAS_BLOG_ALLCATEGORIES_URL_DIVISOR;
        $countBreak = 1;
    } else {
        $module = "listing";
        $categTable = "ListingCategory";
        $moduleScalability = LISTINGCATEGORY_SCALABILITY_OPTIMIZATION;
        $module_default_url = LISTING_DEFAULT_URL;
        $viewAllLabel = system_showText(LANG_LISTING_VIEWALLCATEGORIES);
        $categoryCount = SHOW_CATEGORY_COUNT;
        $alias_allcategories = ALIAS_LISTING_ALLCATEGORIES_URL_DIVISOR;
        
        if ($activeMenuHome) {
            $countBreak = 3;
        }

    }
    
    if ($allCategoriesPage) {
        $countBreak = 4;
    }
    
    unset($catObj);
    unset($categories);
    unset($featuredcategory);
    
	$catObj = new $categTable();
	
	if (FEATURED_CATEGORY == "on") {
		setting_get($module."_featuredcategory", $featuredcategory);
    }
    
    if ($allCategoriesPage) {
        $moduleScalability = "off";
        $featuredcategory = "";
    }

	if ($moduleScalability == "on") {
		$sql = "SELECT id, title, friendly_url, active_".($module == "blog" ? "post" : $module).(THEME_CATEGORY_DESCRIPTION ? ", summary_description" : "").(THEME_CATEGORY_IMAGE ? ", image_id" : "")." FROM $categTable WHERE category_id = '0' ".($featuredcategory ? "AND featured = 'y'" : "")." AND title <> '' AND friendly_url <> '' AND enabled = 'y' ORDER BY active_".($module == "blog" ? "post" : $module)." DESC " ;
        
        if (isset($category_page)) {
            $sql .= " LIMIT ".(($category_page - 1) * MAX_CATEGORY_PER_PAGE).",".MAX_CATEGORY_PER_PAGE;
        } else {
            $sql .= " LIMIT 20";
        }
        
		$categories = system_generateXML("categories", $sql, SELECTED_DOMAIN_ID);
        
	} else {
        
        if (isset($category_page)) {
            $categories = system_retrieveAllCategoriesXML($categTable, $featuredcategory, 0, false, $category_page);
        } else {
            $categories = system_retrieveAllCategoriesXML($categTable, $featuredcategory);
        }
                      
	}
    
	$total = 0;
    $countTotalItems = 0; //counter including all categories and subcategories

	if (is_string($categories)) {
	
        if ($moduleScalability == "on") {
            $viewMoreLink = "<a class=\"view-more\" href=\"".$module_default_url."/".$alias_allcategories.(USE_DOT_PHP_ON_ALLCATEGORIES_LINK == "on" ? ".php" : "/")."\">".$viewAllLabel."</a>";
        } else {
            $viewMoreLink = "";
        }
        
		$xml_categories = simplexml_load_string($categories);
		if (count($xml_categories->info) > 0) {
			for ($i=0; $i < count($xml_categories->info); $i++) {
				unset($categories);
				foreach ($xml_categories->info[$i]->children() as $key => $value) {
					$categories[$key] = $value;
				}
				
				$total++;
                $countTotalItems++;
				
				if ($categories) {

					$categoryLink = $module_default_url."/".ALIAS_CATEGORY_URL_DIVISOR."/".$categories["friendly_url"];                
                    $array_item_categories[$i]["categoryLink"] = $categoryLink;
                    if ($total == 3 && !THEME_CATEGORIES_SIDEBAR) {
                        $array_item_categories[$i]["liClass"] = "class=\"last\"";
                        $array_item_categories[$i]["auxLi"] = "<li class=\"clear\">&nbsp;</li>";
                        $total = 0;
                    } else {
                        $array_item_categories[$i]["auxLi"] = "";
                    }

                    $array_item_categories[$i]["categoryLink"] = $categoryLink;
                    $array_item_categories[$i]["title"] = system_showTruncatedText($categories["title"], 25);
					$array_item_categories[$i]["active_".($module == "blog" ? "post" : $module)] = $categories["active_".($module == "blog" ? "post" : $module)];
					$array_item_categories[$i]["active_".($module == "blog" ? "post" : $module)."_truncated"] = $categories["active_".($module == "blog" ? "post" : $module)];
                    if ($categories["active_".($module == "blog" ? "post" : $module)] > 1000) {
                        $array_item_categories[$i]["active_".($module == "blog" ? "post" : $module)."_truncated"] = "1000+";
                    }
                    
                    if (THEME_CATEGORY_DESCRIPTION) {
                        $array_item_categories[$i]["summary_description"] = strip_tags($categories["summary_description"]);
                    }
                    
                    if (THEME_CATEGORY_IMAGE) {
                        
                        unset($category_imagePath);
                        if ($categories["image_id"]) {
                            $imageObj = new Image((int)$categories["image_id"]);
                            if ($imageObj->imageExists()) {
                                $category_imagePath = $imageObj->getPath();
                            } else {
                                $category_imagePath = false;
                            }
                        } else {
                            $category_imagePath = false;
                        }
                        $array_item_categories[$i]["image_path"] = $category_imagePath;
                    }

                    unset($subcategories);
                    if ($moduleScalability != "on") {

                        $subcategories = system_getAllCategoriesHierarchyXML($categTable, $featuredcategory, $categories["id"], 0, SELECTED_DOMAIN_ID);

                        if ($subcategories) {
                            $xml_subcategories = simplexml_load_string($subcategories);
                            if(count($xml_subcategories->info) > 0) {
                                for($j = 0; $j < count($xml_subcategories->info); $j++){
                                    $countTotalItems++;
                                    unset($subcategories);
                                    foreach($xml_subcategories->info[$j]->children() as $key => $value){
                                        $subcategories[$key] = $value;
                                    }
                                    if ($subcategories) {

                                        $subCategoryLink = $module_default_url."/".ALIAS_CATEGORY_URL_DIVISOR."/".$categories["friendly_url"]."/".$subcategories["friendly_url"];

                                        $array_item_categories[$i]["subcategories"][$j]["subCategoryLink"] = $subCategoryLink;
                                        $array_item_categories[$i]["subcategories"][$j]["subCategoryTitle"] = system_showTruncatedText($subcategories["title"], 25);
                                        $array_item_categories[$i]["subcategories"][$j]["active_".($module == "blog" ? "post" : $module)] = $subcategories["active_".($module == "blog" ? "post" : $module)];
                                        $array_item_categories[$i]["subcategories"][$j]["active_".($module == "blog" ? "post" : $module)."_truncated"] = $subcategories["active_".($module == "blog" ? "post" : $module)];
                                        if ($subcategories["active_".($module == "blog" ? "post" : $module)] > 1000) {
                                            $array_item_categories[$i]["subcategories"][$j]["active_".($module == "blog" ? "post" : $module)."_truncated"] = "1000+";
                                        }
                                            
                                    }
                                }
                            }
                        }
                    }
				}
			}
		}
	}