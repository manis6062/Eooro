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
	# * FILE: /includes/tables/table_smaccount.php
	# ----------------------------------------------------------------------------------------------------

    if (is_numeric($message) && isset($msg_account[$message])) { ?>
        <p class="successMessage"><?=$msg_account[$message]?></p>			
    <? } ?>

    <table class="table-itemlist">
        <tr>
            <th>
                <?=system_showText(LANG_SITEMGR_LABEL_USERNAME)?>
            </th>
            <th>
                <?=system_showText(LANG_SITEMGR_LABEL_NAME)?>
            </th>
            <th>
                <?=system_showText(LANG_SITEMGR_LABEL_CREATED)?>
            </th>
            <th>
                <?=system_showText(LANG_SITEMGR_LABEL_ENABLED);?>
            </th>
            <th class="text-center"><?=system_showText(LANG_LABEL_OPTIONS)?></th>
        </tr>
        <? $i = 0;
            foreach($smaccounts as $smaccount) { ?>
            <? 
            $i++;
            $id = $smaccount->getNumber("id"); ?>
            <tr>
                <td>
                    <a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/smaccount/view.php?id=<?=$smaccount->getNumber("id")?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table" title="<?=$smaccount->getString("username")?>">
                        <?=system_showAccountUserName($smaccount->getString("username"));?>
                    </a>
                </td>
                <td nowrap>
                    <a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/smaccount/view.php?id=<?=$smaccount->getNumber("id")?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table" title="<?=$smaccount->getString("name")?>">
                        <?=system_showAccountUserName($smaccount->getString("name"));?>
                    </a>
                </td>
                <td nowrap>
                    <?(($smaccount->getString("entered") != "0000-00-00 00:00:00") ? $created_field = (format_date($smaccount->getString("entered"), DEFAULT_DATE_FORMAT, "datetime"))." - ".format_getTimeString($smaccount->getString("entered")) : $created_field = "---")?>
                    <a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/smaccount/view.php?id=<?=$smaccount->getNumber("id")?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>" title="<?=$created_field?>">
                        <?=$created_field?>
                    </a>
                </td>
                <td id="tableSmaccount_rowId_<?=$i?>">
                    <? if ($smaccount->getNumber("id") != $_SESSION[SESS_SM_ID]) { ?>
                    <a href="javascript:void(0);" onclick="javascript:updateSMAccount(<?=$smaccount->getNumber("id")?>,'<?=$smaccount->getString('active')?>',<?=$i?>)">
                        <img src="<?=DEFAULT_URL?>/images/<?=$smaccount->getString('active') == 'y' ? 'icon_check.gif' : 'icon_uncheck.gif'?>" border="0" alt="<?=($smaccount->getString('active') == 'y' ? system_showText(LANG_SITEMGR_ACTIVATED) : system_showText(LANG_SITEMGR_DEACTIVATED))?>" title="<?=($smaccount->getString('active') == 'y' ? system_showText(LANG_SITEMGR_ACTIVATED) : system_showText(LANG_SITEMGR_DEACTIVATED))?>" />
                    </a>
                    <? } else { ?>
                        <img src="<?=DEFAULT_URL?>/images/<?=$smaccount->getString('active') == 'y' ? 'icon_check.gif' : 'icon_uncheck.gif'?>" border="0" alt="<?=($smaccount->getString('active') == 'y' ? system_showText(LANG_SITEMGR_ACTIVATED) : system_showText(LANG_SITEMGR_DEACTIVATED))?>" title="<?=($smaccount->getString('active') == 'y' ? system_showText(LANG_SITEMGR_ACTIVATED) : system_showText(LANG_SITEMGR_DEACTIVATED))?>" />
                    <? } ?>
                </td>

                <td nowrap class="main-options text-center">

                    <a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/smaccount/view.php?id=<?=$smaccount->getNumber("id")?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>">
                        <?=system_showText(LANG_SITEMGR_VIEW)?>
                    </a>
                    <b>|</b>
                    <a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/smaccount/smaccount.php?id=<?=$smaccount->getNumber("id")?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>">
                        <?=system_showText(LANG_SITEMGR_EDIT)?>
                    </a>

                    <? if ($smaccount->getNumber("id") != $_SESSION[SESS_SM_ID]) { ?>
                        <b>|</b>
                        <a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/smaccount/delete.php?id=<?=$smaccount->getNumber("id")?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>">
                            <?=system_showText(LANG_SITEMGR_DELETE)?>
                        </a>
                    <? } ?>
                </td>
            </tr>
        <? } ?>
    </table>