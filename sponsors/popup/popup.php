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
    # * FILE: /popup/popup.php
    # ----------------------------------------------------------------------------------------------------
    
    define("SELECTED_DOMAIN_ID", 1);
//    if ($_GET["domain_id"] || $_POST["domain_id"]) {
//        
//            define("SELECTED_DOMAIN_ID", $_GET["domain_id"] ? $_GET["domain_id"] : $_POST["domain_id"]);
//    }
    
    # ----------------------------------------------------------------------------------------------------
    # LOAD CONFIG
    # ----------------------------------------------------------------------------------------------------
    include("../../conf/loadconfig.inc.php");
    
    header("Content-Type: text/html; charset=utf-8", TRUE);
    header("Accept-Encoding: gzip, deflate");
    header("Expires: Sat, 01 Jan 2000 00:00:00 GMT");
    header("Cache-Control: no-store, no-cache, must-revalidate");
    header("Cache-Control: post-check=0, pre-check", FALSE);
    header("Pragma: no-cache");

    # ----------------------------------------------------------------------------------------------------
    # SESSION
    # ----------------------------------------------------------------------------------------------------
    session_start();
    
    # ----------------------------------------------------------------------------------------------------
    # VALIDATION
    # ----------------------------------------------------------------------------------------------------
    include(EDIRECTORY_ROOT."/includes/code/validate_querystring.php");
    $pop_type = $_GET["pop_type"] ? $_GET["pop_type"] : $_POST["pop_type"];
    if ($pop_type != "reviewformpopup") {
        include(EDIRECTORY_ROOT."/includes/code/validate_frontrequest.php");
    }      

    # ----------------------------------------------------------------------------------------------------
    # CODE
    # ----------------------------------------------------------------------------------------------------
    extract($_GET);
    extract($_POST);
    
    $availablePopups = array();
    $availablePopups[] = "terms";
    $availablePopups[] = "uploadimage";
    $availablePopups[] = "profile_login";
    $availablePopups[] = "article_emailform";
    $availablePopups[] = "classified_emailform";
    $availablePopups[] = "event_emailform";
    $availablePopups[] = "listing_emailform";
    $availablePopups[] = "blog_emailform";
    $availablePopups[] = "custominvoice_items";
    $availablePopups[] = "twilio_report";
    $availablePopups[] = "clicktocallpopup";
    $availablePopups[] = "sendtophonepopup";
    $availablePopups[] = "deal_redeem";
    $availablePopups[] = "package_items";
    $availablePopups[] = "reviewformpopup";
    $availablePopups[] = "advertise_preview";
    //$availablePopups[] = "opencase";
    
    if (in_array($pop_type, $availablePopups) && file_exists(EDIRECTORY_ROOT."/includes/code/$pop_type.php")) {
        include(EDIRECTORY_ROOT."/includes/code/$pop_type.php");
    }
    
    $extraStyle = "";
    $aux_modal_box = "";
    
    if (string_strpos($pop_type, "clicktocall") !== false || string_strpos($pop_type, "sendtophone") !== false) {
       $extraStyle = "modal-content-small";
    } elseif (string_strpos($pop_type, "profile_login") !== false) {
        $extraStyle = "login";
        $aux_modal_box = "profileLogin"; 
    } elseif ($pop_type == "uploadimage") {
        $extraStyle = "modal-content-upload";
    } elseif ($pop_type == "deal_redeem") {
        $extraStyle = "modal-deal-redeem";
    } elseif ($pop_type == "advertise_preview") {
        $extraStyle = "modal-preview";
    }
    
    $loadMembersCss = false;
    $isPopup = true;
    $arrayMembersCss = array(0 => "uploadimage", 1 => "custominvoice_items", 2 => "package_items", 3 => "twilio_report");
    if (in_array($pop_type, $arrayMembersCss)) {
        $loadMembersCss = true;
    }
    
    if (string_strpos($pop_type, "emailform") !== false && sess_getAccountIdFromSession()) {
        $userInfo = new Contact(sess_getAccountIdFromSession());
        if (!$userInfo->getNumber("account_id")) {
            unset($userInfo);
        }
    }

    header("Content-Type: text/html; charset=".EDIR_CHARSET, TRUE);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=<?=EDIR_CHARSET;?>" />
        
        <meta name="ROBOTS" content="noindex, nofollow" />

        <?
        include(THEMEFILE_DIR."/".EDIR_THEME."/".EDIR_THEME.".php");
        
        if (string_strpos($pop_type, "review") !== false || $pop_type == "deal_redeem" || $pop_type == "uploadimage" || $pop_type == "advertise_preview") { ?>
        
            <? if ($pop_type == "advertise_preview") { ?>
        
                <script type="text/javascript">
                    <!--
                    DEFAULT_URL = "<?=DEFAULT_URL?>";
                    ACTUAL_MODULE_FOLDER = "<?=(defined("ACTUAL_MODULE_FOLDER") ? ACTUAL_MODULE_FOLDER : "root")?>";
                    THEME_FLAT_FANCYBOX = "<?=THEME_FLAT_FANCYBOX?>";
                    -->
                </script>
        
                <script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/common.js"></script>
            <? } ?>
            
            <script src="<?=DEFAULT_URL?>/scripts/jquery.js" language="javascript" type="text/javascript"></script>
            
        <? } elseif ($pop_type == "profile_login") { ?>
            
            <script src="<?=DEFAULT_URL?>/scripts/front/jquery-1.8.3.min.js" language="javascript" type="text/javascript"></script>
            
            <? if (THEME_USE_BOOTSTRAP) { ?>
                
                <script src="<?=DEFAULT_URL?>/scripts/front/bootstrap.min.js" language="javascript" type="text/javascript"></script>
                <script src="<?=DEFAULT_URL?>/scripts/jquery/bootstrap-select/bootstrap-select.min.js" language="javascript" type="text/javascript"></script>
                
                <script type="text/javascript" language="javascript">
                
                $('document').ready(function() {
                    $('.selectpicker .select').selectpicker();
                });
                
                </script>

            <? } ?>
            
        <? }
        
        if ($pop_type == "uploadimage") { ?>
            
            <script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/jquery/jcrop/js/jquery.Jcrop.js"></script>
            <link rel="stylesheet" href="<?=DEFAULT_URL?>/scripts/jquery/jcrop/css/jquery.Jcrop.css" type="text/css" />
            
        <? }
        
        if (string_strpos($pop_type, "review") !== false) { 
        
            include(system_getFrontendPath('review_javascript.php'));
        
        } elseif ($return_message && (string_strpos($pop_type, "clicktocall") !== false || string_strpos($pop_type, "sendtophone") !== false)) { ?>
            
            <script language="javascript" type="text/javascript">
                setTimeout(function(){
                    parent.$.fancybox.close();
                }, 6000)
            </script>
            
        <? } elseif (string_strpos($pop_type, "profile_login") !== false) {
                $aux_modal_box = true;
        ?>
            <script type="text/javascript">

                function urlRedirect(url) {
                    window.parent.location = url;
                }
                
            </script>        
            
         <? } elseif ($pop_type == "deal_redeem") { ?>
                    
            <script language="javascript" type="text/javascript">
                function print_page() {
                    $("#bt_print").hide();
                    $("#errorMessage").hide();
                    window.print();
                    window.onfocus = function() { $("#bt_print").show();  $("#errorMessage").show(); }
                }
                
                <? if ($newdealsDone) { ?>
                    parent.updateDeals(<?=$newdealsDone?>, <?=$newdealsLeft?>);
                <? } ?>
            </script>      
                    
         <? } elseif ($pop_type == "uploadimage") {
            
                if ($upload_image == "failed") { ?>
                    <script language="javascript" type="text/javascript">
                        setTimeout(function(){
                             parent.$.fancybox.close();
                        }, 1500);

                    </script>
                <? } else {
                    
                        if (($onlyMainImage) || ($main == "false")) {

                            if ($uploadImageUpdate == "y") { ?>
                                <script language="javascript" type="text/javascript">
                                    parent.loadGallery(<?=$_POST["item_id"]?>, 'y', '<?=MEMBERS_ALIAS?>', 'editFe', 'false');
                                    setTimeout(function(){
                                         parent.$.fancybox.close();
                                    }, 1500)
                                </script>
                            <? } elseif ($uploadImageUpdate == "n") { ?>
                                <script language="javascript" type="text/javascript">
                                    parent.loadGallery(<?=$_POST["item_id"]?>, 'y', '<?=MEMBERS_ALIAS?>', 'n', 'false');
                                    setTimeout(function(){
                                         parent.$.fancybox.close();
                                    }, 1500)
                                </script>
                            <? }
                        } else {

                            if (($uploadImageUpdate == "y") || ($uploadImageUpdate == "n")) { ?>
                                <script language="javascript" type="text/javascript">
                                    parent.loadGallery(<?=$_POST["item_id"] ? $_POST["item_id"] : "0";?>, 'y', '<?=MEMBERS_ALIAS?>', '', 'true');
                                    setTimeout(function(){
                                         parent.$.fancybox.close();
                                    }, 1500)
                                </script>
                            <? }
                    }
                }
          } ?>
            
        <!--[if lt IE 9]>
        <script src="<?=DEFAULT_URL."/scripts/front/html5shiv.js"?>"></script>
        <![endif]-->
        
    </head>

    <!--[if IE 7]><body class="allpopup ie ie7"><![endif]-->
    <!--[if lt IE 9]><body class="allpopup ie"><![endif]-->
    <!-- [if false]><body class="allpopup"><![endif]-->
    
                <?php 
                    if ( $pop_type == 'opencase' ) {
                        $app = ModFactory::getApplication();
                        $app->setOptions( 'casemanager', 'opencase', 'showPopup', new Review($review) )->run();
                    }
                    else{
                        include(system_getFrontendPath("popup.php", "frontend"));
                    }
                ?>
    </body>
    
</html>
