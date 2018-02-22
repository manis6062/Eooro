<?php
/**
 * @author          Subigya Jyoti Panta
 * @subpackage      SagePay
 * @copyright (c) 2014, Subigya Jyoti Panta
 * @version         1.0
 */
defined( 'SJP' ) or die( 'Restricted Access' );

class BaseModel
{
    /**
     * Database connector pointing to main ( prefix_main )
     * 
     * @var mysql
     */
    protected $mainDb;
    
    /**
     * Database connector pointing to domain
     * 
     * @var mysql
     */
    protected $domainDb;
    
    public function __construct() 
    {
        $this->mainDb   = db_getDBObject( DEFAULT_DB, true );
        $this->domainDb = db_getDBObjectByDomainID( SELECTED_DOMAIN_ID, $this->mainDb );
    }
}
