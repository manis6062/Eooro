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
	# * FILE: /sitemgr/export/arcamailerexport.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");
    
    # ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (MAIL_APP_FEATURE != "on") {
		header("Location: ".DEFAULT_URL."/".SITEMGR_ALIAS."/");
		exit;
	}

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();

	$url_redirect = "".DEFAULT_URL."/".SITEMGR_ALIAS."/export";
	$url_base = "".DEFAULT_URL."/".SITEMGR_ALIAS."/export";
	$sitemgr = 1;

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_POST);
	extract($_GET);
    
    $url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

    # ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
    include(EDIRECTORY_ROOT."/includes/code/mailapplist.php");
    
    // Page Browsing /////////////////////////////////////////
	$pageObj  = new pageBrowsing("MailAppList", $screen, RESULTS_PER_PAGE, "date DESC, title", "title", $letter, false);
	$mailappLists = $pageObj->retrievePage();
	
	$paging_url = DEFAULT_URL."/".SITEMGR_ALIAS."/export/arcamailerexport.php";

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
                
                <h1><?=system_showText(LANG_SITEMGR_NAVBAR_DATA_MANAGEMENT);?></h1>
                
            </div>
            
        </div>

        <div id="content-content">
            
            <div class="default-margin">
                
                <div id="delete_maillist" style="display:none">
                    <form name="MailList_post" id="MailList_post" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">
                        <input type="hidden" name="hiddenValue">
                    </form>
                </div>
                
				<?
                require(EDIRECTORY_ROOT."/".SITEMGR_ALIAS."/registration.php");
                require(EDIRECTORY_ROOT."/includes/code/checkregistration.php");
                require(EDIRECTORY_ROOT."/frontend/checkregbin.php");
                
                include (INCLUDES_DIR."/tables/table_data_submenu.php");
                
                include(INCLUDES_DIR."/forms/form_mailapplist.php");
                
                ?>
                
                <a name="info"></a>
                
                <br class="clear" />
                
                <? if ($mailappLists) { ?>
                
                <div id="header-content">
                
                    <h2><?=system_showText(LANG_SITEMGR_MAILAPP_MANAGE);?></h2>

                </div>
                
                <? }
                
                //Success Message
                if (is_numeric($message) && isset($msg_mailapplist[$message])) {
                    echo "<p class=\"successMessage\">".$msg_mailapplist[$message]."</p>";
                } elseif (is_numeric($emessage) && isset($msg_mailapplist[$emessage])) {
                    echo "<p class=\"errorMessage\">".$msg_mailapplist[$emessage]."</p>";
                }

                include(INCLUDES_DIR."/tables/table_paging.php");
                
                if ($mailappLists) {
                    
                    include(INCLUDES_DIR."/tables/table_mailapplist.php");
                    
                    $bottomPagination = true;
                    include(INCLUDES_DIR."/tables/table_paging.php");
                    
                } elseif ($letter || $screen) { ?>
                    <p class="informationMessage">
                        <?=system_showText(LANG_SITEMGR_MAILAPP_NORECORDS)?>
                    </p>
                <? } ?>
                
			</div>
            
        </div>

        <div id="bottom-content">&nbsp;</div>
        
    </div>

    <script language="javascript" type="text/javascript">
        
        var check_progress_time = 1*1000;
        
        function linkRedirect(url){
            window.location = url;
        }
        
        function checkRunningProgress() {
            
            $.post(DEFAULT_URL + "/includes/code/mailapplist.php", {
                domain_id: <?=SELECTED_DOMAIN_ID?>,
                type: 'ajax'
            }, function (ret) {
                if (ret != "quit") {
                    var aRet = ret.split("||");
                    var current_id = aRet[1];
                    var current_status = aRet[3];
                    var current_progress = aRet[5];
                    var last_id = aRet[7];
                    var last_status = aRet[9];
                    
                    //Enable/Disable buttons
                    var enableCurrent_down_bt = false;
                    var enableCurrent_delete_bt = false;
                    
                    var enableLast_down_bt = false;
                    var enableLast_delete_bt = false;
                    
                    var disableCurrent_down_bt = false;
                    var disableCurrent_delete_bt = false;
                    
                    var disableLast_down_bt = false;
                    var disableLast_delete_bt = false;
                    
                    if (current_id) {
                        switch (current_status) {
                            case "R" :  $("#tdprogress_"+current_id).html("<span class=\"status-running\"><?=system_showText(LANG_SITEMGR_IMPORT_RUNNING)?></span>");
                                        disableCurrent_down_bt = true;
                                        disableCurrent_delete_bt = true;
                                        break;
                                        
                            case "E" :  $("#tdprogress_"+current_id).html("<span class=\"status-error\"><?=system_showText(LANG_SITEMGR_IMPORT_ERROR)?></span>");
                                        enableCurrent_delete_bt = true;
                                        break;
                                        
                            case "F" :  $("#tdprogress_"+current_id).html("<span class=\"status-finished\"><?=system_showText(LANG_SITEMGR_IMPORT_FINISHED)?></span>");
                                        enableCurrent_down_bt = true;
                                        enableCurrent_delete_bt = true;
                                        break;
                        }
                        $("#progress_"+current_id).html(current_progress+"%");
                    }
                    
                    if (last_id) {
                        switch (last_status) {
                            case "R" :  $("#tdprogress_"+last_id).html("<span class=\"status-running\"><?=system_showText(LANG_SITEMGR_IMPORT_RUNNING)?></span>");
                                        disableLast_down_bt = true;
                                        disableLast_delete_bt = true;
                                        break;
                                        
                            case "E" :  $("#tdprogress_"+last_id).html("<span class=\"status-error\"><?=system_showText(LANG_SITEMGR_IMPORT_ERROR)?></span>");
                                        enableLast_delete_bt = true;
                                        break;
                                        
                            case "F" :  $("#tdprogress_"+last_id).html("<span class=\"status-finished\"><?=system_showText(LANG_SITEMGR_IMPORT_FINISHED)?></span>");
                                        enableLast_down_bt = true;
                                        enableLast_delete_bt = true;
                                        break;
                        }
                        if (last_status == "F") {
                            $("#progress_"+last_id).html("100%");
                        }
                    }
                    
                    if (enableCurrent_down_bt) {
//                        $("#img_download_"+current_id).attr("src", DEFAULT_URL+"/images/bt_download.gif");
                        $("#img_download_"+current_id).removeClass("disabled");
						$("#img_download_"+current_id).css("cursor", "pointer");
                        document.getElementById("img_download_"+current_id).onclick = function() {
                            linkRedirect('arcamailerexport.php?action=downFile&id='+current_id);
                        }
                    }
                    
                    if (enableCurrent_delete_bt) {
//                        $("#img_delete_"+current_id).attr("src", DEFAULT_URL+"/images/bt_delete.gif");
                        $("#img_delete_"+current_id).removeClass("disabled");
						$("#img_delete_"+current_id).css("cursor", "pointer");
                        document.getElementById("img_delete_"+current_id).onclick = function() {
                            dialogBox('confirm', '<?=system_showText(LANG_SITEMGR_MSGAREYOUSURE);?>', current_id, 'MailList_post', '', '<?=system_showText(LANG_SITEMGR_OK)?>', '<?=system_showText(LANG_SITEMGR_CANCEL)?>');
                        }
                    }
                    
                    if (enableLast_down_bt) {
//                        $("#img_download_"+last_id).attr("src", DEFAULT_URL+"/images/bt_download.gif");
                        $("#img_download_"+last_id).removeClass("disabled");
						$("#img_download_"+last_id).css("cursor", "pointer");
                        document.getElementById("img_download_"+last_id).onclick = function() {
                            linkRedirect('arcamailerexport.php?action=downFile&id='+last_id);
                        }
                    }
                    
                    if (enableLast_delete_bt) {
//                        $("#img_delete_"+last_id).attr("src", DEFAULT_URL+"/images/bt_delete.gif");
                        $("#img_delete_"+last_id).removeClass("disabled");
						$("#img_delete_"+last_id).css("cursor", "pointer");
                        document.getElementById("img_delete_"+last_id).onclick = function() {
                            dialogBox('confirm', '<?=system_showText(LANG_SITEMGR_MSGAREYOUSURE);?>', last_id, 'MailList_post', '', '<?=system_showText(LANG_SITEMGR_OK)?>', '<?=system_showText(LANG_SITEMGR_CANCEL)?>');
                        }
                    }
                    
                    if (disableCurrent_down_bt) {
//                        $("#img_download_"+current_id).attr("src", DEFAULT_URL+"/images/bt_download_off.gif");
                        $("#img_download_"+current_id).addClass("disabled");
						$("#img_download_"+current_id).attr("onclick", "");
						$("#img_download_"+current_id).css("cursor", "default");
                    }
                    
                    if (disableCurrent_delete_bt) {
//                        $("#img_delete_"+current_id).attr("src", DEFAULT_URL+"/images/bt_delete_off.gif");
                        $("#img_delete_"+current_id).addClass("disabled");
						$("#img_delete_"+current_id).attr("onclick", "");
						$("#img_delete_"+current_id).css("cursor", "default");
                    }
                    
                    if (disableLast_down_bt) {
//                        $("#img_download_"+last_id).attr("src", DEFAULT_URL+"/images/bt_download_off.gif");
                        $("#img_download_"+last_id).addClass("disabled");
						$("#img_download_"+last_id).attr("onclick", "");
						$("#img_download_"+last_id).css("cursor", "default");
                    }
                    
                    if (disableLast_delete_bt) {
//                        $("#img_delete_"+last_id).attr("src", DEFAULT_URL+"/images/bt_delete_off.gif");
                        $("#img_delete_"+last_id).addClass("disabled");
						$("#img_delete_"+last_id).attr("onclick", "");
						$("#img_delete_"+last_id).css("cursor", "default");
                    }
                    
                    if (current_id) {
                        setTimeout("checkRunningProgress();", check_progress_time);
                    }
                }

            });
            
        }
        
        <? if ($runAjax) { ?>
            
            $(document).ready(function(){
                checkRunningProgress();
            });
            
        <? } ?>
    </script>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>