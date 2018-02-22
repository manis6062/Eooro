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
	# * FILE: /rateReview.php
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
      
    extract($_POST);
    
    $reviewObj = new Review($id);
    
    if ($reviewObj->getNumber("id")) {
    
        if ($action == "like") {
            $field = "like";
            $fieldIP = "like_ips";
            
            $field2 = "dislike";
            $fieldIP2 = "dislike_ips";
        } elseif ($action == "dislike") {
            $field = "dislike";
            $fieldIP = "dislike_ips";
            $field2 = "like";
            $fieldIP2 = "like_ips";
        }
        
        $ratings = $reviewObj->getNumber($field);
        $ratings2 = $reviewObj->getNumber($field2);
        $ips = $reviewObj->getString($fieldIP);
        $ips2 = $reviewObj->getString($fieldIP2);
        
        $arrayIP = explode(",", $reviewObj->getString($fieldIP));
        $arrayIP2 = explode(",", $reviewObj->getString($fieldIP2));
        
        //IF USER HAS ALREADY RATED

        if ($reviewObj->getString($fieldIP) && in_array("||".$_SERVER["REMOTE_ADDR"]."||", $arrayIP)) {
            $reviewObj->setNumber($field, ($ratings-1));
            $reviewObj->setString($fieldIP, str_replace(",||".$_SERVER["REMOTE_ADDR"]."||", "", $ips));
        } else {
            $reviewObj->setNumber($field, ($ratings+1));
            $reviewObj->setString($fieldIP, $ips.",||".$_SERVER["REMOTE_ADDR"]."||");
            
            if ($reviewObj->getString($fieldIP2) && in_array("||".$_SERVER["REMOTE_ADDR"]."||", $arrayIP2)) {
                $reviewObj->setNumber($field2, ($ratings2-1));
                $reviewObj->setString($fieldIP2, str_replace(",||".$_SERVER["REMOTE_ADDR"]."||", "", $ips2));
            }
            
        }

        
        $reviewObj->save();
        
        $likeStr = system_getLikeDislikeButton($reviewObj->getString("like_ips"), $reviewObj->getString("dislike_ips"), $reviewObj->getNumber("id"), $reviewObj->getNumber("like"), $reviewObj->getNumber("dislike"), $div_name);
        
        echo $likeStr;
        
    } else {
        echo "invalid ID";
    }