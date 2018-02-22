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
<form method="POST" action="">
    <label>Address </label>
    <input type="text" name="address"/>
    <label>Credit Card No.</label>
    <input type="text" name="credit-card" /><span id="credit-card-validate"></span>
    <input type="hidden" name="second_step" value="1" />
    <input type="hidden" name="payment_method" value="sagpay" />
    <p class="standardButton paymentButton">
        <button type="submit" id="sagepay-button">Pay using SagePay</button>    
    </p>
</form>
<script type="text/javascript">
    function checkLuhn(input)
    {
      var sum = 0;
      var numdigits = input.length;
      var parity = numdigits % 2;
      for(var i=0; i < numdigits; i++) {
        var digit = parseInt(input.charAt(i))
        if(i % 2 == parity) digit *= 2;
        if(digit > 9) digit -= 9;
        sum += digit;
      }
      return (sum % 10) == 0;
    }
    var cardval = $( 'input[name=credit-card' )
    cardval.change(function(){
        var cardno = cardval.val();
        if ( checkLujhn(cardno) ) {
            $('#credit-card-validate').text( 'OK' );
        }
        else {
            $('#credit-card-validate').text( 'Invalid no.' );
        }
    });
        
</script>