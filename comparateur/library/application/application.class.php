<?php

namespace library\application;
use library\application\configuration;
use library\request;
use library\response;
use library\routes\router;

/**
 * Abstract class application
 * @author Vazquez Luis
 * @copyright (c) 2015, Syntesis Management SA
 */
abstract class application {
    
    /**
     * @access protected
     * @var string
     */
    protected $_name;
    
    /**
     * @access protected
     * @var object Request
     */
    protected $_request;
    
    /**
     * @access protected
     * @var object Response
     */
    protected $_response;
    
    /**
     * @access protected
     * @var object User 
     */
    protected $_user;
    
    /**
     * Constructor
     * @access public
     * @param Application $application
     */
    public function __construct() {
        // Démarre une nouvelle session ou reprend une session existante
        session_start();
        $this->_config = new configuration($this);
        $this->_request = new request();
        $this->_response = new response($this);
    }
    
    /**
     * @access public
     * @param type $filename
     * @return \Library\Application\controllerClass
     */
    public function getController($filename){
        $router = new router($filename);
        try{
            $route = $router->getRoute($this->_request->getData('request_uri'));
        } catch(\InvalidArgumentException $ex) {
            if($ex->getCode() === router::NO_ROUTE){
                $this->_response->redirect404();
            }
        }
        $_GET = array_merge($_GET, $route->getVars());
        $controllerClass = 'applications\\' . $this->_name . '\\modules\\' . $route->getModule() . '\\' . $route->getModule() . 'Controller';
        return new $controllerClass($this, $route->getModule(), $route->getAction());
    }
    
    /**
     * @access public
     * @return string - Name of application
     */
    public function getName(){
        return $this->_name;
    }
    
    /**
     * @access public
     * @return object request
     */
    public function getRequest(){
        return $this->_request;
    }
    
    /**
     * @access public
     * @return object response
     */
    public function getResponse(){
        return $this->_response;
    }
    
    /**
     * @access public
     * @return object user
     */
    public function getUser(){
        return $this->_user;
    }
    
    /**
     * @access public
     * @param string $filename
     */
    abstract public function run($filename);
    
    /**
     * 
     * @param \library\application\users $user
     */
    public function setUser(users $user){
        $this->_user = $user;
    }
}
