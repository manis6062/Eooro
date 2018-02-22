<style type="text/css">
    
@media (max-width: 700px) {
  input::-moz-placeholder {
   
    line-height: 25px;

}

}

</style>
<?php
if (!$advertise_section) { ?>

    <input type="hidden" name="destiny" value="<?=$destiny?>" />
    <input type="hidden" name="query" value="<?=urlencode($query)?>" />

<? }

$style = ($message_login) ? "display:visible;" : "display:none;";

$defaultusername = $username;
$defaultpassword = "";
if (DEMO_MODE) {
    if (!$_POST["account_sugar_id"]) {
        if ($members_section || $advertise_section) {

            if (string_strpos($_SERVER["PHP_SELF"], "/".SOCIALNETWORK_FEATURE_NAME."/login.php") !== false) {
                $defaultusername = "profile@demodirectory.com";
                $defaultpassword = "abc123";
                $forgotLink = ((SSL_ENABLED == "on" && FORCE_PROFILE_SSL == "on") ? SECURE_URL : NON_SECURE_URL)."/".SOCIALNETWORK_FEATURE_NAME."/forgot.php";
            } else {
                $defaultusername = "demo@demodirectory.com";
                $defaultpassword = "abc123";
                $forgotLink = ((SSL_ENABLED == "on" && FORCE_MEMBERS_SSL == "on") ? SECURE_URL : NON_SECURE_URL)."/".MEMBERS_ALIAS."/forgot.php";
            }

        } elseif ($sitemgr_section) {
            $defaultusername = "sitemgr@demodirectory.com";
            $defaultpassword = "abc123";
        }
    }
}
else { 
    $forgotLink = ((SSL_ENABLED == "on" && FORCE_MEMBERS_SSL == "on") ? SECURE_URL : NON_SECURE_URL)."/".MEMBERS_ALIAS."/forgot.php";
}

if ($aux_modal_box) {

    if ($message_login) { ?>
        <p class="<?=$_GET["np"]? "informationMessage": "errorMessage";?>" style="<?=$style?>"><?=$message_login?></p>
    <? } ?>

            <div class="form-group formimage popup-username">
            <input type="hidden" name="loginType" value="popup">
            <input type="hidden" name="signup" value="login">
                <input type="email" class="form-control loginform" 
                       id="<?=$advertise_section ? 'dir_' : ''?>username" 
                       placeholder="User Name" 
                       name="<?=$advertise_section ? "dir_" : ""?>username"
                       value="<?=$defaultusername?>" required>
                <i class="fa fa-user userlock"></i>
                <!--<span class="input-group-addon noborder"><i class="fa fa-user"></i></span>-->
            </div> <!--/form-group-->
            <div class="form-group formimage popup-password">
                <input type="password" class="form-control loginform" 
                       name="password" 
                       id="password" 
                       value="<?=$defaultpassword?>" placeholder="Password" required>
                <i class="fa fa-lock userlock"></i>
                <!--<span class="input-group-addon noborder"><i class="fa fa-lock"></i></span>-->
            </div> <!--/form-group-->

            <? if ($automatically !== false) { ?>
            <div class="labelcheckbox">
                    <label class="auto" >
                            <input type="checkbox" name="automatic_login" value="1" <?=$checked?> class="checkbox cusheight" style="float:left;" />
                            <?='&nbsp;&nbsp;'.system_showText(LANG_AUTOLOGIN);?>
                    </label>
            </div>
            <? } ?>		

            <button type="submit" class="btn btn-default signin popup"><?=system_showText(LANG_BUTTON_LOGIN);?></button>

    <? } elseif (!$sitemgr_section) {
        // this part is modified as required for review theme
if (strtok($message_login, " ")=='') { ?>
<script type="text/javascript">
    $(document).ready(function(){  
        $('#loginForm').hide();
        $('#loginBtnWrapper').show();
    });
</script>
<?php } elseif(strtok($message_login, " ")=='Sorry,' || strtok($message_login, " ")=='Account') { ?>
<script type="text/javascript">
    $(document).ready(function(){    
        $('#loginBtnWrapper').hide();
        $('#loginForm').show();
        $('#claim_signup').hide();
        $('#claim_login').show();
    });
</script>
        
<?php  }  ?>
    <p class="<?=$_GET["np"]? "informationMessage": "errorMessage";?>" style="<?=$style?>"><?=$message_login;?></p>
            <div class="form-group formimage">
                <input type="email" class="form-control loginform" 
                       id="<?=$advertise_section ? 'dir_' : ''?>username" 
                       placeholder="User Name" 
                       name="<?=$advertise_section ? "dir_" : ""?>username"
                       value="<?=$defaultusername?>" required>
                <i class="fa fa-user userlock"></i>
                <!--<span class="input-group-addon noborder"><i class="fa fa-user"></i></span>-->
            </div> <!--/form-group-->
            <div class="form-group formimage">
                <input type="password" class="form-control loginform" 
                       name="<?=$advertise_section ? 'dir_' : ''?>password" 
                       id="<?=$advertise_section ? 'dir_' : ''?>password" 
                       value="<?=$defaultpassword?>" placeholder="Password" required>
                <i class="fa fa-lock userlock"></i>
                <!--<span class="input-group-addon noborder"><i class="fa fa-lock"></i></span>-->
            </div> <!--/form-group-->
            
            <?php
            if(!empty($thePageTitle)){ ?>
            <input type="hidden" name ="claim_listing_redirect" value="y">
            <input type="hidden" name ="claim_listings_id" value="<?php echo $_GET['claimlistingid']?>">
          <?php  }
            
            ?>
            
            
            <button <?=($advertise_section ? "type=\"button\"  onclick=\"submitForm('formDirectory');\"" : "type=\"submit\"")?> class="btn btn-default signin"><?=system_showText(LANG_BUTTON_LOGIN);?></button>
            <div class="checkbox checkbox1">
                <label for="checkbox"><input type="checkbox" class="cusheight">&nbsp; &nbsp;&nbsp;Remember me</label>
                <a href="<?=$forgotLink;?>" class="forget"><?=system_showText(LANG_LABEL_FORGOTPASSWORD);?></a>
            </div>
        <? if ($automatically !== false) { ?>
            <div class="checkbox checkbox1">
                <label>
                    <input type="checkbox" name="automatic_login" value="1" <?=$checked?> class="checkbox cusheight" />
                    <?='&nbsp;&nbsp;&nbsp;&nbsp;'.system_showText(LANG_AUTOLOGIN);?>
                </label>
            </div>
        <? } if(strpos($_SERVER['REQUEST_URI'], 'login.php')) { ?>			

    <?  }   } else { ?>

            <div class="form-login">

                    <h2><?=system_showText(LANG_SITEMGR_LOGIN_ACCOUNT);?></h2>

                    <? if ($message_login) { ?>
            <p class="errorMessage" style="<?=$style?>"><?=$message_login?></p>
        <? } ?>

                    <div class="form-box">

                            <div>
                                    <input type="email" name="username" id="username" value="<?=$defaultusername?>" placeholder="<?=system_showText(LANG_SITEMGR_EMAIL_ADDRESS);?>" />
                            </div>

                            <div>
                                    <input type="password" name="password" id="password" value="<?=$defaultpassword?>" placeholder="<?=system_showText(LANG_LABEL_PASSWORD);?>" />
                            </div>

                            <? if (DEMO_MODE) { ?>
                <center class="warning">Test Password: abc123</center>
            <? } ?>

                            <? if ($automatically !== false) { ?>
                <label class="automaticLogin">
                    <?=system_showText(LANG_AUTOLOGIN);?>
                    <input type="checkbox" name="automatic_login" value="1" <?=$checked?> class="inputAuto" />                            
                </label>
                            <? } ?>

            <button type="submit" class="stmgr-btn success"><?=system_showText(LANG_BUTTON_LOGIN);?></button>
                    </div>

        <p class="linkLogin">
            <a href="<?=((SSL_ENABLED == "on" && FORCE_SITEMGR_SSL == "on") ? SECURE_URL : DEFAULT_URL)?>/<?=SITEMGR_ALIAS?>/forgot.php"><?=system_showText(LANG_SITEMGR_FORGOTPASS_FORGOTYOURPASSWORD)?></a>
                    </p>

            </div>
        <? } ?>
