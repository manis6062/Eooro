<?php

include("../../conf/loadconfig.inc.php");
include_once EDIRECTORY_ROOT.'/classes/class_Opened_Cases.php';

$dbMain 	= db_getDBObject(DEFAULT_DB, true);
$dbDomain 	= db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
$account_id = sess_getAccountIdFromSession();

//Extract POST
$code = mysql_escape_string(trim($_POST['code']));
$type = mysql_escape_string($_POST['type']);
$id   = mysql_escape_string($_POST['id']);

//Remove Promotional Code
if($code == ""){
	emptyOrRemoveCheck($type, $id);
	removePromoCode($type, $id);
}

$discountCodeObj = new DiscountCode($code);

//Validate Discount Code
checkIfDiscountCodeExists($discountCodeObj->id);
checkExpiryDate($discountCodeObj);
checkStatus($discountCodeObj);

if($type == "listing")
{
	    $listingObj = new Listing($id);
		
        //Validation
		checkDiscountCodeOn($discountCodeObj, "listing");
		checkRecurringPromoCode($listingObj->id, $discountCodeObj);
		checkDiscountCodePresent($listingObj, $discountCodeObj);
		
        //If Global brand, location is 0 so check if discount code location is "" else throw error
		if($listingObj->custom_checkbox1 == "y"){
			checkLocation1($discountCodeObj->location_1, "");
		} else {
            //Listing claim Page, converted to global brand issue fix
            if($listingObj->status == "P"){
                $listingPending = new ListingPending($listingObj->id);
                if($listingPending->custom_checkbox1 == "y"){
                	checkLocation1($discountCodeObj->location_1, "");
				} else {
					checkLocation1($discountCodeObj->location_1, $listingPending->location_1);
				}
            } else {
                checkLocation1($discountCodeObj->location_1, $listingObj->location_1);    
            }
		}
		
		//Remove promotional code
		removePromotionalCode("listing", $listingObj->id);

		//Extract price for listing
		$price 			  = CountryLoader::getPriceListing($listingObj->id, $listingObj->location_1);
		$original_price   = $price['price_listing'];
		$discounted_price = $listingObj->getDiscountedPrice($discountCodeObj->id , $original_price);
		$discounted_price = sprintf('%0.2f', $discounted_price);
		$listingObj->setString("discount_id", $discountCodeObj->id);
		$listingObj->Save();

		//ListingPending
		if($listingObj->status == "P"){
			$listingPending = new ListingPending($listingObj->id);
			$listingPending->discount_id = $discountCodeObj->id;
			$listingPending->save();
		}

		//Send Values
		$array = array(
				'original_price' => $original_price,
				'price' => $discounted_price,
				'message' => "Promotional Code Accepted."
				);
		print(json_encode($array));
		die();	
}

if($type == "case")
{
		checkDiscountCodeOn($discountCodeObj, "case");
		$caseObj    = new Opened_Cases($id);
		$listing    = Opened_Cases::getThisCaseListing($id);
		$listingObj = new Listing($listing);
		//Validation
		checkDiscountCodePresent($caseObj, $discountCodeObj);
		
		//If Global brand, location is 0 so check if discount code location is "" else throw error
		if($listingObj->custom_checkbox1 == "y"){
			checkLocation1($discountCodeObj->location_1, "");
		} else {
            //Listing claim Page, converted to global brand issue fix
            if($listingObj->status == "P"){
                $listingPending = new ListingPending($listingObj->id);
                if($listingPending->custom_checkbox1 == "y"){
                	checkLocation1($discountCodeObj->location_1, "");
				} else {
					checkLocation1($discountCodeObj->location_1, $listingPending->location_1);
				}
            } else {
                checkLocation1($discountCodeObj->location_1, $listingObj->location_1);  
            }
		}

		//Remove promotional code
		removePromotionalCode("case", $caseObj->case_id);

		//Extract Price For Cases
		$location_case 	  = $caseObj->getLocationCase($id);
		$price 			  = CountryLoader::getPriceCases($caseObj->case_id, $location_case);
		$original_price   = $price['price_case'];
		$discounted_price = $caseObj->getDiscountedPrice($discountCodeObj->id, $original_price);
		$discounted_price = sprintf('%0.2f', $discounted_price);
		$caseObj->discount_id = $discountCodeObj->id;
		$caseObj->Save();

		//Send Value
		$array = array(
				'original_price' => $original_price,
				'price' => $discounted_price,
				'message' => "Promotional Code Accepted" 
				);
		print(json_encode($array));
}

function invalidCodeRevert($type, $id)
{
	//Listing and case remove promo code		
		$type 	 = $type == "listing" ? ucfirst($type) : "Opened_Cases";
		$typeObj = new $type($id);		
		$typeObj->discount_id = " ";
		$typeObj->save();

		if($type == "Listing"){
			$price = CountryLoader::getPriceListing($typeObj->id, $typeObj->location_1);
			$price = $price['price_listing'];
		} else {
			$location_case = $typeObj->getLocationCase($id);
			$case_id 	   = str_replace("'", "", $typeObj->case_id);
			$price 		   = CountryLoader::getPriceCases($case_id, $location_case);
			$price 		   = $price['price_case'];
		}

		//ListingPending remove promocode
		if($type == "Listing" && $typeObj->status =="P"){
			$typeObj = new ListingPending($id);
			$typeObj->discount_id = " ";
			$typeObj->save();
		}

		$array = array(
			'original_price' => sprintf('%0.2f', $price),
			'price' => sprintf('%0.2f', $price),
			'message' => "Invalid promotional code."
		);

		return $array;
}

function checkIfDiscountCodeExists($discount_id)
{
	global $type;
	global $id;
	if(!$discount_id){
		$array = invalidCodeRevert($type, $id);
		print(json_encode($array));	
		die();
	}
}

//Check if discount code is on
function checkDiscountCodeOn($discountCodeObj, $item)
{
	global $type;
	global $id;
	if($discountCodeObj->$item != "on"){
		$array = invalidCodeRevert($type, $id);
		print(json_encode($array));	
		die();
	}
}

//Check if promo code has expired
function checkExpiryDate($discountCodeObj)
{
	global $type;
	global $id;
	if($discountCodeObj->expire_date < date('Y-m-d')){
		$array = invalidCodeRevert($type, $id);
		print(json_encode($array));	
		die();			
	}
}

//Check if promocode is active
function checkStatus($discountCodeObj)
{
	global $type;
	global $id;
	if($discountCodeObj->status != "A")
	{
		$array = invalidCodeRevert($type, $id);
		print(json_encode($array));	
		die();
	}
	
}

//Extract Discount Code and check if "same" Discount Code is already present. If yes, throw error.
function checkDiscountCodePresent($itemObject, $discountCodeObj)
{
	if($itemObject->discount_id == $discountCodeObj->id)
	{
		$array = array('message' => "Promotional Code already in use.");
		print(json_encode($array));	
		die();
	}

}

//Check recurring promotional code, if not recurring, throw error and die. (For Listing only.)
function checkRecurringPromoCode($id, $discountCodeObj)
{

	if($discountCodeObj->recurring == 'no')
	{
		$dbObj_main = db_getDBObject(DEFAULT_DB, true);
		$dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbObj_main);		

		$sql = "SELECT * FROM Payment_Listing_Log WHERE discount_id = '".$discountCodeObj->id."' AND listing_id = '".$id."' ORDER BY renewal_date DESC LIMIT 1";
		$result = $dbObj->query($sql);
		if (mysql_num_rows($result) >= 1) {
			$array = array('message' => "Sorry, this Promotional Code<br/> can only be used once.");
			print(json_encode($array));
			die();
		}
	}
}

//Remove promotional Code
function removePromotionalCode($type,$id){
	if ($type == "listing") {
		$listingObj = new Listing($id);
		$listingObj->setString("discount_id", ' ');
		$listingObj->Save();
	} 
	if ($type == "case") {
		$caseObj = new Opened_Cases( $id );		
		$caseObj->insertDiscountID(' ', $id);
	} 

}

//Country specific discount code check location1 of listing/case and discount code
function checkLocation1($discountCodelocation1, $itemlocation1){
	if($discountCodelocation1 == $itemlocation1){
		return true;
	} else {
		$array = array('message' => "Promotional Code not supported for this country.");
		print(json_encode($array));	
		die();
	}	
}

//Remove Promotional Code
function removePromoCode($type, $id)
{
		//Listing and case remove promo code		
		$type 	 = $type == "listing" ? ucfirst($type) : "Opened_Cases";
		$typeObj = new $type($id);		
		$typeObj->discount_id = " ";
		$typeObj->save();

		if($type == "Listing"){
			if($typeObj->status == "P"):
				$typeObj = new ListingPending($id);
				$typeObj->discount_id = " ";
				$typeObj->save();
			endif;
			$price = CountryLoader::getPriceListing($typeObj->id, $typeObj->location_1);
			$price = $price['price_listing'];
		} else {
			$location_case = $typeObj->getLocationCase($id);
			$case_id 	   = str_replace("'", "", $typeObj->case_id);
			$price 		   = CountryLoader::getPriceCases($case_id, $location_case);
			$price 		   = $price['price_case'];
		}

		$array = array(
			'original_price' => sprintf('%0.2f', $price),
			'price' => sprintf('%0.2f', $price),
			'message' => "Promotional Code Removed." 
		);
		print(json_encode($array));
		die();

}

//Check if listing/case has promo code, if no show empty promotional code message
function emptyOrRemoveCheck($type, $id){

	$type 	 = $type == "listing" ? ucfirst($type) : "Opened_Cases";
	$typeObj = new $type($id);		

	if($type == "Listing" && $typeObj->status == "P"){
		$typeObj = new ListingPending($id);
	}
	
	if(trim($typeObj->discount_id) == "" ){
		$array = array(
			'message' => "Empty Promotional Code." 
		);
		print(json_encode($array));
		die();		
	}
}

die();


?>