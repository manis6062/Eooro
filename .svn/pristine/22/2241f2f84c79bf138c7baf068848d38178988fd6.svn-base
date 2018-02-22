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
	# * FILE: /sitemgr/review/index.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();

	$url_redirect = "".DEFAULT_URL."/".SITEMGR_ALIAS."/review";
	$url_base     = "".DEFAULT_URL."/".SITEMGR_ALIAS."";

	extract($_GET);
	extract($_POST);

	//increases frequently actions
	if ($item_type == "listing") {
		system_setFreqActions("reviewlisting_manage",'listing');
    } elseif ($item_type == "article") {
		if (ARTICLE_FEATURE != "on" || CUSTOM_ARTICLE_FEATURE != "on") {
			header("Location: ".DEFAULT_URL."/".SITEMGR_ALIAS."/");
			exit;
		}
		system_setFreqActions("reviewarticle_manage",'ARTICLE_FEATURE');
	} elseif ($item_type == "promotion") {
		if (PROMOTION_FEATURE != "on" || CUSTOM_PROMOTION_FEATURE != "on") {
			header("Location: ".DEFAULT_URL."/".SITEMGR_ALIAS."/");
			exit;
		}
		system_setFreqActions("reviewpromotion_manage",'PROMOTION_FEATURE');
	}

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	
	if (!$itemObj) {
    	if ($item_type == 'listing') {
    		$itemObj = new Listing($item_id);
    	} else if ($item_type == 'article') {
    	    $itemObj = new Article($item_id);
    	} else if ($item_type == 'promotion') {
    	    $itemObj = new Promotion($item_id);
    	}
    }

	// Page Browsing /////////////////////////////////////////
	if ($item_id) 				 $sql_where[] = " item_type = '$item_type' AND item_id = '$item_id' ";
	if ($item_type && !$item_id) $sql_where[] = " item_type = '$item_type'";

	if ($sql_where) {
		$where .= " ".implode(" AND ", $sql_where)." ";
    }
    
    //Pending reviews
    $sql_where[] = " (approved = 0 OR (responseapproved = 0 AND response != '')) ";
    
    if ($sql_where) {
		$wherePending .= " ".implode(" AND ", $sql_where)." ";
    }
    
    //Pending Reviews per page
    setting_get("pendingReviews_per_page", $pendingReviews_per_page);
    
    if (!$pendingReviews_per_page) $pendingReviews_per_page = 2;

    //All reviews
	$pageObj  = new pageBrowsing("Review", $screen, RESULTS_PER_PAGE, "approved, added DESC", "review_title", $letter, $where);
	$reviewsArr = $pageObj->retrievePage("object");
    
    $pageObjPending  = new pageBrowsing("Review", $screenP, ($viewAllP ? false : $pendingReviews_per_page), "added DESC", "review_title", $letterPending, $wherePending);
	$reviewsArrPending = $pageObjPending->retrievePage("object");

	$paging_url = DEFAULT_URL."/".SITEMGR_ALIAS."/review/index.php?item_type=$item_type&item_id=$item_id".($filter_id ? "&filter_id=1" : '')."&item_screen=$item_screen&item_letter=$item_letter";

	// Letters Menu
	$letters = $pageObj->getString("letters");
	foreach($letters as $each_letter) {
		if ($each_letter == "#") {
			$letters_menu .= "<a href=\"$paging_url&letter=no\" ".(($letter == "no") ? "style=\"color:#EF413D\"" : "" ).">".string_strtoupper($each_letter)."</a>";
		} else {
			$letters_menu .= "<a href=\"$paging_url&letter=".$each_letter."\" ".(($each_letter == $letter) ? "style=\"color:#EF413D\"" : "" ).">".string_strtoupper($each_letter)."</a>";
		}
	}
	
	$_GET["review_screen"] = $screen;
    
	# PAGES DROP DOWN ----------------------------------------------------------------------------------------------
	$pagesDropDown = $pageObj->getPagesDropDown($_GET, $paging_url, $screen, system_showText(LANG_SITEMGR_PAGING_GOTOPAGE)." ", "this.form.submit();");
	# --------------------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/header.php");

	# ----------------------------------------------------------------------------------------------------
	# NAVBAR
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/navbar.php");
    
?>
    <div id="main-right">
        
        <div id="top-content">
            <div id="header-content">
                <h1>
                    <?=system_showText(LANG_SITEMGR_REVIEW_MANAGEREVIEWS)?>
                </h1>
            </div>
        </div>
        
        <div id="content-content">
            
            <div class="default-margin">

                <? require(EDIRECTORY_ROOT."/".SITEMGR_ALIAS."/registration.php"); ?>
                <? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
                <? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

                <? include(INCLUDES_DIR."/tables/table_review_submenu.php"); ?>

                <br />
                
                <? if ($reviewsArrPending) {
                    
                    $delimiter = (string_strpos($paging_url, "?") !== false) ? "&amp;" : "?";
                ?>
                
                    <div id="header-view" class="left"> 
                        <h4 class="general-title"><?=system_showText(LANG_REVIEW_PENDING)?> / <?=system_showText(LANG_SITEMGR_REPLYS);?> (<?=($pageObjPending->getString("record_amount"))?>)</h4>
                         <? if ($pageObjPending->getString("pages") > 1) { ?>        
                                <a class="general-viewall caps" href="<?=$paging_url?>&viewAllP=1">
                                    <?=system_showText(LANG_LABEL_VIEW_ALL)?>
                                </a>
                        <? } ?>
                    </div>

                    <div id="review-pending">

                        <? foreach ($reviewsArrPending as $each_rateP) {
                            
                            $item_type = $each_rateP->getString('item_type');
                            $item_idReview = $each_rateP->getNumber("item_id");
                            if ($item_type == 'listing') {
                                $itemObjP = new Listing($item_idReview);
                            } else if ($item_type == 'article') {
                                $itemObjP = new Article($item_idReview);
                            } else if ($item_type == 'promotion') {
                                $itemObjP = new Promotion($item_idReview);
                            }
                            
                            $replyContent = "";
                            $isReply = false;
                            if ($each_rateP->getNumber("approved") == 1 && $each_rateP->getNumber("responseapproved") == 0 && $each_rateP->getString("response")) {
                                $isReply = true;
                            }
                            $replyContent = $each_rateP->getString("response");
                            
                            $reviewerName = $each_rateP->getString("reviewer_name");
                            $imgTag = "";
                            
                            if (SOCIALNETWORK_FEATURE == "on") {
                                if ($each_rateP->getNumber("member_id")) {
                                    
                                    $account = new Account($each_rateP->getNumber("member_id"));
                                    $profile = new Profile($each_rateP->getNumber("member_id"));
                                    
                                    $image_id = $profile->getNumber("image_id");

                                    if ($account->has_profile == 'y' && $account->getNumber("id") > 0 && $image_id) {
                                        $imageObj = new Image($image_id, true);
                                        if ($imageObj->imageExists()) {
                                            $imgTag = $imageObj->getTag(true, 50, 50);
                                        } else {
                                            $imgTag = "<img src=\"".DEFAULT_URL."/".SITEMGR_ALIAS."/images/design/icon-user-thumb.gif"."\" width=\"50\" height=\"50\" alt=\"$reviewerName\">";
                                        }
                                    } elseif ($profile->facebook_image) {
                                        $facebookImage = $profile->facebook_image;
                                        if (HTTPS_MODE == "on") {
                                            $facebookImage = str_replace("http://", "https://", $profile->facebook_image);
                                        }
                                        image_getNewDimension(50, 50, $profile->facebook_image_width ? $profile->facebook_image_width : 100, $profile->facebook_image_height ? $profile->facebook_image_height : 100, $newWidth, $newHeight);
                                        $imgTag = "<img src=\"".$facebookImage."\" width=\"$newWidth\" height=\"$newHeight\" alt=\"".$reviewerName."\" />";
                                    } else {
                                        $imgTag = "<img src=\"".DEFAULT_URL."/".SITEMGR_ALIAS."/images/design/icon-user-thumb.gif"."\" width=\"50\" height=\"50\" alt=\"$reviewerName\">";
                                    }
                                    
                                } else {
                                    $imgTag = "<img src=\"".DEFAULT_URL."/".SITEMGR_ALIAS."/images/design/icon-user-thumb.gif"."\" width=\"50\" height=\"50\" alt=\"$reviewerName\">";
                                }
                            }
                        ?>
                            
                            <div class="review-box <?=($isReply ? "review-reply" : "")?>">
                                
                                <div class="rvw-listing-title">
                                    <h4><?=$itemObjP->getString(($item_type != "promotion" ? "title" : "name"))?></h4>
                                </div>
                                
                                <div class="rvw-view">
                                    
                                    <? if ($imgTag) { ?>
                                        <div class="rvw-view rvw-userimage">
                                            <?=$imgTag;?>
                                        </div>
                                    <? }?>
                                    
                                    <div class="rvw-view rvw-userinfo">
                                        <h4><?=($reviewerName ? $reviewerName : system_showText(LANG_NA))?></h4>
                                        <p><?=($each_rateP->getString("added")) ? format_date($each_rateP->getString("added"), DEFAULT_DATE_FORMAT, "datetime").", ".format_getTimeString($each_rateP->getNumber("added")) : system_showText(LANG_NA);?></p>
                                        
                                        <div class="rate">
                                            <?
                                            $starsOn = $each_rateP->getString("rating");
                                            $starsOff = 5 - $starsOn;

                                            for ($i = 0; $i < $starsOn; $i++) { ?>
                                                <img src="<?=DEFAULT_URL?>/images/img_rateMiniStarOn.png" align="bottom" />
                                            <? }

                                            for ($i = 0; $i < $starsOff; $i++) { ?>
                                                <img src="<?=DEFAULT_URL?>/images/img_rateMiniStarOff.png" align="bottom" />   
                                            <? } ?>
                                        </div>                         
                                    </div>
                                    
                                    <div class="rvw-view rvw-detail">
                                        <h4><?=$each_rateP->getString("review_title");?></h4>
                                        <p><?=$each_rateP->getString("review");?></p>
                                        <? if ($replyContent) { ?>
                                            <div class="rvw-reply"><?=$replyContent;?></div>
                                        <? } ?>
                                    </div>
                                    
                                    <div class="rvw-view rvw-options">
                                        <ul>
                                            <li class="rvw-aprove">
                                                <a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/review/view.php?item_id=<?=$each_rateP->getString("item_id")?>&item_type=<?=$each_rateP->getString("item_type")?><?=($filter_id ? "&filter_id=1" : '')?>&id=<?=$each_rateP->getString("id")?>&screenP=<?=$screenP?>&letter=<?=$letter?>&item_screen=<?=$item_screen?>&item_letter=<?=$item_letter?>&openapprove=yes">
                                                    <img src="<?=DEFAULT_URL?>/images/ico-approve.png"/> <?=system_showText(LANG_REVIEW_APPROVE);?>
                                                </a>
                                            </li>
                                            <li class="rvw-edit">
                                                <a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/review/view.php?item_id=<?=$each_rateP->getString("item_id")?>&item_type=<?=$each_rateP->getString("item_type")?><?=($filter_id ? "&filter_id=1" : '')?>&id=<?=$each_rateP->getString("id")?>&screenP=<?=$screenP?>&letter=<?=$letter?>&item_screen=<?=$item_screen?>&item_letter=<?=$item_letter?>&openedit<?=($isReply ? "Reply" : "")?>=yes">
                                                    <img src="<?=DEFAULT_URL?>/images/ico-edit.png"/> <?=system_showText(LANG_LABEL_EDIT);?>
                                                </a>
                                            </li>
                                            <? if (!$isReply) { ?>
                                            <li class="rvw-deny">
                                                <a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/review/delete.php?item_id=<?=$each_rateP->getString("item_id")?>&item_type=<?=$each_rateP->getString("item_type")?><?=($filter_id ? "&filter_id=1" : '')?>&id=<?=$each_rateP->getString("id")?>&screenP=<?=$screenP?>&letter=<?=$letter?>&item_screen=<?=$item_screen?>&item_letter=<?=$item_letter?>">
                                                    <img src="<?=DEFAULT_URL?>/images/ico-deny.png"/> <?=system_showText(LANG_LABEL_DELETE);?>
                                                </a>
                                            </li>
                                            <? } ?>
                                        </ul>
                                    </div>
                                    
                                </div>
                                
                            </div>
                        <? } ?>  

                        <? if ($pageObjPending->getString("pages") > 1) { ?>
                        
                            <div class="review-pag">
                                <? if ($screenP > 1) { ?>   
                                        <a class="rvw-pag-prev" href="<?=$paging_url?><?=$delimiter?>letterPending=<?=$letterPending?>&amp;screenP=<?=$pageObjPending->getString("back_screen")?>" title="<?=system_showText(LANG_PAGING_PREVIOUSPAGE)?>"><span><?=system_showText(LANG_PAGING_PREVIOUSPAGE)?></span></a>
                                <? } ?>

                                <? if ($pageObjPending->getString("pages") > $screenP) { ?>  
                                        <a class="rvw-pag-next" href="<?=$paging_url?><?=$delimiter?>letterPending=<?=$letterPending?>&amp;screenP=<?=$pageObjPending->getString("next_screen")?>" title="<?=system_showText(LANG_PAGING_NEXTPAGE)?>"><span><?=system_showText(LANG_PAGING_NEXTPAGE)?></span></a>
                                <? } ?>
                            </div>
                        
                        <? } ?>

                    </div>
                <? } ?>

                <? if (!$viewAllP) { ?>
                
                    <div id="header-view"> 
                        <? 
                        if ($item_type == 'listing') {
                            echo ucfirst(@constant('LANG_SITEMGR_LISTINGREVIEWS'));
                        } else if ($item_type == 'article') {
                            echo ucfirst(@constant('LANG_SITEMGR_ARTICLEREVIEWS'));
                        } else if ($item_type == 'promotion') {
                            echo ucfirst(@constant('LANG_SITEMGR_PROMOTIONREVIEWS'));
                        }

                        if ($item_id) {
                            echo ' - '.($item_type == "promotion" ? $itemObj->getString("name", true) : $itemObj->getString("title", true)); 
                        }
                        ?>
                    </div>

                    <br />

                    <? include(INCLUDES_DIR."/tables/table_paging.php");

                    if ($reviewsArr) {
                        
                        include(INCLUDES_DIR."/tables/table_review.php");
                        
                        $bottomPagination = true;
                        include(INCLUDES_DIR."/tables/table_paging.php");

                        if ($openapprove == "yes") { ?>
                    
                            <script type="text/javascript">
                                showStatusField(<?=$id?>);
                                document.getElementById("dropdownDomain").disabled = true;
                            </script>
                            
                        <? }
                        
                        if ($openedit == "yes"){ ?>
                            
                            <script type="text/javascript">
                                showReviewField(<?=$id?>);
                                document.getElementById("dropdownDomain").disabled = true;
                            </script>
                            
                        <? }

                    } else { ?>
                        <p class="informationMessage"><?=system_showText(LANG_SITEMGR_REVIEW_NORECORD)?></p>
                    <? }
                } ?>

            </div>
            
        </div>
        
        <div id="bottom-content">
            &nbsp;
        </div>
        
    </div>
<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>