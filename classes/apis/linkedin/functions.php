<?php
class DB 
{
	
	function checkUser($userdata){

		//DB connection parameters
		$dbMain = db_getDBObject(DEFAULT_DB, true);
		$dbObj  = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
		
		//Value returned from twitter
		$oauth_uid  = $userdata->id;
		$email 		= $userdata->emailAddress;
		$fname 		= $userdata->firstName;
		$lname 		= $userdata->lastName;
		$profile_image_url = $userdata->pictureUrl;

		//Making array to pass
		$userInfo['oauth_provier'] = $oauth_provider;
		$userInfo['oauth_uid'] 	   = $oauth_uid;
		$userInfo['username'] 	   = $LinkedInUsername;
		$userInfo['first_name']    = $fname;
		$userInfo['last_name']     = $lname;
		$userInfo['picture'] 	   = $profile_image_url;
		$userInfo['email'] 	   	   = $email;

		
		$_GET['destiny'] 	= $_SESSION['HTTP_REFER'] ? $_SESSION['HTTP_REFER'] : $_SESSION['red_destiny'];
        $_GET['claim'] 		= $_SESSION['claim'] ? $_SESSION['claim'] : null;
        $_GET['advertise']	= $_SESSION['advertise'] ? $_SESSION['advertise'] : null;

		//Extracts $userInfo from twitter and passes it to our database
		if(system_registerForeignAccount($userInfo, "linkedin", $attach_account = false, $email_notification = SYSTEM_NEW_PROFILE) == true)
		{
				$acctObj 	= new Account(sess_getAccountIdFromSession());
                $contactObj = new Contact($acctObj->getNumber("id"));
                $profileObj = new Profile($acctObj->getNumber("id"));
                if ($_GET["claim"] == "yes" || $_GET["advertise"] == "yes" || SOCIALNETWORK_FEATURE == "off") {
                    if ($acctObj->getString("is_sponsor") == 'n') {
                            $accObj->changeMemberStatus(true);
                            unset( $_SESSION['claim'] ); 
                            unset( $_SESSION['advertise'] ); 
                    }
                    if ($_GET["advertise"] == "yes") {
                        $destinyUrl = $_GET["destiny"];
                        $itemID		= $_GET["item_id"];
                        $item		= $_GET["advertise_item"];

                   
                         if ($item == "banner") {
                            $destinyUrl .= "?type=".$level;
                            $destinyUrl .= "&expiration_setting=".$expiration;
                            $destinyUrl .= "&caption=".$caption;
                   		} else if ($item == "listing") {
                            $destinyUrl .= "?level=".$level;
                            if ($template) {
                                    $destinyUrl .= "&listingtemplate_id=".$template;
                            }
                		}
                	}
                }
		} else {
			header('Location:'. DEFAULT_URL."/profile/login.php");
			exit;

		}
	}
}
?>