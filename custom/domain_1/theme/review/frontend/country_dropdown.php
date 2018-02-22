<?php
/**
 * @author          Subigya Jyoti Panta
 * @subpackage      Country Header
 * @copyright (c) 2014, www.eooro.com
 * @version         1.0
 * @modification history original
 */
include_once CLASSES_DIR.DIRECTORY_SEPARATOR.'class_God.php';
$countries = CountryLoader::getCountryList();
?>
<select name="selected-country" id="selected-country">
    <?php 
    foreach( $countries as $coun ){
        $selected = ( $coun['id'] == CountryLoader::getCountryId() ) ? 'selected="selected"' : '';
        echo '<option value="'.$coun['id'].'-'.$coun['name'].'" '.$selected.'>'.$coun['name'].'</option>';
    }
    ?>
</select>
<script>
    var cookCookies = {
        getCookie: function( name ){
            if (document.cookie.length > 0) {
                var c_start = document.cookie.indexOf(name + "=");
                if (c_start != -1) {
                    c_start = c_start + name.length + 1;
                    var c_end = document.cookie.indexOf(";", c_start);
                    if (c_end == -1) {
                        c_end = document.cookie.length;
                    }
                    return decodeURI(document.cookie.substring(c_start, c_end));
                }
            }
            return "";
        },
        setCookie: function (sKey, sValue, vEnd, sPath, sDomain, bSecure) {
            if (!sKey || /^(?:expires|max\-age|path|domain|secure)$/i.test(sKey)) { return false; }
            var sExpires = "";
            if (vEnd) {
                switch (vEnd.constructor) {
                    case Number:
                        sExpires = vEnd === Infinity ? "; expires=Fri, 31 Dec 9999 23:59:59 GMT" : "; max-age=" + vEnd;
                        break;
                    case String:
                        sExpires = "; expires=" + vEnd;
                        break;
                    case Date:
                        sExpires = "; expires=" + vEnd.toUTCString();
                        break;
                }
            }
            document.cookie = encodeURIComponent(sKey) + "=" + encodeURIComponent(sValue) + sExpires + (sDomain ? "; domain=" + sDomain : "") + (sPath ? "; path=" + sPath : "") + (bSecure ? "; secure" : "");
            return true;
        }
    };
    // for country select field
//    $( '#selected-country' ).on( 'change', function(event){
//        var select  = $(this).val();
//        select      = select.split('-');
//        var id      = select[0];
//        var title   = select[1];
//        console.log( id );
//        var folder  = '<?=EDIRECTORY_FOLDER?>'; 
//        if( folder.trim() !== '' ){
//            cookCookies.setCookie( 'location_geoip', title, 0, '<?="".EDIRECTORY_FOLDER."/"?>' ); 
//            cookCookies.setCookie( 'location_geoip_id', id, 0, '<?="".EDIRECTORY_FOLDER."/"?>' );
//        }
//        else{
//            cookCookies.setCookie( 'location_geoip', title, 0 ); 
//            cookCookies.setCookie( 'location_geoip_id', id, 0 );
//        }
//        window.location = '<?=DEFAULT_URL?>';
//    });
    function resetState(){
        setToCookie( 'location_state', '' );
        setToCookie( 'location_state_id', '' );
    }
    function setToCookie( cookie_name, cookie_value, expire ){
        var folder  = '<?=EDIRECTORY_FOLDER?>'; 
        var exp     = expire ? expire : 0;
        if( folder.trim() !== '' ){
            cookCookies.setCookie( cookie_name, cookie_value, exp, '<?="".EDIRECTORY_FOLDER."/"?>' ); 
        }
        else{
            cookCookies.setCookie( cookie_name, cookie_value, exp ); 
        }
    }
    function setLocationToCookie( location_name, id_of_element ){
       $( '#' + id_of_element ).on( 'change', function(event){
            resetState();
            var select  = $(this).val();
            select      = select.split('-');
            var id      = select[0];
            var title   = select[1];
            console.log( id );
            var folder  = '<?=EDIRECTORY_FOLDER?>'; 
            if( folder.trim() !== '' ){
                cookCookies.setCookie( location_name, title, 0, '<?="".EDIRECTORY_FOLDER."/"?>' ); 
                cookCookies.setCookie( location_name+'_id', id, 0, '<?="".EDIRECTORY_FOLDER."/"?>' );
            }
            else{
                cookCookies.setCookie( location_name, title, 0 ); 
                cookCookies.setCookie( location_name+'_id', id, 0 );
            }
            window.location = '<?=DEFAULT_URL?>';
        }); 
    }
    
    setLocationToCookie( 'location_geoip', 'selected-country' );
</script>