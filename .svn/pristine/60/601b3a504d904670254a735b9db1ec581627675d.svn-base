<?php
/**
 * @author          Subigya Jyoti Panta
 * @subpackage      Modules
 * @copyright (c) 2014, www.eooro.com
 * @version         1.0
 * @modification history original
 */
include_once(BASE_MODEL);
include_once(CASEMANAGER_ASSETS_DIR.DIRECTORY_SEPARATOR.'ownermodel.php');
include_once(CASEMANAGER_ASSETS_DIR.DIRECTORY_SEPARATOR.'reviewermodel.php');
include_once(CASEMANAGER_ASSETS_DIR.DIRECTORY_SEPARATOR.'usertype.php');
include_once( CLASSES_DIR.DIRECTORY_SEPARATOR.'class_CaseSettings.php' );

class Viewcase_Model_Casemanager extends BaseModel
{
    protected $caseDetails;
    
    protected $caseMessages;
    
    protected $currentUser;
    protected $toUser;
    
    protected $listing;
    protected $caseCloseAgreement;
    protected $setting;
    
    public function __construct()
    {
        parent::__construct();
        
        $this->setting = new CaseSettings();
    }
    /**
     * To load case details from database when the user clicks on view case.
     * It fetches all the required data from the database.
     * 
     * @param type $details
     */
    public function loadCaseDetails( $details )
    {
        $sql = "SELECT * FROM Opened_Cases c "
                . "JOIN Review r ON c.review_id=r.id "
                . "JOIN Case_Messages m ON c.case_id=m.case_id "
                . "WHERE c.review_id={$details['id']}";
        $resource   = $this->domainDb->query( $sql );
        $this->caseDetails  = mysql_fetch_assoc( $resource );
//        $this->caseDetails['opened_date'] = $this->changeUTCtoLocal( $this->caseDetails['opened_date'] );
        
        $this->setCurrentUser( $this->caseDetails, $details );
        $this->listing = new Listing( $this->caseDetails['item_id'] );
    }
    
    /**
     * Sets user as listing owner or Reviewer.
     * 
     * @param array $caseDetails
     * @param array $details
     * @throws Exception If user is neither owner or reviewer exception is thrown.
     */
    protected function setCurrentUser( $caseDetails, $details )
    {
        if ( $caseDetails['owner_id'] == $details['account_id'] ) {
            $this->currentUser  = UserType::getUser( 'OwnerModel', $caseDetails['owner_id'] );
            $this->toUser       = UserType::getUser( 'ReviewerModel', $caseDetails['member_id'] );
        }
        else if( $caseDetails['member_id'] == $details['account_id'] ){
            $this->currentUser  = UserType::getUser( 'ReviewerModel', $caseDetails['member_id'] );
            $this->toUser       = UserType::getUser( 'OwnerModel', $caseDetails['owner_id'] );
        }
        else {
            throw new Exception( 'owner / reviewer not matched', 5000 );
        }
    }
    
    public function getCaseDetails()
    {
        return $this->caseDetails;
    }
    
    public function getCaseMessages()
    {
        $sql = "SELECT * FROM Case_Messages "
                . "WHERE case_id='{$this->caseDetails['case_id']}'";
        $resource   = $this->domainDb->query( $sql );
        while( $row = mysql_fetch_assoc( $resource ) ){
            $row['date'] = $row['date'];//$this->changeUTCtoLocal( $row['date'] );
            $this->caseMessages[] = $row;
        }
        return $this->caseMessages;
    }
    
    public function saveNewMessage( $details )
    {
        $date = gmdate( 'Y-m-d h:i:s' );
        $details['date'] = $date;
        
        $this->setCurrentUser( $details, $details );
        $sql = $this->currentUser->getSentMessageSQL( $details );
                
        $this->domainDb->query( $sql );
        return $details;//$this->changeUTCtoLocal( $details );
    }
    
    /**
     * Update that the user has seen the message sent.
     * 
     * @param array $details
     */
    public function updateSeen( $details )
    {
        $date = gmdate( 'Y-m-d h:i:s' );
        $details['date'] = $date;
        
        $this->setCurrentUser( $details, $details );
        $sql = $this->currentUser->getMessageSeenSQL( $details );
        
        $this->domainDb->query( $sql );
    }
    
    /**
     * Change date from UTC / GMT system to local time. ( not used, currently it
     * is done by javascript )
     *  
     * @param type $details
     * @return string
     */
    protected function changeUTCtoLocal( $details )
    {
        if ( is_array($details) ) {
            $time = strtotime( $details['date'].' UTC' );
            $date = format_date( date( 'Y-m-d H:i', $time ), DEFAULT_DATE_FORMAT, 'get_event_datetime' , true );
            $details['date'] = $date['date'] . ' ' . $date['time'] . ' ' . $date['am_pm'];
        }
        else{
            $time = strtotime( $details.' UTC' );
            $date = format_date( date( 'Y-m-d H:i', $time ), DEFAULT_DATE_FORMAT, 'get_event_datetime' , true );
            $details = $date['date'] . ' ' . $date['time'] . ' ' . $date['am_pm'];
            
        }
        
        return $details;
    }
    
    public function loadCaseCloseAgreement( $details )
    {
//        $sql = "SELECT long_description FROM Setting_Case "
//                . "WHERE name='reviewer_t_and_c' AND is_enabled='1'";
//        $resource = $this->domainDb->query( $sql );
//        $this->caseCloseAgreement = mysql_fetch_assoc( $resource );
        
        $this->caseCloseAgreement = $this->setting->reviewer_t_and_c;
        
    }
    public function getCaseCloseAgreement()
    {
        return $this->caseCloseAgreement;
    }
    public function closeCase( $details )
    {
        // update case status in Opened Cases
//        $sql = "UPDATE Opened_Cases "
//                . "SET case_status='C' "
//                . "WHERE case_id='{$details['case']}'";
//        $this->domainDb->query( $sql );
        $case = new Opened_Cases( $details['case'] );
        $case->setString( 'case_status', 'C' );
        $case->save();
        
        // update keep / delete review in review
        $review = new Review( $details['review'] );
        if( stripos($details['closeMethod'], 'keep') ){
            
        }
        else if( stripos($details['closeMethod'], 'delete') ){
            $review->setNumber( 'is_deleted', 1 );
            $review->Save();
        }
    }


    public function getCurrentUser()
    {
        return $this->currentUser;
    }
    
    public function getToUser()
    {
        return $this->toUser;
    }
    public function getListing()
    {
        return $this->listing;
    }
    
    public function getSetting()
    {
        return $this->setting->getSettings();
    }
}