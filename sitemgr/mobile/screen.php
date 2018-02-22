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
	# * FILE: /sitemgr/mobile/screen.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");
    
	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (!permission_hasSMPermSection(SITEMGR_PERMISSION_MOBILE)) {
		header("Location: ".DEFAULT_URL."/".SITEMGR_ALIAS."/");
		exit;
	}
    
    extract($_POST);
    extract($_GET);

	# ----------------------------------------------------------------------------------------------------
	# INCREASES FREQUENTLY ACTIONS
	# ----------------------------------------------------------------------------------------------------
	system_setFreqActions('mobile_screen','mobile');
    
    
    # ----------------------------------------------------------------------------------------------------
	# SUBIMIT
	# ----------------------------------------------------------------------------------------------------
    if ($_SERVER["REQUEST_METHOD"] == "POST" && !DEMO_LIVE_MODE) {
        
        $crop = false;
        if ($submit_ios) {
            $type = "ios";
        } elseif ($submit_android) {
            $type = "android";
        } else {
            $crop = true;
        }
        
        if (validate_form("mobile_screen", $_POST, ${"error_".$type}) && !$crop) {

            //image upload
            if ($type == "android") {
                
                foreach($_POST["image"] as $k => $image) {
                    $i = $k + 1; 

                    if ($_POST["image_type$i"] && (($type == "ios" && $i == 1) || ($type == "android" && $i == 2))) {

                        // TYPES
                        //1 = GIF, 2 = JPG, 3 = PNG, 4 = SWF, 5 = PSD, 6 = BMP, 7 = TIFF(intel byte order), 8 = TIFF(motorola byte order), 
                        //9 = JPC, 10 = JP2, 11 = JPX, 12 = JB2, 13 = SWC, 14 = IFF, 15 = WBMP, 16 = XBM
                        $user_id = $_COOKIE["PHPSESSID"];
                        $dir = EDIRECTORY_ROOT."/custom/domain_".SELECTED_DOMAIN_ID."/image_files/";
                        $files = glob("$dir/_".$k."_".$user_id."_*.*"); 
                        switch ($_POST["image_type$i"]) {
                            case 1:
                                $img_type='gif';
                                $img_r = imagecreatefromgif( $files[0] );
                                break;
                            case 2:
                                $img_type='jpeg';
                                $img_r = imagecreatefromjpeg( $files[0] );                           
                                break;
                            case 3:
                                $img_type='png';
                                $img_r = imagecreatefrompng( $files[0] );
                                break;
                        }

                        $dst_r = ImageCreateTrueColor( MOBILE_SCREEN_WIDTH, MOBILE_SCREEN_HEIGHT );

                        if ($img_r) {
                            $lowQuality = false;
                            if($img_type == "png" || $img_type == "gif"){
                                imagealphablending($dst_r, false);
                                imagesavealpha($dst_r,true);
                                $transparent = imagecolorallocatealpha( $dst_r, 255, 255, 255, 127 );
                                imagefill( $dst_r, 0, 0, $transparent ); 
                                imagecolortransparent( $dst_r, $transparent);
                                $transindex = imagecolortransparent($img_r);
                                if($transindex >= 0) {
                                    $lowQuality = true; //only use imagecopyresized (low quality) if the image is a transparent gif
                                }
                            }

                            if ($img_type == "gif" && $lowQuality){ //use imagecopyresized for gif to keep the transparency. The functions imagecopyresized and imagecopyresampled works in the same way with the exception that the resized image generated through imagecopyresampled is smoothed so that it is still visible.
                                //low quality
                                imagecopyresized( $dst_r,
                                                $img_r,
                                                0,
                                                0,
                                                $_POST["x$i"],
                                                $_POST["y$i"],
                                                MOBILE_SCREEN_WIDTH,
                                                MOBILE_SCREEN_HEIGHT,
                                                $_POST["w$i"],
                                                $_POST["h$i"]
                                            );
                            } else {
                                //better quality
                                imagecopyresampled( $dst_r,
                                                $img_r,
                                                0,
                                                0,
                                                $_POST["x$i"],
                                                $_POST["y$i"],
                                                MOBILE_SCREEN_WIDTH,
                                                MOBILE_SCREEN_HEIGHT,
                                                $_POST["w$i"],
                                                $_POST["h$i"]
                                            );
                            }


                        }

                        /**
                        * Saving JPG as PNG 
                        */
                        if ((FORCE_SAVE_JPG_AS_PNG == "on") && ($img_type == "jpeg")) {
                            ${"crop_image".$k} = $dir."crop_image$k.png"; 
                        } else {
                            ${"crop_image".$k} = $dir."crop_image$k.$img_type"; 
                        }

                        if ($img_type == 'gif') {
                            imagegif($dst_r, ${"crop_image".$k});
                        } elseif ($img_type == 'jpeg') {
                            if (FORCE_SAVE_JPG_AS_PNG == "on") {
                                imagepng($dst_r, ${"crop_image".$k});
                            } else {
                                imagejpeg($dst_r, ${"crop_image".$k});
                            }						
                        } elseif ($img_type == 'png') {
                            imagepng($dst_r, ${"crop_image".$k});
                        }
                    }
                }
                
                /* ios image file */
                if ($crop_image0 && $type == "ios") {
                    $filename = EDIRECTORY_ROOT.IMAGE_SCREEN_IOS_PATH;
                    $image_upload = image_uploadForMobile($filename, $crop_image0, false);
                }

                /* android image file */
                if ($crop_image1 && $type == "android") {
                    $filename = EDIRECTORY_ROOT.IMAGE_SCREEN_ANDROID_PATH;
                    $image_upload = image_uploadForMobile($filename, $crop_image1, false);
                }
                
            }

            if (!setting_set("app_storelink_".$type, ${"storelink_".$type})) {
				if(!setting_new("app_storelink_".$type, ${"storelink_".$type})) {
					$error = true;
				}
			}
            
            if ($type == "android") {
                if (!setting_set("app_popuptitle_".$type, ${"popuptitle_".$type})) {
                    if(!setting_new("app_popuptitle_".$type, ${"popuptitle_".$type})) {
                        $error = true;
                    }
                }

                if (!setting_set("app_tagline_".$type, ${"tagline_".$type})) {
                    if(!setting_new("app_tagline_".$type, ${"tagline_".$type})) {
                        $error = true;
                    }
                }

                if (!setting_set("app_price_".$type, ${"price_".$type})) {
                    if(!setting_new("app_price_".$type, ${"price_".$type})) {
                        $error = true;
                    }
                }
            }
            
            if (!setting_set("app_status_".$type, ${"status_".$type})) {
				if(!setting_new("app_status_".$type, ${"status_".$type})) {
					$error = true;
				}
			}
            
            header("Location: ".DEFAULT_URL."/".SITEMGR_ALIAS."/mobile/screen.php?success_$type=1");
            exit;
            
        }
        
    }
    
    # ----------------------------------------------------------------------------------------------------
	# FORMS DEFINES
	# ----------------------------------------------------------------------------------------------------
    if ($_SERVER["REQUEST_METHOD"] != "POST") {
        
        if (DEMO_LIVE_MODE) {
            $storelink_ios = DEMO_MOBILE_APPURL_IOS;
            $storelink_android = DEMO_MOBILE_APPURL_ANDROID;
            $popuptitle_ios = system_showText(LANG_MOBILE_APP);
            $popuptitle_android = system_showText(LANG_MOBILE_APP);
            $tagline_ios = system_showText(LANG_MOBILE_GRAB_APP_IPHONE);
            $tagline_android = system_showText(LANG_MOBILE_GRAB_APP_ANDROID);
            $price_ios = LANG_FREE;
            $price_android = LANG_FREE;
            $status_ios = "A";
            $status_android = "A";
        } else {
            setting_get("app_storelink_ios", $storelink_ios);
            setting_get("app_storelink_android", $storelink_android);
            setting_get("app_popuptitle_ios", $popuptitle_ios);
            setting_get("app_popuptitle_android", $popuptitle_android);
            setting_get("app_tagline_ios", $tagline_ios);
            setting_get("app_tagline_android", $tagline_android);
            setting_get("app_status_ios", $status_ios);
            setting_get("app_status_android", $status_android);
            setting_get("app_price_ios", $price_ios);
            setting_get("app_price_android", $price_android);
        }
    } else {
        if ($type == "ios") {
            $auxType = "android";
        } else {
            $auxType = "ios";
        }
        
        setting_get("app_storelink_".$auxType, ${"storelink_".$auxType});
        setting_get("app_popuptitle_".$auxType, ${"popuptitle_".$auxType});
        setting_get("app_tagline_".$auxType, ${"tagline_".$auxType});
        setting_get("app_status_".$auxType, ${"status_".$auxType});
        
    }
    
    // Status Drop Down
	$statusObj = new ItemStatus();
	unset($arrayValue);
	unset($arrayName);
	$arrayValue = $statusObj->getValues();
	$arrayName = $statusObj->getNames();
	unset($arrayValueDD);
	unset($arrayNameDD);
	for ($i=0; $i<count($arrayValue); $i++) {
		if ($arrayValue[$i] != "E" && $arrayValue[$i] != "P") {
			$arrayValueDD[] = $arrayValue[$i];
			$arrayNameDD[] = $arrayName[$i];
		}
	}
	$statusDropDown_ios = html_selectBox("status_ios", $arrayNameDD, $arrayValueDD, $status_ios, "", "style='width: 200px;'", "-- ".system_showText(LANG_LABEL_SELECT_ALLSTATUS)." --");
	$statusDropDown_android = html_selectBox("status_android", $arrayNameDD, $arrayValueDD, $status_android, "", "style='width: 200px;'", "-- ".system_showText(LANG_LABEL_SELECT_ALLSTATUS)." --");

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/header.php");

	# ----------------------------------------------------------------------------------------------------
	# NAVBAR
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/navbar.php");

?>
    <script type="text/javascript">

        function JS_submit(type) {
            if (type == "ios") {
                $("#submit_android").attr("value", "");
            } else if (type == "android") {
                $("#submit_ios").attr("value", "");
            }
            $("#submit_"+type).attr("value", "submit");
            document.splashScreen.submit();
        }

    </script>

    <? include(EDIRECTORY_ROOT."/includes/code/thumbnail.php"); ?>
    
    <div id="main-right">

        <div id="top-content">
            <h1><?=system_showText(LANG_SITEMGR_NAVBAR_MOBILE)?> - <?=system_showText(LANG_SITEMGR_MOBILE_SCREEN)?></h1>
        </div>

        <div id="content-content">

            <div class="default-margin">

                <? require(EDIRECTORY_ROOT."/".SITEMGR_ALIAS."/registration.php"); ?>
                <? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
                <? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>
                
                <br />

                <p><?=system_showText(LANG_SITEMGR_MOBILE_TIP);?></p>
                
                <br />
                
                <div class="baseForm">
                                        
                    <? if ($error_ios) { ?>
                        <p class="errorMessage"><?=$error_ios?></p>
                    <? } elseif ($success_ios) { ?>
                        <p class="successMessage"><?=system_showText(LANG_SITEMGR_MOBILE_SUCCESS);?></p>
                    <? } ?>

                    <form name="splashScreen" id="splashScreen" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post" enctype="multipart/form-data">
                    
                        <input type="hidden" name="submit_ios" id="submit_ios" value="" />
                        <input type="hidden" name="submit_android" id="submit_android" value="" />
                        <input type="hidden" name="crop_submit" id="crop_submit">
                        
                        <table cellpadding="0" cellspacing="0" border="0" class="standard-table">
                            <tr>
                                <th colspan="2" class="standard-tabletitle"><?=system_showText(LANG_SITEMGR_MOBILE_SCREEN_IOS)?> <span><?=system_showText(LANG_SITEMGR_MOBILE_SCREEN_TIP)?></span></th>
                            </tr>
                            
                            <tr style="display: none;">
                                <th><?=(!file_exists(EDIRECTORY_ROOT.IMAGE_SCREEN_IOS_PATH) ? "* " : "")?><?=system_showText(LANG_SITEMGR_MOBILE_PHONEIMAGE)?>:</th>
                                <td class="columnFile">
                                    <input type="hidden" name="image[]" id="image" value="1">
                                    <input type="file" id="image1" name="image_ios" size="50" onchange="UploadImage('splashScreen', 1);" class="inputExplode" /><span><?=MOBILE_SCREEN_WIDTH?> x <?=MOBILE_SCREEN_HEIGHT?></span>
                                    <?//Crop Tool Inputs?>
                                    <input type="hidden" name="x1" id="x1">
                                    <input type="hidden" name="y1" id="y1">
                                    <input type="hidden" name="x21" id="x21">
                                    <input type="hidden" name="y21" id="y21">
                                    <input type="hidden" name="w1" id="w1">
                                    <input type="hidden" name="h1" id="h1">
                                    <input type="hidden" name="image_width1" id="image_width1">
                                    <input type="hidden" name="image_height1" id="image_height1">
                                    <input type="hidden" name="image_type1" id="image_type1">
                                </td>
                            </tr>
                          
                            <tr>
                                <th>* <?=system_showText(LANG_SITEMGR_MOBILE_STORELINK)?>:</th>
                                <td>
                                    <input type="text" name="storelink_ios" value="<?=$storelink_ios?>" />
                                    <span>App Store (Ex: 5466325236)</span>
                                </td>
                            </tr>
                            
                            <?/*
                            <tr>
                                <th>* <?=system_showText(LANG_SITEMGR_MOBILE_POPTITLE)?>:</th>
                                <td><input type="text" name="popuptitle_ios" maxlength="30" value="<?=htmlspecialchars($popuptitle_ios);?>" /></td>
                            </tr>
                            
                            <tr>
                                <th><?=system_showText(LANG_LABEL_PRICE)?>:</th>
                                <td><input type="text" name="price_ios" maxlength="10" value="<?=htmlspecialchars($price_ios);?>" /></td>
                            </tr>
                            
                            <tr>
                                <th><?=system_showText(LANG_SITEMGR_MOBILE_TAGLINE)?>:</th>
                                <td><input type="text" name="tagline_ios" maxlength="50" value="<?=htmlspecialchars($tagline_ios);?>" /></td>
                            </tr>
                             */?>
                            
                            <tr>
                                <th>* <?=system_showText(LANG_LABEL_STATUS)?>:</th>
                                <td>
                                    <?=$statusDropDown_ios?>
                                </td>
                            </tr>
                            
                        </table>
                        
                        <button type="button" class="input-button-form" onclick="<?=DEMO_LIVE_MODE ? "livemodeMessage('".system_showText(LANG_SITEMGR_DEMO_MESSAGE)."');" : "JS_submit('ios');"?>"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>

                        <br />
                        <br />
                    
                        <? if ($error_android) { ?>
                            <p class="errorMessage"><?=$error_android?></p>
                        <? } elseif ($success_android) { ?>
                            <p class="successMessage"><?=system_showText(LANG_SITEMGR_MOBILE_SUCCESS);?></p>
                        <? } ?>

                        <table cellpadding="0" cellspacing="0" border="0" class="standard-table">
                            <tr>
                                <th colspan="2" class="standard-tabletitle"><?=system_showText(LANG_SITEMGR_MOBILE_SCREEN_ANDROID)?></th>
                            </tr>
                            
                            <tr>
                                <th><?=(!file_exists(EDIRECTORY_ROOT.IMAGE_SCREEN_ANDROID_PATH) ? "* " : "")?><?=system_showText(LANG_SITEMGR_MOBILE_PHONEIMAGE)?>:</th>
                                <td class="columnFile">
                                    <input type="hidden" name="image[]" id="image" value="2">
                                    <input type="file" id="image2" name="image_android" size="50" onchange="UploadImage('splashScreen', 2);" class="inputExplode" /><span><?=MOBILE_SCREEN_WIDTH?> x <?=MOBILE_SCREEN_HEIGHT?></span>
                                    <?//Crop Tool Inputs?>
                                    <input type="hidden" name="x2" id="x2">
                                    <input type="hidden" name="y2" id="y2">
                                    <input type="hidden" name="x22" id="x22">
                                    <input type="hidden" name="y22" id="y22">
                                    <input type="hidden" name="w2" id="w2">
                                    <input type="hidden" name="h2" id="h2">
                                    <input type="hidden" name="image_width2" id="image_width2">
                                    <input type="hidden" name="image_height2" id="image_height2">
                                    <input type="hidden" name="image_type2" id="image_type2">
                                </td>
                            </tr>
                            
                            <tr>
                                <th>* <?=system_showText(LANG_SITEMGR_MOBILE_STORELINK)?>:</th>
                                <td>
                                    <input type="text" name="storelink_android" value="<?=$storelink_android?>" />
                                    <span>Google Play (Ex: com.myAccount.myApp)</span>
                                </td>
                            </tr>
                            
                            <tr>
                                <th>* <?=system_showText(LANG_SITEMGR_MOBILE_POPTITLE)?>:</th>
                                <td><input type="text" name="popuptitle_android" maxlength="30" value="<?=htmlspecialchars($popuptitle_android);?>" /></td>
                            </tr>
                            
                            <tr>
                                <th><?=system_showText(LANG_LABEL_PRICE)?>:</th>
                                <td><input type="text" name="price_android" maxlength="10" value="<?=htmlspecialchars($price_android);?>" /></td>
                            </tr>
                            
                            <tr>
                                <th><?=system_showText(LANG_SITEMGR_MOBILE_TAGLINE)?>:</th>
                                <td><input type="text" name="tagline_android" maxlength="50" value="<?=htmlspecialchars($tagline_android);?>" /></td>
                            </tr>
                            
                            <tr>
                                <th>* <?=system_showText(LANG_LABEL_STATUS)?>:</th>
                                <td>
                                    <?=$statusDropDown_android?>
                                </td>
                            </tr>
                            
                        </table>
                        
                        <button type="button" class="input-button-form" onclick="<?=DEMO_LIVE_MODE ? "livemodeMessage('".system_showText(LANG_SITEMGR_DEMO_MESSAGE)."');" : "JS_submit('android');"?>"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
                        
                    </form>
                    
                </div>
                

            </div>

        </div>

        <div id="bottom-content">&nbsp;</div>

    </div>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>
