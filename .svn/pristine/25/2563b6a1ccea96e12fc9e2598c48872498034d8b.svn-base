<?php
/* ==================================================================*\
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
  \*================================================================== */

# ----------------------------------------------------------------------------------------------------
# * FILE: /includes/code/featured_review.php
# ----------------------------------------------------------------------------------------------------

if (ACTUAL_MODULE_FOLDER == LISTING_FEATURE_FOLDER || ACTUAL_MODULE_FOLDER == "" || (!defined("ACTUAL_MODULE_FOLDER") && string_strpos($_SERVER["REQUEST_URI"], "results.php") !== false)) {
    $module_review = "listing";
    $levelsWithReview = system_retrieveLevelsWithInfoEnabled("has_review");
    $levelObj = new ListingLevel();
} elseif (ACTUAL_MODULE_FOLDER == PROMOTION_FEATURE_FOLDER) {
    $module_review = "promotion";
    $levelsWithReview = true;
    $levelObj = new ListingLevel();
    $levels = $levelObj->getLevelValues();
    unset($allowed_levels);
    foreach ($levels as $each_level) {
        if (($levelObj->getActive($each_level) == 'y') && ($levelObj->getHasPromotion($each_level) == 'y' )) {
            $allowed_levels[] = $each_level;
        }
    }

    $search_levels = ($allowed_levels ? implode(",", $allowed_levels) : "0");
} elseif (ACTUAL_MODULE_FOLDER == ARTICLE_FEATURE_FOLDER) {
    $module_review = "article";
    $levelsWithReview = true;
}

if (!$fromReview) {
    setting_get("commenting_edir", $commenting_edir);
    setting_get("review_{$module_review}_enabled", $review_enabled);
}

$featuredReviews = array();
$count = 0;



if ($review_enabled == "on" && $commenting_edir && $levelsWithReview) {

    # ----------------------------------------------------------------------------------------------------
    # LIMIT
    # ----------------------------------------------------------------------------------------------------

    $lastItemStyle = 0;
    $numberOfReviews = ($numberOfReviews ? $numberOfReviews : 3);
    $reviewMaxSize = 120;

    # ----------------------------------------------------------------------------------------------------
    # CODE
    # ----------------------------------------------------------------------------------------------------


    $mainDBName = DBConnection::getInstance()->getMainDatabaseName();
    $domainDBName = DBConnection::getInstance()->getDomainDatabaseName();

    $dbObjMain = DBConnection::getInstance()->getMain();
    $dbObjDomain = DBConnection::getInstance()->getDomain();

    $sql = "SELECT item_id,
					member_id,
					added,
					reviewer_name,
					reviewer_location,
					review_title,
					review,
					rating,
                    Review.id as revId,
					Account.image_id,
					Account.facebook_image,
					Account.has_profile,";


    if ($module_review == "listing") {
        $table = FORCE_SECOND ? " Listing_Summary" : " Listing";
        $country = CountryLoader::getCountryId();
        $location_geo_id = $country ? $table . '.location_1=' . CountryLoader::getCountryId() . ' AND ' : '';
        $location_state_id = $country ? (CountryLoader::getStateId($country) ? $table . '.location_3=' . CountryLoader::getStateId($country) . ' AND ' : '') : '';

        $levelsWithReviews = implode(",", $levelsWithReview);
        $sql.="Acc.active,";
        $sql .= "" . (FORCE_SECOND ? "Listing_Summary" : "Listing") . ".id,
                            " . (FORCE_SECOND ? "Listing_Summary" : "Listing") . ".title,
                            " . (FORCE_SECOND ? "Listing_Summary" : "Listing") . ".friendly_url,
                            " . (FORCE_SECOND ? "Listing_Summary" : "Listing") . ".level
            FROM Review
            LEFT OUTER JOIN {$mainDBName}.Account Acc on Review.member_id = Acc.id
            LEFT OUTER JOIN {$domainDBName}.Opened_Cases oc on Review.id = oc.review_id
            INNER JOIN  " . (FORCE_SECOND ? "Listing_Summary" : "Listing") . " ON Review.item_id = " . (FORCE_SECOND ? "Listing_Summary" : "Listing") . ".id
            LEFT JOIN AccountProfileContact Account ON (Account.account_id = member_id) 
            WHERE item_type = 'listing' AND Review.status = 'A' AND Acc.active = 'y' AND is_deleted = 0 AND ifnull(oc.case_status, '') != 'A' AND
                  approved = 1 AND 
                  " . (FORCE_SECOND ? "Listing_Summary" : "Listing") . ".status = 'A' AND 
                  " . $location_geo_id . $location_state_id
                . (FORCE_SECOND ? "Listing_Summary" : "Listing") . ".level IN (:levelsWithReview) ORDER BY " . ($randomReview ? "RAND()" : "added DESC") . " LIMIT " . $numberOfReviews;
        $sql = $dbObjDomain->prepare_wherein($sql, ':levelsWithReview', $levelsWithReviews);
    } elseif ($module_review == "article") {

        $sql .= "   Article.id,
                        Article.title,
                        Article.friendly_url
                      FROM Review
                    INNER JOIN  Article ON Review.item_id = Article.id
                    LEFT JOIN AccountProfileContact Account ON (Account.account_id = member_id)
                    WHERE item_type = 'article' AND Review.status = 'A' AND approved = 1 AND Article.status = 'A' ORDER BY added DESC LIMIT " . $numberOfReviews;
        $sql=$dbObjDomain->prepare($sql);
    } elseif ($module_review == "promotion") {

        $visibility_start = date('H') * 60 + date('i');
        $visibility_end = date('H') * 60 + date('i');

        $sql .= "   Promotion.id,
                        Promotion.name AS title,
                        Promotion.friendly_url
                    FROM Review
                    INNER JOIN  Promotion ON Review.item_id = Promotion.id
                    LEFT JOIN AccountProfileContact Account ON (Account.account_id = member_id)
                    WHERE item_type = 'promotion' AND
                    AND Review.status = 'A'
                    approved = 1 AND 
                    Promotion.listing_id > 0 AND 
                    Promotion.listing_status = 'A' AND 
                    Promotion.end_date >= DATE_FORMAT(NOW(), '%Y-%m-%d') AND 
                    Promotion.start_date <= DATE_FORMAT(NOW(), '%Y-%m-%d') AND
                    ((Promotion.visibility_start <= $visibility_start AND Promotion.visibility_end >= $visibility_end ) OR (Promotion.visibility_start = 24 AND Promotion.visibility_end = 24)) AND
                    Promotion.listing_level IN (:search_levels)
                    ORDER BY added DESC LIMIT " . $numberOfReviews;
        $sql = $dbObjDomain->prepare_wherein($sql, ':search_levels', $search_levels);
    }


    $result = $sql->execute();
    $row_count = $sql->rowCount();

    if ($getTotalReviews) {
        $sqlTotal = str_replace("ORDER BY RAND()", "", $sql);
        $sqlTotal = str_replace("LIMIT " . $numberOfReviews, "", $sqlTotal);
        $sqlTotal_result = $sqlTotal->execute();
        $totalReviews = $sqlTotal_result->rowCount();
    }

    if ($row_count) {
        while ($row = $sql->fetch(\PDO::FETCH_ASSOC)) {
            /**
             * modification
             */
            $account = new Account($row["member_id"]);
            $profile = new Profile($row["member_id"]);
            $contact = db_getFromDB("contact", "account_id", db_formatNumber($row["member_id"]), "1");

            $lastItemStyle++;

            if ($lastItemStyle == 1) {
                $itemStyle = "first";
            } elseif ($lastItemStyle == 3) {
                $itemStyle = "last";
            } else {
                $itemStyle = "";
            }

            $featuredReviews[$count]["style"] = $itemStyle;

            if (SOCIALNETWORK_FEATURE == "on") {
                if ($row["member_id"] && $row["has_profile"] == "y") {
                    $imgTag = socialnetwork_writeLink($row["member_id"], "profile", "general_see_profile", $row["image_id"], false, false, "", true, "", false, $account, $profile, $contact);
                    $featuredReviews[$count]["image"] = $imgTag;
                    if (!$imgTag) {
                        $featuredReviews[$count]["image"] = "<span class=\"no-image no-link\"></span>";
                    }
                } else {
                    $featuredReviews[$count]["image"] = "<span class=\"no-image no-link\"></span>";
                }
            }

            $rate_stars = "";
            if ($row["rating"]) {
                for ($x = 0; $x < 5; $x++) {
                    if ($row["rating"] > $x)
                        $rate_stars .= "<img src=\"" . THEMEFILE_URL . "/" . EDIR_THEME . "/images/iconography/img_rateMiniStarOn.png\" alt=\"Star On\" align=\"bottom\" />";
                    else
                        $rate_stars .= "<img src=\"" . THEMEFILE_URL . "/" . EDIR_THEME . "/images/iconography/img_rateMiniStarOff.png\" alt=\"Star Off\" align=\"bottom\" />";
                }
            }



            $featuredReviews[$count]["stars"] = $rate_stars;

            $featuredReviews[$count]["stars"] = $rate_stars;

            $featuredReviews[$count]["avg_review"] = $row["rating"];

            $detailLink = "" . constant(strtoupper($module_review) . "_DEFAULT_URL") . "/" . ALIAS_REVIEW_URL_DIVISOR . "/" . $row["friendly_url"];

            if ($module_review == "listing") {
                if ($levelObj->getDetail($row["level"]) == "y") {
                    $detailItemLink = "" . LISTING_DEFAULT_URL . "/" . $row["friendly_url"];
                } else {
                    $detailItemLink = "" . LISTING_DEFAULT_URL . "/results.php?id=" . $row["id"];
                }
            } else {
                $detailItemLink = "" . constant(strtoupper($module_review) . "_DEFAULT_URL") . "/" . $row["friendly_url"];
            }

            $featuredReviews[$count]["detailItemLink"] = $detailItemLink;
            $featuredReviews[$count]["detailLink"] = $detailLink;
            $featuredReviews[$count]["title"] = string_htmlentities($row["title"]);
            $featuredReviews[$count]["added"] = $row["added"];

            // Added to extract Review Title
            $featuredReviews[$count]["review_title"] = string_htmlentities($row["review_title"]);
            $featuredReviews[$count]["id"] = (($row["revId"]) ? string_htmlentities($row["revId"]) : system_showText(LANG_NA));

            $review = "";
            if (string_strlen(trim($row["review"])) > 0) {
                $review .= ($fullReview ? $row["review"] : system_showTruncatedText($row["review"], $reviewMaxSize));
            }

            $featuredReviews[$count]["review"] = $review;

            $str_time = format_getTimeString($row["added"]);

            $membersStr = "";
            if ($row["member_id"]) { //echo 'yes'. $row['member_id'];
                $membersStr = socialnetwork_writeLink($row["member_id"], "profile", "general_see_profile", false, false, false, "", true, "", false, $account, $profile, $contact);

                if ($membersStr) {
                    $featuredReviews[$count]["reviewer_name"] = (($row["reviewer_name"]) ? string_htmlentities($row["reviewer_name"]) : system_showText(LANG_NA));
                } else {
                    $featuredReviews[$count]["reviewer_name"] = (($row["reviewer_name"]) ? string_htmlentities($row["reviewer_name"]) : system_showText(LANG_NA));
                }
            } else {
                $featuredReviews[$count]["reviewer_name"] = (($row["reviewer_name"]) ? string_htmlentities($row["reviewer_name"]) : system_showText(LANG_NA));
            }
            $featuredReviews[$count]["reviewer_location"] = (($row["reviewer_location"]) ? string_htmlentities($row["reviewer_location"]) : system_showText(LANG_NA));
            $featuredReviews[$count]["date"] = format_date($row["added"], DEFAULT_DATE_FORMAT, "datetime") . " - " . $str_time;
            $featuredReviews[$count]["date_notime"] = format_date($row["added"], DEFAULT_DATE_FORMAT, "datetime");
            // modification
            $featuredReviews[$count]['facebook_image'] = $row["facebook_image"];
            $featuredReviews[$count]['image_id'] = $row["image_id"];
            $count++;
        }
    }
}
?>