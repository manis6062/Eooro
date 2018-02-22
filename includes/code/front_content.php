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
	# * FILE: /includes/code/front_content.php
	# ----------------------------------------------------------------------------------------------------

    //Reviews
    $numberOfReviews = 1;
    $randomReview = true;

    $addHomeSidebar = false;

    //Prepare Newsletter
	include(EDIRECTORY_ROOT."/includes/code/newsletter.php");
    
    //Get special content
    setting_get("front_text_sidebar", $front_text_sidebar);
    setting_get("front_text_sidebar2", $front_text_sidebar2);
    setting_get("front_testimonial", $front_testimonial);
    setting_get("front_testimonial_author", $front_testimonial_author);
    setting_get("twitter_widget", $twitter_widget);
    
    if ($showNewsletter || $front_text_sidebar || $front_text_sidebar2 || $front_testimonial || $front_testimonial_author) {
        $addHomeSidebar = true;
    }
    
    setting_get("front_review_counter", $front_review_counter);
    
    if ($front_review_counter != "on") {
        $numberOfReviews = 4;
    } else {
        $getTotalReviews = true;
    }

?>