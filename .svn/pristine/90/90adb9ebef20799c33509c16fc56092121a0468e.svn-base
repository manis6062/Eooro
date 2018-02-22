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
	# * FILE: /sitemgr/mobile/appbuilder/step5.php
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
    
    # ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
    extract($_POST);
    extract($_GET);
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        system_appBuilderPercentage(5);
        header("Location: ".DEFAULT_URL."/".SITEMGR_ALIAS."/mobile/appbuilder/".($next == "yes" ? "previewapp.php" : "step5.php?success=1"));
        exit;
        
    }
    
    //Get percentage
    setting_get("appbuilder_percentage", $appbuilder_percentage);
    if (!$appbuilder_percentage) {
        $appbuilder_percentage = 0;
    }
    
    setting_get("appbuilder_splash_id", $appbuilder_splash_id);
    setting_get("appbuilder_splash_extension", $appbuilder_splash_extension);
    setting_get("appbuilder_build_done", $appbuilder_build_done);
    
    extract($_POST);
    extract($_GET);
    
	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/header.php");
     

?>
    <script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/jquery/auto_upload/js/file_uploads.js"></script>

    <div  class="center-content">

        <div id="top-content">
            
            <div id="header-content" class="main-heading">
                <h1><?=system_showText(LANG_SITEMGR_APPBUILDER);?><small class="float-right"><a href="<?=(DEFAULT_URL."/".SITEMGR_ALIAS)?>"><?=system_showText(LANG_SITEMGR_BACKSITEMGR);?></a></small></h1>
                <h2><?=system_showText(LANG_SITEMGR_CHOOSE_LOADING);?></h2>
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
                    
                    <h4><?=system_showText(LANG_SITEMGR_CONFIGURE_APP_STEP_5)?></h4>
                    <p class="subheading"><?=system_showText(LANG_SITEMGR_CONFIGURE_APP_STEP_4_MSG)?></p>
                    <p><?=system_showText(LANG_SITEMGR_CONFIGURE_APP_STEP_5_MESSAGE)?></p>
                    <? if ($appbuilder_build_done == "yes") { ?>
                    <p class="alert-tip"><?=system_showText(LANG_SITEMGR_CONFIGURE_APP_STEP_5_TIP)?></p>
                    <? } ?>

                    <p id="returnMessage" style="display:none;"></p>

                    <? if ($success) { ?>
                        <p id="successMessage" class="successMessage"><?=ucfirst(system_showText(LANG_SITEMGR_SETTINGSSUCCESSUPDATED));?></p>
                    <? } ?>

                    <form id="step5" name="step5" method="post" enctype="multipart/form-data" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>">

                        <input type="hidden" name="next" id="next" value="no" />

                        <div class="form-left">
                            <h4><?=system_showText(LANG_SITEMGR_PAGE_PREVIEW)?></h4>
                            <p><?=system_showText(LANG_SITEMGR_PAGE_PREVIEW_TIP)?></p>
                            <div class="cover-preview-image device-apple-large">
                                <div id="preview-image" <?=((file_exists(EDIRECTORY_ROOT."/".IMAGE_APPBUILDER_PATH."/appbuilder_splash_{$appbuilder_splash_id}.".$appbuilder_splash_extension)) ? "style=\"background-image: url(".DEFAULT_URL."/".IMAGE_APPBUILDER_PATH."/appbuilder_splash_{$appbuilder_splash_id}.".$appbuilder_splash_extension.")\"" : "" )?>></div>
                            </div>
                        </div>

                        <div class="form-right">
                            
                            <h4><?=system_showText(LANG_SITEMGR_BUILDER_CONFIG);?></h4>
                            <p><?=system_showText(LANG_SITEMGR_LOADING_CONFIG_TIP);?></p>
                            <label><?=system_showText(LANG_SITEMGR_CHOOSE_LOADING_PAGE);?> (2048 x 2048 pixels)</label>
                            <div class="nicefile-all">
                                
                                <input type="file" name="image" id="image" onchange="sendFile(this);" />
                                <div id="splash_image" class="loading-image"></div>
                                <input type="text" class="nicefile-input" id="label_file"/>
                                <div class="nicefile-button"><?=system_showText(LANG_SITEMGR_CHOOSE_FILE);?></div>
                            </div>
                            
                            <div>
								<p id="alert_img" class="alert" style="display:none;"><?=system_showText(LANG_SITEMGR_APPBUILDER_ABOUT_CONFIG_TIP2);?></p>
                                <p class="tip"><?=system_showText(LANG_SITEMGR_CONFIGURE_APP_STEP_5_TIP2)?></p>
							</div>
                            
                        </div>

                        <div class="action">
                            <button type="button" class="btn btn-success" onclick="<?=DEMO_LIVE_MODE ? "livemodeMessage('".system_showText(LANG_SITEMGR_THEME_DEMO_MESSAGE2)."');" : "JS_submit(true);"?>"><?=system_showText(LANG_SITEMGR_SAVENEXT)?></button>
                        </div>

                    </form>
                    
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

    <script type="text/javascript">
        
        function JS_submit(next) {
            if (next) {
                $("#next").attr("value", "yes");
            }
            document.step5.submit();
        }
        
        function sendFile(obj) {
            
            var fileName = $(obj).val();
            fileName = fileName.replace("C:\\fakepath\\", "");
            $('#label_file').val(fileName);

            <? if (!DEMO_LIVE_MODE) { ?>
            
            $("#step5").vPB({
                url: '<?=DEFAULT_URL."/includes/code/image_autoupload.php?filename=appbuilder_splash&fullpath=1"?>',
                beforeSubmit: function() 
                {
                    $("#splash_image").html('<img src="<?=DEFAULT_URL?>/images/img_loading_gallery.gif" alt="<?=system_showText(LANG_SITEMGR_WAITLOADING);?>" title="<?=system_showText(LANG_SITEMGR_WAITLOADING);?>"/>');
                },
                success: function(response) 
                {
                    strReturn = response.split("||");
                    $('#splash_image').hide().fadeOut('slow');

                    if (strReturn[0] == "ok" || strReturn[0] == "ok_alert") {
                        $("#returnMessage").hide();
                        $("#preview-image").css("background-image", 'url('+strReturn[1]+')');
                        if (strReturn[0] == "ok_alert") {
                            $("#alert_img").show();
                        } else {
                            $("#alert_img").hide();
                        }
                    } else {
                        $("#returnMessage").removeClass("successMessage");
                        $("#returnMessage").removeClass("errorMessage");
                        $("#returnMessage").addClass("errorMessage");
                        $("#returnMessage").html(strReturn[1]);
                        $("#returnMessage").show();
                        $("#errorMessage").hide();
                        $("#successMessage").hide();
                    }
                }
            }).submit();
            
            <? } else { ?>
				livemodeMessage('<?=system_showText(LANG_SITEMGR_DEMO_MESSAGE);?>');
			<? } ?>
        }
        
    </script>