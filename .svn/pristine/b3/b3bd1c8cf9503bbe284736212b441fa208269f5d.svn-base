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
	# * FILE: /loadReviews.php
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
    
    if (is_numeric($item_id)) {
    
        $sql_where[] = " item_type = '$item_type' AND item_id = $item_id ";
        $sql_where[] = " review IS NOT NULL AND review != '' ";
        $sql_where[] = " approved = '1' ";
        $sqlwhere .= " ".implode(" AND ", $sql_where)." ";
        $user = true;

        $aux_items_per_page = THEME_MAX_REVIEWS;

        $pageObj  = new pageBrowsing("Review", $screen, $aux_items_per_page, "`like` DESC, added DESC", "", "", $sqlwhere);
        $reviewsArr = $pageObj->retrievePage("object");

        $array_pages_code = system_preparePagination("", "", $pageObj, "", $screen, $aux_items_per_page, "", "loadReviews('$item_type', $item_id, [screen], 'link');");
          
    } else {
        
        $locationsToShow = explode (",", EDIR_LOCATIONS);
        $locationsToShow = array_reverse ($locationsToShow);
        foreach ($locationsToShow as $locationToShow) {
            $reviewer_location .= system_showText(constant("LANG_LABEL_".constant("LOCATION".$locationToShow."_SYSTEM"))).", ";
        }
        $reviewer_location = string_substr("$reviewer_location", 0, -2);
        unset($locationsToShow);
        
        $arrReviewAux["review_title"] = system_showText(LANG_LABEL_ADVERTISE_REVIEW_TITLE);
        $arrReviewAux["reviewer_name"] = system_showText(LANG_LABEL_ADVERTISE_VISITOR);
        $arrReviewAux["reviewer_location"] = $reviewer_location;
        $arrReviewAux["added"] = date("Y-m-d")." ".date("H:m:s");
        $arrReviewAux["approved"] = "1";
        $arrReviewAux["review"] = "Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica formas.";

        $arrReviewAux["rating"] = "1";
        $arrReviewAux["response"] = "Lorem ipsum dolor sit amet, consectetur. Pellentesque luctus enim ac diam tortor.";
        $arrReviewAux["responseapproved"] = "1";
        $reviewsArr[] = new Review($arrReviewAux);

        $arrReviewAux["rating"] = "3";
        $arrReviewAux["response"] = "";
        $arrReviewAux["responseapproved"] = "0";
        $reviewsArr[] = new Review($arrReviewAux);

        $arrReviewAux["rating"] = "5";
        $reviewsArr[] = new Review($arrReviewAux);
        unset($arrReviewAux);
    }
    
    if ($reviewsArr) {
        
        $divReviewsName = "ratingsAjax_";
        
        foreach ($reviewsArr as $each_rate) {
            
            if ($each_rate->getString("review")) {
                $each_rate->extract();

                $reviewFileName = INCLUDES_DIR."/views/view_review_detail.php";
                $reviewFileNameTheme = INCLUDES_DIR."/views/view_review_detail_".EDIR_THEME.".php";

                if (file_exists($reviewFileNameTheme)) {
                    include($reviewFileNameTheme);
                } else {
                    include($reviewFileName);
                }

                echo $item_reviewcomment;
            }
        }
        
        if ($array_pages_code["total"] > $aux_items_per_page) {
    
            $generalPagination = true;
            $paginationReviews = true;

            echo "<div class=\"line-top\">";
                include(system_getFrontendPath("results_pagination.php"));
            echo "</div>";

        }
        
    } else {
        echo "<p class=\"informationMessage\">".system_showText(LANG_REVIEW_NORECORD)."</p>";
    }