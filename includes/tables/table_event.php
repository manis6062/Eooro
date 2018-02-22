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
	# * FILE: /includes/tables/table_event.php
	# ----------------------------------------------------------------------------------------------------

?>

    <script type="text/javascript">
        function getValuesBulkEvent(){

            if(document.getElementById('change_no_owner').value == "on"){
                document.getElementById("account_search_bulk").value = "0";
            }else if (document.getElementById("account_search_bulk").value) {
                document.getElementById("account_search_bulk").value = document.getElementById("change_account_id").value;
            }

            if (document.getElementById("level_bulk").value) {
                document.getElementById("level_bulk").value = document.getElementById("level").value;
            }

            if (document.getElementById('delete_all').checked){
                document.getElementById("bulkSubmit").value = "Submit";
                dialogBoxBulk('confirm','<?=system_showText(LANG_SITEMGR_BULK_DELETEQUESTION);?>','Submit','event_setting','200','<?=system_showText(LANG_SITEMGR_OK);?>','<?=system_showText(LANG_SITEMGR_CANCEL);?>');
            } else {
                document.getElementById("bulkSubmit").value = "Submit";
                dialogBoxBulk('confirm','<?=system_showText(LANG_SITEMGR_BULK_DELETEQUESTION2);?>','Submit','event_setting','180','<?=system_showText(LANG_SITEMGR_OK);?>','<?=system_showText(LANG_SITEMGR_CANCEL);?>');
            }
        }

        function confirmBulk(){

            <? if (EVENTCATEGORY_SCALABILITY_OPTIMIZATION == "on") { ?>
                feed = document.event_setting.feed;
                return_categories = document.event_setting.return_categories;
                if(return_categories.value.length > 0) return_categories.value="";

                for (i=0;i<feed.length;i++) {
                    if (!isNaN(feed.options[i].value)) {
                        if(return_categories.value.length > 0)
                        return_categories.value = return_categories.value + "," + feed.options[i].value;
                        else
                    return_categories.value = return_categories.value + feed.options[i].value;
                    }
                }   
            <? } ?>

            if (document.getElementById('delete_all').checked){
                document.getElementById("bulkSubmit").value = "Submit";
                dialogBoxBulk('confirm','<?=system_showText(LANG_SITEMGR_BULK_DELETEQUESTION);?>','Submit','event_setting','200','<?=system_showText(LANG_SITEMGR_OK);?>','<?=system_showText(LANG_SITEMGR_CANCEL);?>');
            } else {
                document.getElementById("bulkSubmit").value = "Submit";
                dialogBoxBulk('confirm','<?=system_showText(LANG_SITEMGR_BULK_DELETEQUESTION2);?>','Submit','event_setting','180','<?=system_showText(LANG_SITEMGR_OK);?>','<?=system_showText(LANG_SITEMGR_CANCEL);?>');
            }
        }
    </script>

    <?
    $level = new EventLevel(true);
    $levelvalues = $level->getLevelValues();

    $itemCount = count($events);
    
    //Success and Error Messages
    if (is_numeric($message) && isset($msg_event[$message])) {
        echo "<p class=\"successMessage\">".$msg_event[$message]."</p>";
    }
    if (is_numeric($error_message)) { 
        echo "<p class=\"errorMessage\">".$msg_bulkupdate[$error_message]."</p>";
    } elseif ($error_msg) {
        echo "<p class=\"errorMessage\">".$error_msg."</p>";
    } elseif ($msg == "success") {
        echo "<p class=\"successMessage\">".LANG_MSG_EVENT_SUCCESSFULLY_UPDATE."</p>";
    } elseif ($msg == "successdel") {
        echo "<p class=\"successMessage\">".LANG_MSG_EVENT_SUCCESSFULLY_DELETE."</p>";
    }
    unset($msg);
    
    //Bulk update and Ordination validation
    $orderLinks = false;
    if ((!string_strpos($_SERVER["PHP_SELF"], "".SITEMGR_ALIAS."/search")) && (!string_strpos($_SERVER["PHP_SELF"], "getMoreResults"))) {
    
        $orderLinks = true;
        
        if (string_strpos($url_base, "/".SITEMGR_ALIAS."")) { ?>
            <div class="bulkupdate-box">
                <a class="bulkUpdate" href="javascript:void(0)" onclick="showBulkUpdate(<?=RESULTS_PER_PAGE?>, 'event', '<?=system_showText(LANG_SITEMGR_CLOSE_BULK);?>', '<?=system_showText(LANG_SITEMGR_BULK_UPDATE);?>')" id="open_bulk">
                    <?=system_showText(LANG_SITEMGR_BULK_UPDATE);?>
                </a>
            </div>
        <? }
        
        if (string_strpos($_SERVER["PHP_SELF"], "/".SITEMGR_ALIAS."/".EVENT_FEATURE_FOLDER."/search") !== false) {
            $actionBulk = system_getFormAction($_SERVER["REQUEST_URI"]);
        } else {
            $actionBulk = system_getFormAction($_SERVER["PHP_SELF"]);
        }
        
        ?>
    
        <div class="bulkupdate-box">
            
            <div class="bulkupdate-form">

                <form name="event_setting" id="event_setting" action="<?=$actionBulk?>" method="post">

                    <input type="hidden" name="account_search_bulk" id="account_search_bulk" value="" />
                    <input type="hidden" name="level_bulk" id="level_bulk" value="" />
                    <input type="hidden" name="bulkSubmit" id="bulkSubmit" value="" />

                    <div id="table_bulk" style="display: none" class="table-bulkupdate">

                        <? include(INCLUDES_DIR."/tables/table_bulkupdate.php");

                        if (string_strpos($_SERVER["PHP_SELF"], "search.php") == true) { ?>
                            <button type="button" id="bulkSubmit" name="bulkSubmit" value="Submit" class="stmgr-btn" onclick="javascript:getValuesBulkEvent();"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
                        <? } else { ?>
                            <button type="button" name="bulkSubmit" value="Submit" class="stmgr-btn" onclick="javascript:confirmBulk();"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
                        <? } ?>

                    </div>

                    <div id="idlist"></div>

                </form>

            </div>

            <div id="bulk_check" style="display:none">
            
                <div class="bulk-checkall">
                    <input type="checkbox" id="check_all" name="check_all" onclick="checkAll('event', document.getElementById('check_all'), false, <?=$itemCount;?>); removeCategoryDropDown('event', '<?=DEFAULT_URL?>');" />

                    <a class="CheckUncheck" href="javascript:void(0);" onclick="checkAll('event', document.getElementById('check_all'), true, <?=$itemCount;?>); removeCategoryDropDown('event', '<?=DEFAULT_URL?>');">
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
                    <span><?=system_showText(LANG_LABEL_TITLE)?></span>
                    <? if ($orderLinks) { ?>
                        <a href="<?=$paging_url."?order_by=title_".($order_by == "title_asc" ? "desc" : "asc")."&letter=$letter&screen=$screen".($url_search_params ? "&$url_search_params" : "")?>">
                            <i class="sitemgr-icon-arrow-<?=($order_by == "title_asc" ? "up" : "down")?>"></i>
                        </a>
                    <? } ?>
                </th>

                <th>
                    <span><?=system_showText(LANG_LABEL_LEVEL)?></span>
                    <? if ($orderLinks) { ?>
                        <a href="<?=$paging_url."?order_by=level_".($order_by == "level_asc" ? "desc" : "asc")."&letter=$letter&screen=$screen".($url_search_params ? "&$url_search_params" : "")?>">
                            <i class="sitemgr-icon-arrow-<?=($order_by == "level_asc" ? "up" : "down")?>"></i>
                        </a>
                    <? } ?>
                </th>

                <th>
                    <span><?=system_showText(LANG_LABEL_START_DATE)?></span>
                    <? if ($orderLinks) { ?>
                        <a href="<?=$paging_url."?order_by=startdate_".($order_by == "startdate_asc" ? "desc" : "asc")."&letter=$letter&screen=$screen".($url_search_params ? "&$url_search_params" : "")?>">
                            <i class="sitemgr-icon-arrow-<?=($order_by == "startdate_asc" ? "up" : "down")?>"></i>
                        </a>
                    <? } ?>
                </th>

                <? if (string_strpos($url_base, "/".SITEMGR_ALIAS."")) { ?>
                    <th>
                        <span><?=system_showText(LANG_LABEL_ACCOUNT);?></span>
                        <? if (EVENT_SCALABILITY_OPTIMIZATION != "on" && $orderLinks) { ?>
                            <a href="<?=$paging_url."?order_by=account_".($order_by == "account_asc" ? "desc" : "asc")."&letter=$letter&screen=$screen".($url_search_params ? "&$url_search_params" : "")?>">
                                <i class="sitemgr-icon-arrow-<?=($order_by == "account_asc" ? "up" : "down")?>"></i>
                            </a>
                        <? } ?>
                    </th>
                <? } else { ?>
                    <th>
                        <span><?=system_showText(LANG_LABEL_RENEWAL);?></span>
                        <? if ($orderLinks) { ?>
                            <a href="<?=$paging_url."?order_by=renewal_".($order_by == "renewal_asc" ? "desc" : "asc")."&letter=$letter&screen=$screen".($url_search_params ? "&$url_search_params" : "")?>">
                            <i class="sitemgr-icon-arrow-<?=($order_by == "renewal_asc" ? "up" : "down")?>"></i>
                            </a>
                        <? } ?>
                    </th>
                <? } ?>         

                <th>
                    <span><?=system_showText(LANG_LABEL_STATUS);?></span>
                    <? if ($orderLinks) { ?>
                        <a href="<?=$paging_url."?order_by=status_".($order_by == "status_asc" ? "desc" : "asc")."&letter=$letter&screen=$screen".($url_search_params ? "&$url_search_params" : "")?>">
                        <i class="sitemgr-icon-arrow-<?=($order_by == "status_asc" ? "up" : "down")?>"></i>
                        </a>
                    <? } ?>
                </th>

                <th></th>
                
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
            
            if ($events) foreach ($events as $event) {
                $cont++;
                $id = $event->getNumber("id");
                $eventImages = $level->getImages($event->getNumber("level"));
                if (string_strpos($url_base, "/".SITEMGR_ALIAS."") === false) {
                    if ($event->needToCheckOut()) {
                        if ($event->getPrice() > 0) $hascharge = true;
                        $hastocheckout = true;
                    }
                }

                // ---------------- //

                $sql = "SELECT payment_log_id FROM Payment_Event_Log WHERE event_id = $id ORDER BY renewal_date DESC LIMIT 1";
                $r = $db->query($sql);
                $aux_transaction_data = mysql_fetch_assoc($r);

                if($aux_transaction_data) {
                    $sql = "SELECT id,transaction_datetime FROM Payment_Log WHERE id = {$aux_transaction_data["payment_log_id"]}";
                    $r = $db->query($sql);
                    $transaction_data = mysql_fetch_assoc($r);
                } else {
                    unset($transaction_data);
                }

                // ---------------- //

                $sql = "SELECT IE.invoice_id,IE.event_id,I.id,I.status,I.payment_date FROM Invoice I,Invoice_Event IE WHERE IE.event_id = $id AND I.status = 'R' AND I.id = IE.invoice_id ORDER BY I.payment_date DESC LIMIT 1";
                $r = $db->query($sql);
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

                // ---------------- //

                ?>

                <tr>
                    <td>
                        <input type="checkbox" id="event_id<?=$cont?>" name="item_check[]" value="<?=$id?>" class="inputCheck" style="display:none" onclick="removeCategoryDropDown('event', '<?=DEFAULT_URL?>');"/>
                        <a title="<?=$event->getString("title");?>" href="<?=$url_redirect?>/view.php?id=<?=$id?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table">
                            <?=$event->getString("title", true, 40);?>
                        </a>
                    </td>
                    
                    <td>
                        <?
                        $level = new EventLevel(true);
                        $levelValues = $level->getLevelValues();
                        $levelDefault = $level->getLevel($level->getDefaultLevel());
                        $activeLevels = array();
                        foreach ($levelValues as $levelValue) {
                            if ($level->getActive($levelValue) == 'y') {
                                $activeLevels[] = $levelValue;
                            }
                        }
                        ?>
                        <a href="<?=$url_redirect?>/eventlevel.php?id=<?=$id?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table"><?=(in_array($event->getNumber("level"), $activeLevels)) ? $level->showLevel($event->getNumber("level")) : string_ucwords($levelDefault)?></a>
                    </td>

                    <td>
                        <span title="<?=$eventDate?>" style="cursor:default">
                            <?=$event->getDate("start_date");?>
                        </span>
                    </td>
                    
                    <td>
                        <? if (string_strpos($url_base, "/".SITEMGR_ALIAS."")) {
                            if ($event->getNumber("account_id")) {
                                $account = db_getFromDB("account", "id", db_formatNumber($event->getNumber("account_id")));
                                ?>
                                <a title="<?=system_showAccountUserName($account->getString("username"));?>" href="<?=$url_base?>/account/view.php?id=<?=$event->getNumber("account_id")?>" class="link-table">
                                    <?=system_showTruncatedText(system_showAccountUserName($account->getString("username")), 25);?>
                                </a>
                            <? } else { ?>
                                <span title="<?=system_showText(LANG_SITEMGR_ACCOUNTSEARCH_NOOWNER)?>" style="cursor:default">
                                    <em><?=system_showTruncatedText(LANG_SITEMGR_ACCOUNTSEARCH_NOOWNER, 15);?></em>
                                </span>
                            <? }
                        } else {
                            
                            if ($event->hasRenewalDate()) {
                                $renewal_date = format_date($event->getString("renewal_date"));
                                if ($renewal_date) $date_field = $renewal_date;
                                else $date_field = system_showText(LANG_LABEL_NEW);
                            } else {
                                $date_field = "---";
                            }
                            ?>
                            <span title="<?=$date_field?>" style="cursor:default"><?=$date_field;?></span>
                        <? } ?>
                    </td>
                    
                    <td>
                        <?
                        $changeStatus = true;
                        $status = new ItemStatus();
                        if ((!(string_strpos($url_base, "/".SITEMGR_ALIAS.""))) && (($event->getString("status") == "P") || ($event->getString("status") == "E") || ($event->getString("status") == "S" && $event->getString("suspended_sitemgr") == "y")))
                            $changeStatus = false; ?>
                        <a title="<?=$status->getStatus($event->getString("status"))?>" <? if ($changeStatus) { ?> href="<?=$url_redirect?>/settings.php?id=<?=$id?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>" <? } else { ?> href="javascript:void(0)" style="cursor:default" <? } ?> class="link-table"><?=$status->getStatusWithStyle($event->getString("status"));?></a>
                    </td>
                    
                    <td nowrap="nowrap">
                        
                        <div class="toolbar-icons-button">
                            
                            <div class="toolbar-icons">
                                
                                <ul>

                                    <li>
                                        <a href="<?=$url_redirect?>/report.php?id=<?=$id?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>">
                                            <?=system_showText(LANG_TRAFFIC_REPORTS);?>
                                        </a>
                                    </li>
                                    
                                    <li>
                                        <a href="<?=$url_redirect?>/seocenter.php?id=<?=$id?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>">
                                            <?=system_showText(LANG_LABEL_SEO_TUNING);?>
                                        </a>
                                    </li>
                                    
                                    <? if (permission_hasSMPermSection(SITEMGR_PERMISSION_LEADS)) { ?>
                                    <li>
                                        <a href="<?=$url_base?>/leads/index.php?item_type=event&item_id=<?=$id?>&item_screen=<?=$screen?>&item_letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>">
                                            <?=system_showText(LANG_LABEL_LEADS);?>
                                        </a>
                                    </li>
                                    <? }
                                    
                                    if (PAYMENTSYSTEM_FEATURE == "on" && string_strpos($url_base, "/".SITEMGR_ALIAS."")) {
                                        if ($history_lnk) { ?>
                                            <li>
                                                <a href="<?=$history_lnk?>">
                                                    <?=system_showText(LANG_SITEMGR_TRANSACTIONS);?>
                                                </a>
                                            </li>
                                        <? } else { ?>
                                            <li><?=system_showText(LANG_SITEMGR_TRANSACTIONS);?></li>
                                        <? }
                                        
                                    } ?>

                                    <li>
                                        <a href="<?=$url_redirect?>/delete.php?id=<?=$id?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>">
                                            <?=system_showText(LANG_LABEL_DELETE);?>
                                        </a>
                                    </li>
                                        
                                </ul>
                                
                            </div>
                            
                            <div class="toolbararrow"></div>
                            
                        </div>
                        
                    </td>
                    
                    <td nowrap class="main-options">
                        <a href="<?=$url_redirect?>/view.php?id=<?=$id?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>">
                            <?=system_showText(LANG_LABEL_VIEW);?>
                        </a>
                        <b>|</b>
                        <a href="<?=$url_redirect?>/event.php?id=<?=$id?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>">
                            <?=system_showText(LANG_LABEL_EDIT);?>
                        </a>
                    </td>
                    
                </tr>
                
            <? } ?>

        </table>
        
    </form>