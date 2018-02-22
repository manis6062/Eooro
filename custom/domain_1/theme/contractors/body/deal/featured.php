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
	# * FILE: /theme/contractors/body/deal/featured.php
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
	
	if (is_array($array_show_promotions)) { ?>
    
        <div class="row-fluid flex-box-title">
            <h2>
                <?=system_showText(LANG_FEATURED_PROMOTION);?>

                <? if (PROMOTION_SCALABILITY_OPTIMIZATION != "on") { ?>                       
                    <a class="view-more" href="<?=PROMOTION_DEFAULT_URL."/results.php"?>"><?=system_showText(LANG_LABEL_VIEW_ALL_PROMOTIONS);?> »</a>
                <? } ?>

            </h2>
        </div>
    
    <?

        $countSpecialItem = 0;
        $lastItemStyle = 0;
        $countRowFluid = 0;
        
        for ($i = 0; $i < count($array_show_promotions); $i++) {

            $lastItemStyle++;

            if ($countSpecialItem < $specialItem) { ?>
                
            <div class="row-fluid">
                        
                <div class="flex-box flex-box-dashed row-fluid">
                    
                    <div class="row-fluid">
                        
                        <aside>
                            <a href="<?=$array_show_promotions[$i]["detailLink"]?>">

                                <div class="tag">
                                    <?=$array_show_promotions[$i]["offer"];?>
                                </div>

                                <? if ($array_show_promotions[$i]["image_tag"]) { ?>
                                    <?=$array_show_promotions[$i]["image_tag"]?>
                                <? } else { ?>
                                    <span class="no-image"></span>
                                <? } ?>
                            </a>
                        </aside>

                        <section>

                            <h5>
                                <a href="<?=$array_show_promotions[$i]["detailLink"]?>">
                                    <?=$array_show_promotions[$i]["title"]?>
                                </a>
                            </h5>

                            <p>
                                <a href="<?=$array_show_promotions[$i]["listing_link"]?>" class="text-info">
                                <?=$array_show_promotions[$i]["listing_title"]?>
                                </a>
                            </p>

                            <em><?=(is_numeric($array_show_promotions[$i]["realvalue"]) ? CURRENCY_SYMBOL." " : "").$array_show_promotions[$i]["realvalue"];?></em>

                            <span class="text-warning"><?=(is_numeric($array_show_promotions[$i]["deal_price"]) ? CURRENCY_SYMBOL." " : "").$array_show_promotions[$i]["deal_price"].$array_show_promotions[$i]["deal_cents"];?></span>

                            <p><?=$array_show_promotions[$i]["categories"]?></p>

                        </section>

                    </div>
                    
                </div>

            </div>

            <?

                $countSpecialItem++;

            } else {
                
                $countRowFluid++;

                 if ($lastItemStyle == ($countSpecialItem + 1) || $countRowFluid == 3) { $countRowFluid = 1; ?>

                <div class="row-fluid">

                <? } ?>

                    <div class="span6 flex-box-dashed">
                        
                        <a href="<?=$array_show_promotions[$i]["detailLink"]?>">
                            
                            <div class="tag">
                              <?=$array_show_promotions[$i]["offer"];?>
                            </div>

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

                             <p>
                                <a href="<?=$array_show_promotions[$i]["listing_link"]?>" class="text-info">
                                    <?=$array_show_promotions[$i]["listing_title"]?>
                                </a>
                            </p>

                            <em><?=(is_numeric($array_show_promotions[$i]["realvalue"]) ? CURRENCY_SYMBOL." " : "").$array_show_promotions[$i]["realvalue"];?></em>
                            <span class="text-warning"><?=(is_numeric($array_show_promotions[$i]["deal_price"]) ? CURRENCY_SYMBOL." " : "").$array_show_promotions[$i]["deal_price"].$array_show_promotions[$i]["deal_cents"];?></span> 

                        </section>
                        
                    </div>
                    
                <? if ($lastItemStyle >= count($array_show_promotions) || $lastItemStyle == $numberOfPromotions || $countRowFluid == 2) { ?>

                </div>

                <? }
            }
        }
    } 
    // Preparing markers to Full Cache
?>
	<!--cachemarkerFeaturedDeal2-->