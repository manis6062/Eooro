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
	# * FILE: /functions/socialnetwork_funct.php
	# ----------------------------------------------------------------------------------------------------

	
	function socialnetwork_writeLink($member_id, $module, $type, $image = false, $ref = false, $tb = false, $class = "", $user = true, $classImg = "", $sponsorArea = false, $defAccount = false, $defProfile = false, $defContact = false ) {
		if ($member_id == 0) {
			return false;
		}
		$account = $defAccount ? $defAccount : new Account($member_id);
		$profile = $defProfile ? $defProfile : new Profile($member_id);
		$contact = $defContact ? $defContact : db_getFromDB("contact", "account_id", db_formatNumber($member_id), "1");

		$name_title = string_htmlentities(string_ucwords($profile->nickname && $account->has_profile == "y"? $profile->nickname: $contact->first_name." ".$contact->last_name));
		if ($profile->getNumber("account_id") > 0) {
			$name_link = string_ucwords($profile->nickname && $account->has_profile == "y"? $profile->nickname: $contact->first_name." ".$contact->last_name);
            $name_link = system_showTruncatedText($name_link, 30);
		}

		if ($account->has_profile == "y" && SOCIALNETWORK_FEATURE == "on" && $account->getNumber("id") > 0) {
			
            if (is_numeric($image)) {
                $imgObj = new Image($image, true);
                if ($imgObj->imageExists()) {
                    if ($ref == true) {
                        if ($user) {
                            $link = "<a ".$class." href=\"javascript:void(0);\" onclick=\"urlRedirect('".SOCIALNETWORK_URL."/".$profile->getString("friendly_url")."/');\" title=\"".$name_title."\" id=\"".$profile->nickname."\">";
                        } else {
                            $link = "<a ".$class." href=\"javascript:void(0);\" style=\"cursor: default;\" title=\"".$name_title."\" id=\"".$profile->nickname."\">";
                        }
                    } else {
                        if ($user) {
                            $link = "<a ".$class." href=\"".SOCIALNETWORK_URL."/".$profile->getString("friendly_url")."/\" title=\"".$name_title."\" id=\"".$profile->nickname."\">";
                        } else {
                            $link = "<a ".$class." href=\"javascript:void(0);\" style=\"cursor:default;\" title=\"".$name_title."\" id=\"".$profile->nickname."\">";
                        }

                    }
                    $link .= $imgObj->getTag(true, PROFILE_IMAGE_WIDTH, PROFILE_IMAGE_HEIGHT, "", false, false, $classImg);
                    $link .= "</a>";

                } else {
                    if ($ref == true) {
                        if ($user) {
                            $link = "<a ".$class." href=\"javascript:void(0);\" onclick=\"urlRedirect('".SOCIALNETWORK_URL."/".$profile->getString("friendly_url")."/');\" title=\"".$name_title."\" id=\"".$profile->nickname."\">";
                        } else {
                            $link = "<a ".$class." href=\"javascript:void(0);\" style=\"cursor:default\" title=\"".$name_title."\" id=\"".$profile->nickname."\">";
                        }
                    } else {
                        if ($user) {
                            $link = "<a ".$class." href=\"".SOCIALNETWORK_URL."/".$profile->getString("friendly_url")."/\" title=\"".$name_title."\" id=\"".$profile->nickname."\">";
                        } else {
                            $link = "<a ".$class." href=\"javascript:void(0);\" style=\"cursor:default\" title=\"".$name_title."\" id=\"".$profile->nickname."\">";
                        }
                    }
                    if ($profile->facebook_image) {
                        
         //Check if the url signature is expired 
        if (checkExpiredImage($profile->facebook_image) == "URL signature expired") {
                        $facebookImage = DEFAULT_URL . "/images/profile_noimage.png";
                    } else {
                        $facebookImage = $profile->facebook_image;
                        if (HTTPS_MODE == "on") {
                            $facebookImage = str_replace("http://", "https://", $profile->facebook_image);
                        }
                    }
                    image_getNewDimension(PROFILE_IMAGE_WIDTH, PROFILE_IMAGE_HEIGHT, $profile->facebook_image_width ? $profile->facebook_image_width : 100, $profile->facebook_image_height ? $profile->facebook_image_height : 100, $newWidth, $newHeight);
                            $link .= "<img ".($classImg ? "class=\"$classImg\"" : "")." width=\"$newWidth\" height=\"$newHeight\" src=\"".$facebookImage."\" border=\"0\" title=\"".$name_title."\" alt=\"".$name_title."\" />";
                    } else {
                        if (string_strpos($_SERVER["PHP_SELF"], "/".SITEMGR_ALIAS)){
                            $link .= "<span class=\"no-image no-link\"></span>";
                        } elseif ($sponsorArea) {
                            $link .= "<img src=\"".DEFAULT_URL."/images/profile_noimage.png\" alt=\"$reviewer_name\">";
                        } else {
                            $link .= "<span class=\"no-image\"></span>";
                        }
                    }
                    $link .= "</a>";

                }
            } else if (!$image && !$ref) {
                if ($tb == true) {
                    if ($user) {
                        $link = "<a ".$class." href=\"javascript:void(0);\" onclick=\"urlRedirect('".SOCIALNETWORK_URL."/".$profile->getString("friendly_url")."/');\" title=\"".$name_title."\" id=\"".$profile->nickname."\">".$name_link."</a>";
                    } else {
                        $link = "<a ".$class." href=\"javascript:void(0);\" style=\"cursor:default\" title=\"".$name_title."\" id=\"".$profile->nickname."\">".$name_link."</a>";
                    }
                } else {
                    if ($user) {
                        $link = "<a ".$class." href=\"".SOCIALNETWORK_URL."/".$profile->getString("friendly_url")."/\" title=\"".$name_title."\" id=\"".$profile->nickname."\">".$name_link."</a>";
                    } else {
                        $link = "<a ".$class." href=\"javascript:void(0);\" style=\"cursor:default\" title=\"".$name_title."\" id=\"".$profile->nickname."\">".$name_link."</a>";
                    }
                }
            } else if ($ref == true) {
                if ($user) {
                    $link = SOCIALNETWORK_URL."/".$profile->getString("friendly_url")."/";
                } else {
                    $link = "href=\"javascript:void(0);\" style=\"cursor:default\"";
                }
            }

			
		} elseif (!$sponsorArea) {
			if (SOCIALNETWORK_FEATURE == "on" && $ref) {
				$link = "<img width=\"".PROFILE_IMAGE_WIDTH."\" height=\"".PROFILE_IMAGE_HEIGHT."\" src=\"".DEFAULT_URL."/images/profile_noimage.png\" border=\"0\" alt=\"No Image\" />";
			} else {
				if ($name_link) {
					$link = "<strong>".$name_link."</strong>";
				}
			}
		}
                
                // if url signature expired then remove default image
                if($facebookImage == DEFAULT_URL . "/images/profile_noimage.png"){
                    unset($link);
                }
		
		return $link;
	}

	function socialnetwork_retrieveInfoProfile($account_id) {
		$dbObj = db_getDBObJect(DEFAULT_DB,true);
		$sql = "SELECT * FROM Account, Contact, Profile WHERE Contact.account_id = Profile.account_id AND Profile.account_id = $account_id AND Account.id = $account_id";
		$result = $dbObj->query($sql);
		$row = mysql_fetch_assoc($result);
			
		return $row;
	}
	
	function socialnetwork_postOnFacebook($promotion){

        $link = PROMOTION_DEFAULT_URL."/".ALIAS_SHARE_URL_DIVISOR."/".$promotion->getString("friendly_url");
		
		$image = "";
		$imageObj = new Image($promotion->getNumber("image_id"));
		if ($imageObj->imageExists()) {
			$image = IMAGE_URL."/".$imageObj->getString("prefix")."photo_".$imageObj->getNumber("id").".".string_strtolower($imageObj->getString("type"));
		}
					
		Facebook::getFBInstance($facebook);
		$facebookPost =  array(
			'access_token' => $facebook->getAccessToken(),
			'message' => $promotion->getTagLine(),
			'name' => $promotion->getString("name"),
			'caption' => $promotion->getString("name"),
			'link' => $link,
			'description' => $promotion->getString("description"),
			'picture'=> $image
		);
		
		$response = $facebook->api('/me/feed', 'POST', $facebookPost);
		$response = implode("\n", $response);
		return $response;
	}
	
	function socialnetwork_postOnTwitter($promotion){
		
		setting_get("foreignaccount_twitter_apikey", $consumer_key);
		setting_get("foreignaccount_twitter_apisecret", $consumer_secret);
		if ($consumer_key && $consumer_secret ){
			$twitterSupport = true;
		}

		if ($twitterSupport){
			$hasSession = true;
			// 1nd: check if has twitter liked
			$profileObj = new Profile(sess_getAccountIdFromSession());
			if (!$profileObj->getString("tw_screen_name") || $profileObj->getString("tw_screen_name") == ""){
				$hasSession = false;
			}

			// 2rd: check if twitter auto post is checked
			if ($hasSession && !$profileObj->getNumber("tw_post")){
				$hasSession = false;
			}

			// 3rd: send to Twitter
			if ($hasSession){

				$link = DEFAULT_URL."/".ALIAS_PROMOTION_MODULE."/".$promotion->getString("friendly_url");

				/*** creates URL for API ***/
				$urlapi = "http://tinyurl.com/api-create.php?url=".urlencode($link);
				/*** activate cURL for URL shortening ***/
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $urlapi);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				$shorturl = curl_exec($ch);
				curl_close($ch);

				$encodedmessage = $promotion->getTagLine($shorturl);
				$twitterObj = new EpiTwitter($consumer_key, $consumer_secret);
				$twitterObj->setToken($profileObj->getString("tw_oauth_token"), $profileObj->getString("tw_oauth_token_secret"));
				$update_status = $twitterObj->post_statusesUpdate(array('status'  => $encodedmessage));
				$response = $update_status->response;
				$profileObj->deal_done('twitter', $promotion->getNumber("id"), implode("|",$response));
			}
		}	
	}
?>
