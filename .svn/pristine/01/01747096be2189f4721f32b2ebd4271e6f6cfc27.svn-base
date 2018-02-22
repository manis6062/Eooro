<?php
/**
 * @author          Subigya Jyoti Panta
 * @subpackage      Search
 * @copyright (c) 2014, www.eooro.com
 * @version         1.0
 * @modification history original
 */
class SearchResults
{
    /**
     * @var int
     */
    protected $resultCount;
    
    /**
     * @var mixed
     */
    protected $resultSet;
    
    private  $main;
    private  $domain;
    
    function __construct()
    {
        $this->main   = db_getDBObject(DEFAULT_DB, TRUE);
        $this->domain = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $db);;
    }
    
    /**
     * 
     * @param string $sql
     * @param boolean $database
     */
    public function runSqlQuery( $sql, $database = false )
    {
        if ($database) {
            $resource = $this->main->query( $sql );
        }
        else {
            $resource = $this->domain->query( $sql );
        }
        $this->resultCount = mysql_num_rows( $resource );
        while( $row = mysql_fetch_assoc($resource) ){
            $this->resultSet[] = $row;
        }
    }
    
    /**
     * @return int
     */
    public function getResultCount()
    {
        return $this->resultCount;
    }
    
    public function getResultSet()
    {
        return $this->resultSet;
    }
}