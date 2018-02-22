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
include(EDIRECTORY_ROOT."/includes/code/featured_review.php");

?>

<? if (is_array($featuredReviews) && count($featuredReviews) > 0) : ?>
<?

    
    setting_get( 'listing_detail_show_facebook', $show_facebook);
    setting_get( 'listing_detail_show_twitter', $show_twitter);


if($show_facebook == "on" || $show_twitter == "on"){ //RecentReviews: Display on Bottom :: && (!empty($listingtemplate_twpage) || !empty($listingtemplate_fbpage) || !empty($listingtemplate_twid)
?>
</div><!--sm4-->
</div><!--sm4row-->
<section class="recentReview-footer row">
        <!-- <div class="container"> -->
            <div class="col-sm-12">
            <div class="thumbnail custhumbnail">
                <div class="col-sm-12">
                    <h5 class="footerReview text-left"><?=system_showText(LANG_RECENT_REVIEWS)?>sfsfsfdsfsd</h5>
                    <? foreach ($featuredReviews as $featureReview) :?>
                
                       
                    <div class="col-sm-6 col-md-6 col-lg-3">
                    <div class="thumbnail businessDetail businessDetail1 fixedheight1">
                        <img src="<?=getImageUrl( $featureReview );?>" class="img-circle detailImage" width="60" height="60" alt="img1" />
                              <div class="abc">
                                <h4 class="footer-hreview">
                                    <a href="<?=$featureReview['detailItemLink']?>">
                                        <em><?=system_showTruncatedText($featureReview["title"],20);?></em>
                                        <?
                                            //This was the previous text truncation without using function
                                            // echo substr($featureReview["title"], 0, 20);
                                            //         if (strlen($featureReview["title"]) > 20){
                                            //             echo "...";
                                            //         }
                                        ?>
                                    </a>
                                </h4>
                                
                                 <?  $str=$featureReview["reviewer_name"];
                                     $res = preg_replace('/<\/?a[^>]*>(.+)<\/a>/', '${1}', $str); ?>



                        </div>
                        <?= display_star_rating($featureReview['avg_review'], "resstartwrapper starwrapper4", "starwrapper3" )?>
                        
            <!--            <span class="rev"> <a href="#">5 reviews</a></span>-->
                        <strong><br/><?=system_showTruncatedText(ucwords($featureReview["review_title"]),30);//=$featureReview["review_title"]?></strong>
                        <p><?= system_showTruncatedText($featureReview["review"],65)?>
                        <?
                                        //echo substr($featureReview["review"], 0, 20);
                                        //if (strlen($featureReview["review"]) > 20){
                                            //echo "...";
                                        //}
                        ?>
                        </p>

                                <span class="reviewedBy">Reviewed by:<strong>
                                <?
                                            echo substr($res, 0, 12);
                                            if (strlen($res) > 12){
                                                echo "...";
                                            }
                                ?>
                                </strong></span>
                    
                    </div><!-- end businessDetail-->

                     </div>
                        

                    <? endforeach; ?>

                </div>
            </div><!--/thumbnail-->
            </div>
    <!-- </div> -->
</section>
<? } else { //RecentReviews:Display on side ?>

<div class="thumbnail custhumbnail detailpage-sidereview">
    <div class="col-sm-12">
        <h5 class="rr"><?=system_showText(LANG_RECENT_REVIEWS)?></h5>
        
        <? foreach ($featuredReviews as $featureReview) :?>
        <div class="thumbnail businessDetail">
           
            <img src="<?=getImageUrl( $featureReview );?>" class="img-circle detailImage" width="96" height="95" alt="img1" />
                  <div class="abc">
                    <h4>
                        <a href="<?=$featureReview['detailItemLink']?>">
                            <em><?=$featureReview["title"];?></em>
                        </a>
                    </h4>
                    
                     <?  $str=$featureReview["reviewer_name"];
                         $res = preg_replace('/<\/?a[^>]*>(.+)<\/a>/', '${1}', $str); ?>

                    <span>Reviewed & Rated by: <strong><?=$res?></strong></span>


            </div>
            <?=  display_star_rating( $featureReview['avg_review'] )?>
            
<!--            <span class="rev"> <a href="#">5 reviews</a></span>-->
            <strong><?=  ucwords($featureReview["review_title"])?></strong>
            <p><?=$featureReview["review"]?></p>
        
        </div><!-- end businessDetail-->
        <? endforeach; ?>
            
    </div>
</div><!--/thumbnail-->

<? } ?>
<? endif; ?>
