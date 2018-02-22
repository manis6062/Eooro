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
	# * FILE: /members/listing/clicktocall.php
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

	$url_redirect = "".DEFAULT_URL."/".MEMBERS_ALIAS;
	$url_base = "".DEFAULT_URL."/".MEMBERS_ALIAS."";
	$members = 1;
	
	extract($_POST);
	extract($_GET);

	$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));
	
	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	if (TWILIO_APP_ENABLED != "on" || TWILIO_APP_ENABLED_CALL != "on"){
		header("Location: ".DEFAULT_URL."/".MEMBERS_ALIAS."/");
		exit;
	}
	
	if ($id) {
		$level = new ListingLevel();
		$listing = new Listing($id);
        $accId = $listing->getNumber("account_id");
		if ((!$listing->getNumber("id")) || ($listing->getNumber("id") <= 0)) {
			header("Location: ".DEFAULT_URL."/".MEMBERS_ALIAS."/");
			exit;
		}
		if (sess_getAccountIdFromSession() != $listing->getNumber("account_id")) {
			header("Location: ".DEFAULT_URL."/".MEMBERS_ALIAS."/");
			exit;
		}
		$listingHasClickToCall = $level->getHasCall($listing->getNumber("level"));
		if ((!$listingHasClickToCall) || ($listingHasClickToCall != "y")) {
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
	include(EDIRECTORY_ROOT."/includes/code/clicktocall.php");

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/header.php");

	# ----------------------------------------------------------------------------------------------------
	# NAVBAR
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/navbar.php");

    include(MEMBERS_EDIRECTORY_ROOT."/".LISTING_FEATURE_FOLDER."/navbar.php"); ?>

    <div>

        <? require(EDIRECTORY_ROOT."/".SITEMGR_ALIAS."/registration.php"); ?>
        <? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
        <? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>


        <form name="clicktocall_form" id="clicktocall_form" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">

            <input type="hidden" name="id" id="id" value="<?=$id?>" />						
            <input type="hidden" name="item_title" id="item_title" value="<?=$item_title?>" />						
            <input type="hidden" name="module" id="module" value="<?=$module?>" />						
            <?=system_getFormInputSearchParams((($_POST)?($_POST):($_GET)));?>

            <div class="well-text">
                <h2><?=system_showText(LANG_CLICKTOCALL_TIPTITLE)?></h2>

                <p><?=system_showText(LANG_CLICKTOCALL_TIP2)?></p>
            </div>

            <?
            include(INCLUDES_DIR."/forms/form_clicktocall.php");
            ?>

            <div class="baseButtons baseButtonsClick">

                <p class="standardButton">
                    <button type="submit" name="submit_button" value="Submit">
                        <?=system_showText(LANG_CLICKTOCALL_ACTIVATE)?>
                    </button>
                </p>

                <p class="standardButton <?=!$enableSave ? "standardButton-disabled" : ""?>" id="buttonSaveCopy" <?=!$enableSave ? " disabled=\"disabled\"" : "onclick=\"changeSendForm('checkClickToCall');\""?>>
                    <button type="button" name="check_button" value="validate" >
                        <?=system_showText(LANG_MSG_SAVE_CHANGES)?>
                    </button>
                </p>

                <p class="standardButton <?=!$itemObj->getString("clicktocall_number") ? "standardButton-disabled" : "" ?>" <?=!$itemObj->getString("clicktocall_number") ? " disabled=\"disabled\"" : "onclick=\"changeSendForm('clearNumber');\""?>>
                    <button type="button" name="check_button" value="clear" >
                        <?=system_showText(LANG_BUTTON_CLEAR)?>
                    </button>
                </p>

            </div>
        </form>
    </div>
<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/footer.php");
?>