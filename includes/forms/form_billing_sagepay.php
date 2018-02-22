<?php
/**
 * @author          Subigya Jyoti Panta
 * @authorurl       www.subigyapanta.com.np
 * @subpackage      SagePay
 * @copyright (c) 2014, www.eooro.com
 * @version         1.0
 * @modification history original
 */
$sage    = Sagefactory::getApplication();
$sage->setTask( 'paymentprocess', 'billing', $bill_info )->run();
?>