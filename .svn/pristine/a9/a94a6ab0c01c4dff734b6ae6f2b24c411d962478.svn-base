
<?php   include_once('../../conf/loadconfig.inc.php'); 
 		include(MEMBERS_EDIRECTORY_ROOT."/layout/header.php");
 ?>

 		<div id="spinner" align="center" style="display:none;margin-left:475px;position:absolute;">
		    <i class="fa fa-circle-o-notch fa-spin" style="color:#FF004F;margin-top:175px;font-size:100pt;"></i><br>
		    <h2 style="color:#000;font-size:17px;"> 
		    Please wait while we update your payment method,<br>
		    we will also send you an email to confirm this.</h2>
		</div>

		<form action="<?php echo DEFAULT_URL."/includes/code/process_update_paymentmethod.php"; ?>" method="post" id="braintree-payment-form">
		<div class="clearfix" style="padding: 8px;">
			<input type="hidden" name="listing_id" id="listing_id" value="<?php echo $_GET['listing_id']; ?>">
			
							
			<div id="creditCardForm"  >
				<?php
					$fromUpdatePaymentMethod = true;
					include(INCLUDES_DIR."/forms/form_billing_braintree.php");
				?>
			</div>
		</div>
		</form>
							
		<div id="submitVal" style="margin-top:5px;"></div>

<?php   include(system_getFrontendPath("footer.php", "layout")); ?>

<script src="https://js.braintreegateway.com/v2/braintree.js"></script>

<style type="text/css">
	.col-sm-3.figure{
		margin-top: 0;
	}
	.form-group.rmp {
    margin-bottom: 5px;
    text-align: left;
}
</style>
