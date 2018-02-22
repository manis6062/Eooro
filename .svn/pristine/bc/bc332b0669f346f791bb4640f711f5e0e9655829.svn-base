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
	# * FILE: /theme/diningguide/body/deal/featured.php
	# ----------------------------------------------------------------------------------------------------

	// Preparing markers to Full Cache
	?>
	<!--cachemarkerFeaturedDeal2-->
	<?

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
    include(EDIRECTORY_ROOT."/includes/code/featured_promotion.php");
	
	if (is_array($array_show_promotions)) { ?>

		<h2>
			<span><?=system_showText(LANG_FEATURED_PROMOTION)?></span>
			<? if ($seeAllTextLink && $seeAllText) { ?>
				<a class="view-more" href="<?=$seeAllTextLink?>"><?=$seeAllText;?></a>
			<? } ?>
		</h2>
    
        <div class="special-deal">
            
            <div class="special-deal-border">
                
                <div class="left">
                    
                    <a href="<?=$array_show_promotions[0]["detailLink"]?>" class="image">
                        <div class="special-deal-tag">
                            <div class="deal-tag">
                                <div class="name-tag-deal"><?=$array_show_promotions[0]["offer"]." OFF"?></div>
                            </div>
                        </div>
                    
                        <? if ($array_show_promotions[0]["image_tag"]) { ?>
                            <?=$array_show_promotions[0]["image_tag"]?>
                        <? } else { ?>
                            <span class="no-image"></span>
                        <? } ?>
                    </a>
                </div>	
                
                <div class="right">
                    <h2>
                        <a href="<?=$array_show_promotions[0]["detailLink"]?>">
                            <?=$array_show_promotions[0]["title"]?>
                        </a>
                    </h2>
                    <p><?=$array_show_promotions[0]["description"]?></p>
                </div>
                
            </div>
            
        </div>
		
		<div class="featured featured-deal">
			
            <?
            $lastItemStyle = 0;
			for ($i = 1; $i < count($array_show_promotions); $i++) {
				
				$lastItemStyle++;
								
                if (($lastItemStyle % 2) && ($lastItemStyle != 1)) { ?>
                    <br class="clear" />
                <? } ?>

                <div class="featured-item featured-item-special">

                    <div class="<?=$priceClass?>">

                        <a href="<?=$array_show_promotions[$i]["detailLink"]?>" class="image">
                            <div class="featured-deal-tag">
                                <div class="deal-tag-small">
                                    <div class="name-tag-deal"><?=$array_show_promotions[$i]["offer"]." OFF"?></div>
                                </div>
                            </div>
                        
                            <? if ($array_show_promotions[$i]["image_tag"]) { ?>
                                <?=$array_show_promotions[$i]["image_tag"]?>
                            <? } else { ?>
                                <span class="no-image"></span>
                            <? } ?>
                        </a>

                       
                    </div>

                    <div class="<?=$contentClass?>">

                        <h3>
                            <a href="<?=$array_show_promotions[$i]["detailLink"]?>">
                                <?=$array_show_promotions[$i]["title"]?>
                            </a>
                        </h3>

                        <p><?=$array_show_promotions[$i]["description"]?></p>

                    </div>

                </div>

			<? } ?>
        </div>
<? } 
    // Preparing markers to Full Cache
?>
	<!--cachemarkerFeaturedDeal2-->