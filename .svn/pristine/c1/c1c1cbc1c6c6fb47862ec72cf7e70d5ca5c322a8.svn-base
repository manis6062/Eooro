<?php
/**
 * @author          Subigya Jyoti Panta
 * @subpackage      SagePay
 * @copyright (c) 2014, www.eooro.com
 * @version         1.0
 * @modification history original
 */
defined( 'SJP' ) or die;
//print_r( $this->basket); echo '<br/>';echo '<br/>';
// print_r( '@'.$this->crypt );echo '<br/>';echo '<br/>';
// echo mcrypt_get_iv_size(MCRYPT_CAST_128, MCRYPT_MODE_CBC);echo '<br/>';echo '<br/>';
//$cryptor = Sagefactory::getCryptor();
//$clean = 'haha';
//$pass  = '9BgXZqImIoy0wlyB';
//
//echo 'Decoded: '. $cryptor->setEncryptedData($this->crypt)->setDecryptionCode($pass)->decrypt()->getCleanData();
?>

<form method="POST" action="<?='https://test.sagepay.com/Simulator/VSPFormGateway.asp';?>">
    
    
    
    <input type="hidden" name="VPSProtocol" value="<?=urlencode( '2.23' );?>" />
    <input type="hidden" name="TxType" value="<?=urlencode( 'PAYMENT' );?>" />
    <input type="hidden" name="Vendor" value="<?=urlencode( $this->settings->vendor );?>" />
    
    <input type="hidden" name="Crypt" value="<?='@'.$this->crypt;?>" />
    
    <p class="standardButton paymentButton">
        <button type="submit" id="sagepay-button">Pay using SagePay</button>    
    </p>
</form>
