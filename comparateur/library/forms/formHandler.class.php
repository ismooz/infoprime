<?php

namespace library\forms;

/**
 * Class FormHandler
 * @author Vazquez Luis
 * @copyright (c) 2015, Syntesis Management SA
 */
class formHandler {
    
    /**
     * @access protected
     * @var type 
     */
    protected $_form;
    
    /**
     * @access protected
     * @var type 
     */
    protected $_manager;
    
    /**
     * @access protected
     * @var type 
     */
    protected $_request;
    
    /**
     * Constructor
     * @param \Libraray\Form $form
     * @param \Libraray\Manager $manager
     * @param \Libraray\Request $request
     */
    public function __construct(form $form, manager $manager, request $request) {
        $this->setForm($form);
        $this->setManager($manager);
        $this->setRequest($request);
    }
    
    /**
     * getForm() -
     * @access public
     * @return type
     */
    public function getForm(){
        return $this->_form;
    }
    
    /**
     * getManager() -
     * @access public
     * @return type
     */
    public function getManager(){
        return $this->_manager;
    }
    
    /**
     * getRequest() -
     * @access public
     * @return type
     */
    public function getRequest(){
        return $this->_request;
    }
    
    /**
     * setForm() -
     * @access public
     * @param type $form
     */
    public function setForm($form){
        $this->_form = $form;
    }
    
    /**
     * setManager() -
     * @access public
     * @param type $manager
     */
    public function setManager($manager){
        $this->_manager = $manager;
    }
    
    /**
     * setRequest() -
     * @access public
     * @param type $request
     */
    public function setRequest($request){
        $this->_request = $request;
    }
}
