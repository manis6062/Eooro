<?php

 require_once('braintree-php/lib/Braintree.php');
    Braintree_Configuration::environment('sandbox');
    Braintree_Configuration::merchantId('7vvgnf5ptb942wv4');
    Braintree_Configuration::publicKey('sb2jc8tqtmbjx3jc');
    Braintree_Configuration::privateKey('67ddc84cf8e1ab642c023224cf30d40e');

if(isset($_GET["bt_challenge"])) {
    echo(Braintree_WebhookNotification::verify($_GET["bt_challenge"]));
}
?>