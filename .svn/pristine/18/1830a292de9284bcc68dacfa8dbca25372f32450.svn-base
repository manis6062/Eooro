<?php
  
  	require CLASSES_DIR.'/apis/twitter/twitteroauth.php';
	
  	$redirect_url = DEFAULT_URL ."/sponsors/twitterauth.php";

  	//API Key Google
	define('CONSUMER_KEY', 'vrdpzWIm4HjAE44hn6t8oHoA7');
	define('CONSUMER_SECRET', '6qWPMt2yA7XnV5WkuXlpeeqHNLWnHZXEFfcGHYUouglEbD0lG1');
	define('OAUTH_CALLBACK', $redirect_url);

	$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);
	$request_token = $connection->getRequestToken(OAUTH_CALLBACK);
	$_SESSION['token'] 			= $request_token['oauth_token'];
	$_SESSION['token_secret'] 	= $request_token['oauth_token_secret'];
	$twitter_url = $connection->getAuthorizeURL($request_token['oauth_token']); 
	setting_get("foreignaccount_twitter", $foreignaccount_twitter);
?>
<?php if ($foreignaccount_twitter) {?>
	

<a target="_top" href="<?=$twitter_url?>">
    <button type="button" class="btn btn-default custombtn">
        <div class="fbbtnwrapper twitterblue">
            <i class="fa fa-twitter fb tw"></i>
            <span <?=strpos(ACTUAL_PAGE_NAME, "claim.php") ? : null?>>LOG IN WITH TWITTER</span>

        </div>
    </button>
</a>
<?}?>
