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
	# * FILE: /mobile/breadcrumb.php
	# ----------------------------------------------------------------------------------------------------

?>

	<div class="breadcrumb">
        
		<a href="<?=MOBILE_DEFAULT_URL?>/index.php"><?=system_showText(LANG_MENU_HOME);?></a>
        
		<? if (string_strpos($_SERVER["PHP_SELF"], "/listings.php") !== false) { ?>
			<span class="divider">></span> <?=system_showText(LANG_MENU_LISTING);?>
		
        <? } elseif ((string_strpos($_SERVER["PHP_SELF"], "/listingresults.php") !== false)) { ?>
            <span class="divider">></span> <a href="<?=MOBILE_DEFAULT_URL?>/listings.php"><?=system_showText(LANG_MENU_LISTING);?></a>
            <span class="divider">></span> <?=system_showText(LANG_RESULTS);?>
                
        <? } elseif ((string_strpos($_SERVER["PHP_SELF"], "/listingdetail.php") !== false) && $module_item_title) { ?>
            <span class="divider">></span> <a href="<?=MOBILE_DEFAULT_URL?>/listings.php"><?=system_showText(LANG_MENU_LISTING);?></a>
            <span class="divider">></span> <?=$module_item_title;?>
            
		<? } elseif (string_strpos($_SERVER["PHP_SELF"], "/events.php") !== false) { ?>
			<span class="divider">></span> <?=system_showText(LANG_MENU_EVENT);?>
		
        <? } elseif (string_strpos($_SERVER["PHP_SELF"], "/eventresults.php") !== false) { ?>
			<span class="divider">></span> <a href="<?=MOBILE_DEFAULT_URL?>/events.php"><?=system_showText(LANG_MENU_EVENT);?></a>
			<span class="divider">></span> <?=system_showText(LANG_RESULTS);?>
            
        <? } elseif ((string_strpos($_SERVER["PHP_SELF"], "/eventdetail.php") !== false) && $module_item_title) { ?>
            <span class="divider">></span> <a href="<?=MOBILE_DEFAULT_URL?>/events.php"><?=system_showText(LANG_MENU_EVENT);?></a>
            <span class="divider">></span> <?=$module_item_title;?>
		
        <? } elseif (string_strpos($_SERVER["PHP_SELF"], "/classifieds.php") !== false) { ?>
			<span class="divider">></span> <?=system_showText(LANG_MENU_CLASSIFIED);?>
		
        <? } elseif (string_strpos($_SERVER["PHP_SELF"], "/classifiedresults.php") !== false) { ?>
			<span class="divider">></span> <a href="<?=MOBILE_DEFAULT_URL?>/classifieds.php"><?=system_showText(LANG_MENU_CLASSIFIED);?></a>
			<span class="divider">></span> <?=system_showText(LANG_RESULTS);?>
            
        <? } elseif ((string_strpos($_SERVER["PHP_SELF"], "/classifieddetail.php") !== false) && $module_item_title) { ?>
            <span class="divider">></span> <a href="<?=MOBILE_DEFAULT_URL?>/classifieds.php"><?=system_showText(LANG_MENU_CLASSIFIED);?></a>
            <span class="divider">></span> <?=$module_item_title;?>
		
        <? } elseif (string_strpos($_SERVER["PHP_SELF"], "/articles.php") !== false) { ?>
			<span class="divider">></span> <?=system_showText(LANG_MENU_ARTICLE);?>
		
        <? } elseif ((string_strpos($_SERVER["PHP_SELF"], "/articleresults.php") !== false)) { ?>
			<span class="divider">></span> <a href="<?=MOBILE_DEFAULT_URL?>/articles.php"><?=system_showText(LANG_MENU_ARTICLE);?></a>
			<span class="divider">></span> <?=system_showText(LANG_RESULTS);?>
            
        <? } elseif ((string_strpos($_SERVER["PHP_SELF"], "/articledetail.php") !== false) && $module_item_title) { ?>
            <span class="divider">></span> <a href="<?=MOBILE_DEFAULT_URL?>/articles.php"><?=system_showText(LANG_MENU_ARTICLE);?></a>
            <span class="divider">></span> <?=$module_item_title;?>
    
        <? } elseif (string_strpos($_SERVER["PHP_SELF"], "/deals.php") !== false) { ?>
			<span class="divider">></span> <?=system_showText(LANG_MENU_PROMOTION);?>
		
        <? } elseif ((string_strpos($_SERVER["PHP_SELF"], "/dealresults.php") !== false)) { ?>
			<span class="divider">></span> <a href="<?=MOBILE_DEFAULT_URL?>/deals.php"><?=system_showText(LANG_MENU_PROMOTION);?></a>
			<span class="divider">></span> <?=system_showText(LANG_RESULTS);?>
            
        <? } elseif((string_strpos($_SERVER["PHP_SELF"], "/dealdetail.php") !== false) && $module_item_title) { ?>
            <span class="divider">></span> <a href="<?=MOBILE_DEFAULT_URL?>/deals.php"><?=system_showText(LANG_MENU_PROMOTION);?></a>
            <span class="divider">></span> <?=$module_item_title;?>

		<? } elseif (string_strpos($_SERVER["PHP_SELF"], "/blogHome.php") !== false) { ?>
			<span class="divider">></span> <?=system_showText(LANG_MENU_BLOG);?>
		
        <? } elseif ((string_strpos($_SERVER["PHP_SELF"], "/blogresults.php") !== false)) { ?>
			<span class="divider">></span> <a href="<?=MOBILE_DEFAULT_URL?>/blogHome.php"><?=system_showText(LANG_MENU_BLOG);?></a>
			<span class="divider">></span> <?=system_showText(LANG_RESULTS);?>
            
        <? } elseif((string_strpos($_SERVER["PHP_SELF"], "/blogdetail.php") !== false) && $module_item_title) { ?>
            <span class="divider">></span> <a href="<?=MOBILE_DEFAULT_URL?>/blogHome.php"><?=system_showText(LANG_MENU_BLOG);?></a>
            <span class="divider">></span> <?=$module_item_title;?>
		<? } ?>
	</div>