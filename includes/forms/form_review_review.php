<?
    setting_get("review_manditory", $review_manditory);
  ?>

<?
    $contactObj = new Contact($_SESSION["SESS_ACCOUNT_ID"]);
    $first_name = $contactObj->first_name;
    $last_name = $contactObj->last_name;
    $full_name = $first_name." ".$last_name;
    $account_id = $contactObj->account_id;
    
?>

<div class="modal-content">
    <h2 class="reviewPop">
        <?if (sess_isAccountLogged()){?><?=system_showText(LANG_REVIEWSOF)?> <?} else{?> <?}?>
         <?=($itemObj->getString("title") ? ($itemObj->getString("title")) : ($itemObj->getString("name") ))?>
        <span>
            <a href="javascript:void(0);" onclick="parent.$.fancybox.close();"><?=system_showText(LANG_CLOSE);?></a>
        </span>
    </h2>
    
</div>
<div class="info">

                    <? if ($message_review) {
                        if ($success_review) { ?>

                            <p class="successMessage"><?=$message_review?></p>
                             <script>
                             var a = window.parent.location.href;
                             var n = a.indexOf("popup.php"); 
                             
                                if (n < 1){
                                    setTimeout('location.href = window.parent.location.reload(false);',3000);
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

<section class ="login">  
<div class="container">
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
   <input type="hidden"  name="account_id" value="<?=$account_id;?>" /> 
  <div class="row">
  <!--  <div class="col-sm-3 col-xs-6"> -->
            <div class="col-sm-12 col-xs-12">
                <div class="form-group formimage reviewmbtm">
                <label class="form-control loginform reviewinput reviewplacehld text-write-review" style="line-height:25px;text-align:left;display:none;"><?=(sess_getAccountIdFromSession() && SOCIALNETWORK_FEATURE == "on" && strtoupper($reviewerAcc->getString("has_profile")) == "Y") ? ($reviewerInfo->getString("email")) : ($reviewer_email)?> </label>
                </div>
                <div class="form-group formimage reviewmbtm">
                    <input type="text" 
                           name="reviewer_name" 
                           class="form-control loginform reviewinput reviewplacehld text-write-review" 
                           id="reviewer_name" 
                           placeholder="Name" 
                           value="<?=(sess_getAccountIdFromSession() && SOCIALNETWORK_FEATURE == 'on' && strtoupper($reviewerAcc->getString("has_profile")) == "Y") ? 
($reviewerProfile->getString("nickname") ? $reviewerProfile->getString("nickname") : $first_name) : ($reviewer_name)?>" 
                           maxlength="50" 
                           tabindex="1" required>
                </div> <!--/form-group-->
                <div class="form-group formimage reviewmbtm">
                    <input type="text" 
                           name="review_title" 
                           class="form-control loginform reviewinput reviewplacehld text-write-review" 
                           id="review_title" 
                           placeholder="Review Title*" 
                           value="<?=  stripslashes($review_title)?>" 
                           maxlength="20" 
                           tabindex="2" required autofocus>
                </div> 
                
            </div> <!--/row-->
            <!-- <div class="col-sm-4 col-xs-6"> -->
            <div class="col-sm-12 col-xs-12">
                <div class="form-group formimage reviewmbtm">
                    <textarea class="form-control textarea-write-review" 
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
                            <div style="text-align : -webkit-center;">
            <div class="row" style="text-align: -moz-center;">
                     <div class="g-recaptcha" data-callback="imNotARobot" data-sitekey="<?php echo DATA_SITEKEY; ?>"></div>
                    <span id="re-captcha" style="color:red" /> 
            </div><!--/row-->
                            </div>
            <div class="row">
                <div class="btnwrapper5 col-sm-12 col-xs-12 text-center reviewCatpureButton">
                <button type="submit" 
                        name="submit" 
                        value="Submit" 
                        id="submitReview" 
                        tabindex="5"
                        class="btn btn-default btn-lg reviewsendbtn"><?=system_showText(LANG_BUTTON_SEND)?></button>
    <div id="spinner" style="vertical-align:sub;position:relative;text-align:center;top:-33px;left:27%;display:none;">
        <i class="fa fa-circle-o-notch fa-spin" style="color:#FF004F;font-size: 25px;"></i><br>
    </div>
                </div>
            </div>
 </div>
</div>
</section>
<script type="text/javascript" src="https://www.google.com/recaptcha/api.js"></script>
<script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/common.js"></script>

<script type="text/javascript">
  $('.form').submit(function(e){
          
        // Google Recaptcha
   if(get_Captcha() == ''){
        e.preventDefault();
    };
      
    var name    = $('#reviewer_name').val();
    var title   = $('#review_title').val();
    var comment = $('#review').val();

    if(name && title && comment) {
      $('#submitReview').attr('disabled', true);
      $('#spinner').show();
    }

    
    
  });
</script>