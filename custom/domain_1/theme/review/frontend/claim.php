<? 
// do not display banner for main login page
if(!(strpos($_SERVER['REQUEST_URI'], 'login.php')) 
    && !(strpos($_SERVER['REQUEST_URI'], 'popup.php'))
    &&!(strpos($_SERVER['REQUEST_URI'], 'order_listing.php'))) {
    // declaring variables to be used in review_banner
    $thePageTitle = '<div class="h3Wrapper listing99">
                        <h3>Claim Listing</h3>
                    </div>';
    $customBannerSectionClass = 'listing';
    $customBannerDivClass   = 'listingpbtm';
    include(system_getFrontendPath("review_banner.php"));
}
?>

<section class="latest-review cusreview login">
    <div class="container">

<!--         <div class="col-sm-1">
            <span class="or">or</span>
        </div> -->
        <h1 class="text-center claimHeading">Login with Eooro.com here.</h1>
        <div class="col-sm-5 col-sm-offset-3 col-md-offset-4 social-signup">
           <!--  <h3 class="login12">Don’t have an account? Sign Up!</h3> -->
               <div id="loginBtnWrapper">
            <? 
            if (FACEBOOK_APP_ENABLED == "on") {
                $fbLabel = "LOG IN WITH FACEBOOK";
//                $urlRedirect = DEFAULT_URL."/".MEMBERS_ALIAS."/listing/addsearchlisting.php";
                $urlRedirect = redirectTo();
                include( system_getFrontendPath( 'socialnetwork/form_facebooklogin.php') );
                $_SESSION['claim'] = 'yes';
                unset($fbLabel);
            }

            if ($foreignaccount_google) {
                $goLabel = "LOG IN WITH GOOGLE";
//                $urlRedirect = redirectTo();
                $_SESSION['red_destiny'] = redirectTo();
//                $_SESSION['red_destiny'] = DEFAULT_URL."/".MEMBERS_ALIAS."/claim/getlisting.php?claimlistingid=".$claimlistingid."&claim=yes";;
                //$urlRedirect = "&claim=yes&destiny=".urlencode(DEFAULT_URL."/".MEMBERS_ALIAS."/claim/getlisting.php?claimlistingid=".$claimlistingid);
                include( system_getFrontendPath( 'socialnetwork/form_googlelogin.php') );
                $_SESSION['claim'] = 'yes';
                unset($goLabel);
            } // todo: twitter not working
             if ($foreignaccount_google) {
                //$urlRedirect = DEFAULT_URL."/".MEMBERS_ALIAS."/listing/addsearchlisting.php";
                $_SESSION['claim'] = 'yes';
                include( system_getFrontendPath( 'socialnetwork/form_twitterlogin.php') );
            } 
             if ($foreignaccount_google) {
                $urlRedirect = DEFAULT_URL."/".MEMBERS_ALIAS."/listing/addsearchlisting.php";
                $_SESSION['claim'] = 'yes';
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
              
                <div class="row"  id="loginForm" style="display:none;">
                  <div class=" formwidth ">
                    <div class="row">
                        <div id="claim_signup" style="display:none;">
        <!--                 <h2>Login into your account</h2> -->
                            <form name="signup_claim" action="<?=system_getFormAction($_SERVER["REQUEST_URI"])?>" method="post" role="form">
                                <input type="hidden" name="claim" value="true" />
                                <input type="hidden" name="claim" value="true" />
                                <input type="hidden" name="signup" value="signup" />

                                <? 
                                $members_section = true;
                                include(INCLUDES_DIR."/forms/form_addaccount_review.php"); ?>
                            </form>
                            <section class="login-underbox">
                                <p><a href="javascript:void(0);" onclick="$('#claim_signup').css('display', 'none'); $('#claim_login').fadeIn(500);"><?=system_showText(LANG_LABEL_ALREADY_MEMBER);?></a></p>
                            </section>
                        </div>
                     </div>    
                    </div><!--  formwidth end -->
                    <div class="col-sm-10">
                        <div class="row">
                            <div id="claim_login">
                                <form name="formDirectory" method="post" action="<?=((SSL_ENABLED == "on" && FORCE_MEMBERS_SSL == "on") ? SECURE_URL : NON_SECURE_URL);?>/<?=MEMBERS_ALIAS?>/login.php?destiny=<?=EDIRECTORY_FOLDER?>/<?=MEMBERS_ALIAS?>/listing/addsearchlisting.php">
                                    <input type="hidden" name="claim" value="yes" />
                                    <input type="hidden" name="signup" value="login">
                                    <? 
                                    $members_section = true;
                                    include(INCLUDES_DIR."/forms/form_login_review.php");
                                    ?>
                                </form>
                                <section class="login-underbox">
                                    <p><a href="javascript:void(0);" onclick="$('#claim_login').css('display', 'none'); $('#claim_signup').fadeIn(500);"><?=system_showText(LANG_LABEL_SIGNUPNOW);?></a></p>
                                </section>
                            </div> <!-- claim_login end  -->
                        </div> <!-- row -->
                    </div> <!-- col-sm-10 end -->    
        </div><!-- row end  -->

        </div><!-- social-signup end  -->
    </div><!-- container end -->
</section>
 
<?php if($message_account) { ?>
<script type="text/javascript">
    $(document).ready(function(){    
        $('#loginBtnWrapper').hide();
        $('#loginForm').show();
        $('#claim_signup').show();
        $('#claim_login').hide();
    });
</script>
<?php } ?>
