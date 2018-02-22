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
	# * FILE: /profile/index.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# MAINTENANCE MODE
	# ----------------------------------------------------------------------------------------------------
	verify_maintenanceMode();

	# ----------------------------------------------------------------------------------------------------
	# VALIDATION
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/includes/code/validate_querystring.php");

	if (SOCIALNETWORK_FEATURE == "off") { exit; }
    
	if (isset($_GET["oauth_token"])) {
		header("Location: ".DEFAULT_URL."/".SOCIALNETWORK_FEATURE_NAME."/edit.php?oauth_token=".$_GET["oauth_token"]);
		exit;
	}
	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSessionFront();

	# ----------------------------------------------------------------------------------------------------
	# MODE REWRITE
	# ----------------------------------------------------------------------------------------------------
	setting_get("commenting_edir", $commenting_edir);
	setting_get("review_listing_enabled", $review_enabled);
	setting_get("review_article_enabled", $review_article_enabled);
	setting_get("review_promotion_enabled", $review_promotion_enabled);
	include(EDIRECTORY_ROOT."/".SOCIALNETWORK_FEATURE_NAME."/mod_rewrite.php");
	
	# ----------------------------------------------------------------------------------------------------
	# SITE CONTENT
	# ----------------------------------------------------------------------------------------------------
	$sitecontentSection = "Profile Page";
    $array_HeaderContent = front_getSiteContent($sitecontentSection);
    extract($array_HeaderContent);

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
        
            $headertag_title = $headertagtitle;
            $headertag_description = $headertagdescription;
            $headertag_keywords = $headertagkeywords;
            $hide_search = true;
    if(!$view_profile){
            include(system_getFrontendPath("header.php", "layout"));
        
	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	require(EDIRECTORY_ROOT."/frontend/checkregbin.php");
	$levelObj = new ListingLevel();

	# ----------------------------------------------------------------------------------------------------
	# BODY
	# ----------------------------------------------------------------------------------------------------
	if (sess_validateSessionItens("general", "see_profile", true, $id? "": 0)) {
		$info = socialnetwork_retrieveInfoProfile($id);
		$accountObj = new Account(sess_getAccountIdFromSession());
		if($accountObj->active != "y" && ($accountObj->id == $id)){
                    echo "<div class='container'><div class=\"content-custom alert alert-danger\"><strong><font color = \"red\">Your account is not activated. Please activate it. <a class='forcePointer' onclick='sendEmailActivation(".$accountObj->id.")';>Click here to resend activation email.</a> <img id='loadEmail99' style='display:none;' src='".DEFAULT_URL."/images/img_loading.gif'></font></strong></div></div>";
                }
                // todo: clean/sanitize all get/post variables throught the project
                if($_GET['messageAct']){
                    echo '<div class="container"><div class="content-custom alert alert-success"><strong>'.system_showText(LANG_MSG_ACCOUNT_ACTIVATED).'</strong></div></div>';
                }
            require(THEMEFILE_DIR."/".EDIR_THEME."/body/profile_index.php");                
        }

    $contentObj = new Content();
	$sitecontentSection = "Profile Page Bottom";
	$sitecontentinfo = $contentObj->retrieveContentInfoByType($sitecontentSection);
	if ($sitecontentinfo) {
		$headertagtitle = $sitecontentinfo["title"];
		$headertagdescription = $sitecontentinfo["description"];
		$headertagkeywords = $sitecontentinfo["keywords"];
		$sitecontent = $sitecontentinfo["content"];
	} else {
		$headertagtitle = "";
		$headertagdescription = "";
		$headertagkeywords = "";
		$sitecontent = "";
	}

	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
        ?>
        
        <?
          include(system_getFrontendPath("footer.php", "layout"));
          }
        ?> 
        

<script language="javascript" type="text/javascript" src="<?=DEFAULT_URL?>/scripts/activationEmail.js"></script>