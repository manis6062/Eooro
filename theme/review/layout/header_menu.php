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
    # * FILE: /theme/default/layout/header_menu.php
    # ----------------------------------------------------------------------------------------------------
?>
<li <?=($activeMenuHome ? 'class="active"' : '')?>>
    <a href="<?=NON_SECURE_URL?>">
        <?=system_showText(LANG_MENU_HOME);?>
    </a>
</li>
<li <?=((ACTUAL_MODULE_FOLDER == LISTING_FEATURE_FOLDER) ? 'class="active"' : '')?> >
    <a rel="canonical" href="<?=LISTING_DEFAULT_URL?>/">
        Reviews <?/* <?=system_showText(LANG_MENU_LISTING);?> */ ?>
    </a>
    
</li>
<!-- event -->
<?php if (EVENT_FEATURE == "on" && CUSTOM_EVENT_FEATURE == "on") : ?>
<li <?=((ACTUAL_MODULE_FOLDER == EVENT_FEATURE_FOLDER) ? 'class="active"' : '')?> >
    <a href="<?=EVENT_DEFAULT_URL?>/">
        <?=system_showText(LANG_MENU_EVENT);?>

    </a>
</li>
<?php endif; ?>
<!-- classified -->
<?php if (CLASSIFIED_FEATURE == "on" && CUSTOM_CLASSIFIED_FEATURE == "on") : ?>
<li <?=((ACTUAL_MODULE_FOLDER == CLASSIFIED_FEATURE_FOLDER) ? 'class="active"' : '')?> >
    <a href="<?=CLASSIFIED_DEFAULT_URL?>/">
        <?=system_showText(LANG_MENU_CLASSIFIED);?>
    </a>
</li>
<?php endif; ?>
<!-- article -->
<?php if (ARTICLE_FEATURE == "on" && CUSTOM_ARTICLE_FEATURE == "on") : ?>
<li <?=((ACTUAL_MODULE_FOLDER == ARTICLE_FEATURE_FOLDER) ? 'class="active"' : '')?> >
    <a href="<?=ARTICLE_DEFAULT_URL?>/">
        <?=system_showText(LANG_MENU_ARTICLE);?>
    </a>
</li>
<?php endif; ?>
<!-- promotion -->
<?php if (PROMOTION_FEATURE == "on" && CUSTOM_HAS_PROMOTION == "on" && CUSTOM_PROMOTION_FEATURE == "on") : ?>
<li <?=((ACTUAL_MODULE_FOLDER == PROMOTION_FEATURE_FOLDER) ? 'class="active"' : '')?> >
    <a href="<?=PROMOTION_DEFAULT_URL?>/">
        <?=system_showText(LANG_MENU_PROMOTION);?>
    </a>
</li>
<?php endif; ?>
<!-- blog -->
<?/*
<?php if (BLOG_FEATURE == "on" && CUSTOM_BLOG_FEATURE == "on") : ?>
<li <?=((ACTUAL_MODULE_FOLDER == BLOG_FEATURE_FOLDER) ? 'class="active"' : '')?> >
    <a href="<?=BLOG_DEFAULT_URL?>/">
        <?=system_showText(LANG_MENU_BLOG);?>
    </a>
</li>
<?php endif; ?>
*/?>
<?php if( !sess_getAccountIdFromSession() ) { // account doesnt exist so show advertise and contact ?>
<li class="<?=((strpos($_SERVER['REQUEST_URI'], '/'.ALIAS_ADVERTISE_URL_DIVISOR.'.php') !== false) ? 'active' : '')?>" >
    <a href="<?=NON_SECURE_URL?>/<?=ALIAS_ADVERTISE_URL_DIVISOR?>.php">
        <?=system_showText(LANG_MENU_ADVERTISE);?>
    </a>
    
</li>
<?/*?>
<li <?=((strpos($_SERVER["REQUEST_URI"], "/".ALIAS_CONTACTUS_URL_DIVISOR.".php") !== false) ? 'class="active" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"' : 'itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"')?> >
    <a itemprop="item" href="<?=NON_SECURE_URL?>/<?=ALIAS_CONTACTUS_URL_DIVISOR?>.php">
        <span itemprop="name"><?=system_showText(LANG_MENU_CONTACT);?></span>
    </a>
    <meta itemprop="position" content="1" />
</li>
<?*/?>
<? } 
elseif(sess_getAccountIdFromSession() ){
?>
<li class="<?=((strpos($_SERVER['REQUEST_URI'], '/'.ALIAS_ADVERTISE_URL_DIVISOR.'.php') !== false) ? 'active' : '')?>" >
    <a href="<?=NON_SECURE_URL?>/<?=ALIAS_ADVERTISE_URL_DIVISOR?>.php">
        <?=system_showText(LANG_MENU_ADVERTISE);?>
    </a>
</li>
<?/*?>
<li <?=((strpos($_SERVER["REQUEST_URI"], "/".ALIAS_CONTACTUS_URL_DIVISOR.".php") !== false) ? 'class="active"' : '')?> >
    <a href="<?=NON_SECURE_URL?>/<?=ALIAS_CONTACTUS_URL_DIVISOR?>.php">
        <?=system_showText(LANG_MENU_CONTACT);?>
    </a>
</li>
<?*/?>
<?
} 
?>
    <? //front_includeFile("usernavbar.php", "layout", $js_fileLoader); ?>
