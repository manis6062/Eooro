<script src="scripts/jquery.min.js" />
<?

	/**
	 * Add Latitude and Longitude based on Listing's address
	 */

	include("../conf/loadconfig.inc.php");

		function retrieveLocationNameById($id, $location){
			if ($id){
				$dbObj = db_getDBObject(DEFAULT_DB,true);
				$sql = "SELECT name FROM {$location} WHERE id = $id";
				$result = $dbObj->query($sql);
				$row = mysql_fetch_assoc($result);
				if($row) return $row['name']; else return "";

			} else {
				return "";
			}
		}

	$googleMap = new GoogleMap();
	echo $googleMap->getMapCodev3();


$dbMain = db_getDBObject(DEFAULT_DB, true);
$dbDomain = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);

    $sql = "SELECT id, address, location_1,location_3, location_4, zip_code FROM Listing WHERE latitude = '' AND longitude = '' order by id asc LIMIT 50";
    $resource = $dbDomain->query($sql);
    
    while ($row = mysql_fetch_assoc($resource)) {
    	$listing[] = $row;
    }

	/**
	 * Pull In different locations from our database and AJAX it to google and get lattitude from it 
	 */

    foreach ($listing as $list) {

    	$location1 = retrieveLocationNameById($list['location_1'], "Location_1");
    	$location3 = retrieveLocationNameById($list['location_3'], "Location_3");
    	$location4 = retrieveLocationNameById($list['location_4'], "Location_4");
    	$zip 	   = $list['zip_code'];
    	$loc = $location3 . " " . $location4 . " " . $zip . " " . $location1;
    	$loc = trim($loc);
    	$id = $list['id'];
    	store($loc,$id);
    }

    function store($location, $listing_id){

    	$GetFromGoogle = '
						<script>
							var address = "'.$location.'";
							$.ajax({
								
								  url:"http://maps.googleapis.com/maps/api/geocode/json?address="+address+"&sensor=true",
								  type: "POST",
								  success:function(res){

								  		var latitude  = res.results[0].geometry.location.lat;
								  		var longitude = res.results[0].geometry.location.lng;
								     	StoreInDB( latitude , longitude ,'.$listing_id.');
							  }
							});
						</script>

						<script>
						function StoreInDB( lat , lon , id ){
																		 
									$.ajax({
									  method: "POST",
									  url: "store.php",
									  data: { lat: lat, lon: lon , id: id }
									})
									.done(function( msg ) {
									  	$("#here").html(msg);
									});
							
						}
						</script>';

    	echo $GetFromGoogle;
    }

?>
