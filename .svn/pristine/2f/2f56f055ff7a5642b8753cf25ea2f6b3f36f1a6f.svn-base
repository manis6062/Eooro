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
	# * FILE: /includes/views/view_review.php
	# ----------------------------------------------------------------------------------------------------
	$item_review = "";

	if (!$tPreview) {
		if ($article) {
			$aux = $article->data_in_array;
		} else {
			if (((ACTUAL_MODULE_FOLDER == PROMOTION_FEATURE_FOLDER) || $summayDealAjax || string_strpos($_SERVER["PHP_SELF"], "".SITEMGR_ALIAS."/".PROMOTION_FEATURE_FOLDER) !== false || string_strpos($_SERVER["PHP_SELF"], "".MEMBERS_ALIAS."/".PROMOTION_FEATURE_FOLDER) !== false) && !$listingReviewDeal) {
				if (is_array($promotion)) {
					$aux = $promotion;
				} else if (is_object($promotion)) {
					$aux = $promotion->data_in_array;
				}
			} else {
				if (is_array($listing)) {
					$aux = $listing;
				} else if (is_object($listing)) {
					$aux = $listing->data_in_array;
				}
			}
		}

		$item_default_url = constant(string_strtoupper($item_type).'_DEFAULT_URL');
	}

	###################################################################
	######################     REVIEWS    #############################
	###################################################################

	if ($review_enabled == "on" && $commenting_edir) {
        
		if ($tPreview) {
			$rate_avg = 3;
		} else {
			$rate_avg = htmlspecialchars($aux["avg_review"]);
			$rate_avg = (isset($rate_avg) && $rate_avg != 0) ? round($rate_avg, 2) : system_showText(LANG_NA);
		}
		unset($rate_stars);

		if ($rate_avg) {
            
			if ($tPreview) {
				$review_amount = 10;
			} else {
				$dbMain = db_getDBObject(DEFAULT_DB, true);
				$db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
				$sql = "SELECT * FROM Review WHERE item_type = '$item_type' AND item_id = ".db_formatNumber($aux["id"])." AND review IS NOT NULL AND review != '' AND approved=1 AND is_deleted=0 AND status = 'A' order by added desc";

				$r = $db->query($sql);
				$review_amount = mysql_num_rows($r);
			}

            //Link to open the Review Form
            $linkReviewFormPopup = DEFAULT_URL."/popup/popup.php?pop_type=reviewformpopup&amp;item_type=".$item_type."&amp;item_id=".htmlspecialchars($aux["id"]);
            $auxlinkReviewFormPopup = $linkReviewFormPopup;
            $class = "iframe fancy_window_review";
			if ($user) {
				$linkReviewFormPopup = sess_validateSessionItens($item_type, "rate", false, $linkReviewFormPopup, htmlspecialchars($aux["id"]));
                if ($auxlinkReviewFormPopup != $linkReviewFormPopup) {
                    $class = "fancy_window_iframe";
                } else {
                    $class = "iframe fancy_window_review";
                }
			}

			if ($_SESSION["ITEM_ACTION"] == "rate" && $_SESSION["ITEM_TYPE"] && (is_numeric($_SESSION["ITEM_ID"]) && $_SESSION["ITEM_ID"] == htmlspecialchars($aux["id"])) && sess_isAccountLogged()) { ?>
				<link rel="stylesheet" href="<?=DEFAULT_URL;?>/scripts/jquery/fancybox/v2/helpers/jquery.fancybox-buttons.css">
				<script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/jquery/fancybox/v2/jquery.fancybox.pack.js"></script>
                <a rel="nofollow" href="<?=$linkReviewFormPopup?>" id="login_window" class="fancy_window_review" style="display:none"></a>
                
                <script type="text/javascript">
                    $("a.fancy_window_review").fancybox({
                        width           : <?=FANCYBOX_REVIEW_WIDTH?>,
                        height          : <?=FANCYBOX_REVIEW_HEIGHT?>,
                        
                        <? if (THEME_FLAT_FANCYBOX) { ?>
                                                
                        padding             : 0,
                        margin              : 0,
                        closeBtn            : false,

                        <? } ?>
                        
                        type            : 'iframe'
                    });
                    
                    $(document).ready(function() {
                        $("#login_window").trigger('click');
                    });
                </script>

				<?
				unset($_SESSION["ITEM_ACTION"], $_SESSION["ITEM_TYPE"], $_SESSION["ITEM_ID"]);
			}
            
            $reviewCodePath = INCLUDES_DIR."/views/view_review_code.php";
            $reviewCodeThemePath = INCLUDES_DIR."/views/view_review_code_".EDIR_THEME.".php";

            if (file_exists($reviewCodeThemePath)) {
                include($reviewCodeThemePath);
            } else {
                include($reviewCodePath);
            }
			
		}
	}

	###################################################################
	###################################################################
	###################################################################

	unset($aux);
?>