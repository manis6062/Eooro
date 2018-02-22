<?php
/**
 * @author          Subigya Jyoti Panta
 * @subpackage      SagePay
 * @copyright (c) 2014, www.eooro.com
 * @version         1.0
 * @modification history original
 */
defined( 'SJP' ) or die;

abstract class Sagefactory
{
    /**
     * Returns sagepay application object
     * 
     * @return \Application
     */
    public static function getApplication()
    {
        return Application::getInstance();
    }

    /**
     * Converts Given array to Xml document.
     * 
     * @param array $array
     * @param string $wrapper
     * @return \ArrayToXml
     */
    public static function getArrayToXml( $array, $wrapper )
    {
        return new ArrayToXml( $array, $wrapper);
    }
    
    /**
     * Returns mediator object. It is used to handle events and 
     * communicate with edirectory.
     * 
     * @return \Mediator
     */
    public static function getMediator()
    {
        return Mediator::getInstance();
    }
    
    /**
     * Returns ServerConfig Object. It contains all the configuration to
     * communicate to SagePay server.
     * 
     * @param string $connection_type should be TEST, LIVE or SIMULATOR
     * @return \ServerConfig
     */
    public static function getServerConfig($connection_type)
    {
        return ServerConfig::getInstance($connection_type);
    }
    
    /**
     * Returns a Cryptor Object. Cryptor is a class that performs 128-bit 
     * AES encryption and decryption.
     * 
     * @staticvar Cryptor $cryptor
     * @return \Cryptor
     */
    public static function getCryptor()
    {
        static $cryptor;
        if ( !isset($cryptor) ) {
            $cryptor = new Cryptor();
        }
        return $cryptor;
    }
    
    /**
     * Returns a model if in any application 2 or more model is required.
     * 
     * @staticvar array $modelRegister
     * @param string $modelname
     * @return \basemodel
     */
    public static function getModel( $modelname )
    {
        static $modelRegister = array();
        try{
            if ( !isset($modelRegister[$modelname]) ) {
                $model = new $modelname();
                $modelRegister[ $modelname ] = $model;   
            }
            return $modelRegister[ $modelname ];
        }
        catch ( Exception $ex ){
            // @todo 
            echo 'Model not available. '. $ex->getMessage();
        }
    }
    
    /**
     * Returns an Inflector class.
     * 
     * @staticvar Inflector $instance
     * @return \Inflector
     */
    public static function getInflector()
    {
        static $instance;
        if ( !isset($instance) ) {
            $instance  = new Inflector();
        }
        return $instance;
    }
    
    /**
     * Returns class with CountryCodes.
     * 
     * @staticvar CountryCodes $instance
     * @return \CountryCodes
     */
    public static function getCountryCodes()
    {
        static $instance;
        if ( !isset($instance) ) {
            $instance = new CountryCodes();
        }
        return $instance;
    }
    
    /**
     * 
     * @param type $type
     * @return \DefaultTransactionLogger|\CaseTransactionLogger
     */
    public static function getLogger( $type = 'default' )
    {
        switch ($type) {
            case 'Opened_Cases':
                    return new CaseTransactionLogger();
                break;

            default:
                    return new DefaultTransactionLogger();
                break;
        }
    }
}
