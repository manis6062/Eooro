<?php
/**
 * @author          Subigya Jyoti Panta
 * @subpackage      Modules
 * @copyright (c) 2014, www.eooro.com
 * @version         1.0
 * @modification history original
 */
include_once(BASE_VIEW);

class Searchcase_View_Sitemgrcase extends BaseView
{
    public function display()
    {
        parent::display();
    }
    
    public function showSearchedCases( $details )
    {
        $this->cases            = $this->get( 'Cases' );
        $this->searched         = $this->get( 'Searched' );
        $this->status           = $this->get( 'Status' );
        $this->pagesArray       = $this->get( 'PagesArray' ); 
        $this->searchDetails    = $details['search']; 
        parent::display();
    }
}