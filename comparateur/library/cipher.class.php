<?php

namespace Library;

class cipher {
    
    /**
     * @access private
     * @var type 
     */
    private $_algo;
    
    /**
     * @access private
     * @var type - Initialisation vector  
     */
    private $_iv;
    
    /**
     * @access private
     * @var type 
     */
    private $_key;
    
    /**
     * @access private
     * @var string
     */
    private $_mode;
    
    /**
     * @access private
     * @var string 
     */
    private $_source;
    
    /**
     * Constructor
     * @param type $algo
     * @param type $mode
     * @param type $source
     */
    public function __construct($algo = MCRYPT_3DES, $mode = MCRYPT_MODE_CBC, $source = MCRYPT_RAND) {
        $this->_setAlgo($algo);
        $this->_setMode($mode);
        $this->_setSource($source);
    }
    
    public function encrypt(){
        
    } 
    
    public function decrypt(){
        
    }
    
    /**
     * getIv() -
     * @access public
     * @return type - Initialisation vector
     */
    public function getIv(){
        return base64_encode($this->_iv);
    }
    
    /**
     * setAlgo()
     * @access private
     * @param type $algo
     * @throws Exception
     */
    private function _setAlgo($algo){
        if(empty($algo) || !is_string($algo)){
            throw new Exception('');
        }
        $this->_algo = $algo;
    }
    
    /**
     * _setKey() -
     * @access private
     * @param type $key
     */
    private function _setKey($key){
        if(empty($key)){
            
        }
        $this->_key = $key;
    }
    
    /**
     * _setMode() -
     * @access private
     * @param type $mode
     * @throws Exception
     */
    private function _setMode($mode){
        if(empty($mode) || !is_string($mode)){
            throw new Exception('');
        }
        $this->_mode = $mode;
    }
    
    /**
     * _setSource() -
     * @access private
     * @param type $source
     * @throws Exception
     */
    private function _setSource($source){
        if(empty($source) || !is_string($source)){
            throw new Exception('');
        }
        $this->_source = $source;
    }
}