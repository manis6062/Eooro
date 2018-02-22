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
	# * FILE: /theme/diningguide/frontend/newsletter.php
	# ----------------------------------------------------------------------------------------------------

    # ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/includes/code/newsletter.php");

    if ($showNewsletter) { ?>
	
        <!--cachemarkerNewsletter-->
        <div id="boxNewsletter" class="newsletter">
            
            <div class="button-close">
                <a href="javascript: void(0);" onclick="closeNewsletter();" title="<?=system_showText(LANG_CLOSE);?>"></a>
            </div>
            
            <div class="box-newsletter row-fluid">
               <form>
                    <div class="span5 row-fluid">
                        <div class="span4 img-newsletter"></div>
                        <h3 class="span8"><?=$signupLabel;?></h3>
                    </div>
                    <div class="span7 row-fluid">
                        <div id="news_returnMessage" style="display:none;"></div>
                        <input type="text" id="newsname" placeholder="<?=system_showText(LANG_LABEL_NAME);?>"/>
                        <input type="text" id="newsemail" placeholder="<?=system_showText(LANG_LABEL_EMAIL);?>"/>
                        <button class="btn btn-success" type="button" onclick="subscribeNewsletter();"><?=system_showText(LANG_ARCAMAILER_SUBSCRIBE);?></button>
                    </div>
                </form>
            </div>
            
        </div>
        <!--cachemarkerNewsletter-->
    <? } ?>