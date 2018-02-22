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
	# * FILE: /frontend/lead.php
	# ----------------------------------------------------------------------------------------------------

 ?>

    <div class="contact-form">
	
		<? if ($lead_message) { ?>
			<p class="<?=$message_style?>"><?=$lead_message?></p><br />
		<? } ?>
	
		<form name="leadForm" id="leadForm" action="<?=DEFAULT_URL?>/<?=ALIAS_LEAD_URL_DIVISOR?>.php" method="post" class="form">
	                            
            <div class="span6">
                <div>
                    <label for="first_name"><?=system_showText(LANG_LEAD_FIRSTNAME)?><b>*</b></label>
                    <input id="first_name" name="first_name" value="<?=(sess_getAccountIdFromSession() && is_object($userInfo) && !$_POST) ? ($userInfo->getString("first_name")) : ($_POST["first_name"])?>" value="<?=$_POST["first_name"];?>" type="text" class="text span12" tabindex="1" <?=(sess_getAccountIdFromSession() && is_object($userInfo)) ? "readonly=\"readonly\"" : ""?> />
                </div>

                <div>
                    <label for="email"><?=system_showText(LANG_LEAD_EMAIL)?><b>*</b></label>
                    <input id="email" name="email" value="<?=(sess_getAccountIdFromSession() && is_object($userInfo) && !$_POST) ? ($userInfo->getString("email")) : ($_POST["email"])?>" type="email" class="text span12" tabindex="3" />
                </div>
            </div>

            <div class="span6">    
                <div>
                    <label for="last_name"><?=system_showText(LANG_LEAD_LASTNAME)?><b>*</b></label>
                    <input id="last_name" name="last_name" value="<?=(sess_getAccountIdFromSession() && is_object($userInfo) && !$_POST) ? ($userInfo->getString("last_name")) : ($_POST["last_name"])?>" type="text" class="text span12" tabindex="2" <?=(sess_getAccountIdFromSession() && is_object($userInfo)) ? "readonly=\"readonly\"" : ""?> />
                </div>
                
                <div>
                    <label for="phone"><?=system_showText(LANG_LEAD_PHONE)?></label>
                    <input id="phone" name="phone" value="<?=(sess_getAccountIdFromSession() && is_object($userInfo) && !$_POST) ? ($userInfo->getString("phone")) : ($_POST["phone"])?>" type="text" class="text span12" tabindex="4" />
                </div>
			</div>

			<div class="row-fluid">

                <div>
                    <label for="subject"><?=system_showText(LANG_LABEL_SUBJECT)?><b>*</b></label>
                    <input id="subject" name="subject" value="<?=$_POST["subject"];?>" type="text" class="text span12" tabindex="7" />
                </div>

			</div>
			
			<?
			$_POST["messageBody"] = str_replace("<br />", "", $_POST["messageBody"]);
			?>
			
            <label for="message"><?=system_showText(LANG_LEAD_MESSAGE)?><b>*</b></label>
            
            <textarea id="message" name="messageBody" rows="5" cols="30" class="textarea span12" tabindex="8"><?=$_POST["messageBody"];?></textarea>
         
			<?
            $nextTabindex = 9;
            $editorFolder = EDIRECTORY_ROOT."/custom/domain_".SELECTED_DOMAIN_ID."/editor/lead";
            
            if (file_exists($editorFolder."/save.json")) {

                $jsonstr = file_get_contents($editorFolder."/save.json");
                $arrayJson = array('form_structure' => $jsonstr);
                $form = new Formbuilder($arrayJson, 8);
                $form->render_html('');
                $nextTabindex = $form->tabIndex;
            
            }
            
            ?>
            
            <div class="row-fluid">
	            <div class="captcha span5">
	                <img class="pull-left" src="<?=DEFAULT_URL?>/includes/code/captcha.php" border="0" alt="<?=system_showText(LANG_CAPTCHA_ALT)?>" title="<?=system_showText(LANG_CAPTCHA_TITLE)?>" />
	                <input type="text" value="" name="captchatext" class="text span7 pull-right" tabindex="<?=$nextTabindex;?>" />                    
	            </div>
	            <button class="btn btn-success span4"><?=LANG_BUTTON_SEND?></button>
            </div>
            
			

		</form>
            
	</div>