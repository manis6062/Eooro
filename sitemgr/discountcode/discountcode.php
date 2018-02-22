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
	# * FILE: /sitemgr/discountcode/discountcode.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (PAYMENT_FEATURE != "on") { header("Location:".DEFAULT_URL."/".SITEMGR_ALIAS."");exit; }
	if ((CREDITCARDPAYMENT_FEATURE != "on") && (INVOICEPAYMENT_FEATURE != "on")) { header("Location:".DEFAULT_URL."/".SITEMGR_ALIAS."");exit; }
	if (PAYMENTSYSTEM_FEATURE != "on") { exit; }

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_GET);
	extract($_POST);
	$url_base = "".DEFAULT_URL."/".SITEMGR_ALIAS."";

	//increases frequently actions
	if (!isset($id)) system_setFreqActions('discountcode_add','PAYMENTSYSTEM_FEATURE');

	//Country specific discount codes
	$dbMain = db_getDBObject(DEFAULT_DB, true);
	$sql 	= "SELECT id, name FROM Location_1 order by id desc";
	$result = $dbMain->query($sql);
	
	while ($row = mysql_fetch_assoc($result)) {
		$results[] = $row;
	}

	foreach ($results as $key => $value) {
		$country[$value['id']] = $value['name'];
	}
	
	include(EDIRECTORY_ROOT."/includes/code/discountcode.php");
	
	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/header.php");

	# ----------------------------------------------------------------------------------------------------
	# NAVBAR
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/navbar.php");
?>

<div id="main-right">
	<div id="top-content">
		<div id="header-content">
			<?
			if($id) 
				$prefix = system_showText(LANG_SITEMGR_EDIT);
			else 
				$prefix = system_showText(LANG_SITEMGR_MENU_ADD);
			?>
			<h1><?=$prefix?> <?=string_ucwords(LANG_LABEL_DISCOUNTCODE)?></h1>
		</div>
	</div>
	<div id="content-content">
	<div class="default-margin">

		<? require(EDIRECTORY_ROOT."/".SITEMGR_ALIAS."/registration.php"); ?>
		<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
		<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

		<? include(INCLUDES_DIR."/tables/table_discount_submenu.php"); ?>
		
			<div class="baseForm">

			<form name="discountcode" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">
				<input type="hidden" name="x_id" value="<?=$x_id?>" />
				<? include(INCLUDES_DIR."/forms/form_discountcode.php"); ?>
				<input type="hidden" name="letter" value="<?=$letter?>" />
				<input type="hidden" name="screen" value="<?=$screen?>" />
				<button  id="submit" type="submit" value="Submit" class="input-button-form"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
				<button type="button" value="Cancel" class="input-button-form" onclick="document.getElementById('formdiscountcodecancel').submit();"><?=system_showText(LANG_SITEMGR_CANCEL)?></button>
			</form>
			<form id="formdiscountcodecancel" action="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/discountcode/index.php" method="post">
				<input type="hidden" name="letter" value="<?=$letter?>" />
				<input type="hidden" name="screen" value="<?=$screen?>" />
			</form>
			
			</div>
		</div>
	</div>
	<p class="msg" style="text-align:center;color:red;"></p>
<div id="bottom-content">
&nbsp;
</div>
</div>

<script language="javascript" type="text/javascript"><!-- document.discountcode.id.focus(); --></script>
<script type="text/javascript">
	$(document).ready(function() {
		//DATE PICKER
		<?
		if ( DEFAULT_DATE_FORMAT == "m/d/Y" ) $date_format = "mm/dd/yy";
		elseif ( DEFAULT_DATE_FORMAT == "d/m/Y" ) $date_format = "dd/mm/yy";
		?>

		$('#expire_date').datepicker({
			dateFormat: '<?=$date_format?>',
			changeMonth: true,
			changeYear: true,
            yearRange: '<?=date("Y")?>:<?=date("Y")+10?>'
		});
    });
</script>

<script>
$('#submit').click(function(e){
	console.log($("#percentage:checked").val());
	if($("#percentage:checked").val() == "percentage" && $('input[name="amount"]').val() >= 100){
		e.preventDefault();
		$('.msg').html('Error!! Percentage must be less than 100.');
	}
});


</script>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>