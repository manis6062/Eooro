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
	# * FILE: /mobile/layout/header.php
	# ----------------------------------------------------------------------------------------------------

	header("Expires: Sat, 01 Jan 2000 00:00:00 GMT");
	header("Cache-Control: no-store, no-cache, must-revalidate");
	header("Cache-Control: post-check=0, pre-check=0", FALSE);
	header("Pragma: no-cache");
	header("Content-Type: text/html; charset=".EDIR_CHARSET, TRUE);

	include(INCLUDES_DIR."/code/headertag.php");
    
	$headertag_title = $headertag_title." Mobile";

?>

<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<? $headertag_title = (($headertag_title) ? ($headertag_title) : (EDIRECTORY_TITLE)); ?>
		<title><?=$headertag_title?></title>
		<meta name="viewport" content="width=device-width, minimum-scale=1, maximum-scale=1, initial-scale=1" />
        <meta http-equiv="Content-Type" content="application/vnd.wap.xhtml+xml;charset=UTF-8" />
        
        <? $metatagHead = true; $isMobileVersion = true; include(INCLUDES_DIR."/code/smartbanner.php"); ?>
        
        <link href="<?=MOBILE_DEFAULT_URL?>/layout/bootstrap/assets/css/bootstrap.css" rel="stylesheet" />
        <link href="<?=MOBILE_DEFAULT_URL?>/layout/bootstrap/assets/css/bootstrap-responsive.css" rel="stylesheet" />
        <link href="<?=MOBILE_DEFAULT_URL?>/layout/bootstrap/assets/css/style.css" rel="stylesheet" />
        <link href="<?=MOBILE_DEFAULT_URL?>/layout/bootstrap/assets/css/docs.css" rel="stylesheet" />
        <link href="<?=MOBILE_DEFAULT_URL?>/layout/bootstrap/assets/js/google-code-prettify/prettify.css" rel="stylesheet" />
        <link href="<?=MOBILE_DEFAULT_URL?>/layout/fancybox/source/jquery.fancybox.css" rel="stylesheet" />    
        <link href="<?=MOBILE_DEFAULT_URL?>/layout/fancybox/source/helpers/jquery.fancybox-buttons.css" rel="stylesheet" />    
        
        <link media="only screen and (min-device-width: 480px) and (-webkit-min-device-pixel-ratio: 2) and (orientation : portrait)" href="<?=MOBILE_DEFAULT_URL?>/layout/bootstrap/assets/css/font-awesome.css" rel="stylesheet" />
               
		<script src="<?=MOBILE_DEFAULT_URL?>/layout/bootstrap/assets/js/jquery.js" type="text/javascript"></script>
        <script src="<?=MOBILE_DEFAULT_URL?>/layout/bootstrap/assets/js/bootstrap-collapse.js" type="text/javascript"></script>
        <script src="<?=MOBILE_DEFAULT_URL?>/layout/fancybox/source/jquery.fancybox.pack.js" type="text/javascript"></script>
        <script src="<?=MOBILE_DEFAULT_URL?>/layout/fancybox/source/helpers/jquery.fancybox-buttons.js" type="text/javascript"></script>
        <script src="<?=DEFAULT_URL?>/scripts/jquery/jquery.cookie.js" type="text/javascript"></script>
        <? if ($addSmartBannerJs) { ?>
        
            <link href="<?=DEFAULT_URL?>/scripts/jquery/smartbanner/jquery.smartbanner.css" rel="stylesheet" />  
            <script src="<?=DEFAULT_URL?>/scripts/jquery/smartbanner/jquery.smartbanner.js" type="text/javascript"></script>

            <? if ($type == "android") { ?>
            
            <script type="text/javascript">
                $(document).ready(function() {
                   
                   $.smartbanner({
                        title: '<?=addslashes($popuptitle)?>', // What the title of the app should be in the banner (defaults to <title>)
                        author: '', // What the author of the app should be in the banner (defaults to <meta name=\"author\"> or hostname)
                        price: '<?=addslashes($price)?>', // Price of the app
                        appStoreLanguage: 'us', // Language code for App Store
                        inAppStore: '<?=addslashes($tagline)?>', // Text of price for iOS
                        inGooglePlay: '<?=addslashes($tagline)?>', // Text of price for Android
                        icon: '<?=$imgURL?>', // The URL of the icon (defaults to <link>)
                        iconGloss: null, // Force gloss effect for iOS even for precomposed (true or false)
                        button: '<?=system_showText(LANG_LABEL_VIEW)?>', // Text on the install button
                        scale: 'auto', // Scale based on viewport size (set to 1 to disable)
                        speedIn: 300, // Show animation speed of the banner
                        speedOut: 400, // Close animation speed of the banner
                        daysHidden: 7, // Duration to hide the banner after being closed (0 = always show banner)
                        daysReminder: 7, // Duration to hide the banner after \"VIEW\" is clicked (0 = always show banner)
                        force: 'android' // Choose 'ios' or 'android'. Don't do a browser check, just always show this banner
                    });
                   
                });
            </script>
            
            <? } ?>
        
        <? } ?>
    
        <!--[if lt IE 9]>
          <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?=MOBILE_DEFAULT_URL?>/layout/bootstrap/assets/ico/apple-touch-icon-144-precomposed.png" />
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?=MOBILE_DEFAULT_URL?>/layout/bootstrap/assets/ico/apple-touch-icon-114-precomposed.png" />
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?=MOBILE_DEFAULT_URL?>/layout/bootstrap/assets/ico/apple-touch-icon-72-precomposed.png" />
        <link rel="apple-touch-icon-precomposed" href="<?=MOBILE_DEFAULT_URL?>/layout/bootstrap/assets/ico/apple-touch-icon-57-precomposed.png" />    
        
        <?=system_getNoImageStyle($cssfile = true);?>
        
        <?=system_getFavicon();?>
            
        <script type="text/javascript">
            
            function viewFullSite() {
                $.cookie('mobileFullSite', 'true', {expires: 30, path: '/'});
                location.href = '<?=DEFAULT_URL?>';
            }
            
            <? if (string_strpos($_SERVER["PHP_SELF"], "blogdetail.php") !== false || string_strpos($_SERVER["PHP_SELF"], "dealdetail.php") !== false) { ?>
                $(document).ready(function(){
                    $("a.group").fancybox({
                        'transitionIn'  :   'elastic',
                        'transitionOut' :   'elastic',
                        'speedIn'       :   600,
                        'speedOut'      :   200,
                        'overlayShow'   :   false,
                        'padding'       :   5,
                        'titleShow'     : false
                    });
                });

            <? } elseif (string_strpos($_SERVER["PHP_SELF"], "detail.php") !== false) { ?>
                $(document).ready(function(){
                    $("a.group").fancybox({
                        'padding'       : 5,
                        openEffect      : 'fade',
                        closeEffect     : 'elastic',
                        'titleShow'     : false,
                        closeBtn        : false,
                        arrows          : false,
                        nextClick       : true,
                        helpers         : {
                                            buttons    : {
                                                position: 'bottom'
                                            }
                        },
                        afterLoad : function() {
                            this.title = '<?=system_showText(LANG_LABEL_IMAGE)?> ' + (this.index + 1) + ' <?=system_showText(LANG_PAGING_PAGEOF)?> ' + this.group.length + (this.title ? ' - ' + this.title : '');
                        }
                    });
                });
            <? } ?>
        </script>
       
	</head>

	<body>
        <?
        $aux_show_navbar = true;
        $image_logo_path = system_getHeaderMobileLogo();
        list($width, $height) = getimagesize(EDIRECTORY_ROOT.$image_logo_path);
        image_getNewDimension(MOBILE_LOGO_WIDTH, MOBILE_LOGO_HEIGHT, $width, $height, $image_logo_width, $image_logo_height);
       
        if (string_strpos($_SERVER["PHP_SELF"], "/index.php") !== false) {
            $aux_show_navbar = false;
        } ?>
        
        <div class="navbar navbar-inverse navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">
                    <a class="brand" href="<?=MOBILE_DEFAULT_URL?>">
                        <img width="<?=(int)$image_logo_width?>" height="<?=(int)$image_logo_height?>" src="<?=DEFAULT_URL.$image_logo_path?>" alt="<?=$headertag_title?>" title="<?=$headertag_title?>" />
                    </a>

                    <? if ($aux_show_navbar) { ?>
                        <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-navbar">
                            <span class="icon-bar icon-white"></span>
                            <span class="icon-bar icon-white"></span>
                            <span class="icon-bar icon-white"></span>
                        </a>
                    <? } ?>
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-search">
                        <span class="icon-search icon-white"></span>
                    </a>  
                    
                    <div class="nav-collapse collapse nav-search">
                        <? include("search.php"); ?>
                    </div> 

                    <? if ($aux_show_navbar) { ?>
                        <div class="nav-collapse collapse nav-navbar">
                            <? include("layout/navbar.php"); ?>
                        </div>
                    <? } ?>

                </div>
            </div>
        </div>
  
        <div class="main">
            
            <div class="container">
         
                    <div class="content">
                    <?
                    if (!$aux_show_navbar) {
                        include("layout/navbar.php");
                    }
                    ?>