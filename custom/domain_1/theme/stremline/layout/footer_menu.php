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
    # * FILE: /theme/default/layout/footer_menu.php
    # ----------------------------------------------------------------------------------------------------
?>

    <li>
        <a rel="canonical" href="<?=LISTING_DEFAULT_URL?>/">
            <?=system_showText(LANG_MENU_LISTING);?>
        </a>
    </li>

    <? if (EVENT_FEATURE == "on" && CUSTOM_EVENT_FEATURE == "on") { ?>
    <li>
        <a href="<?=EVENT_DEFAULT_URL?>/">
            <?=system_showText(LANG_MENU_EVENT);?>
        </a>
    </li>
    <? } ?>

    <? if (CLASSIFIED_FEATURE == "on" && CUSTOM_CLASSIFIED_FEATURE == "on") { ?>
    <li>
        <a href="<?=CLASSIFIED_DEFAULT_URL?>/">
            <?=system_showText(LANG_MENU_CLASSIFIED);?>
        </a>
    </li>
    <? } ?>

    <? if (ARTICLE_FEATURE == "on" && CUSTOM_ARTICLE_FEATURE == "on") { ?>
    <li>
        <a href="<?=ARTICLE_DEFAULT_URL?>/">
            <?=system_showText(LANG_MENU_ARTICLE);?>
        </a>
    </li>
    <? } ?>

    <? if (PROMOTION_FEATURE == "on" && CUSTOM_HAS_PROMOTION == "on" && CUSTOM_PROMOTION_FEATURE == "on") { ?>
    <li>
        <a href="<?=PROMOTION_DEFAULT_URL?>/">
            <?=system_showText(LANG_MENU_PROMOTION);?>
        </a>
    </li>
    <? } ?>

    <? if (BLOG_FEATURE == "on" && CUSTOM_BLOG_FEATURE == "on") { ?>
    <li>
        <a href="<?=BLOG_DEFAULT_URL?>/">
            <?=system_showText(LANG_MENU_BLOG);?>
        </a>
    </li>
    <? } ?>