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
	# * FILE: /theme/contractors/frontend/socialbar.php
	# ----------------------------------------------------------------------------------------------------

    setting_get("twitter_account", $setting_twitter_link);
    setting_get("setting_facebook_link", $setting_facebook_link);
    setting_get("setting_linkedin_link", $setting_linkedin_link);
    setting_get("front_itunes_url", $front_itunes_url);
    setting_get("front_gplay_url", $front_gplay_url);
    
    if ($setting_twitter_link || $setting_facebook_link || $setting_linkedin_link || $front_itunes_url || $front_gplay_url) { ?>

    <div class="footer socialbar">
        
        <div class="container">
            
            <div class="row-fluid">
                
                <? if ($front_itunes_url || $front_gplay_url) { ?>
                
                    <b class="btn-social btn-download"></b>
                    
                    <p><?=system_showText(LANG_LABEL_DOWNLOAD_APP);?></p>
                    
                    <? if ($front_itunes_url) { ?>
                    
                    <a rel="nofollow" href="<?=$front_itunes_url?>">iOS</a>
                    
                    <? } ?>
                
                    <?=($front_itunes_url && $front_gplay_url ? " | " : "");?>
                    
                    <? if ($front_gplay_url) { ?>
                    
                    <a rel="nofollow" href="<?=$front_gplay_url?>">Android</a>
                    
                    <? } ?>
                    
                <? } else { ?>
                    
                    <p>&nbsp;</p>
                    
                <? } ?>
                
                <span class="pull-right hidden-phone">
                    <? if ($setting_linkedin_link) { ?>
                    <a class="btn-social btn-linkedin" target="_blank" rel="nofollow" href="<?=$setting_linkedin_link?>"></a>
                    <? } ?>
                    <? if ($setting_twitter_link) { ?>
                    <a class="btn-social btn-twitter" target="_blank" rel="nofollow" href="http://www.twitter.com/<?=$setting_twitter_link?>"></a>
                    <? } ?>
                    <? if ($setting_facebook_link) { ?>
                    <a class="btn-social btn-facebook" target="_blank" rel="nofollow" href="<?=$setting_facebook_link?>"></a>
                    <? } ?>
                </span>
                    
            </div>

            <div class="text-center visible-phone">
                <? if ($setting_linkedin_link) { ?>
                <a class="btn-social btn-linkedin" target="_blank" rel="nofollow" href="<?=$setting_linkedin_link?>"></a>
                <? } ?>
                <? if ($setting_twitter_link) { ?>
                <a class="btn-social btn-twitter" target="_blank" rel="nofollow" href="http://www.twitter.com/<?=$setting_twitter_link?>"></a>
                <? } ?>
                <? if ($setting_facebook_link) { ?>
                <a class="btn-social btn-facebook" target="_blank" rel="nofollow" href="<?=$setting_facebook_link?>"></a>
                <? } ?>
            </div>
            
        </div>

    </div>

    <? } ?>