
<?

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
        
        <div class="form-group formimage createNewAccountForm">
            <input class="form-control loginform" type="text" name="first_name" id="first_name" value="<?=$first_name?>" placeholder="<?=system_showText(LANG_LABEL_FIRST_NAME);?>*" required />
        </div>
        
        <div class="form-group formimage createNewAccountForm">
            <input class="form-control loginform" type="text" name="last_name" id="last_name" value="<?=$last_name?>" placeholder="<?=system_showText(LANG_LABEL_LAST_NAME);?>*" required />
        </div>
        
        <div class="form-group formimage createNewAccountForm">
            <input class="form-control loginform" type="email" name="username" id="usernameSignup" value="<?=$username?>" maxlength="<?=USERNAME_MAX_LEN?>" onblur="populateField(this.value,'email');" placeholder="<?=system_showText(LANG_LABEL_USERNAME);?>*" required />
            <input type="hidden" name="email" id="email" value="<?=$email?>" />
        </div>
        <div class="form-group formimage createNewAccountForm">
            <input class="form-control loginform" type="email" name="retype_username" id="retype_usernameSignup" value="<?=$username?>" maxlength="<?=USERNAME_MAX_LEN?>" placeholder="Retype <?=system_showText(LANG_LABEL_USERNAME);?>*" required /><p id="retypeMsg1" class="error"></p>
        </div>
        <span class="clear"></span>
        
        <div class="form-group formimage createNewAccountForm">
            <input class="form-control loginform" id="passwordSignup" type="password" name="password" maxlength="<?=PASSWORD_MAX_LEN?>" placeholder="<?=system_showText(LANG_LABEL_PASSWORD);?>*" required />
        </div>

        <div class="form-group formimage createNewAccountForm">
            <input class="form-control loginform" id="retype_passwordSignup" type="password" name="retype_password" maxlength="<?=PASSWORD_MAX_LEN?>" placeholder="Retype <?=system_showText(LANG_LABEL_PASSWORD);?>*" required /><p id="retypeMsg2" class="error"></p>
        </div>

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
        
        <? if ($advertise_section) { ?>
        
            <? if (PAYMENT_FEATURE == "on" && ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on"))) { ?>
        
            <button class="btn btn-login pull-right span6 btn btn-default signin" id="check_out_payment_2" type="submit" name="continue" value=""><?=system_showText(LANG_BUTTON_SUBMIT)?></button>
        
            <? } ?>
        
            <button class="btn btn-login pull-right span6 btn btn-default signin" id="check_out_free_2" type="submit" name="checkout" value="<?=system_showText(LANG_BUTTON_CONTINUE)?>"><?=system_showText(LANG_BUTTON_SUBMIT)?></button>
            
        <? } else { ?>
            <? if (strpos(ACTUAL_PAGE_NAME, "claim.php") || strpos($_SERVER['REQUEST_URI'], 'login.php') || strpos($_SERVER['REQUEST_URI'], 'order_listing.php')):  ?>
            <button class="btn btn-default signin claimLoginSubmit" id = "submit" type="submit" value="Submit"><?=system_showText(LANG_BUTTON_SUBMIT)?></button>
            <?else: ?>
            <button class="btn btn-default signin createAccountBtn" id = "submit" type="submit" value="Submit"><?=system_showText(LANG_BUTTON_SUBMIT)?></button>
            <?endif;?>
        
        <? } ?>
    </div>
        <p class="pull-left text-small doubleline">
            <?=str_replace("[a]", "<a rel=\"nofollow\" href=\"".DEFAULT_URL."/popup/popup.php?pop_type=terms\" class=\"fancy_window_iframe\">", str_replace("[/a]", "</a>", system_showText(LANG_ACCEPT_TERMS)));?>
            <input type="hidden" name="agree_tou" value="1" />
        </p>


<?php if($message_account) { ?>
<script type="text/javascript">
    $(document).ready(function(){    
        $('#loginBtnWrapper').hide();
        $('#loginForm').hide();
        $('#claim_signup').show();
        $('#claim_login').hide();
    });
</script>
<?php } ?>


        <script>

            $("#submit").click(function(event){
            
                var username         = $('#usernameSignup').val().trim();
                var retype_username  = $('#retype_usernameSignup').val().trim();

                var password         = $('#passwordSignup').val().trim();
                var retype_password  = $('#retype_passwordSignup').val().trim();

                if(username != ""){
                    if(username != retype_username){
                        $('#retypeMsg1').html('&#149;&nbsp;Email Address do not match, please try again.');
                        $('#retypeMsg1').css('color', 'red').css('font-size', '16px');
                        event.preventDefault();
                    } else {
                        $('#retypeMsg1').html('');
                    }
                }

                if(password != ""){
                    if(password != retype_password){
                        $('#retypeMsg2').html('&#149;&nbsp;Passwords do not match, please try again.');
                        $('#retypeMsg2').css('color', 'red').css('font-size', '16px');
                        event.preventDefault();
                    } else {
                        $('#retypeMsg2').html('');
                    }
                }

            }); 

        </script>