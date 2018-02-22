<?
include("../conf/loadconfig.inc.php");

  $dbMain          = db_getDBObject(DEFAULT_DB, true);
  $company_title   = ucwords($_GET["keyword"]);
  $countries       = CountryLoader::getCountryList(); 
  $countryname     = CountryLoader::getCountryName(); 
  $countryId       = CountryLoader::getCountryId(); 

  //If the user arrives after login save the form data and populate it
  if(strpos($_SERVER['HTTP_REFERER'], "popup/popup.php") && $_COOKIE['tempLocationFormData']){
      parse_str($_COOKIE['tempLocationFormData'], $formData);
      unset($formData['reviewer_name']);
      unset($formData['reviewer_email']);
      $company_title  = htmlentities($formData['company_title']);
      $email          = htmlentities($formData['email']);
      $phone          = htmlentities($formData['phone']);
      $website        = htmlentities($formData['website']);
      $facebook       = htmlentities($formData['facebook']);
      $twitter        = htmlentities($formData['twitter']);
      $c_location_1   = htmlentities($formData['location_1']);
      $c_location_3   = htmlentities($formData['location_3']);
      $c_location_4   = htmlentities($formData['location_4']);
      $street_address = htmlentities($formData['street_address']);
      $review_title   = htmlentities($formData['review_title']);
      $review_comment = htmlentities($formData['review_comment']);
      $rating         = htmlentities($formData['rating']);
  }
?>
<script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?=NON_SECURE_URL?>/custom/domain_1/theme/<?=EDIR_THEME?>/js/ratestar.js"></script>

  <h2>Add this company on our server.</h2>
  
  <form name="rate_form" id="1form">
    <div class="row">
      <div class="col-sm-12">
          <div class="form-group formimage reviewmbtm">
              <input type="text" name="company_title" class="form-control loginform reviewinput reviewplacehld" placeholder="Company Title" value="<?=$company_title?>" maxlength="50" tabindex="1" required>
          </div>
          <div class="form-group formimage reviewmbtm">
              <input type="email" name="email" class="form-control loginform reviewinput reviewplacehld" id="email" placeholder="Company email" value="<?=$email?>" maxlength="100" tabindex="3">
          </div>

          <div class="form-group formimage reviewmbtm">
              <input type="text" name="phone" class="form-control loginform reviewinput reviewplacehld" id="phone" placeholder="Phone" value="<?=$phone?>" maxlength="100" tabindex="4">
          </div>
          <div class="form-group formimage reviewmbtm">
              <input type="text" name="website" class="form-control loginform reviewinput reviewplacehld" id="website" placeholder="Website" value="<?=$website?>" maxlength="100" tabindex="5">
          </div>
          <div class="form-group formimage reviewmbtm">
              <input type="text" name="facebook" class="form-control loginform reviewinput reviewplacehld" id="facebook" placeholder="Facebook page" value="<?=$facebook?>" maxlength="100" tabindex="5">
          </div>
          <div class="form-group formimage reviewmbtm">
              <input type="text" name="twitter" class="form-control loginform reviewinput reviewplacehld" id="twitter" placeholder="Widget id for twitter feed" value="<?=$twitter?>" maxlength="100" tabindex="5">
          </div>
           <div class="form-group fixpm" >
            <?include(system_getFrontendPath("location_no_keyword.php"));?>
          </div>
      
          <div class="form-group formimage reviewmbtm">
              <input type="text" name="street_address" class="form-control loginform reviewinput reviewplacehld" id="street_address" placeholder="Address*" value="<?=$street_address?>" maxlength="50" tabindex="2">
          </div>
          
           <div class="form-group">
          Is this your Business?<br/>
            Yes <input type="radio"  name="is_owner"  id="travel_no_1"  value="No"  tabindex="26" >&nbsp &nbsp
            No <input type="radio"  name="is_owner"  id="travel_yes_1" value="Yes" tabindex="25" >
            
          </div>
         

          <div id="elements">
            <div id="ratings" >
                <p id = "rate">Rate it!</p>
                <div id="hidden" class="resstartwrapper startwrapper"> 
                    <div class="starwrapper white starwrapper1" id="1star"><i class="fa fa-star"></i></div>
                    <div class="starwrapper white starwrapper1" id="2star"><i class="fa fa-star"></i></div>
                    <div class="starwrapper white starwrapper1" id="3star"><i class="fa fa-star"></i></div>
                    <div class="starwrapper white starwrapper1" id="4star"><i class="fa fa-star"></i></div>
                    <div class="starwrapper white starwrapper1" id="5star"><i class="fa fa-star"></i></div>
                </div>
                <input type="hidden" name="rating" id="rating" value="<?=$rating?>" />
            </div>
          
          <? if(!sess_getAccountIdFromSession()) : ?>            
          
            <div class="form-group formimage reviewmbtm">
                <input type="text" name="reviewer_name" class="form-control loginform reviewinput reviewplacehld" id="reviewer_name" placeholder="Your Name" value="" maxlength="50" tabindex="9" style="display:none;">
            </div>

            <div class="form-group formimage reviewmbtm">
                <input type="text" name="reviewer_email" class="form-control loginform reviewinput reviewplacehld" onblur="checkEmail()" id="reviewer_email" placeholder="Your Email" value="" maxlength="50" tabindex="9" style="display:none;">
                <p id="loginHere" class="error" style="display:none;"> 
                You must to login before you can proceed. 
                  <a rel="nofollow" href="<?=EDIRECTORY_FOLDER?>/popup/popup.php?pop_type=profile_login&amp;destiny=<?="$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"?>" class="reviewThis fancy_window_iframe">
                    Click here to login
                  </a>
                </p>
            </div>

          <script>
            function checkEmail(){
              var data = $('#reviewer_email').val();
              if(data.trim() != ""){
                $.ajax({
                  type: "POST",
                  url: "<?=DEFAULT_URL . '/' . MEMBERS_ALIAS?>/ajax.php",
                  data: {ajax_type : "checkEmail", email : data},
                  success: function(data) {
                    if(data.indexOf("true") > -1){
                      $('#loginHere').show();
                      document.getElementById('review_title').style.pointerEvents = 'none';
                      document.getElementById('review').style.pointerEvents = 'none';
                      document.getElementById('check').style.pointerEvents = 'none';
                      document.getElementById('captcha').style.pointerEvents = 'none';
                      document.getElementById('submitReview').style.pointerEvents = 'none';
                      <?//Set cookie and capture the values ?>
                      document.cookie="tempLocationFormData="+$("#1form").serialize();
                      $('#submitReview').click(function(e){
                        e.preventDefault();
                      });
                    } else {
                      $('#loginHere').hide();
                    }
                  }
                });
              }     
            }
          </script>

          <? endif; ?>

            <div class="form-group formimage reviewmbtm">
                <input type="text" name="review_title" class="form-control loginform reviewinput reviewplacehld" id="review_title" placeholder="Review Title" value="<?=$review_title?>" maxlength="20" tabindex="9">
            </div>

            <div class="form-group">
                <textarea class="form-control" name="review_comment" id="review" rows="8" tabindex="10" placeholder="Write Your Review Here"><?=$review_comment?></textarea>
            </div>
          </div> <!-- elements -->

          <div class="form-group checkboxpadding">
            <label style="margin-right:20px; color:#000;" class="checkbox-inline"><input id="check" name="agree" value="" type="checkbox"> I agree to all the Terms and Conditions. </label>
          </div>

          <p><?=system_showText(LANG_CAPTCHA_HELP)?></p>
          <div class="row captchawrapper captcha">
             <div class="g-recaptcha centeringcaptcha" data-callback="imNotARobot" data-sitekey="<?php echo DATA_SITEKEY; ?>"></div>
                    <span id="re-captcha" style="color:red" />   
          </div> <!--/row--> 

          <div class="action" style="position:relative;margin-top:15px;text-align: center;">
            <div class="row">
                <input type="submit" name="submit" value="Add" id="submitReview" class="btn btn-lg btten-info btten-space g-recaptcha" tabindex="12">
            </div>
            <div id="smallSpinner" style="vertical-align:sub;position:absolute;left:42%;top:20px;display:none;">
                <i class="fa fa-circle-o-notch fa-spin" style="color:#FF004F;font-size: 30px;"></i><br>
            </div>
          </div>       
      </div> <!-- col-sm-12 -->
    </div><!-- row -->
  </form>

</div>
</div>
</div>

<div id="spinner" align="center" style="margin-bottom: 100px;display:none;">
   <i class="fa fa-circle-o-notch fa-spin" style="color:#FF004F;margin-top:175px;font-size:100pt;"></i><br>
   <h2 style="color:#000;font-size:17px;"> Please Wait...</h2>
</div>
<script type="text/javascript" src="https://www.google.com/recaptcha/api.js"></script>
 <script type="text/javascript" src="<?=DEFAULT_URL?>/scripts/common.js"></script>
<script type="text/javascript">
    var imNotARobot = function() {
    console.info("Button was clicked");
    document.getElementById('re-captcha').innerHTML = "";
    };</script>
<script>
    var keyword  = $("#company_title").val();
    var email    = $("#email").val(); 
    var phone    = $("#phone").val();
    var website  = $("#website").val();
    var is_owner = $("input[type='radio'][name='is_owner']:checked");
    //for location
    var location1 = $("#location_1").val();
    var location2 = $("#location_2").val();
    var location3 = $("#location_3").val();
    var location4 = $("#location_4").val();
    var location5 = $("#location_5").val();
    //for review details
    var rating = $("#rating").val();
    var review = $("#review").val();
    var review_title   = $("#review_title").val();
    var reviewer_name  = $("#reviewer_name").val();
    var reviewer_email = $("#reviewer_email").val();

$(function() {
    document.getElementById('elements').style.pointerEvents = 'none';
    // Setup form validation on the #register-form element
        $("#1form").validate({
        // Specify the validation rules
        ignore: ":hidden:not(#rating)",
        rules: {
            company_title: "required",
            is_owner: "required",
            location_1: "required",
            location_3: "required",
            location_4: "required",
            "email": {
                required: '#travel_no_1:checked',
                email: true
            },
            "phone": {
                required: false,
                digits: true
            },
            "website": {
                required: false,
                url: true
            },
            "street_address": {
                required: true,
                minlength: 5,
            },
            "review_title": {
                required: '#travel_yes_1:checked',
                minlength: 1
            },
            "review_comment": {
                required: '#travel_yes_1:checked',
            },
            "reviewer_name": {
                required: '#travel_yes_1:checked',
                minlength: 1
            },
            "reviewer_email": {
                required: '#travel_yes_1:checked',
                minlength: 1,
                email: true
            },
            "review": {
                required: '#travel_yes_1:checked',
                minlength: 4
            },
           "rating": {
                required: '#travel_yes_1:checked',
                number:true,
            },
            "agree": {
                required : true
            },
        },
        // Specify the validation error messages
        messages: {
            company_title: "please enter the company name",
            "street_address": {
                required: "Please enter your street address",
                minlength: "Street address should be at least of 5 characters",
            },
            is_owner  : "*",
            location_1: " Please select your country",
            location_3: "Please select your state",
            location_4: "Please select your city",
            "review_title": {
                required: "Please enter Review title",
                minlength: "Review title should be atleast of 2 characters",
            },
            "review_comment": {
                required: "Please enter Review comment",
            },
            "review": {
                required: "Please enter Review ",
                minlength: "Review title should be atleast of 4 characters",
            },
            rating: "Please specify a rating.",
            agree: "*"
        },  submitHandler: function(form) {
                  $("#submitReview").attr('disabled', true);
                  $("#smallSpinner").show();
          <? //check captcha ?>
                          if(get_Captcha() == ''){
                  $('#submitReview').click();
                  $("#submitReview").attr('disabled', false);
                  $("#smallSpinner").hide();
                   document.getElementById('re-captcha').innerHTML = "Captcha field is required";
        return false;
                } else {
                  $('.resultsMessage').hide();
                  $('#spinner').show();
                  var formdata = $("#1form").serialize();
                  $.ajax({
                    type: "POST",
                    url: "<?=SOCIALNETWORK_URL?>/add_com.php",
                    data: formdata,
                    success: function(data) {
                      if(data.indexOf("true") > -1){
                        
                        if($('#travel_yes_1').is(':checked')){
                          $('#spinner').hide();
                          loadModelWindow('Thank you for submitting business and review, our team will review business details and make it live along with your comment.');
                        }

                        if($('#travel_no_1').is(':checked')){
                          $('#spinner').hide();
                          loadModelWindow('Thank you for submitting business, we have send an email with validaton code please action the link.');
                        }

                      }
                    }
                  });    
                }
            
        }
    });
  });
</script>
<script>  
  //for setting the rate value on stars on page load.
  $.fn.gotof = function() {  
    var rat = $("#rate_form").val();
    if(rat == 1) { 
       $('#1star').css('background-color', '#F00000');
       $('#2star,#3star,#4star,#5star').css('background-color', '');
       $('#rate').empty();
       $('#rate').append("<font color = #F00000 >Bad! </font><br />");
    }  else if(rat == 2) {
       $('#2star,#1star').css('background-color', '#FF9900');
       $('#3star,#4star,#5star').css('background-color', '');
       $('#rate').empty();
       $('#rate').append("<font color = #FF9900 >Not Good! </font><br />");  
    }  else if(rat == 3) {
       $('#3star,#2star,#1star').css('background-color', '#FF9900');
       $('#4star,#5star').css('background-color', '');
       $('#rate').empty();
       $('#rate').append("<font color = #FF9900 >Average! </font><br />"); 
    }  else if(rat == 4) {
       $('#4star,#3star,#2star,#1star').css('background-color', '#6ea840');
       $('#5star').css('background-color', '');
       $('#rate').empty();
       $('#rate').append("<font color = #6ea840 >Good! </font><br />");
    } else if(rat == 5) { 
       $('#5star,#4star,#3star,#2star,#1star').css('background-color', '#6ea840');
       $('#rate').empty();
       $('#rate').append("<font color = #6ea840 >Excellent! </font><br />");
    }
  }
</script>
<script>
function resetRatingLevel() {
  setDisplayRatingLevel(document.rate_form.rating.value);
}

function setRatingLevel(level) {
  document.rate_form.rating.value = level;
}

function toggleStatus() {
  if ($('#toggleElement').is(':checked')) {
    $.fn.gotof();      
    $('#elementsToOperateOn :input').removeAttr('disabled');                        
  } else {
    $('#elementsToOperateOn :input').attr('disabledd, true', true);
  }   
}
</script>
<script>
 $("#toggleElement").change(function() {
    if(this.checked) {
    }
});
</script>
<script>
$("input:radio[name^=is_owner]").live('click', function() {
    if($("#travel_no_1").is(":checked") == true){
      document.getElementById('elements').style.pointerEvents = 'none'; 
      $("#review_title").attr('disabledd, true', 'disabled');
      $("#review").attr('disabledd, true', 'disabled');

      $('#review,#review_title,#rating,#reviewer_name,#reviewer_email').val('');
      $('#reviewer_name,#reviewer_email').hide();
      $('#rate').html('Rate it!');
      $('#1star,#2star,#3star,#4star,#5star').css('background-color', '');
      $("label[for='reviewer_name']").hide();
      $("label[for='reviewer_email']").hide();
    }

    if($("#travel_yes_1").is(":checked") == true){
      $('#reviewer_name,#reviewer_email').show();
      document.getElementById('elements').style.pointerEvents = 'auto'; 
      $("#review_title").removeAttr('disabled');
      $("#review").removeAttr('disabled');
    }

});
</script>
<script>
function loadModelWindow(msg){
  jQuery.fancybox({
      'height' : 70, 
      'modal' : true,

      'content' : "<div class=\"modal-content\"><h2>Info</h2><div style=\"width:500px;\" class=\"sureDelete\">"+msg+"<div style=\"text-align:right;margin-top:10px;\"><button id=\"fancyconfirm_cancel\" style=\"padding:4px 6px;\" type=\"button\" class=\"btn btnCancel\" >Ok</button></div></div></div>",
      'beforeShow' : function() {
          jQuery("#fancyconfirm_cancel").click(function() {
            window.location = '<?=DEFAULT_URL?>';
          });
        }
  });
}
</script>
<style type="text/css">  
  .error{
    color: red;
    font-size: 12px;
    font-family: sans-serif;
    font-weight: normal;
  }   
  .select {
      width:290px;
      padding: 4px 6px;
  }
      table.test td {
      margin: 0px 5px 12px 12px;
      padding: 0px 5px 12px 30px;
  }
  table.test {
      border-spacing: 10px;
      *border-collapse: expression('separate', cellSpacing = '10px');
  }
</style>