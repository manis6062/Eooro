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
	# * FILE: /theme/default/body/listing/detail.php
	# ----------------------------------------------------------------------------------------------------
    //variables $lst, $city_meta->name, $state_meta->name are extracted form header.php(custom/domain_1/theme/review/layout/header.php)

    // if($city_meta->name){
    //     $thePageTitle = '<h1 class="transparent-bg">'. $listing->title. ' Reviews | ' . $city_meta->name . ', ' . $state_meta->name . '</h1>';
    // } else {  
    //     $thePageTitle = '<h1 class="transparent-bg">'. $listing->title . ' Reviews'. '</h1>';
    // }
    
    // $headertag_title comes from full_modrewrite.php: line 244
 
    $thePageTitle = '<h1 class="transparent-bg">'. stripcslashes($headertag_title). '</h1>';
    include(system_getFrontendPath("review_banner.php"));

        if( strpos($_SERVER['SERVER_NAME'], "eooro") > -1 ) {
            $partial_uri      = "https://eooro.net/widget/";
        } elseif( strpos($_SERVER['SERVER_NAME'], "lcnservers.com") > -1 ) {
            $partial_uri      = "https://vps65937-6.lcnservers.com/widget/";
        } else {
            $partial_uri      = "https://localhost/widget/";
        }
        
        $widget_uri       = $partial_uri . $listing->friendly_url;
        $widget_uri_small = $partial_uri. "small/";
        $widget_uri_full  = $partial_uri. "small/".$listing->friendly_url;
?>

    
<section class="latest-review cusreview">
    <div class="container">
            <? include(system_getFrontendPath("detailview.php", "frontend", false, LISTING_EDIRECTORY_ROOT)); ?>
        <div class="row">
        <div class="col-sm-4 fullwidth">
            <? include(system_getFrontendPath("detail_maps.php", "frontend", false, LISTING_EDIRECTORY_ROOT)); ?>

            <!-- Widget  -->
            <? 
                $claimed = ($listing->account_id > 0 && !empty($listing->custom_text2));
                if (!$claimed){
                    include(system_getFrontendPath('detail_widget.php'));
                }
            ?>
            <?
            $sidebar = array(
                'facebook' => system_getFrontendPath("detail_fanpage.php", "frontend", false, LISTING_EDIRECTORY_ROOT),
                'twitter' => system_getFrontendPath("detail_fanpage_twitter.php", "frontend", false, LISTING_EDIRECTORY_ROOT),
                'recentreview' => system_getFrontendPath("detail_reviews.php"),
                'banner' => system_getFrontendPath( 'listing_detail_banner.php' )
            );

            // get priorities
            setting_get( 'listing_detail_priority_one', $priorityOne );
            setting_get( 'listing_detail_priority_two', $priorityTwo );
            setting_get( 'listing_detail_priority_three', $priorityThree );
            setting_get( 'listing_detail_priority_four', $priorityFour );

        //See if Priority1, 2, 3, 4 is enabled or not
            
        setting_get( 'listing_detail_show_'.$priorityOne, $pr1);
        setting_get( 'listing_detail_show_'.$priorityTwo, $pr2);
        setting_get( 'listing_detail_show_'.$priorityThree, $pr3);
        setting_get( 'listing_detail_show_'.$priorityFour, $pr4);

        //Whatever is included, display it

        //Priority1 and Priority 2 = Social Media(Facebook/Twitter)
        //Priority2 and Priority3 = Recent Reviews/Banner
        
        if($pr1){
            include_once($sidebar[$priorityOne]);
        }

        if($pr2){
            include_once($sidebar[$priorityTwo]);
        }

        if($pr3){
            include_once($sidebar[$priorityThree]);
        }

        if($pr4){
            include_once($sidebar[$priorityFour]);
        }

            ?>
        </div><!--/col-sm-4-->
                
                <?//include(system_getFrontendPath("detail_maps.php", "frontend", false, LISTING_EDIRECTORY_ROOT)); ?>
                <? //include(system_getFrontendPath("detail_socialbuttons.php", "frontend", false, LISTING_EDIRECTORY_ROOT)); ?>
                <?// include(system_getFrontendPath("detail_fanpage.php", "frontend", false, LISTING_EDIRECTORY_ROOT)); ?>
                <?// include(system_getFrontendPath("detail_fbcomments.php", "frontend", false, LISTING_EDIRECTORY_ROOT)); ?>
                <?// include(system_getFrontendPath("detail_checkin.php", "frontend", false, LISTING_EDIRECTORY_ROOT)); ?>
                
            
        <div class="row">
<!--            <div class="col-sm-6">
                <div class="fooads">
                        <span>Banner Advert 570px x 73px</span>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="fooads">
                        <span>Banner Advert 570px x 73px</span>
                </div>
            </div>-->
        </div>
    </div> <!--/container-->
</section>

    <?// include(system_getFrontendPath("related_listings.php", "frontend", false, LISTING_EDIRECTORY_ROOT)); ?>
