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
	# * FILE: /includes/views/view_listing_detail_code_0_realestate.php
	# ----------------------------------------------------------------------------------------------------
?>

    <div itemscope itemtype="http://schema.org/LocalBusiness" class="detail">

		<h1 itemprop="name"><?=$listingtemplate_title?></h1>
        
        <? include(system_getFrontendPath("detail_socialbuttons.php", "frontend", false, LISTING_EDIRECTORY_ROOT)); ?>
        
        <span class="clear">&nbsp;</span>
        
		<div class="columns">
                      
            <? if (($listingtemplate_image || $listingtemplate_gallery) && $listingtemplate_video_snippet) { ?>
                <div>
                    <ul class="detail-tabs">
                        <li id="li_gallery" class="tab_media_active">
                            <a href="javascript: void(0);" <?=($tPreview || !$user) ? "style=\"cursor:default;\"" : "onclick=\"displayMediaFront('gallery');\"" ?>>
                                <?=system_showText(LANG_LABEL_PHOTO_GALLERY);?>
                            </a>
                        </li>
                        <li id="li_video">
                            <a href="javascript: void(0);" <?=($tPreview || !$user) ? "style=\"cursor:default;\"" : "onclick=\"displayMediaFront('video');\"" ?>>
                                <?=system_showText(LANG_LABEL_VIDEO);?>
                            </a>
                        </li>
                    </ul>    
                </div>    
            <? } ?>
        
        	<? if (($listingtemplate_image && !$listingtemplate_gallery && $onlyMain) || ($tPreview && $listingtemplate_image)) { ?>
                <div class="image-shadow" <?=(!$tPreview ? "id=\"detail_image\"" : "" )?>>
                    <div class="image">
                        <?=$listingtemplate_image?>
                    </div>
                </div>
            <? } ?>

            <? if ($listingtemplate_gallery) { ?>
                <div class="ad-gallery <?=$tPreview ? "gallery" : ""?>" <?=(!$tPreview ? "id=\"detail_gallery\"" : "" )?>>
                    <?=$listingtemplate_gallery?>
                </div>
            <? } ?>

            <? if ($listingtemplate_video_snippet) { ?>
                <div class="video" id="detail_video" <?=(($listingtemplate_image || $listingtemplate_gallery) && $listingtemplate_video_snippet ? "style=\"display: none\"" : "")?>>
                    <script language="javascript" type="text/javascript">
                    //<![CDATA[
                    document.write("<?=str_replace("\"","'",$listingtemplate_video_snippet)?>");
                    //]]>
                    </script>
                </div>
            <? } ?>

            <div class="share" <?=$listingtemplate_summary_review && count($reviewsArr) > 0 ? "itemprop=\"aggregateRating\" itemscope itemtype=\"http://schema.org/AggregateRating\"" : ""?>>
                <?=$listingtemplate_icon_navbar?>
                
                <? if ($listingtemplate_summary_review && count($reviewsArr) > 0) { ?>
                    <meta itemprop="ratingValue" content="<?=$rate_avg;?>" />
                    <meta itemprop="ratingCount" content="<?=count($reviewsArr);?>" />
                <? } ?>
                
            </div>

            <? if ($listingtemplate_designations) { ?>
                <div class="content-box">
                    <?=$listingtemplate_designations?>
                </div>
            <? } ?>
            
            <? if ($listingtemplate_category_tree) { ?>
                <?=$listingtemplate_category_tree?>
            <? } ?>
            
            <? if(($listingtemplate_address) || ($listingtemplate_address2) || ($listingtemplate_location)) echo "\n<address itemprop=\"address\" itemscope itemtype=\"http://schema.org/PostalAddress\">\n"; ?>

            <? if ($listingtemplate_address) { ?>
                <span itemprop="streetAddress"><?=$listingtemplate_address?></span>
            <? } ?>

            <? if ($listingtemplate_address2) { ?>
                <span><?=$listingtemplate_address2?></span>
            <? } ?>

            <? if ($listingtemplate_location) { ?>
                <span><?=$listingtemplate_location?></span>
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

            <? if(($listingtemplate_address) || ($listingtemplate_address2) || ($listingtemplate_location)) echo "</address>\n"; ?>

            <? if ($listingtemplate_phone) { ?>
                <p><strong><?=system_showText(LANG_LISTING_LETTERPHONE)?>:</strong> <?=$listingtemplate_phone?></p>
                <meta itemprop="telephone" content="<?=$listingtemplate_phone_aux;?>" />
            <? } ?>

            <? if ($listingtemplate_fax) { ?>
                <p><strong><?=system_showText(LANG_LISTING_LETTERFAX)?>:</strong> <?=$listingtemplate_fax?></p>
                <meta itemprop="faxNumber" content="<?=$listingtemplate_fax_aux;?>" />
            <? } ?>

            <? if ($listingtemplate_url) { ?>
                <p><strong><?=system_showText(LANG_LISTING_LETTERWEBSITE)?>:</strong> <?=$listingtemplate_url?></p>
                <meta itemprop="url" content="<?=$listingtemplate_url_aux?>" />
            <? } ?>
                
            <? if($listingtemplate_twilioSMS){ ?>
                <p class="button-send"><a rel="nofollow" href="<?=$listingtemplate_twilioSMS?>" <?=$twilioSMS_style?>><?=system_showText(LANG_LABEL_SENDPHONE);?></a></p>                    
            <? } ?> 
                
            <? if($listingtemplate_twilioClickToCall){ ?>					
                <p class="button-call"><a rel="nofollow" href="<?=$listingtemplate_twilioClickToCall?>" <?=$twilioClickToCall_style?>><?=system_showText(LANG_LABEL_CLICKTOCALL);?></a></p>
            <? } ?> 

            <? if ($listingtemplate_claim) { ?>
                <?=$listingtemplate_claim?>
            <? } ?>

			<? if ($listingtemplate_attachment_file) { ?>
				<?=$listingtemplate_attachment_file?>
			<? } ?>

		</div>

		<? if ($listingtemplate_long_description || $listingtemplate_hours_work || $listingtemplate_locations) { ?>
			<p class="long">
                <?=$listingtemplate_long_description ? $listingtemplate_long_description."<br /><br />" : ""?>
                <?=$listingtemplate_hours_work ? $listingtemplate_hours_work."<br /><br />" : ""?>
                <?=$listingtemplate_locations ? $listingtemplate_locations : ""?>
            </p>
		<? } ?>
            
        <? if ($listingtemplate_description) { ?>
            <meta itemprop="description" content="<?=$listingtemplate_description;?>" />
        <? } ?>

        <? if ($auxImgPath) { ?>
            <meta itemprop="image" content="<?=$auxImgPath;?>" />
        <? } ?>

		<? if ($templateExtraFields) { ?>
            <div class="extra-fields">
                <?=$templateExtraFields;?>
            </div>
		<? } ?>

	</div>