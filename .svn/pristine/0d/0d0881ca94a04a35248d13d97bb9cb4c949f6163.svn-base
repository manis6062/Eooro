<? include_once 'common_functions.php';?>
<!-- Bootstrap -->
<?/* <link href="<?=THEMEFILE_URL;?>/<?=EDIR_THEME;?>/css/bootstrap.min.css" rel="stylesheet"> */?>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">

<? if($_SERVER['HTTP_HOST'] == "localhost") { ?>
<link href="<?=THEMEFILE_URL;?>/<?=EDIR_THEME;?>/css/style.css" rel="stylesheet">
<? } else { ?>
<link href="<?=THEMEFILE_URL;?>/<?=EDIR_THEME;?>/css/style.min.css" rel="stylesheet">
<? } ?>
<? system_scriptColectorCSS("/scripts/jquery/fancybox/v2/jquery.fancybox.css", false, false); ?>
<link href='https://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,700italic,800italic,400,600,700,800' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="<?php echo DEFAULT_URL.'/sponsors/listing/font-awesome-4.7.0/css/font-awesome.min.css'; ?>">
<?/* <link rel="stylesheet" href="<?=DEFAULT_URL;?>/scripts/jquery/fancybox/v2/jquery.fancybox.css"> */?>

<!-- Raleway Sans for Advertise Page -->
<? if (strpos($_SERVER['REQUEST_URI'], "advertise.php")) { ?>
<link href='https://fonts.googleapis.com/css?family=Raleway:400,500,600,700' rel='stylesheet' type='text/css'>
<? } ?>

<!-- Css/JS for Profile and Dashboard -->
<? if ( (strpos($_SERVER['PHP_SELF'], SOCIALNETWORK_FEATURE_NAME) || strpos($_SERVER['PHP_SELF'], MEMBERS_ALIAS) ) ) { ?>
	<link rel="stylesheet" href="<?=DEFAULT_URL;?>/scripts/jquery/jquery.autocomplete.css">
	<link rel="stylesheet" href="<?=DEFAULT_URL;?>/scripts/jquery/jcrop/css/jquery.Jcrop.css">
	<link rel="stylesheet" href="<?=DEFAULT_URL;?>/scripts/jquery/fancybox/v2/helpers/jquery.fancybox-buttons.css">

<? } ?>

<!-- Include all compiled plugins (below), or include individual files as needed -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="<?=DEFAULT_URL.'/scripts/jquery/jquery-migrate-1.2.1.min.js'?>"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>


<? if($_SERVER['HTTP_HOST'] == "localhost") { ?>
<script src="<?=THEMEFILE_URL;?>/<?=EDIR_THEME;?>/js/main.js" type="text/javascript" defer></script>
<? } else {?>
<script src="<?=THEMEFILE_URL;?>/<?=EDIR_THEME;?>/js/main.min.js" type="text/javascript" defer></script>
<? } ?>


<? if ((string_strpos($_SERVER['PHP_SELF'], "popup.php") !== false) || 
        (string_strpos($_SERVER['PHP_SELF'], "delete_image.php") !== false)) { ?>
        <link href="<?=THEMEFILE_URL;?>/<?=EDIR_THEME;?>/popup.css" rel="stylesheet" type="text/css" media="all" />
        <link href="<?=system_getStylePath("popup.css", EDIR_THEME);?>" rel="stylesheet" type="text/css" media="all" />
    <? } ?>
    <!-- modifications -->
    <? if ((string_strpos($_SERVER['PHP_SELF'], "/".MEMBERS_ALIAS) !== false) && 
        ((string_strpos($_SERVER['PHP_SELF'], "preview.php") === false) || 
        (string_strpos($_SERVER['PHP_SELF'], "invoice.php") === false)) ||
        // TODO: disabled members.css on case.php for Tab design on Case.php
        // (string_strpos($_SERVER['PHP_SELF'], "case.php") !== false) ||
        $loadMembersCss) { ?>
        <link href="<?=THEMEFILE_URL;?>/<?=EDIR_THEME;?>/compatibility.css" rel="stylesheet" type="text/css" />
        <link href="<?=THEMEFILE_URL;?>/<?=EDIR_THEME;?>/dashboard.css" rel="stylesheet" type="text/css" media="all" />
        <link href="<?=THEMEFILE_URL;?>/<?=EDIR_THEME;?>/members.css" rel="stylesheet" type="text/css" media="all" />
        <link href="<?=system_getStylePath("members.css", EDIR_THEME);?>" rel="stylesheet" type="text/css" media="all" />
    <? } ?>


<? if ((string_strpos($_SERVER['PHP_SELF'], SOCIALNETWORK_FEATURE_NAME) !== false)) { ?>
    
        <!-- INCLUDES HERE  -->
        <link href="<?=THEMEFILE_URL;?>/<?=EDIR_THEME;?>/compatibility.css" rel="stylesheet" type="text/css" />
        <link href="<?=THEMEFILE_URL;?>/<?=EDIR_THEME;?>/profile.css" rel="stylesheet" type="text/css" media="all" />
        <link href="<?=system_getStylePath("profile.css", EDIR_THEME);?>" rel="stylesheet" type="text/css" media="all" />
        <link rel="stylesheet" href="<?=NON_SECURE_URL?>/custom/domain_1/theme/<?=EDIR_THEME?>/css/style_scroll.css" />
        <link rel="stylesheet" href="<?=NON_SECURE_URL?>/custom/domain_1/theme/<?=EDIR_THEME?>/css/jquery.mCustomScrollbar.css" />  
        <link rel="stylesheet" href="<?=DEFAULT_URL;?>/scripts/jquery/jcrop/css/jquery.Jcrop.css">
        <link href="<?=THEMEFILE_URL;?>/<?=EDIR_THEME;?>/members.css" rel="stylesheet" type="text/css" media="all" />
        <link href="<?=THEMEFILE_URL;?>/<?=EDIR_THEME;?>/dashboard.css" rel="stylesheet" type="text/css" media="all" />
        <link href="<?=system_getStylePath("members.css", EDIR_THEME);?>" rel="stylesheet" type="text/css" media="all" />
        <link rel="stylesheet" href="<?=DEFAULT_URL?>/scripts/jquery/fancybox/v2/jquery.fancybox.css" type="text/css" media="all" />
        <link rel="stylesheet" href="<?=DEFAULT_URL;?>/scripts/jquery/fancybox/v2/helpers/jquery.fancybox-buttons.css">

        <? /*<script type="text/javascript" src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>  */?>
        <script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/jquery/jcrop/js/jquery.Jcrop.js"></script>
        <script type="text/javascript" src="<?=NON_SECURE_URL?>/custom/domain_1/theme/<?=EDIR_THEME?>/js/jquery.accordion.js"></script>
        <script src="<?=NON_SECURE_URL?>/custom/domain_1/theme/<?=EDIR_THEME?>/js/jquery.mCustomScrollbar.concat.min.js"></script>
        <script src="<?=DEFAULT_URL.'/scripts/jquery/jquery.textareaCounter.plugin.js'?>"></script>     

<? } ?>


    <link rel="stylesheet" href="<?=DEFAULT_URL?>/scripts/jquery/fancybox/v2/jquery.fancybox.css" type="text/css" media="all" />
    <link rel="stylesheet" href="<?=DEFAULT_URL;?>/scripts/jquery/fancybox/v2/helpers/jquery.fancybox-buttons.css">
    <script  src="<?=DEFAULT_URL?>/scripts/jquery/fancybox/v2/jquery.fancybox.pack.js" async="async"></script>

<? if ((string_strpos($_SERVER['PHP_SELF'], SOCIALNETWORK_FEATURE_NAME."/add.php") !== false) || 
        (string_strpos($_SERVER['PHP_SELF'], SOCIALNETWORK_FEATURE_NAME."/edit.php") !== false)) { ?>
        <link href="<?=THEMEFILE_URL;?>/<?=EDIR_THEME;?>/members.css" rel="stylesheet" type="text/css" media="all" />
        <link href="<?=THEMEFILE_URL;?>/<?=EDIR_THEME;?>/dashboard.css" rel="stylesheet" type="text/css" media="all" />
        <link href="<?=system_getStylePath("members.css", EDIR_THEME);?>" rel="stylesheet" type="text/css" media="all" />
    <? } ?>

<!-- Google Map Member Page -->

<? if ( (strpos($_SERVER['PHP_SELF'], MEMBERS_ALIAS) ) ) { ?>
    <script src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
    <script src="https://js.braintreegateway.com/v2/braintree.js"></script>
    <script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>
<? } ?>

