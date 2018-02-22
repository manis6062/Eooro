<?php 

if( CountryLoader::getCountryName() == 'United States' ): 

    $countryId  = CountryLoader::getCountryId();
    $states     = CountryLoader::getStateList( CountryLoader::getCountryId() );
?>

<select name="selected-state" id="selected-state">
    <?php 
    
    echo '<option value="0">-- Select State --</option>';
    foreach ( $states as $state ){
        $selected = ( $state['id'] == CountryLoader::getStateId($countryId) ) ? 'selected="selected"' : '';
        echo '<option value="'.$state['id'].'-'.$state['name'].'" '.$selected.'>'.$state['name'].'</option>';
    }
    ?>
</select>
<?php endif;

?>
<script>
setLocationToCookie('location_state','selected-state');
</script>
