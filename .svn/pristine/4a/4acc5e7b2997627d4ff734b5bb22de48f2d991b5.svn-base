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
	# * FILE: /includes/forms/form_mobileadvert.php
	# ----------------------------------------------------------------------------------------------------

?>
 
    <script language="javascript" type="text/javascript">

        function JS_submit() {
            document.advert.submit();
        }

    </script>
    
    <p><?=system_showText(LANG_SITEMGR_MOBILE_ADVERT_TIP1)?></p>
    
    <br />
    
    <p><?=system_showText(LANG_SITEMGR_MOBILE_ADVERT_TIP2)?></p>
    
    <br />

    <?
    if ($message_advert) {
        echo "<p class=\"errorMessage\">$message_advert</p>";
    }
    ?>

    <table border="0" cellpadding="0" cellspacing="0" class="standard-table">
        <tr>
            <th colspan="2" class="standard-tabletitle"><?=system_showText(LANG_LABEL_INFORMATION);?></th>
        </tr>

        <tr>
            <th>* <?=system_showText(LANG_SITEMGR_MOBILE_ADVERTTITLE);?>:</th>
            <td>
                <input type="text" name="title" value="<?=$title?>" maxlength="25" />
            </td>
        </tr>
        
        <? if ($imagePath) { ?>
        <tr>
            <th><?=system_showText(LANG_SITEMGR_MOBILE_ADVERT_PREVIEW);?>:</th>
            <td class="image-space">
                <?=$imageObj->getTag(true, MOBILE_ADVERT_WIDTH, MOBILE_ADVERT_HEIGHT, $title, true);?>
            </td>
        </tr>
        <? } ?>
        
        <tr>
            <th style="vertical-align:top">* <?=system_showText(LANG_LABEL_ADDIMAGE)?>:</th>
            <td>
                <input type="file" name="image" class="input-form-banner" size="60" />
                <span><?=MOBILE_ADVERT_WIDTH?> x <?=MOBILE_ADVERT_HEIGHT?></span>
                <span><?=system_showText(LANG_MSG_MAX_FILE_SIZE)?> <?=BANNER_UPLOAD_MAX_SIZE;?> KB.</span>
                <span><?=system_showText(LANG_MSG_ALLOWED_FILE_TYPES)?>: GIF, JPEG, PNG</span>
            </td>
        </tr>
        
        <tr>
			<th style="vertical-align:top">* <?=system_showText(LANG_LABEL_DESTINATION_URL)?>:</th>
			<td>
				<select name="url_protocol" class="httpSelect">
					<?
					$url_protocols 	= explode(",", URL_PROTOCOL);
					$sufix = "://";
					for ($i=0; $i<count($url_protocols); $i++) {
                        if ($url_protocols[$i] != "ftp"){
                            $selected = false;
                            $protocol = $url_protocols[$i].$sufix;
                            if ($destination_protocol) {
                                if (trim($protocol) == trim($destination_protocol)) {
                                    $selected = true;
                                }
                            }
                            ?><option value="<?=$protocol?>"  <?=($selected==true  ? "selected=\"selected\"" : "")?> ><?=$protocol?></option><?
                        }
					}
					?>
				</select>
				<input style="width:79%" type="text" name="url" value="<?=$url?>" class="input-form-banner" maxlength="500" />
				<span><?=system_showText(LANG_MSG_MAX_500_CHARS)?></span>
			</td>
		</tr>
        
        <tr>
			<th class="wrap">* <?=system_showText(LANG_SITEMGR_MOBILE_ADVERT_DEVICES)?>:</th>
			<td>
                <input type="checkbox" name="device_ios" value="1" <?=($device_ios == "1") ? "checked" : "";?> class="inputAlign" />iOS
                <input type="checkbox" name="device_android" value="1" <?=($device_android == "1") ? "checked" : "";?> class="inputAlign" style="margin-left: 20px;" />Android
            </td>
		</tr>
        
        <tr>
            <th class="alignTop">* <?=system_showText(LANG_SITEMGR_MOBILE_EXPIRY);?>:</th>
            <td>
                <input type="text" name="expiration_date" id="expiration_date" value="<?=$expiration_date?>" style="width:80px;" />
                <span>(<?=format_printDateStandard()?>)</span>
            </td>
        </tr>
        
        <tr>
            <th>* <?=system_showText(LANG_LABEL_STATUS)?>:</th>
            <td>
                <?=$statusDropDown?>
            </td>
        </tr>
        
    </table>
    
    <button type="button" name="submit_button" class="input-button-form" onclick="JS_submit();"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>

    <button type="button" value="Cancel" class="input-button-form" onclick="document.getElementById('formadvertcancel').submit();"><?=system_showText(LANG_SITEMGR_CANCEL)?></button>