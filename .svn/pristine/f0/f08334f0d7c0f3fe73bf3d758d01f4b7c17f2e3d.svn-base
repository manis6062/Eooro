<?php

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
    # * FILE: /functions/activity_funct.php
    # ----------------------------------------------------------------------------------------------------


    /**
     * Save new active record
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc. 
     * @param integer $domain_id
     * @param integer $account_id
     * @param real $payment_amount
     * @param string $action
     * @param string $item_type
     * @param string $item_title
     */

    function activity_newActivity($domain_id = 0, $account_id = 0, $payment_amount = 0, $action = "", $item_type = "", $item_title = "") {
        
        $main = DBConnection::getInstance()->getMain();
                    return DBQuery::execute(function() use ($domain_id, $account_id, $payment_amount, $action, $item_type, $item_title, $main){
                        $stmt = $main->prepare("INSERT INTO Recent_Activity
                        (domain_id, 
                        account_id, 
                        payment_amount, 
                        action, 
                        item_type,
                        item_title, 
                        date) 
                        VALUES 
                        (:domain_id, 
                        :account_id, 
                        :payment_amount,
                        :action, 
                        :item_type, 
                        :item_title, 
                        NOW())
                        ");

                        $parameters = array(
                            ':domain_id'      => $domain_id,
                            ':account_id'     => $account_id,
                            ':payment_amount' => $payment_amount,
                            ':action'         => $action,
                            ':item_type'      => $item_type,
                            ':item_title'     => $item_title               
                        );
                        return $stmt->execute($parameters);
                        
                    });
       
    }

    /**
     * Retrieve newest activities
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @param array $activities
     * @return string $text

     */
    function activity_retrieveText($activities) {

        $dbMain = db_getDBObject(DEFAULT_DB, true);
        $text = "<ul>";

        foreach($activities as $active) {
            
            switch ($active["action"]) {

                case 'login':       $domain = new Domain($active["domain_id"]);
                                    $domain_status = $domain->getString("status");
                                    
                                    if ($domain_status == "A") {
                                        $contact = new Contact($active["account_id"]);
                                        if ($contact->getNumber("account_id") != 0) {
                                            $link = "<a href=\"".DEFAULT_URL."/".SITEMGR_ALIAS."/account/view.php?id=".$active["account_id"]."\" title=\"".$contact->getString("first_name")." ".$contact->getString("last_name")."\">".$contact->getString("first_name")." ".$contact->getString("last_name")."</a>";
                                            $text .= "<li>";
                                            $text .= "<span class=\"c-b-date\">";
                                            $text .= "".$active["date"]."";
                                            $text .= "</span>";
                                            
                                            $text .= "<span>".$domain->getString("name")." - ".$link." ".LANG_SITEMGR_LOGGED_IN."</span>";
                                            $text .= "</li>";
                                        }
                                    }
                                    break;

                case 'payment':     $domain = new Domain($active["domain_id"]);
                                    $domain_status = $domain->getString("status");
                                    if ($domain_status == "A") {
                                        
                                        //Get currency symbol
                                        $dbDomain = db_getDBObjectByDomainID($active["domain_id"], $dbMain);
        
                                        $sql = "SELECT * FROM Setting_Payment WHERE name LIKE 'CURRENCY_SYMBOL'";
                                        $result = $dbDomain->query($sql);
                                        $row = mysql_fetch_assoc($result);
                                        $currency_symbol = $row["value"];
                                        
                                        $contact = new Contact($active["account_id"]);
                                        if ($contact->getNumber("account_id") != 0) {
                                            $link = "<a href=\"".DEFAULT_URL."/".SITEMGR_ALIAS."/account/view.php?id=".$active["account_id"]."\" title=\"".$contact->getString("first_name")." ".$contact->getString("last_name")."\">".$contact->getString("first_name")." ".$contact->getString("last_name")."</a>";
                                            $text .= "<li>";
                                            $text .= "<span class=\"c-b-date\">";
                                            $text .= "".$active["date"]."";
                                            $text .= "</span>";
                                            $text .= "<span>".$domain->getString("name")." - ".$currency_symbol.$active["payment_amount"]." ".LANG_SITEMGR_PAID_BY." ".$link."</span>";
                                            $text .= "</li>";
                                        }
                                    }
                                    break;

                case 'newaccount':  $domain = new Domain($active["domain_id"]);
                                    $domain_status = $domain->getString("status");
                                    if ($domain_status == "A") {
                                        $contact = new Contact($active["account_id"]);
                                        if ($contact->getNumber("account_id") != 0) {
                                            $link = "<a href=\"".DEFAULT_URL."/".SITEMGR_ALIAS."/account/view.php?id=".$active["account_id"]."\" title=\"".$contact->getString("first_name")." ".$contact->getString("last_name")."\">".$contact->getString("first_name")." ".$contact->getString("last_name")."</a>";
                                            $text .= "<li>";
                                            $text .= "<span class=\"c-b-date\">";
                                            $text .= "".$active["date"]."";
                                            $text .= "</span>";
                                            $text .= "<span>".$domain->getString("name")." - ".$link." ".LANG_SITEMGR_CREATED_ACCOUNT."</span>";
                                            $text .= "</li>";
                                        }
                                    }
                                    break;
                                
                case 'newitem':     $domain = new Domain($active["domain_id"]);
                                    $domain_status = $domain->getString("status");
                                    if ($domain_status == "A") {
                                        $contact = new Contact($active["account_id"]);
                                        if ($contact->getNumber("account_id") != 0) {
                                            $link = "<a href=\"".DEFAULT_URL."/".SITEMGR_ALIAS."/account/view.php?id=".$active["account_id"]."\" title=\"".$contact->getString("first_name")." ".$contact->getString("last_name")."\">".$contact->getString("first_name")." ".$contact->getString("last_name")."</a>";
                                            $item_type = $active["item_type"];
                                            $itemtype = "";
                                            switch ($item_type){

                                                case "listing":     $itemtype = LANG_SITEMGR_LISTING;
                                                                    break;
                                                case 'event':       $itemtype = LANG_SITEMGR_EVENT;
                                                                    break;
                                                case 'classified':  $itemtype = LANG_SITEMGR_CLASSIFIED;
                                                                    break;
                                                case 'article':     $itemtype = LANG_SITEMGR_ARTICLE;
                                                                    break;
                                                case 'banner':      $itemtype = LANG_SITEMGR_BANNER;
                                                                    break;
                                                case 'promotion':   $itemtype = LANG_SITEMGR_PROMOTION;
                                                                    break;                
                                            }

                                            $item_title = $active["item_title"];
                                            $text .= "<li>";
                                            $text .= "<span class=\"c-b-date\">";
                                            $text .= "".$active["date"]."";
                                            $text .= "</span>";
                                            $text .= "<span>".$domain->getString("name")." - ".$link." ".LANG_SITEMGR_CREATED." ".$itemtype." \"".$item_title."\""."</span>";
                                            $text .= "</li>";
                                        }
                                    }
                                    break;
                                
                case 'newlead':     $domain = new Domain($active["domain_id"]);
                                    $domain_status = $domain->getString("status");
                                    
                                    if ($domain_status == "A") {
                                        $link = system_showText(LANG_LEAD_RECEIVED)." <a href=\"".DEFAULT_URL."/".SITEMGR_ALIAS."/leads/index.php?item_type=".$active["item_type"]."\">".$active["item_title"]."</a>";
                                        $text .= "<li>";
                                        $text .= "<span class=\"c-b-date\">";
                                        $text .= "".$active["date"]."";
                                        $text .= "</span>";

                                        $text .= "<span>".$domain->getString("name")." - ".$link."</span>";
                                        $text .= "</li>";
                                    }
                                    break;

            }
        }
        $text .= "</ul>";
        return $text;
    }

    /**
     * Retrieve newest activities
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @param integer $max
     * @return string $activities_text

     */
    function activity_retrieveActivities($max = 10) {

        $activities = array();
        $db = db_getDBObject(DEFAULT_DB, true);
        $sql = "SELECT id, domain_id, account_id, payment_amount, action, item_type, item_title, date FROM Recent_Activity ORDER BY date DESC LIMIT $max";
        $result = $db->query($sql);
        $i = 0;
        while ($row = mysql_fetch_assoc($result)) {
            $activities[$i]["domain_id"] = $row["domain_id"];
            $activities[$i]["account_id"] = $row["account_id"];
            $activities[$i]["payment_amount"] = $row["payment_amount"];
            $activities[$i]["action"] = $row["action"];
            $activities[$i]["item_type"] = $row["item_type"];
            $activities[$i]["item_title"] = htmlspecialchars($row["item_title"]);
            $activities[$i]["date"] = format_date($row["date"], DEFAULT_DATE_FORMAT, "datetime")." - ".format_getTimeString($row["date"]);
            $i++;
        }

        $activities_text = activity_retrieveText($activities);

        return $activities_text;
    }

     /**
     * Save new to approved record
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @param integer $domain_id
     * @param integer $item_id
     * @param string $item_type
     * @param string $item_title
     * @param string $review_title
     */
    // function activity_newToApproved($domain_id = 0, $item_id = 0, $item_type = "", $item_title = "''", $content = "''", $assoc_item = 0, $rate = 0, $reply_id = 0) {
    //     $db = db_getDBObject(DEFAULT_DB, true);
        
    //     if (string_strpos($item_type, "review") !== false) { //get reviewer name and content
    //         $item_id = str_replace("'", "", $item_id);
    //         $reviewObj = new Review($item_id);
    //         $reviewer_name = $reviewObj->getString("reviewer_name");
    //         $review_content = ($reply_id ? $reviewObj->getString("response") : $reviewObj->getString("review"));
    //     }
        
    //     $sql = "INSERT INTO To_Approved (domain_id, item_id, item_type, item_title, content, assoc_item, rate, reviewer_name, review_content, reply_id, date) 
    //  VALUES ($domain_id, $item_id, '$item_type', $item_title, $content, $assoc_item, $rate, ".db_formatString($reviewer_name).", ".db_formatString($review_content).", $reply_id, NOW())";
    //     $db->query($sql);

    // }
         function activity_newToApproved($domain_id, $item_id = 0, $item_type = "", $item_title = "", $content = "", $assoc_item = 0, $rate = 0, $reply_id = 0) {
            DBQuery::execute(function() use($domain_id,$item_id,$item_type,$item_title,$content,
            $assoc_item,$rate,$reply_id){
            $main = DBConnection::getInstance()->getMain();
            $reviewer_name  = ' ';
            $review_content = ' ';

        if (string_strpos($item_type, "review") !== false) { //get reviewer name and content
            $item_id = str_replace("'", "", $item_id);
            $reviewObj = new Review($item_id);
            $reviewer_name = $reviewObj->getString("reviewer_name");
            $review_content = ($reply_id ? $reviewObj->getString("response") : $reviewObj->getString("review"));
        }
        $stmt = $main->prepare("INSERT INTO To_Approved"
                    . " (
                     domain_id,
                     item_id,
                     item_type,
                     item_title,
                     content,
                     assoc_item,
                     rate,
                     reviewer_name,
                     review_content,
                     reply_id,
                     date)"
                    ." VALUES"
                    ." (:domain_id,
                    :item_id,
                    :item_type,
                    :item_title,
                    :content,
                    :assoc_item,
                    :rate,
                    :reviewer_name,
                    :review_content,
                    :reply_id,
                    NOW())");
                $parameters = array(
                    ':domain_id'   => $domain_id,
                    ':item_id'   => $item_id,
                    ':item_type'   => $item_type,
                    ':item_title'   => $item_title,
                    ':content'   => $content,
                    ':assoc_item'   => $assoc_item,
                    ':rate'   => $rate,
                    ':reviewer_name'   => $reviewer_name,
                    ':review_content'   => $review_content,
                    ':reply_id'   => $reply_id
                );
            $stmt->execute($parameters);

});
    }

    /**
     * Delete approved records
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @param integer $domain_id
     * @param integer $item_id
     * @param string $item_type
     */
    function activity_deleteRecord($domain_id = 0, $item_id = 0, $item_type = "", $reviewResponse = false) {
        $db = db_getDBObject(DEFAULT_DB, true);
        $sql = "DELETE FROM To_Approved WHERE domain_id = $domain_id AND item_id = $item_id AND item_type = '$item_type'".($reviewResponse ? " AND reply_id = 1" : "");
        $db->query($sql);
    }

    /**
     * Update to approved records
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @param integer $domain_id
     * @param integer $item_id
     * @param string $newtitle
     * @param string $item
     * @param string $item_type
     */
    function activity_updateRecord($domain_id = 0, $item_id = 0, $newtitle = "", $item = "", $item_type = "", $rate = 0, $reviewer = "", $review = "", $reviewResponse = false) {
       DBQuery::execute(function() use($domain_id,$item_id,$newtitle, $item,$item_type,$rate,$reviewer,
            $review,$reviewResponse){
            $main = DBConnection::getInstance()->getMain();

         if ($item_type == "listing" || $item_type == "article" || $item_type == "promotion") {
            
            $sql =  $main->prepare("UPDATE To_Approved SET"             
                        . " item_title = :item_title "
                        . " WHERE domain_id = :domain_id "
                        ." AND assoc_item =:assoc_item "
                        ." AND item_type =:item_type "
                  );
              $parameters = array(
                    ':item_title'     => $newtitle,
                    ':domain_id'       => $domain_id,
                    ':assoc_item'       => $item_id,
                    ':item_type' =>$item_type
                  );

        } elseif ($item_type == "post") {
              $stmt = $main->prepare("UPDATE To_Approved SET"               
                        . " item_title = :item_title "
                        . " WHERE domain_id = :domain_id "
                        ." AND assoc_item =:assoc_item "
                        ." AND item_type =:item_type "
                  );
              $parameters = array(
                    ':item_title'     => $newtitle,
                    ':domain_id'       => $domain_id,
                    ':assoc_item'       => $item_id,
                    ':item_type'     => 'blog_comment');
        }
        if ($item == "item") 
            $item .= "_title";
        $cond = isset($reviewResponse) ? " AND reply_id = 1" : "";
                 $stmt = $main->prepare("UPDATE To_Approved SET"               
                        . " item_title = :item_title, "
                        . " rate = :rate, "
                        . " reviewer_name = :reviewer_name, "
                        . " review_content = :review_content "
                        . " WHERE domain_id = :domain_id "
                        . " AND item_id =:item_id "
                        . " AND item_type =:item_type "
                        . $cond);
                $parameters = array(
                    ':item_title'     => $newtitle,
                    ':rate'       => $rate,
                    ':reviewer_name'       => $reviewer,
                    ':review_content'     => $review,
                    ':domain_id'     => $domain_id,
                    ':item_id'     => $item_id,
                    ':item_type'     => $item_type ,
                    );
        $stmt->execute($parameters);
    });
      
    }
    
    /**
     * Get total records
     * @copyright Copyright 2013 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @param string $type
     */
    function activity_totalRecords($type) {
        $db = db_getDBObject(DEFAULT_DB, true);
        $sql = "SELECT COUNT(id) as total FROM To_Approved WHERE item_type ".($type == "items" ? "NOT LIKE  'review_%'" : "LIKE  '%review_%'");
        $result = $db->query($sql);
        $row = mysql_fetch_assoc($result);
        return($row["total"]);
    }


    /**
     * Retrieve to be approved items
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @param array $toapproved
     * @return string $text

     */
    function activity_retrieveTextToApproved($toapproved, $type) {

        $text = "";
        $total = 1;
        $scrollDiv = true;

        foreach ($toapproved as $approve) {

            $domain = new Domain($approve["domain_id"]);
            $domain_status = $domain->getString("status");

            if ($approve["item_type"] == "review_listing" || $approve["item_type"] == "review_promotion") {
                $permission = "SITEMGR_PERMISSION_LISTINGS";
            } elseif($approve["item_type"] == "review_article") {
                $permission = "SITEMGR_PERMISSION_ARTICLES";
            } elseif($approve["item_type"] == "blog_comment") {
                $permission = "SITEMGR_PERMISSION_BLOG";
            } else {
                $permission = "SITEMGR_PERMISSION_".string_strtoupper($approve["item_type"]."s");
            }

            if (($domain_status == "A") && (permission_hasSMPermSection(constant($permission)))) {
                
                $item_id = $approve["item_id"];

                if (string_strpos($approve["item_type"], "review") !== false) {
                    $review_id = $item_id;
                    $item_id = $approve["assoc_item"];

                } elseif (string_strpos($approve["item_type"], "blog") !== false) {
                    $comment_id = $item_id;
                    $item_id = $approve["assoc_item"];

                }               
               
                if ($approve["content"] && string_strpos($approve["item_type"], "review") !== false) { //for reviews
                    $total++;
                    $approve["content"] = str_replace("<br />", "", $approve["content"]);

                    $linkApproveURI = "/".SITEMGR_ALIAS."/review/view.php?item_type=".str_replace("review_","",$approve["item_type"])."&id=".$review_id."&item_id=$item_id&openapprove=yes";
                    $linkApproveQSTRING = "item_type=".str_replace("review_","",$approve["item_type"])."&item_id$item_id&openapprove=yes";
                    $linkApproveItem = "<a href=\"javascript: void(0);\" onclick=\"changeDomainInfo(".$approve["domain_id"].",'".DEFAULT_URL."','".$linkApproveURI."','".$linkApproveQSTRING."','false', 'true')\" title=\"".LANG_SITEMGR_APPROVE."\">".LANG_SITEMGR_APPROVE."</a>";

                    $linkEditURI = "/".SITEMGR_ALIAS."/review/view.php?item_type=".str_replace("review_","",$approve["item_type"])."&id=".$review_id."&item_id=$item_id&openedit".($approve["reply_id"] ? "Reply" : "")."=yes";
                    $linkEditQSTRING = "item_type=".str_replace("review_","",$approve["item_type"])."&item_id=$item_id&openedit".($approve["reply_id"] ? "Reply" : "")."=yes";
                    $linkEditItem = "<a href=\"javascript: void(0);\" onclick=\"changeDomainInfo(".$approve["domain_id"].",'".DEFAULT_URL."','".$linkEditURI."','".$linkEditQSTRING."','false', 'true')\" title=\"".LANG_SITEMGR_EDIT."\">".LANG_SITEMGR_EDIT."</a>";

                    if (!$approve["reply_id"]) {
                        $linkDeleteURI = "/".SITEMGR_ALIAS."/review/delete.php?item_type=".str_replace("review_","",$approve["item_type"])."&id=".$review_id."&item_id=$item_id";
                        $linkDeleteQSTRING = "item_type=".str_replace("review_","",$approve["item_type"])."&item_id=$item_id";
                        $linkDeleteItem = "<a href=\"javascript: void(0);\" class=\"linkred\" onclick=\"changeDomainInfo(".$approve["domain_id"].",'".DEFAULT_URL."','".$linkDeleteURI."','".$linkDeleteQSTRING."','false', 'true')\" title=\"".LANG_SITEMGR_DELETE."\">".LANG_SITEMGR_DELETE."</a>";
                    } else {
                        $linkDeleteItem = "";
                    }
                    
                    $text .= "<div class=\"content-box\">
                            <div class=\"c-b-info\">
                                <h4>".html_entity_decode($approve["item_title"])."</h4>
                                <h5>".htmlspecialchars($approve["content"])."</h5>
                                <p class=\"min-height\">".system_showTruncatedText($approve["review_content"], 277)."</p>                            
                            </div>
                            <div class=\"c-b-options\">
                                <span class=\"left\">
                                    ".($approve["reviewer_name"] ? system_showTruncatedText($approve["reviewer_name"], 15): "").($approve["date"] ? " ".system_showText(LANG_BLOG_ON)." ".$approve["date"] : "")."
                                </span>
                                <span class=\"right caps\">$linkApproveItem<b></b><a href=\"#\">$linkEditItem</a>".($linkDeleteItem ? "<b></b>$linkDeleteItem" : "")."</span>
                            </div>
                        </div>";
                    
                    if ($total > DASHBOARD_MAX_PENDING_REVIEWS && $scrollDiv) {
                        $scrollDiv = false;
                        $text .= "<div id=\"scrollDiv\"></div>";
                        
                    }
                    
                } else { //for other items
                    $total++;
                    
                    $linkApproveItem = "";
                    $linkEditItem = "";
                    $linkDeleteItem = "";
                    
                    if ($approve["content"] && string_strpos($approve["item_type"], "blog") !== false) {
                        $isComment = true;
                    } else {
                        $isComment = false;
                    }
                    
                    if ($isComment) {
                        
                        if ($approve["reply_id"]) {
                            $str_reply = "reply_id=".$approve["reply_id"]."&";
                        } else {
                            $str_reply = "";
                        }
                        $linkApproveURI = "/".SITEMGR_ALIAS."/".BLOG_FEATURE_FOLDER."/comments/index.php?".$str_reply."id=".$comment_id."&openapprove=yes";
                        $linkApproveQSTRING = "openapprove=yes";
                        $linkApproveItem = "<a href=\"javascript: void(0);\" onclick=\"changeDomainInfo(".$approve["domain_id"].",'".DEFAULT_URL."','".$linkApproveURI."','".$linkApproveQSTRING."','false', 'true')\" title=\"".LANG_SITEMGR_APPROVE."\">".LANG_SITEMGR_APPROVE."</a>";
                        
                        $linkDeleteURI = "/".SITEMGR_ALIAS."/".BLOG_FEATURE_FOLDER."/comments/delete.php?post_id=".$item_id."&id=$comment_id";
                        $linkDeleteQSTRING = "post_id=".$item_id."&id=$comment_id";
                        $linkDeleteItem = "<a href=\"javascript: void(0);\" class=\"linkred\" onclick=\"changeDomainInfo(".$approve["domain_id"].",'".DEFAULT_URL."','".$linkDeleteURI."','".$linkDeleteQSTRING."','false', 'true')\" title=\"".LANG_SITEMGR_DELETE."\">".LANG_SITEMGR_DELETE."</a>";
                        
                    } else {
                    
                        $linkApproveItem = "<a href=\"javascript: void(0);\" onclick=\"openApproveItem(".$approve["domain_id"].", ".$item_id.", '".$approve["item_folder"]."')\" title=\"".LANG_SITEMGR_APPROVE."\">".LANG_SITEMGR_APPROVE."</a>";

                        if ($approve["item_type"] == "banner"){
                            $action = "edit.php";
                        } else {
                            $action = $approve["item_type"].".php";
                        }

                        $linkEditURI = "/".SITEMGR_ALIAS."/".$approve["item_folder"]."/".$action."?id=".$item_id;
                        $linkEditQSTRING = "id=".$item_id;
                        $linkEditItem = "<a href=\"javascript: void(0);\" onclick=\"changeDomainInfo(".$approve["domain_id"].",'".DEFAULT_URL."','".$linkEditURI."','".$linkEditQSTRING."','false', 'true')\" title=\"".LANG_SITEMGR_EDIT."\">".LANG_SITEMGR_EDIT."</a>";

                        $linkDeleteURI = "/".SITEMGR_ALIAS."/".$approve["item_folder"]."/delete.php?id=".$item_id;
                        $linkDeleteQSTRING = "id=".$item_id;
                        $linkDeleteItem = "<a href=\"javascript: void(0);\" class=\"linkred\" onclick=\"changeDomainInfo(".$approve["domain_id"].",'".DEFAULT_URL."','".$linkDeleteURI."','".$linkDeleteQSTRING."','false', 'true')\" title=\"".LANG_SITEMGR_DELETE."\">".LANG_SITEMGR_DELETE."</a>";
                   
                    }
                    
                    if ($approve["item_type"] == "blog_comment") {
                        $labelItem = system_showText(LANG_LAVEL_BLOG_COMMENT);
                    } else {
                        $labelItem = @constant("LANG_".string_strtoupper($approve["item_type"])."_FEATURE_NAME");
                    }
                    
                    $text .= "<div class=\"content-box\">
                    
                            <div class=\"c-b-info\">
                                <span class=\"right caps\">".htmlspecialchars($labelItem)."</span>
                                <h4>".html_entity_decode($approve["item_title"])."</h4>";
                                if ($approve["date_time"]) {
                                    $text .= " <p>".system_showText(LANG_LABEL_ADDED_ON)." ".$approve["date_time"]."</p>";
                                }
                    $text .= "  </div>";
                    
                    $text .= "<div class=\"c-b-options\">                       
                                <span class=\"right caps\">
                                
                                    ".$linkApproveItem;
                    
                                    if ($linkEditItem) {
                                        $text .= "<b></b>".$linkEditItem;

                                        
                                    }
                                    
                                    $text .= "<b></b>".$linkDeleteItem;
                                    
                    $text .= " </span>
                            </div>
                        </div>";
                }
                
            }
        }

        return $text;
    }


    /**
     * Retrieve to be approved
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @param integer $max
     * @return string $approved_text

     */
    function activity_retrieveToApproved($max = 5, $type = "items", $all = false){

        $toapproved = array();
        $db = db_getDBObject(DEFAULT_DB, true);
        $sql = "SELECT id, domain_id, item_id, item_type, item_title, content, assoc_item, rate, reviewer_name, review_content, reply_id, date FROM To_Approved WHERE item_type ".($type == "items" ? "NOT LIKE  'review_%'" : "LIKE  '%review_%'")." ORDER BY date DESC ".(!$all ? " LIMIT $max" : "");
        $result = $db->query($sql);
        $i = 0;
        while ($row = mysql_fetch_assoc($result)){
            $toapproved[$i]["domain_id"] = $row["domain_id"];
            $toapproved[$i]["item_id"] = $row["item_id"];
            $toapproved[$i]["item_type"] = $row["item_type"];
            $item_folder = string_strtoupper($row["item_type"]);
            if (string_strpos($row["item_type"], "review_") !== false) {
                $item_folder = string_strtoupper(str_replace("review_", "", $row["item_type"]));
            } else if (string_strpos($row["item_type"], "_comment") !== false) {
                $item_folder = string_strtoupper(str_replace("_comment", "", $row["item_type"]));
            }
            $toapproved[$i]["item_folder"] = constant($item_folder."_FEATURE_FOLDER");;
            $toapproved[$i]["item_title"] = htmlspecialchars($row["item_title"]);
            $toapproved[$i]["content"] = $row["content"];
            $toapproved[$i]["assoc_item"] = $row["assoc_item"];
            $toapproved[$i]["rate"] = $row["rate"];
            $toapproved[$i]["reviewer_name"] = $row["reviewer_name"];
            $toapproved[$i]["review_content"] = $row["review_content"];
            $toapproved[$i]["reply_id"] = $row["reply_id"];
            $toapproved[$i]["date"] = ($row["date"] != "0000-00-00 00:00:00" ? format_date($row["date"], DEFAULT_DATE_FORMAT, "datetime") : "");
            $toapproved[$i]["date_time"] = ($row["date"] != "0000-00-00 00:00:00" ? format_date($row["date"], DEFAULT_DATE_FORMAT, "datetime")." - ".format_getTimeString($row["date"]) : "");
            $i++;
        }

        $toapproved_text = activity_retrieveTextToApproved($toapproved, $type);

        return $toapproved_text;
    }

?>