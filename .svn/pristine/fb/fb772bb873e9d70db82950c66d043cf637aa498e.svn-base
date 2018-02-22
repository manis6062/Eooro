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
	# * FILE: /includes/forms/form_levelname.php
	# ----------------------------------------------------------------------------------------------------

    unset($moduleName);
    unset($moduleMessage);
    unset($levelObj);

    switch ($module) {
        case "listing":
            $moduleName = system_showText(LANG_SITEMGR_LISTING);
            $moduleMessage = $message_listinglevelnames;
            $levelObj = new ListingLevel(true);
            $levelAObj = new ListingLevel();
            break;
        case "event":
            $moduleName = system_showText(LANG_SITEMGR_EVENT);
            $moduleMessage = $message_eventlevelnames;
            $levelObj = new EventLevel(true);
            $levelAObj = new EventLevel();
            break;
        case "banner":
            $moduleName = system_showText(LANG_SITEMGR_BANNER);
            $moduleMessage = $message_bannerlevelnames;
            $levelObj = new BannerLevel(true);
            $levelAObj = new BannerLevel();
            break;
        case "classified":
            $moduleName = system_showText(LANG_SITEMGR_CLASSIFIED);
            $moduleMessage = $message_classifiedlevelnames;
            $levelObj = new ClassifiedLevel(true);
            $levelAObj = new ClassifiedLevel();
            break;
        case "article":
            $moduleName = system_showText(LANG_SITEMGR_ARTICLE);
            $moduleMessage = $message_articlelevelnames;
            $levelObj = new ArticleLevel(true);
            $levelAObj = new ArticleLevel();
            break;
    }

    //Get fields according to level
    if ($module != "banner" && $module != "article") {
        unset($array_fields);
        $levelvalues = $levelObj->getLevelValues();
        foreach ($levelvalues as $levelvalue) {
            $array_fields[$levelvalue] = system_getFormFields(ucfirst($module), $levelvalue);
        }
    }

    if ($moduleMessage) { ?>
        <div id="warning" class="<?=$message_style?>"><?=$moduleMessage?></div>
    <? } ?>

    <div class="holder">

        <form name="<?=$module;?>levelnames" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">

            <p style="padding-bottom: 10px;"><?=system_showText(LANG_SITEMGR_SETTINGS_MANAGE_LEVELS_TIP1);?></p>

            <? if (is_numeric($message) && isset($msg_levels[$message])) { ?>
                <p class="successMessage"><?=$msg_levels[$message]?></p>
            <? } ?>

            <table cellpadding="0" cellspacing="0" border="0" rules="all">

                <tr>
                    <? if ($module != 'banner') { ?>
                    <th class="first"><?=system_showText(@constant("LANG_SITEMGR_SETTINGS_LEVELS_".strtoupper($module)));?></th>
                    <? } ?>
                    <th><?=system_showText(LANG_SITEMGR_SETTINGS_LEVELS_ACTIVE)?></th>
                    <? if ($module != 'article') { ?>
                    <th><?=system_showText(LANG_SITEMGR_SETTINGS_LEVELS_POPULAR)?></th>
                    <? } ?>
                    <th><?=system_showText(LANG_SITEMGR_SETTINGS_LEVELS_ACTUALNAME)?></th>
                    <th><?=system_showText(LANG_SITEMGR_SETTINGS_LEVELS_NEWNAME)?></th>
                </tr>

            <?
                $levelvalues = $levelObj->getLevelValues();
                $levelvalues = array_reverse($levelvalues);

                foreach ($levelvalues as $levelvalue) {
                    $displayName = ($module == "banner" ? $levelObj->getDisplayName($levelvalue) : $levelObj->getName($levelvalue));
            ?>
                    <tr <?=($class ? "class=\"$class\"" : "")?>>

                        <? if ($module != 'banner') { ?>

                            <td class="<?=($levelvalue == $levelObj->getDefault() ? "first" : "blank")?>">
                                <?=($levelvalue == $levelObj->getDefault() ?  string_ucwords(system_showText(LANG_SITEMGR_SETTINGS_LEVELS_DEFAULTLEVEL)) : "&nbsp;")?>
                            </td>

                        <? } ?>

                        <td>
                            <? if ($levelvalue == $levelObj->getDefaultLevel() && $module != 'banner') { ?>
                                <input type="checkbox" name="deactiveLevel[<?=$levelvalue?>]" class="checkbox" id="check_<?=$module;?>_<?=$levelvalue;?>" value="y" checked="checked" disabled="disabled" />
                                <input type="hidden" name="activeLevel[<?=$levelvalue?>]" value="y" />
                            <? } else { ?>
                                <input type="checkbox" name="activeLevel[<?=$levelvalue?>]" id="check_<?=$module;?>_<?=$levelvalue;?>" onclick="disableLevelField('<?=$module;?>', '<?=$levelvalue;?>');" class="checkbox" value="y" <?=($levelObj->getActive($levelvalue) == 'y') ? 'checked' : '';?> />
                            <? } ?>
                        </td>

                        <? if ($module != 'article') { ?>
                        <td>
                            <input type="checkbox" name="popularLevel[<?=$levelvalue?>]" id="radio_<?=$module;?>_<?=$levelvalue;?>" onclick="uncheckLevelField('<?=$module;?>', '<?=$levelvalue;?>');" class="checkbox" value="y" <?=($levelObj->getPopular($levelvalue) == 'y') ? 'checked' : '';?> <?=($levelObj->getActive($levelvalue) != 'y') ? 'disabled="disabled"' : '';?> />
                        </td>
                        <? } ?>

                        <td>
                            <?=string_ucwords($displayName);?>
                        </td>

                        <td>
                            <input type="text" name="nameLevel[<?=$levelvalue?>]" id="text_<?=$module;?>_<?=$levelvalue;?>" maxlength="20" value="<?=string_ucwords($displayName);?>" <?=($levelObj->getActive($levelvalue) != 'y') ? 'readonly="readonly"' : '';?>/>
                        </td>
                    </tr>
                <?
                    if ($class == "over") {
                        $class = "";
                    } else {
                        $class = "over";
                    }
                }
                ?>
            </table>

            <input type="hidden" name="changeType" value="names" />
            <input type="hidden" name="module" value="<?=$module?>" />

            <button type="submit" name="<?=$module;?>levelnames" value="Submit" class="input-button-form"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>

        </form>

    </div>
    <!-- First table complete -->

    <?
        $priorityArray = array( 'facebook'      => 'Facebook Box',
                                'twitter'       => 'Twitter Box',
                                'recentreview'  => 'Recent Reviews',
                                'banner'        => 'Banners'
                );
        setting_get( 'listing_detail_priority_one', $priorityOne);
        setting_get( 'listing_detail_priority_two', $priorityTwo);
        setting_get( 'listing_detail_priority_three', $priorityThree);
        setting_get( 'listing_detail_priority_four', $priorityFour);

        //Enable Disable
        setting_get( 'listing_detail_show_facebook', $listing_detail_show_facebook);
        setting_get( 'listing_detail_show_twitter', $listing_detail_show_twitter);
        setting_get( 'listing_detail_show_recentreview', $listing_detail_show_recentreview);
        setting_get( 'listing_detail_show_banner', $listing_detail_show_banner);

        //Make priority one and two social

        $social_priority = $priorityArray;
        unset($social_priority['recentreview']);
        unset($social_priority['banner']);

        //Make priority two and there banner
        $footer_priority = $priorityArray;
        unset($footer_priority['twitter']);
        unset($footer_priority['facebook']);
        

    ?>
    <!--  Second table added for priority  -->
    <p style="padding-bottom: 10px;">
        Select the priority by which recent reviews / Facebook feed or Banners
        appear on the Listing Details page's sidebar.
    </p>

    <div class="holder">
        <form name="<?=$module?>Priority" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">
            <table cellpadding="0" cellspacing="0" border="0" rules="all">
                <tr>
                    <th>Priorities</th>
                    <th>First</th>
                    <th>Second</th>
                    <th>Third</th>
                    <th>Forth</th>
                </tr>
                <tr>
                    <td>Select Priority</td>
                    <td>
                        <select name="priority-one" id="priority-one">
                            <option value="0">-Select 1st-</option>
                            <? foreach ($social_priority as $key => $value) : ?>
                                <option value="<?=$key?>" <?=($key===$priorityOne) ? 'selected="selected"' : ''?>><?=$value?></option>
                            <? endforeach;?>
                        </select>
                    </td>
                    <td>
                        <select name="priority-two" id="priority-one">
                            <option value="0">-Select 2nd-</option>
                            <? foreach ($social_priority as $key => $value) : ?>
                                <option value="<?=$key?>" <?=($key===$priorityTwo) ? 'selected="selected"' : ''?>><?=$value?></option>
                            <? endforeach;?>
                        </select>
                    </td>
                    <td>
                        <select name="priority-three" id="priority-one">
                            <option value="0">-Select 3rd-</option>
                            <? foreach ($footer_priority as $key => $value) : ?>
                                <option value="<?=$key?>" <?=($key===$priorityThree) ? 'selected="selected"' : ''?>><?=$value?></option>
                            <? endforeach;?>
                        </select>
                    </td>
                    <td>
                        <select name="priority-four" id="priority-one">
                            <option value="0">-Select 4th-</option>
                            <? foreach ($footer_priority as $key => $value) : ?>
                                <option value="<?=$key?>" <?=($key===$priorityFour) ? 'selected="selected"' : ''?>><?=$value?></option>
                            <? endforeach;?>
                        </select>
                    </td>
                </tr>
            </table>
            <table cellpadding="0" cellspacing="0" border="0" rules="all">
                <th>Enable/Disable</th>
                <th></th>
                <? foreach ($priorityArray as $key => $value) { ?>
                <tr>
                    <td><?=$value?></td><td><input type="checkbox" name="listing_detail_show_<?=$key?>" <? echo (!empty(${"listing_detail_show_" . $key})? "checked" : ""); ?>></td>
                </tr>
                <? } ?>
            </table>
            <button type="submit" name="prioritySubmit" class="input-button-form">Submit</button>
        </form>
    </div>
    <? if ($module != "banner" && $module != "article") { ?>

    <p style="padding-bottom: 10px;"><?=system_showText(str_replace("[openlink]", "<a href=\"".DEFAULT_URL."/".SITEMGR_ALIAS."/content/advertisement.php\">", str_replace("[closelink]", "</a>", LANG_SITEMGR_SETTINGS_MANAGE_LEVELS_TIP2)));?></p>

    <div class="holder">

        <form name="<?=$module;?>levelfields" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">

            <? if (is_numeric($msg) && isset($msg_levels[$msg])) { ?>
                <p class="successMessage"><?=$msg_levels[$msg]?></p>
            <? } ?>

            <table cellpadding="0" cellspacing="0" border="0" rules="all">

                <tr>
                    <th class="first">
                        <?=system_showText(@constant("LANG_SITEMGR_SETTINGS_LEVELS_".strtoupper($module)."FIELDS"));?> <span><?=system_showText(LANG_SITEMGR_SETTINGS_LEVELS_ITEMTIP);?></span>
                    </th>
                    <?
                        $levelvalues = $levelAObj->getLevelValues();
                        foreach ($levelvalues as $levelvalue) {
                            $displayName = ucfirst($module == "banner" ? $levelObj->getDisplayName($levelvalue) : $levelObj->getName($levelvalue)); ?>
                            <th><?=$displayName?></th>
                    <? } ?>
                </tr>

                <? if ($module != "article") { ?>
                <tr>
                    <td class="first">
                        <strong><?=ucfirst(system_showText(LANG_LABEL_DETAIL_PAGE))?></strong> <span class="note"><?=system_showText(LANG_SITEMGR_SETTINGS_LEVELS_ITEMTIP_DETAIL);?></span>
                    </td>
                    <? foreach ($levelvalues as $levelvalue) { ?>
                    <td>
                        <input type="checkbox" name="detail[<?=$levelvalue?>]"  class="checkbox" value="y" <?=$levelObj->getDetail($levelvalue) == 'y'?'checked':''; ?> />
                    </td>
                    <? } ?>
                </tr>
                <? } ?>

                <? if ($module == 'listing' && PROMOTION_FEATURE == 'on') {  ?>
                <tr class="over">
                    <td class="first">
                        <strong><?=ucfirst(system_showText(LANG_SITEMGR_PROMOTION_PLURAL))?></strong> <span class="note"><?=system_showText(LANG_SITEMGR_SETTINGS_LEVELS_LISTINGTIP_DEAL);?></span>
                    </td>
                    <? foreach ($levelvalues as $levelvalue) { ?>
                    <td>
                        <input type="checkbox" name="hasPromotion[<?=$levelvalue?>]"  class="checkbox" value="y" <?=$levelObj->getHasPromotion($levelvalue) == 'y'?'checked':''; ?> />
                    </td>
                    <? } ?>
                </tr>
                <? } ?>

                <? if ($module == 'listing' && $review_listing_enabled) { ?>
                <tr>
                    <td class="first"><strong><?=ucfirst(system_showText(LANG_SITEMGR_REVIEWS))?></strong> <span class="note"><?=system_showText(LANG_SITEMGR_SETTINGS_LEVELS_LISTINGTIP_REVIEW);?></span></td>
                    <? foreach ($levelvalues as $levelvalue) { ?>
                    <td>
                        <input type="checkbox" name="hasReview[<?=$levelvalue?>]" class="checkbox" value="y" <?=($levelObj->getHasReview($levelvalue) == 'y') ? 'checked' : '';?> />
                    </td>
                    <? } ?>
                </tr>
                <? } ?>

                <!-- modification -->
                <? if ($module == 'listing' && $review_listing_enabled) { ?>
                <tr>
                    <td class="first"><strong>Reply To Reviews</strong> <span class="note">Allows users to reply to their listing's review.</span></td>
                    <? foreach ($levelvalues as $levelvalue) { ?>
                    <td>
                        <input type="checkbox" name="replyReview[<?=$levelvalue?>]" class="checkbox" value="y" <?=($levelObj->getReplyReview($levelvalue) == 'y') ? 'checked' : '';?> />
                    </td>
                    <? } ?>
                </tr>
                <? } ?>

                <? if ($module == 'listing' && $review_listing_enabled) { ?>
                <tr>
                    <td class="first"><strong>Open Case for Review</strong> <span class="note">Allows users to open case for their listing's review.</span></td>
                    <? foreach ($levelvalues as $levelvalue) { ?>
                    <td>
                        <input type="checkbox" name="openCase[<?=$levelvalue?>]" class="checkbox" value="y" <?=($levelObj->getOpenCase($levelvalue) == 'y') ? 'checked' : '';?> />
                    </td>
                    <? } ?>
                </tr>
                <? } ?>

                <? if ($module == 'listing' && TWILIO_APP_ENABLED == "on" && TWILIO_APP_ENABLED_SMS == "on") { ?>
                <tr class="over">
                    <td class="first"><strong><?=ucfirst(system_showText(LANG_SITEMGR_SEND_PHONE))?></strong> <span class="note"><?=system_showText(LANG_SITEMGR_SETTINGS_LEVELS_LISTINGTIP_SENDPHONE);?></span></td>
                    <? foreach ($levelvalues as $levelvalue) { ?>
                    <td>
                        <input type="checkbox" name="hasSms[<?=$levelvalue?>]" class="checkbox" value="y" <?=($levelObj->getHasSms($levelvalue) == 'y') ? 'checked' : '';?> />
                    </td>
                    <? } ?>
                </tr>
                <? } ?>

                <? if ($module == 'listing' && TWILIO_APP_ENABLED == "on" && TWILIO_APP_ENABLED_CALL == "on") { ?>
                <tr>
                    <td class="first"><strong><?=ucfirst(system_showText(LANG_SITEMGR_CLICK_CALL))?></strong> <span class="note"><?=system_showText(LANG_SITEMGR_SETTINGS_LEVELS_LISTINGTIP_CLICKCALL);?></span></td>
                    <? foreach ($levelvalues as $levelvalue) { ?>
                    <td>
                        <input type="checkbox" name="hasCall[<?=$levelvalue?>]" class="checkbox" value="y" <?=($levelObj->getHasCall($levelvalue) == 'y') ? 'checked' : '';?> />
                    </td>
                    <? } ?>
                </tr>
                <? } ?>

                <? if ($module == 'listing' && BACKLINK_FEATURE == "on") { ?>
                <tr class="over">
                    <td class="first"><strong><?=ucfirst(system_showText(LANG_LABEL_BACKLINK))?></strong> <span class="note"><?=system_showText(LANG_SITEMGR_SETTINGS_LEVELS_LISTINGTIP_BACKLINK);?></span></td>
                    <? foreach ($levelvalues as $levelvalue) { ?>
                    <td>
                        <input type="checkbox" name="backlink[<?=$levelvalue?>]" class="checkbox" value="y" <?=($levelObj->getBacklink($levelvalue) == 'y') ? 'checked' : '';?> />
                    </td>
                    <? } ?>
                </tr>
                <? } ?>

                <? if ($module == 'listing' || $module == 'event') { ?>
                <tr <?=($module == 'event' ? "class=\"over\"" : "")?>>
                    <td class="first"><strong><?=ucfirst(system_showText(LANG_LABEL_EMAIL))?></strong> <span class="note"><?=system_showText(LANG_SITEMGR_SETTINGS_LEVELS_ITEMTIP_EMAIL);?></span></td>
                    <? foreach ($levelvalues as $levelvalue) { ?>
                    <td>
                        <input type="checkbox" name="itemLevel_email[<?=$levelvalue?>]" class="checkbox" value="y" <?=(is_array($array_fields[$levelvalue]) && in_array("email", $array_fields[$levelvalue])) ? 'checked' : '';?> />
                    </td>
                    <? } ?>
                </tr>
                <? } ?>

                <? if ($module != "article") { ?>
                <tr <?=($module == 'event' ? "" : "class=\"over\"")?>>
                    <td class="first"><strong><?=ucfirst(system_showText(LANG_LABEL_URL))?></strong> <span class="note"><?=system_showText(LANG_SITEMGR_SETTINGS_LEVELS_ITEMTIP_URL);?></span></td>
                    <? foreach ($levelvalues as $levelvalue) { ?>
                    <td>
                        <input type="checkbox" name="itemLevel_url[<?=$levelvalue?>]" class="checkbox" value="y" <?=(is_array($array_fields[$levelvalue]) && in_array("url", $array_fields[$levelvalue])) ? 'checked' : '';?> />
                    </td>
                    <? } ?>
                </tr>
                <? } ?>

                <? if ($module == 'listing' || $module == 'event') { ?>
                <tr <?=($module == 'event' ? "class=\"over\"" : "")?>>
                    <td class="first"><strong><?=ucfirst(system_showText(LANG_LABEL_PHONE))?></strong> <span class="note"><?=system_showText(LANG_SITEMGR_SETTINGS_LEVELS_ITEMTIP_PHONE);?></span></td>
                    <? foreach ($levelvalues as $levelvalue) { ?>
                    <td>
                        <input type="checkbox" name="itemLevel_phone[<?=$levelvalue?>]" class="checkbox" value="y" <?=(is_array($array_fields[$levelvalue]) && in_array("phone", $array_fields[$levelvalue])) ? 'checked' : '';?> />
                    </td>
                    <? } ?>
                </tr>
                <? } ?>

                <? if ($module == 'listing' || $module == 'classified') { ?>
                <tr <?=($module == 'classified' ? "" : "class=\"over\"")?>>
                    <td class="first"><strong><?=ucfirst(system_showText(LANG_LABEL_FAX))?></strong> <span class="note"><?=system_showText(LANG_SITEMGR_SETTINGS_LEVELS_ITEMTIP_FAX);?></span></td>
                    <? foreach ($levelvalues as $levelvalue) { ?>
                    <td>
                        <input type="checkbox" name="itemLevel_fax[<?=$levelvalue?>]" class="checkbox" value="y" <?=(is_array($array_fields[$levelvalue]) && in_array("fax", $array_fields[$levelvalue])) ? 'checked' : '';?> />
                    </td>
                    <? } ?>
                </tr>
                <? } ?>

                <tr <?=($module == 'classified' ? "class=\"over\"" : "")?>>
                    <td class="first"><strong><?=ucfirst(system_showText(LANG_LABEL_IMAGERY))?></strong> <span class="note"><?=system_showText(LANG_SITEMGR_SETTINGS_LEVELS_ITEMTIP_IMAGERY);?></span></td>
                    <?
                    foreach ($levelvalues as $levelvalue) {

                        $auxImages = $levelObj->getImages($levelvalue);

                        if ($module == "article" && $auxImages) {
                            $levelImages = $auxImages;
                        } else {
                            if (is_array($array_fields[$levelvalue]) && !in_array("main_image", $array_fields[$levelvalue]) && $auxImages == 0) { //no main image and no gallery
                                $levelImages = 0;
                            } elseif (is_array($array_fields[$levelvalue]) && in_array("main_image", $array_fields[$levelvalue]) && $auxImages == 0) { //only main image, no gallery
                                $levelImages = 1;
                            } elseif (is_array($array_fields[$levelvalue]) && in_array("main_image", $array_fields[$levelvalue]) && $auxImages > 0) { //main image + gallery
                                $levelImages = ++$auxImages;
                            }
                        }
                    ?>
                    <td>
                        <select name="images[<?=$levelvalue?>]" class="small">
                            <? for ($i = 0; $i <= GALLERY_ITEM_MAX_IMAGES; $i++) { ?>
                            <option value="<?=$i?>" <?=($i == $levelImages ? "selected=\"selected\"" : "")?>><?=$i?></option>
                            <? } ?>
                        </select>
                    </td>
                    <? } ?>
                </tr>

                <? if ($module == 'listing' || $module == "event") { ?>
                <tr class="over">
                    <td class="first"><strong><?=ucfirst(system_showText(LANG_LABEL_VIDEOS))?></strong> <span class="note"><?=system_showText(LANG_SITEMGR_SETTINGS_LEVELS_ITEMTIP_VIDEO);?></span></td>
                    <? foreach ($levelvalues as $levelvalue) { ?>
                    <td>
                        <input type="checkbox" name="itemLevel_video[<?=$levelvalue?>]" class="checkbox" value="y" <?=(is_array($array_fields[$levelvalue]) && in_array("video", $array_fields[$levelvalue])) ? 'checked' : '';?> />
                    </td>
                    <? } ?>
                </tr>
                <?  } ?>

                <? if ($module == "listing") { ?>
                <tr>
                    <td class="first"><strong><?=ucfirst(system_showText(LANG_LABEL_ATTACH))?></strong> <span class="note"><?=system_showText(LANG_SITEMGR_SETTINGS_LEVELS_ITEMTIP_ATTACH);?></span></td>
                    <? foreach ($levelvalues as $levelvalue) { ?>
                    <td>
                        <input type="checkbox" name="itemLevel_attachment_file[<?=$levelvalue?>]" class="checkbox" value="y" <?=(is_array($array_fields[$levelvalue]) && in_array("attachment_file", $array_fields[$levelvalue])) ? 'checked' : '';?> />
                    </td>
                    <? } ?>
                </tr>
                <? } ?>

                <? if ($module != "article") { ?>
                <tr <?=($module == 'classified' ? "" : "class=\"over\"")?>>
                    <td class="first"><strong><?=ucfirst(system_showText(LANG_LABEL_SUMMARY_DESCRIPTION))?> (<?=system_showText(LANG_MSG_MAX_250_CHARS)?>)</strong> <span class="note"><?=system_showText(LANG_SITEMGR_SETTINGS_LEVELS_ITEMTIP_SUMMARYDESC);?></span></td>
                    <? foreach ($levelvalues as $levelvalue) { ?>
                    <td>
                        <input type="checkbox" name="itemLevel_summary_description[<?=$levelvalue?>]" class="checkbox" value="y" <?=(is_array($array_fields[$levelvalue]) && in_array("summary_description", $array_fields[$levelvalue])) ? 'checked' : '';?> />
                    </td>
                    <? } ?>
                </tr>

                <tr <?=($module == 'classified' ? "class=\"over\"" : "")?>>
                    <td class="first"><strong><?=ucfirst(system_showText(LANG_LABEL_LONG_DESCRIPTION))?></strong> <span class="note"><?=system_showText(LANG_SITEMGR_SETTINGS_LEVELS_ITEMTIP_LONGDESC);?></span></td>
                    <? foreach ($levelvalues as $levelvalue) { ?>
                    <td>
                        <input type="checkbox" name="itemLevel_long_description[<?=$levelvalue?>]" class="checkbox" value="y" <?=(is_array($array_fields[$levelvalue]) && in_array("long_description", $array_fields[$levelvalue])) ? 'checked' : '';?> />
                    </td>
                    <? } ?>
                </tr>
                <? } ?>

                <? if ($module == 'listing') { ?>
                <tr class="over">
                    <td class="first"><strong><?=ucfirst(system_showText(LANG_LABEL_HOURS_OF_WORK))?></strong> <span class="note"><?=system_showText(LANG_SITEMGR_SETTINGS_LEVELS_ITEMTIP_HOURS);?></span></td>
                    <? foreach ($levelvalues as $levelvalue) { ?>
                    <td>
                        <input type="checkbox" name="itemLevel_hours_of_work[<?=$levelvalue?>]" class="checkbox" value="y" <?=(is_array($array_fields[$levelvalue]) && in_array("hours_of_work", $array_fields[$levelvalue])) ? 'checked' : '';?> />
                    </td>
                    <? } ?>
                </tr>

                <tr>
                    <td class="first"><strong><?=ucfirst(system_showText(LANG_LABEL_LOCATIONS))?></strong> <span class="note"><?=system_showText(LANG_SITEMGR_SETTINGS_LEVELS_ITEMTIP_LOCATIONS);?></span></td>
                    <? foreach ($levelvalues as $levelvalue) { ?>
                    <td>
                        <input type="checkbox" name="itemLevel_locations[<?=$levelvalue?>]" class="checkbox" value="y" <?=(is_array($array_fields[$levelvalue]) && in_array("locations", $array_fields[$levelvalue])) ? 'checked' : '';?> />
                    </td>
                    <? } ?>
                </tr>

                <tr class="over">
                    <td class="first"><strong><?=ucfirst(system_showText(LANG_LISTING_DESIGNATION_PLURAL))?></strong> <span class="note"><?=system_showText(LANG_SITEMGR_SETTINGS_LEVELS_ITEMTIP_BADGES);?></span></td>
                    <? foreach ($levelvalues as $levelvalue) { ?>
                    <td>
                        <input type="checkbox" name="itemLevel_badges[<?=$levelvalue?>]" class="checkbox" value="y" <?=(is_array($array_fields[$levelvalue]) && in_array("badges", $array_fields[$levelvalue])) ? 'checked' : '';?> />
                    </td>
                    <? } ?>
                </tr>

                <? if (THEME_LISTING_PRICE) { ?>
                <tr>
                    <td class="first"><strong><?=ucfirst(system_showText(LANG_LABEL_PRICE))?></strong> <span class="note"><?=system_showText(LANG_SITEMGR_SETTINGS_LEVELS_ITEMTIP_LISTINGPRICE);?></span></td>
                    <? foreach ($levelvalues as $levelvalue) { ?>
                    <td>
                        <input type="checkbox" name="itemLevel_price[<?=$levelvalue?>]" class="checkbox" value="y" <?=(is_array($array_fields[$levelvalue]) && in_array("price", $array_fields[$levelvalue])) ? 'checked' : '';?> />
                    </td>
                    <? } ?>
                </tr>
                <?  } ?>

                <? if (THEME_LISTING_FBPAGE) { ?>
                <tr class="over">
                    <td class="first"><strong><?=ucfirst(system_showText(LANG_LABEL_FBPAGE))?></strong> <span class="note"><?=system_showText(LANG_SITEMGR_SETTINGS_LEVELS_ITEMTIP_FBPAGE);?></span></td>
                    <? foreach ($levelvalues as $levelvalue) { ?>
                    <td>
                        <input type="checkbox" name="itemLevel_fbpage[<?=$levelvalue?>]" class="checkbox" value="y" <?=(is_array($array_fields[$levelvalue]) && in_array("fbpage", $array_fields[$levelvalue])) ? 'checked' : '';?> />
                    </td>
                    <? } ?>
                </tr>
                <?  } ?>

                <? if (THEME_LISTING_FEATURES) { ?>
                <tr>
                    <td class="first"><strong><?=ucfirst(system_showText(LANG_LABEL_FEATURES))?></strong> <span class="note"><?=system_showText(LANG_SITEMGR_SETTINGS_LEVELS_ITEMTIP_FEATURES);?></span></td>
                    <? foreach ($levelvalues as $levelvalue) { ?>
                    <td>
                        <input type="checkbox" name="itemLevel_features[<?=$levelvalue?>]" class="checkbox" value="y" <?=(is_array($array_fields[$levelvalue]) && in_array("features", $array_fields[$levelvalue])) ? 'checked' : '';?> />
                    </td>
                    <? } ?>
                </tr>
                <? } ?>

                <? } ?>

                <? if ($module == 'event' || $module == 'classified') { ?>
                <tr <?=($module == 'classified' ? "" : "class=\"over\"")?>>
                    <td class="first"><strong><?=ucfirst(system_showText(LANG_LABEL_CONTACTNAME))?></strong> <span class="note"><?=system_showText(LANG_SITEMGR_SETTINGS_LEVELS_ITEMTIP_CONTACTNAME);?></span></td>
                    <? foreach ($levelvalues as $levelvalue) { ?>
                    <td>
                        <input type="checkbox" name="itemLevel_contact_name[<?=$levelvalue?>]" class="checkbox" value="y" <?=(is_array($array_fields[$levelvalue]) && in_array("contact_name", $array_fields[$levelvalue])) ? 'checked' : '';?> />
                    </td>
                    <? } ?>
                </tr>
                <? } ?>

                <? if ($module == 'event') { ?>
                <tr>
                    <td class="first"><strong><?=ucfirst(system_showText(LANG_LABEL_EVENTTIME))?></strong> <span class="note"><?=system_showText(LANG_SITEMGR_SETTINGS_LEVELS_ITEMTIP_EVENTTIME);?></span></td>
                    <? foreach ($levelvalues as $levelvalue) { ?>
                    <td>
                        <input type="checkbox" name="itemLevel_time[<?=$levelvalue?>]" class="checkbox" value="y" <?=(is_array($array_fields[$levelvalue]) && in_array("start_time", $array_fields[$levelvalue]) && in_array("end_time", $array_fields[$levelvalue])) ? 'checked' : '';?> />
                    </td>
                    <? } ?>
                </tr>
                <? } ?>

                <? if ($module == 'classified') { ?>
                <tr class="over">
                    <td class="first"><strong><?=ucfirst(system_showText(LANG_LABEL_CONTACT_PHONE))?></strong> <span class="note"><?=system_showText(LANG_SITEMGR_SETTINGS_LEVELS_ITEMTIP_CONTACTPHONE);?></span></td>
                    <? foreach ($levelvalues as $levelvalue) { ?>
                    <td>
                        <input type="checkbox" name="itemLevel_contact_phone[<?=$levelvalue?>]" class="checkbox" value="y" <?=(is_array($array_fields[$levelvalue]) && in_array("contact_phone", $array_fields[$levelvalue])) ? 'checked' : '';?> />
                    </td>
                    <? } ?>
                </tr>

                <tr>
                    <td class="first"><strong><?=ucfirst(system_showText(LANG_LABEL_CONTACT_EMAIL))?></strong> <span class="note"><?=system_showText(LANG_SITEMGR_SETTINGS_LEVELS_ITEMTIP_CONTACTEMAIL);?></span></td>
                    <? foreach ($levelvalues as $levelvalue) { ?>
                    <td>
                        <input type="checkbox" name="itemLevel_contact_email[<?=$levelvalue?>]" class="checkbox" value="y" <?=(is_array($array_fields[$levelvalue]) && in_array("contact_email", $array_fields[$levelvalue])) ? 'checked' : '';?> />
                    </td>
                    <? } ?>
                </tr>

                <tr class="over">
                    <td class="first"><strong><?=ucfirst(system_showText(LANG_LABEL_CLASSIFIED_PRICE))?></strong> <span class="note"><?=system_showText(LANG_SITEMGR_SETTINGS_LEVELS_ITEMTIP_PRICE);?></span></td>
                    <? foreach ($levelvalues as $levelvalue) { ?>
                    <td>
                        <input type="checkbox" name="itemLevel_price[<?=$levelvalue?>]" class="checkbox" value="y" <?=(is_array($array_fields[$levelvalue]) && in_array("price", $array_fields[$levelvalue])) ? 'checked' : '';?> />
                    </td>
                    <? } ?>
                </tr>
                <? } ?>

            </table>

            <button type="submit" name="<?=$module;?>levelfields" value="Submit" class="input-button-form"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>

            <input type="hidden" name="changeType" value="fields" />
            <input type="hidden" name="module" value="<?=$module?>" />

        </form>

    </div>

    <? } ?>
    <script>
        $(document).ready(function(){
            $( 'table:eq(1) tr:even' ).css( "background-color", "#bbf");
            $( 'table:eq(1) tr:odd' ).css( "background-color", "#ded");
        });
    </script>
