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
	# * FILE: /includes/tables/table_content_special.php
	# ----------------------------------------------------------------------------------------------------
?>

    <table border="0" cellspacing="0" cellpadding="0" class="standard-table">
        <tr>
            <th class="standard-tabletitle"><?=string_ucwords(system_showText(LANG_SITEMGR_CONTENT_SPECIALCONTENTS))?></th>
        </tr>
    </table>  

    <table class="table-itemlist">
        <tr>
            <th>
				<span><?=system_showText(LANG_SITEMGR_LABEL_NAME)?></span>
			</th>
			<th width="120px" class="text-center">
                <span><?=system_showText(LANG_LABEL_OPTIONS)?></span>
            </th>
        </tr>
        <tr>
            <td>
                <a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/content/content_header.php" class=""><?=system_showText(LANG_SITEMGR_HEADER)?></a>
            </td>
            <td nowrap class="main-options text-center">
                <a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/content/content_header.php" class="">
                    <?=string_strtolower(system_showText(LANG_SITEMGR_EDIT))?>
                </a>
            </td>
        </tr>
        <tr>
            <td>
                <a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/content/content_footer.php" class=""><?=system_showText(LANG_SITEMGR_FOOTER)?></a>
            </td>
            <td nowrap class="main-options text-center">
                <a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/content/content_footer.php" class="">
                    <?=string_strtolower(system_showText(LANG_SITEMGR_EDIT))?>
                </a>
            </td>
        </tr>
        <tr>
            <td>
                <a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/content/content_noimage.php" class=""><?=system_showText(LANG_SITEMGR_CONTENT_DEFAULTIMAGE)?></a>
            </td>
            <td nowrap class="main-options text-center">
                <a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/content/content_noimage.php" class="">
                    <?=string_strtolower(system_showText(LANG_SITEMGR_EDIT))?>
                </a>
            </td>
        </tr>
        <tr>
            <td>
                <a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/content/content_icon.php" class=""><?=system_showText(LANG_SITEMGR_CONTENT_ICON)?></a>
            </td>
            <td nowrap class="main-options text-center">
                <a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/content/content_icon.php" class="">
                    <?=string_strtolower(system_showText(LANG_SITEMGR_EDIT))?>
                </a>
            </td>
        </tr>
    </table>