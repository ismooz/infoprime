<?php

namespace library;

/**
 * Abstract class validator
 * @abstract
 * @author Vazquez Luis
 * @copyright (c) 2015, Syntesis Management SA
 */
abstract class validator {
    
    /**
     * @access protected
     * @var type 
     */
    protected $_errorMessage;
    
    /**
     * Constructor
     * @param type $errorMessage
     */
    public function __construct($errorMessage) {
        $this->setErroMessage($errorMessage);
    }
    
    /**
     * getErrorMessage() -
     * @access public
     * @return type
     */
    public function getErrorMessage(){
        return $this->_errorMessage;
    }
    
    /**
     * setErrorMessage() -
     * @access public
     * @param type $errorMessage
     * @throws \InvalidArgumentException
     */
    public function setErroMessage($errorMessage){
        if(!is_string($errorMessage)){
            throw new \InvalidArgumentException('This method ' . __METHOD__ . ' only accept string parameter');
        }
        $this->_errorMessage = $errorMessage;
    }
    
    /**
     * isValid() -
     * @access public
     */
    abstract public function isValid($value);
}

