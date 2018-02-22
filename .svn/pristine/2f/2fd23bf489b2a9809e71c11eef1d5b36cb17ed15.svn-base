



<?php 

    $date_now = date('Y-m-d H:i:s');  
    $startdate = strtotime($added); 
    $enddate = strtotime($date_now);
    $diff=$enddate-$startdate;
$temp=$diff/86400; // 60 sec/min*60 min/hr*24 hr/day=86400 sec/day
$dat = format_date($added, 'd M Y');
// days
$day=floor($temp);
if($day<1){  $date = "";
//echo "days: $day<br/>\n"; 
$temp=24*($temp-$day);
// hours
$hour=floor($temp); if($hour){$hours = "-".$hour." hours ago"; $minutes="";}
 //echo "hours: $hours<br/>\n"; 
 $temp=60*($temp-$hour);
// minutes
$minute=floor($temp); if($hour==0){$minutes = "-".$minute." minutes ago";}
//echo "minutes: $minutes<br/>\n"; 
$temp=60*($temp-$minute);
// seconds
$second=floor($temp); if($minute==0){$minutes=""; $seconds = "-".$second." seconds ago";} else{$seconds="";}


//echo "seconds: $seconds<br/>\n<br/>\n"; 
}
else{ $date = "-".$dat; 
    $hours= $minutes= $seconds="";
    
}
$date2 = str_replace('-', '', $date);


    $item_reviewcomment = "";

    if (!$tPreview) {
        if (!$item_type) {
            $item_type = 'listing';
        }

        if (!$itemObj) {
            if ($item_type == 'listing') {
                $itemObj = new Listing($item_id);
                $ratesLabel = str_replace("[item]", string_strtolower(LANG_LISTING_FEATURE_NAME), LANG_LABEL_REVIEW_RATES);
            } else if ($item_type == 'article') {
                $itemObj = new Article($item_id);
                $ratesLabel = str_replace("[item]", string_strtolower(LANG_ARTICLE_FEATURE_NAME), LANG_LABEL_REVIEW_RATES);
            } else if ($item_type == 'promotion') {
                $itemObj = new Promotion($item_id);
                $ratesLabel = str_replace("[item]", string_strtolower(LANG_PROMOTION_FEATURE_NAME), LANG_LABEL_REVIEW_RATES);
            }
        }

        if ($reviewArea != "profile") {
            $dbObj = db_getDBObject(DEFAULT_DB,true);
            $sql = "SELECT image_id, A.has_profile
                FROM Profile
                LEFT JOIN Account A ON (A.id = account_id)
                WHERE account_id = $member_id";
            $result = $dbObj->query($sql);
            $rowProfile = mysql_fetch_assoc($result);

            if (SOCIALNETWORK_FEATURE == "on") {
                if ($member_id && $rowProfile["has_profile"] == "y") {
                    $imgTag = preg_replace( '/(width|height)?\s?="\d+"/', '',
                                                socialnetwork_writeLink($member_id, "profile", "general_see_profile", $rowProfile["image_id"], false, false, "", "", "img-polaroid")
                                                );
                                //added for height & width       
                                $pattern = "/(<img\s+).*?src=((\".*?\")|(\'.*?\')|([^\s]*)).*?>/is";
                                $replacement = "<img width=100 height=100 class=\"img-polaroid\" src=$2>";
                                $val =  preg_replace($pattern, $replacement, $imgTag);
                                //ends    
                } else {
                    $imgTag = "<span class=\"no-image no-link\"></span>";
                }
            }
        }
        
        if (!$itemObj) {
            if ($item_type == 'listing') {
                $itemObj = new Listing($item_id);
            } else if ($item_type == 'article') {
                $itemObj = new Article($item_id);
            } else if ($item_type == 'promotion') {
                $itemObj = new Promotion($item_id);
            }
        } 

        if ($show_item) {

            if (!$user) $linkstr = "javascript:void(0)";
            if (string_strpos($url_base, SITEMGR_ALIAS)) {
                $linkstr = $url_base."/".$item_type."/view.php?id=".$item_id;
            } else {
                $linkstr = $item_default_url."/".$itemObj->getString("friendly_url");
            }
            $item_reviewcomment .= "<h3 class=\"review-name\"><a href=\"".$linkstr."\">";
            $item_reviewcomment .= $itemObj->getString("title");
            $item_reviewcomment .= "</a></h3>";

        }
        
    } else {
        if (SOCIALNETWORK_FEATURE == "on") {
            $imgTag = "<span class=\"no-image\" style=\"cursor: default;\"></span>";
        } else {
            $imgTag = "<span class=\"no-image no-link\"></span>";
        }
    }
    
    $item_default_url = @constant(string_strtoupper($item_type).'_DEFAULT_URL');
    
    if (string_strpos($_SERVER['REQUEST_URI'], ALIAS_REVIEW_URL_DIVISOR."/") || $reviewArea == "profile") {
        $totalReview = $totalReviewsPage;
    } else {
        $totalReview = $numberOfReviews;
    }
    
    $rate_stars = display_star_rating($rating, 'resstartwrapper inlineBlock', 'starwrapper1');
       $rate_stars .= "<meta itemprop=\"ratingValue\" content=\"$rating\"> 
                              <meta itemprop=\"bestRating\" content=\"5\">
                              <p class=\"detail-page-review-para\">
                              <font size=\"2px\" style=\"font-weight:normal;color:#000;\">
                             ( $rating out of 5)
                              </font>
                              </p>";    
    $reviewerNameStr = "";
    
    if ($reviewArea != "profile") {
        if (string_strpos($_SERVER['PHP_SELF'], SITEMGR_ALIAS."/review/view.php")) {
            $reviewerNameStr .= ($reviewer_name) ? $reviewer_name : "";
            
        } else {
            if ($member_id) {
                $membersStr = "";
                $membersStr = socialnetwork_writeLink($member_id, "profile", "general_see_profile", false, false, false, '', $user);
                if ($membersStr) {
                    $reviewerNameStr .= ($reviewer_name) ? $membersStr : "";
                } else {
                    $reviewerNameStr .= ($reviewer_name) ? $reviewer_name : "";
                }
            } else {
                if ($tPreview) {
                    if (SOCIALNETWORK_FEATURE == "on") {
                        $reviewerNameStr .= "<a href=\"javascript:void(0);\" style=\"cursor: default;\">".$reviewer_name."</a>";
                    } else {
                        $reviewerNameStr .= $reviewer_name;
                    }
                } else {
                    $reviewerNameStr .= ($reviewer_name) ? $reviewer_name : "";
                }
            }
        }
    }

    //Removed link to profile 
    $reviewerNameStr = $reviewer_name;

    //for the details of sponsor



        $id = $listing->account_id;
        $apcObj = new AccountProfileContact(1, $id);
        $sponsor_name = $apcObj->first_name." ".$apcObj->last_name;
        
        
        //Check if the url signature is expired 
if ($apcObj->facebook_image) {
if (checkExpiredImage($apcObj->facebook_image) == 'URL signature expired' || checkExpiredImage($apcObj->facebook_image) == 'Content not found') {
$image = "<img src=\"" . DEFAULT_URL . "/images/profile_noimage.png\" width=\"45\" height=\"45\" alt=\"$sponsor_name\">";
} else {
$image = "<img src=\"" . $apcObj->facebook_image . "\" width=\"45\" height=\"45\" alt=\"$sponsor_name\">";
}
} else {
$image = "<img src=\"" . DEFAULT_URL . "/images/profile_noimage.png\" width=\"45\" height=\"45\" alt=\"$sponsor_name\">";
}

if (string_strpos($_SERVER["PHP_SELF"], SITEMGR_ALIAS) !== false || string_strpos($_SERVER["PHP_SELF"], MEMBERS_ALIAS) !== false) {
    // sitemanager or sponsors page ko lagi
        if( strpos( $imgTag, 'no-image' ) === false ) {
        $item_reviewcomment .= 

            "<li class=\"review-item\">
    <div class=\"row\">
        <div class=\"thumbnail custhumbnail bottomToolTip\"> 

            <div class=\"col-sm-2 detail-review-imgwidth\">
               $val
            </div>
            <div class=\"col-sm-9\">
                $rate_stars
                <span class=\"black\"><strong>$reviewer_name</strong>
                    <em> - ".format_date($added, 'd M Y')."</em>
                </span>
                <p>".(($review) ? htmlspecialchars_decode(nl2br($review)) : system_showText(LANG_NA))."</p>";
        }
        else {
            $link= "<img src=\"".DEFAULT_URL."/images/profile_noimage.png\"  alt=\"$reviewer_name\">";
            $item_reviewcomment .=
                    "<li class=\"review-item\">
    <div class=\"row\">    
        <div class=\"thumbnail custhumbnail bottomToolTip\"> 

            <div class=\"col-sm-12\">
                $link "
                    . "$rate_stars
                Reviewed & Rated by: <span class=\"black\"><strong>$reviewer_name</strong>
                    <em> - ".format_date($added, 'd M Y')."</em>
                </span>
                <p>".(($review) ? htmlspecialchars_decode(nl2br($review)) : system_showText(LANG_NA))."</p>";
        }
        if ($response && ($responseapproved || string_strpos($url_base, SITEMGR_ALIAS))) {
            //slicing response 
            // $response = substr($response, 0, 80);
            
            $item_reviewcomment .= "<div class=\"reply \">";
            $item_reviewcomment .= "
                <div class=\"replay-image\">
                    <a href=\"#\">
                        <img src=\"".DEFAULT_URL."/images/profile_noimage.png\" width=\"45\" height=\"45\" alt=\"img\">
                    </a>
                </div><div class=\"reply-wrapper\">";

            $item_reviewcomment .= "<span class=\"replyfrom-sponsor\">Reply From:". $sponsor_name ."</span><em class=\" date\"> - 12 Mar 2015</em><p>" ;
            $item_reviewcomment .= nl2br($response); 
            // $item_reviewcomment .= " <a href=\"#\"><i class=\"fa fa-plus-circle\"></i></a></p></div></div>";

        }

        $link= "<img class=\"img-polaroid\" src=\"".DEFAULT_URL."/images/profile_noimage.png\"  title=\"$reviewer_name\" alt=\"$reviewer_name\">";
                                
        $item_reviewcomment .= "
                    </div> <!-- col-sm-9 end vayo -->
                </div><!-- thumbnail end vayo-->

                <div class=\"ttip\"></div><!-- end ttip-->

                <div class=\"foocomment pull-right mt10\"> 
                    <span>
                        ".
                        system_showText(LANG_LABEL_REVIEW_HELPFUL)
                        ."
                    </span>
                    <span id=\"".($divReviewsName ? $divReviewsName : "ratings_")."$id\">
                    $likeStr
                    </span>
                </div>
            </div>
            </li>";
    
    } else {
        // LIKE & DISLIKE --- detail page ma ni yehi ho
        if (!$id || $pag_content == "reviews") {
            $auxProfileId = $id;
            $id = $row["rID"];
        }
        $likeStr = "";

        //Each id is extracted from reviews array foreach loop formed in view_listing_detail.php
        $id = $each_rate->id;

        $likeStr = system_getLikeDislikeButton($like_ips, $dislike_ips, $id, $like, $dislike, ($divReviewsName ? $divReviewsName : "ratings_"), $user);

        if( strpos( $imgTag, 'no-image' ) === false ) {
            $image1 = preg_replace('/.+src="([^"]+)".+/', '${1}', $val);

        //Here is reivewer name in detail page    
        $item_reviewcomment .= 
            "<li class=\"review-item\">
    <div class=\"row\">
        <div itemprop=\"review\" class=\"thumbnail custhumbnail bottomToolTip\" itemscope itemtype=\"http://schema.org/Review\"> 
            

            <div class=\"col-sm-12 col-md-12 col-lg-12\">
            <div style = 'float:right; padding-left: 15px; padding-bottom:10px;' > 
                $val
                    
<span class = 'photo_date1'>
                    
 <span class=\"black\" itemprop=\"author\" itemscope itemtype=\"http://schema.org/Person\">
                    <em> ". $date2."</em>
                </span>
                 <span class=\"black\">
                    <em> ".str_replace('-', '', $hours).str_replace('-', '', $minutes).str_replace('-', '', $seconds)."</em>
                </span>
                
</span>

            </div>
            <meta itemprop=\"name\" content=\"$review_title\">
            <h4 class=\"reviewTitle\">".ucwords($review_title)."</h4><br />
                <span itemprop=\"reviewRating\" itemscope itemtype=\"http://schema.org/Rating\">
                    <meta itemprop=\"ratingValue\" content=\"$rating\"> 
                    <meta itemprop=\"bestRating\" content=\"5\">
                 $rate_stars
                </span>
 <br> 
     
        
               


Reviewed & Rated by:
<span class = 'res_name'>


 <strong><span itemprop=\"name\">$reviewer_name</span></strong>

                <span class=\"black\" itemprop=\"author\" itemscope itemtype=\"http://schema.org/Person\">
                
                    <em> ".$date."</em>
                </span>
                 <span class=\"black\">
                    <em> ".$hours.$minutes.$seconds."</em>
                </span>
                
</span>
                <hr size ='10' width='100%'>
                <meta itemprop=\"itemReviewed\" itemprop=\"reviewBody\" content=\"$review\">
                <h5>".(($review) ? str_replace("\'", "'", nl2br($review)) : system_showText(LANG_NA))."</h5>";
        }
        else {
            $link= "<img class=\"img-polaroid\" src=\"".DEFAULT_URL."/images/profile_noimage.png\" title=\"$reviewer_name\" alt=\"$reviewer_name\">";
            $item_reviewcomment .=
                    "<li class=\"review-item\">
    <div class=\"row\">
        <div itemprop=\"review\" class=\"thumbnail custhumbnail bottomToolTip\" itemscope itemtype=\"http://schema.org/Review\"> 

            
            <div class=\"col-sm-12 col-md-12 col-lg-12\">
            <meta itemprop=\"name\" content=\"$review_title\">
            <h4 class=\"reviewTitle\">".ucwords($review_title)."</h4><br />
              <span itemprop=\"reviewRating\" itemscope itemtype=\"http://schema.org/Rating\">
                          <meta itemprop=\"name\" content=\"$review_title\">
                    <meta itemprop=\"ratingValue\" content=\"$rating\"> 
                    <meta itemprop=\"bestRating\" content=\"5\">
                    $rate_stars
               </span> 
       
               <br>Reviewed & Rated by:  <span class=\"black\" itemprop=\"author\" itemscope itemtype=\"http://schema.org/Person\">
                <strong><span itemprop=\"name\">$reviewer_name</span></strong>
                    <em> ".$date."</em>
                </span>
                <span class=\"black\">
                    <em> ".$hours.$minutes.$seconds."</em>
                </span>
                <hr size ='10' width='100%'>

                <meta itemprop=\"itemReviewed\" itemprop=\"reviewBody\" content=\"$review\">".
                "<h5>".(($review) ? nl2br($review) : system_showText(LANG_NA))."</h5>";
        }
        if ($response && ($responseapproved || string_strpos($url_base, SITEMGR_ALIAS))) {
            //slicing response 
            $string_len = strlen($response);
         
            
            $item_reviewcomment .= '';
            $item_reviewcomment .= '<div id="va['.$va.'] class="hidden">';
            $item_reviewcomment .= "<div class=\"reply \">";
            $item_reviewcomment .= "
                <div class=\"replay-image\">
                    <a href=\"#\">
                        $image
                    </a>
                </div><div class=\"reply-wrapper\">";
            $item_reviewcomment .= "<span class=\"replyfrom-sponsor\">Reply From:". $sponsor_name ."</span><em class=\" date\"> - 12 Mar 2015</em><p>" ;
                        // $response1 = substr($response, 0, 133);
                        
                        $item_reviewcomment .= "<h5 class='reply-heading'>Reply from ". $listingtemplate_title ."</h5>";
                        $item_reviewcomment .= "<div id=\"first\" class=\"comment\">";                       
                        $item_reviewcomment .= nl2br($response);
                       
                        //for string length
                        // $str_len= strlen($response1);
                        // if($str_len>132){            
                        // $item_reviewcomment .= ""
                        //                         . " <a id=\"image_$va\" href=\"javascript:\" onclick=\"hidecontent($va)\" >"
                        //                         . "<i class=\"fa fa-plus-circle\"></i>"
                        //                         . "</a>"
                        //                         . "</p>";
                        // }
                    $item_reviewcomment .="</div></div></div>";
                    $response2 = substr($response, 133);  
                    $item_reviewcomment .= "<div id=\"display_$va\" class=\"end\" style=\"display: none\" >";
                    $item_reviewcomment .=nl2br($response2);

                    $item_reviewcomment .= "</div> <!--ends --> "
                            . "</div>"
                          ;

            
            
        }

        $item_reviewcomment .= "
            </div><!-- end vayo col-sm-9 -->
        </div><!-- end thumbnail-->
        
        <div class=\"ttip\"></div><!-- end ttip-->
            
        <div class=\"foocomment pull-right mt10\"> 
            <span>
                ".system_showText(LANG_LABEL_REVIEW_HELPFUL)."
            </span>
            <span id=\"".($divReviewsName ? $divReviewsName : "ratings_")."$id\">
            $likeStr
            </span>
        </div>
    </div>
</li>";


        
        if ($pag_content == "reviews") {
            $id = $auxProfileId;
        }
    
    }
?>

<script type="text/javascript" language="JavaScript">
function hidecontent(va){
        
      var i = va;    
      var ds = document.getElementById('display_'+i);
      var image = document.getElementById('image_'+i);
        if (ds.style.display === 'block'){
           ds.style.display = 'none';
           image.style.display = "";
        }
        else {
           ds.style.display = 'block';
           image.style.display = "none";
        }
    }
</script>
