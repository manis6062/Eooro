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
	# * FILE: /profile/logout.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
        sess_validateSession();
	if (string_strpos($_SERVER["HTTP_REFERER"], "/profile") !== false) {
              
                
		sess_logoutAccountFront();
                
	} else {
		$url = $_SERVER["HTTP_REFERER"];
		$url = str_replace("https", "http", $url);
                
                // sess_logoutAccountFront($url); //PREVIOUSLY: to redirect to sponsors/login.php after logout
                sess_logoutAccountFront();		  //redirects to home page
	}
?>