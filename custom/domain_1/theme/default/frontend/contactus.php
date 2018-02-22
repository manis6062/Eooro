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
	# * FILE: /theme/default/frontend/contactus.php
	# ----------------------------------------------------------------------------------------------------

 ?>

    <div class="contact-form">
	
		<? if ($contactus_message) { ?>
			<p class="<?=$message_style?>"><?=$contactus_message?></p>
		<? } ?>
	
		<form name="contactusForm" id="contactusForm" action="<?=DEFAULT_URL?>/<?=ALIAS_CONTACTUS_URL_DIVISOR?>.php" method="post" class="form">
	                            
            <div class="row-fluid">
                <div>
                    <label for="name">* <?=system_showText(LANG_LABEL_NAME)?></label>
                    <input id="name" name="name" value="<?=$_POST["name"];?>" type="text" class="text span12" />
                </div>
                
                <div>
                    <label for="email">* <?=system_showText(LANG_LABEL_EMAIL)?></label>
                    <input id="email" name="email" value="<?=$_POST["email"];?>" type="email" class="text span12" />
                </div>
                
                <div>
                    <label for="title">* <?=system_showText(LANG_LABEL_SUBJECT)?></label>
                    <input id="title" name="title" value="<?=$_POST["title"];?>" type="text" class="text span12" />
                </div>
			</div>
			
			<?
			$_POST["messageBody"] = str_replace("<br />", "", $_POST["messageBody"]);
			?>
			
         
            <label for="message">* <?=system_showText(LANG_LABEL_MESSAGE)?></label>
            <textarea id="message" name="messageBody" rows="5" cols="30" class="textarea span12"><?=$_POST["messageBody"];?></textarea>
         
			
            <p><?=system_showText(LANG_CAPTCHA_HELP)?></p>
			<div class="row-fluid">
	            <div class="captcha">
	                <img class="pull-left" src="<?=DEFAULT_URL?>/includes/code/captcha.php" border="0" alt="<?=system_showText(LANG_CAPTCHA_ALT)?>" title="<?=system_showText(LANG_CAPTCHA_TITLE)?>" />
	                <input type="text" value="" name="captchatext" class="text span7 pull-right" />                    
	            </div>
            </div>
			<div>
                <button class="btn btn-success span12"><?=LANG_BUTTON_SEND?></button>
			</div>

		</form>
            
	</div>