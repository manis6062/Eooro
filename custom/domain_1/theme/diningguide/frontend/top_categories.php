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
	# * FILE: /theme/diningguide/frontend/top_categories.php
	# ----------------------------------------------------------------------------------------------------

    # ----------------------------------------------------------------------------------------------------
    # CODE
    # ----------------------------------------------------------------------------------------------------
    /**
    * Get top categories
    */
    $popularCategories = ListingCategory::getPopularCategories(15);
         
    if (is_array($popularCategories)) {
        
        $catTitle = array();
        foreach ($popularCategories as $key => $row) {
            $catTitle[$key] = $row['title'];
        }
        array_multisort($catTitle, SORT_ASC, $popularCategories);
    ?>

        <div class="<?=($twitter_widget ? "" : "span6 ")?>top-categories">
            
            <h2>
                <i class="i-top-categories"></i> <?=system_showText(LANG_SEARCH_LABELCATEGORY)?>
                <a rel="canonical" href="<?=LISTING_DEFAULT_URL."/".ALIAS_LISTING_ALLCATEGORIES_URL_DIVISOR?>" class="pull-right"><?=system_showText(LANG_LABEL_VIEW_ALL);?></a>
            </h2>
            
            <ul class="list-home">
                <?
                $j = 0;
                foreach ($popularCategories as $category) {
                    $j++;
                    ?>
                    <li>
                        <a rel="canonical" href="<?=LISTING_DEFAULT_URL."/".ALIAS_CATEGORY_URL_DIVISOR."/".$category["full_friendly_url"]?>"><?=$category["title"]?> <span>(<?=$category["active_item"]?>)</span></a>
                    </li>
                    
                    <? if ($j == 3) { ?>
                        <li class="clearfix"></li>
                    <?
                        $j = 0;
                    }
                }
                ?>
            </ul>
            
        </div>

    <? } ?>