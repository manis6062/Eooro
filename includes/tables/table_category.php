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
	# * FILE: /includes/tables/table_category.php
	# ----------------------------------------------------------------------------------------------------

    if ($table_category == "ListingCategory") {
        $maxLevelCat = LISTING_CATEGORY_LEVEL_AMOUNT;
    } else { 
        $maxLevelCat = CATEGORY_LEVEL_AMOUNT;
    }

    if (is_numeric($message) && isset($msg_category[$message])) { ?>
        <p class="successMessage"><?=$msg_category[$message]?></p>
    <? } ?>


    <? if (is_numeric($langmessage) && isset($msg_category[$langmessage])) { ?>
        <? if (is_numeric($featmessage)) { ?>
            <p class="informationMessage"><?=$msg_category[$langmessage]."<br />".$msg_category[$featmessage]?></p>
        <? } else { ?>
            <p class="informationMessage"><?=$msg_category[$langmessage]?></p>
        <? } ?>
    <? } else if (is_numeric($featmessage))  { ?>
        <p class="informationMessage"><?=$msg_category[$featmessage]?></p>
    <? } ?>

    <table border="0" cellpadding="2" cellspacing="2" class="standard-tableTOPBLUE">
        <tr>
            <td colspan="3">
                <a href="<?=$url_redirect?>/index.php"><?=system_showText(LANG_SITEMGR_MENU_HOME)?></a>
                <?
                $path_count = 1;
                if ($category_id) {
                    $categoryObj = new $table_category($category_id);
                    $path_elem_array = $categoryObj->getFullPath();
                    if ($path_elem_array) {
                        foreach ($path_elem_array as $each_category) {
                            echo " <a href=\"".$url_redirect."/index.php?category_id=".$each_category["id"]."&screen=".$screen."&letter=".$letter.(($url_search_params) ? "&$url_search_params" : "")."\">&raquo; ".$each_category["title"]."</a>";
                            $path_count++;
                        }
                    }
                }
                ?>
            </td>
        </tr>
    </table>

    <? if ($categories) { ?>

        <table class="table-itemlist ">

            <tr>
                <th><?=string_ucwords(system_showText(LANG_SITEMGR_CATEGORY))?> <?=string_ucwords(system_showText(LANG_SITEMGR_TITLE))?></th>
                <? if ($path_count < $maxLevelCat) { ?>
                    <th><?=system_showText(LANG_SITEMGR_SUBCATEGORIES)?></th>
                <? } ?>
                <th></th>
                <th class="text-center"><?=system_showText(LANG_LABEL_OPTIONS)?></th>
            </tr>

            <?
            foreach ($categories as $category) {
                $categoryObj = new $table_category($category);
                $id = $categoryObj->getNumber("id");
                $subcategories = db_getFromDB(strtolower($table_category), "category_id", $id, "all", "title", "object", SELECTED_DOMAIN_ID, false, "id, `title`");
                ?>

                <tr>
                    <td>
                        <? if ($path_count < $maxLevelCat) { ?>
                            <a href="<?=$url_redirect?>/index.php?category_id=<?=$id?>" title="<?=$categoryObj->getString("title");?>">
                                <?=$categoryObj->getString("title", true, 90); ?>
                            </a>
                        <? } else { ?>
                            <?=$categoryObj->getString("title", true, 90); ?>
                        <? } ?>

                    </td>
                    <? if ($path_count < $maxLevelCat) { ?>
                        <td><?=count($subcategories);?></td>
                    <? } ?>
                    <td nowrap="nowrap">
                        <div class="toolbar-icons-button">
                            <div class="toolbar-icons">
                                <ul>
                                <? if ($path_count < $maxLevelCat) { ?>
                                    <li>
                                        <a href="<?=$url_redirect?>/category.php?category_id=<?=$id?>">
                                            <?=system_showText(LANG_SITEMGR_CATEGORY_ADDSUBCATEGORY)?>
                                        </a>
                                    </li>
                                <? } else { ?>
                                    <li><?=system_showText(LANG_SITEMGR_CATEGORY_ADDSUBCATEGORY)?></li>
                                <? } ?>								

                                <li>
                                    <a href="<?=$url_redirect?>/delete.php?id=<?=$id?>&category_id=<?=$category_id?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>">
                                        <?=string_ucwords(system_showText(LANG_SITEMGR_DELETE))?>
                                    </a>
                                </li>

                                </ul>
                            </div>
                            <div class="toolbararrow"></div>
                        </div>					

                    </td>
                    <td  nowrap="nowrap" class="main-options text-center">
                        <? if ($path_count < $maxLevelCat) { ?>
                            <a href="<?=$url_redirect?>/index.php?category_id=<?=$id?>">
                                <?=string_ucwords(system_showText(LANG_SITEMGR_VIEW))?>
                            </a>
                        <? } else { ?>
                            <?=string_ucwords(system_showText(LANG_SITEMGR_VIEW))?>
                        <? } ?>

                        <b>|</b>
                        <a href="<?=$url_redirect?>/category.php?id=<?=$id?>&category_id=<?=$category_id?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>">
                            <?=string_ucwords(system_showText(LANG_SITEMGR_EDIT))?>
                        </a>
                    </td>
                </tr>

            <? } ?>

        </table>

    <? } else { ?>
        <p class="informationMessage"><?=system_showText($message_no_record)?></p>
    <? } ?>