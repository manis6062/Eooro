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
	# * FILE: /errorpage.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	if (!$notIncludeConfig){
		include("./conf/loadconfig.inc.php");
	}

	# ----------------------------------------------------------------------------------------------------
	# VALIDATION
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/includes/code/validate_querystring.php");
	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSessionFront();

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	$headertag_title = $headertagtitle;
	$headertag_description = $headertagdescription;
	$headertag_keywords = $headertagkeywords;
    $errorPage = true;

	include(system_getFrontendPath("header.php", "layout"));
	
	# ----------------------------------------------------------------------------------------------------
	
	$dbMain = db_getDBObject(DEFAULT_DB, true);
	$dbDomain = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);

	$sql = "SELECT content from {$dbDomain->db_name}.Content where type = 'Cookies'";
	$resource = $dbDomain->query( $sql );
	$array = mysql_fetch_array($resource);

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	require(EDIRECTORY_ROOT."/frontend/checkregbin.php");

	# ----------------------------------------------------------------------------------------------------
	# BODY
	# ----------------------------------------------------------------------------------------------------
?>

<section class="banner res-banner <?=$customBannerSectionClass?>">
    <div class="banner-wrapper resbanner <?=$customBannerDivClass?>">
        <div class="container">
            <div class="row size1">
        	<div class="logo reslogo pull-left">
                    <a class="brand logo" id="logo-link" href="<?=NON_SECURE_URL?>/" target="_parent" <?=(trim(EDIRECTORY_TITLE) ? "title=\"".EDIRECTORY_TITLE."\"" : "")?> >
                        <img src="<?=THEMEFILE_URL;?>/<?=EDIR_THEME;?>/images/logo.png" alt="logo"/>
                    </a>
                    <div class="hwrap1">
                       <!--  <h1 style=" text-transform: none;">Reputation is Everything.</h1> -->
                       <span class="repu">Reputation Is Everything</span>
                    </div>
                </div>
                <div class="search col-sm-7 newsearch newsearch1" style="padding: 0;">
                    <?php //include( system_getFrontendPath('search.php') );
                        include( EDIRECTORY_ROOT.'/searchfront.php' );
                    ?>
                </div> <!--/custom-search-input-->
            </div> <!--/row-->
    	</div> <!--/container-->
    </div> <!--/banner-wrapper-->
    <div class="container">
    	<div class="row">
            <?=$thePageTitle?>
    	</div>
    </div>
</section>
<div class="container">
	<div class="faqAnswers">
		<div class="content-custom">
			
					<?=$array['content']?>

		</div>
	</div>
</div>

<script>
    function closeFancyboxAndRedirectToUrl(url){
    $.fancybox.close();
    window.location = url;
}
//    $(window).resize(function(){
//        if( $(this).width() < 962 ){
//            $( '#state-selector').addClass('on-top').prependTo('#search-form');
//        }
//        else{
//            $( '#state-selector').removeClass('on-top').appendTo('#user-location');
//        }
//    });
    
</script>

<?

	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(system_getFrontendPath("footer.php", "layout"));

?>