<?php

//Extract our braintree credentials    
   include("../conf/loadconfig.inc.php"); 
   $dbMain = db_getDBObject(DEFAULT_DB, true);
   $dbDomain = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
   $db = $dbDomain->db_name;

   $sql = "SELECT * FROM $db.Setting_Payment WHERE name LIKE 'BRAINTREE%'";
   $resource = $dbDomain->query( $sql );


  while($row = mysql_fetch_assoc($resource) ){
       $array [] = $row;
  }
  $count = count($array);
  for($i=0; $i<$count; $i++){
   $arr[$array[$i] ['name']] = $array[$i] ['value']; //Braintree Stats and Value
  }

  if ($arr['BRAINTREE_ENVIRONMENT'] == "Sandbox") {

   Braintree_Configuration::environment('sandbox');
    Braintree_Configuration::merchantId('7vvgnf5ptb942wv4');
    Braintree_Configuration::publicKey('dqgrkr83wr2hc4zp');
    Braintree_Configuration::privateKey('a6bf5e1bbb5905c9a7ca90135bd6c620');


  } else {

  Braintree_Configuration::environment('production');
    Braintree_Configuration::merchantId($arr['BRAINTREE_MERCHANTID']);
    Braintree_Configuration::publicKey($arr['BRAINTREE_PUBLICKEY']);
    Braintree_Configuration::privateKey($arr['BRAINTREE_PRIVATEKEY']);
  }

   

//ORIGINAL SANDBOX CONFIGURATION
   // require_once('braintree-php/lib/Braintree.php');
   //  Braintree_Configuration::environment('sandbox');
   //  Braintree_Configuration::merchantId('7vvgnf5ptb942wv4');
   //  Braintree_Configuration::publicKey('sb2jc8tqtmbjx3jc');
   //  Braintree_Configuration::privateKey('67ddc84cf8e1ab642c023224cf30d40e');


?>