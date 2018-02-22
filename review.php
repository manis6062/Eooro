

	

	<?php
	include_once('conf/loadconfig.inc.php');

    $reviewId 	= $_GET['id'];
	$reviewObj  = new Review($reviewId);
		
    if(!$reviewObj->id){
    	$goto = DEFAULT_URL;
    	header("Location: ".$goto);
    }

	$listingObj  		   = new Listing($reviewObj->item_id); 
	$imageObjOwner 	 	   = new Image($listingObj->image_id);
	$accountProfileContact = new AccountProfileContact(1, $reviewObj->member_id);
	$imageObjReviewer 	   = new Image($accountProfileContact->image_id, true);


    if ($imageObjOwner->imageExists()) {
        $imgOwner = $imageObjOwner->getTag(true, "100", "100");
		$mainImage = DEFAULT_URL."/custom/domain_1/image_files/".$imageObjOwner->prefix."photo_".$imageObjOwner->id.".".string_strtolower($imageObjOwner->type);
    } else {
        $imgOwner =  "<div class=\"profile-noimage\"><img src='".DEFAULT_URL."/images/profile_noimage.png'></div>";
    }

    if ($imageObjReviewer->imageExists()) {
        $imgReviewer = $imageObjReviewer->getTag(true, "100", "100");
    } else {
        $imgReviewer =  "<div class=\"profile-noimage\"><img src='".DEFAULT_URL."/images/profile_noimage.png'></div>";
    }
	$rating = $reviewObj->rating;

	if(!file_exists($mainImage))
        $mainImage = DEFAULT_URL. "/custom/domain_1/theme/review/images/share-noimage.jpg";		

    include(system_getFrontendPath("header.php", "layout"));
    include(system_getFrontendPath("review_banner.php"));

	// establishing parameters for Recent Reviews of buttom coming from featured_review.php
	$fromReview        = true; 
	$review_enabled    = 'on';
	$commenting_edir   = true;
	$levelsWithReview  = true;
	$module_review	   = 'listing';
	$levelsWithReview  = array(10);
    $levelObj = new ListingLevel();

	 ?>
	 <section class="latest-review cusreview">
		<div class="container">
				<div class="thumbnail custhumbnail widget-thumnail">
					<div class="col-sm-12">
						<div class="row">
							<div class="col-sm-6">
								<h2 class="sabayjai"><a rel="canonical" href="<?php echo DEFAULT_URL.'/company-reviews/'.$listingObj->friendly_url;   ?>"><?php   echo htmlentities($listingObj->title);  ?></a></h2>
								<?php echo displayratingsmall($listingObj->avg_review, 'resstartwrapper', 'starwrapper3'); ?>
									<font size="2px" style="font-weight:normal;color:#000;">
                            			<?php echo '('.$listingObj->data_in_array['review_count'].' reviews)'; ?>                            
                           			</font>
		           					
								<span class="ratin"><?php echo '('.$listingObj->avg_review.' out of 5)'; ?> </span>
							</div> 
							<div class="col-sm-3">
							<?php 
							// for social media icons
							$listing = (array)$listingObj; 
							$user = true;
							include_once("includes/views/icon_listing.php");
							echo $share_navbar;
							  ?>
							  	<!--for contact this bussiness-->
                      			<!--<span class="fax web">
                                    <a rel="nofollow" href="http://www.eooro.com/popup/popup.php?pop_type=listing_emailform&amp;id=11028725&amp;receiver=owner" class="fancy_window_tofriend">Contact this Listing</a>
                                </span>-->
                			</div>
                			 
						</div> <!-- /row -->
					</div> <!-- /col-sm-12 -->
					<div class="col-sm-12">
							<div>
							   <a class="pull-left widgetImage" href ="#">
	                    			<?php echo $imgReviewer;  ?>
							   </a>
							   
							   <div class="media-body widget-media-Wrapper">
							      <h3 class="media-heading-widget"><?php echo htmlentities($reviewObj->review_title);  ?></h3>
							      	<div class="startwrapper resstartwrapper inlineBlock">
								<?php for($i=0;$i<$rating;$i++) {  ?>
									<div class="starwrapperGreen starwrapper3">
										<i class="fa fa-star"></i>
									</div>
									<?php } ?>
								<?php for($i=0;$i<(5-$rating);$i++) {  ?>
									<div class="starwrapper white starwrapper3">
										<i class="fa fa-star"></i>
									</div>
									<?php } ?>
							    	</div>
							    	<strong><span><?php echo htmlentities($reviewObj->reviewer_name);  ?></span></strong>
							    	<em>on&nbsp;<?php echo date('d M Y', strtotime($reviewObj->added));   ?></em>
							      		<p class="inner-reply"><?php echo nl2br(htmlentities($reviewObj->review));  ?></p>

							    <?php if($reviewObj->response) { ?>
								<div class="media-wrapper-widget">		
							      <div class = "media">
							         <a class = "pull-left widgetImage" href = "#" style="display:none;">
	                    			<?php echo $imgOwner;  ?>
							         </a>
							         
							         <div class = "media-body">
							            <h3 class="media-heading-widget ">Reply from <?php echo htmlspecialchars($listingObj->title);  ?></h3>
							            	<p class="inner-reply"><?php echo nl2br(htmlentities($reviewObj->response));  ?></p>
							         </div>
										
							      </div>
							      
							      </div>
							      <?php } ?>
							   </div>
							   </div>
						
						</div>
			
				</div><!-- /thumbnail custhumbnail -->
						<?php
					    include(system_getFrontendPath("recent_review_horizontal.php", "frontend", false, LISTING_EDIRECTORY_ROOT)); 
						?>
		</div> <!-- /container -->
		</section>
<?php 
    include(system_getFrontendPath("footer.php", "layout"));
?>

<style type="text/css">
	.footer-atbottom {
		background-color: #f9f9f9;
	}
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
