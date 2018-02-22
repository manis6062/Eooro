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
	# * FILE: /inclues/forms/form_profile.php
	# ----------------------------------------------------------------------------------------------------

?>

    <script type="text/javascript">
        //<![CDATA[       

        function getFacebookImage() {
            
            $("#image_fb").html("<img src=\"" + DEFAULT_URL + "/images/img_loading_big.gif\" alt=\"\" />");
            
            $.post(DEFAULT_URL + "/<?=MEMBERS_ALIAS?>/ajax.php", {
                ajax_type: 'getFacebookImage',
                id: '<?=sess_getAccountIdFromSession();?>'
            }, function(newImage) {
                var eURL = /http(s)?:\/\/([\w-]+\.)+[\w-]+(\/[\w- ./?%&=]*)?/
                var arrInfo = newImage.split("[FBIMG]");
                var imgSize = "";
                
                if (arrInfo[0] && eURL.exec(arrInfo[0])) {
                    $("#facebook_image").val(arrInfo[0]);
                    if (arrInfo[1] && arrInfo[2]) {
                        var w = parseInt(arrInfo[1]);
                        var h = parseInt(arrInfo[2]);
                        $("#facebook_image_height").val(h);
                        $("#facebook_image_width").val(w);

                        imgSize = " width=\"" + w + "\" ";
                        imgSize += " height=\"" + h + "\" ";
                    } else {
                        $("#facebook_image_height").val("<?=PROFILE_MEMBERS_IMAGE_HEIGHT?>");
                        $("#facebook_image_widht").val("<?=PROFILE_MEMBERS_IMAGE_WIDTH?>");
                        imgSize = " width=\"<?=PROFILE_MEMBERS_IMAGE_WIDTH?>\" ";
                        imgSize += " height=\"<?=PROFILE_MEMBERS_IMAGE_HEIGHT?>\" ";
                    }
                    $("#image_fb").html("<img src=\"" + arrInfo[0] + "\" " + imgSize + " alt=\"\" />");
                    if ($("#message").text() == "<?=system_showText(LANG_MSGERROR_ERRORUPLOADINGIMAGE);?>") {
                        $("#message").removeClass("errorMessage");
                        $("#message").text("");
                    }
                } else if (!eURL.exec(arrInfo[0])) {
                    $("#facebook_image").val("");
                    $("#image_fb").html("<img src=\"<?=DEFAULT_URL;?>/images/profile_noimage.png\" width=\"<?=PROFILE_MEMBERS_IMAGE_WIDTH?>\" height=\"<?=PROFILE_MEMBERS_IMAGE_HEIGHT?>\" alt=\"No Image\" />");
                    $("#message").removeClass("successMessage");
                    $("#message").removeClass("informationMessage");
                    $("#message").addClass("errorMessage");
                    $("#message").text("<?=system_showText(LANG_MSGERROR_ERRORUPLOADINGIMAGE);?>");
                }
            });
        }

        function profileStatus(check_id) {
            var check = $("#" + check_id).attr("checked");

            $.post(DEFAULT_URL + "/includes/code/profile.php", {
                action: "changeStatus",
                has_profile: check,
                account_id: '<?=sess_getAccountIdFromSession();?>',
                ajax: true
            });
            
        }

        function validateFriendlyURL(friendly_url, current_acc) {
        
            $("#URL_ok").css("display", "none");
            $("#URL_notok").css("display", "none");
        
            if (friendly_url) {

                $("#loadingURL").css("display", "");

                $.get(DEFAULT_URL + "/check_friendlyurl.php", {
                    type: "profile",
                    friendly_url: friendly_url,
                    current_acc : current_acc
                }, function (response) {
                    if (response == "ok") {
                        $("#urlSample").html(friendly_url);
                        $("#URL_ok").css("display", "");
                        $("#URL_notok").css("display", "none");
                    } else {
                        $("#URL_ok").css("display", "none");
                        $("#URL_notok").css("display", "");
                    }
                    $("#loadingURL").css("display", "none");
                });
            } else {
                $("#URL_ok").css("display", "none");
                $("#URL_notok").css("display", "none");
            }
        }
        
        function removePhoto() {
            $.post(DEFAULT_URL + "/includes/code/profile.php", {
                action: "removePhoto",
                account_id: '<?=sess_getAccountIdFromSession();?>',
                ajax: true
            }, function(){
                $("#facebook_image").attr("value", "");
                $("#facebook_image_height").attr("value", "");
                $("#facebook_image_width").attr("value", "");
                $("#linkRemovePhoto").css("display", "none");
                $("#image_fb").html("<img src=\"<?=DEFAULT_URL;?>/images/profile_noimage.png\" width=\"<?=PROFILE_MEMBERS_IMAGE_WIDTH?>\" height=\"<?=PROFILE_MEMBERS_IMAGE_HEIGHT?>\" alt=\"No Image\" />");
            });
        }
        //]]>
    </script>
    
    <?

    $validate_demodirectoryDotCom = true;

    if (DEMO_LIVE_MODE) {
        $validate_demodirectoryDotCom = validate_demodirectoryDotCom($username, $message_demoDotCom);
    }
    
    if (!$facebook_image) {
        if ($image_id) {
            
            $imageObj = new Image($image_id, true);
            if ($imageObj->imageExists()) {
                $imgTag = $imageObj->getTag(true, PROFILE_MEMBERS_IMAGE_WIDTH, PROFILE_MEMBERS_IMAGE_HEIGHT);
            } else {
                $imgTag = "<img src=\"".DEFAULT_URL."/images/profile_noimage.png\" width=\"".PROFILE_MEMBERS_IMAGE_WIDTH."\" height=\"".PROFILE_MEMBERS_IMAGE_HEIGHT."\" alt=\"No Image\" />";
            }
        } else {
            $imgTag = "<img src=\"".DEFAULT_URL."/images/profile_noimage.png\" width=\"".PROFILE_MEMBERS_IMAGE_WIDTH."\" height=\"".PROFILE_MEMBERS_IMAGE_HEIGHT."\" alt=\"No Image\" />";
        }
    } else {
        if ($facebook_image) {
            if (HTTPS_MODE == "on") {
                $facebook_image = str_replace("http://", "https://", $facebook_image);
            }
            $imgTag = "<img src=\"".$facebook_image."\" width=\"".PROFILE_MEMBERS_IMAGE_WIDTH."\" height=\"".PROFILE_MEMBERS_IMAGE_HEIGHT."\" alt=\"Facebook Image\" />";
        } else {
            $imgTag = "<img src=\"".DEFAULT_URL."/images/profile_noimage.png\" width=\"".PROFILE_MEMBERS_IMAGE_WIDTH."\" height=\"".PROFILE_MEMBERS_IMAGE_HEIGHT."\" alt=\"No Image\" />";
        }
    }
    
    $domain = new Domain(SELECTED_DOMAIN_ID);
	$domain_url = (SSL_ENABLED == "on" && FORCE_PROFILE_SSL == "on" ? "https://" : "http://").$domain->getString("url").EDIRECTORY_FOLDER."/".SOCIALNETWORK_FEATURE_NAME;
    include(EDIRECTORY_ROOT."/includes/code/thumbnail.php");
    ?>
        
    <div id="hiddenFields" style="display: none;">
        <input type="hidden" id="facebook_image" name="facebook_image" value="<?=$facebook_image?>" />
        <input type="hidden" id="facebook_image_height" name="facebook_image_height" value="<?=$facebook_image_height?>" />
        <input type="hidden" id="facebook_image_width" name="facebook_image_width" value="<?=$facebook_image_width?>" />
        <input type="hidden" name="image_id" value="<?=$image_id?>" />

        <!--Crop Tool Inputs-->
        <input type="hidden" name="x" id="x" />
        <input type="hidden" name="y" id="y" />
        <input type="hidden" name="x2" id="x2" />
        <input type="hidden" name="y2" id="y2" />
        <input type="hidden" name="w" id="w" />
        <input type="hidden" name="h" id="h" />
        <input type="hidden" name="image_width" id="image_width" />
        <input type="hidden" name="image_height" id="image_height" />
        <input type="hidden" name="image_type" id="image_type" />
        <input type="hidden" name="crop_submit" id="crop_submit" />
    </div>
    
    <div id="personal-info">
                    
        <div class="left textright">

            <h2 class="pi"><?=system_showText(LANG_LABEL_PROFILE_INFORMATION);?></h2>
            
            <div id="image_fb">
                <?=$imgTag;?>
            </div>           
            
            <div class="hiddenFile-box">
                                                       
                <span class="hiddenFile">
                    <button type="button" id="buttonfile"><?=system_showText(LANG_LABEL_PROFILE_CHANGEPHOTO);?></button>
                    <input type="file" name="image" id="image" size="1" onchange="UploadImage('account');"/>
                </span>

            </div>
            
            <br />
            
            <? if ($image_id || $facebook_image) { ?>
                <div id="linkRemovePhoto">
                    <a href="javascript: void(0);" onclick="removePhoto();"><?=system_showText(LANG_LABEL_PROFILE_REMOVEPHOTO);?></a>
                    <br />
                </div>
            <? } ?>
            
            <? if ($accountObj->getString("facebook_username")) { ?>
            
                <a href="javascript:void(0);" onclick="getFacebookImage();">
                    <img src="<?=DEFAULT_URL?>/images/icon_facebook.gif" class="alignIMGtxt" alt=""/>
                    <?=system_showText(LANG_LABEL_IMAGE_FROM_FACEBOOK);?>
                </a>
                
            <? } ?>

        </div>
        <div class="right one">
            <?if($accountObj->foreignaccount== 'y'){$foreign= true;}else{$foreign= false;}?>
            <div class="cont_70">
                <label>Nickname*</label>
              
                 <input type="text" id="nn" name="nickname" value="<?=$nickname?>" />
                
            </div>

            <div class="cont_100">
                <label><?=system_showText(LANG_LABEL_ABOUT_ME);?></label>
                <textarea id="personal_message" name="personal_message" rows="7" cols="1"><?=$personal_message?></textarea>			
            </div>

        </div>

    </div>
        
    <div id="personal-page">

        <div class="left pull-left">

            <h2><?=system_showText(LANG_LABEL_PROFILE_PERSONALPAGE);?></h2> 				
            <span><?=system_showText(LANG_MSG_FRIENDLY_URL_PROFILE_TIP);?></span>

        </div>

        <div class="right">
            
            <? if ($validate_demodirectoryDotCom && $is_sponsor == "y") { ?>
                <!-- TODO: No functionality, so, hidden-->
                <div class="cont_checkbox" style="display:none">
                    <input type="checkbox" id="has_profile" name="has_profile" <?=($has_profile == "y") ? "checked=\"checked\"": "" ?> onclick="profileStatus(this.id);" />
                    <label for="has_profile"><?=system_showText(LANG_LABEL_CREATE_PERSONAL_PAGE);?></label>
                </div>
            <? } ?>

            <div class="cont_100">
                <label><?=system_showText(LANG_LABEL_YOUR_URL);?>* <a href="javascript: void(0);">* <span><?=system_showText(LANG_LABEL_REQUIRED_FIELD);?></span></a></label>
                
                <div class="checking">
                    <input type="text" name="friendly_url" id="friendly_url" value="<?=$friendly_url?>" onblur="easyFriendlyUrl(this.value, 'friendly_url', '<?=FRIENDLYURL_VALIDCHARS?>', '<?=FRIENDLYURL_SEPARATOR?>'); validateFriendlyURL(this.value, <?=(sess_getAccountIdFromSession() ? sess_getAccountIdFromSession() : 0)?>);" />
                    <img id="loadingURL" src="<?=DEFAULT_URL?>/images/img_loading.gif" width="15px;" style="display: none;" />
                    <span id="URL_ok" class="positive" style="display: none;"> <img src="<?=DEFAULT_URL?>/images/ico-approve.png" border="0" alt="" /> <?=system_showText(LANG_LABEL_URLOK);?></span>
                    <span id="URL_notok" class="negative" style="display: none;"> <img src="<?=DEFAULT_URL?>/images/ico-deny.png" border="0" alt="" /> <?=system_showText(LANG_LABEL_URLNOTOK);?></span>
                </div>	 					 				
            </div>

            <div class="cont_100">
                <label class="label_100"><?=$domain_url;?>/<b id="urlSample"><?=($friendly_url ? $friendly_url : system_showText(LANG_LABEL_YOUR_URLTIP))?></b>/</label>
            </div>

        </div>

    </div>

    <script language="javascript" type="text/javascript">

        $(document).ready(function() {
            <?
                if ( DEFAULT_DATE_FORMAT == "m/d/Y" ) $date_format = "mm/dd/yy";
                elseif ( DEFAULT_DATE_FORMAT == "d/m/Y" ) $date_format = "dd/mm/yy";
            ?>

            var field_name = 'personal_message';
            var count_field_name = 'personal_message_remLen';

            var options = {
                        'maxCharacterSize': 250,
                        'originalStyle': 'originalTextareaInfo',
                        'warningStyle' : 'warningTextareaInfo',
                        'warningNumber': 40,
                        'displayFormat' : '<span><input readonly="readonly" type="text" id="'+count_field_name+'" name="'+count_field_name+'" size="3" maxlength="3" value="#left" class="textcounter" disabled="disabled" /> <?=system_showText(LANG_MSG_CHARS_LEFT)?> <?=system_showText(LANG_MSG_INCLUDING_SPACES_LINE_BREAKS)?></span>' 
                };
            $('#'+field_name).textareaCount(options);

        });
    </script>

   