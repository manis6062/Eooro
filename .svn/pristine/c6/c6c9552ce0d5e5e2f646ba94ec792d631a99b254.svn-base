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
	# * FILE: /theme/contractors/frontend/browsebycategory.php
	# ----------------------------------------------------------------------------------------------------
    
	# ----------------------------------------------------------------------------------------------------
    # CODE
    # ----------------------------------------------------------------------------------------------------
    include_once(EDIRECTORY_ROOT."/includes/code/browsebycategory.php");
    
    $countBreak = ceil($countTotalItems / $countBreak);

	if (is_array($array_item_categories)) { ?>

        <div class="span12 flex-box-list">

            <h2>
                <b><?=system_showText(LANG_BROWSEBYCATEGORY)?></b>
                
                <? if (!$allCategoriesPage) { ?>
                    <a class="view-more" href="<?=$module_default_url."/".$alias_allcategories.(USE_DOT_PHP_ON_ALLCATEGORIES_LINK == "on" ? ".php" : "/");?>"><?=system_showText(LANG_LABEL_VIEW_ALL);?> »</a>
                <? } ?>
            </h2>

            <ul class="browse-category">

            <? 
            $countLi = 0;
            $countTotalWritten = 0;
            for ($i = 0; $i < count($array_item_categories); $i++) {
                
                $countLi++;
                $countTotalWritten++;
                ?>

                <li>

                    <a href="<?=$array_item_categories[$i]["categoryLink"]?>"><?=$array_item_categories[$i]["title"]?></a>

                    <? if ($categoryCount == "on" && $allCategoriesPage) { ?>
                        <em><?=$array_item_categories[$i]["active_".($module == "blog" ? "post" : $module)]?></em>
                    <? } ?>

                    <? if (count($array_item_categories[$i]["subcategories"])) { ?>
                        <ul class="child">
                            <? for ($j = 0; $j < count($array_item_categories[$i]["subcategories"]); $j++) { $countLi++; $countTotalWritten++; ?>
                                <li>
                                    <a href="<?=$array_item_categories[$i]["subcategories"][$j]["subCategoryLink"]?>">
                                        <?=$array_item_categories[$i]["subcategories"][$j]["subCategoryTitle"]?>
                                    </a>
                                    <? if ($categoryCount == "on" && $allCategoriesPage) { ?>
                                        <em>
                                            <?=$array_item_categories[$i]["subcategories"][$j]["active_".($module == "blog" ? "post" : $module)]?>
                                        </em>
                                    <? } ?>
                                </li>    
                            <? } ?>
                        </ul>    
                    <? } ?>

                </li>
                
                <? if ($countBreak > 0) {
                    
                    if ($countLi >= $countBreak && $countTotalWritten < $countTotalItems) {
                        $countLi = 0;
                        ?></ul><ul class="browse-category"><?
                    }
                
                } ?>

            <? } ?>

            </ul>
            
        </div> 
            
    <? } ?>