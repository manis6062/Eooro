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
	# * FILE: /sitemgr/mobile/appbuilder/step1.php
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
    $appBuilder = true;
	include(INCLUDES_DIR."/code/navigation.php");
    
	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/header.php");
     
	
?>
    	
    <div class="center-content">

        <div id="top-content">
            
            <div id="header-content" class="main-heading">
                <h1><?=system_showText(LANG_SITEMGR_APPBUILDER);?><small class="float-right"><a href="<?=(DEFAULT_URL."/".SITEMGR_ALIAS)?>"><?=system_showText(LANG_SITEMGR_BACKSITEMGR);?></a></small></h1>
                <h2><?=system_showText(LANG_SITEMGR_CONFIGURE_YOUR_APP);?></h2>
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
    				<h4><?=system_showText(LANG_SITEMGR_CONFIGURE_APP_STEP_1);?></h4>
                    <p class="subheading"><?=system_showText(LANG_SITEMGR_CONFIGURE_APP_STEP_1_SUB);?></p>
    				<p><?=system_showText(LANG_SITEMGR_CONFIGURE_APP_STEP_1_MESSAGE)?></p>
    				<p><?=system_showText(LANG_SITEMGR_CONFIGURE_APP_STEP_1_MESSAGE_CONT)?> <?=system_showText(LANG_SITEMGR_CONFIGURE_UPDATE_TIP)?></p>
                    <p class="alert-tip"><?=system_showText(LANG_SITEMGR_CONFIGURE_APP_STEP_1_TIP2)?></p>
                    <? if ($errorMessage) { ?>
                        <p class="errorMessage" id="auxErrorMessage2"><?=$errorMessage?></p>
                    <? } elseif ($successMessage == 1) { ?>
                        <p class="successMessage" id="successMessage"><?=system_showText(LANG_SITEMGR_MENU_SUCCESS);?></p>
                    <? } ?>
                    <p class="errorMessage" id="auxErrorMessage" style="display:none"></p>
                        
                    <input type="hidden" name="aux_litext" id="aux_litext" value='<?=$aux_LI_code?>' />
                    
    				<form id="form_menu" name="form_menu" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">
                        
                        <input type="hidden" name="domain_id" value="<?=SELECTED_DOMAIN_ID?>">
                        <input type="hidden" name="order_options" id="order_options" value="" />
                        <input type="hidden" name="aux_count_li" id="aux_count_li" value="<?=count($arrayOptions)?>" />
                        <input type="hidden" name="SaveByAjax" value="true" id="SaveByAjax" value=""/>
                        <input type="hidden" name="limitItems" id="limitItems" value="<?=$limitItems;?>"/>
                        <input type="hidden" name="limitPreview" id="limitPreview" value="<?=$limitPreview;?>"/>
                        <input type="hidden" name="navigation_area" value="tabbar" />
                        <input type="hidden" name="tab_selected" id="tab_selected" value="apple" />
    					                    
                        <? include(INCLUDES_DIR."/forms/form_navigation_app.php"); ?>

                        <div class="action">
    						<button type="button" class="btn btn-success" onclick="<?=DEMO_LIVE_MODE ? "livemodeMessage('".system_showText(LANG_SITEMGR_THEME_DEMO_MESSAGE2)."');" : "NextStep(true);"?>"><?=system_showText(LANG_SITEMGR_SAVENEXT);?></button>
    					</div>

    				</form>
                    
                    <form id="reset_navigation" name="reset_navigation" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">
                        <input type="hidden" name="resetNavigation" value="reset" />
                        <input type="hidden" name="area" value="tabbar" />
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

    <script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/navigation.js"></script>

	<script type="text/javascript">
        
        function JS_submit() {
            serialize();
            document.form_menu.submit();
        }
        
        function ResetNavigation() {
            dialogBox('confirm', '<?=system_showText(LANG_SITEMGR_NAVIGATION_CONFIRM_RESET);?>', '', 'reset_navigation', '200', '<?=system_showText(LANG_SITEMGR_OK);?>', '<?=system_showText(LANG_SITEMGR_CANCEL);?>');
        }
        
        function editMenu(id, show) {
            if (show) {
                $("#preview_item"+id).css("display", "none");
                $("#edit_item"+id).css("display", "");
            } else {
                $("#preview_item"+id).css("display", "");
                $("#edit_item"+id).css("display", "none");
                $("#navigation_text_preview_"+id).html($("#navigation_text_cancel_"+id).val());
                $("#navigation_text_"+id).attr("value", $("#navigation_text_cancel_"+id).val());
                updatePreview($("#navigation_text_cancel_"+id));
            }
        }
        
        function updateItem(id, obj) {
            $("#navigation_text_preview_"+id).html(obj.value);
        }
        
        function NextStep(redirect, id) {
            
            <? if (DEMO_LIVE_MODE) { ?>
                    if (redirect) {
                        window.location.href = "<?=DEFAULT_URL."/".SITEMGR_ALIAS."/mobile/appbuilder/step2.php"?>";
                    } else {
                        livemodeMessage('<?=system_showText(LANG_SITEMGR_THEME_DEMO_MESSAGE2);?>');
                    }               
            <? } else { ?>
                $("#SaveByAjax").val("true");
                $("#order_options").attr("value", $("#sortable").sortable("toArray"));

                $.post("<?=$_SERVER["PHP_SELF"]?>", $("#form_menu").serialize(), function(data){
                    if (data == "ok") {
                        if (redirect) {
                            window.location.href = "<?=DEFAULT_URL."/".SITEMGR_ALIAS."/mobile/appbuilder/step2.php"?>";
                        } else {
                            $("#preview_item"+id).css("display", "");
                            $("#edit_item"+id).css("display", "none");
                            $("#auxErrorMessage").css("display", "none");
                            $("#successMessage").css("display", "none");
                        }
                    } else {
                        $("#auxErrorMessage").html(data);
                        $("#successMessage").css("display", "none");
                        $("#auxErrorMessage2").css("display", "none");
                        $("#auxErrorMessage").css("display", "");
                        $('html, body').animate({
                            scrollTop: $('#auxErrorMessage').offset().top
                        }, 500);
                    }
                });
            <? } ?>
        }
        
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
        
		$(function() {
            disableDropdown();
            $("#sortable").sortable({ 
                cancel: " input, select, option, #sortable-title, .alert-tip",
                stop: function() { 
                    updatePreview(); 
                }
            });
        });
        
	</script>