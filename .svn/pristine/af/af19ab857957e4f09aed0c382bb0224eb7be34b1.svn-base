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
	# * FILE: /members/article/preview.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (ARTICLE_FEATURE != "on" || CUSTOM_ARTICLE_FEATURE != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSession();
	$acctId = sess_getAccountIdFromSession();

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_GET);
	extract($_POST);

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	$error = false;
	if ($id) {
		$article = new Article($id);
		if ((!$article->getNumber("id")) || ($article->getNumber("id") <= 0)) {
			$error = true;
		}
		if (sess_getAccountIdFromSession() != $article->getNumber("account_id")) {
			$error = true;
		}
	} else {
		$error = true;
	}

	header("Content-Type: text/html; charset=".EDIR_CHARSET, TRUE);

	# ----------------------------------------------------------------------------------------------------
	# REVIEWS
	# ----------------------------------------------------------------------------------------------------
	if ($id)  $sql_where[] = " item_type = 'article' AND item_id = ".db_formatNumber($id)." ";
	$sql_where[] = " review IS NOT NULL AND review != '' ";
	$sql_where[] = " approved = '1' ";
	if ($sql_where) $sqlwhere .= " ".implode(" AND ", $sql_where)." ";
	$pageObj  = new pageBrowsing("Review", $screen, false, "added DESC", "", "", $sqlwhere);
	$reviewsArr = $pageObj->retrievePage("object");

?>

    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
        
        <head>
            <? if (sess_getAccountIdFromSession()) {
                $dbObjWelcome = db_getDBObJect(DEFAULT_DB, true);
                $sqlWelcome = "SELECT first_name, last_name FROM Contact WHERE account_id = ".sess_getAccountIdFromSession();
                $resultWelcome = $dbObjWelcome->query($sqlWelcome);
                $contactWelcome = mysql_fetch_assoc($resultWelcome);
            } ?>
            <meta http-equiv="Content-Type" content="text/html; charset=<?=EDIR_CHARSET;?>" />
            
            <? include(EDIRECTORY_ROOT."/includes/code/head_preview.php"); ?>                
        </head>
        
    <!--[if IE 7]><body class="ie ie7 previewmember"><![endif]-->
	<!--[if lt IE 9]><body class="ie previewmember"><![endif]-->
    <!-- [if false]><body class="previewmember"><![endif]-->

            <? if (!$error) {

                $level = new ArticleLevel();

                ?>

                <div class="level level-preview">
                    
                    <? if (THEME_FLAT_FANCYBOX) { ?>
    
                        <h2>
                            <span>
                                <a href="javascript:void(0);" onclick="parent.$.fancybox.close();"><?=system_showText(LANG_CLOSE);?></a>
                            </span>
                        </h2>

                    <? } ?>

                    <div class="level-summary">	

                        <p class="preview-desc"><?=system_showText(LANG_LABEL_SUMMARY_PAGE);?></p>

                        <?
                        $type = "summary";
                        include(INCLUDES_DIR."/views/view_article_summary.php");
                        ?>

                    </div>

                    <?

                    $type = "detail";
                    $typePreview = "detail"; 

                    if ($level->getDetail($article->getNumber("level")) == "y") { ?>

                        <div class="level-detail">

                            <p class="preview-desc"><?=system_showText(LANG_LABEL_DETAIL_PAGE);?></p>

                            <?
                            $signUpItem = "article";
                            $signUpArticle = true;
                            include(system_getFrontendPath("detail_preview.php", "frontend"));
                            ?>

                        </div>
                        
                    <? } ?>

                </div>

            <? } else { ?>
    
                <p class="errorMessage"><?=system_showText(LANG_MSG_NOTFOUND);?></p>
                
            <? } ?>

        </body>
        
    </html>