<?php

namespace library\logging;
use library\logging\log;

/**
 * Class logFile
 * @author Vazquez Luis
 * @copyright (c) 2015, Syntesis Management SA
 */
class logFile extends log{
    
    public static $filename;
    
    public static function alert(){
        self::_write(self::ALERT);
    }

    public static function debug(){
        self::_write(self::DEBUG);
    }

    public static function info(){
        self::_write(self::INFO);
    }

    public static function warning(){
        self::_write(self::WARNING);
    }
    
    private static function _write($filename, $msg){
        $handle = fopen($filename, 'a');
        if(!fwrite($handle, $msg)){
            
        }
    }
    
    private static function _createTable(){
        
    }
}
