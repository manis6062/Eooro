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
	# * FILE: /theme/default/frontend/banner_top.php
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
                    
                    <p>
                        <a href="<?=((SSL_ENABLED == "on" && FORCE_MEMBERS_SSL == "on" && FORCE_ORDER_SSL == "on") ? SECURE_URL : NON_SECURE_URL)?>/order_banner.php?type=2">
                            <?=system_showText(LANG_DOYOUWANT_ADVERTISEWITHUS);?>
                        </a>
                    </p>
                    
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