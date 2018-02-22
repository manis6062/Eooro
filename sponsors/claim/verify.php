<?
include("../../conf/loadconfig.inc.php");
  require_once EDIRECTORY_ROOT.'/braintree/braintree-php/lib/Braintree.php';
  require_once EDIRECTORY_ROOT.'/braintree/_environment.php';
include(MEMBERS_EDIRECTORY_ROOT."/layout/header.php");
include(MEMBERS_EDIRECTORY_ROOT."/layout/navbar.php");

//Extracts 
$data_array  = array(

  'token'             => $_POST['token'],
  'subtotal'          => $_POST['subtotal'],
  'tax'               => $_POST['tax'],
  'company'           => $_POST['company'],
  'email'             => $_POST['email'],
  'phone'             => $_POST['phone'],
  'fax'               => $_POST['fax'],
  'webiste'           => $_POST['website'],
  'zip'               => $_POST['zip'],
  'address1'          => $_POST['address1'],
  'city'              => $_POST['city'],
  'BillingCountry'    => $_POST['BillingCountry'],
  'firstname'         => $_POST['firstname'],
  'lastname'          => $_POST['lastname'],
);

$id      = $_POST['id'];
$case_id = $_POST['case_id'];


//UnSalt Amount
$rand = $_POST['token'];
$rand = str_replace("1973275", ".", $rand);
$rand = str_replace("5339764", " ", $rand);
$rand = str_replace("3614792", " ", $rand);

$explode = explode(" ", $rand);
$amt = $explode[1];
$count1 = count($explode[0]);
$count2 = count($explode[1]);

if ( $count1 != $count2 ) { 
  unset($_POST);
    $payment_message = "Error processing transaction";
      $payment_message .= "<p class=\"successMessage\">\n";
    $payment_message .= "<font color = red>";
      $payment_message .= ("\n  Error: " . "Token verification failed.");
      $payment_message .= "</font></p>";   

}

//Extract Expiry Date
$yr = substr($_POST['expdate_year'], 2);
$month = $_POST['expdate_month'];

if ($month < 10 && $month[0] != "0") {
 $month = "0" . $month;
}

$exp =  $month. "/" . $yr ;


$return = DEFAULT_URL."/".MEMBERS_ALIAS."/"."billing"."/processpayment.php?payment_method=braintree";

$clientToken = Braintree_ClientToken::generate();

//Create Customer

$result = Braintree_Customer::create(array(
    'firstName' => $_POST['firstname'],
    'lastName' => $_POST['lastname'],
    'company' => $_POST['company'],
    // 'email' => $_POST['email'],
    // 'phone' => $_POST['phone'],
    // 'fax' => $_POST['fax'],
    // 'website' => $_POST['website'],

    'creditCard' => array(
        'cardholderName' =>  mysql_real_escape_string($_POST['firstName'] . " " . $_POST['lastName'] ),
          'number' => mysql_real_escape_string($_POST['num']),
          'expirationDate' => mysql_real_escape_string($exp),
          'cvv' => mysql_real_escape_string($_POST['cvv2Number'])
    )
  ) 

);
?>
<div id="pleasewait">
<h2 style="color:#000;text-align:center;">Please wait, your pament is being processed...</h2>
</div>
<?
if ($result->success) {
    
    $token = $result->customer->creditCards[0]->token;
    $result2 = Braintree_PaymentMethodNonce::create($token);
    $nonce = $result2->paymentMethodNonce->nonce;
    $customer_id = $result->customer->id;
} else {
  echo "<center><font color=black><h2>Sorry following errors were encountered :</h2>";
  echo $result->message. "</center></font>";
  echo "<center><a href=\"javascript:history.go(-1)\">GO BACK</a></center>";
  echo '<script>$(document).ready(function(){
        $( "#pleasewait" ).hide();
        });
        </script>';
}

?>

<script src="https://js.braintreegateway.com/v2/braintree.js"></script>

<script>
var client = new braintree.api.Client({
  clientToken: "<?=$clientToken?>"
});
</script>

<script>
client.verify3DS({
 amount: <?=$amt?>,
 creditCard: "<?=$nonce?>"
}, function (error, response) {
 if (!error) {
   var elem = document.getElementById("nonce");
   elem.value = response.nonce;
   document.getElementById("target").submit();

 } else {
   var p = document.createElement("p");
   p.innerHTML = error.message;
   document.body.appendChild(p);
 }
});
</script>
<section class="latest-review cusreview">
         <div class="container">  
           <div class="thumbnail listingthumbnail lisingthumbnail1">

<form id="target" method="post" action ="<?=$return?>" >
  <input type="hidden" id = "nonce" name="nonce" value=""> 
<?php 

  foreach($data_array as $key => $value)
{
   echo '<input type="hidden" name="'.$key.'" value="'. $value. '">';
}

?>

       <? //Listing

        if (strpos($_POST['id'], "_z")){ ?>

              <input type="hidden" name="id" value="<?=$_POST['id']?>"> 

        <? }  else {     

                    foreach($_POST['id'] as $value)
                  {
                    echo '<input type="hidden" name="id[]" value="'. $value. '">';
                  } 

          }?>

                  <? //Cases
                    foreach($_POST['case_id'] as $value)
                    {
                      echo '<input type="hidden" name="case_id[]" value="'. $value. '">';
                    }
      ?>
  
  <input style="display:none;" type="submit" value="submit">
</form>


  
                 </div>
                </div>
               </div> 
            </div>
          </div> 
        </section>    

<?

  include(MEMBERS_EDIRECTORY_ROOT."/layout/footer.php");
?>