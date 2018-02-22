<?php

/**
 * @author          Subigya Jyoti Panta
 * @subpackage      SagePay
 * @copyright (c) 2014, www.eooro.com
 * @version         1.0
 * @modification history original
 */

try{
    $sageApp    = Sagefactory::getApplication();
    $response   = $sageApp->setTask( 'response', 'interpret', $crypt )->run( true );
    
    extract( $response );
} 
catch (Exception $ex) {
    echo $ex->getMessage();
}
