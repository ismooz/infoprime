<?php

namespace library;

class registry {
    
    /**
     *
     * @var type 
     */
    private static $_instance = null;
    
    /**
     *
     * @var type 
     */
    private static $_objects = array();
    
    /**
     *
     * @var type 
     */
    private static $_settings = array();
    
    /**
     * Constructor
     * @access privavte
     */
    private function __construct(){}
    
    /**
     * getInstance() - Singelton
     * @return object registry
     */
    public static function getInstance(){
        if(is_null(self::$_instance)){
            self::$_instance = new self;
        }
        return self::$_instance;
    }
    
    public static function get(){
        
    }
    
    public static function set(){
        
    }
}
