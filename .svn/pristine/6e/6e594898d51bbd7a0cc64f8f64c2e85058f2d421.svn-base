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
	# * FILE: /includes/tables/table_notifications.php
	# ----------------------------------------------------------------------------------------------------

    if ($message) { ?>
        <p class="successMessage"><?=$message?></p>
    <? } ?>

    <table class="table-itemlist">
        <tr>
            <th>
                <?=system_showText(LANG_SITEMGR_LABEL_NAME)?>
            </th>
            <th nowrap>
                <?=system_showText(LANG_SITEMGR_LABEL_ENABLED)?>
            </th>
            <th nowrap>
                <?=system_showText(LANG_SITEMGR_LABEL_TYPE)?>
            </th>
            <th nowrap>
                <?=system_showText(LANG_SITEMGR_STATUS)?>
            </th>
            <th nowrap>
                <?=system_showText(LANG_SITEMGR_LASTUPDATE)?>
            </th>
            <th nowrap>
                <?=system_showText(LANG_LABEL_OPTIONS)?>
            </td>
        </tr>
        <?
        if ($emails) {
            foreach($emails as $email) { 
                $id = $email->getNumber("id"); 
        ?>

            <tr>			

                <td>
                    <a href="email.php?id=<?=$id?>">
                        <?=system_showText(@constant("LANG_SITEMGR_EMAILNOTIF_TYPE_".$id))?>
                    </a>
                </td>

                <td style="text-align:center">
                    <a href="<?=$url_redirect?>/index.php?id=<?=$email->getString("id")?>&deactive=<?=$email->getString("deactivate")?>"><img src="<?=DEFAULT_URL?>/images/<?=$email->getString('deactivate') == '0' ? 'icon_check.gif' : 'icon_uncheck.gif'?>" border="0" alt="<?=($email->getString('deactivate') == '0' ? system_showText(LANG_SITEMGR_ACTIVATED) : system_showText(LANG_SITEMGR_DEACTIVATED))?>" title="<?=($email->getString('deactivate') == '0' ? system_showText(LANG_SITEMGR_ACTIVATED) : system_showText(LANG_SITEMGR_DEACTIVATED))?>" /></a>            
                </td>

                <td>
                    <?=!$email->getNumber("days") ? system_showText(LANG_SITEMGR_SYSTEMNOTIFICATION) : system_showText(LANG_SITEMGR_RENEWALREMINDER)?>
                </td>

                <td>
                    <?=!$email->getNumber("deactivate") ? system_showText(LANG_SITEMGR_ACTIVE) : system_showText(LANG_SITEMGR_DISABLED) ?>
                </td>

                <td>
                <?
                    if($email->getNumber("updated") == 0) {
                        echo system_showText(LANG_SITEMGR_NOTUPDATED);
                    } else {
                        echo format_date($email->getNumber("updated"), DEFAULT_DATE_FORMAT, "datetime")." - ".format_getTimeString($email->getNumber("updated"));
                    }
                ?>
                </td>
                
                <td nowrap class="main-options text-center">
                    <a href="email.php?id=<?=$id?>">
                        <?=system_showText(LANG_LABEL_EDIT);?>
                    </a>
                </td>
            </tr>
        <? 
            }
        } ?>
    </table>
