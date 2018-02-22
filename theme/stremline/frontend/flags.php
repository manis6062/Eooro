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
    <h4> Location </h4>
    
    <?  $i = 0;
        while( $countries[$i] ):
        $grey = ( $country == $countries[$i]['id'] ) ? '' : '-grey';
    ?>
    <img src="<?=THEMEFILE_URL.'/'.EDIR_THEME.'/images/iconography/'.strtolower($countries[$i]['abbreviation']).$grey.'.png';?>" class="flag" alt="<?=$countries[$i]['name']?>" title="<?=$countries[$i]['name']?>" id="<?=$countries[$i]['id'].'-'.$countries[$i]['abbreviation']?>"/>
    <? $i++; endwhile; ?>
</div>
<script>
        
        $( '.flag' ).on( 'click', function(event){
            var self    = $(this);
            var val     = self.attr( 'id' );
            var id      = val.split('-')[0];
            var title   = self.attr( 'title' );
            var folder  = '<?=EDIRECTORY_FOLDER?>'; 
            if( folder.trim() !== '' ){
                cookCookies.setCookie( 'location_geoip', title, 0, '<?="".EDIRECTORY_FOLDER."/"?>' ); 
                cookCookies.setCookie( 'location_geoip_id', id, 0, '<?="".EDIRECTORY_FOLDER."/"?>' );
            }
            else{
                cookCookies.setCookie( 'location_geoip', title, 0 ); 
                cookCookies.setCookie( 'location_geoip_id', id, 0 );
            }
            resetState();
            window.location = '<?=DEFAULT_URL?>';
            
        });
        
    </script>