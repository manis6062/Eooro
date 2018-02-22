<?

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
    # * FILE: /API/api3.php
    # ----------------------------------------------------------------------------------------------------

    # ----------------------------------------------------------------------------------------------------
    # LOAD CONFIG
    # ----------------------------------------------------------------------------------------------------
    include("../conf/loadconfig.inc.php");
      
    extract($_GET);
    
    # ----------------------------------------------------------------------------------------------------
    # GENERAL SETTINGS
    # ----------------------------------------------------------------------------------------------------
    setting_get("edirectory_api_enabled", $edirectory_api_enabled);
    setting_get("edirectory_api_key", $edirectory_api_key);
    setting_get("appbuilder_previewpassword", $previewpassword);
    $aux_results_per_page = 25;
    $paginationCategs = false;
    define("API_IN_USE", "api3");
    define("EDIR_APP_API_VERSION", "1.0");
    
    //Check if API is enabled
    if ($edirectory_api_enabled == "on" || DEMO_LIVE_MODE) {

        //Validate API key
        $validKey = true;
        if (!DEMO_DEV_MODE && !DEMO_LIVE_MODE) {
            if ($_POST["key"]) {
                $key = $_POST["key"];
            }

            if (($key != $edirectory_api_key && !is_numeric($key)) || ($previewpassword != $key && is_numeric($key))) {
                $validKey = false;
            }
        }

        // Validate parameters
        if (($resource || $_POST) && $validKey) {

            if ($_POST) {
                
                unset($aux_returnArray);
                $aux_returnArray["type"]            = $_POST["resource"];
                $aux_returnArray["total_results"]   = 1; 
                $aux_returnArray["total_pages"]     = 1; 
                $aux_returnArray["results_per_page"]= 1;  
                
                if ($_POST["resource"] == "forgot_password") {
                
                    include(INCLUDES_DIR."/code/forgot_password.php");
                    
                    if ($message_class == "errorMessage") {
                        $aux_returnArray["success"] = FALSE;
                        $aux_returnArray["message"] = str_replace("<br />", "\n", $message);
                    } else {
                        $aux_returnArray["success"] = TRUE;
                        $aux_returnArray["message"] = str_replace("<br />", "\n", $message);
                    }
                                       
                    api_formatReturn($aux_returnArray);
                    
                } elseif ($_POST["resource"] == "contact_mail") {
                
                    if ($_POST["id"] && $_POST["module"]) {
                        
                        $_POST["receiver"] = "owner";
                        extract($_POST);
                        $AppRequest = true;
                        if ($_POST["module"] == "listing") {
                            include(INCLUDES_DIR."/code/listing_emailform.php");      
                        } elseif ($_POST["module"] == "event") {
                            include(INCLUDES_DIR."/code/event_emailform.php");      
                        } elseif ($_POST["module"] == "classified") {
                            include(INCLUDES_DIR."/code/classified_emailform.php");      
                        }
                        
                        if (empty($error) && $return) {
                            $aux_returnArray["success"] = true;
                            $aux_returnArray["message"] = system_showText(LANG_CONTACTMSGSUCCESS);
                        } else {
                            $aux_returnArray["success"] = false;
                            $aux_returnArray["message"] = str_replace("<br />", "\n", system_showText(LANG_CONTACTMSGFAILED).($error ? '<br />'.$error : ''));
                        }

                    } else {
                        $aux_returnArray["success"] = FALSE;
                        $aux_returnArray["message"] = "Missing parameters module and/or id";
                    }
                                        
                    api_formatReturn($aux_returnArray);
                    
                } elseif ($_POST["resource"] == "add_checkin") {
                    
                    $aux_error = "";
                    if (!is_numeric($_POST["item_id"])) {
                        $aux_error = "Missing or invalid parameter item_id\n";
                    }
                    if ($_POST["item_type"] != "listing" && $_POST["item_type"] != "event") {
                        $aux_error .= "Missing or invalid parameter item_type\n";
                    }
                    if (!is_numeric($_POST["account_id"])) {
                        $aux_error .= "Missing or invalid parameter account_id\n";
                    }
                    if (!$_POST["quick_tip"]) {
                        $aux_error .= "Missing or invalid parameter quick_tip\n";
                    }
                    
                    if ($aux_error) {
                        $aux_returnArray["success"] = FALSE;
                        $aux_returnArray["message"] = $aux_error;
                    } else {
                    
                        unset($checkInObj);
                        $contactObj = new Contact($_POST["account_id"]);
                        $checkInObj = new CheckIn();

                        $checkInObj->setString("item_id", $_POST["item_id"]);
                        $checkInObj->setString("item_type", $_POST["item_type"]);
                        $checkInObj->setString("member_id", $_POST["account_id"]);
                        $checkInObj->setString("ip", $_SERVER["REMOTE_ADDR"]);
                        $checkInObj->setString("quick_tip", $_POST["quick_tip"]);
                        $checkInObj->setString("checkin_name", $contactObj->getString("first_name")." ".$contactObj->getString("last_name"));

                        $checkInObj->Save();
                        
                        $aux_returnArray["success"] = TRUE;
                    
                    }
                    
                    api_formatReturn($aux_returnArray);
                    
                } elseif ($_POST["resource"] == "deal_redeem") {
                    
                    $aux_error = "";
                    if (!$_POST["account_id"]) {
                        $aux_error = "Missing parameter account_id\n";
                    }
                    if (!is_numeric($_POST["promotion_id"])) {
                        $aux_error .= "Missing or invalid parameter promotion_id\n";
                    }
                    
                    if (!$aux_error) {
                        //Setting session
                        $accObj = db_getFromDB("account", "id", $_POST["account_id"]);
                        if (!$accObj->getNumber("id")) {
                            $aux_returnArray["success"] = FALSE;
                            $aux_returnArray["message"] = "User not found";
                        } else {
                            $fbAccount = false;
                            if (string_strpos($accObj->getString("username"), "facebook") !== false) {
                                $fbAccount = true;
                            }
                            sess_registerAccountInSession($accObj->getString(($fbAccount ? "facebook_username" : "username")));
                            $profileObj = new Profile($accObj->getNumber("id"));
                            $promotion = new Promotion((int)$_POST["promotion_id"]);
                            $redeem = $promotion->alreadyRedeemed((int)$_POST["promotion_id"]);

                            //0 => ok
                            //1 => already redeem
                            //2 => sold out
                            if ($redeem) {
                                $return["result"] = "redeem already done";
                                $return["redeem_code"] = $redeem;
                                $aux_returnArray["success"] = TRUE;
                            } elseif (!$promotion->amount) {
                                $return["result"] = "deal unavailable";
                                $aux_returnArray["success"] = FALSE;
                                $aux_returnArray["message"] = "deal unavailable";
                            } else {

                                $redeem_code = $profileObj->deal_done("profile", $_POST["promotion_id"], "profile by mobile");
                                $return["result"] = "redeem done";
                                $return["redeem_code"] = $redeem_code;
                                $aux_returnArray["success"] = TRUE;

                            }
                        }
                                            
                    } else {
                        $aux_returnArray["success"] = FALSE;
                        $aux_returnArray["message"] = $aux_error;
                    }
                    if ($return) {
                        $aux_returnArray["results"] = $return;
                    }
                    api_formatReturn($aux_returnArray);
                    
                } elseif ($_POST["resource"] == "add_review") {
                    
                    $AppRequest = true;
                    
                    $item_type = $_POST["item_type"];
                    $item_id = $_POST["item_id"];
                    
                    if ($item_type && $item_id) {
                        include(INCLUDES_DIR."/code/review.php");
                    } else {
                        $message_review = "Missing parameters item_type and/or item_id";
                        $success_review = false;
                    }
                    
                    $aux_returnArray["success"] = $success_review;
                    $aux_returnArray["message"] = $message_review;

                    api_formatReturn($aux_returnArray);
                    
                } elseif ($_POST["resource"] == "add_account") {
                    
                    $AppRequest = true;
                    $_POST["agree_tou"] = 1;
                    $_POST["publish_contact"] = "y";
                    include(INCLUDES_DIR."/code/add_account.php");
                    
                    if (!$validate_account || !$validate_contact) {
                        $retMessage = str_replace("<br />", "\n", $message_account.$message_contact);
                        $retMessage = str_replace("&#149;", "", $retMessage);
                        $retMessage = str_replace("&nbsp;", "", $retMessage);
                        $aux_returnArray["success"] = FALSE;
                        $aux_returnArray["message"] = $retMessage;
                    } else {
                        $aux_returnArray["success"] = TRUE;
                        $aux_returnArray["results"][] = $arrayAccount;
                    }
                    
                    api_formatReturn($aux_returnArray);
                    
                } elseif ($_POST["resource"] == "login") {
                    
                    if ($_POST["uid"]) {
                        
                        unset($user_details);
                        $user_details["uid"] = $_POST["uid"];
                        $user_details["first_name"] = $_POST["first_name"];
                        $user_details["last_name"] = $_POST["last_name"];
                        $user_details["email"] = $_POST["email"];
                        
                        if (system_registerForeignAccount($user_details, "facebook")) {
                            $acctObj = new Account(sess_getAccountIdFromSession());
                            $contactObj = new Contact($acctObj->getNumber("id"));
                            $aux_returnArray["success"] = TRUE;
                            $arrayAccount = array();
                            $arrayAccount["id"] = (int)$acctObj->getNumber("id");
                            $arrayAccount["first_name"] = $contactObj->getString("first_name");
                            $arrayAccount["last_name"] = $contactObj->getString("last_name");
                            $arrayAccount["email"] = $contactObj->getString("email");
                            $aux_returnArray["results"][] = $arrayAccount;
                        } else {
                            $aux_returnArray["success"] = FALSE;
                            $aux_returnArray["message"] = "Login failed";
                        }
                        
                    } elseif (sess_authenticateAccount($_POST["username"], $_POST["password"], $authmessage)) {
                        $aux_returnArray["success"] = TRUE;
                        $acctObj = db_getFromDB("account", "username", db_formatString($_POST["username"]));
                        $contactObj = new Contact($acctObj->getNumber("id"));
                        $arrayAccount = array();
                        $arrayAccount["id"] = (int)$acctObj->getNumber("id");
                        $arrayAccount["first_name"] = $contactObj->getString("first_name");
                        $arrayAccount["last_name"] = $contactObj->getString("last_name");
                        $arrayAccount["email"] = $contactObj->getString("email");
                        $aux_returnArray["results"][] = $arrayAccount;
                    } else {
                        $aux_returnArray["success"] = FALSE;
                        $aux_returnArray["message"] = $authmessage;
                    }
                    
                    api_formatReturn($aux_returnArray);
                    
                }
                
                
            } elseif ($_GET) {
                
                unset($aux_fields, $auxTable, $auxWhere, $aux_results, $aux_returnArray, $items);
                $_GET["module"]                 = $resource;
                $_GET["aux_results_per_page"] 	= $aux_results_per_page;

                $aux_returnArray = array();
                $aux_fields = array();
                $auxTable = "";
                $aux_Where = "";
                
                if ($orderby == "distance" && (!$myLat || !$myLong)) {
                    unset($orderby);
                }

                if ($resource == "listing") {

                    // Label = value (field on DB);
                    $aux_fields["id"]           = "id";
                    $aux_fields["title"]        = "title";
                    $aux_fields["level"]        = "level";
                    $aux_fields["title"]        = "title";
                    $aux_fields["deal_id"]      = "promotion_id";
                    $aux_fields["address"]      = "address";
                    $aux_fields["address2"]     = "address2";
                    $aux_fields["avg_review"]   = "avg_review";
                    $aux_fields["imageurl"]     = "image_id";
                    $aux_fields["phone"]        = "phone";
                    $aux_fields["latitude"]     = "latitude";
                    $aux_fields["longitude"]    = "longitude";
                    $aux_fields["description"]  = "description";
                    $aux_fields["location_4_title"]  = "location_4_title";
                    $aux_fields["location_3_title"]  = "location_3_title";
                    $aux_fields["location_1_title"]  = "location_1_title";
                    
                    $aux_fields["total_reviews"] = "(SELECT count(item_id) FROM Review WHERE item_type = 'listing' AND item_id = Listing_Summary.id AND approved = '1' AND status = 'A') AS total_reviews";

                    api_prepareDistance($myLat, $myLong, $aux_fields);

                    if ($orderby) {
                        api_prepareOrderBy($orderby, $resource, $aux_orderBy);
                    } else {
                        if ($featured) {
                            $aux_orderBy[] = "random_number";
                        } else {
                            $aux_orderBy[] = "level";
                            if (BACKLINK_FEATURE == "on") {
                                $aux_orderBy[] = "backlink DESC";
                            }
                            $aux_orderBy[] = "random_number DESC";
                            $aux_orderBy[] = "title"; 
                        }
                    }

                    Listing::GetInfoToApp($_GET, $aux_returnArray, $aux_fields, $items, $auxTable, $aux_Where);
                    
                } elseif ($resource == "listing_category") {

                    ListingCategory::GetInfoToApp($_GET, $aux_returnArray, $aux_fields, $items, $auxTable, $aux_Where);

                    if ($orderby) {
                        api_prepareOrderBy($orderby, $resource, $aux_orderBy);
                    } else {
                        $aux_orderBy[] = "title";
                    }

                } elseif ($resource == "review") {

                    //Listing/Article detail - list reviews
                    if ($type && $id) {
                        unset($reviewObj);
                        $reviewObj = new Review();

                        $reviewObj->item_id     = $id;
                        $reviewObj->item_type   = $type;

                        $reviewObj->GetInfoToApp($_GET, $aux_returnArray, $items);
                        
                    //Recent reviews
                    } else {
                        
                        $aux_fields["added"] = "added";
                        $aux_fields["reviewer_name"] = "reviewer_name";
                        $aux_fields["reviewer_email"] = "reviewer_email";
                        $aux_fields["reviewer_location"] = "reviewer_location";
                        $aux_fields["review_title"] = "review_title";
                        $aux_fields["review"] = "review";
                        $aux_fields["rating"] = "rating";
                        $aux_fields["member_img"] = "Account.image_id";
                        $aux_fields["facebook_img"] = "Account.facebook_image";
                        $aux_fields["listing_id"] = "Listing_Summary.id";
                        $aux_fields["listing_title"] = "Listing_Summary.title";
                        $aux_fields["listing_latitude"] = "Listing_Summary.latitude";
                        $aux_fields["listing_longitude"] = "Listing_Summary.longitude";
                        api_prepareDistance($myLat, $myLong, $aux_fields);
                        
                        if ($orderby) {
                            api_prepareOrderBy($orderby, $resource, $aux_orderBy);
                        } else {
                            $aux_orderBy[] = "added DESC";
                        }
                        
                        Review::GetReviewsToApp($_GET, $aux_returnArray, $aux_fields, $items, $auxTable, $aux_Where);
                        
                    }

                } elseif ($resource == "checkin" && $id) {

                    unset($checkInObj);
                    $checkInObj = new CheckIn();

                    $checkInObj->item_id     = $id;
                    $checkInObj->item_type   = $module ? $module : "listing";

                    $checkInObj->GetInfoToApp($_GET, $aux_returnArray, $items);

                } elseif ($resource == "event") {

                    $aux_fields["id"]               = "id";
                    $aux_fields["title"]            = "title";
                    $aux_fields["level"]            = "level";
                    $aux_fields["location_name"]    = "location";
                    $aux_fields["location_1"]       = "location_1";
                    $aux_fields["location_3"]       = "location_3";
                    $aux_fields["location_4"]       = "location_4";
                    $aux_fields["address"]          = "address";
                    $aux_fields["phone"]            = "phone";
                    $aux_fields["latitude"]         = "latitude";
                    $aux_fields["longitude"]        = "longitude";
                    $aux_fields["start_date"]       = "start_date";
                    $aux_fields["end_date"]         = "end_date";
                    $aux_fields["start_time"]       = "start_time";
                    $aux_fields["end_time"]         = "end_time";
                    $aux_fields["has_start_time"]   = "has_start_time";
                    $aux_fields["has_end_time"]     = "has_end_time";
                    $aux_fields["recurring"]        = "recurring";
                    $aux_fields["until_date"]       = "until_date";
                    $aux_fields["repeat_event"]     = "repeat_event";
                    $aux_fields[($searchBy == "calendarList" ? "image_id" : "imageurl" )]     = "image_id";

                    api_prepareDistance($myLat, $myLong, $aux_fields);
                    
                    if ($orderby) {
                        api_prepareOrderBy($orderby, $resource, $aux_orderBy);
                    } else {
                        if ($featured) {
                            $aux_orderBy[] = "random_number";
                        } else {
                            $aux_orderBy[] = "level";
                            $aux_orderBy[] = "random_number DESC";
                            $aux_orderBy[] = "end_date";
                            $aux_orderBy[] = "until_date";
                            $aux_orderBy[] = "title";
                        }
                    }

                    if ($searchBy == "calendar") {
                        $arrayCalendar = Event::EventsDay($year, $month);
                    } else {
                        Event::GetInfoToApp($_GET, $aux_returnArray, $aux_fields, $items, $auxTable, $aux_Where);
                    }

                } elseif ($resource == "event_category") {

                    EventCategory::GetInfoToApp($_GET, $aux_returnArray, $aux_fields, $items, $auxTable, $aux_Where);

                    if ($orderby) {
                        api_prepareOrderBy($orderby, $resource, $aux_orderBy);
                    } else {
                        $aux_orderBy[] = "title";
                    }

                } elseif ($resource == "classified") {

                    $aux_fields["id"]           = "id";
                    $aux_fields["title"]        = "title";
                    $aux_fields["level"]        = "level";
                    $aux_fields["address"]      = "address";
                    $aux_fields["address2"]     = "address2";
                    $aux_fields["location_1"]   = "location_1";
                    $aux_fields["location_3"]   = "location_3";
                    $aux_fields["location_4"]   = "location_4";
                    $aux_fields["imageurl"]     = "image_id";
                    $aux_fields["phone"]        = "phone";
                    $aux_fields["latitude"]     = "latitude";
                    $aux_fields["longitude"]    = "longitude";
                    $aux_fields["price"]        = "classified_price";

                    api_prepareDistance($myLat, $myLong, $aux_fields);

                    if ($orderby) {
                        api_prepareOrderBy($orderby, $resource, $aux_orderBy);
                    } else {
                        if ($featured) {
                            $aux_orderBy[] = "random_number";
                        } else {
                            $aux_orderBy[] = "level";
                            $aux_orderBy[] = "random_number DESC";
                            $aux_orderBy[] = "title";
                        }
                    }

                    Classified::GetInfoToApp($_GET, $aux_returnArray, $aux_fields, $items, $auxTable, $aux_Where);

                } elseif ($resource == "classified_category") {

                    ClassifiedCategory::GetInfoToApp($_GET, $aux_returnArray, $aux_fields, $items, $auxTable, $aux_Where);

                    if ($orderby) {
                        api_prepareOrderBy($orderby, $resource, $aux_orderBy);
                    } else {
                        $aux_orderBy[] = "title";
                    }

                } elseif ($resource == "article") {

                    $aux_fields["id"]               = "id";
                    $aux_fields["title"]            = "title";
                    $aux_fields["author"]           = "author";
                    $aux_fields["imageurl"]         = "image_id";
                    $aux_fields["publication_date"] = "publication_date";
                    $aux_fields["avg_review"]       = "avg_review";

                    if ($orderby) {
                        api_prepareOrderBy($orderby, $resource, $aux_orderBy);
                    } else {
                    
                        if ($featured) {
                            $aux_orderBy[] = "random_number";
                        } else {
                            $aux_orderBy[] = "level";
                            $aux_orderBy[] = "publication_date DESC";
                            $aux_orderBy[] = "random_number DESC";
                            $aux_orderBy[] = "updated DESC";
                            $aux_orderBy[] = "entered DESC";
                            $aux_orderBy[] = "title";
                        }
                    
                    }

                    Article::GetInfoToApp($_GET, $aux_returnArray, $aux_fields, $items, $auxTable, $aux_Where);

                } elseif ($resource == "article_category") {

                    ArticleCategory::GetInfoToApp($_GET, $aux_returnArray, $aux_fields, $items, $auxTable, $aux_Where);

                    if ($orderby) {
                        api_prepareOrderBy($orderby, $resource, $aux_orderBy);
                    } else {
                        $aux_orderBy[] = "title";
                    }

                } elseif ($resource == "deal") {

                    $aux_fields["id"]                   = "id";
                    $aux_fields["title"]                = "name";
                    $aux_fields["imageurl"]             = "image_id";
                    $aux_fields["listing_latitude"]     = "listing_latitude";
                    $aux_fields["listing_longitude"]    = "listing_longitude";
                    $aux_fields["listing_id"]           = "listing_id";
                    $aux_fields["avg_review"]           = "avg_review";
                    $aux_fields["realvalue"]            = "realvalue";
                    $aux_fields["dealvalue"]            = "dealvalue";
                    $aux_fields["remaining"]            = "amount";
                    $aux_fields["conditions"]           = "conditions";
                    $aux_fields["listing_title"]        = "(SELECT title FROM Listing_Summary WHERE Listing_Summary.id = listing_id)".(($searchBy && $searchBy != "map") ? " AS listing_title" : "");
                    $aux_fields["total_reviews"]        = "(SELECT count(item_id) FROM Review WHERE item_type = 'promotion' AND item_id = Promotion.id AND approved = '1' AND status = 'A')  AS total_reviews";

                    api_prepareDistance($myLat, $myLong, $aux_fields, true);

                    if ($orderby) {
                        api_prepareOrderBy($orderby, $resource, $aux_orderBy);
                    } else {
                        if ($featured) {
                            $aux_orderBy[] = "random_number";
                        } else {
                            $aux_orderBy[] = "end_date";
                            $aux_orderBy[] = "random_number DESC";
                            $aux_orderBy[] = "name";
                        }
                    }

                    Promotion::GetInfoToApp($_GET, $aux_returnArray, $aux_fields, $items, $auxTable, $aux_Where);

                } elseif ($resource == "deal_category") {

                    ListingCategory::GetInfoToApp($_GET, $aux_returnArray, $aux_fields, $items, $auxTable, $aux_Where);

                    $aux_orderBy[] = "title";

                } elseif ($resource == "get_conf") {

                    setting_social_network_constants();

                    $dbDomain = db_getDBObject();
                    $sql = "SELECT * FROM Setting_Payment WHERE name LIKE 'CURRENCY_SYMBOL'";
                    $result = $dbDomain->query($sql);
                    if (mysql_num_rows($result)) {
                        $row = mysql_fetch_assoc($result);
                        $items["0"]["currency"] = $row["value"];
                    } else {
                        $items["0"]["currency"] = false;
                    }
                    $items[0]["distance_label"] = ZIPCODE_UNIT;
                    $items[0]["format_date"] = DEFAULT_DATE_FORMAT;
                    $items[0]["social_network_settings"] = unserialize(SETTING_SOCIAL_NETWORK_INFORMATION);

                    //General settings
                    setting_get("commenting_edir", $commenting_edir);
                    setting_get("review_approve", $review_approve);
                    setting_get("review_article_enabled", $review_article_enabled);
                    setting_get("review_listing_enabled", $review_listing_enabled);
                    setting_get("review_promotion_enabled", $review_promotion_enabled);
                    setting_get("review_manditory", $review_manditory);

                    $items[0]["edir_reviews"] = $commenting_edir;
                    $items[0]["review_approve"] = ($review_approve ? $review_approve : "off");
                    $items[0]["review_article_enabled"] = $review_article_enabled;
                    $items[0]["review_listing_enabled"] = $review_listing_enabled;
                    $items[0]["review_promotion_enabled"] = $review_promotion_enabled;
                    $items[0]["review_manditory"] = $review_manditory;
                    $items[0]["app_api_version"] = EDIR_APP_API_VERSION;
                    
                    /**
                     * Getting price information
                     */
                    $array_price_information = array();
                    
                    setting_get("listing_price_symbol", $array_price_information["listing_price_symbol"]);
                    
                    for ($i = 1; $i <= LISTING_PRICE_LEVELS; $i++) {
                        setting_get("listing_price_{$i}_from", $array_price_information["listing_price_{$i}_from"]);
                        setting_get("listing_price_{$i}_to", $array_price_information["listing_price_{$i}_to"]);
                        $array_price_information["listing_price_formatted_{$i}"] = $array_price_information["listing_price_symbol"].system_showListingPrice($i);
                    }
                    $items[0]["listing_price_info"] = $array_price_information;
                    
                    /*
                     * Tab bar configuration
                     */
                    $navbarObj = new Navigation();
                    $navbarObj->getNavbar($arrayOptions, "tabbar", true);
                    if (!$arrayOptions) {
                        $navbarObj->ResetNavbar("tabbar", true);
                        $navbarObj->getNavbar($arrayOptions, "tabbar");
                    }
                    $items[0]["tabbar"] = $arrayOptions;
                    
                    /*
                     * Color scheme option
                     */
                    setting_get("appbuilder_colorscheme", $appbuilder_colorscheme);
                    if (!$appbuilder_colorscheme) {
                        $colors[] = "059e9a";
                        $colors[] = "f1812d";
                    } else {
                        $colors = explode("-", $appbuilder_colorscheme);
                    }
                    $items[0]["colors"] = $colors;
                    
                    /*
                     * About page information
                     */
                    setting_get("appbuilder_about_email", $email);
                    setting_get("appbuilder_about_phone", $phone);
                    setting_get("appbuilder_about_website", $website);
                    setting_get("appbuilder_about_text", $aboutText);
                    setting_get("appbuilder_logo_id", $appbuilder_logo_id);
                    setting_get("appbuilder_logo_extension", $appbuilder_logo_extension);
                    setting_get("appbuilder_splash_id", $appbuilder_splash_id);
                    setting_get("appbuilder_splash_extension", $appbuilder_splash_extension);
                    
                    $about["about_text"] = ($aboutText ? $aboutText : NULL);
                    $about["about_email"] = $email;
                    $about["about_phone"] = $phone;
                    $about["about_website"] = $website;
                    $about["about_image"] = (file_exists(EDIRECTORY_ROOT."/".IMAGE_APPBUILDER_PATH."/appbuilder_logo_{$appbuilder_logo_id}.{$appbuilder_logo_extension}") ? DEFAULT_URL.IMAGE_APPBUILDER_PATH."/appbuilder_logo_{$appbuilder_logo_id}.{$appbuilder_logo_extension}" : NULL);
                    $items[0]["about"] = $about;
                    
                    $items[0]["splash_image"] = (file_exists(EDIRECTORY_ROOT."/".IMAGE_APPBUILDER_PATH."/appbuilder_splash_{$appbuilder_splash_id}.{$appbuilder_splash_extension}") ? DEFAULT_URL.IMAGE_APPBUILDER_PATH."/appbuilder_splash_{$appbuilder_splash_id}.{$appbuilder_splash_extension}" : NULL);
                    
                    $aux_returnArray["type"]            = $resource;
                    $aux_returnArray["total_results"]   = count($items);
                    $aux_returnArray["total_pages"]     = count($items);
                    $aux_returnArray["results_per_page"]= count($items);
                    $aux_returnArray["success"]         = true;

                } elseif ($resource == "modules_conf") {

                    $arrayModules = array();
                    $arrayModules[] = "listing";
                    $arrayModules[] = "event";
                    $arrayModules[] = "classified";
                    $arrayModules[] = "article";

                    $i = 0;
                    foreach ($arrayModules as $module) {
                        $levelStr = ucfirst($module)."Level";
                        $levelObj = new $levelStr();
                        $levels = $levelObj->getValues();
                        foreach ($levels as $level) {
                            $items[$i][$module][$level]["detail"] = $levelObj->getDetail($level);
                            $items[$i][$module][$level]["images"] = (int)$levelObj->getImages($level);

                            if ($module == "listing") {
                                $items[$i][$module][$level]["backlink"] = $levelObj->getBacklink($level);
                                $items[$i][$module][$level]["deal"] = $levelObj->getHasPromotion($level);
                                $items[$i][$module][$level]["sms"] = $levelObj->getHasSms($level);
                                $items[$i][$module][$level]["call"] = $levelObj->getHasCall($level);
                                $items[$i][$module][$level]["review"] = $levelObj->getHasReview($level);
                            }

                            if ($module != "article") {
                                $items[$i][$module][$level]["general"] = system_getFormFields($module, $level);
                            }

                        }
                        $i++;
                    }

                    $aux_returnArray["type"]            = $resource;
                    $aux_returnArray["total_results"]   = count($items); 
                    $aux_returnArray["total_pages"]     = count($items); 
                    $aux_returnArray["results_per_page"]= count($items); 
                    $aux_returnArray["success"]         = true;

                } elseif ($resource == "notification") {
                    
                    $appNotif = new AppNotification();
                    $notification = $appNotif->getCurrent();
                    
                    if ($notification) {
                        $totalNotif = 1;
                        $items[0]["description"]        = $notification["description"];
                        $items[0]["id"]                 = $notification["id"];
                        $items[0]["title"]              = $notification["title"];                       
                    } else {
                        $totalNotif = 0;
                    }
                    
                    $aux_returnArray["type"]            = $resource;
                    $aux_returnArray["total_results"]   = $totalNotif;
                    $aux_returnArray["total_pages"]     = $totalNotif;
                    $aux_returnArray["results_per_page"]= $aux_results_per_page; 
                    $aux_returnArray["success"]         = true;
                    
                } elseif ($resource == "advert") {
                    
                    if (!$qtd || !$device) {
                        
                        $msgError = "Missing parameters: <br />";
                        if (!$qtd)  $msgError .= "\"qtd\" <br />";
                        if (!$device) $msgError .= "\"device\" <br />";
                        
                        $return["type"]             = $resource;
                        $return["total_results"]    = 0;
                        $return["total_pages"]      = 0;
                        $return["results_per_page"] = 0;
                        $return["success"]          = FALSE;
                        $return["message"]          = $msgError;

                        api_formatReturn($return);
                        
                    } else {
                        
                        $appAdvert = new AppAdvert();
                        $adverts = $appAdvert->getAdverts($device, $qtd);
                        
                        if ($adverts) {
                            
                            $totalAdvert = count($adverts);
                            $pos = 0;
                            
                            foreach ($adverts as $advert) {
                                                                
                                $items[$pos]["id"]      = $advert["id"];
                                $items[$pos]["title"]   = $advert["title"];
                                $items[$pos]["url"]     = $advert["url"];
                                
                                $imgObj = new Image($advert["image_id"]);
                                if ($imgObj->imageExists()) {
                                    $items[$pos]["image"] = $imgObj->getPath();
                                } else {
                                    $items[$pos]["image"] = NULL;
                                }
                                
                                $pos++;
                                
                            }
                            
                        } else {
                            $totalAdvert = 0;
                        }
                        
                        $aux_returnArray["type"]                = $resource;
                        $aux_returnArray["total_results"]       = $totalAdvert;
                        $aux_returnArray["total_pages"]         = ceil($totalAdvert / $aux_results_per_page); 
                        $aux_returnArray["results_per_page"]    = $aux_results_per_page; 
                        $aux_returnArray["success"]             = TRUE;
                        
                    }
                    
                } else {
                    $return["type"]             = $resource;
                    $return["total_results"]    = 0;
                    $return["total_pages"]      = 0;
                    $return["results_per_page"] = 0;
                    $return["success"]          = FALSE;
                    $return["message"] = "Invalid Resource";
                    $return["success"] = FALSE;
                    api_formatReturn($return);
                }

                /*
                 * Number fields
                 */
                unset($number_fields);
                $number_fields[] = "latitude";
                $number_fields[] = "longitude";
                $number_fields[] = "level";
                $number_fields[] = "id";
                $number_fields[] = "promotion_id";
                $number_fields[] = "category_id";
                $number_fields[] = "count_sub";
                $number_fields[] = "total_reviews";
                $number_fields[] = "deal_id";
                $number_fields[] = "rate";
                $number_fields[] = "image_id";
                $number_fields[] = "total_amount";
                $number_fields[] = "remaining";
                $number_fields[] = "realvalue";
                $number_fields[] = "dealvalue";
                $number_fields[] = "father_id";
                $number_fields[] = "total_sub";
                $number_fields[] = "active_items";
                $number_fields[] = "member_id";
                $number_fields[] = "listing_id";
                $number_fields[] = "rating";
                
                if ($resource != "deal") {
                    $number_fields[] = "avg_review";
                }

                if (is_array($aux_fields) || $items || is_array($arrayCalendar)) {

                    if (!$items && (string_strpos($aux_returnArray["message"], "No results found") === false) && (!$arrayCalendar && $searchBy != "calendar")) {

                        /*
                        * Preparing SQL
                        */
                        $db = db_getDBObject();

                        if ($auxTable && $aux_Where) {

                            /**
                            * Counting results
                            */
                            $sql_count = "SELECT 0 FROM ".$auxTable." WHERE ".implode(" AND ", $aux_Where);
                            $aux_total_results = $db->query($sql_count);

                            if (mysql_num_rows($aux_total_results)) {

                                $aux_returnArray["type"]                = $resource;
                                $aux_returnArray["total_results"]       = mysql_num_rows($aux_total_results);
                                $aux_returnArray["total_pages"]         = ceil(mysql_num_rows($aux_total_results) / ($limit && is_numeric($limit) ? $limit : $aux_results_per_page));
                                $aux_returnArray["results_per_page"]    = (int)($limit && is_numeric($limit) ? $limit : $aux_results_per_page);
                                $aux_returnArray["success"]             = true;
                                
                                if ($limit && is_numeric($limit)) {
                                    $sqlLimit = " LIMIT $limit";
                                } elseif (strpos($auxTable, "Category") !== false && !$paginationCategs) {
                                    $sqlLimit = "";
                                    $aux_returnArray["total_pages"] = 1;
                                    $aux_returnArray["results_per_page"] = $aux_returnArray["total_results"];
                                } else {
                                    $sqlLimit = " LIMIT ".($page ? (($page-1) * $aux_results_per_page)."," : "").$aux_results_per_page;
                                }
                                
                                /**
                                 * Preparing alias to SQL
                                 */
                                unset($sql_alias);
                                foreach ($aux_fields as $key => $value) {
                                    if ((strpos($value, " AS ") !== false) || $value == "image_id" || $value == "promotion_id" || $key == "category_id" ) {
                                        $sql_alias .= $value;
                                    } else {
                                        $sql_alias .= $value . " AS ".$key;
                                    }
                                    $sql_alias .= ",";
                                }
                                if (substr($sql_alias, -1) == ",") {
                                    $sql_alias = substr($sql_alias, 0, strlen($sql_alias)-1);
                                }
                                
                                $sql = "SELECT ".($sql_alias ? $sql_alias : implode(",", $aux_fields))." FROM ".$auxTable." WHERE ".implode(" AND ", $aux_Where)." ".(is_array($aux_orderBy) ? " ORDER BY ".implode(", ", $aux_orderBy) : "" ).$sqlLimit;
                                $aux_results = $db->query($sql);

                                if (mysql_num_rows($aux_results) > 0) {

                                    $i = 0;

                                    if ((strpos($auxTable, "Category") !== false) && $father_id) {

                                        $sqlAux = "SELECT ".implode(",", $aux_fields)." FROM ".$auxTable." WHERE id = $father_id";
                                        $resultAux = $db->query($sqlAux);
                                        $rowAux = mysql_fetch_assoc($resultAux);

                                        foreach($rowAux as $DB_field => $value) {
                                            if ($DB_field == "title") {
                                                $value = "View All";
                                            } elseif ($DB_field == "count_sub") {
                                                $value = 0;
                                            }
                                            $array_results[array_search($DB_field, $aux_fields)] = ((is_numeric($value) && in_array($DB_field, $number_fields))? (float)$value : $value);
                                        }
                                        $aux_returnArray["results"][$i] = $array_results;
                                        $i++;
                                    }

                                    while ($aux_row = mysql_fetch_assoc($aux_results)) {

                                        unset($array_results);
                                        foreach($aux_row as $DB_field => $value) {
                                            $skipNode = false;
                                            if ($DB_field == "image_id") {
                                                unset($imageObj);
                                                $imageObj = new Image($value);
                                                if ($imageObj->imageExists()) {
                                                    $value = $imageObj->getPath();
                                                } else {
                                                    $firstGalImage = system_getImageFromGallery($resource, $aux_row["id"]);
                                                    if ($firstGalImage) {
                                                        $value = $firstGalImage;
                                                    } else {
                                                        $value = NULL;
                                                    }
                                                }
                                            } elseif ($DB_field == "member_img") {
                                                unset($imageObj);
                                                $imageObj = new Image($value, true);
                                                if ($imageObj->imageExists()) {
                                                    $value = $imageObj->getPath();
                                                } else {
                                                    if ($aux_row["facebook_img"]) {
                                                        $value = $aux_row["facebook_img"];
                                                    } else {
                                                        $value = THEMEFILE_URL."/".EDIR_THEME."/schemes/".EDIR_SCHEME."/images/iconography/icon-user-thumb.gif";
                                                    }
                                                }
                                            } elseif ($DB_field == "promotion_id") {
                                                unset($promotionObj);
                                                $promotionObj = new Promotion($value);
                                                if ((!validate_date_deal($promotionObj->getDate("start_date"), $promotionObj->getDate("end_date"))) || (!validate_period_deal($promotionObj->getNumber("visibility_start"),$promotionObj->getNumber("visibility_end")))){
                                                    $value = 0;
                                                } else {
                                                    $array_results["deal_id"] = (float)$value;
                                                }
                                            } elseif ($DB_field == "recurring") {
                                                $eventObj = new Event($aux_row["id"]);
                                                if ($eventObj->getNumber("id")) {
                                                    $array_results["recurring_string"] = $eventObj->getDateStringRecurring();
                                                }
                                            } elseif (($DB_field == "end_date" || $DB_field == "until_date") && $value == "0000-00-00") {
                                                $value = NULL;
                                            } elseif (($DB_field == "start_time") && $value == "00:00:00") {
                                                if ($aux_row["has_start_time"] == "n") {
                                                    $value = NULL;
                                                }
                                            } elseif (($DB_field == "end_time") && $value == "00:00:00") {
                                                if ($aux_row["has_end_time"] == "n") {
                                                    $value = NULL;
                                                }
                                            } elseif (($DB_field == "address" || $DB_field == "location_1" || $DB_field == "location_3" || $DB_field == "location_4" || $DB_field == "address2" || $DB_field == "location_4_title" || $DB_field == "location_3_title" || $DB_field == "location_1_title") && !$array_results["location_information"]) {
                                                unset($auxArrayLocInfo);
                                                $auxArrayLocInfo = array();
                                                trim($aux_row["address"]) ? $auxArrayLocInfo[] = trim($aux_row["address"]) : "";
                                                trim($aux_row["address2"]) ? $auxArrayLocInfo[] = trim($aux_row["address2"]) : "";
                                                if ($aux_row["location_4"]) { 
                                                    $loc4Obj = new Location4($aux_row["location_4"]);
                                                    $auxArrayLocInfo[] = $loc4Obj->getString("name");
                                                }
                                                if ($aux_row["location_3"]) {
                                                    $loc3Obj = new Location3($aux_row["location_3"]);
                                                    $auxArrayLocInfo[] = $loc3Obj->getString("name");
                                                }
                                                if ($aux_row["location_1"]) {
                                                    $loc1Obj = new Location1($aux_row["location_1"]);
                                                    $auxArrayLocInfo[] = $loc1Obj->getString("name");
                                                }
                                                trim($aux_row["location_4_title"]) ? $auxArrayLocInfo[] = trim($aux_row["location_4_title"]) : "";
                                                trim($aux_row["location_3_title"]) ? $auxArrayLocInfo[] = trim($aux_row["location_3_title"]) : "";
                                                trim($aux_row["location_1_title"]) ? $auxArrayLocInfo[] = trim($aux_row["location_1_title"]) : "";
                                                if (count($auxArrayLocInfo) > 0) {
                                                    $array_results["location_information"] = implode(", ", $auxArrayLocInfo);
                                                    unset($array_results["location_4"], $array_results["location_3"], $array_results["location_1"], $array_results["address"], $array_results["address2"], $array_results["location_4_title"], $array_results["location_3_title"], $array_results["location_1_title"]);
                                                }
                                            } elseif (($resource == "deal" || $resource == "review") && ($DB_field == "listing_latitude" || $DB_field == "listing_longitude" || $DB_field == "listing_id" || $DB_field == "listing_title")) {
                                                $skipNode = true;
                                                if (!$array_results["listing"]) {
                                                    $auxInfoListing = array();
                                                    $auxInfoListing["id"] = (int)$aux_row["listing_id"];
                                                    $auxInfoListing["title"] = $aux_row["listing_title"];
                                                    $auxInfoListing["latitude"] = (float)$aux_row["listing_latitude"];
                                                    $auxInfoListing["longitude"] = (float)$aux_row["listing_longitude"];
                                                    $array_results["listing"] = $auxInfoListing;
                                                    unset($array_results["listing_id"], $array_results["listing_title"], $array_results["listing_longitude"], $array_results["listing_latitude"]);
                                                }
                                            } elseif ($resource == "deal" && $DB_field == "realvalue") {
                                                if ($aux_row["realvalue"] > 0) {
                                                    $aux_percentage = round(100-(($aux_row["dealvalue"]*100)/$aux_row["realvalue"]));
                                                } else {
                                                    $aux_percentage = 0;
                                                }
                                                $array_results["deal_discount"] = $aux_percentage."%";
                                            }

                                            if (!$skipNode && $DB_field != "has_start_time" && $DB_field != "has_end_time" && $DB_field != "location_1" && $DB_field != "location_3" && $DB_field != "location_4" && $DB_field != "address" && $DB_field != "address2" && $DB_field != "location_4_title" && $DB_field != "location_3_title" && $DB_field != "location_1_title" && $DB_field != "facebook_img") {
                                                $array_results[(array_search($DB_field, $aux_fields) ? array_search($DB_field, $aux_fields) : $DB_field)] = ((is_numeric($value) && in_array($DB_field, $number_fields)) ? (float)$value : $value);
                                            }

                                        }

                                        $aux_returnArray["results"][$i] = $array_results;
                                        $i++;

                                    }

                                    /**
                                    * Prepare to send fields to order
                                    */
                                    unset($stringFieldsToOrder);
                                    foreach ($aux_fields as $key => $value) {
                                        if ($key != "address" && $key != "address2" && $key != "location_4_title" && $key != "location_3_title" && $key != "location_1_title") {
                                            $stringFieldsToOrder[] = $key;
                                        }
                                    }
                                    $aux_returnArray["fieldsToOrder"] = implode(",",$stringFieldsToOrder); 

                                } else {
                                    $aux_returnArray["type"]               = $resource;
                                    $aux_returnArray["total_results"]      = 0;
                                    $aux_returnArray["total_pages"]        = 0;
                                    $aux_returnArray["results_per_page"]   = $aux_results_per_page;
                                    $aux_returnArray["success"]            = true;
                                    $aux_returnArray["message"]            = "No results found.";
                                }

                            } else {

                                $aux_returnArray["type"]               = $resource;
                                $aux_returnArray["total_results"]      = 0;
                                $aux_returnArray["total_pages"]        = 0;
                                $aux_returnArray["results_per_page"]   = $aux_results_per_page;
                                $aux_returnArray["success"]            = true;
                                $aux_returnArray["message"]            = "No results found.";

                            }
                        }

                    } else {

                        if (is_array($items)) {

                            unset($aux_items);
                            for ($i = 0; $i < count($items); $i++) {     

                                $aux_array_items = $items[$i];

                                foreach ($aux_array_items as $aux_key => $aux_value) {
                                    if ($aux_key == "image_id" || ($aux_key == "imageurl" && is_numeric($aux_value))) {
                                        unset($imageObj);
                                        $imageObj = new Image($aux_value);
                                        if ($imageObj->imageExists()) {
                                            $img_url = $imageObj->getPath();
                                        } else {
                                            $firstGalImage = system_getImageFromGallery($resource, ($aux_array_items[$resource."_ID"] ? $aux_array_items[$resource."_ID"] : $aux_array_items["id"]));
                                            if ($firstGalImage) {
                                                $img_url = $firstGalImage;
                                            } else {
                                                $img_url = NULL;
                                            }
                                        }
                                        if ($id) {
                                            $items[$i]["imageurl"] = $img_url;
                                        } else {
                                            $aux_items[$i]["imageurl"] = $img_url;
                                        }

                                    } elseif ($aux_key == "distance_score") {
                                        if ($id) {
                                            $items[$i]["distance_score"] = round($aux_value, 2)." ".ZIPCODE_UNIT;
                                        } else {
                                            $aux_items[$i]["distance_score"] = round($aux_value, 2)." ".ZIPCODE_UNIT;
                                        }
                                    } elseif ($aux_key == "end_date" || $aux_key == "until_date") {

                                        if ($aux_value == "0000-00-00") {
                                            $aux_value = NULL;
                                        }
                                        
                                        if ($id) {
                                            $items[$i][$aux_key] = $aux_value;
                                        } else {
                                            $aux_items[$i][$aux_key] = $aux_value;
                                        }
                                        
                                    } elseif ($aux_key == "start_time") {

                                        if ($aux_value == "00:00:00" && $aux_array_items["has_start_time"] == "n") {
                                            $aux_value = NULL;
                                        }
                                        
                                        if ($id) {
                                            $items[$i][$aux_key] = $aux_value;
                                        } else {
                                            $aux_items[$i][$aux_key] = $aux_value;
                                        }
                                        
                                    } elseif ($aux_key == "end_time") {

                                        if ($aux_value == "00:00:00" && $aux_array_items["has_end_time"] == "n") {
                                            $aux_value = NULL;
                                        }
                                        
                                        if ($id) {
                                            $items[$i][$aux_key] = $aux_value;
                                        } else {
                                            $aux_items[$i][$aux_key] = $aux_value;
                                        }
                                        
                                    } elseif ($resource == "deal" && ($aux_key == "listing_latitude" || $aux_key == "listing_longitude" || $aux_key == "listing_id" || $aux_key == "listing_title")) {
                                        
                                        $auxInfoListing = array();
                                        $auxInfoListing["id"] = (int)$aux_array_items["listing_id"];
                                        $auxInfoListing["title"] = $aux_array_items["listing_title"];
                                        $auxInfoListing["latitude"] = $aux_array_items["listing_latitude"];
                                        $auxInfoListing["longitude"] = $aux_array_items["listing_longitude"];
                                        
                                        if ($id && !$items[$i]["listing"]) {
                                            $items[$i]["listing"] = $auxInfoListing;
                                        } elseif (!$aux_items[$i]["listing"]) {
                                            $aux_items[$i]["listing"] = $auxInfoListing;
                                        }

                                    } elseif ($aux_key == "address" || $aux_key == "location_1" || $aux_key == "location_3" || $aux_key == "location_4" || $aux_key == "address2" || $aux_key == "location_4_title" || $aux_key == "location_3_title" || $aux_key == "location_1_title") {
                                        
                                        unset($auxArrayLocInfo);
                                        $auxArrayLocInfo = array();
                                        $auxInfoLocation = "";
                                        trim($aux_array_items["address"]) ? $auxArrayLocInfo[] = trim($aux_array_items["address"]) : "";
                                        trim($aux_array_items["address2"]) ? $auxArrayLocInfo[] = trim($aux_array_items["address2"]) : "";
                                        if ($aux_array_items["location_4"]) {
                                            $loc4Obj = new Location4($aux_array_items["location_4"]);
                                            $auxArrayLocInfo[] = $loc4Obj->getString("name");
                                        }
                                        if ($aux_array_items["location_3"]) {
                                            $loc3Obj = new Location3($aux_array_items["location_3"]);
                                            $auxArrayLocInfo[] = $loc3Obj->getString("name");
                                        }
                                        if ($aux_array_items["location_1"]) {
                                            $loc1Obj = new Location1($aux_array_items["location_1"]);
                                            $auxArrayLocInfo[] = $loc1Obj->getString("name");
                                        }
                                        trim($aux_array_items["location_4_title"]) ? $auxArrayLocInfo[] = trim($aux_array_items["location_4_title"]) : "";
                                        trim($aux_array_items["location_3_title"]) ? $auxArrayLocInfo[] = trim($aux_array_items["location_3_title"]) : "";
                                        trim($aux_array_items["location_1_title"]) ? $auxArrayLocInfo[] = trim($aux_array_items["location_1_title"]) : "";
                                        if (count($auxArrayLocInfo) > 0) {
                                            $auxInfoLocation = implode(", ", $auxArrayLocInfo);
                                        }                                       
                                        
                                        if ($id && !$items[$i]["location_information"]) {
                                            $items[$i]["location_information"] = $auxInfoLocation;
                                        } elseif (!$aux_items[$i]["location_information"]) {
                                            $aux_items[$i]["location_information"] = $auxInfoLocation;
                                        }
                                        
                                    } else {

                                        if ($aux_key == "promotion_id") {
                                        
                                            unset($promotionObj);
                                            $promotionObj = new Promotion($aux_array_items["promotion_id"]);
                                            if ((!validate_date_deal($promotionObj->getDate("start_date"), $promotionObj->getDate("end_date"))) || (!validate_period_deal($promotionObj->getNumber("visibility_start"),$promotionObj->getNumber("visibility_end")))){
                                                $aux_value = 0;
                                            }                                        

                                        }
                                        
                                        if ($id) {
                                            if (array_search($aux_key, $aux_fields) !== false) {
                                                $items[$i][array_search($aux_key, $aux_fields)] = ((is_numeric($aux_value) && in_array($aux_key, $number_fields) !== false) ? (float)$aux_value : $aux_value);    
                                            } else {
                                                $items[$i][$aux_key] = ((is_numeric($aux_value) && in_array($aux_key, $number_fields) !== false) ? (float)$aux_value : $aux_value);    
                                            }
                                        } else {
                                            if (array_search($aux_key, $aux_fields) !== false) {
                                                $aux_items[$i][array_search($aux_key, $aux_fields)] = ((is_numeric($aux_value) && in_array($aux_key, $number_fields) !== false) ? (float)$aux_value : $aux_value);
                                            } else {
                                                $aux_items[$i][$aux_key] = ((is_numeric($aux_value) && in_array($aux_key, $number_fields) !== false) ? (float)$aux_value : $aux_value);
                                            }
                                        }
                                        
                                        if ($aux_key == "recurring") {
                                    
                                            $eventObj = new Event(($aux_array_items[$resource."_ID"] ? $aux_array_items[$resource."_ID"] : $aux_array_items["id"]));

                                            if ($id) {
                                                $items[$i]["recurring_string"] = $eventObj->getDateStringRecurring();
                                            } else {
                                                $aux_items[$i]["recurring_string"] = $eventObj->getDateStringRecurring();
                                            }

                                        } elseif ($resource == "deal" && $aux_key == "realvalue") {
                                            if ($aux_array_items["realvalue"] > 0) {
                                                $aux_percentage = round(100-(($aux_array_items["dealvalue"]*100)/$aux_array_items["realvalue"]));
                                            } else {
                                                $aux_percentage = 0;
                                            }
                                            
                                            if ($id) {
                                                $items[$i]["deal_discount"] = $aux_percentage."%";
                                            } else {
                                                $aux_items[$i]["deal_discount"] = $aux_percentage."%";
                                            }
                                        }
                                    }
                                }

                                $aux_returnArray["success"]         = true;
                                if ($id) {
                                    $aux_returnArray["results"][$i] = $items[$i];
                                } else {
                                    $aux_returnArray["results"][$i] = $aux_items[$i];
                                }                                
                            }

                        } else {
                            $aux_returnArray["type"]            = $resource;
                            $aux_returnArray["total_results"]   = 0; 
                            $aux_returnArray["total_pages"]     = 0; 
                            $aux_returnArray["results_per_page"]= $aux_results_per_page; 
                            $aux_returnArray["success"]         = true;
                            $aux_returnArray["message"]			= "No results found.";
                        }
                    }
                }

                if (is_array($aux_returnArray) || is_array($arrayCalendar)) {
                    api_formatReturn(is_array($arrayCalendar) ? $arrayCalendar : $aux_returnArray);
                }
                
            }

        } else {
            $return["type"]             = $resource;
            $return["total_results"]    = 0;
            $return["total_pages"]      = 0;
            $return["results_per_page"] = 0;
            $return["success"]          = FALSE;
            $return["message"]          = ($validKey ? "Please check your parameters" : "Invalid key");
            api_formatReturn($return);
        }
        
    } else {
        $return["type"]             = $resource;
        $return["total_results"]    = 0;
        $return["total_pages"]      = 0;
        $return["results_per_page"] = 0;
        $return["success"]          = FALSE;
        $return["message"] = "API disabled";
        api_formatReturn($return);
    }
?>