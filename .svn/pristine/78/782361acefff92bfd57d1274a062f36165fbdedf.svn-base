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
    # * FILE: /includes/form/form_addaccount.php
    # ----------------------------------------------------------------------------------------------------

    if ((string_strlen(trim($message_account)) > 0) || (string_strlen(trim($message_contact)) > 0) ) { ?>
        <p class="errorMessage">
            <? if (string_strlen(trim($message_contact)) > 0) { ?>
                <?=$message_contact?>
            <? } ?>
            <? if ((string_strlen(trim($message_contact)) > 0) && (string_strlen(trim($message_account)) > 0)) { ?>
                <br />
            <? } ?>
            <? if (string_strlen(trim($message_account)) > 0) { ?>
                <?=$message_account?>
            <? } ?>
        </p>
    <? } ?>
    
    <div class="form-signup">
        
        <div class="span6">
            <label for="first_name"><?=system_showText(LANG_LABEL_FIRST_NAME);?></label>
            <input class="span12" type="text" name="first_name" id="first_name" value="<?=$first_name?>" required />
        </div>
        
        <div class="span6">
            <label for="last_name"><?=system_showText(LANG_LABEL_LAST_NAME);?></label>
            <input class="span12" type="text" name="last_name" id="last_name" value="<?=$last_name?>" required />
        </div>

        <label for="username"><?=system_showText(LANG_LABEL_USERNAME);?></label>
        <input class="span12" type="email" name="username" id="username" value="<?=$username?>" maxlength="<?=USERNAME_MAX_LEN?>" onblur="populateField(this.value,'email');" required />
        <input type="hidden" name="email" id="email" value="<?=$email?>" />
        
        <span class="clear"></span>
        
        <label for="password"><?=system_showText(LANG_LABEL_PASSWORD);?></label>
        <input class="span12" type="password" name="password" maxlength="<?=PASSWORD_MAX_LEN?>" required />
        
    </div>

    <? if ($showNewsletter) { ?>
   
        <div class="checkbox">
            <label>
                <input type="checkbox" class="checkbox" name="newsletter" value="y" <?=($newsletter || (!$newsletter && $_SERVER["REQUEST_METHOD"] != "POST")) ? "checked" : ""?> />
                <?=$signupLabel?>
            </label>
        </div>
   
    <? } ?>

    <div class="row-fluid action">
        <p class="pull-left span6 text-small doubleline">
            <?=str_replace("[a]", "<a rel=\"nofollow\" href=\"".DEFAULT_URL."/popup/popup.php?pop_type=terms\" class=\"fancy_window_iframe\">", str_replace("[/a]", "</a>", system_showText(LANG_ACCEPT_TERMS)));?>
            <input type="hidden" name="agree_tou" value="1" />
        </p>
        
        <? if ($advertise_section) { ?>
        
            <? if (PAYMENT_FEATURE == "on" && ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on"))) { ?>
        
            <button class="btn btn-login pull-right span6" id="check_out_payment_2" type="submit" name="continue" value=""><?=system_showText(LANG_BUTTON_SUBMIT)?></button>
        
            <? } ?>
        
            <button class="btn btn-login pull-right span6" id="check_out_free_2" type="submit" name="checkout" value="<?=system_showText(LANG_BUTTON_CONTINUE)?>"><?=system_showText(LANG_BUTTON_SUBMIT)?></button>
            
        <? } else { ?>

            <button class="btn btn-login pull-right span6" type="submit" value="Submit"><?=system_showText(LANG_BUTTON_SUBMIT)?></button>
        
        <? } ?>
    </div>