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
	# * FILE: /mobile/dealdetail.php
	# ----------------------------------------------------------------------------------------------------
	
	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../conf/mobile.inc.php");
	include("../conf/loadconfig.inc.php");
    
    # ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (PROMOTION_FEATURE != "on" || CUSTOM_PROMOTION_FEATURE != "on" || CUSTOM_PROMOTION_FEATURE != "on") { exit; }
    
    # ----------------------------------------------------------------------------------------------------
	# VALIDATION
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/includes/code/validate_querystring.php");
	include(EDIRECTORY_ROOT."/includes/code/validate_frontrequest.php");
	
    $promotion = new Promotion();
    if (!$promotion->getPromotionByFriendlyURL($item)) {
        header("Location: ".MOBILE_DEFAULT_URL."/deals.php");
        exit;
    }
    
    $listingObj = new Listing($promotion->getNumber("listing_id"));
    $levelObj = new ListingLevel(true);
    
    unset($promotionMsg);
    if ((!$promotion->getNumber("id")) || ($promotion->getNumber("id") <= 0)) {
        $promotionMsg = system_showText(LANG_MSG_NOTFOUND);
    } elseif ((!validate_date_deal($promotion->getDate("start_date"), $promotion->getDate("end_date"))) || (!validate_period_deal($promotion->getNumber("visibility_start"),$promotion->getNumber("visibility_end")))) {
        $promotionMsg = system_showText(LANG_MSG_NOTAVAILABLE);
    } elseif (!$listingObj->getNumber("id") || $listingObj->getNumber("id") <= 0 || $listingObj->getString("status") != "A" || $levelObj->getHasPromotion($listingObj->getNumber("level")) != "y") {
        $promotionMsg = system_showText(LANG_MSG_NOTAVAILABLE);
    } else {
        report_newRecord("promotion", $promotion->getNumber("id"), PROMOTION_REPORT_DETAIL_VIEW);
        $promotion->setNumberViews($promotion->getNumber("id"));
    }
		
	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	$headertag_title = $headertagtitle;
	include(MOBILE_EDIRECTORY_ROOT."/layout/header.php");
	
	if (!$promotionMsg) {
		
		$user = true;
        $isMobileDetail = true;
        include(INCLUDES_DIR."/views/view_promotion_detail.php");
        
		$module_item_title = $deal_name;
		include("./breadcrumb.php"); 
			       
?>
    
    <div class="detail">
        
        <div class="thumbnail ">
            
            <div class="row-fluid ">

                <h4><?=$deal_name;?></h4>
                
                <? if ($dealsDone) { ?>
                    <h4 class="price"><?=system_showText(DEAL_SOLDOUT);?> - <?=$deal_offer?> OFF</h4>
                <? } else { ?>
                    <h4 class="price"><?=$deal_value.($deal_cents ? "<span class=\"cents\">".$deal_cents."</span>" : "")?> - <?=$deal_offer?> OFF</h4>
                <? } ?>
                
                <div class="deal-info">
                    <div class="span4 img-polaroid pull-left <?=(!$auxImgPath ? "no-image" : "")?>">
						<? if ($auxImgPath) { ?> 
                            <a class="group" href="<?=$auxImgPath?>"><img src="<?=$auxImgPath?>"/></a>
                        <? } ?>
					</div>
						
                    <div class="span8 pull-left">
                        
                        <ul id="timeLeft">
                        </ul>
						
                        <br/>
                        <br/>
                        
                        <div class="moreinfo">
                            <strong><?=system_showText(DEAL_VALUE)?>:</strong> <?=$deal_real_value;?><br/>
                           
                            <? if ($dealsDone) { ?>
                                <div class="pull-left"><strong><?=system_showText(DEAL_WITHTHISCOUPON)?>:</strong> <?=CURRENCY_SYMBOL.format_money($promotion->getNumber("dealvalue"),2)?></div>
                                <div class="pull-left"><strong><?=system_showText(DEAL_DEALSDONE_PLURAL)?>:</strong> <?=$deal_sold;?></div>    
                            <? } else { ?>
                                <div class="pull-left"><strong><?=system_showText(LANG_PROMOTION_FEATURE_NAME_PLURAL)." ".system_showText(DEAL_LEFTAMOUNT)?>:</strong> <?=$deal_left;?></div>
                                <div class="pull-left"><strong><?=system_showText(DEAL_DEALSDONE_PLURAL)?>:</strong> <?=$deal_sold;?></div>    
                            <? } ?>
                           
                        </div>
                    </div>
                </div>

                <? if (!$dealsDone) {
                    if (sess_getAccountIdFromSession()) {
                        $redeemLink = MOBILE_DEFAULT_URL."/dealredeem.php?id=".$promotion->getNumber("id");
                    } else {
                        $redeemLink = MOBILE_DEFAULT_URL."/dealredeem.php?login=true&id_login=".$promotion->getNumber("id");
                    }
                ?>
                    <a rel="nofollow" class="btn btn-info span12 plusmarginb" href="<?=$redeemLink;?>"><?=system_showText(DEAL_REDEEMTHIS);?></a>  
                <? } ?>
                    
                <? if ($deal_description) { ?>
                    <strong><?=system_showText(LANG_LABEL_DESCRIPTION);?></strong>
                    <hr/> 
                    <p class="listing-description">
                        <?=nl2br($deal_description);?>
                    </p>
                <? } ?>
                
                <? if ($deal_conditions) { ?>
                    <br/>
                    <strong><?=system_showText(LANG_LABEL_DEAL_CONDITIONS);?></strong>
                    <hr/> 
                    <p class="listing-description">
                        <?=nl2br($deal_conditions);?>
                    </p>
                <? } ?>

            </div>
            
        </div>
        
    </div>

    <? } else { ?>
        
        <p class="warning"><?=$promotionMsg?></p>
        
    <? } ?>
        
<?
		
    # ----------------------------------------------------------------------------------------------------
    # FOOTER
    # ----------------------------------------------------------------------------------------------------
    include(MOBILE_EDIRECTORY_ROOT."/layout/footer.php");
    
?>