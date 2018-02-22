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
	# * FILE: /frontend/socialnetwork/add_account.php
	# ----------------------------------------------------------------------------------------------------

    include(INCLUDES_DIR."/code/newsletter.php");

	setting_get("foreignaccount_google", $foreignaccount_google);
		    
	?>
        
    <script language="javascript" type="text/javascript" src="<?=DEFAULT_URL?>/scripts/checkusername.js"></script>

    <div class="row-fluid login-page">
                   
        <div class="span12">

            <h1 class="text-center"><?=system_showText(LANG_JOIN_PROFILE);?></h1>
               
            <section class="login-box">

                <? if ($foreignaccount_google == "on" || FACEBOOK_APP_ENABLED == "on") {
                    
                    if (FACEBOOK_APP_ENABLED == "on") {
                        $urlRedirect = "?destiny=".urlencode(DEFAULT_URL."/".SOCIALNETWORK_FEATURE_NAME."/");
                        include(INCLUDES_DIR."/forms/form_facebooklogin.php");
                    }
                    
                    if ($foreignaccount_google == "on") {
                        $urlRedirect = "&destiny=".urlencode(DEFAULT_URL."/".SOCIALNETWORK_FEATURE_NAME."/");
                        include(INCLUDES_DIR."/forms/form_googlelogin.php");
                    } ?>

                    <p class="text-center divisor"><?=system_showText(LANG_OR_SIGNUPEMAIL);?></p>

                <? } ?>                
            
                <form name="add_account" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">
                    
                      <? include(INCLUDES_DIR."/forms/form_addaccount.php"); ?>

                </form>

            </section>

            <section class="login-underbox">
                <p>
                    <a href="<?=SOCIALNETWORK_URL?>/login.php"><?=system_showText(LANG_LABEL_ALREADY_MEMBER);?></a>
                </p>
            </section>
            
        </div>
    
    </div>