  <?  // Added for successful facebook login
     $members_section = true; ?>
<section class="login">
    <div class="container">
        <h1 class="text-center">Login with  Eooro.com here.</h1>
        <div class="col-sm-5 col-sm-offset-3 col-md-offset-4 social-signup">
        <div id="loginBtnWrapper">
      <!--       <h3>Don’t have an account? Sign Up!</h3> -->
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
                <h2>Login into your account</h2>
                <?php $constant= MEMBERS_LOGIN_PAGE;?>
                <div class="col-sm-10">
                <div class="row">
                    <form class="form" name="formDirectory" method="post" action="<?=MEMBERS_LOGIN_PAGE;?>" role="form">
                        <input type="hidden" name="advertise" value="<?=($_GET["advertise"] ? $_GET["advertise"] : $_POST["advertise"]);?>" />
                        <input type="hidden" name="claim" value="<?=($_GET["claim"] ? $_GET["claim"] : $_POST["claim"]);?>" />
                        <? include(INCLUDES_DIR."/forms/form_login_review.php"); ?>
                    </form>
                </div>
                </div>    
            </div>
            </div>
    </div>
    
</section>