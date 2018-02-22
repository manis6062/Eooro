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
    # * FILE: /theme/diningguide/layout/footer_menu.php
    # ----------------------------------------------------------------------------------------------------
?>

    <li <?=($activeMenuHome ? "class=\"menuActived\"" : "")?>>
        <a href="<?=NON_SECURE_URL?>">
            <?=system_showText(LANG_MENU_HOME);?>
        </a>
    </li>
    
    <!-- The code below controls the 'By Cuisine' section of the navigation. To change the word used, it's better to edit the language file corresponding to your language, for example EN_US.php. -->
    <li <?=($activeMenuBycuisine ? "class=\"menuActived\"" : "")?>>
        <a rel="canonical" href="<?=LISTING_DEFAULT_URL."/".ALIAS_LISTING_ALLCATEGORIES_URL_DIVISOR.(USE_DOT_PHP_ON_ALLCATEGORIES_LINK == "on" ? ".php" : "/")?>">
            <?=system_showText(LANG_MENU_BYCUISINE);?>
        </a>
    </li>
    
    <!-- The code below controls the 'Best Of' section of the navigation. To change the word used, it's better to edit the language file corresponding to your language, for example EN_US.php. -->
    <li <?=($activeMenuBestof ? "class=\"menuActived\"" : "")?>>
        <a href="<?=DEFAULT_URL."/".ALIAS_BESTOF_URL_DIVISOR?>/">
            <?=system_showText(LANG_MENU_BESTOF);?>
        </a>
    </li>
    
    <? if (PROMOTION_FEATURE == "on" && CUSTOM_HAS_PROMOTION == "on" && CUSTOM_PROMOTION_FEATURE == "on") { ?>
        <!-- The code below controls the 'Deals' section of the navigation, if this module is available. To change the word used, it's better to edit the language file corresponding to your language, for example EN_US.php. -->
        <li <?=((ACTUAL_MODULE_FOLDER == PROMOTION_FEATURE_FOLDER) ? "class=\"menuActived\"" : "")?>>
            <a href="<?=PROMOTION_DEFAULT_URL?>/">
                <?=system_showText(LANG_MENU_PROMOTION);?>
            </a>
        </li>
    <? } ?>

    <? if (BLOG_FEATURE == "on" && CUSTOM_BLOG_FEATURE == "on") { ?>
        <!-- The code below controls the 'Blog' section of the navigation, if this module is available. To change the word used, it's better to edit the language file corresponding to your language, for example EN_US.php. -->
        <li <?=((ACTUAL_MODULE_FOLDER == BLOG_FEATURE_FOLDER) ? "class=\"menuActived\"" : "")?>>
            <a href="<?=BLOG_DEFAULT_URL?>/">
                <?=system_showText(LANG_MENU_BLOG);?>
            </a>
        </li>
    <? } ?>

    <!-- The code below controls the 'Advertise With Us' section of the navigation. To change the word used, it's better to edit the language file corresponding to your language, for example EN_US.php. -->
    <li <?=((strpos($_SERVER["REQUEST_URI"], "/".ALIAS_ADVERTISE_URL_DIVISOR.".php") !== false) ? "class=\"menuActived\"" : "")?>>
        <a href="<?=NON_SECURE_URL?>/<?=ALIAS_ADVERTISE_URL_DIVISOR?>.php">
            <?=system_showText(LANG_MENU_ADVERTISE);?>
        </a>
    </li>
    
    <!-- The code below controls the 'Contact Us' section of the navigation. To change the word used, it's better to edit the language file corresponding to your language, for example EN_US.php. -->
    <li <?=((strpos($_SERVER["REQUEST_URI"], "/".ALIAS_CONTACTUS_URL_DIVISOR.".php") !== false) ? "class=\"menuActived\"" : "")?>>
        <a href="<?=NON_SECURE_URL?>/<?=ALIAS_CONTACTUS_URL_DIVISOR?>.php">
            <?=system_showText(LANG_MENU_CONTACT);?>
        </a>
    </li>