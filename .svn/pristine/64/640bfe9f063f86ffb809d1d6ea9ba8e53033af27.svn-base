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
	# * FILE: /theme/default/layout/usernavbar.php
	# ----------------------------------------------------------------------------------------------------
?>
<link rel=stylesheet href="<?php echo DEFAULT_URL; ?>/custom/domain_1/theme/review/css/flags.css">


<?php if ($_SERVER['HTTP_HOST']=="localhost") { ?>

<script src="<?php echo DEFAULT_URL; ?>/scripts/jquery.flagstrap.js" ></script>

<?php } else {?>

<script src="<?php echo DEFAULT_URL; ?>/scripts/jquery.flagstrap.min.js"></script>

<?php } ?>
    <!--cachemarkerUserNavbar-->

<?

    if (sess_getAccountIdFromSession()) {
        
        $dbObjUser = db_getDBObJect(DEFAULT_DB, true);
        $sqlUser = "SELECT C.first_name,
                                C.last_name,
                                A.has_profile,
                                A.is_sponsor,
                                P.friendly_url,
                                P.nickname
                            FROM Contact C
                            LEFT JOIN Account A ON (C.account_id = A.id)
                            LEFT JOIN Profile P ON (P.account_id = A.id)
                        WHERE A.id = ".sess_getAccountIdFromSession();
        $resultUser = $dbObjUser->query($sqlUser);
        $rowUser = mysql_fetch_assoc($resultUser);
                
    }

//To get the abbreviation of selected country in dropdown
$countries = CountryLoader::getCountryList();

foreach($countries as $key => $country){
    $countries[$key]['abbreviation'] = (strtoupper($country['abbreviation']) == "UK") ? "GB" : strtoupper($country['abbreviation']);
    if($country['id'] === CountryLoader::getCountryId()){
        $countryAbbr = $countries[$key]['abbreviation'];
    }
}

if (SOCIALNETWORK_FEATURE == "on") {  ?>
    
    <? if (sess_getAccountIdFromSession()) { ?>
       <?$listings_count = Listing::getListingCountByAccountId(sess_getAccountIdFromSession());?>
        <div class="navWidth pull-right">
            <ul class="nav navbar-nav bold pull-right afterlogin">           
                <? if ($listings_count > 0) { ?>
                    <li class="<?=(strpos($_SERVER['REQUEST_URI'], MEMBERS_ALIAS) == true) ? 'active' : null ;?>">
                        <a href="<?=((SSL_ENABLED == "on" && FORCE_MEMBERS_SSL == "on") ? SECURE_URL : NON_SECURE_URL)?>/<?=MEMBERS_ALIAS?>/">My Account</a>
                    </li>
                <? } else { ?>
                	<li class="<?=(strpos($_SERVER['REQUEST_URI'], SOCIALNETWORK_FEATURE_NAME) == true) ? 'active' : null ;?>">
                        <a href="<?=SOCIALNETWORK_URL?>/">My Account</a>
                    </li>
                <? } ?>
                <li>
                 <a class="pipe">|</a>
                </li>
                <li>    
                    <a href="<?=SOCIALNETWORK_URL?>/logout.php" class="sign-up"><?=system_showText(LANG_BUTTON_LOGOUT)?></a>
                </li>       
                   <?php if(!strpos($_SERVER['REQUEST_URI'], 'sponsors')) { //show everywhere but account page ?>
                   <li class="country" id="options" data-input-name="country2" data-selected-country="<?=$countryAbbr?>">
                   </li>
                   <?php } ?>
            </ul>
        </div>

    <? } else {?>

            <!-- <div class="col-sm-10 col-md-12 navWidth pull-right"> -->
            <div class="navWidth pull-right col-sm-12" id="fix-overflow-div" >
                <ul class="nav navbar-nav bold pull-right beforelogin">
                   <li class="<?=(strpos($_SERVER['REQUEST_URI'], "login.php") == true) ? 'active' : null ;?>">
                         <a href="<?=DEFAULT_URL.'/profile/login.php'?>">
                            <span>Login</span>
                         </a>
                   </li>
                   <?php if(!strpos($_SERVER['REQUEST_URI'], 'sponsors')) { //show everywhere but account page ?>
                   <li class="country" id="options" data-input-name="country2" data-selected-country="<?=$countryAbbr?>">
                   </li>
                   <?php } ?>
                </ul>
            </div>   
    <? } ?>
    
<? } else { ?>
        
    <? if (sess_getAccountIdFromSession()) { ?>
            <div class="col-sm-9 navWidth">
                <ul class="nav pull-right menu-dashboard">
            
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="sign-up dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-user i-profile"></i>
                            <b class="caret"></b>
                        </a>

                        <ul class="dropdown-menu">
                            <li class="nav-header">
                                <?=system_showText(LANG_LABEL_WELCOME)." ".($rowUser["first_name"]." ".$rowUser["last_name"]);?>!
                            </li>
                            <li class="divider"></li>
                            
                            <li>
                                <a href="<?=((SSL_ENABLED == "on" && FORCE_MEMBERS_SSL == "on") ? SECURE_URL : NON_SECURE_URL)?>/<?=MEMBERS_ALIAS?>/"><?=system_showText(LANG_MEMBERS_DASHBOARD);?></a>
                            </li>

                            <li>
                                <a href="<?=((SSL_ENABLED == "on" && FORCE_MEMBERS_SSL == "on") ? SECURE_URL : NON_SECURE_URL)?>/<?=MEMBERS_ALIAS?>/account/"><?=system_showText(LANG_LABEL_ACCOUNT)?></a>
                            </li>

                            <li>
                                <a href="<?=((SSL_ENABLED == "on" && FORCE_MEMBERS_SSL == "on") ? SECURE_URL : NON_SECURE_URL)?>/<?=MEMBERS_ALIAS?>/logout.php" class="sign-up"><?=system_showText(LANG_BUTTON_LOGOUT)?></a>
                            </li>       
                        </ul>
                    </li>

                </ul>
            </div>

        <? } else { ?>	

            <div class="col-sm-9 cols-sm-offset-2">
                <ul class="nav navbar-nav bold pull-right">
                   <li>
                       <a href="<?=((SSL_ENABLED == "on" && FORCE_MEMBERS_SSL == "on") ? SECURE_URL : NON_SECURE_URL)?>/advertise.php" class="sign-up">
                          <span>Sign Up |</span>
                       </a>
                   </li>

                   <li>
                       <a href="<?=((SSL_ENABLED == "on" && FORCE_MEMBERS_SSL == "on") ? SECURE_URL : NON_SECURE_URL)?>/<?=MEMBERS_ALIAS?>/login.php" class="sign-up">
                          <span > Login </span>
                       </a>
                   </li>
                 
                </ul>
            </div>

        <? } ?>
    
  <?  } ?>
<? 

?>
<script> 
    $('#options').flagStrap({
        countries: {
            // "AU": "Australia",
            // "GB": "United Kingdom",
            // "US": "United States",
            // "CA": "Canada",
            // "IE": "Ireland",
            // "NZ": "New Zealand"
            <? foreach ($countries as $country): ?>
            "<?=$country['abbreviation']?>" : "<?=' '.$country['abbreviation']?>",
            <? endforeach; ?>
        },
        buttonSize: "btn-sm",
        buttonType: "btn-info",
        labelMargin: "10px",
        scrollable: false,
        scrollableHeight: "350px",
        listItemClass: 'flag-list',
        countryAndId: {
            <? foreach ($countries as $country): ?>
            "<?=$country['abbreviation']?>" : "<?=$country['id'].'-'.$country['name']?>",
            <? endforeach; ?>
        }
    });
    
    
</script>
<style type="text/css">
    li.country.flagstrap {
        width: auto;
    }
    li.country.flagstrap button,
    li.country.flagstrap button:hover,
    li.country.flagstrap button:active,
    li.country.flagstrap button:active:focus, 
    li.country.flagstrap button:active:hover
    {
        background-color: transparent;
        border:none;
        outline: none;
        margin-top: 10px;
        box-shadow: none;
        font-size: 14px;
    }
     .open>.dropdown-toggle.btn-info,
    .open>.dropdown-toggle.btn-info:focus, 
    .open>.dropdown-toggle.btn-info:hover
    {
        background-color: #e62847;
    }
    .dropdown-menu.countryFlags{
        min-width: 75px;
    }
    @media (max-width: 767px){
        li.flag-list{
            display: block!important;
        }
        li.flag-list a {
            padding-left: 20px!important;
            color: #fff!important;
        }
        li.flag-list:hover {
            background-color: #e62847;
        }
        .navWidth > ul{
            float: left!important;
            margin-left: 0;
        }
        .navWidth > ul > li >a{
            padding:0; 
        }
        .navWidth ul.beforelogin >li:first-child {
            vertical-align: top;
            margin-top: 5px;
        }
        .navWidth ul.afterlogin >li:nth-of-type(1),
        .navWidth ul.afterlogin >li:nth-of-type(2),
        .navWidth ul.afterlogin >li:nth-of-type(3) {
            vertical-align: top;
            margin-top: 5px;
        }
        .nav.navbar-nav.bold>li>a.pipe {
            padding: 0; 
        }
        li.country.flagstrap button, li.country.flagstrap button:hover, li.country.flagstrap button:active, li.country.flagstrap button:active:focus, li.country.flagstrap button:active:hover {
         margin-top: 0; 
        
    }
    
    }
</style>
