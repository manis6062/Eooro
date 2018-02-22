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
	# * FILE: /profile/forgot.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	$cancel_section = SOCIALNETWORK_FEATURE_NAME."/login.php";
	$section = "members";
	include(INCLUDES_DIR."/code/forgot_password.php");

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(system_getFrontendPath("header.php", "layout"));

?>
    <div class="login-page forgot-page">
        <h1 class="text-center"><?=system_showText(LANG_LABEL_FORGOTTEN_PASSWORD)?></h1>

        <section class="login-box">
            <form name="forgotpassword" method="post" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>">
                <? include(INCLUDES_DIR."/forms/form_forgot_password.php"); ?>
            </form>
        </section>

        <section class="login-underbox">
            <p><a href="<?=NON_SECURE_URL?>/"><?=system_showText(LANG_LABEL_BACK_TO_SEARCH);?></a></p>
        </section>
    </div>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(system_getFrontendPath("footer.php", "layout"));
?>