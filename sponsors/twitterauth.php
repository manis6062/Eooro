<?php

		include("../conf/loadconfig.inc.php");

		session_start();
		setting_get("foreignaccount_twitter", $foreignaccount_twitter);
        if (!$foreignaccount_twitter_apisecret) setting_get("foreignaccount_twitter_apisecret", $foreignaccount_twitter_apisecret);
        if (!$foreignaccount_twitter_apikey) setting_get("foreignaccount_twitter_apikey", $foreignaccount_twitter_apikey);
		define('CONSUMER_KEY', $foreignaccount_twitter_apikey);
		define('CONSUMER_SECRET', $foreignaccount_twitter_apisecret);
		define('OAUTH_CALLBACK', DEFAULT_URL ."/sponsors/twitterauth.php");

		require CLASSES_DIR.'/apis/twitter/twitteroauth.php';
		require CLASSES_DIR.'/apis/twitter/functions.php';

		if(isset($_REQUEST['oauth_token']) && $_SESSION['token']  !== $_REQUEST['oauth_token']) {
			session_destroy();
			header('Location: form_twitterlogin.php');

		}elseif(isset($_REQUEST['oauth_token']) && $_SESSION['token'] == $_REQUEST['oauth_token']) {

			$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $_SESSION['token'] , $_SESSION['token_secret']);
			$access_token = $connection->getAccessToken($_REQUEST['oauth_verifier']);
			
			if($connection->http_code == '200')
			{
				
				$_SESSION['status'] = 'verified';
				$_SESSION['request_vars'] = $access_token;
				
				$user_info = $connection->get('account/verify_credentials'); 
				// $name = explode(' ',$user_info->name);
				// $fname = isset($name[0])?$name[0]:'';
				// $lname = isset($name[1])?$name[1]:'';

				$db_user = new Users();
				$db_user->checkUser($user_info->id, $user_info->screen_name, $user_info->name, $access_token['oauth_token'], $access_token['oauth_token_secret'], $user_info->profile_image_url);
				unset($_SESSION['token']);
				unset($_SESSION['token_secret']);
						
				//User redirection Logic

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

				
				//Login Success
				header('Location:'. $redirect_url);
				exit;
			} else {
				//Login Failed
				header('Location:'. DEFAULT_URL."/profile/login.php");
				exit;
			}				
		}else{
			if(isset($_GET["denied"]))
			{
				header('Location:form_twitterlogin.php');
				die();
			}

			$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);
			$request_token = $connection->getRequestToken(OAUTH_CALLBACK);
			$_SESSION['token'] 			= $request_token['oauth_token'];
			$_SESSION['token_secret'] 	= $request_token['oauth_token_secret'];
			if($connection->http_code == '200')
			{
				
				$twitter_url = $connection->getAuthorizeURL($request_token['oauth_token']);
				header('Location:' .$_GET["destiny"]); 

			}
		}

?>

