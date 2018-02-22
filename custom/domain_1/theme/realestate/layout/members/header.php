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
	# * FILE: /theme/realestate/layout/members/header.php
	# ----------------------------------------------------------------------------------------------------

?>

	<body class="body">
        
        <!-- Google Tag Manager code - DO NOT REMOVE THIS CODE  -->
        <?=front_googleTagManager();?>
        
        <? if (DEMO_LIVE_MODE && file_exists(EDIRECTORY_ROOT."/frontend/livebar.php")) {
            include(EDIRECTORY_ROOT."/frontend/livebar.php");
        } ?>
        
		<div id="div_to_share" class="share-box" style="display: none"></div>
        
        <? if (is_ie(true) || ($checkIE && $ieVersion == 7)) { ?>
			<div class="browserMessage">
            	<div class="wrapper">
					<?=system_showText(LANG_IE6_WARNING);?>
                </div>
            </div>
		<? }
		
		/** Float Layer *******************************************************************/
		include(INCLUDES_DIR."/views/view_float_layer.php");
        /**********************************************************************************/
        
		system_increaseVisit(db_formatString(getenv("REMOTE_ADDR")));
		
        ?>
        
        <div id="header-wrapper">
		
			<div id="header">
		
				<h1 class="logo">
					<a id="logo-link" href="<?=NON_SECURE_URL?>/<?=MEMBERS_ALIAS?>/index.php" target="_parent" <?=(trim(EDIRECTORY_TITLE) ? "title=\"".EDIRECTORY_TITLE."\"" : "")?> <?=system_getHeaderLogo();?>>
						<?=EDIRECTORY_TITLE?>
					</a>
				</h1>
                
                <? include(MEMBERS_EDIRECTORY_ROOT."/layout/usernavbar.php"); ?>
                
			</div>
			
		</div>
        
        <? if (sess_getAccountIdFromSession()) { ?>
        
            <div id="navbar-wrapper">
                
                <? /* NAVBAR WRAP FOR FLUID WIDTH LAYOUT NAVBAR*/ ?>
                <ul id="navbar">
                
					<?
                    $accObj = new Account(sess_getAccountIdFromSession());
                    if ((string_strpos($_SERVER["PHP_SELF"], "".MEMBERS_ALIAS."/signup") === false) && (string_strpos($_SERVER["PHP_SELF"], "".MEMBERS_ALIAS."/claim") === false) && $accObj->getString("is_sponsor") == "y") {
                        ?>
                        
                        <li <?=((string_strpos($_SERVER["PHP_SELF"], "/".MEMBERS_ALIAS."/index.php") !== false) ? "class=\"menuActived\"" : "")?>>
                            <a href="<?=DEFAULT_URL?>/<?=MEMBERS_ALIAS?>/"><?=system_showText(LANG_MEMBERS_DASHBOARD)?></a>
                        </li>
                        
                        <li <?=((string_strpos($_SERVER["PHP_SELF"], "/".MEMBERS_ALIAS."/billing") !== false) || (string_strpos($_SERVER["PHP_SELF"], "/".MEMBERS_ALIAS."/transactions") !== false) ? "class=\"menuActived\"" : "")?>>
                            <a href="<?=DEFAULT_URL?>/<?=MEMBERS_ALIAS?>/billing/"><?=system_showText(LANG_LABEL_BILLING)?></a><i class="notify" id="billing_notify" style="display:none"></i>
                        </li>

                        <li <?=((string_strpos($_SERVER["PHP_SELF"], "/".MEMBERS_ALIAS."/account/index.php") !== false) ? "class=\"menuActived\"" : "")?>>
                            <a href="<?=DEFAULT_URL?>/<?=MEMBERS_ALIAS?>/account/"><?=system_showText(LANG_LABEL_ACCOUNT)?></a>
                        </li>                        
  
            		<? } ?>
				
                </ul>
                
            </div>
		
		<? } ?>

		<div class="content-wrapper ">
            
            <div class="members" >
                
                <div class="content-center">