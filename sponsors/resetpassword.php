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
	# * FILE: /members/resetpassword.php
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
				$urlRedirect = DEFAULT_URL."/profile/";
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

	}	 else {
	 	$error_message = system_showText(LANG_MSG_WRONG_KEY);
	 }

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/header.php");

?>

	<div class="login-page forgot-page">
	         <div class="container">
        
	<h1 class="text-center" style="color:#999;"><?=system_showText(LANG_LABEL_RESET_PASSWORD);?></h1>
		
        <section class="login-box">

         <div class="col-sm-offset-3">
            <? if ($success_message) { ?>
            <div class="col-sm-8">
            	<div class="text-center">
                <p class="alert alert-success">
                    <?=$success_message;?>
                    <br />
                    <a href="<?=$urlRedirect;?>"><?=system_showText(LANG_BUTTON_MANAGE_ACCOUNT)?></a>
                </p>    
                </div>
                </div>
                    
                
            <? } elseif ($error_message && !$message) { ?>
            	<div class="col-sm-8">
            	<div class="text-center">
                <p class="alert alert-danger"><?=$error_message;?>
                    <br /><br />
                    <a href="<?=DEFAULT_URL?>/<?=MEMBERS_ALIAS?>/forgot.php"><?=system_showText(LANG_LABEL_FORGOTPASSWORD);?></a>
                </p> 
                </div>
                </div>
            <? } else {
                
                if ($message) { ?>
                    <p class="errorMessage"><?=$message;?></p>
                <? } ?>

                <form name="formResetPassword" method="post" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>">
                    

                    <div class="row-fluid form-login">
                        <div class="col-sm-7">
                           <div class="form-group">
                            <label><?=system_showText(LANG_LABEL_USERNAME)?>:</label>
                            <span><?=$member_username;?></span>
                            <br />
                           </div>
                           <div class="form-group"> 
                            <label><?=system_showText(LANG_LABEL_PASSWORD)?>:</label>
                            <input class="form-control loginform" type="password" name="password" maxlength="<?=PASSWORD_MAX_LEN?>" required />
                            <small><?=system_showText(LANG_MSG_PASSWORD_MUST_BE_BETWEEN)?> <?=PASSWORD_MIN_LEN?> <?=system_showText(LANG_AND)?> <?=PASSWORD_MAX_LEN?> <?=system_showText(LANG_MSG_CHARACTERS_WITH_NO_SPACES)?></small>
                           </div>
                           <div class="form-group"> 
                            <label><?=system_showText(LANG_LABEL_RETYPE_PASSWORD)?>:</label>
                            <input class="form-control loginform" type="password" name="retype_password" required />
                           </div>
                                                 
                        
                        <table style="margin: 0 auto 0 auto;" cellspacing="4">
                            <tbody>
                                <tr>
                                    <td>
                                        <button class="btn btn-default  btn-success" type="submit" value="<?=system_showText(LANG_BUTTON_SUBMIT);?>"><?=system_showText(LANG_BUTTON_SUBMIT);?></button> 
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        
                        
                        </div>                        
                    </div>
                    
                    				

                </form>

            <? } ?>
         </div>
         </div>    
        </section>
	</div>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/footer.php");

?>

