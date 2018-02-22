<?php include("./conf/loadconfig.inc.php"); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js" >
<? script_loader($js_fileLoader, $pag_content, $aux_module_per_page, $id, $aux_show_twitter); ?>


<center>
	<div class="select-state">
                        <h5> Please Select your state : </h5>
			<div id="custom-search-input" class="search-advanced">

			<?php 

				if( CountryLoader::getCountryName() == 'United States' ): 

				    $countryId  = CountryLoader::getCountryId();
				    $states     = CountryLoader::getStateList( CountryLoader::getCountryId() );
			?>

			<select name="selected-state" id="selected-state" class="required infor form-control country">
			    	
			    	<option>-- Select State --</option>

			    <?php 
			    
			    

			    foreach ( $states as $state ){
			        $selected = ( $state['id'] == CountryLoader::getStateId($countryId) ) ? 'selected="selected"' : '';
			        echo '<option value="'.$state['id'].'-'.$state['name'].'" '.$selected.'>'.$state['name'].'</option>';
			    }			    ?>
			</select>
			<?php endif;?>
</div>

</center>

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

		function resetState(){
		        setToCookie( 'location_state', '' );
		        setToCookie( 'location_state_id', '' );
		    }
		 function setToCookie( cookie_name, cookie_value, expire ){
		        var folder  = '<?=EDIRECTORY_FOLDER?>'; 
		        var exp     = expire ? expire : 0;
		        if( folder.trim() !== '' ){
		            cookCookies.setCookie( cookie_name, cookie_value, exp, '/10300/' ); 
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
		                cookCookies.setCookie( location_name, title, 0, '<?="".EDIRECTORY_FOLDER."/"?>' ); 
		                cookCookies.setCookie( location_name+'_id', id, 0, '<?="".EDIRECTORY_FOLDER."/"?>' );
		            }
		            window.top.location.href ='<?=DEFAULT_URL?>';
		            parent.$.fancybox.close();
		        }); 
		    }
 </script>

<script>
setLocationToCookie('location_state','selected-state');
</script>
