<?php

abstract class TransactionLogger
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
    
    protected $txClasses;
    
    public function __construct() 
    {
        $this->mainDb   = db_getDBObject( DEFAULT_DB, true );
        $this->domainDb = db_getDBObjectByDomainID( SELECTED_DOMAIN_ID, $this->mainDb );
    }
    
    public abstract function logIndividualTransaction( $paymentLogObj, $txStatus, $type, $typeObjArray );
    
    public abstract function updateType( $txStatus, $itemStatus, $type, $typeObjArray );

    public function setTxClasses( $txClass )
    {
        $this->txClasses = $txClass;
    }
}