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
# * FILE: /members/transactions/index.php
# ----------------------------------------------------------------------------------------------------
# ----------------------------------------------------------------------------------------------------
# LOAD CONFIG
# ----------------------------------------------------------------------------------------------------
include("../../conf/loadconfig.inc.php");

# ----------------------------------------------------------------------------------------------------
# VALIDATE FEATURE
# ----------------------------------------------------------------------------------------------------
if (PAYMENT_FEATURE != "on") {
    exit;
}
if ((CREDITCARDPAYMENT_FEATURE != "on") && (MANUALPAYMENT_FEATURE != "on") && (INVOICEPAYMENT_FEATURE != "on")) {
    exit;
}

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

# ----------------------------------------------------------------------------------------------------
# CODE
# ----------------------------------------------------------------------------------------------------
$url_redirect = "" . DEFAULT_URL . "/" . MEMBERS_ALIAS . "/transactions";
$url_base = "" . DEFAULT_URL . "/" . MEMBERS_ALIAS . "";

//TRANSACTIONS
$listing_id = $_GET['itemid'];
$sql_where[] = " account_id = $acctId ";
$sql_where[] = " hidden = 'n' ";
$sql_where[] = " listing_id = $listing_id ";

$where .= " " . implode(" AND ", $sql_where) . " ";
$pageObj = new pageBrowsing("Payment_Log", $screen, false, "transaction_datetime DESC, id DESC", "", "", $where);
$transactions = $pageObj->retrievePage("array");

//INVOICES
if (INVOICEPAYMENT_FEATURE == "on") {
    $invoiceStatusObj = new InvoiceStatus();
    unset($sql_where);
    unset($where);
    $sql_where[] = " hidden = 'n' ";
    if ($acctId) {
        $sql_where[] = " account_id = $acctId ";
    }
    if ($invoiceStatusObj->getDefault()) {
        $sql_where[] = " status != '" . $invoiceStatusObj->getDefault() . "' ";
    }
    if ($sql_where) {
        $where .= " " . implode(" AND ", $sql_where) . " ";
    }
    $pageObj = new pageBrowsing("Invoice", $screen, false, "date DESC", "", "", $where);
    $invoices = $pageObj->retrievePage("array");
}

# ----------------------------------------------------------------------------------------------------
# HEADER
# ----------------------------------------------------------------------------------------------------
if (!$_SERVER['HTTP_X_REQUESTED_WITH']) {
    include(MEMBERS_EDIRECTORY_ROOT . "/layout/header.php");
}
?>
<? if (!$_SERVER['HTTP_X_REQUESTED_WITH']) { ?>
    <section class="latest-review">
        <div class="<?= (EDIR_THEME === 'review') ? 'container' : '' ?>">
        <? } ?>

        <?
        require(EDIRECTORY_ROOT . "/" . SITEMGR_ALIAS . "/registration.php");
        require(EDIRECTORY_ROOT . "/includes/code/checkregistration.php");
        require(EDIRECTORY_ROOT . "/frontend/checkregbin.php");

        if ($transactions || $invoices) {
            include(INCLUDES_DIR . "/tables/table_transaction_members.php");
        } else {
            ?>
            <p class="informationMessage"><?= system_showText(LANG_MSG_NO_TRANSACTIONS_IN_THE_SYSTEM) ?></p>
        <? } ?>

        <? if (!$_SERVER['HTTP_X_REQUESTED_WITH']) { ?>
        </div>
    </section>
<? } ?>
<script>
    function showTransaction(id) {
        showspinner();
        $('#dashboard').load('<?= $url_redirect ?>/view.php?id=' + id, function () {
            hidespinner();
        });
    }
</script>
<?
# ----------------------------------------------------------------------------------------------------
# FOOTER
# ----------------------------------------------------------------------------------------------------
if (!$_SERVER['HTTP_X_REQUESTED_WITH']) {
    include(MEMBERS_EDIRECTORY_ROOT . "/layout/footer.php");
}
?>
