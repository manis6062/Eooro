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
	# * FILE: /sitemgr/mobile/notifications.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();

	$url_redirect = "".DEFAULT_URL."/".SITEMGR_ALIAS."/mobile";
	$url_base = "".DEFAULT_URL."/".SITEMGR_ALIAS."";
	$sitemgr = 1;

	$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

	extract($_GET);
	extract($_POST);

	//increases frequently actions
	if (!isset($message)) system_setFreqActions('mobile_notif', 'app_notifications');
    
    //Submit - delete
    if ($_SERVER["REQUEST_METHOD"] == "POST" && $hiddenValue) {
        $id = intval($hiddenValue);
        $notifObj = new AppNotification($id);
        $notifObj->Delete();
        header("Location: $url_redirect/notifications.php?message=3&screen=$screen&letter=$letter".(($url_search_params) ? "&$url_search_params" : "" )."");
        exit;
    }
	
	// Page Browsing /////////////////////////////////////////
	unset($pageObj);

	$pageObj  = new pageBrowsing("AppNotification", $screen, RESULTS_PER_PAGE, ($_GET["newest"] ? "id DESC, entered" : "status, entered desc"), "title", $letter, false);

	$notifs = $pageObj->retrievePage();
	
	$paging_url = DEFAULT_URL."/".SITEMGR_ALIAS."/mobile/notifications.php";

	// Letters Menu
	$letters = $pageObj->getString("letters");
	foreach ($letters as $each_letter) {
		if ($each_letter == "#") {
			$letters_menu .= "<a href=\"$paging_url?letter=no\" ".(($letter == "no") ? "style=\"color:#EF413D\"" : "" ).">".string_strtoupper($each_letter)."</a>";
		} else {
			$letters_menu .= "<a href=\"$paging_url?letter=".$each_letter."\" ".(($each_letter == $letter) ? "style=\"color:#EF413D\"" : "" ).">".string_strtoupper($each_letter)."</a>";
		}
	}

	# PAGES DROP DOWN ----------------------------------------------------------------------------------------------
	$pagesDropDown = $pageObj->getPagesDropDown($_GET, $paging_url, $screen, system_showText(LANG_SITEMGR_PAGING_GOTOPAGE)." ", "this.form.submit();");
	# --------------------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/header.php");

	# ----------------------------------------------------------------------------------------------------
	# NAVBAR
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/navbar.php");

?>
    <div id="main-right">
        
        <div id="top-content">
            <div id="header-content">
                <h1><?=system_showText(LANG_SITEMGR_MOBILE);?> - <?=system_showText(LANG_SITEMGR_MOBILE_NOTIFICATIONS)?></h1>
            </div>
        </div>
        
        <div id="content-content">
            
            <div class="default-margin">
                
                <div id="delete_notif" class="default-margin" style="display:none">
                    <form name="Notif_post" id="Notif_post" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">
                        <input type="hidden" name="hiddenValue">
                    </form>
                </div>

                <? 
                require(EDIRECTORY_ROOT."/".SITEMGR_ALIAS."/registration.php");
                require(EDIRECTORY_ROOT."/includes/code/checkregistration.php");
                require(EDIRECTORY_ROOT."/frontend/checkregbin.php");

                include(INCLUDES_DIR."/tables/table_mobilenotif_submenu.php");
                
                include(INCLUDES_DIR."/tables/table_paging.php");
                
                //Success Message
                if (is_numeric($message) && isset($msg_appNotif[$message])) {
                    echo "<p class=\"successMessage\">".$msg_appNotif[$message]."</p>";
                }

                if ($notifs) {
                    
                    $status = new ItemStatus();
                    
                    include(INCLUDES_DIR."/tables/table_mobilenotifs.php");
                    
                    $bottomPagination = true;
                    include(INCLUDES_DIR."/tables/table_paging.php");
                    
                } else { ?>
                    <p class="informationMessage">
                        <?=system_showText(LANG_SITEMGR_MOBILENOTIF_NORECORDS)?>
                    </p>
                <? } ?>
            </div>
            
        </div>
        
        <div id="bottom-content">
            &nbsp;
        </div>
        
    </div>
<? 
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>