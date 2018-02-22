<?php include(EDIRECTORY_ROOT.'/custom/domain_1/theme/review/frontend/recent_review_queries.php'); ?>

<section class="recentReview-footer row">
        <!-- <div class="container"> -->
            <div class="col-sm-12">
               <div class="row">
            <div class="thumbnail custhumbnail">
                <div class="row">
                <div class="col-sm-12">
                    <h5 class="footerReview text-left"><?=system_showText(LANG_RECENT_REVIEWS)?></h5>
                    <? foreach ($featuredReviews as $featureReview) :?>
                
                       
                    <div class="col-sm-6 col-md-6 col-lg-3">
                     <div class="thumbnail businessDetail businessDetail1 fixedheight1">
                        <img src="<?=getImageUrl( $featureReview );?>" class="img-circle detailImage" width="60" height="60" alt="img1" />
                              <div class="abc">
                                <h4 class="footer-hreview">
                                    <a href="<?=$featureReview['detailItemLink']?>" title="<?php echo ucwords($featureReview["title"]);  ?>">
                                        <em><?=system_showTruncatedText(trim($featureReview["title"]),25, false, true);?></em>
                                        <?
                                        ?>
                                    </a>
                                </h4>
                                
                                 <?  $str=$featureReview["reviewer_name"];
                                     $res = preg_replace('/<\/?a[^>]*>(.+)<\/a>/', '${1}', $str); ?>



                        </div>
                        <?= display_star_rating($featureReview['avg_review'], "resstartwrapper starwrapper4", "starwrapper3" )?>
                        
                        <a href="<?php echo DEFAULT_URL.'/review.php'.'?id='.$featureReview["id"]; ?>" target="_blank">

                            <strong style="color:#000;"><br/><?=system_showTruncatedText(ucwords($featureReview["review_title"]),30, false, true);//=$featureReview["review_title"]?></strong>
                        <p><?= system_showTruncatedText($featureReview["review"],65, false, true)?>
                        <?
                        ?>
                        </p>
                        </a>
                                <span class="reviewedBy" title="<?php echo $res;  ?>"><strong><date><?php  echo date('d M Y', strtotime($featureReview['added'])); ?></date></strong>
                                    <br>
                                    <strong>    
                                <?
                                echo system_showTruncatedText($res,25, false, true);
                                ?>
                                </strong></span>
                    
                    </div><!-- end businessDetail-->

                     </div>
                        

                    <? endforeach; ?>

                </div>
                </div>
            </div><!--/thumbnail-->
            </div>
            </div>