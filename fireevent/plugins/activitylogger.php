<?php
/**
 * @author          Subigya Jyoti Panta
 * @subpackage      Plugins
 * @copyright (c) 2014, www.eooro.com
 * @version         1.0
 * @modification history original
 */

class ActivityLogger
{
    public function onUserNavigation()
    {   
        $log    = new UserLog();
        
        try{
            $logConfig  = LogConfig::getInstance()->getConfig();
            $logger     = new MongoDbLogger( 'userlogs', $logConfig['database'], $logConfig['server'] );

            $logger->writeLog( $log->createLog() );
//            throw new Exception( 'mongo' );
        } 
        catch (Exception $ex) {
//            echo $ex->getMessage();
            $logger     = new csvLogger();
            
            $logger->writeLog( $log->createLog() );
        }
    }
}
