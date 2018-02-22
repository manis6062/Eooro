<?php
/**
 * @author          Subigya Jyoti Panta
 * @subpackage      SagePay
 * @copyright (c) 2014, www.eooro.com
 * @version         1.0
 * @modification history original
 */
defined( 'SJP' ) or die;

class PaymentSettings_Model extends BaseModel
{
    /**
     * Returns Username as set in the settings.
     * 
     * @return string
     */
    public function getUsername()
    {
        if( !isset($this->username) ){
            $this->bindSettings();
        }
        return $this->username;
    }
    
    /**
     * Returns Password as set in the settings.
     * 
     * @return string
     */
    public function getPassword()
    {
        if( !isset($this->password) ){
            $this->bindSettings();
        }
        return $this->password;
    }
    
    /**
     * Returns Vendor name as set in the settings.
     * 
     * @return string
     */
    public function getVendor()
    {
        if( !isset($this->vendor) ){
            $this->bindSettings();
        }
        return $this->vendor;
    }
    
    /**
     * Returns Status of SagePay as set in the settings.
     * 
     * @return string
     */
    public function getActivationStatus()
    {
        if( !isset($this->activation) ){
            $this->bindSettings();
        }
        return $this->activation;
    }
    
    /**
     * Returns integration type: direct / form.
     * 
     * @return String
     */
    public function getIntegrationType()
    {
        if( !isset($this->integrationtype) ){
            $this->bindSettings();
        }
        return trim($this->integrationtype);
    }
    
    /**
     * Set SagePay settings in database according to user input.
     * 
     * @param array $input
     */
    public function setSettings( $input )
    {
        if ( $input['sagepay_activation'] === 'on' ) {
            $sql = 'UPDATE `Setting_Payment` SET `value` = CASE ';
        
            foreach ( $input as $key => $value ){
                $newKey = strtoupper( $key );
                $sql    .= ' WHEN  name="'.$newKey.'" THEN "'.$value.'"';
            }
            $sql .= ' END ';
        }
        elseif ( $input['sagepay_activation'] === 'off' ) {
            $sql    = 'UPDATE `Setting_Payment` SET `value`="off" WHERE `name`="SAGEPAY_ACTIVATION" ';
        }
        
        $result = $this->domainDb->query( $sql );
    }
    
    /**
     * To bind settings from database to corresponding class properties.
     */
    protected function bindSettings()
    {
        $sql    = 'SELECT * FROM Setting_Payment WHERE name LIKE "SAGEPAY_%"';
        $result = $this->domainDb->query( $sql );
        
        while ( $row = mysql_fetch_assoc($result) ){
            preg_match( '#SAGEPAY_([A-Z]*)#', $row['name'], $matches );
            $property = strtolower( $matches[1] );
            
            $this->$property = $row['value'];
        }
    }
}
