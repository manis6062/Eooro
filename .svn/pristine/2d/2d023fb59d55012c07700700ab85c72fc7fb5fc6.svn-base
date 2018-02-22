<?php
include_once 'conf/loadconfig.inc.php';
include_once CLASSES_DIR.'/class_LocationTreeWalker.php';
include_once 'extras/core/library/validator.php';

// todo ... post data is to be sanitized.
$validator      = new Validator();
$locationLevel  = $validator->escape($_POST['location']);
$locationId     = $validator->escape($_POST['id']);
$locationTree   = LocationTreeWalker::getLocationTreeWalker();

$sql = $locationTree->getChildLocationSQL( $locationLevel, $locationId );
function getLocation( $sql ){
    if( $sql ){
        $main   = db_getDBObject(DEFAULT_DB,true);
         
        $resource = $main->query( $sql );

        $string = '<li class="child">'
                    . '<ul>';
        $result = mysql_num_rows( $resource );
//        $switch = ( $result > 0 ) ? '[+]' : '';
        while( $row = mysql_fetch_assoc( $resource ) ){
            $switch = $row['has_children'] ? 'switch-down' : '';
            $string .= '<li class="all_location_middle">'
                        . '<span id="'.$row['id'].'-'.$row['role'].'-sib" role="'.$row['role'].'" class="switch-2">'
                            . '<a href="#'.$row['id'].'-'.$row['role'].'-sib">'.$row['name'].'</a>'
                        . '</span><span id="'.$row['id'].'-'.$row['role'].'" role="'.$row['role'].'" class="switch '.$switch.'"></span>'
                    . '</li>';
        }
        $string .=  '</ul>'
                . '</li>';
        return $string;
    }
    else {
        return getAlbhabeticalList();
    }
}
function getAlbhabeticalList(){
    global $locationId, $locationTree;
    $letters = range( 'A', 'Z' );
    $numbers = range( 0, 9 );
    
    $url  = $locationTree->getLocationFourFriendlyUrl($locationId);
    $list = '<br/>';
    $data =  'data-link="location/'.$url['location'].'"';
    foreach ( $letters as $letter ){
        $list .= '<span class="letter-list"'. $data .'><a>'.$letter.'</a></span>';
    }
    
    foreach ( $numbers as $letter ){
        $list .= '<span class="letter-list"'. $data .'><a>'.$letter.'</a></span>';
    }
    
    return $list;
}
echo getLocation( $sql );

