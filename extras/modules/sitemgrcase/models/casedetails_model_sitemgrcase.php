<?php
/**
 * @author          Subigya Jyoti Panta
 * @subpackage      Modules
 * @copyright (c) 2014, www.eooro.com
 * @version         1.0
 * @modification history original
 */
include_once(BASE_MODEL);

class Casedetails_Model_Sitemgrcase extends BaseModel
{
    /**
     *
     * @var array
     */
    protected $caseDetails;
    
    /**
     *
     * @var array
     */
    protected $caseMessages;
    
    public function loadCaseDetails( $caseId )
    {
        $sql    = "SELECT C.*, R.*, L.title,A.nickname  FROM Opened_Cases AS C "
                . "JOIN Review AS R ON C.review_id=R.id "
                . "JOIN Listing AS L ON R.item_id=L.id "
                . "JOIN AccountProfileContact AS A ON C.owner_id=A.account_id "
                . "WHERE C.case_id=$caseId";
        
        $resource   = $this->domainDb->query( $sql );
//        while( $row = mysql_fetch_array( $resource ) ){
        
            $this->caseDetails = mysql_fetch_array( $resource );
//        }
        $this->loadCaseMessages( $caseId );
    }
    
    public function loadCaseMessages( $caseId )
    {
        $sql    = "SELECT * FROM Case_Messages "
                . "WHERE case_id=$caseId";
        
        $resource   = $this->domainDb->query( $sql );
        
        while( $row = mysql_fetch_assoc($resource) ){
            $this->caseMessages[] = $row;
        }
    }
    
    public function getCaseDetails()
    {
        return $this->caseDetails;
    }
    
    public function getCaseMessages()
    {
        return $this->caseMessages;
    }
}