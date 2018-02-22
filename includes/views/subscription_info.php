<?php  
    include("../../conf/loadconfig.inc.php");

require_once EDIRECTORY_ROOT.'/braintree/braintree-php/lib/Braintree.php';
require_once EDIRECTORY_ROOT.'/braintree/_environment.php';

	$listing_id = $_POST['id'];
	$itemObj = new Listing($listing_id);
	try {
		$clientToken = Braintree_ClientToken::generate(); //clientToken for paypal
	} catch (Exception $e) {
		$payment_message = getPaymentMessage("fail", "Update system has experienced an error.");
		$payment_success = false;
	}

	if(!$itemObj->custom_text5) {
		$_SESSION['err'] = '2';
    	header("Location: ".DEFAULT_URL."/sponsors/");
	    exit;					
	}

	$paymentMethod = Braintree_PaymentMethod::find($itemObj->custom_text5);

	if(!$paymentMethod) {
		$_SESSION['err'] = '2';
    	header("Location: ".DEFAULT_URL."/sponsors/");
	    exit;					
	}

	$subscription  = $paymentMethod->_attributes['subscriptions'][0]->_attributes;
	$payment_type  = explode('_', get_class($paymentMethod));
	$payment_type  = $payment_type[1];

?>

<h2>Subscription Information:</h2>

<div class="col-sm-12">
<div class="row">
<div class="col-xs-6 col-sm-12 col-md-12 col-lg-6">
	<dl class="dl-horizontal dashboard-horizontal">
	    <dt>Subscription created at:</dt>
		<dd><?php echo date('d M Y', strtotime($subscription['createdAt']->format('Y-m-d')));    ?></dd> 
		<dt>Next billing date:</dt>
		<dd><?php echo date('d M Y', strtotime($subscription['nextBillingDate']->format('Y-m-d')));  ?></dd>
		<dt>Next bill amount:</dt>
		<dd><?php echo substr($paymentMethod->_attributes['subscriptions'][0]->_attributes['merchantAccountId'], -3).' '.$subscription['nextBillAmount']; ?></dd>
	</dl>
  
</div>

<div class="col-xs-6 col-sm-12 col-md-12 col-lg-6">
<dl class="dl-horizontal dashboard-horizontal">
    <?php  if($payment_type == "PayPalAccount" ) {
     ?>
		<dt>Payment type:</dt>
		<dd><?php if($payment_type == 'PayPalAccount') echo 'Paypal'; else $payment_type; ?></dd>
	   
	    <dt>Registered email:</dt>
	    <dd><?php echo $paymentMethod->_attributes['email']; ?></dd>

    <?php } else { ?>
  		<dt>Card type:</dt>
	    <dd><?php echo $paymentMethod->_attributes['cardType'];  ?></dd>

	    <dt>Card last 4 digit:</dt>
	    <dd><?php echo '************'.$paymentMethod->_attributes['last4']; ?></dd>
	
        <dt>Expiration Month/Year:</dt>
	    <dd><?php echo $paymentMethod->_attributes['expirationMonth'].'/'.$paymentMethod->_attributes['expirationYear']  ?></dd>

        <dt>Cardholder name:</dt>
	    <dd><?php echo $paymentMethod->_attributes['cardholderName']   ?></dd>
    <?php  } 
 ?>
</dl>
</div>
</div>
</div>
<h2>Update Payment Method</h2>
<div class="text-center">

<div class="paymentWrapper text-center">
	<p>Choose a Payment Method</p>
	<div class="choosePaymentOption clearfix">
			<input type="hidden" name="customer_id" id="customer_id" value="<?php echo $itemObj->custom_text4; ?>">
			<input type="hidden" name="subscription_id" id="subscription_id" value="<?php echo $itemObj->custom_text2; ?>">
			<input type="hidden" name="listing_id" id="listing_id" value="<?php echo $itemObj->id; ?>">
			<div class='radioBilling'>
				<div class="col-xs-6 col-sm-6">
					<div class="row">
						<div class="pull-right">
							<div class="col-sm-12">
								<div id="paypal-container"></div><!--paypal button is embeded here and data is sent by paypal after login in-->
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class='radioBilling' id="pay-<?=$gatewayInfo[0]?>" style="" >
				<div class="col-xs-6 col-sm-6">
					<div class="row">
						<div class="pull-left row">
							<div class="col-sm-12">
								<div id="braintree-container" style="display:inline-block;width:115px;height:44px;overflow:hidden;cursor:pointer;">
									<a id="debitCard" href="<?php echo SECURE_URL.'/includes/forms/update_paymentmethod_form.php';?>?listing_id=<?php echo $itemObj->id; ?>" style="max-width: 100%;display: block; width: 100%; height: 100%; outline: medium none; border: 0px none;">
										<img id="nocardclicked" rel="<?=$gatewayInfo[0]?>" style="display:none;max-width:100%;display: block; width: 100%; height: 100%; outline: medium none; border: 0px none;" src="<?=DEFAULT_URL.'/custom/domain_1/theme/review/images/dc.png'?>"/>
									</a>
								</div>
								<button class="btn btn-default btn-success" type="submit" id="submit" style="margin-top:10px; display:none;">Submit</button>
								<button class="btn btn-danger" id="cancel" style="margin-top:10px; display:none;">Cancel</button>
							</div>
						</div>
					</div>
				</div>
			</div>
			</div>
					</div>
			<div id="submitVal" style="margin-top:5px;"></div>

<div id="spinner" align="center" style="display:none;margin-left:225px;position:absolute;">
   <i class="fa fa-circle-o-notch fa-spin" style="color:#FF004F;margin-top:175px;font-size:100pt;"></i><br>
   <h2 style="color:#000;font-size:17px;"> Please Wait...</h2>
</div>


<style type="text/css">
	.col-sm-3.figure{
		margin-top: 0;
	}
	.form-group.rmp {
    margin-bottom: 5px;
    text-align: left;
}
</style>


	<script src="https://js.braintreegateway.com/v2/braintree.js"></script>
	<script type="text/javascript">
	braintree.setup("<?=$clientToken?>", "paypal", {
	container: "paypal-container",
	onPaymentMethodReceived: function (obj) {
	$('#submit').show();
	$('#cancel').show();
	$('#braintree-container').hide();
	$('#debitCard').hide();
	$('#bt-pp-email').hide();
	$('#bt-pp-cancel').hide();
	$('#braintree-paypal-loggedin').css('border','0px');
	}
	});

	$(document).on('click', '#submit', function(e){
		e.stopPropagation();
		$('#submitVal').empty();
		$('#submitVal').css('display', 'block');
		var nonce = $("input[type='hidden'][name='payment_method_nonce']").val();
	if(!nonce) {
	$('#submitVal').html("<p class='alert alert-danger' id='errorMessage'>Please select a payment method.</p>");
	return false;
	}

	var listing_id      = $('#listing_id').val();

        $( ".dashboard" ).hide();
        $( "#spinner" ).show();
		$.ajax({
			  method: "POST",
			  url: "<?php echo DEFAULT_URL.'/includes/code/process_update_paymentmethod.php'; ?>",
			  data: {listing_id: listing_id, payment_method_nonce: nonce }
			})
			.done(function( msg ) {
		        $( "#spinner" ).hide();
                $( ".dashboard" ).show();
		        //refresh overview
				loadDashboard('Listing', listing_id);
			});

	});

	$(document).on('click', '#cancel', function(e){
		$("input[type='hidden'][name='payment_method_nonce']").removeAttr('value');
		$("#debitCard").show();
		$('#submit').hide();

		var listing_id      = $('#listing_id').val();
		loadDashboard('Listing', listing_id);
	});
	</script>

</div>    

<style type="text/css">
	.dashboard-horizontal dd,
	.dashboard-horizontal dt{
		line-height: 25px;
	}
</style>
	