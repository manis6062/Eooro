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
	# * FILE: /members/billing/index.php
	# ----------------------------------------------------------------------------------------------------
	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");
	include_once EDIRECTORY_ROOT . '/custom/domain_1/theme/review/common_functions.php';
	require_once EDIRECTORY_ROOT.'/braintree/braintree-php/lib/Braintree.php';
	require_once EDIRECTORY_ROOT.'/braintree/_environment.php';
	
	try {
		$clientToken = Braintree_ClientToken::generate();		
	} catch (Exception $e) {
		include_once(INCLUDES_DIR."/views/view_paymentsystem_notactive.php");
		die;
	}

	if(!$_SERVER['HTTP_X_REQUESTED_WITH']){
	    header("Location:".DEFAULT_URL."/".ALIAS_LISTING_MODULE."/");
	    exit;
	}	
	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (PAYMENT_FEATURE != "on") { exit; }
	if ((CREDITCARDPAYMENT_FEATURE != "on") && (INVOICEPAYMENT_FEATURE != "on")) { exit; }

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSession();
	$acctId = sess_getAccountIdFromSession();
	$url_redirect = "".DEFAULT_URL."/".MEMBERS_ALIAS."/billing";
	$url_base = "".DEFAULT_URL."/".MEMBERS_ALIAS."";

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	include(INCLUDES_DIR."/code/billing.php");

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	if(!$_SERVER['HTTP_X_REQUESTED_WITH']){
		include(MEMBERS_EDIRECTORY_ROOT."/layout/header.php");
	}
	
	# ----------------------------------------------------------------------------------------------------
	# NAVBAR
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/navbar.php");

?>
	<?if(!$_SERVER['HTTP_X_REQUESTED_WITH']){ ?>	
    	<?=(EDIR_THEME=='review') ? '<div class="container">' : ''?>
    <? } ?>	
	<div class="row-fluid">
		<? require(EDIRECTORY_ROOT."/".SITEMGR_ALIAS."/registration.php"); ?>
		<? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
		<? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>
		
		<form id="form" style="margin-top:5px;" name="" method="post" action="<?
		
			if(SSL_ENABLED == "on" && MEMBERS_BILL_LOGIN_SSL =="on" ){
				echo SECURE_URL."/sponsors/billing/pay.php";
			} else {
				echo NON_SECURE_URL."/sponsors/billing/pay.php"; 
			}
			?>">

			<? include(INCLUDES_DIR."/tables/table_billing_first_step.php"); ?>
		</form>
	</div>
		<?if(!$_SERVER['HTTP_X_REQUESTED_WITH']){ ?>	
        	<?=(EDIR_THEME=='review') ? '</div>' : ''?>
        <? } ?>
<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	if(!$_SERVER['HTTP_X_REQUESTED_WITH']){
		include(MEMBERS_EDIRECTORY_ROOT."/layout/footer.php");
	}
?>
