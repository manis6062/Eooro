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
	# * FILE: /members/event/event.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (EVENT_FEATURE != "on" || CUSTOM_EVENT_FEATURE != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSession();
	$acctId = sess_getAccountIdFromSession();
	$members = 1;
	$item_form    = 1;

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_POST);
	extract($_GET);

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	$url_redirect = "".DEFAULT_URL."/".MEMBERS_ALIAS;
	$url_base = "".DEFAULT_URL."/".MEMBERS_ALIAS."";

	include(EDIRECTORY_ROOT."/includes/code/event.php");

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/header.php");

	# ----------------------------------------------------------------------------------------------------
	# NAVBAR
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/navbar.php");

?>

    <div class="content">

        <? require(EDIRECTORY_ROOT."/".SITEMGR_ALIAS."/registration.php"); ?>
        <? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
        <? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

        <h2><?=system_showText(LANG_EVENT_INFORMATION)?></h2>

        <form name="form_event" id="form_event" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post" enctype="multipart/form-data">

            <input type="hidden" name="process" id="process" value="<?=$process?>" />
            <input type="hidden" name="id" value="<?=$id?>" />
            <input type="hidden" name="account_id" value="<?=$acctId?>" />
            <input type="hidden" name="level" id="level" value="<?=$level?>" />
            <input type="hidden" name="using_package" id="using_package" value="<?=($package_id ? "y" : "n")?>" />
            <input type="hidden" name="package_id" id="package_id" value="<?=$package_id?>" />
            <input type="hidden" name="gallery_hash" value="<?=$gallery_hash?>" />

            <? include(INCLUDES_DIR."/forms/form_event.php"); ?>

        </form>

        <form action="<?=DEFAULT_URL?>/<?=MEMBERS_ALIAS?>/" method="get">

            <div class="baseButtons">

                <p class="standardButton">
                    <button type="button" onclick="JS_submit()"><?=system_showText(LANG_BUTTON_SUBMIT)?></button>
                </p>
                <p class="standardButton">
                    <button type="submit" value="Cancel"><?=system_showText(LANG_BUTTON_CANCEL)?></button>
                </p>

            </div>

        </form>

    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            //DATE PICKER
            <?
            if ( DEFAULT_DATE_FORMAT == "m/d/Y" ) $date_format = "mm/dd/yy";
            elseif ( DEFAULT_DATE_FORMAT == "d/m/Y" ) $date_format = "dd/mm/yy";
            ?>

            $('#start_date').datepicker({
                dateFormat: '<?=$date_format?>',
                changeMonth: true,
                changeYear: true,
                yearRange: '<?=date("Y")-1?>:<?=date("Y")+10?>'
            });

            $('#end_date').datepicker({
                dateFormat: '<?=$date_format?>',
                changeMonth: true,
                changeYear: true,
                yearRange: '<?=date("Y")?>:<?=date("Y")+10?>'
            });

            $('#until_date').datepicker({
                dateFormat: '<?=$date_format?>',
                changeMonth: true,
                changeYear: true,
                yearRange: '<?=date("Y")?>:<?=date("Y")+10?>'
        });
        });
    </script>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/footer.php");
?>