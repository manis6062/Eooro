



<?php
    /*==================================================================*\
    ######################################################################
    #                                                                    #
    # Copyright 2005 Arca Solutions, Inc. All Rights Reserved.           #
    #                                                                    #
    # This file may not be redistributed in whole or part.               #
    # eDirectory is licensed on a per-domain basis.                      #
    #                                                                    #
    # ---------------- eDirectory IS NOT FREE SOFTWARE ----------------- #
    #                                                                    #
    # http://www.edirectory.com | http://www.edirectory.com/license.html #
    ######################################################################
    \*==================================================================*/

    # ----------------------------------------------------------------------------------------------------
    # * FILE: /members/ajax.php
    # ----------------------------------------------------------------------------------------------------

    # ----------------------------------------------------------------------------------------------------
    # LOAD CONFIG
    # ----------------------------------------------------------------------------------------------------
    include("../conf/loadconfig.inc.php");
    
    header("Content-Type: text/html; charset=".EDIR_CHARSET, TRUE);
    header("Accept-Encoding: gzip, deflate");
    header("Expires: Sat, 01 Jan 2000 00:00:00 GMT");
    header("Cache-Control: no-store, no-cache, must-revalidate");
    header("Cache-Control: post-check=0, pre-check", FALSE);
    header("Pragma: no-cache");
    
    extract($_POST);
    
   
    # ----------------------------------------------------------------------------------------------------
    # CODE
    # ----------------------------------------------------------------------------------------------------    
    if ($ajax_type == "setItemAsViewed") {
    
        if ($type == "review") {
            $itemObj = new Review($id);
        } elseif ($type == "lead") {
            $itemObj = new Lead($id);
        }
        $itemObj->setString("new", "n");
        $itemObj->save();
    
    } elseif ($ajax_type == "lead_reply") {
        
        extract($_POST);
        $isAjax = true;
        include(EDIRECTORY_ROOT."/includes/code/lead.php");
        
    } elseif ($ajax_type == "load_dashboard") {
        sess_validateSession();
        $acctId = sess_getAccountIdFromSession();
    
        if ($item_id) {
            $itemObj = new $item_type($item_id);
            //ListingPending Modification
            $itemObj->status == "P" ? $itemObj = new ListingPending($item_id): null;

            //Prepare code for dashboard
            include(INCLUDES_DIR."/code/member_dashboard.php");

            //Build dashboard
            include(INCLUDES_DIR."/views/view_member_dashboard.php");
        }
        
    } elseif ($ajax_type == "review_reply") {
        
        if (string_strlen(trim($_POST["reply"])) > 0) {

            setting_get("review_approve", $review_approve);
            $responseapproved = 0;
            if (!$review_approve == "on") $responseapproved = 1;

            $reviewObj = new Review($_POST["idReview"]);
            $review    = trim($_POST["reply"]);
            // $review    = filter_var($review, FILTER_SANITIZE_STRING);//this line has been removed to save records with mysql_real_escape_string
//            $review    = mysql_real_escape_string($review);
            $reviewObj->setString("response", $review);
            $reviewObj->setString("responseapproved", $responseapproved);
            $reviewObj->save();
            echo "ok";
        } else {
            echo "error";
        }
        
    } elseif ($ajax_type == "getunpaidItems") {
        
        include(INCLUDES_DIR."/code/billing.php");
    
        $toPayItems[] = "listings";
        $toPayItems[] = "cases";  
        $toPayItems[] = "events";
        $toPayItems[] = "banners";
        $toPayItems[] = "classifieds";
        $toPayItems[] = "articles";
        $toPayItems[] = "custominvoices";

        $countUnpaid = 0;

        foreach ($toPayItems as $toPayItem) {

            if ($bill_info[$toPayItem]) {

                if ($toPayItem == "custominvoices") {
                    $countUnpaid++;
                } else {
                    foreach($bill_info[$toPayItem] as $id => $info){
                        if ($info["needtocheckout"] == "y") {
                            $countUnpaid++;
                        }
                    }
                }
            }

        }

        //Cases

        
        echo $countUnpaid;
        
    } elseif ($ajax_type == "getFacebookImage") {
        DBQuery::execute(function()use($_POST,$agent,$ref){
            $dbObj = DBConnection::getInstance()->getMain();
            $sql = $dbObj->prepare("SELECT facebook_uid FROM Profile WHERE account_id =:id");
            $sql->bindParam(':id', $_POST["id"]);
            $result = $sql->execute();
            $row = $sql->fetch(\PDO::FETCH_ASSOC);
            $uid = $row["facebook_uid"];

            $imgURL = "http://graph.facebook.com/".$uid."/picture?type=large";

            $ch = curl_init($imgURL);
            curl_setopt($ch, CURLOPT_URL, $imgURL);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_USERAGENT, $agent);
            curl_setopt($ch, CURLOPT_REFERER, $ref);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HEADER, false);

            $data = curl_exec($ch);

            curl_close($ch);
            $filename = EDIRECTORY_ROOT."/custom/domain_".SELECTED_DOMAIN_ID."/tmp/temp.".time();

            $fp = fopen($filename, "w+");
            fwrite($fp, $data);
            fclose($fp);

            $info = getimagesize($filename);

            @unlink($filename);
            image_getNewDimension(PROFILE_MEMBERS_IMAGE_WIDTH, PROFILE_MEMBERS_IMAGE_HEIGHT, $info[0], $info[1], $newWidth, $newHeight);

            echo $imgURL."[FBIMG]".$newWidth."[FBIMG]".$newHeight;
        });
    } elseif ($ajax_type == "deleteListing") {
        $id = $_POST['item_id'];
        DBQuery::execute(function()use($_POST,$id){
             $dbMain  = DBConnection::getInstance()->getMain();
            $dbObj   = DBConnection::getInstance()->getDomain();
            $acctId  = sess_getAccountIdFromSession();

            // Verify if the listing belongs to the user

            $sql = $dbObj->prepare("SELECT account_id From Listing WHERE id =:id");
            $sql->bindValue(':id', $_POST['item_id']);
            $sql->execute();
            $result = $sql->fetch(\PDO::FETCH_ASSOC);
            if( $result['account_id'] == $acctId ) {

                // unsubscribe the listing

                require_once EDIRECTORY_ROOT.'/braintree/braintree-php/lib/Braintree.php';
                require_once EDIRECTORY_ROOT.'/braintree/_environment.php';
            
                
                if($id > 0){ 

                    $listingObj = new Listing($id);
                    $accountObj = new Account($listingObj->account_id);
        
                        //Check if subscription Id is present
                        if($listingObj->custom_text2){

                            //Unsubscribe Listing
                            
                             try {
                                $result = Braintree_Subscription::cancel($listingObj->custom_text2);    
                            } catch (Exception $e) {
                                die("false");
                            }
                            if($result->success == true){                             
                                $listingObj->custom_text2 = ""; //subscription id from braintree
                                $listingObj->custom_text4 = ""; //customer id from braintree
                                $listingObj->custom_text5 = ""; //payment method token from braintree
                                $listingObj->save();

                                # TODO: LOG NEEDS TO CREATED FOR REMOVED LISTINGS.

                                // save log in Payment_log
                                // $listingLog['account_id'] = $acctId;
                                // $listingLog['username'] = $accountObj->username;
                                // $listingLog['ip'] = $_SERVER["REMOTE_ADDR"];
                                // $listingLog['transaction_id'] = date("Y-m-d_H-i-s"). "." . $accountObj->id;
                                // $listingLog['transaction_status'] = 'Removed';
                                // $listingLog['transaction_datetime'] = date("Y-m-d H:i:s");
                                // $listingLog['transaction_subtotal'] = '0.00';
                                // $listingLog['transaction_tax'] = '0.00';
                                // $listingLog['transaction_amount'] = '0.00';
                                // $listingLog['transaction_currency'] = '';
                                // $listingLog['system_type'] = '';
                                // $listingLog['recurring'] = 'n';
                                // $listingLog['notes'] = 'Business Removed';
                                // // $listingLog['return_fields'] = system_array2nvp($subscription_data, " || ");
                                // $listingLog['return_fields'] = '';
                                // $listingLog['hidden'] = 'n';

                                // $paymentLogObj = new PaymentLog($listingLog);
                                // $paymentLogObj->Save();

                                // // save log in Payment_Listing_log
                                // LogListingPayment($listingObj->id, $renewal_date, $paymentLogObj->id, true, true);
                            }
                            else{ 

                                echo 'false'; die;

                            }
                            
                        }
        
                }
                else{ 

                    echo 'false'; die;
                }    
                
                // set custom_checkbox4 = no if deleted listing from overview

                $sql = $dbObj->prepare("UPDATE Listing SET status = 'A', account_id = '0',claim_disable = 'n', discount_id = null WHERE id =:id");
                $sql->bindParam(':id', $id);
                $result = $sql->execute();
                
                $sql = $dbObj->prepare("UPDATE Listing_Summary SET status = 'A', claim_disable = 'n', account_id = '0' WHERE id =:id");
                $sql->bindParam(':id', $id);
                $result = $sql->execute();

                echo ($result == true ? "true" : "false");

            } else {                 
                echo "false";

            }  

            
        });
    } elseif ($ajax_type == "changeCurrency") {

        /*
            #--------------------------------------------
            # Currency change logic :
            #--------------------------------------------

            Test whether listing is subscription based or normal.
            If Listing is subscription based, pull data from "Price_list" table.

            For Normal listings and cases, the below code should work
        */


//            include_once EDIRECTORY_ROOT.'/classes/class_Opened_Cases.php';
//
//            $acctId          = sess_getAccountIdFromSession();
//            $dbMain          = db_getDBObject(DEFAULT_DB, true);
//            $target_currency = mysql_real_escape_string($_POST['newVal']);
//
//            //Extract symbol
//            $sql    = "SELECT symbol from Location_1 WHERE currency='$target_currency'";
//            $result = $dbMain->query($sql);
//            $row    = mysql_fetch_assoc($result);
//            $symbol = $row['symbol'];
//
//            //Set prefred currency as target currency for this account
//            $account = new Account(sess_getAccountIdFromSession());
//            $account->prefered_currency = $target_currency;
//            $account->currency_symbol   = $symbol;
//            $account->save();
//
//                    function getPriceListing($listing_id, $location_1, $target_currency)
//                    {
//
//                        $listing_id      = mysql_real_escape_string($listing_id);
//                        $location_1      = mysql_real_escape_string($location_1);
//                        $target_currency = mysql_real_escape_string($target_currency);
//
//                        if (CheckDurationBasedListing($listing_id) == true):
//
//                            //returns price, currency and symbol of lisintg
//                            $return  = CountryLoader::getCurrencyAndSymbolBasedOnGEOIP('price_listing', $location_1);
//                            //Global Brands Modification
//                            $listingObj = new Listing($listing_id);
//                            if($listingObj->status == "P"){
//                                $listingObj = new ListingPending($listing_id);
//                            }
//
//                            //Set $duration value as monthly or yearly based on listing's custom_checkbox3
//                            if($listingObj->custom_checkbox3 == "y"):
//                                $duration = "monthly";
//                            else:
//                                $duration = "yearly";
//                            endif;
//                    
//                            //Extract price, for global and non global brands
//                            if($listingObj->custom_checkbox1 != "y"):
//                                $return['price_listing']  = Location1::getPrice($listingObj->location_1,  $duration);
//                            else: 
//                                $return['price_listing']  = ListingLevel::getPriceDuration($duration);
//                            endif;
//                            
//                            $forex = CountryLoader::getForexRate($location_1, $target_currency);
//
//                            //Check to see if listing has discount_code
//                            $listingObj  = new Listing($listing_id);
//                            $discount_id = $listingObj->discount_id;
//                            
//                            if($discount_id){
//                                $discountCodeObj = new DiscountCode($discount_id);
//
//                                if ($discountCodeObj->getString("id") && $discountCodeObj->expire_date >= date('Y-m-d')) {
//                                    if ($discountCodeObj->getString("type") == "percentage") {
//                                        $return['price_listing'] = $return['price_listing'] * (1 - $discountCodeObj->getString("amount")/100);
//                                    } elseif ($discountCodeObj->getString("type") == "monetary value") {
//                                        $return['price_listing'] = $return['price_listing'] - $discountCodeObj->getString("amount");
//                                    }
//                                } 
//                            }
//
//                            //After discount code, multiply with forex rate and send back value
//                            $return['price_listing'] = $forex * $return['price_listing'];
//                            return sprintf('%0.2f', $return['price_listing']);
//
//                        else:
//
//                            $dbMain = db_getDBObject(DEFAULT_DB, true);
//                            //Tally This Plan ID with Price_list table and get the price
//                            $plan   = getPlanId($listing_id);
//                            $sql    = "SELECT plan_price From Price_list WHERE plan_id = '$plan'";
//                            $result = $dbMain->query($sql);
//                            $row    = mysql_fetch_assoc($result);
//
//                            return sprintf('%0.2f', $row['plan_price']);
//
//                        endif;
//
//                    }
//
//                    function getPriceCases($case_id, $location_1, $target_currency)
//                    {
//                        include_once EDIRECTORY_ROOT.'/classes/class_Opened_Cases.php';
//
//                        //Global Brands Price
//                        $listing    = Opened_Cases::getThisCaseListing($case_id);
//                        $listingObj = new Listing($listing);
//                        if($listingObj->status == "P"){
//                            $pendingObj = new ListingPending($listing_id);
//                        }
//                        
//                        $return  = CountryLoader::getCurrencyAndSymbolBasedOnGEOIP('price_case', $location_1);
//                        if($listingObj->custom_checkbox1 == "y" || $pendingObj->custom_checkbox1 == "y"){
//                            $caseObj = new Opened_Cases($case_id);
//                            $return['price_case'] = $caseObj->getPrice();
//                            $location_1 = null;
//                        }
//
//                        $account = new Account(sess_getAccountIdFromSession());
//                        $forex   = CountryLoader::getForexRate($location_1, $target_currency);
//                        
//                        //Check to see if listing has discount_code
//                        $caseObj     = new Opened_Cases($case_id);
//                        $discount_id = $caseObj->discount_id;
//                   
//                        if($discount_id){
//                            $discountCodeObj = new DiscountCode($discount_id);
//
//                            if ($discountCodeObj->getString("id") && $discountCodeObj->expire_date >= date('Y-m-d')) {
//                                if ($discountCodeObj->getString("type") == "percentage") {
//                                    $return['price_case'] = $return['price_case'] * (1 - $discountCodeObj->getString("amount")/100);
//                                } elseif ($discountCodeObj->getString("type") == "monetary value") {
//                                    $return['price_case'] = $return['price_case'] - $discountCodeObj->getString("amount");
//                                }
//                            } 
//                        }
//
//                        $return['price_case'] = $forex * $return['price_case'];
//
//                        return sprintf('%0.2f', $return['price_case']);
//
//                    }
// 
//                    foreach ($_POST['listings'] as $value){
//                        $price[$value['id']][] = getPriceListing($value['id'], $value['loc'], $target_currency);
//                    }
//
//                    
//                    foreach ($_POST['cases'] as $value){
//                        $case_id               = new Opened_Cases($value['id']);
//                        $location_1            = $case_id->getLocationCase($value['id']);
//                        $price[$value['id']][] = getPriceCases(mysql_real_escape_string($value['id']), mysql_real_escape_string($location_1), $target_currency);
//                    }
//
//            $return_array['symbol'] = $symbol;
//            $return_array['price']  = $price;
//                      
//            echo json_encode($return_array);

    
    } elseif ($ajax_type == "changeDuration") {

        if(trim($type) != 'yearly' && trim($type) != 'monthly' ):
            die('error');
        endif;   

        if(intval($listing) < 1):
            die('error');
        endif;

        if(Listing::is_owner($listing, sess_getAccountIdFromSession()) == false ):
            die('error');
        endif;

        
        function getListingPrice($listing_id, $duration)
        {
            $listingObj = new Listing($listing_id);          
            $listing = $listingObj;
            if($listingObj->status == "P"):
                $listingObj = new ListingPending($listing_id);
            endif;

            //Set Monthly or Yearly billing for that listing
            if($duration == "monthly"):
                $listingObj->custom_checkbox3 = "y";
                $listingObj->discount_id      = "";
                $listing->discount_id = '';
                $listing->Save();

            elseif($duration == "yearly"):
                $listingObj->custom_checkbox3 = "n";
            endif;

            foreach ($listingObj as $key => $value) {
                $listingObj->$key = $value;
            }

            $listingObj->save();
            $price = CountryLoader::getPriceListing( $listingObj->id,  $listingObj->location_1);
            $price = $price['price_listing'];

            $arr = array('price' => $price, 'custom_checkbox4' => $listingObj->custom_checkbox4 ); 
            echo json_encode($arr);
        }

        $base_price  = getListingPrice($listing, $type); //Price extracted form table
        echo $base_price;
              
    } elseif ($ajax_type == "loadState" ) {

        include CORE_DIR.'/modfactory.php';
        DBQuery::execute(function()use($_POST){
            $dbMain    = DBConnection::getInstance()->getMain();
            $validator = ModFactory::getValidator();
            $request   = $validator->escape( $_POST );
            $sql = $dbMain->prepare("SELECT id, name FROM Location_3 WHERE Location_1 =:loc_1 AND name LIKE CONCAT(:state, '%')");
            $sql->bindParam(':loc_1' ,$request['loc_1']);
            $sql->bindParam(':state' ,$request['state']);
            $result = $sql->execute();
            while($row = $sql->fetch(\PDO::FETCH_ASSOC)){
                            $return[] = $row;
            }
            echo json_encode($return);
        });
    } elseif ($ajax_type == "loadCity" ) {
        
        DBQuery::execute(function()use($_POST){

            include CORE_DIR.'/modfactory.php';
            $dbMain    = DBConnection::getInstance()->getMain();
            $validator = ModFactory::getValidator();
            $request   = $validator->escape( $_POST );

            $sql = $dbMain->prepare("SELECT id, name FROM Location_4 WHERE Location_1 =:loc_1 AND Location_3 =:loc_3 AND name LIKE CONCAT(:city, '%')");
            $sql->bindParam(':loc_1' , $request['loc_1']);
            $sql->bindParam(':loc_3' , $request['loc_3']);
            $sql->bindParam(':city' , $request['city']);
            $result = $sql->execute();
            while($row = $sql->fetch(\PDO::FETCH_ASSOC)){
                            $return[] = $row;
            }
            echo json_encode($return);
        });
    } elseif($ajax_type == "reviewcollectorChangeData"){
        DBQuery::execute(function()use($changeType,$newValue,$customerID){

            $dbMain  = DBConnection::getInstance()->getMain();
            $dbObj   = DBConnection::getInstance()->getDomain();

            //Validation
            (trim($changeType) == "name" || trim($changeType) == "email") ? null : die('error'); 
            is_numeric($customerID) ? null : die('error');
            $newValue = str_replace("<br>", "", $newValue);
            $newValue = htmlentities($newValue);

            if($changeType == "name"){
                $explode = explode(" ", $newValue);
                $firstname = $explode[0];
                $lastname  = $explode[1];
                ($firstname == null || $lastname == null) ? die('Firstname and Lastname must be specified.') : null;

                $sql = $dbObj->prepare("UPDATE ReviewCollector SET firstname =:firstname, lastname =:lastname WHERE id =:customer_id");
                $sql->bindParam(':firstname' ,$firstname);
                $sql->bindParam(':lastname' ,$lastname);
                $sql->bindParam(':customer_id' ,$customerID);
                $result = $sql->execute();
                echo ($result == true ? "success" : "error");

            } elseif($changeType == "email"){
                validate_email($newValue) == false ? die('Please enter a valid email address.') : null;

                $sql = $dbObj->prepare("UPDATE ReviewCollector SET email =:new_value WHERE id =:customer_id");
                $sql->bindParam(':new_value' , $newValue);
                $sql->bindParam(':customer_id' , $customerID);
                $result = $sql->execute();
                echo ($result == true ? "success" : "error");  
            } else {
                die('error');
            }
        });

    } 
   
    
    elseif ($ajax_type == "editForm") {        
         $dbMain  = DBConnection::getInstance()->getMain();
        $id = str_replace("'","", $id);
        is_numeric($id) ? null : die('error');  
        if($_POST['password']){
           $sql = $dbMain->prepare("UPDATE Review_login_credentials SET username =:username , password =:password , email=:email WHERE id =:id");
         $sql->bindParam(':password' ,md5($password));
           
        }
        else{
           $sql = $dbMain->prepare("UPDATE Review_login_credentials SET username =:username  , email=:email WHERE id =:id");

        }
                $sql->bindParam(':username' ,$username);
                $sql->bindParam(':email' ,$email);
                $sql->bindParam(':id' ,$id);
                $result = $sql->execute();
        echo ($result == true ? "true" : "false");
                


        
    }
    







// Inline Edit for APP USER 
    elseif($ajax_type == "appChangeData"){
        DBQuery::execute(function()use($changeType,$newValue,$id){

            $dbMain  = DBConnection::getInstance()->getMain();
            //Validation
       (trim($changeType) == "fullname" || trim($changeType) == "username" || trim($changeType) == "password" || trim($changeType) == "email" || trim($changeType) == "is_enable" || trim($changeType) == "is_locked") ? null : die('error'); 

              
            is_numeric($id) ? null : die('error');
            $newValue = str_replace("<br>", "", $newValue);
            $newValue = htmlentities($newValue);

            if($changeType == "fullname"){
                $fullname = $newValue;
                ($fullname == null) ? die('Fullname must be specified.') : null;

                $sql = $dbMain->prepare("UPDATE Review_login_credentials SET fullname =:fullname WHERE id =:id");
                $sql->bindParam(':fullname' ,$fullname);
                $sql->bindParam(':id' ,$id);
                $result = $sql->execute();
                echo ($result == true ? "success" : "error");

            } 
             if($changeType == "username"){
                 $username = $newValue;
                ($username == null) ? die('Username must be specified.') : null;

                $sql = $dbMain->prepare("UPDATE Review_login_credentials SET username =:username WHERE id =:id");
                $sql->bindParam(':username' ,$username);
                $sql->bindParam(':id' ,$id);
                $result = $sql->execute();
                echo ($result == true ? "success" : "error");

            }
             if($changeType == "password"){
                $password = $newValue;
                ($password == null) ? die('Pasword must be specified.') : null;

                $sql = $dbMain->prepare("UPDATE Review_login_credentials SET password =:password WHERE id =:id");
                $sql->bindParam(':password' ,md5($password));
                $sql->bindParam(':id' ,$id);
                $result = $sql->execute();
                echo ($result == true ? "success" : "error");

            }
            if($changeType == "email"){
                validate_email($newValue) == false ? die('Please enter a valid email address.') : null;

                $sql = $dbMain->prepare("UPDATE Review_login_credentials SET email =:new_value WHERE id =:id");
                $sql->bindParam(':new_value' , $newValue);
                $sql->bindParam(':id' , $id);
                $result = $sql->execute();
                echo ($result == true ? "success" : "error");  
            }
            
              if($changeType == "is_enable"){
                $is_enable = $newValue;
                ($is_enable == null) ? die('Status must be specified.') : null;

                $sql = $dbMain->prepare("UPDATE Review_login_credentials SET is_enable =:is_enable WHERE id =:id");
                $sql->bindParam(':is_enable' ,$is_enable);
                $sql->bindParam(':id' ,$id);
                $result = $sql->execute();
                echo ($result == true ? "success" : "error");
            }
            
             if($changeType == "is_locked"){
                $is_locked = $newValue;
                ($is_locked == null) ? die('Status must be specified.') : null;
                

                $sql = $dbMain->prepare("UPDATE Review_login_credentials SET is_locked =:is_locked WHERE id =:id");
                $sql->bindParam(':is_locked' ,$is_locked);
                $sql->bindParam(':id' ,$id);
                $result = $sql->execute();
                
                if($result){
                    
                    if($is_locked == 0){
                        $failed_count = 0;
                         $sql = $dbMain->prepare("UPDATE Review_login_credentials SET faillogin_count =:faillogin_count WHERE id =:id");
                $sql->bindParam(':faillogin_count' ,$failed_count);
                $sql->bindParam(':id' ,$id);
                $result = $sql->execute(); 
                    }
                    else{
                          $failed_count = 5;
                         $sql = $dbMain->prepare("UPDATE Review_login_credentials SET faillogin_count =:faillogin_count WHERE id =:id");
                $sql->bindParam(':faillogin_count' ,$failed_count);
                $sql->bindParam(':id' ,$id);
                $result = $sql->execute();   
                        
                        
                    }
                    
                    
                    
                   
                }
                
                
                
                
                echo ($result == true ? "success" : "error");
            }
            
            
            else {
                die('error');
            }
        });

    }
    
        elseif($ajax_type == "appDeleteData"){
        DBQuery::execute(function()use($id){

            $dbMain  = DBConnection::getInstance()->getMain();
            is_numeric($id) ? null : die('error');

            $sql = $dbMain->prepare("DELETE FROM Review_login_credentials WHERE id=:id");
            $sql->bindParam(':id', $id);
            $result = $sql->execute();
            echo ($result == true ? "success" : "error");
        });
    
    } 
    
    elseif($ajax_type == "reviewcollectorDeleteData"){
        DBQuery::execute(function()use($customerID){

            $dbMain  = DBConnection::getInstance()->getMain();
            $dbObj   = DBConnection::getInstance()->getDomain();
            is_numeric($customerID) ? null : die('error');

            $sql = $dbObj->prepare("DELETE FROM ReviewCollector WHERE id=:customer_id");
            $sql->bindParam(':customer_id', $customerID);
            $result = $sql->execute();
            echo ($result == true ? "success" : "error");
        });
    
    }  elseif($ajax_type == "checkEmail"){
        DBQuery::execute(function()use($_POST){

            $dbMain  = DBConnection::getInstance()->getMain();
            $dbObj   = DBConnection::getInstance()->getDomain();
            $email   = $_POST['email'];

            $account_exists = db_getFromDB_pdo('account', 'username', $email);
            
            if ($account_exists->getNumber("id")){
                echo "true";
            } else {
                echo "false";
            }
        });
    
    }   elseif($ajax_type == "unsubscribe_listing"){

        require_once EDIRECTORY_ROOT.'/braintree/braintree-php/lib/Braintree.php';
        require_once EDIRECTORY_ROOT.'/braintree/_environment.php';
        
            $account    = sess_getAccountIdFromSession();
            $listing    = mysql_real_escape_string($_POST['listing']);
            
            if($listing > 0):

                $listingObj = new Listing($listing);
    
                    //Check if listing belongs to the user
                    if($listingObj->account_id != $account):

                        die("error");

                    endif;

                    //Check if subscription Id is present
                    if(!$listingObj->custom_text2):

                        die("error");

                    endif;

                    //Unsubscribe Listing
                    try {
                        $result = Braintree_Subscription::cancel($listingObj->custom_text2);    
                    } catch (Exception $e) {
                        die("error");
                    }
                    
        // $logs = serialize($result);

        if($result->success == true):

        ####################### Send Email #####################################
        $contact    = new Contact($account);
        $listing_id = $listingObj->id;
        $title      = $listingObj->title;
        $emailNotification_id = 48;
        $subscription_id = $listingObj->custom_text2;
        setting_get("sitemgr_email",$sitemgr_email);

        $emailNotificationObj = new EmailNotification($emailNotification_id);
        $email                = $contact->email;
        $subject              = $emailNotificationObj->subject;
        $body                 = $emailNotificationObj->body;
        $variables            = $emailNotificationObj->use_variables;
        $eachVariables        = explode(',', $variables);
        $detailLink           = LISTING_DEFAULT_URL."/".$friendly_url;

        if($contact){
            $body             = str_replace(trim($eachVariables[0]),ucfirst(htmlspecialchars($contact->first_name)), $body);
            $body             = str_replace(trim($eachVariables[1]),ucfirst(htmlspecialchars($contact->last_name)), $body);
        } else {
            $body             = str_replace(trim($eachVariables[0]),"", $body);
            $body             = str_replace(trim($eachVariables[1]),"Business Owner", $body);
        }
        $subject              = str_replace(trim($eachVariables[2]),$title, $subject);
        $body                 = str_replace(trim($eachVariables[2]),$title, $body);
        $body                 = str_replace(trim($eachVariables[3]),$detailLink, $body);

        $return  = system_mail($email, $subject, $body, EDIRECTORY_TITLE." <$sitemgr_email>","text/html", "", "", $error, "", "", "", $listing_id, $account, $emailNotification_id, $subscription_id, 'subscription_canceled_usr');
        ############################# Email Sent #####################################
                    
                        $listingObj->custom_text2 = "";
                        $listingObj->custom_text5 = "";
                        $listingObj->save();

                        die("success");
                    
                    else:

                        die("error");

                    endif;
    
            else:

                die("error");

            endif;     
    }

?>