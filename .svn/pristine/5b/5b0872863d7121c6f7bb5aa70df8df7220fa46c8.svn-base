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
	# * FILE: /includes/tables/table_levels_submenu.php
	# ----------------------------------------------------------------------------------------------------

$openPMlisting = ($module == "listing");
$openPMevent = ($module == "event");
$openPMbanner = ($module == "banner");
$openPMclassified = ($module == "classified");
$openPMarticle = ($module == "article");
?>

<div class="submenu">
	<ul>
		<li id="privateMenu_levelListing"><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/prefs/levels.php"><?=system_showText(LANG_SITEMGR_NAVBAR_LISTING)?></a></li>
		
        <? if (permission_hasSMPermSection(SITEMGR_PERMISSION_BANNERS) && BANNER_FEATURE == "on") { ?>
        <li id="privateMenu_levelBanner"><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/prefs/levels.php?module=banner"><?=string_ucwords(system_showText(LANG_SITEMGR_NAVBAR_BANNER))?></a></li>
        <? } ?>
        
        <? if (permission_hasSMPermSection(SITEMGR_PERMISSION_EVENTS) && EVENT_FEATURE == "on") { ?>
        <li id="privateMenu_levelEvent"><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/prefs/levels.php?module=event"><?=string_ucwords(system_showText(LANG_SITEMGR_NAVBAR_EVENT))?></a></li>
		<? } ?>
        
        <? if (permission_hasSMPermSection(SITEMGR_PERMISSION_CLASSIFIEDS) && CLASSIFIED_FEATURE == "on") { ?>
        <li id="privateMenu_levelClassified"><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/prefs/levels.php?module=classified"><?=system_showText(LANG_SITEMGR_NAVBAR_CLASSIFIED)?></a></li>
        <? } ?>
        
        <? if (permission_hasSMPermSection(SITEMGR_PERMISSION_ARTICLES) && ARTICLE_FEATURE == "on") { ?>
        <li id="privateMenu_levelArticle"><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/prefs/levels.php?module=article"><?=system_showText(LANG_SITEMGR_NAVBAR_ARTICLE)?></a></li>
        <? } ?>
    </ul>
</div>

<br clear="all" style="height:0; line-height:0">

<? if ($openPMlisting) { ?> <script type="text/javascript"> addClass('levelListing') </script><? } ?>
<? if ($openPMevent) { ?> <script type="text/javascript"> addClass('levelEvent') </script><? } ?>
<? if ($openPMbanner) { ?> <script type="text/javascript"> addClass('levelBanner') </script><? } ?>
<? if ($openPMclassified) { ?> <script type="text/javascript"> addClass('levelClassified') </script><? } ?>
<? if ($openPMarticle) { ?> <script type="text/javascript"> addClass('levelArticle') </script><? } ?>
