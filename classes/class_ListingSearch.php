<?php
/**
 * @author          Subigya Jyoti Panta
 * @subpackage      Search
 * @copyright (c) 2014, www.eooro.com
 * @version         1.0
 * @modification history original
 */
class ListingSearch extends Search
{
    public function getPageBrowsingArray()
    {
        
        $this->query = $this->replaceStuff($this->query);
        if( system_denyInjection2($_GET['sel']) === $this->query && !empty($_GET['sel']) ){
            return $this->getArrayForPredictionAndSearch();
        }
        else {
            return $this->getArrayForSearch();
        }
    }

    
    protected function getArrayForSearch()
    {
        
        $array      = array();
        $query      = $this->filter->addCharacterToBeginningOfTextGtOne( $this->query );
        //When searching for abc-To-xyz.com, To is removed giving us abc--xyz, '--' causing error so removed that
        $query = str_replace("--", "" ,$query);
        $array["select_columns"] = "*, (MATCH (`Listing_Summary`.`fulltextsearch_what`) AGAINST ('$query' IN BOOLEAN MODE) + ( case when backlink = 'y' then 0.2 else 0 end)+ (avg_review * 0.1 ) + (number_views * 0.001) + ( case when title = '".str_replace("+", "", $query)."' then 1 else 0 end) + case when account_id > 0 then 0.2 else 0 end ) relivence";
        $array["from_tables"]    = "Listing_Summary";
        $whereclause[]  = "Listing_Summary.status in( 'A' , 'P' , 'E')";
        $country        = CountryLoader::getCountryId() ? "location_1=".  CountryLoader::getCountryId() : '';
        $whereclause[]  = $country;
        $whereclause[]  = $country ? (CountryLoader::getStateId($country) ? "location_3=". CountryLoader::getStateId($country) : '') : '';
        //$queryArray     = explode( ' ', $this->query );
        //foreach( $queryArray as $qa ){
            $whereclause[] = "MATCH (Listing_Summary.fulltextsearch_what) AGAINST ('$query' IN BOOLEAN MODE)";
        //}
        $array["where_clause"]   = implode( ' AND ', array_filter($whereclause) );
        $array["group_by"]       = false;
        $array["order_by"]       = ""
                                . "relivence DESC,Listing_Summary.avg_review DESC, Listing_Summary.number_views DESC, Listing_Summary.backlink DESC";
        $array['query']         = $query;
        return $array;
    }
    
    protected function getArrayForPredictionAndSearch()
    {
        $array      = array();
        $array["select_columns"] = "*";
        $array["from_tables"]    = "Listing_Summary";
        $whereclause[]  = "Listing_Summary.status = 'A'";
        $country        = CountryLoader::getCountryId() ? "location_1=".  CountryLoader::getCountryId() : '';
        $whereclause[]  = $country;
        $whereclause[]  = $country ? (CountryLoader::getStateId($country) ? "location_3=". CountryLoader::getStateId($country) : '') : '';
        $whereclause[]  = "Listing_Summary.title = '$this->query'";
        
        $array["where_clause"]   = implode( ' AND ', array_filter($whereclause) );
        $array["group_by"]       = false;
        $array["order_by"]       = "Listing_Summary.level,Listing_Summary.backlink DESC";
        
        return $array;
    }
    
    public function getLetterSearchArray()
    {
        $_locations = explode(",", EDIR_LOCATIONS);
        foreach($_locations as $_location_level) {
            if ( is_numeric($_GET["location_".$_location_level]) ) {
                $whereclause[] = "Listing.location_".$_location_level." = ".$_GET["location_".$_location_level]."";
            }
        }
        $whereclause[] =   "Listing.status = 'A'";
        $whereclause[] =   "Listing.title LIKE '".$this->query."%'";
        
        $array = array();
        $array["select_columns"] = "title, friendly_url, fulltextsearch_keyword, avg_review";
        $array["from_tables"]    = "Listing";
        $array["where_clause"]   = implode( ' AND ', array_filter($whereclause) );
        $array["group_by"]       = false;
        $array["order_by"]       = "Listing.title";
        
        return $array;
    }

    public function replaceStuff($word){
    	$return = str_replace(".", "", $word);
    	$return = str_replace("http://", "", $return);
    	$return = str_replace("www", "", $return);
    	$return = str_replace("ftp://", "", $return);
    	$return = str_replace("https://", "", $return);

    	return $return;
    }
}



    /**
     * 
     * @Unclaimed Search
     */

class UnclaimedSearch extends Search
{
    public function getPageBrowsingArray()
    {
        $this->query = $this->replaceStuff($this->query);
        if( system_denyInjection2($_GET['sel']) === $this->query && !empty($_GET['sel']) ){
            return $this->getArrayForPredictionAndSearch();
        }
        else {
            return $this->getArrayForSearch();
        }
    }

    
    protected function getArrayForSearch()
    {
        $array      = array();
        $query      = $this->filter->addCharacterToBeginningOfTextGtOne( $this->query );
        //When searching for abc-To-xyz.com, To is removed giving us abc--xyz, '--' causing error so removed that
        $query = str_replace("--", "" ,$query);
        $array["select_columns"] = "*, MATCH (`Listing_Summary`.`fulltextsearch_what`) AGAINST ('$query' IN BOOLEAN MODE) relivence";
        $array["from_tables"]    = "Listing_Summary";
        $whereclause[]  = "Listing_Summary.status = 'A'";
        $country        = CountryLoader::getCountryId() ? "location_1=".  CountryLoader::getCountryId() : '';
        $whereclause[]  = $country;
        $whereclause[]  = $country ? (CountryLoader::getStateId($country) ? "location_3=". CountryLoader::getStateId($country) : '') : '';
        $whereclause[] = "MATCH (Listing_Summary.fulltextsearch_what) AGAINST ('$query' IN BOOLEAN MODE) AND account_id=0";
        $array["where_clause"]   = implode( ' AND ', array_filter($whereclause) );
        $array["group_by"]       = false;
        $array["order_by"]       = ""
                                    . "relivence DESC,Listing_Summary.level,Listing_Summary.backlink DESC";
        $array['query']         = $query;

        return $array;
    }
    
    
    public function getLetterSearchArray()
    {
        $_locations = explode(",", EDIR_LOCATIONS);
        foreach($_locations as $_location_level) {
            if ( is_numeric($_GET["location_".$_location_level]) ) {
                $whereclause[] = "Listing.location_".$_location_level." = ".$_GET["location_".$_location_level]."";
            }
        }
        $whereclause[] =   "Listing.status = 'A'";
        $whereclause[] =   "Listing.title LIKE '".$this->query."%'";
        
        $array = array();
        $array["select_columns"] = "title, friendly_url, fulltextsearch_keyword, avg_review";
        $array["from_tables"]    = "Listing";
        $array["where_clause"]   = implode( ' AND ', array_filter($whereclause) );
        $array["group_by"]       = false;
        $array["order_by"]       = "Listing.title";
        
        return $array;
    }

    public function replaceStuff($word){
    	$return = str_replace(".", "", $word);
    	$return = str_replace("http://", "", $return);
    	$return = str_replace("www", "", $return);
    	$return = str_replace("ftp://", "", $return);
    	$return = str_replace("https://", "", $return);

    	return $return;
    }
}



/**
 * @Class Search By ID
 */

class ListingSearchByID extends Search
{
    public function getPageBrowsingArray()
    {
        if( system_denyInjection2($_GET['sel']) === $this->query && !empty($_GET['sel']) ){
            return $this->getArrayForPredictionAndSearch();
        }
        else {
            return $this->getArrayForSearch();
        }
    }

    
    protected function getArrayForSearch()
    {
        $array      = array();
        $query      = $this->filter->addCharacterToBeginningOfTextGtOne( $this->query );
        $array["select_columns"] = " * ";
        $array["from_tables"]    = "Listing_Summary";
        $whereclause[]  = "Listing_Summary.status = 'A'";
        $country        = CountryLoader::getCountryId() ? "location_1=".  CountryLoader::getCountryId() : '';
        $whereclause[]  = $country;
        $whereclause[]  = $country ? (CountryLoader::getStateId($country) ? "location_3=". CountryLoader::getStateId($country) : '') : '';
        //$queryArray     = explode( ' ', $this->query );
        //foreach( $queryArray as $qa ){
            $whereclause[] = "id=$query";
        //}
        $array["where_clause"]   = implode( ' AND ', array_filter($whereclause) );
        $array["group_by"]       = false;
        $array["order_by"]       = ""
                                . "Listing_Summary.level,Listing_Summary.backlink DESC";
        
        return $array;
    }
    
    protected function getArrayForPredictionAndSearch()
    {
        $array      = array();
        $array["select_columns"] = "*";
        $array["from_tables"]    = "Listing_Summary";
        $whereclause[]  = "Listing_Summary.status = 'A'";
        $country        = CountryLoader::getCountryId() ? "location_1=".  CountryLoader::getCountryId() : '';
        $whereclause[]  = $country;
        $whereclause[]  = $country ? (CountryLoader::getStateId($country) ? "location_3=". CountryLoader::getStateId($country) : '') : '';
        $whereclause[]  = "Listing_Summary.title = '$this->query'";
        
        $array["where_clause"]   = implode( ' AND ', array_filter($whereclause) );
        $array["group_by"]       = false;
        $array["order_by"]       = "Listing_Summary.level,Listing_Summary.backlink DESC";
        
        return $array;
    }
    
    public function getLetterSearchArray()
    {
        $_locations = explode(",", EDIR_LOCATIONS);
        foreach($_locations as $_location_level) {
            if ( is_numeric($_GET["location_".$_location_level]) ) {
                $whereclause[] = "Listing.location_".$_location_level." = ".$_GET["location_".$_location_level]."";
            }
        }
        $whereclause[] =   "Listing.status = 'A'";
        $whereclause[] =   "Listing.title LIKE '".$this->query."%'";
        
        $array = array();
        $array["select_columns"] = "title, friendly_url, fulltextsearch_keyword, avg_review";
        $array["from_tables"]    = "Listing";
        $array["where_clause"]   = implode( ' AND ', array_filter($whereclause) );
        $array["group_by"]       = false;
        $array["order_by"]       = "Listing.title";
        
        return $array;
    }
}

