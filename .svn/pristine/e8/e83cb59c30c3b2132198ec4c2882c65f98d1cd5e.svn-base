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
	# * FILE: /sitemgr/prefs/theme.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");
        $devem = DEMO_DEV_MODE;
        $livem = DEMO_LIVE_MODE;
        $demmm = DEMO_MODE;
        
	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	extract($_POST);
	extract($_GET);

	$filethemeConfigPath    = EDIRECTORY_ROOT.'/custom/domain_'.$_POST["domain_id"].'/theme/theme.inc.php';
	$folderthemesPath       = EDIRECTORY_ROOT.'/theme';

	// Default CSS class for message
	$message_style = "successMessage";

	if (($_SERVER['REQUEST_METHOD'] == "POST") && (!DEMO_LIVE_MODE)) {
        
        if ($select_theme) {
			$status = 'success';

			$src = EDIRECTORY_ROOT."/theme/$select_theme";
			$dst = EDIRECTORY_ROOT."/custom/domain_".SELECTED_DOMAIN_ID."/theme/".$select_theme;
			if (!is_dir($dst)){
				$domain = new Domain(SELECTED_DOMAIN_ID);
				$domain->copyThemeToDomain($src, $dst);
			} 

			if (!$filethemeConfig = fopen($filethemeConfigPath, 'w+')) {
				$status = 'error';

			} else {
				                
                if (CACHE_PARTIAL_FEATURE == "on") {
                    cachepartial_removecache("event_calendar");
                }

                if (CACHE_FULL_FEATURE == "on") {
                    cachefull_forceExpiration();
                }

				$buffer  = "<?php".PHP_EOL."\$edir_theme=\"$select_theme\";".PHP_EOL;

				if (!fwrite($filethemeConfig, $buffer, strlen($buffer))) {
					$status = 'error';
				}

                if ($select_theme == EDIR_THEME) {
                    $auxCurValues = unserialize(EDIR_CURR_SCHEME_VALUES);

                    $array["colorBackground"] = $auxCurValues[$scheme]["colorBackground"];
                    $array["colorHeader"] = $auxCurValues[$scheme]["colorHeader"];
                    $array["colorText"] = $auxCurValues[$scheme]["colorText"];
                    $array["colorLink"] = $auxCurValues[$scheme]["colorLink"];
                    $array["colorNavbar"] = $auxCurValues[$scheme]["colorNavbar"];
                    $array["colorNavbarLink"] = $auxCurValues[$scheme]["colorNavbarLink"];
                    $array["colorNavbarLinkActive"] = $auxCurValues[$scheme]["colorNavbarLinkActive"];
                    $array["colorFooter"] = $auxCurValues[$scheme]["colorFooter"];
                    $array["colorFooterText"] = $auxCurValues[$scheme]["colorFooterText"];
                    $array["colorFooterLink"] = $auxCurValues[$scheme]["colorFooterLink"];
                    $array["color1"] = $auxCurValues[$scheme]["color1"];
                    $array["color2"] = $auxCurValues[$scheme]["color2"];
                    $array["color3"] = $auxCurValues[$scheme]["color3"];
                    $array["color4"] = $auxCurValues[$scheme]["color4"];
                    $array["color5"] = $auxCurValues[$scheme]["color5"];
                    $array["color6"] = $auxCurValues[$scheme]["color6"];
                    $array["color7"] = $auxCurValues[$scheme]["color7"];
                    $array["fontOption"] = $auxCurValues[$scheme]["fontOption"];

                    colorscheme_themeSchemeFile($array, $scheme, $select_theme, $scheme, $status);
                } else {
                   @include_once(EDIRECTORY_ROOT.'/custom/domain_'.SELECTED_DOMAIN_ID.'/theme/'.$select_theme.'_scheme.inc.php'); 
                   $scheme = $edir_scheme;
                }

                setting_get("scheme_".$scheme."_customized", $aux_value);

                if (!setting_set("scheme_custom", $aux_value)) {
                    if (!setting_new("scheme_custom", $aux_value)) {
                        $error = true;
                    }
                }

                if ($aux_value) {
                    if (!setting_set("scheme_updatefile", "on")) {
                        if (!setting_new("scheme_updatefile", "on")) {
                            $error = true;
                        }
                    }
                }
			}
            
            setting_get("theme_create_categories", $theme_create_categories);
            
            if ($theme_create_categories != "done" && $hiddenValue == "yes") {
                $ajaxCategory = "&loadCateg=1";
            } else {
                $ajaxCategory = "";
            }

		} else {
			$status = 'error';
		}

		header("Location: ".DEFAULT_URL."/".SITEMGR_ALIAS."/prefs/theme.php?status=$status$ajaxCategory");
		exit;
	}

	//increases frequently actions
	if (!isset($status)) system_setFreqActions('prefs_theme','prefstheme');

	# ----------------------------------------------------------------------------------------------------
	# FORMS DEFINES
	# ----------------------------------------------------------------------------------------------------
	unset($folders);
	$folderthemes = opendir($folderthemesPath);
	$folders = array();
	while ($folder = readdir($folderthemes)) {
		if ($folder != 'sample' && $folder != '.' && $folder != '..') {
			$folders[] = $folder;
		}
	}
	unset($valuesArray);
	unset($namesArray);

	$_valuesArray = explode(',', EDIR_THEMES);
	$_namesArray  = explode(',', EDIR_THEMENAMES);
	for ($i=0;$i<count($_valuesArray);$i++) {
		if (in_array($_valuesArray[$i], $folders)) {
			if ($_namesArray[$i]) {
				$valuesArray[] = $_valuesArray[$i];
				$namesArray[]  = $_namesArray[$i];
			}
		}
	}

	$edir_theme = EDIR_THEME == '' ? 'edirectory' : EDIR_THEME;
    
    //Current image height
    setting_get("background_image_height", $background_image_height);
    //Current image id
    setting_get("diningguide_background_image_id", $curr_image_id);
    
    setting_get("theme_create_categories", $theme_create_categories);
    if ($theme_create_categories != "done") {
        $onclickJs = "JS_submit(false, true, this);";
    } else {
        $onclickJs = "JS_submit(false, false, this);";
    }

	$selectthemes = html_selectBox('select_theme', $namesArray, $valuesArray, $edir_theme, "style=\"width:220px;\" onchange=\"$onclickJs\"", '', '');

	//Messages
	if ($status == 'success') {
		$message = system_showText(LANG_SITEMGR_SETTINGS_THEMES_THEMEWASCHANGED);
		$message_style = 'successMessage';
	} else if ($status == 'failed') {
		$message = system_showText(LANG_SITEMGR_MSGERROR_SYSTEMERROR);
		$message_style = 'errorMessage';
	}

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/header.php");

	# ----------------------------------------------------------------------------------------------------
	# NAVBAR
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/navbar.php");

?>

    <script language="javascript" type="text/javascript">

        function JS_submit(scheme, checkTheme, obj) {
            if (scheme) {
                $("#scheme").attr("value", scheme);
            }
            if (checkTheme && obj.value == "diningguide") {
                dialogBox('confirm_theme','<?=system_showText(LANG_SITEMGR_SETTINGS_THEME_TIP_2);?>','yes','theme','245','<?=system_showText(LANG_SITEMGR_YES);?>','<?=system_showText(LANG_SITEMGR_NO);?>');
            } else {
                $("#theme").submit();
            }
        }
        
        function showTabs(tab) {
            $("#returnMessage").hide();
            var activeTab = "#tab_" + tab;
            var activeTabContent = "#content_" + tab;

            $("ul.tabs li").removeClass("tabActived"); //Remove any "tabActived" class
            $(activeTab).addClass("tabActived"); //Add "tabActived" class to selected tab
            $(".tab-content").hide(); //Hide all tab content
            $(activeTabContent).fadeIn(); //Fade in the active content
            
            if (tab == "map") {
                initialize();
            }
        }
        
        <? if ($loadCateg && THEME_CATEGORY_IMAGE) { ?>
            $(document).ready(function(){
                $.get("<?=DEFAULT_URL."/".SITEMGR_ALIAS."/prefs/theme_categories.php"?>", {
                    domain_id: <?=SELECTED_DOMAIN_ID;?>
                }, function () {});
            });
        <? } ?>

    </script>

	<div id="main-right">

		<div id="top-content">
			<div id="header-content">
				<h1><?=system_showText(LANG_SITEMGR_SETTINGS_SITEMGRSETTINGS)?> - <?=system_showText(LANG_SITEMGR_MENU_THEMES)?></h1>
			</div>
		</div>

		<div id="content-content">
			<div class="default-margin">

				<? require(EDIRECTORY_ROOT."/".SITEMGR_ALIAS."/registration.php"); ?>
				<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
				<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>		

				<br /><br />
                <? include(INCLUDES_DIR."/forms/form_themesettings.php"); ?>
                <? if(EDIR_THEME == 'review') { ?>
				<div style="margin-left:80px;">              
                	<a id="uploadimage" href = "wallpaper.php" class="addImageForm input-button-form iframe fancy_window_imgAdd"> Change Wallpaper </a>
                </div>	
               <? } ?>

<? /*
				//Change Wallpaper Script with crop
				  
				  <a id="uploadimage" class="addImageForm input-button-form iframe fancy_window_imgAdd" href="#">Change Wallpaper</a>

						<script>
							$("a#uploadimage").live("click",function(ev){
							    ev.preventDefault();
							    $.fancybox({
							        href: "<?=NON_SECURE_URL?>/sitemgr/uploadimage_wall.php?item_type=wall",
							        type: "iframe",
							        height: 700,
							        width: 2000,
							        autoSize: false
							    })
							});
						</script>	

*/ ?>
			</div>
		</div>

		<div id="bottom-content"></div>

	</div>

	<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");
	?>
