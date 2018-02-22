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
	# * FILE: /theme/contractors/frontend/newsletter.php
	# ----------------------------------------------------------------------------------------------------   
    
    if ($showNewsletter) { ?>

    <div id="boxNewsletter" class="newsletter">

        <div class="box-newsletter row-fluid text-center">
                       
            <form>
                <div class="news-custom">
                    <h5><?=$signupLabel;?></h5>
                </div>
                <div id="news_returnMessage" style="display:none;"></div>
                <input class="span11" type="text" id="newsname" placeholder="<?=system_showText(LANG_LABEL_NAME);?>"/>
                <input class="span11" type="email" id="newsemail" placeholder="<?=system_showText(LANG_LABEL_EMAIL);?>"/>
                <button class="btn btn-success" type="button" onclick="subscribeNewsletter();"><?=system_showText(LANG_BUTTON_SIGNUP);?></button>
            </form>
            
        </div>

    </div>

    <? } ?>