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
	# * FILE: /frontend/socialnetwork/page_tabs.php
	# ----------------------------------------------------------------------------------------------------

	if ($_GET["id"]) {
		$account = $_GET["id"];
	} else {
		$account = sess_getAccountIdFromSession();
	}
	
	$account = new Account($account);
    
    include(INCLUDES_DIR."/forms/form_members_messages.php");

    if (($account->getString("foreignaccount") == "y") && ($account->getString("foreignaccount_done") == "n")) { ?>
        <p class="warningMessage"><?=system_showText(LANG_MSG_FOREIGNACCOUNTWARNING);?></p>
    <? } ?>

    <? if ($account->getString("is_sponsor") == "n") { ?>
        
    <ul class="profile-tabs">
        
        <li id="tab_1" class="<?=($tab == "tab_1" || !$tab) ? "active" : ""?>">
            <a href="<?=SOCIALNETWORK_URL?>/edit.php?tab=tab_1"><?=system_showText(LANG_LABEL_PERSONAL_PAGE)?></a>
        </li>
        
        <li id="tab_2" class="<?=($tab == "tab_2") ? "active" : ""?>">
            <a href="<?=SOCIALNETWORK_URL?>/edit.php?tab=tab_2"><?=system_showText(LANG_LABEL_ACCOUNT_SETTINGS)?></a>
        </li>
        
    </ul>
        
    <? } ?>