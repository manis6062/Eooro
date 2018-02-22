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
	# * FILE: /includes/forms/form_content_footer.php
	# ----------------------------------------------------------------------------------------------------

?>

<table class="standard-table">
	<tr>
		<th colspan="2" class="standard-tabletitle"><?=string_ucwords(system_showText(LANG_SITEMGR_CONTENT_FOOTERINFORMATION))?></th>
	</tr>
</table>
<table class="standard-table">
	<tr>
		<th><?=system_showText(LANG_SITEMGR_LABEL_COPYRIGHTTEXT)?>:</th>
		<td class="formContentFooter">
            <input type="text" class="httpInput" name="copyright" value="<?=$copyright?>" maxlength="255" style="width:630px" />
        </td>
	</tr>
	<tr>
		<th><?=system_showText(LANG_SITEMGR_LABEL_FACEBOOK_LINK)?>:</th>
		<td>
			<?=$dropdownFB_protocol;?>
			<input type="text" class="httpInput" name="setting_facebook_link" value="<?=str_replace($protocolFB_replace, "", $setting_facebook_link)?>" maxlength="255" style="width:532px"/>
		</td>
	</tr>
	<tr>
		<th><?=system_showText(LANG_SITEMGR_LABEL_LINKEDIN_LINK)?>:</th>
		<td>
			<?=$dropdownLK_protocol;?>
			<input type="text" class="httpInput" name="setting_linkedin_link" value="<?=str_replace($protocolLK_replace, "", $setting_linkedin_link)?>" maxlength="255" style="width:532px"/>
		</td>
	</tr>
    <tr>
		<th><?=system_showText(LANG_LABEL_TWITTER_ACCOUNT)?>:</th>
		<td class="formContentFooter">
                    <!-- modification  -->
			<input type="text" class="httpInput" name="twitter_account" value="<?=$twitter_account?>" maxlength="255" style="width:630px"/>
                    <!--<textarea class="httpInput" name="twitter_account"><?//$twitter_account?></textarea>
		</td>
	</tr>
        <!--  modification added google account  -->
    <tr>
        <th><?=system_showText(LANG_SITEMGR_TWITTER_FEED)?>:</th>
        <td class="formContentFooter">
            <input type="text" class="httpInput" name="twitter_feed" value="<?=$twitter_feed?>" maxlength="255" style="width:630px"/>
        </td>
    </tr>
        <tr>
            <th>Google Account URL:</th>
            <td>
                <input type="text" class="httpInput" name="setting_googleplus_link" value="<?=$setting_googleplus_link?>" />
            </td>
        </tr>
</table>