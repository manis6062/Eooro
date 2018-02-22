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
	# * FILE: /members/signup/payment.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (PAYMENT_FEATURE != "on") { exit; }
	if ((CREDITCARDPAYMENT_FEATURE != "on") && (INVOICEPAYMENT_FEATURE != "on")) { exit; }

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_GET);
	extract($_POST);

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSession();
	$acctId = sess_getAccountIdFromSession();
	$url_redirect = "".DEFAULT_URL."/".MEMBERS_ALIAS."/signup";
	$url_base = "".DEFAULT_URL."/".MEMBERS_ALIAS."";
	$members = 1;

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	$itemCount = 0;

	$listingsToPay = db_getFromDB("listing", "account_id", $acctId, "", "title", "array", false, true);
	foreach ($listingsToPay as $listingToPay) {
		$listing_id[] = $listingToPay["id"];
		$itemCount++;
	}

	if (EVENT_FEATURE == "on" && CUSTOM_EVENT_FEATURE == "on") {
		$eventsToPay = db_getFromDB("event", "account_id", $acctId, "", "title", "array", false, true);
		foreach ($eventsToPay as $eventToPay) {
			$event_id[] = $eventToPay["id"];
			$itemCount++;
		}
	}

	if (BANNER_FEATURE == "on" && CUSTOM_BANNER_FEATURE == "on") {
		$bannersToPay = db_getFromDB("banner", "account_id", $acctId, "", "caption", "array", false, true);
		foreach ($bannersToPay as $bannerToPay) {
			$banner_id[] = $bannerToPay["id"];
			$itemCount++;
		}
	}

	if (CLASSIFIED_FEATURE == "on" && CUSTOM_CLASSIFIED_FEATURE == "on") {
		$classifiedsToPay = db_getFromDB("classified", "account_id", $acctId, "", "title", "array", false, true);
		foreach ($classifiedsToPay as $classifiedToPay) {
			$classified_id[] = $classifiedToPay["id"];
			$itemCount++;
		}
	}

	if (ARTICLE_FEATURE == "on" && CUSTOM_ARTICLE_FEATURE == "on") {
		$articlesToPay = db_getFromDB("article", "account_id", $acctId, "", "title", "array", false, true);
		foreach ($articlesToPay as $articleToPay) {
			$article_id[] = $articleToPay["id"];
			$itemCount++;
		}
	}

	setting_get("payment_tax_status", $payment_tax_status);
	setting_get("payment_tax_value", $payment_tax_value);
	customtext_get("payment_tax_label", $payment_tax_label);

	$second_step = 1;
    
    $gatewaysNoForm = array();
    $gatewaysNoForm[] = "paypal";
    $gatewaysNoForm[] = "simplepay";
    $gatewaysNoForm[] = "payflow";
    $gatewaysNoForm[] = "pagseguro";

	if ($itemCount == 1 || $ispackage == "true") include(INCLUDES_DIR."/code/billing.php");

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
    include(MEMBERS_EDIRECTORY_ROOT."/layout/header.php");
    
?>
<div <?=(EDIR_THEME==='review') ? 'class="container"' : '' ?>>
    <div class="content content-full">
        
        <?
        require(EDIRECTORY_ROOT."/".SITEMGR_ALIAS."/registration.php");
        require(EDIRECTORY_ROOT."/includes/code/checkregistration.php");
        require(EDIRECTORY_ROOT."/frontend/checkregbin.php");
        ?>

        <div class="content-main order" id="screen5" style="display: block;">
            
            <? if( EDIR_THEME === 'review' ) { ?>
            <div class="container">
                <div class="thumbnail listingthumbnail lisingthumbnail1">
                    <div class="row">
                        <div class="col-sm-5 col-sm-offset-1 steps-width">
                            <div class="heading-banner heading-banner1">
                                <h4><?=string_strtoupper(system_showText(LANG_EASYANDFAST));?> <?=string_strtoupper(system_showText(LANG_THREESTEPS))?></h4>
                            </div><!--/heading-banner-->
                        </div><!--/col-sm-5-->
                    </div>
                    <div class="row">
                        <div class="col-sm-11 col-sm-offset-1">
                            <div class="pWrapper">
                                <div class="row">
                                    <ul class="claim-listing">

                                        <li class="list col-sm-3 gap">
                                            <span>1</span> &nbsp; <?=system_showText(LANG_ADVERTISE_CONFIRMATION)?>
                                        </li>

                                        <li class="list col-sm-3 active checkout-width gap">
                                            <span>2</span> &nbsp; <?=system_showText(LANG_CHECKOUT)?>

                                        </li>

                                        <li class="list col-sm-3 active-width gap">
                                            <span>3</span> &nbsp; <?=system_showText(LANG_ADVERTISE_IDENTIFICATION)?>
                                        </li>

                                    </ul>
                                </div>
                            </div><!--/pWrapper-->
                        </div>
                    </div><!--/row-->
                </div><!--/thumbnail-->
            </div> <!--/container-->
        <? } else { ?>
            <div class="real-steps">
                <ul class="standardStep steps-3">
                    <li class="steps-ui stepLast"><span>3</span>&nbsp;<?=system_showText(LANG_ADVERTISE_CONFIRMATION);?></li>
                    <li class="steps-ui  stepActived"><span>2</span>&nbsp;<?=system_showText(LANG_CHECKOUT);?></li>
                    <li class="steps-ui"><span>1</span>&nbsp;<?=system_showText(LANG_ADVERTISE_IDENTIFICATION);?></li>
                </ul>
            </div>
        <? } ?>
            
            <div class="order">

                <div id="billing-detail">

                    <div class="left textright">
                        <h3><?=system_showText(LANG_ADVERTISE_BILLINGDETAIL);?></h3>
                        <p><?=system_showText(LANG_ADVERTISE_BILLINGDETAIL_TIP);?></p>
                    </div>

                    <div class="right">
                        
                        <? if ($paymentSystemError) { ?>

                            <p class="errorMessage">
                                <?=$payment_message?><br />
                                <a href="<?=DEFAULT_URL?>/<?=MEMBERS_ALIAS?>/billing/index.php"><?=system_showText(LANG_MSG_GO_TO_MEMBERS_CHECKOUT);?></a>.
                            </p>

                        <? } elseif ($payment_message) { ?>

                            <p class="errorMessage">
                                <?=system_showText(LANG_MSG_PROBLEMS_WERE_FOUND)?>:<br />
                                <?=$payment_message?><br />
                                <a href="<?=DEFAULT_URL?>/<?=MEMBERS_ALIAS?>/billing/index.php"><?=system_showText(LANG_MSG_GO_TO_MEMBERS_CHECKOUT);?></a>.
                            </p>

                        <? } elseif ((!$bill_info["listings"]) && (!$bill_info["events"]) && (!$bill_info["banners"]) && (!$bill_info["classifieds"]) && (!$bill_info["articles"])) {
                            
                            if ($itemCount > 1) {
                                echo "<p class=\"informationMessage\">".system_showText(LANG_ADVERTISE_ALREADYUSER1)." <a href=\"".DEFAULT_URL."/".MEMBERS_ALIAS."/billing/index.php\">".system_showText(LANG_ADVERTISE_ALREADYUSER2)."</a>.</p>";
                            } else {
                                echo "<p class=\"informationMessage\">".system_showText(LANG_MSG_NO_ITEMS_SELECTED_REQUIRING_PAYMENT)."</p>";
                            }
                            
                        } else { ?>

                        <table class="standard-tableTOPBLUE"  style="display:none;">
                            <tr>
                                <th>
                                    <?  
                                    $showName = true;
                                    if ($ispackage == "true" && $auxitem_name) {
                                        echo system_showText(LANG_LABEL_ITEMS);
                                        $showName = false;
                                    }

                                    if ($bill_info["listings"]) {
                                        foreach ($bill_info["listings"] as $id => $info);
                                        if ($showName) echo system_showText(LANG_LISTING_FEATURE_NAME);
                                    } elseif ($bill_info["events"]) {
                                        foreach ($bill_info["events"] as $id => $info);
                                        if ($showName) echo system_showText(LANG_EVENT_FEATURE_NAME);
                                    } elseif ($bill_info["banners"]) {
                                        foreach ($bill_info["banners"] as $id => $info);
                                        if ($showName) echo system_showText(LANG_BANNER_FEATURE_NAME);
                                    } elseif ($bill_info["classifieds"]) {
                                        foreach ($bill_info["classifieds"] as $id => $info);
                                        if ($showName) echo system_showText(LANG_CLASSIFIED_FEATURE_NAME);
                                    } elseif ($bill_info["articles"]) {
                                        foreach ($bill_info["articles"] as $id => $info);
                                        if ($showName) echo system_showText(LANG_ARTICLE_FEATURE_NAME);
                                    }
                                    ?>
                                </th>
                                
                                <th><?=system_showText(LANG_LABEL_LEVEL);?></th>
                                
                                <? if (($bill_info["listings"]) && $info["extra_category_amount"] > 0) { ?>
                                    <th><?=system_showText(LANG_LABEL_EXTRA_CATEGORY);?></th>
                                <? } ?>
                                    
                                <? if ((PAYMENT_FEATURE == "on") && $info["discount_id"] && ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on"))) { ?>
                                    <th><?=system_showText(LANG_LABEL_DISCOUNT_CODE)?></th>
                                <? } ?>
                                        
                                <? if ($bill_info["banners"]) { ?>
                                    <th><?=system_showText(LANG_LABEL_EXPIRATION);?></th>
                                <? } ?>
                                    
                                <? if ($payment_tax_status == "on" || ($ispackage == "true" && $auxitem_name)) { ?>
                                    <th><?=(($ispackage == "true" && $auxitem_name) ? system_showText(LANG_LABEL_PRICE_PLURAL) : system_showText(LANG_SUBTOTAL));?></th>
                                <? } ?>
                                    
                                <? if ($payment_tax_status == "on" && $ispackage != "true") { ?>
                                    <th><?=$payment_tax_label." (".$payment_tax_value."%)";?></th>
                                <? } ?>
                                    
                                <? if ($ispackage != "true") { ?>
                                    <th><?=system_showText(LANG_LABEL_TOTAL);?></th>
                                <? } ?>
                                
                            </tr>
                            
                            <tr>
                                <td>
                                    <?
                                    if ($bill_info["banners"]) {
                                        echo $info["caption"];
                                    } else {
                                        echo $info["title"];
                                    }
                                    ?>
                                    <?=($info["listingtemplate"] ? "<span class=\"itemNote\">(".$info["listingtemplate"].")</span>" : "");?>
                                </td>
                                
                                <td><?=string_ucwords($info["level"])?></td>
                                
                                <? if (($bill_info["listings"]) && $info["extra_category_amount"] > 0) { ?>
                                    <td><?=$info["extra_category_amount"];?></td>
                                <? } ?>
                                
                                <? if ((PAYMENT_FEATURE == "on") && $info["discount_id"] && ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on"))) { ?>
                                    <td><?=($info["discount_id"]) ? $info["discount_id"] : system_showText(LANG_NA);?></td>
                                <? } ?>
                                        
                                <? if ($bill_info["banners"]) { ?>
                                    <td>
                                        <?
                                        if ($info["expiration_setting"] == BANNER_EXPIRATION_RENEWAL_DATE) echo system_showText(LANG_LABEL_BY_PERIOD);
                                        elseif ($info["expiration_setting"] == BANNER_EXPIRATION_IMPRESSION) echo system_showText(LANG_LABEL_BY_IMPRESSIONS);
                                        ?>
                                    </td>
                                <? } ?>
                                    
                                <? if ($payment_tax_status == "on" || ($ispackage == "true" && $auxitem_name)) { ?>
                                    <td><?=CURRENCY_SYMBOL." ".($aux_package_total > 0 ? format_money($bill_info["total_bill"]-$aux_package_total) : $bill_info["total_bill"]);?></td>
                                <? } ?>

                                <? if ($payment_tax_status == "on" && $ispackage != "true" ) { ?>
                                    <td><?=CURRENCY_SYMBOL." ".payment_calculateTax($bill_info["total_bill"], $payment_tax_value, true, false);?></td>
                                <? } ?>
                                    
                                <? if ($ispackage != "true") { ?>
                                <td>
                                    <?
                                        if ($payment_tax_status == "on") echo CURRENCY_SYMBOL." ".payment_calculateTax($bill_info["total_bill"], $payment_tax_value, true);
                                        else echo CURRENCY_SYMBOL." ".$bill_info["total_bill"];
                                    ?>
                                </td>
                                <? } ?>
                                    
                            </tr>
                            
                            <? if ($ispackage == "true" && $auxitem_name) { ?>
                            <tr>
                                <td><?=($auxpackage_name != $item_name? $auxpackage_name." - ".$item_name." ".$item_levelName: $auxpackage_name)?><br /><?=$auxdomains_names?></td>
                                
                                <td><?=$auxlevel_names?></td>
                                
                                <? if (($bill_info["listings"]) && $info["extra_category_amount"] > 0) { ?>
                                    <td style="text-align:center;">&nbsp;</td>
                                <? } ?>
                                
                                <? if (PAYMENT_FEATURE == "on" && $info["discount_id"] && ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) ) { ?>
                                    <td style="text-align:center;">&nbsp;</td>
                                <? } ?>
                                        
                                <? if ($bill_info["banners"]) { ?>
                                    <td>&nbsp;</td>
                                <? } ?>
                                    
                                <? if ($payment_tax_status == "on" || $ispackage == "true") { ?>
                                    <td><br /><?=$aux_package_item_price;?></td>
                                <? } ?>

                                <? if ($payment_tax_status == "on" && $ispackage != "true") { ?>
                                    <td><?=CURRENCY_SYMBOL." ".payment_calculateTax($bill_info["total_bill"], $payment_tax_value, true, false);?></td>
                                <? } ?>

                                <? if ($ispackage != "true") { ?>
                                <td>
                                    <?
                                    if ($payment_tax_status == "on") echo CURRENCY_SYMBOL." ".payment_calculateTax($bill_info["total_bill"], $payment_tax_value, true);
                                    else echo CURRENCY_SYMBOL." ".$bill_info["total_bill"];
                                    ?>
                                </td>
                                <? } ?>
                                    
                            </tr>
                            <? } ?>
                            
                        </table>
                        
                        <? if ($ispackage == "true" && $auxitem_name) { ?>

                        <table class="standard-tableTOPBLUE">
                            
                            <? if ($payment_tax_status || $bill_info["tax_amount"] > 0) { ?>
                            <tr>
                                <th><?=system_showText(LANG_SUBTOTALAMOUNT);?></th>
                                <td>
                                    <?=CURRENCY_SYMBOL.$bill_info["total_bill"];?>
                                </td>
                            </tr>
                            
                            <tr>
                                <th><?=$payment_tax_label." (".$bill_info["tax_amount"]."%)";?></th>
                                <td>
                                    <?=CURRENCY_SYMBOL.payment_calculateTax($bill_info["total_bill"], $bill_info["tax_amount"], true, false);?>
                                </td>
                            </tr>
                            <? } ?>
                            
                            <tr>
                                <th><?=system_showText(LANG_LABEL_TOTAL_PRICE);?></th>
                                <td>
                                    <?=CURRENCY_SYMBOL.format_money($bill_info["amount"]);?>
                                </td>
                            </tr>
                            
                        </table>

                        <? } ?>
                        
                        <? } ?>

                    </div>

                </div>
                
                <? if (!in_array($payment_method, $gatewaysNoForm)) { ?>

                <div id="payment-method">

                    <div class="left textright">
                        <h3><?=system_showText(LANG_ADVERTISE_PAYMENT);?></h3>
                        <p><?=system_showText(LANG_ADVERTISE_PAYMENT_TIP);?></p>
                    </div>

                    <div class="right">
                        <div class="option">
                            
                <? }
                        $buttonGateway = "";
                        $payment_process = "signup";
                        if (file_exists(INCLUDES_DIR."/forms/form_billing_".$payment_method.".php")) {
                            include(INCLUDES_DIR."/forms/form_billing_".$payment_method.".php");
                        } else {
                            echo "<p class=\"errorMessage\">".system_showText(LANG_MSG_NO_PAYMENT_METHOD_SELECTED)."</p>";
                        }
                            
                if (!in_array($payment_method, $gatewaysNoForm)) { ?>
                        </div>
                    </div>

                </div>
                
                <? } ?>

                <div class="blockcontinue cont_100">
                    
                    <div class="cont_70 empty"></div>
                    
                    <div class="cont_30 ">
                        
                        <p class="bt-highlight checkoutButton biggerbutton">
                            
                            <? if ($buttonGateway) {
                                echo $buttonGateway;
                            } ?>
                                
                        </p>
                        
                    </div>
                </div>

            </div>
            
        </div>

    </div>
</div>
<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/footer.php");
?>