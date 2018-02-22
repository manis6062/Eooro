<?php
unset($listings);
$table = FORCE_SECOND ? " Listing_Summary" : " Listing";
        $location_geo_id    = ' location_1='.$country['id'];
        $location_3_case = "Listing_Summary.location_3 <> 0 AND ";
        $levelsWithReview = system_retrieveLevelsWithInfoEnabled("has_review");
$Main = db_getDBObject(DEFAULT_DB, true);
$array = (array) $Main;

if($global == true) {
    $location_geo_id = " custom_checkbox1= 'y' ";  
    $location_3_case = '';
}

$searchReturn["from_tables"] = "Review| LEFT OUTER JOIN {$array['db_name']}.Account Acc on Review.member_id = Acc.id LEFT JOIN AccountProfileContact Account ON (Account.account_id = member_id) INNER JOIN  ".(FORCE_SECOND ? "Listing_Summary" : "Listing")." ON Review.item_id = ".(FORCE_SECOND ? "Listing_Summary" : "Listing").".id";
$screen=$_POST['screen'];
$aux_items_per_page=10;
$searchReturn["where_clause"]= "item_type = 'listing' AND Acc.active = 'y' AND
                  approved = 1 AND Review.is_deleted='0' AND Review.approved = '1' AND Review.review IS NOT NULL AND Review.review != '' AND Review.status = 'A' AND 
                  Listing_Summary.status in ('A', 'P', 'E') AND "
                  .$location_3_case
                  .$location_geo_id.' AND ' 
                  .(FORCE_SECOND ? "Listing_Summary" : "Listing").".level IN (".implode(",", $levelsWithReview).")";
$searchReturn["order_by"]="added DESC";
$searchReturn["select_columns"]="item_id,
				member_id,
				added,
				reviewer_name,
				reviewer_location,
				review_title,
				review,
				rating,
                               Listing_Summary.title,
                                Listing_Summary.friendly_url,
                                Listing_Summary.location_3_title,
                                Listing_Summary.avg_review";
        //for pageBrowsing                        
        $pageObj = new pageBrowsing($searchReturn["from_tables"], 
        $screen, 
        $aux_items_per_page, 
        $searchReturn["order_by"], 
        false, 
        false, 
        $searchReturn["where_clause"], 
        $searchReturn["select_columns"], 
        false);
        //for retrieving Page 
        $listings = $pageObj->retrievePage("array",$searchReturn["total_listings"]);