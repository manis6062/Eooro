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
    # * FILE: /frontend/claim.php
    # ----------------------------------------------------------------------------------------------------

?>

    <div class="real-steps">
        
        <div class="standardStep-Title">
            <?=string_strtoupper(system_showText(LANG_EASYANDFAST));?> <span><?=string_strtoupper(system_showText(LANG_THREESTEPS))?></span>
        </div>
        
        <ul class="standardStep steps-3">
            <li class="steps-ui stepLast"><span>3</span>&nbsp;<?=system_showText(LANG_CHECKOUT)?></li>
            <li class="steps-ui"><span>2</span>&nbsp;<?=system_showText(LANG_LISTINGUPDATE)?></li>
            <li class="steps-ui stepActived"><span>1</span>&nbsp;<?=system_showText(LANG_ACCOUNTSIGNUP)?></li>
        </ul>
        
    </div>
                       
    <div class="row-fluid login-page">

        <div class="span12">
            
            <h1 class="text-center capitalized">
                <?=system_showText(LANG_LISTING_CLAIMING);?> <q><?=$listingObject->getString("title");?></q>
                <small><?=system_showText(LANG_CLAIM_SIGNUP);?></small>
            </h1>
            
            <hr>

            <div id="claim_login" style="display:none">

                <section class="login-box">

                    <? if ($foreignaccount_google || FACEBOOK_APP_ENABLED == "on") {

                        if (FACEBOOK_APP_ENABLED == "on") {
                            $fbLabel = system_showText(LANG_LOGINFACEBOOKUSER);
//                            $urlRedirect = "?claim=yes&destiny=".urlencode(DEFAULT_URL."/".MEMBERS_ALIAS."/claim/getlisting.php?claimlistingid=".$claimlistingid);
                            $urlRedirect = DEFAULT_URL."/".MEMBERS_ALIAS."/claim/getlisting.php?claimlistingid=".$claimlistingid."&claim=yes";
                            include(INCLUDES_DIR."/forms/form_facebooklogin.php");
                            unset($fbLabel);
                        }

                        if ($foreignaccount_google) {
                            $goLabel = system_showText(LANG_LOGINGOOGLEUSER);
                            $urlRedirect = "&claim=yes&destiny=".urlencode(DEFAULT_URL."/".MEMBERS_ALIAS."/claim/getlisting.php?claimlistingid=".$claimlistingid);
//                            include(INCLUDES_DIR."/forms/form_googlelogin.php");
                            unset($goLabel);
                        } ?>

                        <p class="text-center divisor"><?=system_showText(LANG_OR_SIGNINEMAIL);?></p>            

                    <? } ?>

                    <form name="formDirectory" method="post" action="<?=((SSL_ENABLED == "on" && FORCE_MEMBERS_SSL == "on") ? SECURE_URL : NON_SECURE_URL);?>/<?=MEMBERS_ALIAS?>/login.php?destiny=<?=EDIRECTORY_FOLDER?>/<?=MEMBERS_ALIAS?>/claim/getlisting.php&amp;query=claimlistingid=<?=$claimlistingid?>">
                        <input type="hidden" name="claim" value="yes" />
                        <? 
                        $members_section = true;
                        include(INCLUDES_DIR."/forms/form_login.php");
                        ?>
                    </form>

                </section>

                <section class="login-underbox">
                    <p><a href="javascript:void(0);" onclick="$('#claim_login').css('display', 'none'); $('#claim_signup').fadeIn(500);"><?=system_showText(LANG_LABEL_SIGNUPNOW);?></a></p>
                </section>

            </div>
            
            <div id="claim_signup">
                
                <section class="login-box">

                    <? if ($foreignaccount_google || FACEBOOK_APP_ENABLED == "on") {

                        if (FACEBOOK_APP_ENABLED == "on") {
                            $fbLabel = system_showText(LANG_SIGNUPFACEBOOKUSER);
//                            $urlRedirect = "?claim=yes&destiny=".urlencode(DEFAULT_URL."/".MEMBERS_ALIAS."/claim/getlisting.php?claimlistingid=".$claimlistingid);
                            $urlRedirect = DEFAULT_URL."/".MEMBERS_ALIAS."/claim/getlisting.php?claimlistingid=".$claimlistingid."&claim=yes";
                            include(INCLUDES_DIR."/forms/form_facebooklogin.php");
                            unset($fbLabel);
                        }

                        if ($foreignaccount_google) {
                            $goLabel = system_showText(LANG_SIGNUPGOOGLEUSER);
                            $urlRedirect = "&claim=yes&destiny=".urlencode(DEFAULT_URL."/".MEMBERS_ALIAS."/claim/getlisting.php?claimlistingid=".$claimlistingid);
                            include(INCLUDES_DIR."/forms/form_googlelogin.php");
                            unset($goLabel);
                        } ?>

                        <p class="text-center divisor"><?=system_showText(LANG_OR_SIGNUPEMAIL);?></p>            

                    <? } ?>               

                    <form name="signup_claim" action="<?=system_getFormAction($_SERVER["REQUEST_URI"])?>" method="post">
                        
                        <input type="hidden" name="claim" value="true" />
                        <input type="hidden" name="claimlistingid" id="claimlistingid" value="<?=$claimlistingid?>" />
                        
                        <? include(INCLUDES_DIR."/forms/form_addaccount.php"); ?>

                    </form>

                </section>

                <section class="login-underbox">
                    <p><a href="javascript:void(0);" onclick="$('#claim_signup').css('display', 'none'); $('#claim_login').fadeIn(500);"><?=system_showText(LANG_LABEL_ALREADY_MEMBER);?></a></p>
                </section>

            </div>
            
        </div>

    </div>