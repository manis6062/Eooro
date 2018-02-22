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
	# * FILE: /theme/diningguide/frontend/contact_map.php
	# ----------------------------------------------------------------------------------------------------

    if (GOOGLE_MAPS_ENABLED == "on" && $mapObj->getString("value") == "on" && $contactMap) { ?>

        <div id="map" class="map">&nbsp;</div>
        <?=$contactMap?>
        
    <? } ?>

    <? if ($contact_email || $contact_phone) { ?>
        
        <h3><?=system_showText(LANG_MENU_CONTACT)?></h3>
        
        <div id="contactSidebar" style="display:none;">
            <p id="contactSidebarInfo"></p>
            <p><i class="icon-phone"></i> <?=$contact_phone?></p>
        </div>
        
    <? } ?>