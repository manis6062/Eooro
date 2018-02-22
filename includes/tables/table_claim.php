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
	# * FILE: /includes/tables/table_claim.php
	# ----------------------------------------------------------------------------------------------------

    if (is_numeric($message) && isset($msg_claim[$message])) { ?>
        <p class="successMessage"><?=$msg_claim[$message]?></p>
    <? } ?>
    
    <table class="table-itemlist">

        <tr>
            <th><?=string_ucwords(system_showText(LANG_SITEMGR_LISTING))?></th>
            <th><?=system_showText(LANG_SITEMGR_IMPORT_DATETIME)?></th>
            <th><?=system_showText(LANG_SITEMGR_STATUS)?></th>
            <th style="text-align:center"><?=system_showText(LANG_LABEL_OPTIONS)?></th>
        </tr>

        <? foreach($claims as $claim) { ?>

            <tr>
                <td>
                    <a href="<?=$url_redirect?>/view.php?id=<?=$claim->getNumber("id")?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>">
                        <?
                        if ($claim->getString("old_title") == $claim->getString("new_title")) {
                            echo $claim->getString("listing_title");
                        } else {
                            echo $claim->getString("new_title")." (".$claim->getString("old_title").")";
                        }
                        ?>
                    </a>
                </td>
                <td>
                    <a href="<?=$url_redirect?>/view.php?id=<?=$claim->getNumber("id")?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>">
                        <?=format_date($claim->getString("date_time"), DEFAULT_DATE_FORMAT, "datetime")." - ".format_getTimeString($claim->getNumber("date_time"));?>
                    </a>
                </td>
                <td>
                    <a href="<?=$url_redirect?>/view.php?id=<?=$claim->getNumber("id")?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>">
                        <?=@system_showText(constant("LANG_SITEMGR_CLAIM_STATUS_".string_strtoupper($claim->getString("status"))))?>
                    </a>
                </td>

                <td nowrap class="main-options" style="text-align:center">
                    <a href="<?=$url_redirect?>/view.php?id=<?=$claim->getNumber("id")?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>">
                        <?=system_showText(LANG_SITEMGR_VIEW)?>
                    </a>

                    <? if ($claim->canApprove()) { ?>
                        <b>|</b>
                        <a href="<?=$url_redirect?>/approve.php?id=<?=$claim->getNumber("id")?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>">
                            <?=system_showText(LANG_SITEMGR_APPROVE)?>
                        </a>
                    <? } ?>	

                    <? if ($claim->canDeny()) { ?>
                        <b>|</b>
                        <a href="<?=$url_redirect?>/deny.php?id=<?=$claim->getNumber("id")?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>">
                            <?=system_showText(LANG_SITEMGR_DENY)?>
                        </a>
                    <? } ?>

                </td>
            </tr>

        <? } ?>
    </table>