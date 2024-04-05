<?php

namespace library\forms;

/**
 * Class stringField
 * @author Vazquez Luis
 * @copyright (c) 2015, Syntesis Management SA
 */
class stringField extends field {
    
    protected $_maxlength;
    
    /**
     * getMAxLength() - Return maxlength of field
     * @access public
     * getMaxlength
     * @return type
     */
    public function getMaxlength(){
        return $this->_maxlength;
    }
    
    /**
     * setMaxLength() - Set a maxlength of field
     * @access public
     * @param type $maxlength
     * @throws \InvalidArgumentException
     */
    public function setMaxlength($maxlength){
        if(empty($maxlength)){
            throw new \InvalidArgumentException('This method ' . __METHOD__ . ' cannot accept empty parameter');
        } elseif(!is_integer($maxlength)){
            throw new \InvalidArgumentException('This method ' . __METHOD__ . ' only accept integer parameter');
        } elseif($maxlength <= 0){
            throw new \InvalidArgumentException('This method ' . __METHOD__ . ' only accept unsigned integer');            
        }
        $this->_maxlength = $maxlength;
    }
}