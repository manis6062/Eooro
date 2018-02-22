<?
  
  # ----------------------------------------------------------------------------------------------------
  # * FILE: /members/listing/review-collector.php
  # ----------------------------------------------------------------------------------------------------

  # ----------------------------------------------------------------------------------------------------
  # LOAD CONFIG
  # ----------------------------------------------------------------------------------------------------
  include("../../../conf/loadconfig.inc.php");
  include_once CLASSES_DIR.DIRECTORY_SEPARATOR.'class_ReviewCollector.php';
  
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
  # Pagination
  # ----------------------------------------------------------------------------------------------------

  $this_page_no = ($_GET['page'] ? $_GET['page'] : 1 );
  $actual_page = $_GET['page'];
  $number_of_results_per_page = 5;

  $total_entries = ReviewCollector::GetTotalRequestedReviews($acctId, $listing_id);
  $paginates = ceil($total_entries / $number_of_results_per_page);

  $start_from = ($this_page_no * $number_of_results_per_page) - $number_of_results_per_page;
  if($_GET['sort'] && $_GET['order']){
    $sort       = "firstname";
    $sort_order = $_GET['order'];

    $_GET['sort'] == "name"           ? $sort = "firstname" : null ;
    $_GET['sort'] == "email"          ? $sort = "email" : null ;
    $_GET['sort'] == "first_request"  ? $sort = "first_request_sent_on" : null ;
    $_GET['sort'] == "last_request"   ? $sort = "last_request_sent_on" : null ;
    $_GET['sort'] == "remarks"        ? $sort = "status" : null ;

    $customer_info = ReviewCollector::GetRequestedReviewsInfoSort($acctId, $listing_id, $start_from ,$number_of_results_per_page,$sort, $sort_order);
  } else {
    $customer_info = ReviewCollector::GetRequestedReviewsInfoNoSort($acctId, $listing_id, $start_from ,$number_of_results_per_page);
  }

  # ----------------------------------------------------------------------------------------------------
  # AUX
  # ----------------------------------------------------------------------------------------------------
  extract($_GET);
  extract($_POST);

    $_GET['order'] =="ASC" ? $odr = "DESC" : $odr ="ASC";

  ?>

<div class="reviewCollector">
      <h2>Pending List</h2>
          
          <div role="tabpanel">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs reviewCollector-tabs text-center" role="tablist">
              <li class="col-sm-4 col-xs-12">
                <a id="add-customers" class="bg1">Add Customers</a>
              </li>
              <li class="active col-sm-4 col-xs-12">
                <a id="pending-list" class="bg1">Pending List</a>
              </li>
              <li class="col-sm-4 col-xs-12">
                <a id='collected-reviews' class="bg1">Collected Reviews</a>
              </li>
              
            </ul>
        </div>
          
          <div role="tabpanel" class="tab-pane" id="pendingLists">
            <table class="table table-bordered reviewCollect pendingLists table-hover">
                <thead>
                  <tr>
                    <th class="th-padding">Name</a></th>
                    <th class="th-padding">Email</th></th>
                    <th class="th-padding">1st request</th></th>
                    <th class="th-padding">Last Request</a></th>
                    <th class="th-padding">Remarks</th>
                    <th class="th-padding"></th>
                  </tr>
                </thead>
                <tbody>
                <? foreach ($customer_info as $key => $info ) { ?>
                  <tr class="customerdatarow">
                    <td id="name<?=$info['id']?>" onblur="changed('name','<?=$info['id']?>', this.innerHTML);" contenteditable="true"><?=$info['firstname']?> <?=$info['lastname']?></td>
                    <td id="email<?=$info['id']?>"onblur="changed('email','<?=$info['id']?>', this.innerHTML);" contenteditable="true"><?=$info['email']?></td>
                    <? 
                      if( $info['first_request_sent_on'] ){
                          $info['first_request_sent_on'] = date('F j Y',strtotime($info['first_request_sent_on']));
                        } else {
                          $info['first_request_sent_on'] = " - ";
                        }

                      if( $info['last_request_sent_on'] ){
                          $info['last_request_sent_on'] = date('F j Y',strtotime($info['last_request_sent_on']));
                        } else {
                          $info['last_request_sent_on'] = " - ";
                        }
                    ?>
                    <td><?=$info['first_request_sent_on']?></td>
                    <td><?=$info['last_request_sent_on']?></td>
                    <td>
                      <?=$info['status']?>
                    </td>
                    <th class="th-padding forcePointer closeItem"><i id="delete<?=$info['id']?>" onClick="deleteCustomer(<?=$info['id']?>)" class="fa fa-times"></i></th>
                  </tr>
                <? } ?>
                </tbody>
            </table>
          </div>

<? 
    /**
     * @Pagination
     */

    $limit = 10;
    $page_number = $this_page_no;
    $count = $page_number;
    $this_page_no = $page_number;
    $screen = 1;
    $paginates < $limit ? $limit = $paginates : null;

if($paginates > 0) {

   ?>    
    <div id="pendingList-pagi" style="text-align: center;">
          <ul class="pagination plPagi">
            
            <li>       
               <a onclick="loadData('1')";>&laquo; Start</a>
            </li>

            <li>       
              <a onclick="loadData(<?=($this_page_no > 1 ? $this_page_no - 1 : "99999");?>);">&laquo; Prev</a>
            </li>

            <? for($i = $page_number - 4 ; $i <= min($page_number + 9, $paginates); $i++) { ?>
              
                <li <?=($page_number == $i ? 'class="active"' : null)?>>

                <? if ($i > 0 && $page_number < 5 && $i <= 10 ) { ?>
                  <a onclick="loadData(<?=$i?>);">      
                    <?=($i <= 10 ? $i : null)?>
                  </a>

                <? } else { ?>

                  <? if ( $i > 0 && $i < $page_number + 6) { ?>
                      <a onclick="loadData(<?=$i?>);">
                        <?=$i?>
                      </a>
                  <? } ?>

                <? } ?>
            
                </li>
            <? } ?>
            
            <li <?=(($count > $paginates) ? "class='disabled'" : "");?>>
              <a onclick="loadData(<?=(($this_page_no < $paginates) ? $url.($this_page_no + 1) : "99999");?>);">&raquo; Next</a>
            </li>

            <li>       
              <a onclick="loadData('<?=$paginates;?>')";>&raquo; End</a>
            </li>

          </ul>
    </div>
<? } ?>

</div> <!-- container reviewcollector -->
<div style="margin-bottom:20px;"></div>

<script>
function loadData(page){
  if(page != "99999"){
    $('#dashboard').load('listing/review-collector/pending-list.php?id=<?=$id?>&page='+page);
  }
}
</script>


<script>
$('#collected-reviews').click(function(e){
  e.preventDefault();
  showspinner();
  $('#dashboard').load('listing/review-collector/collected-reviews.php?id='+<?=$id?>, function() {
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

$('#pending-list').click(function(e){
  e.preventDefault();
  showspinner();
  $('#dashboard').load('listing/review-collector/pending-list.php?id='+<?=$id?>, function() {
        hidespinner();
    }); 
});
</script>

<script>

  function deleteCustomer(id){  
      $.fancybox({
          content: '<div class="modal-content">\
                      <h2><span>Warning!</span><span>\
                      <a href="javascript:void(0);" onclick="jQuery.fancybox.close();">Close</a></span></h2>\
                      <div style="width:240px;" class="sureDelete">\
                      <p id="model-text">Are you sure you want to delete this customer ?</p>\
                      <p id="model-text-done" style="display:none;">Success! Customer deleted.</p>\
                      <p id="model-text-failed" style="display:none;">Sorry something\'s not right.<br>Please try again.</p>\
                      <div style="text-align:right;margin-top:10px;">\
                      <button id="ok-model-button" onclick="deleteRecord('+id+');jQuery.fancybox.close();" style="padding:4px 6px;" type="button" class="btn btnOk">Ok</button>\
                      <button id="cancel-model-button"style="padding:4px 6px;" onclick="jQuery.fancybox.close();" type="button" class="btn btnCancel">Cancel</button>\
                      <button id="done-model-button" style="padding:4px 6px;display:none;" onclick="jQuery.fancybox.close();" type="button" class="btn btnCancel">Ok</button>\
                      <button id="failed-model-button" style="padding:4px 6px;display:none;" onclick="jQuery.fancybox.close();" type="button" class="btn btnCancel">Ok</button>\
                      </div></div>\
                  </div>',
          modal: true
      });
  }


  function throwMessage(msg){  
    $.fancybox({
        content: '<div class="modal-content">\
                    <h2><span>Error!</span><span>\
                    <a href="javascript:void(0);" onclick="jQuery.fancybox.close();">Close</a></span></h2>\
                    <div style="width:240px;" class="sureDelete">\
                    <p id="model-text">'+msg+'</p>\
                    <div style="text-align:right;margin-top:10px;">\
                    <button id="ok-model-button" onclick="jQuery.fancybox.close();" style="padding:4px 6px;" type="button" class="btn btnOk">Ok</button>\
                    </div></div>\
                </div>',
        modal: true
    });
  }

  
  function changed(type, id, text){
    showspinner();
    $.post("<?=DEFAULT_URL."/".MEMBERS_ALIAS."/ajax.php"?>", 
        {
          ajax_type   : "reviewcollectorChangeData",
          customerID  : id,
          changeType  : type,
          newValue    : text.trim()
        }
    , function(data) {
        hidespinner();
        if(data.trim().indexOf("success") > -1){
          $('#'+type+id).css('border-bottom','0px');
        } else {
          $('#'+type+id).css('border-bottom','3px solid red');
          throwMessage(data);
        } 

    });
  }

  function deleteRecord(id){
    showspinner();
    $.post("<?=DEFAULT_URL."/".MEMBERS_ALIAS."/ajax.php"?>", 
          {
            ajax_type   : "reviewcollectorDeleteData",
            customerID  : id
          }
      ,function(data) {
        hidespinner();
        if(data.trim().indexOf("success") > -1){
          $('#delete'+id).closest('tr').remove();
        } else {
          throwMessage("Please try again.");
        } 
        
    });
  }
</script>
<!-- <script src="http://localhost/10300/custom/domain_1/theme/review/js/responsive-paginate.js"></script>
    <script type="text/javascript">
      $(document).ready(function () {
    $(".pagination").rPage();
});
    </script> -->