<style type="text/css">
    section.recentReview-footer .thumbnail.custhumbnail {
        border: none;
        background-color: transparent;
}
@media (max-width: 767px) {
    section.recentReview-footer .thumbnail.custhumbnail {
        display: none;
    }
}
</style>

<?
$numberOfReviews = 4;
$randomReview    = true;
//include(EDIRECTORY_ROOT.'/includes/code/featured_review.php')

?>

<?// if (is_array($featuredReviews) && count($featuredReviews) > 0) : ?>
<?

    
    setting_get( 'listing_detail_show_facebook', $show_facebook);
    setting_get( 'listing_detail_show_twitter', $show_twitter);


if($show_facebook == "on" || $show_twitter == "on"){ //RecentReviews: Display on Bottom :: && (!empty($listingtemplate_twpage) || !empty($listingtemplate_fbpage) || !empty($listingtemplate_twid)
?>
</div><!--sm4-->
</div><!--sm4row-->
<?php include(EDIRECTORY_ROOT.'/custom/domain_1/theme/review/frontend/recent_review_horizontal.php'); ?>

    <!-- </div> -->
</section>
<? } else { //RecentReviews:Display on side ?>
<?php include(EDIRECTORY_ROOT.'/custom/domain_1/theme/review/frontend/recent_review_vertical.php'); ?>

<? } ?>
<?// endif; ?>

<?php 
//$listing_id = $_GET['id'];
//$listing_details = Listing::GetListingDetails($listing_id);
//var_dump($listing_details);

?>


<!--<h5> Business Category :</h5>-->
<!--<p> Business Location :  </p> -->
    <?php //echo $locationn_3 . ',' . $locationn_4 ?>
