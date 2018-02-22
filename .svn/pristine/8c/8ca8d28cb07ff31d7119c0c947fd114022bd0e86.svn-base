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
	# * FILE: /sitemgr/prefs/theme_auto_upload.php
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
    
    $return = "";
    $error = false;

    if (isset($_POST) && $_SERVER["REQUEST_METHOD"] == "POST") {

        if ($_FILES) {
 
            $i = 1;
            $image_errors = array();

            $maxImageSize = ((UPLOAD_MAX_SIZE * 10) + 1)."00000";

            foreach ($_FILES as $key => $value) {

                if (strlen($value["tmp_name"]) > 0) {
                    if (image_upload_check($value["tmp_name"])) {
                        if (strlen($value["name"])) {
                            $_POST[$key] = $value["name"];
                        }
                    } else {
                        $image_errors[] = "&#149;&nbsp; ".system_showText(LANG_SITEMGR_MSGERROR_FILEEXTENSIONNOTALLOWED);
                    }	

                    if ($value["size"] > $maxImageSize) {
                        $image_errors[] = "&#149;&nbsp; ".system_showText(LANG_SITEMGR_MSGERROR_MAXFILESIZEALLOWEDIS." ".UPLOAD_MAX_SIZE."MB.");
                    }
                }
                $i++;
            }
            
            if (count($image_errors) == 0) {
                if ($_FILES["file_background_image"]["error"] == 0) {

                   $imageObj = image_upload($_FILES["file_background_image"]["tmp_name"], IMAGE_THEME_BACKGROUND_W, IMAGE_THEME_BACKGROUND_H, 'sitemgr_', false);
                    if ($imageObj) {
                        $return = "<input type='hidden' name='background_image_id' value='".$imageObj->getNumber("id")."' />";
                        $return .= $imageObj->getTag();
                    }
                    
                } else {
                    $error = true;
                    $return = system_showText(LANG_MSGERROR_ERRORUPLOADINGIMAGE);
                }        
            } else {
                $error = true;
                foreach ($image_errors as $imgError) {
                    $return .= $imgError."<br />";
                }
            }

         } else {
             $error = true;
             $return = system_showText(LANG_SITEMGR_IMAGE_EMPTY);
         }
    }
    
    echo ($error ? "error" : "ok")."||".$return;
?>