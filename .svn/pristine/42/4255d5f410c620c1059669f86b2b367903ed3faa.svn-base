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
	# * FILE: /sitemgr/content/content_contactus.php
	# ----------------------------------------------------------------------------------------------------

    # ----------------------------------------------------------------------------------------------------
	# FORMS DEFINES
	# ----------------------------------------------------------------------------------------------------
    if ($_SERVER["REQUEST_METHOD"] != "POST") {
        setting_get("contact_address", $contact_address);
        setting_get("contact_zipcode", $contact_zipcode);
        setting_get("contact_country", $contact_country);
        setting_get("contact_state", $contact_state);
        setting_get("contact_city", $contact_city);
        setting_get("contact_phone", $contact_phone);
        setting_get("contact_email", $contact_email);
        setting_get("contact_latitude", $contact_latitude);
        setting_get("contact_longitude", $contact_longitude);
        setting_get("contact_mapzoom", $contact_mapzoom);
        $map_zoom = $contact_mapzoom;
    }

    //Map Control
    $loadMap = false;
    $mapObj = new GoogleSettings(GOOGLE_MAPS_STATUS, $_SERVER["HTTP_HOST"]);
    if (GOOGLE_MAPS_ENABLED == "on" && $mapObj->getString("value") == "on") {
      $loadMap = true; 
     
      $hasValidCoord = false;
      
      if ($contact_latitude && $contact_longitude && is_numeric($contact_latitude) && is_numeric($contact_longitude)) {
          $hasValidCoord = true;
          $_COOKIE['showMapForm'] = 0;
      }
      
    }

?>

    <table cellpadding="0" cellspacing="0" border="0" class="standard-table">
        <tr>
            <th colspan="2" class="standard-tabletitle">
                <?=system_showText(LANG_LABEL_INFORMATION)?>
            </th>
        </tr>
        <tr>
            <th><?=system_showText(LANG_LABEL_ADDRESS)?>:</th>
            <td><input type="text" name="contact_address" id="address" value="<?=$contact_address?>" <?=($loadMap ? "onblur=\"loadMap();\"" : "")?> maxlength="50" /></td>
        </tr>
        <tr>
            <th><?=string_ucwords(ZIPCODE_LABEL)?>:</th>
            <td><input type="text" name="contact_zipcode" id="zip_code" value="<?=$contact_zipcode?>" <?=($loadMap ? "onblur=\"loadMap();\"" : "")?> maxlength="50" /></td>
        </tr>
        <tr>
            <th><?=system_showText(LANG_LABEL_COUNTRY)?>:</th>
            <td><input type="text" name="contact_country" value="<?=$contact_country?>" maxlength="50" /></td>
        </tr>
        <tr>
            <th><?=system_showText(LANG_LABEL_STATE)?>:</th>
            <td><input type="text" name="contact_state" id="state" value="<?=$contact_state?>" <?=($loadMap ? "onblur=\"loadMap();\"" : "")?> maxlength="50" /></td>
        </tr>
        <tr>
            <th><?=system_showText(LANG_LABEL_CITY)?>:</th>
            <td><input type="text" name="contact_city" id="city" value="<?=$contact_city?>" <?=($loadMap ? "onblur=\"loadMap();\"" : "")?> maxlength="50" /></td>
        </tr>
        <tr>
            <th><?=system_showText(LANG_LABEL_PHONE)?>:</th>
            <td><input type="text" name="contact_phone" value="<?=$contact_phone?>" maxlength="50" /></td>
        </tr>
        <tr>
            <th><?=system_showText(LANG_LABEL_EMAIL)?>:</th>
            <td><input type="text" name="contact_email" value="<?=$contact_email?>" maxlength="50" /></td>
        </tr>
    </table>

    <?
    if ($loadMap) {

        include(EDIRECTORY_ROOT."/includes/code/maptuning_forms.php");

    ?>

    <table cellpadding="0" cellspacing="0" border="0" class="standard-table noMargin" id="tableMapTuning" <?=($hasValidCoord ? "" : "style=\"display: none\"" )?>>
        <tr>
            <th colspan="2" class="standard-tabletitle">
                <?=system_showText(LANG_LABEL_MAP_TUNING)?> 
                <span style="display: block; white-space: normal;" id="divDisplayMap">
                    <a id="linkDisplayMap" href="javascript:void(0)" onclick="displayMapForm(false, false);">
                        <?=(($_COOKIE['showMapForm'] == 0) ? (system_showText(LANG_LABEL_HIDEMAP)) : (system_showText(LANG_LABEL_SHOWMAP)))?>
                    </a>
                </span>
                <div id="tipsMap">
                    <span style="text-align: justify;"><?=system_showText(LANG_MSG_USE_CONTROLS_TO_ADJUST)?></span>
                    <br />
                    <span style="text-align: justify;"><?=system_showText(LANG_MSG_USE_ARROWS_TO_NAVIGATE)?></span>
                    <br />
                    <span style="text-align: justify;"><?=system_showText(LANG_MSG_DRAG_AND_DROP_MARKER)?></span>
                </div>
            </th>
        </tr>

        <tr id="trMap">
            <td>
                <div id="map" class="googleBase" style="border: 1px solid #000;">&nbsp;</div>
                <input type="hidden" name="contact_latitude_longitude" id="myLatitudeLongitude" value="<?=$contact_latitude_longitude?>" />
                <input type="hidden" name="contact_mapzoom" id="map_zoom" value="<?=$contact_mapzoom?>" />
                <input type="hidden" name="contact_latitude" id="latitude" value="<?=$contact_latitude?>" />
                <input type="hidden" name="contact_longitude" id="longitude" value="<?=$contact_longitude?>" />
            </td>
        </tr>

    </table>

    <br class="clear" />

    <? } ?>

    <? if ($hasValidCoord) { ?>
        <script language="javascript" type="text/javascript">
            loadMap(false, true);
        </script>
    <? } ?>    