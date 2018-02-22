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
	# * FILE: /includes/code/advertise_preview.php
	# ----------------------------------------------------------------------------------------------------

    setting_get("commenting_edir", $commenting_edir);
	setting_get("review_listing_enabled", $review_enabled);
    $levelsWithReview = system_retrieveLevelsWithInfoEnabled("has_review");
	
	$locationsToShow = explode (",", EDIR_LOCATIONS);
	$locationsToShow = array_reverse ($locationsToShow);
	foreach ($locationsToShow as $locationToShow) {
		$reviewer_location .= system_showText(constant("LANG_LABEL_".constant("LOCATION".$locationToShow."_SYSTEM"))).", ";
	}
	$reviewer_location = string_substr("$reviewer_location", 0, -2);
	unset($locationsToShow);
	
	$arrReviewAux["review_title"] = system_showText(LANG_LABEL_ADVERTISE_REVIEW_TITLE);
	$arrReviewAux["reviewer_name"] = system_showText(LANG_LABEL_ADVERTISE_VISITOR);
    $arrReviewAux["reviewer_location"] = $reviewer_location;
    $arrReviewAux["added"] = date("Y-m-d")." ".date("H:m:s");
    $arrReviewAux["approved"] = "1";
	$arrReviewAux["review"] = "Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica formas.";
	
    $arrReviewAux["rating"] = "1";
    $arrReviewAux["response"] = "Lorem ipsum dolor sit amet, consectetur. Pellentesque luctus enim ac diam tortor.";
    $arrReviewAux["responseapproved"] = "1";
	$reviewsArr[] = new Review($arrReviewAux);
	
	$arrReviewAux["rating"] = "3";
    $arrReviewAux["response"] = "";
    $arrReviewAux["responseapproved"] = "0";
	$reviewsArr[] = new Review($arrReviewAux);
	
	$arrReviewAux["rating"] = "5";
	$reviewsArr[] = new Review($arrReviewAux);
	unset($arrReviewAux);
    
    $levelValue = $level;

    if ($modulePreview == "listing") {
        
        $listing = new Listing();
        unset($levelObj);
        $levelObj = new ListingLevel();

        $tPreview = "preview";

        $arrListingAux["title"] = system_showText(LANG_LABEL_ADVERTISE_LISTING_TITLE);
        $arrListingAux["email"] = system_showText(LANG_LABEL_ADVERTISE_ITEM_EMAIL);
        $arrListingAux["url"] = system_showText(LANG_LABEL_ADVERTISE_ITEM_SITE);
        $arrListingAux["address"] = system_showText(LANG_LABEL_ADVERTISE_ITEM_ADDRESS);
        $arrListingAux["zip_code"] = ucwords(system_showText(LANG_LABEL_ADVERTISE_ITEM_ZIPCODE));
        $arrListingAux["video_snippet"] = "<img src=\"".THEMEFILE_URL."/".EDIR_THEME."/images/imagery/img-video-sample.jpg\" alt=\"\" title=\"\"/>";
        $arrListingAux["phone"] = "000.000.0000";
        $arrListingAux["fax"] = "000.000.0000";
        $arrListingAux["description"] = "Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas.";
        $arrListingAux["long_description"] = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque luctus enim ac diam malesuada vestibulum vitae at tortor. Nullam nec porttitor arcu. Pellentesque laoreet lorem egestas felis lobortis eu tincidunt nulla tempor. Phasellus adipiscing fringilla tempus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Curabitur sed sapien ut eros porta volutpat et quis leo. Aenean tincidunt ipsum quis nisl blandit nec placerat eros consectetur. Morbi convallis, est quis venenatis fermentum, sapien nibh auctor arcu, auctor mattis justo nisi tincidunt neque. Quisque cursus luctus congue. Quisque vel nulla vitae arcu faucibus placerat. Curabitur iaculis molestie sagittis.";
        $arrListingAux["clicktocall_number"] = "000";
        $arrListingAux["hours_work"] = system_showText(LANG_HOURWORK_SAMPLE_1);;
        $arrListingAux["locations"] = "Lorem ipsum dolor sit amet, consectetur.";
        $arrListingAux["attachment_file"] = "sample";
        $arrListingAux["price"] = "4";
        $arrListingAux["features"] = "<li>Lorem ipsum</li><li>Claritas processus</li><li>Mutationem consuetudium</li>";
        $arrCheckinAux["checkin_name"] = system_showText(LANG_LABEL_ADVERTISE_VISITOR);
        $arrCheckinAux["added"] = date("Y-m-d")." ".date("H:m:s");
        $arrCheckinAux["quick_tip"] = "Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica formas.";
        $checkinsArr[] = new CheckIn($arrCheckinAux);
        $checkinsArr[] = new CheckIn($arrCheckinAux);
        $checkinsArr[] = new CheckIn($arrCheckinAux);
        $arrListingAux["level"] = $level;
        
        /**
        * This variable is used on view_listing_summary.php
        */
        if (TWILIO_APP_ENABLED == "on"){
            if (TWILIO_APP_ENABLED_SMS == "on"){
                $levelsWithSendPhone = system_retrieveLevelsWithInfoEnabled("has_sms");
            }else{
                $levelsWithSendPhone = false;
            }
            if (TWILIO_APP_ENABLED_CALL == "on"){
                $levelsWithClicktoCall = system_retrieveLevelsWithInfoEnabled("has_call");
            }else{
                $levelsWithClicktoCall = false;
            }
        }else{
            $levelsWithSendPhone = false;
            $levelsWithClicktoCall = false;
        }
        unset($arrCheckinAux);

        $listing->makeFromRow($arrListingAux);
        $moduleObj = $listing;
        
        $label = system_showText(LANG_LISTING_FEATURE_NAME)." ".ucfirst($levelObj->getName($level));
        
    } elseif ($modulePreview == "event") {
        
        $event = new Event();
        unset($levelObj);
        $levelObj = new EventLevel();
        
        $tPreview = "preview";

        $arrEventAux["title"] = system_showText(LANG_LABEL_ADVERTISE_EVENT_TITLE);
        $arrEventAux["email"] = system_showText(LANG_LABEL_ADVERTISE_ITEM_EMAIL);
        $arrEventAux["url"] = system_showText(LANG_LABEL_ADVERTISE_ITEM_SITE);
        $arrEventAux["contact_name"] = system_showText(LANG_LABEL_ADVERTISE_ITEM_CONTACT);
        $arrEventAux["address"] = system_showText(LANG_LABEL_ADVERTISE_ITEM_ADDRESS);
        $arrEventAux["zip_code"] = ucwords(system_showText(LANG_LABEL_ADVERTISE_ITEM_ZIPCODE));
        $arrEventAux["video_snippet"] = "<img src=\"".THEMEFILE_URL."/".EDIR_THEME."/images/imagery/img-video-sample.jpg\" alt=\"\" title=\"\"/>";
        $arrEventAux["start_date"] = date("Y-m-d");
        $arrEventAux["has_start_time"] = "y";
        $arrEventAux["start_time"] = "08:00:00";
        $arrEventAux["end_date"] = date("Y-m-d", time() + (30 * 24 * 60 * 60));
        $arrEventAux["has_end_time"] = "y";
        $arrEventAux["end_time"] = "12:00:00";
        $arrEventAux["phone"] = "000.000.0000";
        $arrEventAux["description"] = "Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas.";
        $arrEventAux["long_description"] = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque luctus enim ac diam malesuada vestibulum vitae at tortor. Nullam nec porttitor arcu. Pellentesque laoreet lorem egestas felis lobortis eu tincidunt nulla tempor. Phasellus adipiscing fringilla tempus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Curabitur sed sapien ut eros porta volutpat et quis leo. Aenean tincidunt ipsum quis nisl blandit nec placerat eros consectetur. Morbi convallis, est quis venenatis fermentum, sapien nibh auctor arcu, auctor mattis justo nisi tincidunt neque. Quisque cursus luctus congue. Quisque vel nulla vitae arcu faucibus placerat. Curabitur iaculis molestie sagittis.";
        $arrEventAux["level"] = $level;
        
		$event->makeFromRow($arrEventAux);
		$moduleObj = $event;
        
        $label = system_showText(LANG_EVENT_FEATURE_NAME)." ".ucfirst($levelObj->getName($level));
        
    } elseif ($modulePreview == "classified") {
        
        $classified = new Classified();
        unset($levelObj);
        $levelObj = new ClassifiedLevel();
        
        $tPreview = "preview";

        $arrClassifiedAux["title"] = system_showText(LANG_LABEL_ADVERTISE_CLASSIFIED_TITLE);
        $arrClassifiedAux["email"] = system_showText(LANG_LABEL_ADVERTISE_ITEM_EMAIL);
        $arrClassifiedAux["url"] = system_showText(LANG_LABEL_ADVERTISE_ITEM_SITE);
        $arrClassifiedAux["contactname"] = system_showText(LANG_LABEL_ADVERTISE_ITEM_CONTACT);
        $arrClassifiedAux["address"] = system_showText(LANG_LABEL_ADVERTISE_ITEM_ADDRESS);
        $arrClassifiedAux["zip_code"] = ucwords(system_showText(LANG_LABEL_ADVERTISE_ITEM_ZIPCODE));
        $arrClassifiedAux["classified_price"] = "100.00";
        $arrClassifiedAux["phone"] = "000.000.0000";
        $arrClassifiedAux["fax"] = "000.000.0000";
        $arrClassifiedAux["summarydesc"] = "Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas.";
        $arrClassifiedAux["detaildesc"] = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque luctus enim ac diam malesuada vestibulum vitae at tortor. Nullam nec porttitor arcu. Pellentesque laoreet lorem egestas felis lobortis eu tincidunt nulla tempor. Phasellus adipiscing fringilla tempus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Curabitur sed sapien ut eros porta volutpat et quis leo. Aenean tincidunt ipsum quis nisl blandit nec placerat eros consectetur. Morbi convallis, est quis venenatis fermentum, sapien nibh auctor arcu, auctor mattis justo nisi tincidunt neque. Quisque cursus luctus congue. Quisque vel nulla vitae arcu faucibus placerat. Curabitur iaculis molestie sagittis.";
        $arrClassifiedAux["level"] = $level;
        
        $classified->makeFromRow($arrClassifiedAux);
		$moduleObj = $classified;
        
        $label = system_showText(LANG_CLASSIFIED_FEATURE_NAME)." ".ucfirst($levelObj->getName($level));
        
    } elseif ($modulePreview == "article") {
        
        $article = new Article();
        unset($levelObj);
        $levelObj = new ArticleLevel();
        
        $tPreview = "preview";
	
        $arrArticleAux["title"] = system_showText(LANG_LABEL_ADVERTISE_ARTICLE_TITLE); 
        $arrArticleAux["author"] = system_showText(LANG_LABEL_ADVERTISE_ARTICLE_AUTHOR);
        $arrArticleAux["author_url"] = system_showText(LANG_LABEL_ADVERTISE_ITEM_SITE);
        $arrArticleAux["publication_date"] = date("Y-m-d");
        $arrArticleAux["abstract"] = "Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas."; 
        $arrArticleAux["content"] = "<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque luctus enim ac diam malesuada vestibulum vitae at tortor. Nullam nec porttitor arcu. Pellentesque laoreet lorem egestas felis lobortis eu tincidunt nulla tempor. Phasellus adipiscing fringilla tempus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Curabitur sed sapien ut eros porta volutpat et quis leo. Aenean tincidunt ipsum quis nisl blandit nec placerat eros consectetur. Morbi convallis, est quis venenatis fermentum, sapien nibh auctor arcu, auctor mattis justo nisi tincidunt neque. Quisque cursus luctus congue. Quisque vel nulla vitae arcu faucibus placerat. Curabitur iaculis molestie sagittis.</p>"; 
        $arrArticleAux["level"] = $level;
        
        $article->makeFromRow($arrArticleAux);
		$moduleObj = $article;
        
        $label = system_showText(LANG_ARTICLE_FEATURE_NAME);
        
    } elseif ($modulePreview == "banner") {
        
        unset($levelObj);
        $levelObj = new BannerLevel();
        
        $auxName = string_strtolower($levelObj->getName($level, true));
		$auxName = str_replace(" ", "", $auxName);
        
        if (file_exists(EDIRECTORY_ROOT."/images/content/img_ad_banner_".$auxName."_".EDIR_THEME.".gif")){
            $bannerImgScr = DEFAULT_URL."/images/content/img_ad_banner_".$auxName."_".EDIR_THEME.".gif";
        } else {
            $bannerImgScr = DEFAULT_URL."/images/content/img_ad_banner_".$auxName.".gif";
        }
        
        $label = system_showText(LANG_BANNER_FEATURE_NAME)." ".ucfirst($levelObj->getName($level));
        
    } else {
        exit;
    }
	
    $level = $levelObj;
?>