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
	# * FILE: /includes/forms/form_themesettings.php
	# ----------------------------------------------------------------------------------------------------

    $themeFileform = INCLUDES_DIR."/forms/form_themesettings_".EDIR_THEME.".php";
?>

    <table cellpadding="0" cellspacing="0" border="0" class="standard-table" style="margin-bottom: 0;">
		<tr>
			<th colspan="2" class="standard-tabletitle"><?=system_showText(LANG_SITEMGR_SETTINGS_THEME_SELECTANTHEME)?> 
            <span style="display: block; white-space: normal;"><?=system_showText(LANG_SITEMGR_SETTINGS_THEME_TIP);?></span>
            </th>
		</tr>
	</table>

    <br />

    <? if ($message) { ?>
        <div id="warning" class="<?=$message_style?>">
            <?=$message?>
        </div>
    <? }
    
    if (file_exists($themeFileform)) {
        
        include($themeFileform);
        
    } else {
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
        
            <?
            if (EDIR_THEME != "realestate") { ?>

                <div class="header-form">
                    <?=system_showText(LANG_SITEMGR_SELECT_SCHEME)?>
                </div>


                <div class="customTheme <?=(EDIR_SCHEME == "custom" ? "active" : "")?>">
                    <div class="themeImage">
                        <div class="no-image-sitemgr"><p><?=system_showText(LANG_SITEMGR_CUSTOM_SCHEME)?></p></div>
                    </div>
                    <div class="themeInfo">

                        <?

                        $label = (EDIR_SCHEME == "custom" ? system_showText(LANG_SITEMGR_SCHEME_APPLYED) : system_showText(LANG_SITEMGR_APPLY_SCHEME));
                        $style = (EDIR_SCHEME == "custom" ? "style=\"cursor: default;\"" : "");
                        if (!DEMO_LIVE_MODE){
                            $function = (EDIR_SCHEME == "custom" ? "" : "onclick=\"JS_submit('custom');\"");
                        } else {
                            $function = (EDIR_SCHEME == "custom" ? "" : "onclick=\"livemodeMessage('".system_showText(LANG_SITEMGR_THEME_DEMO_MESSAGE)."');\"");
                        }
                        $class = (EDIR_SCHEME == "custom" ? "activeLink" : "");

                        ?>

                        <p><?=system_showText(LANG_SITEMGR_CUSTOM_SCHEME2)?></p>
                        <i><?=system_showText(LANG_SITEMGR_BUILD)?></i>
                        <a href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/prefs/colorscheme.php?theme=".EDIR_THEME."&label=Custom&scheme=custom"?>" class="customize-icon"><?=system_showText(LANG_SITEMGR_CUSTOMIZE)?></a>
                        <a href="javascript: void(0);" <?=$style?> <?=$function?> class="apply-icon <?=$class?>"><?=$label?></a>
                    </div>
                </div>

            <? } else {

                echo "<br />";

            }

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

                            <? if (EDIR_THEME != "realestate") { ?>
                            <a href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/prefs/colorscheme.php?theme=".EDIR_THEME."&label=".$schemesnames[$key]."&scheme=".$schemes[$key]?>" class="customize-icon"><?=system_showText(LANG_SITEMGR_CUSTOMIZE)?></a>
                            <? } ?>

                            <a href="javascript: void(0);" <?=$style?> <?=$function?> class="apply-icon <?=$class?>"><?=$label?></a>
                        </div>
                    </div>

            <? }
            }
            ?>

            <span class="clear"></span>

            <? if (USING_THEME_TEMPLATE && THEME_TEMPLATE_ID) { ?>
                <div class="header-form">
                    <a href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/prefs/template.php?id=".THEME_TEMPLATE_ID?>"><?=  system_showText(LANG_SITEMGR_CHANGE_THEME)?></a>
                </div>

            <? } ?>

            <span class="clear"></span>
        </form>
    
    <? } ?>