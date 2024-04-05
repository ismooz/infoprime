<?php

namespace library;
use library\application\applicationComponent;
use library\application\page;

/**
 * Class response
 * @author Vazquez Luis
 * @copyright (c) 2015, Syntesis Management SA
 */
class response extends applicationComponent {
    
    /**
     * @access private
     * @var type 
     */
    private $_page;
    
    /**
     * @access public
     * @param type $header
     */
    public function addHeader($header){
        header($header);
    }
    
    /**
     * Redirect browser from location
     * @access public
     * @param type $location
     */
    public function redirect($location){
        session_write_close();
        header('Location: ' . $location);
        exit();
    }
    
    public function redirect404(){
        $this->_page = new page($this->getApplication());
        $this->_page->setContent(__DIR__ . '/../applications/' . $this->_application->getName() .  '/templates/errors/404.html');
        $this->addHeader('HTTP/1.0 404 Not Found');
        $this->send();        
    }
    
    /**
     * Send the view
     * @access public
     */
    public function send(){
        exit($this->_page->render());
    }

    /**
     * Send a cookie
     * @param type $name
     * @param type $value
     * @param type $expire
     * @param type $path
     * @param type $domain
     * @param type $secure
     * @param type $httpOnly
     */
    public function setCookie($name, $value = '', $expire = 0, $path = null, $domain = null, $secure = false, $httpOnly = true){
        setcookie($name, $value, $expire, $path, $domain, $secure, $httpOnly);
    }
    
    /**
     * Set the view
     * @access public
     * @param Page $page
     */
    public function setPage(Page $page){
        $this->_page = $page;
    }
}
