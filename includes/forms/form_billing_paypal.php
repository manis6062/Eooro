<?

//Add and claim listing solution
$_SESSION['payment_method_nonce'] ? $_POST['payment_method_nonce'] = $_SESSION['payment_method_nonce'] : null;
$_SESSION['listing_id'] ? $_POST[ 'listing_id'] = $_SESSION['listing_id'] : null;
unset($_SESSION['payment_method_nonce']);
unset($_SESSION['listing_id']);

?>

<div id="spinner" align="center" style="margin-left:555px;position: absolute;">
	<i class="fa fa-circle-o-notch fa-spin cus-spin" style="color:#FF004F;margin-top:50px;font-size:70pt;"></i><br>
	<h2 style="color:#000;font-size:17px;"> Please Wait...</h2>
</div>

<form id="form" method="post" action="<?=DEFAULT_URL?>/sponsors/billing/processpayment.php?payment_method=paypal">

	<input type="hidden" id="nonce" name="nonce" value="<?=$_POST['payment_method_nonce']?>" />

	<!-- Listings -->

	<?if($_POST['listing_id']):?>
		<?foreach ($_POST['listing_id'] as $key => $value):?>
			<input type="hidden" name="listing_id[]" value="<?=$value?>">
		<?endforeach;?>
	<?endif;?>

	<!-- Cases -->

	<?if($_POST['case_id']):?>
		<?foreach ($_POST['case_id'] as $key => $value): ?>
			<input type="hidden" name="case_id[]" value="<?=$value?>">
		<?endforeach;?>
	<?endif;?>

	<input type="hidden" name="second_step" value="true" />
        <input type="hidden" name="list_id" value="<?php echo $_SESSION['list_id']; ?>" />
	<input type="hidden" name="payment_method" value="paypal" />

</form>
<script>
	$('#form').submit();
</script>