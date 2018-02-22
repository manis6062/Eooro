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
	# * FILE: /includes/forms/form_google_tag.php
	# ----------------------------------------------------------------------------------------------------

?>

    <div class="header-form"><?=string_ucwords(system_showText(LANG_SITEMGR_NAVBAR_GOOGLETAG))?></div>

    <? if ($message_googletag) { ?>
        <div id="warning" class="<?=$message_style?>"><?=$message_googletag?></div>
    <? } ?>

    <table cellpadding="2" cellspacing="0" class="table-form">

        <tr class="tr-form">
            <td align="right" class="td-form">
                <div class="label-form">
                    <?=string_ucwords(system_showText(LANG_SITEMGR_NAVBAR_GOOGLETAG))?>:
                </div>
            </td>
            <td align="left" class="td-form">

                <table border="0" cellpadding="0" cellspacing="0" style="width: auto; margin: 0;">
                    <tr>
                        <td>
                            <input type="radio" name="google_tag_status" value="on" <?=($google_tag_status == "on") ? "checked" : ""?> class="inputRadio" <?=((DEMO_LIVE_MODE) ? "readonly": "")?> />
                        </td>
                        <td>
                            <?=string_ucwords(system_showText(LANG_SITEMGR_ON))?>
                        </td>
                        <td>
                            <input type="radio" name="google_tag_status" value="off" <?=($google_tag_status == "off") ? "checked" : ""?> class="inputRadio" <?=((DEMO_LIVE_MODE) ? "readonly": "")?> />
                        </td>
                        <td>
                            <?=string_ucwords(system_showText(LANG_SITEMGR_OFF))?>
                        </td>
                    </tr>			
                </table>

            </td>
        </tr>
        
        <tr class="tr-form">
            <td align="right" class="td-form">
                <div class="label-form">
                    <?=system_showText(LANG_SITEMGR_GOOGLETAG_CLIENT);?>
                </div>
            </td>
            <td align="left" class="td-form">
                <input type="text" name="google_tag_client" value="<?=$google_tag_client?>" maxlength="255" <?=((DEMO_LIVE_MODE) ? "readonly": "")?> /><br />
                <span><?=system_showText(LANG_SITEMGR_EXAMPLE)?> ABC-ABCAB7</span>
            </td>
        </tr>

    </table>