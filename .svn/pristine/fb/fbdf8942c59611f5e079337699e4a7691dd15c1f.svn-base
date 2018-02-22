<?php
/**
 * @author          Subigya Jyoti Panta
 * @subpackage      Modules
 * @copyright (c) 2014, www.eooro.com
 * @version         1.0
 * @modification history original
 */
class CaseSettings extends Handle
{
    protected $status;
    
    protected $settings;


    public function __construct()
    {
        $db = $this->getDb();
        
        $sql = "SELECT name, value, short_description, long_description "
                . "FROM Setting_Case "
                . "WHERE name LIKE '%status%'";
        $resource = $db->query( $sql );
        while( $row = mysql_fetch_assoc($resource) ){
            $this->status[$row['value']] = $row['short_description'];
        }
        $this->loadCaseSettings();
    }
    
    protected function loadCaseSettings()
    {
        $db = $this->getDb();
        $sql = "SELECT name, value, short_description, long_description FROM Setting_Case WHERE is_enabled=1";
        
        $resource = $db->query( $sql );
        while( $row = mysql_fetch_assoc($resource) ){
            $this->settings[$row['name']] = $row;
        }
    }
    
    public function getSettings()
    {
        return $this->settings;
    }
    
    public function getStatus()
    {
        return $this->status;
    }
    
    public function __get($name)
    {
        return $this->settings[$name];
    }
}