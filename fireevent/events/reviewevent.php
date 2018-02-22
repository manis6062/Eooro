<?php
/**
 * @author          Subigya Jyoti Panta
 * @subpackage      plugins
 * @copyright (c) 2014, www.eooro.com
 * @version         1.0
 * @modification history original
 *                  To pass review to Listener, it acts like an adapter.
 */

class ReviewEvent extends UserEvent
{
    /**
     *
     * @var \Review
     */
    protected $review;
    
    protected $item;
    /**
     * 
     * @return \Review
     */
    public function getReview()
    {
        return $this->review;
    }
    
    /**
     * 
     * @param \Review $review
     */
    public function setReview( $review )
    {
        $this->review   = $review;
    }
    
    public function getItem()
    {
        return $this->item;
    }
    
    public function setItem( $item )
    {
        $this->item = $item;
    }
}