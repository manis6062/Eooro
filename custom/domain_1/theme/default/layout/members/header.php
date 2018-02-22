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
	# * FILE: /theme/default/layout/members/header.php
	# ----------------------------------------------------------------------------------------------------

    // to work in members page
    $dispatcher = PluginRegistry::getDispatcher();
    $dispatcher->dispatch( 'UserNavigation' );
?>  
    <!--[if IE 7]><body class="ie ie7"><![endif]-->
    <!--[if lt IE 9]><body class="ie"><![endif]-->
    <!-- [if false]><body><![endif]-->
    
    <!-- Google Tag Manager code - DO NOT REMOVE THIS CODE  -->
    <?=front_googleTagManager();?>
    
    <? if (DEMO_LIVE_MODE && file_exists(EDIRECTORY_ROOT."/frontend/livebar.php")) {
        include(EDIRECTORY_ROOT."/frontend/livebar.php");
    } ?>
   
    <script type="text/javascript">
        $(function() {

            $(".dropdown-toggle").click(function() {
                $(".dropdown-menu").toggle();
            });
 
            $("#main_menu").click(function() {
                $(".nav-collapse-members").toggleClass("in");
            });
        });
    </script>
    
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
    
    <div class="navbar navbar-static-top">
            
        <div class="header-brand container">
            <!-- The function "system_getHeaderLogo()" returns a inline style, like style="background-image: url(YOUR LOGO URL HERE)" -->
            <div class="brand-logo">
            <a class="brand logo" id="logo-link" href="<?=NON_SECURE_URL?>/" target="_parent" <?=(trim(EDIRECTORY_TITLE) ? "title=\"".EDIRECTORY_TITLE."\"" : "")?> <?=system_getHeaderLogo();?>>
                <?=(trim(EDIRECTORY_TITLE) ? EDIRECTORY_TITLE : "&nbsp;")?>
            </a>
            </div>
        </div>
        
        <div class="navbar-inner">
                
            <div class="container">
                
                <a class="hidden-desktop brand logo" href="<?=NON_SECURE_URL?>/" <?=system_getHeaderMobileLogo(true);?>>
                    <?=(trim(EDIRECTORY_TITLE) ? EDIRECTORY_TITLE : "&nbsp;")?>
                </a>
                    
                <!-- .btn-navbar is used as the toggle for collapsed navbar content -->
                <?
                $accObj = new Account(sess_getAccountIdFromSession());
                if ((sess_getAccountIdFromSession()) && (string_strpos($_SERVER["PHP_SELF"], "".MEMBERS_ALIAS."/signup") === false) && (string_strpos($_SERVER["PHP_SELF"], "".MEMBERS_ALIAS."/claim") === false) && $accObj->getString("is_sponsor") == "y") { ?>      
                <a class="btn btn-navbar" id="main_menu">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <? } ?>

                 <? if (sess_getAccountIdFromSession()) { ?>
                
                <div class="nav-collapse-members">
                    
                    <ul class="nav" id="ul_main_menu">                            
                        <? if ((string_strpos($_SERVER["PHP_SELF"], "".MEMBERS_ALIAS."/signup") === false) && (string_strpos($_SERVER["PHP_SELF"], "".MEMBERS_ALIAS."/claim") === false) && $accObj->getString("is_sponsor") == "y") { ?>
                        
                        <li <?=((string_strpos($_SERVER["PHP_SELF"], "/".MEMBERS_ALIAS."/index.php") !== false) ? "class=\"menuActived\"" : "")?>>
                            <a href="<?=DEFAULT_URL?>/<?=MEMBERS_ALIAS?>/"><?=system_showText(LANG_MEMBERS_DASHBOARD)?></a>
                        </li>
                        
                        <li <?=((string_strpos($_SERVER["PHP_SELF"], "/".MEMBERS_ALIAS."/billing") !== false) || (string_strpos($_SERVER["PHP_SELF"], "/".MEMBERS_ALIAS."/transactions") !== false) ? "class=\"menuActived\"" : "")?>>
                            <a href="<?=DEFAULT_URL?>/<?=MEMBERS_ALIAS?>/billing/"><?=system_showText(LANG_LABEL_BILLING)?><i class="notify" id="billing_notify" style="display:none"></i></a>
                        </li>

                        <li <?=((string_strpos($_SERVER["PHP_SELF"], "/".MEMBERS_ALIAS."/account/index.php") !== false) ? "class=\"menuActived\"" : "")?>>
                            <a href="<?=DEFAULT_URL?>/<?=MEMBERS_ALIAS?>/account/"><?=system_showText(LANG_LABEL_ACCOUNT)?></a>
                        </li>
                        
                       <? } ?>
                    </ul>
                    
                    <ul class="nav pull-right">
                        <? if (!empty($_SESSION[SM_LOGGEDIN])) { ?>
                        
                            <script language="javascript" type="text/javascript">
                                function sitemgrSection() {
                                    location = "<?=DEFAULT_URL?>/<?=MEMBERS_ALIAS?>/sitemgraccess.php?logout";
                                }
                            </script>
                            
                            <li>
                                <a href="javascript:sitemgrSection();"><?=system_showText(LANG_LABEL_SITEMGR_SECTION);?></a>
                            </li>
                            
                        <? } else { ?>

                            <li class="dropdown">
                                <a href="javascript: void(0);" class="sign-up dropdown-toggle">
                                    <i class="sitemgr-icon-gear"></i>
                                </a>
                                
                                <ul class="dropdown-menu">                                    
                                       
                                    <li>
                                        <a href="<?=SOCIALNETWORK_URL?>/"><?=system_showText(LANG_LABEL_PROFILE)?></a>
                                    </li>
                                    
                                    <li>
                                        <a href="<?=NON_SECURE_URL?>/"><?=system_showText(LANG_LABEL_BACK_TO_SEARCH);?></a>
                                    </li>
                                    
                                    <li>
                                        <a href="<?=DEFAULT_URL?>/<?=MEMBERS_ALIAS?>/help.php"><?=system_showText(LANG_BUTTON_HELP)?></a>
                                    </li>
                                   
                                    <li>
                                        <a href="<?=DEFAULT_URL?>/<?=MEMBERS_ALIAS?>/faq.php"><?=system_showText(LANG_MENU_FAQ);?></a>
                                    </li>
                                   
                                    <li>
                                        <a href="<?=((SSL_ENABLED == "on" && FORCE_MEMBERS_SSL == "on") ? SECURE_URL : NON_SECURE_URL)?>/<?=MEMBERS_ALIAS?>/logout.php"><?=system_showText(LANG_BUTTON_LOGOUT)?></a>
                                    </li>
                                    
                                </ul>
                                
                            </li>
                            
                        <? } ?>
                            
                    </ul>
                    
                </div>
                
                <? } ?>

            </div>
                
        </div>
            
    </div>
    
    <div class="image-bg">
        <?=front_getBackground($customimage);?>
    </div>
    
    <div class="well container members">

        <div class="container-fluid">