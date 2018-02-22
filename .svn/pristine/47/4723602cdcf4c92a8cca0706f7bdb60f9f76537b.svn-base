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
	# * FILE: /includes/tables/table_mobilenotifs.php
	# ----------------------------------------------------------------------------------------------------

?>

    <table class="table-itemlist">

        <tr>
            <th>
                <span><?=system_showText(LANG_SITEMGR_MOBILE_NOTIFTITLE);?></span>
            </th>

            <th>
                <span><?=system_showText(LANG_SITEMGR_MOBILE_EXPIRY);?></span>
            </th>

            <th>
                <span><?=system_showText(LANG_LABEL_STATUS);?></span>
            </th>

            <th class="text-center">
                <?=system_showText(LANG_LABEL_OPTIONS)?>
            </th>

        </tr>

        <? if ($notifs) foreach ($notifs as $notif) { $id = $notif->getNumber("id"); ?>

            <tr>
                <td>
                    <a title="<?=$notif->getString("title");?>" href="<?=$url_redirect?>/notification.php?id=<?=$id?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>">
                        <?=$notif->getString("title", true, 40);?>
                    </a>
                </td>
                <td>
                    <span title="<?=format_date($notif->getString("expiration_date"))?>" style="cursor:default"><?=format_date($notif->getString("expiration_date"));?></span>
                </td>
                <td>
                    <?=$status->getStatusWithStyle($notif->getString("status"));?>
                </td>
                <td nowrap class="main-options text-center">
                    <a href="<?=$url_redirect?>/notification.php?id=<?=$id?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>">
                        <?=system_showText(LANG_LABEL_EDIT);?>
                    </a>
                    <b>|</b>
                    <a href="javascript:void(0)" onclick="dialogBox('confirm', '<?=system_showText(LANG_SITEMGR_MSGAREYOUSURE);?>', <?=$id?>, 'Notif_post', '', '<?=system_showText(LANG_SITEMGR_OK);?>', '<?=system_showText(LANG_SITEMGR_CANCEL);?>');">
                        <?=system_showText(LANG_LABEL_DELETE);?>
                    </a>
                </td>
            </tr>

        <? } ?>

    </table>