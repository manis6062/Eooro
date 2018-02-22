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
            $partial_uri      = "http://eooro.net/widget/";
        } elseif( strpos($_SERVER['SERVER_NAME'], "lcnservers.com") > -1 ) {
            $partial_uri      = "http://vps65937-6.lcnservers.com/widget/";
        } else {
            $partial_uri      = "http://localhost/widget/";
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

            <div class="thumbnail custhumbnail detailpage-widget">
                <div class="row-fluid well-steps">
                    <div class="col-sm-12">
                        <div class="iframeWrapperDetailPage">
                        <iframe src="<?=$widget_uri_full?>" scrolling="no" class="detailpage-iframe" style="border:0px;width:250px;height:185px;"></iframe>
                          <div class="widthHeight">
                                <strong>250px x 185px</strong>
                          </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="reputationWrapper">
                        <p data-toggle="modal" data-target="#myModal">
                            <span class="repuEvery">Reputation is Everything</span></br>
                            <span class="clickHere">Click Here</span> to get html code for above review box and put it on your website</br>
                            <span class="helpFree">Help drive your customers to this page…for FREE</span>
                        </p>
                        </div>

                        <!-- Modal -->
                        <div id="myModal" class="modal fade" role="dialog">
                            <div class="modal-dialog">

                                <!-- Modal content-->
                                <div class="modal-content detailpage-modal">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Widget Code for <?=ucwords(htmlspecialchars($listing->title))?></h4>
                                    </div>
                                    <div class="modal-body">
                                        <textarea class="widget-code-text" readonly style="width: 550px; height: 175px;"><div class='eooro-widget' data-business="<?=$listing->friendly_url?>"><script>d=document.getElementsByClassName("eooro-widget"),l=d[0].dataset.business;f=document.createElement("iframe"),f.setAttribute("src","<?=$widget_uri_small?>"+l),f.setAttribute("scrolling","no"),f.setAttribute("style","float:left;border:0px;width:250px;height:486px;"),d[0].appendChild(f);</script></div></textarea>
                                    </div>
                                    <div class="modal-footer detailpage-modal">
                                        <button type="button" class="btn btn-default" onclick="$('.widget-code-text').select();">Select All</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
