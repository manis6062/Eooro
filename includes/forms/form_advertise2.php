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
	# * FILE: /members/login.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# DOMAIN COOKIE VALIDATION
	# ----------------------------------------------------------------------------------------------------
	if (!$_COOKIE["automatic_login_members"] || $_COOKIE["automatic_login_members"] == "false") {
		$resetDomainSession = true;
	}
	
	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
    //include(EDIRECTORY_ROOT."/includes/code/login.php");
    	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	//include(MEMBERS_EDIRECTORY_ROOT."/layout/header.php");
        /**
         * modification
         */
        //$showAdvertiseWithUs = false;

        // override garne kunai option nai chaina.. zabarjasti gardiye
        if( EDIR_THEME !== 'review' ):
?>

	 <div class="row-fluid login-page">
                   
        <div class="span12">

            <h1 class="text-center"><?=system_showText(LANG_LABEL_LOGIN_SPONSORAREA);?></h1>
               
            <section class="login-box">

                <? if ($foreignaccount_google || FACEBOOK_APP_ENABLED == "on") {
                    
                    if (FACEBOOK_APP_ENABLED == "on") {
                        $urlRedirect = $_SERVER["HTTP_REFERER"] ? $_SERVER["HTTP_REFERER"] : DEFAULT_URL.'/index.php';
                        include(INCLUDES_DIR."/forms/form_facebooklogin.php");
                    }

                    if ($foreignaccount_google) {
                        $urlRedirect = "&destiny=".urlencode(DEFAULT_URL."/".MEMBERS_ALIAS."/");
                        include(INCLUDES_DIR."/forms/form_googlelogin.php");
                    }
                ?>

                    <p class="text-center divisor"><?=system_showText(LANG_OR_SIGNINEMAIL);?></p>

                <? } ?>

                <form name="formDirectory" method="post" action="<?=MEMBERS_LOGIN_PAGE;?>"> <? // DEFAULT_URL."/".MEMBERS_ALIAS."/login.php" MEMBERS ALIAS = sponsors ?>
					<input type="hidden" name="advertise" value="<?=($_GET["advertise"] ? $_GET["advertise"] : $_POST["advertise"]);?>" />
					<input type="hidden" name="claim" value="<?=($_GET["claim"] ? $_GET["claim"] : $_POST["claim"]);?>" />
					<? include(INCLUDES_DIR."/forms/form_login.php"); ?>
				</form>

            </section>

            <section class="login-underbox">

                <p><a href="<?=NON_SECURE_URL?>/"><?=system_showText(LANG_LABEL_BACK_TO_SEARCH);?></a></p>
                <?php 
                /**
                 * modification
                 */
                if( $showAdvertiseWithUs ): ?>
                    <p><a href="<?=NON_SECURE_URL?>/<?=ALIAS_ADVERTISE_URL_DIVISOR?>.php"><?=system_showText(LANG_DOYOUWANT_ADVERTISEWITHUS)?></a></p>
                <?php endif; ?>
            </section>

        </div>

    </div>
<? else: ?>
    <? //include(system_getFrontendPath("login_sponsors_ad.php", "frontend/socialnetwork"));  //previously
    include(system_getFrontendPath("login.php", "frontend/socialnetwork"));  ?>
    <?php 
        /**
         * modification
         */
        if( $showAdvertiseWithUs ): ?>
            <p><a href="<?=NON_SECURE_URL?>/<?=ALIAS_ADVERTISE_URL_DIVISOR?>.php"><?=system_showText(LANG_DOYOUWANT_ADVERTISEWITHUS)?></a></p>
    <?php endif; ?>
<?
endif;

	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	//include(MEMBERS_EDIRECTORY_ROOT."/layout/footer.php");
?>