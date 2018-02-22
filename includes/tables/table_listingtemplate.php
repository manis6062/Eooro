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
	# * FILE: /includes/tables/table_listingtemplate.php
	# ----------------------------------------------------------------------------------------------------

    if (is_numeric($message) && isset($msg_listing[$message])) { ?>	
        <p class="successMessage"><?=$msg_listing[$message]?></p>			
    <? } ?>

    <table class="table-itemlist">

        <tr>
            <th>
                <?=system_showText(LANG_SITEMGR_TITLE)?>
            </th>
            <th>
                <?=system_showText(LANG_SITEMGR_STATUS)?>
            </th>
            <th>
                <?=system_showText(LANG_SITEMGR_LISTINGTEMPLATE_ADDITIONALPRICE)?>
            </th>
            <th>
                <?=system_showText(LANG_SITEMGR_LASTUPDATE)?>
            </th>
            <th class="text-center"><?=system_showText(LANG_LABEL_OPTIONS)?></td>
        </tr>

        <? foreach($listingtemplates as $listingtemplate) { ?>
            <? $id = $listingtemplate->getNumber("id"); ?>

            <tr>
                <td>
                    <a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/listingtemplate/view.php?id=<?=$listingtemplate->getNumber("id")?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>">
                        <?=$listingtemplate->getString("title")?>
                    </a>
                </td>
                <td>
                    <a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/listingtemplate/template.php?id=<?=$listingtemplate->getNumber("id")?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>">
                        <?=system_showText(@constant('LANG_SITEMGR_LABEL_'.string_strtoupper($listingtemplate->getString("status"))))?>
                    </a>
                </td>
                <td>
                    <a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/listingtemplate/template.php?id=<?=$listingtemplate->getNumber("id")?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>">
                        <?=$listingtemplate->getString("price")?>
                    </a>
                </td>
                <td>
                    <a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/listingtemplate/view.php?id=<?=$listingtemplate->getNumber("id")?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>">
                        <?=(($listingtemplate->getString("updated") != "0000-00-00 00:00:00") ? (format_date($listingtemplate->getString("updated"), DEFAULT_DATE_FORMAT, "datetime"))." - ".format_getTimeString($listingtemplate->getNumber("updated")) : ("---"))?>
                    </a>
                </td>
                <td nowrap class="main-options text-center" >

                    <a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/listingtemplate/view.php?id=<?=$listingtemplate->getNumber("id")?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>">
                        <?=(system_showText(LANG_SITEMGR_VIEW))?>
                    </a>
                    <b>|</b>
                    <a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/listingtemplate/template.php?id=<?=$listingtemplate->getNumber("id")?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>">
                        <?=(system_showText(LANG_SITEMGR_EDIT))?>
                    </a>
                    <b>|</b>
                    <a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/listingtemplate/delete.php?id=<?=$listingtemplate->getNumber("id")?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>">
                        <?=(system_showText(LANG_SITEMGR_DELETE))?>
                    </a>

                </td>
            </tr>

        <? } ?>
    </table>