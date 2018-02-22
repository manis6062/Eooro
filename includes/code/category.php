<?php

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
	# * FILE: /includes/code/category.php
	# ----------------------------------------------------------------------------------------------------

	####################################################################################################
	### PAY ATTENTION - SAME CODE FOR LISTING, EVENT, CLASSIFIED, ARTICLE AND BLOG
	####################################################################################################

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	if ($_POST["title"]) {
		$_POST["title"] = trim($_POST["title"]);
		$_POST["title"] = preg_replace('/\s\s+/', ' ', $_POST["title"]);
	}
	
	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	if ($_SERVER['REQUEST_METHOD'] == "POST") {

		if ($_POST["seo_description"]) $_POST["seo_description"] = str_replace('"', '', $_POST["seo_description"]);
        if ($_POST["seo_keywords"]) $_POST["seo_keywords"] = str_replace('"', '', $_POST["seo_keywords"]);

		if (validate_form("category", $_POST, $message_category) && ($upload_image != "failed")) {
            
            $upload_image = "no image";
            $category = new $_POST["table_category"]($id);

            //Clean Image
            if ($remove_image) {
                if ($idm = $category->getNumber("image_id")) {
                    $image = new Image($idm);
                    if ($image) {
                        $image->Delete();
                    }
                }
                if ($idm = $category->getNumber("thumb_id")) {
                    $image = new Image($idm);
                    if ($image) {
                        $image->Delete();
                    }
                }
            }
            
            // Image Crop
            if ($_POST["image_type"] != "") {

                // TYPES
                //1 = GIF, 2 = JPG, 3 = PNG, 4 = SWF, 5 = PSD, 6 = BMP, 7 = TIFF(intel byte order), 8 = TIFF(motorola byte order),
                //9 = JPC, 10 = JP2, 11 = JPX, 12 = JB2, 13 = SWC, 14 = IFF, 15 = WBMP, 16 = XBM
                $user_id = $_COOKIE["PHPSESSID"];
                $dir = EDIRECTORY_ROOT . "/custom/domain_" . SELECTED_DOMAIN_ID . "/image_files/";
                $files = glob("$dir/_0_" . $user_id . "_*.*");
                switch ($_POST["image_type"]) {
                    case 1:
                        $img_type = 'gif';
                        $img_r = imagecreatefromgif($files[0]);
                        break;
                    case 2:
                        $img_type = 'jpeg';
                        $img_r = imagecreatefromjpeg($files[0]);
                        break;
                    case 3:
                        $img_type = 'png';
                        $img_r = imagecreatefrompng($files[0]);
                        break;
                }

                $dst_r = ImageCreateTrueColor($_POST['w'], $_POST['h']);

                if ($img_r) {
                    $lowQuality = false;
                    if ($img_type == "png" || $img_type == "gif") {
                        imagealphablending($dst_r, false);
                        imagesavealpha($dst_r, true);
                        $transparent = imagecolorallocatealpha($dst_r, 255, 255, 255, 127);
                        imagefill($dst_r, 0, 0, $transparent);
                        imagecolortransparent($dst_r, $transparent);
                        $transindex = imagecolortransparent($img_r);
                        if ($transindex >= 0) {
                            $lowQuality = true; //only use imagecopyresized (low quality) if the image is a transparent gif
                        }
                    }

                    if ($img_type == "gif" && $lowQuality) { //use imagecopyresized for gif to keep the transparency. The functions imagecopyresized and imagecopyresampled works in the same way with the exception that the resized image generated through imagecopyresampled is smoothed so that it is still visible.
                        //low quality
                        imagecopyresized($dst_r, $img_r, 0, 0, $_POST["x"], $_POST["y"], $_POST["w"], $_POST["h"], $_POST["w"], $_POST["h"]);
                    } else {
                        //better quality
                        imagecopyresampled($dst_r, $img_r, 0, 0, $_POST["x"], $_POST["y"], $_POST["w"], $_POST["h"], $_POST["w"], $_POST["h"]);
                    }
                }

                if ((FORCE_SAVE_JPG_AS_PNG == "on") && ($img_type == "jpeg")) {                    
                    $crop_image = $dir . "crop_image.png";
                } else {
                    $crop_image = $dir . "crop_image.$img_type";
                }
                if ($img_type == 'gif') {
                    imagegif($dst_r, $crop_image);
                } elseif ($img_type == 'jpeg') {
                    if (FORCE_SAVE_JPG_AS_PNG == "on") {
                        imagepng($dst_r, $crop_image);                        
                    } else {
                        imagejpeg($dst_r, $crop_image);
                    }
                } elseif ($img_type == 'png') {
                    imagepng($dst_r, $crop_image);
                }

                //removing image files
                foreach ($files as $file)
                    unlink($file);
                if ((file_exists($_FILES['image']['tmp_name']) || file_exists($crop_image)) && (!$crop_submit)) {
                    $imageArray = image_uploadForItem((($crop_image) ? $crop_image : $_FILES['image']['tmp_name']), "sitemgr_", IMAGE_CATEGORY_FULL_WIDTH, IMAGE_CATEGORY_FULL_HEIGHT, IMAGE_CATEGORY_THUMB_WIDTH, IMAGE_CATEGORY_THUMB_HEIGHT);
                    if ($imageArray["success"]) {
                        $upload_image = "success";
                        $remove_image = false;
                    } else {
                        $upload_image = "failed";
                    }
                }
            }
            
            //Saving category
            if ($upload_image != "failed" && !$crop_submit) {
            
                $_POST["featured"] = ($_POST["featured"] == "on" ? "y" : "n");
                $_POST["enabled"] = ($_POST["clickToDisable"] == "on" ? "n" : "y");

                $category->makeFromRow($_POST);
                
                if ($upload_image == "success") {
                    $category->updateImage($imageArray);
                }

                if ($remove_image) {
                    $category->setNumber("image_id", 0);
                    $category->setNumber("thumb_id", 0);
                }
                
                if (string_strlen($keywords)=="") $category->setString("keywords", "");

                if ($category_id && $_POST["featured"] && count($category->getFullPath()) == 2) {
                    $dbMain = db_getDBObject(DEFAULT_DB, true);
                    $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
                    $sql = "SELECT featured FROM ".$_POST["table_category"]." WHERE id = $category_id";
                    $result = $dbObj->query($sql);
                    $row = mysql_fetch_assoc($result);
                    $father_featured = $row["featured"];
                    if ($father_featured == 'n') {
                        $featuredMessage = 8;
                    }
                }

                $category->Save();
                
                //Updating items fulltext fields
                if (@constant(string_strtoupper($_POST["table_category"])."_SCALABILITY_OPTIMIZATION") != 'on' && @constant(string_strtoupper(str_replace("Category", "", $_POST["table_category"]))."_SCALABILITY_OPTIMIZATION") != 'on') {
                    $category->updateFullTextItems();
                }

                if ($category->getNumber("active_".string_strtolower(str_replace("Category", "", $_POST["table_category"]))) > 0 && $_POST["clickToDisable"]) {
                    $messageItems = true;
                }

                if ($_POST["category_id"]) {
                    if ($_POST["id"]) {
                        $message = 2;
                        if ($_POST["clickToDisable"]){
                            $langMessage = 6;
                        }
                    } else {
                        $message = 3;
                        if ($_POST["clickToDisable"]){
                            $langMessage = 6;
                        }
                    }
                } else { 
                    if ($_POST["id"]) {
                        $message = 4;
                        if ($_POST["clickToDisable"]){
                            $langMessage = 7;
                        }
                    } else {
                        $message = 5;
                        if ($_POST["clickToDisable"]){
                            $langMessage = 7;
                        }
                    }
                }

                if ($messageItems) {
                    if ($langMessage == 7) {
                        $langMessage = 9;
                    }
                }

                header("Location: $url_redirect/".(($search_page) ? "search.php" : "index.php")."?message=".$message."&langmessage=".$langMessage."&featmessage=".$featuredMessage."&category_id=".$category_id."&screen=$screen&letter=$letter".(($url_search_params) ? "&$url_search_params" : ""));
                exit;
            } else if ($upload_image == "failed") {
                $message_category .= system_showText(LANG_MSG_INVALID_IMAGE_TYPE);
            }

		}

		// removing slashes added if required
		$_POST = format_magicQuotes($_POST);
		$_GET = format_magicQuotes($_GET);
		extract($_POST);
		extract($_GET);

	} 

	# ----------------------------------------------------------------------------------------------------
	# FORMS DEFINES
	# ----------------------------------------------------------------------------------------------------
	if ($id) {
		$category = db_getFromDB(string_strtolower($table_category), "id", $id, 1, "", "object", SELECTED_DOMAIN_ID);
		$category->extract();
		$featured = ($featured == "y" ? "on" : "");
		$enabled = ($enabled == "y" ? "on" : "");
	} else {
        $enabled = ($_POST["clickToDisable"] == "on" ? "" : "on");
		$featured = "new";
	}

	extract($_POST);
	extract($_GET);

    $fatherCategoryArray = db_getFromDB(string_strtolower($table_category), "id", $category_id, 1, "", "array", SELECTED_DOMAIN_ID, false, "`id`, `title`");

	$featuredcategory = "";
	if (FEATURED_CATEGORY == "on") {
		setting_get(string_strtolower(str_replace("Category", "", $table_category))."_featuredcategory", $featuredcategory);
		if ($featuredcategory) {
			
			$dbMain = db_getDBObject(DEFAULT_DB, true);
			$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);

			$cat_level = 0;
			$category_id_aux = $fatherCategoryArray["id"];
			while($category_id_aux != 0) {
				$sql = "SELECT category_id FROM $table_category WHERE id = $category_id_aux";
				$result = $dbObj->query($sql);
				$row = mysql_fetch_assoc($result);
				$category_id_aux = $row["category_id"];
				$cat_level++;
			}

			if ($cat_level >= FEATUREDCATEGORY_LEVEL_AMOUNT) {
				$featuredcategory = "";
            }
		}
	}
?>