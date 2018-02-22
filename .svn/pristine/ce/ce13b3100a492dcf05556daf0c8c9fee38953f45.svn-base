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
	# * FILE: /members/listing/navbar.php
	# ----------------------------------------------------------------------------------------------------

    $listObj = new Listing($id);
    $levelList = new ListingLevel(true);

    $listingHasClickToCall = $levelList->getHasCall($listObj->getNumber("level"));
    $listingHasBacklink = $levelList->getBacklink($listObj->getNumber("level"));
    
    //remove nav tabs
    if( 0 > 1 ) {
?>

    <nav class="minor-nav">
        <ul>
            <li>
                <a <?=((string_strpos($_SERVER["PHP_SELF"], "/".MEMBERS_ALIAS."/".LISTING_FEATURE_FOLDER."/listing") !== false) ? "class=\"active\"" : "") ?> href="<?=DEFAULT_URL?>/<?=MEMBERS_ALIAS?>/<?=LISTING_FEATURE_FOLDER?>/listing.php?id=<?=$id?>"><?=system_showText(LANG_LISTING_INFORMATION)?></a>
            </li>

            <? if (BACKLINK_FEATURE == "on" && $listingHasBacklink == "y") { ?>
                <li>
                    <a <?=((string_strpos($_SERVER["PHP_SELF"], "/".MEMBERS_ALIAS."/".LISTING_FEATURE_FOLDER."/backlinks") !== false) ? "class=\"active\"" : "") ?> href="<?=DEFAULT_URL?>/<?=MEMBERS_ALIAS?>/<?=LISTING_FEATURE_FOLDER?>/backlinks.php?id=<?=$id?>">Website Widgets</a>
                </li>
            <? } ?>

            <? if (TWILIO_APP_ENABLED == "on" && TWILIO_APP_ENABLED_CALL == "on"  && $listingHasClickToCall == "y") { ?>
                <li>
                    <a <?=((string_strpos($_SERVER["PHP_SELF"], "/".MEMBERS_ALIAS."/".LISTING_FEATURE_FOLDER."/clicktocall") !== false) ? "class=\"active\"" : "") ?> href="<?=DEFAULT_URL?>/<?=MEMBERS_ALIAS?>/<?=LISTING_FEATURE_FOLDER?>/clicktocall.php?id=<?=$id?>"><?=system_showText(LANG_LABEL_ACTIVATECLICKCALL)?></a>
                </li>
            <? } ?>

                <li>
                    <a <?=((string_strpos($_SERVER["PHP_SELF"], "/".MEMBERS_ALIAS."/".LISTING_FEATURE_FOLDER."/review-collector") !== false) ? "class=\"active\"" : "") ?> href="<?=DEFAULT_URL?>/<?=MEMBERS_ALIAS?>/<?=LISTING_FEATURE_FOLDER?>/review-collector.php?id=<?=$id?>">Review Collector</a>
                </li>

        </ul>
    </nav>

<? } ?>