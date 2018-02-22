<?php
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
# * FILE: /members/claim/billing.php
# ----------------------------------------------------------------------------------------------------
# ----------------------------------------------------------------------------------------------------
# LOAD CONFIG
# ----------------------------------------------------------------------------------------------------
include("../../conf/loadconfig.inc.php");
require_once EDIRECTORY_ROOT . '/braintree/braintree-php/lib/Braintree.php';
require_once EDIRECTORY_ROOT . '/braintree/_environment.php';

$clientToken = Braintree_ClientToken::generate();


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
if ((CREDITCARDPAYMENT_FEATURE != "on") && (INVOICEPAYMENT_FEATURE != "on") && (MANUALPAYMENT_FEATURE) != "on") {
    exit;
}

if (!$claimlistingid) {
    header("Location: " . DEFAULT_URL . "/" . MEMBERS_ALIAS . "/");
    exit;
}
$listingObject = new Listing($claimlistingid);
$listingObject->status == "P" ? $listingObject = new ListingPending($claimlistingid) : null;

if (!$listingObject->getNumber("id") || ($listingObject->getNumber("id") <= 0)) {
    header("Location: " . DEFAULT_URL . "/" . MEMBERS_ALIAS . "/");
    exit;
}
if ($listingObject->getNumber("account_id") != $acctId) {
    header("Location: " . DEFAULT_URL . "/" . MEMBERS_ALIAS . "/");
    exit;
}


DBQuery::execute(function() use ($acctId, $claimlistingid) {
    $domain = DBConnection::getInstance()->getDomain();

    $sqlClaim = $domain->prepare("SELECT id FROM Claim WHERE account_id = :account_id AND listing_id = :listing_id ORDER BY date_time DESC LIMIT 1");
    $sqlClaim->bindParam(':account_id', $acctId);
    $sqlClaim->bindParam(':listing_id', $claimlistingid);
    $sqlClaim->execute();
    if ($rowClaim = $sqlClaim->fetch(\PDO::FETCH_ASSOC))
        $claimID = $rowClaim["id"];

    //Conflict with add listing page, now fixed
    if ($claimID) {
        $claimObject = new Claim($claimID);
        if (!$claimObject->getNumber("id") || ($claimObject->getNumber("id") <= 0)) {
            header("Location: " . DEFAULT_URL . "/" . MEMBERS_ALIAS . "/");
            exit;
        }
    }
});

# -----------------------------------------------------------------------------------------------------
# MULTIPLE CURRENCIES
# -----------------------------------------------------------------------------------------------------

DBQuery::execute(function() {
    $main = DBConnection::getInstance()->getMain();
    //GeoIP based currency, 
    //$price is coming from includes/code/billing.php
    $currency = $price;

    $account = new Account(sess_getAccountIdFromSession());
    $currency['currency'] = $account->prefered_currency;
    $currency['symbol'] = $account->currency_symbol;

    //Extract currencies and their name
    $sql = $main->prepare("SELECT currency, symbol as currency_name FROM Location_1 order by id desc");
    $sql->execute();
    //$result = $dbMain->query($sql);
    while ($row = $sql->fetch(\PDO::FETCH_ASSOC)) {
        $values[] = $row;
    }

    foreach ($values as $key => $value) {
        $currencies[$value['currency']] = $value['currency_name'];
    }
});

# ----------------------------------------------------------------------------------------------------
# SUBMIT
# ----------------------------------------------------------------------------------------------------
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if ($claimObject) {
        $claimObject->setString("step", "d");
        $claimObject->save();
    }

    if ($payment_method == "invoice") {
        header("Location: " . $url_redirect . "/invoice.php?claimlistingid=" . $claimlistingid);
    }
    /**
     * SagePay Modification
     * If use wishes to pay at once, the post data is lost once the page 
     * redirects. 
     * So, we save the data in session. So that it can be retrieved later.
     * It is retrieved in "getData" method in "paymentprocess" model.
     */ elseif ($_POST['BillingCountry']) {
        $idd = sess_getAccountIdFromSession();
        $postt = array();
        foreach ($_POST as $key => $value) {
            preg_match('#^Billing[a-zA-Z0-5]+#', $key, $matches);
            if ($matches[0]) {
                $postt[$matches[0]] = $value;
            }
        }
        $_POST['payment_method_nonce'] ? $_SESSION['payment_method_nonce'] = $_POST['payment_method_nonce'] : null;
        $_POST['listing_id'] ? $_SESSION['listing_id'] = $_POST['listing_id'] : null;
        $_SESSION['user_' . $idd] = system_array2nvp($postt);
        header("Location: " . $url_redirect . "/payment.php?payment_method=" . $payment_method . "&claimlistingid=" . $claimlistingid);
    } else {
        header("Location: " . $url_redirect . "/payment.php?payment_method=" . $payment_method . "&claimlistingid=" . $claimlistingid);
    }
    exit;
}

# ----------------------------------------------------------------------------------------------------
# CODE
# ----------------------------------------------------------------------------------------------------
$listing_id[] = $listingObject->getNumber("id");
$second_step = 1;
$payment_method = "claim";

setting_get("payment_tax_status", $payment_tax_status);
setting_get("payment_tax_value", $payment_tax_value);
customtext_get("payment_tax_label", $payment_tax_label);

include(INCLUDES_DIR . "/code/billing.php");

# ----------------------------------------------------------------------------------------------------
# HEADER
# ----------------------------------------------------------------------------------------------------
include(MEMBERS_EDIRECTORY_ROOT . "/layout/header.php");

require(EDIRECTORY_ROOT . "/" . SITEMGR_ALIAS . "/registration.php");
require(EDIRECTORY_ROOT . "/includes/code/checkregistration.php");
require(EDIRECTORY_ROOT . "/frontend/checkregbin.php");
?>

<form id="form" name="claimbilling" action="<?= system_getFormAction($_SERVER["PHP_SELF"]) ?>" method="post">
    <input type="hidden" name="claimlistingid" value="<?= $claimlistingid ?>" />
    <div class="container">
        <div class="row-fluid">
<?php include(INCLUDES_DIR . "/tables/table_billing_first_step.php"); ?>
        </div>
    </div>
</div>
</form>

<?php
# ----------------------------------------------------------------------------------------------------
# FOOTER
# ----------------------------------------------------------------------------------------------------
include(MEMBERS_EDIRECTORY_ROOT . "/layout/footer.php");
?>