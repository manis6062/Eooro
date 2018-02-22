<?php
/**
 * @author          Subigya Jyoti Panta
 * @subpackage      Modules
 * @copyright (c) 2014, www.eooro.com
 * @version         1.0
 * @modification history original
 */
defined( 'SJP' ) or die;

class BaseView
{
    protected $controller;
    
    protected $model;
    
    protected $layoutPath;
    
    protected $layoutDir;
    
    protected $overideDir;
    
    function __construct( $controller, $model )
    {
        $this->controller   = $controller;
        $this->model        = $model;
        
        $viewname   = explode( '_', strtolower(get_class($this)) );
        $this->overideDir   = THEMEFILE_DIR.DIRECTORY_SEPARATOR.EDIR_THEME.DIRECTORY_SEPARATOR
                            .'modules'.DIRECTORY_SEPARATOR.$viewname[0].DIRECTORY_SEPARATOR;
        
        $this->layoutDir    = MODULES_DIR.DIRECTORY_SEPARATOR.end($viewname).DIRECTORY_SEPARATOR.'views'
                    .DIRECTORY_SEPARATOR.$viewname[0].DIRECTORY_SEPARATOR.'tmpl';
    }
    
    protected function get( $methodName, $model = false )
    {
        $method = 'get' . ucfirst( $methodName );
        if ( $model ) {
            $data   = $model->$method();
        }
        else{
            $data   = $this->model->$method();
        }
        return $data;
    }
    
    public final function setLayoutPath( $path )
    {
        $this->layoutPath = $this->getOverrideFile( $path );
    }
    
    public function display()
    {
        if ( !$this->layoutPath ) {
            $this->setLayoutPath( 'default.php' );
        }
        include_once $this->getLayoutPath();
    }
    
    private function getOverrideFile( $file )
    {
        $overrideFile = $this->overideDir . DIRECTORY_SEPARATOR . $file;
        if ( file_exists($overrideFile) ) {
            return $overrideFile;
        }
        else {
            return $this->layoutDir.DIRECTORY_SEPARATOR.$file;
        }
    }
    
    protected final function getLayoutPath( $parts = null )
    {
        if ( $parts ){
            $newFile = preg_replace( '/([\w])\.php/', '${1}_'.$parts.'.php', $this->layoutPath );
            return $newFile;
        }
        else{
            return $this->layoutPath;
        }
    }
}
