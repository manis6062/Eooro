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
	# * FILE: /includes/forms/form_classified.php
	# ----------------------------------------------------------------------------------------------------

	setting_get("payment_tax_status", $payment_tax_status);
	setting_get("payment_tax_value", $payment_tax_value);
	customtext_get("payment_tax_label", $payment_tax_label);

?>
        
<script language="javascript"  type="text/javascript">

     <? if (!$members) { ?>
         
        function changeClassifiedLevel() {
            
            var auxLevel = $('#level').val();
            var url = "<?=DEFAULT_URL.str_replace(EDIRECTORY_FOLDER, "", $_SERVER["PHP_SELF"]);?>?level="+auxLevel+"<?=($id ? "&id=".$id : "")?>";
            var currLevel = '<?=$level ? $level : ''?>';

            dialogBox('confirm_redirect', '<?=system_showText(LANG_CONFIRM_CHANGE_LEVEL)?>','','','200','<?=system_showText(LANG_SITEMGR_OK);?>','<?=system_showText(LANG_SITEMGR_CANCEL);?>', url, currLevel);

        }
        
    <? } ?>

	function JS_addCategory(id) {
			
		seed = document.classified.seed;
		feed = document.classified.feed;
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
	
		feed = document.classified.feed;
		return_categories = document.classified.return_categories;
		if(return_categories.value.length > 0) return_categories.value="";
		
		for (i=0;i<feed.length;i++) {
			if (!isNaN(feed.options[i].value)) {
				if(return_categories.value.length > 0)
				return_categories.value = return_categories.value + "," + feed.options[i].value;
				else
			return_categories.value = return_categories.value + feed.options[i].value;
			}
		}
		
		document.classified.submit();
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
							loadGallery(item_id, "y", "<?=MEMBERS_ALIAS?>", "", "true");
						<? } else { ?>
							loadGallery(item_id, "y", "<?=SITEMGR_ALIAS?>", "", "true");
						<? } ?>
					}
				}
			}

			xmlhttp.open("GET", "<?=DEFAULT_URL;?>/makemainimage.php?gallery_hash=<?=$gallery_hash?>&image_id="+image_id+"&thumb_id="+thumb_id+"&item_id="+item_id+"&temp="+temp+"&item_type="+item_type+"&domain_id=<?=SELECTED_DOMAIN_ID;?>", true);
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
						if (response == "error"){
                            fancy_alert('<?=system_showText(LANG_ITEM_ALREADY_HAD_MAX_IMAGE)?>', 'errorMessage', false, 500, 100, false);
						}
						<? if ($members) { ?>
							loadGallery(item_id, "y", "<?=MEMBERS_ALIAS?>", "", "true");
						<? } else { ?>
							loadGallery(item_id, "y", "<?=SITEMGR_ALIAS?>", "", "true");
						<? } ?>
					}
				}
			}

			xmlhttp.open("GET", "<?=DEFAULT_URL;?>/changemainimage.php?gallery_hash=<?=$gallery_hash?>&image_id="+image_id+"&thumb_id="+thumb_id+"&item_id="+item_id+"&gallery_id="+gallery_id+"&temp="+temp+"&item_type="+item_type+"&domain_id=<?=SELECTED_DOMAIN_ID;?>"+"&level=<?=$level;?>", true);
			xmlhttp.send(null);
		}
	}
	
	// ---------------------------------- //

	function loadGallery(id, new_image, sess, del, main) {

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

							if (del != "edit" && del != "editFe"){
								if (del == "n"){
									$("#addImage").css("display", "none");
									$("#galleryF").css("display", "");
								} else {
									<? if ($hasImage){?>
										if (del) {
											$("#addImage").css("display", "none");
											$("#galleryF").css("display", "");
										} else {
											$("#addImage").css("display", "");
											$("#galleryF").css("display", "none");
										}
									<? } else { ?>
										$("#addImage").css("display", "");
										$("#galleryF").css("display", "none");
									<? } ?>
								}
							} else {
								if (del == "edit" || del == "editFe")
									$("#galleryF").css("display", "");
							}

							if (main == "true"){
								$("#galleryF").css("display", "");
							}
							<? if ($hasImage){ ?>
								$("#galleryF").css("display", "");
							<? } ?>

							if (xmlhttp.responseText == "no image"){
								$("#galleryF").css("display", "none");
							}
                            
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

			xmlhttp.open("GET", "<?=DEFAULT_URL;?>/includes/code/returngallery.php?gallery_hash=<?=$gallery_hash?>&domain_id=<?=SELECTED_DOMAIN_ID?>&id="+id+"&new_image="+new_image+"&main="+main+"&sess="+sess+"&module=classified&level=<?=$level?>", true);
			xmlhttp.send(null);
		}
	}
	
	$(document).ready(function(){
		
        var field_name = 'summarydesc';
        var count_field_name = 'summarydesc_remLen';

        var options = {
                    'maxCharacterSize': 250,
                    'originalStyle': 'originalTextareaInfo',
                    'warningStyle' : 'warningTextareaInfo',
                    'warningNumber': 40,
                    'displayFormat' : '<span><input readonly="readonly" type="text" id="'+count_field_name+'" name="'+count_field_name+'" size="3" maxlength="3" value="#left" class="textcounter" disabled="disabled" /> <?=system_showText(LANG_MSG_CHARS_LEFT)?> <?=system_showText(LANG_MSG_INCLUDING_SPACES_LINE_BREAKS)?></span>' 
            };
        $('#'+field_name).textareaCount(options);
        
        $.mask.definitions['~']='[+-]';
        $("#price_int").mask("9?999999",{placeholder:""});
        $("#price_cent").mask("9?9",{placeholder:""});
        
        <?
        if($message_classified){
            ?>
            if(feed.length == 0){
                $('#removeCategoriesButton').hide(); 
            }
            <?
        }
        ?>
		
	});
    		
	////////////////////////////////////////////////////////////////////////////////////////////////////////
</script>

<?  // Account Search Javascript /////////////////////////////////////////////////////// ?>

<script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/accountsearch.js"></script>

<?  //////////////////////////////////////////////////////////////////////////////////// ?>

<?

	
	if ($message_classified) {
		echo "<p class=\"errorMessage\">";
		echo $message_classified ;
		echo "</p>";
	}
?>

<? // Display Level ////////////////////////////////////////////////////////////////// ?>
<?php
$level_name = "";
if ($level) {
	$levelObjTMP = new ClassifiedLevel();
	$level_name = $levelObjTMP->getLevel($level);
}

?>

	<table border="0" cellpadding="0" cellspacing="0" class="standard-table">
		
		<tr class="bigger">
			<th><i><span><?=system_showText(LANG_LABEL_REQUIRED_FIELD);?></span></i> <?=system_showText(LANG_CLASSIFIED_TITLE);?>:</th>
			<td>
				<input type="text" name="title" value="<?=$title?>" maxlength="100" <?=(!$id) ? " onblur=\"easyFriendlyUrl(this.value, 'friendly_url', '".FRIENDLYURL_VALIDCHARS."', '".FRIENDLYURL_SEPARATOR."');\" " : ""?> />
				<input type="hidden" name="friendly_url" id="friendly_url" value="<?=$friendly_url?>" maxlength="150" />
			</td>
		</tr>
        <?
        if(!$members){
            ?>
            <tr>
                <th><?=system_showText(LANG_MENU_SELECT_CLASSIFIED_LEVEL)?></th>
                <td>
                    <select name="level" id="level" onchange="changeClassifiedLevel();">
                    <?
                    $levelObjAux = new ClassifiedLevel();
                    $levelvalues = $levelObjAux->getLevelValues();
                    foreach ($levelvalues as $levelvalue) { ?>
                        <option value="<?=$levelvalue?>" <?=(($levelArray[$levelObjAux->getLevel($levelvalue)]) ? "selected" : "")?>>
                            <?=$levelObjAux->showLevel($levelvalue);?>
                        </option>
                    <? } ?>        
                    </select>
                </td>
            </tr>
            <?
        }
        ?>
    </table>
        
    <? // Account Search ////////////////////////////////////////////////////////////////// ?>
    <? if (!$members) { ?>

        <table class="standard-table">
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
    <?  //////////////////////////////////////////////////////////////////////////////////// ?>    
        
    <table border="0" cellpadding="0" cellspacing="0" class="standard-table">
		<tr>
			<th colspan="2" class="standard-tabletitle"><?=system_showText(LANG_LABEL_INFORMATION);?></th>
		</tr>
    

        
        <? if (is_array($array_fields) && in_array("contact_name", $array_fields)){ ?>
            <tr>
                <th><?=system_showText(LANG_LABEL_CONTACT_NAME);?>:</th>
                <td><input type="text" <?=($highlight == "description" && !$contactname ? "class=\"highlight\"" : "")?> name="contactname" value="<?=$contactname?>" /></td>
            </tr>
        <? } ?>
          
        <? if (is_array($array_fields) && in_array("contact_phone", $array_fields)){ ?>
		<tr>
			<th><?=system_showText(LANG_LABEL_CONTACT_PHONE);?>:</th>
			<td><input type="text" <?=($highlight == "description" && !$phone ? "class=\"highlight\"" : "")?> name="phone" value="<?=$phone?>" /></td>
		</tr>
        <? } ?>

        <? if (is_array($array_fields) && in_array("fax", $array_fields)){ ?>
            <tr>
                <th><?=system_showText(LANG_LABEL_CONTACT_FAX);?>:</th>
                <td><input type="text" <?=($highlight == "additional" && !$fax ? "class=\"highlight\"" : "")?> name="fax" value="<?=$fax?>" /></td>
            </tr>
        <? } ?>
            
        <? if (is_array($array_fields) && in_array("contact_email", $array_fields)){ ?>
		<tr>
			<th><?=system_showText(LANG_LABEL_CONTACT_EMAIL);?>:</th>
			<td><input type="text" <?=($highlight == "additional" && !$email ? "class=\"highlight\"" : "")?> name="email" value="<?=$email?>" /></td>
		</tr>
        <? } ?>

        <? if (is_array($array_fields) && in_array("url", $array_fields)){ ?>
            <tr>
                <th><?=system_showText(LANG_LABEL_URL)?>:</th>
                <td>
                <select name="url_protocol" class="httpSelect">
                <?
                $url_protocols 	= explode(",", URL_PROTOCOL);
                $sufix   			= "://";
                $protocol_replace 	= "" ;
                for ($i=0; $i<count($url_protocols); $i++) {
                    $selected = false;
                    $protocol = $url_protocols[$i];
                    if (isset($url) || isset($url_protocol)) {
                        if ($url && !$url_protocol) {
                            $_protocol = explode($sufix, $url);
                            $_protocol = $_protocol[0];
                        } else if ($url_protocol) {
                            $_protocol = str_replace($sufix, "", $url_protocol);
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
                <input type="text" class="httpInput <?=($highlight == "additional" && !$url ? "highlight" : "")?>" name="url" value="<?=str_replace($protocol_replace, "", $url)?>" maxlength="255" />
                </td>
            </tr>
        <? } ?>
          
        <? if (is_array($array_fields) && in_array("price", $array_fields)){ ?>
		<tr>
			<th><?=system_showText(LANG_LABEL_PRICE);?>:</th>
			<td>
				<?
				if ( $classified_price != 'NULL' ) {
					$price_value = explode(".", $classified_price);	
				}
				echo CURRENCY_SYMBOL;
				?>
				<input type="text" <?=($highlight == "description" && $classified_price == 'NULL' ? "class=\"highlight\"" : "")?> name="classified_price_int" id="price_int" value="<?=$price_value[0] ? $price_value[0] : $classified_price_int?>" maxlength="7" style="width:75px; text-align:right;" />
				<strong> &nbsp;.&nbsp; </strong>
				<input type="text" <?=($highlight == "description" && $classified_price == 'NULL' ? "class=\"highlight\"" : "")?> name="classified_price_cent" id="price_cent" value="<?=$price_value[1] ? $price_value[1] : $classified_price_cent?>" maxlength="2" style="width:50px;" />
			</td>
		</tr>
        <? } ?>
	</table>

	<table border="0" cellpadding="0" cellspacing="0" class="standard-table nomargin">
		<tr>
			<th colspan="2" class="standard-tabletitle"><?=system_showText(LANG_LABEL_LOCATIONS)?></th>
		</tr>
		<tr>
			<th><?=system_showText(LANG_LABEL_ADDRESS);?>:</th>
			<td><input type="text" <?=($highlight == "description" && !$address ? "class=\"highlight\"" : "")?> name="address" id="address" <?=($loadMap ? "onblur=\"loadMap(document.classified);\"" : "")?> value="<?=$address?>" value="<?=$address?>" /></td>
		</tr>
		<tr>
			<th><?=system_showText(LANG_LABEL_ADDRESS_OPTIONAL);?>:</th>
			<td><input type="text" <?=($highlight == "description" && !$address2 ? "class=\"highlight\"" : "")?> name="address2" value="<?=$address2?>" /></td>
		</tr>
        
		<tr>
			<th><?=string_ucwords(ZIPCODE_LABEL)?>:</th>
			<td><input type="text" <?=($highlight == "description" && !$zip_code ? "class=\"highlight\"" : "")?> name="zip_code" id="zip_code" <?=($loadMap ? "onblur=\"loadMap(document.classified);\"" : "")?> value="<?=$zip_code?>" maxlength="10" /></td>
		</tr>
        
        <? if ($loadMap) { ?>
        <tr>
            <th><?=system_showText(LANG_LABEL_LATITUDE)?>:</th>
            <td>
                <input type="text" name="latitude" id="latitude" <?=($loadMap ? "onblur=\"loadMap(document.classified, true);\"" : "")?> value="<?=$latitude?>" maxlength="10" />
                <span>Ex: 38.830391</span>
            </td>
        </tr>

        <tr>
            <th><?=system_showText(LANG_LABEL_LONGITUDE)?>:</th>
            <td>
                <input type="text" name="longitude" id="longitude" <?=($loadMap ? "onblur=\"loadMap(document.classified, true);\"" : "")?> value="<?=$longitude?>" maxlength="10" />
                <span>Ex: -77.196370</span>
            </td>
        </tr>
        <? } ?>
	</table>	

	<? include(EDIRECTORY_ROOT."/includes/code/load_location.php"); 
    
    if ($loadMap){
               
        include(EDIRECTORY_ROOT."/includes/code/maptuning_forms.php");
 
        ?>
        <table class="standard-table noMargin" id="tableMapTuning" <?=($hasValidCoord ? "" : "style=\"display: none\"" )?>>
            <tr>
                <th colspan="2" class="standard-tabletitle">
                    <?=system_showText(LANG_LABEL_MAP_TUNING)?> 
                    <div id="tipsMap">
                        <span style="text-align: justify;"><?=system_showText(LANG_MSG_USE_CONTROLS_TO_ADJUST)?></span>
                        <br />
                        <span style="text-align: justify;"><?=system_showText(LANG_MSG_USE_ARROWS_TO_NAVIGATE)?></span>
                        <br />
                        <span style="text-align: justify;"><?=system_showText(LANG_MSG_DRAG_AND_DROP_MARKER)?></span>
                    </div>
                </th>
            </tr>

            <tr>
                <td>
                    <div id="map" class="googleBase" style="border: 1px solid #000;">&nbsp;</div>
                    <input type="hidden" name="latitude_longitude" id="myLatitudeLongitude" value="<?=$latitude_longitude?>" />
                    <input type="hidden" name="map_zoom" id="map_zoom" value="<?=$map_zoom?>" />
                    <input type="hidden" name="maptuning_done" id="maptuning_done" value="<?=$maptuning_done?>" />
                </td>
            </tr>

        </table>

    <? } ?>
	
<? if ((is_array($array_fields) && in_array("main_image", $array_fields)) || $levelMaxImages > 0) { ?>
	<table border="0" cellpadding="0" cellspacing="0" class="standard-table">
		<tr>
			<th colspan="3" class="standard-tabletitle"><?=($onlyMainImage ? system_showText(LANG_LABEL_IMAGE) : system_showText(LANG_LABEL_IMAGE_PLURAL))?> <span>(<?=IMAGE_CLASSIFIED_FULL_WIDTH?>px x <?=IMAGE_CLASSIFIED_FULL_HEIGHT?>px) (JPG, GIF <?=system_showText(LANG_OR);?> PNG)</span></th>
		</tr>

		<tr id="table_gallery">
			<th colspan="3" class="Full">
				<div id="galleryF"></div>
			</th>
		</tr>

		<?
		$gallery_id = $classified->getGalleries();
		if ($onlyMainImage){
        ?>
			<tr id="addImage" style="display:<?=($image_id ? 'none' : '');?>">
        <? } else { ?>
			<tr>
        <? } ?>
                <td class="alignTop width100">
                    
                    <? if ($members) { ?>
                        <a id="uploadimage" href="<?=DEFAULT_URL?>/popup/popup.php?domain_id=<?=SELECTED_DOMAIN_ID?>&pop_type=uploadimage&gallery_hash=<?=$gallery_hash?>&item_type=classified&item_id=<?=$classified->getNumber("id")?>&galleryid=<?=$gallery_id[0]?>&photos=<?=$levelMaxImages?>&level=<?=$level?>" class="addImageForm input-button-form iframe fancy_window_imgAdd"><?=system_showText(LANG_LABEL_ADDIMAGE)?></a>
                    <? } else { ?>
                        <a id="uploadimage" href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/uploadimage.php?gallery_hash=<?=$gallery_hash?>&item_type=classified&item_id=<?=$classified->getNumber("id")?>&galleryid=<?=$gallery_id[0]?>&photos=<?=$levelMaxImages?>&level=<?=$level?>" class="addImageForm input-button-form iframe fancy_window_imgAdd"><b><?=system_showText(LANG_LABEL_ADDIMAGE)?></b></a>
                    <? } ?>
                    
                    <span><?=system_showText(LANG_MSG_MAX_FILE_SIZE)?> <?=UPLOAD_MAX_SIZE;?> MB. <?=system_showText(LANG_MSG_ANIMATEDGIF_NOT_SUPPORTED);?></span>
                    
                    <? if ($levelMaxImages > 0){ ?>
                        <p class="informationMessage"><?=system_showText(LANG_MSG_CLASSIFIED_WILL_SHOW)?> <?=(($levelMaxImages == -1) ? (system_showText(LANG_LABEL_UNLIMITED)) : (system_showText(LANG_MSG_THE_MAX_OF)." ".$levelMaxImages))." ".(($levelMaxImages == 1) ? (LANG_MSG_GALLERY_PHOTO) : (LANG_MSG_GALLERY_PHOTOS)) ?> <?=system_showText(LANG_MSG_PER_GALLERY)?><?=($hasMainImage ? " ".system_showText(LANG_MSG_PLUS_MAINIMAGE) : ".")?></p>
                    <? } ?>
                </td>
            </tr>
		
	</table>
<? } ?>

<? if (is_array($array_fields) && in_array("summary_description", $array_fields)){ ?>
    <table class="standard-table">
        <tr>
        	<th>
                <?=system_showText(LANG_LABEL_SUMMARY_DESCRIPTION)?> <span>(<?=string_strtolower(system_showText(LANG_MSG_MAX_250_CHARS))?>)</span>
            </th>
            <td>
                <textarea id="summarydesc" <?=($highlight == "description" && !$summarydesc ? "class=\"highlight\"" : "")?> name="summarydesc" rows="5" cols="1" ><?=$summarydesc;?></textarea>
            </td>
        </tr>
    </table>
<? } ?>

<? if (is_array($array_fields) && in_array("long_description", $array_fields)){ ?>
    <table class="standard-table">
        <tr>
        	<th><?=system_showText(LANG_LABEL_DETAIL_DESCRIPTION)?></th>
            <td>
                <textarea name="detaildesc" <?=($highlight == "description" && !$detaildesc ? "class=\"highlight\"" : "")?> rows="5"><?=$detaildesc?></textarea>
            </td>
        </tr>
    </table>
<? } ?>

<table class="standard-table nomargin">   
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
			<p class="warningBOXtext"><?=system_showText(LANG_MSG_ONLY_SELECT_SUBCATEGS)?><br /><?=system_showText(LANG_MSG_CLASSIFIED_AUTOMATICALLY_APPEAR)?><br /></p>
			<p class="warningBOXtext"><?=system_showText(LANG_CATEGORIES_CATEGORIESMAXTIP1)." <strong>".system_showText(MAX_CATEGORY_ALLOWED)."</strong> ".system_showText(LANG_CATEGORIES_CATEGORIESMAXTIP2)?></p>
		</td>
	</tr>
	<input type="hidden" name="return_categories" value="" />
	<tr>
		<td colspan="2" class="treeView">
			<ul id="classified_categorytree_id_0" class="categoryTreeview">&nbsp;</ul>
			<table width="100%" border="0" cellpadding="0" class="tableCategoriesADDED" cellspacing="0">				
				<tr>
					<th colspan="2" class="tableCategoriesTITLE alignLeft"><strong><?=system_showText(LANG_CLASSIFIED_CATEGORY_PLURAL);?>:</strong></th>
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
				<tr id="removeCategoriesButton" <?=(($classified->getNumber("id") || $message_classified)? "" :"style='display:none'")?>>
					<td class="tableCategoriesBUTTONS" colspan="2">
						
						<center>
							<button class="input-button-form" type="button" value="<?=system_showText(LANG_BUTTON_REMOVESELECTEDCATEGORY)?>" onclick="JS_removeCategory(document.classified.feed, false);"><?=system_showText(LANG_BUTTON_REMOVESELECTEDCATEGORY)?></button>
						</center>
						
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>

<? if (PAYMENT_FEATURE == "on") { ?>
	<? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) { ?>
		<table class="standard-table">
			<tr>
				<th colspan="2" class="standard-tabletitle"><?=system_showText(LANG_LABEL_DISCOUNT_CODE)?></th>
			</tr>
			<? if (((!$classified->getNumber("id")) || (($classified) && ($classified->needToCheckOut())) || (string_strpos($url_base, "/".SITEMGR_ALIAS."")) || (($classified) && ($classified->getPrice() <= 0))) && ($process != "signup")) { ?>
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
<? } ?>

<script language="javascript" type="text/javascript" src="<?=DEFAULT_URL?>/scripts/categorytree.js"></script>

<script type="text/javascript">

		
	$('input:text[name=classified_price_cent]').keydown(function(e) {
		if (e.which == 8) {
			if (this.value == '') {
				$('input:text[name=classified_price_int]').focus();
			}
		}	
	});
	
	$('input:text[name=classified_price_int]').keydown(function(e) {
		if (e.which == 8 || e.which == 46) {
			if ($(this).val() == '') {
				$('input:text[name=classified_price_cent]').focus();
			}
		}	
	});
    
	loadCategoryTree('all', 'classified_', 'ClassifiedCategory', 0, 0, '<?=DEFAULT_URL?>',<?=SELECTED_DOMAIN_ID?>);

	<? if ($members) $sess = MEMBERS_ALIAS; else $sess = SITEMGR_ALIAS; ?>
	loadGallery(<?=$id ? $id : '0'?>, 'y', '<?=$sess?>', '<?=$id ? 'editFe' : 'editF'?>', <?=$onlyMainImage ? "'false'" : "''"?>);
    
    <? if ($hasValidCoord) { ?>
        loadMap(document.classified, true);
    <? } ?>
</script>