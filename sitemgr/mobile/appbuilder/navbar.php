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
	# * FILE: /sitemgr/mobile/appbuilder/navbar.php
	# ----------------------------------------------------------------------------------------------------  
	
    for ($i = 1; $i <=5; $i++) {
        setting_get("appbuilder_step_".$i, ${"appbuilder_step_".$i});
    }
?>

	<nav class="navicons">

        <ol>
            <li class="<?=($appbuilder_step_1 == "done" ? "checked" : "")?> <?=(string_strpos($_SERVER["PHP_SELF"], "step1.php") !== false ? "active" : "")?>">
            	<a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/mobile/appbuilder/step1.php"><i class="iab-menu"></i><?=system_showText(LANG_SITEMGR_CONFIGURE_MENU);?></a>
            </li>

            <li class="<?=($appbuilder_step_2 == "done" ? "checked" : "")?> <?=(string_strpos($_SERVER["PHP_SELF"], "step2.php") !== false ? "active" : "")?>">
            	<a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/mobile/appbuilder/step2.php"><i class="iab-about"></i><?=system_showText(LANG_SITEMGR_CONFIGURE_ABOUT_PAGE);?></a>
            </li>

            <li class="<?=($appbuilder_step_3 == "done" ? "checked" : "")?> <?=(string_strpos($_SERVER["PHP_SELF"], "step3.php") !== false ? "active" : "")?>">
            	<a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/mobile/appbuilder/step3.php"><i class="iab-colors"></i><?=system_showText(LANG_SITEMGR_CONFIGURE_COLORS);?></a>
            </li>

            <li class="<?=($appbuilder_step_4 == "done" ? "checked" : "")?> <?=(string_strpos($_SERVER["PHP_SELF"], "step4.php") !== false ? "active" : "")?>">
            	<a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/mobile/appbuilder/step4.php"><i class="iab-icon"></i><?=system_showText(LANG_SITEMGR_CHOOSE_ICON);?></a>
            </li>

            <li class="<?=($appbuilder_step_5 == "done" ? "checked" : "")?> <?=(string_strpos($_SERVER["PHP_SELF"], "step5.php") !== false ? "active" : "")?>">
            	<a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/mobile/appbuilder/step5.php"><i class="iab-loadingimage"></i><?=system_showText(LANG_SITEMGR_CHOOSE_LOADING_PAGE);?></a>
            </li>

            <li class="<?=(string_strpos($_SERVER["PHP_SELF"], "previewapp.php") !== false ? "active" : "")?>">
            	<a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/mobile/appbuilder/previewapp.php"><i class="iab-previewapp"></i><?=system_showText(LANG_SITEMGR_DOWNLOAD_PREVIEWER);?></a>
            </li>

            <li class="<?=(string_strpos($_SERVER["PHP_SELF"], "finalstep.php") !== false ? "active" : "")?>">
            	<a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/mobile/appbuilder/finalstep.php"><i class="iab-build"></i><?=system_showText(LANG_SITEMGR_BUILD_APP);?></a>
            </li>
        </ol>

	</nav>