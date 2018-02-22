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
    # * FILE: /API/api2.php
    # ----------------------------------------------------------------------------------------------------

    # ----------------------------------------------------------------------------------------------------
    # LOAD CONFIG
    # ----------------------------------------------------------------------------------------------------
    include("../conf/loadconfig.inc.php");
    
    # ----------------------------------------------------------------------------------------------------
	# VALIDATION
	# ----------------------------------------------------------------------------------------------------
    $errors = "";
    
    extract($_GET);
    
    setting_get("edirectory_api_enabled", $edirectory_api_enabled);
    setting_get("edirectory_api_key", $edirectory_api_key);
    $aux_results_per_page = 25;
    $paginationCategs = false;
    define("API_IN_USE", "api2");
    
    /*
     * API Version
     */
    define("EDIR_APP_API_VERSION", "1.4");
    
    //Check if API is enabled
    if ($edirectory_api_enabled == "on" || DEMO_LIVE_MODE) {
        
        unset($errors);
        //Validate API key
        
        if (!DEMO_DEV_MODE && !DEMO_LIVE_MODE) {
            if ($_POST["key"]) {
                $key = $_POST["key"];
            }

            if ($edirectory_api_key != $key) {
                $errors .= system_showText(LANG_API_INVALIDKEY)."<br />";
            }
        }
        
        // Validate parameters
        if (($resource || $_POST) && !$errors) {

            if ($_POST) {
                
                if ($_POST["resource"] == "ContactMail") {
                
                    if ($_POST["id"]) {
                        if ($_POST["module"] == "listing") {
                            $moduleObj = new Listing($_POST["id"]);
                            $aux_emptySubjectText = LANG_LISTING_CONTACTSUBJECT_ISNULL_1." ".$moduleObj->getString("title")." ".LANG_LISTING_CONTACTSUBJECT_ISNULL_2." ".EDIRECTORY_TITLE;
                        } elseif ($_POST["module"] == "article") {
                            $moduleObj = new Article($_POST["id"]);
                            $aux_emptySubjectText = LANG_ARTICLE_CONTACTSUBJECT_ISNULL_1." ".$moduleObj->getString("title")." ".LANG_ARTICLE_CONTACTSUBJECT_ISNULL_2." ".EDIRECTORY_TITLE;
                            $aux_report_mail_sent = ARTICLE_REPORT_EMAIL_SENT ;
                        } elseif ($_POST["module"] == "deal") {
                            $moduleObj = new Promotion($_POST["id"]);
                            $aux_emptySubjectText = LANG_PROMOTION_CONTACTSUBJECT_ISNULL_1." ".$moduleObj->getString("title")." ".LANG_PROMOTION_CONTACTSUBJECT_ISNULL_2." ".EDIRECTORY_TITLE;
                        } elseif ($_POST["module"] == "classified") {
                            $moduleObj = new Classified($_POST["id"]);
                            $aux_emptySubjectText = LANG_CLASSIFIED_CONTACTSUBJECT_ISNULL_1." ".$moduleObj->getString("title")." ".LANG_CLASSIFIED_CONTACTSUBJECT_ISNULL_2." ".EDIRECTORY_TITLE;
                        } elseif ($_POST["module"] == "event" ){
                            $moduleObj = new Event($_POST["id"]);
                            $aux_emptySubjectText = LANG_EVENT_CONTACTSUBJECT_ISNULL_1." ".$moduleObj->getString("title")." ".LANG_EVENT_CONTACTSUBJECT_ISNULL_2." ".EDIRECTORY_TITLE;
                        }
                    }

                    $to = system_denyInjections($_POST["to"]);
                    $subject = trim(system_denyInjections($_POST["subject"]));
                    $body = trim(system_denyInjections($_POST["body"], true));
                    $name = $_POST["name"];
                    $from = $_POST["from"];
                    $error = "";
                    if (!$name){
                        $aux_error .= system_showText(LANG_MSG_CONTACT_ENTER_NAME)."\n";
                    }
                    if (!validate_email($to)){
                        $aux_error .= system_showText(LANG_MSG_CONTACT_ENTER_VALID_EMAIL)."\n";
                    }
                    if (!validate_email($from)){
                        $aux_error .= system_showText(LANG_MSG_CONTACT_ENTER_VALID_EMAIL)."\n";
                    }
                    if (!$body){
                        $aux_error .= system_showText(LANG_MSG_CONTACT_TYPE_MESSAGE)."\n";
                    }

                    if (empty($aux_error)) {

                        if (empty($subject)){
                            $subject = $aux_emptySubjectText;
                        } 

                        $body = str_replace("<br />", "", $body);

                        $name = stripslashes(html_entity_decode($name));

                        $body = ucfirst(system_showText(LANG_FROM)).": ".$name."\n\n".system_showText(LANG_LABEL_EMAIL).": ".$from."\n\n".system_showText(LANG_LABEL_MESSAGE).": ".$body;

                        $subject = stripslashes(html_entity_decode($subject));
                        $body 	 = stripslashes($body);

                        $subject = "[".system_showText(LANG_CONTACTPRESUBJECT)." ".EDIRECTORY_TITLE."] ".$subject;

                        $return = system_mail($to, htmlspecialchars_decode($subject), $body, $from, 'text/plain', '', '', $error, '', '', $from);

                        if ($return) {
                            $error["success"] = TRUE;
                            $error["message"] = system_showText(LANG_CONTACTMSGSUCCESS);
                        }	else {
                            $error["success"] = FALSE;
                            $error = system_showText(LANG_CONTACTMSGFAILED).($error ? '\n'.$error : '')."\n";
                        }

                        if ($return) {
                            if($_POST["module"] == "listing"){
                                report_newRecord("listing", $_POST["id"], LISTING_REPORT_EMAIL_SENT);
                            }
                            unset($from, $subject, $body, $name);
                        }

                    }else{
                        $error["success"] = FALSE;
                        $error["message"] = $aux_error;
                    }
                    
                    header("Expires: Sat, 01 Jan 2000 00:00:00 GMT");
                    header("Cache-Control: no-store, no-cache, must-revalidate");
                    header("Cache-Control: post-check=0, pre-check=0", FALSE);
                    header("Pragma: no-cache");
                    header("Content-Type: application/json; charset=".EDIR_CHARSET, TRUE);
                    echo json_encode($error);    
                    exit;
                    
                }
                
                
            } elseif ($_GET) {
                unset($aux_fields, $auxTable, $auxWhere, $aux_results, $aux_returnArray, $items);
                $_GET["module"]                 = $resource;
                $_GET["aux_results_per_page"] 	= $aux_results_per_page;

                $aux_returnArray = array();
                $aux_fields = array();
                $auxTable = "";
                $aux_Where = ""; 

                if ($resource == "listing") {

                    // Label = value (field on DB);
                    $aux_fields["listing_ID"]   = "id";
                    $aux_fields["name"]         = "title";
                    $aux_fields["level"]        = "level";
                    $aux_fields["title"]        = "title";
                    $aux_fields["has_deal"]     = "promotion_id";
                    $aux_fields["address"]      = "address";
                    $aux_fields["address2"]     = "address2";
                    $aux_fields["rate"]         = "avg_review";
                    $aux_fields["imageurl"]     = "image_id";
                    $aux_fields["phonenumber"]  = "phone";
                    $aux_fields["latitude"]     = "latitude";
                    $aux_fields["longitude"]    = "longitude";
                    $aux_fields["description"]  = "description";
                    $aux_fields["location_4_title"]  = "location_4_title";
                    $aux_fields["location_3_title"]  = "location_3_title";
                    $aux_fields["location_1_title"]  = "location_1_title";
                    
                    $aux_fields["total_reviews"] = "(SELECT count(item_id) FROM Review WHERE item_type = 'listing' AND item_id = Listing_Summary.id AND approved = '1' AND status = 'A') AS total_reviews";    

                    if ($myLat && $myLong) {
                        if (ZIPCODE_UNIT == "mile") {
                            $aux_fields["distance_score"] = "SQRT(POW((69.1 * (".$myLat." - latitude)), 2) + POW((53.0 * (".$myLong." - longitude)), 2)) AS distance_score";
                        } elseif (ZIPCODE_UNIT == "km") {
                            $aux_fields["distance_score"] = "SQRT(POW((69.1 * (".$myLat." - latitude)), 2) + POW((53.0 * (".$myLong." - longitude)), 2)) * 1.609344 AS distance_score";
                        }
                    }

                    if ($orderBy && $orderSequence) {
                        unset($prepareOrderField,$prepareTypeOrder);
                        $prepareOrderField = explode(",",$orderBy);
                        $prepareTypeOrder = explode(",",$orderSequence);

                        if (count($prepareOrderField) != count($prepareTypeOrder)) {
                            die("Check your order parameters");
                        } else {

                            for ($i = 0; $i < count($prepareOrderField); $i++) {
                                $aux_orderBy[] = $prepareOrderField[$i]." ".$prepareTypeOrder[$i];
                            }

                        }

                    } else {
                        $aux_orderBy[] = "level";
                        if (BACKLINK_FEATURE == "on") {
                            $aux_orderBy[] = "backlink DESC";
                        }
                        $aux_orderBy[] = "random_number DESC";
                        $aux_orderBy[] = "title"; 
                    }

                    Listing::GetInfoToApp($_GET, $aux_returnArray, $aux_fields, $items, $auxTable, $aux_Where);
                    


                } elseif ($resource == "listing_category") {

                    ListingCategory::GetInfoToApp($_GET, $aux_returnArray, $aux_fields, $items, $auxTable, $aux_Where);

                    $aux_orderBy[] = "title";

                } elseif ($resource == "review" && $type && $id) {

                    unset($reviewObj);
                    $reviewObj = new Review();

                    $reviewObj->item_id     = $id;
                    $reviewObj->item_type   = $type;

                    $reviewObj->GetInfoToApp($_GET, $aux_returnArray, $items);



                } elseif ($resource == "checkin" && $id) {

                    unset($checkInObj);
                    $checkInObj = new CheckIn();

                    $checkInObj->item_id     = $id;

                    $checkInObj->GetInfoToApp($_GET, $aux_returnArray, $items);

                } elseif ($resource == "event") {

                    $aux_fields["event_ID"]     = "id";
                    $aux_fields["name"]         = "title";
                    $aux_fields["location"]      = "location";
                    $aux_fields["address"]      = "address";

                    if ($searchBy == "calendarList") {
                        $aux_fields["image_id"]     = "image_id";
                    } else {
                        $aux_fields["imageurl"]     = "image_id";
                    }
                    $aux_fields["phonenumber"]  = "phone";
                    $aux_fields["latitude"]     = "latitude";
                    $aux_fields["longitude"]    = "longitude";
                    $aux_fields["start_date"]   = "start_date";
                    $aux_fields["end_date"]     = "end_date";
                    $aux_fields["start_time"]   = "start_time";
                    $aux_fields["end_time"]     = "end_time";
                    $aux_fields["recurring"]    = "recurring";
                    $aux_fields["until_date"]   = "until_date";
                    $aux_fields["repeat_event"] = "repeat_event";

                    if ($myLat && $myLong) {
                        if (ZIPCODE_UNIT == "mile") {
                            $aux_fields["distance_score"] = "SQRT(POW((69.1 * (".$myLat." - latitude)), 2) + POW((53.0 * (".$myLong." - longitude)), 2)) AS distance_score";
                        } elseif (ZIPCODE_UNIT == "km") {
                            $aux_fields["distance_score"] = "SQRT(POW((69.1 * (".$myLat." - latitude)), 2) + POW((53.0 * (".$myLong." - longitude)), 2)) * 1.609344 AS distance_score";
                        }
                    }

                    if ($orderBy && $orderSequence) {
                        unset($prepareOrderField,$prepareTypeOrder);
                        $prepareOrderField = explode(",",$orderBy);
                        $prepareTypeOrder = explode(",",$orderSequence);

                        if (count($prepareOrderField) != count($prepareTypeOrder)) {
                            die("Check your order parameters");
                        } else {

                            for ($i = 0; $i < count($prepareOrderField); $i++) {
                                $aux_orderBy[] = $prepareOrderField[$i]." ".$prepareTypeOrder[$i];
                            }

                        }

                    } else {
                        $aux_orderBy[] = "level";
                        $aux_orderBy[] = "random_number DESC";
                        $aux_orderBy[] = "title";
                    }

                    if ($searchBy == "calendar") {

                        $arrayCalendar = Event::EventsDay($year, $month);

                    } else {
                        Event::GetInfoToApp($_GET, $aux_returnArray, $aux_fields, $items, $auxTable, $aux_Where);
                    }


                } elseif ($resource == "event_category") {

                    EventCategory::GetInfoToApp($_GET, $aux_returnArray, $aux_fields, $items, $auxTable, $aux_Where);

                    $aux_orderBy[] = "title";

                } elseif ($resource == "classified") {

                    $aux_fields["classified_ID"]= "id";
                    $aux_fields["name"]         = "title";
                    $aux_fields["address"]      = "address";
                    $aux_fields["address2"]     = "address2";
                    $aux_fields["imageurl"]     = "image_id";
                    $aux_fields["phonenumber"]  = "phone";
                    $aux_fields["latitude"]     = "latitude";
                    $aux_fields["longitude"]    = "longitude";
                    $aux_fields["price"]        = "classified_price";

                    if ($myLat && $myLong) {
                        if (ZIPCODE_UNIT == "mile") {
                            $aux_fields["distance_score"] = "SQRT(POW((69.1 * (".$myLat." - latitude)), 2) + POW((53.0 * (".$myLong." - longitude)), 2)) AS distance_score";
                        } elseif (ZIPCODE_UNIT == "km") {
                            $aux_fields["distance_score"] = "SQRT(POW((69.1 * (".$myLat." - latitude)), 2) + POW((53.0 * (".$myLong." - longitude)), 2)) * 1.609344 AS distance_score";
                        }
                    }

                    if ($orderBy && $orderSequence) {
                        unset($prepareOrderField,$prepareTypeOrder);
                        $prepareOrderField = explode(",",$orderBy);
                        $prepareTypeOrder = explode(",",$orderSequence);

                        if (count($prepareOrderField) != count($prepareTypeOrder)) {
                            die("Check your order parameters");
                        } else {

                            for ($i = 0; $i < count($prepareOrderField); $i++) {
                                $aux_orderBy[] = $prepareOrderField[$i]." ".$prepareTypeOrder[$i];
                            }

                        }

                    } else {
                        $aux_orderBy[] = "level";
                        $aux_orderBy[] = "random_number DESC";
                        $aux_orderBy[] = "title";
                    }

                    Classified::GetInfoToApp($_GET, $aux_returnArray, $aux_fields, $items, $auxTable, $aux_Where);

                } elseif ($resource == "classified_category") {

                    ClassifiedCategory::GetInfoToApp($_GET, $aux_returnArray, $aux_fields, $items, $auxTable, $aux_Where);

                    $aux_orderBy[] = "title";

                } elseif ($resource == "article") {

                    $aux_fields["article_ID"]       = "id";
                    $aux_fields["name"]             = "title";
                    $aux_fields["author"]           = "author";
                    $aux_fields["imageurl"]         = "image_id";
                    $aux_fields["publication_date"] = "publication_date";
                    $aux_fields["avg_review"]       = "avg_review";

                    if ($orderBy && $orderSequence) {
                        unset($prepareOrderField,$prepareTypeOrder);
                        $prepareOrderField = explode(",",$orderBy);
                        $prepareTypeOrder = explode(",",$orderSequence);

                        if (count($prepareOrderField) != count($prepareTypeOrder)) {
                            die("Check your order parameters");
                        } else {

                            for ($i = 0; $i < count($prepareOrderField); $i++) {
                                $aux_orderBy[] = $prepareOrderField[$i]." ".$prepareTypeOrder[$i];
                            }

                        }

                    } else {
                    
                        $aux_orderBy[] = "level";
                        $aux_orderBy[] = "publication_date DESC";
                        $aux_orderBy[] = "random_number DESC";
                        $aux_orderBy[] = "title";
                    
                    }

                    Article::GetInfoToApp($_GET, $aux_returnArray, $aux_fields, $items, $auxTable, $aux_Where);

                } elseif ($resource == "article_category") {

                    ArticleCategory::GetInfoToApp($_GET, $aux_returnArray, $aux_fields, $items, $auxTable, $aux_Where);

                    $aux_orderBy[] = "title";

                } elseif ($resource == "deal") {

                    $aux_fields["deal_ID"]              = "id";
                    $aux_fields["name"]                 = "name";
                    $aux_fields["imageurl"]             = "image_id";

                    if ($searchBy && ($searchBy != "map")) {
                        $aux_fields["listing_title"]    = "(select title from Listing_Summary where Listing_Summary.id=listing_id) AS listing_title";
                    } else {
                        $aux_fields["listing_title"]    = "(select title from Listing_Summary where Listing_Summary.id=listing_id)";
                    }

                    $aux_fields["listing_latitude"]     = "listing_latitude";
                    $aux_fields["listing_longitude"]    = "listing_longitude";
                    $aux_fields["listing_id"]           = "listing_id";
                    $aux_fields["avg_review"]           = "avg_review";
                    $aux_fields["realvalue"]            = "realvalue";
                    $aux_fields["dealvalue"]            = "dealvalue";
                    $aux_fields["total_amount"]         = "amount";
                    $aux_fields["conditions"]           = "conditions";
                    $aux_fields["summary"]              = "description";
                    
                    $aux_fields["total_reviews"] = "(SELECT count(item_id) FROM Review WHERE item_type = 'promotion' AND item_id = Promotion.id AND approved = '1' AND status = 'A') ";

                    if ($searchBy) {
                        $aux_fields["amount"]       = "amount";
                    } else {
                        $aux_fields["amount"]       = "(SELECT count(id) FROM Promotion_Redeem WHERE Promotion_Redeem.promotion_id = Promotion.id)";
                    }

                    if ($myLat && $myLong) {
                        if (ZIPCODE_UNIT == "mile") {
                            $aux_fields["distance_score"] = "SQRT(POW((69.1 * (".$myLat." - listing_latitude)), 2) + POW((53.0 * (".$myLong." - listing_longitude)), 2)) AS distance_score";
                        } elseif (ZIPCODE_UNIT == "km") {
                            $aux_fields["distance_score"] = "SQRT(POW((69.1 * (".$myLat." - listing_latitude)), 2) + POW((53.0 * (".$myLong." - listing_longitude)), 2)) * 1.609344 AS distance_score";
                        }
                    }

                    if ($orderBy && $orderSequence) {
                        unset($prepareOrderField,$prepareTypeOrder);
                        $prepareOrderField = explode(",",$orderBy);
                        $prepareTypeOrder = explode(",",$orderSequence);

                        if (count($prepareOrderField) != count($prepareTypeOrder)) {
                            die("Check your order parameters");
                        } else {

                            for ($i = 0; $i < count($prepareOrderField); $i++) {
                                $aux_orderBy[] = $prepareOrderField[$i]." ".$prepareTypeOrder[$i];
                            }

                        }

                    } else {
                        $aux_orderBy[] = "listing_level";
                        $aux_orderBy[] = "random_number DESC";
                        $aux_orderBy[] = "name";
                    }

                    Promotion::GetInfoToApp($_GET, $aux_returnArray, $aux_fields, $items, $auxTable, $aux_Where);



                } elseif ($resource == "deal_category") {

                    ListingCategory::GetInfoToApp($_GET, $aux_returnArray, $aux_fields, $items, $auxTable, $aux_Where);

                    $aux_orderBy[] = "title";

                } elseif ($resource == "getConf") {

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
                    $items[0]["review_approve"] = $review_approve;
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
                    
                    $aux_returnArray["type"]            = $resource;
                    $aux_returnArray["total_results"]   = count($items); 
                    $aux_returnArray["total_pages"]     = count($items); 
                    $aux_returnArray["results_per_page"]= count($items);  

                } elseif ($resource == "modulesConf") {

                    $arrayModules = array();
                    $arrayModules[] = "listing";
                    $arrayModules[] = "event";
                    $arrayModules[] = "classified";
                    $arrayModules[] = "article";

                    $i = 0;
                    foreach($arrayModules as $module) {
                        $levelStr = ucfirst($module)."Level";
                        $levelObj = new $levelStr();
                        $levels = $levelObj->getValues();
                        $j = 0;
                        foreach ($levels as $level) {
                            $items[$i][$module][$j]["level"] = $level;
                            $items[$i][$module][$j]["detail"] = $levelObj->getDetail($level);
                            $items[$i][$module][$j]["images"] = $levelObj->getImages($level);

                            if ($module == "listing") {
                                $items[$i][$module][$j]["backlink"] = $levelObj->getBacklink($level);
                                $items[$i][$module][$j]["deal"] = $levelObj->getHasPromotion($level);
                                $items[$i][$module][$j]["sms"] = $levelObj->getHasSms($level);
                                $items[$i][$module][$j]["call"] = $levelObj->getHasCall($level);
                                $items[$i][$module][$j]["review"] = $levelObj->getHasReview($level);
                            }

                            if ($module != "article") {
                                $items[$i][$module][$j]["general"] = system_getFormFields($module, $level);
                            }
                            $j++;

                        }
                        $i++;
                    }

                    $aux_returnArray["type"]            = $resource;
                    $aux_returnArray["total_results"]   = count($items); 
                    $aux_returnArray["total_pages"]     = count($items); 
                    $aux_returnArray["results_per_page"]= count($items); 

                } elseif ($resource == "notification") {
                    
                    $appNotif = new AppNotification();
                    $notification = $appNotif->getCurrent();
                    if ($notification) {
                        
                        $totalNotif = 1;
                        
                        $items[0]["description"] = $notification["description"];
                        $items[0]["notification_id"] = $notification["id"];
                        $items[0]["title"] = $notification["title"];
                        
                        
                    } else {
                        
                        $totalNotif = 0;
                        
                    }
                    
                    $aux_returnArray["type"]            = $resource;
                    $aux_returnArray["total_results"]   = $totalNotif;
                    $aux_returnArray["total_pages"]     = $totalNotif;
                    $aux_returnArray["results_per_page"]= $aux_results_per_page; 
                    
                    
                } elseif ($resource == "advert") {
                    
                    if (!$qtd || !$device) {
                        
                        echo "Missing parameters: <br />";
                        if (!$qtd) echo "\"qtd\" <br />";
                        if (!$device) echo "\"device\" <br />";
                        die();
                        
                    } else {
                        
                        $appAdvert = new AppAdvert();
                        $adverts = $appAdvert->getAdverts($device, $qtd);
                        
                        if ($adverts) {
                            
                            $totalAdvert = count($adverts);
                            $pos = 0;
                            
                            foreach ($adverts as $advert) {
                                                                
                                $items[$pos]["ad_id"] = $advert["id"];
                                $items[$pos]["title"] = $advert["title"];
                                $items[$pos]["url"] = $advert["url"];
                                
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
                        
                        $aux_returnArray["type"]            = $resource;
                        $aux_returnArray["total_results"]   = $totalAdvert;
                        $aux_returnArray["total_pages"]     = ceil($totalAdvert / $aux_results_per_page); 
                        $aux_returnArray["results_per_page"]= $aux_results_per_page; 
                        
                    }
                    
                } elseif ($resource == "filters") {
                    
                    $filterApi = true;
                    
                    if (!$father_category) {
                    
                        include(EDIRECTORY_ROOT."/search_filters.php");
                    
                    } else {
                        
                        include(EDIRECTORY_ROOT."/loadcategoryfilter.php");
                    }
                    
                    $aux_returnArray["type"]            = $resource;
                    $aux_returnArray["total_results"]   = count($filters);
                    $aux_returnArray["total_pages"]     = 1;
                    $aux_returnArray["results_per_page"]= $aux_results_per_page; 
                    
                    if (is_array($filters)) {
                        foreach ($filters as $filter) {
                            $items[] = $filter;
                        }
                    }
                    
                } else {
                    echo "Invalid Resource";
                    die();
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
                $number_fields[] = "active_listing";
                $number_fields[] = "total_reviews";
                $number_fields[] = "listing_ID";
                $number_fields[] = "has_deal";
                $number_fields[] = "rate";
                $number_fields[] = "event_ID";
                $number_fields[] = "image_id";
                $number_fields[] = "classified_ID";
                $number_fields[] = "article_ID";
                $number_fields[] = "deal_ID";
                $number_fields[] = "total_amount";
                $number_fields[] = "father_id";
                $number_fields[] = "total_sub";
                $number_fields[] = "active_articles";
                $number_fields[] = "active_classifieds";
                $number_fields[] = "active_events";
                $number_fields[] = "active_listings";
                $number_fields[] = "ad_id";
                
                if ($resource != "deal") {
                    $number_fields[] = "avg_review";
                }

                if (is_array($aux_fields) || $items || is_array($arrayCalendar)) {

                    if (!$items && !array_key_exists('error', $aux_returnArray) && (!$arrayCalendar && $searchBy != "calendar")) {

                        /*
                        * Preparing SQL
                        */
                        $db = db_getDBObject();

                        if ($auxTable && $aux_Where) {

                            /**
                            * Counting results
                            */
                            $sql_count = "SELECT 0 FROM ".$auxTable." WHERE ".implode(" AND ",$aux_Where);
                            $aux_total_results = $db->query($sql_count);

                            if (mysql_num_rows($aux_total_results)) {

                                $aux_returnArray["type"]            = $resource;
                                $aux_returnArray["total_results"]   = mysql_num_rows($aux_total_results);
                                $aux_returnArray["total_pages"]     = ceil(mysql_num_rows($aux_total_results) / $aux_results_per_page);
                                $aux_returnArray["results_per_page"]= $aux_results_per_page;
                                
                                if (strpos($auxTable, "Category") !== false && !$paginationCategs) {
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
                                    $sql_alias = substr($sql_alias,0,strlen($sql_alias)-1);
                                }
                                
                                $sql = "SELECT ".($sql_alias ? $sql_alias : implode(",",$aux_fields))." FROM ".$auxTable." WHERE ".implode(" AND ",$aux_Where)." ".(is_array($aux_orderBy) ? " ORDER BY ".implode(", ",$aux_orderBy) : "" ).$sqlLimit;

                                $aux_results = $db->query($sql);

                                if (mysql_num_rows($aux_results) > 0) {

                                    $i = 0;

                                    if ((strpos($auxTable, "Category") !== false) && $father_id) {

                                        $sqlAux = "SELECT ".implode(",",$aux_fields)." FROM ".$auxTable." WHERE id = $father_id";
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
                                            } elseif ($DB_field == "promotion_id") {
                                                unset($promotionObj);
                                                $promotionObj = new Promotion($value);
                                                if ((!validate_date_deal($promotionObj->getDate("start_date"), $promotionObj->getDate("end_date"))) || (!validate_period_deal($promotionObj->getNumber("visibility_start"),$promotionObj->getNumber("visibility_end")))){
                                                    $value = 0;
                                                } else {
                                                    $array_results["deal_id"] = (float)$value;
                                                }
                                            } elseif ($DB_field == "recurring") {
                                                $eventObj = new Event($aux_row["event_ID"]);
                                                if ($eventObj->getNumber("id")) {
                                                    $array_results["recurring_string"] = $eventObj->getDateStringRecurring();
                                                }
                                            }  elseif (($DB_field == "location" || $DB_field == "address" || $DB_field == "address2" || $DB_field == "location_4_title" || $DB_field == "location_3_title" || $DB_field == "location_1_title") && !$array_results["location_information"]) {
                                                unset($auxArrayLocInfo);
                                                $auxArrayLocInfo = array();
                                                $aux_row["location"] ? $auxArrayLocInfo[] = $aux_row["location"] : "";
                                                $aux_row["address"] ? $auxArrayLocInfo[] = $aux_row["address"] : "";
                                                $aux_row["address2"] ? $auxArrayLocInfo[] = $aux_row["address2"] : "";
                                                $aux_row["location_4_title"] ? $auxArrayLocInfo[] = $aux_row["location_4_title"] : "";
                                                $aux_row["location_3_title"] ? $auxArrayLocInfo[] = $aux_row["location_3_title"] : "";
                                                $aux_row["location_1_title"] ? $auxArrayLocInfo[] = $aux_row["location_1_title"] : "";
                                                if (count($auxArrayLocInfo) > 0) {
                                                    $array_results["location_information"] = implode(", ", $auxArrayLocInfo);
                                                }
                                            }

                                            $array_results[(array_search($DB_field, $aux_fields) ? array_search($DB_field, $aux_fields) : $DB_field)] = ((is_numeric($value) && in_array($DB_field, $number_fields)) ? (float)$value : $value);

                                        }

                                        $aux_returnArray["results"][$i] = $array_results;
                                        $i++;

                                    }

                                    /**
                                    * Prepare to send fields to order
                                    */
                                    unset($stringFieldsToOrder);
                                    foreach ($aux_fields as $key => $value) {
                                        $stringFieldsToOrder[] = $key;
                                    }
                                    $aux_returnArray["fieldsToOrder"] = implode(",",$stringFieldsToOrder); 

                                } else {
                                    $aux_returnArray["error"]              = "No results found.";
                                    $aux_returnArray["type"]               = $resource;
                                    $aux_returnArray["total_results"]      = 0; 
                                    $aux_returnArray["total_pages"]        = 0; 
                                    $aux_returnArray["results_per_page"]   = $aux_results_per_page;     
                                }

                            } else {

                                $aux_returnArray["error"]              = "No results found.";
                                $aux_returnArray["type"]               = $resource;
                                $aux_returnArray["total_results"]      = 0; 
                                $aux_returnArray["total_pages"]        = 0; 
                                $aux_returnArray["results_per_page"]   = $aux_results_per_page; 

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
                                    } else {

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

                                        }
                                    }
                                }

                                if ($id) {
                                    $aux_returnArray["results"][$i] = $items[$i];
                                } else {
                                    $aux_returnArray["results"][$i] = $aux_items[$i];
                                }
                            }

                        } else {
                            $aux_returnArray["error"]			= "No results found.";
                            $aux_returnArray["type"]            = $resource;
                            $aux_returnArray["total_results"]   = 0; 
                            $aux_returnArray["total_pages"]     = 0; 
                            $aux_returnArray["results_per_page"]= $aux_results_per_page; 
                        }
                    }
                }

                if (is_array($aux_returnArray) || is_array($arrayCalendar)) {

                    header("Expires: Sat, 01 Jan 2000 00:00:00 GMT");
                    header("Cache-Control: no-store, no-cache, must-revalidate");
                    header("Cache-Control: post-check=0, pre-check=0", FALSE);
                    header("Pragma: no-cache");
                    header("Content-Type: application/json; charset=".EDIR_CHARSET, TRUE);

                    if (is_array($arrayCalendar)) {
                        echo json_encode($arrayCalendar);    
                    } else {
                        echo json_encode($aux_returnArray);    
                    }
                }
                
            }

        } else {
            echo "Please check your parameters";
        }
        
    } else {
        echo "API disabled";
        die();
    }
?>