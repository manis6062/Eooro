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
    # * FILE: /theme/contractors/layout/header_menu.php
    # ----------------------------------------------------------------------------------------------------

?>
    <ul class="nav">

        <li <?=($activeMenuHome ? "class=\"menuActived\"" : "")?>>
            <a href="<?=NON_SECURE_URL?>">
                <?=system_showText(LANG_MENU_HOME);?>
            </a>
        </li>

        <li <?=((ACTUAL_MODULE_FOLDER == LISTING_FEATURE_FOLDER) ? "class=\"menuActived\"" : "")?>>
            <a href="<?=LISTING_DEFAULT_URL?>/">
                <?=system_showText(LANG_MENU_LISTING);?>
            </a>
        </li>

        <? if (EVENT_FEATURE == "on" && CUSTOM_EVENT_FEATURE == "on") { ?>
        <li <?=((ACTUAL_MODULE_FOLDER == EVENT_FEATURE_FOLDER) ? "class=\"menuActived\"" : "")?>>
            <a href="<?=EVENT_DEFAULT_URL?>/">
                <?=system_showText(LANG_MENU_EVENT);?>
            </a>
        </li>
        <? } ?>

        <? if (CLASSIFIED_FEATURE == "on" && CUSTOM_CLASSIFIED_FEATURE == "on") { ?>
        <li <?=((ACTUAL_MODULE_FOLDER == CLASSIFIED_FEATURE_FOLDER) ? "class=\"menuActived\"" : "")?>>
            <a href="<?=CLASSIFIED_DEFAULT_URL?>/">
                <?=system_showText(LANG_MENU_CLASSIFIED);?>
            </a>
        </li>
        <? } ?>

        <? if (ARTICLE_FEATURE == "on" && CUSTOM_ARTICLE_FEATURE == "on") { ?>
        <li <?=((ACTUAL_MODULE_FOLDER == ARTICLE_FEATURE_FOLDER) ? "class=\"menuActived\"" : "")?>>
            <a href="<?=ARTICLE_DEFAULT_URL?>/">
                <?=system_showText(LANG_MENU_ARTICLE);?>
            </a>
        </li>                
        <? } ?>

        <? if (PROMOTION_FEATURE == "on" && CUSTOM_HAS_PROMOTION == "on" && CUSTOM_PROMOTION_FEATURE == "on") { ?>
        <li <?=((ACTUAL_MODULE_FOLDER == PROMOTION_FEATURE_FOLDER) ? "class=\"menuActived\"" : "")?>>
            <a href="<?=PROMOTION_DEFAULT_URL?>/">
                <?=system_showText(LANG_MENU_PROMOTION);?>
            </a>
        </li>
        <? } ?>

        <? if (BLOG_FEATURE == "on" && CUSTOM_BLOG_FEATURE == "on") { ?>
        <li <?=((ACTUAL_MODULE_FOLDER == BLOG_FEATURE_FOLDER) ? "class=\"menuActived\"" : "")?>>
            <a href="<?=BLOG_DEFAULT_URL?>/">
                <?=system_showText(LANG_MENU_BLOG);?>
            </a>
        </li>
        <? } ?>
        
        <li class="hidden-desktop">
            <a href="<?=NON_SECURE_URL?>/<?=ALIAS_ADVERTISE_URL_DIVISOR?>.php">
                <?=system_showText(LANG_MENU_ADVERTISE);?>
            </a>
        </li>

        <li <?=((strpos($_SERVER["REQUEST_URI"], "/".ALIAS_LEAD_URL_DIVISOR.".php") !== false) ? "class=\"menuActived\"" : "")?>>
            <a href="<?=NON_SECURE_URL?>/<?=ALIAS_LEAD_URL_DIVISOR?>.php">
                <?=system_showText(LANG_MENU_ENQUIRE2);?>
            </a>
        </li>
        
    </ul>

    <? front_includeFile("usernavbar.php", "layout", $js_fileLoader); ?>