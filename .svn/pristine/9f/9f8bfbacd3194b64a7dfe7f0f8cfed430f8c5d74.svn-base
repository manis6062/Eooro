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
	# * FILE: /includes/views/view_listing_detail_code_0.php
	# ----------------------------------------------------------------------------------------------------

        if ( EDIR_THEME == 'stremline' ) {
            include(INCLUDES_DIR."/views/view_detail_tabs_stremline.php");
        }
        else {
            include(INCLUDES_DIR."/views/view_detail_tabs.php");
        }
?>
    <div itemscope itemtype="http://schema.org/LocalBusiness" class="tab-container">

        <div id="content_overview" class="tab-content">

            <div class="row-fluid">
                <div class="top-info">
                    <!-- modification h1 from h3 -->
                    <h1 itemprop="name"><?=$listingtemplate_title;?></h1>

                    <div class="row-fluid">

                        <div class="span6" <?=$listingtemplate_summary_review && count($reviewsArr) > 0 ? "itemprop=\"aggregateRating\" itemscope itemtype=\"http://schema.org/AggregateRating\"" : ""?>>
                            <? if ($listingtemplate_summary_review) { ?>
                                <?=$listingtemplate_summary_review;?>
                            <? } ?>
                            <? if ($listingtemplate_summary_review && count($reviewsArr) > 0) { ?>
                                <meta itemprop="ratingValue" content="<?=$rate_avg;?>" />
                                <meta itemprop="ratingCount" content="<?=count($reviewsArr);?>" />
                            <? } ?>
                        </div>
                        <div class="span3">
                            <a rel="nofollow" class="btn-review-small btn btn-success pull-right <?=$class;?>" 
                               href="<?=($user ? $linkReviewFormPopup : "javascript:void(0);");?>">
                            <?=system_showText(LANG_REVIEWRATEIT);?></a>
                        </div>
                        <div class="span3 <?=($listingtemplate_summary_review ? "text-right" : "text-left")?>">
                            <?=$listingtemplate_icon_navbar?>
                            <? if ($listingtemplate_twilioClickToCall) { ?>
                                <span class="button-call"><a rel="nofollow" href="<?=$listingtemplate_twilioClickToCall?>" <?=$twilioClickToCall_style?>><img src="<?=DEFAULT_URL?>/images/icon-call-phone.png" title="<?=system_showText(LANG_LABEL_CLICKTOCALL);?>"/></a></span>
                            <? } ?>

                            <? if ($listingtemplate_twilioSMS) { ?>
                                <span class="button-send"><a rel="nofollow" href="<?=$listingtemplate_twilioSMS?>" <?=$twilioSMS_style?>><img src="<?=DEFAULT_URL?>/images/icon-send-phone.png" title="<?=system_showText(LANG_LABEL_SENDPHONE);?>"/></a></span>
                            <? } ?>
                        </div>

                    </div>

                </div>

            </div>

            <div class="row-fluid">

                <? if ($listingtemplate_category_tree) { ?>
                <div class="span12 top-info">
                    <?=$listingtemplate_category_tree?>
                </div>
                <? } ?>

            </div>

            <div class="row-fluid middle-info">

                <? if ($listingtemplate_image || $listingtemplate_gallery || $listingtemplate_features) { ?>

                <div class="span7">

                    <? if (($listingtemplate_image && !$listingtemplate_gallery && $onlyMain) || ($tPreview && $listingtemplate_image)) { ?>
                        <div class="image-shadow">
                            <div class="image">
                                <?=$listingtemplate_image?>
                            </div>
                        </div>
                    <? } ?>

                    <? if ($listingtemplate_gallery) { ?>
                    <section <?=($onlyMain && !$isNoImage ? "class=\"gallery-overview detailfeatures\"" : "")?> >
                        <div <?=$tPreview ? "class=\"ad-gallery gallery\"" : ""?> >
                            <?=$listingtemplate_gallery?>
                        </div>
                    </section>
                    <? } ?>

                    <div>

                    <? if ($listingtemplate_features) { ?>

                        <br />
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

                <div class="span5">

                    <? if (($listingtemplate_address) || ($listingtemplate_address2) || ($listingtemplate_location)) { ?>
                        <strong><?=system_showText(LANG_LABEL_ADDRESS);?>:</strong>
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
                        <strong><?=system_showText(LANG_LISTING_LETTERPHONE)?>:</strong>
                        <address><?=$listingtemplate_phone?></address>
                        <meta itemprop="telephone" content="<?=$listingtemplate_phone_aux;?>" />
                    <? } ?>

                    <? if ($listingtemplate_fax) { ?>
                        <strong><?=system_showText(LANG_LISTING_LETTERFAX)?>:</strong>
                        <address><?=$listingtemplate_fax?></address>
                        <meta itemprop="faxNumber" content="<?=$listingtemplate_fax_aux;?>" />
                    <? } ?>

                    <? if ($listingtemplate_url) { ?>
                        <strong><?=system_showText(LANG_LISTING_LETTERWEBSITE)?>:</strong>
                        <address class="website"><?=$listingtemplate_url?></address>
                        <meta itemprop="url" content="<?=$listingtemplate_url_aux?>" />
                    <? } ?>

                    <? if ($listingtemplate_claim) {
                        
                        if ($listingtemplate_phone || $listingtemplate_fax || $listingtemplate_url) { ?>
                            <hr>
                        <? } ?>
                            
                        <?=$listingtemplate_claim?>
                        
                    <? } ?>

                    <? if ($listingtemplate_attachment_file) { ?>
                        <hr><?=$listingtemplate_attachment_file;?><br />
                    <? } ?>

                    <? if ($listingtemplate_email) { ?>
                        <a rel="nofollow" href="<?=$listingtemplate_email_link;?>" class="<?=($user? "fancy_window_tofriend" : "" )?> btn btn-large btn-success" <?=(!$user ? "style=\"cursor:default;\"" : "");?>>
                            <?=system_showText(LANG_LISTING_CONTACT);?>
                        </a>
                    <? } ?>

                </div>

            </div>

            <? if ($listingtemplate_long_description || $listingtemplate_hours_work || $listingtemplate_locations) { ?>

            <div class="row-fluid">

                <div class="content-box">

                    <h4><?=system_showText(LANG_LABEL_DESCRIPTION);?></h4>
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
                <meta content="<?=$auxImgPath;?>" />
            <? } ?>

            <? if ($templateExtraFields) { ?>

            <div class="row-fluid">
                <div class="extra-fields">
                    <?=$templateExtraFields;?>
                </div>
            </div>

            <? } ?>

            <? if ($listingtemplate_review) { ?>

            <div class="flex-box-group color-3 helpful-reviews">

                <h2>
                    <i class="icon-pencil"></i>
                    <?=system_showText(LANG_LABEL_HELPFUL_REVIEWS);?>
                       
                    <? if ($total_items > 1) { ?>
                        
                    <a rel="nofollow" class="view-more" href="javascript:void(0);" ><?=$total_items .' '. system_showText(LANG_REVIEWCOUNT_PLURAL);?></a>
                    <? } else if ($total_items == 1) { ?>
                        
                    <a rel="nofollow" class="view-more" href="javascript:void(0);" ><?=$total_items .' '. system_showText(LANG_REVIEWCOUNT);?></a>
                    
                    <? } else { ?>
                      
                    <a rel="nofollow" class="view-more <?=$class;?>" href="<?=($user ? $linkReviewFormPopup : "javascript:void(0);");?>"><?=system_showText(LANG_REVIEWRATEIT);?></a>
                    <? } ?>
                </h2>

                <?=$listingtemplate_review?>

            </div>

            <? } ?>

        </div>

        <? if ($listingtemplate_review) { ?>

        <div id="content_review" class="tab-content" <?=$activeTab == "review"? "": "style=\"display: none;\"";?>>

            <div class="row-fluid">

                <div class="span12 top-info">

                    <div class="span8">

                        <h3><?=$listingtemplate_title?></h3>
                        <div class="stars-rating">
                            <div class="rate-<?=(is_numeric($rate_avg) ? $rate_avg : "0")?>"></div>
                        </div>

                    </div>

                    <div class="span4">
                        <a rel="nofollow" class="btn-review btn btn-success <?=$class;?>" href="<?=($user ? $linkReviewFormPopup : "javascript:void(0);");?>"><?=system_showText(LANG_REVIEWRATEIT);?></a>
                    </div>

                </div>

            </div>

            <div id="loading_reviews">
                <img src="<?=DEFAULT_URL."/theme/".EDIR_THEME."/images/iconography/icon-loading-location.gif"?>" alt="<?=system_showText(LANG_WAITLOADING)?>"/>
            </div>

            <div id="all_reviews" class="row-fluid"></div>

        </div>

        <? } ?>

        <? if ($listingtemplate_video_snippet) { ?>

        <div id="content_video" class="tab-content" <?=$activeTab == "video"? "": "style=\"display: none;\"";?>>

            <div class="row-fluid">

                <div class="span12 top-info">
                    <h3><?=$listingtemplate_title?></h3>
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

            <div class="row-fluid">

                <div class="span12 top-info">
                    <h3><?=$deal_name;?></h3>
                </div>
            </div>

            <div class="row-fluid">

                <div class="image img-polaroid">
                    <div class="no-link">
                        <?=$imageTag;?>
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

                        <? if (!$dealsDone) { ?>
                        
                        <div class="facebookConnect">
                            
                            <? if ($redeemLink) { ?>
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
                            <? } ?>
                                
                        </div>
                        
                        <? }

                        if ($_SESSION["ITEM_ACTION"] == "redeem" && $_SESSION["ITEM_TYPE"] && (is_numeric($_SESSION["ITEM_ID"]) && $_SESSION["ITEM_ID"] == htmlspecialchars($promotion->getNumber('id'))) && sess_isAccountLogged()) { ?>

                            <a href="<?=$_SESSION["fb_deal_redirect"]? $_SESSION["fb_deal_redirect"]: $linkRedeem;?>" id="redeem_window" class="fancy_window_iframe" style="display:none"></a>

                            <script type="text/javascript">
                                //<![CDATA[                               
                                $("a.fancy_window_iframe").fancybox({
                                    maxWidth        : 475,
                                    padding         : 0,
                                    margin          : 0,
                                    closeBtn        : false,
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

                    <div class="deal-timeleft">

                        <? if (!$dealsDone) { ?>

                            <h5><i class="icon-time"></i> <?=system_showText(LANG_LABEL_PROMOTION_TIMELEFT);?></h5>

                            <h4 id="timeLeft"></h4>
z
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
<script>
    $(document).scrollViewer({
        itemId : <?=$item_id?>
    });
</script>