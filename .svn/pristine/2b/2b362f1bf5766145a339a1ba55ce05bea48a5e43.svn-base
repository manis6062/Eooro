<?php 

    if(Braintree_NotificationLog::save($webhookNotification, $subscription)) {
        $log = "saved";
    } else 
        $log = "not saved";


        $listing_id = Listing::getListingFromSubscriptionID($subscription_id);
        $listingObj = new Listing($listing_id);

        $account_id = $listingObj->account_id;
        $friendly_url = $listingObj->friendly_url;
        $title = $listingObj->title;


    #################### SEND EMAIL ################################################    
        $contact    = new Contact($account_id);
        $emailNotification_id = 53

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