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
	

	//Validation
	if(!isset($_SESSION['SESS_ACCOUNT_ID'])){
		header("Location: " .  NON_SECURE_URL);
		die();
	}
	$dbMain = db_getDBObject(DEFAULT_DB, true); 
	$dbDomain = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);

	$review_id = $_GET['id'];

	if($review_id){
		$sql = "SELECT * FROM $dbDomain->db_name.Review WHERE id = $review_id";
		$resource = $dbDomain->query( $sql );
		$array = mysql_fetch_array($resource);
	}
	
	if(!$_POST){

		if ($_SESSION['SESS_ACCOUNT_ID'] != $array[3]){
				header("Location: " .  NON_SECURE_URL);
				die();
		}
	}

	//End Validation

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
	//include(EDIRECTORY_ROOT."/".SOCIALNETWORK_FEATURE_NAME."/mod_rewrite.php");
	
	# ----------------------------------------------------------------------------------------------------
	# SITE CONTENT
	# ----------------------------------------------------------------------------------------------------
	$sitecontentSection = "Profile Page";
    $array_HeaderContent = front_getSiteContent($sitecontentSection);
    extract($array_HeaderContent);
    
    front_themeFiles();
    script_loader($js_fileLoader, $pag_content, $aux_module_per_page, $id, $aux_show_twitter);

?>
<? require(THEMEFILE_DIR."/".EDIR_THEME."/body/review_edit.php");
 