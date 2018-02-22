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
	# * FILE: /includes/tables/table_listing.php
	# ----------------------------------------------------------------------------------------------------

	setting_get('commenting_edir', $commenting_edir);
	setting_get('commenting_fb', $commenting_fb);
	setting_get("review_listing_enabled", $review_enabled);
?>

    <script type="text/javascript">
        function getValuesBulkListing(){

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
                dialogBoxBulk('confirm','<?=system_showText(LANG_SITEMGR_BULK_DELETEQUESTION);?>','Submit','listing_setting','200','<?=system_showText(LANG_SITEMGR_OK);?>','<?=system_showText(LANG_SITEMGR_CANCEL);?>');
            } else {
                document.getElementById("bulkSubmit").value = "Submit";
                dialogBoxBulk('confirm','<?=system_showText(LANG_SITEMGR_BULK_DELETEQUESTION2);?>','Submit','listing_setting','180','<?=system_showText(LANG_SITEMGR_OK);?>','<?=system_showText(LANG_SITEMGR_CANCEL);?>');
            }
        }

        function confirmBulk(){

            <? if (LISTINGCATEGORY_SCALABILITY_OPTIMIZATION == "on") { ?>
                feed = document.listing_setting.feed;
                return_categories = document.listing_setting.return_categories;
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
                dialogBoxBulk('confirm','<?=system_showText(LANG_SITEMGR_BULK_DELETEQUESTION);?>','Submit','listing_setting','200','<?=system_showText(LANG_SITEMGR_OK);?>','<?=system_showText(LANG_SITEMGR_CANCEL);?>');
            } else {
                document.getElementById("bulkSubmit").value = "Submit";
                dialogBoxBulk('confirm','<?=system_showText(LANG_SITEMGR_BULK_DELETEQUESTION2);?>','Submit','listing_setting','180','<?=system_showText(LANG_SITEMGR_OK);?>','<?=system_showText(LANG_SITEMGR_CANCEL);?>');
            }
        }
    </script>
    
    <?
    $level = new ListingLevel(true);
    $levelvalues = $level->getLevelValues();
    $itemCount = count($listings);
    
    //Success and Error Messages
    if (is_numeric($message) && isset($msg_listing[$message])) {
        echo "<p class=\"successMessage\">".$msg_listing[$message]."</p>";
    } 
    if ($extramessage_promotion && PROMOTION_FEATURE == "on" && CUSTOM_PROMOTION_FEATURE == "on") {
        echo "<p class=\"informationMessage\">".system_showText(LANG_LISTING_CLICK_PROMOTION_BELOW)." <em>".system_showText(LANG_LISTING_PROMOTION_ICON)."</em> <img src=\"".DEFAULT_URL."/images/icon_promo.gif\" border=\"0\" /> ".system_showText(LANG_LISTING_IFYOUWISHADDPROMOTION)."</p>";
    }
    if (is_numeric($error_message)) {
        echo "<p class=\"errorMessage\">".$msg_bulkupdate[$error_message]."</p>";
    } elseif ($error_msg) {
        echo "<p class=\"errorMessage\">".$error_msg."</p>";
    } elseif ($msg == "success") {
        echo "<p class=\"successMessage\">".LANG_MSG_LISTING_SUCCESSFULLY_UPDATE."</p>";
    } elseif ($msg == "successdel") {
        echo "<p class=\"successMessage\">".LANG_MSG_LISTING_SUCCESSFULLY_DELETE."</p>";
    }
    unset($msg);
    
    //Bulk update and Ordination validation
    $orderLinks = false;
    if ((!string_strpos($_SERVER["PHP_SELF"], "".SITEMGR_ALIAS."/search")) && (!string_strpos($_SERVER["PHP_SELF"], "getMoreResults"))) {

        $orderLinks = true;
        
        if (string_strpos($url_base, "/".SITEMGR_ALIAS."")) { ?>
            <div class="bulkupdate-box">
                <a class="bulkUpdate" href="javascript:void(0)" onclick="showBulkUpdate(<?=RESULTS_PER_PAGE?>, 'listing', '<?=system_showText(LANG_SITEMGR_CLOSE_BULK);?>', '<?=system_showText(LANG_SITEMGR_BULK_UPDATE);?>')" id="open_bulk">
                    <?=system_showText(LANG_SITEMGR_BULK_UPDATE);?>
                </a>                    
            </div>
        <? }
        
        if (string_strpos($_SERVER["PHP_SELF"], "/".SITEMGR_ALIAS."/".LISTING_FEATURE_FOLDER."/search") !== false) {
            $actionBulk = system_getFormAction($_SERVER["REQUEST_URI"]);
        } else {
            $actionBulk = system_getFormAction($_SERVER["PHP_SELF"]);
        }
        
        ?>

        <div class="bulkupdate-box">
            
            <div class="bulkupdate-form">

                <form name="listing_setting" id="listing_setting" action="<?=$actionBulk?>" method="post">
                    
                    <input type="hidden" name="account_search_bulk" id="account_search_bulk" value="" />
                    <input type="hidden" name="level_bulk" id="level_bulk" value="" />
                    <input type="hidden" name="bulkSubmit" id="bulkSubmit" value="" />
                    
                    <div id="table_bulk" style="display: none" class="table-bulkupdate">
                        
                        <? include(INCLUDES_DIR."/tables/table_bulkupdate.php");
                        
                        if (string_strpos($_SERVER["PHP_SELF"], "search.php") == true) { ?>
                            <button type="button" id="bulkSubmit" name="bulkSubmit" value="Submit" class="stmgr-btn" onclick="javascript:getValuesBulkListing();"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
                        <? } else { ?>
                            <button type="button" name="bulkSubmit" value="Submit" class="stmgr-btn" onclick="javascript:confirmBulk();"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
                        <? } ?>
                            
                    </div>
                    
                    <div id="idlist"></div>
                    
                </form>
                
            </div>

            <div id="bulk_check" style="display:none">
                
                <div class="bulk-checkall">
                    <input type="checkbox" id="check_all" name="check_all" onclick="checkAll('listing', document.getElementById('check_all'), false, <?=$itemCount;?>); removeCategoryDropDown('listing', '<?=DEFAULT_URL?>');" />
               
                    <a class="CheckUncheck" href="javascript:void(0);" onclick="checkAll('listing', document.getElementById('check_all'), true, <?=$itemCount;?>); removeCategoryDropDown('listing', '<?=DEFAULT_URL?>');">
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
                	<span><?=system_showText(LANG_LABEL_TITLE);?></span>
					<? if ($orderLinks) { ?>
                    	<a href="<?=$paging_url."?order_by=title_".($order_by == "title_asc" ? "desc" : "asc")."&letter=$letter&screen=$screen".($url_search_params ? "&$url_search_params" : "")?>">
                            <i class="sitemgr-icon-arrow-<?=($order_by == "title_asc" ? "up" : "down")?>"></i>
                        </a>
                    <? } ?>
                </th>

                <th>
                	<span><?=system_showText(LANG_LABEL_LEVEL);?></span>
					<? if ($orderLinks) { ?>
                    	<a href="<?=$paging_url."?order_by=level_".($order_by == "level_asc" ? "desc" : "asc")."&letter=$letter&screen=$screen".($url_search_params ? "&$url_search_params" : "")?>">
                            <i class="sitemgr-icon-arrow-<?=($order_by == "level_asc" ? "up" : "down")?>"></i>
                        </a>
                    <? } ?>
                </th>

                <? if (string_strpos($url_base, "/".SITEMGR_ALIAS."")) { ?>
                    <th>
                    	<span><?=system_showText(LANG_LABEL_ACCOUNT);?></span>
						<? if (LISTING_SCALABILITY_OPTIMIZATION != "on" && $orderLinks) { ?>
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

            if ($listings) foreach ($listings as $listing) {
                $listing = new Listing($listing->getNumber("id"));
                $cont++;
                $id = $listing->getNumber("id");
                $listingImages = $level->getImages($listing->getNumber("level"));
                $listingHasPromotion = $level->getHasPromotion($listing->getNumber("level"));
                $listingHasClickToCall = $level->getHasCall($listing->getNumber("level"));
                $listingHasDetail = $level->getDetail($listing->getNumber("level"));
                $listingHasBacklink = $level->getBacklink($listing->getNumber("level"));
                if (string_strpos($url_base, "/".SITEMGR_ALIAS."") === false) {
                    if ($listing->needToCheckOut()) {
                        if ($listing->getPrice() > 0) $hascharge = true;
                        $hastocheckout = true;
                    }
                }

                // ---------------- //

                $sql = "SELECT payment_log_id FROM Payment_Listing_Log WHERE listing_id = $id ORDER BY renewal_date DESC LIMIT 1";
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

                $sql = "SELECT IL.invoice_id,IL.listing_id,I.id,I.status,I.payment_date FROM Invoice I,Invoice_Listing IL WHERE IL.listing_id = $id AND I.status = 'R' AND I.id = IL.invoice_id ORDER BY I.payment_date DESC LIMIT 1";
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
                        <input type="checkbox" id="listing_id<?=$cont?>" name="item_check[]" value="<?=$id?>" class="inputCheck" style="display:none" onclick="removeCategoryDropDown('listing', '<?=DEFAULT_URL?>');"/>
                        <a title="<?=$listing->getString("title");?>" href="<?=$url_redirect?>/view.php?id=<?=$id?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>">
                            <?=$listing->getString("title", true, 40);?>
                        </a>
                    </td>
                    
                    <td>
                        <?
                        $level = new ListingLevel(true);
                        $levelValues = $level->getLevelValues();
                        $levelDefault = $level->getLevel($level->getDefaultLevel());
                        $activeLevels = array();
                        foreach ($levelValues as $levelValue) {
                            if ($level->getActive($levelValue) == 'y') {
                                $activeLevels[] = $levelValue;
                            }
                        }
                        ?>
                        <a href="<?=$url_redirect?>/listinglevel.php?id=<?=$id?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>"><?=(in_array($listing->getNumber("level"), $activeLevels)) ? $level->showLevel($listing->getNumber("level")) : string_ucwords($levelDefault)?></a>
                    </td>
                    
                    <td>
                        <? if (string_strpos($url_base, "/".SITEMGR_ALIAS."")) {
                            if ($listing->getNumber("account_id")) {
                                $account = db_getFromDB("account", "id", db_formatNumber($listing->getNumber("account_id")));
                                ?>
                                <a title="<?=system_showAccountUserName($account->getString("username"))?>" href="<?=$url_base?>/account/view.php?id=<?=$listing->getNumber("account_id")?>" class="link-table">
                                    <?=system_showAccountUserName($account->getString("username"));?>
                                </a>
                            <? } else { ?>
                                <span title="<?=system_showText(LANG_SITEMGR_ACCOUNTSEARCH_NOOWNER)?>" style="cursor:default">
                                    <em><?=system_showTruncatedText(LANG_SITEMGR_ACCOUNTSEARCH_NOOWNER, 15);?></em>
                                </span>
                            <? } 
                        } else {
                            
                            if ($listing->hasRenewalDate()) {
                                $renewal_date = format_date($listing->getString("renewal_date"));
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
                        if ((!(string_strpos($url_base, "/".SITEMGR_ALIAS.""))) && (($listing->getString("status") == "P") || ($listing->getString("status") == "E") || ($listing->getString("status") == "S" && $listing->getString("suspended_sitemgr") == "y")))
                            $changeStatus = false; ?>
                        <a title="<?=$status->getStatus($listing->getString("status"))?>" <? if ($changeStatus) { ?> href="<?=$url_redirect?>/settings.php?id=<?=$id?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>" <? } else { ?> href="javascript:void(0);" style="cursor:default" <? } ?>  class="link-table"><?=$status->getStatusWithStyle($listing->getString("status"));?></a>
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

                                    <?
                                    if (($review_enabled == "on" && $commenting_edir) || string_strpos($url_base, "/".SITEMGR_ALIAS."")) {
                                        $sql ="SELECT * FROM Review WHERE item_type = 'listing' AND item_id = '".$listing->getString("id")."' AND status = 'A' LIMIT 1";
                                        $r = $db->query($sql);
                                        if (mysql_affected_rows() > 0) { ?>
                                            <li>
                                                <a href="<?=$url_base?>/review/index.php?item_type=listing&item_id=<?=$id?>&filter_id=1&item_screen=<?=$screen?>&item_letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>">
                                                    <?=system_showText(LANG_REVIEW_PLURAL);?>
                                                </a>
                                            </li>
                                        <? } else { ?>
                                            <li><?=system_showText(LANG_REVIEW_PLURAL);?></li>
                                            <? }
                                    }
                                    
                                    if (permission_hasSMPermSection(SITEMGR_PERMISSION_LEADS)) { ?>
                                        <li>
                                            <a href="<?=$url_base?>/leads/index.php?item_type=listing&item_id=<?=$id?>&item_screen=<?=$screen?>&item_letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>">
                                                <?=system_showText(LANG_LABEL_LEADS);?>
                                            </a>
                                        </li>
                                    <? }
                                    
                                    if (PROMOTION_FEATURE == "on" && CUSTOM_PROMOTION_FEATURE == "on" && CUSTOM_HAS_PROMOTION == "on" ) {
                                        
                                        if ($listingHasPromotion == "y") { ?>
                                            <li>
                                                <a href="<?=$url_redirect?>/deal.php?id=<?=$id?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>">
                                                    <?=system_showText(LANG_PROMOTION_FEATURE_NAME);?>
                                                </a>
                                            </li>
                                        <? } else { ?>
                                            <li><?=system_showText(LANG_PROMOTION_FEATURE_NAME);?></li>
                                        <? }
                                    }
                                    
                                    if (TWILIO_APP_ENABLED == "on" && TWILIO_APP_ENABLED_CALL == "on") { ?>
                                        <li>
                                            <? if ($listingHasClickToCall == "y") { ?>
                                                <a href="<?=$url_redirect?>/clicktocall.php?id=<?=$id?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>">
                                                    <?=system_showText(LANG_LABEL_CLICKTOCALL);?>
                                                </a>
                                            <? } else { ?>
                                                <?=system_showText(LANG_LABEL_CLICKTOCALL);?>
                                            <? } ?>
                                        </li>
                                    <? }
                                    
                                    if ($commenting_fb == "on") { ?>
                                        <li>
                                            <? if ($listingHasDetail == "y") { ?>
                                            <a href="<?=$url_redirect?>/facebook.php?id=<?=$id?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>">
                                                <?=system_showText(LANG_LABEL_FACEBOOK_COMMENTS);?>
                                            </a>
                                            <? } else { ?>
                                                <?=system_showText(LANG_LABEL_FACEBOOK_COMMENTS);?>
                                            <? } ?>
                                        </li>
                                    <? }
                                    
                                    if (BACKLINK_FEATURE == "on") { ?>
                                        <li>
                                            <? if ($listingHasBacklink == "y") { ?>
                                                <a href="<?=$url_redirect?>/backlinks.php?id=<?=$id?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>">
                                                    <?=system_showText(LANG_LABEL_BACKLINK);?>
                                                </a>
                                            <? } else { ?>
                                                <?=system_showText(LANG_LABEL_BACKLINK);?>
                                            <? } ?>
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
                                    }
                                    
                                    if (string_strpos($url_base, "/".SITEMGR_ALIAS."")) { ?>
                                        <li>
                                            <a href="<?=$url_redirect?>/delete.php?id=<?=$id?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>">
                                                <?=system_showText(LANG_LABEL_DELETE);?>
                                            </a>
                                        </li>
                                    <? } ?>
                                        
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
                        <a href="<?=$url_redirect?>/listing.php?id=<?=$id?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>">
                            <?=system_showText(LANG_LABEL_EDIT);?>
                        </a>
                    </td>
                    
                </tr>

            <? } ?>

        </table>
        
	</form>