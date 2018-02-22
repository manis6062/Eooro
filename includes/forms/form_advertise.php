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
	# * FILE: /includes/forms/form_advertise.php
	# ----------------------------------------------------------------------------------------------------

    include(INCLUDES_DIR."/code/newsletter.php");

    $defaultusername = $username;
    $defaultpassword = "";
    if (DEMO_MODE) {
        $defaultusername = "demo@demodirectory.com";
        $defaultpassword = "abc123";
    }
    
    $msgLogged = "";

    $defaultActionForm = $formloginaction.($advertiseItem == "banner" ? "&amp;query=type=".($_POST["type"] ? $_POST["type"] : $_GET["type"]) : "&amp;query=level=".($_POST["level"] ? $_POST["level"] : $_GET["level"]));
    
    if ($advertiseItem == "listing") {
        $defaultActionForm .= "&amp;listingtemplate_id=".($_POST["listingtemplate_id"] ? $_POST["listingtemplate_id"] : $_GET["listingtemplate_id"]);
    }
?>

    <script language="javascript" type="text/javascript">
		<!--

		function orderCalculate() {

			var xmlhttp;

			try {
				xmlhttp = new XMLHttpRequest();
			} catch (e) {
				try {
					xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
				} catch (e) {
					try {
						xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
					} catch (e) {
						xmlhttp = false;
					}
				}
			}

			if (document.getElementById("check_out_payment")) document.getElementById("check_out_payment").className = "isHidden";
			$("#check_out_payment_2").removeClass("isVisible").addClass("isHidden");
			if (document.getElementById("check_out_free")) document.getElementById("check_out_free").className = "isHidden";
            $("#check_out_free_2").removeClass("isVisible").addClass("isHidden");
			if (document.getElementById("loadingOrderCalculate")) document.getElementById("loadingOrderCalculate").style.display = "";
			if (document.getElementById("loadingOrderCalculate")) document.getElementById("loadingOrderCalculate").innerHTML = "<?=system_showText(LANG_WAITLOADING)?>";
			if (xmlhttp) {
				xmlhttp.onreadystatechange = function() {
					if (xmlhttp.readyState == 4) {
						if (xmlhttp.status == 200) {
							var price = xmlhttp.responseText;
							var arrPrice = price.split("|");
							var html = "";
							var tax_status = '<?=$payment_tax_status;?>';
                            var tax_info = "";
							<? if ((PAYMENT_FEATURE == "on") && ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on"))) { ?>
								if (arrPrice[0] > 0) {
									if (tax_status == "on") {
										html += "<strong><?=system_showText(LANG_SUBTOTALAMOUNT)?>: </strong><?=CURRENCY_SYMBOL?>"+arrPrice[0].substring(0, arrPrice[0].length-2)+"."+arrPrice[0].substring(arrPrice[0].length-2, arrPrice[0].length);
										html += "<br /><strong><?=system_showText(LANG_TAXAMOUNT)?>: </strong><?=CURRENCY_SYMBOL?>"+arrPrice[1].substring(0, arrPrice[1].length-2)+"."+arrPrice[1].substring(arrPrice[1].length-2, arrPrice[1].length);
										html += "<br /><strong><?=system_showText(LANG_TOTALPRICEAMOUNT)?>: </strong><?=CURRENCY_SYMBOL?>"+arrPrice[2].substring(0, arrPrice[2].length-2)+"."+arrPrice[2].substring(arrPrice[2].length-2, arrPrice[2].length);
										tax_info = "<?="+".$payment_tax_value."% ".$payment_tax_label;?> (" + "<?=CURRENCY_SYMBOL?>"+arrPrice[2].substring(0, arrPrice[2].length-2)+"."+arrPrice[2].substring(arrPrice[2].length-2, arrPrice[2].length) + ")";
									} else {
										html += "<strong><?=system_showText(LANG_TOTALPRICEAMOUNT)?>: </strong><?=CURRENCY_SYMBOL?>"+arrPrice[0].substring(0, arrPrice[0].length-2)+"."+arrPrice[0].substring(arrPrice[0].length-2, arrPrice[0].length);
									}
									$('#divTax').addClass('isVisible');
									$('#divTax').removeClass('isHidden');
                                    $("#free_item").attr("value", "0");
									if (document.getElementById("check_out_payment")) document.getElementById("check_out_payment").className = "isVisible";
                                    $("#check_out_payment_2").addClass("isVisible").removeClass("isHidden");
									if (document.getElementById("payment-method")) document.getElementById("payment-method").className = "isVisible";
									if (document.getElementById("checkoutpayment_total")) document.getElementById("checkoutpayment_total").innerHTML = html;
								} else {
									$('#divTax').addClass('isHidden');
									$('#divTax').removeClass('isVisible');
                                    $("#free_item").attr("value", "1");
									if (document.getElementById("check_out_free")) document.getElementById("check_out_free").className = "isVisible";
									$("#check_out_free_2").addClass("isVisible").removeClass("isHidden");
                                    if (document.getElementById("payment-method")) document.getElementById("payment-method").className = "isHidden";
									if (document.getElementById("checkoutfree_total")) document.getElementById("checkoutfree_total").innerHTML = "<strong><?=system_showText(LANG_TOTALPRICEAMOUNT)?>: </strong><?=CURRENCY_SYMBOL?><?=system_showText(LANG_FREE)?>";
								}
								if (tax_status == "on") document.getElementById("taxInfo").innerHTML = tax_info;
							<? } else { ?>
                                $("#free_item").attr("value", "1");
								if (document.getElementById("check_out_free")) document.getElementById("check_out_free").className = "isVisible";
								$("#check_out_free_2").addClass("isVisible").removeClass("isHidden");
                                if (document.getElementById("payment-method")) document.getElementById("payment-method").className = "isHidden";
								if (arrPrice[0] > 0) {
									if (tax_status == "on") {
										html += "<strong><?=system_showText(LANG_SUBTOTALAMOUNT)?>: </strong><?=CURRENCY_SYMBOL?>"+arrPrice[0].substring(0, arrPrice[0].length-2)+"."+arrPrice[0].substring(arrPrice[0].length-2, arrPrice[0].length);
										html += "<br /><strong><?=system_showText(LANG_TAXAMOUNT)?>: </strong><?=CURRENCY_SYMBOL?>"+arrPrice[1].substring(0, arrPrice[1].length-2)+"."+arrPrice[1].substring(arrPrice[1].length-2, arrPrice[1].length);
										html += "<br /><strong><?=system_showText(LANG_TOTALPRICEAMOUNT)?>: </strong><?=CURRENCY_SYMBOL?>"+arrPrice[2].substring(0, arrPrice[2].length-2)+"."+arrPrice[2].substring(arrPrice[2].length-2, arrPrice[2].length);
										tax_info = "<?="+".$payment_tax_value."% ".$payment_tax_label;?> (" + "<?=CURRENCY_SYMBOL?>"+arrPrice[2].substring(0, arrPrice[2].length-2)+"."+arrPrice[2].substring(arrPrice[2].length-2, arrPrice[2].length) + ")";
									} else {
										html += "<strong><?=system_showText(LANG_TOTALPRICEAMOUNT)?>: </strong><?=CURRENCY_SYMBOL?>"+arrPrice[0].substring(0, arrPrice[0].length-2)+"."+arrPrice[0].substring(arrPrice[0].length-2, arrPrice[0].length);
									}
									$('#divTax').addClass('isVisible');
									$('#divTax').removeClass('isHidden');
									if (document.getElementById("checkoutfree_total")) document.getElementById("checkoutfree_total").innerHTML = html;
								} else {
									$('#divTax').addClass('isHidden');
									$('#divTax').removeClass('isVisible');
									if (document.getElementById("checkoutfree_total")) document.getElementById("checkoutfree_total").innerHTML = "<strong><?=system_showText(LANG_TOTALPRICEAMOUNT)?>: </strong><?=CURRENCY_SYMBOL?><?=system_showText(LANG_FREE)?>";
								}
								if (tax_status == "on") document.getElementById("taxInfo").innerHTML = tax_info;
							<? } ?>
							if (document.getElementById("loadingOrderCalculate")) document.getElementById("loadingOrderCalculate").style.display = "none";
							if (document.getElementById("loadingOrderCalculate")) document.getElementById("loadingOrderCalculate").innerHTML = "";
						}
					}
				}
				var get_level = "";
				if (document.order_item.level) get_level = "&level=" + document.order_item.level.value;
                
				var get_categories = "";
				if (document.order_item.feed) get_categories = "&categories=" + document.order_item.feed.length;
                
				var get_listingtemplate_id = "";
				if (document.order_item.select_listingtemplate_id) get_listingtemplate_id = "&listingtemplate_id=" + document.order_item.select_listingtemplate_id.value;
                    
				var get_discount_id = "";
				if (document.order_item.discount_id) get_discount_id = document.order_item.discount_id.value;
                
                var get_type = "";
				if (document.order_item.type) get_type = "&type=" + document.order_item.type.value;
                
                var get_expiration_setting = "";
				if (document.order_item.expiration_setting) get_expiration_setting = "&expiration_setting=" + document.order_item.expiration_setting.value;
                
				var get_unpaid_impressions = "";
				if (document.order_item.unpaid_impressions) get_unpaid_impressions = "&unpaid_impressions=" + document.order_item.unpaid_impressions.value;
				
                xmlhttp.open("GET", "<?=DEFAULT_URL;?>/ordercalculateprice.php?item=<?=$advertiseItem?>&item_id=<?=$unique_id;?>"+get_level+get_categories+get_listingtemplate_id+"&discount_id="+get_discount_id+get_type+get_expiration_setting+get_unpaid_impressions, true);
				xmlhttp.send(null);
			}
		}

		<? if (LISTINGTEMPLATE_FEATURE == "on" && CUSTOM_LISTINGTEMPLATE_FEATURE == "on" && $advertiseItem == "listing") { ?>
			function templateSwitch(template) {
				if (!template) template = 0;
				<?=$jsVarsType;?>
				document.order_item.listingtemplate_id.value = template;
				if (document.getElementById("title_label")) {
                    document.getElementById("title_label").innerHTML = eval("title_template_" + template);
                }
				orderCalculate();
				loadCategoryTree('template', 'listing_', 'ListingCategory', 0, template, '<?=DEFAULT_URL."/".EDIR_CORE_FOLDER_NAME."/".LISTING_FEATURE_FOLDER?>',<?=SELECTED_DOMAIN_ID?>);
				updateFormAction();
			}
		<? } ?>
        
        <? if ($advertiseItem == "banner") { ?>
        function typeSwitch(type, expiration_setting) {
			<?
			foreach ($levelValue as $value) {
				echo "var impressions_".$value."_".BANNER_EXPIRATION_RENEWAL_DATE." = 0;";
				echo "var impressions_".$value."_".BANNER_EXPIRATION_IMPRESSION." = ".$bannerLevelObj->getImpressionBlock($value).";";
			}
			?>
			document.order_item.type.value = type;
			document.order_item.expiration_setting.value = expiration_setting;
			document.order_item.unpaid_impressions.value = eval("impressions_" + type + "_" + expiration_setting);
			orderCalculate();
			updateFormAction();
		}
        <? } ?>
        
        function updateFormAction() {
            var levelValue = "";
            var titleValue = "";
            var templateValue = "";
            var categValue = "";
            var discountValue = "";
            var packageValue = "";
            var packageID = "";
            var startDateValue = "";
            var endDateValue = "";
            var expirationValue = "";
            var advertiseItem = "<?=$advertiseItem?>";
            
            //Get level/type
            if (document.order_item.level) {
                levelValue = "level=" + document.order_item.level.value;
            } else if (document.order_item.type) {
                levelValue = "type=" + document.order_item.type.value;
            }
            
            //Get Title/Caption
            if (document.order_item.title) {
                titleValue = "&title=" + urlencode(document.order_item.title.value);
            } else if (document.order_item.caption) {
                titleValue = "&caption=" + urlencode(document.order_item.caption.value);
            }
            
            //Get expiration setting (banner)
            if (document.order_item.expiration_setting) {
                expirationValue = "&expiration_setting=" + document.order_item.expiration_setting.value;
            }
            
            //Get Template ID
            if (document.order_item.select_listingtemplate_id) {
                templateValue = "&listingtemplate_id=" + document.order_item.select_listingtemplate_id.value;
            }
            
            //Get Discount
            if (document.order_item.discount_id) {
                discountValue = "&discount_id=" + document.order_item.discount_id.value;
            }
            
            //Get Start Date (event)
            if (document.order_item.start_date) {
                startDateValue = "&start_date=" + document.order_item.start_date.value;
            }
            
            //Get End Date (event)
            if (document.order_item.end_date) {
                endDateValue = "&end_date=" + document.order_item.end_date.value;
            }
            
            <? if ($advertiseItem == "listing") { ?>
                    
            //Get Categories
            feed = document.order_item.feed;
			var return_categories = "";

			for (i = 0; i < feed.length; i++) {
				if (!isNaN(feed.options[i].value)) {
					if (return_categories.length > 0) {
                        return_categories = return_categories + "," + feed.options[i].value;
                    } else {
                        return_categories = return_categories + feed.options[i].value;
                    }
				}
			}
            if (return_categories.length > 0) {
                categValue = "&return_categories=" + return_categories;
            }
            
            <? } ?>
            
            //Get package
            if ($("#using_package").val() == "y") {
                packageID = $("#aux_package_id").val();
                packageValue = "&package_id="+packageID;
            } else if (advertiseItem == "article") {
                packageID = "skipPackageOffer";
                packageValue = "&package_id="+packageID;
            }
            
            if (document.formDirectory != undefined)	document.formDirectory.action = "<?=$formloginaction?>&query=" + levelValue + templateValue + titleValue + categValue + discountValue + packageValue + startDateValue + endDateValue + expirationValue;
                     
            <? if ($googleEnabled || $facebookEnabled) { ?>
                
                $.get(DEFAULT_URL + "/ordercalculateprice.php", {
                    
                    item:               "<?=$advertiseItem?>",
                    
                    item_id:            "<?=$unique_id;?>",
                    
                    <? if ($advertiseItem == "banner") { ?>
                    
                    type:              document.order_item.type.value,
                    
                    caption:            document.order_item.caption.value,
                    
                    <? } else { ?>
                        
                    level:              document.order_item.level.value,
                    
                    title:              document.order_item.title.value,
                        
                    <? } ?>
                    
                    <? if ($advertiseItem == "listing") { ?>
                        
                    <? if (LISTINGTEMPLATE_FEATURE == "on" && CUSTOM_LISTINGTEMPLATE_FEATURE == "on" && !USING_THEME_TEMPLATE) { ?>
                        
                    listingtemplate_id: document.order_item.select_listingtemplate_id.value,
                    
                    <? } ?>
                    
                    return_categories:  return_categories,
                    
                    <? } elseif ($advertiseItem == "event") { ?>
                        
                    start_date:         document.order_item.start_date.value,
                    
                    end_date:           document.order_item.end_date.value,
                    
                    <? } elseif ($advertiseItem == "banner") { ?>
                        
                    expiration_setting: document.order_item.expiration_setting.value,
                    
                    unpaid_impressions: document.order_item.unpaid_impressions.value,
                    
                    <? } ?>
                        
                    discount_id:        document.order_item.discount_id.value,
                    
                    package_id:         packageID
                }, function () {});
                
            <? } ?>
        }

        <? if ($advertiseItem == "listing") { ?>

		function JS_addCategory(id) {
			seed = document.order_item.seed;
			feed = document.order_item.feed;
            var text = unescapeHTML($("#liContent"+id).html());
			var flag = true;
			for (i = 0; i < feed.length; i++) {
				if (feed.options[i].value == id) {
                    flag = false;
                }
				if (!feed.options[i].value) {
					feed.remove(feed.options[i]);
				}
			}
			if (text && id && flag) {
				feed.options[feed.length] = new Option(text, id);
				$('#categoryAdd'+id).after("<span class=\"categorySuccessMessage\"><?=system_showText(LANG_MSG_CATEGORY_SUCCESSFULLY_ADDED)?></span>").css('display', 'none');
				$('.categorySuccessMessage').fadeOut(5000);
				orderCalculate();
                updateFormAction();
			} else {
				if (!flag) {
                    $('#categoryAdd'+id).after("</a> <span class=\"categoryErrorMessage\"><?=system_showText(LANG_MSG_CATEGORY_ALREADY_INSERTED)?></span> </li>");
                } else {
                    ('#categoryAdd'+id).after("</a> <span class=\"categoryErrorMessage\"><?=system_showText(LANG_MSG_SELECT_VALID_CATEGORY)?></span> </li>");
                }
			}
			
            $('#removeCategoriesButton').show(); 

		}
        
        <? } ?>
        
		function JS_submit() {
            disableButtons();
            <? if ($advertiseItem == "listing") { ?>
			feed = document.order_item.feed;
			return_categories = document.order_item.return_categories;
			if (return_categories.value.length > 0) {
                return_categories.value = "";
            }
			for (i = 0; i < feed.length; i++) {
				if (!isNaN(feed.options[i].value)) {
					if (return_categories.value.length > 0) {
                        return_categories.value = return_categories.value + "," + feed.options[i].value;
                    } else {
                        return_categories.value = return_categories.value + feed.options[i].value;
                    }
				}
			}
            <? } ?>
		}

		//-->
	</script>

    <div style="display:none">
        
        <form id="formDirectory" name="formDirectory" method="post" action="<?=$defaultActionForm;?>">
		
            <input type="hidden" name="advertise" value="yes" />
            <input type="hidden" name="destiny" value="<?=$destiny?>" />
            <input type="hidden" name="query" value="<?=urlencode($query)?>" />
            
            <input type="hidden" name="username" id="form_username" value="" />
            <input type="hidden" name="password" id="form_password" value="" />

        </form>
        
    </div>

    <form name="order_item" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post" class="standardForm" onsubmit="JS_submit();">

        <input type="hidden" name="advertise" value="yes" />
        <input type="hidden" name="signup" value="true" />
        
        <? if ($advertiseItem == "banner") { ?>
            <input type="hidden" name="type" id="type" value="<?=$type?>" />
            <input type="hidden" name="expiration_setting" id="expiration_setting" value="<?=$expiration_setting?>" />
            <input type="hidden" name="unpaid_impressions" id="unpaid_impressions" value="<?=$unpaid_impressions?>" />
        <? } else { ?>
            <input type="hidden" name="level" id="level" value="<?=$level?>" />
        <? } ?>
        
        <? if ($advertiseItem == "listing") { ?>
            <input type="hidden" name="listingtemplate_id" id="listingtemplate_id" value="<?=(USING_THEME_TEMPLATE && THEME_TEMPLATE_ID > 0 ? THEME_TEMPLATE_ID : $listingtemplate_id)?>" />
        <? } ?>

        <div class="content-main" id="screen1" <?=($message_account || $message_contact ? "style=\"display: none;\"" : "style=\"display: block;\"")?>>

            <div class="order-head">
                <h2>
                    <?=$labelName;?>
                    <? if ($advertiseItem != "banner") { ?>
                    - <i><?=$labelPrice;?></i><?=$labelPriceRenewal;?>
                    <? } ?>
                </h2>
                <? if ($payment_tax_status == "on") { ?>
                    <div id="divTax" class="isHidden" <?=($advertiseItem == "banner" ? "style=\"display: none;\"" : "")?>>
                        <span id="taxInfo"></span>
                    </div>
                <? } ?>
            </div>

            <div class="order">

                <div id="errorMessage">&nbsp;</div>

                <div id="listing-info">
                    <div class="left textright">
                        <h3>Business Name:<?//=system_showText(constant("LANG_".strtoupper($advertiseItem)."INFO"));?></h3>
                        <p>
                            <?=system_showText(constant("LANG_".strtoupper($advertiseItem)."INFO_TIP"));?>
                            <? if ($advertiseItem == "listing" && LISTINGTEMPLATE_FEATURE == "on" && CUSTOM_LISTINGTEMPLATE_FEATURE == "on" && !USING_THEME_TEMPLATE) {
                                //echo system_showText(LANG_LISTINGINFO_TIP2);
                            } ?>
                        </p>
                    </div>

                    <div class="right">
                        
                        <div class="cont_70">
                            <label id="title_label" for="<?=$advertiseItem?>-title"><?=($template_title_field !== false && $advertiseItem == "listing") ? $template_title_field[0]["label"] : ($advertiseItem == "banner" ? system_showText(LANG_LABEL_CAPTION) : system_showText(LANG_LABEL_TITLE))?> * <span><?=system_showText(LANG_LABEL_REQUIRED_FIELD);?></span></label>
                            <? if ($advertiseItem == "banner") { ?>
                                <input type="text" name="caption" id="<?=$advertiseItem?>-title" value="<?=$caption?>" maxlength="25" onblur="updateFormAction(); $('#adv_title').html(this.value);" />
                            <? } else { ?>
                                <input type="text" name="title" id="<?=$advertiseItem?>-title" value="<?=$title?>" maxlength="100" onblur="easyFriendlyUrl(this.value, 'friendly_url', '<?=FRIENDLYURL_VALIDCHARS?>', '<?=FRIENDLYURL_SEPARATOR?>'); updateFormAction(); $('#adv_title').html(this.value);" />
                                <input type="hidden" name="friendly_url" id="friendly_url" value="<?=$friendly_url?>" maxlength="150" />
                            <? } ?>
                        </div>
                        
                        <? if ($advertiseItem == "banner") { ?>
                        
                        <div class="cont_70">
                            <table align="center" cellspacing="2" cellpadding="2" border="0" class="standardChooseLevel">
                                <tr>
                                    <td>
                                        <input type="radio" name="type_expiration_setting" value="<?=$type?>_<?=BANNER_EXPIRATION_RENEWAL_DATE?>" <? if (BANNER_EXPIRATION_RENEWAL_DATE == $expiration_setting) { echo "checked=\"checked\""; } ?> onclick="typeSwitch('<?=$type?>', '<?=BANNER_EXPIRATION_RENEWAL_DATE?>');" />
                                    </td>
                                    <td>
                                        <?
                                            if ($bannerLevelObj->getPrice($type) > 0) {
                                                echo CURRENCY_SYMBOL.$bannerLevelObj->getPrice($type);
                                            } else {
                                                echo CURRENCY_SYMBOL.system_showText(LANG_FREE);
                                            }
                                            echo " ".system_showText(LANG_PER)." ";
                                            if (payment_getRenewalCycle("banner") > 1) {
                                                echo payment_getRenewalCycle("banner")." ";
                                                echo payment_getRenewalUnitNamePlural("banner");
                                            } else {
                                                echo payment_getRenewalUnitName("banner");
                                            }
                                        ?>
                                    </td>
                                    <td>
                                        <input type="radio" name="type_expiration_setting" value="<?=$type?>_<?=BANNER_EXPIRATION_IMPRESSION?>" <? if (BANNER_EXPIRATION_IMPRESSION == $expiration_setting) { echo "checked=\"checked\""; } ?> onclick="typeSwitch('<?=$type?>', '<?=BANNER_EXPIRATION_IMPRESSION?>');" />
                                    </td>
                                    <td>
                                        <?
                                        if ($bannerLevelObj->getImpressionPrice($type) > 0) {
                                            echo CURRENCY_SYMBOL.$bannerLevelObj->getImpressionPrice($type);
                                        } else {
                                            echo CURRENCY_SYMBOL.system_showText(LANG_FREE);
                                        }
                                        echo " ".system_showText(LANG_PER)." ".$bannerLevelObj->getImpressionBlock($type)." ".system_showText(LANG_IMPRESSIONS);
                                        ?>
                                    </td>
                                </tr>
                              </table>
                        </div>
                        
                        <? } ?>
                     

                        <? if ($advertiseItem == "listing" && LISTINGTEMPLATE_FEATURE == "on" && CUSTOM_LISTINGTEMPLATE_FEATURE == "on" && !USING_THEME_TEMPLATE) { ?>

                        <div class="cont_70">

                            <label for="listing-template"><?=system_showText(LANG_LISTING_LABELTEMPLATE)?></label>

                            <select name="select_listingtemplate_id" onchange="templateSwitch(this.value);">
                                <option value=""><?=system_showText(LANG_BUSINESS);?></option>
                                <?=$listingTypeOptions;?>
                            </select>

                        </div>

                        <? } ?>
                        
                        <? if ($advertiseItem == "event") { ?>
                        <div class="cont_100">
                            <div class="cont_30">
                                <label id="startDate_label" for="startDate_label"><?=system_showText(LANG_LABEL_STARTDATE)?> * <span><?=system_showText(LANG_LABEL_REQUIRED_FIELD);?></span></label>
                                <input type="text" name="start_date" id="start_date" value="<?=$start_date?>" /> <span>(<?=format_printDateStandard()?>)</span>
                            </div>

                            <div class="cont_30">
                                <label id="eventDate_label" for="eventDate_label"><?=system_showText(LANG_LABEL_ENDDATE)?> * <span><?=system_showText(LANG_LABEL_REQUIRED_FIELD);?></span></label>
                                <input type="text" name="end_date" id="end_date" value="<?=$end_date?>" /> <span>(<?=format_printDateStandard()?>)</span>
                            </div>
                        </div>
                        <? } ?>

                    </div>

                </div>

                <? if ($advertiseItem == "listing") { ?>
                <div id="categories">

                    <div class="left textright">

                        <h3><?=system_showText(LANG_CATEGORIES_TITLE)?></h3>
                        <p>
                            <span id="extracategory_note">
                                <?=system_showText(LANG_CATEGORIES_MSG1)?>
                                <?/*=string_ucwords(system_showText(($listingLevelObj->getFreeCategory($level) > 1) ? LANG_CATEGORY_PLURAL : LANG_CATEGORY))?> <strong><?=system_showText(LANG_FREE)?>: <?=$listingLevelObj->getFreeCategory($level)?></strong>. <?=system_showText(LANG_CATEGORIES_PRICEDESC1)?> <strong><?=system_showText(LANG_CATEGORIES_PRICEDESC2)?> <?=CURRENCY_SYMBOL?> <?=$listingLevelObj->getCategoryPrice($level)?></strong> <?=system_showText(LANG_CATEGORIES_PRICEDESC3)*/?></span>
                            <?//=system_showText(LANG_CATEGORIES_CATEGORIESMAXTIP1)." <strong>".system_showText(LISTING_MAX_CATEGORY_ALLOWED)."</strong> ".system_showText(LANG_CATEGORIES_CATEGORIESMAXTIP2)?>
                        </p>

                    </div>

                    <div class="right">

                        <p class="warningBOXtext">
                            
                            <?//=system_showText(LANG_CATEGORIES_MSG1)?><?//=system_showText(LANG_CATEGORIES_MSG2)?></p>

                        <div class="cont_50">

                            <input type="hidden" name="return_categories" value="" />

                            <div class="treeView">

                                <ul id="listing_categorytree_id_0" class="categoryTreeview">
                                    <li>&nbsp;</li>
                                </ul>
                                <!-- modification  -->
                                Type & Choose up to <?=$listingLevelObj->getFreeCategory($level)?> categories.
                                <input type="text" id="category-list" name="category-list"/>
                                <button type="button" name="add-category" id="add-category">Add</button>

                            </div>

                        </div>

                        <div class="cont_50">
                            <label><?=system_showText(LANG_LISTING_CATEGORIES);?> * <span><?=system_showText(LANG_LABEL_REQUIRED_FIELD);?></span></label>
                            <?=$feedDropDown?>
                            <!-- modification  -->
                            <div class="text-center" id="removeCategoriesButton">
                                <a href="javascript:void(0);" onclick="JS_removeCategory(document.order_item.feed, true);"><?=(system_showText(LANG_CATEGORY_REMOVESELECTED))?></a>
                            </div>
                        </div>

                    </div>

                </div>
                <? } ?>

                <? if (!$msgLogged) { ?>

                <div id="payment-method" class="<?=$checkoutpayment_class?>">

                    <div class="left textright">
                        <h3><?=system_showText(LANG_LABEL_PAYMENT_METHOD1);?></h3>
                        <p><?//=system_showText(LANG_LABEL_PAYMENT_METHOD_TIP);?></p>
                    </div>

                    <div class="right">

                        <div class="clear clearfix option">
                            <? include(INCLUDES_DIR."/forms/form_paymentmethod.php"); ?>
                        </div>

                        <? if (PAYMENT_FEATURE == "on" && ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on"))) { ?>
                        
  						<div class="clear clearfix cont_50">
                            <label for="promocode"><?=string_ucwords(system_showText(LANG_LABEL_DISCOUNTCODE))?></label>
                            <input type="text" id="promocode" name="discount_id" value="<?=$discount_id?>" maxlength="10" onblur="orderCalculate(); updateFormAction();" />
                        </div>
                     
                  		<? } ?>
                        
                    </div>

                </div>

                <? } else { ?>
                
                <input type="hidden" name="userLogged" id="userLogged" value="1" />
                <br class="clear"/>
                <? } ?>

                <div class="blockcontinue cont_100">

                    <div id="loadingOrderCalculate" class="loadingOrderCalculate"><?=system_showText(LANG_WAITLOADING)?></div>

                    <input type="hidden" name="free_item" id="free_item" value="" />

                    <? if (PAYMENT_FEATURE == "on" && ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on"))) { ?>

                    <div id="check_out_payment" class="<?=$checkoutpayment_class?>">

                        <div class="cont_60 ">
                            <div id="checkoutpayment_total" class="orderTotalAmount"></div>
                        </div>

                        <div class="cont_40 ">
                            <p class="checkoutButton bt-highlight">                               
                                <button type="button" id="button1" onclick="<?=("nextStep('$advertiseItem', ".($advertiseItem == "listing" ? "document.order_item.feed" : "false").", '$advertiseItem-title', ".($hasPackage ? "true" : "false").");")?>"><?=system_showText(LANG_BUTTON_CONTINUE)?></button>
                                <a href="<?=NON_SECURE_URL?>/<?=ALIAS_ADVERTISE_URL_DIVISOR?>.php?<?=$advertiseItem?>"><?=system_showText(LANG_ADVERTISE_BACK);?></a>
                                <em><?=$msgLogged;?></em>                               
                            </p>
                        </div>
                    </div>

                    <? } ?>

                    <div id="check_out_free" class="<?=$checkoutfree_class?>">

                        <div class="cont_60 ">
                            <div id="checkoutfree_total" class="orderTotalAmount"></div>
                        </div>

                        <div class="cont_40 ">
                            <p class="checkoutButton bt-highlight">                                
                                <button type="button" id="button2" onclick="<?=("nextStep('$advertiseItem', ".($advertiseItem == "listing" ? "document.order_item.feed" : "false").", '$advertiseItem-title', ".($hasPackage ? "true" : "false").");")?>"><?=system_showText(LANG_BUTTON_CONTINUE)?></button>
                                <a href="<?=NON_SECURE_URL?>/<?=ALIAS_ADVERTISE_URL_DIVISOR?>.php?<?=$advertiseItem?>"><?=system_showText(LANG_ADVERTISE_BACK);?></a>
                           		<em><?=$msgLogged;?></em>
                            </p>
                        </div>

                    </div>

                </div>

            </div>

        </div>
           
        <? if ($hasPackage) { ?>
            
        <div class="content-main order" id="screenPackage" style="display: none;">
            
            <div class="order-package">
                
                <div class="order-head">
                    
                    <h2>
                        <?=$labelName;?> - <i><?=$labelPrice;?></i><?=$labelPriceRenewal;?>
                    </h2>
                    
                </div>
                
                <? include(EDIRECTORY_ROOT."/includes/forms/form_advertise_package.php");?>
                
            </div>				

            <div class="blockcontinue cont_100">
  
                <div class="cont_60 ">&nbsp;</div>
                
                <div class="cont_40">
                    
                    <p class="bt-highlight checkoutButton">
                        <button type="button" onclick="<?="acceptPackage('n'); ".("nextStep('$advertiseItem', ".($advertiseItem == "listing" ? "document.order_item.feed" : "false").", '$advertiseItem-title', false, true);")?>"><?=system_showText(LANG_BUTTON_NO_THANKS)?></button>
                        <a href="javascript: void(0);" onclick="backStep(true);"><?=system_showText(LANG_ADVERTISE_BACK);?></a>
                    </p>
                    
                </div>

            </div>

        </div>
            
        <? } ?>

        <div class="content-main" id="screen2" <?=($message_account || $message_contact ? "style=\"display: block;\"" : "style=\"display: none;\"")?>>
            <? 
            if( EDIR_THEME === 'review' ) { ?>
            
            <section class="latest-review cusreview">
                <div class="thumbnail listingthumbnail lisingthumbnail1">
                    <div class="row">
                        <div class="col-sm-5 col-sm-offset-1 steps-width">
                            <div class="heading-banner heading-banner1">
                                <h4><?=string_strtoupper(system_showText(LANG_EASYANDFAST));?> <?=string_strtoupper(system_showText(LANG_THREESTEPS))?></h4>
                            </div><!--/heading-banner-->
                        </div><!--/col-sm-5-->
                    </div>
                    <div class="row">
                        <div class="col-sm-11 col-sm-offset-1">
                            <div class="pWrapper">
                                <div class="row">
                                    <ul class="claim-listing">

                                        <li class="list col-sm-3 active gap">
                                            <span>1</span> &nbsp; <?=system_showText(LANG_ACCOUNTSIGNUP)?>
                                        </li>

                                        <li class="list col-sm-3 active-width gap">
                                            <span>2</span> &nbsp; <?=system_showText(LANG_LISTINGUPDATE)?>

                                        </li>

                                        <li class="list col-sm-3 checkout-width gap">
                                            <span>3</span> &nbsp; <?=system_showText(LANG_CHECKOUT)?>
                                        </li>

                                    </ul>
                                </div>
                            </div><!--/pWrapper-->
                        </div>
                    </div><!--/row-->
                </div><!--/thumbnail-->
                
                <div class="container">
        <div class="col-sm-4 formwidth">
            <div class="row">
                <div id="advertise_signup">
                <h2>Login into your account</h2>
                    
                        <? 
                        $advertise_section = true;
                        include(INCLUDES_DIR."/forms/form_addaccount_review.php"); ?>
                    
                    <section class="login-underbox">
                        <p><a href="javascript:void(0);" onclick="showLoginAndHideAddAccount();"><?=system_showText(LANG_LABEL_ALREADY_MEMBER);?></a></p>
                    </section>
                
                </div>
                <div  id="advertise_login" style="display:none">
                        <? 
                        $advertise_section = true;
                        include(INCLUDES_DIR."/forms/form_login_review.php");
                        ?>
                    
                    <section class="login-underbox">
                        <p><a class="link-highlight" href="javascript:void(0);" onclick="showAddAccountAndHideLogin();"><?=system_showText(LANG_LABEL_SIGNUPNOW);?></a></p>
                    </section>
                </div>
            </div>
        </div><!-- formwidth end  -->
        <div class="col-sm-1">
            <span class="or">or</span>
        </div>
        <div class="col-sm-5 social-signup">
            <h3>Don’t have an account? Sign Up!</h3>
            <? 
            if (FACEBOOK_APP_ENABLED == "on") {
                $fbLabel = system_showText(LANG_SIGNUPFACEBOOKUSER);
                $urlRedirect = (DEFAULT_URL."/".MEMBERS_ALIAS."/".constant(strtoupper($advertiseItem)."_FEATURE_FOLDER")."/".($advertiseItem == "banner" ? "add" : $advertiseItem).".php").("?advertise=yes&advertise_item=$advertiseItem&item_id=".$unique_id."");
                $_SESSION['advertise'] = 'yes';
                include( system_getFrontendPath( 'socialnetwork/form_facebooklogin.php') );
                unset($fbLabel);
            }

            if ($foreignaccount_google) {
                $goLabel = system_showText(LANG_SIGNUPGOOGLEUSER);
                //$urlRedirect = "&claim=yes&destiny=".urlencode(DEFAULT_URL."/".MEMBERS_ALIAS."/claim/getlisting.php?claimlistingid=".$claimlistingid);
                //include( system_getFrontendPath( 'socialnetwork/form_googlelogin.php') );
                $urlRedirect = "&advertise=yes&advertise_item=$advertiseItem&item_id=".$unique_id."&destiny=".urlencode(DEFAULT_URL."/".MEMBERS_ALIAS."/".constant(strtoupper($advertiseItem)."_FEATURE_FOLDER")."/".($advertiseItem == "banner" ? "add" : $advertiseItem).".php");
                $_SESSION['advertise'] = 'yes';
                include( system_getFrontendPath( 'socialnetwork/form_googlelogin.php') );
                //include(INCLUDES_DIR."/forms/form_googlelogin.php");
				unset($goLabel);
            } 

             if ($foreignaccount_google) {
                $urlRedirect = "&advertise=yes&advertise_item=$advertiseItem&item_id=".$unique_id."&destiny=".urlencode(DEFAULT_URL."/".MEMBERS_ALIAS."/".constant(strtoupper($advertiseItem)."_FEATURE_FOLDER")."/".($advertiseItem == "banner" ? "add" : $advertiseItem).".php");
                include( system_getFrontendPath( 'socialnetwork/form_twitterlogin.php') );
            } 
             if ($foreignaccount_google) {
                $urlRedirect = "&advertise=yes&advertise_item=$advertiseItem&item_id=".$unique_id."&destiny=".urlencode(DEFAULT_URL."/".MEMBERS_ALIAS."/".constant(strtoupper($advertiseItem)."_FEATURE_FOLDER")."/".($advertiseItem == "banner" ? "add" : $advertiseItem).".php");
                include( system_getFrontendPath( 'socialnetwork/form_linkedinlogin.php') );
            } 
            

            ?>

        </div><!-- social-signup end  -->
    </div><!-- container end -->
</section>
            <? } else { ?>
            <div class="real-steps">
			    <ul class="standardStep steps-3">
			        <li class="steps-ui stepLast"><span>3</span>&nbsp;<?=system_showText(LANG_ADVERTISE_CONFIRMATION);?></li>
			        <li class="steps-ui"><span>2</span>&nbsp;<?=system_showText(LANG_CHECKOUT);?></li>
			        <li class="steps-ui stepActived"><span>1</span>&nbsp;<?=system_showText(LANG_ADVERTISE_IDENTIFICATION);?></li>
			    </ul>
			</div>
            

			<div class="row-fluid login-page">

			    <div class="span12">
                    
			        <h1 class="text-center capitalized">
			            <?=system_showText(LANG_ADVERTISE_CHECKOUT)?> <q id="adv_title"></q>
			            <small><?=system_showText(LANG_ADVERTISE_SIGNUP);?></small>
			        </h1>
                    
			        <hr>

			        <div id="advertise_login" style="display:none">

			            <section class="login-box">

			                <? if ($foreignaccount_google || FACEBOOK_APP_ENABLED == "on") {			                                        		                   
                             
                                if ($facebookEnabled) {
                                    $fbLabel = system_showText(LANG_LOGINFACEBOOKUSER);
                                 	//$urlRedirect = "?advertise=yes&advertise_item=$advertiseItem&item_id=".$unique_id."&destiny=".urlencode(DEFAULT_URL."/".MEMBERS_ALIAS."/".constant(strtoupper($advertiseItem)."_FEATURE_FOLDER")."/".($advertiseItem == "banner" ? "add" : $advertiseItem).".php");
                                    $urlRedirect = (DEFAULT_URL."/".MEMBERS_ALIAS."/".constant(strtoupper($advertiseItem)."_FEATURE_FOLDER")."/".($advertiseItem == "banner" ? "add" : $advertiseItem).".php").("?advertise=yes&advertise_item=$advertiseItem&item_id=".$unique_id."");
                                    $_SESSION['advertise'] = 'yes';
                                    include(INCLUDES_DIR."/forms/form_facebooklogin.php");
                                    unset($fbLabel);
                                }

                                if ($googleEnabled) {
                                    $goLabel = system_showText(LANG_LOGINGOOGLEUSER);
                                    $urlRedirect = "&advertise=yes&advertise_item=$advertiseItem&item_id=".$unique_id."&destiny=".urlencode(DEFAULT_URL."/".MEMBERS_ALIAS."/".constant(strtoupper($advertiseItem)."_FEATURE_FOLDER")."/".($advertiseItem == "banner" ? "add" : $advertiseItem).".php");
                                    include(INCLUDES_DIR."/forms/form_googlelogin.php");
                                    unset($goLabel);
                                }
                                ?>

			                    <p class="text-center divisor"><?=system_showText(LANG_OR_SIGNINEMAIL);?></p>            

			                <? }
                            
                            $advertise_section = true;
                            if( EDIR_THEME==='review' ){
                                include(INCLUDES_DIR."/forms/form_login_review.php");    
                            }
                            else {
                                include(INCLUDES_DIR."/forms/form_login.php");
                            }?>

			            </section>

			            <section class="login-underbox">
			                <p><a class="link-highlight" href="javascript:void(0);" onclick="$('#advertise_login').css('display', 'none'); $('#advertise_signup').fadeIn(500);"><?=system_showText(LANG_LABEL_SIGNUPNOW);?></a></p>
			            </section>

			        </div>
                    
			        <div id="advertise_signup">
                        
			            <section class="login-box">

			                <? if ($foreignaccount_google || FACEBOOK_APP_ENABLED == "on") {
			                    
                                if ($facebookEnabled) {
                                    $fbLabel = system_showText(LANG_SIGNUPFACEBOOKUSER);
                                //  $urlRedirect = "?advertise=yes&advertise_item=$advertiseItem&item_id=".$unique_id."&destiny=".urlencode(DEFAULT_URL."/".MEMBERS_ALIAS."/".constant(strtoupper($advertiseItem)."_FEATURE_FOLDER")."/".($advertiseItem == "banner" ? "add" : $advertiseItem).".php");
                                     $urlRedirect = (DEFAULT_URL."/".MEMBERS_ALIAS."/".constant(strtoupper($advertiseItem)."_FEATURE_FOLDER")."/".($advertiseItem == "banner" ? "add" : $advertiseItem).".php").("?advertise=yes&advertise_item=$advertiseItem&item_id=".$unique_id."");
                                    include(INCLUDES_DIR."/forms/form_facebooklogin.php");
                                    unset($fbLabel);
                                }

                                if ($googleEnabled) {
                                    $goLabel = system_showText(LANG_SIGNUPGOOGLEUSER);
                                    $urlRedirect = "&advertise=yes&advertise_item=$advertiseItem&item_id=".$unique_id."&destiny=".urlencode(DEFAULT_URL."/".MEMBERS_ALIAS."/".constant(strtoupper($advertiseItem)."_FEATURE_FOLDER")."/".($advertiseItem == "banner" ? "add" : $advertiseItem).".php");
                                    include(INCLUDES_DIR."/forms/form_googlelogin.php");
                                    unset($goLabel);
                                }
                                ?>

			                    <p class="text-center divisor"><?=system_showText(LANG_OR_SIGNINEMAIL);?></p>            

			                <? }
                            
                            $advertise_section = true;
                            if( EDIR_THEME==='review' ){
                                include(INCLUDES_DIR."/forms/form_addaccount_review.php");    
                            }
                            else {
                                include(INCLUDES_DIR."/forms/form_addaccount.php"); 
                            }
                                ?>
			            </section>

			            <section class="login-underbox">
			                <p><a href="javascript:void(0);" onclick="$('#advertise_signup').css('display', 'none'); $('#advertise_login').fadeIn(500);"><?=system_showText(LANG_LABEL_ALREADY_MEMBER);?></a></p>
			            </section>

			        </div>
                    
			    </div>

			</div>
                <? } ?>

        </div>

    </form>
    <script>
        function showLoginAndHideAddAccount(){
            // show and hide divs
            $('#advertise_signup').css('display', 'none'); 
            $('#advertise_login').fadeIn(500);
            
            //remove required from add account
            $('#first_name').removeAttr( 'required' );
            $('#last_name').removeAttr( 'required' );
            $('#username').removeAttr( 'required' );
            $('#password').removeAttr( 'required' );
            //add required on login
            $('#dir_username').attr( 'required', true );
            $('#dir_password').attr( 'required', true );
        }
        
        function showAddAccountAndHideLogin(){
            $('#advertise_login').css('display', 'none'); 
            $('#advertise_signup').fadeIn(500);
            
            // remove required from login
            $('#dir_username').removeAttr( 'required' );
            $('#dir_password').removeAttr( 'required' );
            // add required on add account
            $('#first_name').attr( 'required', true );
            $('#last_name').attr( 'required', true );
            $('#username').attr( 'required', true );
            $('#password').attr( 'required', true );

        }
    </script>