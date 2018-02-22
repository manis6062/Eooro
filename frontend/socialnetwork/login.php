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
	# * FILE: /frontend/socialnetwork/login.php
	# ----------------------------------------------------------------------------------------------------
   
?>
    <div class="row-fluid login-page">
                   
        <div class="span12">

            <h1 class="text-center"><?=system_showText(LANG_LABEL_LOGIN);?></h1>
               
            <section class="login-box">

                <? if ($foreignaccount_google || FACEBOOK_APP_ENABLED == "on") {
                                        
                    if (FACEBOOK_APP_ENABLED == "on") {
                        $urlRedirect = $_SERVER["HTTP_REFERER"] ? $_SERVER["HTTP_REFERER"] : DEFAULT_URL.'/index.php';
                        include(INCLUDES_DIR."/forms/form_facebooklogin.php");
                    }
                    
                    if ($foreignaccount_google) {
                        $urlRedirect = "&destiny=".urlencode($_SERVER["HTTP_REFERER"]);
                        include(INCLUDES_DIR."/forms/form_googlelogin.php");
                    } ?>

                    <p class="text-center divisor"><?=system_showText(LANG_OR_SIGNINEMAIL);?></p>            

                <? } ?>
               
                <form class="form" name="login" method="post" action="<?=((SSL_ENABLED == "on" && FORCE_PROFILE_SSL == "on") ? SECURE_URL : DEFAULT_URL)?><?=$url?>">
                    <? 
                    $members_section = true;
                    include(INCLUDES_DIR."/forms/form_login.php"); ?>
                </form>

            </section>

            <section class="login-underbox">

                <p><a class="link-highlight" href="<?=SOCIALNETWORK_URL?>/add.php"><?=system_showText(LANG_LABEL_SIGNUPNOW);?></a></p>

                <p><a href="<?=((SSL_ENABLED == "on" && FORCE_MEMBERS_SSL == "on") ? SECURE_URL : NON_SECURE_URL)?>/<?=MEMBERS_ALIAS?>/"><?=system_showText(LANG_GO_TO_SPONSOR_AREA);?></a></p>

            </section>

        </div>

    </div>