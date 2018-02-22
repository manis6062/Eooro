<?php
/**
 * @author          Subigya Jyoti Panta
 * @subpackage      God
 * @copyright (c) 2014, www.eooro.com
 * @version         1.0
 * @modification history original
 */
include_once 'class_QueryFilter.php';
include_once 'class_Search.php';
include_once 'class_SearchResults.php';
include_once 'class_ListingSearch.php';

abstract class God
{
    /**
     * 
     * @return \QueryFilter
     */
    public static function getQueryFilter()
    {
        return new QueryFilter();
    }
    
    /**
     * 
     * @return \Search
     */
    public static function getSearch( $type = 'listing' )
    {
        switch ( $type ) {
            
            case 'listing':
                $object = new ListingSearch();

                break;

            //Unclaimed Listings    
            case 'UnclaimedListing':
                $object = new UnclaimedSearch();

                break;
    

            default:
                $object = new ListingSearch();
                break;
        }
        return $object;
    }
    
    /**
     * 
     * @return \SearchResults
     */
    public static function getSearchResults()
    {
        return new SearchResults();
    }
    
    public static function getLoader()
    {
        static $instance;
        if( !isset($instance) ){
            $instance = new Loader();
        }
        return $instance;
    }
}