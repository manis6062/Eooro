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
	# * FILE: /includes/code/deal_redeem.php
	# ----------------------------------------------------------------------------------------------------
	$promotionMsg = "";
	if ($id) {
		$promotion = new Promotion($id);         
		if ((!$promotion->getNumber("id")) || ($promotion->getNumber("id") <= 0)) {
			$promotionMsg = system_showText(LANG_MSG_NOTFOUND);
		} else {
			$listing = db_getFromDB("listing", "promotion_id", $promotion->getNumber("id"));
			$today = mktime(0,0,0,date("m"),date("d"),date("Y"));
			list($promotion_end_year,$promotion_end_month,$promotion_end_day) = explode("-",$promotion->getString("end_date"));
			$promotion_end_date = mktime(0,0,0,(int)$promotion_end_month,(int)$promotion_end_day,(int)$promotion_end_year);
			if ((!$listing->getNumber("id")) || ($listing->getNumber("id") <= 0) || ($listing->getString("status") != "A") || ($promotion_end_date < $today)) {
				$promotionMsg = system_showText(LANG_MSG_NOTAVAILABLE);
			}
		}
	} else {
		$promotionMsg = system_showText(LANG_MSG_NOTFOUND);
	}

	if ($promotion) {
		$headertag_title = (($promotion->getString("seo_name"))?($promotion->getString("seo_name")):($promotion->getString("name")));
		$headertag_description = (($promotion->getString("seo_description"))?($promotion->getString("seo_description")):($promotion->getString("description")));
		$headertag_keywords = (($promotion->getString("seo_keywords"))?($promotion->getString("seo_keywords")):(str_replace(" || ", ", ", $promotion->getString("keywords"))));
	} else {
		$headertag_title = $promotionMsg;
	}

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	$errorNumber = 0;
	$sucessMessage = "";
	
	if ($redeemit && sess_getAccountIdFromSession() && !$promotionMsg) {

		setting_get("promotion_force_redeem_by_facebook", $promotion_force_redeem_by_facebook);

		if (!$nofacebook) { //Redeem and post on Facebook
			$profileObj = new Profile(sess_getAccountIdFromSession());
			$promotion = new Promotion($id);
			$redeemCheck = $promotion->alreadyRedeemed($id);
			if ($redeemCheck){
				$errorNumber = 1;
			}

			Facebook::getFBInstance($facebook);
			$user = $facebook->getUser();
			if (!$user) $errorNumber = 2;
			
			if (!$errorNumber) {
				$response = socialnetwork_postOnFacebook($promotion);
				$redeem_code = $profileObj->deal_done("facebook", $id, $response);
				socialnetwork_postOnTwitter($promotion);
				$promotion->setNumber("amount", $promotion->getNumber("amount") -1);
				$promotion->Save();
                $dicreaseLeft = false;
				$sucessMessage = "OK";
			}
		} else if(($promotion_force_redeem_by_facebook || FACEBOOK_APP_ENABLED == "off" || $isMobileRedeem) && sess_getAccountIdFromSession()) { //Redeem by email/twitter only
			$promotion = new Promotion($id);
			$redeemCheck = $promotion->alreadyRedeemed($id);
			if ($redeemCheck) {
				$errorNumber = 1;
			}
			if (!$errorNumber) {
				$profileObj = new Profile(sess_getAccountIdFromSession());
				$redeem_code = $profileObj->deal_done("profile", $id, "no facebook");
				socialnetwork_postOnTwitter($promotion);
                $dicreaseLeft = true;
				$sucessMessage = "OK";
			}
		} else {
            $errorNumber = 3;
        }
        
        if ($redeem_code) {
            $promotionDeals = $promotion->getDealInfo();
            $amountLeft = ($dicreaseLeft ? $promotionDeals['left'] - 1 : $promotionDeals['left']);
            $newdealsDone = $promotionDeals['sold'];
            $newdealsLeft = $amountLeft;
        } else {
            $newdealsDone = 0;
        }
    } elseif (!$promotionMsg) {
        $errorNumber = 3;
    }
?>