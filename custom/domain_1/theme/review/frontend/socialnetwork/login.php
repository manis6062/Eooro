<section class="login">
     <div class="container">
        <h1 class="text-center">Login with  Eooro.com here.</h1>
        <div class="col-sm-5 col-sm-offset-3 col-md-offset-4 social-signup">
        <div id="loginBtnWrapper">
       <!--      <h3>Don’t have an account? Sign Up!</h3> -->
            <? 
            if (FACEBOOK_APP_ENABLED == "on") {
                $fbLabel = "LOG IN WITH FACEBOOK";
                $urlRedirect = (DEFAULT_URL."/".MEMBERS_ALIAS."/"."index.php");
                $_SESSION['advertise'] = 'yes';
                include( system_getFrontendPath( 'socialnetwork/form_facebooklogin.php') );
                unset($fbLabel);
            }

            if ($foreignaccount_google) {
                $urlRedirect = "&destiny=".urlencode($_SERVER["HTTP_REFERER"]);
                include( system_getFrontendPath( 'socialnetwork/form_googlelogin.php') );
            } 
            if ($foreignaccount_google) {
                $urlRedirect = "&destiny=".urlencode($_SERVER["HTTP_REFERER"]);
                include( system_getFrontendPath( 'socialnetwork/form_twitterlogin.php') );
            } 
             if ($foreignaccount_google) {
                $urlRedirect = "&destiny=".urlencode($_SERVER["HTTP_REFERER"]);
                include( system_getFrontendPath( 'socialnetwork/form_linkedinlogin.php') );
            } 
            ?>   
            <button type="button" class="btn btn-default custombtn" id="emailBtn">
                <div class="fbbtnwrapper gplus ema" >
                    <i class="fa fa-envelope fb gps"></i>
                    <span><?=strtoupper('Log in with Email')?></span>
                </div>
            </button>
            </div>
            <div class="row" style="display:none;" id="loginForm">
<!--                 <h2>Login into your account</h2>
 -->                <?php $constant= MEMBERS_LOGIN_PAGE;?>
                <div class="col-sm-10">
                <div class="row">
                    <form class="form" name="formDirectory" method="post" action="<?=MEMBERS_LOGIN_PAGE;?>" role="form">
                        <input type="hidden" name="signup" value="<?php echo 'login'?>" />
                        <input type="hidden" name="claim" value="<?=($_GET["claim"] ? $_GET["claim"] : $_POST["claim"]);?>" />
                        <? include(INCLUDES_DIR."/forms/form_login_review.php"); ?>
                    </form>
                </div>
                  <section class="login-underbox">
                        <p><a href="javascript:void(0);" id="showSignup" ><?=system_showText(LANG_LABEL_SIGNUPNOW);?></a></p>
                    </section>
                </div>    
            </div>
                <div class="formwidth">
                    <div class="row">
                        <div id="claim_signup" style="display:none;">
        <!--                 <h2>Login into your account</h2> -->
                            <form name="signup_claim" action="<?=system_getFormAction($_SERVER["REQUEST_URI"])?>" method="post" role="form">
                                <input type="hidden" name="signup" value="<?php echo 'signup';  ?>" />
                                <input type="hidden" name="claimlistingid" id="claimlistingid" value="<?=$claimlistingid?>" />
                                <p class="<?=$_GET["np"]? "informationMessage": "errorMessage";?>" style="<?=$style?>"><?=$message_login;?></p>

                                <? 
                                $members_section = true;
                                include(INCLUDES_DIR."/forms/form_addaccount_review.php"); ?>
                            </form>
                            <section class="login-underbox">
                                <p class="alreadyMem"><a href="javascript:void(0);" id="showLogin"><?=system_showText(LANG_LABEL_ALREADY_MEMBER);?></a></p>
                            </section>
                        </div>
                    </div>
                </div>

            </div>
    </div>
</section>
<style type="text/css">
    .alreadyMem {
        display: inline-block;
    }
</style>

<script type="text/javascript">
    $(document).ready(function(){
    $('#showSignup').click(function(){
        $('#loginBtnWrapper').hide();
        $('#claim_signup').show();
        $('#loginForm').hide();
    });

    $('#showLogin').click(function(){
        $('#loginBtnWrapper').hide();
        $('#loginForm').show();
        $('#claim_signup').hide();
    });

});
</script>

