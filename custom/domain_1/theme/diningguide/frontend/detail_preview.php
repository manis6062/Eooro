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
	# * FILE: /theme/diningguide/frontend/detail_preview.php
	# ----------------------------------------------------------------------------------------------------

?>

    <div class="content">
        <?
        ${"signUp".ucfirst($signUpItem)} = true;
        include(INCLUDES_DIR."/views/view_{$signUpItem}_detail.php");
        ?>
    </div>

    <? if ($signUpItem != "promotion") { ?>

    <div class="sidebar">
        
        <?
        if ($signUpItem == "listing") {
                   
            $signUpListing = true;
            include(system_getFrontendPath("detail_maps.php", "frontend", false, LISTING_EDIRECTORY_ROOT));
            
            $signUpListing = true;
            include(system_getFrontendPath("detail_socialbuttons.php", "frontend", false, LISTING_EDIRECTORY_ROOT));
            
            $signUpListing = true;
            include(system_getFrontendPath("detail_fanpage.php", "frontend", false, LISTING_EDIRECTORY_ROOT));
            
            $signUpListing = true;
            include(system_getFrontendPath("detail_fbcomments.php", "frontend", false, LISTING_EDIRECTORY_ROOT));
            
            $signUpListing = true;
            include(system_getFrontendPath("detail_checkin.php", "frontend", false, LISTING_EDIRECTORY_ROOT));
            $signUpListing = false;
            
            
        } elseif ($signUpItem == "article") {
                       
            $signUpArticle = true;
            include(system_getFrontendPath("detail_fbcomments.php", "frontend", false, ARTICLE_EDIRECTORY_ROOT));
            
            $signUpArticle = true;
            include(system_getFrontendPath("detail_socialbuttons.php", "frontend", false, ARTICLE_EDIRECTORY_ROOT));
        
        } elseif ($signUpItem == "classified") {
            
            $signUpClassified = true;
            include(system_getFrontendPath("detail_maps.php", "frontend", false, CLASSIFIED_EDIRECTORY_ROOT));
            
            $signUpClassified = true;
            include(system_getFrontendPath("detail_socialbuttons.php", "frontend", false, CLASSIFIED_EDIRECTORY_ROOT));
            
        } elseif ($signUpItem == "event") {
                    
            $signUpEvent = true;
            include(system_getFrontendPath("detail_maps.php", "frontend", false, EVENT_EDIRECTORY_ROOT));
            
            $signUpEvent = true;
            include(system_getFrontendPath("detail_socialbuttons.php", "frontend", false, EVENT_EDIRECTORY_ROOT));
        
        }
        ?>
        
    </div>

    <? } ?>