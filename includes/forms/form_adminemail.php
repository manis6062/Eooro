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
	# * FILE: /includes/forms/form_adminemail.php
	# ----------------------------------------------------------------------------------------------------

?>

    <div class="header-form">
        <?=system_showText(LANG_SITEMGR_SETTINGS_EMAIL_ADMINISTRATOREMAIL)?>
    </div>

    <div class="block-info">

        <p>
            <?=system_showText(LANG_SITEMGR_SETTINGS_EMAIL_THEASEEMAILSAREREQUIRED)?><br />
            <?=system_showText(LANG_SITEMGR_SETTINGS_EMAIL_PLEASESEPARATEWITHCOMMA)?>
        </p>

        <? if ($message_adminemail) { ?>
            <div id="warning" class="<?=$message_style?>">
                <?=$message_adminemail?>
            </div>
        <? } ?>

        <div class="well-grid">
            <h4><?=system_showText(LANG_SITEMGR_SETTINGS_EMAIL_GENERALEMAIL)?> <span><?=system_showText(LANG_SITEMGR_SETTINGS_EMAIL_GENERALEMAIL_SPAN)?></span></h4>
            <p class="form-text">
                <b><?=system_showText(LANG_SITEMGR_LABEL_EMAIL)?>:</b>
                <input type="text" name="sitemgr_email" value="<?=$sitemgr_email?>" />
            </p>
            <p class="form-option">
                <b><?=system_showText(LANG_SITEMGR_SETTINGS_EMAIL_SENDNOTIFICATIONONTHISACCOUNT)?></b>
                <input type="checkbox" name="send_email" <?=$send_email_checked?> class="inputCheck" />
            </p>
        </div>

        <div class="well-grid">
            <h4><?=system_showText(LANG_SITEMGR_SETTINGS_EMAIL_SPECIFICEMAIL)?> <span><?=system_showText(LANG_SITEMGR_SETTINGS_EMAIL_SPECIFICEMAIL_SPAN)?></span></h4>
            <p class="form-text">
                <b><?=system_showText(LANG_SITEMGR_SETTINGS_EMAIL_LISTINGADDUPDATE)?></b>
                <input type="text" name="sitemgr_listing_email" value="<?=$sitemgr_listing_email?>" placeholder="<?=system_showText(LANG_SITEMGR_LABEL_EMAIL)?>"/>                       
            </p>

            <? if (EVENT_FEATURE == "on" && CUSTOM_EVENT_FEATURE == "on") { ?>            
                <p class="form-text">
                    <b><?=system_showText(LANG_SITEMGR_SETTINGS_EMAIL_EVENTADDUPDATE)?></b>
                    <input type="text" name="sitemgr_event_email" value="<?=$sitemgr_event_email?>" placeholder="<?=system_showText(LANG_SITEMGR_LABEL_EMAIL)?>"/>                       
                </p>          
            <? } ?>


            <? if (BANNER_FEATURE == "on" && CUSTOM_BANNER_FEATURE == "on") { ?>
                <p class="form-text">
                    <b><?=system_showText(LANG_SITEMGR_SETTINGS_EMAIL_BANNERADDUPDATE)?></b>
                    <input type="text" name="sitemgr_banner_email" value="<?=$sitemgr_banner_email?>" placeholder="<?=system_showText(LANG_SITEMGR_LABEL_EMAIL)?>"/>                       
                </p>             
            <? } ?>

            <? if (CLASSIFIED_FEATURE == "on" && CUSTOM_CLASSIFIED_FEATURE == "on") { ?>
                <p class="form-text">
                    <b><?=system_showText(LANG_SITEMGR_SETTINGS_EMAIL_CLASSIFIEDADDUPDATE)?></b>
                    <input type="text" name="sitemgr_classified_email" value="<?=$sitemgr_classified_email?>"  placeholder="<?=system_showText(LANG_SITEMGR_LABEL_EMAIL)?>"/>                       
                </p> 
            <? } ?>

            <? if (ARTICLE_FEATURE == "on" && CUSTOM_ARTICLE_FEATURE == "on") { ?>
                <p class="form-text">
                    <b><?=system_showText(LANG_SITEMGR_SETTINGS_EMAIL_ARTICLEADDUPDATE)?></b>
                    <input type="text" name="sitemgr_article_email" value="<?=$sitemgr_article_email?>" placeholder="<?=system_showText(LANG_SITEMGR_LABEL_EMAIL)?>"/>                       
                </p>            
            <? } ?>

            <p class="form-text">
                <b><?=system_showText(LANG_SITEMGR_SETTINGS_EMAIL_ACCOUNTADD)?></b>
                <input type="text" name="sitemgr_account_email" value="<?=$sitemgr_account_email?>" placeholder="<?=system_showText(LANG_SITEMGR_LABEL_EMAIL)?>"/>                       
            </p> 

            <p class="form-text">
                <b><?=system_showText(LANG_SITEMGR_SETTINGS_EMAIL_CONTACTUS)?></b>
                <input type="text" name="sitemgr_contactus_email" value="<?=$sitemgr_contactus_email?>" placeholder="<?=system_showText(LANG_SITEMGR_LABEL_EMAIL)?>"/>                       
            </p> 

            <p class="form-text">
                <b><?=system_showText(LANG_SITEMGR_SETTINGS_EMAIL_HELPSUPPORT)?></b>
                <input type="text" name="sitemgr_support_email" value="<?=$sitemgr_support_email?>"  placeholder="<?=system_showText(LANG_SITEMGR_LABEL_EMAIL)?>"/>                       
            </p> 

            <? if (PAYMENT_FEATURE == "on") { ?>
                <? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) { ?>
                    <p class="form-text">
                        <b><?=system_showText(LANG_SITEMGR_SETTINGS_EMAIL_PAYMENTRECEIVED)?></b>
                        <input type="text" name="sitemgr_payment_email" value="<?=$sitemgr_payment_email?>" placeholder="<?=system_showText(LANG_SITEMGR_LABEL_EMAIL)?>"/>                       
                    </p>                 
                <? } ?>
            <? } ?>

            <p class="form-text">
                <b><?=system_showText(LANG_SITEMGR_SETTINGS_EMAIL_REVIEWS)?></b>
                <input type="text" name="sitemgr_rate_email" value="<?=$sitemgr_rate_email?>"  placeholder="<?=system_showText(LANG_SITEMGR_LABEL_EMAIL)?>"/>                       
            </p> 


            <? if (CLAIM_FEATURE == "on") { ?>
                <p class="form-text">
                    <b><?=system_showText(LANG_SITEMGR_SETTINGS_EMAIL_CLAIMLISTING)?></b>
                    <input type="text" name="sitemgr_claim_email" value="<?=$sitemgr_claim_email?>" placeholder="<?=system_showText(LANG_SITEMGR_LABEL_EMAIL)?>"/>                       
                </p>             
            <? } ?>

            <? if (BLOG_FEATURE == "on") { ?>
                <p class="form-text">
                    <b><?=system_showText(LANG_SITEMGR_SETTINGS_EMAIL_BLOG)?></b>
                    <input type="text" name="sitemgr_blog_email" value="<?=$sitemgr_blog_email?>" placeholder="<?=system_showText(LANG_SITEMGR_LABEL_EMAIL)?>"/>                       
                </p>            
            <? } ?>

            <p class="form-text">
                <b><?=ucfirst(system_showText(LANG_SITEMGR_IMPORT))?></b>
                <input type="text" name="sitemgr_import_email" value="<?=$sitemgr_import_email?>" placeholder="<?=system_showText(LANG_SITEMGR_LABEL_EMAIL)?>"/>                       
            </p> 


            <? if (THEME_ENQUIRE_PAGE) { ?>
            <p class="form-text">
                <b><?=ucfirst(system_showText(LANG_LABEL_LEADS))?></b>
                <input type="text" name="sitemgr_lead_email" value="<?=$sitemgr_lead_email?>" placeholder="<?=system_showText(LANG_SITEMGR_LABEL_EMAIL)?>"/>                       
            </p>         
            <? } ?>

        </div>

    </div>