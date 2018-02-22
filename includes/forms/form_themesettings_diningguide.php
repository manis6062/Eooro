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
	# * FILE: /includes/forms/form_themesettings_diningguide.php
	# ----------------------------------------------------------------------------------------------------

    if ($_SERVER["REQUEST_METHOD"] != "POST") {
        
        /**
         * Pricing Levels
         */
        setting_get("listing_price_symbol", $listing_price_symbol);
        for ($i = 1; $i <= LISTING_PRICE_LEVELS; $i++) {
            setting_get("listing_price_{$i}_from", ${"listing_price_".$i."_from"});
            setting_get("listing_price_{$i}_to", ${"listing_price_".$i."_to"});
        }
        
    }

?>
    <script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/jquery/auto_upload/js/file_uploads.js"></script>
    
    <script type="text/javascript">
        
        function changePriceSymbol(price_symbol) {
            $("#inexpensive_symbol").html(price_symbol);
            $("#averagely_expensive_symbol").html(price_symbol+''+price_symbol);
            $("#moderately_expensive_symbol").html(price_symbol+''+price_symbol+''+price_symbol);            
            $("#expensive_symbol").html(price_symbol+''+price_symbol+''+price_symbol+''+price_symbol);
        }

        
        function resetImage() {
            $("#reset_form").attr("value", "reset");
            $("#dimensionY").attr("value", "");
        }
        
        function submitForm(form_id) {
            
            <? if (!DEMO_LIVE_MODE) { ?>
            
            var strReturn;
            $.post("theme_save_settings.php", $('#'+form_id).serialize(), function(response) {
                strReturn = response.split("||");
                
                $("#returnMessage").removeClass("successMessage");
                $("#returnMessage").removeClass("errorMessage");

                $("#returnMessage").addClass(strReturn[0]+"Message");
                $("#returnMessage").html(strReturn[1]);
                $("#returnMessage").show();
                
                //Reset image
                if (strReturn[2]) {

                    if (strReturn[2] == "show") {
                        $("#buttonReset").attr("disabled", "");
                        $("#buttonReset").removeClass("input-button-form-disabled");
                    } else {
                        $("#buttonReset").attr("disabled", "disabled");
                        $("#buttonReset").addClass("input-button-form-disabled");
                        $("#dimensionY").attr("disabled", "disabled")
                        $("#image-background").hide().fadeIn('slow').html(strReturn[3]);
                    }

                }
             });
             
            <? } else { ?>
				livemodeMessage('<?=system_showText(LANG_SITEMGR_DEMO_MESSAGE);?>');
			<? } ?>
        }
        
        function sendFile() {
            
            <? if (!DEMO_LIVE_MODE) { ?>
            
            $("#theme_background_image").vPB({
                url: '<?=DEFAULT_URL."/".SITEMGR_ALIAS."/prefs/theme_auto_upload.php"?>',
                beforeSubmit: function() 
                {
                    $("#loading_backgroundimage").html('<img src="<?=DEFAULT_URL?>/scripts/jquery/auto_upload/images/loadings.gif" align="absmiddle" alt="<?=system_showText(LANG_SITEMGR_WAITLOADING);?>" title="<?=system_showText(LANG_SITEMGR_WAITLOADING);?>"/>');
                },
                success: function(response) 
                {
                    strReturn = response.split("||");
                    $('#loading_backgroundimage').hide().fadeOut('slow');

                    if (strReturn[0] == "ok") {
                        $("#returnMessage").hide();
                        $("#image-background").hide().fadeIn('slow').html(strReturn[1]);
                        $("#dimensionY").attr("disabled", "")
                    } else {
                        $("#returnMessage").removeClass("successMessage");
                        $("#returnMessage").removeClass("errorMessage");

                        $("#returnMessage").addClass("errorMessage");
                        $("#returnMessage").html(strReturn[1]);
                        $("#returnMessage").show();
                    }
                }
            }).submit();
            
            <? } else { ?>
				livemodeMessage('<?=system_showText(LANG_SITEMGR_DEMO_MESSAGE);?>');
			<? } ?>
        }
        
        $(document).ready(function() {

            changePriceSymbol('<?=$listing_price_symbol;?>');
            
            $.mask.definitions['~']='[+-]';
            $("#listing_price_1_to").mask("9?9999",{placeholder:""});
            $("#listing_price_2_from").mask("9?9999",{placeholder:""});
            $("#listing_price_2_to").mask("9?9999",{placeholder:""});
            $("#listing_price_3_from").mask("9?9999",{placeholder:""});
            $("#listing_price_3_to").mask("9?9999",{placeholder:""});
            $("#listing_price_4_from").mask("9?9999",{placeholder:""});
            $("#dimensionY").mask("9?99",{placeholder:""});
            
        });

    </script>
    
    <form name="theme" id="theme" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">
					
        <input type="hidden" name="domain_id" value="<?=SELECTED_DOMAIN_ID?>" />
        <input type="hidden" name="scheme" id="scheme" value="<?=EDIR_SCHEME?>" />
        <input type="hidden" name="hiddenValue" />

        <table cellpadding="2" cellspacing="0" border="0" class="table-form">
            <tr class="tr-form">
                <th><?=system_showText(LANG_SITEMGR_SETTINGS_THEME_SELECTANTHEME)?></th>
                <td align="left" class="td-form">
                    <?=$selectthemes?>
                </td>
            </tr>
        </table>
            
    </form>

    <table cellpadding="0" cellspacing="0" border="0" class="standard-table">

        <tr>
            <th class="tabsBase">
                <ul class="tabs">
                    <li id="tab_background" <?=($tab_form == "background" || !$tab_form ? "class=\"tabActived\"" : "")?>>
                        <a href="javascript:void(0)" onclick="showTabs('background')"><?=system_showText(LANG_SITEMGR_DG_BACKGROUND)?></a>
                    </li>
                    <? /*
                    <li id="tab_map" <?=($tab_form == "map" ? "class=\"tabActived\"" : "")?>>
                        <a href="javascript:void(0)" onclick="showTabs('map')"><?=system_showText(LANG_SITEMGR_DG_MAP)?></a>
                    </li>
                    */ ?>
                    <li id="tab_options" <?=($tab_form == "options" ? "class=\"tabActived\"" : "")?>>
                        <a href="javascript:void(0)" onclick="showTabs('options')"><?=system_showText(LANG_SITEMGR_DG_OPTIONS)?></a>
                    </li>
                </ul>
            </th>
        </tr>

    </table>
    
    <p id="returnMessage" style="display:none;"></p>

    <div class="tab-content" id="content_background" <?=($tab_form == "background" || !$tab_form ? "" : "style=\"display: none;\"")?>>
        
        <form id="theme_background_image" method="post" enctype="multipart/form-data" action="javascript:void(0);" autocomplete="off">
            <input type="hidden" name="form_id" value="theme_background_image" />
            <input type="hidden" name="reset_form" id="reset_form" value="" />
            <input type="hidden" name="curr_image_id" id="curr_image_id" value="<?=$curr_image_id;?>" />
            
            <div class="image-background">
                
                <div id="image-background">
                    <?=front_getBackground($customimage);?>
                </div>
                
                <div class="image-caption"><?=IMAGE_THEME_BACKGROUND_W?> x <?=IMAGE_THEME_BACKGROUND_H?>px</div>
                
            </div>
            
            <div class="block-info">
                <h4><?=system_showText(LANG_SITEMGR_BACKGROUND_NEW);?></h4><hr/>
                <p><?=str_replace("[dimension]", IMAGE_THEME_BACKGROUND_W." x ".IMAGE_THEME_BACKGROUND_H, system_showText(LANG_SITEMGR_BACKGROUND_TIP));?></p>
               
                <div class="form-inline">
                    <label for="imagefile"><?=system_showText(LANG_LABEL_IMAGEFILE);?>:</label>
                    <input type="file" name="file_background_image" id="file_background_image" onchange="sendFile();" />
                    <div id="loading_backgroundimage" class="background-login"></div>
                </div>

                <div class="form-inline">
                    <label><?=system_showText(LANG_SITEMGR_BACKGROUND_DIMENSIONS);?>:</label>
                    <div class="dimensions">
                        <label for="dimensionY"><?=system_showText(LANG_SITEMGR_BACKGROUND_HEIGHT);?></label>
                        <input type="text" name="dimensionY" id="dimensionY" class="small" <?=(!$customimage ? "disabled=\"\"" : "")?> value="<?=$background_image_height;?>" />
                    </div>
                </div>
                
                <button class="input-button-form" type="button" onclick="submitForm('theme_background_image')"><?=system_showText(LANG_BUTTON_UPDATE);?></button>
                <button id="buttonReset" class="input-button-form <?=(!$customimage ? "input-button-form-disabled" : "")?>" type="button" <?=(!$customimage ? "disabled=\"\"" : "")?> onclick="resetImage(); submitForm('theme_background_image');" ><?=system_showText(LANG_SITEMGR_RESET);?></button>
                
            </div>
            
        </form>
        
    </div>
   
    <div class="tab-content" id="content_options" <?=($tab_form == "options" ? "" : "style=\"display: none;\"")?>>
        
        <form id="pricing_levels_form" />
        
            <input type="hidden" name="form_id" value="pricing_levels_form" />
            
            <div class="block-info">
                
                <h4><?=system_showText(LANG_SITEMGR_PRICING_LEVELS)?></h4>
                <p><?=system_showText(LANG_SITEMGR_PRICING_LEVELS_TEXT)?></p>
                <hr/>
                <h4><?=system_showText(LANG_SITEMGR_PRICING_LEVELS_SYMBOL)?></h4>
                <p class="inline"><?=system_showText(LANG_SITEMGR_PRICING_LEVELS_WHICH_SYMBOL)?></p>
                
                <div class="form-option inline">
                    
                    <input type="radio" id="symbol-1" value="$" name="symbol" onclick="changePriceSymbol('$')" <?=($listing_price_symbol == "$" ? "checked=\"checked\"" : "")?>/>
                    <label for="symbol-1" class="symbol">$</label>
                    
                    <input type="radio" id="symbol-2" value="£" name="symbol" onclick="changePriceSymbol('£')" <?=($listing_price_symbol == "£" ? "checked=\"checked\"" : "")?> />
                    <label for="symbol-2" class="symbol">£</label>
                    
                    <input type="radio" id="symbol-3" value="€" name="symbol" onclick="changePriceSymbol('€')" <?=($listing_price_symbol == "€" ? "checked=\"checked\"" : "")?> />
                    <label for="symbol-3" class="symbol">€</label>
                        
                    <input type="radio" id="symbol-4" value="custom" name="symbol" onclick="changePriceSymbol(document.getElementById('custom_symbol').value);" <?=(($listing_price_symbol != "€" && $listing_price_symbol != "£" && $listing_price_symbol != "$") ? "checked=\"checked\"" : "")?>/>
                    
                    <label for="symbol-4">
                        <input type="text" name="custom_symbol" id="custom_symbol" class="small" maxlength="3" onkeyup="changePriceSymbol(this.value);" value="<?=(($listing_price_symbol != "€" && $listing_price_symbol != "£" && $listing_price_symbol != "$") ? $listing_price_symbol : "")?>" />
                    </label>
                    
                </div>
                
                <hr/>
                <h4><?=system_showText(LANG_SITEMGR_PRICING_RANGES)?></h4>
                <p><?=system_showText(LANG_SITEMGR_PRICING_RANGES_TEXT)?></p>
                <br/>
                
                <table cellpadding="0" cellspacing="0" border="0" class="standard-table">
                    <tr>
                        <th><strong id="inexpensive_symbol">$</strong> <?=system_showText(LANG_SITEMGR_PRICING_INEXPENSIVE)?></th>
                        <td>
                            <div class="form-inline">
                                <span class="notinput big">0</span> <em>-</em>  <input type="text" class="small" maxlength="5" name="listing_price_1_to" id="listing_price_1_to" value="<?=$listing_price_1_to?>" />
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th><strong id="averagely_expensive_symbol">$$</strong> <?=system_showText(LANG_SITEMGR_PRICING_AVERAGELY_EXPENSIVE)?></th>
                        <td>
                            <div class="form-inline">
                                <input type="text" class="small" maxlength="5" name="listing_price_2_from" id="listing_price_2_from" value="<?=$listing_price_2_from?>" /> <em>-</em>  <input type="text" class="small" maxlength="5" name="listing_price_2_to" id="listing_price_2_to" value="<?=$listing_price_2_to?>" />
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th><strong id="moderately_expensive_symbol">$$$</strong> <?=system_showText(LANG_SITEMGR_PRICING_MODERATELY_EXPENSIVE)?></th>
                        <td>
                            <div class="form-inline">
                                <input type="text" class="small" maxlength="5" name="listing_price_3_from" id="listing_price_3_from" value="<?=$listing_price_3_from?>"/> <em>-</em>  <input type="text" class="small" maxlength="5" name="listing_price_3_to" id="listing_price_3_to" value="<?=$listing_price_3_to?>" />
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th><strong id="expensive_symbol">$$$$</strong> <?=system_showText(LANG_SITEMGR_PRICING_EXPENSIVE)?></th>
                        <td>
                            <div class="form-inline">
                                <input type="text" class="small" maxlength="5" name="listing_price_4_from" id="listing_price_4_from" value="<?=$listing_price_4_from?>"/> <em>-</em> <span class="notinput"><?=system_showText(LANG_SITEMGR_PRICING_AND_UPWARDS)?></span>
                            </div>
                        </td>
                    </tr>
                </table>
                <button type="button" name="submit_bt" value="options" class="input-button-form" onclick="submitForm('pricing_levels_form')"><?=system_showText(LANG_SITEMGR_SUBMIT);?></button>
            </div>
        </form>
    </div>
