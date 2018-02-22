<?php
/**
 * @author          Subigya Jyoti Panta
 * @subpackage      SagePay
 * @copyright (c) 2014, www.eooro.com
 * @version         1.0
 * @modification history original
 */
defined( 'SJP' ) or die;

class NormalBasket extends Basket
{
    public function prepareBasket()
    {
        $this->produceBasket();
        
        return $this;
    }
    
    protected function produceBasket()
    {
        $no = $this->getNoOfContentsInBasket();
        $this->contents = '';
        
        $this->contents .= $no . ':';
        foreach (  $this->rawData as $key => $value ){
            if ( $this->checkKey($key) ) {
                foreach( $value as $no => $detail ){
                    $this->contents .= $this->rawData[$key][$no]['title'] . ':'
                                .'1:'  // quantity
                                .$detail['total_fee'] . ':'  // item value 
                                .$this->rawData[$key][$no]['unitTaxAmount'] . ':' // item tax
                                .$this->rawData[$key][$no]['unitGrossAmount'] . ':' // item total
                                .$this->rawData[$key][$no]['unitGrossAmount'] . ':'; // line total
                }
            }
        }
        $this->contents = rtrim( $this->contents, ':' );    // remove the trailing :
    }
    
    protected function getNoOfContentsInBasket()
    {
        $count = 0;
        foreach (  $this->rawData as $key => $value ){
            if ( $this->checkKey($key) ) {
                $count += count($value);
            }
        }
        return $count;
    }
}
