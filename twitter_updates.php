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
	# * FILE: /twitter_updates.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("./conf/loadconfig.inc.php");
	
	header("Content-Type: text/html; charset=".EDIR_CHARSET, TRUE);
	header("Accept-Encoding: gzip, deflate");
	header("Expires: Sat, 01 Jan 2000 00:00:00 GMT");
	header("Cache-Control: no-store, no-cache, must-revalidate");
	header("Cache-Control: post-check=0, pre-check", FALSE);
	header("Pragma: no-cache");
    
    extract($_GET);
	
    if ($user_id) {
        $profileObj = new Profile($user_id);
        $tw_oauth_token = $profileObj->getString("tw_oauth_token");
        $tw_oauth_secret = $profileObj->getString("tw_oauth_token_secret");
        $user = $profileObj->getString("twitter_account");
        $posts = MAX_TWEETS_MEMBERS;
    } else {
        setting_get("foreignaccount_twitter_oauthtoken", $tw_oauth_token);
        setting_get("foreignaccount_twitter_oauthsecret", $tw_oauth_secret);
        setting_get("twitter_account", $user);
        $posts = MAX_TWEETS_FRONT;
    }

    $array_twitter = "";
    $array_twitter = twitter_getPublicTimeline($user, EDIRECTORY_ROOT."/custom/domain_".SELECTED_DOMAIN_ID."/tmp", TWITTER_CACHE_TIME, $tw_oauth_token, $tw_oauth_secret);

    if (is_array($array_twitter)) {

        $i = 0;
        unset($twitter_updates);

        foreach ($array_twitter as $tweet) {
            if ($i > MAX_TWEETS_FRONT) break;
            $date = strtotime($tweet["created_at"]);
            $twitter_updates[$date]["url"]    = "http://twitter.com/".$user;
            $twitter_updates[$date]["text"]   = twitter_makeLinksClickable($tweet["text"]);
            $twitter_updates[$date]["date"]   = twitter_agoTime($tweet["created_at"]);
            $twitter_updates[$date]["id"]	  = $tweet["id"];
            $i++;
        }
    }

    if (is_array($twitter_updates)) {

        ksort($twitter_updates);

        $twitter_updates = array_reverse(array_slice($twitter_updates, -1*$posts));

        if (count($twitter_updates) > 0) {

            foreach ($twitter_updates as $tweet) {

                echo "<li style=\"display: list-item;\">";
                echo "<span>";
                echo $tweet["text"];
                echo "</span>";
                echo "<a href=\"".$tweet["url"]."/statuses/".$tweet["id"]."\">";
                echo $tweet["date"];
                echo "</a>";
                echo "</li>";

            }
        }
    }
?>