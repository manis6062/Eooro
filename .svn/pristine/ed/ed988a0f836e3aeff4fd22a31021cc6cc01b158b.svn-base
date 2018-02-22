<?php
/**
 * @author          Subigya Jyoti Panta
 * @subpackage      Bottomless Reviews
 * @copyright (c) 2014, www.eooro.com
 * @version         1.0
 * @modification history original
 */
	include("./conf/loadconfig.inc.php");
        if( EDIR_THEME === 'review' ){
            include_once THEMEFILE_DIR.'/'.EDIR_THEME.'/common_functions.php';
        }
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
        $sql_where[] = " is_deleted=0 ";
        $sql_where[] = " Account.active = 'y' ";
        $sql_where[] = " status = 'A' ";
        $sqlwhere .= " ".implode(" AND ", $sql_where)." ";
        $user = true;

        $aux_items_per_page = THEME_MAX_REVIEWS;

        $Main = db_getDBObject(DEFAULT_DB, true);
        $array = (array) $Main;
    

        $pageObj  = new pageBrowsing("Review| LEFT OUTER JOIN {$array['db_name']}.Account on Review.member_id = Account.id", $screen, $aux_items_per_page, "added DESC", "", "", $sqlwhere);
        $reviewsArr = $pageObj->retrievePage("object"); 
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
        
    } 
    else {
        echo 0;//"<p class=\"informationMessage\"> End of all Reviews </p>";
    }