<?

# ----------------------------------------------------------------------------------------------------
# * FILE: /members/listing/review-collector.php
# ----------------------------------------------------------------------------------------------------

include_once CLASSES_DIR . DIRECTORY_SEPARATOR . 'class_ReviewCollector.php';
include_once CLASSES_DIR . DIRECTORY_SEPARATOR . 'class_Listing.php';


if($_POST){
        $input = $_POST;
    }
    else{
     $input = json_decode(file_get_contents('php://input'),true);
    }
# ----------------------------------------------------------------------------------------------------
# AUX
# ----------------------------------------------------------------------------------------------------
extract($_GET);
extract($input);

$listing_id = mysql_real_escape_string($input['id']);
if ($input['AddUsers']) {
        
        $firstname = strip_tags($input['firstname']);
        $lastname = strip_tags($input['lastname']);
        $email = strip_tags($input['email']);
        $firstname = mysql_real_escape_string($firstname);
        $lastname = mysql_real_escape_string($lastname);
        $email = mysql_real_escape_string($email);
        $msg = str_replace("FIRSTNAME", $firstname, $body);
        $result = ReviewCollector::RegisterReviewCollector(null, $listing_id, '', $firstname, $lastname, $email);
        if($result){
            echo json_encode(array('status'=>'success','msg'=>'Thank you! Review request email has been sent.'));
        }
        else{
            echo json_encode(array('status'=>'failed','msg'=>'Oops! There might be something wrong.'));
        }
         // send email to reviewer
       $listing_details = Listing::GetListing($listing_id);  
       $item_name = $listing_details['title']; 
       $listing_url = NON_SECURE_URL . "/" . ALIAS_LISTING_MODULE ."/". $listing_details['friendly_url'];
        $contactObj = new Contact($listing_details->account_id);
                if ($emailNotificationObj = system_checkEmail(59)) {
                    setting_get("sitemgr_send_email", $sitemgr_send_email);
                    setting_get("sitemgr_email", $sitemgr_email);
                    $sitemgr_emails = explode(",", $sitemgr_email);
                    if ($sitemgr_emails[0])
                        $sitemgr_email = $sitemgr_emails[0];
                    $subject = $emailNotificationObj->getString("subject");
                    $body = $emailNotificationObj->getString("body");
                    $body = str_replace("ACCOUNT_NAME", ($input['firstname'] . ' ' . $input['lastname']), $body);
                    $listing_name = $item_name;
                    $lt_sign = htmlspecialchars('&lt;');
                    $gt_sign = htmlspecialchars('&gt;');
                    $listing_name = str_replace("<" , $lt_sign ,$listing_name);
                    $listing_name = str_replace(">" , $gt_sign ,$listing_name);
                    $body = str_replace("LISTING_NAME", $listing_name, $body);
                    $body = str_replace("LISTING_URL", $listing_url, $body);
                    $body = html_entity_decode($body);
                    $subject = html_entity_decode($subject);
                    $error = false;
                    $send_email_reviewer = system_mail($input['email'], $subject, $body, EDIRECTORY_TITLE . " <$sitemgr_email>", $emailNotificationObj->getString("content_type"), "", $emailNotificationObj->getString("bcc"), $error, "", "", "", "", $contactObj->account_id, REVIEW_LATER);
                    if ($send_email_reviewer && LOG_BUILDER == TRUE) {
                        $message = "Method_type: " . $input['method_type'] .
                                " Email has been sent to reviewer on " . date("F j, Y, g:i a") . "\r\n\r\n";
                        file_put_contents(EDIRECTORY_ROOT . "/custom/log/web_service.log", $message, FILE_APPEND);
                    } else {
                        $message = "Method_type: " . $input['method_type'] .
                                " Unable to send email to reviewer on " . date("F j, Y, g:i a") . "\r\n\r\n";
                        file_put_contents(EDIRECTORY_ROOT . "/custom/log/web_service.log", $message, FILE_APPEND);
                    }
                }
        
        
        
        
        
        
        
}


?>
