<?

	/*==================================================================*\
	######################################################################
	#                                                                    #
	# Copyright 2014 Arca Solutions, Inc. All Rights Reserved.           #
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
	# * FILE: /sitemgr/mobile/appbuilder/notify.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../../conf/loadconfig.inc.php");
       
    # ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
    extract($_POST);

    if (strpos($_SERVER["HTTP_REFERER"], "updateBuild.php") !== false) {
        
        if (!setting_set("appbuilder_pendingdownload", ($downloads > 0 ? "yes" : "no"))) {
            setting_new("appbuilder_pendingdownload", ($downloads > 0 ? "yes" : "no"));
        }
        if (!setting_set("appbuilder_pendingdownload_total", $downloads)) {
            setting_new("appbuilder_pendingdownload_total", $downloads);
        }
        if (!setting_set("appbuilder_build_done", "yes")) {
            setting_new("appbuilder_build_done", "yes");
        }
        
    }
    
?>