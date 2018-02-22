<?php

$main = DBConnection::getInstance()->getDomain();
DBQuery::execute(function() use ($main,$noOfMostViewed) {
    $where = array();
    $mostViewed = array();
   
    $select = "SELECT title, image_id, description, friendly_url, avg_review, number_views 
				FROM Listing_Summary 
				WHERE ";
    $country = CountryLoader::getCountryId();
    if($country){
        $where[] = 'location_1=:location_1';
        $parameters[':location_1'] = $country;
        if(CountryLoader::getStateId($country)){
            $where[] = 'location_3=:location_3' ;
            $parameters[':location_3'] = CountryLoader::getStateId($country);
        }
    }   
    
    $where[] = "status=:status";

    $limit = ' LIMIT ' . $noOfMostViewed;
    $order = ' ORDER BY number_views DESC ';

    $sql = $select . implode(' AND ', array_filter($where)) . $order . $limit;
    $sql = $main->prepare($sql);
    
    $parameters[':status']='A';
   
    $sql->execute($parameters);

   
    $rows = $sql->rowCount();
    if ($rows > 0) {
        while ($row = $sql->fetch(\PDO::FETCH_ASSOC)) {
            $mostViewed[] = $row;
        }
    } else {
        $mostViewed = null;
    }
});


