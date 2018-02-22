<?php
/**
 * @author          Subigya Jyoti Panta
 * @subpackage      Modules
 * @copyright (c) 2014, www.eooro.com
 * @version         1.0
 * @modification history original
 */
include_once(BASE_MODEL);

class Dashboard_Model_Casemanager extends BaseModel
{
    /**
     *
     * @var int
     */
    protected $noOfCases;
    
    /**
     *
     * @var array
     */
    protected $cases;
    
    protected $unreadMessages;
    
    public function extractCaseDetails( $item_id )
    {
        // Open Cases    
        $sql = "SELECT * FROM Opened_Cases AS c
                INNER JOIN Review AS r ON c.review_id=r.id 
                WHERE r.item_id='$item_id' ORDER BY case
                when c.case_status like 'I' then '1' 
                when c.case_status like 'A' then '2'
                else '3' end, c.opened_date DESC";
        $resource   = $this->domainDb->query( $sql );
        while( $row = mysql_fetch_assoc( $resource ) ){
            $this->cases[] = $row;
        }
    }
    
    public function setUnreadMessages( $item_id )
    {
        if ( $this->cases ) {
            foreach ( $this->cases as $case) {
                $sql = "SELECT COUNT(*) as count FROM Case_Messages "
                    . "WHERE case_id='{$case['case_id']}' AND delivery_status='0000-00-00 00:00:00' AND from_user<>{$case['owner_id']}";

                $resource = $this->domainDb->query( $sql );
                $row = mysql_fetch_assoc( $resource );
                $this->unreadMessages[] = $row['count'];
            }
        }
    }
    
    public function getNoOfCases()
    {
        return count( $this->cases );
    }
    
    public function getCases()
    {
        return $this->cases;
    }
    
    public function getUnreadMessages()
    {
        return $this->unreadMessages;
    }
}
