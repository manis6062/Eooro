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

	<!--cachemarkerBannerBottom-->
	<?
    $bannerCategory_id = ($_GET["categories"] && !$category_id ? $_GET["categories"] : $category_id);
    if ($cacheFullBanner) {
        front_getBannerInfo($bannerCategory_id, $banner_section);
    }

	$banner_left = system_showBanner("BOTTOM", $bannerCategory_id, $banner_section);
    $banner_right = system_showBanner("SPONSORED_LINKS", $bannerCategory_id, $banner_section);
    
    $gAdsFooter = true;
    include(system_getFrontendPath("googleads.php"));
    
	if ($banner_left || $banner_right || $scriptGAds) { ?>
    
		<div class="advertisement advertisement-bottom">
            
			<div class="banner">
                
                <? if ($banner_left) { ?>
                <div class="banner-left">
                    <?=$banner_left;?>
                </div>
                <? } ?>
                
                <? if ($scriptGAds) { ?>
                <div class="banner-google">
                    <?=$scriptGAds;?>
                </div>
                <? } ?>
                
                <? if ($banner_right) { ?>
                <div class="banner-sponsor">
                    <?=$banner_right;?>
                </div>
                <? } ?>
                
            </div>
            
		</div>
	<? }

	// Preparing markers to full cache
	?>
	<!--cachemarkerBannerBottom-->