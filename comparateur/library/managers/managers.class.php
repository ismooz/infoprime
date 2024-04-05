<?php

namespace library\managers;

/**
 * Class manager
 * @author Vazquez Luis
 * @copyright (c) 2015, Syntesis Management SA
 */
class managers extends manager {
    
    /**
     * @access protected
     * @var type 
     */
    protected $_api = NULL;

    /**
     * @access protected
     * @var type 
     */
    protected $_managers = array();
    
    /**
     * Constructor
     * @param type $api
     * @param type $dao
     */
    public function __construct($api, $dao) {
        parent::__construct($dao);
        $this->_api = $api;
    }
    
    /**
     * getManager() -
     * @param type $module
     * @return type
     * @throws \InvalidArgumentException
     */
    public function getManagerOf($module){
        if (!is_string($module) || empty($module)){
            throw new \InvalidArgumentException('Le module spécifié est invalide');
        }
        if (!isset($this->_managers[$module])){
            $manager = '\\library\\models\\' . $module . 'Manager_' . $this->_api;
            $this->_managers[$module] = new $manager($this->_api, $this->_dao);
        }
        return $this->_managers[$module];
    }
}