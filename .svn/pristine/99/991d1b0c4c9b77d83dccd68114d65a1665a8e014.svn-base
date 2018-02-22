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
	# * FILE: /sitemgr/mobile/notification.php
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

	$url_redirect = "".DEFAULT_URL."/".SITEMGR_ALIAS."/mobile";
	$url_base = "".DEFAULT_URL."/".SITEMGR_ALIAS."";
	$sitemgr = 1;

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_POST);
	extract($_GET);

	$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

	//increases frequently actions
	if ($_SERVER["REQUEST_METHOD"] != "POST") system_setFreqActions('mobile_notif_add', 'app_notifications');

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/includes/code/mobilenotif.php");

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/header.php");

	# ----------------------------------------------------------------------------------------------------
	# NAVBAR
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/navbar.php");

?>

    <div id="main-right">

        <div id="top-content">
            <div id="header-content">
                <h1><?=system_showText(LANG_SITEMGR_MOBILE);?> - <?=system_showText(LANG_SITEMGR_MOBILE_NOTIFICATIONS)?></h1>
            </div>
        </div>

        <div id="content-content">
            
            <div class="default-margin">

                <?
                require(EDIRECTORY_ROOT."/".SITEMGR_ALIAS."/registration.php");
                require(EDIRECTORY_ROOT."/includes/code/checkregistration.php");
                require(EDIRECTORY_ROOT."/frontend/checkregbin.php");
                
                include(INCLUDES_DIR."/tables/table_mobilenotif_submenu.php"); ?>

                <div class="baseForm">

                    <form name="notification" id="notification" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">

                        <input type="hidden" name="sitemgr" id="sitemgr" value="<?=$sitemgr?>" />
                        <input type="hidden" name="id" id="id" value="<?=$id?>" />
                        <input type="hidden" name="letter" value="<?=$letter?>" />
                        <input type="hidden" name="screen" value="<?=$screen?>" />
                        <?=system_getFormInputSearchParams((($_POST)?($_POST):($_GET)));?>

                        <? include(INCLUDES_DIR."/forms/form_mobilenotif.php"); ?>

                    </form>
                    
                    <form id="formnotificationcancel" action="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/mobile/notifications.php" method="get">

                        <input type="hidden" name="letter" value="<?=$letter?>" />
                        <input type="hidden" name="screen" value="<?=$screen?>" />
                        <?=system_getFormInputSearchParams((($_POST)?($_POST):($_GET)));?>

                    </form>

                </div>

            </div>
        </div>

        <div id="bottom-content">&nbsp;</div>

    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            //DATE PICKER
            <?
            if ( DEFAULT_DATE_FORMAT == "m/d/Y" ) $date_format = "mm/dd/yy";
            elseif ( DEFAULT_DATE_FORMAT == "d/m/Y" ) $date_format = "dd/mm/yy";
            ?>

            $('#expiration_date').datepicker({
                dateFormat: '<?=$date_format?>',
                changeMonth: true,
                changeYear: true,
                yearRange: '<?=date("Y")-1?>:<?=date("Y")+10?>'
            });
        });
    </script>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>