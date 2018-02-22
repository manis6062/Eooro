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
	# * FILE: /sitemgr/deal/preview.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
    # VALIDATION
    # ----------------------------------------------------------------------------------------------------
    if ( PROMOTION_FEATURE != "on" || CUSTOM_PROMOTION_FEATURE != "on" || CUSTOM_HAS_PROMOTION != "on") { exit; }
	
	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();

	$url_redirect = "".DEFAULT_URL."/".SITEMGR_ALIAS."/".PROMOTION_FEATURE_FOLDER;
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
		$promotion = new Promotion($id);
		if ((!$promotion->getNumber("id")) || ($promotion->getNumber("id") <= 0)) {
			$error = true;
		}
	} else {
		$error = true;
	}

	header("Content-Type: text/html; charset=".EDIR_CHARSET, TRUE);
	
	# ----------------------------------------------------------------------------------------------------
	# REVIEWS
	# ----------------------------------------------------------------------------------------------------
	if ($id)  $sql_where[] = " item_type = 'promotion' AND item_id = ".db_formatNumber($id)." ";
	$sql_where[] = " review IS NOT NULL AND review != '' ";
	$sql_where[] = " approved = '1' ";
	if ($sql_where) $sqlwhere .= " ".implode(" AND ", $sql_where)." ";
	$pageObj  = new pageBrowsing("Review", $screen, 3, "added DESC", "", "", $sqlwhere);
	$reviewsArr = $pageObj->retrievePage("object");

?>

    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
        
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=<?=EDIR_CHARSET;?>" />
            <title><?=system_showText(LANG_SITEMGR_HOME_WELCOME) . " - " . system_showText(LANG_SITEMGR_PROMOTION)?> - <?=string_ucwords(system_showText(LANG_SITEMGR_PREVIEW))?></title>
            
            <? include(EDIRECTORY_ROOT."/includes/code/head_preview.php"); ?>            
        </head>

    <!--[if IE 7]><body class="ie ie7 previewmember"><![endif]-->
	<!--[if lt IE 9]><body class="ie previewmember"><![endif]-->
    <!-- [if false]><body class="previewmember"><![endif]-->
                  
            <? if (CUSTOM_PROMOTION_FEATURE != "on") { ?>
                <p class="informationMessage">
                    <?=system_showText(LANG_SITEMGR_MODULE_UNAVAILABLE)?>
                </p>
            <? } else {

                if (!$error) { ?>

                    <div class="level level-preview">

                        <div class="level-summary">	

                            <p class="preview-desc"><?=system_showText(LANG_SITEMGR_SUMMARYPAGE);?></p>

                            <?
                            $type = "summary";
                            setting_get('commenting_edir', $commenting_edir);
                            setting_get("review_promotion_enabled", $review_enabled);
                            include(INCLUDES_DIR."/views/view_promotion_summary.php");
                            ?>

                        </div>

                        <div class="level-detail">

                            <p class="preview-desc"><?=system_showText(LANG_SITEMGR_DETAILPAGE);?></p>

                            <?
                            $signUpItem = "promotion";
                            $signUpPromotion = true;
                            include(system_getFrontendPath("detail_preview.php", "frontend"));
                            ?>

                        </div>
                        
                    </div>

                <? } else { ?>
    
                    <p class="errorMessage"><?=system_showText(LANG_MSG_NOTFOUND);?></p>
                    
                <? }
            }
        ?>
                    
        </body>
        
    </html>