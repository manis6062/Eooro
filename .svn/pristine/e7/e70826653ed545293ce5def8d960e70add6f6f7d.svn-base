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
	# * FILE: /includes/forms/form_themesettings_contractors.php
	# ----------------------------------------------------------------------------------------------------

?>

    <form name="theme" id="theme" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">

        <input type="hidden" name="domain_id" value="<?=SELECTED_DOMAIN_ID?>" />
        <input type="hidden" name="scheme" id="scheme" value="<?=EDIR_SCHEME?>" />
        <input type="hidden" name="hiddenValue" />

        <table cellpadding="2" cellspacing="0" border="0" class="table-form">
            <tr class="tr-form">
                <th><?=system_showText(LANG_SITEMGR_SETTINGS_THEME_SELECTANTHEME)?></th>
                <td align="left" class="td-form">
                    <?=$selectthemes?>
                </td>
            </tr>
        </table>
        
        <div class="header-form">
            <?=system_showText(LANG_SITEMGR_COLOR_COLOROPTIONS)?>
        </div>

        <?

        $schemes = explode(",", EDIR_SCHEMES);
        $schemesnames = explode(",", EDIR_SCHEMENAMES);

        foreach ($schemes as $key => $value) {

            if ($schemes[$key] != "custom") {

                $label = (EDIR_SCHEME == $schemes[$key] ? system_showText(LANG_SITEMGR_SCHEME_APPLYED) : system_showText(LANG_SITEMGR_APPLY_SCHEME));
                $style = (EDIR_SCHEME == $schemes[$key] ? "style=\"cursor: default;\"" : "");
                if (!DEMO_LIVE_MODE){
                    $function = (EDIR_SCHEME == $schemes[$key] ? "" : "onclick=\"JS_submit('".$schemes[$key]."');\"");
                } else {
                    $function = (EDIR_SCHEME == $schemes[$key] ? "" : "onclick=\"livemodeMessage('".system_showText(LANG_SITEMGR_THEME_DEMO_MESSAGE)."');\"");
                }
                $class = (EDIR_SCHEME == $schemes[$key] ? "activeLink" : "");
        ?>

                <div class="customTheme <?=(EDIR_SCHEME == $schemes[$key] ? "active" : "")?>">
                    <div class="themeImage">
                        <img src="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/images/scheme/".EDIR_THEME."_".$schemes[$key].".png"?>" title="<?=$schemesnames[$key]?>" />
                    </div>
                    <div class="themeInfo">
                        <p><?=system_showText(LANG_SITEMGR_COLOR_SCHEME)?> - <?=$schemesnames[$key]?></p>
                        &nbsp;

                        <a href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/prefs/colorscheme.php?theme=".EDIR_THEME."&label=".$schemesnames[$key]."&scheme=".$schemes[$key]?>" class="customize-icon"><?=system_showText(LANG_SITEMGR_CUSTOMIZE)?></a>

                        <a href="javascript: void(0);" <?=$style?> <?=$function?> class="apply-icon <?=$class?>"><?=$label?></a>
                    </div>
                </div>

        <? }
        }
        ?>

    </form>