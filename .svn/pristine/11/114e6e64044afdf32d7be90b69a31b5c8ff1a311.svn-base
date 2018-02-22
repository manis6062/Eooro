<?php

include_once '../conf/loadconfig.inc.php';
$location1 = $_GET['location1'];
$location_3 = Location3::retrieveAllLocationByLocation1($location1);
foreach ($location_3 as $loc1) {
    $array["label"] = $loc1['name'];
    $array["value"] = $loc1['name'];
    $array["id"] = $loc1['id'];
    $final[] = $array;
}
echo json_encode($final);
?>