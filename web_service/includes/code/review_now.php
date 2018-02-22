<?php

include_once(EDIRECTORY_ROOT."/classes/class_ReviewCollector.php");
    if($_POST){
        $input = $_POST;
    }
    else{
     $input = json_decode(file_get_contents('php://input'),true);
    }
        // check user account
        $user = ReviewCollector::getUsersFromEmail($input['reviewer_email']);
        // user exists
        $key = ReviewCollector::getAccountFromAccount($user);
        if( !empty($user[$key]) ){
            $input['member_id'] = $user[$key]['id'];
            $input['activeornot'] = $user[$key]['active'];
        }//create user account if not exist
        else if( empty($user[$key]) && $input['review']){
            $input['signup'] = 'signup';
            $input['username'] = $input['reviewer_email'];
            $input["retype_password"] = $input["password"] = substr(md5($input['reviewer_email']), rand(0, 10), 8);
            $input['first_name'] = $input['reviewer_name'];
            $input['last_name'] = ' ';
            $input['agree_tou'] = true;            
            $input['active'] = 'y';
            include("review_signup.php");
            $input['member_id'] = $account->getNumber('id');
            $input['activeornot'] = 'y';
        }
        // show review form
        include(EDIRECTORY_ROOT."/web_service/includes/code/review.php");
        
   
