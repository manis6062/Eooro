<?	

	/**
	 * Update Database 
	 */
	
	include("../conf/loadconfig.inc.php");

		$dbMain = db_getDBObject(DEFAULT_DB, true);
		$dbDomain = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);

			$id  = $_POST['id'];
			$latitude = $_POST['lat'];
			$longitude = $_POST['lon'];

		$sql = "UPDATE Listing SET latitude = '$latitude', longitude = '$longitude' WHERE id = $id";	
		$resource = $dbDomain->query( $sql );
	
?>