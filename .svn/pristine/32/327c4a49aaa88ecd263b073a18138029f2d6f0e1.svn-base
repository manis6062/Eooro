<?php

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /profile/add_com.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------

	include("../conf/loadconfig.inc.php");	
	setting_get("sitemgr_email",$sitemgr_email);
	//$dbMain = db_getDBObject(DEFAULT_DB, true);
	//$dbObj  = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
        
	//Extract Post data and escape it
                
	$company_title    		= 	$_POST['company_title'];
	$email  				= 	$_POST['email'];
	$phone  				= 	$_POST['phone'];
	$website  				= 	$_POST['website'];
	$facebook_url			= 	$_POST['facebook'];
	$twitter_url 			= 	$_POST['twitter'];
	$location_1  			= 	$_POST['location_1'];
	$location_3  			= 	$_POST['location_3'];
	$location_4  			= 	$_POST['location_4'];
	$street_address  		= 	$_POST['street_address'];
	$is_owner				=   $_POST['is_owner'];
	$rating  				= 	$_POST['rating'];
	$reviewer_name			= 	$_POST['reviewer_name'];
	$reviewer_email			= 	$_POST['reviewer_email'];
	$review_title  			= 	$_POST['review_title'];
	$review  				= 	$_POST['review_comment'];

        

	//If user is signed in , extract email from his 
	$acctID = sess_getAccountIdFromSession();
	if($acctID){
		$contact 		= new Contact($acctID);
		$reviewer_email =  $contact->email;
	}
        trim($is_owner) == "Yes" ? $is_owner = 0 : $is_owner = 1;
	$activationCode = substr( md5(rand(9999,99999)), 0, 20);
        $domain = DBConnection::getInstance()->getDomain();
        DBQuery::execute(function() use ($domain,$company_title,$email,$phone,$website,$facebook_url,$twitter_url,$location_1,$location_3,$location_4,$street_address,$rating,$reviewer_name,$reviewer_email,$review_title,$review,$activationCode, $is_owner) {
	//Set is owner = 0 or 1 in database
	
        //echo $activationCode.'tse/'. $is_owner; die;
	// //Insert into database
        
	$sql= $domain->prepare("INSERT INTO ListingRequest ("
            ."company_title," 
            ."email," 
            ."phone," 
            ."website," 
            ."facebook_url," 
            ."twitter_url," 
            ."location_1,"
            ."location_3," 
            ."location_4," 
            ."street_address," 
            ."is_owner," 
            ."rating," 
            ."reviewer_name," 
            ."reviewer_email," 
            ."review_title," 
            ."review," 
            ."activation_code," 
            ."created_date )"
				."VALUES ("
                                .":company_title," 
                                .":email," 
                                .":phone," 
                                .":website," 
                                .":facebook_url," 
                                .":twitter_url," 
                                .":location_1," 
                                .":location_3," 
                                .":location_4," 
                                .":street_address," 
                                .":is_owner," 
                                .":rating,"
                                .":reviewer_name,"
                                .":reviewer_email," 
                                .":review_title," 
                                .":review," 
                                .":activationCode,"
                                ."NOW() )");
        
             $sql->bindParam(':company_title',$company_title);
             $sql->bindParam(':email',$email);
             $sql->bindParam(':phone',$phone);
             $sql->bindParam(':website',$website);
             $sql->bindParam(':facebook_url',$facebook_url);
             $sql->bindParam(':twitter_url',$twitter_url);
             $sql->bindParam(':location_1',$location_1);
             $sql->bindParam(':location_3',$location_3);
             $sql->bindParam(':location_4',$location_4);
            $sql->bindParam(':street_address',$street_address);
            $sql->bindParam(':is_owner',$is_owner);
            $sql->bindParam(':rating',$rating);
            $sql->bindParam(':reviewer_name',$reviewer_name);
            $sql->bindParam(':reviewer_email',$reviewer_email);
            $sql->bindParam(':review_title',$review_title);
            $sql->bindParam(':review',$review);
            $sql->bindParam(':activationCode',$activationCode);
       
        //print_r($sql); die;
        $result = $sql->execute();
       
	//$result =  $dbObj->query($sql);
	print json_encode($result);
                });

	//Send email with validation link
	if($is_owner == 1){ 
		
		$emailNotificationObj = new EmailNotification(42);
		$subject 			  = $emailNotificationObj->subject;
		$type 	 			  = md5("addbusiness");
		$activation_link 	  = DEFAULT_URL . '/activate.php?type='. $type . "&code=" . $activationCode;
		$body				  = $emailNotificationObj->body;
		if($acctID){
			$body			  = str_replace("FIRSTNAME",ucfirst($contact->first_name), $body);
			$body			  = str_replace("LASTNAME",ucfirst($contact->last_name), $body);
		} else {
			$body			  = str_replace("FIRSTNAME","", $body);
			$body			  = str_replace("LASTNAME","Business Owner", $body);
		}
                //echo $activation_link;die;
		$body			 	  = str_replace("ACTIVATION_LINK",$activation_link, $body);
		$return  = system_mail($email, $subject, $body, EDIRECTORY_TITLE." <$sitemgr_email>","text/html", "", "", $error, "", "", "", "", $contact->account_id, 42);
	}

	if($is_owner == 0){

			$emailNotificationObj = new EmailNotification(43);
			$subject 			  = $emailNotificationObj->subject;
			$type 	 			  = md5("addbusiness");
			$activation_link 	  = DEFAULT_URL . '/activate.php?type='. $type . "&code=" . $activationCode;
			$body				  = $emailNotificationObj->body;

			//Replace
			if($acctID){
				$body				  = str_replace("FIRSTNAME",ucfirst($contact->first_name), $body);
				$body				  = str_replace("LASTNAME",ucfirst($contact->last_name), $body);
			} else {
				$body				  = str_replace("FIRSTNAME","", $body);
				$body				  = str_replace("LASTNAME",$reviewer_name, $body);
			}
				$body			 	  = str_replace("ACTIVATION_LINK",$activation_link, $body);
				$body			 	  = str_replace("LISTING_NAME",  htmlspecialchars($company_title), $body);
				$subject		 	  = str_replace("LISTING_NAME",  $company_title, $subject);

			$return  = system_mail($reviewer_email, $subject, $body, EDIRECTORY_TITLE." <$sitemgr_email>","text/html", "", "", $error, "", "", "", "", $contact->account_id, 43);
		
	}