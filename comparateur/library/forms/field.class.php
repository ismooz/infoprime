<?php

namespace library\forms;

/**
 * Abstract Class Field
 * @author Vazquez Luis
 * @copyright (c) 2015, Syntesis Management SA
 */
abstract class field {
    
    /**
     * @access protected
     * @var type 
     */
    protected $_errorMessage;
    
    /**
     * @access protected
     * @var type 
     */
    protected $_label;
    
    /**
     * @access protected
     * @var type 
     */
    protected $_name;
    
    /**
     * @access protected
     * @var type 
     */
    protected $_value;
    
    /**
     * @access protected
     * @var type 
     */
    protected $_validators;
    
    /**
     * Constructor
     * @param array $options
     */
    public function __construct(array $options){
        $this->_validators = array();
        if(!empty($options)){
            $this->hydrate($options);
        }
    }
    
    /**
     * hydrate() -
     * @access public
     * @param array $options
     */
    public function hydrate($options){
        foreach($options as $option => $param){
            $method = 'set' . ucfirst(substr($option, 1));
            if(is_callable(array($this, $method))){
                $this->$method($param);
            }
        }
    }
    
    /**
     * getLabel() - Return the label of field
     * @access public
     * @return string
     */
    public function getLabel(){
        return $this->_label;
    }
    
    /**
     * getName() - Return the name of field
     * @access public
     * @return string
     */
    public function getName(){
        return $this->_name;
    }
    
    /**
     * getValidators() -
     * @access public
     * @return type
     */
    public function getValidators(){
        return $this->_validators;
    }
    
    /**
     * getValue() - Return the value of field
     * @access public
     * @return string
     */
    public function getValue(){
        return $this->_value;
    }
    
    public function isValid(){
        foreach ($this->_validators as $validator){
            if (!$validator->isValid($this->_value)){
                $this->_errorMessage = $validator->getErrorMessage();
                return false;
            }
        }
        return true;
    }
    
    /**
     * setLabel() -
     * @access public
     * @param type $label
     * @throws \InvalidArgumentException
     */
    public function setLabel($label){
        if(!is_string($label)){
            throw new \InvalidArgumentException('This method ' . __METHOD__ . ' only accept string parameter');
        }
        $this->_label = $label;
    }
    
    /**
     * setName() -
     * @access public
     * @param type $name
     * @throws \InvalidArgumentException
     */
    public function setName($name){
        if(!is_string($name)){
            throw new \InvalidArgumentException('This method ' . __METHOD__ . ' only accept string parameter');
        }
        $this->_name = $name;
    }
    
    /**
     * setValidators() -
     * @access public
     * @param array $validators
     */
    public function setValidators(array $validators){
        foreach($validators as $validator){
            if($validator instanceof Validator && !in_array($validator, $this->_validators)){
                $this->_validators[] = $validator;
            }
        }
    }
    
    /**
     * setValue() -
     * @access public
     * @param type $value
     * @throws \InvalidArgumentException
     */
    public function setValue($value){
        if(!is_string($value)){
            throw new \InvalidArgumentException('This method ' . __METHOD__ . ' only accept string parameter');
        }
        $this->_value = $value;       
    }
}
