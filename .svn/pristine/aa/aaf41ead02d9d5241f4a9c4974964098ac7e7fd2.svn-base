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
	# * FILE: /includes/tables/table_blog.php
	# ----------------------------------------------------------------------------------------------------

	setting_get("commenting_fb", $commenting_fb);
	setting_get("wp_enabled", $wp_enabled);
	$itemCount = count($posts);
	if (BLOG_WITH_WORDPRESS == "on"){
		$wp_enabled = "";
	}
?>

    <script type="text/javascript">
        function getValuesBulkBlog(){
            if (document.getElementById('delete_all').checked){
                document.getElementById("bulkSubmit").value = "Submit";
                dialogBoxBulk('confirm','<?=system_showText(LANG_SITEMGR_BULK_DELETEQUESTION);?>','Submit','blog_setting','200','<?=system_showText(LANG_SITEMGR_OK);?>','<?=system_showText(LANG_SITEMGR_CANCEL);?>');
            } else {
                document.getElementById("bulkSubmit").value = "Submit";
                dialogBoxBulk('confirm','<?=system_showText(LANG_SITEMGR_BULK_DELETEQUESTION2);?>','Submit','blog_setting','180','<?=system_showText(LANG_SITEMGR_OK);?>','<?=system_showText(LANG_SITEMGR_CANCEL);?>');
            }
        }

        function confirmBulk(){

            <? if (BLOGCATEGORY_SCALABILITY_OPTIMIZATION == "on") { ?>
                feed = document.blog_setting.feed;
                return_categories = document.blog_setting.return_categories;
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
                dialogBoxBulk('confirm','<?=system_showText(LANG_SITEMGR_BULK_DELETEQUESTION);?>','Submit','blog_setting','200','<?=system_showText(LANG_SITEMGR_OK);?>','<?=system_showText(LANG_SITEMGR_CANCEL);?>');
            } else {
                document.getElementById("bulkSubmit").value = "Submit";
                dialogBoxBulk('confirm','<?=system_showText(LANG_SITEMGR_BULK_DELETEQUESTION2);?>','Submit','blog_setting','180','<?=system_showText(LANG_SITEMGR_OK);?>','<?=system_showText(LANG_SITEMGR_CANCEL);?>');
            }
        }
    </script>

    <? 
    
    //Success and Error Messages
    if (is_numeric($message) && isset($msg_post[$message])) {
        echo "<p class=\"successMessage\">".$msg_post[$message]."</p>";
    }
    if (is_numeric($error_message)) {
        echo "<p class=\"errorMessage\">".$msg_bulkupdate[$error_message]."</p>";
    } elseif ($error_msg) {
        echo "<p class=\"errorMessage\">".$error_msg."</p>";
    } elseif ($msg == "success") {
        echo "<p class=\"successMessage\">".LANG_MSG_BLOG_SUCCESSFULLY_UPDATE."</p>";
    } elseif ($msg == "successdel") {
        echo "<p class=\"successMessage\">".LANG_MSG_BLOG_SUCCESSFULLY_DELETE."</p>";
    }
    unset($msg);
    
    //Bulk update and Ordination validation
    $orderLinks = false;
    if ((!string_strpos($_SERVER["PHP_SELF"], "".SITEMGR_ALIAS."/search")) && (!string_strpos($_SERVER["PHP_SELF"], "getMoreResults"))) {

        $orderLinks = true; ?>

        <div class="bulkupdate-box">
            <a class="bulkUpdate" href="javascript:void(0)" onclick="showBulkUpdate( <?=RESULTS_PER_PAGE?>, 'blog', '<?=system_showText(LANG_SITEMGR_CLOSE_BULK);?>', '<?=system_showText(LANG_SITEMGR_BULK_UPDATE);?>')" id="open_bulk">
                <?=system_showText(LANG_SITEMGR_BULK_UPDATE);?>
            </a>
        </div>

        <? if (string_strpos($_SERVER["PHP_SELF"], "/".SITEMGR_ALIAS."/".BLOG_FEATURE_FOLDER."/search") !== false) {
            $actionBulk = system_getFormAction($_SERVER["REQUEST_URI"]);
        } else {
            $actionBulk = system_getFormAction($_SERVER["PHP_SELF"]);
        }
        
        ?>
    
        <div class="bulkupdate-box">

            <div class="bulkupdate-form">

                <form name="blog_setting" id="blog_setting" action="<?=$actionBulk?>" method="post">

                    <input type="hidden" name="bulkSubmit" id="bulkSubmit" value="" />

                    <div id="table_bulk" style="display: none" class="table-bulkupdate">

                        <? include(INCLUDES_DIR."/tables/table_bulkupdate.php");
                        
                        if (string_strpos($_SERVER["PHP_SELF"], "search.php") == true) { ?>
                            <button type="button" id="bulkSubmit" name="bulkSubmit" value="Submit" class="stmgr-btn" onclick="javascript:getValuesBulkBlog();"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
                        <? } else { ?>
                            <button type="button" name="bulkSubmit" value="Submit" class="stmgr-btn" onclick="javascript:confirmBulk();"><?=system_showText(LANG_SITEMGR_SUBMIT)?></button>
                        <? } ?>

                    </div>

                    <div id="idlist"></div>

                </form>
    
            </div>

            <div id="bulk_check" style="display:none">
                
                <div class="bulk-checkall">
                    <input type="checkbox" id="check_all" name="check_all" onclick="checkAll('blog', document.getElementById('check_all'), false, <?=$itemCount?>); removeCategoryDropDown('blog', '<?=DEFAULT_URL?>');" />
                    
                    <a class="CheckUncheck" href="javascript:void(0);" onclick="checkAll('blog', document.getElementById('check_all'), true, <?=$itemCount?>); removeCategoryDropDown('blog', '<?=DEFAULT_URL?>');">
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
                    <span><?=system_showText(LANG_LABEL_STATUS);?></span>
                    <? if ($orderLinks) { ?>
                        <a href="<?=$paging_url."?order_by=status_".($order_by == "status_asc" ? "desc" : "asc")."&letter=$letter&screen=$screen".($url_search_params ? "&$url_search_params" : "")?>">
                            <i class="sitemgr-icon-arrow-<?=($order_by == "status_asc" ? "up" : "down")?>"></i>
                        </a>
                    <? } ?>
                </th>

                <th style="width:20px;"></th>

                <th class="text-center">
                    <?=system_showText(LANG_LABEL_OPTIONS)?>
                </th>

            </tr>

            <?
            $cont = 0;
            if ($posts) foreach ($posts as $post_info) {
                $cont++;
                $id = $post_info->getNumber("id");
                ?>

                <tr>
                    <td>
                        <input type="checkbox" id="blog_id<?=$cont?>" name="item_check[]" value="<?=$id?>" class="inputCheck" style="display:none" onclick="removeCategoryDropDown('blog', '<?=DEFAULT_URL?>');"/>
                        <a title="<?=$post_info->getString("title");?>" href="<?=$url_redirect?>/view.php?id=<?=$id?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>" class="link-table">
                            <?=$post_info->getString("title");?>
                        </a>				
                    </td>
                    
                    <td>
                        <?
                        $status = new ItemStatus();
                        ?>
                        <a href="<?=$url_redirect?>/settings.php?id=<?=$id?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>" title="<?=$status->getStatus($post_info->getString("status"));?>">
                            <?=$status->getStatusWithStyle($post_info->getString("status"));?>
                        </a>
                    </td>

                    <td nowrap>
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

                                    <? if ($commenting_fb == "on") { ?>
                                        <li>
                                            <a href="<?=$url_redirect?>/facebook.php?id=<?=$id?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>">
                                                <?=system_showText(LANG_LABEL_FACEBOOK_COMMENTS);?>
                                            </a>
                                        </li>
                                    <? } ?>

                                    <li>
                                        <a href="<?=$url_redirect?>/delete.php?id=<?=$id?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>">
                                            <?=system_showText(LANG_SITEMGR_DELETE)?>
                                        </a>
                                    </li>
                                </ul>
                                
                            </div>
                            
                            <div class="toolbararrow"></div>
                            
                        </div>
                        
                    </td>

                    <td nowrap class="main-options text-center"> 
                        <a href="<?=$url_redirect?>/view.php?id=<?=$id?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>">
                            <?=system_showText(LANG_SITEMGR_VIEW)?>
                        </a>

                        <? if (!$wp_enabled){ ?>
                        <b>|</b>
                        <a href="<?=$url_redirect?>/blog.php?id=<?=$id?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>">
                            <?=system_showText(LANG_SITEMGR_EDIT)?>
                        </a>
                        <? } ?>
                    </td>
                    
                </tr>

                <? } ?>

        </table>
        
    </form>