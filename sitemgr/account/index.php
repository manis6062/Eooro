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
	# * FILE: /sitemgr/account/index.php
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

	$url_base = "".DEFAULT_URL."/".SITEMGR_ALIAS."";

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------	
	extract($_POST);
	extract($_GET);

	//increases frequently actions
	if (!isset($message)) system_setFreqActions('account_manage','account');

	$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));
    
    //Pending accounts per page
    setting_get("pendingReviews_per_page", $pendingAccounts_per_page);
    
    if (!$pendingAccounts_per_page) $pendingAccounts_per_page = 2;

	// Page Browsing ////////////////////////////////////////
	$pageObj  = new pageBrowsing("Account", $screen, RESULTS_PER_PAGE, (($_GET["newest"])?("id DESC"):("lastlogin DESC, username")), "username", $letter, false, "*", false, false, true);
	$accounts = $pageObj->retrievePage();
    
    $pageObjPending  = new pageBrowsing("Account", $screenP, ($viewAllP ? false : $pendingAccounts_per_page), "entered DESC", "username", $letterPending, "active = 'n'", "*", false, false, true);
	$accountsPending = $pageObjPending->retrievePage();

	$paging_url = DEFAULT_URL."/".SITEMGR_ALIAS."/account/index.php";

	// Letters Menu
	$letters = $pageObj->getString("letters");
	foreach ($letters as $each_letter) {
		if ($each_letter == "#") {
			$letters_menu .= "<a href=\"$paging_url?letter=no\" ".(($letter == "no") ? "style=\"color:#EF413D\"" : "" ).">".string_strtoupper($each_letter)."</a>";
		} else {
			$letters_menu .= "<a href=\"$paging_url?letter=".$each_letter."\" ".(($each_letter == $letter) ? "style=\"color: #EF413D\"" : "" ).">".string_strtoupper($each_letter)."</a>";
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
    <script type="text/javascript">
        
        function approveAccount(acc_id) {
             $.get("<?=DEFAULT_URL."/".SITEMGR_ALIAS."/account/approve.php"?>", {
                acc_id: acc_id
            }, function () {
                window.location.reload();
            });
        }
        
    </script>

    <div id="main-right">
        
        <div id="top-content">
            <div id="header-content">
                <h1><?=(SOCIALNETWORK_FEATURE == "on" ? system_showText(LANG_SITEMGR_LABEL_SPONSOR) : system_showText(LANG_SITEMGR_SPONSORACCOUNTS));?></h1>
            </div>
        </div>
        
        <div id="content-content">
            <div class="default-margin">

                <? 
                require(EDIRECTORY_ROOT."/".SITEMGR_ALIAS."/registration.php");
                require(EDIRECTORY_ROOT."/includes/code/checkregistration.php");
                require(EDIRECTORY_ROOT."/frontend/checkregbin.php");
                
                include(INCLUDES_DIR."/tables/table_account_submenu.php");
                
                if ($accountsPending) { ?>
                
                    <div id="header-view" class="left"> 
                        
                        <h4 class="general-title"><?=system_showText(LANG_SITEMGR_ACCOUNTS_NOTACTIVE)?> (<?=($pageObjPending->getString("record_amount"))?>)</h4>
                         <? if ($pageObjPending->getString("pages") > 1) { ?>        
                                <a class="general-viewall caps" href="<?=$paging_url?>?viewAllP=1">
                                    <?=system_showText(LANG_LABEL_VIEW_ALL)?>
                                </a>
                        <? } ?>
                        
                    </div>
                
                    <div id="account-pending">
                        
                        <? foreach ($accountsPending as $each_accountP) { unset($contactObj); $contactObj = new Contact($each_accountP->getNumber("id")); ?>
                        
                            <div class="account-box <?=($each_accountP->getString("is_sponsor") == "n" ? "acc-visitor" : "")?>">

                                <div class="acc-type">
                                    <h4><?=($each_accountP->getString("is_sponsor") == "n" ? system_showText(LANG_SITEMGR_NEWACC_VISITOR) : system_showText(LANG_SITEMGR_NEWACC_SPONSOR))?></h4>
                                </div>
                                
                                <div class="acc-view">
                                    
                                    <div class="acc-view acc-name">
                                        <h4><?=(system_showTruncatedText($contactObj->getString("first_name")." ".$contactObj->getString("last_name"), 20))?></h4>
                                    </div>
                                    
                                    <div class="acc-view acc-email">
                                        <h4><?=system_showText(LANG_LABEL_USERNAME).": ".  system_showTruncatedText(system_showAccountUserName($each_accountP->getString("username")), 30);?></h4>
                                    </div>
                                    
                                    <div class="acc-view acc-info">
                                        <h4><?=system_showText(LANG_SITEMGR_DATECREATED).": ".format_date($each_accountP->getString("entered"), DEFAULT_DATE_FORMAT, "datetime")." - ".format_getTimeString($each_accountP->getNumber("entered"));?></h4>
                                    </div>
                                    
                                    <div class="acc-view acc-options">
                                        <ul>
                                            <li class="acc-aprove">
                                                <a href="javascript: void(0);" onclick="approveAccount(<?=$each_accountP->getString("id")?>);">
                                                    <img src="<?=DEFAULT_URL?>/images/ico-approve.png"/> <?=system_showText(LANG_REVIEW_APPROVE);?>
                                                </a>
                                            </li>
                                            
                                            <li class="acc-edit">
                                                <a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/account/account.php?id=<?=$each_accountP->getString("id")?>&screenP=<?=$screenP?>&letter=<?=$letter?>&item_screen=<?=$item_screen?>&item_letter=<?=$item_letter?>">
                                                    <img src="<?=DEFAULT_URL?>/images/ico-edit.png"/> <?=system_showText(LANG_LABEL_EDIT);?>
                                                </a>
                                            </li>

                                            <li class="acc-deny">
                                                <a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/account/delete.php?id=<?=$each_accountP->getString("id")?>&screenP=<?=$screenP?>&letter=<?=$letter?>&item_screen=<?=$item_screen?>&item_letter=<?=$item_letter?>">
                                                    <img src="<?=DEFAULT_URL?>/images/ico-deny.png"/> <?=system_showText(LANG_LABEL_DELETE);?>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    
                                </div>
                                
                            </div>
                        
                        <? } ?>
                        
                        <? if ($pageObjPending->getString("pages") > 1) { ?>
                        
                            <div class="acc-pag">
                                <? if ($screenP > 1) { ?>   
                                        <a class="acc-pag-prev" href="<?=$paging_url?>?letterPending=<?=$letterPending?>&amp;screenP=<?=$pageObjPending->getString("back_screen")?>" title="<?=system_showText(LANG_PAGING_PREVIOUSPAGE)?>"><span><?=system_showText(LANG_PAGING_PREVIOUSPAGE)?></span></a>
                                <? } ?>

                                <? if ($pageObjPending->getString("pages") > $screenP) { ?>  
                                        <a class="acc-pag-next" href="<?=$paging_url?>?letterPending=<?=$letterPending?>&amp;screenP=<?=$pageObjPending->getString("next_screen")?>" title="<?=system_showText(LANG_PAGING_NEXTPAGE)?>"><span><?=system_showText(LANG_PAGING_NEXTPAGE)?></span></a>
                                <? } ?>
                            </div>
                        
                        <? } ?>
                        
                    </div>
                
                    <?
                }
                
                if (!$viewAllP) {
                    
                    include(INCLUDES_DIR."/tables/table_paging.php");
                    
                    if ($accounts) {
                        
                        include(INCLUDES_DIR."/tables/table_account.php");
                        
                        $bottomPagination = true;
                        include(INCLUDES_DIR."/tables/table_paging.php");
                    } else { ?>
                
                        <p class="informationMessage">
                            <?=system_showText(LANG_SITEMGR_ACCOUNT_NORECORD)?>
                        </p>
                    
                    <? }
                    
                } ?>

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