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
	# * FILE: /members/forgot.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	$cancel_section = MEMBERS_ALIAS."/login.php";
	$section = "members";
	include(INCLUDES_DIR."/code/forgot_password.php");

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/header.php");
            
        include(system_getFrontendPath("review_banner.php"));

        if( EDIR_THEME !== 'review' ){
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
        }
        else { ?>
            
            <section class="latest-review cusreview">
        	<div class="container">
        		<div class="thumbnail listingthumbnail lisingthumbnail1 resetPassword">
                	<div class="row">
                    	<div class="col-sm-12">
                    <div class="heading-banner">
                    	<h4>Reset your password</h4>
                    </div><!--/heading-banner-->
                    </div><!--/col-sm-12-->
                    </div>
                    <div class="row">
                    	<div class="col-sm-12">
                            <div class="pWrapper forgot">
                                <p class="enterEmailId">Enter your email address below. We'll look for your account and send you a password reset email.</p>
                                
                                <form role="form" name="forgotpassword" method="post" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>">
                                    <? include(INCLUDES_DIR."/forms/form_forgot_password_review.php"); ?>
                                </form>
                            </div><!--/pWrapper-->
                        </div>
                    </div><!--/row-->
                </div><!--/thumbnail-->
            </div> <!--/container-->
        </section>
        <? }?>
<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/footer.php");
?>