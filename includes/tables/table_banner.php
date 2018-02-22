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
	# * FILE: /includes/tables/table_banner.php
	# ----------------------------------------------------------------------------------------------------

?>

    <script type="text/javascript">
        function getValuesBulkBanner(){

            if(document.getElementById('change_no_owner').value == "on"){
                document.getElementById("account_search_bulk").value = "0";
            }else if (document.getElementById("change_account_id")) {
                document.getElementById("account_search_bulk").value = document.getElementById("change_account_id").value;
            }

            if (document.getElementById("level_bulk").value) {
                document.getElementById("level_bulk").value = document.getElementById("level").value;
            }

            if (document.getElementById('delete_all').checked){
                document.getElementById("bulkSubmit").value = "Submit";
                dialogBoxBulk('confirm','<?=system_showText(LANG_SITEMGR_BULK_DELETEQUESTION);?>','Submit','banner_setting','200','<?=system_showText(LANG_SITEMGR_OK);?>','<?=system_showText(LANG_SITEMGR_CANCEL);?>');
            } else {
                document.getElementById("bulkSubmit").value = "Submit";
                dialogBoxBulk('confirm','<?=system_showText(LANG_SITEMGR_BULK_DELETEQUESTION2);?>','Submit','banner_setting','180','<?=system_showText(LANG_SITEMGR_OK);?>','<?=system_showText(LANG_SITEMGR_CANCEL);?>');
            }
        }

        function confirmBulk(){
            if (document.getElementById('delete_all').checked){
                document.getElementById("bulkSubmit").value = "Submit";
                dialogBoxBulk('confirm','<?=system_showText(LANG_SITEMGR_BULK_DELETEQUESTION);?>','Submit','banner_setting','200','<?=system_showText(LANG_SITEMGR_OK);?>','<?=system_showText(LANG_SITEMGR_CANCEL);?>');
            } else {
                document.getElementById("bulkSubmit").value = "Submit";
                dialogBoxBulk('confirm','<?=system_showText(LANG_SITEMGR_BULK_DELETEQUESTION2);?>','Submit','banner_setting','180','<?=system_showText(LANG_SITEMGR_OK);?>','<?=system_showText(LANG_SITEMGR_CANCEL);?>');
            }
        }
    </script>
    
    <?
    $levelObj = new BannerLevel(true);
    unset($levelStatus);
    foreach ($levelObj->value as $k => $value) {
        $levelStatus[$value] = $levelObj->active[$k];
    }
    unset($levelObj);

    $itemCount = count($banners);

    //Success and Error Messages
    if (is_numeric($message) && isset($msg_banner[$message])) { 
        echo "<p class=\"successMessage\">".$msg_banner[$message]."</p>";
    }
    if (is_numeric($error_message)) {
        echo "<p class=\"errorMessage\">".$msg_bulkupdate[$error_message]."</p>";
    } elseif ($error_msg) {
        echo "<p class=\"errorMessage\">".$error_msg."</p>";
    } elseif ($msg == "success") {
        echo "<p class=\"successMessage\">".LANG_MSG_BANNER_SUCCESSFULLY_UPDATE."</p>";
    } elseif ($msg == "successdel") {
        echo "<p class=\"successMessage\">".LANG_MSG_BANNER_SUCCESSFULLY_DELETE."</p>";
    }
    unset($msg);
    
    //Bulk update and Ordination validation
    $orderLinks = false;
    if ((!string_strpos($_SERVER["PHP_SELF"], "".SITEMGR_ALIAS."/search")) && (!string_strpos($_SERVER["PHP_SELF"], "getMoreResults"))) {

        $orderLinks = true;
        
        if (string_strpos($url_base, "/".SITEMGR_ALIAS."")) { ?>
            <div class="bulkupdate-box">
                <a class="bulkUpdate" href="javascript:void(0)" onclick="showBulkUpdate(<?=RESULTS_PER_PAGE?>, 'banner', '<?=system_showText(LANG_SITEMGR_CLOSE_BULK);?>', '<?=system_showText(LANG_SITEMGR_BULK_UPDATE);?>')" id="open_bulk">
                    <?=system_showText(LANG_SITEMGR_BULK_UPDATE);?>
                </a>
            </div>
        <? }
        
        if (string_strpos($_SERVER["PHP_SELF"], "/".SITEMGR_ALIAS."/banner/search") !== false) {
            $actionBulk = system_getFormAction($_SERVER["REQUEST_URI"]);
        } else {
            $actionBulk = system_getFormAction($_SERVER["PHP_SELF"]);
        }
        
        ?>

        <div class="bulkupdate-box">

            <div class="bulkupdate-form">

                <form name="banner_setting" id="banner_setting" action="<?=$actionBulk?>" method="post">

                    <input type="hidden" name="account_search_bulk" id="account_search_bulk" value="" />
                    <input type="hidden" name="level_bulk" id="level_bulk" value="" />
                    <input type="hidden" name="bulkSubmit" id="bulkSubmit" value="" />

                    <div id="table_bulk" style="display: none" class="table-bulkupdate">

                        <? include(INCLUDES_DIR."/tables/table_bulkupdate.php");
                        
                        if (string_strpos($_SERVER["PHP_SELF"], "search.php") == true) { ?>
                            <button type="button" id="bulkSubmit" name="bulkSubmit" value="Submit" class="stmgr-btn" onclick="javascript:getValuesBulkBanner();"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
                        <? } else { ?>
                            <button type="button" name="bulkSubmit" value="Submit" class="stmgr-btn" onclick="javascript:confirmBulk();"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
                        <? } ?>

                    </div>

                    <div id="idlist"></div>

                </form>
                
            </div>

            <div id="bulk_check" style="display:none">
                
                <div class="bulk-checkall">          
                    <input type="checkbox" id="check_all" name="check_all" onclick="checkAll('banner', document.getElementById('check_all'), false, <?=$itemCount;?>);" />
                
                    <a class="CheckUncheck" href="javascript:void(0);" onclick="checkAll('banner', document.getElementById('check_all'), true, <?=$itemCount;?>); ">
                        <?=system_showText(LANG_CHECK_UNCHECK_ALL);?>
                    </a>
                </div>
                
            </div>

        </div>
    
        <? include(INCLUDES_DIR."/tables/table_paging.php"); ?>

    <? } ?>

    <form name="item_table">
        
        <table class="table-itemlist">

            <tr>
                <th>
                    <span><?=system_showText(LANG_LABEL_CAPTION)?></span>
                    <? if ($orderLinks) { ?>
                        <a href="<?=$paging_url."?order_by=caption_".($order_by == "caption_asc" ? "desc" : "asc")."&letter=$letter&screen=$screen".($url_search_params ? "&$url_search_params" : "")?>">
                           <i class="sitemgr-icon-arrow-<?=($order_by == "caption_asc" ? "up" : "down")?>"></i>
                       </a>
                    <? } ?>
                </th>

                <th>
                    <span><?=system_showText(LANG_LABEL_TYPE)?></span>
                    <? if ($orderLinks) { ?>
                        <a href="<?=$paging_url."?order_by=level_".($order_by == "level_asc" ? "desc" : "asc")."&letter=$letter&screen=$screen".($url_search_params ? "&$url_search_params" : "")?>">
                            <i class="sitemgr-icon-arrow-<?=($order_by == "level_asc" ? "up" : "down")?>"></i>
                        </a>
                    <? } ?>
                </th>

                <th style="width:60px;">
                    <span><?=system_showText(LANG_LABEL_STATUS);?></span>
                    <? if ($orderLinks) { ?>
                        <a href="<?=$paging_url."?order_by=status_".($order_by == "status_asc" ? "desc" : "asc")."&letter=$letter&screen=$screen".($url_search_params ? "&$url_search_params" : "")?>">
                            <i class="sitemgr-icon-arrow-<?=($order_by == "status_asc" ? "up" : "down")?>"></i>
                        </a>
                    <? } ?>
                </th>

                <? if (string_strpos($url_redirect, "/".SITEMGR_ALIAS."")) { ?>
                    <th style="width:70px;">
                        <span><?=system_showText(LANG_LABEL_ACCOUNT);?></span>
                        <? if (BANNER_SCALABILITY_OPTIMIZATION != "on" && $orderLinks) { ?>
                            <a href="<?=$paging_url."?order_by=account_".($order_by == "account_asc" ? "desc" : "asc")."&letter=$letter&screen=$screen".($url_search_params ? "&$url_search_params" : "")?>">
                                <i class="sitemgr-icon-arrow-<?=($order_by == "account_asc" ? "up" : "down")?>"></i>
                            </a>
                        <? } ?>
                    </th>
                <? } ?>
                    
                <th style="width:70px;">
                    <span><?=system_showText(LANG_LABEL_RENEWAL);?></span>
                    <? if ($orderLinks) { ?>
                        <a href="<?=$paging_url."?order_by=renewal_".($order_by == "renewal_asc" ? "desc" : "asc")."&letter=$letter&screen=$screen".($url_search_params ? "&$url_search_params" : "")?>">
                            <i class="sitemgr-icon-arrow-<?=($order_by == "renewal_asc" ? "up" : "down")?>"></i>
                        </a>
                    <? } ?>
                </th>
                
                <th>
                     <span><?=system_showText(LANG_LABEL_IMPRESSIONS)?></span>
                    <? if ($orderLinks) { ?>
                        <a href="<?=$paging_url."?order_by=impressions_".($order_by == "impressions_asc" ? "desc" : "asc")."&letter=$letter&screen=$screen".($url_search_params ? "&$url_search_params" : "")?>">
                            <i class="sitemgr-icon-arrow-<?=($order_by == "impressions_asc" ? "up" : "down")?>"></i>
                        </a>
                    <? } ?>
                </th>

                <th style="width:20px;"></th>

                <th>
                    <?=system_showText(LANG_LABEL_OPTIONS)?>
                </th>

            </tr>

            <?
            $hascharge = false;
            $hastocheckout = false;
            $cont = 0;
            
            $dbMain = db_getDBObject(DEFAULT_DB, true);
            $db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
            
            if ($banners) foreach ($banners as $each_banner) {
                $cont++;
                $bannerObj = new Banner($each_banner);
                if (string_strpos($url_base, "/".SITEMGR_ALIAS."") === false) {
                    if ($bannerObj->needToCheckOut() && ($bannerObj->getString("unpaid_impressions") > 0 || $bannerObj->getString("expiration_setting") == BANNER_EXPIRATION_RENEWAL_DATE)) {
                        if ($bannerObj->getPrice() > 0 && ($bannerObj->getString("unpaid_impressions") > 0 || $bannerObj->getString("expiration_setting") == BANNER_EXPIRATION_RENEWAL_DATE)) $hascharge = true;
                        $hastocheckout = true;
                    }
                }

                $id = $bannerObj->getNumber("id");

                // ---------------- //

                $sql = "SELECT payment_log_id FROM Payment_Banner_Log WHERE banner_id = $id ORDER BY renewal_date DESC LIMIT 1";
                $r   = $db->query($sql);
                $aux_transaction_data = mysql_fetch_assoc($r);

                if($aux_transaction_data) {
                    $sql = "SELECT id,transaction_datetime FROM Payment_Log WHERE id = {$aux_transaction_data["payment_log_id"]}";
                    $r = $db->query($sql);
                    $transaction_data = mysql_fetch_assoc($r);
                } else {
                    unset($transaction_data);
                }

                // ---------------- //

                $sql = "SELECT IB.invoice_id, IB.banner_id, I.id, I.status, I.payment_date FROM Invoice I, Invoice_Banner IB WHERE IB.banner_id = $id AND I.status = 'R' AND I.id = IB.invoice_id ORDER BY I.payment_date DESC LIMIT 1";
                $r   = $db->query($sql);
                $invoice_data = mysql_fetch_assoc($r);

                // ---------------- //

                list($t_month,$t_day,$t_year)     = explode("/",format_date($transaction_data["transaction_datetime"],DEFAULT_DATE_FORMAT,"datetime"));
                list($i_month,$i_day,$i_year)     = explode("/",format_date($invoice_data["payment_date"],DEFAULT_DATE_FORMAT,"datetime"));
                list($t_hour,$t_minute,$t_second) = explode(":",format_date($transaction_data["transaction_datetime"],"H:i:s","datetime"));
                list($i_hour,$i_minute,$i_second) = explode(":",format_date($invoice_data["payment_date"],"H:i:s","datetime"));

                $t_ts_date = mktime((int)$t_hour,(int)$t_minute,(int)$t_second,(int)$t_month,(int)$t_day,(int)$t_year);
                $i_ts_date = mktime((int)$i_hour,(int)$i_minute,(int)$i_second,(int)$i_month,(int)$i_day,(int)$i_year);

                if (PAYMENT_FEATURE == "on") {
                    if (((MANUALPAYMENT_FEATURE == "on") || (CREDITCARDPAYMENT_FEATURE == "on")) && (INVOICEPAYMENT_FEATURE == "on")) {
                        if($t_ts_date < $i_ts_date){
                            if($invoice_data["id"]) $history_lnk = DEFAULT_URL."/".SITEMGR_ALIAS."/invoices/view.php?id=".$invoice_data["id"];
                            else unset($history_lnk);
                        } else {
                            if($transaction_data["id"]) $history_lnk = DEFAULT_URL."/".SITEMGR_ALIAS."/transactions/view.php?id=".$transaction_data["id"];
                            else unset($history_lnk);
                        }
                    } elseif ((MANUALPAYMENT_FEATURE == "on") || (CREDITCARDPAYMENT_FEATURE == "on")) {
                        if($transaction_data["id"]) $history_lnk = DEFAULT_URL."/".SITEMGR_ALIAS."/transactions/view.php?id=".$transaction_data["id"];
                        else unset($history_lnk);
                    } elseif (INVOICEPAYMENT_FEATURE == "on") {
                        if($invoice_data["id"]) $history_lnk = DEFAULT_URL."/".SITEMGR_ALIAS."/invoices/view.php?id=".$invoice_data["id"];
                        else unset($history_lnk);
                    } else {
                        unset($history_lnk);
                    }
                } else {
                    unset($history_lnk);
                }

                ?>
                <tr>
                    <td>
                        <input type="checkbox" id="banner_id<?=$cont?>" name="item_check[]" value="<?=$id?>" class="inputCheck" style="display:none" onclick="removeCategoryDropDown('banner', '<?=DEFAULT_URL?>');"/>
                        <a title="<?=$bannerObj->getString("caption")?>" href="<?=$url_redirect?>/view.php?id=<?=$bannerObj->GetString("id")?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table">
                            <?=$bannerObj->getString("caption", true);?>
                        </a>
                    </td>
                    
                    <td>
                        <a title="<?=$bannerObj->retrieveHumanReadableType($bannerObj->GetString("type"));?>" href="<?=$url_redirect?>/view.php?id=<?=$bannerObj->GetString("id")?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table">
                        <?
                            echo $bannerObj->retrieveHumanReadableType($bannerObj->GetString("type"));
                            if ($levelStatus[$bannerObj->GetString("type")] == "n") echo " (".LANG_BANNER_DISABLED.")";
                        ?>
                        </a>
                    </td>
                    
                    <td>
                        <?
                        $changeStatus = true;
                        $status = new ItemStatus();
                        if ((!(string_strpos($url_redirect, "/".SITEMGR_ALIAS.""))) && (($bannerObj->GetString("status") == "P") || ($bannerObj->GetString("status") == "E") || ($bannerObj->getString("status") == "S" && $bannerObj->getString("suspended_sitemgr") == "y")))
                            $changeStatus = false; ?>
                        <a title="<?=$status->getStatus($bannerObj->GetString("status"))?>" <? if ($changeStatus) { ?> href="<?=$url_redirect?>/settings.php?id=<?=$bannerObj->GetString("id")?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>" <? } else { ?> href="javascript:void(0)" style="cursor:default" <? } ?> class="link-table">
                            <?=$status->getStatusWithStyle($bannerObj->GetString("status"));?>
                        </a>
                    </td>
                    
                    <? if (string_strpos($url_redirect, "/".SITEMGR_ALIAS."")) { ?>
                    <td>
                        <? if ($bannerObj->GetString("account_id")) {
                            $account = db_getFromDB("account", "id", db_formatNumber($bannerObj->GetString("account_id")));
                            ?>
                            <a title="<?=system_showAccountUserName($account->getString("username"))?>" href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/account/view.php?id=<?=$bannerObj->GetString("account_id")?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table">
                                <?=system_showAccountUserName($account->getString("username"));?>
                            </a>
                        <? } else { ?>
                            <span title="<?=system_showText(LANG_SITEMGR_ACCOUNTSEARCH_NOOWNER)?>" style="cursor:default">
                                <em><?=system_showTruncatedText(LANG_SITEMGR_ACCOUNTSEARCH_NOOWNER, 15);?></em>
                            </span>
                        <? } ?>
                    </td>
                    
                    <? } ?>
                    <td>
                        <?
                        if ($bannerObj->getString("expiration_setting") != BANNER_EXPIRATION_RENEWAL_DATE) {
                            $renewal_field = system_showText(LANG_LABEL_UNLIMITED);
                        } else {
                            if ($bannerObj->hasRenewalDate()) {
                                if ($bannerObj->getDate("renewal_date") == "00/00/0000") {
                                    $renewal_field = system_showText(LANG_LABEL_NEW);
                                } else {
                                    $renewal_field = $bannerObj->getDate("renewal_date");
                                }
                            } else {
                                $renewal_field = "---";
                            }
                        }
                        ?>
                        <span title="<?=$renewal_field?>" style="cursor:default"><?=$renewal_field;?></span>
                    </td>
                    
                    <td>
                        <?
                        if ($bannerObj->getString("expiration_setting") != BANNER_EXPIRATION_IMPRESSION) {
                            $impressions_field = system_showText(LANG_LABEL_UNLIMITED);
                        } else {
                            if ($bannerObj->hasImpressions()) {
                                $impressions_field = $bannerObj->getString("impressions");
                            } else {
                                $impressions_field = "---";
                            }
                        }
                        ?>
                        <span title="<?=$impressions_field?>" style="cursor:default"><?=$impressions_field;?></span>
                    </td>
                    
                    <td>
                        <div class="toolbar-icons-button">
                            
                            <div class="toolbar-icons">
                                
                                <ul>
                                   
                                    <li>
                                        <a href="<?=$url_redirect?>/report.php?id=<?=$bannerObj->GetString("id")?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>">
                                            <?=system_showText(LANG_TRAFFIC_REPORTS);?>
                                        </a>
                                    </li>

                                    <? if (PAYMENTSYSTEM_FEATURE == "on" && string_strpos($url_redirect, "/".SITEMGR_ALIAS."")) {
                                        
                                        if ($history_lnk) { ?>
                                            <li>
                                                <a href="<?=$history_lnk?>">
                                                    <?=system_showText(LANG_SITEMGR_TRANSACTIONS);?>
                                                </a>
                                            </li>
                                        <? } else { ?>
                                            <li>
                                                <?=system_showText(LANG_SITEMGR_TRANSACTIONS);?>
                                            </li>
                                        <? }
                                        
                                    } ?>

                                    <li>
                                        <a href="<?=$url_redirect?>/delete.php?id=<?=$bannerObj->GetString("id")?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>">
                                            <?=system_showText(LANG_LABEL_DELETE)?>
                                        </a>
                                    </li>
                                    
                                </ul>

                            </div>
                            
                            <div class="toolbararrow"></div>
                            
                        </div>
                        
                    </td>
                    
                    <td nowrap class="main-options">
                        <a href="<?=$url_redirect?>/view.php?id=<?=$bannerObj->GetString("id")?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>">
                            <?=system_showText(LANG_LABEL_VIEW)?>
                        </a>
                        <b>|</b>
                        <a href="<?=$url_redirect?>/edit.php?id=<?=$bannerObj->GetString("id")?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>">
                            <?=system_showText(LANG_LABEL_EDIT)?>
                        </a>
                    </td>
                </tr>
            <? } ?>

        </table>
        
    </form>