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
	# * FILE: /edir_core/listing/detail_info.php
	# ----------------------------------------------------------------------------------------------------

    $signUpListing = false;
    
    if (EXTRA_FIELDS_SIDEBAR && !$listingMsg && !$hideDetail) { ?>

        <p class="button-back">
            <a rel="canonical"  href="<?=$tPreview || !$user ? "javascript: void(0);" : LISTING_DEFAULT_URL?>" <?=($tPreview || !$user ? "style=\"cursor:default\"" : "")?>><?=system_showText(LANG_BACKTO.LANG_LISTING_FEATURE_NAME_PLURAL);?></a>
        </p>
    
        <span class="clear">&nbsp;</span>

        <? if ($templateFieldsInfo || $listingtemplate_email_inquiry) { ?>
            <div class="detail-info-shadow">
                <div class="detail-border">
                    <div class="detail-info">
                        <? if ($templateFieldsInfo) { ?>
                            <?=$templateFieldsInfo;?>
                        <? } ?>
                        <? if ($listingtemplate_email_inquiry) { ?>
                            <p class="button-email">
                                <?=$listingtemplate_email_inquiry;?>
                            </p>
                        <? } ?>
                    </div>
                </div>
            </div>
        <? } ?>
    <? } ?>