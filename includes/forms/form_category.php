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
	# * FILE: /includes/forms/form_category.php
	# ----------------------------------------------------------------------------------------------------

	####################################################################################################
	### PAY ATTENTION - SAME CODE FOR LISTING, EVENT, CLASSIFIED, ARTICLE AND BLOG
	####################################################################################################

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------

	switch($table_category){
		case "ArticleCategory"      :	$default_url = ARTICLE_DEFAULT_URL;
                                        $module_label = LANG_SITEMGR_ARTICLE_PLURAL;
                                        break;
		case "ClassifiedCategory"   :   $default_url = CLASSIFIED_DEFAULT_URL;
                                        $module_label = LANG_SITEMGR_CLASSIFIED_PLURAL;
                                        break;
		case "EventCategory"        :	$default_url = EVENT_DEFAULT_URL;
                                        $module_label = LANG_SITEMGR_EVENT_PLURAL;
                                        break;
		case "ListingCategory"      :	$default_url = LISTING_DEFAULT_URL;
                                        $module_label = LANG_SITEMGR_LISTING_PLURAL;
                                        break;
        case "BlogCategory"         :	$default_url = BLOG_DEFAULT_URL;
                                        $module_label = LANG_SITEMGR_BLOG;
                                        break;
	}

    if (!THEME_CATEGORY_DESCRIPTION || $table_category != "ListingCategory") { ?>
        <script type="text/javascript" src="<?=DEFAULT_URL?>/includes/tiny_mce/tiny_mce_src.js"></script>
    <? } ?>

    <script type="text/javascript">

        function system_displayTinyMCEJS(txId) {
            tinyMCE.execCommand('mceAddControl', false, txId);
        }

        function enableCategory(){
            if ($('#clickToDisable').attr('checked') != ''){
                $('#categoryContent').hide();
            } else {
                $('#categoryContent').show();
                <? if (!THEME_CATEGORY_DESCRIPTION || $table_category != "ListingCategory") { ?>
                system_displayTinyMCEJS('content');
                <? } ?>
            }
        }

        $(document).ready(function(){
            $('#title').blur(function() {
                $('#page_title').attr('value', $('#title').val());
            });

            var field_name = 'seo_description';
            var field_name2 = 'seo_keywords';
            var count_field_name = 'seo_description_remLen';
            var count_field_name2 = 'seo_keywords_remLen';

            var options = {
                        'maxCharacterSize': 250,
                        'originalStyle': 'originalTextareaInfo',
                        'warningStyle' : 'warningTextareaInfo',
                        'warningNumber': 40,
                        'displayFormat' : '<span><input readonly="readonly" type="text" id="'+count_field_name+'" name="'+count_field_name+'" size="3" maxlength="3" value="#left" class="textcounter" disabled="disabled" /> <?=system_showText(LANG_MSG_CHARS_LEFT)?> <?=system_showText(LANG_MSG_INCLUDING_SPACES_LINE_BREAKS)?></span>' 
                };

            var options2 = {
                        'maxCharacterSize': 250,
                        'originalStyle': 'originalTextareaInfo',
                        'warningStyle' : 'warningTextareaInfo',
                        'warningNumber': 40,
                        'displayFormat' : '<span><input readonly="readonly" type="text" id="'+count_field_name2+'" name="'+count_field_name2+'" size="3" maxlength="3" value="#left" class="textcounter" disabled="disabled" /> <?=system_showText(LANG_MSG_CHARS_LEFT)?> <?=system_showText(LANG_MSG_INCLUDING_SPACES_LINE_BREAKS)?></span>' 
                };
                
            

            $('#'+field_name).textareaCount(options);
            $('#'+field_name2).textareaCount(options2);
            
            <? if (THEME_CATEGORY_DESCRIPTION && $table_category == "ListingCategory") { ?>
            var field_name3 = 'summary_description';
            var count_field_name3 = 'summary_description_remLen';
            
            var options3 = {
                        'maxCharacterSize': 250,
                        'originalStyle': 'originalTextareaInfo',
                        'warningStyle' : 'warningTextareaInfo',
                        'warningNumber': 40,
                        'displayFormat' : '<span><input readonly="readonly" type="text" id="'+count_field_name3+'" name="'+count_field_name3+'" size="3" maxlength="3" value="#left" class="textcounter" disabled="disabled" /> <?=system_showText(LANG_MSG_CHARS_LEFT)?> <?=system_showText(LANG_MSG_INCLUDING_SPACES_LINE_BREAKS)?></span>' 
                };
                
            $('#'+field_name3).textareaCount(options3);
            <? } ?>


        });

    </script>

    <input type="hidden" name="table_category" value="<?=$table_category;?>" />

    <table cellpadding="0" cellspacing="0" border="0" class="standard-table nomargin">
        <tr>
            <th colspan="2" class="standard-tabletitle">
                <?=system_showText(LANG_SITEMGR_CATEGORY_INFORMATION)?>
            </th>
        </tr>
        <? if ($category_id && $category_id != 0) { ?>
            <tr>
                <th>
                    <?=system_showText(LANG_SITEMGR_CATEGORY_FATHERCATEGORY)?>:
                </th>
                <td>
                    <span style="font-size:12px"><strong><?=$fatherCategoryArray["title"]?></strong></span>
                    <input type="hidden" name="category_id" value="<?=$fatherCategoryArray["id"]?>" />
                </td>
            </tr>
        <? } else { ?>
            <input type="hidden" name="category_id" id="category_id" value="<?=$category_id?>" />
        <? } ?>

        <? if ($featuredcategory) { ?>
            <tr>
                <th>
                    <?=system_showText(LANG_SITEMGR_FEATURED)?>:
                </th>
                <td>
                    <input type="checkbox" id="featured" name="featured" class="inputCheck" <?=($featured == "on" || $featured == "new") ? "checked" : "" ?>><span><?=system_showText(LANG_SITEMGR_FEATUREDCATEGORY_CHECKEDINFO)?></span>
                </td>
            </tr>
        <? } else { ?>
            <input type="hidden" name="featured" value="<?=$featured?>" />
        <? } ?>

        <tr>
            <th>
                <?=system_showText(LANG_SITEMGR_DISABLE_CATEGORY)?>:
            </th>
            <td>
                <input type="checkbox" id="clickToDisable" name="clickToDisable" class="inputCheck" <?=($enabled == "on") ? "" : "checked" ?> onclick="enableCategory();">
            </td>
        </tr>
    </table>

    <div id="categoryContent">
        <table cellpadding="0" cellspacing="0" border="0" class="standard-table">
            <tr>
                <th>* <?=system_showText(LANG_SITEMGR_TITLE)?>:</th>
                <td>
                    <input type="text" id="title" name="title" class="input-form" value="<?=$title;?>" onblur="easyFriendlyUrl(this.value, 'friendly_url', '<?=FRIENDLYURL_VALIDCHARS?>', '<?=FRIENDLYURL_SEPARATOR?>');" />
                    <span><?=system_showText(LANG_SITEMGR_CATEGORY_INFOTEXT1)?></span>
                </td>
            </tr>
        </table>

        <? if (THEME_CATEGORY_IMAGE && $table_category == "ListingCategory") { ?>

        <table border="0" cellpadding="0" cellspacing="0" class="standard-table">
            <tr>
                <th colspan="2" class="standard-tabletitle">
                    <?=system_showText(LANG_LABEL_IMAGE)?><span> (<?=IMAGE_CATEGORY_FULL_WIDTH;?>px x <?=IMAGE_CATEGORY_FULL_HEIGHT;?>px) (JPG, GIF <?=system_showText(LANG_OR);?> PNG)</span>
                </th>
            </tr>

            <?
            if ($thumb_id) {
                $imageObj = new Image($thumb_id);
                if ($imageObj->imageExists()) { ?>
                    <tr>
                        <th>&nbsp;</th>
                        <td class="image-space" colspan="2">
                            <?=$imageObj->getTag(true, IMAGE_CATEGORY_THUMB_WIDTH, IMAGE_CATEGORY_THUMB_HEIGHT, $title);?>
                        </td>
                    </tr>
            <? }
            }

            include(EDIRECTORY_ROOT."/includes/code/thumbnail.php");

            if ($thumb_id) { ?>
                <tr>
                    <th>&nbsp;</th>
                    <td align="left">
                    <input type="checkbox" name="remove_image" class="inputCheck" value="1" style="vertical-align:middle;" /> <?=system_showText(LANG_MSG_CHECK_TO_REMOVE_IMAGE)?>
                    </td>
                </tr>
            <? } ?>

            <tr>
                <th><?=system_showText(LANG_LABEL_IMAGE_SOURCE)?>:</th>
                <td class="columnFile">
                    <input type="file" name="image" id="image" size="50" onchange="UploadImage('category');" class="inputExplode" /><span><?=system_showText(LANG_MSG_MAX_FILE_SIZE)?> <?=UPLOAD_MAX_SIZE;?> MB. <?=system_showText(LANG_MSG_ANIMATEDGIF_NOT_SUPPORTED);?></span>
                    <input type="hidden" name="image_id" value="<?=$image_id?>" />
                    <?//Crop Tool Inputs?>
                    <input type="hidden" name="x" id="x">
                    <input type="hidden" name="y" id="y">
                    <input type="hidden" name="x2" id="x2">
                    <input type="hidden" name="y2" id="y2">
                    <input type="hidden" name="w" id="w">
                    <input type="hidden" name="h" id="h">
                    <input type="hidden" name="image_width" id="image_width">
                    <input type="hidden" name="image_height" id="image_height">
                    <input type="hidden" name="image_type" id="image_type">
                    <input type="hidden" name="crop_submit" id="crop_submit">
                </td>
            </tr>
        </table>

        <? } ?>
        
        <? if (THEME_CATEGORY_DESCRIPTION && $table_category == "ListingCategory") { ?>
        
        <table cellpadding="0" cellspacing="0" border="0" class="standard-table">

            <tr>
                <th colspan="2" class="standard-tabletitle">
                    <?=system_showText(LANG_LABEL_SUMMARY_DESCRIPTION)?> <span>(<?=string_strtolower(system_showText(LANG_MSG_MAX_250_CHARS))?>)</span>
                </th>
            </tr>
            <tr>
                <td style="text-align:center">
                    <textarea id="summary_description" name="summary_description" rows="5" cols="1"><?=$summary_description;?></textarea>
                </td>
            </tr>

        </table>
        
        <? } ?>

        <table cellpadding="0" cellspacing="0" border="0" class="standard-table">
            <tr>
                <th colspan="2" class="standard-tabletitle">
                    <?=system_showText(LANG_SITEMGR_KEYWORDSFORTHESEARCH)?>
                </th>
            </tr>
            <tr>
                <th style="width: 350px;">
                    <span class="label-login">
                        <p>
                            <?=system_showText(LANG_SITEMGR_ADDONEKEYWORDPERLINE)?>. <?=system_showText(LANG_SITEMGR_FOREXAMPLE)?>:
                        </p>
                    </span>
                </th>
                <th style="width: 350px;">
                    <span class="label-login">
                        <p style="text-align: justify;">
                            <?=system_showText(LANG_SITEMGR_KEYWORD_SAMPLE_1)?><br />
                            <?=system_showText(LANG_SITEMGR_KEYWORD_SAMPLE_2)?><br />
                            <?=system_showText(LANG_SITEMGR_KEYWORD_SAMPLE_3)?><br />
                        </p>
                    </span>
                </th>
            </tr>
            <tr>
                <td colspan=2 style="text-align:center">
                    <textarea name="keywords" rows="5" cols="1"><?=$keywords;?></textarea>
                </td>
            </tr>
        </table>

        <table cellpadding="0" cellspacing="0" border="0" class="standard-table">
            <tr>
                <th colspan="2" class="standard-tabletitle">
                    <?=string_ucwords(system_showText(LANG_SITEMGR_CONTENT_SEOCENTER))?>
                </th>
            </tr>
            <tr>
                <td colspan="2">
                    <table class="categoryExampleTable">
                        <tr>
                            <td class="categoryExampleLine">
                                <p style="text-align: justify;">
                                    <?=system_showText(LANG_SITEMGR_CATEGORY_FRIENDLYURL1)?> <br /><br /><strong><?=system_showText(LANG_SITEMGR_FOREXAMPLE)?>:</strong> <br /><br /><?=system_showText(LANG_SITEMGR_CATEGORY_FRIENDLYURL2)?><br />"<?=$default_url?>/<?=ALIAS_CATEGORY_URL_DIVISOR?>/computer"<?=$table_category == "ListingCategory" ? "<br />\"".PROMOTION_DEFAULT_URL."/".ALIAS_CATEGORY_URL_DIVISOR."/computer\"" : ""?><?=("<br /><br />".system_showText(LANG_SITEMGR_CATEGORY_FRIENDLYURL3)."<br />\"".$default_url."/".ALIAS_CATEGORY_URL_DIVISOR."/computer/software-development\"".($table_category == "ListingCategory" ? "<br />\"".PROMOTION_DEFAULT_URL."/".ALIAS_CATEGORY_URL_DIVISOR."/computer/software-development\""."<br /><br />".system_showText(LANG_SITEMGR_CATEGORY_FRIENDLYURL4) : ""))?>
                                </p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <th>
                    * <?=system_showText(LANG_SITEMGR_LABEL_PAGETITLE)?>:
                </th>
                <td class="categorySEOLine">
                    <input type="text" id="page_title" name="page_title" class="input-form" value="<?=$page_title;?>" />
                </td>
            </tr>
            <tr>
                <th>
                    * <?=system_showText(LANG_SITEMGR_LABEL_FRIENDLYTITLE)?>:
                </th>
                <td>
                    <input type="text" id="friendly_url" name="friendly_url" class="input-form" value="<?=$friendly_url;?>" onblur="easyFriendlyUrl(this.value, 'friendly_url', '<?=FRIENDLYURL_VALIDCHARS?>\n', '<?=FRIENDLYURL_SEPARATOR?>');" />
                </td>
            </tr>
            <tr>
                <th>
                    <?=system_showText(LANG_SITEMGR_LABEL_METADESCRIPTION)?>:
                </th>
                <td>
                    <textarea id="seo_description" name="seo_description" rows="5" cols="1"><?=$seo_description;?></textarea>
                </td>
            </tr>
            <tr>
                <th>
                    <?=system_showText(LANG_SITEMGR_LABEL_METAKEYWORDS)?>:
                </th>
                <td>
                    <textarea id="seo_keywords" name="seo_keywords" rows="5" cols="1" ><?=$seo_keywords;?></textarea>
                </td>
            </tr>
        </table>

        <? if (!THEME_CATEGORY_DESCRIPTION || $table_category != "ListingCategory") { ?>

        <table cellpadding="0" cellspacing="0" border="0" class="standard-table">
            <tr>
                <th colspan="2" class="standard-tabletitle">
                    <?=string_ucwords(system_showText(LANG_SITEMGR_CONTENT));?>:
                </th>
            </tr>
            <tr>
                <td colspan="2">
                    <? // TinyMCE Editor Init
                        //fix ie bug with images
                        if (!($content)) $content = "&nbsp;".$content;

                        // calling TinyMCE
                        system_addTinyMCE("", "none", "advanced", "content", "30", "15", "300", $content, false);
                    ?>
                </td>
            </tr>
        </table>
        <? } ?>
    </div>

    <script type="text/javascript">
        enableCategory();
    </script>