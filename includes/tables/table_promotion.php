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
    # * FILE: /includes/tables/table_promotion.php
    # ----------------------------------------------------------------------------------------------------

?>

    <script type="text/javascript">
        function getValuesBulkPromotion(){

            if(document.getElementById('change_no_owner').value == "on"){
                document.getElementById("account_search_bulk").value = "0";
            }else if (document.getElementById("change_account_id")) {
                document.getElementById("account_search_bulk").value = document.getElementById("change_account_id").value;
            }

            if (document.getElementById('delete_all').checked){
                document.getElementById("bulkSubmit").value = "Submit";
                dialogBoxBulk('confirm','<?=system_showText(LANG_SITEMGR_BULK_DELETEQUESTION);?>','Submit','promotion_setting','200','<?=system_showText(LANG_SITEMGR_OK);?>','<?=system_showText(LANG_SITEMGR_CANCEL);?>');
            } else {
                document.getElementById("bulkSubmit").value = "Submit";
                dialogBoxBulk('confirm','<?=system_showText(LANG_SITEMGR_BULK_DELETEQUESTION2);?>','Submit','promotion_setting','180','<?=system_showText(LANG_SITEMGR_OK);?>','<?=system_showText(LANG_SITEMGR_CANCEL);?>');
            }
        }

        function confirmBulk(){
            if (document.getElementById('delete_all').checked){
                document.getElementById("bulkSubmit").value = "Submit";
                dialogBoxBulk('confirm','<?=system_showText(LANG_SITEMGR_BULK_DELETEQUESTION);?>','Submit','promotion_setting','200','<?=system_showText(LANG_SITEMGR_OK);?>','<?=system_showText(LANG_SITEMGR_CANCEL);?>');
            } else {
                document.getElementById("bulkSubmit").value = "Submit";
                dialogBoxBulk('confirm','<?=system_showText(LANG_SITEMGR_BULK_DELETEQUESTION2);?>','Submit','promotion_setting','180','<?=system_showText(LANG_SITEMGR_OK);?>','<?=system_showText(LANG_SITEMGR_CANCEL);?>');
            }
        }   
    </script>

    <?
    setting_get('commenting_edir', $commenting_edir);
    setting_get('commenting_fb', $commenting_fb);
    setting_get("review_promotion_enabled", $review_enabled);
    
    $itemCount = count($promotions);

    //Success and Error Messages
    if ($errorAttachMessage) {
        echo "<p class=\"errorMessage\">".$errorAttachMessage."</p>";
    } elseif ($successAttachMessage == "success") {
        echo "<p class=\"successMessage\">".LANG_MSG_PROMOTION_SUCCESSFULLY_UPDATE."</p>";
    }
    if (is_numeric($message) && isset($msg_promotion[$message]) && !$errorAttachMessage && $successAttachMessage != "success") {
        echo "<p class=\"successMessage\">".$msg_promotion[$message]."</p>";
        echo "<p class=\"informationMessage\">".LANG_MS_MANGE_DEAL_TIP."</p>";
        if ($extra_message && string_strpos($url_base, "/".SITEMGR_ALIAS."")) { 
            echo "<p class=\"informationMessage\">".system_showText(LANG_PROMOTION_EXTRAMESSAGE)."</p>";
        }
    }
    if (is_numeric($error_message)) {
        echo "<p class=\"errorMessage\">".$msg_bulkupdate[$error_message]."</p>";
    } elseif ($msg == "success") {
        echo "<p class=\"successMessage\">".LANG_MSG_PROMOTION_SUCCESSFULLY_UPDATE."</p>";
    } elseif ($msg == "successdel") {
        echo "<p class=\"successMessage\">".LANG_MSG_PROMOTION_SUCCESSFULLY_DELETE."</p>";
    }
    unset($msg);

    //Bulk update and Ordination validation
    $orderLinks = false;
    if ((!string_strpos($_SERVER["PHP_SELF"], "".SITEMGR_ALIAS."/search")) && (!string_strpos($_SERVER["PHP_SELF"], "getMoreResults"))) {
        
        $orderLinks = true;
        
        if (string_strpos($url_base, "/".SITEMGR_ALIAS."")) { ?>
            <div class="bulkupdate-box">   
                <a class="bulkUpdate" href="javascript:void(0)" onclick="showBulkUpdate(<?=RESULTS_PER_PAGE?>, 'promotion', '<?=system_showText(LANG_SITEMGR_CLOSE_BULK);?>', '<?=system_showText(LANG_SITEMGR_BULK_UPDATE);?>')" id="open_bulk">
                    <?=system_showText(LANG_SITEMGR_BULK_UPDATE);?>
                </a>
            </div>
        <? }
        
        if (string_strpos($_SERVER["PHP_SELF"], "/".SITEMGR_ALIAS."/".PROMOTION_FEATURE_FOLDER."/search") !== false) {
            $actionBulk = system_getFormAction($_SERVER["REQUEST_URI"]);
        } else {
            $actionBulk = system_getFormAction($_SERVER["PHP_SELF"]);
        }
        
        ?>
    
        <div class="bulkupdate-box">

            <div class="bulkupdate-form">

                <form name="promotion_setting" id="promotion_setting" action="<?=$actionBulk?>" method="post">

                    <input type="hidden" name="account_search_bulk" id="account_search_bulk" value="" />
                    <input type="hidden" name="bulkSubmit" id="bulkSubmit" value="" />
                    
                    <div id="table_bulk" style="display: none" class="table-bulkupdate">
                        
                        <? include(INCLUDES_DIR."/tables/table_bulkupdate.php"); 
                        
                        if (string_strpos($_SERVER["PHP_SELF"], "search.php") == true) { ?>
                            <button type="button" id="bulkSubmit" name="bulkSubmit" value="Submit" class="stmgr-btn" onclick="javascript:getValuesBulkPromotion();"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
                        <? } else { ?>
                            <button type="button" name="bulkSubmit" value="Submit" class="stmgr-btn" onclick="javascript:confirmBulk();"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
                        <? } ?>
                            
                    </div>
                    
                    <div id="idlist"></div>
                    
                </form>
                
            </div> 

            <div id="bulk_check" style="display:none">
                
               <div class="bulk-checkall"> 
                    <input type="checkbox" id="check_all" name="check_all" onclick="checkAll('promotion', document.getElementById('check_all'), false, <?=$itemCount;?>); removeCategoryDropDown('promotion', '<?=DEFAULT_URL?>');" />
                    
                    <a class="CheckUncheck" href="javascript:void(0);" onclick="checkAll('promotion', document.getElementById('check_all'), true, <?=$itemCount;?>); removeCategoryDropDown('promotion', '<?=DEFAULT_URL?>');">
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
                        <a href="<?=$paging_url."?order_by=name_".($order_by == "name_asc" ? "desc" : "asc")."&letter=$letter&screen=$screen".($url_search_params ? "&$url_search_params" : "")?>">
                            <i class="sitemgr-icon-arrow-<?=($order_by == "name_asc" ? "up" : "down")?>"></i>
                        </a>
                    <? } ?>
                </th>

                <? if (string_strpos($url_base, "/".MEMBERS_ALIAS."")) { ?>
                    <th class="account"><?=system_showText(LANG_LABEL_ATTACHED_LISTING)?></th>
                <? } ?>

                <? if (string_strpos($url_base, "/".SITEMGR_ALIAS."")) { ?>
                    <th class="account">
                        <span><?=system_showText(LANG_LABEL_ACCOUNT);?></span>                        
                        <? if (PROMOTION_SCALABILITY_OPTIMIZATION != "on" && $orderLinks) { ?>
                            <a href="<?=$paging_url."?order_by=account_".($order_by == "account_asc" ? "desc" : "asc")."&letter=$letter&screen=$screen".($url_search_params ? "&$url_search_params" : "")?>">
                                <i class="sitemgr-icon-arrow-<?=($order_by == "account_asc" ? "up" : "down")?>"></i>
                            </a>
                        <? } ?>
                    </th>
                <? } ?>
                    
                <th width="30px"></th> 
                
                <th width="130px" class="text-center"><?=system_showText(LANG_LABEL_OPTIONS)?></th>
            </tr>

            <?
            $cont = 0;
            
            $dbMain = db_getDBObject(DEFAULT_DB, true);
            $db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
            
            foreach($promotions as $promotion) {
                $cont++;
                $id = $promotion->getNumber("id");
                ?>
                <tr class="tr-table">
                    
                    <td class="td-table title">
                        <input type="checkbox" id="promotion_id<?=$cont?>" name="item_check[]" value="<?=$id?>" class="inputCheck" style="display:none" onclick="removeCategoryDropDown('promotion', '<?=DEFAULT_URL?>');"/>
                        <a title="<?=$promotion->getString("name")?>" href="<?=$url_redirect?>/view.php?id=<?=$id?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>">
                            <?=$promotion->getString("name", true, 40);?>
                        </a>
                    </td>
                    
                    <? if (string_strpos($url_base, "/".SITEMGR_ALIAS."")) { ?>
                        <td class="td-table account">
                            <? 
                            if ($promotion->getNumber("account_id")) {
                                $account = db_getFromDB("account", "id", db_formatNumber($promotion->getNumber("account_id")));
                                ?>
                                <a title="<?=system_showAccountUserName($account->getString("username"));?>" href="<?=$url_base?>/account/view.php?id=<?=$promotion->getNumber("account_id")?>">
                                    <?=system_showTruncatedText(system_showAccountUserName($account->getString("username")), 15);?>
                                </a>
                                <? 
                            } else { 
                                ?>
                                <span title="<?=system_showText(LANG_SITEMGR_ACCOUNTSEARCH_NOOWNER)?>" style="cursor:default">
                                    <em><?=system_showTruncatedText(LANG_SITEMGR_ACCOUNTSEARCH_NOOWNER, 15);?></em>
                                </span>
                                <?  
                            } 
                            ?>
                        </td>
                    <? 
                    }

                    if (string_strpos($url_base, "/".MEMBERS_ALIAS."")) { ?>
                        <td class="td-table account">
                            <?=system_getAttachListingDropdown(sess_getAccountIdFromSession(), $id, $cont);?>
                        </td>
                    <? } ?>
                        
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
                                        $sql ="SELECT * FROM Review WHERE item_type = 'promotion' AND item_id = '".$promotion->getString("id")."' AND status = 'A' LIMIT 1";
                                        $r = $db->query($sql);
                                        if (mysql_affected_rows() > 0) { ?>
                                            <li>
                                                <a href="<?=$url_base?>/review/index.php?item_type=promotion&item_id=<?=$id?>&filter_id=1&item_screen=<?=$screen?>&item_letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>">
                                                    <?=system_showText(LANG_REVIEW_PLURAL);?>
                                                </a>
                                            </li>
                                        <? } else { ?>
                                            <li><?=system_showText(LANG_REVIEW_PLURAL);?></li>
                                        <? }
                                    }

                                    if ($commenting_fb == "on") { ?>
                                        <li> <a href="<?=$url_redirect?>/facebook.php?id=<?=$id?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>">
                                            <?=system_showText(LANG_LABEL_FACEBOOK_COMMENTS);?>
                                        </a></li>
                                    <? } ?>

                                    <li>
                                        <a href="<?=$url_redirect?>/delete.php?id=<?=$id?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>" >
                                            <?=system_showText(LANG_LABEL_DELETE)?>
                                        </a>
                                    </li>
                                    
                                </ul>
                                
                            </div>
                            
                        <div class="toolbararrow"></div>
                        
                        </div>
                        
                    </td>
                    
                    <td nowrap class="main-options text-center">
                        <a href="<?=$url_redirect?>/view.php?id=<?=$id?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>">
                            <?=system_showText(LANG_LABEL_VIEW)?>
                        </a>
                        <b>|</b>
                        <a href="<?=$url_redirect?>/deal.php?id=<?=$id?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>">
                            <?=system_showText(LANG_LABEL_EDIT)?>
                        </a>
                    </td>

                </tr>

        <? } ?>

        </table>
        
        <? if (string_strpos($url_base, "/".MEMBERS_ALIAS."")) { ?>
            <input type="hidden" name="total_promotion" id="total_promotion" value="<?=$cont?>" />
        <? } ?>
            
    </form>