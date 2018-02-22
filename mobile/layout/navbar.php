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
	# * FILE: /mobile/layout/navbar.php
	# ----------------------------------------------------------------------------------------------------

?>

    <ul class="nav nav-tabs nav-stacked">
        <? if (string_strpos($_SERVER["PHP_SELF"], "index.php") === false) { ?>
            <li>
                <a href="<?=MOBILE_DEFAULT_URL?>/index.php" accesskey="H">
                    <i class="icon-home"></i>
                    <?=system_showText(LANG_MENU_HOME);?>
                </a>
            </li>
        <? } ?>
        
        <li class="divider"></li>
        
        <li>
            <a href="<?=MOBILE_DEFAULT_URL?>/listings.php" accesskey="L">
                <i class="icon-briefcase"></i>
                <?=system_showText(LANG_MENU_LISTING);?>
            </a>
        </li>
        
        <li class="divider"></li>
        
        <? if (EVENT_FEATURE == "on" && CUSTOM_EVENT_FEATURE == "on") { ?>
            <li>
                <a href="<?=MOBILE_DEFAULT_URL?>/events.php" accesskey="E">
                    <i class="icon-calendar"></i>
                    <?=system_showText(LANG_MENU_EVENT);?>
                </a>
            </li>
            <li class="divider"></li>
        <? } ?>
            
        <? if (CLASSIFIED_FEATURE == "on" && CUSTOM_CLASSIFIED_FEATURE == "on") { ?>
            <li>
                <a href="<?=MOBILE_DEFAULT_URL?>/classifieds.php" accesskey="C">
                    <i class="icon-th-large"></i>
                    <?=system_showText(LANG_MENU_CLASSIFIED);?>
                </a>
            </li>
            <li class="divider"></li>
        <? } ?>
            
        <? if (ARTICLE_FEATURE == "on" && CUSTOM_ARTICLE_FEATURE == "on") { ?>
            <li>
                <a href="<?=MOBILE_DEFAULT_URL?>/articles.php" accesskey="A">
                    <i class="icon-file"></i>
                    <?=system_showText(LANG_MENU_ARTICLE);?>
                </a>
            </li>
            <li class="divider"></li>   
        <? } ?>
            
        <? if (PROMOTION_FEATURE == "on" && CUSTOM_PROMOTION_FEATURE == "on" && CUSTOM_HAS_PROMOTION == "on") { ?>
            <li>
                <a href="<?=MOBILE_DEFAULT_URL?>/deals.php" accesskey="D">
                    <i class="icon-tag"></i>
                    <?=system_showText(LANG_MENU_PROMOTION);?>
                </a>
            </li>
            <li class="divider"></li>
        <? } ?>
            
        <? if (BLOG_FEATURE == "on" && CUSTOM_BLOG_FEATURE == "on") { ?>
            <li>
                <a href="<?=MOBILE_DEFAULT_URL?>/blogHome.php" accesskey="B">
                    <i class="icon-comment"></i>
                    <?=system_showText(LANG_MENU_BLOG);?>
                </a>
            </li>  
        <? } ?>
    </ul>