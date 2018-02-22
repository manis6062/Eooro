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
	# * FILE: /theme/default/body/deal/index.php
	# ----------------------------------------------------------------------------------------------------
           
    include(system_getFrontendPath("sitecontent_top.php"));
    
?>

    <div class="row-fluid span12">   

        <div class="span9">
            
            <? include(system_getFrontendPath("featured.php", "body/deal", false, PROMOTION_EDIRECTORY_ROOT)); ?>
            
            <div class="row-fluid">
                
                <div class="span12">
                    
                    <? include(system_getFrontendPath("featured_review.php")); ?>
                    
                </div>
                
            </div>

        </div>

        <div class="span3">
                
            <div class="row-fluid">
                <? include(system_getFrontendPath("top_categories.php", "frontend", false, PROMOTION_EDIRECTORY_ROOT)); ?>
            </div>

            <div class="row-fluid">
                <? include(system_getFrontendPath("top_locations.php", "frontend", false, PROMOTION_EDIRECTORY_ROOT)); ?>
            </div>
            
            <? if (PROMOTION_SCALABILITY_OPTIMIZATION != "on") { ?>

                <div class="row-fluid visible-desktop">
                    <a class="btn span12 btn-success" href="<?=PROMOTION_DEFAULT_URL."/results.php"?>">
                        <?=system_showText(LANG_LABEL_VIEW_ALL_PROMOTIONS);?>
                    </a>
                </div>

            <? } ?>
           
        </div>

    </div>

    <? include(system_getFrontendPath("sitecontent_bottom.php")); ?>