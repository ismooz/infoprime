<?php

namespace library\forms;

/**
 * Abstract class formBuilder
 * @author Vazquez Luis
 * @copyright (c) 2015, Syntesis Management SA
 */
abstract class formBuilder {
    
    /**
     * @access protected
     * @var type 
     */
    protected $_form;
    
    /**
     * Constructor
     */
    public function __construct($entity) {
       $this->setForm(New Form($entity)); 
    }
    
    /**
     * 
     */
    abstract public function build();
    
    /**
     * getForm() -
     * @access public
     * @return type
     */
    public function getForm(){
        return $this->_form;
    }
    
    /**
     * setForm() -
     * @access public
     * @param \Library\Form $form
     * @throws \InvalidArgumentException
     */
    public function setForm(form $form){
        if(empty($form)){
            throw new \InvalidArgumentException('This method ' . __METHOD__ . ' cannot accept empty parameter');            
        } elseif(!($form instanceof Form)){
            throw new \InvalidArgumentException('This method ' . __METHOD__ . ' only accept From parameter');
        }
        $this->_form = $form;
    }
}