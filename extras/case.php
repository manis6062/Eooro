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
sess_validateSession();

ob_start();
$app = ModFactory::getApplication();

extract( $_POST );
extract( $_GET );

$validator  = new Validator();

$action     = $validator->check( $action, 'letters' ) ? $action : 'showCase';
$id         = $validator->check( $id, 'numbers' );

$details[ 'id' ]  = $id;
$details[ 'account_id' ]  = sess_getAccountIdFromSession();

// escaping details
$details    = $validator->escape( $details );

if(!$_SERVER['HTTP_X_REQUESTED_WITH']){
	include(MEMBERS_EDIRECTORY_ROOT."/layout/header.php");
}

$app->setOptions( 'casemanager', 'viewcase', $action, $details )->run();

if(!$_SERVER['HTTP_X_REQUESTED_WITH']){
	include_once( MEMBERS_EDIRECTORY_ROOT."/layout/footer.php" );
}

ob_end_flush();
?>