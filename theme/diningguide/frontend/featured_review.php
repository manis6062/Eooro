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
	# * FILE: /theme/diningguide/frontend/featured_review.php
	# ----------------------------------------------------------------------------------------------------

    # ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
    include(EDIRECTORY_ROOT."/includes/code/featured_review.php");

    if (is_array($featuredReviews) && count($featuredReviews) > 0) { ?>
        
        <h2><?=system_showText(LANG_RECENT_REVIEWS)?></h2>
        
        <div class="featured-review">
            
            <? foreach ($featuredReviews as $featureReview) { ?>
            
                <div class="featured-item-review <?=$featureReview["style"]?>">
                    
                    <div class="info">
                        
                        <? if ($featureReview["image"]) { ?>
                        <div class="image">
                            <?=$featureReview["image"]?>
                        </div>
                        <? } ?>
                        
                        <h4><a href="<?=$featureReview["detailItemLink"]?>"><?=$featureReview["title"]?></a></h4>
                        
                        <div class="rate">
                            <?=$featureReview["stars"]?>
                        </div>
                        
                        <h5><?=$featureReview["reviewer_name"]?></h5>
                        <p><?=$featureReview["reviewer_location"]?></p>
                        <p><?=$featureReview["date"]?></p>
                        
                    </div>
                    
                    <p><?=$featureReview["review"]?></p>
                    
                    <p class="text-right"><a href="<?=$featureReview["detailLink"]?>"><?=system_showText(LANG_READMORE)?></a></p>
                    
                </div>
            
            <? } ?>
            
        </div>

    <? } ?>