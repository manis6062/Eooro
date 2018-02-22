
<?php 
	
	//To Generate URL for linkedin login
		$redirect_url = DEFAULT_URL ."/sponsors/linkedinauth.php";
		$baseURL 			= 'http://localhost/linkedin/';
		$callbackURL 		= $redirect_url;
		$linkedinApiKey 	= '75hb2d6ejxos7u';
		$linkedinScope 		= 'r_basicprofile r_emailaddress';
		$linkedinApiSecret 	= 'DGd3tg5EhtBeTlVQ';
		require CLASSES_DIR.'/apis/linkedin/functions.php';
		require CLASSES_DIR.'/apis/linkedin/oauth_client.php';
		require CLASSES_DIR.'/apis/linkedin/http.php';
		$db = new DB;
		if (isset($_GET["oauth_problem"]) && $_GET["oauth_problem"] <> "") {
		  $_SESSION["err_msg"] = $_GET["oauth_problem"];
		  header('Location:'. DEFAULT_URL ."/profile/login.php");
		  exit;
		}

		$client = new oauth_client_class;
		$client->debug 			= false;
		$client->debug_http 	= true;
		$client->redirect_uri 	= $callbackURL;
		$client->client_id 		= $linkedinApiKey;
		$application_line 		= __LINE__;
		$client->client_secret 	= $linkedinApiSecret;
		$client->scope = $linkedinScope;
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


		$url 	 = str_replace("accessToken", "authorize?oauth_token=".$_SESSION['OAUTH_ACCESS_TOKEN'][$client->access_token_url]['value'], $client->access_token_url);
	    $success = $client->Finalize($success);
	}
	setting_get("foreignaccount_linkedin", $foreignaccount_linkedin);
?>
<?php if ($foreignaccount_linkedin) {?>
	

<a target="_top" href="<?=$url?>">
    <button type="button" class="btn btn-default custombtn">
        <div class="fbbtnwrapper linkedin">
            <i class="fa fa-linkedin fb ln"></i>
            <span <?=strpos(ACTUAL_PAGE_NAME, "claim.php") ? : null?>>LOG IN WITH LINKEDIN</span>
        </div>
    </button>
</a>

<?}?>