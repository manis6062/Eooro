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
    # * FILE: /theme/diningguide/layout/footer.php
    # ----------------------------------------------------------------------------------------------------

    include(INCLUDES_DIR."/code/contactus.php");
?>

                </div><!-- Close container-fluid div -->
        </div><!-- Close container div -->

        <!-- Don't show banners for advertise pages and maintenance page -->
        <? if (string_strpos($_SERVER["PHP_SELF"], "/order_") === false && string_strpos($_SERVER["REQUEST_URI"], ALIAS_ADVERTISE_URL_DIVISOR.".php") === false && string_strpos($_SERVER["PHP_SELF"], "/maintenancepage.php") === false) { ?>
        
		<div class="container">
			<? include(system_getFrontendPath("banner_bottom.php")); ?>
		</div>
        
        <? } ?>

        <div id="footer-wrapper">

            <div class="container">
                
                <div class="row-fluid">
                    
                    <? if ($twitterAccount && !$twitter_widget) { ?>
                    <div class="span3 last-tweets">
                        <h4><?=system_showText(LANG_TWITTER_UPDATES);?></h4>
                        <?=$timeLine;?>
                    </div>
                    <? } ?>
                    
                    <div class="span3 contact">
                        <h4><?=system_showText(LANG_MENU_CONTACT);?></h4>
                        <address>
                            <?=$contactInfoStr;?>
                            <a href="<?=NON_SECURE_URL?>/<?=ALIAS_CONTACTUS_URL_DIVISOR?>.php"><?=system_showText(LANG_CONTACT_SENDMSG);?></a>
                        </address>
                    </div>
                    
                    <div class="span6 pull-right text-right">
                        <!-- The code below controls the social network links of the footer navigation. -->
                        <? if ($setting_twitter_link || $setting_facebook_link || $setting_linkedin_link) { ?>
                        <div class="social-buttons">

                            <? if ($setting_twitter_link) { ?>
                                <a href="http://www.twitter.com/<?=$setting_twitter_link?>" target="_blank" title="<?=system_showText(LANG_FOLLOW_US_TWITTER)?>">
                                    <img src="<?=DEFAULT_URL?>/theme/<?=EDIR_THEME?>/images/iconography/social-twitter.png" alt="" />
                                </a>
                            <? } ?>

                            <? if ($setting_facebook_link) { ?>
                                <a href="<?=$setting_facebook_link?>" target="_blank" title="<?=system_showText(LANG_ALT_FACEBOOK)?>">
                                    <img src="<?=DEFAULT_URL?>/theme/<?=EDIR_THEME?>/images/iconography/social-facebook.png" alt="" />
                                </a>
                            <? } ?>

                            <? if ($setting_linkedin_link) { ?>
                                <a href="<?=$setting_linkedin_link?>" target="_blank" title="<?=system_showText(LANG_ALT_LINKEDIN)?>">
                                    <img src="<?=DEFAULT_URL?>/theme/<?=EDIR_THEME?>/images/iconography/social-linkedin.png" alt="" />
                                </a>
                            <? } ?>

                        </div>
                        <? } ?>
                        
                        <!-- The code below controls the Copyright info  -->
                        <? front_getCopyright($footer); ?>

                        <p class="copyright">
                            <?=$footer?>
                        </p>
                        
                    </div>
                    
                </div>
                
                <div class="span12">
                    
                    <ul class="footer-nav text-center">
                        <? include(system_getFrontendPath("footer_menu.php", "layout")); ?>
                    </ul>
                    
                </div>
                
            </div>

        </div>

        <!-- Search statistic report - DO NOT REMOVE THIS CODE  -->
        <?=front_statisticReport($banner_section);?>

        <!-- Google maps for results page - DO NOT REMOVE THIS CODE  -->
        <?=front_googleMaps($itemRSSSection, $listings, $classifieds, $events, $promotions, $levelObj);?>

        <!-- Google analytics code - DO NOT REMOVE THIS CODE  -->
        <?=front_googleAnalytics();?>

        <!-- Include all js and css files (minimized) - DO NOT REMOVE THIS CODE  -->
        <? script_loader($js_fileLoader, $pag_content, $aux_module_per_page, $id, $aux_show_twitter); ?>
        
        <!-- Pinterest Button - DO NOT REMOVE THIS CODE  -->
        <?=front_pinterestButton();?>
    </body>
</html>