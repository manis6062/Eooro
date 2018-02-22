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
	# * FILE: /theme/realestate/frontend/related_listings.php
	# ----------------------------------------------------------------------------------------------------

    $maxRelated = 2;
    include(EDIRECTORY_ROOT."/includes/code/related_listings.php");
    
    if (is_array($arrayRelated) && count($arrayRelated) > 0) {
?>
    <h2 class="related-listings"><?=system_showText(LANG_RELATEDLISTINGS);?></h2>

	<div class="listing-ads featured">
        
        <ul class="thumbnails">

        <? foreach ($arrayRelated as $related_listing) { ?>
        
            <li class="featured-item <?=$related_listing["class"]?>">

                <div class="image">                    
                    <a href="<?=$related_listing["detailLink"]?>">
                        <? if ($related_listing["image_tag"]) { ?>
                            <?=$related_listing["image_tag"]?>
                        <? } else { ?>
                            <span class="no-image"></span>
                        <? } ?>
                    </a>
                </div>
                
                <? if ($related_listing["review_link"]) { ?>
                
                <div class="review">
                    <div class="rate">
                        <div class="rate-stars">

                            <? for ($k = 0; $k < $related_listing["avg_review"]; $k++) { ?>
                                <a href="javascript:void(0);" style="cursor: default;" class="star-rating">
                                    <img src="<?=THEMEFILE_URL."/".EDIR_THEME."/images/iconography/img_rateMiniStarOn.png"?>" alt="Star On" />
                                </a>
                            <? } ?>
                            
                            <? for ($j = $k; $j < 5; $j++) { ?>
                                <a href="javascript:void(0);" style="cursor: default;" class="star-rating">
                                    <img src="<?=THEMEFILE_URL."/".EDIR_THEME."/images/iconography/img_rateMiniStarOff.png"?>" alt="Star On" />
                                </a>
                            <? } ?>

                            <span><a href="<?=$related_listing["review_link"];?>">(<?=$related_listing["total_reviews"];?>)</a></span>
                        </div>
                    </div>
                </div>
                
                <? } ?>

                <div class="title">
                    <h3>
                        <a href="<?=$related_listing["detailLink"]?>"><?=$related_listing["title"];?></a>
                    </h3>
                </div>

                <? if ($related_listing["description"]) { ?>
                    <p><?=$related_listing["description"];?></p>
                <? } ?>

            </li>
        
        <? } ?>
            
        </ul>
		
    </div>

    <? } ?>