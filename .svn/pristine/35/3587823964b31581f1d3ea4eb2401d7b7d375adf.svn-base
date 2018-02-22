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
	# * FILE: /includes/tables/table_mobileadvert_submenu.php
	# ----------------------------------------------------------------------------------------------------

    $openPMhome = string_strpos($_SERVER["PHP_SELF"], "adverts.php");
    $openPMadd = (((string_strpos($_SERVER["PHP_SELF"], "advert.php")) && (!string_strpos($_SERVER["REQUEST_URI"], "?id"))) && !(isset($id) && $id != ""));
    $openPMedit = (isset($id) && $id != "") && (!string_strpos($_SERVER["PHP_SELF"], "adverts.php"));
        
?>

    <div class="submenu">
        <ul>
            <li id="privateMenu_home"><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/mobile/adverts.php"><?=system_showText(LANG_SITEMGR_MANAGE)?></a></li>
            <li id="privateMenu_add"><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/mobile/advert.php"><?=system_showText(LANG_SITEMGR_MENU_ADD)?></a></li>
            <li id="privateMenu_edit" <?=($openPMedit ? "style=\"display: \"\"\"" : "style=\"display: none\"")?> ><a href="<?=$url_redirect."/advert.php?id=".$id?>"><?=system_showText(LANG_SITEMGR_EDIT)?></a></li>
        </ul>
    </div>

    <br clear="all">	

    <? if ($openPMhome) { ?> <script type="text/javascript"> addClass('home') </script><? } ?>
    <? if ($openPMadd) { ?> <script type="text/javascript"> addClass('add') </script><? } ?>
    <? if ($openPMedit) { ?> <script type="text/javascript"> addClass('edit') </script><? } ?>
