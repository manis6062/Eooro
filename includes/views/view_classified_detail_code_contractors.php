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
# * FILE: /includes/views/view_classified_detail_code_contractors.php
# ----------------------------------------------------------------------------------------------------

?>

    <div class="responsive-detail" itemscope itemtype="http://schema.org/Product">

        <div class="inverse-row">
            <? include(system_getFrontendPath("detail_maps.php", "frontend", false, CLASSIFIED_EDIRECTORY_ROOT)); ?>
        </div>

        <div class="row-fluid">

            <div class="row-fluid top-info">

                <div class="span10">
                    <h3 itemprop="name"><?=$classified_title;?></h3>
                </div>

                <div class="span2 share-middle text-right">
                    <ul class="share-social">
                        <?=$favoritesLink?>
                    </ul>
                </div>

            </div>
            
            <? if ($classified_category_tree) { ?>
            
            <div class="list-categories">
                <?=$classified_category_tree?>
            </div>
            
            <? } ?>

        </div>

        <div class="row-fluid">

            <div class="span8">
                
                <? if ($classified_price != "NULL" && $classified_price != "" || $classified_contactName ) { ?>
                
                <div class="row-fluid dialog-list">
                    
                    <? if ($classified_price != "NULL" && $classified_price != "") { ?>

                    <dl class="dl-horizontal span6" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                        <dt><?=system_showText(LANG_LABEL_PRICE);?></dt>
                        <dd itemprop="price"><?=CURRENCY_SYMBOL." ".$classified_price;?></dd>
                        <meta itemprop="priceCurrency" content="<?=PAYMENT_CURRENCY?>" />
                    </dl>

                    <? } ?>

                    <? if ($classified_contactName) { ?>

                    <dl class="dl-horizontal span6" itemscope itemtype="http://schema.org/Person">
                        <dt><?=ucfirst(system_showText(LANG_CONTACT))?></dt>
                        <dd itemprop="name"><?=nl2br($classified_contactName)?></dd>
                        
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
                        
                    </dl>

                    <? } ?>  
                </div>
                
                <? } ?>

                <? if ($classified_summary) { ?>
                <div class="row-fluid flex-box-title">
                    <h4><?=system_showText(LANG_LABEL_OVERVIEW);?></h4>

                    <p><?=$classified_summary;?></p>

                    <meta itemprop="description" content="<?=$classified_summary;?>" />
                </div>
                <? } ?>

                <? if ($auxImgPath) { ?>
                    <meta itemprop="image" content="<?=$auxImgPath;?>" />
                <? } ?>

                <? if ($classified_description) { ?>
                <div class="row-fluid flex-box-title">
                    <div class="content-box">
                        <h4><?=system_showText(LANG_LABEL_DESCRIPTION);?></h4>
                        <p><?=$classified_description?></p>
                    </div>
                </div>
                <? } ?>                

                <? if ($classifiedGallery) { ?>
                <div class="row-fluid flex-box-title">
                    <h4><?=system_showText(LANG_LABEL_PHOTO_GALLERY);?></h4>
                    <div class="photo-gallery">
                        <div>
                            <?=$classifiedGallery?>
                        </div>
                    </div>
                </div>
                <? } ?>               

            </div>

            <div class="span4">  
                
                <? include(system_getFrontendPath("detail_socialbuttons.php", "frontend", false, CLASSIFIED_EDIRECTORY_ROOT)); ?>
                    
                <? if ($classified_email) { ?>
                    <br />
                    <a rel="nofollow" href="<?=$contact_email?>" class="<?=!$tPreview? "fancy_window_tofriend": "";?> btn btn-large btn-success" <?=(!$user ? "style=\"cursor:default;\"" : "");?>><?=system_showText(LANG_SEND_AN_EMAIL);?></a><br />
                    <br />
                <? }
                
                if (string_strpos($_SERVER["PHP_SELF"], "preview.php") !== false) {
                    $signUpClassified = true;
                }
                ?>
                
                <div class="flex-box-title"> 
                    
                    <? if ($location || $classified_address || $classified_address2) { ?>

                    <address>

                        <strong><?=system_showText(LANG_LABEL_ADDRESS)?></strong><br />

                        <? if ($classified_address) { ?>
                            <span><?=nl2br($classified_address)?></span><br />
                        <? } ?>

                        <? if ($classified_address2) { ?>
                            <span><?=nl2br($classified_address2)?></span><br />
                        <? } ?>

                        <? if ($location) { ?>
                            <span><?=$location?></span>
                        <? } ?>

                    </address>

                    <? }  ?>

                    <? if ($classified_phone) { ?>
                        
                        <strong><?=system_showText(LANG_LABEL_PHONE)?></strong>
                        <address><?=nl2br($classified_phone)?></address>
                        
                    <? } ?>

                    <? if ($classified_fax) { ?>
                        
                        <strong><?=system_showText(LANG_LABEL_FAX)?></strong>
                        <address><?=nl2br($classified_fax)?></address>
                        
                    <? } ?>

                    <? if ($classified_url) { ?>
                        
                        <? if ($user) { ?>
                        
                            <meta itemprop="url" content="<?=$classified_url?>" />
                            <strong><?=system_showText(LANG_LABEL_URL)?>:</strong>
                            <address><span class="oneline"><a href="<?=nl2br($classified_url)?>" target="_blank"><?=nl2br($classified_url)?></a></span></address>
                            
                        <? } else { ?>
                            
                            <strong><?=system_showText(LANG_LABEL_URL)?>:</strong>
                            <address><span class="oneline"><a href="javascript:void(0);" style="cursor:default"><?=nl2br($classified_url)?></a></span></address>
                            
                        <? } ?>
                        
                    <? } ?>
                </div>
                    
            </div>
            
        </div>
        
    </div>