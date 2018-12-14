<?php
/**
 * Created by PhpStorm.
 * User: serge
 * Date: 18.11.2018
 * Time: 14:57
*/
const arrayDir = ["GameExceptions", "Model"];
const startDir = "app";

spl_autoload_register(function ($class) {

    // project-specific namespace prefix
    $prefix = '';

    // base directory for the namespace prefix
    $base_dir = __DIR__ . '/'.startDir.'/';
    $base_dir ='';

    // does the class use the namespace prefix?
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        // no, move to the next registered autoloader
        return;
    }

    // get the relative class name
    $relative_class = substr($class, $len);

    // replace the namespace prefix with the base directory, replace namespace
    // separators with directory separators in the relative class name, append
    // with .php
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';


    // if the file exists, require it
   // foreach (arrayDir as $elem) {
        if (file_exists($file)) {
            require $file;
            //break;
        }
//        $file = $base_dir.
//            $elem.DIRECTORY_SEPARATOR.str_replace('\\', '/', $relative_class) . '.php';
//        var_dump($file);
//    }

});


//class Autoloader
//{
//    /**
//     * File extension as a string. Defaults to ".php".
//     */
//    protected static $fileExt = '.php';
//    /**
//     * The top level directory where recursion will begin. Defaults to the current
//     * directory.
//     */
//    protected static $pathTop = __DIR__.DIRECTORY_SEPARATOR."app";
//    /**
//     * A placeholder to hold the file iterator so that directory traversal is only
//     * performed once.
//     */
//    protected static $fileIterator = null;
//    /**
//     * Autoload function for registration with spl_autoload_register
//     *
//     * Looks recursively through project directory and loads class files based on
//     * filename match.
//     *
//     * @param string $className
//     */
//    public static function loader($className)
//    {
//        $directory = new RecursiveDirectoryIterator(static::$pathTop, RecursiveDirectoryIterator::SKIP_DOTS);
//        if (is_null(static::$fileIterator)) {
//            static::$fileIterator = new RecursiveIteratorIterator($directory, RecursiveIteratorIterator::LEAVES_ONLY);
//        }
//        $filename = $className . static::$fileExt;
//        foreach (static::$fileIterator as $file) {
//            if (strtolower($file->getFilename()) === strtolower($filename)) {
//                if ($file->isReadable()) {
//                    include_once $file->getPathname();
//                }
//                break;
//            }
//        }
//    }
//    /**
//     * Sets the $fileExt property
//     *
//     * @param string $fileExt The file extension used for class files.  Default is "php".
//     */
//    public static function setFileExt($fileExt)
//    {
//        static::$fileExt = $fileExt;
//    }
//    /**
//     * Sets the $path property
//     *
//     * @param string $path The path representing the top level where recursion should
//     *                     begin. Defaults to the current directory.
//     */
//    public static function setPath($path)
//    {
//        static::$pathTop = $path;
//    }
//}
//Autoloader::setFileExt('.php');
//spl_autoload_register('Autoloader::loader');