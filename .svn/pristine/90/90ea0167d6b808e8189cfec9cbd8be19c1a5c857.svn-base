<?

  include("../conf/loadconfig.inc.php");
  include_once CLASSES_DIR.DIRECTORY_SEPARATOR.'class_Opened_Cases.php';
  include(EDIRECTORY_ROOT."/custom/domain_1/theme/".EDIR_THEME."/common_functions.php");


  if(!$_SERVER['HTTP_X_REQUESTED_WITH']){

        header("Location:".DEFAULT_URL."/".ALIAS_LISTING_MODULE);
        exit;
  }

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

  $item_type 		= "Listing";
  $item_id 			= $listing_id;
  $itemObj 			= new $item_type($item_id);
   

//For Pagination
  $casescount               = Opened_Cases::getThisLisitngCasesCount($listing_id);
  $page_number                = $_GET['page'] ? $_GET['page'] : 1;
  $number_of_results_per_page = 5;
  $pageLink   = "listing_cases.php?id=".$listing_id."&page=";
  $pagination = PaginationCustom::getPagination($number_of_results_per_page, $casescount, $page_number, $pageLink, null, true, "#dashboard");
  $cases = Opened_Cases::getThisLisitngCasesForPagination($listing_id, $pagination['start_from'], $number_of_results_per_page);

  if($cases) {
    foreach ($cases as $case) { 

    	$reviewer_info 	  = new Profile($case['member_id']);
      $info 			  = (array) $reviewer_info;
      $reasonToOpenCase = Opened_Cases::getReasonToOpenThisCase($case['case_id']);

  	?>


  <section class="cusreview businessReview">

        
        <div class="thumbnail custhumbnail businessReview">
                
                <!-- Review Title -->

                <div class="col-sm-6">
                        <a> 
                            <h2 class="sabayjai">
                              <?=  ucwords($case['review_title'])?>
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

                        <span class="reviewed-rated">
                            Reviewed by:
                              <em><?=ucwords($case['reviewer_name'])?></em>
                        </span>
                </div>


                <!-- Case Status -->

                <div class="col-sm-4 featured-listing-social-icons case" style="font-size:15px; cursor:pointer;"> 
                		<? if($case['case_status'] == 'A'){ ?>
                        	<a class="editReply" onclick="showCase(<?=$case['review_id']?>);"> View Cases</a>
                        <? } elseif($case['case_status'] == 'C') { ?>
                        	<a class="editReply" onclick="showCase(<?=$case['review_id']?>);">View Case.</a><br>This case is closed.
                        <? } elseif($case['case_status'] == 'I') { ?>
                        	<a class="editReply" onclick="$('#bill').click();">Pay to activate case</a>
                        <? } ?>
                </div>

                <!-- Reviewer Image -->

                <div class="col-sm-2 featured-listing-image">
                    <?  if (!$info["facebook_image"]) {
                                $imgObj = new Image($info["image_id"], true);
                                if ($imgObj->imageExists()) {
                                    echo $imgObj->getTag(true, 100, 100);
                                } else {
                                    echo "<div class=\"profile-noimage\"><img src='".DEFAULT_URL."/images/profile_noimage.png'></div>";
                                }
                            } else {

                                 if(checkExpiredImage($info['facebook_image']) == "URL signature expired" || checkExpiredImage($info['facebook_image']) == "Content not found"){
                                   $info["facebook_image"] =  DEFAULT_URL . "/images/profile_noimage.png"; 
                                }
                                else{
                                     if (HTTPS_MODE == "on") {
                                    $info["facebook_image"] = str_replace("http://", "https://", $info["facebook_image"]);
                                }
                                    
                                } ?>

                                <img width="<?=$info["facebook_image_width"] ? $info["facebook_image_width"] : 100?>" height="<?=$info["facebook_image_height"] ? $info["facebook_image_height"] : 100?>" src="<?=$info["facebook_image"]?>" border="0" alt="Facebook Image"/>

                    <? } ?>
                </div>
                
                <!-- Review Title and Review -->

                <div class="col-sm-12">
                    <hr size="1">
                    <p class="rev"><?=$case['review']?></p>
                    <p class="rev-reply">Reason to Open Case : <?=$case['review']?></p>
                </div>

        </div> <!--/thumbnail-->

     

</section>

<? } //end froreach ?>
<? echo $pagination['code']; ?>
<? } else { //if cases 
  $variable_not_available = "cases";
  include(INCLUDES_DIR."/views/view_no_reviews_leads_cases.php");

 } ?>
<script>
function showCase(case_id){
    showspinner();
    $('#dashboard').load('<?=EXTRAS_REQ.DIRECTORY_SEPARATOR."case.php?id="?>'+case_id, function() {
        hidespinner();
    }); 
}
</script>



