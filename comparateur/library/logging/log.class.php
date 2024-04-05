<?php

namespace library\logging;

/**
 * Abstract class log
 * @abstract
 * @author Vazquez Luis
 * @copyright (c) 2015, Syntesis Management SA
 */
abstract class log{
    
    const WARNING   = 1;
    const ALERT     = 2;
    const INFO      = 3;
    const DEBUG     = 4;

    /**
     * alert() - Ajoute un log de niveau alert
     * @abstract
     * @access protected
     * @param string $msg - Mesage d'alerte
     * @return void
     */     
    abstract public static function alert($msg);
    
    /**
     * debug() - Ajoute un log de niveau debug 
     * @abstract
     * @access protected
     * @param string $msg - Message de debug
     * @return void
     */     
    abstract public static function debug($msg);
    
    /**
     * info() - Ajoute un log de niveau info
     * @abstract
     * @access protected
     * @param string $msg - Message d'information
     * @return void
     */     
    abstract public static function info($msg);
    
    /**
     * warning() - Ajoute un log de niveau warning
     * @abstract
     * @access protected
     * @param string $msg - Message de warning
     * @return void
     */     
    abstract public static function warning($msg);
}