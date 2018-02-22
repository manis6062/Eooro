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
    # * FILE: /sitemgr/toApprove.php
    # ----------------------------------------------------------------------------------------------------

    # ----------------------------------------------------------------------------------------------------
    # LOAD CONFIG
    # ----------------------------------------------------------------------------------------------------
    $aux_domain_id = (($_POST["aux_domain_id"]) ? ($_POST["aux_domain_id"]) : ($_GET["aux_domain_id"]));
    if ($aux_domain_id) {
        define("SELECTED_DOMAIN_ID", $aux_domain_id);
    }
    include("../conf/loadconfig.inc.php");
    
    //Ajax
    if ($_GET["action"] == "reload") {
        
        header("Content-Type: text/html; charset=".EDIR_CHARSET, TRUE);
        header("Accept-Encoding: gzip, deflate");
        header("Expires: Sat, 01 Jan 2000 00:00:00 GMT");
        header("Cache-Control: no-store, no-cache, must-revalidate");
        header("Cache-Control: post-check=0, pre-check", FALSE);
        header("Pragma: no-cache");
        
        $tobeapproved = "";
        if ($_GET["item"] == "reviews") {
            $tobeapproved = activity_retrieveToApproved(DASHBOARD_MAX_PENDING_REVIEWS, "reviews", true);
        } else {
            $tobeapproved = activity_retrieveToApproved(DASHBOARD_MAX_TO_APPROVED);
        }
        echo $tobeapproved;
        
    //Open popup
    } else {
        
        $isPopupApprove = true;
        $id = (($_POST["id"]) ? ($_POST["id"]) : ($_GET["id"]));
        $module = (($_POST["module"]) ? ($_POST["module"]) : ($_GET["module"]));

        switch ($module) {
            case "listing"      : $folder = LISTING_FEATURE_FOLDER; break;
            case "event"        : $folder = EVENT_FEATURE_FOLDER; break;
            case "classified"   : $folder = CLASSIFIED_FEATURE_FOLDER; break;
            case "article"      : $folder = ARTICLE_FEATURE_FOLDER; break;
            case "banner"       : $folder = BANNER_FEATURE_FOLDER; break;
        }

        include(EDIRECTORY_ROOT."/".SITEMGR_ALIAS."/".$folder."/settings.php");
    }
    
?>