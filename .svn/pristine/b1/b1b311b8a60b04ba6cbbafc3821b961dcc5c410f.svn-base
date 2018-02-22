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
	# * FILE: /includes/forms/form_article.php
	# ----------------------------------------------------------------------------------------------------

?>
        
<script type="text/javascript" src="<?=DEFAULT_URL?>/includes/tiny_mce/tiny_mce_src.js"></script>
<script language="javascript" type="text/javascript">

	function JS_addCategory(id) {

		seed = document.article.seed;
		feed = document.article.feed;
		var text = unescapeHTML($("#liContent"+id).html());
		var flag=true;
		for (i=0;i<feed.length;i++) 
            if (feed.options[i].value==id) 
                flag=false;

		if(text && id && flag){
			feed.options[feed.length] = new Option(text, id);
			$('#categoryAdd'+id).after("<span class=\"categorySuccessMessage\"><?=system_showText(LANG_MSG_CATEGORY_SUCCESSFULLY_ADDED)?></span>").css('display', 'none');
			$('.categorySuccessMessage').fadeOut(5000);
		} else {
			if (!flag) $('#categoryAdd'+id).after("</a> <span class=\"categoryErrorMessage\"><?=system_showText(LANG_MSG_CATEGORY_ALREADY_INSERTED)?></span> </li>");  
            else ('#categoryAdd'+id).after("</a> <span class=\"categoryErrorMessage\"><?=system_showText(LANG_MSG_SELECT_VALID_CATEGORY)?></span> </li>");
		}
		
        $('#removeCategoriesButton').show(); 

	}

	// ---------------------------------- //

	function JS_submit() {

		feed = document.article.feed;
		return_categories = document.article.return_categories;
		if(return_categories.value.length > 0) return_categories.value="";

		for (i=0;i<feed.length;i++) {
			if (!isNaN(feed.options[i].value)) {
				if(return_categories.value.length > 0)
				return_categories.value = return_categories.value + "," + feed.options[i].value;
				else
			return_categories.value = return_categories.value + feed.options[i].value;
			}
		}

		document.article.submit();
	}
      
    // ---------------------------------- //
    
    function system_displayTinyMCEJS(txId) {

    	tinyMCE.execCommand('mceAddControl', false, txId);
    
    }
	
	// ---------------------------------- //
	
	function makeMain(image_id,thumb_id,item_id,temp,item_type) {

		var xmlhttp;

		try {
			xmlhttp = new XMLHttpRequest();
		} catch (e) {
			try {
				xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
			} catch (e) {
				try {
					xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
				} catch (e) {
					xmlhttp = false;
				}
			}
		}

		if (xmlhttp) {
			xmlhttp.onreadystatechange = function() {
				if (xmlhttp.readyState == 4) {
					if (xmlhttp.status == 200) {
						response =  xmlhttp.responseText;
						<? if ($members) { ?>
							loadGallery(item_id, 'y', '<?=MEMBERS_ALIAS?>');
						<? } else { ?>
							loadGallery(item_id, 'y', '<?=SITEMGR_ALIAS?>');
						<? } ?>
					}
				}
			}

			xmlhttp.open("GET", "<?=DEFAULT_URL;?>/makemainimage.php?gallery_hash=<?=$gallery_hash?>&image_id="+image_id+"&thumb_id="+thumb_id+"&item_id="+item_id+"&temp="+temp+"&item_type="+item_type+"&domain_id=<?=SELECTED_DOMAIN_ID?>", true);
			xmlhttp.send(null);
		}
	}
	
	// ---------------------------------- //

	function changeMain(image_id,thumb_id,item_id,temp,gallery_id,item_type) {

		var xmlhttp;

		try {
			xmlhttp = new XMLHttpRequest();
		} catch (e) {
			try {
				xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
			} catch (e) {
				try {
					xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
				} catch (e) {
					xmlhttp = false;
				}
			}
		}

		if (xmlhttp) {
			xmlhttp.onreadystatechange = function() {
				if (xmlhttp.readyState == 4) {
					if (xmlhttp.status == 200) {
						response =  xmlhttp.responseText;
						if (response=='error'){
                            fancy_alert('<?=system_showText(LANG_ITEM_ALREADY_HAD_MAX_IMAGE)?>', 'errorMessage', false, 500, 100, false);
						}
						<? if ($members) { ?>
							loadGallery(item_id, 'y', '<?=MEMBERS_ALIAS?>');
						<? } else { ?>
							loadGallery(item_id, 'y', '<?=SITEMGR_ALIAS?>');
						<? } ?>
					}
				}
			}

			xmlhttp.open("GET", "<?=DEFAULT_URL;?>/changemainimage.php?gallery_hash=<?=$gallery_hash?>&image_id="+image_id+"&thumb_id="+thumb_id+"&item_id="+item_id+"&gallery_id="+gallery_id+"&temp="+temp+"&item_type="+item_type+"&domain_id=<?=SELECTED_DOMAIN_ID?>"+"&level=<?=$level;?>", true);
			xmlhttp.send(null);
		}
	}
	
	// ---------------------------------- //

	function loadGallery(id, new_image, sess) {

		var xmlhttp;

		try {
			xmlhttp = new XMLHttpRequest();
		} catch (e) {
			try {
				xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
			} catch (e) {
				try {
					xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
				} catch (e) {
					xmlhttp = false;
				}
			}
		}

		if (xmlhttp) {
			xmlhttp.onreadystatechange = function() {
				if (xmlhttp.readyState == 4) {
					if (xmlhttp.status == 200) {
                        $("#galleryF").html(xmlhttp.responseText);
                        
                        $("a.fancy_window_imgAdd").fancybox({
                
                            <? if ($members) { ?>

                            'type'                  : 'iframe',
                            'width'                 : <?=FANCYBOX_UPIMAGE_WIDTH?>,
                            'minHeight'             : <?=FANCYBOX_UPIMAGE_HEIGHT?>,
                            <? if (THEME_FLAT_FANCYBOX) { ?>
                            'closeBtn'              : false,
                            <? } ?>
                            'padding'               : 0,
                            'margin'                : 0  

                            <? } else { ?>

                            'overlayShow'			: true,
                            'overlayOpacity'		: 0.4,
                            'autoDimensions'        : false,
                            'width'                 : <?=FANCYBOX_UPIMAGE_WIDTH?>,
                            'height'                : <?=FANCYBOX_UPIMAGE_HEIGHT?>,
                            'titleShow'             : false

                            <? } ?>
                        });

                        $("a.fancy_window_imgCaptions").fancybox({

                            <? if ($members) { ?>

                            'type'                  : 'iframe',
                            'width'                 : <?=FANCYBOX_IMAGECAPTIONS_WIDTH?>,
                            'minHeight'             : <?=FANCYBOX_IMAGECAPTIONS_HEIGHT?>,
                            <? if (THEME_FLAT_FANCYBOX) { ?>
                            'closeBtn'              : false,
                            <? } ?>
                            'padding'               : 0,
                            'margin'                : 0    

                            <? } else { ?>

                            'overlayShow'			: true,
                            'overlayOpacity'		: 0.75,
                            'autoDimensions'        : false,
                            'width'                 : <?=FANCYBOX_IMAGECAPTIONS_WIDTH?>,
                            'height'                : <?=FANCYBOX_IMAGECAPTIONS_HEIGHT?>,
                            'titleShow'             : false

                            <? } ?>

                        });

                        $("a.fancy_window_imgDelete").fancybox({

                            <? if ($members) { ?>
                            'type'                  : 'iframe',
                            'width'                 : <?=FANCYBOX_DELIMAGE_WIDTH?>,
                            'minHeight'             : <?=FANCYBOX_DELIMAGE_HEIGHT?>,
                            <? if (THEME_FLAT_FANCYBOX) { ?>
                            'closeBtn'              : false,
                            <? } ?>
                            'padding'               : 0,
                            'margin'                : 0    
                            <? } else { ?>

                            'overlayShow'			: true,
                            'overlayOpacity'		: 0.4,
                            'autoDimensions'        : false,
                            'width'                 : <?=FANCYBOX_DELIMAGE_WIDTH?>,
                            'height'                : <?=FANCYBOX_DELIMAGE_HEIGHT?>,               
                            'titleShow'             : false
                            <? } ?>
                        });
					}
				}
			}

			xmlhttp.open("GET", "<?=DEFAULT_URL;?>/includes/code/returngallery.php?gallery_hash=<?=$gallery_hash?>&domain_id=<?=SELECTED_DOMAIN_ID?>&id="+id+"&new_image="+new_image+"&sess="+sess+"&module=article", true);
			xmlhttp.send(null);
		}
	}
	
	$(document).ready(function(){
        var field_name = 'abstract';
        var count_field_name = 'abstract_remLen';

        var options = {
                    'maxCharacterSize': 250,
                    'originalStyle': 'originalTextareaInfo',
                    'warningStyle' : 'warningTextareaInfo',
                    'warningNumber': 40,
                    'displayFormat' : '<span><input readonly="readonly" type="text" id="'+count_field_name+'" name="'+count_field_name+'" size="3" maxlength="3" value="#left" class="textcounter" disabled="disabled" /> <?=system_showText(LANG_MSG_CHARS_LEFT)?> <?=system_showText(LANG_MSG_INCLUDING_SPACES_LINE_BREAKS)?></span>' 
            };
        $('#'+field_name).textareaCount(options);
        
        <?
        if($message_article){
            ?>
            if(feed.length == 0){
                $('#removeCategoriesButton').hide(); 
            }
            <?
        }
        ?>
        
	});
	
</script>

<? // Account Search Javascript /////////////////////////////////////////////////////// ?>
<script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/accountsearch.js"></script>
<? //////////////////////////////////////////////////////////////////////////////////// ?>


<?
/*
 * <p class="informationMessage">* <?=system_showText(LANG_LABEL_REQUIRED_FIELD)?> </p>
 */
?>

<?
if ($message_article) {
	echo "<p class=\"errorMessage\">";
		echo $message_article;
	echo "</p>";
}
?>

<table border="0" cellpadding="0" cellspacing="0" class="standard-table">
	<?
	$levelObj = new ArticleLevel();
	$levelValue = $levelObj->getValues();
	
	if (count($levelValue)>1){
	?>
	<tr>
		<th class="tableOption" colspan="2"><a href="<?=NON_SECURE_URL?>/<?=ALIAS_ADVERTISE_URL_DIVISOR?>.php?article" target="_blank"><?=system_showText(LANG_ARTICLE_OPTIONS);?></a></th>
	</tr>
	<?}?>
	<tr class="bigger">
		<th><i><span><?=system_showText(LANG_LABEL_REQUIRED_FIELD);?></span></i> <?=system_showText(LANG_ARTICLE_TITLE);?>:</th>
		<td>
			<input type="text" name="title" value="<?=$title?>" maxlength="100" <?=(!$id) ? " onblur=\"easyFriendlyUrl(this.value, 'friendly_url', '".FRIENDLYURL_VALIDCHARS."', '".FRIENDLYURL_SEPARATOR."');\" " : ""?> />
			<input type="hidden" name="friendly_url" id="friendly_url" value="<?=$friendly_url?>" maxlength="150" />
		</td>
	</tr>
</table>
<? // Account Search ////////////////////////////////////////////////////////////////// ?>
<? if (!$members) { ?>

	<table  class="standard-table">
		<tr>
			<th colspan="2" class="standard-tabletitle"><?=system_showText(LANG_SITEMGR_LABEL_ACCOUNT)?> <span><?=system_showText(LANG_SITEMGR_SETTINGS_IMPORT_TOACCOUNT_SPAN);?></span></th>
		</tr>
	</table>

	<?
	$acct_search_table_title = system_showText(LANG_SITEMGR_ACCOUNTSEARCH_SELECT_DEFAULT);
	$acct_search_field_name = "account_id";
	$acct_search_field_value = $account_id;
	$acct_search_required_mark = false;
	$acct_search_form_width = "95%";
	$acct_search_cell_width = "";
	$return = system_generateAjaxAccountSearch($acct_search_table_title, $acct_search_field_name, $acct_search_field_value, $acct_search_required_mark, $acct_search_form_width, $acct_search_cell_width);
	echo $return;
	?>

<? } ?>
<? //////////////////////////////////////////////////////////////////////////////////// ?>
<table border="0" cellpadding="0" cellspacing="0" class="standard-table">
	<tr>
		<th colspan="2" class="standard-tabletitle"><?=system_showText(LANG_LABEL_INFORMATION);?></th>
	</tr>
	<tr>
		<th><?=system_showText(LANG_ARTICLE_AUTHOR);?>:</th>
		<td><input type="text" <?=($highlight == "description" && !$author ? "class=\"highlight\"" : "")?> name="author" value="<?=$author?>" maxlength="100" /></td>
	</tr>
	<tr>
		<th><?=system_showText(LANG_ARTICLE_AUTHOR_URL);?>:</th>
		<td>
		<select name="author_url_protocol" class="httpSelect">
			<?
			$url_protocols 	= explode(",", URL_PROTOCOL);
			$sufix   			= "://";
			$protocol_replace 	= "" ;
			for ($i=0; $i<count($url_protocols); $i++) {
				$selected = false;
				$protocol = $url_protocols[$i];
				if (isset($author_url) || isset($author_url_protocol)) {
					if ($author_url && !$author_url_protocol) {
						$_protocol = explode($sufix, $author_url);
						$_protocol = $_protocol[0];
					} else if ($author_url_protocol) {
						$_protocol = str_replace($sufix, "", $author_url_protocol);
					}
					if ($_protocol == $protocol) {
						$selected = true;
						$protocol_replace = $_protocol.$sufix;
					}
				} else if (!isset($id) && !$i) {
					$selected = true;
					$protocol_replace = $url_protocols[$i];
					$protocol_replace = $protocol_replace.$sufix;
				}
				$protocol .= $sufix;
			?>
			<option value="<?=$protocol?>"  <?=($selected==true  ? "selected=\"selected\"" : "")?> ><?=$protocol?></option>
			<?
			}
			?>
		</select>
		<input type="text" class="httpInput <?=($highlight == "additional" && !$author_url ? "highlight" : "")?>" name="author_url" value="<?=str_replace($protocol_replace, "", $author_url)?>" maxlength="255" />
		</td>
	</tr>
	<tr>
		<th class="alignTop"><?=system_showText(LANG_LABEL_PUBLICATION_DATE);?>:</th>
		<td><input type="text" name="publication_date" id="publication_date" value="<?=$publication_date?>" style="width:90px;" /><span>(<?=format_printDateStandard()?>)</span></td>
	</tr>
</table>

<table border="0" cellpadding="0" cellspacing="0" class="standard-table">

	<tr>
		<th colspan="3" class="standard-tabletitle"><?=system_showText(LANG_LABEL_IMAGE_PLURAL)?> <span>(<?=IMAGE_ARTICLE_FULL_WIDTH?>px x <?=IMAGE_ARTICLE_FULL_HEIGHT?>px) (JPG, GIF <?=system_showText(LANG_OR);?> PNG)</span></th>
	</tr>
	
	<tr id="table_gallery">
		<th colspan="3" class="Full">
			<div id="galleryF"></div>
		</th>
	</tr>

	<?
	$gallery_id=$article->getGalleries();
	?>

	<tr>
		<td class="alignTop width100">
			<? $articleLevelGallery = new ArticleLevel(); ?>
			<?if ($members) {?>
			<a id="uploadimage" href="<?=DEFAULT_URL?>/popup/popup.php?domain_id=<?=SELECTED_DOMAIN_ID?>&pop_type=uploadimage&gallery_hash=<?=$gallery_hash?>&item_type=article&item_id=<?=$article->getNumber("id")?>&galleryid=<?=$gallery_id[0]?>&photos=<?=$articleLevelGallery->getImages($article->getNumber("level"))?>" class="addImageForm input-button-form iframe fancy_window_imgAdd"><?=system_showText(LANG_LABEL_ADDIMAGE)?></a>
			<?} else {?>
			<a id="uploadimage" href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/uploadimage.php?gallery_hash=<?=$gallery_hash?>&item_type=article&item_id=<?=$article->getNumber("id")?>&galleryid=<?=$gallery_id[0]?>&photos=<?=$articleLevelGallery->getImages($article->getNumber("level"))?>" class="addImageForm input-button-form iframe fancy_window_imgAdd"><b><?=system_showText(LANG_LABEL_ADDIMAGE)?></b></a>
			<?}?>
			<span><?=system_showText(LANG_MSG_MAX_FILE_SIZE)?> <?=UPLOAD_MAX_SIZE;?> MB. <?=system_showText(LANG_MSG_ANIMATEDGIF_NOT_SUPPORTED);?></span>
			
			<p class="informationMessage"><?=system_showText(LANG_MSG_ARTICLE_WILL_SHOW)?> <?=(($articleLevelGallery->getImages($article->getNumber("level")) == -1) ? (system_showText(LANG_LABEL_UNLIMITED)) : (system_showText(LANG_MSG_THE_MAX_OF)." ".$articleLevelGallery->getImages($article->getNumber("level"))))." ".(($articleLevelGallery->getImages($article->getNumber("level")) == 1) ? (LANG_MSG_GALLERY_PHOTO) : (LANG_MSG_GALLERY_PHOTOS)) ?> <?=system_showText(LANG_MSG_PER_GALLERY)?><?=system_showText(LANG_MSG_PLUS_MAINIMAGE)?></p>
		</td>
	</tr>

</table>

<table  class="standard-table">	
    <tr>
    	<th>
            <?=system_showText(LANG_LABEL_ABSTRACT)?> <span>(<?=string_strtolower(system_showText(LANG_MSG_MAX_250_CHARS))?>)</span>
        </th>
        <td>
            <textarea id="abstract" name="abstract" rows="5" cols="1" ><?=$abstract;?></textarea>
        </td>
    </tr>

</table>

<table  class="standard-table">

    <tr>
        <th class="standard-tabletitle"><?=system_showText(LANG_LABEL_CONTENT)?></th>
    </tr>
    <tr>
        <td colspan="2" class="packageEditor">
        	<? if ($highlight == "description" && !$content) { ?>
        	 	<p class="successMessage highlight">You haven't submitted your article yet.</p>
        	<? }
                // TinyMCE Editor Init
                //fix ie bug with images
                if (!($content)) $content = "&nbsp;".$content;

                // calling TinyMCE
                system_addTinyMCE("", "none", "advanced", "content", "30", "15", "100%", $content, false);
            ?>
        </td>
    </tr>
</table>

<table  class="standard-table">
    <tr>
    	<th>
            <?=system_showText(LANG_LABEL_KEYWORDS_FOR_SEARCH)?> <span>(<?=system_showText(LANG_LABEL_MAX);?> <?=MAX_KEYWORDS?> <?=system_showText(LANG_LABEL_KEYWORDS);?>)</span>
        </th>
        <td>
            <textarea name="keywords" <?=($highlight == "additional" && !$keywords ? "class=\"highlight\"" : "")?> rows="5"><?=$keywords?></textarea>
            <span><?=system_showText(LANG_MSG_KEYWORD_PER_LINE)?></span>
        </td>
    </tr>

</table>

<table border="0" cellpadding="0" cellspacing="0" class="standard-table">
	<tr>
		<th colspan="2" class="standard-tabletitle">
			<?=system_showText(LANG_CATEGORIES_SUBCATEGS)?>
		</th>
	</tr>
	<tr>
		<td colspan="2">
			<p class="warningBOXtext" style="background-position: 10px 0;"><?=system_showText(LANG_MSG_ONLY_SELECT_SUBCATEGS)?><br /><?=system_showText(LANG_MSG_ARTICLE_AUTOMATICALLY_APPEAR);?><br /></p>
            <p class="warningBOXtext" style="background-position: 10px 0;"><?=system_showText(LANG_CATEGORIES_CATEGORIESMAXTIP1)." <strong>".system_showText(MAX_CATEGORY_ALLOWED)."</strong> ".system_showText(LANG_CATEGORIES_CATEGORIESMAXTIP2)?></p>
		</td>
	</tr>
	<input type="hidden" name="return_categories" value="" />
	<tr>
		<td colspan="2" class="treeView">
			<ul id="article_categorytree_id_0" class="categoryTreeview">&nbsp;</ul>
			<table width="100%" border="0" cellpadding="2" class="tableCategoriesADDED" cellspacing="0">
				<tr>
					<th colspan="2" class="tableCategoriesTITLE alignLeft"><strong><?=system_showText(LANG_ARTICLE_CATEGORIES);?>:</strong></th>
				</tr>
				<tr id="msgback2" class="informationMessageShort">
					<td colspan="2" style="width: auto;"><p><img width="16" height="14" src="<?=DEFAULT_URL?>/images/icon_atention.gif" alt="<?=LANG_LABEL_ATTENTION?>" title="<?=LANG_LABEL_ATTENTION?>" /> <?=system_showText(LANG_MSG_CLICKADDTOSELECTCATEGORIES);?></p></td>
				</tr>
				<tr id="msgback" style="display:none">
					<td colspan="2"><div><img width="16" height="14" src="<?=DEFAULT_URL?>/images/icon_atention.gif" alt="<?=LANG_LABEL_ATTENTION?>" title="<?=LANG_LABEL_ATTENTION?>" /></div><p><?=system_showText(LANG_MSG_CLICKADDTOADDCATEGORIES);?></p></td>
				</tr>
				<tr>
					<td colspan="2" class="tableCategoriesCONTENT"><?=$feedDropDown?></td>
				</tr>
				<tr id="removeCategoriesButton" <?=(($article->getNumber("id") || $message_article) ? "" :"style='display:none'")?>>
					<td class="tableCategoriesBUTTONS" colspan="2">
						<center>
							<button class="input-button-form" type="button" value="<?=system_showText(LANG_BUTTON_REMOVESELECTEDCATEGORY)?>" onclick="JS_removeCategory(document.article.feed, false);"><?=system_showText(LANG_BUTTON_REMOVESELECTEDCATEGORY)?></button>
						</center>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>

<? if (PAYMENT_FEATURE == "on") { ?>
	<? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) { ?>
		<table  class="standard-table">
			<tr>
				<th colspan="2" class="standard-tabletitle"><?=system_showText(LANG_LABEL_DISCOUNT_CODE)?></th>
			</tr>
			<? if (((!$article->getNumber("id")) || (($article) && ($article->needToCheckOut())) || (string_strpos($url_base, "/".SITEMGR_ALIAS."")) || (($article) && ($article->getPrice() <= 0))) && ($process != "signup")) { ?>
				<tr>
					<th><?=system_showText(LANG_LABEL_CODE)?>:</th>
					<td><input type="text" name="discount_id" value="<?=$discount_id?>" maxlength="10" /></td>
				</tr>
			<? } else { ?>
				<tr>
					<th><?=system_showText(LANG_LABEL_CODE)?>:</th>
					<td>
                        <?=(($discount_id) ? $discount_id : system_showText(LANG_NA) )?>
                        <input type="hidden" name="discount_id" value="<?=$discount_id?>" maxlength="10" />
                    </td>
				</tr>
			<? } ?>
		</table>
	<? } ?>
<? }

	system_displayTinyMCE('content');

?>
<script language="javascript" type="text/javascript" src="<?=DEFAULT_URL?>/scripts/categorytree.js"></script>

<script language="javascript" type="text/javascript">
	loadCategoryTree('all', 'article_', 'ArticleCategory', 0, 0, '<?=DEFAULT_URL?>',<?=SELECTED_DOMAIN_ID?>);

	<? if ($members) $sess = MEMBERS_ALIAS; else $sess = SITEMGR_ALIAS; ?>
		loadGallery(<?=$id ? $id : '0'?>, 'y', '<?=$sess?>');
</script>