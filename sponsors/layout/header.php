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
	# * FILE: /members/layout/header.php
	# ----------------------------------------------------------------------------------------------------

	header("Content-Type: text/html; charset=".EDIR_CHARSET, TRUE);

	include(INCLUDES_DIR."/code/headertag.php");

    $accountObj = new Account(sess_getAccountIdFromSession());

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml" xml:lang="en" lang="en">

	<head>
	
		<?
        if (sess_getAccountIdFromSession()) {
					$dbObjWelcome = db_getDBObJect(DEFAULT_DB, true);
					$sqlWelcome = "SELECT C.first_name, C.last_name, A.has_profile, P.friendly_url FROM Contact C
										   LEFT JOIN Account A ON (C.account_id = A.id)
										   LEFT JOIN Profile P ON (P.account_id = A.id)
										   WHERE A.id = ".sess_getAccountIdFromSession();
					$resultWelcome = $dbObjWelcome->query($sqlWelcome);
					$contactWelcome = mysql_fetch_assoc($resultWelcome);
		}
        
        $headertag_title = (($headertag_title) ? ($headertag_title) : (EDIRECTORY_TITLE)); ?>

        <title><?=( (trim($contactWelcome["first_name"])) ? $contactWelcome["first_name"]." ".$contactWelcome["last_name"].", " : "" ) . system_showText(LANG_MSG_WELCOME) . " - " . $headertag_title?></title>

		<? $headertag_author = (($headertag_author) ? ($headertag_author) : ("Arca Solutions")); ?>
		<meta name="author" content="<?=$headertag_author?>" />

		<? $headertag_description = (($headertag_description) ? ($headertag_description) : (EDIRECTORY_TITLE)); ?>
		<meta name="description" content="<?=$headertag_description?>" />

		<? $headertag_keywords = (($headertag_keywords) ? ($headertag_keywords) : (EDIRECTORY_TITLE)); ?>
<!--		<meta name="keywords" content="<? //=$headertag_keywords?>" />-->

		<meta http-equiv="Content-Type" content="text/html; charset=<?=EDIR_CHARSET;?>" />

		<meta name="ROBOTS" content="noindex, follow" />
        
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
		
		<?
		/* MEMBERS AREA WITH THEME STYLE */
		include(THEMEFILE_DIR."/".EDIR_THEME."/".EDIR_THEME.".php");
		?>
			
		<?=system_getNoImageStyle($cssfile = true);?>
        
        <?=system_getFavicon();?>
        
        <? /* JQUERY FANCYBOX STYLE*/?>
        <link rel="stylesheet" href="<?=DEFAULT_URL?>/scripts/jquery/fancybox/v2/jquery.fancybox.css" type="text/css" media="all" />
		<? /* JQUERY Jcrop STYLE */ ?>
        <link rel="stylesheet" href="<?=DEFAULT_URL?>/scripts/jquery/jcrop/css/jquery.Jcrop.css" type="text/css" />
        <? /* JQUERY UI SMOOTHNESS STYLE */?>
        <link type="text/css" href="<?=DEFAULT_URL?>/scripts/jquery/jquery_ui/css/smoothness/jquery-ui-1.7.2.custom.css" rel="stylesheet" />
		<? /* JQUERY AUTO COMPLETE STYLE */ ?>
		<link type="text/css" href="<?=DEFAULT_URL?>/scripts/jquery/jquery.autocomplete.css" rel="stylesheet" media="all" />
        
        <script type="text/javascript">
        <!-- 
		DEFAULT_URL = "<?=DEFAULT_URL?>";
        THEME_FLAT_FANCYBOX = "<?=THEME_FLAT_FANCYBOX?>";
		-->
		</script>
        
        <script type="text/javascript" src="<?=language_getFilePath(EDIR_LANGUAGE, true);?>"></script>
		<script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/specialChars.js"></script>
		<script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/common.js"></script>
		<script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/location.js"></script>
        <? if( EDIR_THEME==='review' ){?>

        <? } else { ?>
        <script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/front/jquery-1.8.3.min.js"></script>
        <script src="<?=DEFAULT_URL?>/scripts/front/bootstrap.min.js" language="javascript" type="text/javascript"></script>
        <? } ?>
        <script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/jquery/jcrop/js/jquery.Jcrop.js"></script>
        <script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/jquery/fancybox/v2/jquery.fancybox.pack.js" ></script>
                
        <? /* JQUERY UI */ ?>
		<script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/jquery/jquery_ui/js/jquery-ui-1.7.2.custom.min.js"></script>
        <? if (EDIR_LANGUAGE != "en_us") { ?>
        <? /* DATA PICKER TRANSLATION */?>
        <script type="text/javascript" src="<?=language_getDatePickPath(EDIR_LANGUAGE);?>"></script>
        <? } ?>
		<? /* JQUERY COOKIE PLUGIN */?>
        <script src="<?=DEFAULT_URL?>/scripts/jquery/jquery.cookie.js" type="text/javascript"></script>
        <script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/jquery/jquery.maskedinput-1.3.min.js"></script>
		<script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/domain.js"></script>
		<script language="javascript" type="text/javascript" src="<?=DEFAULT_URL?>/scripts/socialbookmarking.js"></script>
        <script src="<?=DEFAULT_URL?>/scripts/jquery/jquery.autocomplete.js" type="text/javascript"></script>
		<script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/jquery/jquery.textareaCounter.plugin.js"></script>
		<script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/jquery/jquery.knob.js"></script>
		<script src="<?=DEFAULT_URL?>/scripts/contactclick.js" language="javascript" type="text/javascript"></script>
        <script src="<?=DEFAULT_URL?>/scripts/Chart.js" language="javascript" type="text/javascript"></script>

		<script type="text/javascript">
            
            $(function() {    

            <? if (!$_SERVER['HTTPS']) {   ?>
                //Update Billing Notification
                $.post("<?=DEFAULT_URL."/".MEMBERS_ALIAS."/ajax.php"?>", {
                    ajax_type: 'getunpaidItems'
                }, function (ret) {
                    if (ret > 0) {
                        $("#billing_notify").html(ret);
                        $("#billing_notify").fadeIn();
                    }
                });
            <? } ?>
                
                <? if (string_strpos($_SERVER["PHP_SELF"], "quicklists.php") !== false) { ?>
                    $('.image.favoritesGrid').hover(function(){
                        $('.coverFavorites', this).stop().animate({top:'0'},{queue:false,duration:160});
                    }, function() {
                        $('.coverFavorites', this).stop().animate({top:'-37px'},{queue:false,duration:160});
                    });
                <? } ?>

                $("a.fancy_window").fancybox({
                    'hideOnContentClick'	: false,
                    'overlayShow'			: true,
                    'overlayOpacity'		: 0.75,
                    'frameWidth'			: 560,
                    'frameHeight'			: 550,
                    
                    <? if (THEME_FLAT_FANCYBOX) { ?>
                                                
                    'padding'               : 0,
                    'margin'                : 0,
                    'showCloseButton'       : false,

                    <? } ?>
                    
                    'titleShow'             : false
                });
                     
                //Modules preview (except for banners)
                $("a.fancy_window_preview").fancybox({
                    'type'                  : 'iframe',
                    'width'                 : <?=FANCYBOX_ITEM_PREVIEW_WIDTH?>,
                    'maxHeight'             : <?=FANCYBOX_ITEM_PREVIEW_HEIGHT?>,
                    <? if (THEME_FLAT_FANCYBOX) { ?>
                    'closeBtn'              : false,
                    <? } ?>
                    'padding'               : 0,
                    'margin'                : 0
                });
                     
                //Banner preview
                 $("a.fancy_window_preview_banner").fancybox({
                    <? if (THEME_FLAT_FANCYBOX) { ?>
                    'closeBtn'              : false,
                    <? } ?>
                    'type'                  : 'iframe',
                    'width'                 : 800,
                    'maxHeight'             : 250,
                    'padding'               : 0,
                    'margin'                : 0
                });
                
                //Transaction/Invoice Detail > View custom invoice items / package items
                $("a.fancy_window_custom").fancybox({
                    <? if (THEME_FLAT_FANCYBOX) { ?>
                    'closeBtn'              : false,
                    'padding'               : 0,
                    'maxHeight'             : 500,
                    <? } ?>
                    'type'                  : 'iframe',
                    'width'                 : 620,
                    'height'                : 370
                });
                
                //Print invoice (claim / sign up / billing)
                $("a.fancy_window_invoice").fancybox({
                    'type'                  : 'iframe',
                    'width'                 : 680,
                    'height'                : 580
                });
                
                //Agree terms (claim / signup)
                $("a.fancy_window_terms").fancybox({
                    <? if (THEME_FLAT_FANCYBOX) { ?>
                    'closeBtn'              : false,
                    'padding'               : 0,
                    <? } ?>
                    'type'                  : 'iframe',
                    'width'                 : 650,
                    'maxHeight'             : 500
                });
                
            });
            
		</script>

		
		<? /*DO NOT REMOVE THIS */ ?>
		
		<style type="text/css">

		div.floatLayer {width: 200px; position: absolute; /*top: 0; left: 0;*/ visibility: hidden; background-color: #FCFCFC; border: 2px solid #EEE; height:auto; padding: 5px; z-index: 999;}

			div.floatLayer * {margin: 0; padding: 0;}

				div.floatLayer h3 {font: bold 12px Verdana, Arial, Helvetica, sans-serif; color: #003F7E; text-align: left; padding:3px 0 3px 0;}

				div.floatLayer p {font: normal 10px Verdana, Arial, Helvetica, sans-serif; color: #000; text-align: left; margin: 0; padding: 3px 0 3px 0;}

		</style>
        
        <!--[if lt IE 9]>
        <script src="<?=DEFAULT_URL."/scripts/front/html5shiv.js"?>"></script>
        <script src="<?=DEFAULT_URL."/scripts/jquery/excanvas.compiled.js"?>"></script>
        <![endif]-->
		
	</head>
    <?
    //Custom header for each theme, if needed
    $headerThemePath = THEMEFILE_DIR."/".EDIR_THEME."/layout/members/header.php";
    $checkIE = is_ie(false, $ieVersion);
    if (file_exists($headerThemePath)) {
        
        include($headerThemePath);
        
    } else { ?>

	<body class="body">
        
        <!-- Google Tag Manager code - DO NOT REMOVE THIS CODE  -->
        <?=front_googleTagManager();?>
        
        <? if (DEMO_LIVE_MODE && file_exists(EDIRECTORY_ROOT."/frontend/livebar.php")) {
            include(EDIRECTORY_ROOT."/frontend/livebar.php");
        } ?>
        
		<div id="div_to_share" class="share-box" style="display: none"></div>
        
        <? if (is_ie(true) || ($checkIE && $ieVersion == 7)) { ?>
			<div class="browserMessage">
            	<div class="wrapper">
					<?=system_showText(LANG_IE6_WARNING);?>
                </div>
            </div>
		<? }
		
		/** Float Layer *******************************************************************/
		include(INCLUDES_DIR."/views/view_float_layer.php");
        /**********************************************************************************/
        
		system_increaseVisit(db_formatString(getenv("REMOTE_ADDR")));
		
        include(MEMBERS_EDIRECTORY_ROOT."/layout/usernavbar.php");
        ?>
        
        <div id="header-wrapper">
		
			<div id="header">
		
				<h1 class="logo">
					<a id="logo-link" href="<?=NON_SECURE_URL?>/<?=MEMBERS_ALIAS?>/" target="_parent" <?=(trim(EDIRECTORY_TITLE) ? "title=\"".EDIRECTORY_TITLE."\"" : "")?> <?=system_getHeaderLogo();?>>
						<?=EDIRECTORY_TITLE?>
					</a>
				</h1>
                
			</div>
			
		</div>
        
        <? if (sess_getAccountIdFromSession()) { ?>
        
            <div id="navbar-wrapper">
                
                <? /* NAVBAR WRAP FOR FLUID WIDTH LAYOUT NAVBAR*/ ?>
                <ul id="navbar">
                
					<?
                    $accObj = new Account(sess_getAccountIdFromSession());
                    if ((string_strpos($_SERVER["PHP_SELF"], "".MEMBERS_ALIAS."/signup") === false) && (string_strpos($_SERVER["PHP_SELF"], "".MEMBERS_ALIAS."/claim") === false) && $accObj->getString("is_sponsor") == "y") {
                        ?>
                        
                    	<li <?=((string_strpos($_SERVER["SERVER_NAME"].$_SERVER["PHP_SELF"], $_SERVER["SERVER_NAME"].EDIRECTORY_FOLDER."/".MEMBERS_ALIAS."/index.php") !== false) ? "class=\"menuActived\"" : "")?>><a href="<?=DEFAULT_URL?>/<?=MEMBERS_ALIAS?>/"><?=system_showText(LANG_BUTTON_HOME)?></a></li>
    
                    	<li <?=((string_strpos($_SERVER["PHP_SELF"], "/".MEMBERS_ALIAS."/account/index.php") !== false) ? "class=\"menuActived\"" : "")?>><a href="<?=DEFAULT_URL?>/<?=MEMBERS_ALIAS?>/account/"><?=system_showText(LANG_BUTTON_MANAGE_ACCOUNT)?></a></li>
    
                    	<li <?=((string_strpos($_SERVER["PHP_SELF"], "/".MEMBERS_ALIAS."/help.php") !== false) ? "class=\"menuActived\"" : "")?>><a href="<?=DEFAULT_URL?>/<?=MEMBERS_ALIAS?>/help.php"><?=system_showText(LANG_BUTTON_HELP)?></a></li>
                        
                    	<li><a href="<?=NON_SECURE_URL?>/"><?=system_showText(LANG_LABEL_BACK_TO_SEARCH);?></a></li>
                        
            		<? } ?>
				
                </ul>
                
            </div>
		
		<? } ?>

		<div class="content-wrapper ">
            
            <div class="members" >
                        
    <? } ?>