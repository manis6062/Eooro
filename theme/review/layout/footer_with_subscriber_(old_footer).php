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

                <!--</div><!-- Close container-fluid div -->
        <!--</div><!-- Close container div -->

        <!-- //Don't show banners for advertise pages, maintenance page and error page -->
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

       <footer>
            <div class="container">
                <div class="row">
                    <div class="col-sm-2">
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
                            <?php if( $tnc ) : ?>
                            <li>
                                <?=preg_replace( '#([^\]]+])([\w\s]+)(\[\/a\]\.)#', 
                                        '<a rel="nofollow" href="'.DEFAULT_URL.'/popup/popup.php?pop_type=terms" class="fancy_window_iframe">${2}</a>',
                                        system_showText(LANG_ACCEPT_TERMS));?>
                            </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                    <div class="col-sm-3">
                        <h5>About</h5>
                        <ul class="features">
                            <?php if( $advertise ): ?>
                            <li>
                                <a href="<?=NON_SECURE_URL?>/<?=ALIAS_ADVERTISE_URL_DIVISOR?>.php">
                                    <?=system_showText(LANG_MENU_ADVERTISE);?>
                                </a>
                            </li>
                            <?php endif; ?>
                            <li>
                                <a href="<?=NON_SECURE_URL?>/<?=ALIAS_FAQ_URL_DIVISOR?>.php">
                                    <?=system_showText(LANG_MENU_FAQ);?>
                                </a>
                            </li>

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
                    <div class="col-sm-3">
                        <h5>Locations</h5>
                        <ul class="features">
                         <? if (CLASSIFIED_FEATURE == "on" && CUSTOM_CLASSIFIED_FEATURE == "on") { ?>
                            <li>
                                <a rel="canonical" href="<?=LISTING_DEFAULT_URL?>/">
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
                           <? if (BLOG_FEATURE == "on" && CUSTOM_BLOG_FEATURE == "on") { ?>
                                <li>
                                    <a href="<?=BLOG_DEFAULT_URL?>/">
                                        <?=system_showText(LANG_MENU_BLOG);?>
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
                                <a rel="canonical" class="view-more" href="<?=LISTING_DEFAULT_URL."/".ALIAS_ALLLOCATIONS_URL_DIVISOR.".php"?>">
                                    View Locations
                                </a>
                            </li>
                            <li>
                                <?   if ( $showFlags ):
                                    include(system_getFrontendPath("flags.php"));
                    
                                endif; ?>
                            </li>
                            <li>
                            <div class = "hidden">
                                <? include( system_getFrontendPath('state_dropdown.php') ); ?>
                            </div>
                            </li>
                            
                        </ul>  
                    </div>
                    <div class="col-sm-4 textright">
                        <ul class="social">
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
                            <? if ($setting_linkedin_link) { ?>
                            <li>
                                <a href="<?=$setting_linkedin_link?>"  
                                   target="_blank" 
                                   title="<?=system_showText(LANG_ALT_LINKEDIN)?>" 
                                   class="darkblue">
                                    <i class="fa fa-linkedin"></i>
                                </a>
                            </li>
                            <? } ?>
<!--                            <li>
                                <a href="#" class="orange">
                                    <i class="fa fa-rss"></i>
                                </a>
                            </li>-->
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
                        <h5>Sign up for our newsletter</h5>
                        <p>Free and useful online marketing <br>and customer service tips:</p>
                        <form id="subscribe" method="post" action="<?=DEFAULT_URL.'/add_subscriber.php'?>" role="form">
                            <div class="form-group">
                                <input type="email" class="form-control cuscontrol" id="email" name="email">
                                <button id="subscribe-me" type="submit" class="btn btn-default btn-lg fbtn">SUBSCRIBE</button>
                            </div>
                            <p id="subscribe-message"></p>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <!-- Copyright info  -->
                        <? front_getCopyright($footer, true); ?> 
                        <p><?=$footer?></p>
                    </div>
                </div>
            </div>
        </footer>
        <script>
        (function($){
            $( '#subscribe-me' ).click( function(event){
                event.preventDefault();
                var email = $('#email').val();
                
                if ( email === '' ) {
                    $( '#subscribe-message' ).text('Enter an email address .')
                            .css( 'color', 'red' );
                }
                else {
                    $.ajax({
                        url:'<?=DEFAULT_URL.'/add_subscriber.php'?>',
                        type : 'POST', 
                        data: {
                            email : email
                        },
                        
                        success: function (response, textStatus){
                            if( response === 'true' ){
                                $( '#subscribe-message' ).text('You have been subscribed for our newsletter')
                                        .css( 'color', 'green' );
                            }
                            else if( response === 'invalid' ){
                                $( '#subscribe-message' ).text( 'Your email is invalid' )
                                        .css( 'color', 'red' );
                            }
                        },
                        error: function(){
                            $( '#subscribe-message' ).text('Sorry, your request could not be processed at the moment')
                            .css( 'color', 'red' );
                        }
                    });
                }
            });
        })(jQuery);
            
        </script>
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