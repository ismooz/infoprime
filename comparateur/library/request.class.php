<?php

namespace library;

/**
 * Class request
 * @author Vazquez Luis
 * @copyright (c) 2015, Syntesis Management SA
 */
class request {
    
    /**
     * Return data
     * @access public
     * @param type $var
     * @param type $key
     * @return type
     */
    public function getData($var, $key = ''){
        switch(strtolower($var)){
            case 'cookie':
                $data = filter_input(INPUT_COOKIE, $key);
                break;
            case 'get':
                $data = $_GET[$key];
                break;
            case 'image':
                $data = $_FILES[$key];
                break;
            case 'method':
                $data = filter_input(INPUT_SERVER, 'REQUEST_METHOD');
                break;
            case 'post':
                $data = filter_input(INPUT_POST, $key);
                break;
            case 'request_uri':
                $data = filter_input(INPUT_SERVER, 'REQUEST_URI');
                break;
            default:
                throw new \InvalidArgumentException();
        }
        return $data;
    }
    
    /**
     * Return 
     * @access public
     * @param type $var
     * @param type $key
     * @return type
     */
    public function getExists($var, $key){
        switch($var){
            case 'cookie':
                $result = isset($_COOKIE[$key]);
                break;
            case 'get':
                $result = isset($_GET[$key]);
                break;
            case 'post':
                $result = isset($_POST[$key]);
                break;
            default:
                throw new \InvalidArgumentException();
        }
        return $result;
    } 
}