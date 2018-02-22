<ol itemscope itemtype="http://schema.org/BreadcrumbList" class="hidden">
  <li itemprop="itemListElement" itemscope
      itemtype="http://schema.org/ListItem">
    <a itemprop="item" rel="canonical" href="<?NON_SECURE_URL?>/company-reviews/">
        <span itemprop="name">Recent Reviews</span></a>

    <meta itemprop="position" content="1" />
  </li>
</ol>
 <?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include("./conf/loadconfig.inc.php");
 if( EDIR_THEME === 'review' ){
            include_once THEMEFILE_DIR.'/'.EDIR_THEME.'/common_functions.php';
        }
$table = FORCE_SECOND ? " Listing_Summary" : " Listing";
            $country            = CountryLoader::getCountryId();
            $location_geo_id    = $country ? $table.'.location_1='.CountryLoader::getCountryId().' AND ' : '';
            $location_state_id  = $country ? (CountryLoader::getStateId($country) ? $table.'.location_3='.CountryLoader::getStateId($country).' AND ' : '') : '';
        $levelsWithReview = system_retrieveLevelsWithInfoEnabled("has_review");

$Main = db_getDBObject(DEFAULT_DB, true);
$array = (array) $Main;

$searchReturn["from_tables"] = "Review| LEFT OUTER JOIN {$array['db_name']}.Account Acc on Review.member_id = Acc.id LEFT JOIN AccountProfileContact Account ON (Account.account_id = member_id) INNER JOIN  ".(FORCE_SECOND ? "Listing_Summary" : "Listing")." ON Review.item_id = ".(FORCE_SECOND ? "Listing_Summary" : "Listing").".id";
$screen=$_POST['screen'];
$aux_items_per_page=10;
$searchReturn["where_clause"]= "item_type = 'listing' AND Acc.active = 'y' AND
                  approved = 1 AND Review.is_deleted='0' AND Review.approved = '1' AND Review.review IS NOT NULL AND Review.review != '' AND 
                  ".(FORCE_SECOND ? "Listing_Summary" : "Listing").".status = 'A' AND 
                  ".$location_geo_id.$location_state_id  
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
                                Account.image_id,
				Account.facebook_image,
				Account.has_profile, Acc.active ";
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
       ?>   
    <div class="container">
        <div class="row">
       <? if (!$listings)
       {
           ?>
           <div class="noresults col-sm-9 cuscato">
                    <div class="resultsMessage">
                        <?php header("HTTP/1.0 404 Not Found"); ?>
                        <?=system_showText(LANG_SEARCH_NORESULTS);?>
                    </div>
           </div> 
    <? }
       else 
       { 
           ?>
           <div id="content_listView" class="col-sm-9 cuscato"> 
            <div class="results-info-listing">    
                <div class="row">
                        <span class="recent-reviews" style="display:none;">Recent Reviews</span>
                </div> 
            </div>
            <? foreach ($listings as $listing) {
                     if ($listing["facebook_image"]) {
            //Check if the url signature is expired 
            $url = $listing["facebook_image"];
            $ch = curl_init();
            $timeout = 5;
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
            $lines_string = curl_exec($ch);
            curl_close($ch);
            if ($lines_string == "URL signature expired") {
                $image = DEFAULT_URL . "/images/profile_noimage.png";
            } else {
                $image = $listing["facebook_image"];
            }
        }
              ?>

<?//variables for listing

$dbMain = db_getDBObject(DEFAULT_DB, true);
$dbDomain = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
$sql = "SELECT count(*) From Review where item_id = " . $listing['item_id'] . " and approved = 1 and is_deleted = 0 AND status = 'A'";
$query  = $dbDomain->query( $sql );
$arr = mysql_fetch_array($query);
$rev_num = $arr[0];
$rate = ($listing["rating"]);
$url = $listing["friendly_url"];
$url_add= DEFAULT_URL .'/'. ALIAS_LISTING_MODULE .'/'. $url;

?>     

    
            <div class="row">
               <div class="thumbnail custhumbnail">
                  <div itemscope itemtype="http://schema.org/Review">
                    <div class="col-sm-6">
                    <!-- <span style="float:left"> -->
                            <a itemprop="sameAs" href="<?php echo $url_add ?>"> 
                              <div itemprop="itemReviewed" itemscope itemtype="http://schema.org/LocalBusiness">
                                <h2 class="sabayjai" itemprop="name">
                                  <?=$listing["title"];?>
                                </h2>
                              </div>
                            </a>

                            <div class="detail-page-review" itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating">

                              <?=display_star_rating($rate, null, null)?>
                              <meta itemprop="ratingValue" content="<?=$rate;?>"> 
                              <meta itemprop="bestRating" content="5">
                              <p class="detail-page-review-para">
                              <font size="2px" style="font-weight:normal;color:#000;">
                              (<?=$rate;?> out of 5)
                              <!-- (<?=$rev_num?> reviews) -->
                              </font>
                              </p>
                            </div>

                            <span class="reviewed-rated" itemprop="author" itemscope itemtype="http://schema.org/Person">
                                Reviewed & Rated by:
                                <span itemprop="name">
                                  <em> <?=$listing["reviewer_name"]?></em>
                                </span>  
                            </span>
                    


                    <!-- SOCIAL SHARING GO HERE -->
<?/* 
NOTE:
$listing["review"]  = Summary...actual review
$url_add            = URL Address
$listing["reviewer_name"] = TITLE
$screen = Page Number
$image        = Image

*/?>  
                    
                    </div>
                     <div class="col-sm-4 featured-listing-social-icons">
                       <ul class="social detailSocial">
                            <li class="icon">
                            <a rel="nofollow" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=325,width=600, top=100, left=400');return false;" href="https://twitter.com/intent/tweet?url=<?php echo $url_add ?>&amp;text=<?=$listing["review"]?>" target="_blank" class="tw bg"><i class="fa fa-twitter"></i></a></li>
                <li class="icon">

                          <a class="fb bg" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=325,width=600, top=100, left=400');return false;" rel="nofollow" target="_blank" href="http://www.facebook.com/sharer/sharer.php?s=100&amp;p[url]=<?echo $url_add;?>"> 
                          <i class="fa fa-facebook">

                            </i>
                            </a>
                            </li>


                            <li class="icon"><a rel="nofollow" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=325,width=600, top=100, left=400');return false;" target="_blank" href="https://plus.google.com/share?url=<?php echo $url_add ?>" class="gp bg"><i class="fa fa-google"></i></a></li></ul> 
                                
                             
                    </div>
                   <div class="col-sm-2 featured-listing-image">
                        <? if($image){ ?>
                               
                            <img src="<? echo ($image);?>" width="100" height="100" />
                            <?} else {
                                $reviewer_name= $listing['reviewer_name'];

                                $link= "<img src=\"".DEFAULT_URL."/images/profile_noimage.png\"  alt=\"$reviewer_name\">";
                                echo $link;
                                                           ?>
                             <? } ?>
                        
                    </div>
                    <div class="col-sm-12">
                        <hr size="10" > 
                            <? //Added review-title ?>
                        <strong><?=  ucwords($listing["review_title"])?></strong>
                            <?$xss=$listing["review"];
                              $rev = htmlspecialchars($xss,ENT_QUOTES);
                              $revie= (($rev) ? htmlspecialchars_decode(nl2br($rev)) : system_showText(LANG_NA));?>
                            <meta itemprop="reviewBody" content="<?=$revie;?>">
                            <p><?=$revie;?></p>

                    </div>
                  </div> <!--/itemscope-->
               </div> <!--/thumbnail-->
                  <br>
            </div>
               <? } ?>   
           </div>
       <?}
        ?>  
          <? /* adsensecode
           <div class="col-sm-3 cusright">
            <div class="ads">
                <span>
                  Banner Advert<br>300 x 300
                  <script asyncsrc="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                  <!-- Eooro Banner Ad -->
                  <ins class="adsbygoogle"
                  style="display:inline-block;width:300px;height:250px"
                  data-ad-client="ca-pub-4628605991195184"
                  data-ad-slot="3915182695"></ins>
                  <script>
                  (adsbygoogle = window.adsbygoogle || []).push({});
                  </script>
                </span>
            </div>
            <div class="ads">
                <span> 
                Banner Advert<br>300 x 300
                  <script asyncsrc="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                  <!-- Eooro Banner Ad -->
                  <ins class="adsbygoogle"
                  style="display:inline-block;width:300px;height:250px"
                  data-ad-client="ca-pub-4628605991195184"
                  data-ad-slot="3915182695"></ins>
                  <script>
                  (adsbygoogle = window.adsbygoogle || []).push({});
                  </script></span>
            </div>
            <div class="ads">
                <span>
                Banner Advert<br>300 x 300
                    <script asyncsrc="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                    <!-- Eooro Banner Ad -->
                    <ins class="adsbygoogle"
                    style="display:inline-block;width:300px;height:250px"
                    data-ad-client="ca-pub-4628605991195184"
                    data-ad-slot="3915182695"></ins>
                    <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
                    </script>
                  </span>
            </div>
            <div class="ads">
                <span>
                Banner Advert<br>300 x 300
                   <script asyncsrc="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                  <!-- Eooro Banner Ad -->
                  <ins class="adsbygoogle"
                  style="display:inline-block;width:300px;height:250px"
                  data-ad-client="ca-pub-4628605991195184"
                  data-ad-slot="3915182695"></ins>
                  <script>
                  (adsbygoogle = window.adsbygoogle || []).push({});
                  </script>
                </span>
            </div>
        </div>
        */ ?>
        </div>     
    </div>
    
    <script>
    increment = 1;
    var getResult = $( '.resultsMessage' ).text().trim();
    getResult = (getResult === '') ? true : false;
    $( document ).scrollViewer({
        pageRatio           : 0.8,
        screen              : 2,
        ajaxURL             : document.URL.replace( /&screen=[\d]+/, '' ),
        ajaxType            : 'POST',
        responseContainer   : '#content_listView',
        filterContents      : true,
        filterSelector      : { 
                                keep : '#content_listView',
                                discard: ['.results-info-listing','.bottom-pagination-listing']
                            },
        endOfResult         : function( response ){
          
            var result = response.text();

            if(result){
              history.replaceState(null, null, '#page='+increment);
              increment++;
            }

            if( result.search(/No Results Returned for your search/im) > -1 ){
                return true;
            }
            else{
                return false;
            }
        },
        loadResult          : getResult,
      
    });
</script>
        
