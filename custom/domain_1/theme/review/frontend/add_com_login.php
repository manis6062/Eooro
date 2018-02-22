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
	# * FILE: /members/login.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# DOMAIN COOKIE VALIDATION
	# ----------------------------------------------------------------------------------------------------
	if (!$_COOKIE["automatic_login_members"] || $_COOKIE["automatic_login_members"] == "false") {
		$resetDomainSession = true;
	}
	
	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
    //include(EDIRECTORY_ROOT."/includes/code/login.php");
    	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	//include(MEMBERS_EDIRECTORY_ROOT."/layout/header.php");
        /**
         * modification
         */
        //$showAdvertiseWithUs = false;
?>

        <div>
            <?$headertag_title = $headertagtitle;
            $headertag_description = $headertagdescription;
            $headertag_keywords = $headertagkeywords;
            $hide_search = true;
            include(system_getFrontendPath("header.php", "layout"));
            ?>
        </div>

	<div class="row-fluid login-page">
        <div class="span12">
            <section class="login-underbox">
               <? include(system_getFrontendPath("login_add_com.php", "frontend/socialnetwork")); ?>
            </section>
        </div>
        </div>

        <div>
            <?
            include(system_getFrontendPath("footer.php", "layout"));
            ?> 
        </div>
