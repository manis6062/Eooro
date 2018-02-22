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
	# * FILE: /theme/default/body/deal/featured.php
	# ----------------------------------------------------------------------------------------------------

	// Preparing markers to Full Cache
	?>
	<!--cachemarkerFeaturedDeal2-->
	<?

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
    $getListingCateg = true;
    include(EDIRECTORY_ROOT."/includes/code/featured_promotion.php");
	
	if (is_array($array_show_promotions)) {

        $countSpecialItem = 0;
        $lastItemStyle = 0;
        $countRowFluid = 0;
        
        for ($i = 0; $i < count($array_show_promotions); $i++) {

            $lastItemStyle++;

            if ($countSpecialItem < $specialItem) { ?>
                
            <div class="row-fluid">
                        
                <div class="span12 flex-box color-1">
                    
                    <h2>
                        <?=system_showText(LANG_FEATURED_PROMOTION_SING);?>
                        <span><?=(is_numeric($array_show_promotions[$i]["deal_price"]) ? CURRENCY_SYMBOL : "").$array_show_promotions[$i]["deal_price"].$array_show_promotions[$i]["deal_cents"];?> <b class="divisor"></b><?=$array_show_promotions[$i]["offer"]." ".system_showText(LANG_DEAL_OFF);?></span>
                    </h2>
                    
            		<div class="row-fluid">
                        
	            		<div class="span12 row-fluid">
                            
		            		<aside class="span8">
                                
		            			<a href="<?=$array_show_promotions[$i]["detailLink"]?>">
                                    <? if ($array_show_promotions[$i]["image_tag"]) { ?>
                                        <?=$array_show_promotions[$i]["image_tag"]?>
                                    <? } else { ?>
                                        <span class="no-image"></span>
                                    <? } ?>                               
    		            			<span>
                                        <h4><?=$array_show_promotions[$i]["title"]?></h4>
                                    </span>
                                </a>

		            		</aside>
                            
		            		<section>
                                
		            			<h5>
                                    <a href="<?=$array_show_promotions[$i]["detailLink"]?>">
                                        <?=$array_show_promotions[$i]["listing_title"]?>
                                    </a>
                                </h5>
                                
		            			<p><?=$array_show_promotions[$i]["description"]?></p>
                                
		            			<footer>
		            				<p><?=$array_show_promotions[$i]["categories"]?></p>
		            			</footer>
                                
		            		</section>
                            
	            		</div>
                        
            		</div>

                </div>

            </div>

            <?

                $countSpecialItem++;

            } else {
                
                $countRowFluid++;

                 if ($lastItemStyle == ($countSpecialItem + 1) || $countRowFluid == 4) { $countRowFluid = 1; ?>

                <div class="row-fluid">

                <? } ?>

                    <div class="span4 flex-box color-1">
                        <h2>
                            <?=system_showText(LANG_FEATURED_PROMOTION_SING);?>
                            <span><?=(is_numeric($array_show_promotions[$i]["deal_price"]) ? CURRENCY_SYMBOL : "").$array_show_promotions[$i]["deal_price"].$array_show_promotions[$i]["deal_cents"];?></span>
                        </h2>
                        
                        <a href="<?=$array_show_promotions[$i]["detailLink"]?>">
                            <? if ($array_show_promotions[$i]["image_tag"]) { ?>
                                <?=$array_show_promotions[$i]["image_tag"]?>
                            <? } else { ?>
                                <span class="no-image"></span>
                            <? } ?>
                        </a>
                        
                        <section>
                            <h5>
                                <a href="<?=$array_show_promotions[$i]["detailLink"]?>">
                                    <?=$array_show_promotions[$i]["title"]?>
                                </a>
                            </h5>
                            <p><?=$array_show_promotions[$i]["description"]?></p>
                        </section>
                    </div>
                    
                <? if ($lastItemStyle >= count($array_show_promotions) || $lastItemStyle == $numberOfPromotions || $countRowFluid == 3) { ?>

                </div>

                <? }
                }
        }
    } 
    // Preparing markers to Full Cache
?>
	<!--cachemarkerFeaturedDeal2-->