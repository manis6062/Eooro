<?

require_once EDIRECTORY_ROOT . '/braintree/braintree-php/lib/Braintree.php';
require_once EDIRECTORY_ROOT . '/braintree/_environment.php';
require_once(INCLUDES_DIR . "/code/billing.php");

$total = $bill_info['amount'];
$accountObj = new Account(sess_getAccountIdFromSession());
$contactObj = new Contact($accountObj->id);
$customer_id = $accountObj->bt_customer_id;
$nonce = $_POST['nonce'];


#-----------------------------------------------------------
# 	Separate Listings not to create subscription of
#-----------------------------------------------------------

foreach ($_POST['listing_id'] as $key => $listing):

    $listingObj = new Listing($listing);

    if ($listingObj->status == "P"):
        $listingObj = new ListingPending($listing);
    endif;

    if ($listingObj->discount_id):
        $discountCodeObj = new DiscountCode($listingObj->discount_id);

        if (($discountCodeObj->type == "duration") && ($discountCodeObj->status == "A") && $discountCodeObj->expire_date >= date('Y-m-d')):

            unset($_POST['listing_id'][$key]);

        endif;

    endif;

endforeach;

#------------------------------------------------
#	Create a customer for Braintree
#------------------------------------------------

if (!$customer_id):
    $result = Braintree_Customer::create([
                'firstName' => $contactObj->first_name,
                'lastName' => $contactObj->last_name,
                'company' => $contactObj->company,
                'email' => $contactObj->email,
                'phone' => $contactObj->phone,
                'fax' => $contactObj->fax,
    ]);

    $customer_id = $result->customer->id;
    $accountObj->bt_customer_id = $customer_id;
    $accountObj->save();

endif;

#------------------------------------------------
#	Create a payment Method for Braintree
#------------------------------------------------

$result_payment_method = Braintree_PaymentMethod::create([
            'customerId' => $customer_id,
            'paymentMethodNonce' => $nonce
        ]);

$token = $result_payment_method->paymentMethod->_attributes['token'];

#------------------------------------------------
#
#			F O R		L I S T I N G S
#
#------------------------------------------------

if ($_POST['listing_id']):

    if ($result_payment_method->success == true):

        #-----------------------------------------------------------
        # Create Subscription
        #-----------------------------------------------------------

        foreach ($_POST['listing_id'] as $key => $listing):

            $planId = getPlanId($listing);
            $merchantID = getMerchantID($listing);

            //Create subscription based on listing's plan id and save subscription id in custom_text2

            if ($merchantID):

                $result_subscription = Braintree_Subscription::create([
                            'paymentMethodToken' => $token,
                            'planId' => $planId,
                            'merchantAccountId' => $merchantID
                ]);

            else:

                $result_subscription = Braintree_Subscription::create([
                            'paymentMethodToken' => $token,
                            'planId' => $planId
                ]);

            endif;

            if ($result_subscription->success == true)
                Braintree_NotificationLog::save(false, $result_subscription->subscription, $customer_id, $source = "manualPay"); // save log


                
//If subscription create success log success else log failure in payment log
            if ($result_subscription->success == true):

                if ($_SERVER['SERVER_NAME'] == "localhost" && $_SERVER['SERVER_ADDR'] == "127.0.0.1" && $_SERVER['REMOTE_ADDR'] == "127.0.0.1"):
                    $subscription_id = $result_subscription->subscription->_attributes['id'];
                    $subscription_attributes = $result_subscription->subscription->_attributes;
                    $transaction_data = $subscription_attributes['transactions'][$key]->_attributes;

                    $subscription_data['transaction_id'] = $transaction_data['id'];
                    $subscription_data['subscription_id'] = $subscription_id;
                    $subscription_data['merchantAccountId'] = $subscription_attributes['merchantAccountId'];
                    $subscription_data['nextBillAmount'] = $subscription_attributes['nextBillAmount'];
                    $subscription_data['planId'] = $subscription_attributes['planId'];
                    $subscription_data['price'] = $subscription_attributes['price'];
                    $subscription_data['status'] = $subscription_attributes['status'];

                    $transaction['transaction_id'] = date("Y-m-d_H-i-s") . "." . $accountObj->id;
                    $transaction['type'] = $transaction_data['type'];
                    $transaction['transaction_currency'] = $transaction_data['currencyIsoCode'] ? $transaction_data['currencyIsoCode'] : substr($result_subscription->subscription->_attributes['merchantAccountId'], -3);
                    $transaction['transaction_amount'] = $transaction_data['amount'];
                    $transaction['transaction_subtotal'] = $transaction['transaction_amount'];
                    $transaction['processorResponseCode'] = $transaction_data['processorResponseCode'];
                    $transaction['processorResponseText'] = $transaction_data['processorResponseText'];
                    $transaction['paymentInstrumentType'] = $transaction_data['paymentInstrumentType'];
                    $transaction['processorSettlementResponseCode'] = $transaction_data['processorSettlementResponseCode'];
                    $transaction['processorSettlementResponseText'] = $transaction_data['processorSettlementResponseText'];
                    $transcation['subscription_data'] = $subscription_data;
                    $transaction["transaction_datetime"] = date("Y-m-d H:i:s");
                    $transaction["listing_id"] = $listing;
                    $transaction["account_id"] = $accountObj->id;
                    $transaction["username"] = $accountObj->getString("username");
                    $transaction["ip"] = $_SERVER["REMOTE_ADDR"];
                    $transaction["transaction_status"] = "Success";
                    $transaction["system_type"] = $_POST['payment_method'];
                    $transaction["recurring"] = "y";
                    $transaction["notes"] = $transaction_data['message'];
                    $transaction["return_fields"] = system_array2nvp($subscription_data, " || ");

                    //Create Payment Log
                    $paymentLogObj = new PaymentLog($transaction);
                    $paymentLogObj->Save();
                    MakePaymentLisitng($listing, $paymentLogObj->id, $subscription_id);

                    //Add subscription Id in Listing's custom_text2 column
                    $subscription_id = $result_subscription->subscription->_attributes['id'];
                    $listingObj = new Listing($listing);
                    $renewal_data = $result_subscription->subscription->_attributes['nextBillingDate']->format('Y-m-d');
//						$renewal_data	 	  = $listingObj->getNextMonthlyRenewalDate(); //Set renewal date to 30 days

                    if ($listingObj->status == "P"):
                        $listingObj = new ListingPending($listing);
                        $pendingObj = $listingObj;

                        if ($pendingObj->custom_checkbox3 == "y"):
                            $listingObj->custom_checkbox3 = "y"; //Monthly data
                        endif;

                        //Update Listing's grace period for monthly listing
                        DeletePendingListing($listingObj->id);
                    endif;

                    $listingObj = new Listing($listing);
                    $listingObj->status = "A";
                    $listingObj->renewal_date = $renewal_data;

                    $listingObj->custom_checkbox4 = "y"; //Update Listing's got grace period of 30 days
                    $listingObj->custom_text2 = $subscription_id;
                    $listingObj->custom_text4 = $customer_id;
                    $listingObj->custom_text5 = $result_subscription->subscription->_attributes['paymentMethodToken'];
                    $listingObj->custom_dropdown4 = (string) $result_subscription->subscription->_attributes['firstBillingDate']->format('Y-m-d');
                    $listingObj->save();

                else:

                    //Add subscription Id in Listing's custom_text2 column
                    $subscription_id = $result_subscription->subscription->_attributes['id'];
                    $listingObj = new Listing($listing);
                    $renewal_data = $result_subscription->subscription->_attributes['nextBillingDate']->format('Y-m-d');
//						$renewal_data	 	  = $listingObj->getNextMonthlyRenewalDate(); //Set renewal date to 30 days

                    if ($listingObj->status == "P"):
                        $listingObj = new ListingPending($listing);
                        $pendingObj = $listingObj;

                        if ($pendingObj->custom_checkbox3 == "y"):
                            $listingObj->custom_checkbox3 = "y"; //Monthly data
                        endif;

                        //Update Listing's grace period for monthly listing
                        DeletePendingListing($listingObj->id);
                    endif;

                    $listingObj = new Listing($listing);
                    $listingObj->status = "A";
                    $listingObj->renewal_date = $renewal_data;

                    $currency = $transaction_data['currencyIsoCode'] ? $transaction_data['currencyIsoCode'] : substr($result_subscription->subscription->_attributes['merchantAccountId'], -3);


                    $listingObj->custom_checkbox4 = "y"; //Update Listing's got grace period of 30 days
                    $listingObj->custom_text2 = $subscription_id;
                    $listingObj->custom_text4 = $customer_id;
                    $listingObj->custom_text5 = $result_subscription->subscription->_attributes['paymentMethodToken'];
                    $listingObj->custom_dropdown4 = (string) $result_subscription->subscription->_attributes['firstBillingDate']->format('Y-m-d H:i:s');
                    $listingObj->save();

                    //Log 0.00 amount for the first free month
                    LogFailedTransaction($listing, "First Month Free", $return_fields = false, true, "paypal", $currency);
                endif;

                $payment_success = true;
                $payment_message = getPaymentMessage("success", $transaction_data['message']);

            else:

                $transaction['transaction_id'] = date("Y-m-d_H-i-s") . "." . $accountObj->id;
                $transaction['type'] = $transaction_data['type'];
                $transaction['transaction_currency'] = $transaction_data['currencyIsoCode'] ? $transaction_data['currencyIsoCode'] : $accountObj->prefered_currency;
                $transaction['transaction_amount'] = $transaction_data['amount'];
                $transaction['transaction_subtotal'] = $transaction['transaction_amount'];
                $transaction['processorResponseCode'] = $transaction_data['processorResponseCode'];
                $transaction['processorResponseText'] = $transaction_data['processorResponseText'];
                $transaction['paymentInstrumentType'] = $transaction_data['paymentInstrumentType'];
                $transaction['processorSettlementResponseCode'] = $transaction_data['processorSettlementResponseCode'];
                $transaction['processorSettlementResponseText'] = $transaction_data['processorSettlementResponseText'];
                $transcation['subscription_data'] = $subscription_data;
                $transaction["transaction_datetime"] = date("Y-m-d H:i:s");
                $transaction["system_type"] = $_POST['payment_method'];
                $transaction["recurring"] = "n";
                $transaction["notes"] = $transaction_data['message'];
                $transaction["account_id"] = $accountObj->id;
                $transaction["listing_id"] = $listing;
                $transaction["username"] = $accountObj->getString("username");
                $transaction["ip"] = $_SERVER["REMOTE_ADDR"];
                $transaction["transaction_status"] = "Failed";
                $transaction["return_fields"] = system_array2nvp($transaction, " || ");

                //Create Payment Log
                $payment_message = LogFailedTransaction($listing, $result_subscription->_attributes['message'], $transaction);
                $payment_success = false;

            endif;

        endforeach;

    else:
        $payment_message = LogFailedTransaction($listing, $result_payment_method->_attributes['message']);
        $payment_success = false;
    endif;

endif;

#------------------------------------------------
#
#			F O R		C A S E S
#
# 		And No Subscription Type Listings
#
#------------------------------------------------

if ($_POST['case_id'] || $noSubscriptionListings):

    include_once CLASSES_DIR . DIRECTORY_SEPARATOR . 'class_Opened_Cases.php';
    include_once CLASSES_DIR . DIRECTORY_SEPARATOR . 'class_CaseSettings.php';
    include_once CLASSES_DIR . DIRECTORY_SEPARATOR . 'class_PaymentCaseLog.php';

    if ($result_payment_method->success == true):

        #-------------------------------------------------
        #  			Create Transaction
        #-------------------------------------------------

        $merchantID = getMerchantID();
        $case_price = sprintf('%0.2f', $bill_info['case_total']);
        $noSublisting_price = sprintf('%0.2f', $bill_info["no_subscription_bill"]);
        $totalPrice = $case_price + $noSublisting_price;

        if ($merchantID):

            $result = Braintree_Transaction::sale([
                        "amount" => $totalPrice,
                        'merchantAccountId' => $merchantID,
                        'paymentMethodToken' => $token,
                        'options' => array(
                            'submitForSettlement' => True
                        ),
            ]);

        else:

            $result = Braintree_Transaction::sale([
                        "amount" => $totalPrice,
                        'paymentMethodToken' => $token,
                        'options' => array(
                            'submitForSettlement' => True
                        ),
            ]);

        endif;


        #------------------------------------------------------------
        #	Collect Transaction Data And Log Payment
        #------------------------------------------------------------

        $transaction_braintree["RESULT"] = $result->success == true ? "Success" : "Failed";
        $transaction_braintree["TRANSACTION_ID"] = $result->transaction->id;
        $transaction_braintree["RESPMSG"] = $result->transaction->status;
        $transaction_braintree["AMOUNT"] = $result->transaction->amount;
        $transaction_braintree["CURRENCY"] = $result->transaction->currencyIsoCode;
        $transaction_braintree["MERCH_ACCOUNT_ID"] = $result->transaction->merchantAccountId;
        $transaction_braintree["PROCESSOR_AUTHORIZATION_CODE"] = $result->transaction->processorAuthorizationCode;
        $transaction_braintree["PROCESSOR_RESPONSE_CODE"] = $result->transaction->processorResponseCode;
        $transaction_braintree["PROCESSOR_RESPONSE_TEXT"] = $result->transaction->processorResponseText;
        $transaction_braintree["PAYMENT_INSTRUMENT_TYPE"] = $result->transaction->paymentInstrumentType;
        $transaction_braintree[] = $result->transaction->billingDetails;

        $transaction["account_id"] = $accountObj->getString("id");
        $transaction["listing_id"] = $_SESSION['list_id'];
        $transaction["username"] = $accountObj->getString("username");
        $transaction["ip"] = $_SERVER["REMOTE_ADDR"];
        $transaction["transaction_status"] = $transaction_braintree["RESULT"];
        $datetime = (array) $result->transaction->createdAt;
        $transaction["transaction_datetime"] = date("Y-m-d H:i:s");
        $transaction['transaction_id'] = date("Y-m-d_H-i-s") . "." . $accountObj->id;
        $transaction['transaction_subtotal'] = $result->transaction->amount;
        $transaction["transaction_amount"] = $result->transaction->amount;
        $transaction["transaction_currency"] = $result->transaction->currencyIsoCode ? $result->transaction->currencyIsoCode : substr($result->subscription->_attributes['merchantAccountId'], -3);
        $transaction["system_type"] = $_POST['payment_method'];
        $transaction["recurring"] = "n";
        $transaction["notes"] = $result->message;
        $transaction["return_fields"] = system_array2nvp($transaction_braintree, " || ");

        $paymentLogObj = new PaymentLog($transaction);
        $paymentLogObj->Save();

        #-------------------------------------------------
        #  			Transaction Success
        #-------------------------------------------------

        if ($result->success == true):


            #----------------------------------------------
            #	Get Transaction Data
            #----------------------------------------------

            foreach ($_POST['case_id'] as $case):

                LogCasePayment($paymentLogObj->id, $case, true);

            endforeach;

            //No subscription Listings

            foreach ($noSubscriptionListings as $listing):


                LogNonSubscriberListingPayment($paymentLogObj->id, $listing);

            endforeach;


            $payment_success = true;
            $payment_message = getPaymentMessage("success", $result->message);

        else:

            #-------------------------------------------------
            #  			Transaction Failed
            #-------------------------------------------------

            foreach ($_POST['case_id'] as $case):

                LogCasePayment($paymentLogObj->id, $case);

            endforeach;

            foreach ($noSubscriptionListings as $listing):

                LogNonSubscriberListingPayment($paymentLogObj->id, $listing, false);

            endforeach;

            $payment_success = false;
            $payment_message = getPaymentMessage("fail", $result->message);

        endif;

    else:

        $payment_message = getPaymentMessage("fail", $result_payment_method->_attributes['message']);
        $payment_success = false;

    endif;

	endif;