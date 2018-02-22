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
	# * FILE: /sitemgr/mobile/appbuilder/previewapp.php
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
    
    setting_get("appbuilder_previewpassword", $appbuilder_previewpassword);
    
    if (!$appbuilder_previewpassword) {
        $appbuilder_previewpassword = system_generatePassword(true);
        if (!setting_set("appbuilder_previewpassword", $appbuilder_previewpassword)) {
            setting_new("appbuilder_previewpassword", $appbuilder_previewpassword);
        }
    }
       
    
	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/header.php");

?>

    <div class="center-content">

        <div id="top-content">
            
            <div id="header-content" class="main-heading">
                <h1><?=system_showText(LANG_SITEMGR_APPBUILDER);?><small class="float-right"><a href="<?=(DEFAULT_URL."/".SITEMGR_ALIAS)?>"><?=system_showText(LANG_SITEMGR_BACKSITEMGR);?></a></small></h1>
                <h2><?=system_showText(LANG_SITEMGR_PREVIEW_USING_OUR_APP);?></h2>
            </div>
            
        </div>

        <div id="content-content">
            
            <?
            require(EDIRECTORY_ROOT."/".SITEMGR_ALIAS."/registration.php");
            require(EDIRECTORY_ROOT."/includes/code/checkregistration.php");
            require(EDIRECTORY_ROOT."/frontend/checkregbin.php");
            ?>
           
            <div class="appbuilder">

            	<? /*  Navbar  */
                    include("navbar.php");
                ?>
                
 				<article>
                    
					<h4><?=system_showText(LANG_SITEMGR_DOWNLOAD_TO_PREVIEW_THE_APP)?></h4>
					<p><?=system_showText(LANG_SITEMGR_PREVIEW_TIP)?></p>
<!--					<p class="alert-tip"><?=system_showText(LANG_SITEMGR_CONFIGURE_APP_PREVIEW_TIP)?></p>-->
					
					<div class="previewscreen">
						<img src="<?=(DEFAULT_URL."/".SITEMGR_ALIAS."/images/appbuilder/iPhone-5.png")?>" alt="iPhone5" />

						<div class="right">
							<div class="logo-edir">
								<i class="iab-edirectory"></i>
								<span>edirectory App Previewer</span>
							</div>
							<a href="http://appbuilder.edirectory.com/previewapp.php?android" target="_blank" class="btn btn-default"><?=system_showText(LANG_SITEMGR_DOWNLOAD_ANDROID)?></a>
							<br />
							<a href="http://appbuilder.edirectory.com/previewapp.php?ios" target="_blank" class="btn btn-default"><?=system_showText(LANG_SITEMGR_DOWNLOAD_IOS)?></a>
						</div>					
					</div>

					<div class="well-border">
						<h4><?=system_showText(LANG_SITEMGR_PREVIEW_DETAILS)?></h4>
						<p><?=system_showText(LANG_SITEMGR_PREVIEW_DETAILS_MESSAGE)?></p>
						<table>
							<tbody>
								<tr>
									<th><?=system_showText(LANG_SITEMGR_DOMAIN_SING)?></th>
									<td><?=str_replace("http://", "", DEFAULT_URL);?></td>
								</tr>
								<tr>
									<th>PIN</th>
									<td><?=$appbuilder_previewpassword;?></td>
								</tr>
							</tbody>
						</table>
					</div>
                    
                    <div class="action">
                        <button type="button" class="btn btn-success" onclick="window.location.href = '<?=DEFAULT_URL."/".SITEMGR_ALIAS."/mobile/appbuilder/finalstep.php"?>'"><?=system_showText(LANG_SITEMGR_NEXT)?></button>
                    </div>
                    
				 </article>
                
			</div>
            
        </div>
        
    </div>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>