<?php
/**
 * @author          Subigya Jyoti Panta
 * @subpackage      Country Manager
 * @copyright (c) 2014, www.eooro.com
 * @version         1.0
 * @modification history original
 */
if( GEO_LOCATOR_TYPE === 'maxmind_lite_db' ){
    require_once EDIRECTORY_ROOT.'/vendor/autoload.php';
}
require_once CLASSES_DIR.DIRECTORY_SEPARATOR.'apis/geolocator/geolocator.php';
require_once CLASSES_DIR.DIRECTORY_SEPARATOR.'apis/geolocator/maxmindgeolitelocator.php';
require_once CLASSES_DIR.DIRECTORY_SEPARATOR.'apis/geolocator/maxmindgeolitebinarylocator.php';
require_once CLASSES_DIR.DIRECTORY_SEPARATOR.'apis/geolocator/freegeoiplocator.php';
require_once CLASSES_DIR.DIRECTORY_SEPARATOR.'apis/geolocator/geolocatorgod.php';

class CountryLoader
{
    protected static $countryList;
    
    protected static $country;
    
    protected static $stateList;
    
    protected static $state;
    
    public static function getCountryList()
    {
        if( !isset(static::$countryList) ){
            $sql = "SELECT id, name, abbreviation FROM Location_1";
            $main = db_getDBObject( DEFAULT_DB, true );
            $resource = $main->query( $sql );

            while( $row = mysql_fetch_assoc($resource) ){
                static::$countryList[] = $row;
            }
        }
        return static::$countryList;
    }
    
    public static function getCountryId()
    {
        if( !isset(static::$country['id']) ){
            // if present in cookie .. send from cookie
            if ( CookieGod::getCountryId() ) {
                static::$country['id']= CookieGod::getCountryId();
            }
            else {
                $locDetails = GeoLocatorGod::getGeoLocator()->getDetails();
                static::setCountry($locDetails->country_name);
            }
        }  
        return static::$country['id'];
    }

    public static function getCountryName()
    {
        if( !isset(static::$country['name']) ){
            // if present in cookie .. send from cookie
            if ( CookieGod::getCountry() ) {
                static::$country['name'] = CookieGod::getCountry();
            }
            else if( !isset(static::$country) ){
                $locDetails = GeoLocatorGod::getGeoLocator()->getDetails();
                self::setCountry($locDetails->country_name);
            }
        }
        return static::$country['name'];
    }

    protected static function setCountry( $name )
    {
        $sql = "SELECT name, id FROM Location_1 where name = '$name'";
        $dbMain     = db_getDBObject(DEFAULT_DB, true);
        
        $resource   = $dbMain->query( $sql );
        
        if( mysql_num_rows($resource) > 0 ){
            static::$country = mysql_fetch_assoc( $resource );
        }
        else {
            static::$country = array( 'name' => DEFAULT_COUNTRY_LOCATION, 'id' => DEFAULT_COUNTRY_LOCATION_ID );            
        }
    }
    
    public static function getStateList( $loc1 )
    {
        if ( !isset(static::$stateList[$loc1]) ) {
            $sql = "SELECT id, name FROM Location_3 WHERE location_1=$loc1";
            static::$stateList[$loc1]  = db_getFromDBBySQL( 'location3', $sql, 'array' );
        }
        return static::$stateList[$loc1];
    }
    
    public static function getStateId( $countryId )
    {
        if( !isset(static::$state['id']) ){
            if ( CookieGod::getStateId() ) {
                static::$state['id'] = CookieGod::getStateId();
            }
            else {
                $locDetails = GeoLocatorGod::getGeoLocator()->getDetails();
                self::setState( $locDetails->region_code, $countryId );
            }
        }
        return static::$state['id'];
    }
    
    public static function getStateName( $countryId )
    {
        if ( !isset(static::$state['name']) ) {
            if ( CookieGod::getState() ) {
                static::$state['name'] = CookieGod::getState();
            }
            else {
                $locDetails = GeoLocatorGod::getGeoLocator()->getDetails();
                self::setState($locDetails->region_code, $countryId );
            }
        }
        return static::$state['name'];
    }
    
    protected static function setState( $stateCode, $countryId )
    {
        // sometimes code may not be present
        if( $stateCode && $countryId ){
            $sql = "SELECT name, id FROM Location_3 where abbreviation='$stateCode' AND location_1=$countryId";
            static::$state = db_getFromDBBySQL( 'location3', $sql, 'array' )[0];
            if( static::$state ){
                setcookie("location_state", static::$state['name'], 0, "".EDIRECTORY_FOLDER."/");
                setcookie("location_state_id", static::$state['id'], 0, "".EDIRECTORY_FOLDER."/");
            }
        }
    }

    #-----------------------------------------------------------------------------------------------------------
    #                               Methods for Multi Currency based on Geo IP
    #-----------------------------------------------------------------------------------------------------------
    
    public static function getCurrencyAndSymbolBasedOnGEOIP($item, $location_1)
    {

        $dbMain = db_getDBObject(DEFAULT_DB, true);
        $dbObj  = db_getDBObject();

        //Extract IP of user and based on that extract currency and assign $ if not set in our table
        $geoLocator = GeoLocatorGod::getGeoLocator();
        $ipDetails  = $geoLocator->getDetails();

        //Extract symbol and currency format based on user's ip address
        $sql        = "SELECT symbol, currency FROM Location_1 WHERE name = '$ipDetails->country_name'";
        $currency   = mysql_fetch_assoc($dbMain->query($sql));
        $currency ? null : ($currency['symbol'] = '$' AND $currency['currency'] = "USD");
        
        //Extract listing price based on listing's location 1
        $sql        = "SELECT $item FROM Location_1 WHERE id = '$location_1'";
        $result     = mysql_fetch_assoc($dbMain->query($sql));
        $currency[$item] = $result[$item];

        //This function returns price in (dollars as set in our database).
        return $currency;
    }

    public static function getForexRate($location_1 = null, $new_format)
    {
        $dbMain = db_getDBObject(DEFAULT_DB, true);
        if($location_1){
            //Extract location1, currency
            $sql    = "SELECT currency FROM Location_1 WHERE id = $location_1";
            $result =  mysql_fetch_assoc($dbMain->query($sql));        
            $result = $result['currency'];

            //Get exchange rate from listing's location1 currency to user's geoip based currency
            $sql    = "SELECT forex as rate FROM Currency_Converter WHERE from_currency = '$result' AND to_currency = '$new_format'";
            $result =  mysql_fetch_assoc($dbMain->query($sql));
            
            return $result['rate'];

        } else {
            $sql    = "SELECT forex as rate FROM Currency_Converter WHERE from_currency = 'USD' AND to_currency = '$new_format'";
            $result =  mysql_fetch_assoc($dbMain->query($sql));
            return $result['rate'];            
        }
    }


    public static function getPriceListing($listing_id, $location_1)
    {

//        $return  = self::getCurrencyAndSymbolBasedOnGEOIP('price_listing', $location_1);

        //Differentiate Duration Based Listing Price From Subscription Based Listing Price
//            if (CheckDurationBasedListing($listing_id) == true):
//
//                //Global Brands Modification
//                $listingObj = new Listing($listing_id);
//                if($listingObj->status == "P"){
//                    $listingObj = new ListingPending($listing_id);
//                }
//
//                //Set $duration value as monthly or yearly based on listing's custom_checkbox3
//                if($listingObj->custom_checkbox3 == "y"):
//                    $duration = "monthly";
//                else:
//                    $duration = "yearly";
//                endif;
//
//                //Extract price, for global and non global brands
//                if($listingObj->custom_checkbox1 != "y"):
//                    $return['price_listing']  = Location1::getPrice($listingObj->location_1,  $duration);
//                else: 
//                    $return['price_listing']  = ListingLevel::getPriceDuration($duration);
//                endif;
//
//                $account = new Account(sess_getAccountIdFromSession());
//                $forex   = self::getForexRate($location_1, $account->prefered_currency);
//
//                //Check to see if listing has discount_code
//                //$listingObj  = new Listing($listing_id);
//                $discount_id = $listingObj->discount_id;
//                
//                if($discount_id){
//                    $discountCodeObj = new DiscountCode($discount_id);
//                    if ($discountCodeObj->getString("id") && $discountCodeObj->expire_date >= date('Y-m-d')) {
//                        if ($discountCodeObj->getString("type") == "percentage") {
//                            $return['price_listing'] = $return['price_listing'] * (1 - $discountCodeObj->getString("amount")/100);
//                        } elseif ($discountCodeObj->getString("type") == "monetary value") {
//                            $return['price_listing'] = $return['price_listing'] - $discountCodeObj->getString("amount");
//                        }
//                    } 
//                }
//
//                //After discount code, multiply with forex rate and send back value
//                $return['price_listing'] = $forex * $return['price_listing'];

//            else:
                $listingObj = new Listing($listing_id);
                if($listingObj->status == "P"){
                    $listingObj = new ListingPending($listing_id);
                }
                $return = $listingObj->getCurrencyAndSymbol();
                
                $dbMain = db_getDBObject(DEFAULT_DB, true);
                //Tally This Plan ID with Price_list table and get the price
                $plan   = getPlanId($listing_id);
                $sql    = "SELECT plan_price From Price_list WHERE plan_id = '$plan'";
                $result = $dbMain->query($sql);
                $row    = mysql_fetch_assoc($result);

                $return['price_listing'] = sprintf('%0.2f', $row['plan_price']);

//            endif;

        return $return;
    }

    public static function getPriceListingForWebhook($listing_id, $location_1)
    {

        $return  = self::getCurrencyAndSymbolBasedOnGEOIP('price_listing', $location_1);

        //Differentiate Duration Based Listing Price From Subscription Based Listing Price
            if (CheckDurationBasedListing($listing_id) == true):

                //Global Brands Modification
                $listingObj = new Listing($listing_id);
                if($listingObj->status == "P"){
                    $listingObj = new ListingPending($listing_id);
                }

                //Set $duration value as monthly or yearly based on listing's custom_checkbox3
                if($listingObj->custom_checkbox3 == "y"):
                    $duration = "monthly";
                else:
                    $duration = "yearly";
                endif;

                //Extract price, for global and non global brands
                if($listingObj->custom_checkbox1 != "y"):
                    $return['price_listing']  = Location1::getPrice($listingObj->location_1,  $duration);
                else: 
                    $return['price_listing']  = ListingLevel::getPriceDuration($duration);
                endif;

                $account = new Account(sess_getAccountIdFromSession());
                $forex   = self::getForexRate($location_1, $account->prefered_currency);

                //Check to see if listing has discount_code
                $listingObj  = new Listing($listing_id);
                $discount_id = $listingObj->discount_id;
                
                if($discount_id){
                    $discountCodeObj = new DiscountCode($discount_id);
                    if ($discountCodeObj->getString("id") && $discountCodeObj->expire_date >= date('Y-m-d')) {
                        if ($discountCodeObj->getString("type") == "percentage") {
                            $return['price_listing'] = $return['price_listing'] * (1 - $discountCodeObj->getString("amount")/100);
                        } elseif ($discountCodeObj->getString("type") == "monetary value") {
                            $return['price_listing'] = $return['price_listing'] - $discountCodeObj->getString("amount");
                        }
                    } 
                }

                //After discount code, multiply with forex rate and send back value
                $return['price_listing'] = $forex * $return['price_listing'];

            else:

                $dbMain = db_getDBObject(DEFAULT_DB, true);
                //Tally This Plan ID with Price_list table and get the price
                $plan   = getPlanIdWebhook($listing_id);
                $sql    = "SELECT plan_price From Price_list WHERE plan_id = '$plan'";
                $result = $dbMain->query($sql);
                $row    = mysql_fetch_assoc($result);

                $return['price_listing'] = sprintf('%0.2f', $row['plan_price']);

            endif;

        return $return;
    }

    public static function getPriceCases($case_id, $location_1)
    {
        include_once EDIRECTORY_ROOT.'/classes/class_Opened_Cases.php';

        //Global Brands Price
        $listing    = Opened_Cases::getThisCaseListing($case_id);
        $listingObj = new Listing($listing);
        
        if($listingObj->status == "P"){
            $listingObj = new ListingPending($listing_id);
        }
        
        $return = self::getCurrencyAndSymbolBasedOnGEOIP('price_case', $location_1);
        
        //If global brand, get case price from Main table
        if($listingObj->custom_checkbox1 == "y"){
            $caseObj = new Opened_Cases($case_id);
            $return['price_case'] = $caseObj->getPrice();
            $location_1 = null;
        }

        $account = new Account(sess_getAccountIdFromSession());
        $forex   = self::getForexRate($location_1, $account->prefered_currency);
        
        //Check to see if case has discount_code
        $caseObj     = new Opened_Cases($case_id);
        $discount_id = $caseObj->discount_id;
   
        if($discount_id){
            $discountCodeObj = new DiscountCode($discount_id);

            if ($discountCodeObj->getString("id") && $discountCodeObj->expire_date >= date('Y-m-d')) {
                if ($discountCodeObj->getString("type") == "percentage") {
                    $return['price_case'] = $return['price_case'] * (1 - $discountCodeObj->getString("amount")/100);
                } elseif ($discountCodeObj->getString("type") == "monetary value") {
                    $return['price_case'] = $return['price_case'] - $discountCodeObj->getString("amount");
                }
            } 
        }

        $return['price_case'] = $forex * $return['price_case'];

        return $return;

    }

    public static function getListingPriceBasedOnIP(){
        $dbMain       = db_getDBObject(DEFAULT_DB, true);
        $dbObj        = db_getDBObject();
        $geoLocator   = GeoLocatorGod::getGeoLocator();
        $ipDetails    = $geoLocator->getDetails();
        $country_name = $ipDetails->country_name;      

        //Check to see if country is in our database
        $sql    = "SELECT * FROM Location_1 WHERE name='$country_name'";
        $result =  mysql_num_rows($dbMain->query($sql));

        if ($result)
        {
        //If yes extract price and symbol
           $sql        = "SELECT price_listing_monthly, price_listing, symbol From Location_1 where name = '$country_name'";
           $result     =  mysql_fetch_assoc($dbMain->query($sql));
           return $result;
        } else {
        //If not, select price where currency is USD
            $sql        = "SELECT price_listing_monthly, price_listing,symbol From Location_1 where currency = 'USD'";
            $result     =  mysql_fetch_assoc($dbMain->query($sql));
            return $result;
        }
    }

}