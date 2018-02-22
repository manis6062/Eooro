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
	# * FILE: /includes/forms/form_googlelogin.php
	# ----------------------------------------------------------------------------------------------------

    if (!$goLabel) {
        if (string_strpos($_SERVER["PHP_SELF"], "order") !== false || string_strpos($_SERVER["REQUEST_URI"], ALIAS_CLAIM_URL_DIVISOR."/") !== false) {
            $goLabel = "Google";
        } else {
            $goLabel = system_showText(LANG_LOGINGOOGLEUSER);
        }
    }
    $state = $_SESSION['go_state'] = md5( uniqid() );
    setting_get("foreignaccount_google", $foreignaccount_google);
?>

    <div class="login-button login-google">
    <a id="googleSignInButton" href="javascript: void(0);"><?=$goLabel?></a>
    </div>

    <script language="javascript" type="text/javascript">
        //<![CDATA[	
        var destiny = '<?=DEFAULT_URL."/".MEMBERS_ALIAS."/googleauth.php?login$urlRedirect"?>';
        $( document ).ready(function(){
            $( '#googleSignInButton' ).click(function(){
                $( this ).attr( 'href', 'https://accounts.google.com/o/oauth2/auth?scope=' +
                                    'https%3A%2F%2Fwww.googleapis.com%2Fauth%2Fplus.profile.emails.read&' +
                                    'state=<?=$state?>&' +
                                    'redirect_uri=<?=GOOGLE_REDIRECT_URL?>&'+
                                    'response_type=code&' +
                                    'client_id=<?=GOOGLE_CLIENT_ID?>&' +
                                    'access_type=online' );
                            console.log( this );
            });
        });
        //]]>
    </script>
  