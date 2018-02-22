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
	# * FILE: /theme/default/layout/members/header.php
	# ----------------------------------------------------------------------------------------------------

    // to work in members page
    $dispatcher = PluginRegistry::getDispatcher();
    $dispatcher->dispatch( 'UserNavigation' );
?>  
    <!--[if IE 7]><body class="ie ie7"><![endif]-->
    <!--[if lt IE 9]><body class="ie"><![endif]-->
    <!-- [if false]><body><![endif]-->
    <body style="min-height:100vh;">
<script>
     var isSafari = /Safari/.test(navigator.userAgent) && /Apple Computer/.test(navigator.vendor);

    if (isSafari) 
    {
        $('body').css('min-height', '96rem');
    }
</script>
    <!-- Google Tag Manager code - DO NOT REMOVE THIS CODE  -->
    <?=front_googleTagManager();?>
    
    <? if (DEMO_LIVE_MODE && file_exists(EDIRECTORY_ROOT."/frontend/livebar.php")) {
        include(EDIRECTORY_ROOT."/frontend/livebar.php");
    } ?>

   
    <script type="text/javascript">
       $(function() {

           $(".dropdown-toggle").click(function() {
               $(".dropdown-menu").toggle();
           });

           $("#main_menu").click(function() {
               $(".nav-collapse-members").toggleClass("in");
           });
       });
    </script>
    
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
    ?>
    <style>
        <?if( (!strpos($_SERVER['PHP_SELF'],'login')) && (!strpos($_SERVER['PHP_SELF'],'addsearchlisting'))  ){ ?>
            .footer-atbottom {
              background-color: #FFF ;
            }
        <? } ?>
        <?if(strpos($_SERVER['PHP_SELF'], 'forgot')){?>

            .footer-atbottom {
              background-color: #F9F9F9 ;
            }
           <? }elseif(strpos($_SERVER['PHP_SELF'],'reset')){?>
            .footer-atbottom {
                background-color: #EEF9FF ;
            }
            <?}?>
    </style>
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
                    <ul class="nav navbar-nav cusnav">
                        <? include(system_getFrontendPath("header_menu.php", "layout")); ?>
                    </ul>
                  <? 
                //if the user is logged in
                session_start();
   		if (sess_isAccountLogged()){
                    ?>
                    <div class="row">
                <div class="col-sm-6 col-md-6 pull-right dashboard-icon1">
                        <? include(system_getFrontendPath( 'usernavbar.php', 'layout') ); ?>
                </div>  
                </div>
                        
                <? } else {
                    //if the user is logged out
                    ?>
                    <div class="col-sm-3 pull-right singup-login">
                        <div class="row">
                        <? include(system_getFrontendPath( 'usernavbar.php', 'layout') ); ?>
                    </div>
                    
                  <?  }
                  ?>      
                        
                   
                    </div>
                </div> <!--/container-->
            </nav>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.6.2/modernizr.min.js"></script>
              <script>
                    Modernizr.addTest('flexboxtweener', Modernizr.testAllProps('flexAlign', 'end', true));
              </script>
        </header>
