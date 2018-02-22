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
	# * FILE: /members/listing/listinglevel.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");
    require_once CLASSES_DIR . "/class_CustomSearch.php";
    include( CLASSES_DIR.'/class_God.php' );


	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSession();

	extract($_GET);
	extract($_POST);
	$url_redirect = "".DEFAULT_URL."/".MEMBERS_ALIAS;
	$url_base = "".DEFAULT_URL."/".MEMBERS_ALIAS."";
	$members = 1;

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/header.php");

	# ----------------------------------------------------------------------------------------------------
	# NAVBAR
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/navbar.php");

    $countryId  = CountryLoader::getCountryId();
    $states     = CountryLoader::getStateList( CountryLoader::getCountryId() );
    $countries  = CountryLoader::getCountryList();

    $searchReturn = God::getSearch('UnclaimedListing')->setQuery(strtolower($_GET['keyword']))->getPageBrowsingArray();
    $aux_items_per_page = ($_COOKIE["listing_results_per_page"] ? $_COOKIE["listing_results_per_page"] : 10);       
    $queryString  = $searchReturn['query'];
    unset($searchReturn);
   
    if($queryString){
        //Custom Search
        $CustomSearchObj = new CustomSearch();
        $listings        = $CustomSearchObj->getBackEndResults($queryString, $screen);
        if($listings){
            //$total       = $CustomSearchObj->getBackEndResultsCount($queryString);
        }
    }
    //$array_pages_code["total"] = $total;          
    $aux_module_per_page            = "listing";
    $aux_module_items               = $listings; 
    $aux_module_itemRSSSection      = "listing";
    system_scriptColectorNotDefer("/scripts/scrollviewer.min.js", false, false, false,false);
?>

<section class="banner res-banner ">
    <div class="banner-wrapper resbanner ">
        <div class="container">
            <div class="row size1">
                <div class="logo reslogo pull-left">
                    <a class="brand logo" id="logo-link" href="" target="_parent" title="Demo Directory">
                        <img src="<?=EDIRECTORY_FOLDER?>/custom/domain_1/theme/review/images/eooro-white.png" alt="logo"  height="54px" width="250px">
                    </a>
                    <div class="hwrap1">
                        <span class="repu">Reputation is Everything.</span>
                    </div>

                </div>
                <div class="hwrap pull-right">
                   <!-- <img src="http://localhost/10300/custom/domain_1/theme/review/images/white-logo-title.png" alt="white-logo-title" class="logo-title" width="300px"/> -->
                   <h3 class="hidden-sm hidden-md hidden-lg">Reputation Is Everything<sup>TM</sup></h3>
                  
                </div>
                
                <?if($keyword){?>
                                <div class="search col-sm-7 newsearch newsearch1" style="padding:0">        
                                    <div class="transparent-bg">   
                    <? if(CountryLoader::getCountryName() != 'United States' ) { ?>
                        <form class="form" name="search_form" method="get" action="addsearchlisting.php">
                            <h2 class="check">Check if your business is already in our system.</h2>
                            <div id="custom-search-input" class="search-advanced">
                                <div class="search-keyword input-group location">
                                    <input type="text" name="keyword" class="search-query form-control without-country" id="input<?=($searchResponsive ? "_resp" : "")?>" placeholder="<?=system_showText(LANG_LABEL_KEYWORDSEARCH);?>" value="<?=htmlspecialchars($keyword);?>" />
                                    <span class="input-group-btn search-button">
                                        <button id="search" class="btn btn-danger btn-info btn-search" type="submit">Search</button>
                                    </span>
                                </div>

                                <? if ($hasWhereSearch) { ?>
                                <input type="hidden" name="where" id="where<?=($searchResponsive ? "_resp" : "")?>" placeholder="<?=system_showText(LANG_LABEL_LOCATIONSEARCH);?>" value="<?=$where?>" <?=($waitGeoIP ? "class=\"ac_loading\" disabled=\"disabled\"" : "class=\" \"")?> />
                                <? } ?>

                                <input type="hidden" name="sel" id="sel" value="" />
                            </div><!--/custom-search-input-->
                        </form>
                    <? } else { ?>
                        <!-- For United States -->
                        <form class="form" name="search_form" method="get" action="<?=$action;?>">
                            <h2>Check if your business in already in our system.</h2>
                            <div id="custom-search-input" class="search-advanced">
                                <div class="search-keyword input-group location1">
                                    <input type="text" name="keyword" class="search-query form-control" id="input<?=($searchResponsive ? "_resp" : "")?>" placeholder="<?=system_showText(LANG_LABEL_KEYWORDSEARCH);?>" value="<?=htmlspecialchars($keyword);?>" />
                                
                                    <select name="selected-state" id="selected-state" class="required infor form-control country">
                                        <option> Select State </option>
                                        <? foreach ( $states as $state ){ 
                                            $selected = ( $state['id'] == CountryLoader::getStateId($countryId) ) ? 'selected="selected"' : '';
                                            echo '<option value="'.$state['id'].'-'.$state['name'].'" '.$selected.'>'.$state['name'].'</option>';
                                        }?>
                                    </select>

                                    <span class="input-group-btn search-button">
                                        <button id="search" class="btn btn-danger btn-info btn-search" type="submit" >
                                        Search
                                        </button>
                                        <!-- Modal -->
                                        <div class="modal bs-example-modal-sm" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-sm">
                                                <div class="modal-content modal-content-state">
                                                    <div class="modal-body">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title" id="myModalLabel"> Please select state before you proceed.</h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <!-- Modal -->
                                    </span>
                                </div>

                                <? if ($hasWhereSearch) { ?>
                                <input type="hidden" name="where" id="where<?=($searchResponsive ? "_resp" : "")?>" placeholder="<?=system_showText(LANG_LABEL_LOCATIONSEARCH);?>" value="<?=$where?>" <?=($waitGeoIP ? "class=\"ac_loading\" disabled=\"disabled\"" : "class=\" \"")?> />
                                <? } ?>
                                <input type="hidden" name="sel" id="sel" value="" />
                            </div><!--/custom-search-input-->
                        </form>
                    <? } ?> 
                        <div class="btn-group col-sm-offset-9">
                            <button type="button" class="btn btn-default adropdown-toggle state-dropdown country" data-toggle="dropdown" aria-expanded="false"><?=CountryLoader::getCountryName()?><span class="caret state-caret country"></span></button>
                            <ul class="dropdown-menu state-innerdropdown country" role="menu">
                                <?  
                                $i = 0;
                                while( $countries[$i] ):
                                $grey = ( $country == $countries[$i]['id'] ) ? '' : '-grey';
                                ?>
                                    <li class="li" id="<?=$countries[$i]['id'].'-'.$countries[$i]['abbreviation']?>"><?=$countries[$i]['name']?></li>

                                <? $i++; endwhile; ?>
                            </ul>
                        </div>
                </div> <!--/custom-search-input-->
                <? } ?>
                </div> <!--/row-->
            </div>
        </div>
        <div class="container">
            <div class="row">
                <h1 class="transparent-bg">Search and add Business</h1>      
            </div>
        </div>
    </div>
</section>


<? if($keyword==NULL) { ?>
<section class="foralert">
    <div class="container">
        <div class="search col-sm-7 newsearch newsearch1 newsearch2" style="padding:0">        
            <!-- For Other Countries -->
            <div class="transparent-bg">   

                <? if(CountryLoader::getCountryName() != 'United States') { ?>

                        <form class="form" name="search_form" method="get" action="addsearchlisting.php">
                            <h2 class="check">Check if your business is already in our system.</h2>
                            <div id="custom-search-input" class="search-advanced">
                                <div class="search-keyword input-group location">
                                    <input type="text" name="keyword" class="search-query form-control without-country" id="input<?=($searchResponsive ? "_resp" : "")?>" placeholder="<?=system_showText(LANG_LABEL_KEYWORDSEARCH);?>" value="<?=htmlspecialchars($keyword);?>" />
                                    <span class="input-group-btn search-button">
                                        <button id="search" class="btn btn-danger btn-info btn-search" type="submit">
                                           Search
                                        </button>
                                    </span>
                                </div>
                                <? if ($hasWhereSearch) { ?>
                                    <input type="hidden" name="where" id="where<?=($searchResponsive ? "_resp" : "")?>" placeholder="<?=system_showText(LANG_LABEL_LOCATIONSEARCH);?>" value="<?=$where?>" <?=($waitGeoIP ? "class=\"ac_loading\" disabled=\"disabled\"" : "class=\" \"")?> />
                                <? } ?>
                                <input type="hidden" name="sel" id="sel" value="" />
                            </div><!--/custom-search-input-->
                        </form>

                <? } else { ?>

                        <!-- For United States -->

                        <form class="form" name="search_form" method="get" action="<?=$action;?>">
                            <h2 class="check">Check if your business is already in our system.</h2>
                            <div id="custom-search-input" class="search-advanced">
                                <div class="search-keyword input-group location1">
                                    <input type="text" name="keyword" class="search-query form-control addlisting" id="input<?=($searchResponsive ? "_resp" : "")?>" placeholder="<?=system_showText(LANG_LABEL_KEYWORDSEARCH);?>" value="<?=htmlspecialchars($keyword);?>" />
                                    <select name="selected-state" id="selected-state" class="required infor form-control country addlisting">
                                        <option>Select State</option>
                                        <?php 
                                            foreach ( $states as $state ){
                                                $selected = ( $state['id'] == CountryLoader::getStateId($countryId) ) ? 'selected="selected"' : '';
                                                echo '<option value="'.$state['id'].'-'.$state['name'].'" '.$selected.'>'.$state['name'].'</option>';
                                            }
                                        ?>
                                    </select>
                                  
                                    <span class="input-group-btn search-button">
                                        <button id="search" class="btn btn-danger btn-info btn-search" type="submit" data-target=".bs-example-modal-sm">
                                            Search
                                        </button>
                    
                                        <div class="modal bs-example-modal-sm in" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-sm">
                                                <div class="modal-content modal-content-state">
                                                    <div class="modal-body">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                        <h4 class="modal-title" id="myModalLabel"> Please select state before you proceed.</h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>   
                                    </span>

                                    <? if ($hasWhereSearch) { ?>
                                        <input type="hidden" name="where" id="where<?=($searchResponsive ? "_resp" : "")?>" placeholder="<?=system_showText(LANG_LABEL_LOCATIONSEARCH);?>" value="<?=$where?>" <?=($waitGeoIP ? "class=\"ac_loading\" disabled=\"disabled\"" : "class=\" \"")?> />
                                    <? } ?>
                                    
                                    <input type="hidden" name="sel" id="sel" value="" />
                                </div>
                            </div>
                        </form>

                <? } ?> 
         
                <div class="btn-group col-sm-offset-9">
                    <button type="button" class="btn btn-default adropdown-toggle state-dropdown country" data-toggle="dropdown" aria-expanded="false"><?=CountryLoader::getCountryName()?><span class="caret state-caret country"></span></button>
                    <ul class="dropdown-menu state-innerdropdown country" role="menu">
                        <?  $i = 0;
                            while( $countries[$i] ):
                            $grey = ( $country == $countries[$i]['id'] ) ? '' : '-grey';
                        ?>
                        
                        
                            <li class="li" id="<?=$countries[$i]['id'].'-'.$countries[$i]['abbreviation']?>"><?=$countries[$i]['name']?></li>
                        
                        <? $i++; endwhile; ?>
                    </ul>
                </div>
            </div>

            <? if($_GET["keyword"]==NULL && CountryLoader::getCountryName() != 'United States') { ?>          
                <div class="alert alert-danger"><h5 style="color:#FF004F;"><strong>Use the above search box to check if we already have your business in our database.</strong></h5></div>
            <? } ?>  

        <? if($_GET["keyword"]==NULL && CountryLoader::getCountryName() == 'United States'){ ?>  
            <div class="alert alert-danger"><h5 style="color:#FF004F;"><strong>Use the above search box to check if we already have your business in our database.</strong></h5></div>
        <? }?>          

        </div> <!--/custom-search-input-->

<? } ?>
    </div>
</section>

<? if(CountryLoader::getCountryName() == 'United States') { ?>
    <script> 
    $('#search').on( 'click', function(e){
    	if($( '#selected-state' ).val().trim() == "Select State"){
    		$('#myModal').modal('show'); 	
    		e.preventDefault(); 
    	}
    });
    </script>
<? } ?>


<?
    if($keyword){
        include(THEMEFILE_DIR."/".EDIR_THEME."/body/dashresults.php");
    }

?>

<?
$url = NON_SECURE_URL. "/sponsors/listing/listing.php?level=10&listingtemplate_id=&keyword=".$_GET['keyword'];
    $messag = "<h1 style='font-size:30px;'>Your business is not listed above?</h1><br>";
    $messag .= "Don’t Panic, Try these<br><br>";
    $messag .= "1. Check your spelling.<br><br>";
    $messag .= "2. Shorten your search term e.g instead of “Acme Plumbing Limited” enter “Acme Plumbing” or “Acme”.<br><br>";
    $messag .= "3. If you still can't find this company, simply click the Add New Company button below.<br><br>";
    $messag .= '<a href = "' . $url . '"
             <button type="submit" class="btn btn-success pull-right">Add New Company &nbsp;<i class="fa fa-arrow-circle-right"></i></button>
             </a>';?>
<div id="hello" style="display:none;">
    <section class="latest-review cusreview" style="margin-top: -50px;">
        <div class="container">
            <div class="col-sm-9 cuscato"> 
                <?=$messag?>
            </div>
        </div>
    </section>
</div>

<script>
    var getResult = $( '.resultsMessage' ).text().trim();
    getResult = (getResult === '') ? true : false;
    $( document ).scrollViewer({
        pageRatio           : 0.8,
        screen              : 2,
        ajaxURL             : document.URL.replace( /&screen=[\d]+/, '' ),
        ajaxType            : 'POST',
        responseContainer   : '#content_listView',
        filterContents      : true,
        filterSelector      : { 
                                keep : '#content_listView',
                                discard: ['.results-info-listing','.bottom-pagination-listing']
                            },
        endOfResult         : function( response ){
            var result = response.text();
            if( result.search(/Your business not listed?/) > -1 ){
                $('#hello').show();
                return true;
            }
            else{
                $('#hello').hide();

                return false;
            }
        },
        loadResult          : getResult
    });
</script>
<script>
    function resetState(){
        setToCookie( 'location_state', '' );
        setToCookie( 'location_state_id', '' );
    }
    function setToCookie( cookie_name, cookie_value, expire ){
        var exp     = expire ? expire : 0;
        cookCookies.setCookie( cookie_name, cookie_value, exp, '/' ); 

    }
    function setLocationToCookie( location_name, id_of_element ){

       $( '#selected-state' ).on( 'change', function(event){
 
            resetState();
            var select  = $(this).val();
            select      = select.split('-');
            var id      = select[0];
            var title   = select[1];
           
            cookCookies.setCookie( location_name, title, 0, '/' ); 
            cookCookies.setCookie( location_name+'_id', id, 0, '/' );
                        
        }); 
    }
    (function($){
        $( '.li' ).on( 'click', function(event){
            var self    = $(this);
            var val     = self.attr( 'id' );
            var id      = val.split('-')[0];
            
            //Extract Country Name to set in Cookie
            var text = $(this).text();
            var title = decodeURIComponent(text);

            cookCookies.setCookie( 'location_geoip', title, 0, '/' ); 
            cookCookies.setCookie( 'location_geoip_id', id, 0, '/' );

            resetState();
            var reloaduri = window.location.href;
            var sanitizeuri = reloaduri.replace(/#_=_/g, '');
            window.location =  sanitizeuri;
            
        });
    })(jQuery);
    
    setLocationToCookie('location_state','selected-state');

</script>
<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/footer.php");
?>
<script>
$('#search').click(function(e){

    if($('#input').val().trim() == ""){
      e.preventDefault();
    }
});
</script>
<style type="text/css">
    .modal-backdrop.in {
        position: absolute;
        z-index: -1;
    }
</style>