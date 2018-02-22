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
    include(EDIRECTORY_ROOT."/includes/code/featured_review.php");

    if (is_array($featuredReviews) && count($featuredReviews) > 0) { ?>
        
        <div class="flex-box-group color-4">
        
            <h2><?=system_showText(LANG_RECENT_REVIEWS)?></h2>


            <? foreach ($featuredReviews as $featureReview) { ?>

                <section class="item-preview">

                    <h5>
                        <a href="<?=$featureReview["detailItemLink"]?>"><?=$featureReview["title"]?></a>
                        <div class="stars-rating"><div class="rate-<?=$featureReview["avg_review"]?>"></div></div>
                    </h5>
                    
                    <p><?=$featureReview["review"]?></p>
                    
                    <b><?=$featureReview["reviewer_name"];?></b>

                </section>

            <? } ?>
          
        </div>

    <? } ?>