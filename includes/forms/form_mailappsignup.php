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
	# * FILE: /includes/forms/form_mailappsignup.php
	# ----------------------------------------------------------------------------------------------------

?>
    <script language="javascript" type="text/javascript">

        function showAccountTabes(num_div, accType) {
            $("#accType").attr("value", accType);

            for (j = 0; j < 2; j++) {
                $('#account_'+j).css('display', 'none');
                $('#tab_account_'+j).removeClass("tabActived");
            }    
            $('#account_'+num_div).css('display', '');
            $('#tab_account_'+num_div).addClass("tabActived");

        }
        
        function disconnect() {
            dialogBox('confirm', '<?=system_showText(LANG_SITEMGR_MAILAPP_DISCONNECTACC_CONFIRM);?>', 0, 'arcamailer_disconnect', '245', '<?=system_showText(LANG_SITEMGR_OK);?>', '<?=system_showText(LANG_SITEMGR_CANCEL);?>');
        }
        
        function openLogin() {
            window.open("http://send.arcamailer.com<?=($edir_customer_id && $edir_email ? "?username=$edir_email" : "")?>", "_blank");
        }
    </script>

    <br class="clear" />

    <div class="block-info">
        
        <h4><?=system_showText(LANG_SITEMGR_MAILAPP_NEWSLETTERS);?></h4>
        
        <div style="width: 225px; height:45px; margin: 20px 0 10px 0; background-image: url('../images/arcamailer.png')"></div>
        <div class="sample-img"></div> 
        <p><?=str_replace("[/a]", "</a>", (str_replace("[a]", "<a href=\"".MAILAPP_LIVE_URL."\" target=\"_blank\">", system_showText(LANG_SITEMGR_MAILAPP_SIGNUP_TIP_1))));?></p>
        <p><?=system_showText(LANG_SITEMGR_MAILAPP_SIGNUP_TIP_2);?></p>
        <p><?=system_showText(LANG_SITEMGR_MAILAPP_SIGNUP_TIP_3);?></p>
        <p><?=str_replace("[/a]", "</a>", (str_replace("[a]", "<a href=\"".DEFAULT_URL."/".SITEMGR_ALIAS."/export/arcamailerexport.php\" target=\"_blank\">", system_showText(LANG_SITEMGR_MAILAPP_SIGNUP_TIP_4))));?></p>
        <p><?=system_showText(LANG_SITEMGR_MAILAPP_SIGNUP_1);?></p>
        
      
        
    </div>

    <div class="block-info mailapp">

        <h4>1. <?=system_showText(LANG_SITEMGR_MAILAPP_SIGNUP_1_TIP);?></h4>
        
        <form name="mailappdisconnect" id="arcamailer_disconnect" method="post" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>">
            <input type="hidden" name="disconnet" value="yes" />
        </form>

        <form name="mailapp" id="mailapp" method="post" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>">

            <input type="hidden" name="actionForm" value="newAcc" />
            
            <input type="hidden" id="accType" name="account_type" value="<?=($account_type ? $account_type : "new");?>" />
            
            <table cellpadding="0" cellspacing="0" border="0" class="standard-table import_steps_table">
                <tr>
                    <th class="tabsBase">
                        <ul class="tabs">
                            <li id="tab_account_0" <?=($account_type == "new" || !$account_type) ? "class=\"tabActived\"" : ""?>>
                                <a href="javascript:void(0);" onclick="showAccountTabes(0, 'new');" ><?=system_showText(LANG_SITEMGR_MAILAPP_NEWACCOUNT);?></a>
                            </li>
                            <li id="tab_account_1" <?=($account_type == "existing") ? "class=\"tabActived\"" : ""?>>
                                <a href="javascript:void(0);" onclick="showAccountTabes(1, 'existing');"><?=system_showText(LANG_SITEMGR_MAILAPP_EXISTINGACCOUNT);?></a>
                            </li>
                        </ul>
                    </th>
                </tr>
            </table>
            
            <a name="account"></a>

            <div id="account_0" class="group" <?=($account_type == "new" || !$account_type) ? "" : "style=\"display:none;\""?>>

                <? if ($message_mailapp && $actionForm == "newAcc" && $account_type == "new") { ?>
                    <p class="errorMessage"><?=$message_mailapp;?></p>
                <? } elseif ($messageSignup) { ?>
                    <p class="successMessage"><?=system_showText(LANG_SITEMGR_MAILAPP_ACCDONE);?></p>
                <? } elseif ($messageConnect) { ?>
                    <p class="successMessage"><?=system_showText(LANG_SITEMGR_MAILAPP_CONNECTDONE);?></p>
                <? } elseif ($messageDisconnect) { ?>
                    <p class="successMessage"><?=system_showText(LANG_SITEMGR_MAILAPP_DISCONNECTDONE);?></p>
                <? } ?>

                <div>
                    <i class="ico ico-user"></i>

                    <input class="ico-input" type="text" id="idname" name="edir_name" placeholder="<?=system_showText(LANG_SITEMGR_MAILAPP_NAME);?>" value="<?=$edir_name;?>" <?=($edir_customer_id ? "disabled=\"disabled\"" : "")?>/>

                    <select name="edir_country" id="edir_country" <?=($edir_customer_id ? "disabled=\"disabled\"" : "")?>>
                        <option value="0"><?=system_showText(LANG_SITEMGR_LABEL_COUNTRY);?></option>
                        <?=$countryOptions;?>
                    </select>
                </div>

                <div>
                    <i class="ico ico-mail"></i>

                    <input class="ico-input" type="text" id="idemail" name="edir_email" placeholder="<?=system_showText(LANG_SITEMGR_LABEL_EMAILADDRESS);?>" value="<?=$edir_email;?>" <?=($edir_customer_id ? "disabled=\"disabled\"" : "")?>/>

                    <select name="edir_timezone" id="edir_timezone" <?=($edir_customer_id ? "disabled=\"disabled\"" : "")?>>
                        <option value="0"><?=system_showText(LANG_SITEMGR_MAILAPP_TIMEZONE);?></option>
                        <?=$timezoneOptions;?>
                    </select>
                </div>
                    
                <div class="groupcheckbox">
	                <p><i>* <?=system_showText(LANG_SITEMGR_MAILAPP_FREEACC);?></i></p>
				</div>
                    
                <? if ($edir_customer_id) { ?>
                    
                    <button type="button" onclick="disconnect();" class="button-green"><?=system_showText(LANG_SITEMGR_MAILAPP_DISCONNECTACC);?></button>
                    
                <? } else { ?>
                    
                    <button type="submit" class="button-green"><?=system_showText(LANG_SITEMGR_MAILAPP_CREATEACC);?></button>
                    
                <? } ?>

            </div>
            
            <div id="account_1" class="group" <?=($account_type == "existing") ? "" : "style=\"display:none;\""?>>

                <? if ($message_mailapp && $actionForm == "newAcc" && $account_type == "existing") { ?>
                    <p class="errorMessage"><?=$message_mailapp;?></p>
                <? } elseif ($messageSignup) { ?>
                    <p class="successMessage"><?=system_showText(LANG_SITEMGR_MAILAPP_ACCDONE);?></p>
                <? } ?>

                <div>
                    <i class="ico ico-user"></i>

                    <input class="ico-input" type="text" <?=($edir_customer_id ? "disabled=\"disabled\"" : "")?> name="arcamailer_username" placeholder="<?=system_showText(LANG_SITEMGR_MAILAPP_USERNAME);?>" value="<?=$arcamailer_username;?>" <?=($edir_list_id ? "disabled=\"disabled\"" : "")?>/>
                </div>
                    
                <div>
                    <i class="ico ico-lock"></i>

                    <input class="ico-input" type="password" <?=($edir_customer_id ? "disabled=\"disabled\"" : "")?> name="arcamailer_password" placeholder="<?=system_showText(LANG_SITEMGR_MAILAPP_PASSWORD);?>" <?=($edir_list_id ? "disabled=\"disabled\"" : "")?>/>
                </div>
                    
                <? if ($edir_customer_id) { ?>
                    
                    <button type="button" onclick="disconnect();" class="button-green"><?=system_showText(LANG_SITEMGR_MAILAPP_DISCONNECTACC);?></button>
                    
                <? } else { ?>

                    <button type="submit" class="button-green"><?=system_showText(LANG_SITEMGR_MAILAPP_CONNECTACC);?></button>

                <? } ?>
                
            </div>

        </form>

    </div>

    <div class="block-info mailapp">

        <h4>2. <?=system_showText(LANG_SITEMGR_MAILAPP_SIGNUP_2_TIP);?></h4>

        <form name="mailapp" id="mailapp" method="post" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>">

            <input type="hidden" name="actionForm" value="newList" />
            <input type="hidden" name="edir_customer_id" value="<?=$edir_customer_id?>" />
            <input type="hidden" name="edir_list_id" value="<?=$edir_list_id?>" />

            <div class="group">

                <a name="newsletter"></a>

                <? if ($message_mailapp && $actionForm == "newList") { ?>
                    <p class="errorMessage"><?=$message_mailapp;?></p>
                <? } elseif ($messageUpdate) { ?>
                    <p class="successMessage"><?=system_showText(LANG_SITEMGR_MAILAPP_LISTUPDATE);?></p>
                <? } elseif ($messageNewList) { ?>
                    <p class="successMessage"><?=system_showText(LANG_SITEMGR_MAILAPP_LISTCREATE);?></p>
                <? } ?>
                
				<div>
                    <span><?=system_showText(LANG_SITEMGR_MAILAPP_NEWSLETTER);?></span>
                    <input type="text" id="idlist" name="edir_list" <?=(!$edir_customer_id ? "disabled=\"disabled\"" : "")?> maxlength="50" value="<?=($edir_list ? $edir_list : EDIRECTORY_TITLE." ".LANG_SITEMGR_MAILAPP_NEWSLETTER_SING);?>" <?=($edir_list_id ? "disabled=\"disabled\"" : "")?>/>
                </div>

                <div>
                    <span><?=system_showText(LANG_SITEMGR_MAILAPP_NEWSLETTER_LABEL);?></span>
                    <input type="text" id="idlistLabel" name="edir_list_label" <?=(!$edir_customer_id ? "disabled=\"disabled\"" : "")?> maxlength="50" value="<?=($edir_list_label ? $edir_list_label : LANG_SITEMGR_MAILAPP_NEWSLETTER_LABEL_TIP);?>" />
                </div>
                    
                <div class="groupcheckbox">
	                <input type="checkbox" name="enable_list" value="on" <?=($edir_enable_list ? "checked=\"checked\"" : ""); ?> <?=(!$edir_customer_id ? "disabled=\"disabled\"" : "")?> />
	                <p><?=system_showText(LANG_SITEMGR_MAILAPP_ACTIVATENEWSLETTER);?></p>
				</div>
                
                <button type="submit" class="button-green <?=(!$edir_customer_id ? "buttonDisabled" : "")?>" <?=(!$edir_customer_id ? "disabled=\"disabled\"" : "")?>><?=system_showText(LANG_BUTTON_SUBMIT);?></button>

            </div>

        </form>

    </div>
    
    <div class="block-info mailapp">
        
        <h4>3. <?=system_showText(LANG_SITEMGR_MAILAPP_SIGNUP_3_TIP);?></h4>
        
        <div class="group center">
            
            <button type="button" class="button-green " onclick="openLogin();"><?=system_showText(LANG_SITEMGR_MAILAAP_LOGIN);?></button>
            
        </div>
        
    </div>