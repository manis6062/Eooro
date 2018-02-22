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
	# * FILE: /includes/tables/table_invoice.php
	# ----------------------------------------------------------------------------------------------------

    if ((!string_strpos($_SERVER["PHP_SELF"], "".SITEMGR_ALIAS."/search")) && (!string_strpos($_SERVER["PHP_SELF"], "getMoreResults"))) {

        if ($msg == 1) {
            echo "<p class=\"successMessage\">".system_showText(LANG_SITEMGR_INVOICE_DELETE_SUCCESS)."</p>";
        } ?>

        <div style="display:none">
            <form name="invoice_post" id="invoice_post" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">
                <input type="hidden" name="hiddenValue">
                <input type="hidden" name="screen" value="<?=$screen?>">
                <input type="hidden" name="manage_type" value="invoice">
                <?=system_getFormInputSearchParams((($_POST)?($_POST):($_GET)));?>
            </form>
        </div>
    
    <? } ?>

    <script type="text/javascript">
    <!--
        function JS_openDetail(id) {
            document.getElementById('info_'+id).style.display = '';
            document.getElementById('img_'+id).innerHTML = '<img style="cursor: pointer; cursor: hand;" src="<?=DEFAULT_URL?>/images/content/img_close.gif" onclick="JS_closeDetail('+id+');" />'
        }
        
        function JS_closeDetail(id) {
            document.getElementById('info_'+id).style.display = 'none';
            document.getElementById('img_'+id).innerHTML = '<img style="cursor: pointer; cursor: hand;" src="<?=DEFAULT_URL?>/images/content/img_open.gif" onclick="JS_openDetail('+id+');" />'
        }
        
        <? if ((!string_strpos($_SERVER["PHP_SELF"], "".SITEMGR_ALIAS."/search")) && (!string_strpos($_SERVER["PHP_SELF"], "getMoreResults"))) { ?>
        function getValuesBulkInvoice(){

            if (document.getElementById('delete_all').checked){
                document.getElementById("bulkSubmit").value = "Submit";
                dialogBoxBulk('confirm','<?=system_showText(LANG_SITEMGR_BULK_DELETEQUESTION);?>','Submit','invoice_bulk','200','<?=system_showText(LANG_SITEMGR_OK);?>','<?=system_showText(LANG_SITEMGR_CANCEL);?>');
            } else {
                document.getElementById("bulkSubmit").value = "Submit";
                dialogBoxBulk('confirm','<?=system_showText(LANG_SITEMGR_BULK_DELETEQUESTION2);?>','Submit','invoice_bulk','180','<?=system_showText(LANG_SITEMGR_OK);?>','<?=system_showText(LANG_SITEMGR_CANCEL);?>');
            }
        }

        function confirmBulk(){

            if (document.getElementById('delete_all').checked){
                document.getElementById("bulkSubmit").value = "Submit";
                dialogBoxBulk('confirm','<?=system_showText(LANG_SITEMGR_BULK_DELETEQUESTION);?>','Submit','invoice_bulk','200','<?=system_showText(LANG_SITEMGR_OK);?>','<?=system_showText(LANG_SITEMGR_CANCEL);?>');
            } else {
                document.getElementById("bulkSubmit").value = "Submit";
                dialogBoxBulk('confirm','<?=system_showText(LANG_SITEMGR_BULK_DELETEQUESTION2);?>','Submit','invoice_bulk','180','<?=system_showText(LANG_SITEMGR_OK);?>','<?=system_showText(LANG_SITEMGR_CANCEL);?>');
            }
        }
        <? } ?>
    -->
    </script>
    
    <?
    //Sitemgr Bulk update
    if ((!string_strpos($_SERVER["PHP_SELF"], "".SITEMGR_ALIAS."/search")) && (!string_strpos($_SERVER["PHP_SELF"], "getMoreResults"))) {
        
        $itemCount = count($invoices);
    
        if (is_numeric($error_message)) {
            echo "<p class=\"errorMessage\">".$msg_bulkupdate[$error_message]."</p>";
        } elseif ($msg == "successdel") {
            echo "<p class=\"successMessage\">".LANG_SITEMGR_INVOICES_DELETE_SUCCESS."</p>";
        }
        unset($msg);
        
        if (string_strpos($_SERVER["PHP_SELF"], "/".SITEMGR_ALIAS."/invoices/search") !== false) {
            $actionBulk = system_getFormAction($_SERVER["REQUEST_URI"]);
            $actionBulk = str_replace("msg=".$_GET["msg"], "", $actionBulk);
        } else {
            $actionBulk = system_getFormAction($_SERVER["PHP_SELF"]);
        }
    ?>

        <div class="bulkupdate-box">
            <a class="bulkUpdate" href="javascript:void(0)" onclick="showBulkUpdate( <?=RESULTS_PER_PAGE?>, 'invoice', '<?=system_showText(LANG_SITEMGR_CLOSE_BULK);?>', '<?=system_showText(LANG_SITEMGR_BULK_UPDATE);?>')" id="open_bulk">
                <?=system_showText(LANG_SITEMGR_BULK_UPDATE);?>
            </a>                   
        </div>

        <div class="bulkupdate-box">
            
            <div class="bulkupdate-form">
    
                <form name="invoice_bulk" id="invoice_bulk" action="<?=$actionBulk?>" method="post">

                    <input type="hidden" name="bulkSubmit" id="bulkSubmit" value="" />

                    <?=system_getFormInputSearchParams((($_POST)?($_POST):($_GET)));?>

                    <div id="table_bulk" style="display: none" class="table-bulkupdate">

                        <? include(INCLUDES_DIR."/tables/table_bulkupdatePayment.php");

                        if (string_strpos($_SERVER["PHP_SELF"], "search.php") == true) { ?>
                            <button type="button" id="bulkSubmit" name="bulkSubmit" value="Submit" class="stmgr-btn" onclick="getValuesBulkInvoice();"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
                        <? } else { ?>
                            <button type="button" name="bulkSubmit" value="Submit" class="stmgr-btn" onclick="confirmBulk();"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
                        <? } ?>

                    </div>

                    <div id="idlist"></div>

                </form>
                
            </div>
            
            <div id="bulk_check" style="display:none">
            
                <div class="bulk-checkall">
                    <input type="checkbox" id="check_all" name="check_all" onclick="checkAll('invoice', document.getElementById('check_all'), false, <?=$itemCount;?>); removeCategoryDropDown('invoice', '<?=DEFAULT_URL?>');" />
                    
                    <a class="CheckUncheck" href="javascript:void(0);" onclick="checkAll('invoice', document.getElementById('check_all'), true, <?=$itemCount;?>); removeCategoryDropDown('invoice', '<?=DEFAULT_URL?>');">
                        <?=system_showText(LANG_CHECK_UNCHECK_ALL);?>
                    </a>
                </div>

            </div>
            
        </div>

        <? include(INCLUDES_DIR."/tables/table_paging.php");

    } ?>
    
    <form name="item_table">

        <table class="table-itemlist">
            
            <tr>
                <th>&nbsp;</th>
                <th><?=system_showText(LANG_LABEL_ID);?></th>
                <th><?=system_showText(LANG_LABEL_STATUS);?></th>
                <th><?=system_showText(LANG_LABEL_DATE);?></th>
                <th><?=system_showText(LANG_LABEL_SUBTOTAL);?></th>
                <th><?=system_showText(LANG_LABEL_TAX);?></th>
                <th><?=system_showText(LANG_LABEL_AMOUNT);?></th>
                <th><?=system_showText(LANG_LABEL_ACCOUNT);?></th>
                <th><?=system_showText(LANG_LABEL_OPTIONS)?></th>
            </tr>
            
            <?
            $cont = 0;
            foreach($invoices as $invoice) { 
                $cont++;
                $id = $invoice["id"];
                $invoiceStatusObj = new InvoiceStatus();

                $str_time    = format_getTimeString($invoice["date"]);
                $account_id  = $invoice["account_id"];
                $username    = $invoice["username"];
                $id          = $invoice["id"];
                $ip          = $invoice["ip"];
                $date        = format_date($invoice["date"],DEFAULT_DATE_FORMAT, "datetime")." - ".$str_time;
                $status      = $invoiceStatusObj->getStatusWithStyle($invoice["status"]);
                $amount      = $invoice["amount"];
                $subtotal    = $invoice["subtotal_amount"];
                $tax		 = $invoice["tax_amount"];
                $expire_date = format_date($invoice["date"],DEFAULT_DATE_FORMAT, "date");
                $valTax		 = payment_calculateTax($subtotal,$tax,true,false);

            ?>

            <tr>
                <td class="inputCheckBulk">
                    <input type="checkbox" id="invoice_id<?=$cont?>" name="item_check[]" value="<?=$id?>" class="inputCheck" style="display:none" onclick="removeCategoryDropDown('invoice', '<?=DEFAULT_URL?>');"/>
                    <div id="img_<?=$invoice["id"]; ?>">
                        <img style="cursor: pointer; cursor: hand;" src="<?=DEFAULT_URL?>/images/content/img_open.gif" onclick="JS_openDetail('<?=$invoice["id"];?>');" />
                    </div>
                </td>
                
                <td>
                    <span title="<?=$id?>" style="cursor:default"><?=$id?></span>
                </td>
                
                <td>
                <? if ($invoice["status"] == "P") { ?>
                    <a title="<?=$invoiceStatusObj->getStatus($invoice["status"]);?>" href="<?=$url_redirect?>/settings.php?id=<?=$id?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table"><?=$status?></a>
                <? } else { ?>			
                    <a title="<?=$invoiceStatusObj->getStatus($invoice["status"]);?>" class="link-table"><?=$status?></a>
                <? } ?>
                </td>
                
                <td>
                    <span title="<?=$date?>" style="cursor:default"><?=$date?></span>
                </td>

                <td>
                    <span title="<?=$subtotal?> (<?=$invoice["currency"]?>)" style="cursor:default"><?=$subtotal?> (<?=$invoice["currency"]?>)</span>
                </td>

                <td>
                    <span title="<?=$valTax?> (<?=$invoice["currency"]?>)" style="cursor:default"><?=$valTax?> (<?=$invoice["currency"]?>)</span>
                </td>

                <td>
                    <span title="<?=$amount?> (<?=$invoice["currency"]?>)" style="cursor:default"><?=$amount?> (<?=$invoice["currency"]?>)</span>
                </td>

                <td>
                    <? if ($account_id > 0) {  ?>
                        <a title="<?=system_showAccountUserName($username)?>" href="<?=$url_base?>/account/view.php?id=<?=$account_id?>" class="link-table">
                            <?=system_showTruncatedText(system_showAccountUserName($username), 60);?>
                        </a>
                    <? } else { ?>
                        <span title="<?=system_showAccountUserName($username)?>" style="cursor:default">
                            <?=system_showTruncatedText(system_showAccountUserName($username), 60);?>
                        </span>
                    <? } ?>
                </td>

                <td nowrap class="main-options">
                    <a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/invoices/view.php?id=<?=$id?>&letter=<?=$letter?>&screen=<?=$screen?>"><?=system_showText(LANG_LABEL_VIEW);?></a>
                    <b>|</b>
                    <a href="javascript:void(0)" onclick="dialogBox('confirm', '<?=system_showText(LANG_SITEMGR_INVOICE_DELETEQUESTION);?>', <?=$invoice['id']?>, 'invoice_post', '200', '<?=system_showText(LANG_SITEMGR_OK);?>', '<?=system_showText(LANG_SITEMGR_CANCEL);?>');"><?=system_showText(LANG_LABEL_DELETE);?></a>
                </td>
                
            </tr>
            
            <tr id="info_<?=$invoice["id"];?>" style="display:none; background-color:white;">
                <td colspan="9">
                <?php include(INCLUDES_DIR."/views/view_invoice_summary_info.php"); ?>
                </td>
            </tr>
            
            <tr></tr>
            
            <? } ?>
            
        </table>
        
    </form>