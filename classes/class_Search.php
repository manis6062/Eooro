<?php
/**
 * @author          Subigya Jyoti Panta
 * @subpackage      Search
 * @copyright (c) 2014, www.eooro.com
 * @version         1.0
 * @modification history original
 */
abstract class Search
{
    /**
     *
     * @var QueryFilter 
     */
    protected $filter;
    
    /**
     *
     * @var string
     */
    protected $query;
    
    /**
     *
     * @var SearchResults
     */
    protected $result;
            
    function __construct()
    {
        $this->filter = God::getQueryFilter();
    }
    
    public function setQuery($query)
    {
        // get Filtered Query
        $this->query = system_denyInjection2( $this->filter->setRawQuery( $query )->getFilteredQuery() );
        return $this;
    }
    
    public function getResults()
    {
        $this->result = God::getSearchResults();
        $this->process( $this->query );
        return $this->result;
    }
    
    abstract public function getPageBrowsingArray();
    
    protected function process( $query )
    {
        $sql = "SELECT * FROM Listing_Summary "
                . "WHERE MATCH ( Listing_Summary.fulltextsearch_what) AGAINST ('$query' IN BOOLEAN MODE) AND 
                    MATCH (Listing_Summary.fulltextsearch_what) AGAINST ('$query' IN BOOLEAN MODE)";
        $this->result->runSqlQuery( $sql );
//        $resource = 
    }
    
    abstract function getLetterSearchArray();
}