<?

    /*==================================================================*\
    ######################################################################
    #                                                                    #
    # Copyright 2005 Arca Solutions, Inc. All Rights Reserved.           #
    #                                                                    #
    # This file may not be redistributed in whole or part.               #
    # eDirectory is licensed on a per-domain basis.                      #
    #                                                                    #
    # ---------------- eDirectory IS NOT FREE SOFTWARE ----------------- #
    #                                                                    #
    # http://www.edirectory.com | http://www.edirectory.com/license.html #
    ######################################################################
    \*==================================================================*/

    # ----------------------------------------------------------------------------------------------------
    # * FILE: /includes/forms/form_paymentmethod.php
    # ----------------------------------------------------------------------------------------------------

    $arrayGateways = array();
    
    if (AUTHORIZEPAYMENT_FEATURE == "on") {
        $arrayGateways[] = "authorize||".system_showText(LANG_LABEL_BY_CREDIT_CARD);
    }
    
    if (LINKPOINTPAYMENT_FEATURE == "on") {
        $arrayGateways[] = "linkpoint||".system_showText(LANG_LABEL_BY_CREDIT_CARD);
    }
    
    if (ITRANSACTPAYMENT_FEATURE == "on") {
        $arrayGateways[] = "itransact||".system_showText(LANG_LABEL_BY_CREDIT_CARD);
    }
    
    if (WORLDPAYPAYMENT_FEATURE == "on") {
        $arrayGateways[] = "worldpay||".system_showText(LANG_LABEL_BY_CREDIT_CARD);
    }
    
    if (PSIGATEPAYMENT_FEATURE == "on") {
        $arrayGateways[] = "psigate||".system_showText(LANG_LABEL_BY_CREDIT_CARD);
    }
    
    if (TWOCHECKOUTPAYMENT_FEATURE == "on") {
        $arrayGateways[] = "twocheckout||".system_showText(LANG_LABEL_BY_CREDIT_CARD);
    }
    
    if (PAYFLOWPAYMENT_FEATURE == "on") {
        $arrayGateways[] = "payflow||".system_showText(LANG_LABEL_BY_CREDIT_CARD);
    }
        
    if (PAYPALPAYMENT_FEATURE == "on") {
        $arrayGateways[] = "paypal||".system_showText(LANG_LABEL_BY_PAYPAL);
    }
    
    if (SIMPLEPAYPAYMENT_FEATURE == "on") {
        $arrayGateways[] = "simplepay||".system_showText(LANG_LABEL_BY_SIMPLEPAY);
    }
    
    if (PAGSEGUROPAYMENT_FEATURE == "on") {
        $arrayGateways[] = "pagseguro||".system_showText(LANG_LABEL_BY_PAGSEGURO);
    }
    
    if (INVOICEPAYMENT_FEATURE == "on") {
        $arrayGateways[] = "invoice||".system_showText(LANG_LABEL_PRINT_INVOICE_AND_MAIL_CHECK);
    }

    $imagelink_color = NON_SECURE_URL . '/custom/domain_1/image_files/cards/bw/';
    $imagelink       = NON_SECURE_URL . '/custom/domain_1/image_files/cards/';

    # --------------------------------
    # Sagepay Modification 
    # --------------------------------
    $sageApp = Sagefactory::getApplication();
    if( $sageApp->setTask( 'paymentsettings', 'getActivationStatus' )->run(true) === 'on' ){
        $arrayGateways[] = "sagepay||by SagePay";
    }

    # --------------------------------
    # Braintree Modification 
    # --------------------------------

    $dbMain = db_getDBObject(DEFAULT_DB, true);
    $dbDomain = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
    $db = $dbDomain->db_name;

    $sql = "SELECT * FROM $db.Setting_Payment WHERE name = 'BRAINTREE_ACTIVE' ";
    $resource = $dbDomain->query( $sql );


    while($row = mysql_fetch_assoc($resource) ){
         $array [] = $row;
    }
    
    $count = count($array);
    for($i=0; $i<$count; $i++){
     $arr[$array[$i] ['name']] = $array[$i] ['value']; //Braintree Stats and Value
    }
    
    if ($arr['BRAINTREE_ACTIVE'] == "on"){
        $arrayGateways[] = "braintree||By Debit / Credit Card"; //Added Braintree
    }

    # --------------------------------
    # Paypal Modification 
    # --------------------------------

    $sql = "SELECT * FROM $db.Setting_Payment WHERE name = 'PAYPAL_STATUS' ";
    $resource = $dbDomain->query( $sql );

    while($row = mysql_fetch_assoc($resource) ){
         $pay_array [] = $row;
    }
    // Paypal Value
    define(PAYPAL_STATUS_DB, $pay_array[0]['value']);

    $countGat = 0;

    if (is_array($arrayGateways) && $arrayGateways[0]) { ?>
    <? 
      #----------------------------------------------
      # Payment Form Code Below
      #----------------------------------------------
    ?>
    <div class="panelWrapperBilling">
       <div class="panel pull-right" style="padding:5px;background-color: #FF004F;margin-bottom: 0;">
        <div class="priceWrapper" style="color:#fff;overflow: hidden;">
            <h5 style="display:inline-block;margin:0;">Total Price: </h5>
            <span class="symbol"><?=$currency['currency']?></span> 
            <p class="billtotal" style="display:inline;color:#fff;"></p>
        </div>
      </div> <!--/panel pull-right-->
    </div>  <!--/panelWrapperBilling-->
        
    <div class="paymentWrapper text-center">
      <p>Choose a Payment Method</p>

      <div class="choosePaymentOption clearfix">     

        <? foreach ($arrayGateways as $gateway) {
            $gatewayInfo = explode("||", $gateway); 
            $countGat++; 
            if($gatewayInfo[1] == "By PayPal"):
                $pull_class = 'pull-right';
            elseif($gatewayInfo[1] == "By Debit / Credit Card"):
                $pull_class = 'pull-left row';
            endif;
            ?>

            <div class='radioBilling' id="pay-<?=$gatewayInfo[0]?>" style="" >
                <div class="col-xs-6 col-sm-6">
                        <div class="row"> 
                          <div class="<?=$pull_class;?>">
                                <div class="col-sm-12">
                                    <input type="radio" name="payment_method" class="radioPayment" value="<?=$gatewayInfo[0]?>" id="radio-<?=$gatewayInfo[0]?>" style="pointer-events: none; display:none;" <?php if($gatewayInfo[0]=='braintree') echo "checked = 'checked'" ?> />
                                     <label class="cardname">
                                         <? if($gatewayInfo[1] == "By PayPal"): ?>
                                            <i class="fa fa-check paymentCheckPaypal" aria-hidden="true"></i>
                                            <div id="paypal-container"></div>
                                            <? elseif($gatewayInfo[1] == "By Debit / Credit Card"): ?>
                                            <div id="braintree-container" style="display:inline-block;width:115px;height:44px;overflow:hidden;cursor:pointer;">
                                            <a id="debitCard"  style="max-width: 100%;display: block; width: 100%; height: 100%; outline: medium none; border: 0px none;">
                                                <img id="cardclicked" rel="<?=$gatewayInfo[0]?>" style="display:none;max-width:100%;display: block; width: 100%; height: 100%; outline: medium none; border: 0px none;" src="<?=DEFAULT_URL.'/custom/domain_1/theme/review/images/dc.png'?>">
                                            </a>
                                            <i class="fa fa-check paymentCheckCreditcard" aria-hidden="true"></i>
                                          </div>
                                         <?endif;?>
                                     </label>
                                </div>
                             </div>
                          </div>
                </div>
            </div>

        <? } ?>

      </div><!--/choosePaymentOption -->


    <input type="hidden" name="second_step" id="second_step" value="1" style="display:none" />


     <div class="payment-wrapper clearfix">

      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
        <div class="row">
            <div class="button-wrapper pull-left">
              <label style="color:#000;padding-left:0;" class="checkbox-inline">We accept all major credit cards.<?="   ";?><img alt="cards" src="<?=$imagelink?>cards.png" /></label>
            </div>
        </div>
      </div>

      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
        <div class="row">
            <div class="button-wrapper pull-<?=!$_SERVER['HTTP_X_REQUESTED_WITH'] ? 'right' :'left'; ?>">
                <div class="text-left">
                  <label style="color:#000;" class="checkbox-inline"><input id="check" type="checkbox" class="termsCondition" value=""> I agree to all the Terms of Purchase. </label>
                  <button style="" value="submit" type='submit' id="button" class='btn btn-default checkout pull-right'><i class='fa fa-share'></i> Check Out</button>
                </div>
            </div>
        </div>
      </div>

      <div class="col-xs-12 col-sm-12">
        <div class="row">
          <p class="msg" style="color:red;">
            <p class="msg2" style="margin-top:-10px;"></p>
            <p class="msg3" style="margin-top:-10px;"></p>
          </p>
        </div>
      </div>

      </div>

    <? }
   
    /**
     *  SagePay Modification --- Display form after clicking on 'by sagepay'
     */
     $sageApp->setTask( 'clientdetails' )->run();

?>
<? //Please Select a Payment Method Script ?>
<script>
   
    <? //Hide Paypal sitemanager ?>
    var paypalonoff = "<?=PAYPAL_STATUS_DB?>";
    if (paypalonoff != "on"){
        $( "#pay-paypal" ).empty();
    }

    $( "#paypal" ).click(function(event) {
        $( "#radio-paypal" ).click();
    });

    $( "#button" ).click(function(event) {
        var val = $('.radioPayment:checked').val();
        var val2 = $('#check').val();
        if (!$("#check").is(":checked")) {
        event.preventDefault();                 
        $('.msg').empty();
        $('.msg2').empty();
        $('.msg3').empty();
        $('.msg3').append("<font color=red>Please accept terms of purchase, before proceeding.</font>");
        }
        $( "#check" ).click(function(event) {
             if ($("#check").is(":checked")) {
                $('.msg3').empty();
            }
        });

        if ( !val ){
        event.preventDefault();                 
        $('.msg').empty();
        $('.msg2').empty();
        $('.msg2').append("<font color=red>Please select a payment method.</font>");
        } else {
            $('.msg').remove();
        }    
    });

</script>

<?//Script to not let user pass if no item is selected?>
<script>
    $( "#button" ).click(function(event) {
    var getVal = $('.singleprice').siblings('.each-price-ref').val();
    var arr    = getVal.split('-');
    thisPrice  = Number(arr[0]);
    if (!thisPrice){
        event.preventDefault();
        $('.msg2').empty();
        $('.msg3').empty();
        $('.msg3').append("<font color=red>No Items Selected / Requiring Payment.</font>");
    }
            

});
</script>

<?//Script to Calculate Total Billing page ?>
<script>
    calculateTotal();
    function calculateTotal(){
        var total = Number("0.00");
        <?//Calculate total is based on paragraph class singleprice value ?>        
        $('.singleprice').each(function(){
            if($(this).closest(".yearly").children('td:first').children('.inputCheck').is(':checked') == true){
                // var thisPrice = Number($(this).siblings('.each-price-ref').val());
                // total = total + thisPrice;
                var thisPrice = $(this).siblings('.each-price-ref').val();
                var check     = $(this).siblings('.custom_checkbox4').val();
                if(check == 'y') {
                        total = parseFloat(total) + parseFloat(thisPrice);
                }
 
            }
            $('.billtotal').text(parseFloat(total).toFixed(2));
        });
    }
</script>

<?//Script to toggle Add Remove Payment Item?>
<script>
    function toggleItem(id, type){
        <? //When toggling change the ADD/REMOVE button text and color ?>
        $('#btn-'+id).toggleClass( "plusbtn" );
        $('#btn-'+id).html( $('#btn-'+id).html().trim() == '<i class="fa fa-times" id="checkout"></i>' ? '<i class="fa fa-plus" id="checkout"></i>' : '<i class="fa fa-times" id="checkout"></i>' );
        
        if($('#btn-'+id).attr('data-original-title') == 'Remove'){
            $('#btn-'+id).attr('data-original-title','Add');
            $('#btn-'+id).closest('tr').addClass('customDisabled');
            $('#btn-'+id).addClass('customEnabled');
        }
        
        else if($('#btn-'+id).attr('data-original-title') == 'Add'){
            $('#btn-'+id).attr('data-original-title','Remove');
            $('#btn-'+id).closest('tr').removeClass('customDisabled');
            $('#btn-'+id).addClass('customEnabled');
        }
        

        <?//Check or uncheck checkbox?>
        if(type.trim() === "listing"){
            $('#listing_id-'+id).prop("checked", !$('#listing_id-'+id).prop("checked"));
        } else {
            $('#case_id-'+id).prop("checked", !$('#case_id-'+id).prop("checked"));
        }
        var price = $('#singleprice-'+id).text().trim();
        <? //Calculate values based on whether checkbox is checked ?>
        if(type.trim() === "listing"){
            if($('#listing_id-'+id).is(':checked') == true){
                $('#price-ref-'+id).val(price);            
            } else {
                $('#price-ref-'+id).val("0.00");            
            }
        } else {
            if($('#case_id-'+id).is(':checked') == true){
                $('#price-ref-'+id).val(price);            
            } else {
                $('#price-ref-'+id).val("0.00");            
            }
        }
        <?//Migrate Paid Items To Unpaid When Press Add and display fadeout message ?>
        $('#btn-'+id).parents('li.service-list-item-notneed').removeClass( 'service-list-item-notneed' ).addClass('service-list-item-need').hide().after('<li class="fadeout" style="list-style:none;"><p class="alert alert-success">Business added to check out tab.</p></li>');
        calculateTotal();
        $('.fadeout').fadeOut(5000);
    }
</script>

<?//Braintree paypal script?>

<script type="text/javascript">
  braintree.setup("<?=$clientToken?>", "paypal", {
  container: "paypal-container",
  onPaymentMethodReceived: function (obj) { 
    var nonce = obj.nonce;
    $('#nonce').val(nonce);
    $('#radio-paypal').attr('checked', 'checked');
    $('#radio-braintree').removeAttr('checked');
    $('#bt-pp-email').hide();
    $('#bt-pp-cancel').hide();
    $('#braintree-paypal-loggedin').css('border','0px');
    $('.paymentCheckPaypal').show();
    $('.paymentCheckCreditcard').hide();
  }
});

$('.cardname').on('click', function(){
    var $self = $(this);
    $('.cardname').removeClass('card-selected');
    $self.addClass('card-selected');
    $('#radio-braintree').attr('value', 'braintree');
    $('#radio-braintree').attr('checked', 'checked');
    $('#radio-paypal').removeAttr('checked');
    $('.paymentCheckCreditcard').show();
});

$('#cardclicked').on('click', function(){
    if($('.paymentCheckPaypal').is(':visible')) {
        $('.paymentCheckPaypal').hide();
        $('#bt-pp-name').click();
    }
});

</script>