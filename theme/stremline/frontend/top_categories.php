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
	# * FILE: /theme/default/frontend/top_categories.php
	# ----------------------------------------------------------------------------------------------------

    # ----------------------------------------------------------------------------------------------------
    # CODE
    # ----------------------------------------------------------------------------------------------------
    /**
    * Get top categories
    */
    $showCount = true;
    if (ACTUAL_MODULE_FOLDER == LISTING_FEATURE_FOLDER) {
        $popularCategories = ListingCategory::getPopularCategories(21);
        $moduleURL = LISTING_DEFAULT_URL;
        $categURLDivisor = ALIAS_LISTING_ALLCATEGORIES_URL_DIVISOR;
        $divColor = "3";
    } elseif (ACTUAL_MODULE_FOLDER == CLASSIFIED_FEATURE_FOLDER) {
        $popularCategories = ClassifiedCategory::getPopularCategories(21, "ClassifiedCategory", "active_classified");
        $moduleURL = CLASSIFIED_DEFAULT_URL;
        $categURLDivisor = ALIAS_CLASSIFIED_ALLCATEGORIES_URL_DIVISOR;
        $divColor = "4";
    } elseif (ACTUAL_MODULE_FOLDER == EVENT_FEATURE_FOLDER) {
        $popularCategories = EventCategory::getPopularCategories(21, "EventCategory", "active_event");
        $moduleURL = EVENT_DEFAULT_URL;
        $categURLDivisor = ALIAS_EVENT_ALLCATEGORIES_URL_DIVISOR;
        $divColor = "1";
    } elseif (ACTUAL_MODULE_FOLDER == ARTICLE_FEATURE_FOLDER) {
        $popularCategories = ArticleCategory::getPopularCategories(21, "ArticleCategory", "active_article");
        $moduleURL = ARTICLE_DEFAULT_URL;
        $categURLDivisor = ALIAS_ARTICLE_ALLCATEGORIES_URL_DIVISOR;
        $divColor = "4";
    } elseif (ACTUAL_MODULE_FOLDER == BLOG_FEATURE_FOLDER) {
        $popularCategories = BlogCategory::getPopularCategories(21, "BlogCategory", "active_post");
        $moduleURL = BLOG_DEFAULT_URL;
        $categURLDivisor = ALIAS_BLOG_ALLCATEGORIES_URL_DIVISOR;
        $divColor = "4";
    } elseif (ACTUAL_MODULE_FOLDER == PROMOTION_FEATURE_FOLDER) {
        $popularCategories = ListingCategory::getPopularCategories(21, "ListingCategory", "active_listing");
        $moduleURL = PROMOTION_DEFAULT_URL;
        $categURLDivisor = ALIAS_PROMOTION_ALLCATEGORIES_URL_DIVISOR;
        $divColor = "4";
        $showCount = false;
    } else {
        $popularCategories = ListingCategory::getPopularCategories(21, "ListingCategory", "active_listing");
        $moduleURL = LISTING_DEFAULT_URL;
        $categURLDivisor = ALIAS_LISTING_ALLCATEGORIES_URL_DIVISOR;
        $divColor = "3";
    }
         
    if (is_array($popularCategories)) {
        
        $catTitle = array();
        foreach ($popularCategories as $key => $row) {
            $catTitle[$key] = $row['title'];
        }
        array_multisort($catTitle, SORT_ASC, $popularCategories);
    ?>

        <div class="span12 flex-box-list color-<?=$divColor?>">

            <h2>
                <?=system_showText(LANG_BROWSEBYCATEGORY)?> 
                <span><a class="view-more" href="<?=$moduleURL."/".$categURLDivisor.(USE_DOT_PHP_ON_ALLCATEGORIES_LINK == "on" ? ".php" : "/")?>"><?=system_showText(LANG_MORE);?></a></span>
            </h2>
            
            <ul class="browse-category">
                
                <? foreach ($popularCategories as $category) { ?>
                
                    <li>
                        
                        <a href="<?=$moduleURL."/".ALIAS_CATEGORY_URL_DIVISOR."/".$category["full_friendly_url"]?>">
                            <?=$category["title"]?>
                        </a>
                            
                        <? if (SHOW_CATEGORY_COUNT == "on" && $showCount) { ?>
                            <span>(<?=$category["active_item"]?>)</span>
                        <? } ?>
                        
                    </li>
                    
                <? } ?>
                    
            </ul>
            
        </div>

    <? } ?>