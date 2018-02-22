<?
include("../conf/loadconfig.inc.php");
include(EDIRECTORY_ROOT."/".SOCIALNETWORK_FEATURE_NAME."/mod_rewrite.php");
include(EDIRECTORY_ROOT."/custom/domain_1/theme/".EDIR_THEME."/common_functions.php");
include_once CLASSES_DIR.DIRECTORY_SEPARATOR.'class_Opened_Cases.php';

if(!$_SERVER['HTTP_X_REQUESTED_WITH']){
      header("Location:".DEFAULT_URL."/".ALIAS_LISTING_MODULE);
      exit;
}

function get_local_time($current_time){
    $time        = strtotime($current_time.' UTC');
    $dateInLocal = date("jS M Y", $time);
    return $dateInLocal;
}

$acctidFromSession = sess_getAccountIdFromSession();
$acctidFromSession == $id ? $showedit = true : $showedit = false;


 //For Pagination
  $casescount                 = Opened_Cases::getThisUsersCasesCount($id);
  $page_number                = $_GET['page'] ? $_GET['page'] : 1;
  $number_of_results_per_page = 5;

$pagination = PaginationCustom::getPagination($number_of_results_per_page, $casescount, $page_number, "cases.php?page=", null, true,"#body");
$cases = Opened_Cases::getThisUsersCasesForPagination(mysql_real_escape_string($id), $pagination['start_from'], $number_of_results_per_page);

if($cases) {

  foreach ($cases as $case) {
    $listing = new Listing($case['item_id']);

?>
    <div class="profile-dashboard">
<section class="cusreview businessReview">

    <div class="">
        
        <div class="thumbnail custhumbnail businessReview">
                
                <!-- Review Title -->

                <div class="col-sm-6">
                        <a> 
                            <h2 class="sabayjai businessReviewProfile">
                              <?=  ucwords($case['review_title']);?>
                            </h2>
                        </a>

                        <!-- Ratings and Ratings Count -->

                        <div class="detail-page-review">

                            <?=display_star_rating($case['rating'])?>

                            <p class="detail-page-review-para">
                                <font style="font-weight:normal;color:#000;" size="2px">
                                (<?=$case['rating']?> out of 5)
                                </font>
                            </p>

                        </div>

                        <!-- Business Name  -->

                        <span class="reviewed-rated">
                           Business Name:
                              <em><?=$case['title']?></em>
                        </span>
                        <br>
                        <span class="reviewed-rated">
                          Case <?=($case['case_status'] == "A" ? "Opened" : "Closed");?>  Date:
                          <em><?=get_local_time($case['case_status'] == "A" ? $case['opened_date'] : $case['closed_date']);?></em>
                        </span>
                </div>
                
                <!-- Buttons to Edit Review, Delete Review, Close Case And Delete Case  -->

                <div class="col-sm-4 featured-listing-social-icons ReviewMen1" style="font-size:10px;">

                        <!-- Reply -->

                        <a class="editReply forcePointer" onclick="message(<?=$case['case_id']?>,<?=$case['review_id']?>,<?=$case['owner_id']?>,<?=$case['member_id']?>);">Reply <span class="pipe">|</span></a>
                        

                        <!-- Case  -->

                        <? if ($case['case_status'] == "A") { ?>
                          <ul class="dropdown-menu close-case-dropdown" role="menu" aria-labelledby="my-menu">
                                <li  class="cckr"><a onclick="closeCase(<?=$case['case_id'];?>, <?=$case['review_id'];?>, 'close-keep');" class="fancy_window_closecase">Close case and keep review</a></li>
                                <li  class="ccdr"><a onclick="closeCase(<?=$case['case_id'];?>, <?=$case['review_id'];?>, 'close-delete');" class="fancy_window_closecase">Close case and delete review</a></li>
                            </ul>

                          <button type="button" class="btn btn-default dropdown-toggle btn-xs case-closebtn" data-toggle="dropdown" aria-expanded="true">
                            Close <span class="caret caret-close"></span>
                          </button>
                        <? } else { ?>
                          <button class="btn btn-default btn-xs case-openbtn delete">Closed</button>
                        <? } ?>

                </div>


                <!-- Business Image -->

                <div class="col-sm-2 featured-listing-image profileImg">
                     <?
                         $imageObj = new Image($listing->getNumber("image_id"));
                          if ($imageObj->imageExists()) {
                              // Don't display caption for now. Remove these comments to show caption
//                              $dbMain = db_getDBObject(DEFAULT_DB, true);
//                              $db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
//                              $sql = "SELECT image_caption, thumb_caption FROM Gallery_Image WHERE image_id = ".$listing->getNumber("image_id");
//                              $r = $db->query($sql);
//                              while ($row_aux = mysql_fetch_array($r)) {
//                                  $imagecaption = $row_aux["image_caption"];
//                                  $thumbcaption = $row_aux["thumb_caption"];
//                              }
//                              if (THEME_USE_BOOTSTRAP) {
//                                  $thumbcaption = system_showTruncatedText($thumbcaption, 45);
//                                  $imagecaption = system_showTruncatedText($imagecaption, 45);
//                              }
                              $listingtemplate_image = "<div class=\"no-link\" ".(RESIZE_IMAGES_UPGRADE == "off" ? "style=\"text-align:center\"" : "").">";
//                              $listingtemplate_image .= $imageObj->getTag(100, 100, 100, ($thumbcaption ? $thumbcaption : $listing->getString("title", false)), THEME_RESIZE_IMAGE);
                              $listingtemplate_image .= $imageObj->getTag(100, 100, 100, '', THEME_RESIZE_IMAGE);
                              $listingtemplate_image .= "</div>";
//                              $aux_thumbcaption = "<strong style=\"display:block\">$thumbcaption</strong>";
//                              if ($imagecaption) $listingtemplate_image .= "<p class=\"image-caption\">$aux_thumbcaption".$imagecaption."</p>";
                              $auxImgPath = $imageObj->getPath();
                          } else {
                              $isNoImage = true;
                              $listingtemplate_image = "<span class=\"no-image no-link\"></span>";
                          }

                          echo($listingtemplate_image);
                        ?>
                </div>
                
                <!-- Review Title and Review -->

                <div class="col-sm-12">
                    <hr size="1">
                    <p><?=$case['review']?></p>
                </div>

        </div> <!--/thumbnail-->

    </div>       

</section>
</div> <!-- profile-dashboard -->

<? }//end foreach ?>

  <? echo $pagination['code']; ?>

<? } else { //end if 

$variable_not_available = "cases";
include(INCLUDES_DIR."/views/view_no_reviews_leads_cases.php");

}?>



<script>

  function message(case_id, review_id, owner_id, reviewer_id){
     
        $.ajax({
              url: "case_msg.php",
              type: "POST",
              data: {
                  "rid"           : review_id,        
                  "case-id"       : case_id,
                  "owner-id"      : owner_id,
                  "member-id"     : reviewer_id
              },
              success: function( response ){
                $.fancybox.open(
                      [{
                          content    : response,
                          'width'    : 617,
                          'height'   : 509,
                          'autoSize' : false,
                          'type'     : 'iframe',
                          'closeBtn' : false,
                      }]
                );
              }
        });
  }


  function closeCase(case_id, review_id, closeOption){
        
          $.ajax({
              url: "case_close_agreement.php",
              type: "POST",
              data: {
                  "closeMethod"        : closeOption,
                  "case-id"            : case_id,
                  "account-id"         : <?=sess_getAccountIdFromSession();?>,
                  "review-id"          : review_id
              },
              success: function( response ){
                    $.fancybox.open(
                          [{'closeBtn' : false,
                              content: response,
                              'width': 617,
                              'height' : 430,
                              'autoSize' : false
                          }]
                      );

              }

          });
            
  }
</script>