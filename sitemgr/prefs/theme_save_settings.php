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
	# * FILE: /sitemgr/prefs/theme_save_settings.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
    $loadSitemgrLangs = true;
	include("../../conf/loadconfig.inc.php");
    
    header("Content-Type: text/html; charset=".EDIR_CHARSET, TRUE);
    header("Accept-Encoding: gzip, deflate");
    header("Expires: Sat, 01 Jan 2000 00:00:00 GMT");
    header("Cache-Control: no-store, no-cache, must-revalidate");
    header("Cache-Control: post-check=0, pre-check", FALSE);
    header("Pragma: no-cache");
   
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        $error = false;
        
        if ($_POST["form_id"] == "pricing_levels_form") {
            if (is_numeric($_POST["listing_price_1_to"]) && 
               is_numeric($_POST["listing_price_2_from"]) && 
               is_numeric($_POST["listing_price_2_to"]) && 
               is_numeric($_POST["listing_price_3_from"]) && 
               is_numeric($_POST["listing_price_3_to"]) && 
               is_numeric($_POST["listing_price_4_from"]) && $_POST["symbol"]) {
                
                if (($_POST["symbol"] == "custom") && (!$_POST["custom_symbol"])) {
                     $msg = system_showText(LANG_SITEMGR_PRICING_CHECK_FIELDS);
                     $error = true;
                } elseif (($_POST["listing_price_1_to"] < $_POST["listing_price_2_from"]) &&
                   ($_POST["listing_price_1_to"] < $_POST["listing_price_2_to"]) &&
                   ($_POST["listing_price_1_to"] < $_POST["listing_price_3_from"]) &&
                   ($_POST["listing_price_1_to"] < $_POST["listing_price_3_to"]) &&
                   ($_POST["listing_price_1_to"] < $_POST["listing_price_4_from"])) {
                    
                        if (($_POST["listing_price_2_from"] < $_POST["listing_price_2_to"]) &&
                           ($_POST["listing_price_2_from"] < $_POST["listing_price_3_from"]) &&
                           ($_POST["listing_price_2_from"] < $_POST["listing_price_3_to"]) &&
                           ($_POST["listing_price_2_from"] < $_POST["listing_price_4_from"])) {
                            
                           if (($_POST["listing_price_2_to"] < $_POST["listing_price_3_from"]) &&
                                ($_POST["listing_price_2_to"] < $_POST["listing_price_3_to"]) &&
                                ($_POST["listing_price_2_to"] < $_POST["listing_price_4_from"])) {

                                if (($_POST["listing_price_3_from"] < $_POST["listing_price_3_to"]) &&
                                ($_POST["listing_price_3_from"] < $_POST["listing_price_4_from"])) {

                                    if (($_POST["listing_price_3_to"] < $_POST["listing_price_4_from"])) {

                                        for ($i = 1; $i <= LISTING_PRICE_LEVELS; $i++) {

                                            if (!setting_set("listing_price_{$i}_from", ($_POST["listing_price_".$i."_from"] ? $_POST["listing_price_".$i."_from"] : "0"))) {
                                                setting_new("listing_price_{$i}_from", ($_POST["listing_price_".$i."_from"] ? $_POST["listing_price_".$i."_from"] : "0"));
                                            }

                                            if (!setting_set("listing_price_{$i}_to", ($_POST["listing_price_".$i."_to"] ? $_POST["listing_price_".$i."_to"] : ""))) {
                                                setting_new("listing_price_{$i}_to", ($_POST["listing_price_".$i."_to"] ? $_POST["listing_price_".$i."_to"] : ""));
                                            }

                                        }

                                        if ($_POST["symbol"] == "custom") {

                                            if (!setting_set("listing_price_symbol", $_POST["custom_symbol"])) {
                                                setting_new("listing_price_symbol", $_POST["custom_symbol"]);
                                            }

                                        } else {

                                            if (!setting_set("listing_price_symbol", $_POST["symbol"])) {
                                                setting_new("listing_price_symbol", $_POST["symbol"]);
                                            }
                                        }

                                        $msg = system_showText(LANG_SITEMGR_PRICING_SUCCESSFULLY_UPDATED);

                                    } else {
                                        $msg = system_showText(LANG_SITEMGR_PRICING_RANGE_FIELDS);
                                        $error = true;
                                    }
                                } else {
                                    $msg = system_showText(LANG_SITEMGR_PRICING_RANGE_FIELDS);
                                    $error = true;
                                }
                            
                           } else {
                               $msg = system_showText(LANG_SITEMGR_PRICING_RANGE_FIELDS);
                               $error = true;
                           }
                            
                        } else {
                            $msg = system_showText(LANG_SITEMGR_PRICING_RANGE_FIELDS);
                            $error = true;
                        }
                } else {
                    $msg = system_showText(LANG_SITEMGR_PRICING_RANGE_FIELDS);
                    $error = true;
                }
                
            } else {
                $msg = system_showText(LANG_SITEMGR_PRICING_CHECK_FIELDS);
                $error = true;
            }
            
        } elseif ($_POST["form_id"] == "theme_background_image") {
            
            //Add/Update image
            
            $buttonReset = "";
            
            if ($_POST["reset_form"] == "reset" || $_POST["background_image_id"]) {
                
                //Remove old image
                setting_get("diningguide_background_image_id", $image_id);
                
                if ($image_id != $_POST["background_image_id"]) {
                    $imgObj = new Image($image_id);
                    if ($imgObj->getNumber("id")) {
                        $imgObj->delete();
                    }
                }
                
                if ($_POST["reset_form"] == "reset") {
                    $buttonReset = "hide";
                    $_POST["background_image_id"] = "";
                    system_backgroundImageStyle("clean");
                    
                    //clear dimension
                    if (!setting_set("background_image_height", "")) {
                        setting_new("background_image_height", "");
                    }
                } else {
                    $buttonReset = "show";
                }
                
                if (!setting_set("diningguide_background_image_id", $_POST["background_image_id"])) {
                    setting_new("diningguide_background_image_id", $_POST["background_image_id"]);
                }
                
                $newImageReturn = "<input type='hidden' name='background_image_id' value='' />".front_getBackground($customimage);
                
                if ($_POST["background_image_id"] && $customimage) {
                    if ($_POST["dimensionY"]) {
                        //generate new css file
                        system_backgroundImageStyle("new", $_POST["dimensionY"]);
                        
                        //save dimension
                        if (!setting_set("background_image_height", $_POST["dimensionY"])) {
                            setting_new("background_image_height", $_POST["dimensionY"]);
                        }
                    } else {
                        //remove css file
                        system_backgroundImageStyle("clean");
                        
                        //clear dimension
                        if (!setting_set("background_image_height", "")) {
                            setting_new("background_image_height", "");
                        }
                    }
                }
                
                $msg = system_showText(LANG_SITEMGR_BACKGROUND_UPDATED);
                
            } elseif ($_POST["curr_image_id"]) {
                
                //generate new css file
                system_backgroundImageStyle("new", $_POST["dimensionY"]);
                
                //save dimension
                if (!setting_set("background_image_height", $_POST["dimensionY"])) {
                    setting_new("background_image_height", $_POST["dimensionY"]);
                }
                
                $msg = system_showText(LANG_SITEMGR_BACKGROUND_UPDATED);
            } else {
                $msg = system_showText(LANG_SITEMGR_IMAGE_EMPTY);
                $error = true;
            }
        }
        
        echo ($error ? "error" : "success")."||".$msg.($buttonReset ? "||".$buttonReset."||".$newImageReturn : "");
    }
?>