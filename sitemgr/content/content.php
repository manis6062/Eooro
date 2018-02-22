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
	# * FILE: /sitemgr/content/content.php
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
	# CODE
	# ----------------------------------------------------------------------------------------------------

	extract($_GET);
	extract($_POST);
	
	if ($id) {
		
		// getting the section and type from Content table
		$auxContent = new Content($id);
        
        $blockedContent = unserialize(SITECONTENT_BLOCKED);
        if (in_array($auxContent->getString("type"), $blockedContent)) {
            header("Location: ".DEFAULT_URL."/".SITEMGR_ALIAS."/");
            exit;
        }

		if (($auxContent->getString("section") == "article") || ($auxContent->getString("section") == "advertise_article")){
			if (ARTICLE_FEATURE != "on" || CUSTOM_ARTICLE_FEATURE != "on"){
				header("Location: ".DEFAULT_URL."/".SITEMGR_ALIAS."/");
				exit;
			}
		}
        if (($auxContent->getString("section") == "blog")){
			if (BLOG_FEATURE != "on" || CUSTOM_BLOG_FEATURE != "on"){
				header("Location: ".DEFAULT_URL."/".SITEMGR_ALIAS."/");
				exit;
			}
		}
		if (($auxContent->getString("section") == "event") || ($auxContent->getString("section") == "advertise_event")){
			if (EVENT_FEATURE != "on" || CUSTOM_EVENT_FEATURE != "on"){
				header("Location: ".DEFAULT_URL."/".SITEMGR_ALIAS."/");
				exit;
			}
		}
		if (($auxContent->getString("section") == "classified") || ($auxContent->getString("section") == "advertise_classified")){
			if (CLASSIFIED_FEATURE != "on" || CUSTOM_CLASSIFIED_FEATURE != "on"){
				header("Location: ".DEFAULT_URL."/".SITEMGR_ALIAS."/");
				exit;
			}
		}

		$contentObj = new Content($_REQUEST["id"]);
		if (($_SERVER['REQUEST_METHOD'] == "POST") && (!DEMO_LIVE_MODE)) {

            $errorMessage = "";
             
            //Save contact info
            if (THEME_CONTACTUS_FIELDS && $contentObj->getString("type") == "Contact Us") {
                
                if ($contact_email) {
                    if (!validate_email($contact_email)) {
                        $errorMessage = "&#149;&nbsp;".system_showText(LANG_MSG_ENTER_VALID_EMAIL_ADDRESS);
                    }
                }
                
                if (!$errorMessage) {
                
                    $contactInfo = array(
                        "contact_address",
                        "contact_zipcode",
                        "contact_country",
                        "contact_state",
                        "contact_city",
                        "contact_phone",
                        "contact_email",
                        "contact_mapzoom",
                        "contact_latitude",
                        "contact_longitude"
                    );

                    foreach ($contactInfo as $info) {
                        if (!setting_set($info, $$info)) {
                            if (!setting_new($info, $$info)) {
                                $error = true;
                            }
                        }
                    }
                }
            }
            
            if ($contentObj->getString("type") == "Home Page") {
                
                /*
                * Twitter Widget
                */
                if (!setting_set("twitter_widget", $twitter_widget)) {
                    if (!setting_new("twitter_widget", $twitter_widget)) {
                        $error = true;
                    }
                }

                if (THEME_HOMEPAGE_FIELDS) {
                    $upload_image = "no image";

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
                                if($transindex >= 0) {
                                    $lowQuality = true; //only use imagecopyresized (low quality) if the image is a transparent gif
                                }
                            }

                            if ($img_type == "gif" && $lowQuality) { //use imagecopyresized for gif to keep the transparency. The functions imagecopyresized and imagecopyresampled works in the same way with the exception that the resized image generated through imagecopyresampled is smoothed so that it is still visible.
                                //low quality
                                imagecopyresized($dst_r, $img_r, 0, 0, $_POST["x"], $_POST["y"], $_POST["w"], $_POST["h"], $_POST["w"], $_POST["h"]
                                );
                            } else {
                                //better quality
                                imagecopyresampled($dst_r, $img_r, 0, 0, $_POST["x"], $_POST["y"], $_POST["w"], $_POST["h"], $_POST["w"], $_POST["h"]
                                );
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
                            if(FORCE_SAVE_JPG_AS_PNG == "on"){
                                imagepng($dst_r, $crop_image);                        
                            }else{
                                imagejpeg($dst_r, $crop_image);
                            }
                        } elseif ($img_type == 'png') {
                            imagepng($dst_r, $crop_image);
                        }

                        //removing image files
                        foreach ($files as $file) {
                            unlink($file);
                        }

                    }

                    if ((file_exists($_FILES['image']['tmp_name']) || file_exists($crop_image) || $remove_image) && (!$crop_submit)) {
                        $image_upload = image_uploadForSitemgr(EDIRECTORY_ROOT.IMAGE_TESTIMONIAL_PATH, ($crop_image ? $crop_image : $_FILES['image']['tmp_name']), $remove_image);
                    }

                    if ($upload_image != "failed" && !$crop_submit) {

                        $frontInfo = array(
                            "front_text_top",
                            "front_text_sidebar",
                            "front_text_sidebar2",
                            "front_testimonial",
                            "front_testimonial_author",
                            "front_itunes_url",
                            "front_gplay_url",
                            "front_review_counter"
                        );

                        foreach ($frontInfo as $info) {
                            if (!setting_set($info, $$info)) {
                                if (!setting_new($info, $$info)) {
                                    $error = true;
                                }
                            }
                        }

                    }
                }
                
            }
            
            //Save home page extra content info
            if (!$errorMessage && $upload_image != "failed" && !$crop_submit) {
            
                $description = str_replace('"', '', $_POST["description"]);
                $keywords = str_replace('"', '', $_POST["keywords"]);

                $contentObj->setString("title", trim($title));
                $contentObj->setString("description", trim($description));
                $contentObj->setString("keywords", trim($keywords));
                $contentObj->setString("content", $content_html);
                $contentObj->Save();
                $id = $contentObj->getNumber("id");
                $message = 0;

                header("Location:".DEFAULT_URL."/".SITEMGR_ALIAS."/content/content.php?id=$id&message=$message");
                exit;
                
            }
		}
	} else {
		header("Location: ".DEFAULT_URL."/".SITEMGR_ALIAS."/content/");
		exit;
	}
    
    $allowContent = true;
    
    $blockedContent = unserialize(SITECONTENT_FORSEO);
    if (in_array($auxContent->getString("type"), $blockedContent)) {
        $allowContent = false;
    }
    $contentLabel = string_strtoupper($auxContent->getString("type"));
    $contentLabel = str_replace(" ", "_", $contentLabel);
    setting_get("twitter_widget", $twitter_widget);

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
    <!--

    function JS_submit() {
        $("#submit_button").attr("value", 1);
        document.content.submit();
    }

    -->
    </script>

    <div id="main-right">

        <div id="top-content">
            <div id="header-content">
                <h1><?=string_ucwords(system_showText(LANG_SITEMGR_CONTENT_MANAGECONTENT))?></h1>
            </div>
        </div>

        <div id="content-content">

            <?
            require(EDIRECTORY_ROOT."/".SITEMGR_ALIAS."/registration.php");
            require(EDIRECTORY_ROOT."/includes/code/checkregistration.php");
            require(EDIRECTORY_ROOT."/frontend/checkregbin.php");
            ?>
            
            <form name="content" id="content" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post" enctype="multipart/form-data">

                <input name="id" type="hidden" value="<?=$id?>" />

                <div class="default-margin">

                    <ul class="list-view">
                        <?
                        $backPage = "index.php";
                        if ($auxContent->getString("section") != "general" && string_strpos($auxContent->getString("section"), 'advertise_') === false) $backPage = $auxContent->getString("section").".php";
                        else if (string_strpos($auxContent->getString("section"), 'advertise_') !== false) $backPage = "advertisement.php";
                        ?>
                        <li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/content/<?=$backPage?>"><?=system_showText(LANG_SITEMGR_BACK)?></a></li>
                    </ul>

                    <br />

                    <div id="header-export">
                        <?=system_showText(constant("LANG_SITEMGR_CONTENT_".$contentLabel))?>
                    </div>

                    <? if (is_numeric($message)) { ?>
                        <p class="successMessage"><?=$msg_content[$message]?></p>
                    <? } elseif ($errorMessage) { ?>
                        <p class="errorMessage"><?=$errorMessage?></p>
                    <? } ?>

                </div>

                <table cellpadding="0" cellspacing="0" border="0" class="standard-table">

                    <? if ($auxContent->getString("type") == "Home Page") { ?>
                    
                    <tr>
                        <th><?=system_showText(LANG_LABEL_TWITTER_WIDGET)?>:</th>
                        <td>
                            <textarea name="twitter_widget" style="width:630px"><?=$twitter_widget;?></textarea>
                            <span><a href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/faq/faq.php?keyword=twitter"?>" target="_blank"><?=system_showText(LANG_SITEMGR_TWITTERTIP);?></a></span>
                        </td>
                    </tr>
                    
                    <? } ?>
                    
                    <? if ((($auxContent->getString("section") == "general") || (string_strpos($auxContent->type, "Advertisement") === false)) 
                    && (string_strpos($auxContent->type, "Bottom") === false) && (string_strpos($auxContent->type, "Terms") === false) && ($auxContent->getString("section") != "member") && (string_strpos($auxContent->type,"Packages") === false )) { ?>
                        <tr>
                            <th colspan="2" class="standard-tabletitle">
                                <?=system_showText(LANG_SITEMGR_CONTENT_SEOCENTER)?>
                            </th>
                        </tr>
                        <tr>
                            <th><?=system_showText(LANG_SITEMGR_TITLE)?>:</th>
                            <td><input type="text" name="title" value="<?=$contentObj->title?>" maxlength="100" /></td>
                        </tr>
                        <tr>
                            <th><?=system_showText(LANG_SITEMGR_LABEL_DESCRIPTION)?>:</th>
                            <td>
                                <textarea id="description" name="description" rows="5"><?=$contentObj->description?></textarea>

                            </td>
                        </tr>
                        <tr>
                            <th><?=system_showText(LANG_SITEMGR_LABEL_KEYWORDS)?>:</th>
                            <td>
                                <textarea id="keywords" name="keywords" rows="5"><?=$contentObj->keywords?></textarea>
                            </td>
                        </tr>
                    <? } ?>

                </table>
                
                <? if (THEME_CONTACTUS_FIELDS && $auxContent->getString("type") == "Contact Us") {
                
                    include(EDIRECTORY_ROOT."/".SITEMGR_ALIAS."/content/content_contactus.php");
                
                }
                
                if ($allowContent) { ?>

                <table cellpadding="0" cellspacing="0" border="0" class="standard-table">
                    <tr>
                        <th colspan="2" class="standard-tabletitle">
                            <?=string_ucwords(system_showText(LANG_SITEMGR_CONTENT))?>
                        </th>
                    </tr>
                </table>

                <table width="650" class="standard-table">
                    <tr>
                        <td colspan="2">
                            <p><strong><?=system_showText(LANG_SITEMGR_LABEL_NOTE)?>1:</strong>&nbsp;<?=system_showText(LANG_SITEMGR_ADDING_HIPERLINK_EDITOR)?></p>
                            <p><strong><?=system_showText(LANG_SITEMGR_LABEL_NOTE)?>2:</strong>&nbsp;<?=system_showText(LANG_SITEMGR_ADDING_EMBED_EDITOR)?></p>
                        </td>
                    </tr>
                    <tr>
                        <td class="packageEditor" colspan="2">
                            <? // TinyMCE Editor Init
                                // getting content
                                $content = $contentObj->getString("content", false);
                                //fix ie bug with images
                                if (!$content) $content = "&nbsp;".$content;
                                // calling TinyMCE
                                system_addTinyMCE("", "exact", "advanced", "content_html", "30", "25", "100%", $content);
                            ?>
                        </td>
                    </tr>
                </table>
                
                <? }
                
                if (THEME_HOMEPAGE_FIELDS && $auxContent->getString("type") == "Home Page") {
                
                    include(EDIRECTORY_ROOT."/".SITEMGR_ALIAS."/content/content_homepage.php");
                
                }
                
                ?>

                <table style="margin: 0 auto 0 auto;">
                    <tr>
                        <td><button type="button" name="Save" value="Save" class="input-button-form" onclick="<?=DEMO_LIVE_MODE ? "livemodeMessage('".system_showText(LANG_SITEMGR_THEME_DEMO_MESSAGE2)."');" : "JS_submit();"?>"><?=system_showText(LANG_SITEMGR_SAVE)?></button></td>
                    </tr>
                </table>

            </form>

        </div>

        <div id="bottom-content">&nbsp;</div>

    </div>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>

    <script type="text/javascript">

        var arrFields = ('description,keywords').split(',');

        $(document).ready(function(){

            for (j=0;j<arrFields.length;j++) {
                i = arrFields[j];
                var field_name = i;
                var count_field_name = 'remLen'+i;

                var options = {
                            'maxCharacterSize': 250,
                            'originalStyle': 'originalTextareaInfo',
                            'warningStyle' : 'warningTextareaInfo',
                            'warningNumber': 40,
                            'displayFormat' : '<span><input readonly="readonly" type="text" id="'+count_field_name+'" name="'+count_field_name+'" size="3" maxlength="3" value="#left" class="textcounter" disabled="disabled" /> <?=system_showText(LANG_MSG_CHARS_LEFT)?> <?=system_showText(LANG_MSG_INCLUDING_SPACES_LINE_BREAKS)?></span>' 
                    };
                $('#'+field_name).textareaCount(options);

            }

        });
    </script>