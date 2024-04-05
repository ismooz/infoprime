<?php

namespace library\routes;

/**
 * Class route
 * @author Vazquez Luis
 * @copyright (c) 2015, Syntesis Management SA
 */
class route {
    
    /**
     * @access private
     * @var string 
     */
    private $_action;
   
    /**
     * @access private
     * @var string 
     */
    private $_module;
   
    /**
     * @access private
     * @var string
     */
    private $_url;
    
    /**
     * @access private
     * @var type 
     */
    private $_vars;
    
    /**
     * @access private
     * @var type 
     */
    private $_varsNames;

    /**
     * Constructor
     * @access public
     * @param type $url
     * @param type $module
     * @param type $action
     * @param array $varsName
     */
    public function __construct($url, $module, $action, array $varsName = array()) {
       $this->_setAction($action);
       $this->_setModule($module);
       $this->_setUrl($url);
       $this->_vars = array();
       $this->_varsNames = $varsName;
    }
    
    /**
     * @access private
     * @param type $action
     * @throws \InvalidArgumentException
     */
    private function _setAction($action){
        if(!is_string($action)){
            throw new \InvalidArgumentException('This method ' . __METHOD__ . ' only accept string argument');
        }
        $this->_action = $action;        
    }
    
    /**
     * @access private
     * @param type $module
     * @throws \InvalidArgumentException
     */
    private function _setModule($module){
         if(!is_string($module)){
            throw new \InvalidArgumentException('This method ' . __METHOD__ . ' only accept string argument');
        }
        $this->_module = $module;       
    }
    
    /**
     * @access private
     * @param type $url
     * @throws \InvalidArgumentException
     */
    private function _setUrl($url){
        if(!is_string($url)){
            throw new \InvalidArgumentException('This method ' . __METHOD__ . ' only accept string argument');
        }
        $this->_url = $url;        
    }

    /**
     * setVars() -
     * @access public
     * @param array $vars
     */
    public function setVars(array $vars){
        $this->_vars = $vars;
    }
    
    /**
     * setVarsNames() -
     * @access public
     * @param array $varsNames
     */
    public function setVarsNames(array $varsNames){
        $this->_varsNames = $varsNames;
    }    
    
    /**
     * @access public
     * @return string
     */
    public function getAction(){
        return $this->_action;
    }
    
    /**
     * @access public
     * @return string
     */
    public function getModule(){
        return $this->_module;
    }
    
    /**
     * @access public
     * @return string
     */
    public function getUrl(){
        return $this->_url;
    }

    /**
     * getVars() -
     * @access public
     * @return type
     */
    public function getVars(){
        return $this->_vars;
    }
    
    /**
     * getVarsNames() -
     * @access public
     * @return type
     */
    public function getVarsNames(){
        return $this->_varsNames;
    }    
    
    /**
     * @access public
     * @return type
     */
    public function hasVars(){
        return !empty($this->_varsNames);
    }    
    
    /**
     * @access public
     * @param type $url
     * @return string|boolean
     */    
    public function match($url){
        $matches = '';
        if (preg_match('`^' . $this->_url . '$`', $url, $matches)){
            return $matches;
        } else {
            return false;
        }         
    }
}