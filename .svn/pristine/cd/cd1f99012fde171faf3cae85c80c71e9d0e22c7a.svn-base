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

$app = ModFactory::getApplication();

extract( $_POST );
extract( $_GET );

$validator  = new Validator();
$module     = $validator->check( $module, 'alphaNumeric' );
$controller = $validator->check( $con, 'alphaNumeric' );
$action     = $validator->check( $action, 'alphaNumeric' );
// escaping details
$details    = $validator->escape( $details );

$app->setOptions( $module, $controller, $action, $details )->run();

?>