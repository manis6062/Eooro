<?
include("../conf/loadconfig.inc.php");
  if(!$_SERVER['HTTP_X_REQUESTED_WITH']){
      header("Location:".DEFAULT_URL."/".ALIAS_LISTING_MODULE);
      exit;
  }

  //Watching public reviews not working fix
  $explode_url  = explode("page=", $_SERVER['REQUEST_URI']);
  $get = $explode_url[1];
  $get ? $_GET['page'] = $get : null;

  include(EDIRECTORY_ROOT."/".SOCIALNETWORK_FEATURE_NAME."/mod_rewrite.php");
  include(EDIRECTORY_ROOT."/custom/domain_1/theme/".EDIR_THEME."/common_functions.php");

  $id            = mysql_real_escape_string($id);
  $reviewer_id   = $id;      
  $reviewer_info = new Profile($id);

  $acctidFromSession = sess_getAccountIdFromSession();
  $acctidFromGet     = $id;
  $acctidFromSession == $acctidFromGet ? $showedit = true : $showedit = false;


  //For Pagination
  $reviewscount               = Review::getReviewsCountByAccountID($id);
  $page_number                = $_GET['page'] ? $_GET['page'] : 1;
  $number_of_results_per_page = 5;
  $pagination = PaginationCustom::getPagination($number_of_results_per_page, $reviewscount, $page_number, "reviews.php?page=", null, true, "#body");
  $reviewsArr = Review::getReviewsByAccountIDForPagination($id, $pagination['start_from'], $number_of_results_per_page);


if($reviewsArr) { ?>

<? foreach($reviewsArr as $review){ 


    $has_case = Review::HasCase($review['id']);
    $reviewer_info = new Profile($review['member_id']);
    $listing = new Listing($review['item_id']);
    $info = (array) $reviewer_info;


    $url        = DEFAULT_URL . "/" . ALIAS_LISTING_MODULE . "/" . $listing->friendly_url;

    ?>

    <div class="profile-dashboard">
    <section class="cusreview businessReview">

    <!-- Review Wrapper -->

    <div id="content-<?=$review['id']?>">

        <div class="" id="row-<?=$review['id']?>">
            
            <div class="thumbnail custhumbnail businessReview">
                    
                    <div class="col-sm-6">
                            <a> 
                                <h2 class="sabayjai businessReviewProfile">
                                  <?=htmlspecialchars(ucwords($review['review_title']))?>
                                </h2>
                            </a>

                            <!-- Ratings and Ratings Count -->

                            <div class="detail-page-review">

                                <?=display_star_rating($review['rating'])?>

                                <p class="detail-page-review-para">
                                    <font style="font-weight:normal;color:#000;" size="2px">
                                    (<?=$review['rating']?> out of 5)
                                    </font>
                                </p>

                            </div>

                            <span class="reviewed-rated">
                                Business Name:
                                <span itemprop="name">
                                  <em><a href="<?=$url?>"><?=htmlspecialchars(ucwords($listing->title))?></a></em>
                                </span>
                            </span>
                    </div>

                    <? if($showedit == true) { ?>
                    
                    <!-- Edit Review -->

                    <div class="col-sm-4 featured-listing-social-icons ReviewMen">
                        <p style="font-size:10px;">
                            <a id='<?=$review['id']?>' rel="nofollow" href="<?=NON_SECURE_URL?>/profile/popup.php?id=<?=urlencode($review['id'])?>" class="reviewThis iframe fancy_window_review editReply forcePointer">
                              Edit <span class="pipe">|</span> 
                            </a>
                            <!-- Delete Review -->
                            <a onclick="deleteReviewPrompt(<?=$review['id']?>,<?=($has_case ? "true" : "false");?>);" href="javascript:;" class="editReply forcePointer reviewThis confirm_case">Delete</a>

                    </div>
                    <?}?>
                    <div class="col-sm-2 featured-listing-image ReviewImg">

                        <?
                         $imageObj = new Image($listing->getNumber("image_id"));
                          if ($imageObj->imageExists()) {

                              $dbMain = db_getDBObject(DEFAULT_DB, true);
                              $db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
                              $sql = "SELECT image_caption, thumb_caption FROM Gallery_Image WHERE image_id = ".$listing->getNumber("image_id");
                              $r = $db->query($sql);
                              while ($row_aux = mysql_fetch_array($r)) {
                                  $imagecaption = $row_aux["image_caption"];
                                  $thumbcaption = $row_aux["thumb_caption"];
                              }
                              if (THEME_USE_BOOTSTRAP) {
                                  $thumbcaption = system_showTruncatedText($thumbcaption, 45);
                                  $imagecaption = system_showTruncatedText($imagecaption, 45);
                              }
                              $listingtemplate_image = "<div class=\"no-link\" ".(RESIZE_IMAGES_UPGRADE == "off" ? "style=\"text-align:center\"" : "").">";
                              $listingtemplate_image .= $imageObj->getTag(100, 100, 100, ($thumbcaption ? $thumbcaption : $listing->getString("title", false)), THEME_RESIZE_IMAGE);
                              $listingtemplate_image .= "</div>";
                              $aux_thumbcaption = "<strong style=\"display:block\">$thumbcaption</strong>";
                              if ($imagecaption) $listingtemplate_image .= "<p class=\"image-caption\">$aux_thumbcaption".$imagecaption."</p>";
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
                        <p class="rev"><em style="font-size:16px;"><?php echo date('d M Y', strtotime($review['added']));  ?> - </em><?=nl2br(htmlspecialchars($review['review']))?></p>
                        <p class="rev-reply" id="append-reply-<?=$review['id']?>"><?=($review['response'] ? 'Reply : ' . $review['response'] : null);?></p>
                    </div>

                    <div id="window-<?=$review['id']?>" class="col-sm-12" style="display:none;">
                        <a onclick="hideWindow(<?=$review['id']?>);" style="float:right;">Close</a>
                        <textarea id="message-<?=$review['id']?>" name="reply" rows="5" cols="88"></textarea>
                        
                        <button onclick="reply(<?=$review['id']?>);" class="btn btn-info btnColor">Reply</button>

                    </div>

            </div> <!--/thumbnail-->

        </div>

    
    </div>

    <!-- Spinner -->

    <div id="wait-<?=$review['id']?>" style="display:none;">
        <div class="spinner" align="center" style="margin:20px;">
           <i class="fa fa-circle-o-notch fa-spin" style="color:#FF004F;margin-top:175px;font-size:100pt;"></i><br>
           <h2 style="color:#000;font-size:17px;"> Please Wait...</h2>
        </div>
    </div>

    </section>
    </div> <!-- profile-dashboard -->

    <? } ?>
    <script>

    function sanitizeString(str){
      str = str.replace(/[^a-z0-9áéíóúñü \.,_-]/gim,"");
      return str.trim();
    }

    function deleteReviewPrompt(review_id,has_case){
      if(has_case == true){
        fancyConfirm('This review has a case opened, Are you sure you want to delete it ?', review_id);
      } else {
        fancyConfirm('Are you sure you want to delete this review ?', review_id);
      }
    }

    function fancyConfirm(msg, review_id) {
      jQuery.fancybox({
          'height' : 70,
          'modal' : true,
          'content' : "<div class=\"modal-content\"><h2><span>Warning!</span><span><a href=\"javascript:void(0);\" onclick=\"jQuery.fancybox.close();\"><?=system_showText(LANG_CLOSE);?></a></span></h2><div style=\"width:240px;\" class=\"sureDelete\">"+msg+"<div style=\"text-align:right;margin-top:10px;\"><button id=\"fancyConfirm_ok\" style=\"padding:4px 6px;\" type=\"button\" class=\"btn btnOk\">Ok</button><button id=\"fancyconfirm_cancel\" style=\"padding:4px 6px;\" type=\"button\" class=\"btn btnCancel\" >Cancel</button></div></div></div>",
          'beforeShow' : function() {
             
              
              jQuery("#fancyConfirm_ok").click(function() {
                  deleteReview(review_id,<?=$id?>);
                    showspinner();
                    $('#body', parent.document).load('reviews.php', function(){
                        hidespinner();
                        jQuery.fancybox.close();
                    });
              });
               jQuery("#fancyconfirm_cancel").click(function() {
                  jQuery.fancybox.close();
              });
          }
      });
    }

    function deleteReview(review_id, reviewer_id){
        $.ajax({
          method: "POST",
          url: "ajax.php",
          data: { 
                  ajax_type   : "review_delete", 
                  review_id   : review_id,
                  reviewer_id : reviewer_id
                }
        })
          .done(function( msg ) {
            $('#dashboard').append(msg);
        });

    }
</script>

  <? echo $pagination['code']; ?>

<? } else { 

$variable_not_available = "reviews";
include(INCLUDES_DIR."/views/view_no_reviews_leads_cases.php");

}?>