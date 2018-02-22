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
	# * FILE: /includes/forms/form_forgot_password.php
	# ----------------------------------------------------------------------------------------------------

    if ($section == "sitemgr") { ?>

	<div class="form-login">
    
    	<h2><?=LANG_SITEMGR_FORGOOTTEN_PASS_1;?></h2>
        
        <br />
        
        <p class="login-question"><?=LANG_SITEMGR_FORGOOTTEN_PASS_TIP;?></p>
        
		<? if ($message) { ?><p class="<?=$message_class?>"><?=$message?></p><? } ?>		
		
        <div class="form-box">
            <input type="text" name="username" value="" placeholder="<?=system_showText(LANG_SITEMGR_EMAIL_ADDRESS)?>" />
            <button type="submit" value="Send It" class="stmgr-btn success"><?=LANG_SITEMGR_SEND_IT;?></button>
        </div>
       
        <p class="linkLogin">
            <a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/login.php"><?=LANG_SITEMGR_FORGOOTTEN_PASS_3;?></a>
        </p>
        
	</div>

	<? } else { ?>

		<div class="row-fluid form-login">
            
            <? if ($message_class != "informationMessage") { ?>
                <p class="<?=$message_class?>"><?=$message?></p>
                <br />
            <? } else { ?>
                <label for="username"><?=system_showText(LANG_MSG_TYPE_USERNAME);?></label>
            <? } ?>
             
            <? if ($message_class != "successMessage") { ?>
                <input class="span12" type="email" id="username" name="username" value="" placeholder="<?=system_showText(LANG_LABEL_EMAIL_ADDRESS);?>" />
            
                <div class="row-fluid action">
                    <div class="span6">
                        <p class="forgotpassword doubleline">
                            <a href="<?=DEFAULT_URL;?>/<?=$cancel_section;?>"><?=system_showText(LANG_MSG_CLICK_IF_YOU_HAVE_PASSWORD);?></a>
                        </p>
                    </div>
                    <div class="span6">
                        <button class="btn btn-login span12" type="submit" value="<?=system_showText(LANG_BUTTON_CONTINUE)?>"><?=system_showText(LANG_BUTTON_CONTINUE)?></button>
                    </div>
                </div>
                
            <? } ?>

		</div>

	<? } ?>