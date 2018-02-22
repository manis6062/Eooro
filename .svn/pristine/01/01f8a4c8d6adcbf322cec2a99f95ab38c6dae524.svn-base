<?php
    $mostviewed = new Listing(); 
    $trends = $mostviewed->GetTrendingListings(CountryLoader::getCountryId());
    $country=  (CountryLoader::getCountryName());

  if (isset($trends)){    
?>


    <section class  = "latest-review recently-reviewed">
      <div class    = "container">

        <div class  = "row">
            <h3> Trending  <?=$country?> Business Reviews</h3>
        </div>
          
            <table class = "table table-bordered reviewCollect table-hover recentReviewedTrending">
                <thead class="thead-bg">
                  <tr>
                    <th class ="col-sm-3 col-md-4"> Businesses Reviewed </th>
                    <th class ="col-sm-2 col-md-2"> Town/State          </th>              
                    <th class ="col-sm-3 col-md-2"> Company Rating      </th>
                    <th class ="col-sm-2 col-md-2"> Average rating      </th>
                    
                  </tr>
                </thead>
               <tbody>


                   <?php foreach ($trends as $trend) { 

                        $summary = new ListingSummary($trend['item_id']);
                      
                        $location1friendlyurl = $summary->location_1_friendly_url;
                        $location3friendlyurl = $summary->location_3_friendly_url;
                        $location4friendlyurl = $summary->location_4_friendly_url;
                        
                        $link_city  = DEFAULT_URL . "/" . ALIAS_LISTING_MODULE . "/" . "locations/" . $location1friendlyurl . "/" . $location3friendlyurl . "/" . $location4friendlyurl . "/1";
                        $link_state = DEFAULT_URL . "/" . ALIAS_LISTING_MODULE . "/" . "locations/" . $location1friendlyurl . "/" . $location3friendlyurl . "/1";
                        $url        = DEFAULT_URL . "/" . ALIAS_LISTING_MODULE . "/" . $trend['friendly_url'];
                          
                    ?>
                  

                  <tr>
                      <td><a href="<?=$url?>"><?=stripcslashes(htmlspecialchars($trend['title']))."</a>"?></td>
                      <td>
                        <?  
                            $state = $trend['location_3_title'];
                            $city  = $trend['location_4_title']; 

                            if($state != $city){
                              if (empty($city) ){
                                echo  "<a href='". $link_state ."'>". $state . "</a>";
                              } else{
                                echo "<a href='". $link_city ."'>". $city . "</a>" . ", " . "<a href='". $link_state ."'>". $state . "</a>" ;
                              }
                            } else {
                                echo "<a href='". $link_city ."'>". $city . "</a>" ;
                            }
                        ?>
                         
                      </td>
                    <td class = "startWidth"><?=displayratingsmall($trend['average_rating'], 'resstartwrapper', 'starwrapper3')?></td>


                    <? //For big rating : displayrating($trend['average_rating'], 'resstartwrapper', 'starwrapper1')?>


                    <td>
                        <?=$trend['average_rating']?> out of 5 - 
                        <?$count  = $trend['number_of_review'];
                            if($count == 1)
                              { echo $count. " review" ;
                            }else{
                              echo  $count. " reviews";
                            };?>
                    </td>

                  </tr>
                    <?php } ?>

                  <?php } ?>
                </tbody>

            </table>
            
      </div>
  </section>