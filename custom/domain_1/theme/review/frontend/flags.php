<?php 
/**
 * @author          Subigya Jyoti Panta
 * @subpackage      Flags
 * @copyright (c) 2014, www.eooro.com
 * @version         1.0
 * @modification history original
 */

$countries = CountryLoader::getCountryList();
$country   = CountryLoader::getCountryId();
?>



<div class="flag-container">
    <?  $i = 0;
        while( $countries[$i] ):
        $grey = ( $country == $countries[$i]['id'] ) ? '' : '-grey';
    ?>
    <img src="<?=THEMEFILE_URL.'/'.EDIR_THEME.'/images/iconography/'.strtolower($countries[$i]['abbreviation']).$grey.'.png';?>" class="flag" height="26px" width="40px" alt="<?=$countries[$i]['name']?>" title="<?=$countries[$i]['name']?>" id="<?=$countries[$i]['id'].'-'.$countries[$i]['abbreviation']?>"/>
    <? $i++; endwhile; ?>
</div>

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
       $( '#' + id_of_element ).on( 'change', function(event){
            resetState();
            var select  = $(this).val();
            select      = select.split('-');
            var id      = select[0];
            var title   = select[1];

                cookCookies.setCookie( location_name, title, 0, '/' ); 
                cookCookies.setCookie( location_name+'_id', id, 0, '/' );

            var reloaduri = window.location.href;
            var sanitizeuri = reloaduri.replace(/#_=_/g, '');
            var sanitizeuri = sanitizeuri.replace('#','','g');
            window.location =  sanitizeuri;
        }); 
    }
    (function($){
        $( '.flag' ).on( 'click', function(event){
            var self    = $(this);
            var val     = self.attr( 'id' );
            var id      = val.split('-')[0];
            var title   = self.attr( 'title' );
            
                cookCookies.setCookie( 'location_geoip', title, 0, '/' ); 
                cookCookies.setCookie( 'location_geoip_id', id, 0, '/' );

            resetState();
            var reloaduri = window.location.href;
            var sanitizeuri = reloaduri.replace(/#_=_/g, '');
            var sanitizeuri = sanitizeuri.replace('#','','g');
            window.location =  sanitizeuri;
            
        });
    })(jQuery);
   
</script>
