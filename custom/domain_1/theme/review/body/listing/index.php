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
	# * FILE: /theme/default/body/listing/index.php
	# ----------------------------------------------------------------------------------------------------    
    $thePageTitle = '<h1 class="transparent-bg">Recent Reviews</h1>';
    include(system_getFrontendPath("review_banner.php"));
    include(system_getFrontendPath("sitecontent_top.php"));
    
?>
<section class="latest-review cusreview">
<div class="container">
    <div class="row-fluid span12">   
        
        <div class="span12">
            
            <? include(system_getFrontendPath("featured.php", "body/listing", false, LISTING_EDIRECTORY_ROOT)); ?>
            
            <?// include(system_getFrontendPath("featured_listing_deal.php", "body/listing", false, LISTING_EDIRECTORY_ROOT)); ?>
            <!--<div class="row-fluid">
                <?// include(system_getFrontendPath("top_categories.php", "frontend", false, LISTING_EDIRECTORY_ROOT)); ?>
            </div>
            <div class="row-fluid">
            <?// include(system_getFrontendPath("top_locations.php", "frontend", false, LISTING_EDIRECTORY_ROOT)); ?>
            </div>
            -->
            <div class="row-fluid">

                <div class="span12">

                    <? //include(system_getFrontendPath("featured_review.php")); ?>

                </div>
                
            </div>

        </div>

        <div class="span3">
            <!--
            <div class="row-fluid">
                <?// include(system_getFrontendPath("top_categories.php", "frontend", false, LISTING_EDIRECTORY_ROOT)); ?>
            </div>
            
            <div class="row-fluid">
                <?// include(system_getFrontendPath("top_locations.php", "frontend", false, LISTING_EDIRECTORY_ROOT)); ?>
            </div>     
            -->
            <? if (LISTING_SCALABILITY_OPTIMIZATION != "on") { ?>
            
                <div class="row-fluid visible-desktop">
                    <a class="btn span12 btn-success" rel="canonical" href="<?=LISTING_DEFAULT_URL."/results.php"?>"><?=system_showText(LANG_LABEL_VIEW_ALL_LISTINGS);?></a>
                </div>
            
            <? } ?>
            
        </div>
        
    </div>
</div>
</section>
   

    <? include(system_getFrontendPath("sitecontent_bottom.php")); ?>