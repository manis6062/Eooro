<?php

	#----------------------------------------
	#	View Locations Page
	#----------------------------------------

	$thePageTitle = '<h1 class="transparent-bg">'.$headertag_description.'</h1>';
	include(system_getFrontendPath("review_banner_contactus.php"));

	$page = ACTUAL_PAGE_NAME;
	$page = str_replace("listing", ALIAS_LISTING_MODULE, $page);
	$number_of_reuslts_per_column = 250;

	#----------------------------
	#		Reference
	#
	#	$country_data[0] = Country 
	#	$country_data[1] = /
	#	$country_data[2] = State
	#	$country_data[3] = / 
	#	$country_data[4] = City
	#----------------------------
?>
<section class="contact-form login review">
	<div class="row-fluid generalpage">
		<div class="container">

				<!-- Country  -->

				<? if(!$country_data[0] && !$country_data[1] && !$country_data[2] && !$country_data[3] && !$country_data[4]) { 

						$location1 	   = new Location1();
						$all_countries = $location1->retrieveAllLocation();
						?>
				
						<div class=" location-well view-location">
                                                    <h2 class="text-center" style="color:black;">Browse By <i class="fa fa-map-marker"></i> Location</h2>
							<hr class="location-hr">
							<div class="country-list text-center view-location-country-list">
<!--								<div class="col-sm-12">-->

									<? foreach ( $all_countries as $country ) { ?>

										
                                        <? 
                                        include(system_getFrontendPath('alllocation_trending.php'));
                                        include(system_getFrontendPath('alllocation_recentreviews.php'));
                                        ?>
									<? } 
									// show global businesses
									$global = true;
                                    include(system_getFrontendPath('alllocation_trending.php'));
                                    include(system_getFrontendPath('alllocation_recentreviews.php'));

									?>
								
<!--								</div>-->
							</div>

						</div>
				<? } ?>
				

				<!-- State / County  -->
				
				<? if($country_data[0] && $country_data[1] && !$country_data[2] && !$country_data[3] && !$country_data[4]) { 

					$friendly_url = $country_data[0];
					$location1 = new Location1();
					$id = $location1->getIdFromFriendlyURL($friendly_url);
                                        $id = !empty($id) ? $id : 'null';
					$location1Name = new Location1($id);

					//Pagination
					$number_of_results_per_page = $number_of_reuslts_per_column * 4; // 4 for four columns
					$total_entries 				= $location1->GiveMeLocation3Total($id);
					$paginates = ceil($total_entries / $number_of_results_per_page);

					$page_number  = isset($country_data[1]) ? $country_data[1] : 1;
					$page_number  = intval($page_number);
					if(isset($start_from) && $start_from >= 0){
						$start_from   = ($page_number * $number_of_results_per_page) - $number_of_results_per_page;
					}else{
                                            $start_from = 0;
                                        }

					$states = $location1->GiveMeLocation3($id, $start_from, $number_of_results_per_page);

					?>

								<div class=" location-well">
									<h2 class="text-center">Browse By <i class="fa fa-map-marker"></i> Location: <?=$location1Name->name?></h2>
									<hr class="location-hr">
									<div class="country-list text-center">
<!--										<div class="col-sm-12">-->

										<? if($states){
											
											foreach ( $states as $state ): ?>
											
												<div class="col-sm-3">
													
													<a href="<?=$page?>/<?=$friendly_url?>/<?=$state['friendly_url']?>/1"><?=$state['name']?></a>
												
												</div>
										
											<? endforeach; 

											//Pagination Buttons
							
											    $url = $page . '/' . $country_data[0] . "/";
											    $limit = 10;
											    $count = $page_number;
											    $this_page_no = $page_number;
											    $screen = 1;

											    $paginates < $limit ? $limit = $paginates : null;

											  	if( $total_entries > $number_of_results_per_page ) {

											   ?> 
<!--										</div>-->

									</div>

								</div>
				
								<div class="row text-center">
								
								<ul class="pagination plPagi">
											
											<li>       
								              <a href="<?=$url."1";?>">&laquo; Start</a>
								            </li>
								            
								            <li>       
								              <a href="<?=($this_page_no > 1 ? $this_page_no - 1 : null);?>">&laquo; Prev</a>
								            </li>

								            <? for($i = $page_number - 4 ; $i <= min($page_number + 9, $paginates); $i++) { ?>
								            	
								            		<li <?=($page_number == $i ? 'class="active"' : null)?>>

								            		<? if ($i > 0 && $page_number < 5 && $i <= 10 ) { ?>
						            					<a href="<?=$i?>">			
								            				<?=($i <= 10 ? $i : null)?>
								            			</a>

								            		<? } else { ?>

								            			<? if ( $i > 0 && $i < $page_number + 6) { ?>
										            			<a href="<?=($i)?>">			
										            				<?=$i?>
										            			</a>
									            		<? } ?>

								            		<? } ?>
								            
								            		</li>
								            <? } ?>

								            <li><a href="<?=(($this_page_no < $paginates) ? $url.($this_page_no + 1) : null);?>">&raquo; Next</a></li>

											<li>       
								              <a href="<?=$url.$paginates;?>">&raquo; End</a>
								            </li>

								</ul>
				
								<? } else { ?>
										</div>
									</div>
								</div>

								<? } ?>
								</div>

							<? } else { ?>

								No State / County found in this location.
				
							</div>
						</div>
					</div>
							
							<? } ?>
				
				<? } ?>


				<!-- Town / City Location  : 4 -->


				<? if($country_data[0] && $country_data[1] && $country_data[2] && !$country_data[3] && !$country_data[4]) { 

					$friendly_url 		= $country_data[0];
					$friendly_url_state = $country_data[1];
					
					//Extract Location 1 and 3
					$location1 	   = new Location1();
					$location_1_id = $location1->getIdFromFriendlyURL($friendly_url);
                                        $location_1_id = !empty($location_1_id) ? $location_1_id : 'null';
                                        
					$location3 	   = new Location3();
					$location_3_id = $location3->getIdFromFriendlyURL($friendly_url, $friendly_url_state);
                                        $location_3_id = !empty($location_3_id) ? $location_3_id : 'null';
					//Pagination
					$number_of_results_per_page = $number_of_reuslts_per_column * 4; // 4 for four columns
					$total_entries 				= $location1->GiveMeLocation4Total($location_1_id,$location_3_id);
					$paginates = ceil($total_entries / $number_of_results_per_page);

					$page_number  = isset($country_data[2]) ? $country_data[2] : 1;
					$page_number  = intval($page_number);
					$start_from   = ($page_number * $number_of_results_per_page) - $number_of_results_per_page;
					if($start_from >= 0){
						$cities = $location1->GiveMeLocation4($location_1_id,$location_3_id, $start_from, $number_of_results_per_page);
					}

					?>

								<div class="well location-well">
									<h2 class="text-center">Browse By <i class="fa fa-map-marker"></i> Location: <?=$loc1.", ".$locationName?></h2>
									<hr class="location-hr">
									<div class="country-list text-center">
<!--										<div class="col-sm-12">-->

										<? if($cities){
											
											foreach ( $cities as $city ): ?>
											
												<div class="col-sm-3">
													
													<a href="<?=$page?>/<?=$friendly_url?>/<?=$friendly_url_state?>/<?=$city['friendly_url']?>/1"><?=$city['name']?></a>
												
												</div>
										
											<? endforeach; 

											//Pagination Buttons
							
											    $url = $page . '/' . $country_data[0] . "/". $country_data[1] . "/";
											    $limit = 10;
											    $count = $page_number;
											    $this_page_no = $page_number;

											    $paginates < $limit ? $limit = $paginates : null;

											  	if( $total_entries > $number_of_results_per_page ) {

											   ?> 
<!--										</div>-->

									</div>

								</div>
				
								<div class="row text-center">
								<ul class="pagination plPagi">
											
											<li>       
								              <a href="<?=$url."1";?>">&laquo; Start</a>
								            </li>
								            
								            <li>       
								              <a href="<?=($this_page_no > 1 ? $this_page_no - 1 : null);?>">&laquo; Prev</a>
								            </li>

								            <? for($i = $page_number - 4 ; $i <= min($page_number + 9, $paginates); $i++) { ?>
								            	
								            		<li <?=($page_number == $i ? 'class="active"' : null)?>>

								            		<? if ($i > 0 && $page_number < 5 && $i <= 10 ) { ?>
						            					<a href="<?=$i?>">			
								            				<?=($i <= 10 ? $i : null)?>
								            			</a>

								            		<? } else { ?>

								            			<? if ( $i > 0 && $i < $page_number + 6) { ?>
										            			<a href="<?=($i)?>">			
										            				<?=$i?>
										            			</a>
									            		<? } ?>

								            		<? } ?>
								            
								            		</li>
								            <? } ?>

								            <li><a href="<?=(($this_page_no < $paginates) ? $url.($this_page_no + 1) : null);?>">&raquo; Next</a></li>

											<li>       
								              <a href="<?=$url.$paginates;?>">&raquo; End</a>
								            </li>

								</ul>
				
								<? } else { ?>
										</div>
									</div>
								</div>

								<? } ?>
								</div>

							<? } else { ?>

								No Town / City found in this location.
				
							</div>
						</div>
					</div>
							
							<? } ?>
				
				<? } ?>


				<!-- Businesses in Town/City -->

				<? if($country_data[0] && $country_data[1] && $country_data[2] && $country_data[3] && !$country_data[4]) { 

					$friendly_url 		= $country_data[0];
					$friendly_url_state = $country_data[1];
					$friendly_url_city	= $country_data[2];

					//Extract Location 1, 3, 4

					$location1 	   = new Location1();
					$location_1_id = $location1->getIdFromFriendlyURL($friendly_url);

					$location3 	   = new Location3();
					$location_3_id = $location3->getIdFromFriendlyURL($friendly_url, $friendly_url_state);

					
					$location4 	   = new Location4();
					$location_4_id = $location4->getIdFromFriendlyURL($friendly_url_state, $friendly_url_city);

					$listingObj = new Listing();

					//Pagination
					$number_of_results_per_page = 20;
					$total_entries 				= $listingObj->getmeTotalLocationWise($location_4_id);
					$paginates = ceil($total_entries / $number_of_results_per_page);

					$page_number  = isset($country_data[3]) ? $country_data[3] : 1;
					$page_number  = intval($page_number);
					$start_from   = ($page_number * $number_of_results_per_page) - $number_of_results_per_page;

					if($start_from >= 0){
						$businesses   = $listingObj->GiveMeNumberOfReviews($location_4_id, $start_from, $number_of_results_per_page);
					}

					if($businesses){
					?>

							<table class="table table-bordered reviewCollect location4">
					            <thead>
					              <tr>
									<th colspan="4"><h1 class="text-center"><i class="fa fa-building-o building-location4"></i>Business in: <?=$loc1.", ".$loc3.", ".$loc4?></h1></th>
					              </tr>
					            </thead>
					            <thead>
					              <tr>
					                <th class="th-padding">Company Name</th>
					                <th class="th-padding"></th>
					                <th class="th-padding">Ratings</th>
					              </tr>
					            </thead>
					            <tbody>
					            <? foreach ( $businesses as $business ): ?>
					              <tr>
					                <td><a href="<?=DEFAULT_URL . '/' . ALIAS_LISTING_MODULE . '/' . $business['friendly_url'];?>"><?=htmlspecialchars($business['title'])?></a></td>
					                <td><?=displayrating($business['avg_review'], 'resstartwrapper', 'starwrapper1')?></td>
					                <?$review_couter = $business['review_count'] == 1 ? $business['review_count']. " Review" : $business['review_count']. " Reviews"; ?>
					                <td><?=$business['avg_review'] > 0 ?  $business['avg_review'] . " out of 5 - " . $review_couter : "Not Rated" ?></td>
					              </tr>
					            <? endforeach; 

					            //Pagination Buttons
							
											    $url = $page . '/' . $country_data[0] . "/". $country_data[1] . "/". $country_data[2] . "/";
											    $limit = 10;
											    $count = $page_number;
											    $this_page_no = $page_number;

											    $paginates < $limit ? $limit = $paginates : null;

											  	if( $total_entries > $number_of_results_per_page ) {

											   ?> 
										</div>
					            </tbody>
					          </table>

								<div class="row text-center">
								<ul class="pagination plPagi">
											
											<li>       
								              <a href="<?=$url."1";?>">&laquo; Start</a>
								            </li>
								            
								            <li>       
								              <a href="<?=($this_page_no > 1 ? $this_page_no - 1 : null);?>">&laquo; Prev</a>
								            </li>

								            <? for($i = $page_number - 4 ; $i <= min($page_number + 9, $paginates); $i++) { ?>
								            	
								            		<li <?=($page_number == $i ? 'class="active"' : null)?>>

								            		<? if ($i > 0 && $page_number < 5 && $i <= 10 ) { ?>
						            					<a href="<?=$i?>">			
								            				<?=($i <= 10 ? $i : null)?>
								            			</a>

								            		<? } else { ?>

								            			<? if ( $i > 0 && $i < $page_number + 6) { ?>
										            			<a href="<?=($i)?>">			
										            				<?=$i?>
										            			</a>
									            		<? } ?>

								            		<? } ?>
								            
								            		</li>
								            <? } ?>

								            <li><a href="<?=(($this_page_no < $paginates) ? $url.($this_page_no + 1) : null);?>">&raquo; Next</a></li>

											<li>       
								              <a href="<?=$url.$paginates;?>">&raquo; End</a>
								            </li>

								</ul>
				
								<? } else { ?>
										</div>
									</div>
								</div>

								<? } ?>
								</div>
					            </tbody>
					          </table>

							<? } else { ?>

							<div class=" location-well">
									<h2 class="text-center">Browse By <i class="fa fa-map-marker"></i> Location: <?=$location1Name->name?></h2>
									<hr class="location-hr">
									<div class="country-list text-center">
<!--										<div class="col-sm-12">-->
											No businesses found in this location.
<!--										</div>-->
									</div>
							</div>

							<? } ?>
				
				<? } ?>		

		</div>
	</div>
</section>
<!-- <script src="http://localhost/10300/custom/domain_1/theme/review/js/responsive-paginate.js"></script>
		<script type="text/javascript">
			$(document).ready(function () {
    $(".pagination").rPage();
});
		</script> -->