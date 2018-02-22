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
	# * FILE: /theme/default/frontend/newsletter.php
	# ----------------------------------------------------------------------------------------------------   
    
?>
	   
    <div id="boxNewsletter" class="newsletter">

        <div class="box-newsletter row-fluid text-center">
            
            <? if (!$showSlider) { ?>
        
            <div class="button-close">
                <a href="javascript: void(0);" onclick="closeNewsletter();" title="<?=system_showText(LANG_CLOSE);?>"></a>
            </div>

            <? } ?>
            
            <form>
                <div class="news-custom">
                    <h3><?=$signupLabel;?></h3>
                    <p><?=system_showText(LANG_ARCAMAILER_SUBSCRIBE_TIP);?></p>
                </div>
                <div id="news_returnMessage" style="display:none;"></div>
                <input class="span11" type="text" id="newsname" placeholder="<?=system_showText(LANG_LABEL_NAME);?>..."/>
                <input class="span11" type="email" id="newsemail" placeholder="<?=system_showText(LANG_LABEL_EMAIL);?>..."/>
                <button class="btn btn-success btn-large" type="button" onclick="subscribeNewsletter();"><?=system_showText(LANG_BUTTON_SIGNUP);?></button>
            </form>

            <? if ($setting_facebook_link && $showSlider) { ?>

                <hr>

                <a class="btn btn-facebook btn-large" href="<?=$setting_facebook_link?>" target="_blank"><b><?=system_showText(LANG_LIKE_FACEBOOK);?></b></a>

            <? } ?>
        </div>

    </div>