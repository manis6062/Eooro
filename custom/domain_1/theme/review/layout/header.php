<?php

//error_reporting( E_ALL );
//ini_set( 'display_errors', 'on' );
    header("Expires: Sat, 01 Jan 2000 00:00:00 GMT");
    header("Cache-Control: no-store, no-cache, must-revalidate");
    header("Cache-Control: post-check=0, pre-check=0", FALSE);
    header("Pragma: no-cache");
    header("Content-Type: text/html; charset=".EDIR_CHARSET, TRUE);

    // to work in live mode
    $dispatcher = PluginRegistry::getDispatcher();
    $dispatcher->dispatch( 'UserNavigation' );

    $url1           = $listing->friendly_url;
    $friendly_url1  = $listing->friendly_url;
    $check_url      = LISTING_DEFAULT_URL."/".$url1;
    $current_url    = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

    if($check_url==$current_url ){
     $listingObj  = db_getFromDB("listing", "friendly_url", db_formatString($friendly_url1));
     $title       = $headertag_title;
     $description = $headertag_description;
     $galObj      = new Gallery();
     $sqlGI       = "SELECT `gallery_id` FROM `Gallery_Item` WHERE `item_id` = ".$listingObj->getNumber("id")." AND `item_type` = 'listing' LIMIT 1";
     $resGI       = $dbObj->Query($sqlGI);

        $rowGI       = mysql_fetch_assoc($resGI);
        $images      = $galObj->getAllImages($rowGI["gallery_id"],false);
        $levelObj    = new ListingLevel();
         //Get fields according to level
         unset($array_fields);
         $array_fields   = system_getFormFields("Listing", $level);
         $levelMaxImages = $levelObj->getImages($level);


         if ((is_array($array_fields) && in_array("main_image", $array_fields)) || $levelMaxImages > 0){

            $hasImage = true;

            if (is_array($images) && $images[0]) {
                foreach ($images as $image) {
                    $imgObj = new Image($image["image_id"]);
                    if ($imgObj->imageExists()) {
                        if ($image["image_default"] == "y") { //store the main image to use on meta tag og:image
                            $mainImage = $imgObj->getPath();

                        }

                        $randomImage = $imgObj->getTag(false, 0, 0, $image["image_caption"] ? $image["image_caption"] : $title);
                        $strImages .= $randomImage;
                    }

                }
                if (!$mainImage) { //if there is no main image, use a random image
                $mainImage = DEFAULT_URL. "/custom/domain_1/theme/review/images/share-noimage.jpg";

                }
            }
            else{
                $mainImage = DEFAULT_URL. "/custom/domain_1/theme/review/images/share-noimage.jpg";
            }

        }
      }

    //This function returns the variables to fill in the meta tags content below. Do not change this line.
    front_getHeaderTag($headertag_title, $headertag_author, $headertag_description, $headertag_keywords);
    // front_shareContent($title, $description, $hasImage, $images, false);
    $showMetaKeyword = true;
    $city_meta    = new location4($listing->location_4);
    $state_meta   = new location3($listing->location_3);
    $title        = str_replace('&amp;', '&', $headertag_title);


    $seo_description  = $listing->seo_description;
    $city_meta->name  = $city;
    $state_meta->name = $state;
    $business_title   = (ucfirst($title));
    $description      = htmlspecialchars($listing->description);

    if(strpos($current_url, 'review.php')) { 
        $contentReview  = htmlentities($reviewObj->review);
        $description    = htmlentities($reviewObj->review);
        $business_title = htmlentities($reviewObj->reviewer_name). " has reviewed ". htmlentities($listingObj->title);
    }
?>
<!DOCTYPE html>
<html itemscope itemtype="http://schema.org/LocalBusiness" lang="en">
    <head>
        <meta charset="utf-8">
        <title><?=$business_title?></title>
        <meta name="author" content="<?=$headertag_author?>" />

    <!-- If the page is detail page and it consists of locations  -->
<? if(strpos(ACTUAL_PAGE_NAME, "detail.php")): ?>
        <?
        if(strpos($current_url, 'www.') === false){
            $current_url = preg_replace('#(http(?:s)?://)(.*)#', '${1}www.${2}', $current_url);
        }
        ?>
        <link rel="canonical" href="<?=$current_url?>" />
<? if( $city_meta->name ): ?>
<?$content= "Read reviews for"." ". $business_title ." in".$city."," .$state. ". " ."Write a business review for"." ".  $business_title ."in". $city_meta->name .",". $state_meta->name ;?>
    <meta name="description" content="<?=$content?>" />
<? else : ?>
<?$content="Read reviews for". " ".$business_title." "."Write a business review for"." ".$business_title;?>
    <meta name="description" content="<?=$content?>" />
<? endif; ?>
<? else :?>
<? $content= $headertag_description;?>
    <meta name ="description" content="<?=$content?>" />
<? endif; ?>

<!-- If the listing business consists of seo description-->

<?  if($seo_description) {?>
<?$content= $seo_description?>
<meta property="og:description" content="<?=  htmlspecialchars($seo_description)?>" />
<?}else{?>
    <meta property="og:description" content="<?php echo $contentReview ? $contentReview : $content; ?>"/>
<?}?>


    <meta property="og:title" content="<?=$business_title?>"/>
    <meta property="og:url" content="<?=$current_url?>"/>
    <meta itemprop="description" content="<?=$description?>">
    <meta property="og:image" content="<?=$mainImage?>"/>
    <meta property="og:image:width" content="1000" />
    <meta property="og:image:height" content="1000" />
    <link rel="image_src" type="image/jpeg" href="<?=$mainImage?>" />
<!--    <meta name="keywords" content="<? //=$headertag_keywords?>" />-->
    <meta http-equiv="Content-Type" content="text/html; charset=<?=EDIR_CHARSET;?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name='verify-v1' content='ac40d65b05e49ad526ba191669bc4d50'/>
        <style type="text/css">
            ._s0 _rw img{
            display: none;
            }
        </style>

        <? $metatagHead = true; include(INCLUDES_DIR."/code/smartbanner.php"); ?>

        <!-- This function returns the favicon tag. Do not change this line. -->
        <?=system_getFavicon();?>

        <!-- This function returns the search engine meta tags. Do not change this line. -->
        <?=front_searchMetaTag();?>

        <!-- This function returns the meta tags rel="next"/rel="prev" to improve SEO on results pages. Do not change this line. -->
        <?=front_paginationTags($array_pages_code, $aux_items_per_page, $hideResults, $blogHome);?>

        <?  // The URL is exploded on "/" and searched for term "profile", if found meta tag ROBOTS = nofollow ?>

        <?php
        if ((strpos($_SERVER['REQUEST_URI'], SOCIALNETWORK_FEATURE_NAME) > -1)
                    || (strpos($_SERVER['REQUEST_URI'], 'contactus'))
                    || (strpos($_SERVER['REQUEST_URI'], 'sitemap'))
                    || (strpos($_SERVER['REQUEST_URI'], 'locations'))
                    || (strpos($_SERVER['REQUEST_URI'], 'privacypolicy'))
                    || (strpos($_SERVER['REQUEST_URI'], 'termsofuse'))
                    || (strpos($_SERVER['REQUEST_URI'], 'sponsors'))
                    || (strpos($_SERVER['REQUEST_URI'], 'results'))
                    || (strpos($_SERVER['REQUEST_URI'], 'review.php')))

                {
                    echo '<meta name="ROBOTS" content="noindex, follow" />';
                } else if(strpos($_SERVER['REQUEST_URI'], 'order_listing.php')
                    || strpos($_SERVER['REQUEST_URI'], 'claim')){
                    echo '<meta name="ROBOTS" content="noindex, nofollow" />';
                }
                elseif((strpos($_SERVER['REQUEST_URI'], 'advertise'))
                        || (strpos($_SERVER['REQUEST_URI'], 'reviews'))
                        || (strpos($_SERVER['REQUEST_URI'], 'faq'))) {
                    echo '<meta name="ROBOTS" content="index, follow" />';
                }
                else if(!$module_key){   //For home page
                    echo '<meta name="ROBOTS" content="index, follow" />';
                    echo '<link rel="canonical" href="http://www.eooro.com/" />';
                } else { //other pages like sitemap, contact us
                    echo '<meta name="ROBOTS" content="noindex, follow" />';
                }
        ?>
        <meta name="msvalidate.01" content="2FBF9CE22B5EE613CDCCEF74CD94410E" />
        <!-- This function includes all css files. Do not change this line. -->
        <!-- To change any style, it's better to edit the stylesheet files. -->
        <? front_themeFiles(); ?>

        <!--[if lt IE 9]>
            <script src="<?=DEFAULT_URL."/scripts/front/html5shiv.js"?>"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- This function reads and includes all js and css files (minimized). Do not change this line. -->
        <? script_loader($js_fileLoader, $pag_content, $aux_module_per_page, $id, $aux_show_twitter); ?>
        <? $u = DEFAULT_URL."/custom/domain_1/theme/".EDIR_THEME."/images/wallpapers/";?>

<? if(ACTUAL_PAGE_NAME == 'ACTUAL_PAGE_NAME' && !strpos($_SERVER['REQUEST_URI'], "results.php") && !strpos($_SERVER['REQUEST_URI'], "termsofuse.php") && !strpos($_SERVER['REQUEST_URI'], "privacypolicy.php")&& !strpos($_SERVER['REQUEST_URI'], "order_listing.php") && !strpos($_SERVER['REQUEST_URI'], "review.php") && !strpos($_SERVER['REQUEST_URI'], "reviewcollector.php")  && !strpos($_SERVER['REQUEST_URI'], "widget_in_action.php")) {?>

    <? if(strpos($_COOKIE['location_geoip'], ' ')){?>
    <? $country =  str_replace(' ', '', $_COOKIE['location_geoip']); ?>
        <? $file = $u . $country . '_img.jpg';
        $filename = $country . '_img.jpg';
        $src = $u . $filename;  ?>
<? if (!@getimagesize($src)) { ?>
    <style>
    .banner{
        background:url('<?=$u?>DefaultWallpaper_img.jpg') top center no-repeat;
        background-size:100% 100%;
    }
    </style>
<? } else { ?>
    <style>
        .banner{
            background:url('<?=$u?><?=$country?>_img.jpg') top center no-repeat;
            /* background-size:cover;*/
            background-size:100% 100%;
        }
    </style>
<? } ?>
    <?} else { ?>
        <? $file = $u . $_COOKIE['location_geoip'] . '_img.jpg';
        $filename = $_COOKIE['location_geoip'] . '_img.jpg';
        $src = $u . $filename;?>

<? if (!@getimagesize($src)) { ?>
    <style>
        .banner{
            background:url('<?=$u?>DefaultWallpaper_img.jpg') top center no-repeat;
            background-size:cover;
        }
    </style>

<? } else { ?>
    <style>
    .banner{
        background:url('<?=$u?><?=$_COOKIE['location_geoip']?>_img.jpg') top center no-repeat;
        background-size:cover;
    }
    </style>
<? } ?>
    <?}?>



<? } else { ?>

<style>
.banner{
    background:url('<?=$u?>banner_img.jpg') top center no-repeat;
    background-size:cover;
}
</style>

<? } ?>
<?if( strpos($_SERVER['REQUEST_URI'],'faq.php') ){ ?>
<style>
    .footer-atbottom {
      background-color: #FFF;
    }
</style>
<? } ?>
</head>

    <!--[if IE 7]><body class="ie ie7"><![endif]-->
    <!--[if lt IE 9]><body class="ie"><![endif]-->
     <!--[if false]>-->
    <body style="min-height:100vh;">
<script>
      var isSafari = /Safari/.test(navigator.userAgent) && /Apple Computer/.test(navigator.vendor);

   if (isSafari)
    {
        $('body').css('min-height', '96rem');
    }
</script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.6.2/modernizr.min.js" ></script>
  <script>
        Modernizr.addTest('flexboxtweener', Modernizr.testAllProps('flexAlign', 'end', true));
  </script>
<!--<![endif]-->

        <!-- Google Tag Manager code - DO NOT REMOVE THIS CODE  -->
        <?=front_googleTagManager();?>

        <? if (DEMO_LIVE_MODE && file_exists(EDIRECTORY_ROOT."/frontend/livebar.php")) {
            include(EDIRECTORY_ROOT."/frontend/livebar.php");
        } ?>

        <!-- This function returns the code warning users to upgrade their browser if they are using Internet Explorer 6. Do not change this line.  -->
        <? front_includeFile("IE6alert.php", "layout", $js_fileLoader); ?>
        <header>
            <nav class="navbar navbar-default">
                <div class="container">
        <a class="navbar-brand" href="<?=DEFAULT_URL?>"><img src="<?=DEFAULT_URL.'/custom/domain_1/content_files/img-logo.png'?>" width="100px"/> </a>
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                  </button>
                        <div>
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <div>
                    <ul class="nav navbar-nav cusnav" >
                        <? include(system_getFrontendPath("header_menu.php", "layout")); ?>
                    </ul>
                        <?if(sess_isAccountLogged()==NULL) {?>
                            <div class="col-sm-5 pull-right singup-login">
                             <div class="row">
                                <? include(system_getFrontendPath( 'usernavbar.php', 'layout') ); ?>
                             </div>
                            </div>
                        <?} else {?>

                            <div class="col-sm-6 pull-right dashboard-icon1">
                             <div class="row">
                                <? include(system_getFrontendPath( 'usernavbar.php', 'layout') ); ?>
                             </div>
                            </div>

                          <?  } ?>
                    </div>
                </div> <!--/container-->
            </nav>
        </header>
        