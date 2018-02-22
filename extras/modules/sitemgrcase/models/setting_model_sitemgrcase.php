<?php
/**
 * @author          Subigya Jyoti Panta
 * @subpackage      Modules / sitemgrcase - setting
 * @copyright (c) 2014, www.eooro.com
 * @version         1.0
 * @modification history original
 */
include_once(BASE_MODEL);

class Setting_Model_Sitemgrcase extends BaseModel
{
    protected $settings;
    
    public function loadSettings()
    {
        $sql = "SELECT name, value, short_description, long_description FROM Setting_Case "
                . "WHERE is_enabled=1";
        
        $resource = $this->domainDb->query( $sql );
        while( $row = mysql_fetch_assoc($resource) ){
            $this->settings[] = $row;
        }
        $this->settings = $this->makeReadable( $this->settings, 'name' );
    }
    
    protected function makeReadable( $settings, $column )
    {
        $newSettings = array();
        foreach( $settings as $setting ){
            foreach( $setting as $key => $value ){
                
                $newSettings[$setting[$column]][$key] = $value;
//                $newSettings[$column] = 
            }
        }
        return $newSettings;
    }
    
    public function updateSettings( $details )
    {
        $this->loadSettings();
        $sqls = array();
        $fieldNames = array( 'name', 'value', 'short_description', 'long_description', 'is_enabled', 'updated_date' );
        
        if ( $this->settings['price']['value'] != $details['price'] ) {
            if ( $details['price'] ) {
                $this->settings['price']['value'] = $details['price'];
                $sqls[] = $this->generateSQL( 'price' );
                $sqls[] = $this->generateSQL( 'price', false );
            }
        }
        if ( $this->settings['duration']['value'] != $details['duration'] ) {
            if( $details['duration'] ){
                $this->settings['duration']['value'] = $details['price'];
                $sqls[] = $this->generateSQL( 'duration' );
                $sqls[] = $this->generateSQL( 'duration', false );
            }
        }
        if ( $this->settings['sponsor_t_and_c']['long_description'] != $details['sponsor-terms'] ) {
            if( $details['sponsor-terms'] ){
                $this->settings['sponsor_t_and_c']['long_description'] = $details['sponsor-terms'];
                $sqls[] = $this->generateSQL( 'sponsor_t_and_c' );
                $sqls[] = $this->generateSQL( 'sponsor_t_and_c', false );
            }
        }
        if ( $this->settings['reviewer_t_and_c']['long_description'] != $details['reviewer-terms'] ) {
            if( $details['reviewer-terms'] ){
                $this->settings['reviewer_t_and_c']['long_description'] = $details['reviewer-terms'];
                $sqls[] = $this->generateSQL( 'reviewer_t_and_c' );
                $sqls[] = $this->generateSQL( 'reviewer_t_and_c', false );
            }
        }
        if ( $this->settings['resolution_type_user_k']['short_description'] != $details['user-keep-short']  || $this->settings['resolution_type_user_k']['long_description'] != $details['user-keep-long'] ) {
            if( $details['user-keep-short'] || $details['user-keep-long'] ){
                $this->settings['resolution_type_user_k']['short_description'] = $details['user-keep-short']; 
                $this->settings['resolution_type_user_k']['long_description'] = $details['user-keep-long'];
                $sqls[] = $this->generateSQL( 'resolution_type_user_k' );
                $sqls[] = $this->generateSQL( 'resolution_type_user_k', false );
            }
        }
        if ( $this->settings['resolution_type_user_d']['short_description'] != $details['user-delete-short']  || $this->settings['resolution_type_user_k']['long_description'] != $details['user-delete-long'] ) {
            if( $details['user-delete-short'] || $details['user-delete-long'] ){
                $this->settings['resolution_type_user_d']['short_description'] = $details['user-delete-short']; 
                $this->settings['resolution_type_user_d']['long_description'] = $details['user-delete-long'];
                $sqls[] = $this->generateSQL( 'resolution_type_user_d' );
                $sqls[] = $this->generateSQL( 'resolution_type_user_d', false );
            }
        }
        $this->runSQL( $sqls );
    }
    
    protected function generateSQL( $settingKey1, $update = true )
    {
        $fieldNames = array( 'name', 'value', 'short_description', 'long_description', 'is_enabled', 'updated_date' );
        $date = gmdate('Y-m-d h:i:s');
        if( $update ){
            $query  = "UPDATE Setting_Case SET is_enabled='0' WHERE name='$settingKey1' AND is_enabled=1";
        }
        else {
            $query  = "INSERT INTO Setting_Case (".implode(',', $fieldNames).") VALUES ('".implode("','", $this->settings[$settingKey1])."', '1', '".$date."')"; 
        }
        return $query;
    }
    
    protected function runSQL( $sqls )
    {
        foreach( $sqls as $sql ){
            $this->domainDb->query( $sql );
        }
    }
    
    public function getSettings()
    {
        return $this->settings;
    }
}