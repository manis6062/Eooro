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
	# * FILE: /includes/forms/form_account_members.php
	# ----------------------------------------------------------------------------------------------------

    $accountID = sess_getAccountIdFromSession();
    $readonly = "";
    if (DEMO_LIVE_MODE && ($username == "demo@demodirectory.com")) {
        $readonly = "readonly"; 
    }

    $isForeignAcc = false;

    if ((string_strpos($username, "facebook::") !== false || string_strpos($username, "google::") !== false || string_strpos($username, "twitter::") !== false || string_strpos($username, "linkedin::") !== false)) {
        $isForeignAcc = true;
    }

    $dropdown_protocol = html_protocolDropdown($url, "url_protocol", false, $protocol_replace);

    ?>
        
    <script language="javascript" type="text/javascript" src="<?=DEFAULT_URL?>/scripts/checkusername.js"></script>
    <script language="javascript" type="text/javascript" src="<?=DEFAULT_URL?>/scripts/activationEmail.js"></script>                        

    <div id="change-email">

        <div class="right">

            <div class="cont_100">

                <div class="checking">

                <label style="display:inline;float:none;"><?=system_showText(LANG_LABEL_USERNAME)?>: </label>
                <input type="hidden" value="<?=$email?>" name="username">
                <label style="display:inline;float:none;"><?=$email?></label>
                    <? if ($active == "y") { ?>
                        <span class="positive">
                            <i class="fa fa-check-circle" aria-hidden="true"></i>
                            <?=system_showText(LANG_LABEL_ACCOUNT_ACT);?>
                        </span>
                    <? } else { ?>
                        <span class="negative"> <i class="fa fa-times-circle" aria-hidden="true"></i> <?=system_showText(LANG_LABEL_ACCOUNT_NOTACT);?> <a href="javascript: void(0);" onclick="sendEmailActivation(<?=$accountID?>);"><?=system_showText(LANG_LABEL_ACTIVATE_ACC);?></a></span>
                    <? } ?>
                    <img id="loadingEmail" src="<?=DEFAULT_URL?>/images/img_loading.gif" width="15px;" style="display: none;" />
                    <input type="hidden" name="active" value="<?=$active?>" />

                </div>

            </div>

        </div>

    </div>


    <?/* if (!$isForeignAcc) { ?>

    <div id="change-password">

        <div class="right">

            <div class="cont_100">

                <label><?=system_showText(LANG_LABEL_CURRENT_PASSWORD)?><span class="req">*</span></label>

                <div class="checking">
                    <input type="password" name="current_password" class="input-form-account" <?=$readonly?> />
                </div>

            </div>

            <div class="cont_50">
                <label><?=system_showText(LANG_LABEL_NEW_PASSWORD);?></label>
                <input type="password" name="password" maxlength="<?=PASSWORD_MAX_LEN?>" <?=$readonly?> />
            </div>

            <div class="cont_50">
                <label><?=system_showText(LANG_LABEL_RETYPE_NEW_PASSWORD);?></label>
                <input type="password" name="retype_password" <?=$readonly?> />
            </div>

        </div>

    </div>

    <? } */ ?>    