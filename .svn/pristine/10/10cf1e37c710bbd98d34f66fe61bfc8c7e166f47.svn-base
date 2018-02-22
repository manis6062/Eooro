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
	# * FILE: /includes/forms/form_mobilenotif.php
	# ----------------------------------------------------------------------------------------------------

?>
 
    <script language="javascript" type="text/javascript">

        function JS_submit() {
            document.notification.submit();
        }

    </script>
    
    <p><?=system_showText(LANG_SITEMGR_MOBILE_NOTIF_TIP1)?></p>
    
    <br />
    
    <p><?=system_showText(LANG_SITEMGR_MOBILE_NOTIF_TIP2)?></p>
    
    <br />

    <?
    if ($message_notification) {
        echo "<p class=\"errorMessage\">$message_notification</p>";
    }
    ?>

    <table border="0" cellpadding="0" cellspacing="0" class="standard-table">
        <tr>
            <th colspan="2" class="standard-tabletitle"><?=system_showText(LANG_SITEMGR_MOBILE_NOTIF_SING);?> - <?=system_showText(LANG_SITEMGR_MOBILE_IOSANDROID);?></th>
        </tr>

        <tr>
            <th>* <?=system_showText(LANG_SITEMGR_MOBILE_NOTIFTITLE);?>:</th>
            <td>
                <input type="text" name="title" value="<?=$title?>" maxlength="24" />
                <span><?=system_showText(LANG_SITEMGR_MOBILE_NOTIFTITLE_MAXCHARS);?></span>
            </td>
        </tr>
        
        <tr>
            <th>* <?=system_showText(LANG_SITEMGR_MOBILE_NOTIFTEXT);?>:</th>
            <td>
                <input type="text" name="description" value="<?=$description?>" maxlength="200" />
                <span><?=system_showText(LANG_SITEMGR_MOBILE_NOTIFTEXT_MAXCHARS);?></span>
            </td>
        </tr>
        
        <tr>
            <th class="alignTop">* <?=system_showText(LANG_SITEMGR_MOBILE_EXPIRY);?>:</th>
            <td>
                <input type="text" name="expiration_date" id="expiration_date" value="<?=$expiration_date?>" style="width:80px;" />
                <span>(<?=format_printDateStandard()?>)</span>
            </td>
        </tr>
        
        <tr>
            <th>* <?=system_showText(LANG_LABEL_STATUS)?>:</th>
            <td>
                <?=$statusDropDown?>
            </td>
        </tr>
    </table>
    
    <button type="button" name="submit_button" class="input-button-form" onclick="JS_submit();"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>

    <button type="button" value="Cancel" class="input-button-form" onclick="document.getElementById('formnotificationcancel').submit();"><?=system_showText(LANG_SITEMGR_CANCEL)?></button>
        
    <? if ($currentNotif) { ?>
        
    <table border="0" cellpadding="0" cellspacing="0" class="standard-table" style="margin: 50px 0 0">
        
        <tr>
            <th colspan="2" class="standard-tabletitle"><?=system_showText(LANG_SITEMGR_MOBILE_NOTIF_SING);?> - <span class="currently-running"><?=system_showText(LANG_SITEMGR_MOBILE_RUNNING);?></span></th>
        </tr>
        
    </table>
    <table border="0" cellpadding="0" cellspacing="0" class="standard-table">
        
        <tr>
            <th><?=system_showText(LANG_LABEL_TITLE);?>:</th>
            <td>
                <?=$currentNotif["title"];?>
            </td>
        </tr>
        
        <tr>
            <th><?=system_showText(LANG_SITEMGR_MOBILE_NOTIF_SING);?>:</th>
            <td>
                <?=$currentNotif["description"];?>
            </td>
        </tr>
        
    </table>
    <? } ?>
    