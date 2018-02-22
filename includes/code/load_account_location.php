<style type="text/css">
    [class*="standard-table"]{
        background-color: #fff;
    }
    table.businessLocationTable tr{
        margin-bottom: 5px;
    }
    table.businessLocationTable th{
        display: block;
        overflow: hidden;
        width: 100%;
        text-align: left;
    }
    table.businessLocationTable td{
        width: 95%;
        display:block;
    }
    table.businessLocationTable label{
        margin-bottom: 0;
    }
  .standard-table span.asterik {
    color: #ff004f;
    display: inline-block;
        }
        [class*="standard-table"] select, .standardSIGNUPTable select {
            margin-bottom: 5px;
        }
</style>
<?
/* ==================================================================*\
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
  \*================================================================== */

# ----------------------------------------------------------------------------------------------------
# * FILE: /includes/code/load_location.php
# ----------------------------------------------------------------------------------------------------
# ----------------------------------------------------------------------------------------------------
# CODE
# ----------------------------------------------------------------------------------------------------
/*
 * Check if is on sitemgr / members to use different function to get locations
 */
$use_sitemgr_function = false;
if (string_strpos($_SERVER["REQUEST_URI"], SITEMGR_ALIAS) || string_strpos($_SERVER["REQUEST_URI"], MEMBERS_ALIAS)) {
    $use_sitemgr_function = true;
}

if ($advanced_search) {

    $show_legend = false;
    $has_default_location = false;
    if ($_default_locations_info) {
        $last_default_location = 0;
        $has_default_location = true;
        $locations_default_where = "";
        foreach ($_default_locations_info as $_default_location_info) {
            if ($_default_location_info["show"] == "y") {
                if (!$show_legend && (is_array($_non_default_locations) && count($_non_default_locations) > 0) && !$newLocStyle) {
                    $show_legend = true;
                    ?><label><?= system_showText(LANG_SEARCH_LABELLOCATION) ?>:</label><?
                }
                $locStr = "Location" . $_default_location_info["type"];
                $locObj = new $locStr($_default_location_info["id"]);
                $locations_default_where .= $locObj->getString("name") . ", ";
            }
            ?>
            <input type="hidden" name="location_<?= $_default_location_info["type"] ?>" value="<?= $_default_location_info["id"] ?>" /><?
            $last_default_location = $_default_location_info["type"];
        }
        $locations_default_where = string_substr($locations_default_where, 0, -2);
        $locations_default_where_replace = "yes";

        if (is_array($_non_default_locations) && ($_non_default_locations[0])) {
            foreach ($_non_default_locations as $_location_level) {
                if (${"location_" . $_location_level}) {
                    $locations_default_where_replace = "no";
                    break;
                }
            }
        }

        if ($newLocStyle) {
            $locations_default_where_replace = "no";
        }
        ?>
        <input type="hidden" name="locations_default_where" id="locations_default_where" value="<?= $locations_default_where ?>" />	
        <input type="hidden" name="locations_default_where_replace" id="locations_default_where_replace" value="<?= $locations_default_where_replace ?>" />
        <?
    }

    if ($_non_default_locations) {
        if (!$show_legend && !$newLocStyle) {
            $show_legend = true;
            ?>

            <label>
                <?= system_showText(LANG_SEARCH_LABELLOCATION) ?>:
            </label>

            <?
        }
        $firstLoc = true;
        foreach ($_non_default_locations as $_location_level) {
            system_retrieveLocationRelationship($_non_default_locations, $_location_level, $_location_father_level, $_location_child_level);
            ?>

            <div class="field loading-location" id="div_img_loading_<?= $_location_level ?>" style="display:none;">
                <img src="<?= DEFAULT_URL ?>/theme/<?= EDIR_THEME ?>/images/iconography/icon-loading-footer.gif" alt="<?= system_showText(LANG_WAITLOADING) ?>"/>
            </div>

            <div id="div_location_<?= $_location_level ?>" <?= (${"locations" . $_location_level} && ($_location_father_level !== false ? ${"location_" . $_location_father_level} : true) || ($has_default_location && $_location_level == ($last_default_location + 1) && ${"locations" . $_location_level}) ) ? "" : "style=\"display:none;\"" ?>>

                <select class="select" name="location_<?= $_location_level ?>" id="location_<?= $_location_level ?>" <? if ($_location_child_level) { ?> onchange="loadLocation('<?//= DEFAULT_URL ?>', '<?//= EDIR_LOCATIONS ?>', <?//= $_location_level ?>, <?//= $_location_child_level ?>, this.value, <?//= ($firstLoc ? "true" : "false") ?>, <?//= ($newLocStyle ? "1" : "0") ?>);" <? } elseif (!$newLocStyle) { ?> onchange="fillLocations('<?//= EDIR_LOCATIONS ?>')"<? } ?>>

                    <option id="l_location_<?= $_location_level ?>" value=""><?= system_showText(constant("LANG_SEARCH_LABELCB" . constant("LOCATION" . $_location_level . "_SYSTEM"))) ?></option>

                    <?
                    if (${"locations" . $_location_level}) {

                        foreach (${"locations" . $_location_level} as $each_location) {

                            //$selected = (${"location_".$_location_level} == $each_location["id"]) ? "selected" : "";
                            ?>
                            <option <?= $selected ?> value="<?= $each_location["id"] ?>"><?= $each_location["name"] ?></option>

                            <?
                            unset($selected);
                        }
                    }
                    $firstLoc = false;
                    ?>
                </select>

                <div class="field" id="box_no_location_found_<?= $_location_level ?>" style="display: none;">&nbsp;</div>

            </div>

            <?
        }

        $showClear = false;
        if ($location_1 || $location_2 || $location_3 || $location_4 || $location_5) {
            $showClear = true;
        }

        if (!$newLocStyle) {
            ?>

            <span class="clear-location" id="locations_clear" <?= ($showClear ? "" : "style=\"display: none\"" ) ?>>
                <a href="javascript:void(0);" class="view-button" onclick="clearLocations('<?= EDIR_LOCATIONS ?>', <?= $has_default_location ? $has_default_location : 0 ?>, <?= $last_default_location ? $last_default_location : 0 ?>);">
                    <?= system_showText(LANG_BUTTON_CLEAR) ?>
                </a>
            </span>

            <?
        }
    }
    unset($_location_father_level);
    unset($_location_child_level);
    unset($_location_level);
    unset($show_legend);
    unset($advanced_search);
} else {
    ?>
    <div id="formsLocation" class="form-location ">
        <table cellpadding="0" cellspacing="0" border="0" class="standard-table standardSIGNUPTable businessLocationTable <?= $contact ? "noMargin" : ""; ?>"> <?
            if ($_default_locations_info) {
                foreach ($_default_locations_info as $_default_location_info) {
                    if ($_default_location_info["show"] == "y") {
                        ?>
                        <tr>
                            <th> <label for="location_<?= $_default_location_info["type"] ?>"><?= system_showText(constant("LANG_LABEL_" . constant("LOCATION" . $_default_location_info["type"] . "_SYSTEM"))) ?>:</label></th>
                            <td colspan="2"> <?= $_default_location_info["name"] ?> </td>
                            <td>&nbsp;</td>
                        </tr>
                    <? }
                    ?>
                    <input type="hidden" name="location_<?= $_default_location_info["type"] ?>" value="<?= $_default_location_info["id"] ?>"><?
                }
            }

            if ($_non_default_locations) {
                foreach ($_non_default_locations as $_location_level) { //echo '<pre>'; print_r($_non_default_locations);
                if($_location_level == 1) { //use dropdown only for country. state and city on text box
                    system_retrieveLocationRelationship($_non_default_locations, $_location_level, $_location_father_level, $_location_child_level);
                    $location_name = system_showText(constant("LANG_LABEL_" . constant("LOCATION" . $_location_level . "_SYSTEM"))); //var_dump($location_name);

                    if ($location_name == "Country") {
                        $location_name = "Country";
                        $checkLocation = $country;
                        $selectLocation = system_showText(constant("LANG_SEARCH_LABELCBCOUNTRY"));
                    } 
                    // elseif ($location_name == "State") {
                    //     $location_name = "County/State";
                    //     $checkLocation = $state;
                    //     $selectLocation = system_showText(constant("LANG_SEARCH_LABELCBSTATE"));
                    // } else {
                    //     $location_name = "City/Town";
                    //     $checkLocation = $city;
                    //     $selectLocation = system_showText(constant("LANG_SEARCH_LABELCBCITY"));
                    // }
                    ?>

                    <tr id="div_location_<?= $_location_level ?>" <?= ((${"locations" . $_location_level} & $_POST["new_location" . $_location_level . "_field"] == "") || (!${"locations" . $_location_level} && ${"location_" . $_location_father_level} && !$_POST["new_location" . $_location_level . "_field"]) || ($checkLocation && $checkLocation != "")) ? "" : "style=\"display:none;\"" ?>>
                        <th>
                            <label for="location_<?= $_location_level ?>" class="location"><?= $location_name ?>:<? if ($listing->custom_checkbox1 != "n") { ?><span class="asterik">*</span><? } ?>
                            </label>
                        </th>
<!--                         <td class="field" id="div_img_loading_<?= $_location_level ?>" style="display:none;">
                            <img src="<?//= DEFAULT_URL ?>/images/content/img_loading_bar.gif" alt="<?= system_showText(LANG_WAITLOADING) ?>"/>
                        </td>
 -->                        <td id="div_select_<?= $_location_level ?>" class="field locationSelect">

                            <select <?= ((${"locations" . $_location_level} || ($checkLocation && $checkLocation != "")) ? "" : "style=\"display:none\"") ?> class="select <?= ($highlight == "description" && !${"location_" . $_location_level} ? "highlight" : "") ?>" name="<?
                            if ($_location_level == 1) {
                                echo 'country';
                            } 
                            // else if ($_location_level == 3) {
                            //     echo 'state';
                            // } else if ($_location_level == 4) {
                            //     echo 'city';
                            //}
                            ?>" id="location_<?= $_location_level ?>" <? if ($_location_child_level) { ?> onchange="loadLocationSitemgrMembers('<?= DEFAULT_URL ?>', '<?= EDIR_LOCATIONS ?>', <?= $_location_level ?>, <?= $_location_child_level ?>, this.value); <? } ?>">

                                <option id="l_location_<?= $_location_level ?>" value=""><?= $checkLocation ?></option>
                                <?
                                //echo 'test'.$checkLocation;
                                $location = 'location_' . $_location_level;


                                //retrive list of locations when edit the account
                                if ($state) {
                                    //Location 3 state/county
                                    $objLocationLabel = "Location3";
                                    ${"Location" . $_non_default_locations[1]} = new $objLocationLabel;
                                    ${"locations" . $_non_default_locations[1]} = ${"Location" . $_non_default_locations[1]}->retrieveAllLocationByLocation1($country);

                                    if ($city) {
                                        //Location4 city
                                        $objLocationLabel = "Location4";
                                        ${"Location" . $_non_default_locations[2]} = new $objLocationLabel;
                                        ${"locations" . $_non_default_locations[2]} = ${"Location" . $_non_default_locations[2]}->retrieveAllLocationByLocation1($country, $state);
                                    }
                                }


                                
                                if (is_array(${"locations" . $_location_level})) {
                                    foreach (${"locations" . $_location_level} as $each_location) {
                                        $selected = ($checkLocation == $each_location["name"]) ? "selected" : "";
                                        ?>
                                        <option <?= $selected ?> value="<?= $each_location["id"] ?>"><?= $each_location["name"] ?></option><?
                                        unset($selected);
                                    }
                                }
                                ?>
                            </select>
                            <div class="field" id="box_no_location_found_<?= $_location_level ?>" <?= (!${"locations" . $_location_level} && ${"location_" . $_location_father_level} && !$_POST["new_location" . $_location_level . "_field"] ? "" : "style=\"display:none;\"") ?>><?= system_showText(constant("LANG_LABEL_NO_LOCATIONS_FOUND")) ?>.</div>
                        </td>

                    </tr>
                    <!--text box for State and City-->
                            <tr>
                                <th>
                                <label class="location"><?="Country/State" ?>:<? if ($listing->custom_checkbox1 != "n") { ?><span class="asterik">*</span><? } ?>
                                </label>
                                </th>
                                <td>
                                <input type="text" name="state" class="select" id="location_3" value="<?php echo $state; ?>">
                                </td>
                            </tr>
                            <tr>
                                <th>
                                <label class="location"><?="City/Town" ?>:<? if ($listing->custom_checkbox1 != "n") { ?><span class="asterik">*</span><? } ?>
                                </label>
                                </th>
                                <td>
                                <input type="text" name="city" class="select" id="location_3" value="<?php echo ($city != 'city' ? $city : '') ; ?>">
                                </td>
                            </tr>

                    <?
                }
            }
                unset($_location_father_level);
                unset($_location_child_level);
                unset($_location_level);
            }
            ?>
        </table>
    </div> <? }
        ?>

<script type="text/javascript" src="<?= DEFAULT_URL ?>/scripts/location.js"></script>
<script>
<? if ($c_location_1): ?>
                                    loadLocation('<?= DEFAULT_URL ?>', '<?= EDIR_LOCATIONS ?>', 1, 3, <?= $c_location_1 ?>);
    <? /*
      var opts = document.getElementById('location_3').options;
      console.log(opts);
     */ ?>
<? endif; ?>
<? if ($c_location_3): ?>
                                    loadLocation('<?= DEFAULT_URL ?>', '<?= EDIR_LOCATIONS ?>', 3, 4, <?= $c_location_3 ?>);
<? endif; ?>
<? if ($c_location_4): ?>

<? endif; ?>
</script>