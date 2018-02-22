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
	# * FILE: /searchfront.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	require(EDIRECTORY_ROOT."/frontend/checkregbin.php");

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	$action =  (!THEME_GENERAL_RESULTS ? LISTING_DEFAULT_URL : NON_SECURE_URL)."/results.php";
	$searchByKeywordTip = system_showText(LANG_LABEL_SEARCHKEYWORDTIP);
	$autocomplete_keyword_url = AUTOCOMPLETE_KEYWORD_URL.'?module=listing';
	$hasAdvancedSearch = false;
	$hasWhereSearch = true;
    $hasPriceSearch = false;
    $hasRatingSearch = false;
    setting_get("commenting_edir", $commenting_edir);

    if (THEME_ADVSEARCH_HOME && (ACTUAL_MODULE_FOLDER == "" || (!defined("ACTUAL_MODULE_FOLDER") && string_strpos($_SERVER["REQUEST_URI"], "/results.php") !== false))) {
        
        $action_adv = LISTING_DEFAULT_URL."/results.php" ;
        $moduleURL = LISTING_DEFAULT_URL;
		$hasAdvancedSearch = true;
		$advancedSearchItem = "listing";
		$advancedSearchPath = EDIRECTORY_FOLDER.str_replace(NON_SECURE_URL, "", LISTING_DEFAULT_URL);
        setting_get("review_listing_enabled", $review_enabled);
        
    } elseif (ACTUAL_MODULE_FOLDER == LISTING_FEATURE_FOLDER) {
        
		$searchByKeywordTip = system_showText(LANG_LABEL_SEARCHKEYWORDTIP_LISTING);
		$autocomplete_keyword_url = AUTOCOMPLETE_KEYWORD_URL.'?module=listing';
        $action = LISTING_DEFAULT_URL."/results.php";
		$action_adv = LISTING_DEFAULT_URL."/results.php" ;
        $moduleURL = LISTING_DEFAULT_URL;
		$hasAdvancedSearch = true;
		$advancedSearchItem = "listing";
		$advancedSearchPath = EDIRECTORY_FOLDER.str_replace(NON_SECURE_URL, "", LISTING_DEFAULT_URL);
        setting_get("review_listing_enabled", $review_enabled);

	} elseif (ACTUAL_MODULE_FOLDER == PROMOTION_FEATURE_FOLDER) {
        
		$searchByKeywordTip = system_showText(LANG_LABEL_SEARCHKEYWORDTIP_PROMOTION);
		$autocomplete_keyword_url = AUTOCOMPLETE_KEYWORD_URL.'?module=promotion';
        $action = PROMOTION_DEFAULT_URL."/results.php" ;
		$action_adv = PROMOTION_DEFAULT_URL."/results.php" ;
        $moduleURL = PROMOTION_DEFAULT_URL;
		$hasAdvancedSearch = true;
		$advancedSearchItem = "promotion";
		$advancedSearchPath = EDIRECTORY_FOLDER.str_replace(NON_SECURE_URL, "", PROMOTION_DEFAULT_URL);
        setting_get("review_promotion_enabled", $review_enabled);

	} elseif (ACTUAL_MODULE_FOLDER == EVENT_FEATURE_FOLDER) {
        
		$searchByKeywordTip = system_showText(LANG_LABEL_SEARCHKEYWORDTIP_EVENT);
		$autocomplete_keyword_url = AUTOCOMPLETE_KEYWORD_URL.'?module=event';
        $action = EVENT_DEFAULT_URL."/results.php" ;
		$action_adv = EVENT_DEFAULT_URL."/results.php" ;
        $moduleURL = EVENT_DEFAULT_URL;
		$hasAdvancedSearch = true;
		$advancedSearchItem = "event";
		$advancedSearchPath = EDIRECTORY_FOLDER.str_replace(NON_SECURE_URL, "", EVENT_DEFAULT_URL);

	} elseif (ACTUAL_MODULE_FOLDER == CLASSIFIED_FEATURE_FOLDER) {
        
		$searchByKeywordTip = system_showText(LANG_LABEL_SEARCHKEYWORDTIP_CLASSIFIED);
		$autocomplete_keyword_url = AUTOCOMPLETE_KEYWORD_URL.'?module=classified';
		$action = CLASSIFIED_DEFAULT_URL."/results.php" ;
		$action_adv = CLASSIFIED_DEFAULT_URL."/results.php" ;
        $moduleURL = CLASSIFIED_DEFAULT_URL;
		$hasAdvancedSearch = true;
		$advancedSearchItem = "classified";
		$advancedSearchPath = EDIRECTORY_FOLDER.str_replace(NON_SECURE_URL, "", CLASSIFIED_DEFAULT_URL);

	} elseif (ACTUAL_MODULE_FOLDER == ARTICLE_FEATURE_FOLDER) {
        
		$searchByKeywordTip = system_showText(LANG_LABEL_SEARCHKEYWORDTIP_ARTICLE);
		$autocomplete_keyword_url = AUTOCOMPLETE_KEYWORD_URL.'?module=article';
		$action = ARTICLE_DEFAULT_URL."/results.php" ;
		$action_adv = ARTICLE_DEFAULT_URL."/results.php" ;
		$hasAdvancedSearch = true;
		$hasWhereSearch = false;
		$advancedSearchItem = "article";
		$advancedSearchPath = EDIRECTORY_FOLDER.str_replace(NON_SECURE_URL, "", ARTICLE_DEFAULT_URL);
        setting_get("review_article_enabled", $review_enabled);

	} elseif (ACTUAL_MODULE_FOLDER == BLOG_FEATURE_FOLDER) {
		$searchByKeywordTip = system_showText(LANG_LABEL_SEARCHKEYWORDTIP_POST);
		$autocomplete_keyword_url = AUTOCOMPLETE_KEYWORD_URL.'?module=blog';
		$action = BLOG_DEFAULT_URL."/results.php" ;
		$action_adv = BLOG_DEFAULT_URL."/results.php" ;
		$hasAdvancedSearch = true;
		$hasWhereSearch = false;
		$advancedSearchItem = "blog";
		$advancedSearchPath = EDIRECTORY_FOLDER.str_replace(NON_SECURE_URL, "", BLOG_DEFAULT_URL);

	}
    
    if ($review_enabled == "on" && $commenting_edir) {
        $hasRatingSearch = true;
    }
    
    if (THEME_LISTING_PRICE && $advancedSearchItem == "listing") {
        $hasPriceSearch = true;
    }
	
	if (!$browsebylocation && !$browsebycategory) {

		/*
		 * Social network options
		 */
		$useSocialNetworkLocation = false;
		if (sess_getAccountIdFromSession () && !$where){
			$profileObj = new Profile(sess_getAccountIdFromSession());
			if ($profileObj->getString("location") && $profileObj->getString("usefacebooklocation")){
				$where = $profileObj->getString("location");
				$useSocialNetworkLocation = true;
			}
		}

		/*
		 * GeoIP
		 */	
		$waitGeoIP = false;
		
		if (!$useSocialNetworkLocation 
				&& !$where 
				&& GEOIP_FEATURE == "on" 
				&& $advancedSearchItem != "article" 
				&& $advancedSearchItem != "blog"
				&& (!$screen || string_strpos($_SERVER["PHP_SELF"], "profile") > 0)
				&& !$letter 
				&& (string_strpos($_SERVER["REQUEST_URI"], "results.php") === false)
			) {
			
            if ($_COOKIE["location_geoip"]) {
                $where = $_COOKIE["location_geoip"];
            } else {
            
                $waitGeoIP = true; 

                $where = system_showText(LANG_LABEL_WAIT_LOCATION);

                $js_fileLoader = system_scriptColectorOnReady("

                    $.ajax({
                    type: \"GET\",
                    url: \"".DEFAULT_URL."/getGeoIP.php\",
                    success: function(msg){
                            $('#where, #where_resp').removeClass('ac_loading');
-                            $('#where, #where_resp').prop('disabled', '');
-                            $('#where, #where_resp').attr('value', msg);
                    }
                    });

                ",$js_fileLoader);
            
            }
		}
	}
	   
//    if (ACTUAL_MODULE_FOLDER != PROMOTION_FEATURE_FOLDER || (ACTUAL_MODULE_FOLDER == PROMOTION_FEATURE_FOLDER && PROMOTION_SCALABILITY_USE_AUTOCOMPLETE == "on")){
//               
//        $js_fileLoader = system_scriptColectorOnReady("
//
//                        $('#keyword, #keyword_resp').autocomplete(
//                            '$autocomplete_keyword_url',
//                                    {
//                                        delay:1000,
//                                        dataType: 'html',
//                                        minChars:".AUTOCOMPLETE_MINCHARS.",
//                                        matchSubset:0,
//                                        selectFirst:0,
//                                        matchContains:1,
//                                        cacheLength:".AUTOCOMPLETE_MAXITENS.",
//                                        autoFill:false,
//                                        maxItemsToShow:".AUTOCOMPLETE_MAXITENS.",
//                                        max:".AUTOCOMPLETE_MAXITENS."
//                                        }
//                            );
//                        $('#keyword, #keyword_resp').result(function(event, data){
//                            console.log( data );
//                            $( '#sel' ).val( data[0] );
//                        });
//
//                ",$js_fileLoader);
//    }
    
    // if ($hasWhereSearch) {
        
    //     $js_fileLoader = system_scriptColectorOnReady("

    //         $('#where, #where_resp').autocomplete(
    //             '".AUTOCOMPLETE_LOCATION_URL."',
    //                 {
    //                     delay:1000,
    //                     minChars:".AUTOCOMPLETE_MINCHARS.",
    //                     matchSubset:0,
    //                     selectFirst:0,
    //                     matchContains:1,
    //                     cacheLength:".AUTOCOMPLETE_MAXITENS.",
    //                     autoFill:false,
    //                     maxItemsToShow:".AUTOCOMPLETE_MAXITENS.",
    //                     max:".AUTOCOMPLETE_MAXITENS."
    //                 }
    //             );

    //     ",$js_fileLoader);
        
    // }
    
    /**
     * modification
     */
    $js_fileLoader = system_scriptColectorOnReady("
            
            var locat = $( '#where' ).val();
            $('.btn-search').on( 'click', function(e){
                var key = $( '#keyword' ).val();
                var loc = $( '#where' ).val();
                var state = cookCookies.getCookie('location_state');
                
                if( loc === 'United States' ){
                    if(!state || state === 'undefined'){ 
                        e.preventDefault(); 
                        // $.fancybox.open({
                            
                        //     content: '<strong>Please select the USA state you are searching for.</strong>
                        //     		<div>my custom html</div>

                        //     ',
                        //     height: 550
                        // });

						// $( '.inner' ).append( '<p>Please select a State</p>' );

						   // $( 'p' ).show( 'slow' );

                        $('#myModal').modal('show'); 


       //                  	$.fancybox.open({
							//     padding : 0,
							//     href:'dropdown.php',
							//     type: 'iframe',
							//     height: 10,
							//     width: 220,
							//     fitToView: false,
							// 	autoSize: false
							// });	
						


                        //window.scrollTo(0, document.body.scrollHeight);
                    }
                }
                
                if( !$( '#where' ).val().trim().length ){
                    $( '#where' ).val(locat);
                }
                
                // if( !key.trim().length ){
                //     e.preventDefault();
                // }
            });
            
            
            ",$js_fileLoader);
    
    $js_fileLoader = system_scriptColectorOnReady("
            
            if( $(window).width() < 962 ){
                $( '#state-selector').addClass('on-top').prependTo('#search-form');
            }
            
            
            ",$js_fileLoader);
    
    include(system_getFrontendPath("new_search.php"));

?>

<script>function closeFancyboxAndRedirectToUrl(o){$.fancybox.close(),window.location=o}</script>
