<?php

# ----------------------------------------------------------------------------------------------------
# * FILE: /sponsors/listing/app.php
# ----------------------------------------------------------------------------------------------------
if (!$_SERVER['HTTP_X_REQUESTED_WITH']) {
    header("Location:" . DEFAULT_URL . "/" . ALIAS_LISTING_MODULE);
    exit;
}
# ----------------------------------------------------------------------------------------------------
# LOAD CONFIG
# ----------------------------------------------------------------------------------------------------
include("../../conf/loadconfig.inc.php");
include_once CLASSES_DIR . DIRECTORY_SEPARATOR . 'class_App.php';






# ----------------------------------------------------------------------------------------------------
# SESSION
# ----------------------------------------------------------------------------------------------------
sess_validateSession();
$acctId = sess_getAccountIdFromSession();
$contact = new Contact($acctId);
$sponsor_firstname = ucfirst($contact->first_name);
$sponsor_lastname = ucfirst($contact->last_name);
$sponsor_email = $contact->email;
$listing_id = mysql_real_escape_string($_GET['id']);



//check unique username
if($_POST['unique_username']){
    $listing_id = $_POST['listing_id'];
    $id = $_POST['id'];
    $username = $_POST['unique_username'];
    $return = APP::checkUniqueUsername($listing_id,$username,$id);
    if($return == 1){
         echo 1;
    }else{
        echo 0;
    }
    exit;
    
}





# ----------------------------------------------------------------------------------------------------
# AUX
# ----------------------------------------------------------------------------------------------------
extract($_GET);
extract($_POST);



# ----------------------------------------------------------------------------------------------------
# VALIDATION
# ----------------------------------------------------------------------------------------------------
$listObj = new Listing($id);
$listing_name = $listObj->title;
$owner_id = $listObj->account_id;

$invalidDataIndex = array();

if ($acctId != $owner_id) {
    header("Location: " . DEFAULT_URL . "/" . MEMBERS_ALIAS . "/");
    exit;
}


if ($_POST['app_addusers']) {
    $times = count($fullname);
    for ($i = 0; $i < $times; $i++) {
        $fullname[$i] = strip_tags($_POST['fullname'][$i]);
        $username[$i] = strip_tags($_POST['username'][$i]);
        $password[$i] = strip_tags($_POST['password'][$i]);
        $email[$i] = strip_tags($_POST['email'][$i]);
        $is_enable[$i] = strip_tags($_POST['is_enable'][$i]);
        // Save to database
        $last_insert_id = App::InsertUser($listing_id, $fullname[$i], $username[$i], $password[$i], $email[$i], $is_enable[$i]);
        //Build Log  - "New User Created" 
        $message = " - Full Name: " . $fullname[$i] .
                " , " . "Username: " . $username[$i] .
                "  , " . "Password: " . $password[$i] .
                "  , " . "Email: " . $email[$i] . "\r\n" .
                "- The App user " . $fullname[$i] . " has been created on Business name '" . $listing_name . "' with Business Id '" . $app_id . "' on " . date("F j, Y, g:i a") . "\r\n";
        file_put_contents(EDIRECTORY_ROOT . "/custom/log/web_service.log", $message, FILE_APPEND);
   
        
           $app_id = Listing::getAppIdFromListingId($listing_id);
    $emailNotificationObj = system_checkEmail(NEW_APP_USER);
    setting_get("sitemgr_email", $sitemgr_email);
    $subject = $emailNotificationObj->getString("subject");
    $body = $emailNotificationObj->getString("body");
    $row = App::getRowsWithId($last_insert_id);
    $to = $row['email'];
    $android_link = ANDROID_LINK;
    $android_img = ANDROID_IMG;
    $ios_link = IOS_LINK;
    $ios_img = IOS_IMG;
//   $microsoft_link = MICROSOFT_APP_LINK;
//     $microsoft_img = MICROSOFT_IMAGE;
    $subject = str_replace("EDIRECTORY_TITLE", EDIRECTORY_TITLE, $subject);
    $body = str_replace("FULLNAME", $row['fullname'], $body);
    $body = str_replace("ANDROID_LINK", $android_link, $body);
    $body = str_replace("IOS_LINK", $ios_link, $body);
    $body = str_replace("IOS_IMG", $ios_img, $body);
    $body = str_replace("ANDROID_IMG", $android_img, $body);
//    $body = str_replace("MICROSOFT_LINK", $microsoft_link, $body);
//    $listing_name= preg_replace('/^\</m', '', $listing_name);
    $lt_sign = htmlspecialchars('&lt;');
    $gt_sign = htmlspecialchars('&gt;');
    $listing_name = str_replace("<" , $lt_sign ,$listing_name);
    $listing_name = str_replace(">" , $gt_sign ,$listing_name);
    $body = str_replace("BUSINESSNAME",$listing_name, $body);
    $body = str_replace("APPID", $app_id, $body);
    $body = str_replace("USERNAME", $row['username'], $body);
    $body = str_replace("PASSWORD", $password[$i], $body);
    $body = html_entity_decode($body);
    $subject = html_entity_decode($subject);
    $error = FALSE;
    system_mail($to, $subject, $body, EDIRECTORY_TITLE . " <$sitemgr_email>", $emailNotificationObj->getString("content_type"), "", $emailNotificationObj->getString("bcc"), $error, "", "", "", "", "", NEW_APP_USER);
    //Build Log  - "Sent Email" 
    if (LOG_BUILDER == TRUE) {
        $message = "- Registration email has been successfully sent to" . $row['fullname'] . " on email address '" . $row['email'] . "' on " . date("F j, Y, g:i a") . "\r\n\r\n";
        file_put_contents(EDIRECTORY_ROOT . "/custom/log/web_service.log", $message, FILE_APPEND);
    }
        
        
        
        
    }
    //Send Email
 
}

if ($listObj->status == "A") {
    if (!$_POST) {
        include_once('app/manage-user.php');
    }
} else {
    include(INCLUDES_DIR . "/views/view_listing_not_activated.php");
}
?>
