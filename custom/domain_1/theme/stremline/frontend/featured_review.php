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
	# * FILE: /frontend/featured_review.php
	# ----------------------------------------------------------------------------------------------------

    # ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
    $numberOfReviews = 4;
    $randomReview    = true;
    include(EDIRECTORY_ROOT."/includes/code/featured_review.php");

    if (is_array($featuredReviews) && count($featuredReviews) > 0) { ?>

        <div class="stremline-review review-container">
        
            <h2><?=system_showText(LANG_RECENT_REVIEWS)?></h2>


            <? foreach ($featuredReviews as $featureReview) { ?>
                
                <section class="item-preview">
                    <div class="image round-image" style="background: url(<?=getImageUrl( $featureReview );?>) no-repeat center"></div>
                    
                    <b><?=$featureReview["reviewer_name"];?></b>
                    <h5>
                        <small>rated and reviewed </small><a href="<?=$featureReview["detailItemLink"]?>"><?=$featureReview["title"]?></a>
                        
                    </h5>
                    <div class="stars-rating"><div class="rate-<?=$featureReview["avg_review"]?>"></div></div>
                    <br clear="all"/>
                    <div>
                        <p><?=$featureReview["review"]?></p>
                    </div>

                </section>

            <? } ?>
          
        </div>

    <? } ?>