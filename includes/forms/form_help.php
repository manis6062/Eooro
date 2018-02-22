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
	# * FILE: /includes/forms/form_help.php
	# ----------------------------------------------------------------------------------------------------

    if ($message_help) {
        if ($success) { ?>
            <p class="successMessage"><?=$message_help?></p>
        <? } else { ?>
            <p class="errorMessage"><?=$message_help?></p>
        <? }
    } ?>

	<label for="name"><?=system_showText(LANG_LABEL_NAME)?></label>
	<input class="span12" id="name" type="text" name="name" value="<?=$name?>" />

	<label for="email"><?=system_showText(LANG_LABEL_EMAIL)?></label>
	<input class="span12" id="email" type="text" name="email" value="<?=$email?>" />

	<label for="textarea"><?=system_showText(LANG_LABEL_TEXT)?></label>
	<textarea class="span12" id="textarea" name="text" value="<?=$text?>" rows="6"></textarea>