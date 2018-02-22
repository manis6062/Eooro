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
	# * FILE: /conf/google.inc.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# FLAGS - on/off
	# ----------------------------------------------------------------------------------------------------
	define("GOOGLE_ADS_ENABLED",        "on");
	define("GOOGLE_MAPS_ENABLED",       "on");
	define("GOOGLE_ANALYTICS_ENABLED",  "on");
	define("GOOGLE_TAGMANAGER_ENABLED", "on");
        
        setting_get("foreignaccount_google", $foreignaccount_google);
        setting_get("google_client_id", $google_client_id);
        setting_get("google_client_secret", $google_client_secret);
        setting_get("google_developer_key", $google_developer_key);

        define( 'GOOGLE_CLIENT_ID', $google_client_id );
        define( 'GOOGLE_CLIENT_SECRET', $google_client_secret );
        define( 'GOOGLE_DEVELOPER_KEY', $google_developer_key );

        //commented the orginal one
//        define( 'GOOGLE_CLIENT_ID', '908847492733-o83qot2ke16fhcfqi4jr0glkn4g613aq.apps.googleusercontent.com' );
//        define( 'GOOGLE_CLIENT_SECRET', '7r0A1Fl6NNvIW_magq7-yIPZ' );
//        define( 'GOOGLE_DEVELOPER_KEY', '908847492733-ciji02no759imr2bbhn3o59man8b3qu6.apps.googleusercontent.com' );


        if(SSL_ENABLED == "on" && MEMBERS_BILL_LOGIN_SSL =="on" ){
				define( 'GOOGLE_REDIRECT_URL', SECURE_URL."/".MEMBERS_ALIAS."/googleauth.php" );
			} else {
				define( 'GOOGLE_REDIRECT_URL', DEFAULT_URL."/".MEMBERS_ALIAS."/googleauth.php" );
		}



        // define( 'GOOGLE_REDIRECT_URL', DEFAULT_URL."/".MEMBERS_ALIAS."/googleauth.php" );
     
 ?>
