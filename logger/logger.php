<?php
/**
 * @author          Subigya Jyoti Panta
 * @subpackage      Plugins
 * @copyright (c) 2014, www.eooro.com
 * @version         1.0
 * @modification history original
 */

abstract class Logger
{
    /**
     *
     * @var SLog
     */
    protected $log;
    
    /**
     * 
     * @return SLog
     */
    public function getLog()
    {
        return $this->log;
    }
    
    /**
     * 
     * @param SLog $log
     * @return \Logger
     */
    public function setLog( SLog $log )
    {
        $this->log  = $log;
        return $this;
    }
    
    abstract public function writeLog( SLog $log );
}