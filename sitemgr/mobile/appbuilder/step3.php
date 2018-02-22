<?

	/*==================================================================*\
	######################################################################
	#                                                                    #
	# Copyright 2014 Arca Solutions, Inc. All Rights Reserved.           #
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
	# * FILE: /sitemgr/mobile/appbuilder/step3.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../../conf/loadconfig.inc.php");
    
 	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
    permission_hasSMPerm();
    
    # ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
    extract($_POST);
    extract($_GET);
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                
        if ($color_scheme == "custom") {
            $color_scheme = $colorApp1."-".$colorApp2;
            
            if (!setting_set("appbuilder_colorscheme_custom", $color_scheme)) {
                if (!setting_new("appbuilder_colorscheme_custom", $color_scheme)) {
                    $error = true;
                }
            }
        }
        
        if (!setting_set("appbuilder_colorscheme", $color_scheme)) {
            if (!setting_new("appbuilder_colorscheme", $color_scheme)) {
                $error = true;
            }
        }

        system_appBuilderPercentage(3);
        header("Location: ".DEFAULT_URL."/".SITEMGR_ALIAS."/mobile/appbuilder/".($next == "yes" ? "step4.php" : "step3.php?success=1"));
        exit;
         
    }
    
    //Get percentage
    setting_get("appbuilder_percentage", $appbuilder_percentage);
    if (!$appbuilder_percentage) {
        $appbuilder_percentage = 0;
    }
    
    extract($_POST);
    extract($_GET);
    
    //Theme colors
    if (!DEMO_LIVE_MODE) {
        $arrayCurValues = unserialize(EDIR_CURR_SCHEME_VALUES);
    } else {
        $arrayDefault = unserialize(ARRAY_DEFAULT_COLORS);
        $arrayCurValues = $arrayDefault[EDIR_THEME];
    }
    
    if (EDIR_THEME == "realestate") {
        $arrayColorsApp[] = "ec008c-0072bc";
    } elseif (EDIR_THEME == "diningguide") {
        $arrayColorsApp[] = "9bc11d-ea853b";
    } else {
        $arrayColorsApp[] = $arrayCurValues[EDIR_SCHEME]["color1"]."-".$arrayCurValues[EDIR_SCHEME]["color4"];
    }
    $arrayColorsApp[0] .= "-".system_showText(LANG_SITEMGR_BUILDER_DIRCOLORS);
    $arrayColorsApp[] = "059e9a-f1812d-Contrast";
    $arrayColorsApp[] = "2c3e50-c0392b-Super Contrast";
    $arrayColorsApp[] = "d35400-3498db-Sand & Sea";
    $arrayColorsApp[] = "3498db-63696a-Concrete";
    $arrayColorsApp[] = "8c3ab2-bb7cda-Extroverted";
    $arrayColorsApp[] = "16a085-1abc9c-Enviromentally Friendly";
    $arrayColorsApp[] = "c0392b-34495e-Gothica";
    $arrayColorsApp[] = "e67e22-27ae60-Eat your Veg";
    $arrayColorsApp[] = "aaaaaa-da5138-Red Monochrome";

    setting_get("appbuilder_colorscheme", $appbuilder_colorscheme);
    setting_get("appbuilder_colorscheme_custom", $appbuilder_colorscheme_custom);

    if (!$appbuilder_colorscheme) {
        $appbuilder_colorscheme = $arrayCurValues[EDIR_SCHEME]["color1"]."-".$arrayCurValues[EDIR_SCHEME]["color4"];
    }

    if ($appbuilder_colorscheme_custom) {
        $colorCustom = explode("-", $appbuilder_colorscheme_custom);
    } else {
        $colorCustom = explode("-", $arrayCurValues[EDIR_SCHEME]["color1"]."-".$arrayCurValues[EDIR_SCHEME]["color4"]);
    }
    
	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/header.php");
 
?>

    <div  class="center-content">

        <div id="top-content">
            
            <div id="header-content" class="main-heading">
                <h1><?=system_showText(LANG_SITEMGR_APPBUILDER);?><small class="float-right"><a href="<?=(DEFAULT_URL."/".SITEMGR_ALIAS)?>"><?=system_showText(LANG_SITEMGR_BACKSITEMGR);?></a></small></h1>
                <h2><?=system_showText(LANG_SITEMGR_BUILDER_COLORS);?></h2>
            </div>
            
        </div>

        <div id="content-content">
            
            <?
            require(EDIRECTORY_ROOT."/".SITEMGR_ALIAS."/registration.php");
            require(EDIRECTORY_ROOT."/includes/code/checkregistration.php");
            require(EDIRECTORY_ROOT."/frontend/checkregbin.php");
            ?>
           
            <div class="appbuilder">
                
			    <? /*  Navbar  */
                    include("navbar.php");
                ?>
                
                <article>
                    
                    <h4><?=system_showText(LANG_SITEMGR_BUILDER_COLORS_1)?></h4>
                    <p class="subheading"><?=system_showText(LANG_SITEMGR_BUILDER_COLORS_2)?></p>
                    <p><?=system_showText(LANG_SITEMGR_BUILDER_COLORS_3)?></p>

                    <? if ($success) { ?>
                        <p id="successMessage" class="successMessage"><?=ucfirst(system_showText(LANG_SITEMGR_SETTINGSSUCCESSUPDATED));?></p>
                    <? } ?>

                    <form id="step3" name="step3" method="post" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>">

                        <input type="hidden" name="color_option" id="color_option" value="<?=$appbuilder_coloroption?>" />
                        <input type="hidden" name="next" id="next" value="no" />

                        <div class="span100">

                            <? 
                            $count = 0;
                            $countTotal = 0;
                            foreach ($arrayColorsApp as $color) {

                                $count++;
                                $countTotal++;
                                $auxColor = explode("-", $color);

                                if ($count == 1) { ?>

                                    <div class="col-1-3">

                                <? } ?>

                                <label class="colorscheme">
                                    <input type="radio" name="color_scheme" <?=($appbuilder_colorscheme == $auxColor[0]."-".$auxColor[1] ? "checked=\"checked\"" : "")?> value="<?=$auxColor[0]."-".$auxColor[1];?>" />
                                    <b style="background-color:#<?=$auxColor[0];?>"></b>
                                    <b style="background-color:#<?=$auxColor[1];?>"></b>
                                    <b class="colorname"><?=$auxColor[2];?></b>
                                </label>

                                <? if ($countTotal == count($arrayColorsApp)) { ?>
                                    <label class="colorscheme">
                                        <input type="radio" name="color_scheme" <?=($appbuilder_colorscheme == $appbuilder_colorscheme_custom ? "checked=\"checked\"" : "")?> value="custom" />
                                        <b class="colorSelector-5" id="colorSelectorApp1" style="background-color:#<?=$colorCustom[0];?>"><span></span></b>
                                        <input type="hidden" id="colorApp1" name="colorApp1" value="<?=$colorCustom[0];?>"/>
                                        <b class="colorSelector-5" id="colorSelectorApp2" style="background-color:#<?=$colorCustom[1];?>"><span></span></b>
                                        <input type="hidden" id="colorApp2" name="colorApp2" value="<?=$colorCustom[1];?>"/>
                                        <b class="colorname"><?=system_showText(LANG_SITEMGR_CUSTOM_COLOR);?></b>
                                    </label>
                                <? } ?>

                                <? if ($count == 4 || $countTotal == count($arrayColorsApp)) { $count = 0; ?>
                                    </div>
                                <? } ?>

                            <? } ?>

                        </div>

                        <div class="action">
                            <button type="button" class="btn btn-success" onclick="<?=DEMO_LIVE_MODE ? "livemodeMessage('".system_showText(LANG_SITEMGR_THEME_DEMO_MESSAGE2)."');" : "JS_submit(true);"?>"><?=system_showText(LANG_SITEMGR_SAVENEXT)?></button>
                        </div>

                    </form>
                        
                </article>
                
			</div>
            
        </div>
        
    </div>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>

    <script type="text/javascript">
        
        function JS_submit(next) {
            if (next) {
                $("#next").attr("value", "yes");
            }
            document.step3.submit();
        }
        
    </script>