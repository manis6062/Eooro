<?php
/**
 * @author          Subigya Jyoti Panta
 * @subpackage      Modules
 * @copyright (c) 2014, www.eooro.com
 * @version         1.0
 * @modification history original
 */
?>
<link rel="stylesheet" href="<?=MODULES_REQ.'/casemanager/views/opencase/tmpl/style.css'?>" type="text/css"/>
<div class="modal-content" >
    <h2>
        <span class="truncatePopupTitle"> Open case for "<?=  ucwords($this->review->getString("review_title"));?>"</span>
        <span>
            <a href="javascript:void(0);" onclick="parent.$.fancybox.close();"><?=system_showText(LANG_CLOSE);?></a>
        </span>
    </h2>
    <div id="case-agreement">
        
        <h3 class="terms">Terms and Conditions</h3>
        <p class="agreement">
            <?=$this->settings['sponsor_t_and_c']['long_description'];?>
        </p>
        <button type="button" id="accept" class="btn agree-btn">I Agree</button>
        <button type="button" id="reject" class="btn agree-btn" onclick="parent.$.fancybox.close();">I don't Agree</button>
    </div>
    <div class="popup-opencase" id="case-form" style='display:none;'>
        <form action="<?=AJAX_REQ;?>" method="POST" id="opencase-form">
<!--             <div class="left">
				<div class="form-group">
					<label for="reviewer_name">Reviewer:</label>
					<input type="text" id="reviewer_name" value="<?=$this->review->getString("reviewer_name");?>" readonly="readonly">
				</div>
				<div class="form-group">
					<label for="reviewer_comment">Reviews:</label>
					<textarea id="reviewer_comment" name="details[review_comment]" rows="3" cols="21" readonly="readonly"><?=$this->review->getString("review");?></textarea>
				</div>
            </div>
            <div class="right">
			<div class="form-group">
                <label for="case_reason">Reason To Open Case<span class="req">*</span>: </label>
                <textarea id="case_reason" name="details[case_reason]" rows="6" col="28" placeholder="Give Your Reason to open the case in no more than 2000 characters" maxlength="2000"></textarea>
            </div>
            </div> -->
            <div class="form-group opencase-form">
                <label for="reviewer_name">Reviewer:</label>
                <input type="text" name="reviewer_name" class="form-control loginform reviewinput reviewplacehld text-write-review" id="reviewer_name" placeholder="Name" value="<?=$this->review->getString("reviewer_name");?>" readonly="readonly" maxlength="50" tabindex="1" required="" autofocus="">
            </div>
            <div class="form-group opencase-form">
                <label for="reviewer_comment">Reviews:</label>
                <textarea class="form-control loginform reviewinput reviewplacehld text-write-review" id="reviewer_comment" name="details[review_comment]" rows="3" cols="21" readonly="readonly"><?=$this->review->getString("review");?></textarea>
            </div>
            <div class="form-group opencase-form">
                <label for="case_reason">Reason To Open Case<span class="req">*</span>: </label>
                <textarea class="form-control textarea-write-review reviewCaptureOpenCase" id="case_reason" name="details[case_reason]" rows="6" col="28" placeholder="Give Your Reason to open the case in no more than 2000 characters" maxlength="2000"></textarea>
            </div>
            <div class="center">
                <input type="hidden" name="details[review_id]" value="<?=$this->review->getNumber("id");?>" />
                <input type="hidden" name="details[reviewer_id]" value="<?=$this->review->getNumber("member_id");?>" />
                <input type="hidden" name="details[owner_id]" value="<?=sess_getAccountIdFromSession();?>" />
                <? if($this->review->getString('item_type') == 'listing' ): ?>
                <input type="hidden" name="details[listing_id]" value="<?=$this->review->getNumber('item_id');?>"/>
                <? endif?>
                <input type="hidden" name="module" value="casemanager"/>
                <input type="hidden" name="con" value="opencase"/>
                <input type="hidden" name="action" value="registerCase" />
                <!--<input type="submit" name="submit_case" id="submit_case" value="Open Case" onclick="openCase(event);"/> -->
                <input type="submit" name="submit_case" id="submit_case" value="Open Case" class="btn agree-btn"/>
                <p id="paragraph" style="display:none;"><a target="_top" class="btn agree-btn" onclick="loadbilling();">Pay to activate case</a></p>
            </div>
        </form>
    </div>
        
    
</div>
<script src="<?=DEFAULT_URL.'/scripts/front/jquery-1.8.3.min.js';?>"></script>
<script>
    $( '#accept' ).on( 'click', function(){
        $( '#case-agreement' ).hide();
        $( '#case-form' ).show().promise().done(function(){
            parent.$.fancybox.update();
        });
    });
    $( '#opencase-form' ).submit(function( event ){
        event.preventDefault();
        
        var data = {};
        var Form = this;
        if ( this.elements['case_reason'].value.trim() !== '' ) {
            $.ajax({
                cache   : false,
                url     : '<?=AJAX_REQ?>',
                type    : "POST",
                datatype: "json",
                data    : $(Form).serialize(),
                context : Form,
                success: function( responseString ){
                            try{
                                var response = JSON.parse( responseString );
                            }
                            catch( ex ){
                                console.log( responseString );
                            }
                            if ( response['status'] ) {
                                $( '.modal-content .msg-status' ).remove();
                                $('.popup-opencase').before('<p class="successMessage msg-status">'+response['text']+'</p>');
                            }
                            else{
                                $( '.modal-content .msg-status' ).remove();
                                $('.popup-opencase').before('<p class="errorMessage msg-status">'+response['text']+'</p>');
                            }
                            var submitCase = document.getElementById( 'submit_case' );
                            submitCase.disabled = true;
                            submitCase.value    = 'Done..';
                            $('#submit_case').hide();
                            $('#paragraph').show();
                        },
                error  : function(){
                            $('.popup-opencase').before('<p class="errorMessage">Error !! Please try again Later</p>');
                        },
                complete: function(){
                            parent.$.fancybox.update();
                }
            });
        }
        else {
            $( '.modal-content .msg-status' ).remove();
            $('.popup-opencase').before('<p class="errorMessage msg-status">You need a Reason to Open a case.</p>');
            parent.$.fancybox.update();
        }
        
    }); 

function loadbilling(){
    $('#bill', parent.document).click();
    parent.$.fancybox.close();
}
</script>