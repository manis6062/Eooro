  <link rel="stylesheet" href="<?=NON_SECURE_URL?>/custom/domain_1/theme/<?=EDIR_THEME?>/css/style_scroll.css" />
  <link rel="stylesheet" href="<?=NON_SECURE_URL?>/custom/domain_1/theme/<?=EDIR_THEME?>/css/jquery.mCustomScrollbar.css" />
  <script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/jquery/fancybox/v2/jquery.fancybox.pack.js"></script>
  <link rel="stylesheet" href="<?=DEFAULT_URL?>/scripts/jquery/fancybox/v2/jquery.fancybox.css" type="text/css" media="all" />

  <?
    $uid = $info["account_id"];  
    $dbMain = db_getDBObject(DEFAULT_DB, true); 
    $dbDomain = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain); 
    //$Main = db_getDBObject(DEFAULT_DB, true);
    $array = (array) $dbDomain;
    $searchReturn["from_tables"] =  "Review| INNER JOIN Listing ON Review.item_id=Listing.id "; 
    $screen=$_POST['screen'];
    $aux_items_per_page=10;
    $searchReturn["where_clause"]= "Review.member_id=".$uid." AND Review.approved = 1 AND Review.is_deleted = 0";
    $searchReturn["select_columns"]= "id, item_type, item_id, review, review_title, rating, response, responseapproved, added, Listing.title";
    $searchReturn["order_by"]="Review.added DESC";
    
    //making query from class page Browsing
    $pageObj = new pageBrowsing($searchReturn["from_tables"], 
                                $screen, 
                                $aux_items_per_page, 
                                $searchReturn["order_by"], 
                                false, 
                                false, 
                                $searchReturn["where_clause"], 
                                $searchReturn["select_columns"], 
                                false);
    
    $listings = $pageObj->retrievePage("array",false);

      //for social details
      $id=$uid;
      $accObj = new Account($id);
      $publish = $accObj->getString("publish_contact"); 
      $profileObj = new Profile(sess_getAccountIdFromSession());
       $profileObj->extract();
   
         //For Open Cases ID
        $dbMain = db_getDBObject(DEFAULT_DB, true);
        $dbDomain = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
        $account_id = sess_getAccountIdFromSession();

            if( $account_id ){
            $sql = "SELECT R.*, O.*, L.title FROM Opened_Cases AS O "
                    . "INNER JOIN Review AS R ON O.review_id=R.id "
                    . "INNER JOIN Listing AS L ON L.id=R.item_id "
                    . "WHERE R.member_id=$account_id ORDER BY case_status = 'A' DESC";
              $resource = $dbDomain->query( $sql );
            }
            while( $row = mysql_fetch_assoc($resource) ){
                $cases[] = $row;
            }
          $caseSize = count( $cases );

      /*
      ** @ Finding Out Active Cases
      */

      for ($c = 0; $c < count($cases); $c++){
        if($cases [$c] ['case_status'] == 'A'){
          $active_count ++; 
        }
      }
?>
    <noscript>
			<style>
				.st-accordion ul li{
					height:auto;
				}
				.st-accordion ul li > a span{
					visibility:hidden;
				}
        
			</style>
    </noscript>
    
    <style>
        @media (max-width: 650px) and (min-width:480px){
          .fancybox-wrap.fancybox-desktop.fancybox-type-iframe.fancybox-opened{
            width:450px !important;
          }
          .fancybox-inner{
              width: 440px!important;
          }
    </style>
   
        <?if(!$listings){?>
        <section class="welcome-box">
            
            <h1><?=system_showText(LANG_LABEL_WELCOME);?>, <?=htmlspecialchars($info["nickname"]);?>!</h1>
            
            <div class="search-box">
                
                <? if (!count($userActivity)) { ?>
                    <h3><?=system_showText(LANG_LABEL_PROFILE_TIP2);?></h3>
                <? } ?>
            </div>
        </section>
                        <? }
          else { ?>
		<section class="profile-index">
        	<div class="container-fluid">
            	
                        <div class="row">
                        	<div class="profile-dashboard">
                            	<div class="profile-wrapper">
                            <?php if ($uid == $_SESSION['SESS_ACCOUNT_ID']) { ?> 
                                    <span class="profile"><?=system_showText(LANG_LABEL_WELCOME);?>, <?=htmlspecialchars($info["nickname"]);?>!</span>
                            <? } ?>
                               	</div>
                                <div role="tabpanel">
                                
                                  <!-- Nav tabs -->
                                  <ul class="nav nav-tabs custom-tabs" role="tablist">
                                    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Recent Activity </a></li>
                                
                            <?php if ($uid == $_SESSION['SESS_ACCOUNT_ID']) { ?>           
                                    <li role="presentation">
                                        <?if($active_count<1) {?>
                                            <a href="case.php">
                                                Case Opened
                                            </a>    
                                        <? }else {?>
                                        <a href="case.php">
                                            Case Opened 
                                            <span class="badge custom-badge">
                                                <? echo $active_count; ?>
                                            </span>
                                        </a>
  
                                        <?}
                                        ?>
                                    </li>

                          <? } ?>
                                  </ul>
                                
                                  <!-- Tab panes -->
                                  <div class="tab-content marginforboth">
                                    <div role="tabpanel" class="tab-pane active" id="home">
                                    	<div class="wrapper content">
                                         <div class="mCustomScrollbar" data-mcs-theme="dark">
                                          <div id="st-accordion" class="st-accordion">
                                          <ul class="recentreview-border">
<?   foreach ($listings as $row)
{  $review_id = $row["id"];
   $sqli = "SELECT * FROM Opened_Cases WHERE review_id='$review_id' AND case_status='A'";
   $resource = $dbDomain->query( $sqli );
   while( $rowi = mysql_fetch_assoc($resource) ){
      $opencase_review_id = $rowi["review_id"];
   }
 ?>  
        <?
            $id=htmlentities($row['id']); 
            $item_type=htmlentities($row['item_type']);
            $review_title=htmlentities($row['review_title']);
            $review=htmlentities($row['review']); 
            $title = htmlentities($row["title"]); 
            $added = htmlentities($row["added"]);
            $added = date("jS M Y",strtotime($added));
            $rating = htmlentities($row["rating"]);
            $item_id = htmlentities($row["item_id"]);

        ?>
                                              
                                              
                                                    <li style="height:99px; overflow:hidden;">
                                                        <a href="#">
                                                            <em class="company-title"><?=$row["title"]?></em>
                                                            <span class="st-arrow">Open or Close</span>
                                                        </a>
                                                        <div class="date-button-wrapper">
                                                           <div class="date-wrapper">
                                                                 <font align="right" color = "grey"> 
                                                                    <?=$added?>
                                                                 </font>
                                                        </div>
                                                <?php if ($uid == $_SESSION['SESS_ACCOUNT_ID']) { ?>        
                                                        <div class="dropdown case-dropdown opencasedropdown pull-right">

                                                              <form name="review_id" id="review_id"  class="form" style="display:none">
                                                                   <input type="hidden" name="review" id="review_<?=$id?>" value="<?=$id?>" />
                                                              </form>

                                                                <a rel="nofollow" href="<?=NON_SECURE_URL?>/profile/popup.php?id=<?=urlencode($id)?>" class="reviewThis iframe fancy_window_review">

                                                                <?
                                                                //onclick="if(validateSelect()&&validateSave()){doSomething();}"

                                                                //if ($review_id == $opencase_review_id){var_dump("hello world!");}?>
                                                                <button id='<?=$id?>' class="btn btn-default btn-xs case-openbtn edit" >Edit</button>  
                                                                </a>
                                                                <?if ($review_id == $opencase_review_id){ ?>
                                                                <a class="confirm_case" href="javascript:;">
                                                                    <button id='<?=$id?>' class="btn btn-default btn-xs case-openbtn delete" onclick="review_onclick(<?=$id?>)">Delete</button>
                                                                </a>
                                                                <!-- <a href="#" id="delete" class="iframe">
                                                                    <button id='<?=$id?>' class="btn btn-default btn-xs case-openbtn delete" onclick="myfunction()">Delete</button>
                                                                </a> -->
                                                                <?} else {?>
                                                                <a class="confirm" href="javascript:;">
                                                                  <button id='<?=$id?>' class="btn btn-default btn-xs case-openbtn delete" onclick="review_onclick(<?=$id?>)">Delete</button>
                                                                </a>
                                                                <!-- <a href="#" id="delete_case">
                                                                    <button id='<?=$id?>' class="btn btn-default btn-xs case-openbtn delete" onclick="myfunction1()">Delete</button>
                                                                </a> -->
                                                                <?}?>
                                                        </div>

                                              <? } ?>
                                                              
                                                        </div>
                                                        <div class="startwrapper profile-star">
                                                                <?=display_star_rating( $row['rating'], 'resstartwrapper3', 'starwrapper3' )?>
                                                        </div><br>
                                                        
                                                        <em class="review-title"><?=  ucwords($row["review_title"])?> </em>
                                                            
                                                            
                                                            
                                                           
                                                        <div class="st-content">
                                                           <?$dat=$row["review"]?>
                                                           <? $rev = htmlspecialchars($dat,ENT_QUOTES); ?>
                                                            <p><?=(($rev) ? htmlspecialchars_decode(nl2br($rev)) : system_showText(LANG_NA));?></p>
                                                        </div>
                                                    </li>
                                               
<? } ?>  
	 </ul>
                                            </div>
  </div>
                                            </div> <!--wrapper-->
                                    </div>
                                            <? if(mysql_fetch_array($result_pag_data)==NULL)
                                            {?>
                                           <? }
                                             ?>
            							
                                    <div role="tabpanel" class="tab-pane" id="profile">
                                    </div>
                                     <div class="hidden" style="padding:20px;"> 
                                        
                                        <form class="form-search form-inline profile-search">
                                            <input type="text" class="form-control search-query1" placeholder="Search Review" />
                                        </form>
                                     </div> 

                                  </div>
                                
                                </div>
                            </div>
                        </div>
                    <!--</div> col-sm-10-->
                </div>
            
        </section>
          <? } ?>
    <script>
        (function($){
            $(window).load(function(){
                $(".content").mCustomScrollbar();
            });
        })(jQuery);
    </script>

      <script type="text/javascript">
            $(function() {

                $('#st-accordion').accordion({
                    oneOpenedItem   : true
                });

            });
        </script>

      <script>
      function review_onclick(id){
        var i = id;
        var value = document.getElementById('review_'+i).value;
        funct_val(value);
      }
      function funct_val(val){
        rval = val; 
      }
      function do_something() {
            console.info( arguments );
        }
      function delete_review()
      { 
        var dataString = 'id='+ rval;
        $.ajax({
                        method: "POST",
                        url: "delete_ajax.php",
                        data: dataString,
                        cache: false,
                        success: function(response)
                        {
                            content: response;
                        }
                                           });
                            window.location.reload();
                            return false;
       }

       function delete_review_case()
       {  //console.log(rval);
          //console.log("hello");
          var dataString = 'id='+ rval;
          $.ajax({
                        method: "POST",
                        url: "delete_case_ajax.php",
                        data: dataString,
                        cache: false,
                        success: function(response)
                        {
                            content: response;
                        }
                                           });
                            window.location.reload();
                            return false;
       }  

      function fancyConfirm(msg,callbackYes,callbackNo) {
          var ret;

          jQuery.fancybox({
            //'autoSize' : false,

             // 'maxHeight'    : 25,
             // 'minWidth' : 240 ,   
              // 'autoScale' : false
              'height' : 70, 
             //  'width':253,
              'modal' : true,
              //'content' : "<div style=\"margin:1px;width:240px;height:70px;\">"+msg+"<div style=\"text-align:right;margin-top:10px;\"><input id=\"fancyconfirm_cancel\" style=\"margin:3px;padding:0px;\" type=\"button\" value=\"Cancel\"><input id=\"fancyConfirm_ok\" style=\"margin:3px;padding:0px;\" type=\"button\" value=\"Ok\"></div></div>",
              'content' : "<div class=\"modal-content\"><h2><span>Warning!</span><span><a href=\"javascript:void(0);\" onclick=\"parent.$.fancybox.close();\"><?=system_showText(LANG_CLOSE);?></a></span></h2><div style=\"width:240px;\" class=\"sureDelete\">"+msg+"<div style=\"text-align:right;margin-top:10px;\"><button id=\"fancyConfirm_ok\" style=\"padding:4px 6px;\" type=\"button\" class=\"btn btnOk\">Ok</button><button id=\"fancyconfirm_cancel\" style=\"padding:4px 6px;\" type=\"button\" class=\"btn btnCancel\" >Cancel</button></div></div></div>",
              'beforeShow' : function() {
                 
                  
                  jQuery("#fancyConfirm_ok").click(function() {
                      $.fancybox.close();
                      
                      callbackYes();
                  });
                   jQuery("#fancyconfirm_cancel").click(function() {
                      $.fancybox.close();
                      
                      callbackNo();
                      
                  });
              }
          });
      }

       

      $(document).ready(function() {

          $(".confirm").click(function() {
              fancyConfirm('Are you sure you want to delete?', function() {
                  delete_review();
                  
              }, function() {
                  do_something('no');
              });
          });
          $(".confirm_case").click(function() {
              fancyConfirm('This review has an opened case. Are you sure you want to Close the case and delete the review?', function() {
                  delete_review_case();
              }, function() {
                  do_something('no');
              });
          });
      });
      </script>
  
  </body>
  <script type="text/javascript" src="<?=NON_SECURE_URL?>/custom/domain_1/theme/<?=EDIR_THEME?>/js/jquery.accordion.js"></script>
  <script type="text/javascript" src="<?=NON_SECURE_URL?>/custom/domain_1/theme/<?=EDIR_THEME?>/js/jquery.easing.1.3.js"></script>
  <script src="<?=NON_SECURE_URL?>/custom/domain_1/theme/<?=EDIR_THEME?>/js/jquery.mCustomScrollbar.concat.min.js"></script>

</html>
