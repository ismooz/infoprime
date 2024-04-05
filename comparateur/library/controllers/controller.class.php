<?php

namespace library\controllers;
use library\application\application;
use library\application\applicationComponent;
use library\managers\managers;
use library\database\MyPDO;
use library\application\page;

/**
 * Abstract Class Controller
 * @author Vazquez Luis
 * @copyright (c) 2015, Syntesis Management SA
 */
abstract class controller extends applicationComponent{
    
    /**
     * @access protected
     * @var string 
     */
    protected $_action;
    
    /**
     * @access protected
     * @var type 
     */
    protected $_managers;

    /**
     * @access protected
     * @var string
     */
    protected $_module;
    
    /**
     * @access protected
     * @var object Page 
     */
    protected $_page;
    
    /**
     * @access protected
     * @var string
     */
    protected $_view;
   
    /**
     * Constructor
     * @access public
     * @param Application $application
     * @param type $module
     * @param type $action
     */
    public function __construct(application $application, $module, $action) {
        parent::__construct($application);
        $this->_managers = new managers('PDO', MyPDO::getInstance(DB_DSN, DB_USER, DB_PASS));
        $this->_page = new page($application);
        $this->setModule($module);
        $this->setAction($action);
        $this->setView($action);
    }
    
    /**
     * @access public
     * @return object Page
     */
    public function getPage(){
        return $this->_page;
    }
    
    /**
     * execute() -
     * @access public
     * @throws \RuntimeException
     */
    public function execute() {
        $method = 'execute' . ucfirst($this->_action);
        if (!is_callable(array($this, $method))) {
            throw new \RuntimeException('L\'action "' . $this->_action . '" n\'est pas définie sur ce module');
        }
        $this->$method($this->_application->getRequest());
    }    
    
    /**
     * @access public
     * @param type $action
     * @throws \InvalidArgumentException
     */
    public function setAction($action){
        if (empty($action)) {
            throw new \InvalidArgumentException('This method ' . __METHOD__ . ' cannot accept empty parameter');
        } elseif (!is_string($action)) {
            throw new \InvalidArgumentException('This method ' . __METHOD__ . ' only accept string parameter');
        }
        $this->_action = $action;        
    }
    
    /**
     * @access public
     * @param type $module
     * @throws \InvalidArgumentException
     */
    public function setModule($module){
        if (empty($module)) {
            throw new \InvalidArgumentException('This method ' . __METHOD__ . ' cannot accept empty parameter');
        } elseif (!is_string($module)) {
            throw new \InvalidArgumentException('This method ' . __METHOD__ . ' only accept string parameter');
        }
        $this->_module = $module;        
    }
    
    public function setView($view){
        if (!is_string($view) || empty($view)){
          throw new \InvalidArgumentException('La vue doit être une chaine de caractères valide');
        }
        $this->_view = $view;
        $this->_page->setContent(__DIR__ . '/../../applications/' . $this->_application->getName() . '/modules/' . $this->_module . '/views/' . $this->_view . '.php');
    }
}