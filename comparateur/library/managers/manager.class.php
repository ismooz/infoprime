<?php

namespace library\managers;

/**
 * Abstract class manager
 * @author Vazquez Luis
 * @copyright (c) 2015, Syntesis Management SA
 */
abstract class manager {
    
    /**
     * @access protected
     * @var object - 
     */
    protected $_dao;
    
    /**
     * Constructor
     * @param type $dao
     */
    public function __construct($dao) {
        $this->_dao = $dao;
    }
}