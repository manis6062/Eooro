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
	# * FILE: /theme/default/body/index.php
	# ----------------------------------------------------------------------------------------------------
   
    # ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------       
    //Slider
    include(EDIRECTORY_ROOT."/includes/code/slider_front.php");
    
	//Newsletter
    include(EDIRECTORY_ROOT."/includes/code/newsletter.php");
    
    //Facebook page
    setting_get("setting_facebook_link", $setting_facebook_link);

?>
              
    <div class="row-fluid">
        
        <? if ($showSlider) { ?>
        
        <div class="span<?=($showNewsletter ? "9" : "12")?>">
            <? include(system_getFrontendPath("slider.php")); ?>
        </div>
        
        <? } ?>
        
        <? if ($showNewsletter) { ?>
        
        <div class="span<?=($showSlider ? "3" : "12")?>">
            <? include(system_getFrontendPath("newsletter.php")); ?>
        </div>
        
        <? } ?>
        
    </div>

    <? include(system_getFrontendPath("sitecontent_top.php")); ?>

    <div class="row-fluid">
        
        <div class="span8">
                       
            <div class="row-fluid">
                <? include(system_getFrontendPath("top_categories.php", "frontend", false, LISTING_EDIRECTORY_ROOT)); ?>
            </div>
                        
            <div class="row-fluid">
                <? include(system_getFrontendPath("featured_listing.php", "frontend", false, LISTING_EDIRECTORY_ROOT)); ?>
            </div>
           
            <div class="row-fluid">
                <? include(system_getFrontendPath("top_locations.php", "frontend")); ?>
            </div>

            <div class="row-fluid">
                <? include(system_getFrontendPath("featured_promotion.php", "frontend", false, PROMOTION_EDIRECTORY_ROOT)); ?>
            </div>
            
            <div class="row-fluid">
                <div class="span6">
                    <? include(system_getFrontendPath("featured_classified.php", "frontend", false, CLASSIFIED_EDIRECTORY_ROOT)); ?>
                </div>
                <div class="span6">
                    <? include(system_getFrontendPath("featured_article.php", "frontend", false, ARTICLE_EDIRECTORY_ROOT)); ?>
                </div>
            </div>
 
        </div>
        
        <div class="span4">
            
            <? include(system_getFrontendPath("featured_review.php")); ?>
            
            <div class="row-fluid">
                <? include(system_getFrontendPath("event_calendar.php")); ?>
            </div>
            
            <? include(system_getFrontendPath("twitter.php")); ?>

        </div>
        
    </div>

    <? include(system_getFrontendPath("sitecontent_bottom.php")); ?>