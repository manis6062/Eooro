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
	# * FILE: /includes/forms/form_foreignaccount.php
	# ----------------------------------------------------------------------------------------------------

?>
<? if ($message_foreignaccount) { ?>
	<div id="warning" class="<?=$message_style?>">
		<?=$message_foreignaccount?>
	</div>
<? } ?>
<br />
<table cellpadding="2" cellspacing="0" border="0" class="table-form" width="100%">

    <tr class="tr-form">
    	<th colspan="2"><div class="header-form">Facebook</div></th>
    </tr>
	<tr class="tr-form">
		<td align="right" class="td-form">
			<input type="checkbox" name="foreignaccount_facebook" id="foreignaccount_facebook" value="on" 
				<?=$foreignaccount_facebook_checked?>  class="inputCheck" /></td> 
		</td>
		<td>
			<div class="label-form" align="left"><label for="foreignaccount_facebook">
				<?=system_showText(LANG_SITEMGR_SETTINGS_LOGINOPTION_CHECKTHISBOXTOENABLEFACEBOOK);?></label></div>
		</td>
	</tr>
	<tr class="tr-form">
		<td align="right" class="td-form">
			<?=system_showText(LANG_SITEMGR_SETTINGS_LOGINOPTION_FACEBOOKAPIID)?>:
		</td>
		<td>
			<input type="text" name="foreignaccount_facebook_apiid" value="<?=$foreignaccount_facebook_apiid?>" 
				<?=((DEMO_LIVE_MODE) ? "readonly": "")?> />
		</td>
	</tr>
	<tr class="tr-form">
		<td align="right" class="td-form">
			<?=system_showText(LANG_SITEMGR_SETTINGS_LOGINOPTION_FACEBOOKAPISECRET)?>:
		</td>
		<td>
			<input type="text" name="foreignaccount_facebook_apisecret" value="<?=$foreignaccount_facebook_apisecret?>" 
				<?=((DEMO_LIVE_MODE) ? "readonly": "")?> />
		</td>
	</tr>


	<!-- GOOGLE STARTS HERE  -->
	<tr class="tr-form">
            <th colspan="2"><div class="header-form">Google</div></th>
        </tr>
	<tr class="tr-form">
		<td align="right" class="td-form">
			<input type="checkbox" name="foreignaccount_google" id="foreignaccount_google" value="on" <?=$foreignaccount_google_checked?>  class="inputCheck" />
		</td>
		<td>
			<div class="label-form" align="left"><label for="foreignaccount_google"><?=system_showText(LANG_SITEMGR_SETTINGS_LOGINOPTION_CHECKTHISBOXTOENABLEGOOGLE);?></label></div>
		</td>
	</tr>
	<tr class="tr-form">
		<td align="right" class="td-form">
			<?=system_showText(LANG_SITEMGR_SETTINGS_LOGINOPTION_GOOGLECLIENTKEY)?>:
		</td>
		<td>
			<input type="text" name="google_client_id" value="<?=$google_client_id?>" <?=((DEMO_LIVE_MODE) ? "readonly": "")?> />
		</td>
	</tr>
	<tr class="tr-form">
		<td align="right" class="td-form">
			<?=system_showText(LANG_SITEMGR_SETTINGS_LOGINOPTION_GOOGLECLIENTSECRET)?>:
		</td>
		<td>
			<input type="text" name="google_client_secret" value="<?=$google_client_secret?>" <?=((DEMO_LIVE_MODE) ? "readonly": "")?> />
		</td>
	</tr>
        <tr class="tr-form">
		<td align="right" class="td-form">
			<?=system_showText(LANG_SITEMGR_SETTINGS_LOGINOPTION_GOOGLEDEVELOPERKEY)?>:
		</td>
		<td>
			<input type="text" name="google_developer_key" value="<?=$google_developer_key?>" <?=((DEMO_LIVE_MODE) ? "readonly": "")?> />
		</td>
	</tr>
    <tr class="tr-form"><th colspan="2">&nbsp;</th></tr>


   <!-- Twitter starts here -->
     <tr class="tr-form">
    	<th colspan="2"><div class="header-form">Twitter</div></th>
    </tr>
    <tr class="tr-form">
		<td align="right" class="td-form">

			<input type="checkbox" name="foreignaccount_twitter" id="foreignaccount_twitter" value="on" <?=$foreignaccount_twitter_checked?>  class="inputCheck" />
		</td>
		<td>
			<div class="label-form" align="left"><label for="foreignaccount_twitter"><?echo "Allow visitors and sponsors to sign in with their Twitter account"?></label></div>
		</td>
	</tr>
	<tr class="tr-form">
		<td align="right" class="td-form">
			<?echo "Consumer Key"?>
		</td>
		<td>
			<input type="text" name="foreignaccount_twitter_apikey" value="<?=$foreignaccount_twitter_apikey;?>" <?=((DEMO_LIVE_MODE) ? "readonly": "")?> />
		</td>
	</tr>
	<tr class="tr-form">
		<td align="right" class="td-form">
			<?echo "Consumer Secret";?>:
		</td>
		<td>
			<input type="text" name="foreignaccount_twitter_apisecret" value="<?=$foreignaccount_twitter_apisecret;?>" <?=((DEMO_LIVE_MODE) ? "readonly": "")?> />
		</td>
	</tr>



	<!-- Linked in strats here -->

	<tr class="tr-form">
    	<th colspan="2"><div class="header-form">LinkedIn</div></th>
    </tr>
    <tr class="tr-form">
		<td align="right" class="td-form">

			<input type="checkbox" name="foreignaccount_linkedin" id="foreignaccount_linkedin" value="on" <?=$foreignaccount_linkedin_checked?>  class="inputCheck" />
		</td>
		<td>
			<div class="label-form" align="left"><label for="foreignaccount_linkedin"><?echo "Allow visitors and sponsors to sign in with their LinkeIn account"?></label></div>
		</td>
	</tr>
	<tr class="tr-form">
		<td align="right" class="td-form">
			<?echo "Consumer Key"?>
		</td>
		<td>
			<input type="text" name="foreignaccount_linkedin_apikey" value="<?=$foreignaccount_linkedin_apikey;?>" <?=((DEMO_LIVE_MODE) ? "readonly": "")?> />
		</td>
	</tr>
	<tr class="tr-form">
		<td align="right" class="td-form">
			<?echo "Consumer Secret";?>:
		</td>
		<td>
			<input type="text" name="foreignaccount_linkedin_apisecret" value="<?=$foreignaccount_linkedin_apisecret;?>" <?=((DEMO_LIVE_MODE) ? "readonly": "")?> />
		</td>
	</tr>
        
</table>
