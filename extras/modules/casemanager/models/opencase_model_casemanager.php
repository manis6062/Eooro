<?php
/**
 * @author          Subigya Jyoti Panta
 * @subpackage      Modules
 * @copyright (c) 2014, www.eooro.com
 * @version         1.0
 * @modification history original
 */
include_once(BASE_MODEL);

class Opencase_Model_Casemanager extends BaseModel
{
    /**
     * It is true of false depending if case details is successfully saved or not.
     * 
     * @var boolean 
     */
    protected $savedDetails;
    
    protected $response;
    
    protected $verified;
    
    public function verifyCase( $details )
    {
        $sql = "SELECT COUNT(*) AS count FROM Opened_Cases WHERE review_id={$details['review_id']}";
        $resource = $this->domainDb->query( $sql );
        
        $row = mysql_fetch_assoc( $resource );
        $this->verified = $row['count'] ? false : true;
        
        return $this->verified;
    }
    
    public function saveCaseDetails( $details )
    {
        // save to Opened_Cases
        $details[ 'opened_date' ] = $details[ 'last_communication_on' ] = gmdate( 'Y-m-d h:i:s' );
        $details[ 'case_status' ] = 'I';
        $columnNames = array('owner_id', 'review_id', 'listing_id','review_comment', 'opened_date', 'case_status', 'last_communication_on' );
                
        foreach( $columnNames as $column ){
            $fieldValues[] = "'".$details[ $column ]."'";
        }
        $sql = "INSERT INTO Opened_Cases (".implode(',', $columnNames).") "
                . "VALUES (".implode(',', $fieldValues).")";
        
        $this->savedDetails = $this->domainDb->query( $sql ); 
        
        // Get recently saved case id
        $sql = "SELECT case_id FROM Opened_Cases WHERE owner_id='{$details['owner_id']}' "
                ."AND review_id='{$details['review_id']}'";
        $resource = $this->domainDb->query( $sql );
        $row    = mysql_fetch_assoc( $resource );
        
        // save to Case_Messages
        $sql = "INSERT INTO Case_Messages (case_id, from_user, to_user, message, date )"
                . "VALUES ('{$row['case_id']}', '{$details['owner_id']}', '{$details['reviewer_id']}'"
                . ", '{$details['case_reason']}', '{$details['opened_date']}')";
        $this->domainDb->query( $sql );
    }
    
    public function getCaseDetails()
    {
        if ( $this->savedDetails ) {
//            return 
        }
    }
    
    public function getResponse()
    {
        $this->response['status'] = $this->verified;
        $this->response['text'] = $this->verified ? '<font color=green>Case Registered Successfully.</font>' : 'Case is Already Registered !!';
    
        return $this->response;
    }
     
    public function sendEmail()
    {
        
    }
    
    public function getSettings()
    {
        $setting = new CaseSettings();
        return $setting->getSettings();
    }
}
