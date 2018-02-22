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
	# * FILE: /profile/resetpassword.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSession();

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	if ($_SERVER['REQUEST_METHOD'] == "POST") {

		$accountObj = new Account(sess_getAccountIdFromSession());
		$member_username = $accountObj->getString("username");

		if ($_POST["password"]) {
			if (validate_MEMBERS_account($_POST, $message, sess_getAccountIdFromSession())) {
				$accountObj->setString("password", $_POST["password"]);
				$accountObj->updatePassword();
				$success_message = system_showText(LANG_MSG_PASSWORD_SUCCESSFULLY_UPDATED);
                $urlRedirect = SOCIALNETWORK_URL."/edit.php";
			}
		} else {
			$message = system_showText(LANG_MSG_PASSWORD_IS_REQUIRED);
		}

	}

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	if ($_GET["key"]) {

		$forgotPasswordObj = new forgotPassword($_GET["key"]);

		if ($forgotPasswordObj->getString("unique_key") && ($forgotPasswordObj->getString("section") == "members")) {

			$accountObj = new Account($forgotPasswordObj->getString("account_id"));
			$member_username = $accountObj->getString("username");

			$forgotPasswordObj->Delete();

			if (!$member_username) {
				$error_message = system_showText(LANG_MSG_WRONG_ACCOUNT);
			}

		} else {
			$error_message = system_showText(LANG_MSG_WRONG_KEY);
		}

	} else {
		$error_message = system_showText(LANG_MSG_WRONG_KEY);
	}

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(system_getFrontendPath("header.php", "layout"));

?>

	<div class="login-page forgot-page">
        
	<h1 class="text-center" style="color:black"><?=system_showText(LANG_LABEL_RESET_PASSWORD);?></h1>

        <section class="login-box">

            <? if ($success_message) { ?>
                <p class="successMessage">
                    <?=$success_message;?>
                    <br />
                    <a href="<?=$urlRedirect;?>"><?=system_showText(LANG_BUTTON_MANAGE_ACCOUNT)?></a>
                </p>
            <? } elseif ($error_message && !$message) { ?>
                <p class="errorMessage"><?=$error_message;?>
                    <br /><br />
                    <a href="<?=DEFAULT_URL?>/<?=SOCIALNETWORK_FEATURE_NAME?>/forgot.php"><?=system_showText(LANG_LABEL_FORGOTPASSWORD);?></a>
                </p> 
            <? } else {
                
                if ($message) { ?>
                    <p class="errorMessage"><?=$message;?></p>
                <? } ?>

                <form name="formResetPassword" method="post" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>">
                  <div class="row" style="color:black;text-align:center">  
                        <div class="col-sm-4">
                        <label><?=system_showText(LANG_LABEL_USERNAME)?>:</label>
                        <span><?=$member_username;?></span>
                        <br />
                        <br />

                        <label><?=system_showText(LANG_LABEL_PASSWORD)?>:</label>
                        <input class="span12" type="password" name="password" maxlength="<?=PASSWORD_MAX_LEN?>" required />
                        <small><?=system_showText(LANG_MSG_PASSWORD_MUST_BE_BETWEEN)?> <?=PASSWORD_MIN_LEN?> <?=system_showText(LANG_AND)?> <?=PASSWORD_MAX_LEN?> <?=system_showText(LANG_MSG_CHARACTERS_WITH_NO_SPACES)?></small>
                        <br />
                        <br />
                        <label><?=system_showText(LANG_LABEL_RETYPE_PASSWORD)?>:</label>
                        <input class="span12" type="password" name="retype_password" required />
                        </div>
                   </div>
                      
                   <div class="row-fluid action">
                        <div class="span6 pull-left">
<!--                            <button class="btn btn-login span12" type="submit" value="<?//=system_showText(LANG_BUTTON_SUBMIT);?>"><?//=system_showText(LANG_BUTTON_SUBMIT);?></button>-->
                            <button class="btn btn-default signin" type="submit" value="<?=system_showText(LANG_BUTTON_SUBMIT);?>"><?=system_showText(LANG_BUTTON_SUBMIT)?></button>
                        </div>
                  </div>     
                </form>

            <? } ?>

        </section>
	</div>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(system_getFrontendPath("footer.php", "layout"));
?>
