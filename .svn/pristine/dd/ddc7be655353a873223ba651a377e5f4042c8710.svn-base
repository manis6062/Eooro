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
	# * FILE: /includes/tables/table_lead_submenu.php
	# ----------------------------------------------------------------------------------------------------

?>

    <div class="submenu">
        <ul>
            <li id="privateMenu_listing">
                <a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/leads/index.php?item_type=listing"><?=system_showText(LANG_SITEMGR_LISTING_LEADS)?></a>
            </li>
            
            <? if (EVENT_FEATURE == "on" && CUSTOM_EVENT_FEATURE == "on") { ?>
            <li id="privateMenu_event">
                <a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/leads/index.php?item_type=event"><?=system_showText(LANG_SITEMGR_EVENT_LEADS)?></a>
            </li>
            <? } ?>
            
            <? if (CLASSIFIED_FEATURE == "on" && CUSTOM_CLASSIFIED_FEATURE == "on") { ?>
            <li id="privateMenu_classified">
                <a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/leads/index.php?item_type=classified"><?=system_showText(LANG_SITEMGR_CLASSIFIED_LEADS)?></a>
            </li>
            <? } ?>
            
            <? if (THEME_ENQUIRE_PAGE) { ?>
            <li id="privateMenu_general">
                <a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/leads/index.php?item_type=general"><?=system_showText(LANG_SITEMGR_GENERAL_LEADS)?></a>
            </li>
            <? } ?>
        </ul>
    </div>
    <br clear="all" style="height:0; line-height:0">
    
    <?
    $openPMlisting = string_strpos($_SERVER["REQUEST_URI"], "listing") || $_POST["item_type"] == "listing";
    $openPMevent = string_strpos($_SERVER["REQUEST_URI"], "event") || $_POST["item_type"] == "event";
    $openPMclassified = string_strpos($_SERVER["REQUEST_URI"], "classified") || $_POST["item_type"] == "classified";
    $openPMgeneral = string_strpos($_SERVER["REQUEST_URI"], "general") || $_POST["item_type"] == "general";
    ?>

    <? if ($openPMlisting) { ?> <script type="text/javascript"> addClass('listing')</script><? } ?>
    <? if ($openPMevent) { ?> <script type="text/javascript"> addClass('event')</script><? } ?>
    <? if ($openPMclassified) { ?> <script type="text/javascript"> addClass('classified')</script><? } ?>
    <? if ($openPMgeneral) { ?> <script type="text/javascript"> addClass('general')</script><? } ?>
