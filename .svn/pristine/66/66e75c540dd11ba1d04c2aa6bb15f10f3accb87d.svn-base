<?
if(!$_SERVER['HTTP_X_REQUESTED_WITH']){
    header("Location:".DEFAULT_URL."/".ALIAS_LISTING_MODULE);
    exit;
}

include("../conf/loadconfig.inc.php");
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
$listingObj = new Listing($listing_id);
$listingObj->status == "P" ? $allow_reply = false : $allow_reply = true;

# ----------------------------------------------------------------------------------------------------
# AUX
# ----------------------------------------------------------------------------------------------------
extract($_GET);
extract($_POST);

//For Pagination
$reviewscount               = Review::giveMeTotalReviews($acctId, $listing_id);
$page_number                = $_GET['page'] ? $_GET['page'] : 1;
$number_of_results_per_page = 5;
$pageLink   = "listing_reviews.php?id=".$listing_id."&page=";
$pagination = PaginationCustom::getPagination($number_of_results_per_page, $reviewscount, $page_number, $pageLink, null, true, "#dashboard");
$reviewsArr = Review::GetReviews($acctId, $listing_id, $pagination['start_from'] , $number_of_results_per_page);

if($reviewsArr) { ?>

<? foreach($reviewsArr as $review){ 

    $has_case = Review::HasCase($review['id']);
    $reviewer_info = new Profile($review['member_id']);
    $info = (array) $reviewer_info;
    ?>

    <section class="cusreview businessReview">

    <!-- Content -->

    <div id="content-<?=$review['id']?>">
           
            <div class="thumbnail custhumbnail businessReview">
                    
                    <div class="col-sm-6">
                            <a> 
                                <h2 class="sabayjai">
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
                                Reviewed &amp; Rated by:
                                <span itemprop="name">
                                <em>
                                  <?//=ucwords($info['nickname'])?>
                                    <?=htmlspecialchars(ucwords($review['reviewer_name']))?> 
                                </em>
                                </span>  
                                    <?php echo "on ".date('d M Y', strtotime($review['added']));  ?>
                            </span>
                    </div>
                    
                    <div class="col-sm-4 featured-listing-social-icons businessRe">
                        <p style="font-size:16px;font-weight:normal;cursor:pointer;">
                        <? if ($allow_reply == true): ?>
                            <a class="editReply" onclick="showWindow(<?=$review['id']?>)"><?=($review['response'] ? 'Edit' : 'Write');?> Reply <span class="pipe">|</span></a>
                        <? else:?>
                            <a class="editReply" onclick="loadfancy();">Write Reply <span class="pipe">|</span></a>
                        <?endif;?>
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
                                    echo "<div class=\"profile-noimage\"></div>";
                                }
                            } else {
                                
                                if(checkExpiredImage($info['facebook_image']) == "URL signature expired" || checkExpiredImage($info['facebook_image']) == "Content not found"){
                                   $info["facebook_image"] =  ''; 
                                }
                                else{
                                     if (HTTPS_MODE == "on") {
                                    $info["facebook_image"] = str_replace("http://", "https://", $info["facebook_image"]);
                                }
                                    
                                }
                                
                                

                                ?>

                                <img width="100" height="100" src="<?=$info["facebook_image"]?>" border="0" alt="Facebook Image"/>

                        <? } ?>

                    </div>
                    
                    <!-- Review Title and Review -->
                    <div class="col-sm-12">
                        <hr size="1"> 
                        <p class="rev"><?=nl2br(htmlspecialchars($review['review']))?></p>
                        <p class="rev-reply" id="append-reply-<?=$review['id']?>"><?=($review['response'] ? 'Reply : ' . nl2br(htmlspecialchars($review['response'])) : null);?></p>
                    </div>

                    <div id="window-<?=$review['id']?>" class="col-sm-12" style="display:none;">
                        <textarea id="message-<?=$review['id']?>" name="reply" rows="5" cols="88" class="writeReply-txtarea"></textarea>
                        
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
<?//$pagination['code']?>
<? } else { //if 

  $variable_not_available = "reviews";
  include(INCLUDES_DIR."/views/view_no_reviews_leads_cases.php");
  
} ?>

<script type="text/javascript" >

        // function sanitizeString(str){
        //     str = str.replace(/[^a-z0-9áéíóúñü\s\n\r\.,_-]/gim,"");
        //     return str.trim();
        // }

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
                    body=body.replace(/[\u00A0-\u9999<>\&]/gim, function(i) {
                      return '&#' + i.charCodeAt(0) + ';';
                    });
                    $('#append-reply-'+review_id).html('Reply: '+(changeNlToBr(body)));
                    //$("#wait-"+review_id).hide();
                    hidespinner();
                    $("#content-"+review_id).show();
                    $("#window-"<?=$review['id'] ? '+'.$review['id'] : '' ?>).hide();   
                } else {
                    $('#append-reply-'+review_id).html('<font size="2px" color="red">Sorry, something\'s not right, please try again.<font>');
                    //$("#wait-"+review_id).hide();
                    hidespinner();
                    $("#content-"+review_id).show();   
                }

            });
        }

        function reply(id){
            //$("#wait-"+id).show();
            $("#content-"+id).hide();
            var value = $('#message-'+id).val();
            
            showspinner();
            saveReply(id,<?=$listing_id?>, value);
            //hideWindow(id);
        }

        // popup
        $("a.fancy_window_opencase").fancybox({
            'closeBtn'      : false,
            'padding'       : 0,
            'type'          : 'iframe',
            'width'         : 600
        });
        
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

</script>