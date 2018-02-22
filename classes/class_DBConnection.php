<?php
if (QUERY_LOG_DB) {
    require_once CLASSES_DIR.'/class_LoggablePDO.php';
}

class DBConnection
{
    /**
     *
     * @var MyPDO
     */
    private $domain;
    private $domainDatabaseName;
    /**
     *
     * @var MyPDO
     */
    private $main;
    private $mainDatabaseName;
    /**
     * Main logger should not be loggable else it will recurse infinitely
     * 
     * @var \PDO 
     */
    private $mainWithoutLogger;
    
    
    private function __construct() 
    {
        
    }
    
    /**
     * Get Database Connection object wrapper
     * @staticvar DBConnection $instance
     * @return \DBConnection
     */
    public static function getInstance()
    {
        static $instance;
        if( !isset($instance) ){
            $instance = new self();
        }
        return $instance;
    }
    
    /**
     * PDO instance related to domain database
     * 
     * @return \PDO
     */
    public function getDomain()
    {
        if( !isset($this->domain) ){
            $main = $this->getMainWithoutLogger();
            $params = $this->getDomainParameters($main);
            $this->domain = $this->getConnectionToDatabase($params);
        }
        return $this->domain;
    }
    public function getDomainDatabaseName()
    {
        return $this->domainDatabaseName;
    }
    /**
     * PDO instance related with main database.
     * If Database Query logging is enabled, it returns LoggablePDO 
     * (PDO with added functionality of logging statements)
     * 
     * @return \PDO
     */
    public function getMain()
    {
        if( !isset($this->main) ){
            $connectionParams = $this->getMainParameters(DEFAULT_DB);
            $this->main = $this->getConnectionToDatabase($connectionParams);
        }
        return $this->main;
    }
    public function getMainDatabaseName()
    {
        return $this->mainDatabaseName;
    }
    
    public function getMainWithoutLogger()
    {
        if( !isset($this->mainWithoutLogger) ){
            $connectionParams = $this->getMainParameters(DEFAULT_DB);
            $this->mainWithoutLogger = $this->getConnectionToDatabase($connectionParams, true);
        }
        return $this->mainWithoutLogger;
    }
    
    private function getMainParameters($key)
    {
	$params = new \stdClass();
        $params->db_key	= $key;
        $params->db_host  = constant("_".$key."_HOST");
        $params->db_user  = constant("_".$key."_USER");
        $params->db_pass  = constant("_".$key."_PASS");
        $params->db_name  = $this->mainDatabaseName = constant("_".$key."_NAME");
        $params->db_email = constant("_".$key."_EMAIL");
        $params->db_debug = constant("_".$key."_DEBUG");
        $params->mysql_error = false;
        $params->options = array(
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
                \PDO::ATTR_EMULATE_PREPARES => false,
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"
        );
        
        return $params;
    }
    
    private function getDomainParameters(\PDO $main)
    {
        try{
            $sql = "SELECT database_host as db_host, "
                        . "database_port as port, "
                        . "database_username as db_user, "
                        . "database_password as db_pass, "
                        . "database_name as db_name "
                    . "FROM Domain "
                    . "WHERE id = :id "
                    . "AND `status` = :status";
            $stmt = $main->prepare($sql);
//            $stmt->bindValue(':url', str_replace("www.","",$_SERVER["HTTP_HOST"]));
            $stmt->bindValue(':id', '1');
            $stmt->bindValue(':status', 'A');
            $stmt->execute();

            $result = $stmt->fetchObject();
            $params = clone $result;
            $params->mysql_error = false;
            $params->options = array(
                    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                    \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
                    \PDO::ATTR_EMULATE_PREPARES => false,
                    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"
            );
            $this->domainDatabaseName = $params->db_name;
            return $params;
        }
        catch(PDOException $e){
            
            echo "Error!: " . $e->getMessage() . "<br/>";
            logToFile("Error!: " . $e->getMessage());
            die();
        }
    }
    
    protected function getConnectionToDatabase($params, $logger = false)
    {
        
        try {
            $db = new MyPDO('mysql:host='.$params->db_host.';dbname='.$params->db_name, 
                            $params->db_user, 
                            $params->db_pass, 
                            $params->options);
            
            // to log query but not log sqls while logging ( to avoid infinite recursion )
            if (QUERY_LOG_DB && !$logger) {
                $loggableDb = new LoggablePDO($db);
                return $loggableDb;
            }
            return $db;
        } 
        catch (\PDOException $e) {
            echo "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }
    protected static function logToFile( $message )
    {
        $filename   = EDIRECTORY_ROOT .'/custom/log/dblog-'. gmdate( 'Ymd' ) .'.txt';
        $handle = fopen( $filename, "a+" );
        fwrite($handle, $message );
        fclose( $handle );
    }

}