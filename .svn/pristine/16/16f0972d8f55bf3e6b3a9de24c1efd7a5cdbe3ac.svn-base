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
	# * FILE: /frontend/newsletter.php
	# ----------------------------------------------------------------------------------------------------

    # ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/includes/code/newsletter.php");

    if ($showNewsletter) { ?>
	
        <div class="newsletter">
            <div class="box-newsletter">
                <h3><?=$signupLabel;?></h3>
                <form>
                    <div id="news_returnMessage" style="display:none;"></div>
                    <label for="newsname"><?=system_showText(LANG_LABEL_NAME);?></label>
                    <input type="text" id="newsname"/>
                    <label for="newsemail"><?=system_showText(LANG_LABEL_EMAIL);?></label>
                    <input type="text" id="newsemail"/>
                    <button type="button" onclick="subscribeNewsletter();"><?=system_showText(LANG_ARCAMAILER_SUBSCRIBE);?></button>
                </form>
            </div>
        </div>

    <? } ?>