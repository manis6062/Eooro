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
	# * FILE: /includes/code/reviewformpopup.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
    if (sess_isAccountLogged() || $email_review){
	if (!$_GET['review'] && !$_POST['review']) {
		unset($review);
	}

	reset($_POST); foreach($_POST as $key=>$value) { $_POST[$key] = trim($value); }
	reset($_GET);  foreach($_GET as $key=>$value) { $_GET[$key] = trim($value); }
	
	extract($_POST);
	extract($_GET);
        
        
	$rating = $_POST["rating"];
	$review = $_POST["review"];
    // Review string sanatize
    $review = filter_var($review, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
       
    include(INCLUDES_DIR."/code/review.php");
    }
    else{ ?>
    <div class="alert alert-warning text-center">
    <p> <strong>Session Expired !</strong> <br>Your session has been expired, you must login to post your review. <br>
			You are being redirecting to login page.</p></div>
<script>
window.addEventListener('load', 
  function() { 
    $('.modal-content').hide();  	
  }, false);

setTimeout(function ()
    {
    	//$(document).removeClass('modal-content');
	    	


	if (self.name != '_refreshed_'){
	self.name = '_refreshed_';
	 //$('.modal-content').hide();  
	var DEFAULT_URL = "<?php echo DEFAULT_URL ?>"; 
	var previousurl =  document.referrer;
	var destiny =  window.parent.location.href;
	var get_uri=window.location.href;
	var last_value = get_uri.split('/');
	var check_pop_comefrom=last_value[5];
	if(check_pop_comefrom=="popup.php"){
	var fullurl = previousurl.split('&');
	var id = fullurl[2].split('=');
	var listing = fullurl[1].split('=');
	  var GET = window.location.search.substring(1);

	}
	else
	{
	var fullurl = get_uri.split('&');
	var id = fullurl[2].split('=');
	var listing = fullurl[1].split('=');
	}
	self.window.location.replace(""+DEFAULT_URL+"/popup/popup.php?pop_type=profile_login&destiny="+destiny+"&act=rate&type="+listing[1]+"&rate_item="+id[1]+"");
	    } else {
	        self.name = ''; 
	    }
	    }, 500);

	</script> 
	   <? }
	?>
