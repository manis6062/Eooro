<?php
/**
 * @author          Subigya Jyoti Panta
 * @subpackage      Search
 * @copyright (c) 2014, www.eooro.com
 * @version         1.0
 * @modification history original
 */
class QueryFilter
{
    /**
     * List of Prepositions
     * @var array
     */
    private $prepList;
    
    protected $rawQuery;
            
    function __construct()
    {
        $this->prepList = array(
            '&', 'at', 'of', 'on', 'or','com','in', 'the', 'to','.', '-', '--' , '%', '@', '$' ,'#' , ';' , ':' , "'" , '"'
        );
    }
    
    public function setRawQuery( $raw )
    {
        $this->rawQuery = $raw;
        return $this;
    }
    
    /**
     * Returns User query after removing unwanted words.
     * 
     * @return string
     */
    public function getFilteredQuery()
    {
        $replaced = preg_replace('/\b(?:'.implode('|', $this->prepList).')\b/', ' ', $this->rawQuery );
        $replaced = preg_replace( '/[\s]{2,}/', ' ', $replaced );
        $replaced = trim($replaced);
        return $replaced;
    }
    
    public function addCharacterToBeginningOfTextGtOne( $string, $char = '+' )
    {
        $return = array();
        $temp = explode( ' ', $string );
        foreach( $temp as $values ){
            if ( strlen($values) > 1 ) {
                $return[] = $char.$values;
            }
            else {
                $return[] = $values;
            }
        }
        
        return implode( ' ', $return );
    }
}