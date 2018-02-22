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
	# * FILE: /includes/views/view_promotion_detail_code_realestate.php
	# ----------------------------------------------------------------------------------------------------
	 
?>

	<div class="detail detail-deal" itemscope itemtype="http://schema.org/Product">

		<h1 itemprop="name"><?=$deal_name;?></h1>
		
        <span class="clear">&nbsp;</span>

		<div class="deal">

			<div class="deal-price">
				<? if ($dealsDone) { ?>
				<div class="deal-tag deal-tag-sold-out">
					<span class="price"><?=system_showText(DEAL_SOLDOUT);?></span>
					<span class="discount"><?=$deal_offer?> OFF</span>
				</div>
				<? }else{ ?>
				<div class="deal-tag" itemscope itemtype="http://schema.org/Offer">
					<span class="price"><?=$deal_value.($deal_cents ? "<span class=\"cents\">".$deal_cents."</span>" : "")?></span>
					<span class="discount"><?=$deal_offer?> OFF</span>
                    <meta itemprop="price" content="<?=$deal_value.($deal_cents ? $deal_cents : ".00");?>" />
                    <meta itemprop="priceCurrency" content="<?=PAYMENT_CURRENCY?>" />
				</div>
				<? } ?>
			</div>

			<div class="image-shadow">
                <div class="image">
                    <?=$imageTag;?>
                </div>
            </div>

		</div>
        
        <span class="clear"></span>
        
        <div class="share" <?=$promotion_review && count($reviewsArr) > 0 ? "itemprop=\"aggregateRating\" itemscope itemtype=\"http://schema.org/AggregateRating\"" : ""?>>
			<?=$deal_icon_navbar;?>
            
            <? if ($promotion_review && count($reviewsArr) > 0) { ?>
                <meta itemprop="ratingValue" content="<?=$rate_avgDeal;?>" />
                <meta itemprop="ratingCount" content="<?=count($reviewsArr);?>" />
            <? } ?>
            
            <? if ($map_link) { ?>
                <ul class="share-actions">
                    <li><a href="javascript: void(0);" <?=$map_link?> <?=$map_style?>><?=system_showText(LANG_ICONMAP)?></a></li>
                </ul>
            <? } ?>
        </div>
        
        <? if ($deal_category_tree){?>
            <?=$deal_category_tree;?>
		<? } ?>
        
        <? include(system_getFrontendPath("detail_socialbuttons.php", "frontend", false, PROMOTION_EDIRECTORY_ROOT)); ?>

		<? if ($deal_conditions) { ?>
			<h2><?=system_showText(LANG_LABEL_DEAL_CONDITIONS);?></h2>
			<p> <?=nl2br($deal_conditions);?></p>
		<? } ?>
            
		<? if ($deal_description) { ?>
			<h2><?=system_showText(LANG_LABEL_DESCRIPTION);?></h2>
			<p> <?=nl2br($deal_description);?></p>
		<? } ?>
            
        <? if ($deal_summarydescription) { ?>
            <meta itemprop="description" content="<?=$deal_summarydescription;?>" />
        <? } ?>
            
        <? if ($auxImgPath) { ?>
            <meta itemprop="image" content="<?=$auxImgPath;?>" />
        <? } ?>
            
        <? if ($deal_review && count($reviewsArr) > 0) { ?>
        <div itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
            <meta itemprop="ratingValue" content="<?=$rate_avgDeal;?>" />
            <meta itemprop="ratingCount" content="<?=count($reviewsArr);?>" />
        </div>
        <? } ?>
            
        <div itemscope itemtype="http://schema.org/LocalBusiness">
            <meta itemprop="name" content="<?=$listing->getString("title")?>" />
            
            <? if ($listingtemplate_url_aux) { ?>
                <meta itemprop="url" content="<?=$listingtemplate_url_aux?>" />
            <? } ?>
                
            <? if ($listingtemplate_phone_aux) { ?>
                <meta itemprop="telephone" content="<?=$listingtemplate_phone_aux;?>" />
            <? } ?>
                
            <? if (is_array($snippet_address) && count($snippet_address > 0)) { ?>
                     
                <div itemscope itemtype="http://schema.org/PostalAddress">
                    
                    <? if ($listingtemplate_address) { ?>
                        <meta itemprop="streetAddress" content="<?=$listingtemplate_address?>" />
                    <? } ?>
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
                </div>
                
            <? } ?>
        </div>
	
    </div>