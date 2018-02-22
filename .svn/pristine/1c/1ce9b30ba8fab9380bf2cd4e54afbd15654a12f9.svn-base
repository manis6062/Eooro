<?php

# ----------------------------------------------------------------------------------------------------
# LOAD CONFIG
# ----------------------------------------------------------------------------------------------------
include("./conf/loadconfig.inc.php");
include CORE_DIR.'/modfactory.php';

# ----------------------------------------------------------------------------------------------------
# CODE
# ----------------------------------------------------------------------------------------------------
header("Expires: Sat, 01 Jan 2000 00:00:00 GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", FALSE);
header("Pragma: no-cache");
header("Content-Type: text/html; charset=".EDIR_CHARSET, TRUE);

$validator = ModFactory::getValidator();
$request = $validator->escape( $_GET );
if( $request['q'] ){
    $sql = "SELECT title FROM ListingCategory WHERE title like '%".htmlspecialchars_decode($request['q'])."%' AND enabled='y' AND count_sub=0";
    $result = db_getFromDBBySQL( 'listingcategory', $sql, 'array' );
    
    foreach( $result as $titles ){
        $titleArray[] = $titles['title'];
    }
    
    echo implode( "\n", $titleArray );
}

if( $request['add'] ){
    $sql    = "SELECT title, id FROM ListingCategory WHERE title = '".htmlspecialchars_decode($request['add'])."' AND enabled='y' AND count_sub=0";
    $result = db_getFromDBBySQL( 'listingcategory', $sql, 'array' );
    
    if( $result ){
        echo json_encode($result[0]);
    }
    else {
        echo 0;
    }
}
