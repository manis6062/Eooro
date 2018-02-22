<?
  include("../conf/loadconfig.inc.php");

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
  $maxItems = 5;

//For Pagination
  $leadscount                 = Lead::GetLeadsCountForListing($listing_id, $acctId);
  $page_number                = $_GET['page'] ? $_GET['page'] : 1;
  $number_of_results_per_page = 5;
  $pageLink   = "listing_leads.php?id=".$listing_id."&page=";
  $pagination = PaginationCustom::getPagination($number_of_results_per_page, $leadscount, $page_number, $pageLink, null, true, "#dashboard");
  $leads      = Lead::GetLeadsForListingForPagination($listing_id,$acctId, $pagination['start_from'], $number_of_results_per_page);



  # ----------------------------------------------------------------------------------------------------
  # AUX
  # ----------------------------------------------------------------------------------------------------
  extract($_GET);
  extract($_POST);

   
  $listingObj = new Listing($listing_id);
  if($listingObj->email && !empty($leads)){
        foreach ($leads as $lead) {
?>

<section class="cusreview businessReview">

    <!-- Content -->

    <div class="" id="content-<?=$lead['id']?>">
        
        <div class="thumbnail custhumbnail businessReview">
                
                <div class="col-sm-6">
                        <a> 
                            <h2 class="sabayjai">
                            <?=$lead['subject']?>
                            </h2>
                        </a>

                        <!-- From, Received date and Replied date -->

                        <div class="detail-page-review">
                        <?php  $reviewer_info = new Profile($_SESSION['SESS_ACCOUNT_ID']);?>
                            <p class="detail-page-review-para">
                                <font style="font-weight:normal;color:#000;" size="2px">
                                From : <?=$lead['first_name'] . " " . $lead['last_name']?><br>
                                Received : <?=date('M jS, Y', strtotime($lead["entered"]))?> <br>
                                <?=$lead['reply_date'] != "0000-00-00 00:00:00" ? "Replied : " . date('M jS, Y', strtotime($lead["reply_date"])) : null;?>
                                </font>
                            </p>

                        </div>
                        <?$lead_message = @unserialize($lead['message']);?>
                </div>
                

                <!-- Reply Button  -->

                <div class="col-sm-4 featured-listing-social-icons"> 
                    <a class="editReply forcePointer" id="reply-<?=$lead['id']?>" onclick="showWindow(<?=$lead['id']?>);">Reply</a>
                </div>

                <div class="col-sm-2 featured-listing-image">
                   
                </div>
                
                <!-- Lead Message Received -->

                <div class="col-sm-12">
                    <hr size="1"> 
                    <strong>Message: </strong>
                    <p class="rev"><?=$lead_message['LANG_LABEL_MESSAGE']?></p>
                    <p class="rev-reply" id="status-message-<?=$lead['id']?>" style="font-size:13px;"></p>
                </div>

                <!-- Lead Reply Window -->

                 <div id="window-<?=$lead['id']?>" class="col-sm-12" style="display:none;">
                        <textarea id="message-<?=$lead['id']?>" name="reply" rows="5" cols="88" class="writeReply-txtarea"></textarea>  
                        <button onclick="replylead(<?=$lead['id']?>, '<?=$lead['email']?>');" class="btn btn-info btnColor">Reply</button>
                        <button class="forcePointer btn btn-info btnColor" onclick="hideWindow(<?=$lead['id']?>);">Close</button>
                </div>

        </div> <!--/thumbnail-->

    </div> 

    <!-- Spinner -->

    <div id="wait-<?=$lead['id']?>" style="display:none;">
        <div class="spinner" align="center" style="margin:20px;">
           <i class="fa fa-circle-o-notch fa-spin" style="color:#FF004F;margin-top:175px;font-size:100pt;"></i><br>
           <h2 style="color:#000;font-size:17px;"> Please Wait...</h2>
        </div>
    </div>      

</section>
    <? } //leads ?>
    <? echo $pagination['code']; ?>
<? } else { //if 

  $variable_not_available = "leads";
  include(INCLUDES_DIR."/views/view_no_reviews_leads_cases.php");

} ?>

<script>

    function sanitizeString(str){
        str = str.replace(/[^a-z0-9áéíóúñü \.,_-]/gim,"");
        return str.trim();
    }

    function replylead(lead_id, to){
        $("#wait-"+lead_id).show();
        $("#content-"+lead_id).hide();
        var value = $('#message-'+lead_id).val();
        body = sanitizeString(value);
        sendMessage(lead_id, to ,value);
    }

    function sendMessage(lead_id, to, body) {
        $.ajax({
          method: "POST",
          url: '<?=DEFAULT_URL."/".MEMBERS_ALIAS."/ajax.php"?>',
          data: {   
                    action      : 'reply',
                    ajax_type   : 'lead_reply',
                    idLead      : lead_id,
                    item_id     : <?=$listing_id?>,
                    item_type   : 'Listing',
                    message     : body,
                    to          : to,
                    type        : 'Listing'

                }
        })
          .done(function( msg ) {   

            if ( msg.trim() == "ok"){
                $("#wait-"+lead_id).hide();
                $("#content-"+lead_id).show();
                $("#status-message-"+lead_id).html('<font color="green">Success! Your email was sent.</font>');
                $("#window-"+lead_id).hide();
            } else {
                $("#wait-"+lead_id).hide();
                $("#content-"+lead_id).show();
                $("#status-message-"+lead_id).html('<font color="red">Sorry, Your email was not sent.</font>');
            }

        });
    }

    function showWindow(id){
        $('#window-'+id).show('fast');
    }

    function hideWindow(id){
        $('#window-'+id).hide('fast');
    }

</script>