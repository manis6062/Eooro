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
# * FILE: /members/billing/processpayment.php
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
if (CREDITCARDPAYMENT_FEATURE != "on") {
    exit;
}

# ----------------------------------------------------------------------------------------------------
# AUX
# ----------------------------------------------------------------------------------------------------
if ($_POST['list_id']) {
    $listing_id = $_POST['list_id'];
} else {
    $listing_id = $_POST['listing_id'][0];
}



# ----------------------------------------------------------------------------------------------------
# SESSION
# ----------------------------------------------------------------------------------------------------
sess_validateSession();

$acctId = sess_getAccountIdFromSession();
$url_redirect = "" . DEFAULT_URL . "/" . MEMBERS_ALIAS . "/billing";
$url_base = "" . DEFAULT_URL . "/" . MEMBERS_ALIAS . "";
$payment_method = $_GET['payment_method'];
# ----------------------------------------------------------------------------------------------------
# CODE
# ----------------------------------------------------------------------------------------------------
include(INCLUDES_DIR . "/code/billing_" . $payment_method . ".php");

# ----------------------------------------------------------------------------------------------------
# HEADER
# ----------------------------------------------------------------------------------------------------
include(MEMBERS_EDIRECTORY_ROOT . "/layout/header.php");

# ----------------------------------------------------------------------------------------------------
# NAVBAR
# ----------------------------------------------------------------------------------------------------
include(MEMBERS_EDIRECTORY_ROOT . "/layout/navbar.php");

require(EDIRECTORY_ROOT . "/" . SITEMGR_ALIAS . "/registration.php");
require(EDIRECTORY_ROOT . "/includes/code/checkregistration.php");
require(EDIRECTORY_ROOT . "/frontend/checkregbin.php");
?>
<section class="latest-review">
    <div class="container">
        <div class="col-md-12">

            <!--   Basic Table  -->
            <div class="panel panel-default panel-custom">
                <div class="panel-heading panel-heading-custom" style="text-align:center;">
                    Transaction Status
                </div>

                <? if ($payment_success): ?>

                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-custom">
                                <thead>
                                    <tr>
                                        <th style="text-align:center;">Transaction</th>
                                        <th style="text-align:center;" class="success-text">Success <i class="fa fa-smile-o fa-smile-custom"></i></th>
                                    </tr>
                                </thead>
                                <tbody class="tbody-custom">
                                    <? /*    <tr style="text-align:center;">
                                      <td>Transaction Id</td>
                                      <td><?=$transaction['transaction_id']?></td>
                                      </tr>
                                     */ ?>
                                </tbody>
                            </table>




                            <div class="alert alert-warning alert-custom" style="text-align:center;">
                                Payment transaction may or may not occur immediately.
                            </div>
                            <div class="alert alert-success alert-custom" style="text-align:center;">
                                <?php
                                if (is_array($listing_id)) {
                                    $listing_id = $listing_id[0];
                                }
                                ?>
                                After your payment is processed, information about your transaction may be found in your <a href='<?= DEFAULT_URL . "/" . MEMBERS_ALIAS . "/transactions/index.php?itemid=" . $listing_id; ?>' class="transaction-history">transaction history</a>.
                                <br>
                                You will redirect in 10 sec or please <a href="<?= DEFAULT_URL . '/' . MEMBERS_ALIAS . '/' ?>">click here</a> to go back to My Account.
                            </div>
                        </div>
                    </div>

<? else: ?>

                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-custom">
                                <thead>
                                    <tr>
                                        <th style="text-align:center">Transaction</th>
                                        <th style="text-align:center" class="text-danger">Failed <i class="fa fa-frown-o fa-frown-custom"></i></th>
                                    </tr>
                                </thead>
                            </table>
                            <div class="tbody-custom">
                                <div class="text-danger text-center custom123" style="height:40px;text-align:center;">
                                    <p><?= $payment_message['head'] ?></p>
                                </div>
                            </div>
                            <div class="alert alert-danger alert-custom text-center">
    <?= $payment_message['body'] ?>
                                You will redirect in 10 sec or please <a href="<?= DEFAULT_URL . '/' . MEMBERS_ALIAS . '/' ?>">click here</a> to go back to My Account.
                            </div>
                        </div>
                    </div>

<? endif; ?>

            </div>
        </div>
    </div>
</section>
<script>
    window.setTimeout(function () {
        window.location.href = "<?= DEFAULT_URL . '/' . MEMBERS_ALIAS . '/' ?>";
    }, 10000);
</script>
<style>
    .footer-atbottom {
        background-color: #F9F9F9;
    }
</style>

<?
# ----------------------------------------------------------------------------------------------------
# FOOTER
# ----------------------------------------------------------------------------------------------------
include(MEMBERS_EDIRECTORY_ROOT . "/layout/footer.php");
?>
