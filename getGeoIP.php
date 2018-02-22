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
	# * FILE: /getGeoIP.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("./conf/loadconfig.inc.php");
        
        require_once EDIRECTORY_ROOT.'/vendor/autoload.php';
        require_once CLASSES_DIR.DIRECTORY_SEPARATOR.'apis/geolocator/geolocator.php';
        require_once CLASSES_DIR.DIRECTORY_SEPARATOR.'apis/geolocator/maxmindgeolitelocator.php';
        require_once CLASSES_DIR.DIRECTORY_SEPARATOR.'apis/geolocator/maxmindgeolitebinarylocator.php';
        require_once CLASSES_DIR.DIRECTORY_SEPARATOR.'apis/geolocator/freegeoiplocator.php';
        require_once CLASSES_DIR.DIRECTORY_SEPARATOR.'apis/geolocator/geolocatorgod.php';
    
    header("Content-Type: text/html; charset=".EDIR_CHARSET, TRUE);

	# ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------

	$debug_geoIP = false;
        
    if ($_COOKIE["location_geoip"]) {
        $location_GeoIP['name'] = $_COOKIE["location_geoip"];
    } 
    else {
        try{
            $geoLocator         = GeoLocatorGod::getGeoLocator();
            $ipDetails          = $geoLocator->getDetails();
            $location_GeoIP = getCountry( $ipDetails->country_name );//geo_GeoIP($debug_geoIP);

            if ( EDIR_LANGUAGE == "pt_br" && string_strpos($location_GeoIP, "Brazil") !== false ) {
                $location_GeoIP = str_replace("Brazil", "Brasil", $location_GeoIP);
            }
            setcookie("location_geoip", $location_GeoIP['name'], 0, "/");
            setcookie("location_geoip_id", $location_GeoIP['id'], 0, "/");
    
        }
        catch( InvalidArgumentException $ex ){
            // handle it
            $error = $ex->getMessage();
        }
        catch( Exception $ex ){
            $error = $ex->getMessage();
        }
    }
    
	echo $location_GeoIP['name'];
        
    function getCountry( $name )
    {
        $sql = "SELECT name, id FROM Location_1 where name = '$name'";
        $dbMain     = db_getDBObject(DEFAULT_DB, true);
        
        $resource   = $dbMain->query( $sql );
        
        if( mysql_num_rows($resource) > 0 ){
            $row = mysql_fetch_assoc( $resource );
            return $row;
        }
        else {
            return array( 'name' => DEFAULT_COUNTRY_LOCATION, 'id' => DEFAULT_COUNTRY_LOCATION_ID );            
        }
    }