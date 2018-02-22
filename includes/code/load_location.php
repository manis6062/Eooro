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
    # * FILE: /includes/code/load_location.php
    # ----------------------------------------------------------------------------------------------------
    
    # ----------------------------------------------------------------------------------------------------
    # CODE
    # ----------------------------------------------------------------------------------------------------
	/*
	 * Check if is on sitemgr / members to use different function to get locations
	 */
	$use_sitemgr_function = false;
	if (string_strpos($_SERVER["REQUEST_URI"], SITEMGR_ALIAS) || string_strpos($_SERVER["REQUEST_URI"], MEMBERS_ALIAS)) {
		$use_sitemgr_function = true;
	}

	if ($advanced_search) {
        
		$show_legend = false;
		$has_default_location = false;
		if ($_default_locations_info) {
			$last_default_location = 0;
			$has_default_location = true;
			$locations_default_where = "";
			foreach($_default_locations_info as $_default_location_info) {
				if ($_default_location_info["show"] == "y") {
					if (!$show_legend && (is_array($_non_default_locations) && count($_non_default_locations) > 0) && !$newLocStyle) {
						$show_legend = true;
						?><label><?=system_showText(LANG_SEARCH_LABELLOCATION)?>:</label><?
					}
                    $locStr = "Location".$_default_location_info["type"];
                    $locObj = new $locStr($_default_location_info["id"]);
                    $locations_default_where .= $locObj->getString("name").", ";
				}
				?>
				<input type="hidden" name="location_<?=$_default_location_info["type"]?>" value="<?=$_default_location_info["id"]?>" /><?
				$last_default_location = $_default_location_info["type"]; 
			}
			$locations_default_where = string_substr($locations_default_where, 0, -2);
			$locations_default_where_replace = "yes";
			
			if (is_array($_non_default_locations) && ($_non_default_locations[0])) {
				foreach($_non_default_locations as $_location_level) {
					if (${"location_".$_location_level}) {
						$locations_default_where_replace = "no";
						break;
					}
				}
			}
			
            if ($newLocStyle) {
                $locations_default_where_replace = "no";
            }
			
			?>
			<input type="hidden" name="locations_default_where" id="locations_default_where" value="<?=$locations_default_where?>" />	
			<input type="hidden" name="locations_default_where_replace" id="locations_default_where_replace" value="<?=$locations_default_where_replace?>" />
			<?
		}

		if ($_non_default_locations) {
			if (!$show_legend && !$newLocStyle) {
				$show_legend = true;
				?>
				
				<label>
					<?=system_showText(LANG_SEARCH_LABELLOCATION)?>:
				</label>
				
				<?
			}
			$firstLoc = true;
			foreach($_non_default_locations as $_location_level) {
				system_retrieveLocationRelationship ($_non_default_locations, $_location_level, $_location_father_level, $_location_child_level);
				?>

				<div class="field loading-location" id="div_img_loading_<?=$_location_level?>" style="display:none;">
					<img src="<?=DEFAULT_URL?>/theme/<?=EDIR_THEME?>/images/iconography/icon-loading-footer.gif" alt="<?=system_showText(LANG_WAITLOADING)?>"/>
				</div>

				<div id="div_location_<?=$_location_level?>" <?=(${"locations".$_location_level} && ($_location_father_level !== false? ${"location_".$_location_father_level} : true) || ($has_default_location && $_location_level == ($last_default_location + 1) && ${"locations".$_location_level}) ) ? "" : "style=\"display:none;\""?>>

                    <select class="select" name="location_<?=$_location_level?>" id="location_<?=$_location_level?>" <? if ($_location_child_level) { ?> onchange="loadLocation('<?=DEFAULT_URL?>', '<?=EDIR_LOCATIONS?>', <?=$_location_level?>, <?=$_location_child_level?>, this.value, <?=($firstLoc ? "true" : "false")?>, <?=($newLocStyle ? "1" : "0")?>);" <? } elseif (!$newLocStyle) { ?> onchange="fillLocations('<?=EDIR_LOCATIONS?>')"<? } ?>>

						<option id="l_location_<?=$_location_level?>" value=""><?=system_showText(constant("LANG_SEARCH_LABELCB".constant("LOCATION".$_location_level."_SYSTEM")))?></option>
						
                        <? if (${"locations".$_location_level}) {
                            
							foreach(${"locations".$_location_level} as $each_location) {
                                
								//$selected = (${"location_".$_location_level} == $each_location["id"]) ? "selected" : "";
								?>
                                <option <?=$selected?> value="<?=$each_location["id"]?>"><?=$each_location["name"]?></option>
                                    
                                <?
								unset($selected);
							}
						}
						$firstLoc = false;
					?>
					</select>
                    
					<div class="field" id="box_no_location_found_<?=$_location_level?>" style="display: none;">&nbsp;</div>
                    
				</div>

				<?
			}
			
			$showClear = false;
			if ($location_1 || $location_2 || $location_3 || $location_4 || $location_5) {
				$showClear = true;
			}
			
			if (!$newLocStyle) { ?>
            
                <span class="clear-location" id="locations_clear" <?=($showClear ? "" : "style=\"display: none\"" )?>>
                    <a href="javascript:void(0);" class="view-button" onclick="clearLocations('<?=EDIR_LOCATIONS?>', <?=$has_default_location ? $has_default_location : 0?>, <?=$last_default_location ? $last_default_location : 0?>);">
                        <?=system_showText(LANG_BUTTON_CLEAR)?>
                    </a>
                </span>
            
			<? }
		}
		unset ($_location_father_level);
		unset ($_location_child_level);
		unset ($_location_level); 
		unset ($show_legend);
		unset($advanced_search);

	} else { ?>
		<div id="formsLocation" class="form-location">
			<table cellpadding="0" cellspacing="0" border="0" class="standard-table standardSIGNUPTable <?=$contact? "noMargin": "";?>"> <?

				if ($_default_locations_info) {
					foreach($_default_locations_info as $_default_location_info) {
						if ($_default_location_info["show"] == "y") {
							?>
							<tr>
								<th> <label for="location_<?=$_default_location_info["type"]?>"><?=system_showText(constant("LANG_LABEL_".constant("LOCATION".$_default_location_info["type"]."_SYSTEM")))?>:</label></th>
								<td colspan="2"> <?=$_default_location_info["name"]?> </td>
								<td>&nbsp;</td>
							</tr>
							<?
						} ?>
						<input type="hidden" name="location_<?=$_default_location_info["type"]?>" value="<?=$_default_location_info["id"]?>"><?
					}
				}

				if ($_non_default_locations) {
					
					unset($_non_default_locations[1], $_non_default_locations[2]);

					foreach($_non_default_locations as $_location_level) {

						system_retrieveLocationRelationship ($_non_default_locations, $_location_level, $_location_father_level, $_location_child_level);
						$location_name = system_showText(constant("LANG_LABEL_".constant("LOCATION".$_location_level."_SYSTEM")));
						?>

						<!-- Country -->

						<tr id="div_location_<?=$_location_level?>" <?=((${"locations".$_location_level} & $_POST["new_location".$_location_level."_field"]=="") || (!${"locations".$_location_level} && ${"location_".$_location_father_level} && !$_POST["new_location".$_location_level."_field"])) ? "" : "style=\"display:none;\""?>>
							<th><?if($location_name =="State") { $location_name = "State/County"; } ?>
								<label for="location_<?=$_location_level?>"><?=$location_name?>
									<span class="req">*</span>:
								</label>
							</th>
							<td class="field" id="div_img_loading_<?=$_location_level?>" style="display:none;">
								<img src="<?=DEFAULT_URL?>/images/content/img_loading_bar.gif" alt="<?=system_showText(LANG_WAITLOADING)?>"/>
							</td>
							<td id="div_select_<?=$_location_level?>" class="field locationSelect">
								<? if ($use_sitemgr_function) { ?>
									<select <?=($_GET['id'] ? 'style="width:96%;"' : 'style="width:100%;"');?> class="select <?=($highlight == "description" && !${"location_".$_location_level} ? "highlight" : "")?>" name="<?=($sitemgrSearch ? "search_" : "")?>location_<?=$_location_level?>" id="location_<?=$_location_level?>" <? if ($_location_child_level) { ?> onchange="loadLocationSitemgrMembers('<?=DEFAULT_URL?>', '<?=EDIR_LOCATIONS?>', <?=$_location_level?>, <?=$_location_child_level?>, this.value); <? if ($loadMap) { ?> loadMap(<?=$formLoadMap?>); <? } ?> " <? } elseif ($loadMap){ ?> onchange="loadMap(<?=$formLoadMap?>);" <? } ?> <?=$_GET['id'] ? "disabled": null;?>>
                                <? } else { ?>
									<select <?=((${"locations".$_location_level}) ? "" : "style=\"display:none\"")?> class="select" name="<?=($sitemgrSearch ? "search_" : "")?>location_<?=$_location_level?>" id="location_<?=$_location_level?>" <? if ($_location_child_level) { ?> onchange="loadLocation('<?=DEFAULT_URL?>', '<?=EDIR_LOCATIONS?>', <?=$_location_level?>, <?=$_location_child_level?>, this.value);" <? } ?>>
                                <? } ?>
                                        
									<option id="l_location_<?=$_location_level?>" value=""><?=system_showText(constant("LANG_SEARCH_LABELCB".constant("LOCATION".$_location_level."_SYSTEM")))?></option>
									<?
									if (is_array(${"locations".$_location_level})) {
                                        foreach(${"locations".$_location_level} as $each_location) {
                                            $selected = (${"location_".$_location_level} == $each_location["id"]) ? "selected" : "";
                                            ?><option <?=$selected?> value="<?=$each_location["id"]?>"><?=$each_location["name"]?></option><?
                                            unset($selected);
                                        }
                                    }
									?>
								</select>
								<div class="field" id="box_no_location_found_<?=$_location_level?>" <?=(!${"locations".$_location_level} && ${"location_".$_location_father_level} && !$_POST["new_location".$_location_level."_field"] ? "" : "style=\"display:none;\"")?>><?=system_showText(constant("LANG_LABEL_NO_LOCATIONS_FOUND"))?>.</div>
							</td>						
							<td class="field">
								<div id="div_new_location<?=$_location_level?>_link" <?=($_POST["new_location".$_location_level."_field"]==""?"":"style=\"display:none;\"")?> >
									<? if ($_location_level != 1 && !string_strpos($_SERVER["PHP_SELF"], "search.php")) { ?>
									<? } else echo "&nbsp;"; ?>
								</div>								
							</td>						
						</tr>

						<!-- State/County -->

						<tr id="div_location_3">
							<th>
								<label for="location_3">State / County
									<span class="req">*</span>:
								</label>
							</th>

							<td>
								<input id="stateCheck" value="<?=Location3::getName($listing->location_3)?>" onkeyup="showState(this.value)" autocomplete="off"  style="width:96%;" <?=$listing->location_1 ? null : "disabled"?>/>
								<div id="spinnerState" class="selectCounty" style="display:none;vertical-align:sub;" align="center">
								   <i class="fa fa-circle-o-notch fa-spin" style="color:#FF004F;font-size: 16px;"></i><br>
								</div>
								<select id="location_3" name="location_3" style="display:none;">
								<option value="<?=$listing->location_3?>" selected><?=Location3::getName($listing->location_3)?></option>
								</select>
									<div class="ac_results" id="stateResultDiv" style="position: absolute; width:  <?=($_GET['id'] ? '62.5%' : '42.5%');?>; display: none;">
										<ul id="stateResultUl" style="max-height: 180px; overflow: auto;">
										</ul>
									</div>
								<span class="categoryErrorMessage" id="stateNotFound"></span>
							</td>
						</tr>


						<!-- City -->

						<tr id="div_location_4">
							<th>	
								<label for="location_3">City
									<span class="req">*</span>:
								</label>
							</th>

							<td>
								<input id="cityCheck" value="<?=Location4::getName($listing->location_4)?>" onkeyup="showCity(this.value)" autocomplete="off" style="width:96%;" <?=$listing->location_4 ? null : "disabled"?>/>
								<div id="spinnerCity" class="selectCounty" style="display:none;vertical-align:sub;" align="center">
								   <i class="fa fa-circle-o-notch fa-spin" style="color:#FF004F;font-size: 16px;"></i><br>
								</div>
								<select id="location_4" name="location_4" style="display:none;">
								<option value="<?=$listing->location_4?>" selected><?=Location4::getName($listing->location_4)?></option>
								</select>
									<div class="ac_results" id="cityResultDiv" style="position: absolute; width: <?=($_GET['id'] ? '62.5%' : '42.5%');?>;display: none;">
										<ul id="cityResultUl" style="max-height: 180px; overflow: auto;">
										</ul>
									</div>
									<span class="categoryErrorMessage" id="cityNotFound"></span>

							</td>

						</tr>

						<? if ($_location_level != 1 && !string_strpos($_SERVER["PHP_SELF"], "search.php")) { ?>

							<tr id="div_new_location<?=$_location_level?>_field" <?=($_POST["new_location".$_location_level."_field"]!=""?"":($_POST["new_location".$_location_father_level."_field"]!=""?"":"style=\"display:none;\""))?>>
								<th>
									<label for="newlocation"><?=system_showText(constant("LANG_LABEL_ADD_A_NEW_".constant("LOCATION".$_location_level."_SYSTEM")))?>:</label>
								</th>
								<td class="field">
									<input type="text" name="new_location<?=$_location_level?>_field" id="new_location<?=$_location_level?>_field" value="<?=$_POST["new_location".$_location_level."_field"]?>" <? if ($_location_child_level) { ?> onfocus="showNewLocationField('<?=$_location_child_level?>', '<?=EDIR_LOCATIONS?>', false);" <? } ?> onblur="easyFriendlyUrl(this.value, 'new_location<?=$_location_level?>_friendly', '<?=FRIENDLYURL_VALIDCHARS?>', '<?=FRIENDLYURL_SEPARATOR?>'); <? if ($loadMap) { ?> loadMap(<?=$formLoadMap?>); " <? } elseif ($loadMap){ ?> onchange="loadMap(<?=$formLoadMap?>);" <? } ?>   />
									<input type="hidden" name="new_location<?=$_location_level?>_friendly" id="new_location<?=$_location_level?>_friendly" value="<?=$_POST["new_location".$_location_level."_friendly"]?>" />
								</td>
								<td class="field" colspan="2">
									<div id="div_new_location<?=$_location_level?>_back" <?=($_POST["new_location".$_location_father_level."_field"]==""?"":"style=\"display:none;\"")?>>
										<a href="javascript:void(0);" onclick="hideNewLocationField('<?=$_location_level?>', '<?=EDIR_LOCATIONS?>');" style=" cursor: pointer">- <?=system_showText(constant("LANG_LABEL_CHOOSE_AN_EXISTING_".constant("LOCATION".$_location_level."_SYSTEM")))?></a>
									</div>
								</td>
							</tr>
						<?
						}
					}				
					unset ($_location_father_level);
					unset ($_location_child_level);
					unset ($_location_level);
				}			
				?>
			</table>
		</div> <?
	} ?>

<?//Function to load map on page load ?>
<?if($claimlistingid):?>
	<script>
	$(window).load(function() {
		loadMap(document.listing); 
	});
	</script>
<?endif;?>


<script>
$('#location_1').on('change',function(){
	$('#location_3').html('<option selected></option>');
	$('#location_4').html('<option selected></option>');
	$('#stateCheck').val('');
	$('#cityCheck').val('');
	loadMap(document.listing);
	map.setZoom(map.getZoom() - 7);
	$('#zipnotfound').hide();

	$('#stateNotFound').hide();
	$('#cityNotFound').hide();

	<?//Empty location1 validation ?>
	
	if($('#location_1').val() == ""){
		$("#stateCheck").prop("disabled", true);
		$("#cityCheck").prop("disabled", true);
	} else {
		$("#stateCheck").prop("disabled", false);
		$("#cityCheck").prop("disabled", true);
	}
});

function showState(state){
	$('#spinnerState').show();
	$('#cityNotFound').hide();
	if(state != ''){
		$('#cityCheck').val('');
		$.post("<?=DEFAULT_URL?>/sponsors/ajax.php", { ajax_type:"loadState", state: state , loc_1 : $('#location_1').val() } ,function(data, status){
			$('#spinnerState').hide();
			if(data.trim() != "null"){	
		        var obj = JSON.parse(data);
		        $('#stateResultDiv').show();
		        $( '#stateResultUl' ).empty();
				
		        $.each(obj, function (key, value) {
				    var name = value.name;
				    var id   = value.id;
				    $('#stateResultUl').append('<li>'+name+'<input type="hidden" class="location_3" value="'+id+'"/></li>');
				})
				
		        $( '#stateResultUl' ).find( "li:odd" ).addClass( "ac_odd" );
		        $( '#stateResultUl' ).find( "li:even" ).addClass( "ac_even" );

				$('#stateResultUl').on('click', 'li', function(){
					$('#stateCheck').val($(this).text()); 
					$('#location_3').html('<option value='+$(this).find('.location_3').val()+' selected>'+$(this).text()+'<option>');
					$('#location_3').click();
					loadMap(document.listing);
					map.setZoom(map.getZoom() - 9);
					$('#stateResultDiv').hide();
					$('#zipnotfound').hide();
					$('#stateNotFound').hide();
					$("#cityCheck").prop("disabled", false);
				});
			} else {
				$('#stateNotFound').html('State/County not found.');
				$('#stateNotFound').show().fadeOut( 2000 );
				$('#stateCheck').siblings('.error').hide();
				$('#spinnerState').hide();
				$("#cityCheck").val('');
				$('#location_3').html('<option selected></option>');
				$('#location_4').html('<option selected></option>');
				$("#cityCheck").prop("disabled", true);
			}
	    });

	    $(document).click(function(){
			$('#stateResultDiv').hide();
		});
	} else {
		$('#spinnerState').hide();
	}

}

function showCity(city){
	$('#spinnerCity').show();
	if(city != ''){
		$.post("<?=DEFAULT_URL?>/sponsors/ajax.php", { ajax_type:"loadCity", city: city , loc_1 : $('#location_1').val(), loc_3:$('#location_3').val() } ,function(data, status){
		    $('#spinnerCity').hide();
		    if(data.trim() != "null"){	
		        var obj = JSON.parse(data);
		        $('#cityResultDiv').show();
		        $( '#cityResultUl' ).empty();
				
		        $.each(obj, function (key, value) {
				    var name = value.name;
				    var id   = value.id;
				    $('#cityResultUl').append('<li>'+name+'<input type="hidden" class="location_4" value="'+id+'"/></li>');
				})
				
		        $( '#cityResultUl' ).find( "li:odd" ).addClass( "ac_odd" );
		        $( '#cityResultUl' ).find( "li:even" ).addClass( "ac_even" );

				$('#cityResultUl').on('click', 'li', function(){
					$('#cityCheck').val($(this).text()); 
					$('#location_4').html('<option value='+$(this).find('.location_4').val()+' selected>'+$(this).text()+'<option>');
					$('#location_4').click();
					loadMap(document.listing);
					$('#cityResultDiv').hide();
					$('#zipnotfound').hide();
					$('#cityNotFound').hide();
				});
			} else {
				$('#cityNotFound').show().fadeOut( 2000 );
				$('#cityNotFound').html('City not found.');
			 	$('#cityNotFound').siblings('.error').hide();
				$('#spinnerCity').hide();
			}
	    });

	    $(document).click(function(){
			$('#cityResultDiv').hide();
		});
	} else {
		$('#spinnerCity').hide();
	}
}

</script>
