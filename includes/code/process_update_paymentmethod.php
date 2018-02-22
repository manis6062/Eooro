
<?php 
include_once('../../conf/loadconfig.inc.php');
require_once EDIRECTORY_ROOT.'/braintree/braintree-php/lib/Braintree.php';
require_once EDIRECTORY_ROOT.'/braintree/_environment.php';
?>
<!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">-->
<link href="<?php echo DEFAULT_URL;  ?>/custom/domain_1/theme/review/css/style.css" rel="stylesheet">
<script src="https://js.braintreegateway.com/v2/braintree.js"></script>

<?php
	$listing_id = $_POST['listing_id']; 
	$listingObj = new Listing($listing_id);

	$account_id = sess_getAccountIdFromSession();
	if(!$listingObj || $listingObj->account_id != $account_id) {
		$_SESSION['err'] = '1';
    	header("Location: ".DEFAULT_URL."/sponsors/");
	}

	$paymentMethodToken = $listingObj->custom_text5;
	$customer_id = $listingObj->custom_text4;
	$subscription_id = $listingObj->custom_text2;

	if($_POST['payment_method_nonce']) { //for paypal

		$nonce = $_POST['payment_method_nonce'];

		try {
			$result_payment_method = Braintree_PaymentMethod::create([
			    'customerId' 		 => $customer_id,
			    'paymentMethodNonce' => $nonce
			]);
		} catch (Exception $e) {
			$_SESSION['err'] = '2';
	    	header("Location: ".DEFAULT_URL."/sponsors/");
		    exit;			
		}

		$token = $result_payment_method->paymentMethod->_attributes['token'];

		try {
			$result = Braintree_Subscription::update($subscription_id, [
			    'paymentMethodToken' => $token,
			]);
		} catch (Exception $e) {
			$_SESSION['err'] = '2';
	    	header("Location: ".DEFAULT_URL."/sponsors/");
		    exit;			
		}

		$subscription = $result->subscription; // for log

        $listingObj->custom_text5 = $result->subscription->_attributes['paymentMethodToken'];
		$listingObj->save();

	} else { //for creditcard
       	    $verfiy3DSecure = true;
		    try {
		      $clientToken = Braintree_ClientToken::generate();
		    } catch (Exception $e) {
			$_SESSION['err'] = '2';
		    header('Location: '.DEFAULT_URL . "/" . MEMBERS_ALIAS);
		    exit;
		    }

			$getPaymentMethod = Braintree_PaymentMethod::find($paymentMethodToken);
	        $nonce            = $getPaymentMethod->paymentMethodNonce->nonce;
			$payment_type     = explode('_', get_class($getPaymentMethod));
			$payment_type     = $payment_type[1];

			if($payment_type == 'PayPalAccount') {
			try { 
			$updateResult = Braintree_Customer::update(
			    $customer_id,
				[ 			
				// TODO: Billing information hasnot been passed and 3D secure is not checked //				  
		    	  	'creditCard' => [
	        	    'cardholderName' =>  mysql_real_escape_string($_POST['firstName'] . " " . $_POST['lastName'] ),
	            	'number' => mysql_real_escape_string($_POST['num']),
	              	'expirationDate' => mysql_real_escape_string(makeExpDate($_POST['expdate_year'], $_POST['expdate_month'])),
	              	'cvv' => mysql_real_escape_string($_POST['cvv2Number'])]
				]);
		    } catch (Exception $e) {
				$_SESSION['err'] = '2';
			    header('Location: '.DEFAULT_URL . "/sponsors/");
			    exit;
		    }

		    if($updateResult->success != true) { //in case of wrong card details
				$_SESSION['err'] = '2';
			    header('Location: '.DEFAULT_URL . "/sponsors/");
			    exit;		    	
		    }

		if($updateResult->success == true) {
			$token 	  = $updateResult->customer->creditCards[0]->token;
			$getNonce = Braintree_PaymentMethodNonce::create($token);
	        $nonce    = $getNonce->paymentMethodNonce->nonce;
		}
		else { 
			// TODO //
		}

		try {
			$result = Braintree_Subscription::update($subscription_id, [
			    'paymentMethodToken' => $token,
			]);
		    } catch (Exception $e) {
				$_SESSION['err'] = '2';
			    header('Location: '.DEFAULT_URL . "/sponsors/");
			    exit;
		    }

			$subscription = $result->subscription; // for log

		if($result->success == true) {
		    $listingObj->custom_text5 = $result->subscription->_attributes['paymentMethodToken'];
			$listingObj->save();
		}

	} else {

		?>
	    <script>
		    var client = new braintree.api.Client({
		      clientToken: "<?=$clientToken?>"
		    });
		    
		    client.verify3DS({
		       creditCard: "<?=$nonce?>"
		    }, function (error, response) {
		    if (!error) { 
		    	<?php 
		    	try {
				$result = Braintree_PaymentMethod::update(
				  $paymentMethodToken,
				  [
				    'billingAddress' => [
		                'postalCode' => $_POST['zip'],
		                'streetAddress' => $_POST['address1'],
		        	'options' => [
			            'updateExisting' => true ]
		            ],

		    	    'cardholderName' =>  mysql_real_escape_string($_POST['firstName'] . " " . $_POST['lastName'] ),
		        	'number' => mysql_real_escape_string($_POST['num']),
		          	'expirationDate' => mysql_real_escape_string(makeExpDate($_POST['expdate_year'], $_POST['expdate_month'])),
		          	'cvv' => mysql_real_escape_string($_POST['cvv2Number'])
				]); 
		    } catch (Exception $e) {
				$_SESSION['err'] = '2';
			    header('Location: '.DEFAULT_URL . "/sponsors/");
			    exit;
		    }

		    if($result->success != true) {
				$_SESSION['err'] = '2';
			    header('Location: '.DEFAULT_URL . "/sponsors/");
			    exit;		    	
		    }

				?>
		     } else {
		       <?//3d secure failed ?>
		       window.location = '<?=DEFAULT_URL."/sponsors/"?>';
		     }
		    });
		</script>

    <?php
		$subscription = $result->paymentMethod->_attributes['subscriptions'][0];
}

	}
	if($result->success == true) {

		setting_get("sitemgr_email",$sitemgr_email);

	    if ($emailNotificationObj = system_checkEmail(55)) {
	    	$contactObj			  = new Contact($account_id);
	        $email                = $contactObj->email;
	        $subject              = $emailNotificationObj->subject;
	        $body                 = $emailNotificationObj->body;
	        $detailLink           = LISTING_DEFAULT_URL."/".$listingObj->friendly_url;

	        if($contactObj){
	            $body             = str_replace("FIRSTNAME",ucfirst($contactObj->first_name), $body);
	            $body             = str_replace("LASTNAME",ucfirst($contactObj->last_name), $body);
	        } else {
	            $body             = str_replace("FIRSTNAME","", $body);
	        }
	        $body                 = str_replace("LISTING_NAME",$listingObj->title, $body);
	        $body                 = str_replace("LISTING_URL",$detailLink, $body);
	        system_mail($contactObj->getString("email"), $subject, $body, EDIRECTORY_TITLE." <$sitemgr_email>", $emailNotificationObj->getString("content_type"), "", $emailNotificationObj->getString("bcc"), $error, "", "", "", $listing_id, $contactObj->account_id, 55, $listingObj->custom_text2, 'payment method update');		
		}
	}

    Braintree_NotificationLog::save(false, $subscription, $customer_id, 'payment method update');
	?> 
<?php include(MEMBERS_EDIRECTORY_ROOT."/layout/header.php"); ?>
	<div id="spinner" align="center" style="margin-left:475px;position:absolute;">
	    <i class="fa fa-circle-o-notch fa-spin" style="color:#FF004F;margin-top:175px;font-size:100pt;"></i><br>
	    <h2 style="color:#000;font-size:17px;"> 
	    Please wait while we update your payment method,<br> 
	    we will also send you an email to confirm this.</h2>
	</div>

 

<style type="text/css">
	h2.reviewPop{
		overflow: hidden;
		font-size: 16px;
	}

</style>

<script>
    window.setTimeout(function(){
        window.location.href = "<?=DEFAULT_URL . '/' . MEMBERS_ALIAS . '/'?>";
    }, 10000);
</script>

