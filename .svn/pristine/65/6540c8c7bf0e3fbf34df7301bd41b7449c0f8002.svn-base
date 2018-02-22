<?php
 
 

$numberOfReviews = 6;
$randomReview    = false;
include(EDIRECTORY_ROOT."/includes/code/featured_review.php");

if ( !$randomReview && count($featuredReviews) >= 2 && count($featuredReviews) <= 4 ) {
    $keys = array_rand( $featuredReviews, 2 );
    $featuredReviews = array_intersect_key( $featuredReviews, array_flip($keys) );
}
else if( !$randomReview && count($featuredReviews) > 4 ){
    $keys = array_rand( $featuredReviews, 4 );
    $featuredReviews = array_intersect_key( $featuredReviews, array_flip($keys) );
}
else {
    $featuredReviews = null;
}
?>

<? if (is_array($featuredReviews) && count($featuredReviews) > 0) : ?>
<section class="latest-review">
    <div class="container">
        <div class="row">
            <h3><?=system_showText(LANG_RECENT_REVIEWS)?></h3>
        </div>
        <?php $revNo = 0; // to display in two rows ?>

        <? foreach ($featuredReviews as $featureReview) :?>
        <? $review_title = $featureReview["review_title"];
           $review_title1 = $featureReview["review_title"];
           $review_len = strlen($review_title1); 
           if($review_len>47){
                $review_title1 = substr($review_title1,0,44);
                $review_title1 = $review_title1."...";
                // $dot = "...";

                // $review_title2 = substr($review_title,-7);
           }
           // else{ $dot = ""; $review_title2=""; }

         ?>
            <?=( $revNo%2 === 0 ) ? '<div class="row mbottom">' : '' ?>
                <div class="col-sm-6">
                    <div class="thumbnail fixedheight" itemscope itemtype="http://schema.org/Review" >
                        <img src="<?=getImageUrl( $featureReview );?>" class="img-circle" width="115" height="115" alt="img1" />
                        <div class="abc">
                            <?  $str=$featureReview["reviewer_name"];
                                
                                $res = preg_replace('/<\/?a[^>]*>(.+)<\/a>/', '${1}', $str);
                                
                                ?>
                           <div itemprop="itemReviewed" itemscope itemtype="http://schema.org/LocalBusiness">     
                            <h4 itemprop="name">
                                <a href="<?=$featureReview['detailItemLink']?>">
                                    <em><?=stripcslashes($featureReview["title"]);?></em>
                                </a>
                            </h4>
                           </div> 
                            <span class="reviewed-rated" itemprop="author" itemscope itemtype="http://schema.org/Person">Reviewed & Rated by: 
                              <span itemprop="name"> 
                              <?  $reviewer = $res;
                                  $res_len = strlen($res);
                                  if($res_len>17){
                                    $res = substr($res,0,17)."...";
                                 ?>
                              </span>   
                            <span data-toggle="tooltip" data-placement="top" title="<?echo strip_tags($reviewer);?>">
                            <strong> <?=$res;?> </strong>
                            </span>
                            <? }else { $res = $reviewer;?>
                            <strong> <?=$res;?> </strong>
                            <? }?>
                            </span>

                        </div>
                           <div class="detail-page-review" itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating">
                              <?=  display_star_rating( $featureReview['avg_review'], null, 'recentreview-star' )?>
                              <meta itemprop="ratingValue" content="<?=$featureReview['avg_review'];?>"> 
                              <meta itemprop="bestRating" content="5">
                              <meta itemprop="reviewCount" content="12">
                           </div> 

								 <?// Review Title ?>
                         <span class="text" itemprop="name">

                            <? $review_title = ucwords($featureReview["review_title"]);
                            $review_len = strlen($review_title); 
                            if($review_len>47){
                                $review_title1 = system_showTruncatedText($review_title,44);
                                ?>
                            <span data-toggle="tooltip" data-placement="bottom" title="<?=htmlspecialchars_decode($review_title)?>">
                                <strong> <?=htmlspecialchars_decode($review_title1);?> </strong>
                            </span>
                            <?} else{?>
                             <span title="">
                                <strong> <?=htmlspecialchars_decode($review_title);?> </strong>
                            </span>
                            <?}?>
                            <!-- <span class="dot"><?=$dot?></span> -->
                           <!--  <span class="full-text" style="display:none">
                                <strong><?=ucwords($review_title2)?></strong>
                            </span> -->
                         </span>
<!--                        <div class="startwrapper">
                            <? //for( $i = 0; $i < $featureReview["avg_review"]; $i++ ) : ?>
                                    <div class="starwrapper">
                                       <i class="fa fa-star"></i>
                                    </div>
                            <? //endfor; ?>
                            <?// for( $i = 0; $i < 5 - $featureReview["avg_review"]; $i++ ) : ?>
                                    <div class="starwrapper">
                                       <i class="fa fa-star white"></i>
                                    </div>
                          http://www.eooro.com/  <? //endfor; ?>
                            <span class="rev"> <a href="#"><?//=$featureReview["avg_review"]?> reviews</a></span>
                        </div>-->
                        <p><?=stripcslashes($featureReview["review"]);?></p>

                         <meta itemprop="description" content="<?=$featureReview["review"];?>">
                    </div>
                </div>
            <?=( $revNo%2 === 1 ) ? '</div>' : '' ?>
            <? $revNo++; ?>
        <? endforeach; ?>
          
    </div>
</section>
<? endif; ?>

<? /* 
<script>

  // $(document).ready(function () {  
  //   //var someText = "...";
  //   $(".half-text").prop('title', 'This is the hover-over text');
  //   $('.text').hover(function() {
  //       var spans = $('.dot');
  //       spans.text('');
       
        
  //       $('.full-text', $(this)).slideToggle(100, 'linear').display(100, 'linear');     
  //   });
  //   //$('.full-text').append(document.createTextNode(someText));
  // });
//  $(function() {
// $( document ).tooltip();
// });

</script>
*/?>
<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
});
</script>