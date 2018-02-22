<?php

	if(Braintree_NotificationLog::save($webhookNotification, $subscription)) {
		$log = "saved";
	} else 
        $log = "not saved";


	$listing_id = Listing::getListingFromSubscriptionID($subscription_id);
	$listingObj = new Listing($listing_id);
	$accountObj = new Account($listingObj->account_id);
	
	if($listingObj->status == "P"):
		$listingObj = new ListingPending($listingObj->id);
		//$accountObj = new Account($listingObj->account_id);
	endif;


    //Fetch latest transasction data
    $transcation_array = $subscription->_attributes['transactions'];
    $key 			   = key( array_slice( $transcation_array, -1, 1, TRUE ) );
    $transaction_data  = $subscription->_attributes['transactions'][$key]->_attributes;

	    $subscription_data['transaction_id'] 	= $transaction_data['id'];
		$subscription_data['subscription_id']   = $subscription_id;
		$subscription_data['merchantAccountId'] = $subscription_attributes['merchantAccountId'];
		$subscription_data['nextBillAmount']    = $subscription_attributes['nextBillAmount'];
		$subscription_data['planId']			= $subscription_attributes['planId'];
		$subscription_data['price']				= $subscription_attributes['price'];
		$subscription_data['status']			= $subscription_attributes['status'];

		$transaction['transaction_id'] 			= date("Y-m-d_H-i-s"). "." . $accountObj->id;
		$transaction['type']					= $transaction_data['type'];
		$transaction['transaction_currency']	= $transaction_data['currencyIsoCode'] ? $transaction_data['currencyIsoCode'] : $accountObj->prefered_currency;
		$transaction['transaction_amount']		= $transaction_data['amount'];
		$transaction['transaction_subtotal'] 	= $transaction['transaction_amount'];
		$transaction['processorResponseCode']	= $transaction_data['processorResponseCode'];
		$transaction['processorResponseText']	= $transaction_data['processorResponseText'];
		$transaction['paymentInstrumentType']	= $transaction_data['paymentInstrumentType'];
		$transaction['processorSettlementResponseCode'] = $transaction_data['processorSettlementResponseCode'];
		$transaction['processorSettlementResponseText'] = $transaction_data['processorSettlementResponseText'];
		$transcation['subscription_data']		= $subscription_data;
		$transaction["transaction_datetime"] 	= date("Y-m-d H:i:s");
		$transaction_data['paymentInstrumentType'] == "paypal_account" ? $transaction['paymentInstrumentType'] = "paypal" : "creditcard";

		$transaction["account_id"]           	= $accountObj->id;
		$transaction["username"]             	= $accountObj->getString("username");
		$transaction["ip"]                   	= $_SERVER["REMOTE_ADDR"];
		$transaction["transaction_status"]   	= "Success";
		$transaction["system_type"]  	        = $transaction['paymentInstrumentType'];
		$transaction["recurring"]       		= "y";
		$transaction["notes"]                	= 'First '.$subscription->_attributes['trialDuration'].' '.$subscription->_attributes['trialDurationUnit'].' Free.'; //$transaction_data['message'];
		$transaction["return_fields"] 			= system_array2nvp($subscription_data, " || ");

		$paymentLogObj = new PaymentLog($transaction);
		$paymentLogObj->Save();

		/*--------------------------------------------------------------------------------------------------------------------
		| Another way to generate renewal date. Currently discarded and value fetched from subscription billingPeriodEndDate
		|---------------------------------------------------------------------------------------------------------------------
		|
        |	if($listingObj->custom_checkbox3 == "y"): // monthly
        |       $renewal_date = $listingObj->getNextMonthlyRenewalDate();  // billingPeriodEndDate from subscription
        |        $listingObj->setString("renewal_date", $renewal_date);
        |    else: // yearly
        |        $renewal_date = $listingObj->getNextRenewalDate();  // billingPeriodEndDate from subscription
        |        $listingObj->setString("renewal_date", $renewal_date);
        |    endif;
        */

        $renewal_date = $subscription->_attributes['billingPeriodEndDate']->format('Y-m-d');
        LogListingPayment($listingObj->id, $renewal_date, $paymentLogObj->id, true, true);

		if($listingObj->status == "P"):
			DeletePendingListing($listingObj->id);
    	endif;
       
        $listingObj = new Listing($listingObj->id);
        $listingObj->setString("renewal_date", $renewal_date); //Set renewal Date
        $listingObj->custom_text3 = $subscription->_attributes['nextBillingDate']->format('Y-m-d'); //Set next bill date in listing table
        $listingObj->custom_text2 = $subscription_id; //Set next bill date in listing table
        $listingObj->custom_text5 = $subscription->_attributes['paymentMethodToken'];
        $listingObj->discount_id  = ""; //Remove Listing's Discount Code
        $listingObj->setString("status", "A");

        //for sending email
        $account_id = $listingObj->account_id;
        $friendly_url = $listingObj->friendly_url;
        $title = $listingObj->title;

        $listingObj->Save();


    #################### SEND EMAIL ################################################
        $contact    = new Contact($account_id);
        $emailNotification_id = 50;

        $emailNotificationObj = new EmailNotification($emailNotification_id);
        $email                = $contact->email;
        $subject              = $emailNotificationObj->subject;
        $body                 = $emailNotificationObj->body;
        $variables            = $emailNotificationObj->use_variables;
        $eachVariables        = explode(',', $variables);
        $detailLink           = LISTING_DEFAULT_URL."/".$friendly_url;

        if($contact){
            $body             = str_replace(trim($eachVariables[0]),ucfirst($contact->first_name), $body);
            $body             = str_replace(trim($eachVariables[1]),ucfirst($contact->last_name), $body);
        } else {
            $body             = str_replace(trim($eachVariables[0]),"", $body);
            $body             = str_replace(trim($eachVariables[1]),"Business Owner", $body);
        }
        $subject              = str_replace(trim($eachVariables[2]),$title, $subject);
        $body                 = str_replace(trim($eachVariables[2]),$title, $body);
        $body                 = str_replace(trim($eachVariables[3]),$detailLink, $body);

        $return  = system_mail($email, $subject, $body, EDIRECTORY_TITLE." <$sitemgr_email>","text/html", "", "", $error);
            if($return) {
                $issue_sending = true;
                $emailResult = "Email Sent: ".$listing_id.' | '.$account_id.' | '.$subject.' | '.$body;
            }
            else {
                $issue_sending = false;
                $emailResult = "Email Not Sent: ".$listing_id.' | '.$account_id.' | '.$subject.' | '.$body;
            }
        
        ############################## Email Sent ##############################


        ############################## Email Log ##############################
        if(EmailLog::save($listing_id, $account_id, $email, $emailNotification_id, $subscription_id, $notification_type, $subject, $body, $issue_sending)) {
            $emailLog = "Email Log Saved";
        } else 
            $emailLog = "Email Log Not Saved";                
        ############################## Email Log Saved ##############################



        $message =
        "[Webhook Received " . $webhookNotification->timestamp->format('Y-m-d H:i:s') . "] "
        . "Kind: " . $webhookNotification->kind . " | "
        . "log: " . $log . " | "
        . "emailResult: " . $emailResult . " | ".$emailLog . " | "
        . "Subscription_id: " . $webhookNotification->subscription->id . "\n";

        file_put_contents("custom/log/braintree/webhook.log", $message, FILE_APPEND);


?>