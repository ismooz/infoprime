<?php

namespace library;

/**
 * Class maxLengthValidator
 * @author Vazquez Luis
 * @copyright (c) 2015, Syntesis Management SA
 */
class maxLengthValidator extends validator {
    
    /**
     * @access protected
     * @var type 
     */
    protected $_maxlength;
    
    /**
     * Constructor
     * @param type $errorMessage
     */
    public function __construct($errorMessage, $maxLength) {
        parent::__construct($errorMessage);
        $this->setMaxLength($maxLength);
    }
    
    /**
     * getMaxLength() -
     * @access public
     * @return type
     */
    public function getMaxLength(){
        return $this->_maxlength;
    }
    
    /**
     * isValid() -
     * @access public
     * @param type $value
     * @return type
     */
    public function isValid($value){
        if(empty($value)){
            throw new \InvalidArgumentException('This method ' . __METHOD__ . ' cannot accept empty parameter.');
        }
        return strlen($value) <= $this->_maxlength;
    }
    
    /**
     * setMaxLength() -
     * @access public
     * @param type $maxlength
     * @throws \InvalidArgumentException
     */
    public function setMaxLength($maxlength){
        if(empty($maxlength)){
            throw new \InvalidArgumentException('This method ' . __METHOD__ . ' cannot accept empty parameter.');
        } elseif(!is_integer($maxlength)){
            throw new \InvalidArgumentException('This method ' . __METHOD__ . ' only accept integer parameter.');
        } elseif($maxlength <= 0){
            throw new \InvalidArgumentException('This method ' . __METHOD__ . ' only accept unsigned integer.');            
        }
        $this->_maxlength = $maxlength;
    }
}
