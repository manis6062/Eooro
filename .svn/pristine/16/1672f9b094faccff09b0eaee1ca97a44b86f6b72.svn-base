<?

 ?>

        <div>
		<? if ($contactus_message) { ?>
			<p class="<?=$message_style?> ContactUs"><?=$contactus_message?></p>
		<? } ?>
	
            <form name="contactusForm" 
                  id="contactusForm" 
                  action="<?=DEFAULT_URL?>/<?=ALIAS_CONTACTUS_URL_DIVISOR?>.php" 
                  method="post" 
                  class="form"
                  role="form">
	                            
            <div class="row-fluid">
            <p id="msg" style="color:red;font-size: 12px;margin-bottom: 5px;margin-top: -23px;"></p>
                <div class="form-group formimage reviewmbtm">
                    <input id="name" 
                           name="name" 
                           value="<?=$_POST["name"];?>" 
                           type="text" 
                           class="form-control loginform reviewinput reviewplacehld"
                           placeholder="<?=system_showText(LANG_LABEL_NAME)?> *"/>
                </div>
                
                <div class="form-group formimage reviewmbtm">
                    <input id="email" 
                           name="email" 
                           value="<?=$_POST["email"];?>" 
                           type="email" 
                           class="form-control loginform reviewinput reviewplacehld"
                           placeholder="<?=system_showText(LANG_LABEL_EMAIL)?> *"  />
                </div>
                
                <div class="form-group formimage reviewmbtm">
                    <input id="title" 
                           name="title" 
                           value="<?=$_POST["title"];?>" 
                           type="text" 
                           class="form-control loginform reviewinput reviewplacehld"
                           placeholder="<?=system_showText(LANG_LABEL_SUBJECT)?> *"/>
                </div>
            </div>
			
			<?
			$_POST["messageBody"] = str_replace("<br />", "", $_POST["messageBody"]);
			?>
			
         
            <textarea id="message" 
                      name="messageBody" 
                      rows="5" 
                      cols="30" 
                      class="form-control"
                      placeholder="<?=system_showText(LANG_LABEL_MESSAGE)?> *"><?=$_POST["messageBody"];?></textarea>
         
			
            <p><?=system_showText(LANG_CAPTCHA_HELP)?></p>
			<div class="row-fluid overflow-hidden">
	            <div class="captcha">
	                <img class="pull-left" src="<?=DEFAULT_URL?>/includes/code/captcha.php" border="0" alt="<?=system_showText(LANG_CAPTCHA_ALT)?>" title="<?=system_showText(LANG_CAPTCHA_TITLE)?>" /><!-- <span class="req">*</span> -->
	                <input type="text" id="captcha" value="" name="captchatext" class="text span7 pull-right" placeholder="captcha *" />    

	            </div>
              <div class="row contact-button-margin-top-10 pull-right">
                <button id="submit" class="btn btn-success span12"><?=LANG_BUTTON_SEND?></button>
      </div>          
            </div>
            

		</form>
    </div>
    
<script>
$('#submit').click(function(e){

  function testempty(value){
    var z = 1;
      if ($('#'+value).val().trim() == '' ){
        $('#'+value).css('border','1px solid red');
        $('#msg').html('All fields are required.');
        var z = 0;
      }
    return z;
  }
  var total  = testempty("name") + testempty("email") + testempty("title") + testempty("message") + testempty("captcha");
  if(total < 5){ return false;  }
});

$("form#contactusForm :input").each(function(){
    $(this).click(function(e){
      $(this).css('border','1px solid #DCDCDC');
      // $(this).css('border','1px solid #66AFE9;');
    });    
});
</script>