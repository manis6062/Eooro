<?
    setting_get("review_manditory", $review_manditory);
  ?>

<?
$user = HtmlCleaner::CleanBasic($user);
if(sess_getAccountIdFromSession() ){
    $contactObj = new Contact(sess_getAccountIdFromSession());
    $first_name = $contactObj->first_name;
    $last_name = $contactObj->last_name;
    $full_name = $first_name." ".$last_name;
    $email = $contactObj->email;
    $name = (sess_getAccountIdFromSession() && SOCIALNETWORK_FEATURE == 'on' && strtoupper($reviewerAcc->getString("has_profile")) == "Y") ? 
($reviewerProfile->getString("nickname") ? $reviewerProfile->getString("nickname") : $first_name) : ($reviewer_name);
}
else {
    // If already registered user
    if( !empty($user) ){
        $notSignedInUser = $user;
    }// If new user
    else {
        
    }
}
    
?>


<section class ="login">  
<div class="container">
<div class="col-sm-8">
<div class="row">
<div class="info reviewCaptureInfo">

                    <? if ($message_review) {
                        if ($success_review) { ?>

                            <p class="successMessage"><?=$message_review?></p>
                             <script>
                             var a = window.parent.location.href;
                             var n = a.indexOf("popup.php"); 
                             
                                if (n < 1){
                                    //setTimeout('location.href = window.parent.location.reload(false);',3000);
                                }
                             </script>
                        <? } else { ?>

                            <p class="errorMessage"><?=$message_review?></p>
                        <? }
                    } ?>
          <!-- commented out the errormessage. -->
                    <!-- <p class="errorMessage" id="JS_errorMessage" style="display:none">&nbsp;</p> -->

                    <? 
                    if ($error_message) {
                        echo "<p class=\"errorMessage\">".$error_message."</p>";
                    } ?>

</div>
        <?php if(!empty($notSignedInUser)){ 
                $countAccount = count($notSignedInUser);
                if($countAccount>1) {
          ?>
        <div class="alert alert-info reviewCaptureAlertInfo">
          <strong>We have found following account registered for this email. Please select the account with which you want to post this review.</strong> 
        </div>
        <?php } ?>
        <div class="col-sm-12">

            <!--<select name="user_select" id="user_select" class="form-control">
                <option value="select">-- Select User --</option>
                <? //foreach( $notSignedInUser as $key => $u ): ?>
                    <option value="<?=$u['foreignaccount']?>" 
                            data-firstname="<?=$u['first_name']?>"
                            data-lastname="<?=$u['last_name']?>"
                            data-nickname="<?=$u['nickname']?>"
                            data-foreign="<?=$u['foreignaccount']?>">
                            <?=$u['nickname']?>
                    </option>
                <? //endforeach;?>
            </select>-->

            <?php  foreach( $notSignedInUser as $key => $u ) { 
              if($u['foreignaccount'] == 'facebook'){ ?>
            <div class="fbbtnwrapper reviewCaptureFormBtn">
                <i class="fa fa-facebook fb user_select" id="facebook" data-foreign="<?=$u['foreignaccount']?>" data-lastname="<?=$u['last_name']?>" data-nickname="<?=$u['nickname']?>" data-firstname="<?=$u['first_name']?>"></i>
            </div>   
              <?php 
                  } elseif($u['foreignaccount'] == 'google') { ?>
                   <div class="fbbtnwrapper gplus reviewCaptureFormBtn">
                <i class="fa fa-google-plus fb gp user_select" id="google" data-foreign="<?=$u['foreignaccount']?>" data-lastname="<?=$u['last_name']?>" data-nickname="<?=$u['nickname']?>" data-firstname="<?=$u['first_name']?>"></i>
            </div>
            <?php } elseif($u['foreignaccount'] == 'email') { ?>
            <div class="fbbtnwrapper gplus ema reviewCaptureFormBtn">
                <i class="fa fa-envelope fb gps user_select" id="email" data-foreign="<?=$u['foreignaccount']?>" data-lastname="<?=$u['last_name']?>" data-nickname="<?=$u['nickname']?>" data-firstname="<?=$u['first_name']?>"></i>
            </div>
            <?php } }
              ?>
        </div>
        <?php } ?>

<?
    unset($_SESSION['captchakey']);
    
  //Check if user is activated or not while writing review part 1
  
    $user_array =  (array) $reviewerAcc;
      if ($user_array["id"] == 0){
        //Not Logged In
      } else {
          //User is Logged In  
          if ($user_array["active"] == "n"){
            //Your account is not activated.
          } 
        }  

  //
  //  PART 2  - includes/code/review.php
  // 
  // END //
?>
     
    
    
    
    

    <div class="row">
        <div class="email-review-title">
            <div class="col-sm-12">
                <h2 class="sabayjai">
                     <?php if($_GET['widget_item_id']) : ?>
    <h5 class="rr"> <?php 
    $widget_review = openssl_decrypt(base64_decode($_GET['widget_item_id']), 'aes128', REVIEW_COLLECTOR_EMAIL_LINK_KEY);
    parse_str($widget_review);
    $listing_id = Validator::integer($item_id, TRUE);
    $list_name = Listing::getListingFromID($listing_id);
    echo $list_name;
    ?> </h5>
    
                <?php endif; ?>
                    <?=($itemObj->getString("title") ? ($itemObj->getString("title")) : ($itemObj->getString("name") ))?>
                </h2>
            </div>
        </div>
    </div>

    <div id="Rate">
        <p id = "rate">Rate it!*</p>
<script type="text/javascript" src="<?=NON_SECURE_URL?>/custom/domain_1/theme/<?=EDIR_THEME?>/js/ratestar.js"></script> 

        <div class="startwrapper resstartwrapper">
             <div class="starwrapper white starwrapper1" id="1star"><i class="fa fa-star"></i></div>
             <div class="starwrapper white starwrapper1" id="2star"><i class="fa fa-star"></i></div>
             <div class="starwrapper white starwrapper1" id="3star"><i class="fa fa-star"></i></div>
             <div class="starwrapper white starwrapper1" id="4star"><i class="fa fa-star"></i></div>
             <div class="starwrapper white starwrapper1" id="5star"><i class="fa fa-star"></i></div>

        </div>
 <div id="rating_error_msg"> </div> 

   
    </div>

  <?
    if($rating_stars == "") { ?>
 <? } else {
      echo $rating_stars;
    }
    ?>    
    
  <input type="hidden" name="rating" id="rating" value="<?=$rating?>" />
  <input type="hidden" id="member_id" name="member_id" value="<?=sess_getAccountIdFromSession()?>" />
  <input type="hidden" id="activeornot" name="activeornot" value="<?=$user_array["active"]?>" />
  <input type="hidden" id="user_select" name="user_select" />
  <div class="row">
  <!--  <div class="col-sm-3 col-xs-6"> -->
            <div class="col-sm-12 col-xs-12">
                <div class="form-group formimage reviewmbtm">
                <label class="form-control loginform reviewinput reviewplacehld text-write-review" style="line-height:25px;text-align:center;display:none;"><?=(sess_getAccountIdFromSession() && SOCIALNETWORK_FEATURE == "on" && strtoupper($reviewerAcc->getString("has_profile")) == "Y") ? ($reviewerInfo->getString("email")) : ($reviewer_email)?> </label>
                </div>
                <div class="form-group formimage reviewmbtm">
                    <input type="text" 
                           name="reviewer_name" 
                           class="form-control loginform reviewinput reviewplacehld text-write-review" 
                           id="reviewer_name" 
                           placeholder="Name" 
                           value="<?=$name?>" 
                           maxlength="50" 
                           tabindex="1" required <?php if(!$name) echo 'autofocus';  ?>>
                </div> <!--/form-group-->
                  <?php if($_GET['widget_item_id'] && empty($contactObj)) { ?>
                <input type="hidden" name="from_widget" value="y">
                 <input type="hidden" name="listing_name" value="<?php echo $list_name; ?>">
                 <div class="form-group formimage reviewmbtm">
                    <input type="text" 
                           name="email" 
                           class="form-control loginform reviewinput reviewplacehld text-write-review" 
                           id="email" 
                           placeholder="Email Address*" 
                           value="" 
                           maxlength="50" 
                           tabindex="2" required >
                   
                </div> 
                  <div id="email_validate_msg" class="fff" > </div> 
                <?php } 
                elseif($_GET['widget_item_id']) { ?>
                  <input type="hidden" name="from_widget" value="y">
                 <input type="hidden" name="listing_name" value="<?php echo $list_name; ?>">
                      <div class="form-group formimage reviewmbtm">
                    <input type="text" 
                           name="email" 
                           class="form-control loginform reviewinput reviewplacehld text-write-review" 
                           id="email" 
                           placeholder="Email Address*" 
                           value="<?php echo $email; ?>" 
                           maxlength="50" 
                           tabindex="2" required readonly>
                </div> 
                    
            <?php    }
                ?>
                 
                  <?php if($_GET['widget_item_id'] && empty($contactObj)) : ?>
                 
                 <div class="form-group formimage reviewmbtm">
                    <input type="text" 
                           name="c_email" 
                           class="form-control loginform reviewinput reviewplacehld text-write-review" 
                           id="c_email" 
                           placeholder="Confirm Email*" 
                           value="" 
                           maxlength="50" 
                           tabindex="2" required>
                </div>
                 <div id="error_msg" class="fff" > </div> 
                  <?php endif; ?>
                <div class="form-group formimage reviewmbtm">
                    <input type="text" 
                           name="review_title" 
                           class="form-control loginform reviewinput reviewplacehld text-write-review" 
                           id="review_title" 
                           placeholder="Review Title*" 
                           value="<?=  stripslashes($review_title)?>" 
                           maxlength="20" 
                           tabindex="2" required <?php if($name) echo 'autofocus';  ?>>
                </div> 
                
              
                
            </div> <!--/row-->
            <!-- <div class="col-sm-4 col-xs-6"> -->
            <div class="col-sm-12 col-xs-12">
                <div class="form-group formimage reviewmbtm ">
                    <textarea class="form-control textarea-write-review reviewCaptureTextArea" 
                              name="review" 
                              id="review" 
                              rows="8" 
                              tabindex="3" maxlength="2000" 
                              placeholder="Write Your Review Here* " required><?=stripslashes($review)?></textarea>
                </div>
            </div> <!--/col-sm-5-->
    
            </div>
  
  
  <div class="action">
            <div class="reviewpara reviewpara-reviewCapture">
                <p><?=system_showText(LANG_CAPTCHA_HELP)?></p>
            </div>
            <!-- <div class="row captchawrapper col-xs-offset-2 captcha"> -->
            <div class="row">
                <div class="captchawrapper  centeringcaptcha captcha">
                     <div class="g-recaptcha" data-callback="imNotARobot" data-sitekey="<?php echo DATA_SITEKEY; ?>"></div>
                    <span id="re-captcha" style="color:red" /> 
                </div>
            </div><!--/row-->
            <div class="row">
                <div class="btncaptcha5 col-sm-12 col-xs-12  ">
                <button type="submit" 
                        name="submit" 
                        value="Submit" 
                        id="submitReview" 
                        tabindex="5" 
                        class="btn btn-lg btten-info btten-space g-recaptcha"><?=system_showText(LANG_BUTTON_SEND)?></button>

            <div id="smallSpinner" style="vertical-align:sub;position:absolute;left:49%;top:25px;display:none;"><br><br>
                <i class="fa fa-circle-o-notch fa-spin" style="color:#FF004F;font-size: 30px;"></i>  Please wait...<br>
            </div>
                </div>
            </div>
 </div>
</div>
 </div>
 <div class="col-sm-4">
   
   <?php
   include(system_getFrontendPath("recent_review_vertical.php")); 
   ?>
 </div>
</div>
</div>

</section>
<script type="text/javascript" src="https://www.google.com/recaptcha/api.js"></script>
 <script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/common.js"></script>
<script>
    
    
    $(function() {
    $("#c_email").keyup(function() {
        var email = $("#email").val();
        $("#error_msg").html(email == $(this).val() ? "" : "<div style='color: red;margin-top: -5px; padding-bottom: 3px;'>&nbsp&nbspThe Confirmation Email must match your Email Address.&nbsp&nbsp</div>");
    });
      });
         
    function validateEmail(email) {
            var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
            return re.test(email);
        }
        
        
    $(function() {
    $("#email").keyup(function() {
    var email = $("#email").val();
    if(validateEmail(email) == false){
     $('#email_validate_msg').html("<div style='color: red;margin-top: -5px; padding-bottom: 3px;'>&nbsp&nbspThe Email Address you entered is not valid.&nbsp&nbsp</div>"); 
    }
    else{
        $('#email_validate_msg').html(''); 

    }
        });
    });
        

  $('#submitReview').click(function(e){
      if(get_Captcha() == ''){
        e.preventDefault();
    };

var name    = $('#reviewer_name').val();
var title   = $('#review_title').val();
var comment = $('#review').val();
var email = $('#email').val();
var c_email = $('#c_email').val();
var rating = $('#rating').val();

if(rating == ''){
     var x =  document.getElementById("rating_error_msg");
    x.innerHTML = "<div style='color: red;margin-top: -5px; padding-bottom: 3px;'>&nbsp&nbspPlease select a rating for this item.&nbsp&nbsp</div>";
    setTimeout(function() {
     x.innerHTML = "";
    }, 8000);
    e.preventDefault();
    return false;
}


  });



    (function($){
        $(document).ready(function(){

          $('.user_select').click(function(){
            var id   = $(this).attr('id');
            var self = $("#"+id);
              selectAccount(self);            
          });

          if($('#facebook').is(':visible')) {
                var self = $('#facebook');
                selectAccount(self);
                return false;
          }
          if($('#google').is(':visible')) {
                var self = $('#google');
                selectAccount(self);
                return false;
          }
          if($('#email').is(':visible')) {
                var self = $('#email');
                selectAccount(self);
                return false;
          }

          function selectAccount(self) {
                var name =  self.data('nickname') || self.data('firstname') ;
                $('#reviewer_name').val(name);
                $('#user_select').val(self.data('foreign'));

              $('.user_select').css('background', '#c7c7c7');
              var type = self.data('foreign');
              if(type=='google')
                self.css('background', '#ce3e26');
              if(type=='email')
                self.css('background', '#6caa16');
              if(type=='facebook')
                self.css('background', '#354f88');
          }

        });
    })(jQuery);
</script>