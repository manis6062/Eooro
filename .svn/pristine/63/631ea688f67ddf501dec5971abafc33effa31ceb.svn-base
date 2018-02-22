<?php
    $schemes = explode(",", EDIR_SCHEMES);
    $schemesnames = explode(",", EDIR_SCHEMENAMES);
?>
    <script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/jquery/auto_upload/js/file_uploads.js"></script>
    
    <script type="text/javascript">
                
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
            $.mask.definitions['~']='[+-]';
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
                    <li <?=(string_strpos($_SERVER["PHP_SELF"], "prefs/theme.php") !== false ? "class=\"tabActived\"" : "")?>>
                        <a href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/prefs/theme.php"?>"><?=system_showText(LANG_SITEMGR_DG_BACKGROUND)?></a>
                    </li>
                    <li <?=(string_strpos($_SERVER["PHP_SELF"], "prefs/colorscheme.php") !== false ? "class=\"tabActived\"" : "")?>>
                        <a href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/prefs/colorscheme.php?theme=".EDIR_THEME."&label=".$schemesnames[0]."&scheme=".$schemes[0]?>"><?=system_showText(LANG_SITEMGR_COLOR_COLOROPTIONS)?></a>
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