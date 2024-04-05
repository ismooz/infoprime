<?php

namespace library;

/**
 * Class parseCSV
 */
class parseCSV {
    
    /**
     * convert_encoding
     * @access private
     * @var type 
     */
    private $_convertEncoding;
    
    /**
     * data
     * @access private
     * @var type 
     */
    private $_data;
    
    /**
     * inputEncoding -
     * @access private
     * @var string
     */
    private $_inputEncoding;
    
    /**
     * outputEncoding -
     * @var type 
     */
    private $_outputEncoding;
    
    /**
     * filename
     * @access private
     * @var string
     */
    private $_filename;
    
    /**
     * delimiter
     * @access private
     * @var string
     */
    private $_delimiter;
    
    /**
     * heading
     * @access private
     * @var string
     */
    private $_heading;
    
    /**
     * constructor
     * @param string $filename
     * @param string $delimiter
     * @param string $heading
     * @throws Exception
     */
    public function __construct($filename, $delimiter = ',', $heading = false, $convertEncoding = false, $outputEncoding = 'UTF-8') {
        $this->setFilename($filename);
        $this->_loadFile();
        $this->setDelimiter($delimiter);
        $this->setHeading($heading);
        $this->_setConvertEncoding($convertEncoding);
        $this->setOutputEncoding($outputEncoding);
    }
    
    /**
     * getConvertEncoding
     * @access public
     * @return type
     */
    public function getConvertEncoding(){
        return $this->_convertEncoding;
    }
    
    /**
     * getData
     * @access public
     * @return type
     */
    public function getData(){
        return $this->_data;
    }
    
    /**
     * getDelimiter
     * @return string
     */
    public function getDelimiter(){
        return $this->_delimiter;
    }
    
    /**
     * getFilename
     * @return string
     */
    public function getFilename(){
        return $this->_filename;
    }
    
    /**
     * getInputEncoding
     * @access public
     * @return type
     */
    public function getInputEncoding(){
        return $this->_inputEncoding;
    }
    
    /**
     * getEncoding() -
     * @access public
     * @return type
     */
    public function getOutputEncoding(){
        return $this->_outputEncoding;
    }

    /**
     * getHeading -
     * @access public
     * @return boolean
     */
    public function getHeading(){
        return $this->_heading;
    }
    
    private function _loadFile(){
        $this->_data = file_get_contents($this->_filename);
        
        if($this->_convertEncoding === true){
            echo('oui');
            $this->_data = mb_convert_encoding($this->_data, $this->_outputEncoding, $this->_inputEncoding);
            echo(mb_detect_encoding($this->_data));
        }
    }
    
    /**
     * 
     * @param type $convertEncoding
     * @throws \Exception
     */
    private function _setConvertEncoding($convertEncoding){
        if(!is_bool($convertEncoding)){
            throw new \Exception('This method(' . __METHOD__ . ') only accept boolean parameter');
        }
        $this->_convertEncoding = $convertEncoding;
    }
    
    /**
     * setDelimiter
     * @param type $delimiter
     * @throws Exception
     */
    public function setDelimiter($delimiter){
        if(empty($delimiter)){
            throw new \Exception('This method(' . __METHOD__ . ') cannot accept empty parameter');
        }
        $this->_delimiter = $delimiter;
    }
    
    /**
     * setEncoding() -
     * @access public 
     * @param type $encoding
     * @throws Exception
     */
    public function setOutputEncoding($encoding){
        if(empty($encoding)){
            throw new \Exception('This method(' . __METHOD__ . ') cannot accept empty parameter');
        }            
        $this->_outputEncoding = $encoding;
    }
    
    /**
     * setFilename -
     * @access public
     * @param string $filename
     */
    public function setFilename($filename){
        if(empty($filename)){
            throw new \Exception('This method(' . __METHOD__ . ') cannot accept empty parameter');
        }
        if(!is_file($filename)){
            throw new \Exception('This filename(' . $filename . ') cannot exist');
        }
        if(!is_readable($filename)){
            throw new \Exception('This filename(' . $filename . ') is not readable');
        }
        $this->_inputEncoding = mb_detect_encoding($filename, $this->_outputEncoding, true);
        $this->_filename = $filename;
    }
    
    /**
     * setHeading -
     * @access public
     * @param type $heading
     */
    public function setHeading($heading = true){
        if(!is_bool($heading)){
            throw new \Exception('This method(' . __METHOD__ . ') only accept boolean parameter');
        }
        $this->_heading = $heading;
    }
}