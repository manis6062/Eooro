<?php

class DBQuery
{
    public static function execute(\Closure $run)
    {
        try{
            return $run();
        }
        catch (\PDOException $ex){
            echo "Oops!! I am embarrased. System Administrator has been notified and this problem will be solved as soon as possible. We are sorry for the inconvenience.<br/>";
            self::logToFile("\n".$ex->getMessage()."\n\n".$ex->getTraceAsString()."\n\n");
        }
    }
    
    protected static function logToFile( $message )
    {
        $filename   = EDIRECTORY_ROOT .'/custom/log/dblog-'. gmdate( 'Ymd' ) .'.txt';
        $handle = fopen( $filename, "a+" );
        fwrite($handle, $message );
        fclose( $handle );
    }
    
    protected static function sendEmail( $message )
    {
        
    }
}

