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
	# * FILE: /sitemgr/prefs/share.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");
	
	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();

	# ----------------------------------------------------------------------------------------------------
	# VALIDATING FEATURES
	# ----------------------------------------------------------------------------------------------------
	extract($_POST);
	extract($_GET);	

	//increases frequently actions
	if ($_SERVER["REQUEST_METHOD"] != "POST") system_setFreqActions('prefs_share', 'prefsshare');
    
    # ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        if (!setting_set("button_share_facebook", $share_facebook))
            if (!setting_new("button_share_facebook", $share_facebook))
                $error = true;
            
        if (!setting_set("button_share_google", $share_google))
            if (!setting_new("button_share_google", $share_google))
                $error = true;
            
        if (!setting_set("button_share_pinterest", $share_pinterest))
            if (!setting_new("button_share_pinterest", $share_pinterest))
                $error = true;
            
        if ($error) {
            $message_share = "<p class=\"errorMessage\">".system_showText(LANG_SITEMGR_MSGERROR_SYSTEMERROR)."</p>";
        } else {
            header("Location: ".DEFAULT_URL."/".SITEMGR_ALIAS."/prefs/share.php?success=1");
            exit;
        }
    }
	
	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/header.php");

	# ----------------------------------------------------------------------------------------------------
	# NAVBAR
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/navbar.php");
    
    # ----------------------------------------------------------------------------------------------------
	# FORMS DEFINES
	# ----------------------------------------------------------------------------------------------------
	setting_get("button_share_facebook", $button_share_facebook);
	if ($button_share_facebook) $share_facebook_checked = "checked";
    
    setting_get("button_share_google", $button_share_google);
	if ($button_share_google) $share_google_checked = "checked";
    
    setting_get("button_share_pinterest", $button_share_pinterest);
	if ($button_share_pinterest) $share_pinterest_checked = "checked";

?>
    <div id="main-right">

		<div id="top-content">
			<div id="header-content">
				<h1><?=system_showText(LANG_SITEMGR_SETTINGS_SITEMGRSETTINGS)?> - <?=system_showText(LANG_SITEMGR_SHARE)?></h1>
			</div>
		</div>

		<div id="content-content">
            
			<div class="default-margin">

				<? require(EDIRECTORY_ROOT."/".SITEMGR_ALIAS."/registration.php"); ?>
				<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
				<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

				<br />

				<form name="settings_share" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">
                    
                    <p><?=system_showText(LANG_SITEMGR_SETTINGS_SHARE_TIP1);?></p>
                    
                    <?  if ($message_share) {
                            echo $message_share;
                        } elseif ($success) {
                            echo "<p class=\"successMessage\">".system_showText(LANG_SITEMGR_SETTINGS_SHARE_SUCCESS)."</p>";
                        }
                    ?>
                    
                    <br class="clear" />
                        
					<table cellpadding="0" cellspacing="0" border="0" class="standard-table">
                        
                        <tr>
                            <th colspan="2" class="standard-tabletitle">Facebook</th>
                        </tr>
                        
                        <tr>
                            <th>
                                <input type="checkbox" name="share_facebook" value="on" <?=$share_facebook_checked?>  class="inputCheck" />
                            </th>
                            <td><?=system_showText(LANG_SITEMGR_SETTINGS_SHARE_FACEBOOK);?></td>
                        </tr>
                        
                        <tr>
                           <th colspan="2" class="standard-tabletitle">Google+</th>
                        </tr>
                        <tr>
                            <th>
                                <input type="checkbox" name="share_google" value="on" <?=$share_google_checked?>  class="inputCheck" />
                            </th>
                            <td>
                                <?=system_showText(LANG_SITEMGR_SETTINGS_SHARE_GOOGLE);?>
                                <span><?=system_showText(LANG_SITEMGR_SETTINGS_SHARE_TIP2);?></span> 
                            </td>
                        </tr>
                        
                        <tr>
                            <th colspan="2" class="standard-tabletitle">Pinterest</th>
                        </tr>
                        <tr>
                            <th>
                                <input type="checkbox" name="share_pinterest" value="on" <?=$share_pinterest_checked?>  class="inputCheck" />
                            </th>
                            <td>
                                <?=system_showText(LANG_SITEMGR_SETTINGS_SHARE_PINTEREST);?>
                                <span><?=system_showText(LANG_SITEMGR_SETTINGS_SHARE_TIP3);?></span>
                            </td>
                        </tr>

                    </table>
                    
					<table style="margin: 0 auto 0 auto;">
						<tr>
							<td>
								<button type="submit" name="settings_share" value="Submit" class="input-button-form"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
							</td>
						</tr>
					</table>
                    
				</form>

			</div>
		</div>

		<div id="bottom-content">
			&nbsp;
		</div>

	</div>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>