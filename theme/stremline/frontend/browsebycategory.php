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
	# * FILE: /theme/default/frontend/browsebycategory.php
	# ----------------------------------------------------------------------------------------------------
    
	# ----------------------------------------------------------------------------------------------------
    # CODE
    # ----------------------------------------------------------------------------------------------------
    include_once(EDIRECTORY_ROOT."/includes/code/browsebycategory.php");
    
	if (is_array($array_item_categories)) { ?>

        <h3 <?=(!$allCategoriesPage ? "onclick=\"collapseBrowseBy($(this), '', 'browse_category', true, true);\"" : "")?>>
            <b class="title-filter"><?=system_showText(LANG_BROWSEBYCATEGORY)?> </b>
            <? if (!$allCategoriesPage) { ?>
            <a href="javascript:void(0);" class="icon-caret-down"></a>
            <? } ?>
        </h3>

        <ul id="browse_category_" class="item-select">

        <? for ($i = 0; $i < count($array_item_categories); $i++) { ?>

            <li>
                
                <? if (count($array_item_categories[$i]["subcategories"])) { ?>
                    <a href="javascript: void(0);" onclick="collapseBrowseBy($(this), <?=$i?>, 'subcateg', true, false);" class="icon-caret-right"></a>
                <? } ?>
                
                <a href="<?=$array_item_categories[$i]["categoryLink"]?>"><?=$array_item_categories[$i]["title"]?></a>
                
                <? if ($categoryCount == "on") { ?>
                    <em><?=$array_item_categories[$i]["active_".($module == "blog" ? "post" : $module).($allCategoriesPage ? "" : "_truncated")]?></em>
                <? } ?>
                
                <? if (count($array_item_categories[$i]["subcategories"])) { ?>
                    <ul id="subcateg_<?=$i?>" class="child" style="display:none;">
                        <? for ($j = 0; $j < count($array_item_categories[$i]["subcategories"]); $j++) { ?>
                            <li>
                                <a href="<?=$array_item_categories[$i]["subcategories"][$j]["subCategoryLink"]?>">
                                    <?=$array_item_categories[$i]["subcategories"][$j]["subCategoryTitle"]?>
                                </a>
                                <? if ($categoryCount == "on") { ?>
                                    <em>
                                        <?=$array_item_categories[$i]["subcategories"][$j]["active_".($module == "blog" ? "post" : $module).($allCategoriesPage ? "" : "_truncated")]?>
                                    </em>
                                <? } ?>
                            </li>    
                        <? } ?>
                    </ul>    
                <? } ?>

            </li> 

        <? } ?>

        </ul>
            
    <? } ?>