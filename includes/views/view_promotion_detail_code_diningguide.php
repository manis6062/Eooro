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
	# * FILE: /includes/views/view_promotion_detail_code_diningguide.php
	# ----------------------------------------------------------------------------------------------------

?>
	<div class="row-fluid detail-deal" itemscope itemtype="http://schema.org/Product">
	
        <div class="span8">
            
            <div class="detail-deal-tag">
                <div class="deal-tag <?=($dealsDone ? "soldout" : "");?>">
                    <div class="name-tag-deal"><?=$deal_offer." OFF";?></div>
                </div>
            </div>
				
            <div class="image img-polaroid">
                <?=$imageTag;?>
            </div>

            <div class="description">
                
                <h1 class="hidden-desktop" itemprop="name"><?=$deal_name;?></h1>

                <? if ($deal_description) { ?>
                    <p><?=nl2br($deal_description);?></p>
                <? } ?>
                    
                <? if ($deal_summarydescription) { ?>
                    <meta itemprop="description" content="<?=$deal_summarydescription;?>" />
                <? } ?>

                <? if ($auxImgPath) { ?>
                    <meta itemprop="image" content="<?=$auxImgPath;?>" />
                <? } ?>
                    
            </div>
			
            <div class="row-fluid">
                
                <div class="minimap visible-desktop">
                    <? if ($listing_google_maps) { ?>
                        <div id="map" class="map">&nbsp;</div>
                        <?=$listing_google_maps?>
                    <? } ?>
                </div>
                
                <div class="span6" itemscope itemtype="http://schema.org/LocalBusiness">
                    
                    <h3>
                        <a href="<?=$listingDetailLink?>" <?=(!$user ? "style=\"cursor:default\"" : "")?>>
                            <?=$listing->getString('title')?>
                        </a>
                    </h3>
                    
                    <meta itemprop="name" content="<?=$listing->getString("title")?>" />
                    
                    <div class="review-stars visible-desktop">
                        <?=$listing_review;?>
                    </div>
                    
                    <? if ($listingtemplate_url) { ?>
                        <meta itemprop="url" content="<?=$listingtemplate_url_aux?>" />
                        <p><?=$listingtemplate_url?></p>
					<? } ?>
                    
                    <? if ($listingtemplate_email) { ?>
                        <p><?=$listingtemplate_email;?></p>
					<? } ?>
                        
                    <? if ($listingtemplate_phone) { ?>
                        <meta itemprop="telephone" content="<?=$listingtemplate_phone_aux;?>" />
                    <? } ?>
                    
                    <? if ($listingtemplate_address || $listingtemplate_address2 || $listingtemplate_location || $listingtemplate_phone || $map_link) echo "\n<address itemprop=\"address\" itemscope itemtype=\"http://schema.org/PostalAddress\">\n"; ?>
						
                        <? if ($listingtemplate_address) { ?>
                            <meta itemprop="streetAddress" content="<?=$listingtemplate_address?>" />
                            <?=$listingtemplate_address?><br />
						<? } ?>
                            
						<? if ($listingtemplate_address2) { ?>
                            <?=$listingtemplate_address2?><br />
						<? } ?>
                            
						<? if ($listingtemplate_location) { ?>
                            <?=$listingtemplate_location?><br />
						<? } ?>
                            
                        <? if ($listingtemplate_phone) { ?>
                            <?=$listingtemplate_phone?><br />
                        <? } ?>
                            
                        <? if ($map_link) { ?>
                            <a href="javascript: void(0);" <?=$map_link?> <?=$map_style?>><?=system_showText(LANG_EVENT_DRIVINGDIRECTIONS)?></a>
                        <? } ?>
                            
                        <? if (is_array($snippet_address) && count($snippet_address > 0)) { ?>
                        
                            <? if ($snippet_address["addressCountry"]) { ?>
                            <meta itemprop="addressCountry" content="<?=$snippet_address["addressCountry"]?>" />
                            <? } ?>
                            <? if ($snippet_address["addressRegion"]) { ?>
                            <meta itemprop="addressRegion" content="<?=$snippet_address["addressRegion"]?>" />
                            <? } ?>
                            <? if ($snippet_address["addressLocality"]) { ?>
                            <meta itemprop="addressLocality" content="<?=$snippet_address["addressLocality"]?>" />
                            <? } ?>
                            <? if ($snippet_address["postalCode"]) { ?>
                            <meta itemprop="postalCode" content="<?=$snippet_address["postalCode"]?>" />
                            <? } ?>

                        <? } ?>
                
                    <? if ($listingtemplate_address || $listingtemplate_address2 || $listingtemplate_location || $listingtemplate_phone || $map_link) echo "\n</address>\n"; ?>
                    
                </div>
                
            </div>
			
		</div>
		
        <div class="span4">
            
			<h1 class="visible-desktop"><?=$deal_name;?></h1>
	
			<div class="review-stars visible-desktop"  <?=$promotion_review && count($reviewsArr) > 0 ? "itemprop=\"aggregateRating\" itemscope itemtype=\"http://schema.org/AggregateRating\"" : ""?>>
                <?=$promotion_review?>
                
                <? if ($promotion_review && count($reviewsArr) > 0) { ?>
                    <meta itemprop="ratingValue" content="<?=$rate_avgDeal;?>" />
                    <meta itemprop="ratingCount" content="<?=count($reviewsArr);?>" />
                <? } ?>
			</div>
					
			<div class="action">
                
                <div class="deal-value" itemscope itemtype="http://schema.org/Offer">
                    <span><?=system_showText(DEAL_VALUE)?><strong><?=$deal_real_value;?></strong></span>
                    <span><?=system_showText(LANG_SITEMGR_DISCOUNT)?><strong> <?=$deal_offer;?></strong></span>
                    <span><?=system_showText(LANG_LABEL_PROMOTION_PAY)?><strong><?=$deal_value.($deal_cents ? $deal_cents : "")?></strong></span>
                    <meta itemprop="price" content="<?=$deal_value.($deal_cents ? $deal_cents : ".00");?>" />
                    <meta itemprop="priceCurrency" content="<?=PAYMENT_CURRENCY?>" />
                </div>

                <div class="facebookConnect hidden-phone">
                    <? 
                    if (!$dealsDone) {
                        if ($redeemLink) { ?>
                            <div <?=$buttomClass;?>>
                                <h2>
                                    <?
                                    $linkFBRedeem = "<a rel=\"nofollow\" href=\"".$redeemLink."\" ".(FACEBOOK_APP_ENABLED != "on" ? "class=\"$linkRedeemClass\"" : "")." $promotionStyle>".addslashes($buttonText)."</a>";
                                    ?>
                                    <script language="javascript" type="text/javascript">
                                        //<![CDATA[
                                        document.write('<?=$linkFBRedeem?>');
                                        //]]>
                                    </script>
                                </h2>
                            </div>
                        <? } ?>

                        <? if ($linkText) { ?>
                            <p class="redeem-option">
                                <a rel="nofollow" class="<?=$linkRedeemClass?>" href="<?=$redeemWFB;?>" <?=$promotionStyle?>><?=$linkText;?></a>
                            </p>
                        <? } ?>
                    <? } ?>

                    <? if ($_SESSION["ITEM_ACTION"] == "redeem" && $_SESSION["ITEM_TYPE"] && (is_numeric($_SESSION["ITEM_ID"]) && $_SESSION["ITEM_ID"] == htmlspecialchars($promotion->getNumber('id'))) && sess_isAccountLogged()) { ?>
                            
                        <a href="<?=$_SESSION["fb_deal_redirect"]? $_SESSION["fb_deal_redirect"]: $linkRedeem;?>" id="redeem_window" class="fancy_window_iframe" style="display:none"></a>
                        
                        <script type="text/javascript">
                            //<![CDATA[                               
                            $("a.fancy_window_iframe").fancybox({
                                width           : <?=FANCYBOX_DEAL_WIDTH?>,
                                height          : <?=FANCYBOX_DEAL_HEIGHT?>,
                                type            : 'iframe'
                            });

                            $(document).ready(function() {
                                $("#redeem_window").trigger('click');
                            });
                            //]]>
                        </script>
                        
                        <? unset($_SESSION["ITEM_ACTION"], $_SESSION["ITEM_TYPE"], $_SESSION["ITEM_ID"], $_SESSION["ACCOUNT_REDIRECT"], $_SESSION["fb_deal_redirect"]);
                    } ?>

                </div>

            </div>
				
			<div class="deal-timeleft">
                
                <? if (!$dealsDone) { ?>
                
                    <h5><i class="icon-time"></i> <?=system_showText(LANG_LABEL_PROMOTION_TIMELEFT);?></h5>

                    <h4 id="timeLeft"><?=(!$user ? "0 ".string_ucwords(system_showText(LANG_LABEL_DAYS))." 00:00:00" : "")?></h4>
                    
                <? } else { ?>
                    
                    <h4 class="deal-soldout"><?=system_showText(DEAL_SOLDOUT);?></h4>
                    
                <? } ?>

			</div>
			
			<div class="deal-dealsleft">
				<span><?=system_showText(LANG_LABEL_DEAL_LEFT);?>: <i id="updateDealsLeft"><?=$deal_left;?></i></span>
				<span><?=system_showText(LANG_LABEL_ACCOUNT_DEALS);?>: <i id="updateDeals"><?=$deal_sold;?></i></span>
			</div>
			
            <? include(system_getFrontendPath("detail_socialbuttons.php", "frontend", false, PROMOTION_EDIRECTORY_ROOT)); ?>
        
            <? if ($deal_conditions) { ?>
                <h6><?=($deal_name." - ".system_showText(LANG_LABEL_DEAL_CONDITIONS));?></h6>
                <p><?=nl2br($deal_conditions);?></p>
            <? } ?>
                
            <div class="visible-desktop">
                <? include(system_getFrontendPath("detail_fbcomments.php", "frontend", false, LISTING_EDIRECTORY_ROOT)); ?>
            </div>
		
		</div>
        
	</div>