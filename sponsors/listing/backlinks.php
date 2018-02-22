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
	if(!$_SERVER['HTTP_X_REQUESTED_WITH']){
	    header("Location:".DEFAULT_URL."/".ALIAS_LISTING_MODULE);
	    exit;
	}
	# ----------------------------------------------------------------------------------------------------
	# * FILE: /members/listing/backlinks.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSession();
	$acctId = sess_getAccountIdFromSession();
	
	if (BACKLINK_FEATURE == "off") {
		header("Location: ".DEFAULT_URL."/".MEMBERS_ALIAS."/");
		exit;
	}

    # ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_GET);
	extract($_POST);

	$url_redirect = DEFAULT_URL."/".MEMBERS_ALIAS;
	$url_base = DEFAULT_URL."/".MEMBERS_ALIAS;
	$members = 1;
	
    if ($id) {
		$level = new ListingLevel();
		$listing = new Listing($id);
		if ($acctId != $listing->getNumber("account_id")) {
			header("Location: ".DEFAULT_URL."/".MEMBERS_ALIAS."/");
			exit;
		}
		$listingHasBacklink = $level->getBacklink($listing->getNumber("level"));
		if ((!$listingHasBacklink) || ($listingHasBacklink != "y")) {
			header("Location: ".DEFAULT_URL."/".MEMBERS_ALIAS);
			exit;
		}
	} else {
		header("Location: ".DEFAULT_URL."/".MEMBERS_ALIAS."/");
		exit;
	}
	
    # ----------------------------------------------------------------------------------------------------
    # CODE
    # ----------------------------------------------------------------------------------------------------
    include(EDIRECTORY_ROOT."/includes/code/backlinks.php");
    ?>

	<div <?=(EDIR_THEME==='review') ? '' : ''?>>

		<? require(EDIRECTORY_ROOT."/".SITEMGR_ALIAS."/registration.php"); ?>
		<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
		<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

        <? if($listing->status == "A") {?>
	        <div class="package">

	            <form name="backlinks" id="backlinks" method="post" action="<?=system_getFormAction($_SERVER["PHP_SELF"]);?>">
	                
	                <input type="hidden" name="id" value="<?=$id?>" />
	                <input type="hidden" id="backlinkValid" name="backlinkValid" value="0" />
	                
	                <? include(EDIRECTORY_ROOT."/includes/forms/form_backlinks.php");?>
	            </form>

	        </div>
	    <? } else { 
	    	include(INCLUDES_DIR."/views/view_listing_not_activated.php");
	    } ?>
	</div>