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
	# * FILE: /includes/code/returngallery.php
	# ----------------------------------------------------------------------------------------------------

    $aux_domain_id = $_GET["domain_id"] ? $_GET["domain_id"] : SELECTED_DOMAIN_ID;

    if (!defined("SELECTED_DOMAIN_ID")){
        define("SELECTED_DOMAIN_ID", $aux_domain_id);
    }

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# FORMS DEFINES
	# ----------------------------------------------------------------------------------------------------

	$id = $_GET["id"] ? $_GET["id"] : 0;
	$new_image = $_GET["new_image"];
	$sess = $_GET["sess"];
	$module = $_GET["module"];
	$main = $_GET["main"];
	$level = $_GET["level"];
	$gallery_hash = $_GET["gallery_hash"];

	switch ($module){
        case "blog" :       $thumb_width = IMAGE_BLOG_THUMB_WIDTH;
							$thumb_height = IMAGE_BLOG_THUMB_HEIGHT;
							break;
		case "article" :	$thumb_width = IMAGE_ARTICLE_THUMB_WIDTH;
							$thumb_height = IMAGE_ARTICLE_THUMB_HEIGHT;
							break;
		case "classified" : $thumb_width = IMAGE_CLASSIFIED_THUMB_WIDTH;
							$thumb_height = IMAGE_CLASSIFIED_THUMB_HEIGHT;
							break;
		case "event" :		$thumb_width = IMAGE_EVENT_THUMB_WIDTH;
							$thumb_height = IMAGE_EVENT_THUMB_HEIGHT;
							break;
		case "listing" :	$thumb_width = 'auto';
							$thumb_height = 'auto';
							break;
	}
    
    $hasmain_image = true;
    
    $imagesWritten = 0;
    
    if ($module != "blog") {
        $strLevelObj = ucfirst($module)."Level";
        $levelObj = new $strLevelObj();
        $maxImages = $levelObj->getImages($level);
    }
    
	if ($id) {

		if ($sess == MEMBERS_ALIAS) {
			$by_key = array("id", "account_id");
			$by_value = array(db_formatNumber($id), sess_getAccountIdFromSession());
			$moduleObj = db_getFromDB($module, $by_key, $by_value, 1, "", "object", $aux_domain_id);
		} else {
			$moduleObj = db_getFromDB($module, "id", db_formatNumber($id), 1, "", "object", $aux_domain_id);
		}

		//ListingPending
		$moduleObj->status == "P" ? $moduleObj = new ListingPending($id) : null;

		$moduleObj->extract();
        
        if ($module != "article" && $module != "blog"){
            //Get fields according to level
            unset($array_fields);
            $array_fields = system_getFormFields(ucfirst($module), $moduleObj->getNumber("level"));
            if (is_array($array_fields) && !in_array("main_image", $array_fields)){
                $hasmain_image = false;
            }
        }

		$galleries  = db_getFromDBBySQL("gallery", "SELECT gallery_id FROM Gallery_Item WHERE item_id = ".$id." AND item_type = '$module' ORDER BY id", "array", false, $aux_domain_id);
		$gallery_id = $galleries[0]["gallery_id"];
	} 
	
    if ($module != "blog"){
        $return_code = "<ul>";
    }

	/************************************************************
	 *
	 * Duplicate images showing edit page code commented out
	 *
	 ************************************************************/

	// if ($thumb_id && $hasmain_image) {
	// 	$imageObj = new Image($thumb_id);
        
 //        if ($module != "blog"){
 //            $dbMain = db_getDBObject(DEFAULT_DB, true);
 //            $dbObj = db_getDBObjectByDomainID($aux_domain_id, $dbMain);
 //            $sql = "SELECT thumb_caption FROM Gallery_Image WHERE gallery_id = $gallery_id AND image_default <> 'n' AND thumb_id = $thumb_id ORDER BY id";
 //            $r = $dbObj->query($sql);

 //            while ($row_aux = mysql_fetch_array($r)) {
 //                $altImage = $row_aux["thumb_caption"];
 //                $thumb_caption = system_showTruncatedText($row_aux["thumb_caption"], 40);
 //            }
 //            $imagesWritten++;
 //            if ($imagesWritten % 2 && $imagesWritten != 1) {
 //                $return_code .= "<br clear=\"all\" />";
 //            }

            
 //            $return_code .= "<li class=\"mainImageGallery\">"; // add image code


 //        } else {
 //            $thumb_caption = system_showTruncatedText($thumb_caption, 40);
 //            $altImage = $thumb_caption;
 //        }
        
 //        //add image code
	// 	$return_code .= "<span class=\"galleryImgcenter\">".$imageObj->getTag(true, $thumb_width, $thumb_height, $altImage, true)."</span>";
	// 	$return_code .= "<h5>".$thumb_caption."</h5>";
 //        if ($sess == SITEMGR_ALIAS){
 //            $return_code .= "<a href=\"".DEFAULT_URL."/$sess/uploadimage.php?item_type=$module&level=$level&item_id=".$id."&image_id=".$image_id."&thumb_id=".$thumb_id."&captions=y\" class=\"ImageEditCaptions iframe fancy_window_imgCaptions\">".LANG_LABEL_EDIT_CAPTIONS."</a>";
 //        } else {
 //            $return_code .= "<a href=\"".DEFAULT_URL."/popup/popup.php?domain_id=".SELECTED_DOMAIN_ID."&pop_type=uploadimage&item_type=$module&level=$level&item_id=".$id."&image_id=".$image_id."&thumb_id=".$thumb_id."&captions=y\" class=\"ImageEditCaptions iframe fancy_window_imgCaptions\">".LANG_LABEL_EDIT_CAPTIONS."</a>";
 //        }
 //        $return_code .= "<a href=\"".DEFAULT_URL."/$sess/delete_image.php?item_type=$module&item_id=".$id."\" class=\"ImageDelete iframe fancy_window_imgDelete\" >".LANG_LABEL_DELETE."</a>";
	// 	if ($main != "false"){
	// 		// $return_code .= "<a href=\"javascript:void(0);\" class=\"mainImageLink mainImageLinkBK\" title=\"".LANG_LABEL_CLICKTOSETGALLERYIMAGE."\" onclick=\"changeMain(".$image_id.",".$thumb_id.",".$id.",'n',".$gallery_id.",'$module')\">".LANG_LABEL_MAINIMAGE."</a>";
	// 	}

 //        if ($module != "blog"){
 //        	//add image code
 //            $return_code .= "</li>";
 //        }
	// }

	if ($gallery_id && $module != "blog") {

		$return_code .=	"<input type=\"hidden\" name=\"gallery_id\" id=\"gallery_id\" value=".$gallery_id." />";
		$gallery = new Gallery($gallery_id, $aux_domain_id);

		if ((count($gallery->image) > 0) && ($thumb_id)) {
			$col = 1;
		} else {
			$col = 0;
		}
        
        $totalImages = ($maxImages >= count($gallery->image)) ? count($gallery->image) : $maxImages;

		if (count($gallery->image) > 0) {
			for ($i=0; $i<$totalImages; $i++) {
				if ($col == 0) {
					$return_code .= "";
				}
				$col++;

				$imageObj = new Image($gallery->image[$i]["thumb_id"]);

				$altImage = $gallery->image[$i]["thumb_caption"];
				$thumb_caption = system_showTruncatedText($gallery->image[$i]["thumb_caption"], 40);
                if ($module != "blog"){
                    $imagesWritten++;
                    if ($imagesWritten % 2 && $imagesWritten != 1) {
                        $return_code .= "<br clear=\"all\" />";
                    }
                    $return_code .= "<li  >";
                }
				$return_code .= "<span class=\"galleryImgcenter\">".$imageObj->getTag(true, $thumb_width, $thumb_height, $altImage, true)."</span>";
				$return_code .= "<h5>".$thumb_caption."</h5>";
                if ($sess == SITEMGR_ALIAS){
                    $return_code .= "<span class='imgspan'><a href=\"".DEFAULT_URL."/$sess/uploadimage.php?item_type=$module&level=$level&item_id=".$id."&gallery_id=".$gallery_id."&image_id=".$gallery->image[$i]["image_id"]."&thumb_id=".$gallery->image[$i]["thumb_id"]."&captions=y\" class=\"ImageEditCaptions iframe fancy_window_imgCaptions\">".LANG_LABEL_EDIT_CAPTIONS."</a></span>";
                } else {
                    $return_code .= "<span class='imgspan'><a href=\"".DEFAULT_URL."/sponsors/popup/popup.php?domain_id=".SELECTED_DOMAIN_ID."&pop_type=uploadimage&item_type=$module&level=$level&item_id=".$id."&gallery_id=".$gallery_id."&image_id=".$gallery->image[$i]["image_id"]."&thumb_id=".$gallery->image[$i]["thumb_id"]."&captions=y\" class=\"ImageEditCaptions iframe fancy_window_imgCaptions\">".LANG_LABEL_EDIT_CAPTIONS."</a></span>";
                }
                $return_code .= "<span class='imgspan'><a href=\"".DEFAULT_URL."/$sess/delete_image.php?item_id=".$moduleObj->getNumber("id")."&item_type=$module&gallery_image_id=".$gallery->image[$i]["image_id"]."&gallery_id=".$gallery_id."\" class=\"ImageDelete iframe fancy_window_imgDelete\" >".LANG_LABEL_DELETE."</a></span>";
				if ($main != "false"){
					//$return_code .= "<a href=\"javascript:void(0);\" title=\"".LANG_LABEL_CLICKTOSETMAINIMAGE."\" class=\"mainImageLinkBK\" onclick=\"makeMain(".$gallery->image[$i]["image_id"].",".$gallery->image[$i]["thumb_id"].",".$moduleObj->getNumber("id").",'n','$module')\">".LANG_LABEL_MAKEMAIN."</a>";
				}
                if ($module != "blog"){
                    $return_code .= "</li>";
                }
			}
		}

	}

	if ($new_image == "y"){

		$col = 0;

		$dbMain = db_getDBObject(DEFAULT_DB, true);
		$db = db_getDBObjectByDomainID($aux_domain_id, $dbMain);
		$sess_id = $gallery_hash;

		$sql = "SELECT * FROM Gallery_Temp WHERE sess_id='$sess_id'";
		$r = $db->query($sql);

		
		while ($row = mysql_fetch_array($r)) {
			if ($col == 0) {
					$return_code .= "";
				}
				$col++;

				$imageObj = new Image($row["thumb_id"]);
				$imageObj->force_main = true;
				$altImage = $row["thumb_caption"];
				$thumb_caption = system_showTruncatedText($row["thumb_caption"], 40);
                if ($module != "blog"){
                    $imagesWritten++;
                    if ($imagesWritten % 2 && $imagesWritten != 1) {
                        $return_code .= "<br clear=\"all\" />";
                    }
                    if ($row["image_default"] == 'y') {
                        $return_code .= "<li class=\"mainImageGallery\">";
                    } else {
                        $return_code .= "<li>";
                    }
                }
				$return_code .= "<span class=\"galleryImgcenter\">".$imageObj->getTag(true, $thumb_width, $thumb_height, $altImage, true)."</span>";
				$return_code .= "<h5>".$thumb_caption."</h5>";
				if ($sess == SITEMGR_ALIAS){
                    $return_code .= "<a href=\"".DEFAULT_URL."/$sess/uploadimage.php?temp=y&item_type=$module&level=$level&item_id=".$id."&gallery_id=".$gallery_id."&image_id=".$row["image_id"]."&thumb_id=".$row["thumb_id"]."&captions=y\" class=\"ImageEditCaptions iframe fancy_window_imgCaptions\">".LANG_LABEL_EDIT_CAPTIONS."</a>";
                } else {
                    $return_code .= "<a href=\"".DEFAULT_URL."/sponsors/popup/popup.php?domain_id=".SELECTED_DOMAIN_ID."&pop_type=uploadimage&temp=y&item_type=$module&level=$level&item_id=".$id."&gallery_id=".$gallery_id."&image_id=".$row["image_id"]."&thumb_id=".$row["thumb_id"]."&captions=y\" class=\"ImageEditCaptions iframe fancy_window_imgCaptions\">".LANG_LABEL_EDIT_CAPTIONS."</a>";
                }
                $return_code .= "<a href=\"".DEFAULT_URL."/$sess/delete_image.php?temp=y&item_type=$module&item_id=".$id."&gallery_image_id=".$row["image_id"]."&gallery_id=".$gallery_id."\" class=\"ImageDelete iframe fancy_window_imgDelete\" >".LANG_LABEL_DELETE."</a>";

				if ($main != "false"){
					// if ($row["image_default"] == "n") {
					// 	$return_code .= "<a href=\"javascript:void(0);\" class=\"mainImageLinkBK\" title=\"".LANG_LABEL_CLICKTOSETMAINIMAGE."\" onclick=\"makeMain(".$row["image_id"].",".$row["thumb_id"].",".$id.",'y','$module')\">".LANG_LABEL_MAKEMAIN."</a>";
					// } else {
					// 	$return_code .= "<a href=\"javascript:void(0);\" class=\"mainImageLink mainImageLinkBK\" title=\"".LANG_LABEL_CLICKTOSETGALLERYIMAGE."\" onclick=\"changeMain(".$row["image_id"].",".$row["thumb_id"].",".$id.",'y',0,'$module')\">".LANG_LABEL_MAINIMAGE."</a>";
					// }
                    if ($module != "blog"){
                        $return_code .= "</li>";
                    }
				}
			}
	}

    if ($module != "blog") {
        $return_code .= "</ul>";
    } else {
        if ($return_code == "") {
            $return_code = "no image";
        }
    }

	header("Content-Type: text/html; charset=".EDIR_CHARSET, TRUE);
	header("Accept-Encoding: gzip, deflate");
	header("Expires: Sat, 01 Jan 2000 00:00:00 GMT");
	header("Cache-Control: no-store, no-cache, must-revalidate");
	header("Cache-Control: post-check=0, pre-check", FALSE);
	header("Pragma: no-cache");

	echo $return_code;
?>