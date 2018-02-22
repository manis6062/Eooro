<?php
/**
 * @author          Subigya Jyoti Panta
 * @subpackage      Modules
 * @copyright (c) 2014, www.eooro.com
 * @version         1.0
 * @modification history original
 */
?>
<h3>Terms and Conditions</h3>
<div id="case-agreement" class="agreement">
    <p>
        <?=$this->caseCloseAgreement['long_description'];?>
    </p>
    <br>
    <p>
        <input id="agree-checkbox" type="checkbox" value="<?=$this->details['case'];?>" name="agree">I accept the Agreement
    </p>
    <p class="pull-right">    
        <button id="close-button" type="button" class="btn">Close Case</button> 
    </p>
</div>
<script>
    var checkBox    = document.getElementById( 'agree-checkbox' );
    var closeButton = document.getElementById( 'close-button' );
    closeButton.disabled = true;

    checkBox.onchange = function(){
        if ( this.checked ) {
            closeButton.disabled = false;
        }
        else{
            closeButton.disabled = true;
        }
    };
    
    console.log( $( '#close-button' ) );
    $( '#close-button' ).on( 'click',function(){
            var details = <?=json_encode($this->details);?>; 
            
            $.ajax({
                url: "<?=CASE_URL;?>",
                type: "POST",
                data: {
                    "action"    : "closeCase", 
                    "details"   : details 
                },
                success: function( response ){
                    closeButton.disabled = true;
                    parent.$.fancybox.close();
                }
            });
    });
</script>
