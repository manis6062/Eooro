<?php

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
	# * FILE: /functions/script_funct.php
	# ----------------------------------------------------------------------------------------------------

    function script_loader(&$js_fileLoader, $pag_content, $aux_module_per_page, $id, &$aux_show_twitter) {
        
        if (!isset($js_fileLoader)) { ?>
            <script type="text/javascript">
                <!--
                DEFAULT_URL = "<?=DEFAULT_URL?>";
                ACTUAL_MODULE_FOLDER = "<?=(defined("ACTUAL_MODULE_FOLDER") ? ACTUAL_MODULE_FOLDER : "root")?>";
                THEME_FLAT_FANCYBOX = "<?=THEME_FLAT_FANCYBOX?>";
                -->
            </script>

        <?
            $css_fileLoader = "";

            $full_page_url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
            
            //If not localhost include minified javascript
            if($_SERVER['HTTP_HOST'] != "localhost"){
                    system_scriptColector("/scripts/common.min.js", false, false, false);
            } else {
                    system_scriptColector("/scripts/common.js", false, false, false);
            }
            
          
            if (THEME_USE_BOOTSTRAP && EDIR_THEME !== 'review') {
                $js_fileLoader = system_scriptColectorOnReady("$('.selectpicker .select').selectpicker();", $js_fileLoader, true);
                $toolTipjs = "loadToolTip('general');";
                $js_fileLoader = system_scriptColectorOnReady($toolTipjs, $js_fileLoader, true);
            }
            
            $scriptFunct = true;
            include(INCLUDES_DIR."/code/smartbanner.php");

            if (string_strpos($_SERVER["PHP_SELF"], "/".SOCIALNETWORK_FEATURE_NAME) !== false) {
                // remove placeholderjs for review theme
                if (EDIR_THEME !== 'review'){
                    system_scriptColector("/scripts/jquery/jquery.placeholder.min.js", false, false, false);
                    $js_fileLoader = system_scriptColectorOnReady("$('input').placeholder();", $js_fileLoader, true);
                }
                // system_scriptColector("/scripts/jquery/jquery.autocomplete.min.js", false, false, false);
                // system_scriptColector("/scripts/jquery/fancybox/v2/jquery.fancybox.pack.js", false, false, false);
                system_scriptColector("/scripts/jquery/jquery.cookie.min.js", false, false, false);

                /*
                 * LOAD JUST IN "/profile/edit.php"
                 */
                if (string_strpos($_SERVER["PHP_SELF"], "/edit.php") !== false) {
                    $js_fileLoader = system_scriptColector("/scripts/jquery/jcrop/js/jquery.Jcrop.js", $js_fileLoader);
                    $js_fileLoader = system_scriptColector("/scripts/jquery/jquery.textareaCounter.plugin.js", $js_fileLoader);
                }

                /*
                 * LOAD JUST IN "/profile/add.php"
                 */
                if (string_strpos($_SERVER["PHP_SELF"], "/add.php") !== false) {
                    $js_fileLoader = system_scriptColector("/scripts/checkusername.js", $js_fileLoader);
                }

                /*
                 * LOAD JUST IN "/profile/index.php"
                 */
                if (string_strpos($_SERVER["PHP_SELF"], "/index.php") !== false) {
                    $js_fileLoader = system_scriptColector("/scripts/contactclick.js", $js_fileLoader);
                    $js_fileLoader = system_scriptColector("/scripts/socialbookmarking.js", $js_fileLoader);
                    $js_fileLoader = system_scriptColectorOnReady($results_per_page_script, $js_fileLoader, true);
                }

                $js_fileLoader = system_scriptColectorOnReady($removeFavorites_script, $js_fileLoader, true);
                
            } else {

                if (!SLIDER_USE_CAROUSEL) {
                    $js_fileLoader = system_scriptColector("/scripts/jquery/easySlider-FadeIn.js", false, false, false);
                }

                /*
                 * GALLERY SCRIPT AND BLOG SCRIPT
                 */
                if (defined("ACTUAL_MODULE_FOLDER") && ACTUAL_MODULE_FOLDER != "") {
                    
                    if (ACTUAL_MODULE_FOLDER == BLOG_FEATURE_FOLDER) {
                        $js_fileLoader = system_scriptColector("/scripts/blog.js", false, false, false);
                    }
                    
                    if (!THEME_GALLERY_FANCYBOX) {
                    
                        if (THEME_USE_BOOTSTRAP) {
                            $js_fileLoader = system_scriptColector("/scripts/jquery/galleria/galleria-1.2.9.min.js", false, false, false);
                            system_scriptColectorCSS(THEMEFILE_RELATIVE_PATH."/".EDIR_THEME."/galleria/galleria.".EDIR_THEME.".css", false, false);
                            $js_fileLoader = system_scriptColector(THEMEFILE_RELATIVE_PATH."/".EDIR_THEME."/galleria/galleria.".EDIR_THEME.".js", false, false, false);
                        } else {
                            $js_fileLoader = system_scriptColector("/scripts/jquery/ad-gallery/jquery.ad-gallery.js", false, false, false);
                        }
                    
                    }

                    if (THEME_USE_BOOTSTRAP && EDIR_THEME !== 'review') {

                        $tipJS = "loadToolTip('detail');";

                        $js_fileLoader = system_scriptColectorOnReady($tipJS, $js_fileLoader, true);

                    }
                }

                /*
                 * LOAD IN ALL PAGES EXCEPT IN "/blog" and "/article"
                 */
                if (ACTUAL_MODULE_FOLDER != BLOG_FEATURE_FOLDER && ACTUAL_MODULE_FOLDER != ARTICLE_FEATURE_FOLDER) {
                    $js_fileLoader = system_scriptColector("/scripts/location.js", $js_fileLoader);
                }

                /*
                 * LOAD JUST IN "/listing", "/classified", "/event" and "/deal"
                 */
                if ((THEME_ADVSEARCH_HOME && (ACTUAL_MODULE_FOLDER == "" || (!defined("ACTUAL_MODULE_FOLDER") && string_strpos($_SERVER["REQUEST_URI"], "/results.php") !== false))) || ACTUAL_MODULE_FOLDER == LISTING_FEATURE_FOLDER || ACTUAL_MODULE_FOLDER == EVENT_FEATURE_FOLDER || ACTUAL_MODULE_FOLDER == CLASSIFIED_FEATURE_FOLDER || ACTUAL_MODULE_FOLDER == ARTICLE_FEATURE_FOLDER || ACTUAL_MODULE_FOLDER == PROMOTION_FEATURE_FOLDER || ACTUAL_MODULE_FOLDER == BLOG_FEATURE_FOLDER) {
                    // system_scriptColector("/scripts/advancedsearch.js", false, false, false);
                }

                /*
                 * LOAD JUST IN "/order_*"
                 */
                if ((string_strpos($_SERVER["PHP_SELF"], "/order_") !== false || ACTUAL_MODULE_FOLDER == BLOG_FEATURE_FOLDER || THEME_USE_BOOTSTRAP) && EDIR_THEME !== 'review' ) {
                    system_scriptColector("/scripts/jquery/jquery.placeholder.min.js", false, false, false);
                    $js_fileLoader = system_scriptColectorOnReady("$('input').placeholder();", $js_fileLoader, true);
                }
                
                /*
                 * LOAD JUST IN "/contactus.php" and "/enquire.php"
                 */
                if ((string_strpos($_SERVER["REQUEST_URI"], ALIAS_CONTACTUS_URL_DIVISOR.".php") !== false || string_strpos($_SERVER["REQUEST_URI"], ALIAS_LEAD_URL_DIVISOR.".php") !== false || string_strpos($_SERVER["REQUEST_URI"], ALIAS_ADVERTISE_URL_DIVISOR.".php") !== false) && THEME_CONTACTUS_FIELDS) {
                    setting_get("contact_email", $contact_email);
                    if ($contact_email) {
                        $contactArray = explode("@", $contact_email);
                        $js_fileLoader = system_scriptColectorOnReady("contactSiderbar('{$contactArray[0]}', '{$contactArray[1]}');", $js_fileLoader, true);
                    }
                }
                
                //Not sure if this is used in review theme.
                // system_scriptColector("/scripts/jquery/jquery_ui/js/jquery-ui-1.7.2.custom.min.js", false, false, false);

                if (EDIR_LANGUAGE != "en_us") {
                    system_scriptColector(language_getDatePickPath(EDIR_LANGUAGE, SELECTED_DOMAIN_ID, true), false, false, false);
                }

                // system_scriptColector("/scripts/jquery/jquery.autocomplete.min.js", false, false, false);
                // system_scriptColector("/scripts/jquery/fancybox/v2/jquery.fancybox.pack.js", false, false, false);
                if (THEME_GALLERY_FANCYBOX) {
                    system_scriptColector("/scripts/jquery/fancybox/v2/helpers/jquery.fancybox-buttons.min.js", false, false, false);
                }
                system_scriptColector("/scripts/jquery/jquery.cookie.min.js", false, false);

                /*
                 * Bottomless script Results page, detail page, recent review page and add listing page
                 */
                if ((strpos($_SERVER['REQUEST_URI'], ALIAS_LISTING_MODULE)) || strpos($_SERVER['REQUEST_URI'], "results.php") || strpos($_SERVER['REQUEST_URI'], "addsearchlisting.php")) {
                    system_scriptColectorNotDefer("/scripts/scrollviewer.min.js", false, false, false,false);
                }

                /*
                 * LOAD JUST IN "claim" and "/order_*.php"
                 */
                if (string_strpos($_SERVER["REQUEST_URI"], ALIAS_CLAIM_URL_DIVISOR."/") !== false || string_strpos($_SERVER["PHP_SELF"], "/order_") !== false) {
                    $js_fileLoader = system_scriptColector("/scripts/checkusername.js", $js_fileLoader);
                    $js_fileLoader = system_scriptColector("/scripts/advertise.js", $js_fileLoader);
                }

                /*
                 * LOAD JUST IN results, detail, reviews page, checkins page and blog home page
                 */
                if (string_strpos($_SERVER["REQUEST_URI"], "/results.php") !== false || string_strpos($_SERVER["REQUEST_URI"], ALIAS_CATEGORY_URL_DIVISOR."/") !== false || string_strpos($_SERVER["REQUEST_URI"], ALIAS_LOCATION_URL_DIVISOR."/") !== false  || string_strpos($_SERVER["REQUEST_URI"], ALIAS_CHECKIN_URL_DIVISOR."/") !== false || string_strpos($_SERVER["REQUEST_URI"], ALIAS_REVIEW_URL_DIVISOR."/") !== false || ACTUAL_MODULE_FOLDER == BLOG_FEATURE_FOLDER) {
                    $js_fileLoader = system_scriptColector("/scripts/socialbookmarking.js", $js_fileLoader);
                    $js_fileLoader = system_scriptColector("/scripts/contactclick.js", $js_fileLoader);
                    
                }

                /*
                 * GOOGLE+ SCRIPT
                 */
                 if (defined("ACTUAL_MODULE_FOLDER") && ACTUAL_MODULE_FOLDER != ""){                     
                    unset($aux_googleplus_script);
                    $aux_googleplus_script = share_getGoogleButton("", "", true, "language");
                    if ($aux_googleplus_script) {
                        // system_scriptColector("https://apis.google.com/js/plusone.js", false, $aux_googleplus_script, false, true);
                    }
                }
            }

            /*
             * Script to languages flags, ajax content on front and fancybox
             */
            // $aux_script = ' $(document).ready(function() { ';
            $aus_script = '';

                                if (THEME_FLAT_FANCYBOX) {
            $aux_script .= '              
                                $("a.fancy_window_iframe").fancybox({
                                    type                : \'iframe\',
                                    maxWidth            : 500,
                                    maxHeight           : 351,
                                    padding             : 0,
                                    margin              : 0,
                                    closeBtn            : false
                                });
                                
                                $("a.fancy_window_preview").fancybox({
                                    type                : \'iframe\',
                                    maxHeight           : '.FANCYBOX_FRONT_PREVIEW_HEIGHT.',
                                    width               : '.FANCYBOX_FRONT_PREVIEW_WIDTH.',
                                    padding             : 0,
                                    margin              : 0,
                                    closeBtn            : false
                                });
                                
                                $("a.fancy_window_preview_banner").fancybox({
                                    closeBtn            : false
                                });

                                //The following API calls are needed to work with the fancybox 1.3.4 (members area)
                                $("a.fancy_window_tofriend").fancybox({
                                    type                : \'iframe\',
                                    maxWidth            : '.FANCYBOX_TOFRIEND_WIDTH.',
                                    maxHeight           : '.FANCYBOX_TOFRIEND_HEIGHT.',
                                    padding             : 0,
                                    margin              : 0,
                                    closeBtn            : false
                                });

                                $("a.fancy_window_twilio").fancybox({
                                    type                : \'iframe\',
                                    maxWidth            : '.FANCYBOX_TWILIO_WIDTH.',
                                    maxHeight           : '.FANCYBOX_TWILIO_HEIGHT.',
                                    padding             : 0,
                                    margin              : 0,
                                    closeBtn            : false
                                });

                                $("a.fancy_window_review").fancybox({
                                    type                : \'iframe\',
                                    maxWidth            : '.FANCYBOX_REVIEW_WIDTH.',
                                    maxHeight           : 538,
                                    padding             : 0,
                                    margin              : 0,
                                    closeBtn            : false
                                });

                                $("a.fancy_inside").fancybox({
                                    type                : \'iframe\',
                                    maxWidth            : '.FANCYBOX_REVIEW_WIDTH.',
                                    maxHeight           : 600,
                                    padding             : 0,
                                    margin              : 0,
                                    closeBtn            : true
                                });

';

                                } else {
            $aux_script .= '
                                $("a.fancy_window_iframe").fancybox({
                                    type                : \'iframe\',
                                    maxWidth            : 600
                                });
                                
                                $("a.fancy_window_preview").fancybox({
                                    type                : \'iframe\',
                                    width               : '.FANCYBOX_FRONT_PREVIEW_WIDTH.',
                                    maxHeight           : '.FANCYBOX_FRONT_PREVIEW_HEIGHT.',
                                    padding             : 0,
                                    margin              : 0
                                });
                                
                                $("a.fancy_window_preview_banner").fancybox({
                                    
                                });
                                
                                //The following API calls are needed to work with the fancybox 1.3.4 (members area)
                                $("a.fancy_window_tofriend").fancybox({
                                    type                : \'iframe\',
                                    maxWidth            : '.FANCYBOX_TOFRIEND_WIDTH.',
                                    maxHeight           : '.FANCYBOX_TOFRIEND_HEIGHT.'
                                });

                                $("a.fancy_window_twilio").fancybox({
                                    type                : \'iframe\',
                                    maxWidth            : '.FANCYBOX_TWILIO_WIDTH.',
                                    maxHeight           : '.FANCYBOX_TWILIO_HEIGHT.'
                                });

                                $("a.fancy_window_review").fancybox({
                                    type                : \'iframe\',
                                    maxWidth            : '.FANCYBOX_REVIEW_WIDTH.',
                                    maxHeight           : '.FANCYBOX_REVIEW_HEIGHT.'
                                });';

                                }
//            $aux_script .= '
//                            });
//                        ';
        
            $js_fileLoader = system_scriptColectorOnReady($aux_script, $js_fileLoader, true);

            if (((LOAD_MODULE_CSS_HOME == "on") || (ACTUAL_MODULE_FOLDER == "") || (THEME_BLOGARCHIVE_ACCORDION && ACTUAL_MODULE_FOLDER == BLOG_FEATURE_FOLDER)) && string_strpos($_SERVER["REQUEST_URI"], ALIAS_BESTOF_URL_DIVISOR) === false) {
                
                /*
                 * Script to accordion and index sidebar
                 */

                $js_fileLoader = system_scriptColector("/scripts/jquery/jquery.accordion.js",$js_fileLoader);

                if (THEME_BLOGARCHIVE_ACCORDION && ACTUAL_MODULE_FOLDER == BLOG_FEATURE_FOLDER) {
                    $sidebar_script = "$(document).ready(function(){
                                            $('ul#accordion').accordion();
                                            $('.current').show(); 
                                        });";  
                    
                    
                    /**
                    * Script to results per page
                    */
                    $aux_request_uri = $_SERVER["REQUEST_URI"];
                    if (string_strpos($aux_request_uri, "page/".$_GET["page"]) !== false && $_GET["page"] && $_GET["url_full"]) {
                        $aux_request_uri = str_replace("page/".$_GET["page"], "page/1", $aux_request_uri);
                    } elseif(string_strpos($aux_request_uri, "screen=".$_GET["screen"]) !== false && $_GET["screen"]) {
                        $aux_request_uri = str_replace("screen=".$_GET["screen"], "screen=1", $aux_request_uri);
                    }

                    $results_per_page_script = "$('#results_per_page').removeAttr('disabled');
                                                $('#results_per_page').change(function(){
                                                    $.cookie('".$aux_module_per_page."_results_per_page', $('#results_per_page').val(), {path: '".EDIRECTORY_FOLDER."/'}); 
                                                    $(location).attr('href','".$aux_request_uri."');
                                                });";

                    $js_fileLoader = system_scriptColectorOnReady($results_per_page_script, $js_fileLoader, true);
                    
                } else {
                    $sidebar_script = "$(document).ready(function(){
                        
                                            if ($('#sidebar_ajax').length) {
                                            
                                                $.get(DEFAULT_URL + \"/includes/code/frontajax.php\", {
                                                    type: 'sidebar_index'
                                                }, function (ret) {
                                                    $(\"#sidebar_ajax\").html(ret);
                                                    $('ul#accordion').accordion();
                                                    $('.current').show();
                                                }); 
                                                
                                            } else if ($('#accordion').length) {
                                                $('ul#accordion').accordion();
                                                $('.current').show();
                                            }
                                            
                                        });";                   
                }
                
                $js_fileLoader = system_scriptColectorOnReady($sidebar_script, $js_fileLoader, true);
                
            } elseif (string_strpos($_SERVER["REQUEST_URI"], "results.php") || string_strpos($_SERVER["REQUEST_URI"], ALIAS_CATEGORY_URL_DIVISOR."/") !== false || string_strpos($_SERVER["REQUEST_URI"], ALIAS_LOCATION_URL_DIVISOR."/") !== false || string_strpos($_SERVER["REQUEST_URI"], ALIAS_ARCHIVE_URL_DIVISOR."/") !== false || string_strpos($_SERVER["REQUEST_URI"], ALIAS_REVIEW_URL_DIVISOR."/") || string_strpos($_SERVER["REQUEST_URI"], ALIAS_CHECKIN_URL_DIVISOR."/") || string_strpos($_SERVER["REQUEST_URI"], ALIAS_BESTOF_URL_DIVISOR)  || (string_strpos($_SERVER["REQUEST_URI"], ALIAS_LISTING_ALLCATEGORIES_URL_DIVISOR) && THEME_SEARCH_CATEGORY_PAGE)) {

                if ((string_strpos($_SERVER["REQUEST_URI"], "results.php") || string_strpos($_SERVER["REQUEST_URI"], ALIAS_CATEGORY_URL_DIVISOR."/") !== false || string_strpos($_SERVER["REQUEST_URI"], ALIAS_LOCATION_URL_DIVISOR."/") !== false)) {
                    /*
                     * Script to accordion 
                     */

                    $js_fileLoader = system_scriptColector("/scripts/jquery/jquery.accordion.js",$js_fileLoader);

                    $sidebar_script = "$(document).ready(function(){
                                            $('ul#accordion').accordion();
                                            $('.current').show(); 
                                        });";

                    $js_fileLoader = system_scriptColectorOnReady($sidebar_script, $js_fileLoader, true);
                }

                /**
                 * Script to results per page
                 */
                $aux_request_uri = $_SERVER["REQUEST_URI"];
                if (string_strpos($aux_request_uri, "page/".$_GET["page"]) !== false && $_GET["page"] && $_GET["url_full"]) {
                    $aux_request_uri = str_replace("page/".$_GET["page"], "page/1", $aux_request_uri);
                } elseif(string_strpos($aux_request_uri, "screen=".$_GET["screen"]) !== false && $_GET["screen"]) {
                    $aux_request_uri = str_replace("screen=".$_GET["screen"], "screen=1", $aux_request_uri);
                }

                $results_per_page_script = "$('#results_per_page').removeAttr('disabled');
                                            $('#results_per_page').change(function(){
                                                $.cookie('".$aux_module_per_page."_results_per_page', $('#results_per_page').val(), {path: '".EDIRECTORY_FOLDER."/'}); 
                                                $(location).attr('href','".$aux_request_uri."');
                                            });";

                $js_fileLoader = system_scriptColectorOnReady($results_per_page_script, $js_fileLoader, true);
                
                //Results filter
                if ((
                        (defined("ACTUAL_MODULE_FOLDER") && string_strlen(ACTUAL_MODULE_FOLDER) > 0) || 
                        (!defined("ACTUAL_MODULE_FOLDER") && string_strpos($_SERVER["REQUEST_URI"], "results.php") !== false)
                    ) && THEME_USE_BOOTSTRAP) {
                    
                    // system_scriptColector("/scripts/filter.js", false, false, false);
                    
                    $strOpen = system_loadFiltersStr((defined("ACTUAL_MODULE_FOLDER") ? ACTUAL_MODULE_FOLDER : LISTING_FEATURE_FOLDER));
                    
                    if ($strOpen) {
                        $js_fileLoader = system_scriptColectorOnReady($strOpen, $js_fileLoader, true);
                    }
                    
                }

            }

            /*
             * Scripts to Last twetts on footer
             */
            setting_get("twitter_account", $tw_account);
            setting_get("foreignaccount_twitter_apikey", $tw_apikey);
            setting_get("foreignaccount_twitter_apisecret", $tw_apisecret);
            setting_get("foreignaccount_twitter_oauthtoken", $tw_oauth_token);
            setting_get("foreignaccount_twitter_oauthsecret", $tw_oauth_secret);

            if ($tw_account && $tw_apikey && $tw_apisecret && $tw_oauth_token && $tw_oauth_secret) {
                $last_twitts_script = "$('#twitter_update_list_footer').fadeIn(100,function(){ $('#twitter_update_list_footer').load('".DEFAULT_URL."/twitter_updates.php') }) ; ";
                $js_fileLoader = system_scriptColectorOnReady($last_twitts_script, $js_fileLoader, true);
            }

            if (string_strpos($_SERVER["PHP_SELF"], SOCIALNETWORK_FEATURE_NAME."/index.php") == true || string_strpos($_SERVER["PHP_SELF"], SOCIALNETWORK_FEATURE_NAME."/edit.php") == true) {

                $profileObj = new Profile($id);
                if ($tw_apikey && $tw_apisecret && strlen($profileObj->getString("twitter_account")) && $profileObj->getString("tw_oauth_token") && $profileObj->getString("tw_oauth_token_secret")) {
                    $aux_show_twitter = true;
                    $last_twitts_script = "$('#twitter_update_list_profile').fadeIn(100,function(){ $('#twitter_update_list_profile').load('".DEFAULT_URL."/twitter_updates.php?user_id=".$id."') }) ;";
                    $js_fileLoader = system_scriptColectorOnReady($last_twitts_script, $js_fileLoader, true);
                }
            }

        } else if (isset($js_fileLoader) && is_array($js_fileLoader)) {
            define("SCRIPTCOLLECTOR_DEBUG", "off");
            system_renderJavascripts($js_fileLoader);
        }
    }
?>