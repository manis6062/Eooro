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
	# * FILE: /includes/tables/table_discountcode.php
	# ----------------------------------------------------------------------------------------------------

    if(is_numeric($message) && isset($msg_discountcode[$message])) { ?>
        <p class="successMessage"><?=$msg_discountcode[$message]?></p>
    <? } ?>
   
    <table class="table-itemlist">
        <tr>
            <th>
                <span>
                    <?=system_showText(LANG_SITEMGR_LABEL_CODE)?>
                </span>
            </th>
            <th>
                <span>
                    <?=system_showText(LANG_SITEMGR_LABEL_REPEAT)?>
                </span>
            </th>
            <th>
                <span>
                    <?=system_showText(LANG_SITEMGR_LABEL_EXPIRATION)?>
                </span>
            </th>
            <th>
                <span>
                    <?=system_showText(LANG_SITEMGR_LABEL_AMOUNT)?>
                </span>
            </th>
            <th>
                <span>
                    <?=system_showText(LANG_SITEMGR_STATUS)?>
                </span>
            </th>
            <th class="text-center">
                <?=system_showText(LANG_LABEL_OPTIONS)?>
            </th>
        </tr>
        <?
        foreach($discount_codes as $each_discount_code) {
            $id = $each_discount_code->getNumber("id");
            $discountCodeStatusObj = new DiscountCodeStatus(); ?>

            <tr>
                <td>
                    <a href="<?=$url_base?>/discountcode/discountcode.php?x_id=<?=$id?>&screen=<?=$screen?>&letter=<?=$letter?>">
                        <b><?=$each_discount_code->getString("id")?></b>
                    </a>
                </td>
                
                <td>
                    <?=system_showText(@constant('LANG_SITEMGR_'.string_strtoupper($each_discount_code->getString("recurring"))));?>
                </td>
                
                <td>
                    <?=format_date($each_discount_code->getString("expire_date"));?>
                </td>
                
                <td>
                    <?=(($each_discount_code->getString("type")=="monetary value") ? CURRENCY_SYMBOL : "")?><?=trim(string_ucwords($each_discount_code->getString("amount")));?><?=(($each_discount_code->getString("type")=="percentage") ? "%" : "")?>
                </td>
                
                <td>
                    <? $discountCodeStatusObj = new DiscountCodeStatus();?>
                    <a href="<?=$url_base?>/discountcode/settings.php?x_id=<?=$id?>&screen=<?=$screen?>&letter=<?=$letter?>">
                        <?=$discountCodeStatusObj->getStatusWithStyle($each_discount_code->getString("status"))?>
                    </a>
                </td>
                
                <td nowrap class=" text-center main-options">
                    <a href="<?=$url_base?>/discountcode/discountcode.php?x_id=<?=$id?>&screen=<?=$screen?>&letter=<?=$letter?>">
                        <?=system_showText(LANG_SITEMGR_EDIT)?>
                    </a>
                    <b>|</b>
                    <a href="<?=$url_base?>/discountcode/delete.php?x_id=<?=$id?>&screen=<?=$screen?>&letter=<?=$letter?>">
                        <?=system_showText(LANG_SITEMGR_DELETE)?>
                    </a>
                </td>
            </tr>
        <? } ?>
    </table>