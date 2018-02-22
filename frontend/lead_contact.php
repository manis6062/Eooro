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
	# * FILE: /frontend/lead_contact.php
	# ----------------------------------------------------------------------------------------------------

    if ($contact_address || $contact_zipcode || $contact_city || $contact_state || $contact_country || $contact_email || $contact_phone) { ?>

        <h3><?=system_showText(LANG_LEAD_TALKTOUS);?></h3>

        <? if ($contact_phone) { ?>
        <address>
            <h4><?=system_showText(LANG_LABEL_PHONE);?></h4>	             		
            <p><?=$contact_phone;?></p>
        </address>
        <? } ?>

        <? if ($contact_email) { ?>
        <address>
            <h4><?=system_showText(LANG_LABEL_EMAIL);?></h4>
            <p id="contactSidebarInfo_noicon"></p>
        </address>
        <? } ?>

        <? if ($contact_address || $contact_city || $contact_state || $contact_country || $contact_zipcode) { ?>
        <address>
            <h4><?=system_showText(LANG_LABEL_ADDRESS);?></h4>
            <? if ($contact_address) { ?>
            <p><?=$contact_address;?></p>
            <? } ?>

            <? if ($contact_city || $contact_state || $contact_zipcode) { ?>
            <p><?=$contact_city?><?=$contact_separator;?><?=$contact_state?> <?=$contact_zipcode?></p>
            <? } ?>

            <? if ($contact_country) { ?>
            <p><?=$contact_country;?></p>
            <? } ?>
        </address>
        <? } ?>
    
    <? } ?>