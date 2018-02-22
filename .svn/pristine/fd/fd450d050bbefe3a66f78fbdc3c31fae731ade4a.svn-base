<?php
/**
 * @author          Subigya Jyoti Panta
 * @subpackage      Plugins
 * @copyright (c) 2014, www.eooro.com
 * @version         1.0
 * @modification history original
 */

class Lucene
{
    /**
     *
     * @var \Lucene49Search
     */
    protected $searcher;
    
    /**
     * Contains configuration details of Lucene
     * 
     * @var array
     */
    protected $config;
    
    /**
     * Tells if use has entered a search query
     * 
     * @var boolean
     */
    protected $flag;
    
    public function __construct()
    {
        $this->config   = parse_ini_file( __DIR__ . DIRECTORY_SEPARATOR . 'config.ini' );
        
        $queryKey   = !empty($_GET[ 'keyword' ]) ? $this->insertWildcard($_GET[ 'keyword' ]) : false;
        $queryLoc   = !empty($_GET[ 'where' ]) ? $this->insertWildcard($_GET[ 'where' ]) : false;

        if ( $queryKey && $queryLoc ) {
            $searchFields   = "fulltextsearch_keyword, fulltextsearch_where";
            $searchKeys     = $queryKey . ','.$queryLoc;
            $this->flag     = true;
        }
        else if ( $queryKey ) {
            $searchFields   = "fulltextsearch_keyword";
            $searchKeys     = $queryKey;
            $this->flag     = true;
        }
        else if ( $queryLoc ) {
            $searchFields   = "fulltextsearch_where";
            $searchKeys     = $queryLoc;
            $this->flag     = true;
        }
        else{
            $this->flag     = false;
        }
        
        $this->searcher = new Lucene49Search( $this->config['database_table'], 
                $this->config['search_dir'], $this->config['return_fields'], 
                $searchFields, $searchKeys, $this->config['jar_path'] ); 
    }
    
    /**
     * Contains all the listing information. Returns all the results by default.
     * All result = All 120 results if 120 records are found.
     * 
     * @param type $startIndex If you want 40-50 data from 120 found it is 40
     * @param type $endIndex    If you want 40-50 data from 120 found it is 50
     * @return type
     */
    public function getResults( $screen = 0, $itemsPerPage = 0 )
    {
        $listings   = array();
        if ( $screen == 0 || $screen == 1 ) {
            $startIndex = 0;
        }
        else {
            $startIndex = ( $screen - 1 ) * $itemsPerPage;
        }
        $endIndex   = $startIndex + $itemsPerPage;
        
        $this->searcher->setStartIndex( $startIndex );
        $this->searcher->setEndIndex( $endIndex );
        
        if ($this->flag) {
            $result = $this->searcher->getResults();
            
            $no = array_pop( $result );
            $no = substr($no, 5);
            foreach ( $result as $json ){
                $listings[] = (array)json_decode( $json );
            }
            $listings[] = trim( $no );
        }
        return $listings;
    }
    
    /**
     * To insert a wildcard for searching user query.
     * 
     * @param type $string
     * @return string
     */
    protected function insertWildcard( $string )
    {
        $result = explode( ' ', $string );
        foreach ( $result as $value) {
            $withcard[] = $value . '*';
        }
        $result = implode( ' ', $withcard );
        
        return $result;
    }
}
