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
	# * FILE: /includes/views/view_promotion_summary_code_diningguide.php
	# ----------------------------------------------------------------------------------------------------

?>
	<a name="<?=$friendly_url;?>"></a>
    
    <div id="summary_map_content_<?=$promotion->getNumber("id");?>">
	
        <div class="summary summary-deal summary-small">

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
                            <?=$offer." ".OFF?>
                            <br /><small><?=CURRENCY_SYMBOL.$deal_price.($deal_cents ? "<span class=\"cents\">".$deal_cents."</span>" : "");?></small>
                        </div>
                    </div>
                <? } ?>

            </div>

            <div class="media">

                    <div class="row-fluid">
                        <? if ($promotion_desc) { ?>
                            <p><?=$promotion_desc;?></p>
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

                            <div class="summary-infodetail">
                                <? if (($listingtemplate_address) || ($listingtemplate_address2) || ($listingtemplate_location)) echo "<address>\n"; ?>

                                <? if ($listingtemplate_address) { ?>
                                    <span><?=$listingtemplate_address?></span>
                                <? } ?>

                                <? if ($listingtemplate_address2) { ?>
                                    <span><?=$listingtemplate_address2?></span>
                                <? } ?>

                                <? if ($listingtemplate_location) { ?>
                                    <span><?=$listingtemplate_location?></span>
                                <? } ?>

                                <? if (($listingtemplate_address) || ($listingtemplate_address2) || ($listingtemplate_location)) echo "\n</address>\n"; ?>		
                            </div>

                            <div class="summary-contact span12">
                                <? if ($listingtemplate_url) { ?>
                                    <div>
                                        <?=$listingtemplate_url?>
                                    </div>
                                <? } ?>
                                <? if ($listingtemplate_phone) { ?>
                                    <div class="text-right">
                                        <p><?=$listingtemplate_phone?></p>
                                    </div>
                                <? } ?>
                            </div>

                        </div>

                </div>

                </div>

            </div>

            <div class="row-fluid  line-footer">

                <div class="span9 review">

                    <?=$promotion_review;?>

                    <? if ($listingtemplate_email) { ?>
                        <?=($promotion_review ? " <b>|</b> " : "").$listingtemplate_email;?>
                    <? } ?>
                </div>

                <div class="text-right icons"> 
                    <div class="navicons"><?=$deal_icon_navbar;?></div>
                </div>

            </div>

        </div>
        
    </div>