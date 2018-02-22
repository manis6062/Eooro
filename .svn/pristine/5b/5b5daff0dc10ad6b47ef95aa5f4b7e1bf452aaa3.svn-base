<?php
require CLASSES_DIR.'/class_LoggablePDOStatement.php';

class LoggablePDO 
{
    /**
     *
     * @var \PDO 
     */
    private $pdo;
    
    public function __construct(\PDO $pdo) 
    {
        $this->pdo = $pdo;
    }
    
    public function prepare($statement, $options = array())
    {
        $stmt = $this->pdo->prepare($statement, $options); 
        return new LoggablePDOStatement($stmt);
    }
    
    public function __call($name, $arguments) {
        call_user_func_array(array($this->pdo, $name), $arguments);
    }
}

