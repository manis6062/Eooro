<?php
/**
 * @author          Subigya Jyoti Panta
 * @subpackage      SagePay
 * @copyright (c) 2014, www.eooro.com
 * @version         1.0
 * @modification history original
 */
defined( 'SJP' ) or die;

abstract class Filter
{    
    public function bindPostToProperties()
    {
        foreach ( $_POST as $key => $value) {
            $this->$key = $this->getFilteredData( $value );
        }
    }
    
    abstract public function getFilteredData( $data, $options );
}