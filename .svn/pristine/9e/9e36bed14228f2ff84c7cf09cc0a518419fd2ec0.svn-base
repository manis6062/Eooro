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
	# * FILE: /functions/payment_funct.php
	# ----------------------------------------------------------------------------------------------------

	function payment_getRenewalPeriod($item) {
		return constant(string_strtoupper($item)."_RENEWAL_PERIOD");
	}

	function payment_getRenewalCycle($item) {
		return string_substr(constant(string_strtoupper($item)."_RENEWAL_PERIOD"), 0, string_strlen(constant(string_strtoupper($item)."_RENEWAL_PERIOD"))-1);
	}

	function payment_getRenewalUnit($item) {
		return string_substr(constant(string_strtoupper($item)."_RENEWAL_PERIOD"), string_strlen(constant(string_strtoupper($item)."_RENEWAL_PERIOD"))-1);
	}

	function payment_getRenewalUnitName($item) {
		$unit = payment_getRenewalUnit($item);
		if ($unit == "Y") $unitname = system_showText(LANG_YEAR);
		elseif ($unit == "M") $unitname = system_showText(LANG_MONTH);
		elseif ($unit == "D") $unitname = system_showText(LANG_DAY);
		return $unitname;
	}

	function payment_getRenewalUnitNamePlural($item) {
		$unit = payment_getRenewalUnit($item);
		if ($unit == "Y") $unitname = system_showText(LANG_YEAR_PLURAL);
		elseif ($unit == "M") $unitname = system_showText(LANG_MONTH_PLURAL);
		elseif ($unit == "D") $unitname = system_showText(LANG_DAY_PLURAL);
		return $unitname;
	}
	
	function payment_writeSettingPaymentFile($array_PaymentSetting) {
			
		$filePath = EDIRECTORY_ROOT.'/custom/domain_'.SELECTED_DOMAIN_ID.'/payment/payment.inc.php';
		
		if (!$file = fopen($filePath, 'w+')) {
			return false;
		}
		
		$buffer = "<?php".PHP_EOL;
		
		$buffer .= "\$payment_simplepayStatus = \"".$array_PaymentSetting['payment_simplepayStatus']."\";".PHP_EOL;
		$buffer .= "\$payment_paypalStatus = \"".$array_PaymentSetting['payment_paypalStatus']."\";".PHP_EOL;
		$buffer .= "\$payment_paypalapiStatus = \"".$array_PaymentSetting['payment_paypalapiStatus']."\";".PHP_EOL;
		$buffer .= "\$payment_payflowStatus = \"".$array_PaymentSetting['payment_payflowStatus']."\";".PHP_EOL;
		$buffer .= "\$payment_twocheckoutStatus = \"".$array_PaymentSetting['payment_twocheckoutStatus']."\";".PHP_EOL;
		$buffer .= "\$payment_psigateStatus = \"".$array_PaymentSetting['payment_psigateStatus']."\";".PHP_EOL;
		$buffer .= "\$payment_worldpayStatus = \"".$array_PaymentSetting['payment_worldpayStatus']."\";".PHP_EOL;
		$buffer .= "\$payment_itransactStatus = \"".$array_PaymentSetting['payment_itransactStatus']."\";".PHP_EOL;
		$buffer .= "\$payment_linkpointStatus = \"".$array_PaymentSetting['payment_linkpointStatus']."\";".PHP_EOL;
		$buffer .= "\$payment_authorizeStatus = \"".$array_PaymentSetting['payment_authorizeStatus']."\";".PHP_EOL;
		$buffer .= "\$payment_pagseguroStatus = \"".$array_PaymentSetting['payment_pagseguroStatus']."\";".PHP_EOL.PHP_EOL;
		$buffer .= "\$payment_simplepayRecurring = \"".$array_PaymentSetting['payment_simplepayRecurring']."\";".PHP_EOL;
		$buffer .= "\$payment_paypalRecurring = \"".$array_PaymentSetting['payment_paypalRecurring']."\";".PHP_EOL;
		$buffer .= "\$payment_linkpointRecurring = \"".$array_PaymentSetting['payment_linkpointRecurring']."\";".PHP_EOL;
		$buffer .= "\$payment_authorizeRecurring = \"".$array_PaymentSetting['payment_authorizeRecurring']."\";".PHP_EOL.PHP_EOL;
		$buffer .= "\$period_renewalListing = \"".$array_PaymentSetting['renewal_periodListing']."\";".PHP_EOL;
		$buffer .= "\$period_renewalEvent = \"".$array_PaymentSetting['renewal_periodEvent']."\";".PHP_EOL;
		$buffer .= "\$period_renewalBanner = \"".$array_PaymentSetting['renewal_periodBanner']."\";".PHP_EOL;
		$buffer .= "\$period_renewalClassified = \"".$array_PaymentSetting['renewal_periodClassified']."\";".PHP_EOL;
		$buffer .= "\$period_renewalArticle = \"".$array_PaymentSetting['renewal_periodArticle']."\";".PHP_EOL.PHP_EOL;
		$buffer .= "# ****************************************************************************************************".PHP_EOL;
		$buffer .= "# CUSTOMIZATIONS".PHP_EOL;
		$buffer .= "# NOTE: The \$payment_currency in this file is only for the domain ".SELECTED_DOMAIN_ID."".PHP_EOL;
		$buffer .= "# Any changes will require an update in the table \"Setting_Payment\"".PHP_EOL;
		$buffer .= "# to set the property \"PAYMENT_CURRENCY\" with the value bellow on the domain ".SELECTED_DOMAIN_ID." database.".PHP_EOL;
		$buffer .= "# ****************************************************************************************************".PHP_EOL;
		$buffer .= "\$payment_currency = \"".$array_PaymentSetting['payment_currency']."\";".PHP_EOL.PHP_EOL;
		$buffer .= "\$currency_symbol = \"".$array_PaymentSetting['currency_symbol']."\";".PHP_EOL;
		$buffer .= "\$invoice_payment = \"".$array_PaymentSetting['invoice_payment']."\";".PHP_EOL;
		$buffer .= "\$manual_payment = \"".$array_PaymentSetting['manual_payment']."\";".PHP_EOL;
		
		$return_payment = fwrite($file, $buffer, strlen($buffer));
		
		fclose($file);
		
		return $return_payment;
	
	}
	
	function payment_verifyItensRenewal($itens) {
		$aux = $itens[0];
		$aux2 = true;
		$i = 1;
		while ($i < count($itens)) {
			if ($itens[$i] != $aux) {
				$aux2 = false;
			};
			$i++;
		}
		return $aux2;
	}

	function payment_calculateTax ($price, $tax, $formatValue = true, $amount = true) {
		if ($amount) {
			$value = ($price * (1 + $tax / 100));
			if ($formatValue) return format_money($value);
			else return $value;
		} else {
			$value = (($price * (1 + $tax / 100)) - $price);
			if ($formatValue) return format_money($value);
			else return $value;
		}
	}

	function payment_taxToPercentage ($tax_value, $total_value) {
        if ($total_value > 0) {
            $value = (($tax_value * 100) / $total_value);
            return $value;
        } else {
            return 0;
        }
	}
    
    function payment_receiveInvoice($invoiceObj){
        
        domain_updateDashboard("revenue", "", $invoiceObj->getString("amount"), SELECTED_DOMAIN_ID);

        $invoiceObj->setString("payment_date", date("Y")."-".date("m")."-".date("d")." ".date("H").":".date("i").":".date("s"));
        $invoiceObj->Save(true);

        $dbMain = db_getDBObject(DEFAULT_DB, true);
        $db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
        $sql = "SELECT * FROM Invoice_Listing WHERE invoice_id = ".$invoiceObj->getString("id")."";
        $r = $db->query($sql);

        while($row = mysql_fetch_assoc($r)) $listing_ids[] = $row["listing_id"];

        if ($listing_ids) {

            $listingStatus = new ItemStatus();

            foreach ($listing_ids as $each_listing_id) $listings[] = new Listing($each_listing_id);

            if ($listings) foreach ($listings as $listing) {

                $sql = "UPDATE Invoice_Listing SET renewal_date = '".$listing->getNextRenewalDate()."' WHERE invoice_id = ".$invoiceObj->getString("id")." AND listing_id = ".$listing->getString("id")."";
                $r = $db->query($sql);

                $listing->setString("renewal_date", $listing->getNextRenewalDate());

                setting_get("listing_approve_paid", $listing_approve_paid);

                if ($listing_approve_paid){
                    $listing->setString("status", $listingStatus->getDefaultStatus());
                }else{
                    $listing->setString("status", "A");
                }

                $listing->Save();

            }

        }

        $sql = "SELECT * FROM Invoice_Event WHERE invoice_id = ".$invoiceObj->getString("id")."";
        $r = $db->query($sql);

        while($row = mysql_fetch_assoc($r)) $event_ids[] = $row["event_id"];

        if ($event_ids) {

            $eventStatus = new ItemStatus();

            foreach ($event_ids as $each_event_id) $events[] = new Event($each_event_id);

            if ($events) foreach ($events as $event) {

                $sql = "UPDATE Invoice_Event SET renewal_date = '".$event->getNextRenewalDate()."' WHERE invoice_id = ".$invoiceObj->getString("id")." AND event_id = ".$event->getString("id")."";
                $r = $db->query($sql);

                $event->setString("renewal_date", $event->getNextRenewalDate());

                setting_get("event_approve_paid",$event_approve_paid);

                if ($event_approve_paid){
                    $event->setString("status", $eventStatus->getDefaultStatus());
                }else{
                    $event->setString("status", "A");
                }

                $event->Save();

            }

        }

        $sql = "SELECT * FROM Invoice_Banner WHERE invoice_id = ".$invoiceObj->getString("id")."";
        $r = $db->query($sql);

        while ($row = mysql_fetch_assoc($r)) $banner_ids[] = $row["banner_id"];

        if ($banner_ids) {

            $bannerStatus = new ItemStatus();

            foreach ($banner_ids as $each_banner_id) $banners[] = new Banner($each_banner_id);

            if ($banners) foreach ($banners as $banner) {

                setting_get("banner_approve_paid", $banner_approve_paid);

                if($banner->getString("expiration_setting") == BANNER_EXPIRATION_IMPRESSION){

                    if ($banner_approve_paid){
                        $sql = "UPDATE Banner set impressions = impressions + ".$banner->getNumber("unpaid_impressions").", renewal_date = '0000-00-00', unpaid_impressions = 0 WHERE id = ".$banner->getNumber("id");
                    } else {
                        $sql = "UPDATE Banner set impressions = impressions + ".$banner->getNumber("unpaid_impressions").", renewal_date = '0000-00-00', unpaid_impressions = 0, status = 'A' WHERE id = ".$banner->getNumber("id");	
                    }
                    $result = $db->query($sql);

                } elseif ($banner->getString("expiration_setting") == BANNER_EXPIRATION_RENEWAL_DATE){

                    $sql = "UPDATE Invoice_Banner SET renewal_date = '".$banner->getNextRenewalDate()."' WHERE invoice_id = ".$invoiceObj->getString("id")." AND banner_id = ".$banner->getString("id")."";
                    $r = $db->query($sql);

                    $banner->setString("renewal_date", $banner->getNextRenewalDate());

                    if ($banner_approve_paid){
                        $banner->setString("status", $bannerStatus->getDefaultStatus());
                    }else{
                        $banner->setString("status", "A");
                    }

                    $banner->Save();

                }

            }

        }

        $sql = "SELECT * FROM Invoice_Classified WHERE invoice_id = ".$invoiceObj->getString("id")."";
        $r = $db->query($sql);

        while($row = mysql_fetch_assoc($r)) $classified_ids[] = $row["classified_id"];

        if ($classified_ids) {

            $classifiedStatus = new ItemStatus();

            foreach ($classified_ids as $each_classified_id) $classifieds[] = new Classified($each_classified_id);

            if ($classifieds) foreach ($classifieds as $classified) {

                $sql = "UPDATE Invoice_Classified SET renewal_date = '".$classified->getNextRenewalDate()."' WHERE invoice_id = ".$invoiceObj->getString("id")." AND classified_id = ".$classified->getString("id")."";
                $r = $db->query($sql);

                $classified->setString("renewal_date", $classified->getNextRenewalDate());
                setting_get("classified_approve_paid", $classified_approve_paid);

                if ($classified_approve_paid){
                    $classified->setString("status", $classifiedStatus->getDefaultStatus());
                }else{
                    $classified->setString("status", "A");
                }
                $classified->Save();

            }

        }

        $sql = "SELECT * FROM Invoice_Article WHERE invoice_id = ".$invoiceObj->getString("id")."";
        $r = $db->query($sql);

        while($row = mysql_fetch_assoc($r)) $article_ids[] = $row["article_id"];

        if ($article_ids) {

            $articleStatus = new ItemStatus();

            foreach ($article_ids as $each_article_id) $articles[] = new Article($each_article_id);

            if ($articles) foreach ($articles as $article) {

                $sql = "UPDATE Invoice_Article SET renewal_date = '".$article->getNextRenewalDate()."' WHERE invoice_id = ".$invoiceObj->getString("id")." AND article_id = ".$article->getString("id")."";
                $r = $db->query($sql);

                $article->setString("renewal_date", $article->getNextRenewalDate());

                setting_get("article_approve_paid",$article_approve_paid);

                if ($article_approve_paid){
                    $article->setString("status", $articleStatus->getDefaultStatus());
                }else{
                    $article->setString("status", "A");
                }
                $article->Save();

            }

        }

        $sql = "SELECT * FROM Invoice_CustomInvoice WHERE invoice_id = ".$invoiceObj->getString("id")."";
        $r = $db->query($sql);

        while($row = mysql_fetch_assoc($r)) {
            $custominvoice_ids[] = $row["custom_invoice_id"];
            $custominvoice_tax[] = $row["tax"];
        }

        if ($custominvoice_ids) {
            $k = 0;
            foreach ($custominvoice_ids as $each_custominvoice_id) $customInvoices[] = new CustomInvoice($each_custominvoice_id);

            if ($customInvoices) foreach ($customInvoices as $customInvoice) {

                $customInvoice->setString("paid", "y");

                $taxT = $custominvoice_tax[$k];
                $tax = payment_calculateTax($customInvoice->getNumber("subtotal"),$taxT,true,false);
                $k++;

                $customInvoice->setNumber("tax", $taxT);
                $customInvoice->setNumber("amount", $customInvoice->getNumber("subtotal") + $tax);
                $customInvoice->Save();
            }
        }

        $sql = "SELECT package_id FROM Invoice_Package WHERE invoice_id = ".$invoiceObj->getString("id")."";
        $r = $db->query($sql);

        while($row = mysql_fetch_assoc($r)) $package_id = $row["package_id"];

        if ($package_id) {

            $sql = "SELECT module_id, module, domain_id FROM PackageModules WHERE parent_domain_id = ".SELECTED_DOMAIN_ID." AND package_id = ".$package_id." AND account_id = ".$invoiceObj->getString("account_id");
            $r = $dbMain->query($sql);
            $i=0;
            while($row = mysql_fetch_assoc($r)){
                $itemsInfo[$i]["module_id"] = $row["module_id"];
                $itemsInfo[$i]["module"] = $row["module"];
                $itemsInfo[$i]["domain_id"] = $row["domain_id"];
                $i++;
            }

            foreach($itemsInfo as $item){
                if ($item["module"] != "custom_package"){
                    $className = ucfirst($item["module"]);
                    $item_id = $item["module_id"];
                    $domain_idItem = $item["domain_id"];

                    $itemObj = new $className($item_id);

                    $itemStatus = new ItemStatus();

                    setting_get($item["module"]."_approve_paid", $item_approve_paid);

                    if ($item_approve_paid){
                        $stritemStatus = $itemStatus->getDefaultStatus();
                    }else{
                        $stritemStatus = "A";
                    }


                    $sql = "UPDATE $className SET status = ".db_formatString($stritemStatus).", renewal_date = ".db_formatString($itemObj->getNextRenewalDate())." WHERE id = ".$item_id;
                    $dbItem = db_getDBObjectByDomainID($domain_idItem, $dbMain);
                    $dbItem->query($sql);
                }

            }

        }
    }
	

    #------------------------------------------------------------------------
    #                  CUSTOM PAYMENT FUNCTIONS
    #------------------------------------------------------------------------


    #---------------------------------------------------------------
    #   Function to get type of Merchant ID
    #---------------------------------------------------------------
    #   Format  : eooro Currency
    #   example : eooroUSD
    #   Note    : Merchant id is returned null for USD
    #---------------------------------------------------------------

    function getMerchantID($listing){
        // $account_id = sess_getAccountIdFromSession();
        // $account    = new Account($account_id);

        //     // if($account->prefered_currency != "USD"):
        //     $merchant_id = "eooro". $account->prefered_currency;
            // endif;
            
            $dbMain = db_getDBObject(DEFAULT_DB, true);
            $dbObj  = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
            
            $listingObj  = new Listing($listing);
            
            if($listingObj->status == "P"):
                $listingObj = new ListingPending($listing);
            endif;
            // if its a global set dollars
            if($listingObj->custom_checkbox1 == 'y'){
                return "eooroUSD";
            }
            else if($listingObj->location_1){
                $sql = "SELECT currency FROM Location_1 "
                        . "WHERE id=$listingObj->location_1";
                $res = $dbMain->query($sql);
                $row = mysql_fetch_array($res);
                
                return "eooro".$row['currency'];
            }
            else{
                return "eooroUSD";
            }

    }

    #---------------------------------------------------------------
    #   Function to get type of Subscription Plan
    #---------------------------------------------------------------
    #   Format  : eooro location1 duration currency discounttype amt
    #   example : eooroUKmonthlyAUDper50
    #---------------------------------------------------------------
    
    function getPlanId($listing){
        $planId      = "eooro";
        $listingObj  = new Listing($listing);
        
        if($listingObj->status == "P"):
            $listingObj = new ListingPending($listing);
        endif;
        
//        $accountObj  = new Account(sess_getAccountIdFromSession());

        #----------------------
        # Country Prefix 
        #----------------------

            if($listingObj->custom_checkbox1 != "y"):
                $countryPrefix = Location1::getAbbreviationFromId($listingObj->location_1);
                $countryPrefix = strtoupper($countryPrefix);
            else:
                $countryPrefix = "GLOBAL";
            endif;

        $planId = $planId. $countryPrefix; //eooroUS or eooroGB or eooroGLOBAL

        #----------------------
        # Yearly or Monthly
        #----------------------        

            if($listingObj->status == "P"):
                $listingObj = new ListingPending($listing);
            endif;

            if($listingObj->custom_checkbox3 == "y"):
                $payment_cycle = "monthly";
            else:
                $payment_cycle = "yearly";
            endif;

        $planId      = $planId . $payment_cycle; //eooroUKmonthly

        #----------------------
        # Selected Currency
        #----------------------

//        $currency    = $accountObj->prefered_currency;
        $currency    = $listingObj->getCurrencyAndSymbol()['currency'];
        $planId      = $planId . $currency; //eooroUSmonthlyGBP

        #--------------------------
        # If Discount Code Present
        #--------------------------
        $discount_id = $listingObj->discount_id;

            if(trim($discount_id)):
                
                $discountCodeObj = new DiscountCode($discount_id);
                
                if ($discountCodeObj->type == "percentage"):
                    $discount_type = "per";
                elseif ($discountCodeObj->type == "monetary value"):
                    $discount_type = "price";
                endif;

                $planId = $planId . $discount_type; //eooroUKmonthlyUSDpercent or eooroUSmonthlyGBPprice

                $planId = $planId . intval($discountCodeObj->amount); //eooroNZmonthlyAUDper50

            endif;

        return $planId;

    }

    function getPlanIdWebhook($listing){
        $planId      = "eooro";
        $listingObj  = new Listing($listing);

        if($listingObj->status == "P"):
            $listingObj = new ListingPending($listingObj->id);
        endif;

        $accountObj = new Account($listingObj->account_id);

        #----------------------
        # Country Prefix 
        #----------------------

            if($listingObj->custom_checkbox1 != "y"):
                $countryPrefix = Location1::getAbbreviationFromId($listingObj->location_1);
                $countryPrefix = strtoupper($countryPrefix);
            else:
                $countryPrefix = "GLOBAL";
            endif;

        $planId = $planId. $countryPrefix; //eooroUS or eooroGB or eooroGLOBAL

        #----------------------
        # Yearly or Monthly
        #----------------------        

            if($listingObj->custom_checkbox3 == "y"):
                $payment_cycle = "monthly";
            else:
                $payment_cycle = "yearly";
            endif;

        $planId      = $planId . $payment_cycle; //eooroUKmonthly

        #----------------------
        # Selected Currency
        #----------------------

        $currency    = $accountObj->prefered_currency;
        $planId      = $planId . $currency; //eooroUSmonthlyGBP

        #--------------------------
        # If Discount Code Present
        #--------------------------
        $discount_id = $listingObj->discount_id;

            if(trim($discount_id)):
                
                $discountCodeObj = new DiscountCode($discount_id);
                
                if ($discountCodeObj->type == "percentage"):
                    $discount_type = "per";
                elseif ($discountCodeObj->type == "monetary value"):
                    $discount_type = "price";
                endif;

                $planId = $planId . $discount_type; //eooroUKmonthlyUSDpercent or eooroUSmonthlyGBPprice

                $planId = $planId . intval($discountCodeObj->amount); //eooroNZmonthlyAUDper50

            endif;

        return $planId;

    }




    #---------------------------------------------------------------
    # Duration Based Discount Code Functions
    #---------------------------------------------------------------

    function addDateForDiscountCalculation($date_str, $months){
        $date      = new Datetime($date_str);
        $start_day = $date->format('j');

        $date->modify("+{$months} month");
        $end_day = $date->format('j');

        if ($start_day != $end_day)
            $date->modify('last day of last month');

        return $date;
    }


    function calcuateDiscountDuration($discount_id, $listing_id){
        $listingObj = new Listing($listing_id);
        //Duration Based Discount Code
        $discountCodeObj = new DiscountCode($discount_id);                                          
        if(($discountCodeObj->type =="duration") && ($discountCodeObj->status == "A") && $discountCodeObj->expire_date >= date('Y-m-d')):
            $amont = intval($discountCodeObj->amount);
            $result = addDateForDiscountCalculation($listingObj->getString("renewal_date"), $amont);
            $result = (array) $result;
            $d      = $result['date'];
            $d      = explode(" ", $d);
        endif;

        return $d[0];
    }


    #---------------------------------------------------------------
    # Listing Payment Functions
    #---------------------------------------------------------------

    //Log data in Payment_Listing_Log table
    function LogListingPayment($listing, $renewal_date, $payment_log_id, $success = true, $webhook = false){
        $listingObj = new Listing($listing);
        $transaction_listing_log["payment_log_id"] = $payment_log_id;
        $transaction_listing_log["listing_id"]     = $listing;
        $transaction_listing_log["listing_title"]  = $listingObj->getString("title", false);
        $transaction_listing_log["level"]          = $listingObj->getString("level");
        $transaction_listing_log["level_label"]    = 10;
        $transaction_listing_log["discount_id"]    = $listingObj->getString("discount_id");
        $transaction_listing_log["categories"]     = 0;
        if($webhook == false):
            $transaction_listing_log["amount"]         = sprintf('%0.2f', CountryLoader::getPriceListing($listingObj->id, $listingObj->location_1)['price_listing']);
        else:
            $transaction_listing_log["amount"]         = sprintf('%0.2f', CountryLoader::getPriceListingForWebhook($listingObj->id, $listingObj->location_1)['price_listing']);        
        endif;
        $transaction_listing_log["renewal_date"]   = $renewal_date;
        $transaction_listing_log["discount_id"]    = $listingObj->getString("discount_id"); 

        if($success == false):
            $transaction_listing_log["renewal_date"]   = $listingObj->getString("renewal_date");
            $transaction_listing_log["amount"]         = "0.00";
        endif;

        $paymentListingLogObj = new PaymentListingLog($transaction_listing_log, $domain_id);
        $paymentListingLogObj->Save();
    }

    function DeletePendingListing($listing){
        $listingObj      = new Listing($listing);
        $lisitingPending = new ListingPending($listing);
        $listingarray    = (array) $listingObj;
        $pendingarray    = (array) $lisitingPending;
        $both            = array_intersect_key($pendingarray, $listingarray);

            foreach($both as $key => $value):
                $listingObj->$key = $value;
            endforeach;
            
        $listingObj->save();
        $lisitingPending->delete($listing);
        return $listingObj;
    }

    function MakePaymentLisitng($listing, $payment_log_id, $subscription_id){
        $listingObj = new Listing($listing);

            $listingObj=DeletePendingListing($listingObj->id);

            //Insert subscription ID in Listing
            $listingObj->custom_text2 =  $subscription_id;

            //Renewal date based on monthly or yearly
            if($listingObj->custom_checkbox3 == "y"): // monthly
                $renewal_date = $listingObj->getNextMonthlyRenewalDate();
                $listingObj->setString("renewal_date", $renewal_date);
            else: // yearly
                $renewal_date = $listingObj->getNextRenewalDate();
                $listingObj->setString("renewal_date", $renewal_date);
            endif;

        $listingObj->setString("status", "A");
        $listingObj->setRenewalDate(calcuateDiscountDuration($listingObj->discount_id, $listingObj->id), $listingObj->id);
        $listingObj->Save();

        // Log Lisitng Payment
        LogListingPayment($listing, $renewal_date, $payment_log_id, true);

    }


    function LogNonSubscriberListingPayment($payment_log_id, $listing, $success = true){
        $listingObj = new Listing($listing);

        //Transaction succeed or failed
        if($success == true):    
        
            //If listing is new, then get value from ListingPending and update in Listing Table
            if($listingObj->renewal_date == "0000-00-00"):
                $lisitingPending = new ListingPending($listing);
                $listingarray    = (array) $listingObj;
                $pendingarray    = (array) $lisitingPending;
                $both            = array_intersect_key($pendingarray, $listingarray);

                    foreach($both as $key => $value):
                        $listingObj->$key = $value;
                    endforeach;

                $lisitingPending->delete($listing);

            endif;

            $listingObj->setString("status", "A");
            $listingObj->setRenewalDate(calcuateDiscountDuration($listingObj->discount_id, $listingObj->id),$listingObj->id);
            $listingObj->Save();
            LogListingPayment($listing, calcuateDiscountDuration($listingObj->discount_id, $listingObj->id), $payment_log_id, true);
            
        else:
            LogListingPayment($listing, $listingObj->renewal_date, $payment_log_id);
        endif;

    }
    
    #---------------------------------------------------------------
    #                Case Payment Functions
    #---------------------------------------------------------------

    //Log case payment and make active if transaction was successful
    function LogCasePayment($payment_log_id, $case, $active = false){
        include_once CLASSES_DIR.DIRECTORY_SEPARATOR.'class_Opened_Cases.php';
        include_once CLASSES_DIR.DIRECTORY_SEPARATOR.'class_CaseSettings.php';
        include_once CLASSES_DIR.DIRECTORY_SEPARATOR.'class_PaymentCaseLog.php';
        
        $caseObj                            = new Opened_Cases( $case );
        $payment_case_log['payment_log_id'] = $payment_log_id;
        $payment_case_log['case_id']        = $caseObj->getNumber('case_id');
        $payment_case_log['amount']         = "0.00";

        if($active == true){        
            $payment_case_log['amount']     = sprintf('%0.2f', CountryLoader::getPriceCases($case, $caseObj->getLocationCase($case))['price_case']);
            $caseObj->makeActive();
        }
        
        $paymentCaseLogObj                  = new PaymentCaseLog( $payment_case_log, $domain_id );
        $paymentCaseLogObj->Save();     
    }

    #---------------------------------------------------------------
    #  Payment Success/Failed Messaging Functions
    #---------------------------------------------------------------

    function generateFailedTransactionPaymentLog($message){
        $accountObj = new Account(sess_getAccountIdFromSession());
        $paymentLogObj = new PaymentLog();
        $paymentLogObj->account_id              = $accountObj->id;
        $paymentLogObj->username                = $accountObj->username;
        $paymentLogObj->ip                      = $_SERVER["REMOTE_ADDR"];
        $paymentLogObj->transaction_id          = date("Y-m-d_H-i-s"). "." . $accountObj->id;
        $paymentLogObj->transaction_status      = "Failed";
        $paymentLogObj->transaction_datetime    = date("Y-m-d H:i:s");
        $paymentLogObj->transaction_tax         = "0.00";
        $paymentLogObj->transaction_subtotal    = "0.00";
        $paymentLogObj->transaction_amount      = "0.00";
        $paymentLogObj->transaction_currency    = $accountObj->prefered_currency;
        $paymentLogObj->system_type             = "";
        $paymentLogObj->recurring               = "n";
        $paymentLogObj->notes                   = $message;
        $paymentLogObj->return_fields           = null;
        $paymentLogObj->save();

        return $paymentLogObj->id;
    }


    function LogFailedTransaction($listing, $message, $return_fields = false, $monthly = false, $payment_instrument, $currency){
        $accountObj = new Account(sess_getAccountIdFromSession());

            if($return_fields):
                $paymentLogObj = new PaymentLog($return_fields);
            else:
                $paymentLogObj = new PaymentLog();
                $paymentLogObj->account_id              = $accountObj->id;
                $paymentLogObj->username                = $accountObj->username;
                $paymentLogObj->ip                      = $_SERVER["REMOTE_ADDR"];
                $paymentLogObj->transaction_id          = date("Y-m-d_H-i-s"). "." . $accountObj->id;
                if($monthly == true){
                    $paymentLogObj->transaction_status      = "Success";
                } else {
                    $paymentLogObj->transaction_status      = "Failed";
                }
                $paymentLogObj->transaction_datetime    = date("Y-m-d H:i:s");
                $paymentLogObj->listing_id    = $listing;
                $paymentLogObj->transaction_tax         = "0.00";
                $paymentLogObj->transaction_subtotal    = "0.00";
                $paymentLogObj->transaction_amount      = "0.00";
                $paymentLogObj->transaction_currency    = $currency;
                $paymentLogObj->system_type             = $payment_instrument;
//                if($payment_instrument == "paypal"){ 
//                    $paymentLogObj->system_type  = "paypal";
//                }
                $paymentLogObj->recurring               = "n";
                $paymentLogObj->notes                   = $message;
                $paymentLogObj->return_fields           = null;
            endif;

            $paymentLogObj->save();
            $payment_message_array = getPaymentMessage("fail", $message);

            //Log Failed listing payment
            LogListingPayment($listing, null, $paymentLogObj->id, false);

        return $payment_message_array;

    }


    function getPaymentMessage($type, $message){
        if($type == "fail"):
            $payment_message_array['head']  = "Sorry your transaction failed. Following errors were encountered : <br>";
            $payment_message_array['body']  = "<font color='red'>Error processing transaction.</font>";
            $payment_message_array['body'] .= "<p class='successMessage'>\n";
            $payment_message_array['body'] .= "<font color = red>";
            $payment_message_array['body'] .= $message;
            $payment_message_array['body'] .= "</font></p>";
        else:
            $payment_message_array['body']  = "<p class=successMessage>\n";
            $payment_message_array['body'] .= str_replace('.',".<br>", $message);
            $payment_message_array['body'] .= "</font></p>";
        endif;

        return $payment_message_array;
    }

    #---------------------------------------------------------------
    #   Other Payment Functions
    #---------------------------------------------------------------

    function makeExpDate($year, $month){
        $year  = substr($year, 2);

            if ($month < 10 && $month[0] != "0"):
                $month = "0" . $month;
            endif;

        $exp   =  $month. "/" . $year;

        return $exp;
    }

    #---------------------------------------------------------------
    #   Check if Listing is Duration Based
    #---------------------------------------------------------------

    function CheckDurationBasedListing($listing){
        $listingObj = new Listing($listing);

        if($listingObj->status == "P"):
            $listingObj = new ListingPending($listing);
        endif;
        
        if($listingObj->discount_id):
            $discountCodeObj = new DiscountCode($listingObj->discount_id);   
        
            if(($discountCodeObj->type =="duration") && ($discountCodeObj->status == "A") && $discountCodeObj->expire_date >= date('Y-m-d')):
                return true;
            endif;

        endif;
        
        return false;
    }

?>