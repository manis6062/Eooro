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
	# * FILE: /includes/views/view_listing_detail_code_0_contractors.php
	# ----------------------------------------------------------------------------------------------------


?>
    <div itemscope itemtype="http://schema.org/LocalBusiness">
                   
        <div class="top-info">
            
            <div class="row-fluid">

                <h3 itemprop="name" class="span10"><?=$listingtemplate_title?></h3>

                <div class="span2 text-right">
                    
                    <ul class="share-social">
                        <?=$favoritesLink?>
                    </ul>
                    
                    <? if ($listingtemplate_twilioClickToCall) { ?>
                        <span class="button-call">
                            <a rel="nofollow" href="<?=$listingtemplate_twilioClickToCall?>" <?=$twilioClickToCall_style?>><img src="<?=DEFAULT_URL?>/images/icon-call-phone.png" title="<?=system_showText(LANG_LABEL_CLICKTOCALL);?>"/></a>
                        </span>
                    <? } ?>

                    <? if ($listingtemplate_twilioSMS) { ?>
                        <span class="button-send">
                            <a rel="nofollow" href="<?=$listingtemplate_twilioSMS?>" <?=$twilioSMS_style?>><img src="<?=DEFAULT_URL?>/images/icon-send-phone.png" title="<?=system_showText(LANG_LABEL_SENDPHONE);?>"/></a>
                        </span>
                    <? } ?>
                </div>

            </div>

        </div>

        <div class="row-fluid flex-box-title">
            
            <article class="top-info span12">

                <? if ($listingtemplate_summary_review) { ?>
                
                <div class="span4 big-rating" <?=$listingtemplate_summary_review && count($reviewsArr) > 0 ? "itemprop=\"aggregateRating\" itemscope itemtype=\"http://schema.org/AggregateRating\"" : ""?>>
                    
                    <?=$listingtemplate_summary_review;?>
                    
                    <? if (count($reviewsArr) > 0) { ?>
                        <meta itemprop="ratingValue" content="<?=$rate_avg;?>" />
                        <meta itemprop="ratingCount" content="<?=count($reviewsArr);?>" />
                    <? } ?>
                </div>
                
                <? } ?>

                <div class="span4">
                    <? if ($listingtemplate_phone) { ?>
                        <strong><?=system_showText(LANG_LISTING_LETTERPHONE)?></strong>
                        <address><?=$listingtemplate_phone?></address>
                        <meta itemprop="telephone" content="<?=$listingtemplate_phone_aux;?>" />
                    <? } ?>

                    <? if ($listingtemplate_fax) { ?>
                        <strong><?=system_showText(LANG_LISTING_LETTERFAX)?></strong>
                        <address><?=$listingtemplate_fax?></address>
                        <meta itemprop="faxNumber" content="<?=$listingtemplate_fax_aux;?>" />
                    <? } ?>

                    <? if (($listingtemplate_address) || ($listingtemplate_address2) || ($listingtemplate_location)) { ?>
                        <strong><?=system_showText(LANG_LABEL_ADDRESS);?></strong>
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

                </div>

                <div class="span4">

                    <? if ($listingtemplate_url) { ?>
                        <strong><?=system_showText(LANG_LISTING_LETTERWEBSITE)?></strong>
                        <address class="website"><?=$listingtemplate_url?></address>
                        <meta itemprop="url" content="<?=$listingtemplate_url_aux?>" />
                    <? } ?>
                   
                    <? if ($listingtemplate_attachment_file) { ?>
                        <div class="small-text"><?=$listingtemplate_attachment_file;?></div>
                    <? } ?>

                    <? if ($listingtemplate_email) { ?>
                        <a rel="nofollow" href="<?=$listingtemplate_email_link;?>" class="<?=($user? "fancy_window_tofriend" : "" )?> btn btn-success" <?=(!$user ? "style=\"cursor:default;\"" : "");?>>
                            <?=system_showText(LANG_SEND_AN_EMAIL);?>
                        </a>
                    <? } ?>

                </div>

            </article>

            <? if ($listingtemplate_category_tree) { ?>
                <div class="list-categories">
                    <?=$listingtemplate_category_tree?>
                </div>
            <? } ?>

            <? if ($listingtemplate_claim) { ?>
                <div class="claimthis"><?=$listingtemplate_claim?></div>
            <? } ?>

        </div>

        <? 
        $tabOverview = false;
        if ($listingtemplate_long_description || 
                $listingtemplate_hours_work || 
                $listingtemplate_locations ||
                $listingtemplate_description ||
                $listingtemplate_gallery ||
                $listingtemplate_features ||
                $listingtemplate_designations
                ) { ?>
        
        <div id="content_overview">
            <?
            $tabActiveOverview = true;
            $tabOverview = true;
            include(INCLUDES_DIR."/views/view_detail_tabs_contractors.php");
            $tabActiveOverview = false;
            ?>
        </div>
        
        <? } ?>

        <? if ($listingtemplate_long_description || $listingtemplate_hours_work || $listingtemplate_locations) { ?>

        <div class="row-fluid flex-box-title">
            <article>
                <p class="long">
                    <?=$listingtemplate_long_description ? $listingtemplate_long_description."<br /><br />" : ""?>
                    <?=$listingtemplate_hours_work ? $listingtemplate_hours_work."<br /><br />" : ""?>
                    <?=$listingtemplate_locations ? $listingtemplate_locations : ""?>
                </p>
            </article>
        </div>

        <? } ?>
            
        <? if ($listingtemplate_description) { ?>
            <meta itemprop="description" content="<?=$listingtemplate_description;?>" />
        <? } ?>
            
        <? if ($listingtemplate_gallery) { ?>

        <div class="row-fluid flex-box-title">
            
            <h4><?=system_showText(LANG_LABEL_PHOTO_GALLERY);?></h4>
            
            <div class="photo-gallery">
                <? if ($listingtemplate_gallery) { ?>
                    <div>
                        <?=$listingtemplate_gallery?>
                    </div>
                <? } ?>
            </div>
        </div>

        <? } ?>

        <? if ($listingtemplate_features) { ?>
        <div class="row-fluid flex-box-title">
            
            <h4><?=system_showText(LANG_LABEL_FEATURES);?></h4>
            <ul>
                <ol>
                    <ul><?=$listingtemplate_features;?></ul>
                </ol>
            </ul>
        </div>
        <? } ?>

        <? if ($templateExtraFields || $listingtemplate_designations) { ?>

        <div class="row-fluid flex-box-title">
            
            <h4><?=system_showText(LANG_LABEL_GOODKNOW);?></h4>
            
            <? if ($templateExtraFields) { ?>
            <div class="extra-fields">
                <?=$templateExtraFields;?>
            </div>
            <? } ?>

            <? if ($listingtemplate_designations) { ?>
            <div class="row-fluid">
                <?=$listingtemplate_designations?>
            </div>
            <? } ?>               
            
        </div>

        <? } ?>
            
        <? if ($auxImgPath) { ?>
            <meta itemprop="image" content="<?=$auxImgPath;?>" />
        <? } ?>

        <? if ($listingtemplate_review) { ?>

        <div id="content_review" class="area-content">
            <?
            $tabActiveReview = true;
            include(INCLUDES_DIR."/views/view_detail_tabs_contractors.php");
            $tabActiveReview = false;
            ?>
        </div>

        <div class="row-fluid flex-box-title">

            <div class="top-info top-review">
                <div class="row-fluid">
                    <div class="big-rating">
                        <?=str_replace("»", "", $listingtemplate_summary_review);?>
                    </div>
                </div>
            </div>
            
            <script language="javascript" type="text/javascript">
                $('document').ready(function() {
                    loadReviews('<?=$item_type?>', <?=($user ? $item_id : "'preview'")?>, 1, 'tab');
                });
            </script>
            
            <div id="loading_reviews" class="loading_reviews_preview">
                <img src="<?=DEFAULT_URL."/theme/".EDIR_THEME."/images/iconography/icon-loading-location.gif"?>" alt="<?=system_showText(LANG_WAITLOADING)?>"/>
            </div>

            <div id="all_reviews" class="all_reviews_preview row-fluid"></div>

        </div>

        <? } ?>

        <? if ($listingtemplate_video_snippet) { ?>
        
        <div id="content_video" class="area-content">
            <?
            $tabActiveVideo = true;
            include(INCLUDES_DIR."/views/view_detail_tabs_contractors.php");
            $tabActiveVideo = false;
            ?>
        </div>

        <div class="row-fluid flex-box-title">

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

        <? } ?>

    </div>