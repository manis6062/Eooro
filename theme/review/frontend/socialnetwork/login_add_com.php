<?//echo MEMBERS_LOGIN_PAGE;?>
<? $members_section = true; ?>
    <div class="container">        
               
    <h1 style="color:black">Login or create your account with  Eooro.com here.</h1>
        
        <div id ="signup">     
            <!-- Signup Box -->
            <form name="order_item" action="<?=NON_SECURE_URL?>/profile/add_com_db.php" method="post" class="standardForm" onsubmit="JS_submit();">

                <input type="hidden" name="advertise" value="yes" />
                <input type="hidden" name="signup" value="true" />

                <div class="form-signup">
                    <div class="col-sm-4 formwidth">
                        <div class="row">
                            <h2 style="color:black">Signup Your Account</h2>

                            <div class="form-group formimage">
                                <input class="form-control loginform" type="text" name="first_name" id="first_name" value="<?=$first_name?>" placeholder="<?=system_showText(LANG_LABEL_FIRST_NAME);?>*" required />
                            </div>
                            
                            <div class="form-group formimage">
                                <input class="form-control loginform" type="text" name="last_name" id="last_name" value="<?=$last_name?>" placeholder="<?=system_showText(LANG_LABEL_LAST_NAME);?>*" required />
                            </div>
                            
                            <div class="form-group formimage">
                                <input class="form-control loginform" type="email" name="username" id="username" value="<?=$username?>" maxlength="<?=USERNAME_MAX_LEN?>" onblur="populateField(this.value,'email');" placeholder="<?=system_showText(LANG_LABEL_USERNAME);?>*" required />
                                <input type="hidden" name="email" id="email" value="<?=$email?>" />
                            </div>
                            <span class="clear"></span>
                            
                            <div class="form-group formimage">
                                <input class="form-control loginform" id="password" type="password" name="password" maxlength="<?=PASSWORD_MAX_LEN?>" placeholder="<?=system_showText(LANG_LABEL_PASSWORD);?>*" required />
                            </div>
                           
                            <div class="row-fluid action">
                                <p class="pull-left text-small doubleline">
                                    <?=str_replace("[a]", "<a rel=\"nofollow\" href=\"".DEFAULT_URL."/popup/popup.php?pop_type=terms\" class=\"fancy_window_iframe\">", str_replace("[/a]", "</a>", system_showText(LANG_ACCEPT_TERMS)));?>
                                    <input type="hidden" name="agree_tou" value="1" />
                                </p> </div>
                                <section class="login-underbox">
                                        <p><a class="link-highlight" href="javascript:void(0);" onclick="showLoginAndHideAddAccount();"><?=system_showText(LANG_LABEL_ALREADY_MEMBER);?></a></p>
                                </section>
                            </div>
                        </div>
                    </div>
            </form> 
       
        </div><!-- end signup div -->              
                   
        <div id="login" style="display:none;">
                
                <!-- Login Box -->
                <div class="col-sm-4 formwidth">
                    <div class="row">
                        <h2 style="color:black">Login into your account</h2>
                        <form class="form" name="formDirectory" method="post" action="<?=NON_SECURE_URL?>/profile/add_com_db.php" role="form">
                            <input type="hidden" name="advertise" value="<?=($_GET["advertise"] ? $_GET["advertise"] : $_POST["advertise"]);?>" />
                            <input type="hidden" name="claim" value="<?=($_GET["claim"] ? $_GET["claim"] : $_POST["claim"]);?>" />
                            <? include(INCLUDES_DIR."/forms/form_login_review.php"); ?>

                            <section class="login-underbox">
                                <p><a class="link-highlight" href="javascript:void(0);" onclick="showAddAccountAndHideLogin();"><?=system_showText(LANG_LABEL_SIGNUPNOW);?></a></p>
                            </section>

                        </form>
                    </div>
                </div>
                
        </div>

                <div class="col-sm-1">
                    <span class="or">or</span>
                </div>       

                
                <!-- Social Media Login -->    
                <div class="col-sm-5 social-signup">
                    <h3 style="color:black">Don’t have an account? Sign Up!</h3>
                    <? 
                        if (FACEBOOK_APP_ENABLED == "on") {
                            $fbLabel = "LOG IN WITH FACEBOOK"; //system_showText(LANG_SIGNUPFACEBOOKUSER);
                            $urlRedirect = (DEFAULT_URL."/".MEMBERS_ALIAS."/"."index.php").("?advertise=yes&advertise_item=$advertiseItem&item_id=".$unique_id."");
                            $_SESSION['advertise'] = 'yes';
                            include( system_getFrontendPath( 'socialnetwork/form_facebooklogin.php') );
                            unset($fbLabel);
                         }

                        if ($foreignaccount_google) {
                            $goLabel = "LOGIN WITH GOOGLE";//system_showText(LANG_SIGNUPGOOGLEUSER);
                            //$urlRedirect = "&claim=yes&destiny=".urlencode(DEFAULT_URL."/".MEMBERS_ALIAS."/claim/getlisting.php?claimlistingid=".$claimlistingid);
                            //include( system_getFrontendPath( 'socialnetwork/form_googlelogin.php') );
                            $urlRedirect = "&advertise=yes&advertise_item=$advertiseItem&item_id=".$unique_id."&destiny=".urlencode(DEFAULT_URL."/".MEMBERS_ALIAS."/".constant(strtoupper($advertiseItem)."_FEATURE_FOLDER")."/".($advertiseItem == "banner" ? "add" : $advertiseItem).".php");
                            $_SESSION['advertise'] = 'yes';
                            include( system_getFrontendPath( 'socialnetwork/form_googlelogin.php') );
                            //include(INCLUDES_DIR."/forms/form_googlelogin.php");
                            unset($goLabel);
                        } 
                         if ($foreignaccount_google) {
                            $urlRedirect = "&advertise=yes&advertise_item=$advertiseItem&item_id=".$unique_id."&destiny=".urlencode(DEFAULT_URL."/".MEMBERS_ALIAS."/".constant(strtoupper($advertiseItem)."_FEATURE_FOLDER")."/".($advertiseItem == "banner" ? "add" : $advertiseItem).".php");

                            include( system_getFrontendPath( 'socialnetwork/form_twitterlogin.php') );
                        } 
                         if ($foreignaccount_google) {
                            $urlRedirect = "&advertise=yes&advertise_item=$advertiseItem&item_id=".$unique_id."&destiny=".urlencode(DEFAULT_URL."/".MEMBERS_ALIAS."/".constant(strtoupper($advertiseItem)."_FEATURE_FOLDER")."/".($advertiseItem == "banner" ? "add" : $advertiseItem).".php");
                            include( system_getFrontendPath( 'socialnetwork/form_linkedinlogin.php') );
            } 
                         ?>
                </div>

        

    </div>


<script>



        function showLoginAndHideAddAccount(){
            // show and hide divs
            $('#signup').css('display', 'none'); 
            $('#login').fadeIn(500);
            
            //remove required from add account
            $('#first_name').removeAttr( 'required' );
            $('#last_name').removeAttr( 'required' );
            $('#username').removeAttr( 'required' );
            $('#password').removeAttr( 'required' );
            //add required on login
            $('#dir_username').attr( 'required', true );
            $('#dir_password').attr( 'required', true );
        }
        
        function showAddAccountAndHideLogin(){
            $('#login').css('display', 'none'); 
            $('#signup').fadeIn(500);
            
            // remove required from login
            $('#dir_username').removeAttr( 'required' );
            $('#dir_password').removeAttr( 'required' );
            // add required on add account
            $('#first_name').attr( 'required', true );
            $('#last_name').attr( 'required', true );
            $('#username').attr( 'required', true );
            $('#password').attr( 'required', true );

        }
    </script>

