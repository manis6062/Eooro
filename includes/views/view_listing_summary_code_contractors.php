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
	# * FILE: /includes/views/view_listing_summary_code_contractors.php
	# ----------------------------------------------------------------------------------------------------

	if (is_array($listing)) {
		$aux = $listing;
	} else if (is_object($listing)) {
		$aux = $listing->listing_array;
	}

	if ($listingtemplate_friendly_url) { ?>
		<a name="<?=$listingtemplate_friendly_url;?>"></a>
	<? } ?>
    
    <div <?=$listing["id"] ? "id=\"summary_map_content_".$listing["id"]."\"" : ""?>>
        
        <div <?=$listing["id"] ? "id=\"listing_summary_".$listing["id"]."\"" : ""?> class="summary-small <?=$listing["backlink"] == "y" && BACKLINK_FEATURE == "on" ? "summary summary-backlink" : "summary" ?>">
            
            <section>
                
                <div class="row-fluid title">

                    <div class="<?=($listing_deal ? "span10" : "span12")?>" >
                        <h3>
                            <?=$listingtemplate_title?>
                        </h3>

                        <? if ($listingtemplate_complementaryinfo) { ?>
                            <p <?=($listing["id"] ? "id=\"showCategory_".$listing["id"]."\"" : "")?>><?=$listingtemplate_complementaryinfo?></p>
                        <? } ?>
                    </div>

                    <? if ($listing_deal) { ?>

                        <div class="listing-tag-deal">
                            <div class="name-tag-deal">
                                <a href="<?=$listing_deal_link;?>" <?=$listing_deal_link_style;?>><?=system_showText(LANG_PROMOTION_FEATURE_NAME);?></a>
                            </div>
                        </div>

                    <? } ?>

                </div>

                <div class="media">

                    <div class="row-fluid">

                        <? if ($listingtemplate_description) { ?>
                            <p><?=$listingtemplate_description?></p>
                        <? } ?>

                    </div>

                    <div class="media-body">

                        <div class="row-fluid info">

                        <? if ($listingtemplate_image) { ?>

                            <div class="span4">
                                <div class="summary-image">
                                    <?=$listingtemplate_image;?>
                                </div>
                            </div>

                            <? } ?>                    

                            <div class="<?=(!$listingtemplate_image ? "span12" : "span8")?>">

                                <? if ($listingtemplate_designations) { ?>
                                <div class="pull-right">
                                    <?=$listingtemplate_designations?>
                                </div>
                                <? } ?>
                                
                                <div class="summary-address">
                                <? if (($listingtemplate_address) || ($listingtemplate_address2) || ($listingtemplate_location)) echo "<address>\n"; ?>

                                <? if ($listingtemplate_address) { ?>
                                    <span><?=$listingtemplate_address?></span>
                                <? } ?>

                                <? if ($listingtemplate_address2) { ?>
                                    <p><small><?=$listingtemplate_address2?></small></p>
                                <? } ?>

                                <? if ($listingtemplate_location) { ?>
                                    <p><small><?=$listingtemplate_location?></small></p>
                                <? } ?>

                                <? if (($listingtemplate_address) || ($listingtemplate_address2) || ($listingtemplate_location)) echo "\n</address>\n"; ?>
                                </div> 

                                <div class="summary-contact <?=(($listingtemplate_designations) ? "span9" : "span12" )?>">
                                    
                                    <? if ($listingtemplate_url) { ?>
                                    <div>
                                        <?=$listingtemplate_url?>
                                    </div>
                                    <? } ?>
                                    
                                    <?  if (($listingtemplate_phone) || ($listingtemplate_fax)) { ?>
                                    <div class="<?=($listingtemplate_url ? "text-right" : "")?>">
                                        <? if ($listingtemplate_phone) { ?>
                                            <p><?=$listingtemplate_phone?></p>
                                        <? } ?>
                                        <? if ($listingtemplate_fax) { ?>
                                            <p><?=$listingtemplate_fax?></p>
                                        <? } ?>                                    
                                    </div>
                                    <? } ?>
                                </div>

                            </div>

                        </div>

                        <? if ($listingtemplate_claim) { ?>

                            <p class="claim">
                                <?=$listingtemplate_claim?>
                            </p>

                        <? } ?>

                    </div>

                </div>
                
            </section>
            
            <div class="row-fluid line-footer">

                <div class="span9 review">

                    <? if ($listingtemplate_review) { ?>
                        <?=$listingtemplate_review?>
                    <? } ?>

                    <? if ($listingtemplate_email) { ?>
                        <?=($listingtemplate_review ? " <b>|</b> " : "").$listingtemplate_email?>
                    <? } ?>

                    <? if ($listingtemplate_checkin) { ?>
                        <?=($listingtemplate_review || $listingtemplate_email ? " <b>|</b> " : "").$listingtemplate_checkin?>
                    <? } ?>

                </div>

                <div class="icons text-right">

                    <? if ($listingtemplate_twilioSMS) { ?>
                        <span class="button-send"><a rel="nofollow" href="<?=$listingtemplate_twilioSMS?>" <?=$twilioSMS_style?>><img src="<?=DEFAULT_URL?>/images/icon-send-phone.png" title="<?=system_showText(LANG_LABEL_SENDPHONE);?>"/></a></span>
                    <? } ?>

                    <? if ($listingtemplate_twilioCall) { ?>
                        <span class="button-call"><a rel="nofollow" href="<?=$listingtemplate_twilioCall?>" <?=$twilioCall_style?>><img src="<?=DEFAULT_URL?>/images/icon-call-phone.png" title="<?=system_showText(LANG_LABEL_CLICKTOCALL);?>"/></a></span>
                    <? } ?>
                    
                </div>

            </div>

        </div>
        
    </div>
	
	<? unset($aux); ?>