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
	# * FILE: /theme/diningguide/frontend/banner_top.php
	# ----------------------------------------------------------------------------------------------------

	// Preparing markers to Full Cache
?>

	<!--cachemarkerBannerTop-->
	<?
    $bannerCategory_id = ($_GET["categories"] && !$category_id ? $_GET["categories"] : $category_id);
    if ($cacheFullBanner) {
        front_getBannerInfo($bannerCategory_id, $banner_section);
    }

	$banner_left    = system_showBanner("TOP", $bannerCategory_id, $banner_section);
	$banner_right   = system_showBanner("TOP_RIGHT", $bannerCategory_id, $banner_section);
    
	if ($banner_left || $banner_right) { ?>
    
		<div class="advertisement">
            
            <div class="banner">
                <div class="banner-left"><?=($banner_left ? $banner_left : "")?></div>
                <div class="banner-right"><?=($banner_right ? $banner_right : "")?></div> 
            </div>
            
		</div>
    
    <? } else { ?>
    
		<div class="advertisement-space"></div>
        
    <? }

	// Preparing markers to full cache
?>
	<!--cachemarkerBannerTop-->