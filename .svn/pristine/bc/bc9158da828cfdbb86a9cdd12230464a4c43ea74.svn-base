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
	# * FILE: /sitemgr/prefs/colorscheme.php
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

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	extract($_POST);
	extract($_GET);
	
	unset($array);

	// Default CSS class for message
	$message_style = "successMessage";
	
	if ($_SERVER['REQUEST_METHOD'] != "POST" && (!$_GET["theme"] || !$_GET["label"])) {
		header("Location: ".DEFAULT_URL."/".SITEMGR_ALIAS."/prefs/theme.php");
		exit;
	}
	
	$themes = explode(",", EDIR_THEMES);
	$schemesnames = explode(",", EDIR_SCHEMENAMES);
	
	if (!in_array($theme, $themes) || !in_array($label, $schemesnames) || !$scheme || $theme == "realestate" || $theme == "diningguide") {
		header("Location: ".DEFAULT_URL."/".SITEMGR_ALIAS."/prefs/theme.php");
		exit;
	}

	if (($_SERVER['REQUEST_METHOD'] == "POST") && (!DEMO_LIVE_MODE)) {
	
		if ($action == "submit") {

			$array["colorBackground"] = $colorBackground;
			$array["colorHeader"] = $colorHeader;
			$array["colorText"] = $colorText;
			$array["colorLink"] = $colorLink;
			$array["colorNavbar"] = $colorNavbar;
			$array["colorNavbarLink"] = $colorNavbarLink;
			$array["colorNavbarLinkActive"] = $colorNavbarLinkActive;
			$array["colorFooter"] = $colorFooter;
			$array["colorFooterText"] = $colorFooterText;
			$array["colorFooterLink"] = $colorFooterLink;
			$array["color1"] = $color1;
			$array["color2"] = $color2;
			$array["color3"] = $color3;
			$array["color4"] = $color4;
			$array["color5"] = $color5;
			$array["color6"] = $color6;
			$array["color7"] = $color7;
			$array["fontOption"] = $font;
			$errorMessage = "";		

			if (!$errorMessage) {
				colorscheme_themeSchemeFile($array, $scheme, EDIR_THEME, ($aux_action ? $scheme : EDIR_SCHEME), $status);

				if ($scheme == EDIR_SCHEME || $aux_action){
					if (!setting_set("scheme_updatefile", "on")) {
						if (!setting_new("scheme_updatefile", "on")) {
							$error = true;
						}
					}
				}

				if (!setting_set("scheme_custom", "on")) {
					if (!setting_new("scheme_custom", "on")) {
						$error = true;
					}
				}
				
				if (!setting_set("scheme_".$scheme."_customized", "on")) {
					if (!setting_new("scheme_".$scheme."_customized", "on")) {
						$error = true;
					}
				}

				$successMessage = system_showText(LANG_SITEMGR_COLOR_SAVED);
			}
		} elseif ($action == "reset") {
			
			$arrayDefault = unserialize(ARRAY_DEFAULT_COLORS);
			$arrayCurValues = unserialize(EDIR_CURR_SCHEME_VALUES);
			
			$array["colorBackground"] = $arrayDefault[$theme][$scheme]["colorBackground"] ? $arrayDefault[$theme][$scheme]["colorBackground"] : "SCHEME_EMPTY";
			$colorBackground = $arrayDefault[$theme][$scheme]["colorBackground"] ? $arrayDefault[$theme][$scheme]["colorBackground"] : false;
			
			$array["colorHeader"] = $arrayDefault[$theme][$scheme]["colorHeader"] ? $arrayDefault[$theme][$scheme]["colorHeader"] : "SCHEME_EMPTY";
			$colorHeader = $arrayDefault[$theme][$scheme]["colorHeader"] ? $arrayDefault[$theme][$scheme]["colorHeader"] : false;
						
			$array["colorText"] = $arrayDefault[$theme][$scheme]["colorText"] ? $arrayDefault[$theme][$scheme]["colorText"] : "SCHEME_EMPTY";
			$colorText = $arrayDefault[$theme][$scheme]["colorText"] ? $arrayDefault[$theme][$scheme]["colorText"] : false;
			
			$array["colorLink"] = $arrayDefault[$theme][$scheme]["colorLink"] ? $arrayDefault[$theme][$scheme]["colorLink"] : "SCHEME_EMPTY";
			$colorLink = $arrayDefault[$theme][$scheme]["colorLink"] ? $arrayDefault[$theme][$scheme]["colorLink"] : false;
			
			$array["colorNavbar"] = $arrayDefault[$theme][$scheme]["colorNavbar"] ? $arrayDefault[$theme][$scheme]["colorNavbar"] : "SCHEME_EMPTY";
			$colorNavbar = $arrayDefault[$theme][$scheme]["colorNavbar"] ? $arrayDefault[$theme][$scheme]["colorNavbar"] : false;
			
			$array["colorNavbarLink"] = $arrayDefault[$theme][$scheme]["colorNavbarLink"] ? $arrayDefault[$theme][$scheme]["colorNavbarLink"] : "SCHEME_EMPTY";
			$colorNavbarLink = $arrayDefault[$theme][$scheme]["colorNavbarLink"] ? $arrayDefault[$theme][$scheme]["colorNavbarLink"] : false;
			
			$array["colorNavbarLinkActive"] = $arrayDefault[$theme][$scheme]["colorNavbarLinkActive"] ? $arrayDefault[$theme][$scheme]["colorNavbarLinkActive"] : "SCHEME_EMPTY";
			$colorNavbarLinkActive = $arrayDefault[$theme][$scheme]["colorNavbarLinkActive"] ? $arrayDefault[$theme][$scheme]["colorNavbarLinkActive"] : false;
			
			$array["colorFooter"] = $arrayDefault[$theme][$scheme]["colorFooter"] ? $arrayDefault[$theme][$scheme]["colorFooter"] : "SCHEME_EMPTY";
			$colorFooter = $arrayDefault[$theme][$scheme]["colorFooter"] ? $arrayDefault[$theme][$scheme]["colorFooter"] : false;
			
			$array["colorFooterText"] = $arrayDefault[$theme][$scheme]["colorFooterText"] ? $arrayDefault[$theme][$scheme]["colorFooterText"] : "SCHEME_EMPTY";
			$colorFooterText = $arrayDefault[$theme][$scheme]["colorFooterText"] ? $arrayDefault[$theme][$scheme]["colorFooterText"] : false;
			
			$array["colorFooterLink"] = $arrayDefault[$theme][$scheme]["colorFooterLink"] ? $arrayDefault[$theme][$scheme]["colorFooterLink"] : "SCHEME_EMPTY";
			$colorFooterLink = $arrayDefault[$theme][$scheme]["colorFooterLink"] ? $arrayDefault[$theme][$scheme]["colorFooterLink"] : false;
            
            $array["color1"] = $arrayDefault[$theme][$scheme]["color1"] ? $arrayDefault[$theme][$scheme]["color1"] : "SCHEME_EMPTY";
			$color1 = $arrayDefault[$theme][$scheme]["color1"] ? $arrayDefault[$theme][$scheme]["color1"] : false;
            
            $array["color2"] = $arrayDefault[$theme][$scheme]["color2"] ? $arrayDefault[$theme][$scheme]["color2"] : "SCHEME_EMPTY";
			$color2 = $arrayDefault[$theme][$scheme]["color2"] ? $arrayDefault[$theme][$scheme]["color2"] : false;
            
            $array["color3"] = $arrayDefault[$theme][$scheme]["color3"] ? $arrayDefault[$theme][$scheme]["color3"] : "SCHEME_EMPTY";
			$color3 = $arrayDefault[$theme][$scheme]["color3"] ? $arrayDefault[$theme][$scheme]["color3"] : false;
            
            $array["color4"] = $arrayDefault[$theme][$scheme]["color4"] ? $arrayDefault[$theme][$scheme]["color4"] : "SCHEME_EMPTY";
			$color4 = $arrayDefault[$theme][$scheme]["color4"] ? $arrayDefault[$theme][$scheme]["color4"] : false;
            
            $array["color5"] = $arrayDefault[$theme][$scheme]["color5"] ? $arrayDefault[$theme][$scheme]["color5"] : "SCHEME_EMPTY";
			$color5 = $arrayDefault[$theme][$scheme]["color5"] ? $arrayDefault[$theme][$scheme]["color5"] : false;
            
            $array["color6"] = $arrayDefault[$theme][$scheme]["color6"] ? $arrayDefault[$theme][$scheme]["color6"] : "SCHEME_EMPTY";
			$color6 = $arrayDefault[$theme][$scheme]["color6"] ? $arrayDefault[$theme][$scheme]["color6"] : false;
            
            $array["color7"] = $arrayDefault[$theme][$scheme]["color7"] ? $arrayDefault[$theme][$scheme]["color7"] : "SCHEME_EMPTY";
			$color7 = $arrayDefault[$theme][$scheme]["color7"] ? $arrayDefault[$theme][$scheme]["color7"] : false;
					
			$array["fontOption"] = $arrayDefault[$theme][$scheme]["fontOption"] ? $arrayDefault[$theme][$scheme]["fontOption"] : "SCHEME_EMPTY";
            $font = 1;

			colorscheme_themeSchemeFile($array, $scheme, EDIR_THEME, EDIR_SCHEME, $status);
			
			if (!setting_set("scheme_custom", "off")) {
				if (!setting_new("scheme_custom", "off")) {
					$error = true;
				}
			}
			
			if (!setting_set("scheme_".$scheme."_customized", "off")) {
				if (!setting_new("scheme_".$scheme."_customized", "off")) {
					$error = true;
				}
			}

			$successMessage = system_showText(LANG_SITEMGR_COLOR_SAVED);
			
		}
	}
	
	# ----------------------------------------------------------------------------------------------------
	# FORMS DEFINES
	# ----------------------------------------------------------------------------------------------------
	if ($_SERVER['REQUEST_METHOD'] != "POST") {
		
		if (!DEMO_LIVE_MODE) {
			$arrayCurValues = unserialize(EDIR_CURR_SCHEME_VALUES);
		} else {
			$arrayDefault = unserialize(ARRAY_DEFAULT_COLORS);
			$arrayCurValues = $arrayDefault[$theme];
		}
			
		$colorBackground = $arrayCurValues[$scheme]["colorBackground"];
		$colorHeader = $arrayCurValues[$scheme]["colorHeader"];
		$colorText = $arrayCurValues[$scheme]["colorText"];
		$colorLink = $arrayCurValues[$scheme]["colorLink"];
		$colorNavbar = $arrayCurValues[$scheme]["colorNavbar"];
		$colorNavbarLink = $arrayCurValues[$scheme]["colorNavbarLink"];
		$colorNavbarLinkActive = $arrayCurValues[$scheme]["colorNavbarLinkActive"];
		$colorFooter = $arrayCurValues[$scheme]["colorFooter"];
		$colorFooterText = $arrayCurValues[$scheme]["colorFooterText"];
		$colorFooterLink = $arrayCurValues[$scheme]["colorFooterLink"];
        $color1 = $arrayCurValues[$scheme]["color1"];
        $color2 = $arrayCurValues[$scheme]["color2"];
        $color3 = $arrayCurValues[$scheme]["color3"];
        $color4 = $arrayCurValues[$scheme]["color4"];
        $color5 = $arrayCurValues[$scheme]["color5"];
        $color6 = $arrayCurValues[$scheme]["color6"];
        $color7 = $arrayCurValues[$scheme]["color7"];
		$fontOption = $arrayCurValues[$scheme]["fontOption"];
	
	} else {
		$fontOption = $font;
	}
    
    $arrayDefault = unserialize(ARRAY_DEFAULT_COLORS);
	$arrayAuxCurValues = $arrayDefault[$theme];

	unset($arrayFont);
	unset($arrayNameFont);
	unset($arrayValueFont);	
	
	$arrayNameFont[] = $arrayAuxCurValues[$scheme]["fontName"];
	$arrayNameFont[] = "Arial, Helvetica, Sans-serif";
	$arrayNameFont[] = "Courier New, Courier, monospace";
	$arrayNameFont[] = "Georgia, Times New Roman, Times, serif";
	$arrayNameFont[] = "Tahoma, Geneva, sans-serif";
	$arrayNameFont[] = "Trebuchet MS, Arial, Helvetica, sans-serif";
	$arrayNameFont[] = "Verdana, Geneva, sans-serif";
	
	$arrayValueFont[] = 1; //Montserrat (Default), Open Sans (Contractors)
	$arrayValueFont[] = 2; //Arial, Helvetica, Sans-serif
	$arrayValueFont[] = 3; //'Courier New', Courier, monospace
	$arrayValueFont[] = 4; //Georgia, 'Times New Roman', Times, serif
	$arrayValueFont[] = 5; //Tahoma, Geneva, sans-serif
	$arrayValueFont[] = 6; //'Trebuchet MS', Arial, Helvetica, sans-serif
	$arrayValueFont[] = 7; //Verdana, Geneva, sans-serif

	$arrayFont = html_selectBox("font", $arrayNameFont, $arrayValueFont, $fontOption, "", "", "");
	
    $table_colors_1 = array(0 => "Text", 1 => "Link", 2 => "NavbarLink", 3 => "NavbarLinkActive", 4 => "FooterLink", 5 => "FooterText");
    $table_colors_2 = array(0 => "Header", 1 => "Background", 2 => "Navbar", 3 => "Footer");
    $table_colors_3 = array(0 => "1", 1 => "2", 2 => "3", 3 => "4", 4 => "5", 5 => "6", 6 => "7");

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/header.php");

	# ----------------------------------------------------------------------------------------------------
	# NAVBAR
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/navbar.php");
	
?>

	<div id="main-right">

		<div id="top-content">
			<div id="header-content">
				<h1><?=system_showText(LANG_SITEMGR_SETTINGS_SITEMGRSETTINGS)?> - <?=system_showText(LANG_SITEMGR_COLOR_OPTIONS)?></h1>
			</div>
		</div>

		<div id="content-content">
			<div class="default-margin">

				<? require(EDIRECTORY_ROOT."/".SITEMGR_ALIAS."/registration.php"); ?>
				<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
				<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>		

				<br />

				<ul class="list-view">
					<li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/prefs/theme.php"><?=system_showText(LANG_SITEMGR_BACK)?></a></li>
				</ul>
				
				<form name="color_scheme" id="color_scheme" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post" enctype="multipart/form-data">

					<? include(INCLUDES_DIR."/forms/form_colorscheme.php"); ?>
					
					<input type="hidden" name="theme" value="<?=$theme?>">
					<input type="hidden" name="label" value="<?=$label?>">
					<input type="hidden" name="scheme" value="<?=$scheme?>">
					<input type="hidden" name="action" id="action" value="submit">
					<input type="hidden" name="aux_action" id="aux_action" value="0">
					
				
					<? if (DEMO_LIVE_MODE) { ?>
						<button type="button" name="submit_button" class="input-button-form" value="Submit" onclick="livemodeMessage('<?=system_showText(LANG_SITEMGR_THEME_DEMO_MESSAGE)?>');"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
					<? } else { ?>
						<button type="button" name="submit_button" class="input-button-form" value="Submit" onclick="JS_submit('submit');"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
					<? } ?>
					
					<? if (EDIR_SCHEME != $scheme) { ?>	
						<? if (DEMO_LIVE_MODE) { ?>
							<button type="button" name="submit_button" class="input-button-form" value="Submit" onclick="livemodeMessage('<?=system_showText(LANG_SITEMGR_THEME_DEMO_MESSAGE)?>');"><?=system_showText(LANG_SITEMGR_APPLY_SCHEME)?></button>
						<? } else { ?>
							<button type="button" name="submit_button" class="input-button-form" value="Submit" onclick="JS_submit('apply');"><?=system_showText(LANG_SITEMGR_APPLY_SCHEME)?></button>
						<? } ?>
					<? } ?>
						
					<? if (DEMO_LIVE_MODE) { ?>
						<button type="button" name="reset_button" class="input-button-form" value="Submit" onclick="livemodeMessage('<?=system_showText(LANG_SITEMGR_THEME_DEMO_MESSAGE)?>');"><?=system_showText(LANG_SITEMGR_RESET)?></button>
					<? } else { ?>
						<button type="button" name="reset_button" class="input-button-form" value="Submit" onclick="JS_submit('reset');"><?=system_showText(LANG_SITEMGR_RESET)?></button>
					<? } ?>
						
					<button type="button" name="cancel" class="input-button-form" value="Cancel" onclick="Redirect('<?=DEFAULT_URL."/".SITEMGR_ALIAS."/prefs/theme.php"?>');"><?=system_showText(LANG_SITEMGR_CANCEL)?></button>
					
				</form>

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
