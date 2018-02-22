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
	# * FILE: /theme/default/frontend/related_listings.php
	# ----------------------------------------------------------------------------------------------------

    include(EDIRECTORY_ROOT."/includes/code/related_listings.php");
    
    if (is_array($arrayRelated) && count($arrayRelated) > 0) {
?>
    <h2 class="related-listings"><?=system_showText(LANG_RELATEDLISTINGS);?></h2>

	<div class="row-fluid rel-listings">

        <? foreach ($arrayRelated as $related_listing) { ?>
        
    	<div class="span4 flex-box color-4">
            
    		<h2><?=$related_listing["title"];?></h2>
                        
            <a class="image" href="<?=$related_listing["detailLink"]?>">
                <? if ($related_listing["image_tag"]) { ?>
                    <?=$related_listing["image_tag"]?>
                <? } else { ?>
                    <span class="no-image"></span>
                <? } ?>
            </a>
            
    		<section>
                
                <? if ($related_listing["description"]) { ?>
                    <p><?=$related_listing["description"];?></p>
                <? } ?>
                    
                <? if ($related_listing["avg_review"] > 0) { ?>
                    
                    <div class="rate">
                        <div class="rate-stars">
                            <div class="stars-rating ">
                                <div class="rate-<?=$related_listing["avg_review"]?>"></div>
                            </div>
                            <a class="review-count pull-right" href="<?=$related_listing["review_link"];?>"><?=$related_listing["total_reviews"];?></a>
                        </div>
                    </div>
                    
                <? } ?>
                    
    		</section>
            
    	</div>
        
        <? } ?>
		
    </div>

    <? } ?>