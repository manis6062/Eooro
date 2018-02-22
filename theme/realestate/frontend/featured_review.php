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
	# * FILE: /theme/realestate/frontend/featured_review.php
	# ----------------------------------------------------------------------------------------------------

    # ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
    include(EDIRECTORY_ROOT."/includes/code/featured_review.php");

    if (is_array($featuredReviews) && count($featuredReviews) > 0) { ?>
        
        <h2><span><?=system_showText(LANG_RECENT_REVIEWS)?></span></h2>
        
        <div class="featured featured-review">
            
            <? foreach ($featuredReviews as $featureReview) { ?>
            
                <div class="featured-item <?=$featureReview["style"]?>">
                    
                    <? if ($featureReview["image"]) { ?>
                    <div class="image">
                        <?=$featureReview["image"]?>
					</div>
                    <? } ?>
                    
                    <div class="featured-review-text">
                    
                        <h3><a href="<?=$featureReview["detailItemLink"]?>"><?=$featureReview["title"]?></a></h3>

                        <div class="rate">
                            <?=$featureReview["stars"]?>
                        </div>

                        <a href="<?=$featureReview["detailLink"]?>"><?=system_showText(LANG_READMORE)?></a>

                        <div class="info">
                            <p class="date"><?=$featureReview["date"]?></p>
                            <p><?=system_showText(LANG_BY)." ".$featureReview["reviewer_name"]?></p>
                            <p><?=$featureReview["reviewer_location"]?></p>
                        </div>
                        
                        <p class="review-text"><?=$featureReview["review"]?></p>
                    
                    </div>
                    
                </div>
            
            <? } ?>
            
        </div>

    <? } ?>