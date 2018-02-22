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
	# * FILE: /frontend/socialnetwork/user_activity.php
	# ----------------------------------------------------------------------------------------------------
	 
	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
    $dbMain = db_getDBObject(DEFAULT_DB, true);
    $dbDomain = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
    $userActivity = array();
    
    //Get Deals Redeemed
    $sql = "SELECT id, datetime, redeem_code, promotion_id FROM Promotion_Redeem WHERE account_id = ".db_formatNumber($id);
    $result = $dbDomain->query($sql);
    while ($row = mysql_fetch_assoc($result)) {
        
        $promotionObj = new Promotion($row["promotion_id"]);
        
        if ($promotionObj->getNumber("id")) {
            
            $userActivity["deal_".$row["id"]]["id"] = $row["id"];
            $userActivity["deal_".$row["id"]]["added"] = $row["datetime"];
            $userActivity["deal_".$row["id"]]["redeem_code"] = $row["redeem_code"];
            $userActivity["deal_".$row["id"]]["used"] = $row["used"];
            $userActivity["deal_".$row["id"]]["promotion_id"] = $row["promotion_id"];
            
            if ($promotionObj->getNumber("listing_id") && $promotionObj->getString("listing_status") == "A" && (validate_date_deal($promotionObj->getDate("start_date"), $promotionObj->getDate("end_date"))) && (validate_period_deal($promotionObj->getNumber("visibility_start"), $promotionObj->getNumber("visibility_end")))) {
                $userActivity["deal_".$row["id"]]["title"] = "<a href=\"".$promotionObj->getFriendlyURL(false, PROMOTION_DEFAULT_URL)."\">".$promotionObj->getString("name")."</a>";
            } else {
                $userActivity["deal_".$row["id"]]["title"] = $promotionObj->getString("name");
            }
            
        }
        
    }
    
    //Get Reviews
    $sql = "SELECT id, item_type, item_id, review, review_title, rating, response, responseapproved, added FROM Review WHERE member_id = ".db_formatNumber($id)." AND approved = 1 AND status = 'A'";
    $result = $dbDomain->query($sql);
    $levelObj = new ListingLevel(true);
    while ($row = mysql_fetch_assoc($result)) {
        
        switch ($row["item_type"]) {
            case "listing": 
                            $itemObj = new Listing($row["item_id"]);
                            $friendlyURL = LISTING_DEFAULT_URL;
                            if ($itemObj->getString("status") == "A") {
                                $itemAvailable = true;
                                if ($levelObj->getDetail($itemObj->getNumber("level")) == "y") {
                                    $hasDetail = true;
                                } else {
                                    $hasDetail = false;
                                }
                            } else {
                                $itemAvailable = false;
                            }
                            break;
            
            case "article":
                            $itemObj = new Article($row["item_id"]);
                            $friendlyURL = ARTICLE_DEFAULT_URL;
                            if ($itemObj->getString("status") == "A") {
                                $itemAvailable = true;
                            } else {
                                $itemAvailable = false;
                            }
                            $hasDetail = true;
                            break;
            
            case "promotion":
                            $itemObj = new Promotion($row["item_id"]);
                            $friendlyURL = Promotion_DEFAULT_URL;
                            if ($itemObj->getNumber("listing_id") && $itemObj->getString("listing_status") == "A" && (validate_date_deal($itemObj->getDate("start_date"), $itemObj->getDate("end_date"))) && (validate_period_deal($itemObj->getNumber("visibility_start"), $itemObj->getNumber("visibility_end")))) {
                                $itemAvailable = true;
                            } else {
                                $itemAvailable = false;
                            }
                            $hasDetail = true;
                            break;
        }
        
        if ($itemObj->getNumber("id") && $itemAvailable) {
            $userActivity["review_".$row["id"]]["id"] = $row["id"];
            $userActivity["review_".$row["id"]]["item_type"] = $row["item_type"];
            $userActivity["review_".$row["id"]]["item_id"] = $row["item_id"];
            $userActivity["review_".$row["id"]]["review"] = $row["review"];
            $userActivity["review_".$row["id"]]["review_title"] = $row["review_title"];
            $userActivity["review_".$row["id"]]["rating"] = $row["rating"];
            $userActivity["review_".$row["id"]]["response"] = $row["response"];
            $userActivity["review_".$row["id"]]["responseapproved"] = $row["responseapproved"];
            $userActivity["review_".$row["id"]]["added"] = $row["added"];
            $userActivity["review_".$row["id"]]["title"] = "<a href=\"".($hasDetail ? $itemObj->getFriendlyURL(false, $friendlyURL) : $friendlyURL."/results.php?id=".$row["item_id"])."\">".$itemObj->getString(($row["item_type"] == "promotion" ? "name" : "title"))."</a>";
        }
    }
    
    //Get Blog Comments
    $sql = "SELECT id, post_id, description, added FROM Comments WHERE member_id = $id AND approved = 1";
    $result = $dbDomain->query($sql);
    while ($row = mysql_fetch_assoc($result)) {
        
        $postObj = new Post($row["post_id"]);
        
        if ($postObj->getNumber("id") && $postObj->getString("status") == "A") {
            $userActivity["comment_".$row["id"]]["id"] = $row["id"];
            $userActivity["comment_".$row["id"]]["description"] = $row["description"];
            $userActivity["comment_".$row["id"]]["added"] = $row["added"];
            $userActivity["comment_".$row["id"]]["title"] = "<a href=\"".$postObj->getFriendlyURL(false, BLOG_DEFAULT_URL)."\">".$postObj->getString("title")."</a>";
        }
        
    }
    
    //Order by date
    $ord = array();
    foreach ($userActivity as $key => $value){
        $ord[] = strtotime($value["added"]);
    }

    array_multisort($ord, SORT_DESC, $userActivity);
    
    //Geo IP
    $useSocialNetworkLocation = false;
    if (sess_getAccountIdFromSession()) {
        $profileObj = new Profile(sess_getAccountIdFromSession());
        if ($profileObj->getString("location") && $profileObj->getString("usefacebooklocation")){
            $where = $profileObj->getString("location");
            $useSocialNetworkLocation = true;
        }
    }
    
    if (!$useSocialNetworkLocation && GEOIP_FEATURE == "on") {

        if ($_COOKIE["location_geoip"]) {
                $where = $_COOKIE["location_geoip"];
        } else {
        
            $waitGeoIP = true; 

            $where = system_showText(LANG_LABEL_WAIT_LOCATION);

            $js_fileLoader = system_scriptColectorOnReady("

                $.ajax({
                    type: \"GET\",
                    url: \"".DEFAULT_URL."/getGeoIP.php\",
                    success: function(msg){
                        $('#where').removeClass('ac_loading');
                        $('#where').prop('disabled', '');
                        $('#where').attr('value', msg);
                    }
                    });

            ",$js_fileLoader);
        
        }
    }
    
    //Max activities shown per block
    $maxActs = 5;
    
?>

    <article>

        <? if ($id == sess_getAccountIdFromSession()) { ?>
        
        <section class="welcome-box">
            
            <h1><?=system_showText(LANG_LABEL_WELCOME);?>, <?=htmlspecialchars($info["nickname"]);?>!</h1>
            
            <div class="search-box">
                
                <? if (!count($userActivity)) { ?>
                    <h3><?=system_showText(LANG_LABEL_PROFILE_TIP2);?></h3>
                <? } ?>
                    
                <p><?=system_showText(LANG_LABEL_PROFILE_TIP1);?></p>

                <form action="<?=LISTING_DEFAULT_URL."/results.php";?>" method="get" class="form-inline">
                    <div class="row-fluid">
                        <div class="span5">
                            <input class="span12" type="text" name="keyword" tabindex="1" placeholder="<?=system_showText(LANG_LABEL_KEYWORDSEARCH);?>" />
                        </div>
                        <div class="span5">
                            <input type="text" name="where" id="where" tabindex="2" value="<?=$where;?>" placeholder="<?=system_showText(LANG_LABEL_LOCATIONSEARCH);?>" <?=($waitGeoIP ? "class=\"ac_loading span12\" disabled=\"disabled\"" : "class=\"span12\"")?> />
                        </div>						
                        <div class="span2">
                            <input type="submit" value="<?=system_showText(LANG_BUTTON_SEARCH);?>" tabindex="3" class="span12 btn btn-success" />
                        </div>
                    </div>							
                </form>

            </div>

        </section>
        
        <? } elseif (!count($userActivity)) { ?>
           
            <section class="welcome-box">
                <h2><?=system_showText(LANG_LABEL_PROFILE_RECENT_ACTIVITY)?></h2>
                <div class="search-box">
                    
                    <br>
                    <h4><?=system_showText(LANG_LABEL_PROFILE_TIP3);?></h4>
                    <h3><?=system_showText(LANG_LABEL_PROFILE_TIP4);?></h3>
                                        
                    <p><?=system_showText(LANG_LABEL_PROFILE_TIP1);?></p>

                    <form action="<?=LISTING_DEFAULT_URL."/results.php";?>" method="get" class="form-inline">
                        <div class="row-fluid">
                            <div class="span5">
                                <input class="span12" type="text" name="keyword" tabindex="1" placeholder="<?=system_showText(LANG_LABEL_KEYWORDSEARCH);?>" />
                            </div>
                            <div class="span5">
                                <input type="text" name="where" id="where" tabindex="2" value="<?=$where;?>" placeholder="<?=system_showText(LANG_LABEL_LOCATIONSEARCH);?>" <?=($waitGeoIP ? "class=\"ac_loading span12\" disabled=\"disabled\"" : "class=\"span12\"")?> />
                            </div>
                            <div class="span2">
                                <input type="submit" value="<?=system_showText(LANG_BUTTON_SEARCH);?>" tabindex="3" class="span12 btn btn-success" />
                            </div>
                        </div>
                    </form>
                    
                </div>
                
             </section>

        <? }
        
        if (count($userActivity)) { ?>
        
        <section class="activity-box">
            
            <h2><?=system_showText(LANG_LABEL_PROFILE_RECENT_ACTIVITY)?></h2>
            
            <?
            $countItem = 1;
            foreach ($userActivity as $key => $activity) { ?>

            <section class="item-activity" id="activity_<?=$countItem?>" <?=$countItem > $maxActs ? "style=\"display:none;\"" : ""?>>
                
                <? if (string_strpos($key, "deal") !== false) { ?>
                
                    <p>
                        <?=system_showText(LANG_LABEL_REDEEMED);?> <b><?=$activity["title"]?></b> <?=system_showText(LANG_BLOG_ON)?> <?=format_date($activity["added"], DEFAULT_DATE_FORMAT, "datestring");?>
                        
                        <? if ($id == sess_getAccountIdFromSession() && !$activity["used"]) { ?>
                        <a class="pull-right iframe fancy_window_iframe" href="<?=DEFAULT_URL."/popup/popup.php?pop_type=deal_redeem&amp;reprint=true&amp;redeemit=true&amp;nofacebook=true&amp;id=".$activity["promotion_id"];?>"><?=system_showText(LANG_LABEL_PRINT);?></a>
                        <? } ?>
                    </p>
                    
                    <? if ($id == sess_getAccountIdFromSession()) { ?>
                    
                    <div class="activity-detail">
                        <p class="code"><?=system_showText(LANG_LABEL_DEAL_CODE);?> <b><?=$activity["redeem_code"];?></b></p>
                    </div>
                    
                    <? } ?>
                
                <? } elseif (string_strpos($key, "review") !== false) { ?>
                    
                    <p><?=system_showText(LANG_LABEL_RATED);?> <b><?=$activity["title"]?></b> <?=system_showText(LANG_WITH);?> <span class="stars-rating"><span class="rate-<?=$activity["rating"]?>"></span></span><?=system_showText(LANG_BLOG_ON)?> <?=format_date($activity["added"], DEFAULT_DATE_FORMAT, "datestring");?></p>
                    <p><b><?=$activity["review_title"]?></b></p>
                    
                    <div class="activity-detail">
                        
                        <p class="review"><?=$activity["review"]?></p>
                        
                        <? if ($activity["responseapproved"]) { ?>
                        <p class="reply"><?=$activity["response"]?></p>
                        <? } ?>
                        
                    </div>
                
                <? } elseif (string_strpos($key, "comment") !== false) { ?>
                
                    <p><?=system_showText(LANG_LABEL_COMMENTED);?> <b><?=$activity["title"]?></b> <?=system_showText(LANG_BLOG_ON)?> <?=format_date($activity["added"], DEFAULT_DATE_FORMAT, "datestring");?></p>
                    
                    <div class="activity-detail">
                        <p class="review"><?=$activity["description"]?></p>
                    </div>
                    
                <? } ?>                
                
            </section>
            
            <?
            $countItem++;
            }
            
            if ($countItem > ($maxActs + 1)) { ?>

            <div class="viewmore">
                <a id="linkMoreactivity" href="javascript:void(0);" onclick="showmore('activity_', 'linkMoreactivity', <?=$countItem?>, <?=$maxActs?>);"><?=system_showText(LANG_PREVIOUS_ACTIVITY);?></a>
                <input type="hidden" id="activity_" value="<?=$maxActs?>" />
            </div>
            
            <? } ?>

        </section>
        
        <? } ?>
        
    </article>

    <script type="text/javascript">
        
		$(".activity-detail").hide();

		$(".item-activity").click( function() {
			$(this).toggleClass("opened");
			$(this).children(".activity-detail").stop(true,true).slideToggle("slow");
		});

	</script>