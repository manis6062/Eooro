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
	# * FILE: /theme/diningguide/frontend/related_listings.php
	# ----------------------------------------------------------------------------------------------------

    include(EDIRECTORY_ROOT."/includes/code/related_listings.php");
    
    if (is_array($arrayRelated) && count($arrayRelated) > 0) {
?>
    <h2 class="related-listings"><?=system_showText(LANG_RELATEDLISTINGS);?></h2>

	<div class="row-fluid">
        
        <ul class="thumbnails listing-ads">

        <? foreach ($arrayRelated as $related_listing) { ?>
        
            <li class="span4">

                <div class="thumbnail">

                    <div class="image">                    
                        <a class="image" href="<?=$related_listing["detailLink"]?>">
                            <? if ($related_listing["image_tag"]) { ?>
                                <?=$related_listing["image_tag"]?>
                            <? } else { ?>
                                <span class="no-image"></span>
                            <? } ?>
                        </a>
                    </div>

                    <h3>
                        <a href="<?=$related_listing["detailLink"]?>"><?=$related_listing["title"];?></a>
                    </h3>

                    <div class="featured-body">

                        <? if ($related_listing["description"]) { ?>
                            <p><?=$related_listing["description"];?></p>
                        <? } ?>

                        <? if ($related_listing["avg_review"] > 0) { ?>

                            <div class="rate-stars">

                                <? for ($k = 0; $k < $related_listing["avg_review"]; $k++) { ?>
                                    <img src="<?=THEMEFILE_URL."/".EDIR_THEME."/images/iconography/img_rateMiniStarOn.png"?>" alt="Star On" />
                                <? } ?>

                                <a class="review-count" href="<?=$related_listing["review_link"];?>"><?=$related_listing["total_reviews"];?></a>
                            </div>

                        <? } ?>

                    </div>

                </div>

            </li>
        
        <? } ?>
            
        </ul>
		
    </div>

    <? } ?>