<?php
	
	include("../conf/loadconfig.inc.php");
	require CLASSES_DIR.'/apis/linkedin/functions.php';
	require CLASSES_DIR.'/apis/linkedin/oauth_client.php';
	require CLASSES_DIR.'/apis/linkedin/http.php';
	
		$redirect_url 		= DEFAULT_URL ."/sponsors/linkedinauth.php";
		$callbackURL 		= $redirect_url;
		
	 	setting_get("foreignaccount_linkedin", $foreignaccount_linkedin);
        if (!$foreignaccount_linkedin_apisecret) setting_get("foreignaccount_linkedin_apisecret", $foreignaccount_linkedin_apisecret);
        if (!$foreignaccount_linkedin_apikey) setting_get("foreignaccount_linkedin_apikey", $foreignaccount_linkedin_apikey);

		$linkedinApiKey 	= $foreignaccount_linkedin_apikey;
		$linkedinScope 		= 'r_basicprofile r_emailaddress';
		$linkedinApiSecret 	= $foreignaccount_linkedin_apisecret;

		$db = new DB;
		if (isset($_GET["oauth_problem"]) && $_GET["oauth_problem"] <> "") {
		  $_SESSION["err_msg"] = $_GET["oauth_problem"];
		   header('Location:'. DEFAULT_URL ."/profile/login.php");
		  exit;
		}

		//Build up parameters to send to linked in
		$client = new oauth_client_class;
		$client->debug 			= false;
		$client->debug_http 	= true;
		$client->redirect_uri 	= $callbackURL;
		$client->client_id 		= $linkedinApiKey;
		$application_line 		= __LINE__;
		$client->client_secret 	= $linkedinApiSecret;
		$client->scope 			= $linkedinScope;

		if (($success = $client->Initialize())) {

		  if (($success = $client->Process())) {
		    if (strlen($client->authorization_error)) {
		      $client->error = $client->authorization_error;
		      $success = false;
		    } 
		    elseif (strlen($client->access_token)) {
		      $success = $client->CallAPI(
							'http://api.linkedin.com/v1/people/~:(id,email-address,first-name,last-name,location,picture-url,public-profile-url,formatted-name)', 
							'GET', array(
								'format'=>'json'
							), array('FailOnAccessError'=>true), $user);

		    }

		  }
		  $success = $client->Finalize($success);
		  

		}
		if($_GET["advertise"] == "yes"){
			//Advertise page (claim your business)
			$redirect_url = DEFAULT_URL."/sponsors/";
		}  elseif ($_GET['claim'] == "yes"){
			//Claim page
			$redirect_url = $_SESSION['red_destiny'];
		} else {
			
			//Write review popup
			if($_SESSION['ITEM_ACTION'] == "rate"){
				$redirect_url = $_SESSION['red_destiny'];
			} else {
				//Login Page
				$redirect_url = DEFAULT_URL."/sponsors/";
			}
		}
		if ((strpos($_SESSION['red_destiny'], 'getlisting.php'))){
						$redirect_url = $_SESSION['red_destiny'];
				}

		//If sucess redirect user to sponsors
		if ($client->exit) exit;
			if ($success) {
			  	$user_id = $db->checkUser($user);

				$_SESSION['loggedin_user_id'] = $user_id;
				$_SESSION['user'] = $user;

			} else {
		 	 $_SESSION["err_msg"] = $client->error;
		}

		header('Location:'. $redirect_url);
		exit;
?>

