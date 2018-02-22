<?php

//$_POST 	  		= format_magicQuotes($_POST);
//$_GET     		= format_magicQuotes($_GET); 
// if(trim($_POST['location_1']) == ''){ 
// 	$_POST['location_1'] = 0;
// 	$_POST['location_3'] = 0;
// 	$_POST['location_4'] = 0;
// } 
//$_POST['title']	= filter_var($_POST['title'], FILTER_SANITIZE_STRING);
foreach ($_POST as $k => $v) {
    $_POST[$k] = $v;
}


$dbMain = db_getDBObject(DEFAULT_DB, true);
$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
//	$postData 		= array_map('mysql_real_escape_string', $_POST);
$postData = $_POST;

$level = 10;
$id = $_GET["id"] ? mysql_real_escape_string($_GET["id"]) : mysql_real_escape_string($_POST["id"]); //edit page
$claimlistingid = mysql_real_escape_string($claimlistingid);
$claimlistingid ? $listing = new Listing($claimlistingid) : null;
$originalObj = new Listing(($id ? $id : $claimlistingid));

#----------------------------------------------------
#			SET FORM VALUES
#----------------------------------------------------

if ($_SERVER['REQUEST_METHOD'] == "POST"):

    $listing_category = new Listing_Category();

    #---------------------------------------
    #	Sets Listing's Logo
    #---------------------------------------

    system_addItemGallery($gallery_hash, $_POST["title"], $gallery_id, $image_id, $thumb_id);

    if (empty($postData['location_3']) && !empty($postData['input_location_3'])) {
        // add location 3 to database if user does not select location3
        $location3Obj = new Location3();
        $location3Obj->name = $postData['input_location_3'];
        $location3Obj->location_1 = $postData['location_1'];
        $friendly_url = strtolower($postData['input_location_3']);
        $friendly_url = str_replace(' ', '-', $friendly_url);
        $location3Obj->friendly_url = $friendly_url;
        $location3Obj->abbreviation = '';
        $location3Obj->seo_description = '';
        $location3Obj->seo_keywords = '';
        $location3Obj->Save();
    }
    if (empty($postData['location_4']) && !empty($postData['input_location_4'])) {
        // add location 4 to database if user does not select location4
        $location4Obj = new Location4();
        $location4Obj->name = $postData['input_location_4'];
        $friendly_url = strtolower($postData['input_location_4']);
        $friendly_url = str_replace(' ', '-', $friendly_url);
        $location3Obj->friendly_url = $friendly_url;
        $location4Obj->abbreviation = '';
        $location4Obj->seo_description = '';
        $location4Obj->seo_keywords = '';
        $location4Obj->location_1 = $postData['location_1'];
        if (empty($postData['location_3'])) {
            $location4Obj->location_3 = $location3Obj->id;
        } else {
            $location4Obj->location_3 = $postData['location_3'];
        }
        $location4Obj->Save();
    }


    #----------------------------------------
    #			Add Listing
    #----------------------------------------

    if ($process == "add"):

        $listingObj = new Listing();
        $listingarray = (array) $listingObj;

        //Set Listing's status to pending and get listing's id
        $listingObj->status = "P";



        // concat(substring(replace(upper(title), ' ', ''), 1, 3) , location_1 , FLOOR(RAND() * 9999));

        if (empty($listingObj->id)) {
            $custom_dropdown5 = str_replace(' ', '', $_POST['title']);
            $custom_dropdown5 = strtoupper($custom_dropdown5);
            $custom_dropdown5 = substr($custom_dropdown5, 0, 3);
            $custom_dropdown5 = $custom_dropdown5 . $_POST['location_1'];
            $random_num = rand(1000, 9999);
            $listingObj->custom_dropdown5 = $custom_dropdown5 . $random_num;
            $listingObj->custom_dropdown5 = clean($listingObj->custom_dropdown5);
        }
        $pending->renewal_date = "0000-00-00";
        $listingObj->save();

        //Create a Pending Listing
        $pendingObj = new ListingPending();
        $pendingarray = (array) $pendingObj;

        //Extract and store $_POST value into Listing

        $both = array_intersect_key($postData, $pendingarray);

        foreach ($both as $key => $value):
            $pendingObj->$key = $value;
        endforeach;

        $pendingObj->id = $listingObj->id;
        $pendingObj->renewal_date = "0000-00-00";
        $pendingObj->status = "P";
        //set saved location 3 and 4
        if (empty($postData['location_3'])) {
            $pendingObj->location_3 = $location3Obj->id;
        }
        if (empty($postData['location_4'])) {
            $pendingObj->location_4 = $location4Obj->id;
        }

        $pendingObj->seo_title = $pendingObj->title; //set value for seo title 
        //Local Business

        $pendingObj->custom_checkbox0 = "n";
        $pendingObj->custom_checkbox1 = "n";
        $pendingObj->custom_checkbox2 = "n";

        //Website Business
        if ($postData['custom_dropdown2'] == "Website"):
            $pendingObj->custom_checkbox0 = "y";
        endif;

        //Global Business
        if ($postData['custom_dropdown3'] == "Global"):
            //	$pendingObj->custom_checkbox0 = "y";
            $pendingObj->custom_checkbox1 = "y";

            //if global bussiness and location not set, set it to 0
            if (!$pendingObj->location_1) {
                $pendingObj->location_1 = 0;
            }
            if (!$pendingObj->location_3) {
                $pendingObj->location_3 = 0;
            }
            if (!$pendingObj->location_4) {
                $pendingObj->location_4 = 0;
            }

        endif;

        //Country Brand
        if ($postData['custom_dropdown3'] == "National"):
            //	$pendingObj->custom_checkbox0 = "y";
            $pendingObj->custom_checkbox2 = "y";
        endif;

        $pendingObj->custom_checkbox3 = "n"; //yearly listing default		
        $pendingObj->account_id = sess_getAccountIdFromSession();

        $listingarray = (array) $listingObj;
        $pendingarray = (array) $pendingObj;

        //Get pending value in listing object
        $both = array_intersect_key($pendingarray, $listingarray);

        foreach ($both as $key => $value):
            $listingObj->$key = ($value);
        endforeach;

        //Set Gallery
        $pendingObj->setGalleries($gallery_id);

        //Set Main Image
        $galleryObj = new Gallery($gallery_id);
        $pendingObj->image_id = $galleryObj->image['0']['image_id'];
        $pendingObj->thumb_id = $galleryObj->image['0']['thumb_id'];

        //Add categories in Pending Table


        $listing_category->checkListingSubCategoryAndAdd($postData['keywords'], $listingObj->id, true);

        $pendingObj->save();
        $listingObj->save();


        // Note: there is a copy of notify email in claim business also.
        #----------------------------------------
        #	Notify By Email
        #----------------------------------------
        //if ($originalObj->status != "P"){ $emailNotification = true; $message = 1; }
        $emailNotification = true;
        $message = 0;

        $domain = new Domain(SELECTED_DOMAIN_ID);
        if ($listingObj->account_id > 0) {
            if ($message == 0) {
                $contactObj = new Contact($listingObj->getNumber("account_id"));
                if ($emailNotificationObj = system_checkEmail(SYSTEM_NEW_LISTING)) {
                    setting_get("sitemgr_send_email", $sitemgr_send_email);
                    setting_get("sitemgr_email", $sitemgr_email);
                    $sitemgr_emails = explode(",", $sitemgr_email);
                    $detailLink = LISTING_DEFAULT_URL . "/" . $pendingObj->friendly_url; //To be used in notification email
                    if ($sitemgr_emails[0])
                        $sitemgr_email = $sitemgr_emails[0];
                    $subject = $emailNotificationObj->getString("subject");
                    $body = $emailNotificationObj->getString("body");
                    $body = str_replace('LISTING_NAME', ucwords(htmlspecialchars($pendingObj->title)), $body); //listingObj->title appeares broken
                    $body = str_replace('MEMBERS_URL', htmlspecialchars($detailLink), $body);
                    $body = system_replaceEmailVariables($body, $listingObj->getNumber('id'), 'listing');
                    $body = str_replace($_SERVER["HTTP_HOST"], $domain->getstring("url"), $body);
                    $subject = system_replaceEmailVariables($subject, $listingObj->getNumber('id'), 'listing');
                    $body = html_entity_decode($body);
                    $subject = html_entity_decode($subject);
                    $error = false;
                    system_mail($contactObj->getString("email"), $subject, $body, EDIRECTORY_TITLE . " <$sitemgr_email>", $emailNotificationObj->getString("content_type"), "", $emailNotificationObj->getString("bcc"), $error, "", "", "", $listingObj->id, $contactObj->account_id, SYSTEM_NEW_LISTING);
                }
            }
        }

        if ($emailNotification) {
            if (!string_strpos($url_base, "/" . SITEMGR_ALIAS . "")) {

                $domain_url = ((SSL_ENABLED == "on" && FORCE_SITEMGR_SSL == "on") ? SECURE_URL : NON_SECURE_URL);
                $domain_url = str_replace($_SERVER["HTTP_HOST"], $domain->getstring("url"), $domain_url);

                setting_get("sitemgr_listing_email", $sitemgr_listing_email);
                $sitemgr_listing_emails = explode(",", $sitemgr_listing_email);

                $account = new Account($acctId);
                setting_get("new_listing_email", $new_listing_email);
                setting_get("update_listing_email", $update_listing_email);
                $sentUp = 0;
                $sentNew = 0;

                $emailSubject = system_showText(LANG_NOTIFY_LISTING);
                $sitemgr_msg = system_showText(LANG_LABEL_SITE_MANAGER) . ",<br /><br />";

                if ($_POST["id"]) {
                    $sitemgr_msg .= ucfirst(LANG_LISTING_FEATURE_NAME) . " \"" . $listingObj->title . "\" " . system_showText(LANG_NOTIFY_ITEMS_1) . " \"" . system_showAccountUserName($account->getString("username")) . "\" " . system_showText(LANG_NOTIFY_ITEMS_3) . "<br /><br />";
                    $link_sitemgrmsg = "<a href=\"" . $domain_url . "/" . SITEMGR_ALIAS . "/" . LISTING_FEATURE_FOLDER . "/settings.php?id=" . $listingObj->id . "\" target=\"_blank\">" . $domain_url . "/" . SITEMGR_ALIAS . "/" . LISTING_FEATURE_FOLDER . "/settings.php?id=" . $listingObj->id . "</a><br /><br />";
                    $sentUp = 1;
                } else {
                    $sitemgr_msg .= ucfirst(LANG_LISTING_FEATURE_NAME) . " \"" . $listingObj->title . "\" " . system_showText(LANG_NOTIFY_ITEMS_2) . " \"" . system_showAccountUserName($account->getString("username")) . "\" " . system_showText(LANG_NOTIFY_ITEMS_3) . "<br /><br />";
                    $link_sitemgrmsg = "<a href=\"" . $domain_url . "/" . SITEMGR_ALIAS . "/" . LISTING_FEATURE_FOLDER . "/view.php?id=" . $listingObj->id . "\" target=\"_blank\">" . $domain_url . "/" . SITEMGR_ALIAS . "/" . LISTING_FEATURE_FOLDER . "/view.php?id=" . $listingObj->id . "</a><br /><br />";
                    $sentNew = 1;
                }
                $sitemgr_msg .= $link_sitemgrmsg . EDIRECTORY_TITLE;

                if (($update_listing_email && $sentUp == 1) || ($new_listing_email && $sentNew == 1)) {
                    system_notifySitemgr($sitemgr_listing_emails, $emailSubject, $sitemgr_msg);
                }
            }
        }
        //Redirect To Billing Page
        header("Location: $url_redirect/claim/billing.php?claimlistingid=" . $listingObj->id);

    endif;


    #----------------------------------------
    #			Edit Listing
    #----------------------------------------

    if ($process == "edit"):

        $listingObj = new Listing($id);

        if ($listingObj->custom_dropdown5 == '') {
            $custom_dropdown5 = str_replace(' ', '', $listingObj->title);
            $custom_dropdown5 = strtoupper($custom_dropdown5);
            $custom_dropdown5 = substr($custom_dropdown5, 0, 3);
            $custom_dropdown5 = $custom_dropdown5 . $listingObj->location_1;
            $random_num = rand(1000, 9999);
            $listingObj->custom_dropdown5 = $custom_dropdown5 . $random_num;
            $listingObj->custom_dropdown5 = clean($listingObj->custom_dropdown5);
        }

        //Unless user has paid, update data to ListingPending table
        if ($listingObj->status == "P"):
            //Copy Listing Table Data to ListingPending Table
            $pendingObj = new ListingPending($id);
            //Assign ListingPending the values of listing table
            $listingarray = (array) $listingObj;
            $pendingarray = (array) $pendingObj;

            //Assign Listing Pending POST Data
            $both = array_intersect_key($postData, $pendingarray);
            foreach ($both as $key => $value):
                $pendingObj->$key = ($value);
            endforeach;
            //set saved location 3 and 4
            if (empty($postData['location_3'])) {
                $pendingObj->location_3 = $location3Obj->id;
            }
            if (empty($postData['location_4'])) {
                $pendingObj->location_4 = $location4Obj->id;
            }

            $pendingObj->renewal_date = "0000-00-00";
            $pendingObj->status = "P";

            //Set Gallery
            $pendingObj->setGalleries($gallery_id);

            //Set Main Image
            $galleryObj = new Gallery($gallery_id);
            $pendingObj->image_id = $galleryObj->image['0']['image_id'];
            $pendingObj->thumb_id = $galleryObj->image['0']['thumb_id'];

            //Set Categories

            if (!empty($postData['keywords'])) {
                $posted_keywords = implode(',', $postData['keywords']);
//					$listing_category->checkListingSubCategoryAndAdd($postData['keywords'], $listingObj->id, true);
                $pendingObj->keywords = $posted_keywords;
            }


            $pendingObj->save();

        endif;

        //If Listing is Active, store POST data
        if ($listingObj->status != "P"):

            //Store postData value into Listing Object
            $listingarray = (array) $listingObj;
            $both = array_intersect_key($postData, $listingarray);

            foreach ($both as $key => $value):
                $listingObj->$key = $value;
            endforeach;
            //set saved location 3 and 4
            if (empty($postData['location_3']) && !empty($postData['input_location_3'])) {
                $listingObj->location_3 = $location3Obj->id;
            }
            if (empty($postData['location_4']) && !empty($postData['input_location_4'])) {
                $listingObj->location_4 = $location4Obj->id;
            }


            //commented by vivek(data doesnot update when uncommented)
            //Not allowing changing global brand and country code
            $listingObj->location_1 = $postData['location_1'] ? $postData['location_1'] : $originalObj->location_1;
            // $listingObj->location_3 	   = $originalObj->location_3;
            // $listingObj->location_4        = $originalObj->location_4;
            $listingObj->custom_dropdown3 = $originalObj->custom_dropdown3;

            //Set Gallery
            $listingObj->setGalleries($gallery_id);

            //Set Main Image
            $galleryObj = new Gallery($gallery_id);
            $listingObj->image_id = $galleryObj->image['0']['image_id'];
            $listingObj->thumb_id = $galleryObj->image['0']['thumb_id'];

            if (!empty($postData['keywords'])) {
                $posted_keywords = implode(',', $postData['keywords']);
//					$listing_category->checkListingSubCategoryAndAdd($postData['keywords'], $listingObj->id, true);
                $listingObj->keywords = $posted_keywords;
            }

            $listingObj->save();

        endif;

        header("Location: $url_redirect/" . (($search_page) ? "search.php" : ""));

    endif;


    // Note: there is a copy of notify email in add business also.
    #----------------------------------------
    #			Claim Listing
    #----------------------------------------

    if ($process == "claim"):

        $claimlistingid ? $id = ($claimlistingid) : null;

        //Copy Listing Table Data to ListingPending Table
        $listingObj = new Listing($id);
        $pendingObj = new ListingPending($id);
        $img_id = $pendingObj->image_id;
        $thm_id = $pendingObj->thumb_id;



        //Assign ListingPending the values of listing table
        $listingarray = (array) $listingObj;
        $pendingarray = (array) $pendingObj;



        $both = array_intersect_key($listingarray, $pendingarray);

        foreach ($both as $key => $value):
            $pendingObj->$key = $value;
        endforeach;




        //Extract and store $_POST value into Listing Pending
        $both = array_intersect_key($postData, $pendingarray);

        foreach ($both as $key => $value):
            $pendingObj->$key = ($value);
        endforeach;

        //Add categories in Pending Table
        $listing_category->checkListingSubCategoryAndAdd($postData['keywords'], $listingObj->id, true);

        $pendingObj->id = $listingObj->id;
        $pendingObj->account_id = sess_getAccountIdFromSession();
        $pendingObj->renewal_date = "0000-00-00";
        $pendingObj->image_id = $img_id;
        $pendingObj->thumb_id = $thm_id;
        $pendingObj->status = "P";
        $pendingObj->updated = date("Y-m-d h:i:s");

        //Set Gallery
        $pendingObj->setGalleries($gallery_id);

        //Set Main Image
        $galleryObj = new Gallery($gallery_id);
        $pendingObj->image_id = $galleryObj->image['0']['image_id'];
        $pendingObj->thumb_id = $galleryObj->image['0']['thumb_id'];
        $detailLink = LISTING_DEFAULT_URL . "/" . $friendly_url; //To be used in notification email

        $pendingObj->save();

        //Set Listing renewal date to today
        $listingObj->setString("account_id", sess_getAccountIdFromSession());
        $listingObj->setString("renewal_date", "0000-00-00");
        $listingObj->setString("status", "P");
        $listingObj->save();



        #----------------------------------------
        #	Notify By Email
        #----------------------------------------
        $emailNotification = true;
        $message = 0;

        $domain = new Domain(SELECTED_DOMAIN_ID);
        if ($listingObj->account_id > 0) {
            if ($message == 0) {
                $contactObj = new Contact($listingObj->getNumber("account_id"));
                if ($emailNotificationObj = system_checkEmail(SYSTEM_NEW_LISTING)) {
                    setting_get("sitemgr_send_email", $sitemgr_send_email);
                    setting_get("sitemgr_email", $sitemgr_email);
                    $sitemgr_emails = explode(",", $sitemgr_email);
                    if ($sitemgr_emails[0])
                        $sitemgr_email = $sitemgr_emails[0];
                    $detailLink = LISTING_DEFAULT_URL . "/" . $listingObj->friendly_url; //To be used in notification email

                    $subject = $emailNotificationObj->getString("subject");
                    $body = $emailNotificationObj->getString("body");
                    $body = str_replace('LISTING_NAME', ucwords(htmlspecialchars($listingObj->title)), $body);
                    $body = str_replace('MEMBERS_URL', htmlspecialchars($detailLink), $body);
                    $body = system_replaceEmailVariables($body, $listingObj->getNumber('id'), 'listing');
                    $body = str_replace($_SERVER["HTTP_HOST"], $domain->getstring("url"), $body);
                    $subject = system_replaceEmailVariables($subject, $listingObj->getNumber('id'), 'listing');
                    $body = html_entity_decode($body);
                    $subject = html_entity_decode($subject);
                    $error = false;
                    system_mail($contactObj->getString("email"), $subject, $body, EDIRECTORY_TITLE . " <$sitemgr_email>", $emailNotificationObj->getString("content_type"), "", $emailNotificationObj->getString("bcc"), $error, "", "", "", $listingObj->id, $contactObj->account_id, SYSTEM_NEW_LISTING);
                }
            }
        }

        if ($emailNotification) {
            if (!string_strpos($url_base, "/" . SITEMGR_ALIAS . "")) {

                $domain_url = ((SSL_ENABLED == "on" && FORCE_SITEMGR_SSL == "on") ? SECURE_URL : NON_SECURE_URL);
                $domain_url = str_replace($_SERVER["HTTP_HOST"], $domain->getstring("url"), $domain_url);

                setting_get("sitemgr_listing_email", $sitemgr_listing_email);
                $sitemgr_listing_emails = explode(",", $sitemgr_listing_email);

                $account = new Account($acctId);
                setting_get("new_listing_email", $new_listing_email);
                setting_get("update_listing_email", $update_listing_email);
                $sentUp = 0;
                $sentNew = 0;

                $emailSubject = system_showText(LANG_NOTIFY_LISTING);
                $sitemgr_msg = system_showText(LANG_LABEL_SITE_MANAGER) . ",<br /><br />";

                if ($_POST["id"]) {
                    $sitemgr_msg .= ucfirst(LANG_LISTING_FEATURE_NAME) . " \"" . $listingObj->title . "\" " . system_showText(LANG_NOTIFY_ITEMS_1) . " \"" . system_showAccountUserName($account->getString("username")) . "\" " . system_showText(LANG_NOTIFY_ITEMS_3) . "<br /><br />";
                    $link_sitemgrmsg = "<a href=\"" . $domain_url . "/" . SITEMGR_ALIAS . "/" . LISTING_FEATURE_FOLDER . "/settings.php?id=" . $listingObj->id . "\" target=\"_blank\">" . $domain_url . "/" . SITEMGR_ALIAS . "/" . LISTING_FEATURE_FOLDER . "/settings.php?id=" . $listingObj->id . "</a><br /><br />";
                    $sentUp = 1;
                } else {
                    $sitemgr_msg .= ucfirst(LANG_LISTING_FEATURE_NAME) . " \"" . $listingObj->title . "\" " . system_showText(LANG_NOTIFY_ITEMS_2) . " \"" . system_showAccountUserName($account->getString("username")) . "\" " . system_showText(LANG_NOTIFY_ITEMS_3) . "<br /><br />";
                    $link_sitemgrmsg = "<a href=\"" . $domain_url . "/" . SITEMGR_ALIAS . "/" . LISTING_FEATURE_FOLDER . "/view.php?id=" . $listingObj->id . "\" target=\"_blank\">" . $domain_url . "/" . SITEMGR_ALIAS . "/" . LISTING_FEATURE_FOLDER . "/view.php?id=" . $listingObj->id . "</a><br /><br />";
                    $sentNew = 1;
                }
                $sitemgr_msg .= $link_sitemgrmsg . EDIRECTORY_TITLE;

                if (($update_listing_email && $sentUp == 1) || ($new_listing_email && $sentNew == 1)) {
                    system_notifySitemgr($sitemgr_listing_emails, $emailSubject, $sitemgr_msg);
                }
            }
        }

        header("Location: $url_redirect/billing.php?claimlistingid=" . $listingObj->id);

    endif;

    exit;

endif;


#----------------------------------------------------
#				GET FORM VALUES
#----------------------------------------------------

$gallery_hash = $_POST["gallery_hash"] ? $_POST["gallery_hash"] : "listing" . ($id ? "_$id" : $claimlistingid ? "_$claimlistingid" : "") . "_" . uniqid(rand(), true);
$array_fields = system_getFormFields("Listing", 10);
$listingObj = new Listing(($id ? $id : $claimlistingid));
if ($listingObj->status == "P"):
    $listingObj = new ListingPending(($id ? $id : $claimlistingid));
endif;
$listing = $listingObj;


#-------------------------------------------------
#	LOCATIONS CODE (Country/State/City) Dropdown
#-------------------------------------------------

$_non_default_locations = "";
$_default_locations_info = "";

if (EDIR_DEFAULT_LOCATIONS):

    system_retrieveLocationsInfo($_non_default_locations, $_default_locations_info);
    $last_default_location = $_default_locations_info[count($_default_locations_info) - 1]['type'];
    $last_default_location_id = $_default_locations_info[count($_default_locations_info) - 1]['id'];
    if ($_non_default_locations):
        $objLocationLabel = "Location" . $_non_default_locations[0];
        ${"Location" . $_non_default_locations[0]} = new $objLocationLabel;
        ${"Location" . $_non_default_locations[0]}->SetString("location_" . $last_default_location, $last_default_location_id);
        ${"locations" . $_non_default_locations[0]} = ${"Location" . $_non_default_locations[0]}->retrieveLocationByLocation($last_default_location);
    endif;

else:
    $_non_default_locations = explode(",", EDIR_LOCATIONS);

    //Location 1 : Country
    $objLocationLabel = "Location" . $_non_default_locations[0];
    ${"Location" . $_non_default_locations[0]} = new $objLocationLabel;
    ${"locations" . $_non_default_locations[0]} = ${"Location" . $_non_default_locations[0]}->retrieveAllLocation();

    if ($listing->location_3):
        //Location 3 state/county
        $objLocationLabel = "Location3";
        ${"Location" . $_non_default_locations[1]} = new $objLocationLabel;
        ${"locations" . $_non_default_locations[1]} = ${"Location" . $_non_default_locations[1]}->retrieveAllLocationByLocation1($listing->location_1);

        if ($listing->location_4):
            //Location4 city
            $objLocationLabel = "Location4";
            ${"Location" . $_non_default_locations[2]} = new $objLocationLabel;
            ${"locations" . $_non_default_locations[2]} = ${"Location" . $_non_default_locations[2]}->retrieveAllLocationByLocation1($listing->location_1, $listing->location_3);
        endif;
    endif;

endif;


#-------------------------------------------------
#	GALLERY CODE - Listing Logo/Image
#-------------------------------------------------
if ($id || $claimlistingid):

    $galleries = db_getFromDBBySQL_pdo("gallery", "SELECT gallery_id FROM Gallery_Item WHERE item_id = " . ($id ? $id : $claimlistingid) . " ORDER BY id", "array", false, SELECTED_DOMAIN_ID);
    $gallery_id = $galleries[0]["gallery_id"];
    if (!$gallery_id && $image_id && $thumb_id) {
        $gallery = new Gallery($id);
        $aux = array("account_id" => 0, "title" => $title, "entered" => "NOW()", "updated" => "now()");
        $gallery->makeFromRow($aux);
        $gallery->save();
        $listingObj->setGalleries($gallery->getNumber("id"));
        $gallery_id = $gallery->getNumber("id");
        $domain = DBConnection::getInstance()->getDomain();
        DBQuery::execute(function() use ($domain, $gallery_id, $thumb_id) {
            $stmt = $domain->prepare("INSERT INTO Gallery_Image (gallery_id,image_id,thumb_id,image_default) VALUES (:gallery_id, :image_id, :thumb_id,'y')");
            $parameters = array(
                ':gallery_id' => $gallery_id,
                ':image_id' => $image_id,
                ':thumb_id' => $thumb_id
            );
            $stmt->execute($parameters);
        });
    }

    if (!is_array($listingObj->getGalleries())) {
        $gallery = new Gallery();
        $aux = array("account_id" => 0, "title" => $listingObj->getString("title"), "entered" => "NOW()", "updated" => "now()");
        $gallery->makeFromRow($aux);
        $gallery->save();
        $listingObj->setGalleries($gallery->getNumber("id"));
    }

    //Gallery and main image
    $onlyMainImage = true;
    $hasMainImage = true;
    $hasImage = true;

    #-------------------------------------------------
    #	MAP CODE - Google Map Code
    #-------------------------------------------------
    //Map Control
    $loadMap = false;
    $mapObj = new GoogleSettings(GOOGLE_MAPS_STATUS, $_SERVER["HTTP_HOST"]);

    if (GOOGLE_MAPS_ENABLED == "on" && $mapObj->getString("value") == "on"):
        $loadMap = true;
        $formLoadMap = "document.listing";
        if (!$maptuning_done) {
            $maptuning_done = "n";
        }

        $hasValidCoord = false; //If hasValidCoord = false map is not loaded in form_listing

        if ($latitude && $longitude && is_numeric($latitude) && is_numeric($longitude)) {
            $hasValidCoord = true;
        }

        if (!$id || $hasValidCoord) {
            $_COOKIE['showMapForm'] = 0;
        }
    endif;

else:

    $loadMap = true;

		endif;