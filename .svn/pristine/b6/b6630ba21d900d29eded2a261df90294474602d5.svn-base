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
	# * FILE: /includes/forms/form_facebooklogin.php
	# ----------------------------------------------------------------------------------------------------
        require CLASSES_DIR.'/apis/facebook/autoload.php';
        
        use Facebook\FacebookRedirectLoginHelper;
        use Facebook\FacebookSession;
        
	Facebook::getFBInstance($facebook);
    //TODO: Depricated function
        //        $facebook->setFbSession($FBSession);
        //        FacebookSession::setDefaultApplication( FACEBOOK_API_ID, FACEBOOK_API_SECRET );
        //	if (!isset($urlRedirect)) {
        //		$urlRedirect = "?destiny=".urlencode(DEFAULT_URL.str_replace(EDIRECTORY_FOLDER, "", $_SERVER["REQUEST_URI"]));
        //	}
                
        //	$loginParams = array(
        //		"redirect_uri"		=> FACEBOOK_REDIRECT_URI.$urlRedirect,
        //		"scope"				=> FACEBOOK_PERMISSION_SCOPE
        //	);
    //End of TODO
        $helper = $facebook->getHelper();
        // for temporary use
        $_SESSION['red_destiny'] = $urlRedirect;
        
    if (!$fbLabel) {
        if (string_strpos($_SERVER["PHP_SELF"], "order") !== false || string_strpos($_SERVER["REQUEST_URI"], ALIAS_CLAIM_URL_DIVISOR."/") !== false) {
            $fbLabel = "Facebook";
        } else {
            $fbLabel = system_showText(LANG_LOGINFACEBOOKUSER);
        }
    }
    
    if ($linkAttachFB) { ?>

       <!-- <p><i class="socialicon social-facebook"></i><a href="<?//=$helper->getLoginUrl(explode(',', FACEBOOK_PERMISSION_SCOPE));?>"><?//=system_showText(LANG_LABEL_LINK_FACEBOOK);?></a></p>-->

    <? } else { ?>

        <div class="login-button login-facebook">        
            <a <?=($isPopUP ? "target=\"_top\"" : "")?> href="<?=$helper->getLoginUrl(explode(',', FACEBOOK_PERMISSION_SCOPE));?>"><?=$fbLabel?></a>
        </div>

        <p>&nbsp;</p>
    
    <? } ?>