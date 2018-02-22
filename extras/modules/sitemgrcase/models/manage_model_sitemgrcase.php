<?php
/**
 * @author          Subigya Jyoti Panta
 * @subpackage      Modules
 * @copyright (c) 2014, www.eooro.com
 * @version         1.0
 * @modification history original
 */
include_once(BASE_MODEL);

class Manage_Model_Sitemgrcase extends BaseModel
{
    /**
     *
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
     *
     * @var array
     */
    protected $pagesArray;
    
    function __construct()
    {
        parent::__construct();
        
        $this->status   = array( 'A' => 'Active', 'C' => 'Closed', 'I' => 'Initialised' ); 
    }
    
    public function loadCases( $details )
    {
        $orderBy    = $details['order_by'] ? 'ORDER BY '.$details['order_by'] : '';
        $orderDir   = $details['order_dir'] ? $details['order_dir'] : '';
        
        $sql = "SELECT C.*, R.*, L.title, A.first_name, A.last_name FROM Opened_Cases AS C "
                . "JOIN Review AS R ON C.review_id=R.id "
                . "JOIN Listing AS L ON R.item_id=L.id "
                . "JOIN AccountProfileContact AS A ON C.owner_id=A.account_id "
                . "$orderBy $orderDir";
        
        $resource = $this->domainDb->query( $sql );
        while( $row = mysql_fetch_assoc($resource) ){
            $this->cases[] = $row;
        }
    }
    
    public function loadCasesWithPagination( $details )
    {
        /**
         * pageBrowsing($table = "Listing", $screen = 1, $limit = false, $order = false, 
         * $letter_field = false, $letter = false, $where = false, $return_columns = "*", 
         * $return_object = false, $group_by = false, $force_main = false, 
         * $selected_domain_id = false, $having = false RESULTS_PER_PAGE
         */
        
        $table      = "Opened_Cases| "
                    . "JOIN Review AS R ON Opened_Cases.review_id=R.id "
                    . "JOIN Listing AS L ON R.item_id=L.id "
                    . "JOIN AccountProfileContact AS A ON Opened_Cases.owner_id=A.account_id ";
        $returnCols = '*, R.*, L.title, A.first_name, A.last_name';
        $orderBy    = $details['order_by'] ? $details['order_by'] : '';
        $orderDir   = $details['order_dir'] ? $details['order_dir'] : '';
        $order      = (!empty($details['order_by']) && !empty($details['order_dir'])) ? $details['order_by'].' '.$details['order_dir'] : false;
        $this->pagination = new pageBrowsing( $table, $details['screen'], RESULTS_PER_PAGE, 
                $order, false, false, false, $returnCols );
        
        $this->cases    = $this->pagination->retrievePage( 'array' );
        $paging_url = SITEMGRCASE_URL.'?';
        $this->pagesArray = system_preparePagination($paging_url, 'controller=manage', $this->pagination, false, $details['screen'], RESULTS_PER_PAGE, TRUE );
     
    }
    
    public function getCases()
    {
        return $this->cases;
    }
    
    public function getStatus()
    {
        return $this->status;
    }
    
    public function getPagesArray()
    {
        return $this->pagesArray;
    }
}