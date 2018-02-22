<?php
/**
 * @author          Subigya Jyoti Panta
 * @subpackage      Modules
 * @copyright (c) 2014, www.eooro.com
 * @version         1.0
 * @modification history original
 */

include_once '../conf/loadconfig.inc.php';
include_once( CORE_LIBRARY . DIRECTORY_SEPARATOR . 'validator.php' );

// check session
sess_validateSMSession();
permission_hasSMPerm();

//setting defaults
$module     = 'sitemgrcase';
$controller = 'search';
$details    = array();
extract( $_POST );
extract( $_GET );

$fill = function( $array ) use (&$details){
    if ( $array['details'] ) {
        foreach( $array['details'] as $key => $value ){
            $details[ $key ] = $value;
        }
    }
    else{
        foreach( $array as $key => $value ){
            if ( $key !== 'details' ) {
                $details[ $key ] = $value;
            }
        }
    }
};
$fill( $_POST );
$fill( $_GET );

//validating
$validator  = new Validator();
$module     = $validator->check( $module, 'alphaNumeric' );
$controller = $validator->check( $controller, 'alphaNumeric' );
$action     = $validator->check( $action, 'letters' );
// escaping details
$details    = $validator->escape( $details );

$doc = ModFactory::getDocumentLoader();
$doc->setTemplate( 'sitemgr' );
$doc->render( $module, $controller, $action, $details );