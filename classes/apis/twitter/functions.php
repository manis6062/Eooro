<?php

class Users {

	function checkUser($oauth_uid, $screen_name,$name,$oauth_token,$oauth_secret,$profile_image_url){
			
			$dbMain = db_getDBObject(DEFAULT_DB, true);
			$dbObj  = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
			
			//TOODO extract email from twitter

			$email 					   = "test@example.com";
			$userInfo['oauth_provier'] = "twitter";
			$userInfo['oauth_uid'] 	   = $oauth_uid;
			$userInfo['username'] 	   = $oauth_provider."".$email;
			$name_count				   =str_word_count($name);
			if ($name_count >= 2) {
				$full_name=explode(' ', $name);
				$fname= $full_name[0];
				$lname=$full_name[1];
			}else{
				$fname= $name;
				$lname= NULL;
			}
			$userInfo['first_name']    = $fname;
			$userInfo['nickname']      = $screen_name;
			$userInfo['last_name']     = $lname;
			$userInfo['picture'] 	   = $profile_image_url;
			$userInfo['email'] 	   	   = $screen_name."@gmail.com";


			$_GET['destiny'] 	= $_SESSION['HTTP_REFER'] ? $_SESSION['HTTP_REFER'] : $_SESSION['red_destiny'];
	        $_GET['claim'] 		= $_SESSION['claim'] ? $_SESSION['claim'] : null;
	        $_GET['advertise']	= $_SESSION['advertise'] ? $_SESSION['advertise'] : null;

			//Send user info to our database
			if(system_registerForeignAccount($userInfo, "twitter", $attach_account = false, $email_notification = SYSTEM_NEW_PROFILE) == true)
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
