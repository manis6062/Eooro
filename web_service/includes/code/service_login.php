<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
# ----------------------------------------------------------------------------------------------------
# LOAD CONFIG
# ----------------------------------------------------------------------------------------------------

        if($_SERVER['HTTP_HOST'] == "localhost") { 
            include("../conf/loadconfig.inc.php");
        }
        else{
            include("../../../conf/loadconfig.inc.php");
        }




include_once(EDIRECTORY_ROOT . "/web_service/functions/session_funct.php");

# ----------------------------------------------------------------------------------------------------
# CODE
# ----------------------------------------------------------------------------------------------------

if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $msg_arr = array('status' => 'failed', 'msg' => "New app is released with improvements, you will have to update your app before you can proceed.");
            echo json_encode($msg_arr);   
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if($_POST){
        $input = $_POST;
    }
    else{
     $input = json_decode(file_get_contents('php://input'),true);
    }
    
  

    /*     * * check for user login ** */
    if ($input['method_type'] == 'service_login') { 
        $listing_id = json_decode(sess_authenticateServiceAccount($input['app_id'] ,$input['username'], $input['password'], $authmessage)); 

        if ($listing_id->listing_id != null) {
            $listingObj = new Listing();
            $listing_name = $listingObj->getListingFromID($listing_id->listing_id);
            $arr = array('status' => 'success', 'listing_id' => $listing_id->listing_id, 'listing_title' => $listing_name, 'msg' => $listing_id->msg);
            echo json_encode($arr);
            
         //Build Login Success
         if (LOG_BUILDER == TRUE) {
          $message = "Method_type: " . $input['method_type'] .
           " , ". "Business Id: " . $input['app_id'] .
           " , ". "Username: " . $input['username'] .
           "  , ". " Password: " . $input['password'] .  "\r\n".
                 $input['username'] . " succcessfully login on  " . date("F j, Y, g:i a") ."\r\n\r\n";
         file_put_contents(EDIRECTORY_ROOT."/custom/log/web_service.log", $message, FILE_APPEND); }
            
        } else {
            $arr = array('status' => 'failed', 'listing_id' => null, 'listing_title' => null, 'msg' => $listing_id->msg);
            echo json_encode($arr);
         //Build Login Failed
         if (LOG_BUILDER == TRUE) {
          $message = "Method_type: " . $input['method_type'] .
                  " , ". "Business Id: " . $input['app_id'] .
           " , ". "Username: " . $input['username'] .
           "  , ". " Password: " . $input['password'] .  "\r\n".
                 $input['username'] . " failed to login on  " . date("F j, Y, g:i a") ."\r\n\r\n";
         file_put_contents(EDIRECTORY_ROOT."/custom/log/web_service.log", $message, FILE_APPEND); } 
        }
    }

    /*     * * review now system ** */
    if ($input['method_type'] == 'review_now') {
        
        //Build Log for review now
        if (LOG_BUILDER == TRUE) {
            $message = "Method_type: " . $input['method_type'] .
                    " , " . "Listing Id: " . $input['item_id'] .
                    " , " . "Listing Name: " . $input['listing_name'] .
                    " , " . "Business Id: " . $input['business_id'] .
                    " , " . "Reviewer Name: " . $input['reviewer_name'] .
                    "  , " . "Reviewer Email: " . $input['reviewer_email'] .
                    "  , " . "Review Title: " . $input['review_title'] .
                    "  , " . "Review : " . $input['review'] .
                    "  , " . "Rating : " . $input['rating'] . "\r\n" .
                    $input['reviewer_name'] . " wrote a review on " . date("F j, Y, g:i a") . "\r\n";
            file_put_contents(EDIRECTORY_ROOT . "/custom/log/web_service.log", $message, FILE_APPEND);
        }
         include("review_now.php");
       
    }

      /*     * * review latter system ** */
    if ($input['method_type'] == 'review_latter') {
      
          //Build Log
        if (LOG_BUILDER == TRUE) {
            $message = "Method_type: " . $input['method_type'] .
                    " , " . "Listing Id: " . $input['id'] .
                    " , " . "Listing Name: " . $input['listing_name'] .
                    " , " . "Business Id: " . $input['business_id'] .
                    " , " . "Name: " . $input['firstname'] . ' ' . $input['lastname'] .
                    "  , " . " Email: " . $input['email'] . "\r\n" .
                    $input['firstname'] . ' ' . $input['lastname'] . " submitted email address on " . date("F j, Y, g:i a") . "\r\n\r\n";
            file_put_contents(EDIRECTORY_ROOT . "/custom/log/web_service.log", $message, FILE_APPEND);
        }
                include("review_latter.php");

    }
}

