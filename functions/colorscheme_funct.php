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
	# * FILE: /functions/colorscheme_funct.php
	# ----------------------------------------------------------------------------------------------------

	function colorscheme_generateDynamicCSS() {
		
		setting_get("scheme_updatefile", $scheme_updatefile); //variable forcing to update the css file
		
		$constantsPath = EDIRECTORY_ROOT."/conf/".EDIR_THEME."_scheme.inc.php";
		$dynamicPHPPath = THEMEFILE_DIR."/".EDIR_THEME."/colorscheme.php";
		$arrayDefault = unserialize(ARRAY_DEFAULT_COLORS);
		
		$constModification = date("dYHis", filemtime($constantsPath)); //update css if sitemgr has changed any color
		$phpModification = date("dYHis", filemtime($dynamicPHPPath)); //update css if the php file was changed

		$domainRoot = EDIRECTORY_ROOT."/custom/domain_".SELECTED_DOMAIN_ID."/theme/".EDIR_THEME;
		$domainURL = DEFAULT_URL."/custom/domain_".SELECTED_DOMAIN_ID."/theme/".EDIR_THEME;

		$dynamicCSSPath = $domainRoot."/color_scheme_".$constModification."_".$phpModification.".css";
		$dynamicCSSUrl = $domainURL."/color_scheme_".$constModification."_".$phpModification.".css";

		if (!file_exists($dynamicCSSPath) || (int)filesize($dynamicCSSPath) <= 0 || $scheme_updatefile == "on"){ //update css file
			
			if (!setting_set("scheme_updatefile", "off")) { //restore default value
				if (!setting_new("scheme_updatefile", "off")) {
					$error = true;
				}
			}
			include_once(CLASSES_DIR."/class_miniJS.php");

			foreach (glob($domainRoot."/color_scheme_*.css") as $deleteFilename) { //remove old css files
                @unlink($deleteFilename);
			}

			//array with all colors and image to be replaced
			$constReplace = Array (
				"SCHEME_COLORBACKGROUND",
				"SCHEME_COLORHEADER",
				"SCHEME_COLORTEXT",
				"SCHEME_COLORLINK",
				"SCHEME_COLORNAVBAR",
				"SCHEME_COLORNAVBARLINK",
				"SCHEME_COLORNAVBARLINKACTIVE",
				"SCHEME_COLORFOOTER",
				"SCHEME_COLORFOOTERTEXT",
				"SCHEME_COLORFOOTERLINK",
				"SCHEME_COLOR1",
				"SCHEME_COLOR2",
				"SCHEME_COLOR3",
				"SCHEME_COLOR4",
				"SCHEME_COLOR5",
				"SCHEME_COLOR6",
				"SCHEME_COLOR7",
				"SCHEME_FONTOPTION"
			);
			
			$handle = fopen($dynamicCSSPath, 'w+');
			$phpContent = file_get_contents($dynamicPHPPath);
			
			$regexPattern = "/<!--Marker-->.*<!--Marker-->/s";
			$phpContent = preg_replace($regexPattern, "", $phpContent); //remove the file header info
			
			foreach ($constReplace as $const) {
				unset($newValue);
				if ($const == "SCHEME_FONTOPTION") { //replace font family value
					$auxFont = constant($const);
                    $auxFontDefaultName = $arrayDefault[EDIR_THEME][EDIR_SCHEME]["fontName"];

					switch ($auxFont) {
                        case 1: $newValue = $auxFontDefaultName;
								break;
						case 2: $newValue = "Arial, Helvetica, Sans-serif";
								break;
						case 3: $newValue = "\"Courier New\", Courier, monospace";
								break;
						case 4: $newValue = "Georgia, \"Times New Roman\", Times, serif";
								break;
						case 5: $newValue = "Tahoma, Geneva, sans-serif";
								break;
						case 6: $newValue = "\"Trebuchet MS\", Arial, Helvetica, sans-serif";
								break;
						case 7: $newValue = "Verdana, Geneva, sans-serif";
								break;
					}
								
				} else {
					if (defined($const) && $const != "SCHEME_EMPTY") { //read the new value to be replaced
						$newValue = constant($const);
					}
				}
								
				if ($newValue) {
																                   					
					$phpContent = str_replace("<?=$const?>", $newValue, $phpContent);
					
				}
			}

			fwrite($handle, ($phpContent));
			fclose($handle);
		}
		
		return "<link href=\"$dynamicCSSUrl\" rel=\"stylesheet\" type=\"text/css\" media=\"all\" />";
		
	}
	
	function colorscheme_themeSchemeFile($array, $select_scheme, $edir_theme, $use_scheme, &$status){
		$status = "";
		$fileschemeConfigPath    = EDIRECTORY_ROOT.'/custom/domain_'.SELECTED_DOMAIN_ID.'/theme/'.$edir_theme.'_scheme.inc.php';
		
		if (!$fileschemeConfig = fopen($fileschemeConfigPath, 'w+')) {
			$status = 'error';

		} else {
			
			$auxCurValues = unserialize(EDIR_CURR_SCHEME_VALUES);
			
			$themes = explode(",", EDIR_THEMES);
			$buffer  = "<?php".PHP_EOL."\$edir_scheme=\"$use_scheme\";".PHP_EOL;

			$schemes = explode(",", constant("EDIR_SCHEMES"));
			foreach ($schemes as $scheme){
				foreach($array as $key=>$value){
					if ($select_scheme == $scheme){
						$buffer .= "\$arrayScheme[\"$scheme\"][\"$key\"] = \"".($value ? $value : "SCHEME_EMPTY")."\";".PHP_EOL;
					} else {
						$buffer .= "\$arrayScheme[\"$scheme\"][\"$key\"] = \"".$auxCurValues[$scheme][$key]."\";".PHP_EOL;
					}
				}
			} 
			
			if (!fwrite($fileschemeConfig, $buffer, strlen($buffer))) {
				$status = 'error';
			}
		}
	}
	
	function colorscheme_generateMenuImage($colors, $scheme, $theme){
		
		$physicalPath = EDIRECTORY_ROOT.'/custom/domain_'.SELECTED_DOMAIN_ID.'/theme_images';

		if (!is_dir($physicalPath)) mkdir($physicalPath);

		$values_img = array(1, 9, 9, 1, 17, 9);
			
		if (($colors["colorContentBackground"] == "SCHEME_EMPTY" && $colors["colorBackground"] == "SCHEME_EMPTY") || (!$colors["colorContentBackground"] && !$colors["colorBackground"]) || ($colors["colorContentBackground"] == "SCHEME_EMPTY" && !$colors["colorBackground"])){
			$colors["colorContentBackground"] = "FFFFFF";
		}

		if ($colors["colorContentBackground"] || $colors["colorBackground"]){
			
			$colorsBackground = system_hex2rgb($colors["colorContentBackground"] && $colors["colorContentBackground"] != "SCHEME_EMPTY" ? $colors["colorContentBackground"] : $colors["colorBackground"]);

			$img = imagecreate(18,9); //image size
			$background_body = imagecolorallocate($img, $colorsBackground["red"], $colorsBackground["green"], $colorsBackground["blue"]);
			$background	= imagecolorallocatealpha($img, 0, 0, 0,127);

			imagefilledrectangle($img, 0, 0, 18, 9, $background); // background to poligon
			imagefilledpolygon($img, $values_img, 3, $background_body); // Poligon


			imagepng($img, EDIRECTORY_ROOT."/custom/domain_".SELECTED_DOMAIN_ID."/theme_images/".$scheme."_active.png");
		} else {
			@unlink(EDIRECTORY_ROOT."/custom/domain_".SELECTED_DOMAIN_ID."/theme_images/".$scheme."_active.png");
		}
	}
	
	function colorscheme_generateDealImages($colors, $scheme, $theme){
		
		$physicalPath = EDIRECTORY_ROOT.'/custom/domain_'.SELECTED_DOMAIN_ID.'/theme_images';

		if (!is_dir($physicalPath)) mkdir($physicalPath);
		
		$colorsInf = system_hex2rgb($colors["colorLink"]);
		$colorsMain = system_hex2rgb(strtolower($colors["colorTitle"]) != "ffffff" ? $colors["colorTitle"] : $colors["colorFooterLink"]);
		
		//deal tag used on featured deals, listing detail and deal results

		$init = 8;
		$final = 32;

		$values_img = array($init, 0, 0, (($final / 2)), $init, $final);

		$img = imagecreate(80, 32); //image size

		$tag_color = imagecolorallocate($img, $colorsMain["red"], $colorsMain["green"], $colorsMain["blue"]); //color to the main tag
		$background	= imagecolorallocatealpha($img, 0, 0, 0, 127); //transparent background

		imagefilledrectangle($img, 0, 0, $final, 64, $background); //background to poligon
		imagefilledrectangle($img, $init, 0, 80, $final, $tag_color); //background to tag
		imagefilledpolygon($img, $values_img, 3, $tag_color); //poligon
		imagefilledellipse($img, $init+2, ($final / 2), 5, 5, $background); //hole to tag

		imagepng($img, EDIRECTORY_ROOT."/custom/domain_".SELECTED_DOMAIN_ID."/theme_images/".$scheme."_icon-tag.png");

		//deal tag used on deal detail

		$init = 13; 
		$final = 51;

		$values_img = array($init, 0, 0, (($final / 2)), $init, $final);

		$img = imagecreate(132, 74); //image size

		$color = imagecolorallocate($img, $colorsInf["red"], $colorsInf["green"], $colorsInf["blue"]);
		$tag_color	= imagecolorallocate($img, $colorsMain["red"], $colorsMain["green"], $colorsMain["blue"]);
		$background	= imagecolorallocatealpha($img, 0, 0, 0,127); //transparent background

		imagefilledrectangle($img, 0, 0, $final, 100, $background); //background to poligon
		imagefilledrectangle($img, 152, 52, 152, 100, $color); //box above tag
		imagefilledrectangle($img, $init, 0, 132, $final, $tag_color); //background to tag
		imagefilledpolygon($img, $values_img, 3, $tag_color); //poligon
		imagefilledellipse($img, $init, ($final / 2), 6, 6, $background); //hole to tag

		imagepng($img, EDIRECTORY_ROOT."/custom/domain_".SELECTED_DOMAIN_ID."/theme_images/".$scheme."_icon-tag-detail.png");

		//deal tag used on the deal index (special deal)

		$init = 11;
		$final = 44;

		$values_img = array($init, 0, 0, (($final / 2)), $init, $final);

		$img = imagecreate(120,65); //image size

		$color = imagecolorallocate($img, $colorsInf["red"], $colorsInf["green"], $colorsInf["blue"]); //color to the rectangle below the main tag.
		$tag_color = imagecolorallocate($img, $colorsMain["red"], $colorsMain["green"], $colorsMain["blue"]); //color to the main tag
		$background	= imagecolorallocatealpha($img, 0, 0, 0, 127); //transparent background

		imagefilledrectangle($img, 0, 0, $final, 64, $background);
		imagefilledrectangle($img, 43, ($final+1), 132, 65, $color); //box below tag
		imagefilledrectangle($img, $init, 0, 132, $final, $tag_color); //box of themain tag
		imagefilledpolygon($img, $values_img, 3, $tag_color); //triangle of the left corner
		imagefilledellipse($img, $init+1, ($final / 2), 6, 6, $background); //tag circle

		imagepng($img, EDIRECTORY_ROOT."/custom/domain_".SELECTED_DOMAIN_ID."/theme_images/".$scheme."_icon-tag-special-deal.png");

		//box above tag in deal results

		$img = imagecreate(70, 20); //image size
		$color = imagecolorallocatealpha($img, $colorsInf["red"], $colorsInf["green"], $colorsInf["blue"], 100); //color to the image
		imagefilledrectangle($img, 152, 52, 152, 100, $color); //box above tag
		imagepng($img, EDIRECTORY_ROOT."/custom/domain_".SELECTED_DOMAIN_ID."/theme_images/".$scheme."_icon-tag-sub.png");
			
	}
	
	function colorscheme_generateMarkerImage($colors = "", $scheme = "", $theme = ""){
		
		$physicalPath = EDIRECTORY_ROOT.'/custom/domain_'.SELECTED_DOMAIN_ID.'/theme_images';

		if (!is_dir($physicalPath)) mkdir($physicalPath);

		$values_img = array(4, 16, 11, 21, 17, 16); //main triangle
		$values_img2 = array(2, 14, 11, 23, 19, 14); //triangle border
		$font = EDIRECTORY_ROOT."/".SITEMGR_ALIAS."/prefs/arial.ttf";
		
		$colorsBackground = system_hex2rgb($colors["colorLink"]);

		for ($i=0; $i<=40; $i++){
		
			$img = imagecreate(23,23); //image size
			$background_body = imagecolorallocate($img, $colorsBackground["red"], $colorsBackground["green"], $colorsBackground["blue"]);
			$background_body2 = imagecolorallocate($img, 255, 255, 255); //border and text
			$background	= imagecolorallocatealpha($img, 0, 0, 0, 127);

			imagefilledrectangle($img, 0, 0, 23, 23, $background); // transparent background

			imagefilledpolygon($img, $values_img2, 3, $background_body2); //background border to triangle

			imagefilledrectangle($img, 0, 0, 23, 18, $background_body2); //background border to rectangle
			imagefilledrectangle($img, 1, 1, 21, 17, $background_body); //background to rectangle

			imagefilledpolygon($img, $values_img, 3, $background_body); //background to triangle

			if ($i){
				
				$pos_x = ($i < 10 ? (23/2 -2) : (23/2 -6));
                if(function_exists("imagettftext")){
                    $pos_y = 14;
                    imagettftext($img, 9, 0, $pos_x, $pos_y, $background_body2, $font, $i);
                }else{
                    $pos_y = 2;
                    imagestring($img, 3, $pos_x, $pos_y, $i, $background_body2);
                }
    
				$name = $scheme."_marker_$i.png";
			} else {
				$name = $scheme."_marker.png";
			}
			
			imagepng($img, EDIRECTORY_ROOT."/custom/domain_".SELECTED_DOMAIN_ID."/theme_images/".$name);
			
		}
	}

?>