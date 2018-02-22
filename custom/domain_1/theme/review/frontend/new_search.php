<?
    $dbMain = db_getDBObject(DEFAULT_DB, true);
    $main = $dbMain->db_name;

?>

<? if(CountryLoader::getCountryName() != 'United States') { ?>

<!-- For Other Countries -->
<script>localStorage.clear();</script>
    <div id="custom-search-input" class="search-advanced">
        <div class="transparent-bg">
            <form class="form" name="search_form" method="get" action="<?=$action;?>">
                <h2>Whose review are you looking for?</h2>
                <div id="custom-search-input" class="search-advanced">
                    <div class="search-keyword input-group location">
                        <input type="text" name="keyword" class="search-query form-control without-country" id="input<?=($searchResponsive ? "_resp" : "")?>" placeholder="<?=system_showText(LANG_LABEL_KEYWORDSEARCH);?>" value="<?=$keyword;?>" />
                        <span class="input-group-btn search-button">
                            <button id="search" class="btn btn-danger btn-info btn-search" type="submit">
                                Search
                            </button>
                        </span>
                    </div>

                    <? if ($hasWhereSearch) { ?>
                    <!--<div class="search-location">
                        <label id="where-title" class="title" for="where"><?=system_showText(LANG_LABEL_SEARCHINGFOR_WHERE).' in '.$where.'?';?></label>-->
                        <input type="hidden" name="where" id="where<?=($searchResponsive ? "_resp" : "")?>" placeholder="<?=system_showText(LANG_LABEL_LOCATIONSEARCH);?>" value="<?=$where?>" <?=($waitGeoIP ? "class=\"ac_loading\" disabled=\"disabled\"" : "class=\" \"")?> />
                    <!--</div>-->
                    <? } ?>
                    <input type="hidden" name="sel" id="sel" value="" />
                </div><!--/custom-search-input-->

            </form>
   

<? } else { ?>

<!-- For United States -->

    <div class="transparent-bg">
        <form class="form" name="search_form" method="get" action="<?=$action;?>" onsubmit="localStorage.clear()">
            <h2>Whose review are you looking for?</h2>
            <div id="custom-search-input" class="search-advanced">
                <div class="search-keyword input-group location1">
                 <input type="text" name="keyword" id="input" class="search-query form-control"  id="keyword<?=($searchResponsive ? "_resp" : "")?>" placeholder="<?=system_showText(LANG_LABEL_KEYWORDSEARCH);?>" value="<?=$keyword;?>" />
                <!-- <input type="text" name="keyword" id="input" class="search-query form-control" id="keyword<?=($searchResponsive ? "_resp" : "")?>" placeholder="<?=system_showText(LANG_LABEL_KEYWORDSEARCH);?>" value="<?=$keyword;?>" />-->                    

                    <?php 

                        $country       = CountryLoader::getCountryName();
                        $countryID     = CountryLoader::getCountryId();
                        $cookieStateId = CountryLoader::getStateId($countryID);

                        //For State, get location 1 id
                        
                        if ($countryID){
                            $sql = "SELECT id, name FROM {$main}.Location_3 WHERE location_1=$countryID";
                            $resource = mysql_query($sql);
                            while( $row = mysql_fetch_assoc($resource) ){
                                    $states[] = $row;
                                }
                        }    
                        $statecount = count ($states);

                                ?>

                                <select name="selected-state" id="selected-state" class="required infor form-control country">
                                    <?php 
                                    
                                    echo '<option value =""> Select State </option>';
                                    // foreach ( $states as $state ){
                                    //     $selected = ( $state['id'] == CountryLoader::getStateId($countryId) ) ? 'selected="selected"' : '';
                                    //     echo '<option value="'.$state['id'].'-'.$state['name'].'" '.$selected.'>'.$state['name'].'</option>';
                                    // }
                                    for ($z = 0; $z < $statecount ; $z++){
                                        $selected = ( $states[$z]['id'] == $cookieStateId ) ? 'selected="selected"' : '';;
                                        echo '<option value="'.$states[$z]['id'].'-'.$states[$z]['name'].'" '.$selected.'>'.$states[$z]['name'].'</option>';
                                    }

                                    ?>
                                </select>
                               
                    <span class="input-group-btn search-button">
                        <button id="search" class="btn btn-danger btn-info btn-search" type="submit" <? //if (!$_COOKIE['location_state']) {  echo "disabled";  } ?>>
                            Search
                        </button>
                        <!-- Button trigger modal -->
                                <!-- <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
                                  Launch demo modal
                                </button> -->

                                <!-- Modal -->
                                <div class="modal fade bs-example-modal-sm" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                  <div class="modal-dialog modal-sm">
                                    <div class="modal-content modal-content-state">
                                      <div class="modal-body">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel"> Please select state before you proceed.</h4>
                                      </div>
                                      
                                     
                                    </div>
                                  </div>
                                </div>
                    </span>
                </div>

                <? if ($hasWhereSearch) { ?>
                <!--<div class="search-location">
                    <label id="where-title" class="title" for="where"><?=system_showText(LANG_LABEL_SEARCHINGFOR_WHERE).' in '.$where.'?';?></label>-->

                    <input type="hidden" name="where" id="where<?=($searchResponsive ? "_resp" : "")?>" placeholder="<?=system_showText(LANG_LABEL_LOCATIONSEARCH);?>" value="<?=$where?>" <?=($waitGeoIP ? "class=\"ac_loading\" disabled=\"disabled\"" : "class=\" \"")?> />
                <!--</div>-->
                <? } ?>
                <input type="hidden" name="sel" id="sel" value="" />
            </div><!--/custom-search-input-->

        </form>
<?  
$reffer = $_SERVER["HTTP_REFERER"].'index.php';

$pageURL1 = 'http://'.$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"].'index.php';
$pageURL2 = 'https://'.$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"].'index.php';

if ($reffer == $pageURL1) {
    $true = 1;
}
if ($reffer == $pageURL2) {
    $true = 1;
}

?>

<? if ($_COOKIE['location_geoip'] == 'United States'){ ?>
<script>

    $(document).ready(function(){

           $("#search").button().click(function(){
                var search = $("#input").val();
                 // Store
                localStorage.setItem("searchvalue", search);
            });    
          
            $("#selected-state").click(function(){
                  var search = $("#input").val();
                 // Store
                localStorage.setItem("searchvalue", search);

             });   

           if (search){
            $('#input').val(localStorage.getItem("searchvalue"));
           }
    });
</script>
<?}?>

<? } ?> 

<?  

    //For Country Name    
    
//    $sql = "SELECT id, name,abbreviation from {$main}.Location_1";
//    $resource = mysql_query($sql);
//     while( $row = mysql_fetch_assoc($resource) ){
//            $countries[] = $row;       
//        }
    $countries = CountryLoader::getCountryList();
    // $countryname = $_COOKIE['location_geoip_id'];
     $countryname = CountryLoader::getCountryName();

   // If Country is selected remove its instance from dropdown 

    $count = count($countries);

    for ($z = 0 ; $z < $count ; $z++){
        if ($countries [$z]['name'] == $countryname){
            unset($countries [$z]); 
            $countries = array_values($countries);
        }
    }

    ?>

             <div class="btn-group col-sm-offset-9">
             <!-- <div class="btn-group pull-right"> -->
                <!--TODO this button should be removed. hidden for now-->
                <button type="button" class="btn btn-default dropdown-toggle state-dropdown country" data-toggle="dropdown" aria-expanded="false" style="display:none;">
                    <?=$countryname?><span class="caret state-caret country"></span>
                </button>
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
    </div>
<?if($keyword){ ?>
<? /*
<script>
    $(document).ready(function(){
        //commented out for checkbox enable-disable on No Search Results
           // if (search){
           //  $('#input').val('<?=$keyword?>');
           // }
    });
</script>
*/?>
<?}?>

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
            
            $(this).trigger('changeLocation',[{
                id: id, 
                title: title
            }]);
            
        });
        
        //for flag list on top menu
        $('.flag-list').on('click', function(event){
            var data = $(this).data('id');
            data = data.split('-');
            $(this).trigger('changeLocation',[{
                id: data[0],
                title:data[1]
            }]);
        });
        
        $(document).on('changeLocation', function(event, data){
            var title = data.title;
            var id = data.id;

            cookCookies.setCookie( 'location_geoip', title, 0, '/' ); 
            cookCookies.setCookie( 'location_geoip_id', id, 0, '/' );

            resetState();
            var reloaduri = window.location.href;
            var sanitizeuri = reloaduri.replace(/#_=_/g, '');
            var sanitizeuri = sanitizeuri.replace('#','','g');
            
            window.location =  sanitizeuri;
        });
    })(jQuery);
    setLocationToCookie('location_state','selected-state');
</script>

<script>
$('#search').click(function(e){

    if($('#input').val().trim() == ""){
      e.preventDefault();
    }
});
</script>
