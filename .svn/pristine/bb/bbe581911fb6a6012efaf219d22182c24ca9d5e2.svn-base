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
	# * FILE: /sitemgr/prefs/levels.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

    # ----------------------------------------------------------------------------------------------------
    # VALIDATE FEATURE
    # ----------------------------------------------------------------------------------------------------
    if (ABLE_RENAME_LEVEL != "on") { exit; }
        
	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	extract($_POST);
	extract($_GET);	
    
    //Validate modules
    if (!$module) {
        $module = "listing";
    } else {
        $availableModules = array();
        $availableModules[] = "listing";
        if (EVENT_FEATURE == "on") {
            $availableModules[] = "event";
        }
        if (BANNER_FEATURE == "on") {
            $availableModules[] = "banner";
        }
        if (CLASSIFIED_FEATURE == "on") {
            $availableModules[] = "classified";
        }
        if (ARTICLE_FEATURE == "on") {
            $availableModules[] = "article";
        }
        if (!in_array($module, $availableModules)) {
            header("Location: ".DEFAULT_URL."/".SITEMGR_ALIAS."/prefs/levels.php");
            exit;
        }
    }

	//increases frequently actions
	if (!isset($activeLevel)) system_setFreqActions('prefs_managelevel', 'prefslevels');
    
	// Default CSS class for message
	$message_style = "successMessage";

    if ($module == "listing") {
        setting_get('review_listing_enabled', $review_listing_enabled);
    }

	if ($_SERVER['REQUEST_METHOD'] == "POST") {

        if ($changeType == "names") {
            
            // Listing Level Names
            if ($_POST["listinglevelnames"]) {

                if (validate_form("listinglevelnames", $_POST, $error)) {

                    $levelObj = new ListingLevel(true);
                    $levelsArray = $levelObj->getLevelValues();
                    foreach ($levelsArray as $levelValue) {

                        if (!isset($nameLevel[$levelValue])) { $nameLevel[$levelValue] = ""; }
                        if (!isset($activeLevel[$levelValue])) { $activeLevel[$levelValue] = "n"; }
                        if (!isset($popularLevel[$levelValue])) { $popularLevel[$levelValue] = "n"; }

                        $levelObj->updateValues(string_strtolower($nameLevel[$levelValue]), $activeLevel[$levelValue], "", "", "", "", "", "", "", $levelValue, "names", $popularLevel[$levelValue]);
                    }

                } else {
                    $actions[] = $error;
                    $message_style = "errorMessage";
                }

                if (!$error) {
                    header("Location: ".DEFAULT_URL."/".SITEMGR_ALIAS."/prefs/levels.php?message=0&module=listing");
                    exit;
                } else {
                    $message_style = "errorMessage";
                }

                if ($actions) {
                    $message_listinglevelnames = implode('<br />', $actions);
                }

            }

            // Event Level Names
            else if($_POST["eventlevelnames"]) {

                if (validate_form("eventlevelnames", $_POST, $error)) {

                    $levelObj = new EventLevel(true);
                    $levelsArray = $levelObj->getLevelValues();
                    foreach ($levelsArray as $levelValue) {

                        if (!isset($nameLevel[$levelValue])) { $nameLevel[$levelValue] = ""; }
                        if (!isset($activeLevel[$levelValue])) { $activeLevel[$levelValue] = "n"; }
                        if (!isset($popularLevel[$levelValue])) { $popularLevel[$levelValue] = "n"; }

                        $levelObj->updateValues(string_strtolower($nameLevel[$levelValue]), $activeLevel[$levelValue], "", "", $levelValue, "names", $popularLevel[$levelValue]);
                    }

                } else {
                    $actions[] = $error;
                    $message_style = "errorMessage";
                }

                if (!$error) {
                    header("Location: ".DEFAULT_URL."/".SITEMGR_ALIAS."/prefs/levels.php?message=0&module=event");
                    exit;
                } else {
                    $message_style = "errorMessage";
                }

                if ($actions) {
                    $message_eventlevelnames .= implode('<br />', $actions);
                }

            }

            // Banner Level Names
            else if($_POST["bannerlevelnames"]) {

                if (validate_form("bannerlevelnames", $_POST, $error)) {

                    $levelObj = new BannerLevel(true);
                    $levelsArray = $levelObj->getLevelValues();
                    foreach ($levelsArray as $levelValue) {

                        if (!isset($nameLevel[$levelValue])) { $nameLevel[$levelValue] = ""; }
                        if (!isset($activeLevel[$levelValue])) { $activeLevel[$levelValue] = "n"; }
                        if (!isset($popularLevel[$levelValue])) { $popularLevel[$levelValue] = "n"; }

                        $levelObj->updateValues(string_strtolower($nameLevel[$levelValue]), $activeLevel[$levelValue], $levelValue, $popularLevel[$levelValue]);
                    }

                } else {
                    $actions[] = $error;
                    $message_style = "errorMessage";
                }

                if (!$error) {
                    header("Location: ".DEFAULT_URL."/".SITEMGR_ALIAS."/prefs/levels.php?message=0&module=banner");
                    exit;
                } else {
                    $message_style = "errorMessage";
                }

                if ($actions) {
                    $message_bannerlevelnames .= implode('<br />', $actions);
                }

            }

            // Classified Level Names
            else if($_POST["classifiedlevelnames"]) {

                if (validate_form("classifiedlevelnames", $_POST, $error)) {

                    $levelObj = new ClassifiedLevel(true);
                    $levelsArray = $levelObj->getLevelValues();
                    foreach ($levelsArray as $levelValue) {

                        if (!isset($nameLevel[$levelValue])) { $nameLevel[$levelValue] = ""; }
                        if (!isset($activeLevel[$levelValue])) { $activeLevel[$levelValue] = "n"; }
                        if (!isset($popularLevel[$levelValue])) { $popularLevel[$levelValue] = "n"; }

                        $levelObj->updateValues(string_strtolower($nameLevel[$levelValue]), $activeLevel[$levelValue], "", "", $levelValue, "names", $popularLevel[$levelValue]);
                    }

                } else {
                    $actions[] = $error;
                    $message_style = "errorMessage";
                }

                if (!$error) {
                    header("Location: ".DEFAULT_URL."/".SITEMGR_ALIAS."/prefs/levels.php?message=0&module=classified");
                    exit;
                } else {
                    $message_style = "errorMessage";
                }

                if ($actions) {
                    $message_classifiedlevelnames .= implode('<br />', $actions);
                }

            }

            // Article Level Names
            else if($_POST["articlelevelnames"]) {

                if (validate_form("articlelevelnames", $_POST, $error)) {

                    $levelObj = new ArticleLevel(true);
                    $levelsArray = $levelObj->getLevelValues();
                    foreach ($levelsArray as $levelValue) {

                        if (!isset($nameLevel[$levelValue])) { $nameLevel[$levelValue] = ""; }
                        if (!isset($activeLevel[$levelValue])) { $activeLevel[$levelValue] = "n"; }

                        $levelObj->updateValues(string_strtolower($nameLevel[$levelValue]), $activeLevel[$levelValue], "", $levelValue, "names");
                    }

                } else {
                    $actions[] = $error;
                    $message_style = "errorMessage";
                }

                if (!$error) {
                    header("Location: ".DEFAULT_URL."/".SITEMGR_ALIAS."/prefs/levels.php?message=0&module=article");
                    exit;
                } else {
                    $message_style = "errorMessage";
                }

                if ($actions) {
                    $message_articlelevelnames .= implode('<br />', $actions);
                }

            }
            
        } elseif ($changeType == "fields") {
                       
            // Listing Level Fields
            if ($_POST["listinglevelfields"]) {

                $levelObj = new ListingLevel(true);
                $levelsArray = $levelObj->getLevelValues();
                foreach ($levelsArray as $levelValue) {

                    //Updates values for table ListingLevel
                    if (!isset($hasPromotion[$levelValue])) { $hasPromotion[$levelValue] = "n"; } else { $hasPromotionCheck = true; }
                    if (!isset($hasReview[$levelValue])) { $hasReview[$levelValue] = "n"; }
                    if (!isset($hasSms[$levelValue])) { $hasSms[$levelValue] = "n"; }
                    if (!isset($hasCall[$levelValue])) { $hasCall[$levelValue] = "n"; }
                    if (!isset($backlink[$levelValue])) { $backlink[$levelValue] = "n"; }
                    if (!isset($detail[$levelValue])) { $detail[$levelValue] = "n"; }
                    
                    // modification
                    if ( !isset($replyReview[$levelValue]) ) {
                        $replyReview[$levelValue] = 'n';
                    }
                    if ( !isset($openCase[$levelValue]) ) {
                        $openCase[$levelValue] = 'n';
                    }
                    //Images
                    $auxImages = 0;
                    if ($images[$levelValue] <= 0) { //no main image, no gallery
                        $auxImages = 0;
                    } elseif ($images[$levelValue] == 1) { //only main image, no gallery
                        $auxImages = 0;
                        $_POST["itemLevel_main_image"][$levelValue] = true;
                    } elseif ($images[$levelValue] > 1) { //main image + gallery
                        $auxImages = --$images[$levelValue];
                        $_POST["itemLevel_main_image"][$levelValue] = true;
                    }

                    $levelObj->updateValues("", "", $hasPromotion[$levelValue], $hasReview[$levelValue], $hasSms[$levelValue], $hasCall[$levelValue], $backlink[$levelValue], $detail[$levelValue], $auxImages, $levelValue, "fields", "", $replyReview[$levelValue], $openCase[$levelValue] );
                }
                
                //Updates values for table ListingLevel_Field
                system_updateFormFields($_POST, "Listing");

                //Updates promotion setting
                if ($hasPromotionCheck) {
                    if(!setting_set("custom_has_promotion", "on")) {
                        if(!setting_new("custom_has_promotion", "on")) {
                            $error = true;
                        }
                    }
                } else {
                    if(!setting_set("custom_has_promotion", "")) {
                        if(!setting_new("custom_has_promotion", "")) {
                            $error = true;
                        }
                    }
                }

                if (!$error) {
                    header("Location: ".DEFAULT_URL."/".SITEMGR_ALIAS."/prefs/levels.php?msg=0&module=listing");
                    exit;
                } else {
                    $message_style = "errorMessage";
                }

                if ($actions) {
                    $message_listinglevelnames = implode('<br />', $actions);
                }

            }

            // Event Level Fields
            else if($_POST["eventlevelfields"]) {

                $levelObj = new EventLevel(true);
                $levelsArray = $levelObj->getLevelValues();
                foreach ($levelsArray as $levelValue) {

                    if (!isset($detail[$levelValue])) { $detail[$levelValue] = "n"; }
                    
                    //Images
                    $auxImages = 0;
                    if ($images[$levelValue] <= 0) { //no main image, no gallery
                        $auxImages = 0;
                    } elseif ($images[$levelValue] == 1) { //only main image, no gallery
                        $auxImages = 0;
                        $_POST["itemLevel_main_image"][$levelValue] = true;
                    } elseif ($images[$levelValue] > 1) { //main image + gallery
                        $auxImages = --$images[$levelValue];
                        $_POST["itemLevel_main_image"][$levelValue] = true;
                    }
                    
                    $levelObj->updateValues("", "", $detail[$levelValue], $auxImages, $levelValue, "fields");
                }
                
                //Updates values for table EventLevel_Field
                system_updateFormFields($_POST, "Event");

                if (!$error) {
                    header("Location: ".DEFAULT_URL."/".SITEMGR_ALIAS."/prefs/levels.php?msg=0&module=event");
                    exit;
                } else {
                    $message_style = "errorMessage";
                }

                if ($actions) {
                    $message_eventlevelnames .= implode('<br />', $actions);
                }

            }
            
            // Classified Level Fields
            else if($_POST["classifiedlevelfields"]) {

                $levelObj = new ClassifiedLevel(true);
                $levelsArray = $levelObj->getLevelValues();
                foreach ($levelsArray as $levelValue) {

                    if (!isset($detail[$levelValue])) { $detail[$levelValue] = "n"; }
                    
                    //Images
                    $auxImages = 0;
                    if ($images[$levelValue] <= 0) { //no main image, no gallery
                        $auxImages = 0;
                    } elseif ($images[$levelValue] == 1) { //only main image, no gallery
                        $auxImages = 0;
                        $_POST["itemLevel_main_image"][$levelValue] = true;
                    } elseif ($images[$levelValue] > 1) { //main image + gallery
                        $auxImages = --$images[$levelValue];
                        $_POST["itemLevel_main_image"][$levelValue] = true;
                    }
                    
                    $levelObj->updateValues("", "", $detail[$levelValue], $auxImages, $levelValue, "fields");
                }
                
                //Updates values for table ClassifiedLevel_Field
                system_updateFormFields($_POST, "Classified");

                if (!$error) {
                    header("Location: ".DEFAULT_URL."/".SITEMGR_ALIAS."/prefs/levels.php?msg=0&module=classified");
                    exit;
                } else {
                    $message_style = "errorMessage";
                }

                if ($actions) {
                    $message_classifiedlevelnames .= implode('<br />', $actions);
                }

            }
            
//            // Article Level Fields
//            else if($_POST["articlelevelfields"]) {
//
//                $levelObj = new ArticleLevel(true);
//                $levelsArray = $levelObj->getLevelValues();
//                foreach ($levelsArray as $levelValue) {
//                                      
//                    $levelObj->updateValues("", "", $images[$levelValue], $levelValue, "fields");
//                }
//
//                if (!$error) {
//                    header("Location: ".DEFAULT_URL."/".SITEMGR_ALIAS."/prefs/levels.php?msg=0&module=article");
//                    exit;
//                } else {
//                    $message_style = "errorMessage";
//                }
//
//                if ($actions) {
//                    $message_articlelevelnames .= implode('<br />', $actions);
//                }
//
//            }
        }
        
        // For Priority
        if ( isset($_POST['prioritySubmit']) ) {
            setting_set( 'listing_detail_priority_one',$_POST['priority-one'] );
            setting_set( 'listing_detail_priority_two',$_POST['priority-two'] );
            setting_set( 'listing_detail_priority_three',$_POST['priority-three'] );
            setting_set( 'listing_detail_priority_four',$_POST['priority-four'] );

            //Enable Disable
            setting_set( 'listing_detail_show_facebook', $_POST['listing_detail_show_facebook']);
            setting_set( 'listing_detail_show_twitter', $_POST['listing_detail_show_twitter']);
            setting_set( 'listing_detail_show_recentreview', $_POST['listing_detail_show_recentreview']);
            setting_set( 'listing_detail_show_banner', $_POST['listing_detail_show_banner']);
        }
	}

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/header.php");

	# ----------------------------------------------------------------------------------------------------
	# NAVBAR
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/navbar.php");

?>

    <div id="main-right">

        <div id="top-content">
            <div id="header-content">
                <h1><?=ucfirst(system_showText(LANG_SITEMGR_SETTINGS_SITEMGRSETTINGS))?> - <?=string_ucwords(system_showText(LANG_SITEMGR_SETTINGS_LEVELS))?></h1>
            </div>
        </div>

        <div id="content-content">
            <div class="default-margin">

                <? require(EDIRECTORY_ROOT."/".SITEMGR_ALIAS."/registration.php"); ?>
                <? require(EDIRECTORY_ROOT."/includes/code/checkregistration.php"); ?>
                <? require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>

                <? include(INCLUDES_DIR."/tables/table_levels_submenu.php"); ?>

                <? include(INCLUDES_DIR."/forms/form_levelname.php"); ?>

            </div>
        </div>

        <div id="bottom-content">
            &nbsp;
        </div>

    </div>

    <script type="text/javascript">
        function disableLevelField (from, level) {
            var check = $('#check_' + from + "_" + level).attr('checked');
            var checkRadio = $('#radio_' + from + "_" + level).attr('checked');
            if (check == true) {
                $('#text_' + from + "_" + level).attr("readonly", "");
                $('#radio_' + from + "_" + level).attr("disabled", "");
            } else {
                if (checkRadio == true) {
                    $('#check_' + from + "_" + level).attr('checked', 'checked');
                } else {
                    $('#text_' + from + "_" + level).attr("readonly", "readonly");
                    $('#radio_' + from + "_" + level).attr("disabled", "disabled");
                }
            }
        }
        
        function uncheckLevelField (from, level) {
                       
            <? foreach ($levelvalues as $levelvalue) { ?>
                if (level != <?=$levelvalue?>) {
                    $('#radio_' + from + "_" + <?=$levelvalue?>).attr("checked", "");
                }
            <? } ?>
            
        }
    </script>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>