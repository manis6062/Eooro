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
	# * FILE: /includes/views/view_promotion_summary_code_contractors.php
	# ----------------------------------------------------------------------------------------------------

?>
	<a name="<?=$friendly_url;?>"></a>
    
    <div id="summary_map_content_<?=$promotion->getNumber("id");?>">
	
        <div class="summary summary-deal summary-small">

        	<section>

                <div class="row-fluid title">

                    <div class="span8">
                        <h3>
                            <a href="<?=$promotionLink?>" <?=$promotionStyle?> title="<?=$promotion->getString("name")?>"><?=$promotion->getString("name", true, false).$promotionDistance?></a>
                        </h3>
                        <? if ($listingTitle) { ?>
                            <p><?=system_showText(LANG_BY)?> <a href="<?=$listing_link?>" <?=$promotionStyle?> title="<?=string_htmlentities($listingTitle)?>"><?=$listingTitle?></a></p>
                        <? } ?>
                    </div>

                    <? if ($sold_out) { ?>

                        <div class="deal-tag-small">
                            <div class="name-tag-deal soldout"><?=system_showText(DEAL_SOLDOUT);?></div>
                        </div>

                    <? } else { ?>

                        <div class="deal-tag-small">
                            <div class="name-tag-deal">
                                <?=(is_numeric($deal_price) && $deal_price > 0 ? CURRENCY_SYMBOL." ".$deal_price.($deal_cents ? "<span class=\"cents\">".$deal_cents."</span>" : "") : system_showText(LANG_FREE));?>                            
                                <b class="divisor"></b>
                                <?=$offer." ".system_showText(LANG_DEAL_OFF);?>
                            </div>
                        </div>

                    <? } ?>

                </div>
            
                <div class="media-body">
                    
                    <div class="row-fluid info">

                        <div class="span4">
                            <div class="summary-image">
                                <?=$imageTag;?>
                            </div>
                        </div>

                        <div class="span8">
	                        <? if ($promotion_desc) { ?>
	                           <p><?=$promotion_desc;?></p>
	                        <? } ?>
                        </div>

               		</div>

                </div>

			</section>

            <div class="row-fluid  line-footer">

                <div class="span12 review">
                    <?=$promotion_review;?>                    
                </div>

            </div>

        </div>
        
    </div>