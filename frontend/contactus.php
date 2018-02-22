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
	# * FILE: /frontend/contactus.php
	# ----------------------------------------------------------------------------------------------------

 ?>

    <div class="contact-form contact-us-form realestate-form">
	
		<? if ($contactus_message) { ?>
			<p class="<?=$message_style?>"><?=$contactus_message?></p>
		<? } ?>
	
		<form name="contactusForm" id="contactusForm" action="<?=DEFAULT_URL?>/<?=ALIAS_CONTACTUS_URL_DIVISOR?>.php" method="post" class="form">
	
            <h2><?=system_showText(LANG_LABEL_FORMCONTACTUS);?></h2>
                            
            <div class="real-left">
                <div>
                    <label for="name">* <?=system_showText(LANG_LABEL_NAME)?></label>
                    <input id="name" name="name" value="<?=$_POST["name"];?>" type="text" class="text" />
                </div>
                
                <div>
                    <label for="email">* <?=system_showText(LANG_LABEL_EMAIL)?></label>
                    <input id="email" name="email" value="<?=$_POST["email"];?>" type="text" class="text" />
                </div>
                
                <div>
                    <label for="title">* <?=system_showText(LANG_LABEL_SUBJECT)?></label>
                    <input id="title" name="title" value="<?=$_POST["title"];?>" type="text" class="text" />
                </div>
			</div>
			
			<?
			$_POST["messageBody"] = str_replace("<br />", "", $_POST["messageBody"]);
			?>
			
            <div class="real-right">
                <div>
                    <label for="message">* <?=system_showText(LANG_LABEL_MESSAGE)?></label>
                    <textarea id="message" name="messageBody" rows="8" cols="30" class="textarea"><?=$_POST["messageBody"];?></textarea>
                </div>
			</div>
			
            <div class="real-right real-info">
                <p><?=system_showText(LANG_CAPTCHA_HELP)?></p>
                <div class="captcha">
                    <div>
                        <img src="<?=DEFAULT_URL?>/includes/code/captcha.php" border="0" alt="<?=system_showText(LANG_CAPTCHA_ALT)?>" title="<?=system_showText(LANG_CAPTCHA_TITLE)?>" />
                        <input type="text" value="" name="captchatext" class="text" />
                    </div>
                </div>
                <div class="button button-contact">
                    <h2><a href="javascript: document.contactusForm.submit();"><?=LANG_BUTTON_SEND?></a></h2>			
                </div>
			</div>
		</form>
	</div>