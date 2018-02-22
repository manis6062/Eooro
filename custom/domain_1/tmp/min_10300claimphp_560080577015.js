

/* File: /scripts/location.js */

function containerReload(){var Content;if($.browser.msie&&$.browser.version==6){try{xmlhttp=new XMLHttpRequest();}
catch(ee){try{xmlhttp=new ActiveXObject("Msxml2.XMLHTTP");}
catch(e){try{xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");}
catch(E){xmlhttp=false;}}}
try{Content=document.getElementById('LocationbaseAdvancedSearch').innerHTML;document.getElementById('LocationbaseAdvancedSearch').innerHTML="";document.getElementById('LocationbaseAdvancedSearch').innerHTML=Content;}catch(e){Content=document.getElementById('formsLocation').innerHTML;document.getElementById('formsLocation').innerHTML="";document.getElementById('formsLocation').innerHTML=Content;}}}
function loadLocationSitemgrMembers(url,edir_locations,level,childLevel,id){var edir_locations=edir_locations.split(',');if(!isNaN(id)){for(i=0;i<edir_locations.length;i++){if(edir_locations[i]>level){text=$("#l_location_"+edir_locations[i]).attr("text");$("#location_"+edir_locations[i]).html("<option id=\"l_location_"+edir_locations[i]+"\" value=\"\">"+text+"</option>");$('#div_location_'+edir_locations[i]).css('display','none');$('#new_location'+edir_locations[i]+'_field').attr('value','');$('#div_new_location'+edir_locations[i]+'_field').css('display','none');}}
$("#div_location_"+childLevel).css("display","");$('#location_'+childLevel).css('display','none');$('#div_img_loading_'+childLevel).css('display','');$('#box_no_location_found_'+childLevel).css('display','none');try{$('#div_select_'+childLevel).css('display','none');}catch(e){}
$.get(url+"/sponsors/location.php",{id:id,level:level,childLevel:childLevel,type:'byId'},function(location){if(location!="empty"){var text=$("#l_location_"+childLevel).attr("text");$("#location_"+childLevel).html(location);$("#l_location_"+childLevel).html(text);$('#location_'+childLevel).css('display','');try{$('#div_select_'+childLevel).css('display','');}catch(e){}
display_level_limit=childLevel;}else{if(!id)
$("#div_location_"+childLevel).css("display",'none');else{try{$('#div_select_'+childLevel).css('display','');}catch(e){}
$('#box_no_location_found_'+childLevel).css('display','');}}
if(childLevel&&id)
$('#div_new_location'+childLevel+'_link').css('display','');else
$('#div_new_location'+childLevel+'_link').css('display','none');$('#div_img_loading_'+childLevel).css('display','none');});}
containerReload();}
function loadLocation(url,edir_locations,level,childLevel,id,showClear,newStyle){var aux_edir_locations=edir_locations;var edir_locations=edir_locations.split(',');if(!isNaN(id)){for(i=0;i<edir_locations.length;i++){if(edir_locations[i]>level){text=$("#l_location_"+edir_locations[i]).text();$("#location_"+edir_locations[i]).html("<option id=\"l_location_"+edir_locations[i]+"\" value=\"\">"+text+"</option>");$('#div_location_'+edir_locations[i]).css('display','');$('#new_location'+edir_locations[i]+'_field').attr('value','');$('#div_new_location'+edir_locations[i]+'_field').css('display','none');}}
$("#div_location_"+childLevel).css("display","");$('#location_'+childLevel).css('display','none');$('#location_'+level).prop('disabled','true');$('#div_img_loading_'+childLevel).css('display','');if($('#locations_clear')){$('#locations_clear').css('display','none');}
$('#box_no_location_found_'+childLevel).css('display','none');try{$('#div_select_'+childLevel).css('display','none');}catch(e){}
$.get(url+"/location.php",{id:id,level:level,childLevel:childLevel,type:'byId'},function(location){if(location!="empty"){var text=$("#l_location_"+childLevel).text();$("#location_"+childLevel).html(location);$("#l_location_"+childLevel).html(text);if(newStyle!="1"){$('#location_'+childLevel).css('display','');}
try{$('#div_select_'+childLevel).css('display','');}catch(e){}
display_level_limit=childLevel;}else{if(!id){if(newStyle!="1"){$("#div_location_"+childLevel).css("display",'');}}else{try{$('#div_select_'+childLevel).css('display','');}catch(e){}
$('#box_no_location_found_'+childLevel).css('display','');}}
if(childLevel&&id){$('#div_new_location'+childLevel+'_link').css('display','');}else{if(newStyle!="1"){$('#div_new_location'+childLevel+'_link').css('display','none');}}
$('#location_'+level).prop('disabled','');$('#div_img_loading_'+childLevel).css('display','none');if($('#locations_clear')){$('#locations_clear').css('display','');}
if(location!="empty"){for(i=0;i<edir_locations.length;i++){if(edir_locations[i]!=childLevel){if(newStyle!="1"){$('#div_location_'+edir_locations[i]).css('display','');}}}}else{if(newStyle!="1"){$('#div_location_'+childLevel).css('display','');}}
if(newStyle!="1"){fillLocations(aux_edir_locations);}else{if($().selectpicker){$('.selectpicker .select').selectpicker('refresh');}}
if(showClear){$('#locations_clear').css('display','');}});}
containerReload();}
function loadLocationsChildtb(url,level,id,childLevel){if(!isNaN(id)){$.get(url+"/location.php",{id:id,level:level,childLevel:childLevel,type:'byId'},function(location){var text=$("#l_location_"+childLevel).attr("text");if(location!="empty"){$("#select_L"+childLevel).html(location);$("#l_location_"+childLevel).html(text);}else
$("#select_L"+childLevel).html('<option id=\"l_location_'+childLevel+'\" value=\"\">'+text+'</option>');});}
containerReload();}
function loadAllLocationstb(url,level){$.get(url+"/location.php",{level:level,type:'All'},function(location){if(location!="empty"){var text=$("#l_location_"+level).attr("text");alert('all text: '+text);$("#select_L"+level).html(location);$("#l_location_"+level).html(text);}});containerReload();}
function loadLocationsChild(url,level,id,childLevel){if(!isNaN(id)){$.get(url+"/location.php",{id:id,level:level,childLevel:childLevel,type:'byId'},function(location){var text=$("#l_location_"+childLevel).attr("text");if(location!="empty"){$("#default_L"+childLevel+"_id").html(location);$("#l_location_"+childLevel).html(text);}else
$("#default_L"+childLevel+"_id").html('<option id=\"l_location_'+childLevel+'\" value=\"\">'+text+'</option>');});}
containerReload();}
function loadAllLocations(url,level){$.get(url+"/location.php",{level:level,type:'All'},function(location){if(location!="empty"){var text=$("#l_location_"+level).attr("text");$("#default_L"+level+"_id").html(location);$("#l_location_"+level).html(text);}});containerReload();}
function formLocations_submit(level,form){if(level<=3){for(i=(level+1);i<=4;i++)
if($('#select_location'+i).val())
$('#select_location'+i).remove();}
form.submit();}
function showNewLocationField(level,edir_locations,back,text){var edir_locations=edir_locations.split(',');for(i=0;i<edir_locations.length;i++){if(edir_locations[i]>=level){$('#div_location_'+edir_locations[i]).css('display','none');$('#new_location'+edir_locations[i]+'_field').attr('value','');$('#div_new_location'+edir_locations[i]+'_field').css('display','none');}}
$('#div_new_location'+level+'_field').css('display','');$('#div_new_location'+level+'_link').css('display','none');if(!back)
$('#div_new_location'+level+'_back').css('display','none');else
$('#div_new_location'+level+'_back').css('display','');if(text){$('#new_location'+level+'_field').val(text);}}
function hideNewLocationField(level,edir_locations){var edir_locations=edir_locations.split(',');for(i=0;i<edir_locations.length;i++){if(edir_locations[i]>=level){$('#new_location'+edir_locations[i]+'_field').attr('value','');$('#div_new_location'+edir_locations[i]+'_field').css('display','none');}}
$('#div_location_'+level).css('display','');$('#div_new_location'+level+'_link').css('display','');if(!$("#location_"+level).is(":visible")){$('#box_no_location_found_'+level).css('display','');}}
function fillFieldWhere(location_title){if(document.getElementById("where")){if(document.getElementById("where").value!=''){document.getElementById("where").value+=', '+location_title;}else{document.getElementById("where").value+=location_title;}}
if(document.getElementById("where_resp")){if(document.getElementById("where_resp").value!=''){document.getElementById("where_resp").value+=', '+location_title;}else{document.getElementById("where_resp").value+=location_title;}}}
function fillLocations(levels){var edir_locations=levels.split(',');if(edir_locations){if(document.getElementById("where")){$("#where, #where_resp").attr("value","");}
if(document.getElementById("locations_default_where")){if(document.getElementById("locations_default_where").value){$("#where, #where_resp").attr("value",$("#locations_default_where").val());}}
for(i=0;i<edir_locations.length;i++){if($("#location_"+edir_locations[i]+" option:selected").val()>0){fillFieldWhere($("#location_"+edir_locations[i]+" option:selected").text());}}}}
function clearLocations(levels,has_default,last_default){var edir_locations=levels.split(',');var first_to_show=0;document.getElementById("where").value="";for(i=0;i<edir_locations.length;i++){if(i>first_to_show){$('#div_location_'+edir_locations[i]).css('display','none');}else{$('#div_location_'+edir_locations[i]).css('display','');$("#location_"+edir_locations[i]).prop("selectedIndex",0);}
if(has_default){if(edir_locations[i]==last_default){first_to_show=i+1;}}}
$('#locations_clear').css('display','none');}

/* File: /scripts/checkusername.js */

function checkUsername(username,path,option,current_acc){expression=/(&\B)|(^&)|(#\B)|(^#)/;if(expression.exec(username)){username='erro';}
$.get(DEFAULT_URL+"/search_username.php",{option:option,username:username,path:path,current_acc:current_acc},function(response){$('#checkUsername').html(response);});}

/* File: /scripts/advertise.js */

var activeNextStep=true;function nextStep(item_type,feed,item_title,gotoPackage,finalStep){if(!activeNextStep){return;}
activeNextStep=false;var paymentRadio=$('input[name=payment_method]');var checkedValue=paymentRadio.filter(':checked').val();if(finalStep){$("#screenPackage").hide();$("#screen2").fadeIn();activeNextStep=true;}else{disableButtons();var return_categories="";if(feed!=false){for(i=0;i<feed.length;i++){if(!isNaN(feed.options[i].value)){if(return_categories.length>0){return_categories=return_categories+","+feed.options[i].value;}else{return_categories=return_categories+feed.options[i].value;}}}}
var payment_selected=0;if(checkedValue||$("#free_item").val()=="1"||$("#userLogged").val()=="1"){payment_selected=1;}
$.post(DEFAULT_URL+"/validateAdvertise.php",{item_type:item_type,signup:1,title:$("#"+item_title).val(),friendly_url:$("#friendly_url").val(),return_categories:return_categories,discount_id:$("#promocode").val(),start_date:$("#start_date").val(),end_date:$("#end_date").val(),type:$("#type").val(),caption:$("#"+item_title).val(),expiration_setting:$("#expiration_setting").val(),unpaid_impressions:$("#unpaid_impressions").val(),has_payment:payment_selected},function(response){if(response=="ok"){$("#errorMessage").hide();$("#screen1").hide();$("#screen2").hide();if(gotoPackage){$("#screenPackage").fadeIn();}else{$("#screen2").fadeIn();}
setRequiredVariablesToCookie();}else{$("#errorMessage").html("<p class=\"errorMessage\">"+response+"</p>");$('html, body').animate({scrollTop:$('#errorMessage').offset().top},500);$("#errorMessage").fadeIn();}
activeNextStep=true;enableButtons();});}}
function backStep(is_package,go_package){if(is_package){$("#screenPackage").hide();}
$("#screen1").hide();$("#screen2").hide();if(go_package){$("#screenPackage").fadeIn();}else{$("#screen1").fadeIn();}}
function submitForm(formName){if(typeof updateFormAction=="function"){updateFormAction();}
if(formName=="formDirectory"){$("#form_username").attr("value",$("#dir_username").val());$("#form_password").attr("value",$("#dir_password").val());document.formDirectory.submit();}else if(formName=="formCurrentUser"){document.formCurrentUser.submit();}}
function disableButtons(){var i;for(i=1;i<=2;i++){document.getElementById('button'+i).innerHTML=LANG_JS_WAIT;}}
function enableButtons(){var i;for(i=1;i<=2;i++){document.getElementById('button'+i).innerHTML=LANG_JS_CONTINUE;}}
function acceptPackage(pvalue){$("#using_package").attr("value",pvalue);updateFormAction();}

/* File: /scripts/socialbookmarking.js */

function getAbsoluteTop(oElement){var iReturnValue=0;while(oElement!=null){iReturnValue+=oElement.offsetTop;oElement=oElement.offsetParent;}
return iReturnValue;}
function getAbsoluteLeft(oElement){var iReturnValue=0;while(oElement!=null){iReturnValue+=oElement.offsetLeft;oElement=oElement.offsetParent;}
return iReturnValue;}
function enableSocialBookMarking(id,module,url,comments,checkins){if(comments===undefined){comments=0;}
if(checkins===undefined){checkins=0;}
var left=0+getAbsoluteLeft(document.getElementById('link_social_'+id+module));var top=18+getAbsoluteTop(document.getElementById('link_social_'+id+module));$.ajax({type:"POST",url:url+"/includes/code/socialbookmarking_ajax.php",data:"id="+id+"&module="+module+"&comments="+comments+"&checkins="+checkins,success:function(msg){$('#div_to_share').html(msg);}});$('#div_to_share').css('top',top+'px').css('left',left+"px").css('z-index','1000').show('fast');}
function disableSocialBookMarking(){$('#div_to_share').hide('fast');}

/* File: /scripts/contactclick.js */

function showPhone(listingid,default_url){try{xmlhttp=new XMLHttpRequest();}catch(exc){try{xmlhttp=new ActiveXObject("Msxml2.XMLHTTP");}catch(ex){try{xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");}catch(e){xmlhttp=false;}}}
if(xmlhttp){xmlhttp.open("GET",default_url+'/countphoneclick.php?listing_id='+listingid,true);xmlhttp.send(null);}
document.getElementById("phoneLink"+listingid).className="hide";document.getElementById("phoneNumber"+listingid).className="show-inline";}
function showFax(listingid,default_url){try{xmlhttp=new XMLHttpRequest();}catch(exc){try{xmlhttp=new ActiveXObject("Msxml2.XMLHTTP");}catch(ex){try{xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");}catch(e){xmlhttp=false;}}}
if(xmlhttp){xmlhttp.open("GET",default_url+'/countfaxclick.php?listing_id='+listingid,true);xmlhttp.send(null);}
document.getElementById("faxLink"+listingid).className="hide";document.getElementById("faxNumber"+listingid).className="show-inline";}