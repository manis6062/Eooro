<?php

/** 
 * @Author		Subigya Jyoti Panta
 * @Copyright		All rights reserved by the author
 * @Description	Autoload application dependencies
 * 
 *      TO work with this class, you'll need to define "ROOTDIR", then 
 *      simply include the file.
 */
defined( 'SJP' ) or die( 'Restricted Access' );

class Autoloader
{    
    protected static $dirpaths = null;
    
    protected static $rootDir = null;
    
    public static function my_autoloader( $class )
    {
        $filename = strtolower($class) .'.php';
        if ( self::fileIncluded($filename) ) {
            return;
        }
        else {
//            throw new Exception($class.' not found!');
        }
    }

    public static function fileIncluded( $filename )
    {
        if ( static::$dirpaths == null ) {
            static::$dirpaths   = self::getDirectories();
        }
        foreach ( static::$dirpaths as $directories) {
            $path   = $directories. '/'. $filename;
            if ( file_exists($path) ) {
                include $path;
                return true;
            }
        }
        return false;
    }
    
    public static function getDirectories()
    {
        $directory = self::getRootDir();
        $fileSPLObjects =  new RecursiveIteratorIterator(
                        new RecursiveDirectoryIterator($directory),
                        RecursiveIteratorIterator::CHILD_FIRST
                    );
        try {
            foreach( $fileSPLObjects as $fullFileName => $fileSPLObject ) {
                $exploded   = explode('/', $fullFileName);
                $end        = end($exploded);
                if ( $end !== '.' && $end !== '..' ) {
                    if ( is_dir($fullFileName) )  {
                        $directories[] = $fullFileName;
                        //echo $fullFileName . '<br/><br/>';
                    }
                }       
            }
        }
        catch (UnexpectedValueException $e) {
            printf("Directory [%s] contained a directory we can not recurse into", $directory);
        }
        $directories[] = $directory;
        
        // to autoload event plugins
        $directories[] = EDIRECTORY_ROOT . '/fireevent';
        $directories[] = EDIRECTORY_ROOT . '/fireevent/basefiles';
        $directories[] = EDIRECTORY_ROOT . '/fireevent/plugins';
        $directories[] = EDIRECTORY_ROOT . '/fireevent/events';
        $directories[] = EDIRECTORY_ROOT . '/logger';
        $directories[] = EDIRECTORY_ROOT . '/lucene';
        $directories[] = EDIRECTORY_ROOT . DIRECTORY_SEPARATOR . 'extras';
        
        $directories[] = EDIRECTORY_ROOT . DIRECTORY_SEPARATOR . 'extras'. DIRECTORY_SEPARATOR .'core';
        return $directories;
    }
    
    public static function getRootDir()
    {
        if ( self::$rootDir ) {
            return self::$rootDir;
        }
        else {
            return ROOT_DIR;
        }
    }
    
    public static function setRootDir( $path = null )
    {
        self::$rootDir = $path;
    }
}
spl_autoload_register( 'Autoloader::my_autoloader' );