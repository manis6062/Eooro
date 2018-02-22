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
	# * FILE: /theme/diningguide/frontend/bycuisine.php
	# ----------------------------------------------------------------------------------------------------
    
    unset($aux_array_rss);
    
	if (is_array($categories)) { ?>

        <div class="top-pagination">
            
            <div class="line-bottom">
                <? include(system_getFrontendPath("results_filter.php")); ?>
                <? include(system_getFrontendPath("results_pagination.php")); ?>
            </div>
            
        </div>

        <div class="content-full-results">
            
            <div class="row-fluid allcategories">
                
                <? foreach($categories as $category) { ?>
                
                    <div class="span6">
                        
                        <div class="all-head">
                            
                            <div class="row-fluid">
                                
                                <div class="category-name">
                                    
                                    <div class="category-centered">
                                        
                                        <div class="category-link">

                                            <a rel="canonical" href="<?=LISTING_DEFAULT_URL."/".ALIAS_CATEGORY_URL_DIVISOR."/".$category->getString("full_friendly_url")?>">
                                                <?
                                                echo $category->getString("title"); 
                                                if (SHOW_CATEGORY_COUNT == "on") { ?>

                                                    <br />
                                                    
                                                    <span>
                                                        <small>(<?=$category->getNumber("active_listing")?>)</small>
                                                    </span>

                                                <? } ?>
                                            </a>

                                        </div>
                                        
                                    </div>
                                    
                                </div>
                                
                                <div class="category-image">
                                    <a rel="canonical" href="<?=LISTING_DEFAULT_URL."/".ALIAS_CATEGORY_URL_DIVISOR."/".$category->getString("full_friendly_url")?>">
                                        <? if ($category->getImagePath()) { ?>
                                            <img src="<?=$category->getImagePath()?>"/>
                                        <? } else { ?>
                                            <span class="no-image"></span>
                                        <? } ?>
                                    </a>
                                </div>
                                
                            </div>
                            
                        </div>

                        <p><?=$category->getString("summary_description");?></p>
                        
                    </div>
                <? } ?>
                
                <div class="bottom-pagination">
                    <? 
                    $pagination_bottom = true;
                    $showLetter = false;
                    include(system_getFrontendPath("results_pagination.php"));
                    ?>
                </div>
                
            </div>
            
        </div>
    <? } ?>