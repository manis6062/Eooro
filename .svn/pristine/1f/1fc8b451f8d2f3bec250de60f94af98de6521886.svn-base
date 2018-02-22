
<?php
//echo $listing;
?>
<link href="https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel="stylesheet">
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<!--<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
<script src="https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>-->

<script src="<?=DEFAULT_URL ?>/scripts/jquery/jquery-1.10.2.js"></script>
<script src="<?=DEFAULT_URL ?>/scripts/jquery/jquery_ui/js/jquery-ui-1.10.4.js"></script> 


<div id="formsLocation" class="form-location">
    <div  style="border:none" cellpadding="0" cellspacing="0" border="0" class=" standardSIGNUPTable <?= $contact ? "noMargin" : ""; ?>">
        <!-- Country -->
        <div id="div_location_1" class="form-group fullWidth">
            <div class="col-md-12">
                <label for="location_1">Country
                    <span class="asterik">*</span>:
                </label>
            </div>
<!--            <div class="field" id="div_img_loading" style="display:none;">
                <img src="<?= DEFAULT_URL ?>/images/content/img_loading_bar.gif" alt="<?= system_showText(LANG_WAITLOADING) ?>"/>
            </div>-->
            <div class="col-md-12 field locationSelect">
                <?php 
                    if(isset($listing)){
                        $location1Obj= new Location1($listing->location_1);
                        $location3Obj=new Location3($listing->location_3);
                        $location4Obj=new Location4($listing->location_4);
                    }
                ?>
                <input tabindex="12" id="input_location_1" class="form-control location-input" name="input_location_1" type="text" <?php if(isset($location1Obj)){echo "value='".$location1Obj->name."'";} ?>>
                <input id="location_1" name="location_1" type="hidden" <?php if(isset($location1Obj)){echo "value='".$location1Obj->id."'";} ?>>
            </div>						
        </div>



        <!-- State/County -->

        <div id="div_location_3" class="form-group fullWidth">
            <div class="col-md-12">
                <label for="location_3">State/County
                    <span class="asterik">*</span>:
                </label>
            </div>

            <div class="col-md-12">
                <input tabindex="13" id="input_location_3" class="form-control location-input" name="input_location_3" type="text" <?php if(isset($location3Obj)){echo "value='".$location3Obj->name."'";} ?> />
                <input id="location_3" name="location_3" type="hidden" <?php if(isset($location3Obj)){echo "value='".$location3Obj->id."'";} ?> >
            </div>
        </div>


        <!-- City -->

        <div id="div_location_4" class="form-group fullWidth">
            <div class="col-md-12">	
                <label for="location_4">City
                    <span class="asterik">*</span>:
                </label>
            </div>

            <div class="col-md-12">
                <input tabindex="14" id="input_location_4" class="form-control location-input" name="input_location_4" type="text"  autocomplete="off" <?php if(isset($location4Obj)){echo "value='".$location4Obj->name."'";} ?> />
                <input id="location_4" name="location_4" type="hidden" <?php if(isset($location4Obj)){echo "value='".$location4Obj->id."'";} ?>>

            </div>

        </div>
        <div id="addLocation" style="display: none;" >
            <div></div>
            <div>
                <span class="txt-success">New address being added to system this will be validated and approved by Site manager</span>
            </div>
        </div>
    </div>
    
</div>
<script>
    //$ changed to $j dur to conflict in jquery
    var $j = jQuery.noConflict();
//    var availableLocation1;// defined in sponsors/listing/listing
    var availaibleLocation3,availaibleLocation4;
//    var validCountry=false;
    var addLocation3=false;
    var addLocation4=false;

    function loadLocation1() {
        <?php
            $loacation_1 = Location1::retrieveAllLocation();
            
            foreach($loacation_1 as $loc1){
                $array["label"]=$loc1['name'];
                $array["value"]=$loc1['name'];
                $array["id"]=$loc1['id'];
                $final[]=$array;
            }
            $json_locations1 = json_encode($final);
        ?>
        availableLocation1 = <?php echo $json_locations1 ?>;
//        console.log(availableLocation1);

        $j("#input_location_1").autocomplete({
            source: availableLocation1,
            select: function (event, selected) {
                $("#location_1").val(selected.item.id);
                loadLocation3(selected.item.id);
            }
        });
    }
    function loadLocation3(location1) {
        var url="<?=DEFAULT_URL ?>/sponsors/load_location3_ajax.php?location1="+location1;
        $j.ajax({
            url: url,
            success: function(data){
                availableLocation3=data;
//                loadMap();
//                    console.log(data);
                $j("#input_location_3").autocomplete({
                    source: data,
                    select: function (event, selected) {
                        $j("#location_3").val(selected.item.id);
                        loadLocation4($("#location_1").val(),selected.item.id);
                    }
                });
            },
            dataType: "json"
          });
    }
    function loadLocation4(location1,location3){
        var url="<?=DEFAULT_URL ?>/sponsors/load_location4_ajax.php?location1="+location1+"&location3="+location3;
        $j.ajax({
            url: url,
            success: function(data){
                availableLocation4=data;
//                    console.log(data);
                $j("#input_location_4").autocomplete({
                    source: data,
                    select: function (event, selected) {
                        $j("#location_4").val(selected.item.id);
//                        loadLocation4(selected.item.id);
                    }
                });
            },
            dataType: "json"
          });
    }
    function showLocationAddMessage(){
        console.log(addLocation3);
        console.log(addLocation4);
        if((addLocation3==true && $j('input_location_3').val()!='')||(addLocation4==true && $j('input_location_4').val()!='')){
            $j("#addLocation").css('display','');
        }
        else{
            $j("#addLocation").css('display','none');
        }
    }
</script>
<script>
    loadLocation1();
    <?php 
        //edit mode...
        if(isset($listing)){
    ?>
        var location1_id=$j('#location_1').val();
        var location3_id=$j('#location_3').val();
        loadLocation3(location1_id);
        loadLocation4(location1_id,location3_id);
        
    <?php
        }
    ?>
    
    $(document).ready(function(){
        $j("#input_location_1").focusout(function(){
            var index;
            for (index = 0; index < availableLocation1.length; ++index) {
                var name=availableLocation1[index].value;
                var id=availableLocation1[index].id;
                if(name.toUpperCase()==$j(this).val().toUpperCase()){
//                    console.log('selected='+name);
                    $j("#input_location_1").val(name);
                    $j("#location_1").val(id);
                    loadLocation3(id);
//                    validCountry=true;
                    return false;
                }
            }
//            validCountry=false;
//            console.log('valid='+validCountry);
        });
        $j("#input_location_3").focusout(function(){
            var index;
            for (index = 0; index < availableLocation3.length; ++index) {
                var name=availableLocation3[index].value;
                var id=availableLocation3[index].id;
                if(name.toUpperCase()==$j(this).val().toUpperCase()){
//                    console.log('selected='+name);
                    $j("#input_location_3").val(name);
                    $j("#location_3").val(id);
                    loadLocation4($j("#location_1").val(),id);
                    addLocation3=false;
                    showLocationAddMessage();
                    return false;
                }
                else{
                    $j("#location_3").val('');
                    addLocation3=true;
                    if($j(this).val()!=''){
                        showLocationAddMessage();
                    }
                }
            }
            
                    
        });
        $j("#input_location_4").focusout(function(){
            var index;
            for (index = 0; index < availableLocation4.length; ++index) {
                var name=availableLocation4[index].value;
                var id=availableLocation4[index].id;
                if(name.toUpperCase()==$j(this).val().toUpperCase()){
//                    console.log('selected='+name);
                    $j("#input_location_4").val(name);
                    $j("#location_4").val(id);
                    addLocation4=false;
                    showLocationAddMessage();
                    return false;
                }
                else{
                    $j("#location_4").val('');
                    addLocation4=true;
                    if($j(this).val()!=''){
                        showLocationAddMessage();
                    }
                }
            }
            
        });
        
        // change events...
        $j("#input_location_3").change(function(){
            $j("#input_location_4").val('');
            $j("#location_4").val('');
        });
        $j("#input_location_1").change(function(){
            $j("#input_location_3").val('');
            $j("#location_3").val('');
            $j("#input_location_4").val('');
            $j("#location_4").val('');
        });
    });
</script>

