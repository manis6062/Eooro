
 <?php include_once(EDIRECTORY_ROOT.'/custom/domain_1/theme/'.EDIR_THEME.'/common_functions.php'); ?>
<section class ="login">  
<div class="container">
<div class="col-sm-8">
<div class="row">
    <div class="row">
        <div class="email-review-title">
            <div class="col-sm-12">
                <h2 class="sabayjai">
                     <h5 class="rr"> <?php 
    $list_name = Listing::getListingFromID($listing_id);
    echo $list_name;
    ?></h5> <h4 class="rr">Update Review</h4>
                    
                    
                    
                </h2>
            </div>
        </div>
    </div>

    <div id="Rate">
        <p id = "rate">Rate it!*</p> 

    <?php //echo display_star_rating($review_details['rating']);?>

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
    
        
       
  <input type="hidden" name="rating" id="rating" value="<?=$review_details['rating']?>" />
  <input type="hidden" id="member_id" name="member_id" value="<?=$review_details['member_id']?>" />
  <input type="hidden" name="item_id" value="<?=$listing_id; ?>" />
  <input type="hidden" name="updated_id" value="<?=$listing_id; ?>" />
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
                           value="<?=$review_details['reviewer_name'];?>" 
                           maxlength="50" 
                           tabindex="1" required <?php if(!$review_details['reviewer_name']) echo 'autofocus';  ?>>
                </div> <!--/form-group-->
                <div class="form-group formimage reviewmbtm">
                    <input type="text" 
                           name="review_title" 
                           class="form-control loginform reviewinput reviewplacehld text-write-review" 
                           id="review_title" 
                           placeholder="Review Title*" 
                           value="<?=  stripslashes($review_details['review_title'])?>" 
                           maxlength="20" 
                           tabindex="2" required <?php if($review_details['review_title']) echo 'autofocus';  ?>>
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
                              placeholder="Write Your Review Here* " required><?=stripslashes($review_details['review'])?></textarea>
                </div>
            </div> <!--/col-sm-5-->
    
            </div>
  
  
  <div class="action">
            <div class="reviewpara reviewpara-reviewCapture">
                <p><?=system_showText(LANG_CAPTCHA_HELP)?></p>
            </div>
            <!-- <div class="row captchawrapper col-xs-offset-2 captcha"> -->
          <div class="row">
                <div class="captchawrapper col-sm-6 my-center captcha">
                     <div class="g-recaptcha" data-callback="imNotARobot" data-sitekey="<?php echo DATA_SITEKEY; ?>"></div>
                    <span id="re-captcha" style="color:red" /> 
                </div>
            </div><!--/row-->
            <div class="row">
                <div class="btnwrapper5 col-sm-12 col-xs-12 text-center reviewCaptureButton">
                <button type="submit" 
                        name="submit" 
                        value="Submit" 
                        id="submitReview" 
                        tabindex="5" 
                        class="btn btn-default btn-lg reviewsendbtn reviewSendCaptureBtn"><?=system_showText(LANG_BUTTON_SEND)?></button>

            <div id="smallSpinner" style="vertical-align:sub;position:absolute;left:49%;top:25px;display:none;">
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

  $('#submitReview').click(function(){
      
       if(get_Captcha() == ''){
        e.preventDefault();
    };

    var name    = $('#reviewer_name').val();
    var title   = $('#review_title').val();
    var comment = $('#review').val();

    if(name && title && comment) {
        $(this).hide();
        $('#smallSpinner').show();   
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