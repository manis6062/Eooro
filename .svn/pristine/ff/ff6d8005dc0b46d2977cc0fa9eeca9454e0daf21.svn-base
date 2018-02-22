<?php 

    if (is_array($listing)) {
        $aux = $listing;
    } 
    else if (is_object($listing)) {
        $aux = $listing->listing_array;
    }


    //FOR OVERALL RATING CALC. ON lISTING RESULTS PAGE.

    $item_type = "Listing";
    $item_id = $listings[$va]["id"];

    //Preview page extract item id
    $item_id ? null : $item_id = $_GET['id'];

    //Reveiws Count with Active members

    $dbMain = db_getDBObject(DEFAULT_DB, true);
    $dbDomain = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);

    $sql =  "SELECT count(*) From Review 
            LEFT OUTER JOIN {$dbMain->db_name}.Account on Review.member_id = Account.id
            where item_id = {$item_id} and approved = 1 and is_deleted = 0 and Account.active ='y' AND Review.status = 'A'";

    $query  = $dbDomain->query( $sql );
    $arr = mysql_fetch_array($query);
    $rev_num = $arr[0];

    $ratings_data = '<font size = 2px> (' . $rev_num . ' reviews)' . '</font>';
    $rev_num ? null: $ratings_data = '<font size = 2px>(Review this business)</font>';


    $RevObj = new Review();
    $reviewData = $RevObj->getRateAvgByItem($item_type, $item_id,"count");
    $counter_review = $reviewData['review_count'];
    $counter_review = ($counter_review == 1 ? $counter_review . " Review" : $counter_review . " Reviews" );

    $item_avgreview = $reviewData['rate'];
   
    $item_avgreview == "N/A" || $item_avgreview == null ? $item_avgreview = "0" : null;


    
    if ( strpos($listingtemplate_image, '<img') ) {
        $imagePresent = true;
        $claim_text = isset( $claimForReview )  ? 'Claim This Business' : '';
        $html = 
                '<h2 class="sabayjai" itemprop="name">'.ucfirst(stripcslashes($listingtemplate_title)).'</h2>'.
                displayrating( $item_avgreview, 'resstartwrapper', 'starwrapper1' ). $ratings_data;
        $val1 = '
                <div class="col-sm-3">
                    '.$listingtemplate_share_navbar.'
                      
                    <a 
                           href="'.$claim_link.'" class="reviewThis"
                           >'.
                            $claim_text.
                    '</a>
                </div>
                <div class="col-sm-3 detail-ul-style">
                    <section>
                    <div>
                    <ul>
                    '.$listingtemplate_image.'
                    </ul>
                    </div>    
                    </section>    
                </div>
                ';
        $claimlistingid = $listing["id"];
        $claim_link1 = ((SSL_ENABLED == "on" && FORCE_MEMBERS_SSL == "on" && FORCE_CLAIM_SSL == "on") ? SECURE_URL : NON_SECURE_URL)."/".MEMBERS_ALIAS."/".ALIAS_CLAIM_URL_DIVISOR."/listing.php?claimlistingid=".$claimlistingid;

        $val = '<div class="col-sm-3">
                   '.$listingtemplate_share_navbar.'
                    <a href="'.$claim_link1.'" class="reviewThis"
                           >'.
                            $claim_text.
                    '</a>    
                </div> <div class="col-sm-3 detail-ul-style">
                    <section>
                    <div>
                    <ul>
                    '.$listingtemplate_image.'
                    </ul>
                    </div>    
                    </section>    
                </div>';       
    }
    else {
        $claim_text = isset( $claimForReview )  ? 'Claim This Business' : '';
        $href = ($user ? $linkReviewFormPopup : "javascript:void(0);");
        $class = $class;
        $imagePresent = false;
        $listingtemplate_title = str_replace('<a href="">', '', $listingtemplate_title);
        $listingtemplate_title = str_replace('</a>', '', $listingtemplate_title);

        $uri = DEFAULT_URL . '/' . ALIAS_LISTING_MODULE . "/" . $listingtemplate_friendly_url;

        $html = '<a href="'.$uri.'">'.ucfirst(stripcslashes($listingtemplate_title)) . '</a>'
                .displayrating( $item_avgreview, 'resstartwrapper', 'starwrapper1' ). $ratings_data;
        $val1 = '<div class="col-sm-3">
                   '.$listingtemplate_share_navbar.'
                    <a  href="'.$claim_link.'" class="reviewThis"
                           >'.
                            $claim_text.
                    '</a>    
                </div>';
        
		$claimlistingid = $listing["id"];
        $claim_link1 = ((SSL_ENABLED == "on" && FORCE_MEMBERS_SSL == "on" && FORCE_CLAIM_SSL == "on") ? SECURE_URL : NON_SECURE_URL)."/".MEMBERS_ALIAS."/".ALIAS_CLAIM_URL_DIVISOR."/listing.php?claimlistingid=".$claimlistingid;

        $val = '<div class="col-sm-3">
                   '.$listingtemplate_share_navbar.'
                    <a href="'.$claim_link1.'" class="reviewThis"
                           >'.
                            $claim_text.
                    '</a>    
                </div>';
    }
?>

<div class="row">
    <div <?=$listing["id"] ? "id=\"summary_map_content_".$listing["id"]."\"" : ""?> class="thumbnail custhumbnail">
        
            <div class="col-sm-6 <?=$imagePresent ? 'margin-bottom-10' : '' ?>">
            <? if (!strpos($_SERVER['PHP_SELF'], 'preview.php')) { 
                echo $html;
            } else { 
                $rev_num ? null : $rev_num = "0";
                $html = '<h2>'.ucfirst(stripcslashes($listingtemplate_title)).'</h2>'
                .displayrating( $item_avgreview, 'resstartwrapper', 'starwrapper1' ). $ratings_data ;
                echo $html;
            } ?>

            <? 
				echo '<span class="ratin" itemprop="reviewCount">'.'<font size = "2px"> 
				(' . $item_avgreview ." " .'out of 5)' . '</font>'.'</span>';
			?>

            


            </div>
            <?if(sess_isAccountLogged())
            { 
            echo $val;
            } else 
                {
				echo $val1;
				}?>
            <!--Displays Phone Number and Website url according to data -->  
            <div class="col-sm-12">
                <?php if ($listingtemplate_phone || $listingtemplate_url) {?>
                    <div class="phonefax phonefax1">
                       <?php if ($listingtemplate_phone) {?> 
                            <span class="phone">
                               <?= system_showText(LANG_LISTING_LETTERPHONE). ':'. $listingtemplate_phone?>
                            </span>
                        <?}?>
                        <?php if ($listingtemplate_url) {?> 
                            <span class="pull-right web">  
                                <?=system_showText(LANG_LISTING_LETTERWEBSITE). ':'?> <?=str_replace("www.", "", $listingtemplate_url)?>
                            </span>
                        <?}?>
                    </div>
                 <? } else{?><hr style="border-color: rgb(212, 212, 212);"> <? }?>
            </div>

            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-6 mero-7">
                        <? if (($listingtemplate_address) || ($listingtemplate_address2) || ($listingtemplate_location)) { ?>
                                <address itemprop="address" itemscope itemtype="http://schema.org/PostalAddress" class="lineHeight">
                                    <p><?=$listingtemplate_address?><?echo "\n";?><?=$listingtemplate_location?>
                                       <br><?=$aux['listing_1_title'];?> 
                                    </p>
                                <? if (is_array($snippet_address) && count($snippet_address > 0)) { ?>

                                    <? if ($snippet_address["addressCountry"]) { ?>
                                    <meta itemprop="addressCountry" content="<?=$snippet_address["addressCountry"]?>" />
                                    <? } ?>
                                    <? if ($snippet_address["addressRegion"]) { ?>
                                    <meta itemprop="addressRegion" content="<?=$snippet_address["addressRegion"]?>" />
                                    <? } ?>
                                    <? if ($snippet_address["addressLocality"]) { ?>
                                    <meta itemprop="addressLocality" content="<?=$snippet_address["addressLocality"]?>" />
                                    <? } ?>
                                    <? if ($snippet_address["postalCode"]) { ?>
                                    <meta itemprop="postalCode" content="<?=$snippet_address["postalCode"]?>" />
                                    <? } ?>

                                <? } ?>
                                </address>

                            <? } ?>
                    
                    
                    </div>
                    <div class="col-sm-6 mero-5">
                        <div class="btngrp pull-right">
                            <? 
                            $claim_text = isset( $claimForReview )  ? 'CLAIM LISTING' : 'APPROVED';
                            $claim_link = isset( $claimForReview ) ? $claim_link : 'javascript:void(0)';
                            $claim_class = isset( $claimForReview ) ? '' : 'approved';
                            
                            ?>
                            <? //link for Review
							//For Preview page
                            $url=strtok($_SERVER["REQUEST_URI"],'?');
                            $words = explode('/', $url);
                            $last_words = array_pop($words);


                           $url1 = NON_SECURE_URL."/".MEMBERS_ALIAS."/listing/preview.php";
                           $words1 = explode('/', $url1);
                           $last_words1 = array_pop($words1);

                            $linkReviewFormPopup = DEFAULT_URL."/popup/popup.php?pop_type=reviewformpopup&amp;item_type=".lcfirst($item_type)."&amp;item_id=".htmlspecialchars($aux["id"]);
                            $klass = "reviewThis iframe fancy_window_review";
                            if(!$_SESSION['SESS_ACCOUNT_ID']){
                                $linkReviewFormPopup =  EDIRECTORY_FOLDER."/popup/popup.php?pop_type=profile_login&destiny=". $_SERVER["REQUEST_URI"]."&act=rate&type=listing&rate_item=".$aux["id"];
                                $klass = "reviewThis fancy_window_iframe";
                            }

                           
                           $href = ($user ? $linkReviewFormPopup : "javascript:void(0);"); 

                            if($last_words == $last_words1)
                            { ?>
                            <a href="<?=DEFAULT_URL.'/'.ALIAS_LISTING_MODULE.'/'.$listingtemplate_friendly_url;?>" target="_blank">
                                <button class="btn btn-default btn-sm fbtn fbtn1 morebtn">Read Reviews</button>
                            </a>
                                
                            <? } else { ?>

                            <a href="<?=DEFAULT_URL.'/'.ALIAS_LISTING_MODULE.'/'.$listingtemplate_friendly_url;?>">
                                <button class="btn btn-default btn-sm fbtn fbtn1 morebtn">Read Reviews</button>
                            </a>
                            <?}?>
                             <a rel="nofollow" href="<?=$href?>" class="<?=$klass?>">
                                <button class="btn btn-default btn-sm fbtn fbtn1 col1 clbtn <?=$claim_class?>">
                                  Write Review
                                </button>
                             </a>
                            <? unset( $claim_text, $claim_link ); ?>
                        </div>
                    </div>
                </div>
            </div>
    </div> <!--/thumbnail-->
 </div>
