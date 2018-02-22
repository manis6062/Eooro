<?php
/**
 * @author          Subigya Jyoti Panta
 * @subpackage      Plugins
 * @copyright (c) 2014, www.eooro.com
 * @version         1.0
 * @modification history original
 */

class MongoDbLogger extends Logger
{
    /**
     *
     * @var string
     */
    protected $collectionName;
    
    /**
     *
     * @var MongoCollection
     */
    protected $collection;

    public function __construct( $collectionName, $databaseName, $server )
    {
        $client             = new MongoClient( $server );
        $this->mongoDb      = $client->selectDB( $databaseName );
        $this->collection   = $this->mongoDb->selectCollection( $collectionName );
    }
    
    public function writeLog( SLog $log )
    {
        $this->collection->save( $log );
    }
    
    /**
     * 
     * @param string $collectionName
     * @return \MongoDbLogger
     */
    public function setCollection( $collectionName )
    {
        $this->collectionName   = $collectionName;
        $this->collection       = $this->mongoDb->selectCollection( $collectionName );
        
        return $this;
    }
    
    public function getCollection()
    {
        return $this->collectionName;
    }
}
