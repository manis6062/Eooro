<?php
/**
 * @author          Subigya Jyoti Panta
 * @subpackage      Plugins
 * @copyright (c) 2014, www.eooro.com
 * @version         1.0
 * @modification history original
 */

class Lucene49Search
{
    /**
     * Name of the database table where you want to search.
     * 
     * @var String
     */
    protected $dbTable;
    
    /**
     * Path of the directory where lucene indexed are present.
     * 
     * @var String 
     */
    protected $searchDir;
    
    /**
     * Comma separated database fields that is to be returned.
     * 
     * @var string
     */
    protected $returnFields;
    
    /**
     * Comma separated database fields where you want to search.
     * 
     * @var string
     */
    protected $searchFields;
    
    /**
     * Comma separated Keywords you want to search.
     * 
     * @var string
     */
    protected $searchKeys;
    
    /**
     * Path to the searcher jar file.
     * 
     * @var string
     */
    protected $jar;
    
    /**
     * Starting no. of items to list.
     * ie 10 of 10-21
     * @var int
     */
    protected $startIndex;
    
    /**
     * Ending no. of items of the list.
     * ie 21 of 10-21
     * @var int
     */
    protected $endIndex;
    
    /**
     * 
     * @param string $dbTable database table name
     * @param string $searchDir directory to search for the indexed files
     * @param string $returnFields comma separated fields to return -> (similar to mysql select field1, field2)
     * @param string $searchFields field to search for -> ( similar to mysql where "field1" = key )
     * @param string $searchKeys key to search for -> ( similar to mysql where field1 = "key" )
     */
    public function __construct( $dbTable, $searchDir, $returnFields, $searchFields, $searchKeys, $jarPath )
    {
        $this->dbTable      = $dbTable;
        $this->searchDir    = $searchDir;
        $this->returnFields = $returnFields;
        $this->searchFields = $searchFields;
        $this->searchKeys   = $searchKeys;
        $this->jar          = $jarPath;
    }
    
    /**
     * Builds command to run jar file. The command is of the following format.
     * java -jar -searchDir <directory> -returnFields <fields> .... etc.
     * 
     * @return string
     * @throws Exception
     */
    protected function buildCommand()
    {
        if ( empty($this->searchDir) || empty($this->dbTable) || empty($this->returnFields) || empty($this->searchFields) || empty($this->searchKeys) ) {
            throw new Exception( "Search dir or database table or return fields or search fields or search keys not specified");
        }
        if ( count(explode(',', $this->searchFields)) !== count(explode(',', $this->searchKeys)) ) {
            throw new Exception( "Search fields does not match search keys" );
        }
        $properties     = get_object_vars( $this );
        
        foreach( $properties as $key => $values ){
            $this->$key = $this->$key ? ' -'.strtolower($key).' \''.$values.'\'' : '';
        }
        
        if ( $this->searchDir && $this->dbTable ) {
            $command    = 'java '.$this->jar.$this->searchDir
                    .$this->dbTable.$this->returnFields.$this->searchFields.$this->searchKeys
                    .$this->startIndex.$this->endIndex;
        }
        else {
            throw new Exception( 'Index Directory not Specified', 5000 );
        }
        return $command;
    }
    
    /**
     * Runs the java command and returns the search results in array form.
     * 
     * @return array
     * @throws Exception
     */
    public function getResults()
    {
        $command = $this->buildCommand();
        
        exec($command, $output);
        if ( $output ) {
            return $output;
        }
        else {
            throw new Exception( 'Error in Command, No results found', 10000 );
        }
    }
    
    public function setDbTable( $dbTable )
    {
        $this->dbTable = $dbTable;
        return $this;
    }
    
    public function setSearchDir( $dir )
    {
        $this->searchDir = $dir;
        return $this;
    }
    
    public function setReturnFields( $returnFields )
    {
        $this->returnFields = $returnFields;
        return $this;
    }
    
    public function setSearchFields( $fields )
    {
        $this->searchFields = $fields;
        return $this;
    }
    
    public function setSearchKeys( $keys )
    {
        $this->searchKeys   = $keys;
        return $this;
    }
    
    public function setJarPath( $path )
    {
        $this->jar  = $path;
    }        
     
    public function setStartIndex( $start )
    {
        $this->startIndex = $start;
    }
    
    public function setEndIndex( $end )
    {
        $this->endIndex = $end;
    }
    
}
