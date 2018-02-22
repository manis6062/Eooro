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
	# * FILE: /sitemgr/content/content_homepage.php
	# ----------------------------------------------------------------------------------------------------

    # ----------------------------------------------------------------------------------------------------
	# FORMS DEFINES
	# ----------------------------------------------------------------------------------------------------
    if ($_SERVER["REQUEST_METHOD"] != "POST") {
        setting_get("front_text_top", $front_text_top);
        setting_get("front_text_sidebar", $front_text_sidebar);
        setting_get("front_text_sidebar2", $front_text_sidebar2);
        setting_get("front_testimonial", $front_testimonial);
        setting_get("front_testimonial_author", $front_testimonial_author);
        setting_get("front_itunes_url", $front_itunes_url);
        setting_get("front_gplay_url", $front_gplay_url);
        setting_get("front_review_counter", $front_review_counter);
    }

    setting_get("commenting_edir", $commenting_edir);
    setting_get("review_listing_enabled", $review_enabled);
    
    include(EDIRECTORY_ROOT."/includes/code/thumbnail.php");

?>

    <table cellpadding="0" cellspacing="0" border="0" class="standard-table">
        <tr>
            <th colspan="2" class="standard-tabletitle"><?=system_showText(LANG_SITEMGR_EXTRA_CONTENT);?></th>
        </tr>
        <tr>
            <th><?=system_showText(LANG_SITEMGR_EXTRA_ADVTEXT_TOP);?>:</th>
            <td>
                <input type="text" name="front_text_top" value="<?=htmlspecialchars($front_text_top);?>" maxlength="50" />
                <span><?=system_showText(LANG_SITEMGR_EXTRA_ADVTEXT_TOP_TIP);?></span>
            </td>
        </tr>
        <tr>
            <th><?=system_showText(LANG_SITEMGR_EXTRA_ADVTEXT_SIDEBAR);?>:</th>
            <td>
                <input type="text" name="front_text_sidebar" value="<?=htmlspecialchars($front_text_sidebar);?>" maxlength="50" />
                <span><?=system_showText(LANG_SITEMGR_EXTRA_ADVTEXT_SIDEBAR_TIP);?></span>
            </td>
        </tr>
        <tr>
            <th><?=system_showText(LANG_SITEMGR_EXTRA_ADVTEXT_SIDEBAR2);?>:</th>
            <td>
                <input type="text" name="front_text_sidebar2" value="<?=htmlspecialchars($front_text_sidebar2);?>" maxlength="50" />
                <span><?=system_showText(LANG_SITEMGR_EXTRA_ADVTEXT_SIDEBAR2_TIP);?></span>
            </td>
        </tr>
        <tr>
            <th><?=system_showText(LANG_SITEMGR_EXTRA_ADVTEXT_TESTIMONIAL);?>:</th>
            <td>
                <input type="text" name="front_testimonial" value="<?=htmlspecialchars($front_testimonial);?>" maxlength="200" />
                <span><?=system_showText(LANG_SITEMGR_EXTRA_ADVTEXT_TESTIMONIAL_TIP);?></span>
            </td>
        </tr>
        <tr>
            <th><?=system_showText(LANG_SITEMGR_EXTRA_ADVTEXT_TESTIMONIAL_AUTHOR);?>:</th>
            <td>
                <input type="text" name="front_testimonial_author" value="<?=htmlspecialchars($front_testimonial_author);?>" maxlength="60" />
                <span><?=system_showText(LANG_SITEMGR_EXTRA_ADVTEXT_TESTIMONIAL_TIP2);?></span>
            </td>
        </tr>
        <tr>
            <th class="formLabelAlign">
                <?=system_showText(LANG_SITEMGR_EXTRA_ADVTEXT_TESTIMONIAL_IMAGE)?>:<br /><br />
            </th>
            <td class="columnFile">
                <input type="file" name="image" id="image" size="50" onchange="UploadImage('content');" class="inputExplode" /><span>160px x 280px. <?=system_showText(LANG_MSG_MAX_FILE_SIZE)?> <?=UPLOAD_MAX_SIZE;?> MB. <?=system_showText(LANG_MSG_ANIMATEDGIF_NOT_SUPPORTED);?></span>
                <?//Crop Tool Inputs?>
                <input type="hidden" name="x" id="x">
                <input type="hidden" name="y" id="y">
                <input type="hidden" name="x2" id="x2">
                <input type="hidden" name="y2" id="y2">
                <input type="hidden" name="w" id="w">
                <input type="hidden" name="h" id="h">
                <input type="hidden" name="image_width" id="image_width">
                <input type="hidden" name="image_height" id="image_height">
                <input type="hidden" name="image_type" id="image_type">
                <input type="hidden" name="crop_submit" id="crop_submit">
            </td>
        </tr>
        <? if (file_exists(EDIRECTORY_ROOT.IMAGE_TESTIMONIAL_PATH)) { ?>
        <tr>
            <th>&nbsp;</th>
            <td align="left">
                <input type="checkbox" name="remove_image" class="inputCheck" value="1" style="vertical-align:middle;" /> <?=system_showText(LANG_MSG_CHECK_TO_REMOVE_IMAGE)?>
            </td>
        </tr>
        <? } ?>
        <tr>
            <th><?=system_showText(LANG_SITEMGR_EXTRA_IOS)?>:</th>
            <td>
                <input type="text" name="front_itunes_url" value="<?=htmlspecialchars($front_itunes_url);?>" />
                <span><?=system_showText(LANG_SITEMGR_EXTRA_IOS_TIP)?></span>
            </td>
        </tr>
        <tr>
            <th><?=system_showText(LANG_SITEMGR_EXTRA_ANDROID)?>:</th>
            <td>
                <input type="text" name="front_gplay_url" value="<?=htmlspecialchars($front_gplay_url);?>" />
                <span><?=system_showText(LANG_SITEMGR_EXTRA_ANDROID_TIP)?></span>
            </td>
        </tr>
        <? if ($review_enabled == "on" && $commenting_edir) { ?>
        <tr>
            <th><input type="checkbox" name="front_review_counter" value="on" <?=($front_review_counter == "on" ? "checked=\"checked\"" : "")?> /></th>
            <td><?=system_showText(LANG_SITEMGR_EXTRA_REVIEW);?><span><?=system_showText(LANG_SITEMGR_EXTRA_REVIEW_TIP);?></span></td>
        </tr>
        <? } ?>
    </table>