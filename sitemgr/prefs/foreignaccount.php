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
	# * FILE: /sitemgr/prefs/foreignaccount.php
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
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------

	extract($_POST);
	extract($_GET);
	//increases frequently actions
	if (!isset($foreignaccount)) system_setFreqActions('prefs_signinoptions','prefssign');

	$message_style = "successMessage";
	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		$invalidID = false;
		if (!preg_match("/^[0-9]*$/", $foreignaccount_facebook_apiid)) {
			$error = true;
			$invalidID = true;
		}
		if (!$invalidID) {
//for google           

	                if (($foreignaccount_google && $google_client_id && $google_client_secret && $google_developer_key) ||
	                        (!$foreignaccount_google && !$google_client_id && !$google_client_secret && !$google_developer_key)) 
	                {
	                        if (!setting_set("foreignaccount_google", $_POST['foreignaccount_google']))
	                            if (!setting_new("foreignaccount_google", $_POST['foreignaccount_google']))
						$error = true;
	                                    
	                                if (!setting_set("google_client_id", $google_client_id))
	                                    if (!setting_new("google_client_id", $google_client_id))
						$error = true;    
	                                
	                                if (!setting_set("google_client_secret", $google_client_secret))
	                                    if (!setting_new("google_client_secret", $google_client_secret))
						$error = true;  
	                                
	                                if (!setting_set("google_developer_key", $google_developer_key))
	                                    if (!setting_new("google_developer_key", $google_developer_key))
						$error = true;      
	                } 
	                else 
	                {
	                    $error= false;
	                    if ($google_client_id && $google_client_secret && $google_developer_key) {
	                          if (!setting_set("foreignaccount_google", $foreignaccount_google))
							      if (!setting_new("foreignaccount_google", $foreignaccount_google))
							      	$error = true;  
				                                
				                                  if (!setting_set("google_client_id", $google_client_id))
				                                  if (!setting_new("google_client_id", $google_client_id))
			    					$error = true;
				                                  
				                                  if (!setting_set("google_client_secret", $google_client_secret))
				                                  if (!setting_new("google_client_secret", $google_client_secret))
								    $error = true;
				                                  
				                                  if (!setting_set("google_developer_key", $google_developer_key))
				                                  if (!setting_new("google_developer_key", $google_developer_key))
								    $error = true;
	                    }
	                    else if (!$foreignaccount_google || !$google_client_id || !$google_client_secret || !$google_developer_key)
	                    {
	                        $error = true;  
	                    }
	        }        
//for facebook
			if (($foreignaccount_facebook && $foreignaccount_facebook_apisecret && $foreignaccount_facebook_apiid) ||
                                (!$foreignaccount_facebook && !$foreignaccount_facebook_apisecret && !$foreignaccount_facebook_apiid)) {
				if (!setting_set("foreignaccount_facebook", $foreignaccount_facebook))
					if (!setting_new("foreignaccount_facebook", $foreignaccount_facebook))
						$error = true;

				if (!setting_set("foreignaccount_facebook_apisecret", $foreignaccount_facebook_apisecret))
					if (!setting_new("foreignaccount_facebook_apisecret", $foreignaccount_facebook_apisecret))
						$error = true;

				if (!setting_set("foreignaccount_facebook_apiid", $foreignaccount_facebook_apiid))
					if (!setting_new("foreignaccount_facebook_apiid", $foreignaccount_facebook_apiid))
						$error = true;
			} else {
				$error = false;

				if ($foreignaccount_facebook_apisecret && $foreignaccount_facebook_apiid) {


					if (!setting_set("foreignaccount_facebook", $foreignaccount_facebook))
						if (!setting_new("foreignaccount_facebook", $foreignaccount_facebook))
							$error = true;

					if (!setting_set("foreignaccount_facebook_apisecret", $foreignaccount_facebook_apisecret))
						if (!setting_new("foreignaccount_facebook_apisecret", $foreignaccount_facebook_apisecret))
							$error = true;

					if (!setting_set("foreignaccount_facebook_apiid", $foreignaccount_facebook_apiid))
						if (!setting_new("foreignaccount_facebook_apiid", $foreignaccount_facebook_apiid))
							$error = true;
				} else if (!$foreignaccount_facebook || !$foreignaccount_facebook_apisecret || !$foreignaccount_facebook_apiid) {
					$error = true;
				}
			}
//For Twitter
		  if (($foreignaccount_twitter  && $foreignaccount_twitter_apisecret && $foreignaccount_twitter_apikey) ||
                            (!$foreignaccount_twitter && !$foreignaccount_twitter_apisecret && !$foreignaccount_twitter_apikey)) 
                    {
                            if (!setting_set("foreignaccount_twitter", $foreignaccount_twitter))
                                if (!setting_new("foreignaccount_twitter", $foreignaccount_twitter))
                $error = true;    
                            
                            if (!setting_set("foreignaccount_twitter_apisecret", $foreignaccount_twitter_apisecret))
                                if (!setting_new("foreignaccount_twitter_apisecret", $foreignaccount_twitter_apisecret))
				$error = true;  
                            
                            if (!setting_set("foreignaccount_twitter_apikey", $foreignaccount_twitter_apikey))
                                if (!setting_new("foreignaccount_twitter_apikey", $foreignaccount_twitter_apikey))
				$error = true;      
                    } 
                    else 
                    {
                            $error= false;
                            if ($foreignaccount_twitter_apisecret && $foreignaccount_twitter_apikey) {
                                  if (!setting_set("foreignaccount_twitter", $foreignaccount_twitter))
			      if (!setting_new("foreignaccount_twitter", $foreignaccount_twitter))
		        	$error = true;  
                                
                                  if (!setting_set("foreignaccount_twitter_apisecret", $foreignaccount_twitter_apisecret))
                                  if (!setting_new("foreignaccount_twitter_apisecret", $foreignaccount_twitter_apisecret))
				    $error = true;
                                  
                                  if (!setting_set("foreignaccount_twitter_apikey", $foreignaccount_twitter_apikey))
                                  if (!setting_new("foreignaccount_twitter_apikey", $foreignaccount_twitter_apikey))
				    $error = true;
                            }
                            else if (!$foreignaccount_twitter || !$foreignaccount_twitter_apisecret || !$foreignaccount_twitter_apikey)
                            {
                                $error = true;  
                            }
                        }

//For LinkedIn    
			  if (($foreignaccount_linkedin  && $foreignaccount_linkedin_apisecret && $foreignaccount_linkedin_apikey) ||
                            (!$foreignaccount_linkedin && !$foreignaccount_linkedin_apisecret && !$foreignaccount_linkedin_apikey)) 
                    {
                            if (!setting_set("foreignaccount_linkedin", $foreignaccount_linkedin))
                                if (!setting_new("foreignaccount_linkedin", $foreignaccount_linkedin))
				
                          
				$error = true;    
                            
                            if (!setting_set("foreignaccount_linkedin_apisecret", $foreignaccount_linkedin_apisecret))
                                if (!setting_new("foreignaccount_linkedin_apisecret", $foreignaccount_linkedin_apisecret))
				$error = true;  
                            
                            if (!setting_set("foreignaccount_linkedin_apikey", $foreignaccount_linkedin_apikey))
                                if (!setting_new("foreignaccount_linkedin_apikey", $foreignaccount_linkedin_apikey))
				$error = true;      
                    } 
                    else 
                    {
                        $error= false;
                        if ($foreignaccount_linkedin_apisecret && $foreignaccount_linkedin_apikey) {
                              if (!setting_set("foreignaccount_linkedin", $foreignaccount_linkedin))
							      if (!setting_new("foreignaccount_linkedin", $foreignaccount_linkedin))
							      	$error = true;  
					                            
					                              if (!setting_set("foreignaccount_linkedin_apisecret", $foreignaccount_linkedin_apisecret))
					                              if (!setting_new("foreignaccount_linkedin_apisecret", $foreignaccount_linkedin_apisecret))
								    $error = true;
					                              
					                              if (!setting_set("foreignaccount_linkedin_apikey", $foreignaccount_linkedin_apikey))
					                              if (!setting_new("foreignaccount_linkedin_apikey", $foreignaccount_linkedin_apikey))
								    $error = true;
                        }
                        else if (!$foreignaccount_linkedin || !$foreignaccount_linkedin_apisecret || !$foreignaccount_linkedin_apikey)
                        {
                            $error = true;  
                        }
                    }


			
		}
		if (!$error) {
			$actions[] = '&#149;&nbsp;'.system_showText(LANG_SITEMGR_SETTINGS_LOGINOPTION_CONFIGURATIONWASCHANGED);
		} else {
			if ($invalidID) $actions[] = '&#149;&nbsp;'.system_showText(LANG_SITEMGR_MSGERROR_SYSTEMERROR_API);
			else $actions[] = '&#149;&nbsp;'.system_showText(LANG_SITEMGR_SETTINGS_LOGINOPTION_EMPTYKEYS);
			$message_style = "errorMessage";
		}
		if ($actions) {
			$message_foreignaccount .= implode("<br />", $actions);
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
	/**
	 * Facebook Account
	 */
	setting_get("foreignaccount_facebook", $foreignaccount_facebook);
	if ($foreignaccount_facebook) $foreignaccount_facebook_checked = "checked";
	if (!$foreignaccount_facebook_apisecret) setting_get("foreignaccount_facebook_apisecret", $foreignaccount_facebook_apisecret);
	if (!$foreignaccount_facebook_apiid) setting_get("foreignaccount_facebook_apiid", $foreignaccount_facebook_apiid);
	
	/**
	 * Google Account
	 */
	setting_get("foreignaccount_google", $foreignaccount_google);
	if ($foreignaccount_google) $foreignaccount_google_checked = "checked";
        if (!$google_client_id) setting_get("google_client_id", $google_client_id);
        if (!$google_client_secret) setting_get("google_client_secret", $google_client_secret);
        if (!$google_developer_key) setting_get("google_developer_key", $google_developer_key);


     /**
	 * Twitter Account
	 */   

	setting_get("foreignaccount_twitter", $foreignaccount_twitter);
	if ($foreignaccount_twitter) $foreignaccount_twitter_checked = "checked";
        if (!$foreignaccount_twitter_apisecret) setting_get("foreignaccount_twitter_apisecret", $foreignaccount_twitter_apisecret);
        if (!$foreignaccount_twitter_apikey) setting_get("foreignaccount_twitter_apikey", $foreignaccount_twitter_apikey);

	 /**
	 * LinkedIn Account
	 */
    setting_get("foreignaccount_linkedin", $foreignaccount_linkedin);
	if ($foreignaccount_linkedin) $foreignaccount_linkedin_checked = "checked";
        if (!$foreignaccount_linkedin_apisecret) setting_get("foreignaccount_linkedin_apisecret", $foreignaccount_linkedin_apisecret);
        if (!$foreignaccount_linkedin_apikey) setting_get("foreignaccount_linkedin_apikey", $foreignaccount_linkedin_apikey);

?>

<div id="main-right">

	<div id="top-content">
		<div id="header-content">
			<h1><?=system_showText(LANG_SITEMGR_SETTINGS_SITEMGRSETTINGS)?> - <?=system_showText(LANG_SITEMGR_MENU_LOGINOPTIONS)?></h1>
		</div>
	</div>

	<div id="content-content">
		<div class="default-margin">

			<? require(EDIRECTORY_ROOT."/".SITEMGR_ALIAS."/registration.php"); ?>
			<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
			<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

			<br />

			<form name="foreignaccount" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">
				<? include(INCLUDES_DIR."/forms/form_foreignaccount.php"); ?>
				<table style="margin: 0 auto 0 auto;">
					<tr>
						<td>
							<button type="submit" name="foreignaccount" value="Submit" class="input-button-form"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
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
