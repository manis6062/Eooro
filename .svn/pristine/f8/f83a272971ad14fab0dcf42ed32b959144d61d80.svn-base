<?php
include("../conf/loadconfig.inc.php");
include_once '../classes/class_Listing_Category.php';


$cat_name = $_GET['category_name'];
$categories = Listing_Category::getAllCategories($cat_name);

foreach ($categories as $cat) {
    $array["label"] = $cat['dispcat'];
    $array["value"] = $cat['dispcat'];
     $array["category_name"] = $cat['name'];
     $array["subcategory_name"] = $cat['sub_name'];
    $array["category_id"] = $cat['category_id'];
    $array["subcategory_id"] = $cat['subcategory_id'];
    $final[] = $array;
}
echo json_encode($final);
