<?php


class CustomSearch {

	protected static $country;
	protected static $state;

	function __construct(){
		self::$country = CountryLoader::getCountryId();
		self::$state   = self::$country ? (CountryLoader::getStateId(self::$country) ? " AND location_3=". CountryLoader::getStateId(self::$country) : null) : '';
	}
	

	#-------------------------------------------
	# Sponsors Add Listing Results Query
	#-------------------------------------------

	public static function getBackEndResults($queryString, $screen = 0){
		
		$dbMain 	= db_getDBObject(DEFAULT_DB, true);
		$dbObj  	= db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
		$start_from   = ($screen * 10) - 10;
		$screen == null ? $start_from = 0 : null;

		$sql = "
				SELECT 
				    *
				FROM
				    (SELECT 
				        Listing_Summary.*,
				            MATCH (`Listing_Summary`.`fulltextsearch_what`) AGAINST ('".$queryString."' IN BOOLEAN MODE) relivence
				    FROM
				        Listing_Summary
				    WHERE
				        Listing_Summary.status = 'A'
				            AND location_1 = ". self::$country . self::$state . " /* base */
				            AND MATCH (Listing_Summary.fulltextsearch_what) AGAINST ('".$queryString."' IN BOOLEAN MODE)
				            AND account_id = 0
				            AND MATCH (`Listing_Summary`.`fulltextsearch_what`) AGAINST ('".$queryString."' IN BOOLEAN MODE) > 0 
				            
				            
				            UNION 
				            
				            SELECT 
				        Listing_Summary.*,
				            MATCH (`Listing_Summary`.`fulltextsearch_what`) AGAINST ('".$queryString."' IN BOOLEAN MODE) relivence
				    FROM
				        Listing_Summary
				    WHERE
				        custom_checkbox2 = 'y'  /* country */
				            AND location_1 = ". self::$country . self::$state . " /* base */
				            AND account_id = 0
				            AND MATCH (Listing_Summary.fulltextsearch_what) AGAINST ('".$queryString."' IN BOOLEAN MODE)
				            AND status = 'A'
				            AND MATCH (`Listing_Summary`.`fulltextsearch_what`) AGAINST ('".$queryString."' IN BOOLEAN MODE) > 0 
				            
				            
				            UNION 
				            
				            SELECT 
				        Listing_Summary.*,
				            MATCH (`Listing_Summary`.`fulltextsearch_what`) AGAINST ('".$queryString."' IN BOOLEAN MODE) relivence
				    FROM
				        Listing_Summary
				    WHERE
				        custom_checkbox1 = 'y' /* global */
				            AND account_id = 0
				            AND status = 'A'
				            AND MATCH (Listing_Summary.fulltextsearch_what) AGAINST ('".$queryString."' IN BOOLEAN MODE)
				            AND MATCH (`Listing_Summary`.`fulltextsearch_what`) AGAINST ('".$queryString."' IN BOOLEAN MODE) > 0) X
				ORDER BY X.relivence
				limit ". $start_from  ." , 10";


		$result = $dbObj->query($sql);
		while($row = mysql_fetch_assoc($result)){
			$return[] = $row;
		}

		return $return;
	
	}

	#-------------------------------------------
	# Sponsors Add Listing Results Count Query
	#-------------------------------------------

	public static function getBackEndResultsCount($queryString){

 		$dbMain  = db_getDBObject(DEFAULT_DB, true);
		$dbObj   = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);

		$sql = "
				SELECT 
				    count(*) as total
				FROM
				    (SELECT 
				        Listing_Summary.*,
				            MATCH (`Listing_Summary`.`fulltextsearch_what`) AGAINST ('".$queryString."' IN BOOLEAN MODE) relivence
				    FROM
				        Listing_Summary
				    WHERE
				        Listing_Summary.status = 'A'
				            AND location_1 = ". self::$country . self::$state . " /* base */
				            AND MATCH (Listing_Summary.fulltextsearch_what) AGAINST ('".$queryString."' IN BOOLEAN MODE)
				            AND account_id = 0
				            AND MATCH (`Listing_Summary`.`fulltextsearch_what`) AGAINST ('".$queryString."' IN BOOLEAN MODE) > 0 
				            
				            
				            UNION 
				            
				            SELECT 
				        Listing_Summary.*,
				            MATCH (`Listing_Summary`.`fulltextsearch_what`) AGAINST ('".$queryString."' IN BOOLEAN MODE) relivence
				    FROM
				        Listing_Summary
				    WHERE
				        custom_checkbox2 = 'y'  /* country */
				            AND location_1 = ". self::$country . self::$state . " /* base */
				            AND account_id = 0
				            AND MATCH (Listing_Summary.fulltextsearch_what) AGAINST ('".$queryString."' IN BOOLEAN MODE)
				            AND status = 'A'
				            AND MATCH (`Listing_Summary`.`fulltextsearch_what`) AGAINST ('".$queryString."' IN BOOLEAN MODE) > 0 
				            
				            
				            UNION 
				            
				            SELECT 
				        Listing_Summary.*,
				            MATCH (`Listing_Summary`.`fulltextsearch_what`) AGAINST ('".$queryString."' IN BOOLEAN MODE) relivence
				    FROM
				        Listing_Summary
				    WHERE
				        custom_checkbox1 = 'y' /* global */
				            AND account_id = 0
				            AND status = 'A'
				            AND MATCH (Listing_Summary.fulltextsearch_what) AGAINST ('".$queryString."' IN BOOLEAN MODE)
				            AND MATCH (`Listing_Summary`.`fulltextsearch_what`) AGAINST ('".$queryString."' IN BOOLEAN MODE) > 0) X
				ORDER BY X.relivence";

		$result = $dbObj->query($sql);
		$row    = mysql_fetch_assoc($result);
		
		return $row['total'];
	
	}


}