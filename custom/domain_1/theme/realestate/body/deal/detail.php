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
	# * FILE: /theme/realestate/body/deal/detail.php
	# ----------------------------------------------------------------------------------------------------

?>

	<div class="content-center">
    
        <div class="content">
        
            <div class="content-main">
                <? include(system_getFrontendPath("detailview.php", "frontend", false, PROMOTION_EDIRECTORY_ROOT)); ?>
            </div>
            <? include(system_getFrontendPath("banner_bottom.php")); ?>
            
        </div>
    
        <div class="sidebar">
            <? include(system_getFrontendPath("detail_info.php", "frontend", false, PROMOTION_EDIRECTORY_ROOT)); ?>
            <? include(system_getFrontendPath("detail_listing.php", "frontend", false, PROMOTION_EDIRECTORY_ROOT)); ?>
            <? include(system_getFrontendPath("detail_reviews.php", "frontend", false, PROMOTION_EDIRECTORY_ROOT)); ?>
            <? include(system_getFrontendPath("detail_fbcomments.php", "frontend", false, PROMOTION_EDIRECTORY_ROOT)); ?>
            <? include(system_getFrontendPath("banner_featured.php")); ?>
            <? include(system_getFrontendPath("banner_sponsoredlinks.php")); ?>
            <? include(system_getFrontendPath("googleads.php")); ?>
        </div>
        
	</div>