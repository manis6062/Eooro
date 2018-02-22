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
	# * FILE: /includes/forms/form_mailapplist.php
	# ----------------------------------------------------------------------------------------------------

?>

    <script language="javascript" type="text/javascript">

        function showCategoriesByModule(moduleName) {
            
            if (moduleName == "all") {
                
                $("#div_step_2").toggle('slow');
                $('#label_step_3').text("2");
                $('#label_step_4').text("3");
                
            } else {
                
                $("#div_step_2").fadeIn();
                $('#label_step_3').text("3");
                $('#label_step_4').text("4");
            
                <? foreach ($availableModules as $avModule) { ?>
                    $("#categories_<?=ucfirst($avModule);?>").css("display", "none");
                    $("#<?=$avModule;?>_categorytree_id_0").html("&nbsp;");
                <? } ?>

                if (moduleName) {

                    if (moduleName == 'Listing') {
                        loadCategoryTree('all', 'listing_', 'ListingCategory', 0, 0, '<?=DEFAULT_URL."/".EDIR_CORE_FOLDER_NAME."/".LISTING_FEATURE_FOLDER?>',<?=SELECTED_DOMAIN_ID?>);
                    } else {
                        loadCategoryTree('all', moduleName.toLowerCase()+'_', moduleName+'Category', 0, 0, '<?=DEFAULT_URL?>',<?=SELECTED_DOMAIN_ID?>);
                    }

                    if ($('#divCategories').css('display') == 'none') {
                        $("#divCategories").fadeIn();
                    }
                    if ($('#divAll').css('display') == 'none') {
                        $("#divAll").fadeIn();
                    }
                    $("#categories_"+moduleName).fadeIn();

                } else {
                    $("#divAll").fadeOut();
                    $("#divCategories").css("display", "none");
                }
                
            }
            
        }
        
        function JS_addCategory(id) {
            var selectedModule = document.mailapp.module.value;
            var id_aux = "";
            var text_aux = "";
            
            switch (selectedModule) {
                case "Listing" :    feed = document.mailapp.feed_listing;
                                    id_aux = "listing_"+id;
                                    break;
                case "Event" :      feed = document.mailapp.feed_event;
                                    id_aux = "event_"+id;
                                    break;
                case "Classified" : feed = document.mailapp.feed_classified;
                                    id_aux = "classified_"+id;
                                    break;
                case "Article" :    feed = document.mailapp.feed_article;
                                    id_aux = "article_"+id;
                                    break;
            }
            
            feedAll = document.mailapp.feed_all;
            
            var text = unescapeHTML($("#liContent"+id).html());
            var flag = true;
            for (i = 0; i < feed.length; i++) {
                if (feed.options[i].value == id) {
                    flag = false;
                }
            }
            
            switch (selectedModule) {
                case "Listing" :    text_aux = "<?=system_showText(LANG_LISTING_FEATURE_NAME)." » ";?>"+text;
                                    break;
                case "Event" :      text_aux = "<?=system_showText(LANG_EVENT_FEATURE_NAME)." » ";?>"+text;
                                    break;
                case "Classified" : text_aux = "<?=system_showText(LANG_CLASSIFIED_FEATURE_NAME)." » ";?>"+text;
                                    break;
                case "Article" :    text_aux = "<?=system_showText(LANG_ARTICLE_FEATURE_NAME)." » ";?>"+text;
                                    break;
            }

            if (text && id && flag) {
                feed.options[feed.length] = new Option(text, id);
                feedAll.options[feedAll.length] = new Option(text_aux, id_aux);
                $('#categoryAdd'+id).after("<span class=\"categorySuccessMessage\"><?=system_showText(LANG_MSG_CATEGORY_SUCCESSFULLY_ADDED)?></span>").css('display', 'none');
                $('.categorySuccessMessage').fadeOut(5000);
                
            } else {
                if (!flag) $('#categoryAdd'+id).after("</a> <span class=\"categoryErrorMessage\"><?=system_showText(LANG_MSG_CATEGORY_ALREADY_INSERTED)?></span> </li>");
                else ('#categoryAdd'+id).after("</a> <span class=\"categoryErrorMessage\"><?=system_showText(LANG_MSG_SELECT_VALID_CATEGORY)?></span> </li>");
            }            
            
            //Show button to remove categories
            $('#removeCategoriesButton').show(); 
            
        }
        
        function removeCategory(feed) {
            
            if (feed.selectedIndex >= 0) {
                
                categ = feed.options[feed.selectedIndex].value;
                categinfo = categ.split('_');
                
                switch (categinfo[0]) {
                    case "listing" :    path_aux = "../<?=LISTING_FEATURE_FOLDER;?>";
                                        feed_aux = document.mailapp.feed_listing;
                                        break;
                    case "event" :      path_aux = "../<?=EVENT_FEATURE_FOLDER;?>";
                                        feed_aux = document.mailapp.feed_event;
                                        break;
                    case "classified" : path_aux = "../<?=CLASSIFIED_FEATURE_FOLDER;?>";
                                        feed_aux = document.mailapp.feed_classified;
                                        break;
                    case "article" :    path_aux = "../<?=ARTICLE_FEATURE_FOLDER;?>";
                                        feed_aux = document.mailapp.feed_article;
                                        break;
                }
                
                for (i = 0; i < feed_aux.length; i++) {
                    if (feed_aux.options[i].value == categinfo[1]) {
                        $("#feed_"+categinfo[0]).val(categinfo[1]);
                    }
                }
                
                feed.remove(feed.selectedIndex);
                JS_removeCategory(feed_aux, false);
                
                if (feed.length == 0) {
                	$('#removeCategoriesButton').hide();
                }
            }

        }
        
        function JS_submit() {
           
            <? foreach ($availableModules as $avModule) { ?>
            feed_<?=$avModule;?> = document.mailapp.feed_<?=$avModule;?>;
            return_categories_<?=$avModule;?> = document.mailapp.return_categories_<?=$avModule;?>;
            if (return_categories_<?=$avModule;?>.value.length > 0) return_categories_<?=$avModule;?>.value = "";

            if (feed_<?=$avModule;?>) {
                for (i = 0; i < feed_<?=$avModule;?>.length; i++) {
                    if (feed_<?=$avModule;?>.options[i].value != "") {
                        if (return_categories_<?=$avModule;?>.value.length > 0) {
                            return_categories_<?=$avModule;?>.value = return_categories_<?=$avModule;?>.value + "," + feed_<?=$avModule;?>.options[i].value;
                        } else {
                            return_categories_<?=$avModule;?>.value = return_categories_<?=$avModule;?>.value + feed_<?=$avModule;?>.options[i].value;
                        }
                    }
                }
            }
            <? } ?>
            
            feedAll = document.mailapp.feed_all;
            return_categories_all = document.mailapp.return_categories_all;
            if (return_categories_all.value.length > 0) return_categories_all.value = "";

            if (feedAll) {
                for (i = 0; i < feedAll.length; i++) {
                    if (feedAll.options[i].value != "") {
                        if (return_categories_all.value.length > 0) {
                            return_categories_all.value = return_categories_all.value + "," + feedAll.options[i].value;
                        } else {
                            return_categories_all.value = return_categories_all.value + feedAll.options[i].value;
                        }
                    }
                }
            }
            
            document.mailapp.submit();
        }

    </script>
    
    <?
    if ($message_mailapp) {
        echo "<p class=\"errorMessage\">";
            echo $message_mailapp;
        echo "</p>";
    }
    $modulesStr = LISTING_FEATURE_NAME_PLURAL.(EVENT_FEATURE == "on" && FORCE_DISABLE_EVENT_FEATURE != "on" ? ", ".EVENT_FEATURE_NAME_PLURAL : "" ).(CLASSIFIED_FEATURE == "on" && FORCE_DISABLE_CLASSIFIED_FEATURE != "on" ? ", ".CLASSIFIED_FEATURE_NAME_PLURAL : "").(ARTICLE_FEATURE == "on" && FORCE_DISABLE_ARTICLE_FEATURE != "on" ? ", ".ARTICLE_FEATURE_NAME_PLURAL : "");
    ?>

    <div class="block-info">

        <h4><?=system_showText(LANG_SITEMGR_MAILAPP_EXPORTER);?></h4>
        <p><?=str_replace("[modules]", $modulesStr, str_replace("[arcamailer]", "<a href=\"".DEFAULT_URL."/".SITEMGR_ALIAS."/".MAILAPP_FOLDER."/index.php\" target=\"_blank\">".system_showText(LANG_SITEMGR_MAILAPP)."</a>", system_showText(LANG_SITEMGR_MAILAPP_CLIENTEXPORTER_TIP)));?></p>

    </div>
    
    <form name="mailapp" id="mailapp" method="post" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>">
              
        <input type="hidden" name="return_categories_all" value="" />
        
        <div class="block-info">

            <h4>1. <?=system_showText(LANG_SITEMGR_MAILAPP_CLIENTEXPORTER_STEP_1);?></h4>
            <p><?=system_showText(LANG_SITEMGR_MAILAPP_CLIENTEXPORTER_STEP_1_TIP);?></p>

            <select id="moduleSelector" name="module" onchange="showCategoriesByModule(this.value);">
                <?=system_showText($modulesDropdownOptions);?>
            </select>

        </div>

        <div class="block-info" id="div_step_2" <?=($module == "all" ? "style=\"display: none;\"" : "");?>>

            <h4>2. <?=system_showText(LANG_SITEMGR_MAILAPP_CLIENTEXPORTER_STEP_2);?></h4>
            <p><?=system_showText(LANG_SITEMGR_MAILAPP_CLIENTEXPORTER_STEP_2_TIP);?></p>

            <div class="categories" id="divCategories" <?=($module ? "" : "style=\"display: none;\"")?>>

                <p><span><img width="16" height="14" src="<?=DEFAULT_URL?>/images/icon_atention.gif" alt="<?=LANG_LABEL_ATTENTION?>" title="<?=LANG_LABEL_ATTENTION?>"> <?=system_showText(LANG_MSG_CLICKADDTOSELECTCATEGORIES);?></span></p>

                <? foreach ($availableModules as $avModule) { ?>
                
                <div id="categories_<?=ucfirst($avModule);?>" <?=($module == ucfirst($avModule) ? "" : "style=\"display: none;\"")?>>

                    <ul id="<?=$avModule?>_categorytree_id_0" class="categoryTreeview">&nbsp;</ul>
                    
                    <div style="display: none">
                        <?=${"feedDropDown_".$avModule};?>
                    </div>
                    
                    <input type="hidden" name="return_categories_<?=$avModule?>" value="" />

                </div>

                <? } ?>
                
                <div class="selectedcategories" id="divAll">

                    <hr>

                    <div class="select">
                        <?=$feed_all;?>
                    </div>

                    <div class="optionbuttons" id="removeCategoriesButton" style="display:none";>
                        <button class="input-button-form" type="button" value="<?=system_showText(LANG_BUTTON_REMOVESELECTEDCATEGORY)?>" onclick="removeCategory(document.mailapp.feed_all);"><?=system_showText(LANG_BUTTON_REMOVESELECTEDCATEGORY)?></button>
                    </div>

                </div>

            </div>

        </div>

        <div class="block-info">

            <h4><span id="label_step_3"><?=($module == "all" ? "2" : "3");?></span>. <?=system_showText(LANG_SITEMGR_MAILAPP_CLIENTEXPORTER_STEP_3);?></h4>
            <p><?=system_showText(LANG_SITEMGR_MAILAPP_CLIENTEXPORTER_STEP_3_TIP);?></p>
            <input type="text" name="title" id="title" class="small" value="<?=$title;?>" />

        </div>

        <div class="block-info">

            <h4><span id="label_step_4"><?=($module == "all" ? "3" : "4");?></span>. <?=system_showText(LANG_SITEMGR_MAILAPP_CLIENTEXPORTER_STEP_4)?></h4>
            <p><?=system_showText(LANG_SITEMGR_MAILAPP_CLIENTEXPORTER_STEP_4_TIP);?></p>

            <button type="button" onclick="JS_submit();" class="input-button-form"><?=system_showText(LANG_SITEMGR_EXPORT_SUBMIT);?></button>

        </div>

    </form>
    
    <script language="javascript" type="text/javascript" src="<?=DEFAULT_URL?>/scripts/categorytree.js"></script>

    <? if ($module) { ?>
    
    <script language="javascript" type="text/javascript">
                
        <? if ($module == "Listing") { ?>
        
        loadCategoryTree('all', 'listing_', 'ListingCategory', 0, 0, '<?=DEFAULT_URL."/".EDIR_CORE_FOLDER_NAME."/".LISTING_FEATURE_FOLDER?>',<?=SELECTED_DOMAIN_ID?>);
        
        <? } else { ?>
            
        loadCategoryTree('all', '<?=strtolower($module)?>_', '<?=$module;?>Category', 0, 0, '<?=DEFAULT_URL?>',<?=SELECTED_DOMAIN_ID?>);
            
        <? } ?>
    </script>
    
    <? } ?>
    
    