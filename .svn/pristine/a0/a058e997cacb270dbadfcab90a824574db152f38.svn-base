<?php
/**
 * @author          Subigya Jyoti Panta
 * @subpackage      Modules
 * @copyright (c) 2014, www.eooro.com
 * @version         1.0
 * @modification history original
 */
include_once(BASE_VIEW);

class Manage_View_Sitemgrcase extends BaseView
{
    public function listCases( $details )
    {
        $this->cases    = $this->get( 'Cases' );
        $this->status   = $this->get( 'Status' );
        $this->arrowDir[$details['order_by']] = !empty($details['order_dir']) ? (($details['order_dir'] === 'ASC') ? 'down' : 'up' ) : 'down';
        $this->pagesArray   = $this->get( 'PagesArray' ); 
        
        parent::display();
    }
}