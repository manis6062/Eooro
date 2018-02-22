<?
  
  # ----------------------------------------------------------------------------------------------------
  # * FILE: /members/listing/review-collector.php
  # ----------------------------------------------------------------------------------------------------

  # ----------------------------------------------------------------------------------------------------
  # LOAD CONFIG
  # ----------------------------------------------------------------------------------------------------
  include("../../../conf/loadconfig.inc.php");
  include_once CLASSES_DIR.DIRECTORY_SEPARATOR.'class_ReviewCollector.php';
  include_once EDIRECTORY_ROOT . '/custom/domain_1/theme/review/common_functions.php';
  
  # ----------------------------------------------------------------------------------------------------
  # SESSION
  # ----------------------------------------------------------------------------------------------------
  sess_validateSession();
  $acctId = sess_getAccountIdFromSession();
  $contact = new Contact($acctId);
  $sponsor_firstname  = ucfirst($contact->first_name);
  $sponsor_lastname   = ucfirst($contact->last_name);
  $sponsor_email    = $contact->email;
  $listing_id = mysql_real_escape_string($_GET['id']);
  
  # ----------------------------------------------------------------------------------------------------
  # AUX
  # ----------------------------------------------------------------------------------------------------
  extract($_GET);
  extract($_POST);

  # ----------------------------------------------------------------------------------------------------
  # HEADER
  # ----------------------------------------------------------------------------------------------------
  // include(MEMBERS_EDIRECTORY_ROOT."/layout/header.php");

  # ----------------------------------------------------------------------------------------------------
  # NAVBAR
  # ----------------------------------------------------------------------------------------------------
  // include(MEMBERS_EDIRECTORY_ROOT."/".LISTING_FEATURE_FOLDER."/navbar.php");

  $item_type = "Listing";
  $item_id = $listing_id;
  $itemObj = new $item_type($item_id);
  $reviewTable = "Listing";
  $item_hasreview = true;
  $levelObj = new ListingLevel();
  $itemObj->status == "P" ? $allow_reply = false : $allow_reply = true;

//For Pagination
$reviewscount               = Review::getCollectedReviewsCountByListingID($listing_id);
$page_number                = $_GET['page'] ? $_GET['page'] : 1;
$number_of_results_per_page = 5;

$pageLink   = "listing/review-collector/collected-reviews.php?id=".$listing_id."&page=";
$pagination = PaginationCustom::getPagination($number_of_results_per_page, $reviewscount, $page_number, $pageLink, null, true, "#dashboard");
$reviewsArr = Review::GetCollectedReviews($acctId, $listing_id, $pagination['start_from'] , $number_of_results_per_page);
?>
<div class="reviewCollector">
    <h2>Collected Reviews</h2>
        <div role="tabpanel">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs reviewCollector-tabs text-center" role="tablist">
              <li class="col-sm-4 col-xs-12">
                <a id="add-customers" class="bg1">Add Customers</a>
              </li>
              <li class="col-sm-4 col-xs-12">
                <a id="pending-list" class="bg1">Pending List</a>
              </li>
              <li class="active col-sm-4 col-xs-12">
                <a id='collected-reviews' class="bg1">Collected Reviews</a>
              </li>
              
            </ul>
        </div>
<? if($reviewsArr) { ?>
<? foreach($reviewsArr as $review){ 

    $has_case = Review::HasCase($review['id']);
    $reviewer_info = new Profile($review['member_id']);
    $info = (array) $reviewer_info;
    ?>

    <section class="cusreview businessReview collected">

    <!-- Content -->

    <div id="content-<?=$review['id']?>">
           
            <div class="thumbnail custhumbnail businessReview">
                    
                    <div class="col-sm-6">
                            <a> 
                                <h2 class="sabayjai">
                                  <?=  ucwords($review['review_title'])?>
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
                                Reviewed &amp; Rated by:
                                <span itemprop="name">
                                  <em><?=ucwords($review['reviewer_name'])?></em>
                                </span>  
                            </span>
                    </div>
                    
                    <div class="col-sm-4 featured-listing-social-icons businessRe">
                        <p style="font-size:16px;font-weight:normal;cursor:pointer;">
                            <a class="editReply" onclick="showWindow(<?=$review['id']?>)"><?=($review['response'] ? 'Edit' : 'Write');?> Reply <span class="pipe">|</span></a>
                              <? if ($has_case) { 
                                 if ($has_case != "I" ){
                                ?>
                                <a class="editReply" onclick="viewCase(<?=$review['id']?>);">
                                View Case
                                </a>
                                <? } else {?>
                                <a class="editReply" onclick="$('#bill').click();">Pay to activate case</a>
                                <? } ?>
                            <? } else { ?>
                            <? if ($allow_reply == true): ?>
                                <a href="<?=DEFAULT_URL .'/sponsors/popup/popup.php?pop_type=opencase&review='.$review['id'];?>" class="fancy_window_opencase businessOpencase editReply">
                            <? else:?>
                                <a class="editReply" onclick="loadfancy();">
                            <?endif;?>                                
                                Open Case
                                </a>
                            <? } ?>
                        </p>
                    </div>

                    <div class="col-sm-2 featured-listing-image">

                        <?  if (!$info["facebook_image"]) {
                                $imgObj = new Image($info["image_id"], true);
                                if ($imgObj->imageExists()) {
                                    echo $imgObj->getTag(true, "100", "100");
                                } else {
                                    echo "<div class=\"profile-noimage\"><img src='".DEFAULT_URL."/images/profile_noimage.png'></div>";
                                }
                            } else {

                                if (HTTPS_MODE == "on") {
                                    $info["facebook_image"] = str_replace("http://", "https://", $info["facebook_image"]);
                                } ?>

                                <img width="100" height="100" src="<?=$info["facebook_image"]?>" border="0" alt="Facebook Image"/>

                        <? } ?>

                    </div>
                    
                    <!-- Review Title and Review -->
                    <div class="col-sm-12">
                        <hr size="1"> 
                        <p class="rev"><?=$review['review']?></p>
                        <p class="rev-reply" id="append-reply-<?=$review['id']?>"><?=($review['response'] ? 'Reply : ' . $review['response'] : null);?></p>
                    </div>

                    <div id="window-<?=$review['id']?>" class="col-sm-12" style="display:none;">
                        <textarea id="message-<?=$review['id']?>" name="reply" rows="5" cols="88" class="collectedReviewsTextarea"></textarea>
                        
                        <button onclick="reply(<?=$review['id']?>);" class="btn btn-info btnColor">Reply</button>
                        <button class="forcePointer btn btn-info btnColor" onclick="hideWindow(<?=$review['id']?>);">Close</button>

                    </div>

            </div> <!--/thumbnail-->
    
    </div>

    <!-- Spinner -->

    <div id="wait-<?=$review['id']?>" style="display:none;">
        <div class="spinner" align="center" style="margin:20px;">
           <i class="fa fa-circle-o-notch fa-spin" style="color:#FF004F;margin-top:175px;font-size:100pt;"></i><br>
           <h2 style="color:#000;font-size:17px;"> Please Wait...</h2>
        </div>
    </div>

    </section>

    <? } ?>
<?=$pagination['code']?>
<? } else {
    $variable_not_available = "collected reviews";
    include(INCLUDES_DIR."/views/view_no_reviews_leads_cases.php");
} ?>
</div>

<script>
function loadData(page){
  if(page != "99999"){
    $('#dashboard').load('listing/review-collector/collected-reviews.php?id=<?=$id?>&page='+page);
  }
}
</script>

<script>
$('#pending-list').click(function(e){
  e.preventDefault();
  showspinner();
  $('#dashboard').load('listing/review-collector/pending-list.php?id='+<?=$id?>, function() {
        hidespinner();
    }); 
});

$('#add-customers').click(function(e){
  e.preventDefault();
  showspinner();
  $('#dashboard').load('listing/review-collector.php?id='+<?=$id?>, function() {
        hidespinner();
    }); 
});
</script>
<script>
    // to open case
    function showCase( info ){
        $.ajax({
            url: "<?=AJAX_REQ?>",
            type: "POST",
            data: { mod:"casemanager", con:"opencase", details : info },
            success: function ( response, status, jqXHR ){
            }
        });
    }

    function viewCase(case_id){
        showspinner();
        $('#dashboard').load('<?=EXTRAS_REQ.DIRECTORY_SEPARATOR."case.php?id="?>'+case_id, function() {
            hidespinner();
        }); 
    }

    function showWindow(id){
        $('#window-'+id).show('fast');
    }

    function hideWindow(id){
        $('#window-'+id).hide('fast');
    }

  function loadfancy(){
    $.fancybox({
        'padding':  0,
        'width'  :  500,
        'height' :  500,
        closeBtn :  false,
        content  : '<div style=\'height:200px;width:400px;font-size:12px;\'>\
                        <div class="modal-content">\
                        <h2>\
                            Activate Your Business\
                            <span>\
                                <a href="javascript:void(0);" onclick="parent.$.fancybox.close();">Close</a>\
                            </span>\
                        </h2>\
                        </div>\
                    <br>\
                        <div style=\'margin-left:10px;\'>\
                            <p align="center">Please Activate your business to use this feature.</p>\<br><br>\
                                <p class="standardButton claimButton listingButton forcePointer" style="text-decoration:none;">\
                                    <a onclick="menuItemClick(\'billing\',\'bill\');parent.$.fancybox.close();">Click Here To Activate</a>\
                                </p>\
                        </div>\
                    </div>'
    });
  }

  function reply(id){
    $("#wait-"+id).show();
    $("#content-"+id).hide();
    var value = $('#message-'+id).val();
    value = sanitizeString(value);
    saveReply(id,<?=$listing_id?>, value);
  }

  function sanitizeString(str){
      str = str.replace(/[^a-z0-9áéíóúñü \.,_-]/gim,"");
      return str.trim();
  }

  function saveReply(review_id, listing_id, body) {
      $.ajax({
        method: "POST",
        url: '<?=DEFAULT_URL."/".MEMBERS_ALIAS."/ajax.php"?>',
        data: {   
                  ajax_type : 'review_reply',
                  idReview  : review_id,
                  item_id   : listing_id,
                  item_type : 'listing',
                  reply     :  body
              }
      })
        .done(function( msg ) {           
          if ( msg.trim() == "ok"){
              $('#append-reply-'+review_id).html('Reply: '+body);
              $("#wait-"+review_id).hide();
              $("#content-"+review_id).show();   
          } else {
              $('#append-reply-'+review_id).html('<font size="2px" color="red">Sorry, something\'s not right, please try again.<font>');
              $("#wait-"+review_id).hide();
              $("#content-"+review_id).show();   
          }

      });
  }

</script>