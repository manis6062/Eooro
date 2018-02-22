<?php

require_once "conf/loadconfig.inc.php";

ini_set('display_errors', 1);
error_reporting(E_ERROR);

require_once EDIRECTORY_ROOT.'/braintree/braintree-php/lib/Braintree.php';
require_once EDIRECTORY_ROOT.'/braintree/_environment.php';
    

/*-----------------------------------------------------------------------------
    Generate Sample Notification
-------------------------------------------------------------------------------

    $sampleNotification = Braintree_WebhookTesting::sampleNotification(
		Braintree_WebhookNotification::SUBSCRIPTION_CHARGED_SUCCESSFULLY,
        '6swfkg'
    );

    extract($sampleNotification);
*/

    extract($_POST);

	if( isset($bt_signature) &&  isset($bt_payload)):
		
		    $webhookNotification = Braintree_WebhookNotification::parse(
		        $bt_signature, $bt_payload
		    );
		    $subscription_id   = $webhookNotification->subscription->id;


		    //Extract data from webhook recieved
		    $notification_type = $webhookNotification->kind;
		    $timestamp         = $webhookNotification->timestamp->format('Y-m-d H:i:s');
		    $subscription_id   = $webhookNotification->subscription->id;
		    try{
			    $subscription 	   = Braintree_Subscription::find($subscription_id);
			    $customer_id  	   = $subscription->transactions[0]->_attributes['customer']['id'];	
			    $planId 		   = $subscription->_attributes['planId'];
			}
			catch (Exception $e){
			    $subscription 	   = "Not available";
			    $customer_id  	   = "Not available";	
			    $planId 		   = "Not available";
			}
			//Write a log file
		    $message =
		        "[Webhook Received " . $timestamp . "] "
		        . "Kind: " . $notification_type . " | "
		        . "Subscription_id: " . $subscription_id . " | "
				. "customer_id: " . $customer_id  . " | "
				. "planId: " . $planId . "\n";

		    file_put_contents("custom/log/braintree/webhook.log", $message, FILE_APPEND);


		switch ($notification_type) {

			case 'subscription_canceled': 

				require_once EDIRECTORY_ROOT.'/braintree/webhook/WebhookNotification_canceled.php';

			break;
						
			case 'subscription_went_active':

				require_once EDIRECTORY_ROOT.'/braintree/webhook/WebhookNotification_went_active.php';

			break;

			case 'subscription_expired':

				require_once EDIRECTORY_ROOT.'/braintree/webhook/WebhookNotification_expired.php';

			break;

			case 'subscription_went_past_due':

				require_once EDIRECTORY_ROOT.'/braintree/webhook/WebhookNotification_went_past_due.php';

			break;

			case 'subscription_charged_successfully':
     			    	
				require_once EDIRECTORY_ROOT.'/braintree/webhook/WebhookNotification_successfull.php';

			break;


			case 'subscription_charged_unsuccessfully':

				require_once EDIRECTORY_ROOT.'/braintree/webhook/WebhookNotification_unsuccessfull.php';

			break;

			default:

				require_once EDIRECTORY_ROOT.'/braintree/webhook/WebhookNotification_Default.php';

			break;

		}
		    
	endif;

	?>
