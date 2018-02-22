<?php
/**
 * @author          Subigya Jyoti Panta
 * @subpackage      SagePay
 * @copyright (c) 2014, www.eooro.com
 * @version         1.0
 * @modification history original
 */
defined( 'SJP' ) or die;

$countrycode    = Sagefactory::getCountryCodes();
?>
<div class="container">
<div id="sagepay-selected" style="display:none;">
    <div id="msg"></div><br/><br/>
    <!--<button id="populate" >Populate from your account details</button> -->
    <!-- Billing Person's Details --> 
    <label>Name*</label>
    <input type="text" name="BillingFirstnames" value="<?=$this->client->first_name;?>" class="infor"/><br/>
    <label>Surname*</label>
    <input type="text" name="BillingSurname" value="<?=$this->client->last_name;?>" class="required infor"/><br/>
    <label>Address 1*</label>
    <input type="text" name="BillingAddress1" value="<?=$this->client->address;?>" class="required infor"/><br/>
    <label>Address 2</label>
    <input type="text" name="BillingAddress2" value="<?=$this->client->address2;?>" class="infor"/><br/>
    <label>City*</label>
    <input type="text" name="BillingCity" value="<?=$this->client->city;?>" class="required infor"/><br/>
    <label>Post Code / Zip code *</label>
    <input type="text" name="BillingPostCode" value="<?=$this->client->zip;?>" class="required infor" maxlength="10"/><br/>
    <label>Country*</label>
    <select class="required infor country" name="BillingCountry"><br/>
        <?php
            $clientCountryCode = $countrycode->getCode( $this->client->country );
            foreach( $countrycode->getCountriesAndCodes() as $code => $country ){
                if ( $clientCountryCode === $code ) {
                    echo '<option value="'.$code.'" selected="selected">'.$country.'</option>';
                }
                echo '<option value='.$code.'>'.$country.'</option>';
            }
        ?>
    </select><!--
    <label>State*</label> 
    <input type="text" name="BillingState" value="<?=$this->client->state;?>" class="required infor"/>-->
</div>
</div>

<script type="text/javascript">
    (function(){
        var sagepaySelected;
        
        function addRequired()
        {
            $( '#sagepay-selected' ).find( 'input' ).each(function(){
                var name = $(this).attr( 'name' );
                if( name != 'BillingAddress2'){
                    $(this).attr( 'required', 'true' );
                }
            });
        }
        function removeRequired()
        {
            $( '#sagepay-selected' ).find( 'input' ).each(function(){
                $(this).removeAttr( 'required' );
            });
        }
        
        $( 'input[name=payment_method]' ).click(function(){
            var sagepay = $(this).val();
        
            if ( sagepay === 'sagepay' ) {
                $( '#sagepay-selected' ).show(600);
                sagepaySelected = true;
                addRequired();
            }
            else {
                $( '#sagepay-selected' ).hide(600);
                sagepaySelected = false;
                removeRequired();
            }
        });
        
        $( '#sagepay-selected input')
                .blur(function(){
                    var regex;
                    var pattern = /[^a-zA-Z0-9._\-,:]/i;
                    var count1  = $(this).find( 'input' ).size();
                    var count2  = 0;
                    
                    $( '#sagepay-selected' ).find( 'input' ).each(function(){
                        var input   = $(this).val();
                        var name    = $(this).attr('name');
                        if ( name == 'BillingPostCode' ) {
                            regex = /[^\s\w]/;
                            var value = $(this).val();
                            $(this).val( value.replace( /\s/g, '' ) );
                        }
                        else if( name == 'BillingAddress1' || name == 'BillingAddress2'){
                            regex = /[^a-zA-Z0-9._\-,:\s]/;
                        }
                        else{
                            regex = pattern;
                        }
                        var match   = regex.test(input);
                        if ( match ) {
                            $( '#msg' ).text( 'Your Form is Invalid !! Please Fill in All the Required fields properly' ).css( 'color', 'red' );
                            count2++;
                            $( 'button[type=submit], button[type=button]' ).attr( 'disabled', 'disabled' );
                        }
                    });
                    
                    if ( count2 === 0 ) {
                        $( '#msg' ).text( '' );
                        $( 'button[type=submit], button[type=button]' ).removeAttr( 'disabled' );
                    }
                });
    })(jQuery);
</script>