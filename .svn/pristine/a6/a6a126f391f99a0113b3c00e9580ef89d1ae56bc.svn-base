<?php

class LoggablePDOStatement
{
    /**
     *
     * @var PDOStatement 
     */
    private $stmt;
    
    public function __construct(PDOStatement $stmt) {
        $this->stmt = $stmt;
    }
    
    public function execute($options = null)
    {
        $time_start = microtime(true); 
        $result =  $this->stmt->execute($options);
        $time_end = microtime(true);
        $time = $time_end - $time_start;
        
        $this->logSQL($time);
        return $result;
    }

    protected function logSQL($time)
    {
        // write to database
        DBQuery::execute(function() use ($time){
            $mainTable = DBConnection::getInstance()->getMainWithoutLogger();
            
            if (string_strpos($query, "INSERT") !== false) {
                $type = "Insert";
                $log = true;
            } else if (string_strpos($query, "UPDATE") !== false) {
                $type = "Update";
                $log = true;
            } else if (string_strpos($query, "DELETE") !== false) {
                $type = "Delete";
                $log = true;
            } else {
                $type = "Select";
                $log = true;
            }
            $ip = $_SERVER["REMOTE_ADDR"];
            $page = $_SERVER["PHP_SELF"];
            if ($_SESSION["SM_LOGGEDIN"]) {
                $session = "sitemgr";
            } elseif ($_SESSION["SESS_ACCOUNT_ID"]) {
                $session = "account_id = ".$_SESSION["SESS_ACCOUNT_ID"];
            }else{
                $session = 'empty';
            }
            
            $sql = "INSERT INTO SQL_Log (`sql`, `type`, `date`, `time`, `ip`, `page`, `session`, `execution_time`)
                            VALUES (:query, :type, CURDATE(), CURTIME(), :ip, :page, :session, :exe_time )";
            $stmt = $mainTable->prepare($sql);
            $stmt->execute(array(
                ':query'    => $this->stmt->queryString,
                ':type'     => $type,
                ':ip'       => $ip,
                ':page'     => $page,
                ':session'  => $session,
                ':exe_time' => $time
            ));
        });
    }
    
    public function bindParam($parameter, &$variable, $data_type=PDO::PARAM_STR, $length = null, $driver_options = null)
    {
        return $this->stmt->bindParam($parameter, $variable, $data_type, $length, $driver_options);
    }
    
    public function __call($name, $arguments) {
        return call_user_func_array(array($this->stmt, $name), $arguments);
    }
}