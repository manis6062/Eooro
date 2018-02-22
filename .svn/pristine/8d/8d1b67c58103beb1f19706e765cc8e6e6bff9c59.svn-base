<?php
/**
 * @author          Subigya Jyoti Panta
 * @subpackage      Modules
 * @copyright (c) 2014, www.eooro.com
 * @version         1.0
 * @modification history original
 */
class DocumentLoader
{
    protected $templateOutput;
    
    protected $moduleOutput;
    
    protected $template;
    
    function render( $module, $controller, $action = null, $details = null )
    {
        ob_start();
        include_once $this->template;
        $this->templateOutput = ob_get_contents();
        ob_end_clean();
        
        $app = ModFactory::getApplication();
        ob_start();
        $app->setOptions( $module, $controller, $action, $details )->run();
        $this->moduleOutput = ob_get_contents();
        ob_end_clean();
        
        echo preg_replace( '/<\s*application\s+type="(\w+)"\s*\/>/', $this->moduleOutput, $this->templateOutput );
    }

    /**
     * 
     * @param string $template
     */
    function setTemplate( $template )
    {
        $this->template = TEMPLATE_DIR.DIRECTORY_SEPARATOR.$template
                            .DIRECTORY_SEPARATOR.'index.php';
    }
    
}