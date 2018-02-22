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
	# * FILE: /sitemgr/leads/index.php
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

	$url_redirect = DEFAULT_URL."/".SITEMGR_ALIAS."/leads";
	$url_base     = DEFAULT_URL."/".SITEMGR_ALIAS;

	extract($_GET);
	extract($_POST);

	//increases frequently actions
    if ($_SERVER["REQUEST_METHOD"] != "POST") {
        if ($item_type == "listing") {

            system_setFreqActions("leadlisting_manage", "listing");

        } elseif ($item_type == "classified") {

            if (CLASSIFIED_FEATURE != "on" || CUSTOM_CLASSIFIED_FEATURE != "on") {
                header("Location: ".DEFAULT_URL."/".SITEMGR_ALIAS."/");
                exit;
            }
            system_setFreqActions("leadclassified_manage", "CLASSIFIED_FEATURE");

        } elseif ($item_type == "event") {

            if (EVENT_FEATURE != "on" || CUSTOM_EVENT_FEATURE != "on") {
                header("Location: ".DEFAULT_URL."/".SITEMGR_ALIAS."/");
                exit;
            }
            system_setFreqActions("leadevent_manage", "EVENT_FEATURE");

        } elseif ($item_type == "general") {
            system_setFreqActions("leadgeneral_manage", "leadgeneral_manage");
        }
    }

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/includes/code/lead.php");
	
	if (!$itemObj) {
    	if ($item_type == "listing") {
    		$itemObj = new Listing($item_id);
    	} else if ($item_type == "classified") {
    	    $itemObj = new Classified($item_id);
    	} else if ($item_type == "event") {
    	    $itemObj = new Event($item_id);
    	}
    }

	// Page Browsing /////////////////////////////////////////
	if ($item_id) 				 $sql_where[] = " type = '$item_type' AND item_id = '$item_id' ";
	if ($item_type && !$item_id) $sql_where[] = " type = '$item_type'";

	if ($sql_where) {
		$where .= " ".implode(" AND ", $sql_where)." ";
    }
    
	$pageObj  = new pageBrowsing("Leads", $screen, RESULTS_PER_PAGE, "entered DESC", "first_name", $letter, $where);
	$leadsArr = $pageObj->retrievePage("array");
    
	$paging_url = DEFAULT_URL."/".SITEMGR_ALIAS."/leads/index.php?item_type=$item_type&item_id=$item_id&item_screen=$item_screen&item_letter=$item_letter";

	// Letters Menu
	$letters = $pageObj->getString("letters");
	foreach($letters as $each_letter) {
		if ($each_letter == "#") {
			$letters_menu .= "<a href=\"$paging_url&letter=no\" ".(($letter == "no") ? "style=\"color:#EF413D\"" : "" ).">".string_strtoupper($each_letter)."</a>";
		} else {
			$letters_menu .= "<a href=\"$paging_url&letter=".$each_letter."\" ".(($each_letter == $letter) ? "style=\"color:#EF413D\"" : "" ).">".string_strtoupper($each_letter)."</a>";
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
                <h1>
                    <?=system_showText(LANG_MANAGE_LEADS)?>
                </h1>
            </div>
        </div>
        
        <div id="content-content">
            
            <div class="default-margin">

                <?
                require(EDIRECTORY_ROOT."/".SITEMGR_ALIAS."/registration.php");
                require(EDIRECTORY_ROOT."/includes/code/checkregistration.php");
                require(EDIRECTORY_ROOT."/frontend/checkregbin.php");
                
                include(INCLUDES_DIR."/tables/table_lead_submenu.php"); ?>

                <? if ($item_type) { ?>
                
                <br />
                
                <div id="header-view">
                    <?=system_showText(@constant("LANG_SITEMGR_".strtoupper($item_type)."_LEADS")).($item_id && is_object($itemObj) ? " - ".$itemObj->getString("title") : "");?>
                    
                    <? if ($item_type == "general") { ?>
                        <a class="stmgr-btn capitalize float-right" href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/content/leadeditor.php"?>"><?=system_showText(LANG_SITEMGR_CUSTOMIZE_LEAD)?></a>
                    <? } ?>
                </div>
                
                <? }
                
                include(INCLUDES_DIR."/tables/table_paging.php");

                if ($leadsArr) {

                    include(INCLUDES_DIR."/tables/table_lead.php");
                    
                    $bottomPagination = true;
                    include(INCLUDES_DIR."/tables/table_paging.php");

                } else { ?>
                    <p class="informationMessage"><?=system_showText(LANG_NORECORD)?></p>
                <? } ?>

            </div>
            
        </div>
        
        <div style="display:none">
            <form name="Lead_post" id="Lead_post" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">
                <input type="hidden" name="hiddenValue" />
                <input type="hidden" name="item_id" value="<?=$item_id;?>" />
                <input type="hidden" name="item_type" value="<?=$item_type;?>" />
                <input type="hidden" name="screen" value="<?=$screen;?>" /> 
                <input type="hidden" name="letter" value="<?=$letter;?>" />
            </form>
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