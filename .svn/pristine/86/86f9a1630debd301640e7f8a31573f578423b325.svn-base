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
	# * FILE: /includes/views/view_classified_detail_code_diningguide.php
	# ----------------------------------------------------------------------------------------------------

    include(INCLUDES_DIR."/views/view_detail_tabs.php");
    
?>	

    <div class="content-main" itemscope itemtype="http://schema.org/Product">
        
        <div class="tab-container">
            
            <div id="content_overview" class="tab-content">
                
                <div class="row-fluid top-info">
                    
                    <div class="span10">
                        <h2 itemprop="name"><?=$classified_title;?></h2>
                    </div>
                    
                    <div class="span2 share">
                        <?=$classified_icon_navbar?>
                    </div>
                    
                </div>
                
                <div class="row-fluid">
                    <? if ($classified_category_tree) { ?>
                        <?=$classified_category_tree?>
                    <? } ?>
                </div>
                
                <div class="row-fluid middle-info">
                    
                    <? if ($imageTag || $classifiedGallery) { ?>
                    
                    <div class="span6">

                        <? if (($imageTag && !$classifiedGallery && $onlyMain) || ($tPreview && $imageTag)) { ?>
                            <div class="image">
                                <?=$imageTag?>
                            </div>
                        <? } ?>

                        <? if ($classifiedGallery) { ?>

                            <section <?=($onlyMain && !$isNoImage ? "class=\"gallery-overview detailfeatures\"" : "")?> >
                                <div <?=$tPreview ? "class=\"ad-gallery gallery\"" : ""?>>
                                     <?=$classifiedGallery?>
                                </div>
                            </section>
                            
                        <? } ?>
                    </div>
                    
                    <? } ?>
                    
                    <div class="span6">
                        
                        <? if ($classified_price != 'NULL' && $classified_price != '') { ?>
                        
                            <div itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                                <p><strong><?=system_showText(LANG_LABEL_PRICE);?>:</strong></p>
                                <p itemprop="price"><?=CURRENCY_SYMBOL." ".$classified_price;?></p>
                                <meta itemprop="priceCurrency" content="<?=PAYMENT_CURRENCY?>" />
                            </div>
                        
                            <br class="clear" />
                        <? } ?>

                        <? if (($location) || ($classified_address) || ($classified_address2)) { ?>
                        
                            <p><strong><?=system_showText(LANG_LABEL_ADDRESS);?>:</strong></p>

                            <address>
                        
                        <? } ?>

                        <? if ($classified_address) { ?>
                            <span><?=nl2br($classified_address)?></span>
                        <? } ?>

                        <? if ($classified_address2) { ?>
                            <span><?=nl2br($classified_address2)?></span>
                        <? } ?>

                        <? if ($location) { ?>
                            <span><?=$location?></span>
                        <? } ?>

                        <? if (($location) || ($classified_address) || ($classified_address2)) { ?>
                            </address> 
                        <? } ?>

                        <? if ($classified_contactName) { ?>
                            <p><strong><?=system_showText(LANG_LABEL_CONTACTNAME)?>:</strong> <?=nl2br($classified_contactName)?></p>
                        <? } ?>

                        <? if ($classified_phone) { ?>
                            <p><strong><?=system_showText(LANG_LABEL_PHONE)?>:</strong> <?=nl2br($classified_phone)?></p>
                        <? } ?>

                        <? if ($classified_fax) { ?>
                            <p><strong><?=system_showText(LANG_LABEL_FAX)?>:</strong> <?=nl2br($classified_fax)?></p>
                        <? } ?>

                        <? if ($classified_email) { ?>
                            <p><strong><?=system_showText(LANG_LABEL_EMAIL)?>:</strong> <a rel="nofollow" href="<?=$contact_email?>" class="<?=!$tPreview? "fancy_window_tofriend": "";?>" style="<?=$contact_email_style?>"><?=system_showText(LANG_SEND_AN_EMAIL);?></a></p>
                        <? } ?>	

                        <? if ($classified_url) { ?>
                            <? if ($user) { ?>
                                <meta itemprop="url" content="<?=$classified_url?>" />
                                <p><strong><?=system_showText(LANG_LABEL_URL)?>:</strong> <a href="<?=nl2br($classified_url)?>" target="_blank"><?=nl2br($classified_url)?></a></p>
                            <? } else { ?>
                                <p><strong><?=system_showText(LANG_LABEL_URL)?>:</strong> <a href="javascript:void(0);" style="cursor:default"><?=nl2br($classified_url)?></a></p>
                            <? } ?>
                        <? } ?>

                    </div>

                </div>
                
                <div class="row-fluid">
                    
                    <? if ($classified_description) { ?>
                        <div class="content-box">
                            <h2><?=system_showText(LANG_LABEL_DESCRIPTION);?></h2>
                            <p class="long"><?=$classified_description?></p>
                        </div>
                    <? } ?>
                    
                    <? if ($classified_summary) { ?>
                        <meta itemprop="description" content="<?=$classified_summary;?>" />
                    <? } ?>
                        
                    <? if ($auxImgPath) { ?>
                        <meta itemprop="image" content="<?=$auxImgPath;?>" />
                    <? } ?>
                </div>
                
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
            
        </div>
        
    </div>