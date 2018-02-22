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
	# * FILE: /members/claim/billing.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	extract($_GET);
	extract($_POST);

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSession();
	$acctId = sess_getAccountIdFromSession();
	$url_redirect = "".DEFAULT_URL."/".MEMBERS_ALIAS."/claim";
	$url_base = "".DEFAULT_URL."/".MEMBERS_ALIAS."";
	$members = 1;

	# ----------------------------------------------------------------------------------------------------
	# VALIDATE FEATURE
	# ----------------------------------------------------------------------------------------------------
	if (CLAIM_FEATURE != "on") { exit; }
	if (PAYMENT_FEATURE != "on") { exit; }
	if ((CREDITCARDPAYMENT_FEATURE != "on") && (INVOICEPAYMENT_FEATURE != "on") && (MANUALPAYMENT_FEATURE) != "on") { exit; }

    // Comment out lines stop redirect process for added listings.
    $claimlistingid = $_GET['claimlistingid'];
	if (!$claimlistingid) {
		// header("Location: ".DEFAULT_URL."/".MEMBERS_ALIAS."/");
		// exit;
	}
	$listingObject = new Listing($claimlistingid);
	if (!$listingObject->getNumber("id") || ($listingObject->getNumber("id") <= 0)) {
		// header("Location: ".DEFAULT_URL."/".MEMBERS_ALIAS."/");
		// exit;
	}
	if ($listingObject->getNumber("account_id") != $acctId) {
		// header("Location: ".DEFAULT_URL."/".MEMBERS_ALIAS."/");
		// exit;
	}

	$db = db_getDBObject(DEFAULT_DB, true);
	$dbObjClaim = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $db);
	$sqlClaim = "SELECT id FROM Claim WHERE account_id = '".$acctId."' AND listing_id = '".$claimlistingid."' AND status = 'progress' AND step = 'c' ORDER BY date_time DESC LIMIT 1";
	$resultClaim = $dbObjClaim->query($sqlClaim);
	if ($rowClaim = mysql_fetch_assoc($resultClaim)) $claimID = $rowClaim["id"];
	if (!$claimID) {
		// header("Location: ".DEFAULT_URL."/".MEMBERS_ALIAS."/");
		// exit;
	}
	$claimObject = new Claim($claimID);
	if (!$claimObject->getNumber("id") || ($claimObject->getNumber("id") <= 0)) {
		// header("Location: ".DEFAULT_URL."/".MEMBERS_ALIAS."/");
		// exit;
	}

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	if ($_SERVER['REQUEST_METHOD'] == "POST") {
        //PREVENT CREATING ITEM IN CLAIM PAGE
		// $claimObject->setString("step", "d");
		// $claimObject->save();

		if ($payment_method == "invoice") {
			header("Location: ".$url_redirect."/invoice.php?claimlistingid=".$_REQUEST['claimlistingid']);
		} 
                /**
                 * SagePay Modification
                 * If use wishes to pay at once, the post data is lost once the page 
                 * redirects. 
                 * So, we save the data in session. So that it can be retrieved later.
                 * It is retrieved in "getData" method in "paymentprocess" model.
                 */
                elseif( $_POST['BillingCountry'] ){
                        $idd    = sess_getAccountIdFromSession();
                        $postt  = array();
                        foreach( $_POST as $key => $value ){
                            preg_match( '#^Billing[a-zA-Z0-5]+#', $key, $matches);
                            if ( $matches[0] ) {
                                $postt[$matches[0]] = $value;
                            }
                        }
                        $_SESSION[ 'user_'.$idd ] = system_array2nvp( $postt );
                        header("Location: ".$url_redirect."/addpayment.php?payment_method=".$payment_method."&claimlistingid=".$_REQUEST['claimlistingid']);
                }
                else {
			header("Location: ".$url_redirect."/addpayment.php?payment_method=".$payment_method."&claimlistingid=".$_REQUEST['claimlistingid']);
		}
		exit;

	}

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
	$listing_id[] = $listingObject->getNumber("id");
	$second_step = 1;
	$payment_method = "claim";

	setting_get("payment_tax_status", $payment_tax_status);
	setting_get("payment_tax_value", $payment_tax_value);
	customtext_get("payment_tax_label", $payment_tax_label);

	include(INCLUDES_DIR."/code/billing.php");
	if ($bill_info["listings"]) foreach ($bill_info["listings"] as $id => $info);

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/header.php");

    require(EDIRECTORY_ROOT."/".SITEMGR_ALIAS."/registration.php");
    require(EDIRECTORY_ROOT."/includes/code/checkregistration.php");
    require(EDIRECTORY_ROOT."/frontend/checkregbin.php"); ?>
	<div class="content content-full">
		

        <div <?=(EDIR_THEME === 'review') ? 'class="container"' : ''?>>
        <h2 class="claimthisListing"><?=system_showText(LANG_MSG_CLAIM_THIS_LISTING)?></h2>
            <?
            if (!$bill_info["listings"]){
                echo "<p class=\"informationMessage\">".system_showText(LANG_MSG_NO_ITEMS_REQUIRING_PAYMENT)."</p>";
            } else {
                ?>
                <p class="msg1" style="margin-bottom:-17px;" align="right"></p>
                <form id="form" name="claimbilling" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">
    
                    <input type="hidden" name="claimlistingid" value="<?=$claimlistingid?>" />

            <div class="container">
                <ul class="before-checkout">
                    <input style="display:none;" type="checkbox" id="check1" name="listing_id[]" checked="checked" />
                    <li class="service-list-item">
                        
                    <!-- Image     -->

                        <div class="col-sm-2 service-img">
                           <? if(get_listing_thumb_id($_GET['claimlistingid']) != 0){ 
                                
                                $thumb = get_listing_thumb_id($_GET['claimlistingid']);
                                $img   = new Image($thumb);
                                $path  = $img->IMAGE_URL ."/" . $img->prefix . "photo_" . $img->id . "." . strtolower($img->type); ?>

                                <a href="#">
                                    <img src="<?=$path?>" class="img-responsive" >
                                </a>

                            <? } ?>
                        </div>

                    <!-- End Image -->

                    <!-- Listing Title/Price -->
                    <div class="col-sm-7 col-md-6 col-lg-7">
                        <div class="product-info">
                           <h4 class="product-name" title="<?=$info['title']?>"><?=substr($info['title'], 0, 30);?>
                            <? $cnt = strlen($info['title']); 
                                
                                if ($cnt > 30){ echo "..."; }
                            ?>
                            </h4>
                            <div class="price product-single-price">
                                 <div class="addressListing">
                                 <?
                                 $di = $_GET['claimlistingid'];

                                    $dbObj = db_getDBObject(DEFAULT_DB,true);
                                    $dbDomain = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbObj);
                                    
                                    $sql = "SELECT address FROM {$dbDomain->db_name}.Listing WHERE id = $di ";
                                    $result = $dbDomain->query($sql);
                                    $row = mysql_fetch_array($result);

                                 ?>
                                <address title ="<?=$row[0]?>">
                                    
                                    <? 
                                    echo substr($row[0], 0, 30);
                                    if (strlen($row[0]) > 30){
                                                echo "...";
                                    }

                                    ?>

                                </address>
                            </div>

                            <?=CURRENCY_SYMBOL." "?><?=$info['total_fee']?></div>
                        </div>
                    </div>
                    <!-- End Listing Title/Price -->

                    <!-- Price and other information -->
                    <div class="container">
                        <div class="col-sm-3 service-info">
                                
                                <ul class="info-list-item" style="margin-left: 42px;">
                                    
                                    <li>
                                        <p>Level : <?=ucfirst($info['level'])?></p>
                                    </li>
                                    <li>
                                        <p>Promotional Code : <?=(($info["discount_id"]) ? ($info["discount_id"]) : (system_showText(LANG_NA)));?></p>
                                    </li>
                                    <li>
                                        <p>Renewal Date: <?=$info['renewal_date']?></p>
                                    </li>
                                    <li>
                                        <button id="btn" type="button" class="btn btn-default removebtn"><i class="fa fa-times"></i> Remove</button>
                                    </li>
                                    
                                </ul>
                                
                        </div>

                    <!-- End Price and other information -->

                    </li>
            </ul>
<input name = "proceed" type="text" id="proceed" value="1" style="display:none;">

    </div>
    <script>
    $( document ).ready(function() {
      $( "#button" ).click(function(event) {        
                                 
                var val = $( "#proceed" ).val();

                    if ( val == '0' ){

                    event.preventDefault();                 

                    $('.msg1').empty();
                    $('.msg1').append("Please select a listing before you proceed.");
                    
                    } else {
                        
                        $('.msg1').empty();
                    }    
            });
     });
    </script>
   
                    <br />
    
                    <? if (PAYMENT_FEATURE == "on") { ?>
                        <? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) { ?>


                                <div id="check_out_payment">
                                    <? include(INCLUDES_DIR."/forms/form_paymentmethod.php"); ?>
                                    <br />
                                    <p style="display:none;" class="standardButton claimButton">
                                        <button id="button" type="submit" name="submit" value="<?=system_showText(LANG_BUTTON_NEXT);?>"><?=system_showText(LANG_BUTTON_NEXT);?></button>
                                    </p>
                                </div>
                        <? } ?>
                    <? } ?>
    
                </form>
    
                <?
            }
            ?>
    
        </div>
    </div>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(MEMBERS_EDIRECTORY_ROOT."/layout/footer.php");
?>