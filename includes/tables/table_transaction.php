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
# * FILE: /includes/tables/table_transaction.php
# ----------------------------------------------------------------------------------------------------

if ((!string_strpos($_SERVER["PHP_SELF"], "" . SITEMGR_ALIAS . "/search")) && (!string_strpos($_SERVER["PHP_SELF"], "getMoreResults"))) {

    if ($msg == 1) {
        echo "<p class=\"successMessage\">" . system_showText(LANG_SITEMGR_TRANSACTION_DELETE_SUCCESS) . "</p>";
    }
    ?>

    <div style="display:none">
        <form name="transaction_post" id="transaction_post" action="<?= system_getFormAction($_SERVER["PHP_SELF"]) ?>" method="post">
            <input type="hidden" name="hiddenValue">
            <input type="hidden" name="screen" value="<?= $screen ?>">
            <input type="hidden" name="manage_type" value="transaction">
            <?= system_getFormInputSearchParams((($_POST) ? ($_POST) : ($_GET))); ?>
        </form>
    </div>

<? } ?>

<script type="text/javascript">
<!--
    function JS_openDetail(id) {
        document.getElementById('info_' + id).style.display = '';
        document.getElementById('img_' + id).innerHTML = '<img style="cursor: pointer; cursor: hand;" src="<?= DEFAULT_URL ?>/images/content/img_close.gif" onclick="JS_closeDetail(' + id + ');" />'
    }

    function JS_closeDetail(id) {
        document.getElementById('info_' + id).style.display = 'none';
        document.getElementById('img_' + id).innerHTML = '<img style="cursor: pointer; cursor: hand;" src="<?= DEFAULT_URL ?>/images/content/img_open.gif" onclick="JS_openDetail(' + id + ');" />'
    }

<? if ((!string_strpos($_SERVER["PHP_SELF"], "" . SITEMGR_ALIAS . "/search")) && (!string_strpos($_SERVER["PHP_SELF"], "getMoreResults"))) { ?>
        function getValuesBulkTransaction() {

            if (document.getElementById('delete_all').checked) {
                document.getElementById("bulkSubmit").value = "Submit";
                dialogBoxBulk('confirm', '<?= system_showText(LANG_SITEMGR_BULK_DELETEQUESTION); ?>', 'Submit', 'transaction_bulk', '200', '<?= system_showText(LANG_SITEMGR_OK); ?>', '<?= system_showText(LANG_SITEMGR_CANCEL); ?>');
            } else {
                document.getElementById("bulkSubmit").value = "Submit";
                dialogBoxBulk('confirm', '<?= system_showText(LANG_SITEMGR_BULK_DELETEQUESTION2); ?>', 'Submit', 'transaction_bulk', '180', '<?= system_showText(LANG_SITEMGR_OK); ?>', '<?= system_showText(LANG_SITEMGR_CANCEL); ?>');
            }
        }

        function confirmBulk() {

            if (document.getElementById('delete_all').checked) {
                document.getElementById("bulkSubmit").value = "Submit";
                dialogBoxBulk('confirm', '<?= system_showText(LANG_SITEMGR_BULK_DELETEQUESTION); ?>', 'Submit', 'transaction_bulk', '200', '<?= system_showText(LANG_SITEMGR_OK); ?>', '<?= system_showText(LANG_SITEMGR_CANCEL); ?>');
            } else {
                document.getElementById("bulkSubmit").value = "Submit";
                dialogBoxBulk('confirm', '<?= system_showText(LANG_SITEMGR_BULK_DELETEQUESTION2); ?>', 'Submit', 'transaction_bulk', '180', '<?= system_showText(LANG_SITEMGR_OK); ?>', '<?= system_showText(LANG_SITEMGR_CANCEL); ?>');
            }
        }
<? } ?>
-->
</script>

<?
//Sitemgr Bulk update
if ((!string_strpos($_SERVER["PHP_SELF"], "" . SITEMGR_ALIAS . "/search")) && (!string_strpos($_SERVER["PHP_SELF"], "getMoreResults"))) {

    $itemCount = count($transactions);

    if (is_numeric($error_message)) {
        echo "<p class=\"errorMessage\">" . $msg_bulkupdate[$error_message] . "</p>";
    } elseif ($msg == "successdel") {
        echo "<p class=\"successMessage\">" . LANG_SITEMGR_TRANSACTIONS_DELETE_SUCCESS . "</p>";
    }
    unset($msg);

    if (string_strpos($_SERVER["PHP_SELF"], "/" . SITEMGR_ALIAS . "/transactions/search") !== false) {
        $actionBulk = system_getFormAction($_SERVER["REQUEST_URI"]);
        $actionBulk = str_replace("msg=" . $_GET["msg"], "", $actionBulk);
    } else {
        $actionBulk = system_getFormAction($_SERVER["PHP_SELF"]);
    }
    ?>

    <div class="bulkupdate-box">
        <a class="bulkUpdate" href="javascript:void(0)" onclick="showBulkUpdate(<?= RESULTS_PER_PAGE ?>, 'transaction', '<?= system_showText(LANG_SITEMGR_CLOSE_BULK); ?>', '<?= system_showText(LANG_SITEMGR_BULK_UPDATE); ?>')" id="open_bulk">
            <?= system_showText(LANG_SITEMGR_BULK_UPDATE); ?>
        </a>                    
    </div>

    <div class="bulkupdate-box">

        <div class="bulkupdate-form">

            <form name="transaction_bulk" id="transaction_bulk" action="<?= $actionBulk ?>" method="post">

                <input type="hidden" name="bulkSubmit" id="bulkSubmit" value="" />

                <?= system_getFormInputSearchParams((($_POST) ? ($_POST) : ($_GET))); ?>

                <div id="table_bulk" style="display: none" class="table-bulkupdate">

                    <? include(INCLUDES_DIR . "/tables/table_bulkupdatePayment.php");

                    if (string_strpos($_SERVER["PHP_SELF"], "search.php") == true) {
                        ?>
                        <button type="button" id="bulkSubmit" name="bulkSubmit" value="Submit" class="stmgr-btn" onclick="getValuesBulkTransaction();"><?= system_showText(LANG_SITEMGR_SUBMIT) ?></button>
                    <? } else { ?>
                        <button type="button" name="bulkSubmit" value="Submit" class="stmgr-btn" onclick="confirmBulk();"><?= system_showText(LANG_SITEMGR_SUBMIT) ?></button>
    <? } ?>

                </div>

                <div id="idlist"></div>

            </form>

        </div>

        <div id="bulk_check" style="display:none">

            <div class="bulk-checkall">
                <input type="checkbox" id="check_all" name="check_all" onclick="checkAll('transaction', document.getElementById('check_all'), false, <?= $itemCount; ?>); removeCategoryDropDown('transaction', '<?= DEFAULT_URL ?>');" />

                <a class="CheckUncheck" href="javascript:void(0);" onclick="checkAll('transaction', document.getElementById('check_all'), true, <?= $itemCount; ?>); removeCategoryDropDown('transaction', '<?= DEFAULT_URL ?>');">
    <?= system_showText(LANG_CHECK_UNCHECK_ALL); ?>
                </a>
            </div>

        </div>

    </div>

    <? include(INCLUDES_DIR . "/tables/table_paging.php"); ?>

<? } ?>

<form name="item_table">

    <table class="table-itemlist">

        <tr>
            <th style="width:20px">&nbsp;</th>
            <th><?= system_showText(LANG_LABEL_ID); ?></th>
            <th><?= system_showText(LANG_LABEL_STATUS); ?></th>
            <th><?= system_showText(LANG_LABEL_DATE); ?></th>
            <th><?= system_showText(LANG_LABEL_SUBTOTAL); ?></th>
            <th><?= system_showText(LANG_LABEL_TAX); ?></th>
            <th><?= system_showText(LANG_LABEL_AMOUNT); ?></th>
            <th><?= system_showText(LANG_LABEL_ACCOUNT); ?></th>
            <th><?= system_showText(LANG_LABEL_SYSTEM); ?></th>
            <th style="width:72px"><?= system_showText(LANG_LABEL_OPTIONS) ?></th>
        </tr>

        <?
        $cont = 0;
        foreach ($transactions as $transaction) {
            $cont++;
            $id = $transaction["id"];
            $str_time = format_getTimeString($transaction["transaction_datetime"]);
            if (defined("LANG_LABEL_" . $transaction["transaction_status"])) {
                $labelStatus = @constant(string_strtoupper(("LANG_LABEL_" . $transaction["transaction_status"])));
            } else {
                $labelStatus = $transaction["transaction_status"];
            }
            ?>
            <tr>
                <td class="inputCheckBulk">
                    <input type="checkbox" id="transaction_id<?= $cont ?>" name="item_check[]" value="<?= $id ?>" class="inputCheck" style="display:none" onclick="removeCategoryDropDown('transaction', '<?= DEFAULT_URL ?>');"/>
                    <div id="img_<?= $transaction["id"]; ?>">
                        <img style="cursor: pointer; cursor: hand;" src="<?= DEFAULT_URL ?>/images/content/img_open.gif" onclick="JS_openDetail('<?= $transaction["id"]; ?>');" />
                    </div>
                </td>
                <td><p title="<?= $transaction["transaction_id"] ?>" style="cursor:default"><?= system_showTruncatedText($transaction["transaction_id"], 10) ?></p></td>
                <td><span title="<?= $labelStatus ?>" style="cursor:default"><?= $labelStatus ?></span></td>
                <td><span title="<?= format_date($transaction["transaction_datetime"], DEFAULT_DATE_FORMAT, "datetime") . " - " . $str_time ?>" style="cursor:default"><?= format_date($transaction["transaction_datetime"], DEFAULT_DATE_FORMAT, "datetime") . " - " . $str_time ?></span></td>

                <td>
                    <?
                    if ($transaction["transaction_subtotal"] > 0)
                        $subtotal_field = $transaction["transaction_subtotal"] . " (" . $transaction["transaction_currency"] . ")";
                    else
                        $subtotal_field = "0.00 (" . $transaction["transaction_currency"] . ")";
                    ?>
                    <span title="<?= $subtotal_field ?>" style="cursor:default"><?= $subtotal_field ?></span>
                </td>

                <td>
                    <?
                    if ($transaction["transaction_tax"] > 0)
                        $tax_field = payment_calculateTax($subtotal_field, $transaction["transaction_tax"], true, false) . " (" . $transaction["transaction_currency"] . ")";
                    else
                        $tax_field = "0.00 (" . $transaction["transaction_currency"] . ")";
                    ?>
                    <span title="<?= $tax_field ?>" style="cursor:default"><?= $tax_field ?></span>
                </td>

                <td>
    <?
    if ($transaction["transaction_amount"] > 0)
        $amount_field = $transaction["transaction_amount"] . " (" . $transaction["transaction_currency"] . ")";
    else
        $amount_field = "0.00 (" . $transaction["transaction_currency"] . ")";
    ?>
                    <span title="<?= $amount_field ?>" style="cursor:default"><?= $amount_field ?></span>
                </td>

                <td>
                    <? if ($transaction["account_id"] > 0) { ?>
                        <a title="<?= system_showAccountUserName($transaction["username"]) ?>" href="<?= $url_base ?>/account/view.php?id=<?= $transaction["account_id"] ?>" class="link-table">
        <?= system_showTruncatedText(system_showAccountUserName($transaction["username"]), 10); ?>
                        </a>
                    <? } else { ?>
                        <span title="<?= system_showAccountUserName($transaction["username"]) ?>" style="cursor:default">
                        <?= system_showTruncatedText(system_showAccountUserName($transaction["username"]), 10); ?>
                        </span>
                    <? } ?>
                </td>

                <td>
    <?
    if (($transaction["system_type"] != "simplepay") && ($transaction["system_type"] != "paypal") && ($transaction["system_type"] != "manual") && ($transaction["system_type"] != "pagseguro")) {
        $type_field = system_showText(LANG_CREDITCARD);
    } else {
        $type_field = $transaction["system_type"];
    }
    ?>
                    <span title="<?= $type_field ?>" style="cursor:default"><?= $type_field ?></span>
                </td>
                <td nowrap class="main-options">
                    <a href="<?= $url_redirect ?>/view.php?id=<?= $transaction["id"] ?>">
    <?= system_showText(LANG_LABEL_VIEW); ?>
                    </a>
                    <b>|</b>
                    <a href="javascript:void(0)" onclick="dialogBox('confirm', '<?= system_showText(LANG_SITEMGR_TRANSACTION_DELETEQUESTION); ?>', <?= $transaction['id'] ?>, 'transaction_post', '200', '<?= system_showText(LANG_SITEMGR_OK); ?>', '<?= system_showText(LANG_SITEMGR_CANCEL); ?>');">
    <?= system_showText(LANG_LABEL_DELETE); ?>
                    </a>
                </td>
            </tr>
            <tr id="info_<?= $transaction["id"]; ?>" style="display:none;">
                <td colspan="10">
    <?php include (INCLUDES_DIR . "/views/view_transaction_summary_info.php"); ?>
                </td>
            </tr>
            <tr></tr>
<? } ?>

    </table>

</form>