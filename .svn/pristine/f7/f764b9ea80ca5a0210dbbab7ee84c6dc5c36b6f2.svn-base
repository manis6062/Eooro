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
    # * FILE: /theme/default/layout/footer.php
    # ----------------------------------------------------------------------------------------------------

    include(INCLUDES_DIR."/code/contactus.php");
    
    setting_get("twitter_widget", $twitter_widget);
    
    /**
     * modification
     */
    $showFlags = true;
    $advertise = false;
    $tnc       = true;
?>
        <? if (
                string_strpos($_SERVER["PHP_SELF"], "/order_") === false && 
                string_strpos($_SERVER["REQUEST_URI"], ALIAS_ADVERTISE_URL_DIVISOR.".php") === false && 
                string_strpos($_SERVER["PHP_SELF"], "/maintenancepage.php") === false &&
                ACTUAL_PAGE_NAME != "errorpage.php"
            ) { ?>
               
		<div class="container">
			<? include(system_getFrontendPath("banner_bottom.php")); ?>
		</div>
        
        <? } ?>
       <div class="footer-atbottom"></div>
       <footer id="footer-at-bottom">
            <div class="container">
                <div class="row">
                    <!--<div class="col-sm-2">
                        <h5>Features</h5>
                        <ul class="features">
                           <? if (EVENT_FEATURE == "on" && CUSTOM_EVENT_FEATURE == "on") { ?>
                            <li>
                                <a href="<?=EVENT_DEFAULT_URL?>/">
                                    <?=system_showText(LANG_MENU_EVENT);?>
                                </a>
                            </li>
                            <? } ?>
                            <? if (CLASSIFIED_FEATURE == "on" && CUSTOM_CLASSIFIED_FEATURE == "on") { ?>
                            <li>
                                <a href="<?=CLASSIFIED_DEFAULT_URL?>/">
                                    <?=system_showText(LANG_MENU_CLASSIFIED);?>
                                </a>
                            </li>
                            <? } ?>
                            <li>
                                <a href="<?=NON_SECURE_URL?>">
                                    <?=system_showText(LANG_MENU_HOME);?>
                                </a>
                            </li>
                            <? include(system_getFrontendPath("footer_menu.php", "layout")); ?>
                            <?php if( $advertise ): ?>
                            <li>
                                <a href="<?=NON_SECURE_URL?>/<?=ALIAS_ADVERTISE_URL_DIVISOR?>.php">
                                    <?=system_showText(LANG_MENU_ADVERTISE);?>
                                </a>
                            </li>
                            <?php endif; ?>
                            <li>
                                <a href="<?=NON_SECURE_URL?>/<?=ALIAS_SITEMAP_URL_DIVISOR?>.php">
                                    <?=system_showText(LANG_MENU_SITEMAP);?>
                                </a>
                            </li>

                            <li>
                                <a href="<?=NON_SECURE_URL?>/<?=ALIAS_CONTACTUS_URL_DIVISOR?>.php">
                                    <?=system_showText(LANG_MENU_CONTACT);?>
                                </a>
                            </li>
                            
                        </ul>
                    </div>
 
                     <div class="col-sm-2 site-content">
                        <h5>Site Content</h5>
                        <ul class="features">
                            <li>
                                <a href="<?=NON_SECURE_URL?>/<?=ALIAS_FAQ_URL_DIVISOR?>.php">
                                    <?=system_showText(LANG_MENU_FAQ);?>
                                </a>
                            </li>
                            <li>  <a href="<?=NON_SECURE_URL?>/privacypolicy.php">Privacy Policy</a></li>
                            <li>  <a href="<?=NON_SECURE_URL?>/termsofuse.php">Terms of Use</a></li>
                        </ul>
                    </div> 
                     <div class="col-sm-4">
                        <h5>Locations</h5>
                        <ul class="features">
                         <? if (CLASSIFIED_FEATURE == "on" && CUSTOM_CLASSIFIED_FEATURE == "on") { ?>
                            <li>
                                <a href="<?=LISTING_DEFAULT_URL?>/">
                                    <?=system_showText(LANG_MENU_LISTING);?>
               
                                </a>
                            </li>
                        <? } ?>
                            <? if (PROMOTION_FEATURE == "on" && CUSTOM_HAS_PROMOTION == "on" && CUSTOM_PROMOTION_FEATURE == "on") { ?>
                                <li>
                                    <a href="<?=PROMOTION_DEFAULT_URL?>/">
                                        <?=system_showText(LANG_MENU_PROMOTION);?>
                                    </a>
                                </li>
                            <? } ?>
                            <? if (CLASSIFIED_FEATURE == "on" && CUSTOM_CLASSIFIED_FEATURE == "on") { ?>
                                <li>
                                    <a href="<?=CLASSIFIED_DEFAULT_URL?>/">
                                        <?=system_showText(LANG_MENU_CLASSIFIED);?>
                                    </a>
                                </li>
                            <? } ?>
                            <li>
                                <a class="view-more" href="<?=LISTING_DEFAULT_URL."/"."locations"?>">
                                    View Locations
                                </a>
                            </li>
                            <li>
                                <?   if ( $showFlags ):
                                    include(system_getFrontendPath("flags.php"));
                    
                                endif; ?>
                            </li>
                            <li>
                            </li>
                            
                        </ul>
                        <div class="social-wrappper">
                        </div>
                       
                    </div> -->
                    <div class="col-sm-12 col-md-9 col-lg-8">
                        <ul class="footerMenu">
                            <li><a rel="canonical" href="<?=NON_SECURE_URL?>">Home</a>
                            <?php if( $advertise ){ ?>
                            <li><a rel="canonical" href="<?=NON_SECURE_URL?>/<?=ALIAS_ADVERTISE_URL_DIVISOR?>.php">Reviews</a>
                            <?php } ?>
                            <li><a rel="canonical" href="<?=LISTING_DEFAULT_URL?>/">Reviews</a>
                            <li><a rel="canonical" href="<?=NON_SECURE_URL?>/<?=ALIAS_SITEMAP_URL_DIVISOR?>.php">Sitemap</a>
                            <li><a rel="canonical" href="<?=NON_SECURE_URL?>/<?=ALIAS_CONTACTUS_URL_DIVISOR?>.php">Contact Us</a>
                            <li><a rel="canonical" href="<?=LISTING_DEFAULT_URL."/"."locations"?>">
                                View Locations
                                </a>
                            <li><a rel="canonical" href="<?=NON_SECURE_URL?>/<?=ALIAS_FAQ_URL_DIVISOR?>.php">FAQ</a>
                            <li><a rel="canonical" href="<?=NON_SECURE_URL?>/privacypolicy.php">Privacy Policy</a>
                            <li><a rel="canonical" href="<?=NON_SECURE_URL?>/termsofuse.php">Terms of Use</a>
                            
                        </ul>
                        
                    </div>
                           <div class="col-sm-12 col-md-3 col-lg-4 connect-with-eooro">
           <!--              <h5>Connect with Eooro.com</h5> -->
                        <ul class="social footerSocial pull-right">
                            <? if ($setting_facebook_link) { ?>
                            <li>
                                <a href="<?=$setting_facebook_link?>"  
                                   target="_blank" 
                                   title="<?=system_showText(LANG_ALT_FACEBOOK)?>" 
                                   class="fbblue">
                                    <i class="fa fa-facebook"></i>
                                </a>
                                
                            </li>
                            <? } ?>
                            <? if ($setting_twitter_link) { ?>
                            <li>
                            <a href="<?=$setting_twitter_link?>"  
                                   target="_blank" 
                                   title="<?=system_showText(LANG_FOLLOW_US_TWITTER)?>" 
                                   class="twitterblue">
                                    <i class="fa fa-twitter"></i>
                            </a>
                            </li>
                            <? } ?>
                            <? if ($setting_google_link) { ?>
                            <li>
                                <a href="<?=$setting_google_link?>"
                                   target="_blank" 
                                   title="Google+" 
                                   class="darkorange">
                                    <i class="fa fa-google-plus"></i>
                                </a>
                            </li>
                            <? } ?>
                        </ul>
                        
                    </div>
                </div>
<!--             <div class="row">
                 <div class="col-sm-12">
                     <p>
                         <? front_getCopyright($footer, true); ?> 
                         
                         <?
                            $footer = str_replace("©" , "999999999999999" , $footer);
                            $footer = strrev($footer);
                            $footer = str_replace(">/ rb<", "<br>", $footer);
                            $footer = str_replace(";ypoc&", "&copy;", $footer);
                            $footer = str_replace(")c(", "(c)", $footer);
                            $footer = str_replace("(", ")", $footer);
                            $footer = str_replace(")d", "(d", $footer);
                            echo str_replace("999999999999999", "©", $footer);
                         ?>
                     </p>
                    </div>
                </div> -->
            </div>
        </footer>
        
        <!-- Search statistic report - DO NOT REMOVE THIS CODE  -->
        <?=front_statisticReport($banner_section);?>

        <!-- Google maps for results page - DO NOT REMOVE THIS CODE  -->
        <?=front_googleMaps($itemRSSSection, $listings, $classifieds, $events, $promotions, $levelObj);?>

        <!-- Google analytics code - DO NOT REMOVE THIS CODE  -->
        <?=front_googleAnalytics();?>

        <!-- Include all js and css files (minimized) - DO NOT REMOVE THIS CODE  -->
        <? script_loader($js_fileLoader, $pag_content, $aux_module_per_page, $id, $aux_show_twitter); ?>
       
    </body>
</html>
