

/* File: /scripts/contactclick.js */

function showPhone(listingid,default_url){try{xmlhttp=new XMLHttpRequest();}catch(exc){try{xmlhttp=new ActiveXObject("Msxml2.XMLHTTP");}catch(ex){try{xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");}catch(e){xmlhttp=false;}}}
if(xmlhttp){xmlhttp.open("GET",default_url+'/countphoneclick.php?listing_id='+listingid,true);xmlhttp.send(null);}
document.getElementById("phoneLink"+listingid).className="hide";document.getElementById("phoneNumber"+listingid).className="show-inline";}
function showFax(listingid,default_url){try{xmlhttp=new XMLHttpRequest();}catch(exc){try{xmlhttp=new ActiveXObject("Msxml2.XMLHTTP");}catch(ex){try{xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");}catch(e){xmlhttp=false;}}}
if(xmlhttp){xmlhttp.open("GET",default_url+'/countfaxclick.php?listing_id='+listingid,true);xmlhttp.send(null);}
document.getElementById("faxLink"+listingid).className="hide";document.getElementById("faxNumber"+listingid).className="show-inline";}

/* File: /scripts/socialbookmarking.js */

function getAbsoluteTop(oElement){var iReturnValue=0;while(oElement!=null){iReturnValue+=oElement.offsetTop;oElement=oElement.offsetParent;}
return iReturnValue;}
function getAbsoluteLeft(oElement){var iReturnValue=0;while(oElement!=null){iReturnValue+=oElement.offsetLeft;oElement=oElement.offsetParent;}
return iReturnValue;}
function enableSocialBookMarking(id,module,url,comments,checkins){if(comments===undefined){comments=0;}
if(checkins===undefined){checkins=0;}
var left=0+getAbsoluteLeft(document.getElementById('link_social_'+id+module));var top=18+getAbsoluteTop(document.getElementById('link_social_'+id+module));$.ajax({type:"POST",url:url+"/includes/code/socialbookmarking_ajax.php",data:"id="+id+"&module="+module+"&comments="+comments+"&checkins="+checkins,success:function(msg){$('#div_to_share').html(msg);}});$('#div_to_share').css('top',top+'px').css('left',left+"px").css('z-index','1000').show('fast');}
function disableSocialBookMarking(){$('#div_to_share').hide('fast');}