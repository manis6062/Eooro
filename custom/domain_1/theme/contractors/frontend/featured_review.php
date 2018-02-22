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
    $fullReview = true;    
    include(EDIRECTORY_ROOT."/includes/code/featured_review.php");

    if (is_array($featuredReviews) && count($featuredReviews) > 0) {
        
        if ($activeMenuHome) { ?>

        <div class="row-fluid flex-box-group">
        	
            <? if ($front_review_counter == "on") { ?>
            
        	<section class="span3 total-reviews">
        		<h1>
        			<?=$totalReviews;?>
        			<small><?=system_showText(LANG_LABEL_LISTING_REVIEW);?></small>
        		</h1>
        	</section>

            <div class="span9 reviewcounter">
            <? }
            
            foreach ($featuredReviews as $featureReview) { ?>

                <section class="featured-item-preview">
                    <h5><a href="<?=$featureReview["detailItemLink"]?>"><?=$featureReview["title"]?></a></h5>                    
                    <p>"<?=$featureReview["review"]?>"</p>
                    <div class="stars-rating"><div class="rate-<?=$featureReview["avg_review"]?>"></div></div>
                    <b><?=$featureReview["reviewer_name"].($featureReview["reviewer_location"] ? ", ".$featureReview["reviewer_location"] : "");?></b>
                    <time><?=$featureReview["date_notime"]?></time>
                </section>

            <? } ?>


             <? if ($front_review_counter == "on") { ?>
                </div>
            <? } ?>

        </div>
            
        <? } else { ?>

        <div class="flex-box-group flex-box-underline">
                
            <h2><?=system_showText(LANG_RECENT_REVIEWS)?></h2>

            <? foreach ($featuredReviews as $featureReview) { ?>

                <section class="item-preview featured-item-preview">
                    <h5><a href="<?=$featureReview["detailItemLink"]?>"><?=$featureReview["title"]?></a></h5>
                    <p>"<?=$featureReview["review"]?>"</p>
                    <div class="stars-rating"><div class="rate-<?=$featureReview["avg_review"]?>"></div></div>
                    <b><?=$featureReview["reviewer_name"];?></b>
                    <time><?=$featureReview["date_notime"]?></time>
                </section>


            <? } ?>

        </div>
            
        <? } ?>

    <? } ?>