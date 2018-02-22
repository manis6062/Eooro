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
	# * FILE: /includes/views/view_listing_detail_code_0_diningguide.php
	# ----------------------------------------------------------------------------------------------------

    include(INCLUDES_DIR."/views/view_detail_tabs.php");

?>

    <div class="content-main">

        <div itemscope itemtype="http://schema.org/LocalBusiness" class="tab-container">

            <div id="content_overview" class="tab-content">

                <div class="row-fluid">

                    <div class="span12">
                        <h2 itemprop="name"><?=$listingtemplate_title?></h2>
                    </div>

                </div>

                <div class="row-fluid top-info">

                    <? if ($listingtemplate_summary_review) { ?>
                        <div class="span9" <?=$listingtemplate_summary_review && count($reviewsArr) > 0 ? "itemprop=\"aggregateRating\" itemscope itemtype=\"http://schema.org/AggregateRating\"" : ""?>>
                            <?=$listingtemplate_summary_review;?>
                            
                            <? if ($listingtemplate_summary_review && count($reviewsArr) > 0) { ?>
                                <meta itemprop="ratingValue" content="<?=$rate_avg;?>" />
                                <meta itemprop="ratingCount" content="<?=count($reviewsArr);?>" />
                            <? } ?>
                        </div>
                    <? } ?>

                    <div class="span3 share">
                         <?=$listingtemplate_icon_navbar?>
                        
                         <? if ($listingtemplate_twilioClickToCall) { ?>
                            <span class="button-call"><a rel="nofollow" href="<?=$listingtemplate_twilioClickToCall?>" <?=$twilioClickToCall_style?>><img src="<?=DEFAULT_URL?>/images/icon-call-phone.png" title="<?=system_showText(LANG_LABEL_CLICKTOCALL);?>"/></a></span>
                        <? } ?>   
                            
                        <? if ($listingtemplate_twilioSMS) { ?>
                            <span class="button-send"><a rel="nofollow" href="<?=$listingtemplate_twilioSMS?>" <?=$twilioSMS_style?>><img src="<?=DEFAULT_URL?>/images/icon-send-phone.png" title="<?=system_showText(LANG_LABEL_SENDPHONE);?>"/></a></span>            
                        <? } ?>            
                       
                    </div>

                </div>

                <br class="clearfix" />

                <div class="row-fluid middle-info">

                    <? if ($listingtemplate_image || $listingtemplate_gallery || $listingtemplate_features) { ?>
                    
                    <div class="span6">

                        <? if (($listingtemplate_image && !$listingtemplate_gallery && $onlyMain) || ($tPreview && $listingtemplate_image)) { ?>
                            <div class="image-shadow">
                                <div class="image">
                                    <?=$listingtemplate_image?>
                                </div>
                            </div>
                        <? } ?>

                        <? if ($listingtemplate_gallery) { ?>
                            <section <?=($onlyMain && !$isNoImage ? "class=\"gallery-overview detailfeatures\"" : "class=\"gallery-overview\"")?> >
                                <div <?=$tPreview ? "class=\"ad-gallery gallery\"" : ""?>>
                                    <?=$listingtemplate_gallery?>
                                </div>
                            </section>
                        <? } ?>
                        
                        <div <?=($onlyMain && !$isNoImage ? "class=\"detailfeatures\"" : "")?>>
                        
                        <? if ($listingtemplate_features) { ?>
                            <div class="well-top"><?=system_showText(LANG_LABEL_GOODKNOW);?></div>

                            <div class="well-small">
                                <ul>
                                    <ol><?=system_showText(LANG_LABEL_FEATURES);?></ol>
                                    <ol>
                                        <ul><?=$listingtemplate_features;?></ul>         
                                    </ol>
                                </ul>
                            </div>
                        <? } ?>
                        <? if ($listingtemplate_designations) { ?>            
                            <?=$listingtemplate_designations?>
                        <? } ?>
                            
                        </div>
                    </div>
                    
                    <? } ?>

                    <div class="span6">
                        
                        <? if (($listingtemplate_address) || ($listingtemplate_address2) || ($listingtemplate_location)) { ?>
                            <p><address><strong><?=system_showText(LANG_LABEL_ADDRESS);?>:</strong></address></p>
                        <? } ?>
                    
                        <? if (($listingtemplate_address) || ($listingtemplate_address2) || ($listingtemplate_location)) echo "\n<address itemprop=\"address\" itemscope itemtype=\"http://schema.org/PostalAddress\">\n"; ?>

                        <? if ($listingtemplate_address) { ?>
                            <span itemprop="streetAddress"><?=$listingtemplate_address?></span>
                        <? } ?>

                        <? if ($listingtemplate_address2) { ?>
                            <br /><span><?=$listingtemplate_address2?></span>
                        <? } ?>

                        <? if ($listingtemplate_location) { ?>
                            <br /><span><?=$listingtemplate_location?></span>
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

                        <? if (($listingtemplate_address) || ($listingtemplate_address2) || ($listingtemplate_location)) echo "</address>\n"; ?>

                        <? if ($listingtemplate_phone) { ?>
                            <p><address><strong><?=system_showText(LANG_LISTING_LETTERPHONE)?>:</strong> <?=$listingtemplate_phone?></address></p>
                            <meta itemprop="telephone" content="<?=$listingtemplate_phone_aux;?>" />
                        <? } ?>

                        <? if ($listingtemplate_fax) { ?>
                            <p><address><strong><?=system_showText(LANG_LISTING_LETTERFAX)?>:</strong> <?=$listingtemplate_fax?></address></p>
                            <meta itemprop="faxNumber" content="<?=$listingtemplate_fax_aux;?>" />
                        <? } ?>

                        <? if ($listingtemplate_url) { ?>
                            <p><address><strong><?=system_showText(LANG_LISTING_LETTERWEBSITE)?>:</strong> <?=$listingtemplate_url?></address></p>
                            <meta itemprop="url" content="<?=$listingtemplate_url_aux?>" />
                        <? } ?>
                    
                        <? if ($listingtemplate_price) { ?>
                            <p>
                                <address>
                                    <strong><?=system_showText(LANG_LABEL_PRICE)?>:</strong><a id="priceTip" href="javascript: void(0);" title="<?=($listing_price_symbol." ".$listingtemplate_price);?>" <?=(!$user ? "style=\"cursor: default;\"" : "")?>><span itemprop="priceRange"><?=$listingtemplate_price_symbol;?></span></a>
                                </address>
                            </p>
                        <? } ?>

                        <? if ($listingtemplate_claim) { ?>
                            <?=$listingtemplate_claim?>
                        <? } ?>

                        <? if ($listingtemplate_email) { ?>
                            <a rel="nofollow" href="<?=$listingtemplate_email_link;?>" class="<?=($user? "fancy_window_tofriend" : "" )?> btn btn-success" <?=(!$user ? "style=\"cursor:default;\"" : "");?>>
                                <?=system_showText(LANG_LISTING_CONTACT);?>
                            </a>
                        <? } ?>
                        
                    </div>

                </div>

                <? if ($listingtemplate_long_description || $listingtemplate_hours_work || $listingtemplate_locations) { ?>
                
                <div class="row-fluid">
                    
                    <div class="content-box">
                        
                        <h2><?=system_showText(LANG_LABEL_DESCRIPTION);?></h2>
                        <p class="long">
                            <?=$listingtemplate_long_description ? $listingtemplate_long_description."<br /><br />" : ""?>
                            <?=$listingtemplate_hours_work ? $listingtemplate_hours_work."<br /><br />" : ""?>
                            <?=$listingtemplate_locations ? $listingtemplate_locations : ""?>
                        </p>
                        
                    </div>
                    
                </div>
                
                <? } ?>
                
                <? if ($listingtemplate_description) { ?>
                    <meta itemprop="description" content="<?=$listingtemplate_description;?>" />
                <? } ?>

                <? if ($auxImgPath) { ?>
                    <meta itemprop="image" content="<?=$auxImgPath;?>" />
                <? } ?>
                
                <? if ($listingtemplate_review) { ?>
                
                <div class="helpful-reviews">    
                    
                    <h2>
                        <?=system_showText(LANG_LABEL_HELPFUL_REVIEWS);?>
                        
                        <? if (count($reviewsArr) > 3) { ?>
                            <a rel="nofollow" class="pull-right" href="javascript:void(0);" <?=(!$user ? "style=\"cursor:default;\"" : "onclick=\"loadReviews('listing', $listingtemplate_id, 1); showTabDetail('review', true);\"");?>><?=str_replace("[x]", count($reviewsArr), system_showText(LANG_LABEL_SHOW_REVIEWS));?></a>
                        <? } else { ?>
                            <a rel="nofollow" class="hidden-phone pull-right <?=$class;?>" href="<?=($user ? $linkReviewFormPopup : "javascript:void(0);");?>"><?=system_showText(LANG_REVIEWRATEIT);?></a>
                        <? } ?>
                    </h2>                    
                    
                    <?=$listingtemplate_review?>
                    
                </div>
                
                <? } ?>

            </div>
            
            <? if ($listingtemplate_review) { ?>
            
            <div id="content_review" class="tab-content" <?=$activeTab == "review"? "": "style=\"display: none;\"";?>>
                
                <div class="row-fluid">

                    <div class="span12">
                        <h2><?=$listingtemplate_title?></h2>
                        <a rel="nofollow" class="hidden-phone pull-right <?=$class;?>" href="<?=($user ? $linkReviewFormPopup : "javascript:void(0);");?>"><?=system_showText(LANG_REVIEWRATEIT);?></a>
                    </div>

                </div>
                
                <div id="loading_reviews">
                    <img src="<?=DEFAULT_URL."/theme/".EDIR_THEME."/images/iconography/icon-loading-content.gif"?>" alt="<?=system_showText(LANG_WAITLOADING)?>"/>
                </div>
                
                <div id="all_reviews" class="content-reviews"></div>

            </div>
            
            <? } ?>
            
            <? if ($listingtemplate_attachment_file) { ?>
            
            <div id="content_menu" class="tab-content" <?=$activeTab == "menu"? "": "style=\"display: none;\"";?>>

                <div class="row-fluid">

                    <div class="span12">
                        <h2><?=$listingtemplate_title?></h2>
                    </div>

                </div>
                
                <div class="row-fluid downloadmenu">
                    <img src="<?=THEMEFILE_URL."/".EDIR_THEME."/images/imagery/menu.png"?>" alt="<?=system_showText(LANG_LABEL_MENU);?>"/>
                    <?=str_replace("[item]", $listingtemplate_title, $listingtemplate_attachment_file);?>
                </div>

            </div>
            
            <? } ?>
            
            <? if ($listingtemplate_video_snippet) { ?>
            
            <div id="content_video" class="tab-content" <?=$activeTab == "video"? "": "style=\"display: none;\"";?>>

                <div class="row-fluid ">

                    <div class="span12">
                        <h2><?=$listingtemplate_title?></h2>
                    </div>
                    
                    <div class="video">
                        <script language="javascript" type="text/javascript">
                        //<![CDATA[
                        document.write("<?=str_replace("\"","'",$listingtemplate_video_snippet)?>");
                        //]]>
                        </script>
                    </div>
                    
                    <? if ($listingtemplate_video_description) { ?>
                        <p><?=nl2br($listingtemplate_video_description);?></p>
                    <? } ?>

                </div>

            </div>
            
            <? } ?>
            
            <? if ($hasDeal) { ?>
            
            <div id="content_deal" class="tab-content" <?=$activeTab == "deal"? "": "style=\"display: none;\"";?>>
                
                <h2><?=$deal_name;?></h2>
                
                <div class="row-fluid">
                    
                    <div class="span12">
                        
                        <div class="detail-deal-tag">
                            <div class="deal-tag <?=($dealsDone ? "soldout" : "");?>">
                                <div class="name-tag-deal"><?=$deal_offer." OFF";?></div>
                            </div>
                        </div>

                        <div class="image img-polaroid">
                            <div class="no-link">
                                <?=$imageTag;?>
                            </div>
                        </div>
                        
                    </div>
                    
                </div>
                  
                <div class="row-fluid">
                    
                    <? if ($deal_description) { ?>
                    
                    <div class="span6">
                        
                        <div class="description">
                            
                            <p><?=nl2br($deal_description);?></p>

                        </div>
                        
                    </div>
                    
                    <? } ?>
                         
                    <div class="<?=($deal_description ? "span6" : "span12")?>">
                                 
                        <div class="action">

                            <div class="deal-value">
                                <span><?=system_showText(DEAL_VALUE)?><strong><?=$deal_real_value;?></strong></span>
                                <span><?=system_showText(LANG_SITEMGR_DISCOUNT)?><strong> <?=$deal_offer;?></strong></span>
                                <span><?=system_showText(LANG_LABEL_PROMOTION_PAY)?><strong><?=$deal_value.($deal_cents ? $deal_cents : "")?></strong></span>
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
                                    <? }

                                    if ($linkText) { ?>
                                        <p class="redeem-option">
                                            <a rel="nofollow" class="<?=$linkRedeemClass?>" href="<?=$redeemWFB;?>" <?=$promotionStyle?>><?=$linkText;?></a>
                                        </p>
                                    <? }
                                }

                                if ($_SESSION["ITEM_ACTION"] == "redeem" && $_SESSION["ITEM_TYPE"] && (is_numeric($_SESSION["ITEM_ID"]) && $_SESSION["ITEM_ID"] == htmlspecialchars($promotion->getNumber('id'))) && sess_isAccountLogged()) { ?>
                                        
                                    <a href="<?=$_SESSION["fb_deal_redirect"]? $_SESSION["fb_deal_redirect"]: $linkRedeem;?>" id="redeem_window" class="fancy_window_iframe" style="display:none"></a>
                                    
                                    <script type="text/javascript">
                                        //<![CDATA[                               
                                        $("a.fancy_window_iframe").fancybox({
                                            width           : <?=FANCYBOX_DEAL_WIDTH?>,
                                            height          : <?=FANCYBOX_DEAL_HEIGHT?>,
                                            type            : 'iframe'
                                        });

                                        $(document).ready(function() {
                                            showTabDetail('deal');
                                            $("#redeem_window").trigger('click');
                                        });
                                        //]]>
                                    </script>
                                    
                                    <?
                                    unset($_SESSION["ITEM_ACTION"], $_SESSION["ITEM_TYPE"], $_SESSION["ITEM_ID"], $_SESSION["ACCOUNT_REDIRECT"], $_SESSION["fb_deal_redirect"]);
                                } ?>

                            </div>

                        </div>
                             
                        <div class="deal-timeleft">
                                                       
                             <? if (!$dealsDone) { ?>
                
                                <h5><i class="icon-time"></i> <?=system_showText(LANG_LABEL_PROMOTION_TIMELEFT);?></h5>

                                <h4 id="timeLeft"></h4>

                            <? } else { ?>

                                <h4 class="deal-soldout"><?=system_showText(DEAL_SOLDOUT);?></h4>

                            <? } ?>
                            
                        </div>

                        <div class="deal-dealsleft">
                            <span><?=system_showText(LANG_LABEL_DEAL_LEFT);?>: <i id="updateDealsLeft"><?=$deal_left;?></i></span>
                            <span><?=system_showText(LANG_LABEL_DEAL_BOUGHT);?>: <i id="updateDeals"><?=$deal_sold;?></i></span>
                        </div>

                        <? if ($deal_conditions) { ?>
                            <h6><?=($deal_name." - ".system_showText(LANG_LABEL_DEAL_CONDITIONS));?></h6>
                            <p><?=nl2br($deal_conditions);?></p>
                        <? } ?>
                             
                    </div>
                         
                </div>
                
            </div>

            <? } ?>
            
        </div>

    </div>