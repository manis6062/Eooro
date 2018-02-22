<?php  

class Braintree_NotificationLog {

	public static function save($webhookNotification, $subscription, $customer_id = false, $source) { //for manualpay customer_id is passed as parameter

    $billingPeriodEndDate = $subscription->_attributes['billingPeriodEndDate'];
     

    if($source) {
        $planId                       = $subscription->_attributes['planId'];
        $balance                      = $subscription->_attributes['balance'];
        $daysPastDue                  = $subscription->_attributes['daysPastDue'];
        $createdAt                    = self::parseDate($subscription->_attributes['createdAt']);
        $updatedAt                    = self::parseDate($subscription->_attributes['updatedAt']);
        $firstBillingDate             = self::parseDate($subscription->_attributes['firstBillingDate']);
        $subscription_id              = $subscription->_attributes['id'];
        $nextBillAmount               = $subscription->_attributes['nextBillAmount'];
        $status                       = $subscription->_attributes['status'];
        $failureCount                 = $subscription->_attributes['failureCount'];
        $merchantAccountId            = $subscription->_attributes['merchantAccountId'];
        $neverExpires                 = $subscription->_attributes['neverExpires'];
        $nextBillingPeriodAmount      = $subscription->_attributes['nextBillingPeriodAmount'];
        $paymentMethodToken           = $subscription->_attributes['paymentMethodToken'];
        $price                        = $subscription->_attributes['price'];
        $trialDuration                = $subscription->_attributes['trialDuration'];
        $trialDurationUnit            = $subscription->_attributes['trialDurationUnit'];
        $trialPeriod                  = $subscription->_attributes['trialPeriod'];
        $customerName                 = $subscription->_attributes['descriptor']->_attributes['name'];

        $customerName   = mysql_real_escape_string(htmlentities($customerName));

        $logs = serialize($subscription);
        $db = db_getDBObject(DEFAULT_DB, true);
        $q =    "INSERT INTO transaction_log( logDate, time, customer_id, notification_type,
                planId,                      balance,               daysPastDue,       billingPeriodEndDate,
                billingPeriodStartDate,      firstBillingDate,      subscription_id,   nextBillAmount,
                status,                      failureCount,          merchantAccountId, neverExpires,
                nextBillingPeriodAmount,     paymentMethodToken,    price,
                trialDuration,               trialDurationUnit,     trialPeriod,       
                customerFirstName,           updated,                src
                ) 
                values( NOW(),               '$createdAt',           '$customer_id',       '$source',
                '$planId',                   '$balance',             '$daysPastDue',       '$billingPeriodEndDate',
                '$billingPeriodStartDate',   '$firstBillingDate',    '$subscription_id',   '$nextBillAmount',
                '$status',                   '$failureCount',        '$merchantAccountId', '$neverExpires',
                '$nextBillingPeriodAmount',  '$paymentMethodToken',  '$price',
                '$trialDuration',            '$trialDurationUnit',   '$trialPeriod',       
                '$customerName',             '$updatedAt',           '" . mysql_real_escape_string($logs) . "')"; 

    }
    elseif($billingPeriodEndDate) {

        $notification_type            = $webhookNotification->kind;
        $timestamp                    = self::parseDate($webhookNotification->timestamp);
        $subscription_id              = $webhookNotification->subscription->id;  
        $customer_id                  = $subscription->transactions[0]->_attributes['customer']['id'];  
        $planId                       = $subscription->_attributes['planId'];
        $balance                      = $subscription->_attributes['balance'];
        $daysPastDue                  = $subscription->_attributes['daysPastDue'];
        $billingPeriodEndDate         = self::parseDate($subscription->_attributes['billingPeriodEndDate']);
        $billingPeriodStartDate       = self::parseDate($subscription->_attributes['billingPeriodStartDate']);
        $firstBillingDate             = self::parseDate($subscription->_attributes['firstBillingDate']);
        $nextBillAmount               = $subscription->_attributes['nextBillAmount'];
        $status                       = $subscription->_attributes['status'];
        $failureCount                 = $subscription->_attributes['failureCount'];
        $merchantAccountId            = $subscription->_attributes['merchantAccountId'];
        $neverExpires                 = $subscription->_attributes['neverExpires'];
        $nextBillingPeriodAmount      = $subscription->_attributes['nextBillingPeriodAmount'];
        $paymentMethodToken           = $subscription->_attributes['paymentMethodToken'];
        $price                        = $subscription->_attributes['price'];
        $trialDuration                = $subscription->_attributes['trialDuration'];
        $trialDurationUnit            = $subscription->_attributes['trialDurationUnit'];
        $trialPeriod                  = $subscription->_attributes['trialPeriod'];
        $processorResponseText        = $subscription->_attributes['transactions'][0]->_attributes['processorResponseText'];
        $additionalProcessorResponse  = $subscription->_attributes['transactions'][0]->_attributes['additionalProcessorResponse'];
        $processorResponseCode        = $subscription->_attributes['transactions'][0]->_attributes['processorResponseCode'];
        $transactionsId               = $subscription->_attributes['transactions'][0]->_attributes['id'];
        $billingId                    = $subscription->_attributes['transactions'][0]->_attributes['billing']['id'];
        $transactionSource            = $subscription->_attributes['transactions'][0]->_attributes['statusHistory'][0]->_attributes['transactionSource'];
        $recurringNumber              = $subscription->_attributes['transactions'][0]->_attributes['recurring'];
        $paymentInstrumentType        = $subscription->_attributes['transactions'][0]->_attributes['paymentInstrumentType'];
        $customerFirstName            = $subscription->_attributes['transactions'][0]->_attributes['customer']['firstName'];
        $customerLastName             = $subscription->_attributes['transactions'][0]->_attributes['customer']['lastName'];

        $customerFirstName   = mysql_real_escape_string(htmlentities($customerFirstName));
        $customerLastName   = mysql_real_escape_string(htmlentities($customerLastName));

        $logs = serialize($subscription);
        $db = db_getDBObject(DEFAULT_DB, true);
        $q =    "INSERT INTO transaction_log( logDate,
                notification_type,           time,                  subscription_id,   customer_id,
                planId,                      balance,               daysPastDue,       billingPeriodEndDate,
                billingPeriodStartDate,      firstBillingDate,      nextBillAmount,
                status,                      failureCount,          merchantAccountId, neverExpires,
                nextBillingPeriodAmount,     paymentMethodToken,    price,
                trialDuration,               trialDurationUnit,     trialPeriod,       processorResponseText,
                additionalProcessorResponse, processorResponseCode, transactionsId,
                billingId,                   transactionSource,     recurringNumber,   paymentInstrumentType,
                customerFirstName,           customerLastName,      src
                ) 

                values( NOW(),
                '$notification_type',            '$timestamp',              '$subscription_id',   '$customer_id',
                '$planId',                       '$balance',                '$daysPastDue',       '$billingPeriodEndDate',
                '$billingPeriodStartDate',       '$firstBillingDate',       '$nextBillAmount',
                '$status',                       '$failureCount',           '$merchantAccountId', '$neverExpires',
                '$nextBillingPeriodAmount',      '$paymentMethodToken',     '$price',
                '$trialDuration',                '$trialDurationUnit',      '$trialPeriod',       '$processorResponseText',
                '$additionalProcessorResponse',  '$processorResponseCode',  '$transactionsId',
                '$billingId',                    '$transactionSource',      '$recurringNumber',   '$paymentInstrumentType',
                '$customerFirstName',            '$customerLastName',       '" . mysql_real_escape_string($logs) . "')";


        }
        else {
        $notification_type            = $webhookNotification->kind;
        $timestamp                    = self::parseDate($webhookNotification->timestamp);
        $subscription_id              = $webhookNotification->subscription->id;  
        $planId                       = $subscription->_attributes['planId'];
        $balance                      = $subscription->_attributes['balance'];
        $daysPastDue                  = $subscription->_attributes['daysPastDue'];
        $firstBillingDate             = self::parseDate($subscription->_attributes['firstBillingDate']);
        $nextBillAmount               = $subscription->_attributes['nextBillAmount'];
        $status                       = $subscription->_attributes['status'];
        $failureCount                 = $subscription->_attributes['failureCount'];
        $merchantAccountId            = $subscription->_attributes['merchantAccountId'];
        $neverExpires                 = $subscription->_attributes['neverExpires'];
        $nextBillingPeriodAmount      = $subscription->_attributes['nextBillingPeriodAmount'];
        $paymentMethodToken           = $subscription->_attributes['paymentMethodToken'];
        $price                        = $subscription->_attributes['price'];
        $trialDuration                = $subscription->_attributes['trialDuration'];
        $trialDurationUnit            = $subscription->_attributes['trialDurationUnit'];
        $trialPeriod                  = $subscription->_attributes['trialPeriod'];

        $logs = serialize($subscription);
        $db = db_getDBObject(DEFAULT_DB, true);
        $q =    "INSERT INTO transaction_log( logDate,
                notification_type,           time,                  subscription_id,   
                planId,                      balance,               daysPastDue,       billingPeriodEndDate,
                billingPeriodStartDate,      firstBillingDate,      nextBillAmount,
                status,                      failureCount,          merchantAccountId, neverExpires,
                nextBillingPeriodAmount,     paymentMethodToken,    price,
                trialDuration,               trialDurationUnit,     trialPeriod,                               
                src ) 

                values( NOW(),
                '$notification_type',            '$timestamp',              '$subscription_id',   
                '$planId',                       '$balance',                '$daysPastDue',       '$billingPeriodEndDate',
                '$billingPeriodStartDate',       '$firstBillingDate',       '$nextBillAmount',
                '$status',                       '$failureCount',           '$merchantAccountId', '$neverExpires',
                '$nextBillingPeriodAmount',      '$paymentMethodToken',     '$price',
                '$trialDuration',                '$trialDurationUnit',      '$trialPeriod',       
                '" . mysql_real_escape_string($logs) . "')";
            
        }
         $sucess = $db->query($q);
            if($sucess) 
                return true;
            else 
                return false;
			

	}

    function parseDate($date){
        try{
            $returnDate=$date->format('Y-m-d H:i:s');
        }
        catch(Exception $ex){
            $returnDate= null;
        }
        return $returnDate;
    }
}
 ?>
