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
	# * FILE: /sitemgr/layout/header.php
	# ----------------------------------------------------------------------------------------------------

	header("Content-Type: text/html; charset=".EDIR_CHARSET, TRUE);

	header("Accept-Encoding: gzip, deflate");
	header("Expires: Sat, 01 Jan 2000 00:00:00 GMT");
	header("Cache-Control: no-store, no-cache, must-revalidate");
	header("Cache-Control: post-check=0, pre-check", FALSE);
	header("Pragma: no-cache");
    
    if (!$isPopupApprove) {
        setting_get("phpMailer_error", $phpMailer_error);
    }
    setting_get("sitemgr_language", $sitemgr_language);
    $blockMenuTodo = todo_validatePage(true);
    setting_get("appbuilder_pendingdownload", $appPending);
    setting_get("appbuilder_pendingdownload_total", $downloadsPending);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

	<head>

		<?
		customtext_get("header_title", $headertag_title);
		$headertag_title = (($headertag_title) ? ($headertag_title) : (EDIRECTORY_TITLE));
        $checkIE = is_ie(false, $ieVersion);
        if (string_strpos($_SERVER["PHP_SELF"], "content/navigation.php") !== false && $checkIE && $ieVersion == 9) {
            $loadNewJquery = true;
        } elseif ((string_strpos($_SERVER["PHP_SELF"], MAILAPP_FOLDER."/index.php") !== false || string_strpos($_SERVER["PHP_SELF"], SITEMGR_ALIAS."/login.php") !== false || string_strpos($_SERVER["PHP_SELF"], SITEMGR_ALIAS."/forgot.php") !== false) && $checkIE && $ieVersion < 10) {
            $loadNewJquery = true;
            $placeHolderFix = true;
        } elseif (string_strpos($_SERVER["PHP_SELF"], "/prefs/theme.php") !== false && $checkIE && $ieVersion < 9) {
            $loadNewJquery = true;
        } elseif (string_strpos($_SERVER["PHP_SELF"], "/leadeditor.php") !== false) {
            $loadNewJquery = true;
        } else {
            $loadNewJquery = false;
        }
		?>

		<title><?= ((string_strpos($_SERVER["PHP_SELF"], "registration.php")) ? '' : system_showText(LANG_SITEMGR_HOME_WELCOME). " - ") . $headertag_title?></title>

		<meta name="author" content="Arca Solutions" />

		<meta http-equiv="Content-Type" content="text/html; charset=<?=EDIR_CHARSET;?>" />

		<meta name="ROBOTS" content="noindex, nofollow" />

		<? if ($facebookScript) {
			echo Facebook::getMetaTags("admins", FACEBOOK_USER_ID);
			echo Facebook::getMetaTags("app_id", FACEBOOK_API_ID);
		} ?>

		<?=system_getNoImageStyle($cssfile = true);?>
        
        <?=system_getFavicon();?>
<!-- 
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet"> -->

        <? /* JQUERY FANCYBOX STYLE*/?>
        <link rel="stylesheet" href="<?=DEFAULT_URL?>/scripts/jquery/fancybox/jquery.fancybox-1.3.4.css" type="text/css" media="all" />
		<? /* JQUERY Jcrop STYLE */?>
        <link rel="stylesheet" href="<?=DEFAULT_URL?>/scripts/jquery/jcrop/css/jquery.Jcrop.css" type="text/css" />
        <? /* GENERAL STYLE */?>
        <link href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/layout/general_sitemgr.css" rel="stylesheet" type="text/css" />
        <link href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/layout/style.css" rel="stylesheet" type="text/css" />
		<? /* LOGIN & FORGOT STYLE*/?>
		<? if ((string_strpos($_SERVER["PHP_SELF"], "/login.php") !== false) || (string_strpos($_SERVER["PHP_SELF"], "/".SITEMGR_ALIAS."/forgot.php") !== false)) { ?>
			<link href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/layout/login.css" rel="stylesheet" type="text/css" />
		<? } ?>
        <? /* JQUERY UI SMOOTHNESS STYLE */?>
        <link type="text/css" href="<?=DEFAULT_URL?>/scripts/jquery/jquery_ui/css/smoothness/jquery-ui-1.7.2.custom.css" rel="stylesheet" />
		<? /* JQUERY AUTO COMPLETE STYLE  */?>
		<link type="text/css" href="<?=DEFAULT_URL?>/scripts/jquery/jquery.autocomplete.css" rel="stylesheet" media="all" />

        <? if ((string_strpos($_SERVER["PHP_SELF"], "/theme.php") !== false)) { ?>
            <link href="<?=DEFAULT_URL?>/scripts/jquery/auto_upload/css/style.css" rel="stylesheet" type="text/css"></link>
        <? } ?>

        <script type="text/javascript">
		<!--
		DEFAULT_URL = "<?=DEFAULT_URL?>";
        SITEMGR_ALIAS = "<?=SITEMGR_ALIAS?>";
		-->
		</script>

        <script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/specialChars.js"></script>
        <script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/common.js"></script>
		<script type="text/javascript" src="<?=language_getFilePath($sitemgr_language, true);?>"></script>
		<script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/location.js"></script>
        
        <? if (!$loadNewJquery) { ?>
            <script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/jquery.js"></script>
        <? } else { 
           /*Loading the New Version of jQuery and UI just to navigation configuration work fine in IE9*/ ?>
            <link type="text/css" href="<?=DEFAULT_URL?>/scripts/jquery/jquery.1.5.2/jquery.ui.css" rel="stylesheet" />
            <script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/jquery/jquery.1.5.2/jquery.js"></script>
            <script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/jquery/jquery.1.5.2/jquery.ui.js"></script>
        <? } ?>
            
		<script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/ajax-search.js"></script>
        <script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/jquery/jcrop/js/jquery.Jcrop.js"></script>
        <script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/jquery/fancybox/jquery.fancybox-1.3.4.js"></script>
        
        <? if (!$loadNewJquery) { ?>
            <script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/jquery/jquery_ui/js/jquery-ui-1.7.2.custom.min.js"></script>
        <? } ?>
        
        <? if ($sitemgr_language != "en_us") { ?>
            <? /* DATA PICKER TRANSLATION */?>
            <script type="text/javascript" src="<?=language_getDatePickPath($sitemgr_language);?>"></script>
        <? } ?>
            
		<script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/jquery/jquery.autocomplete.js"></script>
        <script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/jquery/jquery.maskedinput-1.3.min.js"></script>
		<script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/jquery/jquery.textareaCounter.plugin.js"></script>
		<script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/jquery/jquery.hoverIntent.js"></script>
		<script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/jquery/jquery.cookie.min.js"></script>         
		<script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/bulkupdate.js"></script>
        <script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/domain.js"></script>
		
		<? if (string_strpos($_SERVER["PHP_SELF"], "colorscheme") !== false || string_strpos($_SERVER["PHP_SELF"], "step3") !== false) { ?>
		
			<link rel="stylesheet" href="<?=DEFAULT_URL?>/scripts/jquery/colorpicker/css/colorpicker.css" type="text/css" />
			<link rel="stylesheet" href="<?=DEFAULT_URL?>/scripts/jquery/colorpicker/css/layout.css" type="text/css" />

			<script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/jquery/colorpicker/colorpicker.js"></script>
			<script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/jquery/colorpicker/eye.js"></script>
			<script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/jquery/colorpicker/utils.js"></script>
			<script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/jquery/colorpicker/layout.js?ver=1.0.2"></script>

		<? } ?>
            
        <? if (string_strpos($_SERVER["PHP_SELF"], "htmleditor") !== false) { ?>
            
            <script language="javascript" type="text/javascript" src="<?=DEFAULT_URL?>/scripts/editarea/edit_area/edit_area_full.js"></script>
        
        <? } ?>
            
        <? if (string_strpos($_SERVER["PHP_SELF"], "leadeditor.php") !== false) { ?>
            
            <script src="<?=DEFAULT_URL?>/scripts/jquery/formbuilder/jquery.formbuilder.js"></script>
            <script src="<?=DEFAULT_URL?>/scripts/jquery/formbuilder/lang/<?=$sitemgr_language?>.js"></script>
        
        <? } ?>
            
        <? if (string_strpos($_SERVER["PHP_SELF"], "import/index.php") !== false) { ?>
            <script type="text/javascript" src="<?=DEFAULT_URL;?>/scripts/jquery/jquery.csv2table.js"></script>
        <? } ?>
            
        <? if (string_strpos($_SERVER["PHP_SELF"], "getstarted.php") !== false) { ?>
            <link rel="stylesheet" href="<?=DEFAULT_URL?>/scripts/jquery/progressbar/jquery.progressbar.css" type="text/css" />
            <script type="text/javascript" src="<?=DEFAULT_URL;?>/scripts/jquery/progressbar/jquery.progressbar.js"></script>
        <? } ?>
            
        <? if ($placeHolderFix) { ?>
            <script type="text/javascript" src="<?=DEFAULT_URL;?>/scripts/jquery/jquery.placeholder.min.js"></script>
        <? } ?>
		
		<script type="text/javascript">
			var show = false;

			function searchResetSitemgr(form) {
				tot = form.elements.length;
				for (i=0;i<tot;i++) {
					if (form.elements[i].type == 'text') {
						form.elements[i].value = "";
					} else if (form.elements[i].type == 'checkbox' || form.elements[i].type == 'radio') {
						form.elements[i].checked = false;
					} else if (form.elements[i].type == 'select-one') {
						form.elements[i].selectedIndex = 0;
					}
				}
			}

			function validateQuickSearch() {
				if ($('#QS_searchFor').val() == 'All') {
					if (($('#QS_keywords').val() == '')||($('#QS_keywords').val() == "<?=string_ucwords(system_showText(LANG_SITEMGR_SEARCH))?>")) {
                        fancy_alert('<?=system_showText(LANG_SITEMGR_SEARCH_FIELDS_EMPTY);?>', 'errorMessage', false, 600, 100, false);
                        return false;
					}
				}
				return true;
			}
            
            function searchSubmit () {
                if (validateQuickSearch()) {
                    if ($('#QS_keywords').val() == "<?=string_ucwords(system_showText(LANG_SITEMGR_SEARCH))?>"){
                        $("#QS_keywords").attr('value', '');
                    }
                    document.getElementById('formSearchHome').submit();
                }
            }
				
			function addClass(item) {
				$("#privateMenu_"+item).addClass('submenu_active');
			}

			$(document).ready(function() {
                                              
				$("#QS_keywords").focus(function() {
					$("#QS_keywords").attr('value', '');
				});

				$("#QS_keywords").blur(function() {
					if (!$("#QS_keywords").val()) {
						$("#QS_keywords").attr('value', '<?=string_ucwords(system_showText(LANG_SITEMGR_SEARCH))?>');
                    }
				});

				$("#searchLink").click(function () {
					if (show == false) {
						$("#searchAll").fadeIn('slow');
						show = true;
					} else {
						$("#searchAll").fadeOut('slow');
						show = false;
					}
				});
                
                //Support > Feedback
                $("a.fancy_window_feedback").fancybox({
                    'overlayShow'			: true,
                    'overlayOpacity'		: 0.75,
                    'autoDimensions'        : false,
                    'width'                 : 400,
                    'height'                : 470,
                    'titleShow'             : false
                });
              
                //General popups. Ex: Settings > eDirectory API > Api help
                $("a.fancy_window").fancybox({
                    'hideOnContentClick'	: false,
                    'overlayShow'			: true,
                    'overlayOpacity'		: 0.75,
                    'frameWidth'			: 560,
                    'frameHeight'			: 550,
                    'titleShow'             : false
                });
                
                //Support > About eDirectory
                $("a.fancy_window_about").fancybox({
                    'type'                  : 'iframe',
                    'hideOnContentClick'	: false,
                    'overlayShow'			: true,
                    'overlayOpacity'		: 0.75,
                    'width'                 : 595,
                    'height'                : 570,
                    'autoDimensions'        : false,
                    'autoScale'             : false,
                    'titleShow'             : false
                });
                
                //Site Content > Custom > Get URL
                $("a.fancy_window_small").fancybox({
                    'hideOnContentClick'	: false,
                    'overlayShow'			: true,
                    'overlayOpacity'		: 0.75,
                    'width'                 : 550,
                    'height'                : 150,
                    'titleShow'             : false
                });
                        
                //Modules preview (except for banners)
                $("a.fancy_window_preview").fancybox({
                    'overlayShow'			: true,
                    'overlayOpacity'		: 0.75,
                    'width'                 : <?=FANCYBOX_ITEM_PREVIEW_WIDTH?>,
                    'height'                : <?=FANCYBOX_ITEM_PREVIEW_HEIGHT?>,
                    'titleShow'             : false
                });
                                
                //Banner preview
                $("a.fancy_window_preview_banner").fancybox({
                    'overlayShow'			: true,
                    'overlayOpacity'		: 0.75,
                    'width'                 : 800,
                    'height'                : 210,
                    'titleShow'             : false
                });
                
                //Transaction/Invoice Detail > View custom invoice items / package items
                $("a.fancy_window_custom").fancybox({
                    'overlayShow'			: true,
                    'overlayOpacity'		: 0.75,
                    'width'                 : 620,
                    'height'                : 370,
                    'titleShow'             : false
                });
                                 
                //Settings > Invoice Information > Preview Invoice
                $("a.fancy_window_auto").fancybox({
                    'overlayShow'			: true,
                    'overlayOpacity'		: 0.75,
                    'autoDimensions'        : true,
                    'titleShow'             : false
                });
                       
                //Site Content > CSS Editor > Show Source
                $("a.fancy_window_htmleditor").fancybox({
                    'overlayShow'			: true,
                    'overlayOpacity'		: 0.75,
                    'width'                 : 780,
                    'height'                : 550,
                    'titleShow'             : false
                });
                
                //Site Content > CSS Editor > Alert First Change
                $("a.fancy_window_htmleditor2").fancybox({
                    'overlayShow'			: true,
                    'overlayOpacity'		: 0.75,
                    'width'                 : 400,
                    'height'                : 230,
                    'modal'                 : true,
                    'titleShow'             : false
                });
                
                //Email sending configuration warning
                $("a.fancy_window_phpMailer").fancybox({
                    'overlayShow'			: true,
                    'overlayOpacity'		: 0.75,
                    'width'                 : 400,
                    'height'                : 230,
                    'titleShow'             : false
                });

                //Config Checker > Cron log > View history.
                $("a.fancy_window_cronlog").fancybox({
                    'overlayShow'			: true,
                    'overlayOpacity'		: 0.75,
                    'width'                 : 500,
                    'height'                : 330,
                    'titleShow'             : false
                });
                           
                //Dashboard > Approve items
                $("a.fancy_window_popupToapprove").fancybox({
                    'overlayShow'			: true,
                    'overlayOpacity'		: 0.75,
                    'width'                 : 680,
                    'height'                : 350,
                    'titleShow'             : false
                });
                
                <? if ($phpMailer_error && !DEMO_LIVE_MODE && string_strpos($_SERVER["PHP_SELF"], "/prefs/emailconfig.php") === false && string_strpos($_SERVER["PHP_SELF"], "/support/") === false && string_strpos($_SERVER["PHP_SELF"], "/registration.php") === false && string_strpos($_SERVER["PHP_SELF"], "/login.php") === false) { ?>
                    $("#phpMailer_window").attr("href", '<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/configMail.php');
                    $("#phpMailer_window").trigger("click");
                <? }
                
                if ($placeHolderFix) { ?>
                    $('input').placeholder();
                <? } ?>                          
			});
		</script>

        <link href="<?=DEFAULT_URL?>/sitemgr/layout/custom.css" rel="stylesheet" type="text/css"></link>
        <!--[if lt IE 9]>
        <script src="<?=DEFAULT_URL."/scripts/front/html5shiv.js"?>"></script>
        <![endif]-->

        <?if(strpos($_SERVER['PHP_SELF'], "listing")){?>
        <!-- Added Google Map Script -->
        <script src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>

        <? } ?>
        
	</head>

	 <!--[if lt IE 9]><body class="ie"><![endif]-->
     <!-- [if false]><body><![endif]-->
     
    <? if (DEMO_LIVE_MODE && file_exists(EDIRECTORY_ROOT."/frontend/livebar.php")) {
        include(EDIRECTORY_ROOT."/frontend/livebar.php");
    }
	/*
	 * Get Domains
	 */
	$domainDropDown = domain_getDropDown(DEFAULT_URL, $_SERVER["REQUEST_URI"], $_SERVER["QUERY_STRING"], SELECTED_DOMAIN_ID);
	
    if ((is_ie(true)|| ($checkIE && $ieVersion == 7)) && !$isPopupApprove) { ?>
        <div class="browserMessage">
            <div class="wrapper">
				<?=system_showText(LANG_IE6_WARNING);?>
            </div>
        </div>
    <? } ?>
    
    <div class="site-content">
        
        <div class="wrapper">

            <? if (!$isPopupApprove) { ?>
            
            <div class="small-header">

                <div class="container-box">

                <? if (!$_SESSION[SM_LOGGEDIN]) { ?>
                    <h1 class="brand"><?=string_ucwords(system_showText(LANG_SITEMGR_SITE_SIGNIN))?></h1>
                <? }
                
                if ($_SESSION[SM_LOGGEDIN] && string_strpos($_SERVER["PHP_SELF"], "registration.php") === false) { ?>
                    <h1 class="brand">
                        <div class="logo">
                            <a href="<?=DEFAULT_URL?>/index.php" target="_parent" <?=(trim(EDIRECTORY_TITLE) ? "title=\"".EDIRECTORY_TITLE."\"" : "")?>>
                                <img src="<?=system_getHeaderLogoSitemgr();?>"/>
                            </a>
                        </div>
                    </h1>
                <? }
                
                if (sess_isSitemgrLogged() && (string_strpos($_SERVER["PHP_SELF"], "registration.php") === false)) { ?>

                    <ul class="nav-header">
                      
                        <? if ($_SESSION["is_arcalogin"]) { ?>
                            <li>
                                <a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/support/index.php">Config Checker</a>
                            </li>
                        <? }
                        
                        if (!$blockMenuTodo) { ?>

                            <li>
                                <a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/"><?=system_showText(LANG_SITEMGR_DASHBOARD);?></a>
                            </li>

                            <? if (permission_hasSMPermSection(SITEMGR_PERMISSION_ACCOUNTS)) { ?>

                                <li class="title-dropdown">
                                    
                                    <a href="javascript:void(0);"><?=system_showText(LANG_SITEMGR_NAVBAR_ACCOUNTS)?></a>
                                    
                                    <ul class="nav-dropdown">
                                        
                                        <li class="nav-header"><?=(SOCIALNETWORK_FEATURE == "on" ? system_showText(LANG_SITEMGR_LABEL_SPONSOR) : system_showText(LANG_SITEMGR_SPONSORACCOUNTS));?></li>
                                        <li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/account/index.php"><?=system_showText(LANG_SITEMGR_MANAGE);?></a></li>
                                        <li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/account/account.php"><?=system_showText(LANG_SITEMGR_ADD);?></a></li>
                                        <li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/account/search.php"><?=system_showText(LANG_SITEMGR_SEARCH);?></a></li>
                                        <hr>
                                        <li class="nav-header"><?=system_showText(LANG_SITEMGR_NAVBAR_SITEMGRACCOUNTS);?></li>
                                        <li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/smaccount/index.php"><?=system_showText(LANG_SITEMGR_MANAGE);?></a></li>
                                        <li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/smaccount/smaccount.php"><?=system_showText(LANG_SITEMGR_ADD);?></a></li>
                                        <li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/smaccount/search.php"><?=system_showText(LANG_SITEMGR_SEARCH);?></a></li>
                                  
                                    </ul>

                                </li>

                            <? }
                            
                            if (permission_hasSMPermSection(SITEMGR_PERMISSION_DOMAIN)) { ?>
                                <li class="title-dropdown">
                                    <a href="javascript:void(0);"><?=system_showText(LANG_SITEMGR_NAVBAR_DOMAIN_PLURAL);?></a>
                                    <ul class="nav-dropdown">
                                        <li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/domain/index.php"><?=system_showText(LANG_SITEMGR_MANAGE);?></a></li>
                                        <li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/domain/domain.php"><?=system_showText(LANG_SITEMGR_ADD);?></a></li>
                                    </ul>
                                </li>
                            <? }
                            
                        } ?>
                    </ul>

                    <ul class="nav-header nav-right">
                       
                        <? if ($appPending == "yes") { ?>
                            <a href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/mobile/appbuilder/connect.php?download=yes"?>" target="_blank" title="<?=str_replace("[x]", $downloadsPending, system_showText(($downloadsPending == 1 ? LANG_SITEMGR_BUILDER_APPREADY_SING : LANG_SITEMGR_BUILDER_APPREADY)));?>"><i class="sitemgr-icon-phone"><span><?=$downloadsPending?></span></i></a>
                        <? } ?>

                        <li class="title-dropdown">

                            <a href="javascript:void(0);"><i class="sitemgr-icon-gear"></i></a>
                            
                            <ul class="nav-dropdown">
                                <li><a href="http://support.edirectory.com/" target="_blank"><?=system_showText(LANG_SITEMGR_EDIRECTORYMANUAL)?></a></li>
                                <li><a class="iframe fancy_window_feedback" href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/feedback.php"><?=system_showText(LANG_SITEMGR_FEEDBACK)?></a></li>
                                <li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/faq/faq.php"><?=system_showText(LANG_SITEMGR_MENU_FAQ)?></a></li>
                                <? if (!$blockMenuTodo) { ?>
                                    <li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/sitemap.php"><?=system_showText(LANG_SITEMGR_LABEL_SITEMAP)?></a></li>
                                <? } ?>
                                <li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/about.php" class="fancy_window_about"><?=system_showText(LANG_SITEMGR_MENU_ABOUT)?></a></li>
                                <hr>          
                                <li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/manageaccount.php"><?=system_showText(LANG_SITEMGR_MENU_MYACCOUNT)?></a></li>
                                <li><a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/logout.php"><?=system_showText(LANG_SITEMGR_MENU_LOGOUT)?></a></li>
                            </ul>
                        </li>

                        <li class="nav-highlight">
                            <a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/domain/domain.php"><?=system_showText(LANG_SITEMGR_ADD);?> <?=system_showText(LANG_SITEMGR_DOMAIN_SING)?></a>
                        </li>

                    </ul> 
                    
                  <? }
                  
                    $activeMenuAccounts = false;
                    $activeMenuDomains = false;
                    $activeMenuDasboard = (string_strpos($_SERVER["PHP_SELF"], "".SITEMGR_ALIAS."/index.php") || string_strpos($_SERVER["PHP_SELF"], "".SITEMGR_ALIAS."/dashboard.php"));

                    if (string_strpos($_SERVER["PHP_SELF"], "".SITEMGR_ALIAS."/account")) $activeMenuAccounts = true;
                    elseif (string_strpos($_SERVER["PHP_SELF"], "".SITEMGR_ALIAS."/account/account.php")) $activeMenuAccounts = true;
                    elseif (string_strpos($_SERVER["PHP_SELF"], "".SITEMGR_ALIAS."/account/search.php")) $activeMenuAccounts = true;
                    elseif (string_strpos($_SERVER["PHP_SELF"], "".SITEMGR_ALIAS."/smaccount")) $activeMenuAccounts = true;
                    elseif (string_strpos($_SERVER["PHP_SELF"], "".SITEMGR_ALIAS."/smaccount/smaccount.php")) $activeMenuAccounts = true;
                    elseif (string_strpos($_SERVER["PHP_SELF"], "".SITEMGR_ALIAS."/smaccount/search.php")) $activeMenuAccounts = true;
                    elseif (string_strpos($_SERVER["PHP_SELF"], "".SITEMGR_ALIAS."/manageaccount.php")) $activeMenuAccounts = true;
                    elseif (string_strpos($_SERVER["PHP_SELF"], "".SITEMGR_ALIAS."/domain")) $activeMenuDomains = true;
                    elseif (string_strpos($_SERVER["PHP_SELF"], "".SITEMGR_ALIAS."/domain/domain.php")) $activeMenuDomains = true;

                    $url_header = $_SERVER["PHP_SELF"];
                    $url_header = string_substr ($url_header, string_strlen ($url_header)-18, 18 );
                    ?>

                    <a href="#" id="phpMailer_window" class="iframe fancy_window_phpMailer" style="display:none" title=""></a>

                </div>
                
			</div>
            
            <? } ?>
            
			<span class="clear"></span>
            
			<div class="content">