<?
  $verfiy3DSecure = true;
  $accountObj     = new Account(sess_getAccountIdFromSession());
  $contactObj     = new Contact($accountObj->id);
  $countrycode    = Sagefactory::getCountryCodes();
  $imagelink      = DEFAULT_URL . '/custom/domain_1/image_files/cards/';
  $listing_id ? $_POST['listing_id'] = $listing_id : null; // CLaim page fix

  if($verfiy3DSecure == true):
    $return         = null;
    $returnVerified = DEFAULT_URL."/".MEMBERS_ALIAS."/"."billing"."/processpayment.php?payment_method=braintree";
    require_once EDIRECTORY_ROOT.'/braintree/braintree-php/lib/Braintree.php';
    require_once EDIRECTORY_ROOT.'/braintree/_environment.php';
    
    try {
      $clientToken = Braintree_ClientToken::generate();
    } catch (Exception $e) {
      header('Location: '.DEFAULT_URL . "/" . MEMBERS_ALIAS);
      exit;
    }

    if($_POST['num']): //user enters credit card details

    #------------------------------------------------------------
    # Create a customer for Braintree if not present
    #------------------------------------------------------------

    if(!$customer_id):
      // $result = Braintree_Customer::create(
      //   [
      //     'firstName' => $_POST['firstname'],
      //     'lastName' => $_POST['lastname'],
      //     'company' => $_POST['company']
      //   ]
      // );
        $result = Braintree_Customer::create([
            'firstName'     => $_POST['first'],
            'lastName'      => $_POST['last'],
            'company'       => $_POST['company'],
            'email'         => $_POST['email'],
            'phone'         => $_POST['phone'],
            'fax'           => $contactObj->fax,
        ]);

      $customer_id = $result->customer->id;
      $accountObj->bt_customer_id = $customer_id;
      $accountObj->save();

    endif;

    #--------------------------------------------------------------
    # Add credit card details and get a Payment Method Nonce (because need to have nonce or customer id to add credit card details so first create customer id(up) and add card details. nonce is created from customer id below)
    #--------------------------------------------------------------

    $result = Braintree_Customer::update(
        $customer_id, 
        [       
              'creditCard' => [
              'cardholderName' =>  mysql_real_escape_string($_POST['firstName'] . " " . $_POST['lastName'] ),
              'number' => mysql_real_escape_string($_POST['num']),
              'expirationDate' => mysql_real_escape_string(makeExpDate($_POST['expdate_year'], $_POST['expdate_month'])),
              'cvv' => mysql_real_escape_string($_POST['cvv2Number']),
              'billingAddress' => [
                'postalCode' => $_POST['zip'],
                'streetAddress' => $_POST['address1']
              ]
            ]
        ]
    );

    if($result->success == true):

        $token    = $result->customer->creditCards[0]->token;
        $getNonce = Braintree_PaymentMethodNonce::create($token);
        $nonce1    = $getNonce->paymentMethodNonce->nonce;

    else:

        $error_message = $result->_attributes['message'];
        $error_message = rtrim($error_message, ".");
        $error_message = " - " . $error_message;
        $error_message = str_replace(".", "<br> - ", $error_message);

    endif;

  endif;

  else:
    $return = DEFAULT_URL."/".MEMBERS_ALIAS."/"."billing"."/processpayment.php?payment_method=braintree";
  endif;  
?>
<?if($error_message):?>

  <p class="alert alert-danger" id="errorMessage">
    <strong>Sorry following errors occured!</strong><br>
    <?=$error_message?>
    Please try again.
  </p>
  <script>
  $('#spinner').hide();
  $('#braintree-payment-form').show();
  </script>

<?endif;?>
<?php if(!$fromUpdatePaymentMethod) { //dont show if its update payment method page ?>
<form method="post" id="braintree-payment-form" autocomplete="off" action="<?=$return?>">
<?php } ?>
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <div class="col-sm-6">
          <div class="personalInformation">
            <h1><i class="fa fa-user fa-personalInformation"></i>Payment <span class="information">Information</span></h1>
          </div>
          <div class="personalInformation-holder panel-body">
              <!-- Listings -->
              <?if($_POST['listing_id']):?>
                <?foreach ($_POST['listing_id'] as $key => $value):?>
                  <input type="hidden" name="listing_id[]" value="<?=$value?>">
                <?endforeach;?>
              <?endif;?>

              <!-- Cases -->
              <?if($_POST['case_id']):?>
                <?foreach ($_POST['case_id'] as $key => $value): ?>
                  <input type="hidden" name="case_id[]" value="<?=$value?>">
                <?endforeach;?>
              <?endif;?>
              <input type="hidden" name="second_step" value="1">
              <input type="hidden" name="payment_method" value="<?=$post['payment_method']?>">
              <input type="hidden" name="list_id" value="<?php echo $_SESSION['list_id']; ?>" />
              <input type="hidden" name="third_step" value="1">

              <div class="row">
                <div class="col-sm-4">
                  <div class="form-group rmp">
                    <label for="salutation">Salutation</label>
                      <select class="form-control" id="salutation">
                          <option>Mr.</option>
                          <option>Ms.</option>
                          <option>Mrs.</option>
                      </select>    
                  </div>
                </div>
                <div class="col-sm-8">
                  <div class="form-group rmp">
                    <label for="company">Company</label>
                    <input type="text" class="form-control" name="company" id="company" value="<?=$_POST['company'] ? htmlspecialchars($_POST['company']) : htmlspecialchars($contactObj->company)?>" placeholder="Enter your Company">
                  </div>
                </div>
              </div>

              <div class="row">
                  <div class="col-sm-6">
                  <div class="form-group rmp">
                          <label for="firstname">First Name*</label>
                          <input type="text" class="form-control" id="firstname" name="first" placeholder="First Name" value=<?=$_POST['first'] ? htmlspecialchars($_POST['first']) : htmlspecialchars($contactObj->first_name)?>>
                     </div>
                  </div>
                  <div class="col-sm-6">
                     <div class="form-group rmp">
                          <label for="lastName">Last Name*</label>
                         <input type="text" class="form-control" id="lastName" name="last" value="<?=$_POST['last'] ? htmlspecialchars($_POST['last']) : htmlspecialchars($contactObj->last_name)?>" placeholder="Last Name">
                      </div>
                  </div>
              </div>

              <div class="row">
                  <div class="col-sm-12">
                      <div class="form-group rmp">
                      <label for="email-personalInformation">Email</label>
                      <input type="email" name="email" class="form-control" id="email-personalInformation" value="<?=$_POST['email'] ? $_POST['email'] : $contactObj->email?>" placeholder="Enter Your Email" >
                      <i class="fa fa-envelope-o personalInformation"></i>
                  </div>
                  </div>
                  <div class="col-sm-12">
                      <div class="form-group rmp">
                      <label for="phone-personalInformation">Phone</label>
                      <input type="tel" name="phone" class="form-control" id="phone-personalInformation" value="<?=$_POST['phone'] ? $_POST['phone'] : $contactObj->phone?>" placeholder="Enter Your Phone Number" >
                      <i class="fa fa-phone-square phonePersonalInformation"></i>
                  </div>
                  </div>
              </div>                          

              <div class="row">
                <div class="col-sm-4">
                  <div class="form-group rmp">
                      <label for="zipcode">Postal/Zip Code*</label>
                      <input type="tel" name="zip" class="form-control" value="<?=$_POST['zip'] ? $_POST['zip'] : $contactObj->zip?>" id="zipcode" placeholder="Zip Code">
                  </div>
                </div>
                <div class="col-sm-8">
                  <div class="form-group rmp">
                    <label for="stateCounty">State / County*</label>
                    <input type="text" name="state" class="form-control" value="<?=$_POST['state'] ? htmlspecialchars($_POST['state']) : htmlspecialchars($contactObj->state)?>" id="stateCounty" placeholder="State">
                  </div>
                </div>
              </div>
              
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group rmp">
                    <label for="addressPersonalInformation">Street Address*</label>
                    <input type="text" name="address1" class="form-control" value="<?=$_POST['address1'] ? htmlspecialchars($_POST['address1']) : htmlspecialchars($contactObj->address)?>" id="addressPersonalInformation" placeholder="Enter Your Address">
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group rmp">
                    <label for="cityPersonalInformation">City*</label>
                    <input type="text" name="city" class="form-control" value="<?=$_POST['city'] ? htmlspecialchars($_POST['city']) : htmlspecialchars($contactObj->city)?>" id="cityPersonalInformation" placeholder="City">
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group rmp">
                    <label for="countryPersonalInformation">Country*</label><p id="errmsg1"></p>
                    <select class="form-control required" name="BillingCountry" id="countryPersonalInformation">
                      <option value="">Select Your Country</option>
                        <?php
                              $clientCountryCode = $countrycode->getCode( $contactObj->country );
                              $_POST['BillingCountry'] ? $clientCountryCode = $_POST['BillingCountry'] : null;
                              
                                  foreach( $countrycode->getCountriesAndCodes() as $code => $country ): ?>
                                      <option value="<?=$code?>" <?=($clientCountryCode === $code ? "selected" : null)?>><?=$country?></option>
                                  <? endforeach; ?>
                    </select>    
                  </div>
                </div>
              </div>
          </div>
        </div>

        <div class="col-sm-6">
            <div class="personalInformation">
              <h1><i class="fa fa-credit-card fa-personalInformation"></i>Card <span class="information">Details</span></h1>
            </div>
            <div class="personalInformation-holder panel-body"> 
              <div class="row">
                <div class="col-sm-9">
                  <div class="form-group rmp">
                    <label for="cardType">Card Type*</label><p id="errmsg"></p>
                    <select name="select" class="form-control required" id="cardType">
                      <option value="">Select Credit Card Type</option>
                      <option value="visa">Visa</option>
                      <option value="mastercard">MasterCard</option>
                      <?/*<option value="discover">Discover</option>
                      <option value="amex">American Express</option>
                      <option value="jcb">JCB</option>
                      <option value="maestro">Maestro</option>*/ ?>
                    </select>    
                  </div>
                </div>
                <div class="col-sm-3 figure">
                  <div class="figure">
                    <img src="<?=$imagelink?>select.png" height="40" width="90" name="card-img"  alt="card-img" id='card-img'/>
                  </div>
                </div>
              </div>
              
              <div class="row">
                <div class="col-sm-9">
                  <div class="form-group rmp">
                    <label for="cardNumber">Card Number*</label>
                    <input type="text" name="num" class="form-control" id="cardNumber" placeholder="xxxx - xxxx - xxxx - xxxx">
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="form-group rmp">
                    <label for="cvc">CVV*</label>
                    <input type="text" name="cvv2Number" class="form-control" id="cvv" placeholder="">
                  </div>
                </div>
              </div>
                    
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group rmp">
                      <label for="cardHolderName">Card Holder's First Name*</label>
                      <input type="text" name="firstName" class="form-control" id="cardHolderLastName" placeholder="Enter First Name" >
                      <i class="fa fa-user personalInformation"></i>
                  </div>
                  <div class="form-group rmp">
                    <label for="cardHolderName">Card Holder's Last Name*</label>
                    <input type="text" class="form-control" name="lastName" id="cardHolderFirstName" placeholder="Enter Last Name" >
                    <i class="fa fa-user personalInformation"></i>
                  </div>
                </div>
              </div>
              
              <div class="row">
                <div class="col-sm-4">
                  <div class="form-group rmp">
                    <label for="expiryYear">Expiry Year*</label>
                      <select name="expdate_year" class="form-control" id="expiryYear">
                        <option value="">Select Year</option>
                        <option value="2016">2016</option>
                        <option value="2017">2017</option>
                        <option value="2018">2018</option>
                        <option value="2019">2019</option>
                        <option value="2020">2020</option>
                        <option value="2021">2021</option>
                        <option value="2022">2022</option>
                        <option value="2023">2023</option>
                        <option value="2024">2024</option>
                        <option value="2025">2025</option>
                        <option value="2026">2026</option>
                      </select> 
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group rmp">
                    <label for="expiryMonth">Expiry Month*</label>
                    <select name="expdate_month" class="form-control" id="expiryMonth">
                      <option value="">Select Month</option>
                      <option value="1">January</option>
                      <option value="2">Feburary</option>
                      <option value="3">March</option>
                      <option value="4">April</option>
                      <option value="5">May</option>
                      <option value="6">June</option>
                      <option value="7">July</option>
                      <option value="8">August</option>
                      <option value="9">September</option>
                      <option value="10">October</option>
                      <option value="11">Novemember</option>
                      <option value="12">December</option>
                    </select> 
                    <p id="yrmsg" style="color:red;"></p>
                  </div>
                </div>
              </div>
              <div class="button-group">
                <? if(  $verfiy3DSecure == true ): ?>
                  <input type="hidden" name="nonce" id="nonce" value="<?=$nonce?>">
                <? endif; ?>
                <button type="submit" id="button" class="btn btn-success free-btn">Proceed</button>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>
  <?php if(!$fromUpdatePaymentMethod) { //dont show if its update payment method page ?>
</form>
<?php } ?>
<div id="spinner" align="center" style="margin-left:555px;position: absolute;display:none;">
  <i class="fa fa-circle-o-notch fa-spin cus-spin" style="color:#FF004F;margin-top:50px;font-size:70pt;"></i><br>
  <h2 style="color:#000;font-size:17px;"> Please Wait...</h2>
</div>

<script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>
<?if(!$nonce1):?>
  <script type="text/javascript">
    <? //JQUERY validation script ?>
    $(function() { 
        var today = new Date();
        $.validator.addMethod('pastMonthInvalidate', function(value, element){
            var year = $('#expiryYear').val();
            var selectedDate = new Date();
            selectedDate.setMonth(value-1);
            selectedDate.setFullYear(year);

            return (selectedDate >= today);
        });
        $.validator.addMethod('pastYearInvalidate', function(value, element){
            return (value >= today.getFullYear());
        });
      $("#braintree-payment-form").validate({
          rules: {
              firstName   : "required",
              first       : "required",
              last        : "required",
              lastName    : "required",
              address1    : "required",
              city        : "required",
              zip         : "required",
              state       : "required",
              num : {
                  required: true,
                  minlength: 16,
                  maxlength: 16
              },
              expdate_month : {
                            required: true,
                            pastMonthInvalidate: true
                        },
                expdate_year : {
                    required: true,
                    pastYearInvalidate: true
                },
              cvv2Number: {
                  required: true,
                  minlength: 3,
                  maxlength: 3
              },
              select: "required",
              BillingCountry : "required"
          },
          
          // Validation error messages
          messages: {
              firstName: "<font color=red size=2px>First Name is required.</font>",
              first: "<font color=red size=2px>First Name is required.</font>",
              cvv2Number: "<font color=red size=2px>Invalid CVV</font>",
              lastName: "<font color=red size=2px>Last Name is required</font>",
              last: "<font color=red size=2px>Last Name is required</font>",
              num : "<font color=red size=2px>Enter a Valid Credit Card Number</font>",
              expdate_month : "<font color=red size=2px>Invalid Month.</font>",
              expdate_year : "<font color=red size=2px>Invalid Year.</font>",
              address1: "<font color=red size=2px>Address is required.</font>",
              city: "<font color=red size=2px>City is required.</font>",
              zip: "<font color=red size=2px>Enter a valid zip code</font>",
              state: "<font color=red size=2px>Enter a valid state.</font>",
              select: "<font color=red size=2px>Select a credit card type.</font>",
              BillingCountry : "<font color=red size=2px>Please select your country.</font>",
          },
          
          submitHandler: function(form) {
            $( "#errorMessage" ).hide();
            $( "#braintree-payment-form" ).hide(); 
            $( "#spinner" ).show();
            form.submit();
          }
      });

    });

    <?//Chnage credit card update image script ?>
    $('#cardType').on('change', function() {
      if ( this.value == "visa"){
      $("img[name=card-img]").attr("src", '<?=$imagelink?>' + $(this).val()+'.png');
      } else if ( this.value  == "mastercard") {
      $("img[name=card-img]").attr("src", '<?=$imagelink?>' + $(this).val()+'.png');
      } else if ( this.value  == "discover") {
      $("img[name=card-img]").attr("src", '<?=$imagelink?>' + $(this).val()+'.png');
      } else if ( this.value  == "amex") {
      $("img[name=card-img]").attr("src", '<?=$imagelink?>' + $(this).val()+'.png');
      } else if ( this.value  == "jcb") {
      $("img[name=card-img]").attr("src", '<?=$imagelink?>' + $(this).val()+'.png');
      } else if ( this.value  == "maestro") {
      $("img[name=card-img]").attr("src", '<?=$imagelink?>' + $(this).val()+'.png');
      } else { 
      $("img[name=card-img]").attr("src", '<?=$imagelink?>' + 'select'+'.png');
      }
    });
  </script>
<?endif;?>

<? if(  $verfiy3DSecure == true && $nonce1 ): ?>
  
  <script>
    $('#braintree-payment-form').hide();
    $('#spinner').show();
    var client = new braintree.api.Client({
      clientToken: "<?=$clientToken?>"
    });
    
    client.verify3DS({
       amount: <?=$bill_info["amount"]?>,
       creditCard: "<?=$nonce1?>"
    }, function (error, response) {
    if (!error) {
          var elem   = document.getElementById("nonce");
          elem.value = response.nonce;
          console.log(response.nonce);
          $('#braintree-payment-form').attr('action', '<?=$returnVerified?>');
          $('#braintree-payment-form').submit();
     } else {
       <?//3d secure failed ?>
       window.location = '<?=DEFAULT_URL."/sponsors/"?>';
     }
    });

  </script>

<? endif; ?>