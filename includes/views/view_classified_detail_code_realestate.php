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
	# * FILE: /includes/views/view_classified_detail_code_realestate.php
	# ----------------------------------------------------------------------------------------------------

?>
	
	<div class="detail" itemscope itemtype="http://schema.org/Product">
		
		<h1 itemprop="name"><?=$classified_title;?></h1>
        
        <? include(system_getFrontendPath("detail_socialbuttons.php", "frontend", false, CLASSIFIED_EDIRECTORY_ROOT)); ?>
        
        <span class="clear">&nbsp;</span>
        
		<div class="columns">
        	
			<? if (($imageTag && !$classifiedGallery && $onlyMain) || ($tPreview && $imageTag)) { ?>
            	<div class="image-shadow">
                    <div class="image">
                        <?=$imageTag?>
                    </div>
				</div>
            <? } ?>

            <? if ($classifiedGallery) { ?>
                <div class="ad-gallery <?=$tPreview ? "gallery" : ""?>">
                    <?=$classifiedGallery?>
                </div>
            <? } ?>
            
            <div class="share">
                <?=$classified_icon_navbar?>
            </div>
			
			<div>
                
                <? if ($classified_category_tree) { ?>
                    <?=$classified_category_tree?>
                <? } ?>
								
				<? if (($location) || ($classified_address) || ($classified_address2)) echo "<address>\n";  ?>
				
				<? if($classified_address) { ?>
					<span><?=nl2br($classified_address)?></span>
				<? } ?>

				<? if($classified_address2) { ?>
					<span><?=nl2br($classified_address2)?></span>
				<? } ?>

				<? if($location) { ?>
					<span><?=$location?></span>
				<? } ?>

				<? if (($location) || ($classified_address) || ($classified_address2)) echo "</address>\n";  ?>
				
				<? if ($classified_contactName){ ?>
					<p><strong><?=system_showText(LANG_LABEL_CONTACTNAME)?>:</strong> <?=nl2br($classified_contactName)?></p>
				<? } ?>
					
				<? if ($classified_phone){ ?>
					<p><strong><?=system_showText(LANG_LABEL_PHONE)?>:</strong> <?=nl2br($classified_phone)?></p>
				<? } ?>
					
				<? if ($classified_fax){ ?>
					<p><strong><?=system_showText(LANG_LABEL_FAX)?>:</strong> <?=nl2br($classified_fax)?></p>
				<? } ?>
					
				<? if ($classified_email){ ?>
					<p><strong><?=system_showText(LANG_LABEL_EMAIL)?>:</strong> <a rel="nofollow" href="<?=$contact_email?>" class="<?=!$tPreview? "fancy_window_tofriend": "";?>" style="<?=$contact_email_style?>"><?=system_showText(LANG_SEND_AN_EMAIL);?></a></p>
				<? } ?>	
			
				<? if ($classified_url){ ?>
					<? if ($user){ ?>
                        <meta itemprop="url" content="<?=$classified_url?>" />
						<p><strong><?=system_showText(LANG_LABEL_URL)?>:</strong> <a href="<?=nl2br($classified_url)?>" target="_blank"><?=nl2br($classified_url)?></a></p>
					<? } else { ?>
						<p><strong><?=system_showText(LANG_LABEL_URL)?>:</strong> <a href="javascript:void(0);" style="cursor:default"><?=nl2br($classified_url)?></a></p>
					<? } ?>
				<? } ?>
                
                <? if ($classified_price != 'NULL' && $classified_price != '') {?>
					<br />
                    <div itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                        <p itemprop="price">
                            <strong><?=system_showText(LANG_LABEL_PRICE);?>:</strong>
                            <?=CURRENCY_SYMBOL." ".$classified_price;?>
                        </p>
                        <meta itemprop="priceCurrency" content="<?=PAYMENT_CURRENCY?>" />
                    </div>
				<? } ?>
				
			</div>
            
		</div>
			
		<? if ($classified_description) { ?>
			<div class="content-box">
				<p class="long"><?=$classified_description?></p>
			</div>
		<? } ?>
        
        <? if ($classified_summary) { ?>
            <meta itemprop="description" content="<?=$classified_summary;?>" />
        <? } ?>
            
        <? if ($auxImgPath) { ?>
            <meta itemprop="image" content="<?=$auxImgPath;?>" />
        <? } ?>
        
        <? if ($classified_contactName) { ?>

        <div itemscope itemtype="http://schema.org/Person">
            <meta itemprop="name" content="<?=$classified_contactName;?>" />

            <? if ($classified_phone) { ?>
            <meta itemprop="telephone" content="<?=$classified_phone;?>" />
            <? } ?>

            <? if ($classified_fax) { ?>
            <meta itemprop="faxNumber" content="<?=$classified_fax;?>" />
            <? } ?>

            <? if ($classified_address) { ?>
            <meta itemprop="address" content="<?=$classified_address?>" />
            <? } ?>

            <? if (is_array($snippet_address) && count($snippet_address > 0)) { ?>
            <div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
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

        <? } ?>
		
	</div>