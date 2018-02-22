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
	# * FILE: /members/listing/preview.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

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
		$listing = new Listing($id);
		if ((!$listing->getNumber("id")) || ($listing->getNumber("id") <= 0)) {
			$error = true;
		}
		if (sess_getAccountIdFromSession() != $listing->getNumber("account_id")) {
			$error = true;
		}
	} else {
		$error = true;
	}

	header("Content-Type: text/html; charset=".EDIR_CHARSET, TRUE);
	
	# ----------------------------------------------------------------------------------------------------
	# REVIEWS
	# ----------------------------------------------------------------------------------------------------
	if ($id)  $sql_where[] = " item_type = 'listing' AND item_id = ".db_formatNumber($id)." ";
	$sql_where[] = " review IS NOT NULL AND review != '' ";
	$sql_where[] = " approved = '1' ";
        $sql_where[] = " is_deleted=0 ";
	if ($sql_where) $sqlwhere .= " ".implode(" AND ", $sql_where)." ";
	$pageObj  = new pageBrowsing("Review", $screen, false, "added DESC", "", "", $sqlwhere);
	$reviewsArr = $pageObj->retrievePage("object");

	# ----------------------------------------------------------------------------------------------------
	# CHECK INS
	# ----------------------------------------------------------------------------------------------------
	if ($id)  $sql_where2[] = " item_id = ".db_formatNumber($id)." ";
	$sql_where2[] = " quick_tip IS NOT NULL AND quick_tip != '' ";
	if ($sql_where2) $sqlwhere2 .= " ".implode(" AND ", $sql_where2)." ";
	$pageObj  = new pageBrowsing("CheckIn", $screen, 3, "added DESC", "", "", $sqlwhere2);
	$checkinsArr = $pageObj->retrievePage("object");

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
            <title><?=( ($contactWelcome) ? $contactWelcome["first_name"]." ".$contactWelcome["last_name"].", " : "" ) . system_showText(LANG_MSG_WELCOME) . " - " .  system_showText(LANG_LISTING_PREVIEW);?></title>
            
            <? include(EDIRECTORY_ROOT."/includes/code/head_preview.php"); ?>
        </head>
        
    <!--[if IE 7]><body class="ie ie7 previewmember"><![endif]-->
	<!--[if lt IE 9]><body class="ie previewmember"><![endif]-->
    <!-- [if false]><body class="previewmember"><![endif]-->
    
            <?
            if (!$error) {
                setting_get('commenting_edir', $commenting_edir);
                setting_get("review_listing_enabled", $review_enabled);
                $levelsWithReview = system_retrieveLevelsWithInfoEnabled("has_review");
                $levelObj = new ListingLevel();
                ?>
    <?=(EDIR_THEME==='review') ? '<div class="container">' : ''?>
                <div class="level level-preview">
                    <!-- modification  -->
                    <? if (THEME_FLAT_FANCYBOX) { ?>
                        <?=(EDIR_THEME==='review') ? '<div class="row bg">' : '' ?>
                        <h2>
                            <span>
                                <a href="javascript:void(0);" onclick="parent.$.fancybox.close();"><?=system_showText(LANG_CLOSE);?></a>
                            </span>
                        </h2>
                        <?=(EDIR_THEME==='review') ? '</div>' : '' ?>

                    <? } ?>

                    <div class="level-summary">	

                        <p class="preview-desc"><?=system_showText(LANG_LABEL_SUMMARY_PAGE);?></p>

                        <?
                        /**
                        * This variable is used on view_listing_summary.php
                        */
                        if (TWILIO_APP_ENABLED == "on") {
                            if (TWILIO_APP_ENABLED_SMS == "on"){
                                $levelsWithSendPhone = system_retrieveLevelsWithInfoEnabled("has_sms");
                            }else{
                                $levelsWithSendPhone = false;
                            }
                            if (TWILIO_APP_ENABLED_CALL == "on"){
                                $levelsWithClicktoCall = system_retrieveLevelsWithInfoEnabled("has_call");
                            }else{
                                $levelsWithClicktoCall = false;
                            }
                        } else {
                            $levelsWithSendPhone = false;
                            $levelsWithClicktoCall = false;
                        }

                        $type = "summary";
                        include(INCLUDES_DIR."/views/view_listing_summary.php");
                        ?>

                    </div>

                    <?
                    /*
                    * Create new Listing Obj
                    */
                    $listing = new Listing($id);
                        $type = "detail";
                        $typePreview = "detail"; 

                    if ($levelObj->getDetail($listing->getNumber("level")) == "y") { ?>
                    
                        <div class="level-detail">

                            <p class="preview-desc"><?=system_showText(LANG_LABEL_DETAIL_PAGE);?></p>

                            <?
                            $signUpItem = "listing";
                            $signUpListing = true;
                            include(system_getFrontendPath("detail_preview.php", "frontend"));
                            ?>

                        </div>
                    
                    <? } ?>
                    
                </div>
            <?=(EDIR_THEME==='review') ? '</div>' : ''?>
            <? } else { ?>
    
                <p class="errorMessage"><?=system_showText(LANG_MSG_NOTFOUND);?></p>
                
            <? } ?>

        </body>
        
    </html>