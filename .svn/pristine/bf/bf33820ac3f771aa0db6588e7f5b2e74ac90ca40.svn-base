<?php
/**
 * 
 */

class HtmlCleaner
{
    public static function CleanBasic( $input )
    {
        if(is_array($input)){
            return array_map(array(__CLASS__, 'CleanBasic'), $input);
        }
        return htmlentities($input);
    }
}
