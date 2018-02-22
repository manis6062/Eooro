<?php
/**
 * @author          Subigya Jyoti Panta
 * @subpackage      SagePay
 * @copyright (c) 2014, www.eooro.com
 * @version         1.0
 * @modification history original
 */
defined( 'SJP' ) or die;

class SimpleFilter extends Filter
{
    /**
     * @todo Function is not complete and may not work correctly
     * @param string $data
     * @param string $options
     * @return type
     */
    public function getFilteredData($data, $options)
    {
        if ( $options === 'int' ) {
            preg_match( '#[0-9]+#', $data, $matches );
        }
        else if ( $options === 'float' ) {
            preg_match( '#[0-9.]+#', $data, $matches );
        }
        else{
            preg_match_all( '#[0-9a-zA-Z]#', $data, $matches );
        }
        return $matches[0];
    }
}
