<?php
/**
 * @author          Subigya Jyoti Panta
 * @subpackage      SagePay
 * @copyright (c) 2014, www.eooro.com
 * @version         1.0
 * @modification history original
 */
defined( 'SJP' ) or die;

echo htmlentities( $this->data );

?>
<form method="POST" action="<?=SAGE_DIRECT_URL;?>">
    
    <!-- Billing Person's Details --> 
    <label>Name</label>
    <input type="text" name="credit-card" /> 
    
    
    <label>Credit Card No.</label>
    <input type="text" name="credit-card" /><span id="credit-card-validate"></span>
    
    <!-- item details -->
    <?php foreach ( $this->items as $key => $value ):    ?>
            <input type="hidden" name="items[<?=$key;?>][item][description]" value="<?=$value['title'];?>" />
            <input type="hidden" name="items[<?=$key;?>][item][productSku]" value="<?=$value['itemType'];?>" />
            <input type="hidden" name="items[<?=$key;?>][item][productCode]" value="0"/>
            <input type="hidden" name="items[<?=$key;?>][item][quantity]" value="1" />
            <input type="hidden" name="items[<?=$key;?>][item][unitNetAmount]" value="<?=$value['total_fee'];?>" />
            <input type="hidden" name="items[<?=$key;?>][item][unitTaxAmount]" value="<?=$value['unitTaxAmount'];?>" />
            <input type="hidden" name="items[<?=$key;?>][item][unitGrossAmount]" value="<?=$value['unitGrossAmount'];?>" />
            <input type="hidden" name="items[<?=$key;?>][item][totalGrossAmount]" value="<?=$value['totalGrossAmount'];?>" />
            
    <? endforeach; ?>
    <!-- client details -->
    <input type="hidden" name="client[recipientFName]" value="<?=$this->client->first_name;?>" class="required" />
    <input type="hidden" name="client[recipientLName]" value="<?=$this->client->last_name;?>" class="required" />
    <input type="hidden" name="client[recipientMName]" value="0" />
    <input type="hidden" name="client[recipientSal]" value="Hello" />
    <input type="hidden" name="client[recipientEmail]" value="<?=$this->client->email;?>" class="required" />
    <input type="hidden" name="client[recipientPhone]" value="<?=$this->client->phone;?>" class="required" />
    <input type="hidden" name="client[recipientAdd1]" value="<?=$this->client->address;?>" class="required" />
    <input type="hidden" name="client[recipientAdd2]" value="<?=$this->client->address2;?>" />
    <input type="hidden" name="client[recipientCity]" value="<?=$this->client->city;?>" class="required" />
    <input type="hidden" name="client[recipientState]" value="<?=$this->client->state;?>" />
    <input type="hidden" name="client[recipientCountry]" value="<?=$this->client->country;?>" class="required" />
    <input type="hidden" name="client[recipientPostCode]" value="<?=$this->client->zip;?>" class="required" />
        
    <input type="hidden" name="other[agentId]" value="<?=sess_getAccountIdFromSession();?>" />
    <input type="hidden" name="VPSProtocol" value="<?=urlencode( '2.23' );?>" />
    <input type="hidden" name="TxType" value="<?=urlencode( 'PAYMENT' );?>" />
    <input type="hidden" name="Vendor" value="<?=urlencode( 'eooro' );?>" />
    <input type="hidden" name="VendorTxCode" value="<?=urlencode( 564735624756745 );?>" />
    <input type="hidden" name="second_step" value="1" />
    <input type="hidden" name="payment_method" value="sagepay" />
    <p class="standardButton paymentButton">
        <button type="submit" id="sagepay-button">Pay using SagePay</button>    
    </p>
    <div id="error-message"></div>
</form>

<script type="text/javascript">
        
    (function($){
        function checkCardNo(input)
        {
            var sum = 0;
            var numdigits = input.length;
            var parity = numdigits % 2;
                if ( numdigits >= 8 ) {
                    for(var i=0; i < numdigits; i++) {
                      var digit = parseInt(input.charAt(i))
                      if(i % 2 == parity) digit *= 2;
                      if(digit > 9) digit -= 9;
                      sum += digit;
                    }
                    return (sum % 10) == 0;
                }
                else {
                    return 0;
                }
                    
        }
        var cardval = $( 'input[name=credit-card]' );
//        console.log( cardval );
        cardval.keypress(function(){
            var cardno = cardval.val();
            if ( checkCardNo(cardno) ) {
                $('#credit-card-validate').text( ' OK !' ).css('color', 'green');
            }
            else {
                $('#credit-card-validate').text( 'Invalid no.' ).css('color', 'red');
            }
        });
        $('.required').each(function(){
            var inadequateInfo;
            if ( $(this).val() == false ) {
                inadequateInfo = true;
            }
            if ( inadequateInfo ) {
                $( '#error-message' ).text('You haven\'t provided your full information, please fill in you account details before paying.' ).css( 'color', 'red' );
                $( '#sagepay-button' ).attr( 'disabled', 'disabled' );
            }
        });
        
    })(jQuery);
</script>