<?php
/**
 * @author          Subigya Jyoti Panta
 * @subpackage      Modules
 * @copyright (c) 2014, www.eooro.com
 * @version         1.0
 * @modification history original
 */
include_once(BASE_MODEL);

class Searchcase_Model_Sitemgrcase extends BaseModel
{
    /**
     * Searched cases
     * @var array
     */
    protected $cases;
    
    /**
     *
     * @var array
     */
    protected $status;
    
    /**
     *
     * @var \pageBrowsing
     */
    protected $pagination;
    
    /**
     * array containing pagination details like current page etc.
     * 
     * @var array
     */
    protected $pagesArray;
    
    /**
     *
     * @var boolean
     */
    protected $searched;
    
    function __construct()
    {
        parent::__construct();
        
        $this->searched = false;
        $this->status   = array( 'A' => 'Active', 'C' => 'Closed', 'I' => 'Initialised' ); 
    }
    /**
     * Works !!
     * @param array $details
     */
    public function loadSearchData( $details )
    {
        $db = db_getDBObject(DEFAULT_DB, false);
        
        $sql = "SELECT O.*, R.*, A.*, L.title FROM
            ". $db->db_name .".Opened_Cases O
            left outer join ". $db->db_name .".Review R on O.review_id = R.id
            left outer join ". $db->db_name .".AccountProfileContact A on O.owner_id=A.account_id
            left outer join ". $db->db_name .".Listing L on R.item_id=L.id ";
        
        $where[]    = !empty($details['search']['case_status']) ? "O.case_status='{$details['search']['case_status']}'" : '';
        $where[]    = !empty($details['search']['owner_name']) ? "A.nickname LIKE '%{$details['search']['owner_name']}%'" : '';
        $where[]    = !empty($details['search']['listing_title']) ? "L.title LIKE '%{$details['search']['listing_title']}%'" : '';
        $where[]    = !empty($details['search']['review_title']) ? "R.review_title LIKE '%{$details['search']['review_title']}%'" : '';
        $where[]    = !empty($details['search']['reviewer_name']) ? "R.reviewer_name LIKE '%{$details['search']['reviewer_name']}%'" : '';
        $where[]    = !empty($details['search']['opened_date']) ? "date(O.opened_date)='{$details['search']['opened_date']}'" : '';
        
        $where = array_filter( $where, function( $value ){
            if ( $value ) {
                return $value;
            }
        });
        if ( $where ) {
            $whereClause = 'WHERE '.implode( ' AND ', $where );
            $sql .= $whereClause;
        }
            /*WHERE O.case_status='A' 
            AND A.nickname like '%brock%' 
            AND R.reviewer_name like '%nmp%'
            AND L.title like '%ltd%'
            AND R.review_title like '%title%'
            AND date(O.opened_date)='2014-08-14'";*/
        $resource = $this->domainDb->query( $sql );
    }
    
    public function loadPaginatedSearchData( $details )
    {
        $db = db_getDBObject(DEFAULT_DB, false);

        $table = "Opened_Cases| "
                . "left outer join ". $db->db_name .".Review R on Opened_Cases.review_id = R.id
            left outer join ". $db->db_name .".AccountProfileContact A on Opened_Cases.owner_id=A.account_id
            left outer join ". $db->db_name .".Listing L on R.item_id=L.id ";
        $returnCols = '*, R.*, A.*, L.title';
        
        // building where clause
        $where[]    = !empty($details['search']['case_status']) ? "Opened_Cases.case_status='{$details['search']['case_status']}'" : '';
        $where[]    = !empty($details['search']['owner_name']) ? "A.nickname LIKE '%{$details['search']['owner_name']}%'" : '';
        $where[]    = !empty($details['search']['listing_title']) ? "L.title LIKE '%{$details['search']['listing_title']}%'" : '';
        $where[]    = !empty($details['search']['review_title']) ? "R.review_title LIKE '%{$details['search']['review_title']}%'" : '';
        $where[]    = !empty($details['search']['reviewer_name']) ? "R.reviewer_name LIKE '%{$details['search']['reviewer_name']}%'" : '';
        $where[]    = !empty($details['search']['opened_date']) ? "date(Opened_Cases.opened_date)='{$details['search']['opened_date']}'" : '';
        
        $where = array_filter( $where, function( $value ){
            if ( $value ) {
                return $value;
            }
        });
        if ( $where ) {
            $whereClause = implode( ' AND ', $where );
            $this->searched = true;
        }
        $this->pagination = new pageBrowsing( $table, $details['screen'], RESULTS_PER_PAGE, 
                false, false, false, $whereClause, $returnCols );
    
        $this->cases    = $this->pagination->retrievePage( 'array' );
        $this->pagesArray = system_preparePagination($paging_url, 'controller=searchcase', $this->pagination, false, $details['screen'], RESULTS_PER_PAGE, TRUE );
    }
    
    
    public function getCases()
    {
        return $this->cases;
    }
    
    public function getPagesArray()
    {
        return $this->pagesArray;
    }
    
    public function getSearched()
    {
        return $this->searched;
    }
    public function getStatus()
    {
        return $this->status;
    }
}