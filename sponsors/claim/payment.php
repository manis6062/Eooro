<?
/* ==================================================================*\
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
  \*================================================================== */

# ----------------------------------------------------------------------------------------------------
# * FILE: /members/claim/payment.php
# ----------------------------------------------------------------------------------------------------
# ----------------------------------------------------------------------------------------------------
# LOAD CONFIG
# ----------------------------------------------------------------------------------------------------
include("../../conf/loadconfig.inc.php");

# ----------------------------------------------------------------------------------------------------
# AUX
# ----------------------------------------------------------------------------------------------------
extract($_GET);
extract($_POST);

# ----------------------------------------------------------------------------------------------------
# SESSION
# ----------------------------------------------------------------------------------------------------
sess_validateSession();
$acctId = sess_getAccountIdFromSession();
$url_redirect = "" . DEFAULT_URL . "/" . MEMBERS_ALIAS . "/claim";
$url_base = "" . DEFAULT_URL . "/" . MEMBERS_ALIAS . "";
$members = 1;

# ----------------------------------------------------------------------------------------------------
# VALIDATE FEATURE
# ----------------------------------------------------------------------------------------------------
if (CLAIM_FEATURE != "on") {
    exit;
}
if (PAYMENT_FEATURE != "on") {
    exit;
}
if ((CREDITCARDPAYMENT_FEATURE != "on") && (INVOICEPAYMENT_FEATURE != "on")) {
    exit;
}
if (!$claimlistingid) {
    header("Location: " . DEFAULT_URL . "/" . MEMBERS_ALIAS . "/");
    exit;
}
$listingObject = new Listing($claimlistingid);
if (!$listingObject->getNumber("id") || ($listingObject->getNumber("id") <= 0)) {
    header("Location: " . DEFAULT_URL . "/" . MEMBERS_ALIAS . "/");
    exit;
}
if ($listingObject->getNumber("account_id") != $acctId) {
    header("Location: " . DEFAULT_URL . "/" . MEMBERS_ALIAS . "/");
    exit;
}

$db = db_getDBObject(DEFAULT_DB, true);
$dbObjClaim = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $db);
$sqlClaim = "SELECT id FROM Claim WHERE account_id = '" . $acctId . "' AND listing_id = '" . $claimlistingid . "' AND status = 'progress' AND step = 'd' ORDER BY date_time DESC LIMIT 1";
$resultClaim = $dbObjClaim->query($sqlClaim);
if ($rowClaim = mysql_fetch_assoc($resultClaim))
    $claimID = $rowClaim["id"];
if ($claimID) {
    $claimObject = new Claim($claimID);
    if (!$claimObject->getNumber("id") || ($claimObject->getNumber("id") <= 0)) {
        header("Location: " . DEFAULT_URL . "/" . MEMBERS_ALIAS . "/");
        exit;
    }
}


# ----------------------------------------------------------------------------------------------------
# CODE
# ----------------------------------------------------------------------------------------------------
$listing_id[] = $listingObject->getNumber("id");
$second_step = 1;
include(INCLUDES_DIR . "/code/billing.php");
if ($bill_info["listings"])
    foreach ($bill_info["listings"] as $id => $info)
        ;

setting_get("payment_tax_status", $payment_tax_status);
setting_get("payment_tax_value", $payment_tax_value);
customtext_get("payment_tax_label", $payment_tax_label);

# ----------------------------------------------------------------------------------------------------
# HEADER
# ----------------------------------------------------------------------------------------------------
include(MEMBERS_EDIRECTORY_ROOT . "/layout/header.php");

require(EDIRECTORY_ROOT . "/" . SITEMGR_ALIAS . "/registration.php");
require(EDIRECTORY_ROOT . "/includes/code/checkregistration.php");
require(EDIRECTORY_ROOT . "/frontend/checkregbin.php");
?>

<div <?= (EDIR_THEME === 'review') ? 'class="container"' : '' ?>>

<?
$payment_process = "claim";

if (file_exists(INCLUDES_DIR . "/forms/form_billing_" . $payment_method . ".php")) {
    include(INCLUDES_DIR . "/forms/form_billing_" . $payment_method . ".php");
}
?>



</div>

<?
# ----------------------------------------------------------------------------------------------------
# FOOTER
# ----------------------------------------------------------------------------------------------------
include(MEMBERS_EDIRECTORY_ROOT . "/layout/footer.php");
?>
