<?php 
include_once '../conf/loadconfig.inc.php';
$location1=$_GET['location1'];
$location3=$_GET['location3'];
$location_4=Location4::retrieveAllLocationByLocation1($location1,$location3);
foreach ($location_4 as $loc1) {
    $array["label"] = $loc1['name'];
    $array["value"] = $loc1['name'];
    $array["id"] = $loc1['id'];
    $final[] = $array;
}
echo json_encode($final);
?>