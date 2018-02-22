<?php
/**
 * @author          Subigya Jyoti Panta
 * @subpackage      SagePay
 * @copyright (c) 2014, www.eooro.com
 * @version         1.0
 * @modification history original
 */

defined( 'SJP' ) or die;

abstract class Basket
{
    /**
     * Get Contents of Basket
     * 
     * @var string
     */
    protected $contents;
    
    /**
     * Set Raw Basket data that is to be converted into required type.
     * 
     * @var mixed
     */
    protected $rawData;
    
    /**
     * Get contents of the Basket
     * 
     * @return string
     */
    public function getContents()
    {
        return $this->contents;
    }
    
    /**
     * 
     * @param type $data
     * @return \Basket
     */
    public function setRawData( $data )
    {
        $this->rawData = $data;
        return $this;
    }
    
    /**
     * @return \Basket
     */
    abstract public function prepareBasket();
    
    protected function checkKey( $key )
    {
        if ($key === 'listings' || $key === 'banners' || $key === 'events' || $key === 'classifieds' || $key === 'articles' || $key === 'cases') {
            return true;
        }
        return false;
    }
}
