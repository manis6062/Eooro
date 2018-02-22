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
	# * FILE: /sitemgr/mobile/appbuilder/index.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../../conf/loadconfig.inc.php");
    
	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
    permission_hasSMPerm();
    
    extract($_POST);
    extract($_GET);
    
    
	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/header.php");
     

?>

    <div class="center-content">

        <div id="top-content">
            
            <div id="header-content" class="main-heading">
                <h1><?=system_showText(LANG_SITEMGR_APPBUILDER);?> <small class="float-right"><a href="<?=(DEFAULT_URL."/".SITEMGR_ALIAS)?>"><?=system_showText(LANG_SITEMGR_BACKSITEMGR);?></a></small></h1>
            </div>
            
        </div>

        <div id="content-content">
            
            <div class="default-margin appbuilder">
                
                <?
                require(EDIRECTORY_ROOT."/".SITEMGR_ALIAS."/registration.php");
                require(EDIRECTORY_ROOT."/includes/code/checkregistration.php");
                require(EDIRECTORY_ROOT."/frontend/checkregbin.php");
                ?>
                
				<div class="showsteps">
					<h4><?=system_showText(LANG_SITEMGR_THE_PROCESS)?></h4>
					<ol>
						<li><span>1</span><?=system_showText(LANG_SITEMGR_SELECT_CONTENT)?></li>
						<li><span>2</span><i class="arrowsteps"></i><?=system_showText(LANG_SITEMGR_CONFIGURE_CONTENT_COLORS_ICONS_IMAGES)?></li>
						<li><span>3</span><i class="arrowsteps"></i><?=system_showText(LANG_SITEMGR_BUILD_AND_SUBMIT)?></li>
					</ol>
				</div>

				<div class="illustration">
					<h3><?=system_showText(LANG_SITEMGR_MESSAGE_USERS)?></h3>
					<img src="<?=(DEFAULT_URL."/".SITEMGR_ALIAS."/images/appbuilder/process-appbuilder.png")?>" alt="<?=system_showText(LANG_SITEMGR_THE_PROCESS)?>" />
					<span class="yourwebsite"><?=system_showText(LANG_SITEMGR_YOUR_WEBSITE)?></span>
				</div>

				<div class="center-action">
					<a class="btn btn-success" href="<?=(DEFAULT_URL."/".SITEMGR_ALIAS."/mobile/appbuilder/step1.php")?>"><?=system_showText(LANG_SITEMGR_START_BUILDER)?></a>
				</div>
                
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