<?php
/**
 * @author          Subigya Jyoti Panta
 * @subpackage      Plugins
 * @copyright (c) 2014, www.eooro.com
 * @version         1.0
 * @modification history original
 */
class LogConfig
{
    private static $instance;
    
    /**
     *
     * @var array
     */
    public $config;
    
    private function __construct()
    {
        $path = dirname( __FILE__ );
        $this->config = parse_ini_file( $path . '/config.ini' ); 
        
        $username  = !empty($this->config['username']) ? $this->config['username'] . ':' : '';
        $password  = !empty($this->config['password']) ? $this->config['password'] . '@' : '';
        $address   = $this->getServerAddr( $this->config['hostname'], $this->config['port'] );
        
        if ( empty($username) && empty($password) && empty($address) ) {
            $this->config['server'] = DEMO_DEV_MODE ? '' : 'mongodb://' . $username . $password 
                                                            . $address .'/'. $this->config['database'];
        }
        else{
            $this->config['server'] = 'mongodb://' . $username . $password 
                                    . $address .'/'. $this->config['database'];
        }
        
    }
    private function __clone()
    {}
    
    /**
     * 
     * @return LogConfig
     */
    public static function getInstance()
    {
        if ( !isset(static::$instance) ) {
            static::$instance   = new LogConfig();
        }
        return static::$instance;
    }
    
    /**
     * 
     * @return array
     */
    public function getConfig()
    {
        return $this->config;
    }
    
    protected function getServerAddr( $host, $port )
    {
        $size = count( $host );
        for ( $i=0; $i<$size; $i++ ){
            $portn  = !empty($port[$i]) ? ':'.$port[$i] : '';
            $name[] = $host[$i].$portn;
        }
        $addr   = implode( ',', $name ); 
        return trim( $addr, ',' );
    }
}
