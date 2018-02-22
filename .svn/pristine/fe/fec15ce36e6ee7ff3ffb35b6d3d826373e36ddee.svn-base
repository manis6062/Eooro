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
    
    # ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
    //Get percentage
    setting_get("appbuilder_percentage", $appbuilder_percentage);
    if (!$appbuilder_percentage) {
        $appbuilder_percentage = 0;
    }

    include(INCLUDES_DIR."/code/appbuilder_step2.php");
    
	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/header.php");
 

?>
    <script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/jquery/auto_upload/js/file_uploads.js"></script>

    <div class="center-content">

        <div id="top-content">
            
            <div id="header-content" class="main-heading">
                <h1><?=system_showText(LANG_SITEMGR_APPBUILDER);?><small class="float-right"><a href="<?=(DEFAULT_URL."/".SITEMGR_ALIAS)?>"><?=system_showText(LANG_SITEMGR_BACKSITEMGR);?></a></small></h1>
                <h2><?=system_showText(LANG_SITEMGR_APPBUILDER_ABOUT);?></h2>
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

					<h4><?=system_showText(LANG_SITEMGR_APPBUILDER_ABOUT_TITLE);?></h4>
                    <p class="subheading"><?=system_showText(LANG_SITEMGR_APPBUILDER_ABOUT_TITLE_TIP);?></p>
    				<p><?=system_showText(LANG_SITEMGR_CONFIGURE_APP_STEP_2_MESSAGE)?></p>
	                
	                <p id="returnMessage" style="display:none;"></p>
	                
	                <? if ($errorMessage) { ?>
	                    <p id="errorMessage" class="errorMessage"><?=$errorMessage;?></p>
	                <? } elseif ($success) { ?>
	                    <p id="successMessage" class="successMessage"><?=ucfirst(system_showText(LANG_SITEMGR_SETTINGSSUCCESSUPDATED));?></p>
	                <? } ?>

					<form id="step2" name="step2" method="post" enctype="multipart/form-data" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>">
	                    
	                    <input type="hidden" name="next" id="next" value="no" />

	                    <div class="form-left">

					        <h4><?=system_showText(LANG_SITEMGR_APPBUILDER_ABOUT_PREVIEW);?></h4> 
					        <p><?=system_showText(LANG_SITEMGR_APPBUILDER_ABOUT_TIP);?></p>

						    <div id="device-apple" class="cover-preview-image device-apple">
                                
						        <div class="about-preview-image">
						        	<span class="lang-aboutus"><?=system_showText(LANG_MENU_ABOUT)?></span>
							        <div class="prev-logo">
				                        <? if (file_exists(EDIRECTORY_ROOT."/".IMAGE_APPBUILDER_PATH."/appbuilder_logo_{$appbuilder_logo_id}.{$appbuilder_logo_extension}")) { ?>
											<img src="<?=DEFAULT_URL."/".IMAGE_APPBUILDER_PATH."/appbuilder_logo_{$appbuilder_logo_id}.{$appbuilder_logo_extension}"?>" />
										<? } else { ?>
											<div class="your-logo"><?=system_showText(LANG_SITEMGR_APPBUILDER_ABOUT_LOGO)?></div>
										<? } ?>
			                        </div>
			                        <span class="customtext <?=($about ? "" : "wireframe")?>">
                                        <? if ($about) { ?>
                                        <?=nl2br($about);?>
                                        <? } else { ?>
                                        <div class="your-abouttext"><?=system_showText(LANG_MENU_ABOUT)?></div>
                                        <? } ?>
                                    </span>
									<span class="lang-email"><?=system_showText(LANG_LABEL_EMAIL_ADDRESS)?></span>
		                        	<span class="lang-phone"><?=system_showText(LANG_LABEL_PHONE_NUMBER)?></span>
		                        	<span class="lang-website"><?=system_showText(LANG_LABEL_WEBSITE)?></span>
		                        </div>
                                
						        <div class="change-device">
						            <a class="icon-device-apple active" href="javascript:void(0);"></a>
						            <a class="icon-device-android" href="javascript:void(0);"></a>
						        </div>
                                
						    </div>
                            
						    <div id="device-android" class="cover-preview-image device-android" style="display:none;">
                                
						        <div class="about-preview-image">
						        	<span class="lang-aboutus"><?=system_showText(LANG_MENU_ABOUT)?></span>
						        	<div class="prev-logo">
				                        <? if (file_exists(EDIRECTORY_ROOT."/".IMAGE_APPBUILDER_PATH."/appbuilder_logo_{$appbuilder_logo_id}.{$appbuilder_logo_extension}")) { ?>
											<img src="<?=DEFAULT_URL."/".IMAGE_APPBUILDER_PATH."/appbuilder_logo_{$appbuilder_logo_id}.{$appbuilder_logo_extension}"?>" />
										<? } else { ?>
											<div class="your-logo"><?=system_showText(LANG_SITEMGR_APPBUILDER_ABOUT_LOGO)?></div>
										<? } ?>  
		                        	</div>
		                        	<span class="customtext <?=($about ? "" : "wireframe")?>">
                                        <? if ($about) { ?>
                                        <?=nl2br($about);?>
                                        <? } else { ?>
                                        <div class="your-abouttext"><?=system_showText(LANG_MENU_ABOUT)?></div>
                                        <? } ?>
                                    </span>
		                        	<span class="lang-email"><?=system_showText(LANG_LABEL_EMAIL_ADDRESS)?></span>
		                        	<span class="lang-phone"><?=system_showText(LANG_LABEL_PHONE_NUMBER)?></span>
		                        	<span class="lang-website"><?=system_showText(LANG_LABEL_WEBSITE)?></span>
		                        </div>
                                
						        <div class="change-device">
						            <a class="icon-device-apple" href="javascript:void(0);"></a>
						            <a class="icon-device-android active" href="javascript:void(0);"></a>
						        </div>
                                
						    </div>
                            
					    </div>
                        
						<div class="form-right">
	                                
					        <h4><?=system_showText(LANG_SITEMGR_APPBUILDER_ABOUT_CONFIG);?></h4>
					        <p><?=system_showText(LANG_SITEMGR_APPBUILDER_ABOUT_CONFIG_TIP);?></p>

	                        <div>
								<label for="logo"><?=system_showText(LANG_SITEMGR_LOGO_IMAGE)?> (680 x 200 pixels)</label>
								
								<div class="nicefile-all">
	                                <input type="file" name="image" id="image" onchange="sendFile(this);" tabindex="2" />
	                                <div id="loading_image" class="loading-image"></div>
	                                <input type="text" class="nicefile-input" id="label_file"/>
	                                <div class="nicefile-button"><?=system_showText(LANG_SITEMGR_CHOOSE_FILE);?></div>
	                            </div>
							</div>

							<div>
								<p id="alert_img" class="alert" style="display:none;"><?=system_showText(LANG_SITEMGR_APPBUILDER_ABOUT_CONFIG_TIP2);?></p>
								<p class="tip"><?=system_showText(LANG_SITEMGR_CONFIGURE_APP_STEP_2_TIP)?></p>
							</div>
	                        
							<div>
								<label for="textarea"><?=system_showText(LANG_SITEMGR_ABOUT_TEXT)?></label>
								<textarea cols="40" rows="8" name="about" id="textarea" onkeyup="updateAbout();" tabindex="3"><?=$about;?></textarea>
							</div>

							<div>
								<label for="email"><?=system_showText(LANG_LABEL_EMAIL_ADDRESS)?></label>
								<input type="email" name="email" id="email" value="<?=$email;?>" tabindex="4" />
							</div>

							<div>
								<label for="phone"><?=system_showText(LANG_LABEL_PHONE_NUMBER)?></label>
								<input type="phone" name="phone" id="phone" value="<?=$phone;?>" tabindex="5" />
							</div>

							<div>
								<label for="website"><?=system_showText(LANG_LABEL_WEBSITE)?></label>
								<input type="url" name="website" id="website" value="<?=$website;?>" tabindex="6" />
							</div>
						
						</div>
	                    
						<br class="clearfix"><br />
	                    
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

   		$(".icon-device-apple").click(function(){
			$("#device-android").css("display", "none");
			$("#device-apple").css("display", "");
            $("#tab_selected").attr("value", "apple");
		});
		$(".icon-device-android").click(function(){
			$("#device-android").css("display", "");
			$("#device-apple").css("display", "none");
            $("#tab_selected").attr("value", "android");
		});
        
        function nl2br(str, is_xhtml) {
            var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br ' + '/>' : '<br>'; // Adjust comment to avoid issue on phpjs.org display

            return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1' + breakTag + '$2');
        }        
        
        function updateAbout() {
            $(".customtext").html(nl2br($("#textarea").val()));
            $(".customtext").removeClass("wireframe");
        }
        
        function JS_submit(next) {
            if (next) {
                $("#next").attr("value", "yes");
            }
            document.step2.submit();
        }
        
        function sendFile(obj) {

        	var fileName = $(obj).val();
            fileName = fileName.replace("C:\\fakepath\\", "");
            $('#label_file').val(fileName);
            
            <? if (!DEMO_LIVE_MODE) { ?>
            
            $("#step2").vPB({
                url: '<?=DEFAULT_URL."/includes/code/image_autoupload.php?filename=appbuilder_logo"?>',
                beforeSubmit: function() 
                {
                    $("#loading_image").html('<img src="<?=DEFAULT_URL?>/images/img_loading_gallery.gif" alt="<?=system_showText(LANG_SITEMGR_WAITLOADING);?>" title="<?=system_showText(LANG_SITEMGR_WAITLOADING);?>"/>');
                },
                success: function(response) 
                {
                    strReturn = response.split("||");
                    $('#loading_image').hide().fadeOut('slow');

                    if (strReturn[0] == "ok" || strReturn[0] == "ok_alert") {
                        $("#returnMessage").hide();
                        $(".prev-logo").hide().fadeIn("slow").html(strReturn[1]);
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
                        scrollPage('#returnMessage');
                    }
                }
            }).submit();
            
            <? } else { ?>
				livemodeMessage('<?=system_showText(LANG_SITEMGR_DEMO_MESSAGE);?>');
			<? } ?>
        }
        
    </script>