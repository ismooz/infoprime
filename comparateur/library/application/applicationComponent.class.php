<?php

namespace library\application;

/**
 * Abstact Class ApplicationComponent
 * @abstract
 * @author Vazquez Luis
 * @copyright (c) 2015, Syntesis Management SA
 */
abstract class applicationComponent {
    
    /**
     * @access protected
     * @var type 
     */
    protected $_application;
    
    /**
     * @access public
     * @param \Library\Application\application $application
     */
    public function __construct(application $application) {
        $this->_application = $application;
    }
    
    /**
     * @access public
     * @return type
     */
    public function getApplication(){
        return $this->_application;
    }
}