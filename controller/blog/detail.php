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
	# * FILE: /controller/blog/detail.php
	# ----------------------------------------------------------------------------------------------------

    # ----------------------------------------------------------------------------------------------------
    # MODULE REWRITE
    # ----------------------------------------------------------------------------------------------------
    include(EDIR_CONTROLER_FOLDER."/".BLOG_FEATURE_FOLDER."/rewrite.php");

    # ----------------------------------------------------------------------------------------------------
	# VALIDATION
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/includes/code/validate_querystring.php");
    include(EDIRECTORY_ROOT."/includes/code/validate_frontrequest.php");

	setting_get("review_approve", $post_comment_approve);

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	if (($_SERVER["REQUEST_METHOD"] == "POST") && sess_getAccountIdFromSession()) {

		extract($_POST);
		$comment_email = trim($comment_email);
		$comment_email = system_denyInjections($comment_email);
		$comment = system_denyInjections($comment, true);
		$comment = stripslashes($comment);
		$error_comment = "";

		if (!validate_email($comment_email)) $error_comment .= system_showText(LANG_COMMENT_EMPTY_EMAIL)."<br />";
		if (!$comment) $error_comment .= system_showText(LANG_COMMENT_EMPTY)."<br />";
//		if ( md5($captchatext) != $_SESSION["captchakey"] ) {
//			$error_comment .= system_showText(LANG_MSG_CONTACT_TYPE_CODE)."<br />";
//		}
		
        if (empty($error_comment)) {

            $postid = $_GET["id"] ? $_GET["id"] : $_POST["id"];

            $commentObj = new Comments();
            $commentObj->setNumber("post_id", $id);
            $commentObj->setNumber("reply_id", ($reply_id ? $reply_id : 0));
            $member_id = sess_getAccountIdFromSession();
            $commentObj->setNumber("member_id", $member_id);
            $commentObj->setString("description", $comment);
            $commentObj->setString("name", $comment_name);
            $commentObj->setString("email", $comment_email);
            $commentObj->setString("approved", (!$post_comment_approve? 1: 0));
            $commentObj->Save();

            $postObj = new Post($id);
            $commentObj = new Comments($commentObj->getString("id"));

            // site manager warning message /////////////////////////////////////
            setting_get("sitemgr_blog_email", $sitemgr_blog_email);
            $sitemgr_blog_emails = explode(",", $sitemgr_blog_email);
            
            $emailSubject = "[".EDIRECTORY_TITLE."] ".($reply_id ? system_showText(LANG_NOTIFY_NEWREPLY) : system_showText(LANG_NOTIFY_NEWCOMMENT));
            
            # send email to sitegmr
            $sitemgr_msg = system_showText(LANG_LABEL_SITE_MANAGER).",<br /><br />"
                        .system_showText(LANG_NOTIFY_NEWCOMMENT_1)." \"".$postObj->getString("title")."\" ".($reply_id ? system_showText(system_showText(LANG_NOTIFY_NEWCOMMENT_2)) : system_showText(system_showText(LANG_NOTIFY_NEWCOMMENT_3)))."<br /><br />"
                        .$comment_name." (".$comment_email.") ".system_showText(LANG_NOTIFY_NEWCOMMENT_4).":<br /><br />"
                        .$comment."<br />"
                        ."<br />".system_showText(LANG_NOTIFY_NEWCOMMENT_5)." ".format_date($commentObj->getString("added"), DEFAULT_DATE_FORMAT." H:i:s", "datetime")."<br /><br />"
                        .system_showText(LANG_NOTIFY_NEWCOMMENT_6).":<br />"
                        ."<a href=\"".DEFAULT_URL."/".SITEMGR_ALIAS."/".BLOG_FEATURE_FOLDER."/comments/view.php?post_id=".$postid."&id=".$commentObj->getString("id")."\" target=\"_blank\">".DEFAULT_URL."/".SITEMGR_ALIAS."/".BLOG_FEATURE_FOLDER."/comments/view.php?post_id=".$postid."&id=".$commentObj->getString("id")."</a><br /><br />";

            system_notifySitemgr($sitemgr_blog_emails, $emailSubject, $sitemgr_msg);
            
            $comment = html_entity_decode($comment);
            
            $success_message = "";
            $success_approve_message = "";
            if (!$reply_id) {
                if ($post_comment_approve == "on") {
                    $success_approve_message = LANG_MSG_COMMENT_SENT_TO_APPROVE;
                } else {
                    $success_message = LANG_MSG_COMMENT_SUCCESSFULLY_POSTED;
                }
            } else {
                if ($post_comment_approve == "on") {
                    $success_approve_message = LANG_MSG_REPLY_SENT_TO_APPROVE;
                } else {
                    $success_message = LANG_MSG_REPLY_SUCCESSFULLY_POSTED;
                }
            }
            
            unset($comment_name);
            unset($comment_email);
            unset($comment);
        } else {
            $message_comment = true;
        }
	}

	# ----------------------------------------------------------------------------------------------------
	# BLOG
	# ----------------------------------------------------------------------------------------------------
	if (($_GET["id"]) || ($_POST["id"])) {
		$id = $_GET["id"] ? $_GET["id"] : $_POST["id"];
		$post = new Post($id);
		unset($postMsg);
		if ((!$post->getNumber("id")) || ($post->getNumber("id") <= 0)) {
			$postMsg = system_showText(LANG_MSG_NOTFOUND);
		} elseif ($post->getString("status") != "A") {
			$postMsg = system_showText(LANG_MSG_NOTAVAILABLE);
		}
		report_newRecord("post", $id, POST_REPORT_DETAIL_VIEW);
		$post->setNumberViews($id);
		
	} else {
		header("Location: ".BLOG_DEFAULT_URL."/");
		exit;
	}
	
	# ----------------------------------------------------------------------------------------------------
	# COMMENTS
	# ----------------------------------------------------------------------------------------------------
	$dbObj = db_getDBObJect();
	$sql_comment = " SELECT * FROM Comments WHERE post_id = $id AND reply_id = 0 AND approved = 1";
	$sql_comment .= " ORDER BY `added` DESC ";
	$result = $dbObj->query($sql_comment);
	while ($row = mysql_fetch_assoc($result)) {
		$commentArr[] = $row;
	}
    
    # ----------------------------------------------------------------------------------------------------
    # HEADER
    # ----------------------------------------------------------------------------------------------------
    if (($post->getNumber("id")) && ($post->getNumber("id") > 0)) {
        $postCategs = $post->getCategories(false, false, false, true, true);
        if ($postCategs) {
            foreach ($postCategs as $postCateg) {
                $category_id[] = $postCateg->getNumber("id");
            }
        }
    }
    $_POST["category_id"] = $category_id;
?>