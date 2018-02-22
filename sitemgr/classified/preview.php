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
	# * FILE: /sitemgr/classified/preview.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (CLASSIFIED_FEATURE != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();

	$url_redirect = "".DEFAULT_URL."/".SITEMGR_ALIAS."/".CLASSIFIED_FEATURE_FOLDER;
	$url_base = "".DEFAULT_URL."/".SITEMGR_ALIAS."";
	$sitemgr = 1;

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_POST);
	extract($_GET);

	$url_search_params = system_getURLSearchParams((($_POST)?($_POST):($_GET)));

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	$error = false;
	if ($id) {
		$classified = new Classified($id);
		if ((!$classified->getNumber("id")) || ($classified->getNumber("id") <= 0)) {
			$error = true;
		}
	} else {
		$error = true;
	}

	header("Content-Type: text/html; charset=".EDIR_CHARSET, TRUE);

?>

    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
        
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=<?=EDIR_CHARSET;?>" />
            <title><?=system_showText(LANG_SITEMGR_HOME_WELCOME) . " - " . system_showText(LANG_SITEMGR_CLASSIFIED_SING)?> - <?=string_ucwords(system_showText(LANG_SITEMGR_PREVIEW))?></title>
            
            <? include(EDIRECTORY_ROOT."/includes/code/head_preview.php"); ?>
        </head>

    <!--[if IE 7]><body class="ie ie7 previewmember"><![endif]-->
	<!--[if lt IE 9]><body class="ie previewmember"><![endif]-->
    <!-- [if false]><body class="previewmember"><![endif]-->
            
            <? if (CUSTOM_CLASSIFIED_FEATURE != "on") { ?>
                <p class="informationMessage">
                    <?=system_showText(LANG_SITEMGR_MODULE_UNAVAILABLE)?>
                </p>
            <? } else {

                if (!$error) {

                    $level = new ClassifiedLevel();

                    ?>

                    <div class="level level-preview">

                        <div class="level-summary">	

                            <p class="preview-desc"><?=system_showText(LANG_SITEMGR_SUMMARYPAGE);?></p>

                            <?
                            $type = "summary";
                            include(INCLUDES_DIR."/views/view_classified_summary.php");
                            ?>

                        </div>

                        <?

                        $type = "detail";
                        $typePreview = "detail"; 
                        
                        if ($level->getDetail($classified->getNumber("level")) == "y") { ?>

                            <div class="level-detail">

                                <p class="preview-desc"><?=system_showText(LANG_SITEMGR_DETAILPAGE);?></p>

                                <?
                                $signUpItem = "classified";
                                $signUpClassified = true;
                                include(system_getFrontendPath("detail_preview.php", "frontend"));
                                ?>

                            </div>

                        <? } ?>

                    </div>
    
                <? } else { ?>
    
                    <p class="errorMessage"><?=system_showText(LANG_MSG_NOTFOUND);?></p>
                    
                <? }
            }
            ?>
                    
        </body>
        
    </html>