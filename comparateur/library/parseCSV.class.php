<?php

namespace library;

class parseCSV {
    
    private $_convertEncoding = false;
    
    /**
     * @access private
     * @var type 
     */
    private $_enclosure;
    
    /**
     * @access private
     * @var string
     */
    private $_encoding;
    
    /**
     * Escape
     * @access public
     * @var type 
     */
    private $_escape;
    
    /**
     * Filename
     * 
     * @access private
     * @var type 
     */
    private $_fileHandle;
    
    /**
     * @access private
     * @var string
     */
    private $_filename;
    
    /**
     * @access private
     * @var array 
     */
    private $_data;
    
    /**
     * @access private
     * @var string
     */
    private $_delimiter;
    
    /**
     * header
     * @access private
     * @var type 
     */
    private $_header;
    
    /**
     * @access private
     * @var type 
     */
    private $_heading;
    
    /**
     * 
     * @param type $filename
     * @param type $delimiter
     * @param type $heading
     */
    public function __construct($filename, $heading = true, $delimiter = ',', $enclosure = '"', $escape = '\\'){
        $this->setFilename($filename);
        $this->_loadFile();
        $this->setDelimiter($delimiter);
        $this->setEnclosure($enclosure);
        $this->setEscape($escape);
        $this->setHeading($heading);
        if($this->_heading){
            $this->_parseHeader();
        }
        $this->_parse();
    }
    
    /**
     * __destruct()
     * @access public
     */
    public function __destruct() {
        if(!is_null($this->_fileHandle)){
            fclose($this->_fileHandle);
        }
    }
    
    /**
     * __toSting()
     * @access public
     * @return string
     */
    public function __toString() {
        $data = 'Filename : <span style="color:blue">' . $this->_filename . "</span><br/>\r\n";
        $data .= 'File size : <span style="color:blue">' . filesize($this->_filename) . " octets</span><br/>\r\n";
        $data .= 'Encoding : <span style="color:blue">' . $this->_encoding . "</span><br/>\r\n";
        $data .= 'Delimiter : <span style="color:blue">' . $this->_delimiter . "</span><br/>\r\n";
        $data .= 'Enclosure : <span style="color:blue">' . $this->_enclosure . "</span><br/>\r\n";
        $data .= 'Escape : <span style="color:blue">' . $this->_escape . "</span><br/><br/>\r\n";
        $data .= "<table style='border-collapse:collapse'>\r\n";
        if($this->_heading){
            $data .= "<thead>\r\n";
            $data .= "<tr style='border:1px solid #aaa'>\r\n";
            foreach($this->_header as $title){
                $data .= "<th style='padding:5px 8px;border:1px solid #aaa'><strong>" . $title . "</strong></th>\r\n";
            }
            $data .= "</tr>\r\n";
            $data .= "</thead>\r\n";
        }        
        foreach($this->_data as $line){
            $data .= "<tbody>\r\n";
            $data .= "<tr style='border:1px solid #aaa'>\r\r";
            foreach($line as $field){
                $data .= "<td style='padding:5px 8px;border:1px solid #aaa'>" . $field . "</td>\r\n";
            }
            $data .= "</tr>\r\n";
        }
        $data .= "</tbody>\r\n";
        $data .= "</table>\r\n";
        return $data;
    }
    
    /**
     * getEnclosure()
     * Retourne le caractère utilisé pour entourer le champ.
     * @access public
     * @return type
     */
    public function getEnclosure(){
        return $this->_enclosure;
    }
    
    /**
     * getEscape()
     * @access public
     * @return string
     */
    public function getEscape(){
        return $this->_escape;
    }
    
    /**
     * getData()
     * @access public
     * @return array
     */
    public function getData(){
        return $this->_data;
    }
    
    /**
     * getDelimiter()
     * Retourne le délimiteur de champs.
     * @access public
     * @return type
     */
    public function getDelimiter(){
        return $this->_delimiter;
    }
    
    /**
     * getFilename()
     * @access public
     * @return string
     */
    public function getFilename(){
        return $this->_filename;
    }
    
    /**
     * getHeader()
     * @access public
     * @return 
     */
    public function getHeader(){
        return $this->_header;
    }
    
    /**
     * getHeading()
     * @access public
     * @return type
     */
    public function getHeading(){
        return $this->_heading;
    }
    
    /**
     * _loadFile()
     * @access private
     */
    private function _loadFile(){
        $this->_fileHandle = fopen($this->_filename, 'r+');
        $this->_encoding = mb_detect_encoding(file_get_contents($this->_filename), mb_list_encodings(), true);
    }
    
    private function _parse(){
        $row = 0;
        $result = array();
        $length = filesize($this->_filename) + 1;
        if(is_null($this->_fileHandle)){
            throw new \Exception('This method(' . __METHOD__ . ') cannot accept Null file handle.');
        }
        while($data = fgetcsv($this->_fileHandle, $length, $this->_delimiter, $this->_enclosure, $this->_escape)){
            $result[$row] = $data;
            $row++;
        }
        $this->_data = $result;
    }
    
    /**
     * _parseHeader()
     * @access private
     */
    private function _parseHeader(){
        if(is_null($this->_fileHandle)){
            throw new \Exception('This method(' . __METHOD__ . ') cannot accept Null file handle.');
        }
        $this->_header = fgetcsv($this->_fileHandle, 0, $this->_delimiter, $this->_enclosure);
        if($this->_convertEncoding){
            echo('oui');
            $this->_header = mb_convert_encoding($this->_header, 'UTF-8', mb_detect_encoding($this->_header, "UTF-8, ISO-8859-1, ISO-8859-15", true));
        }
    }
    
    /**
     * setDelimiter()
     * Définit le délimiteur de champs (un seul caractère).
     * @access public
     * @param type $delimiter
     * @throws \Exception
     */
    public function setDelimiter($delimiter){
        if(empty($delimiter)){
            throw new \Exception('This method(' . __METHOD__ . ') cannot accept empty parameter');
        }
        $this->_delimiter = $delimiter;
    }   
    
    /**
     * setEnclosure()
     * Définit le caractère utilisé pour entourer le champ (un seul caractère).
     * @access public
     * @param type $enclosure
     * @throws \Exception
     */
    public function setEnclosure($enclosure){
        if(empty($enclosure)){
            throw new \Exception('This method(' . __METHOD__ . ') cannot accept empty parameter.');
        }
        $this->_enclosure = $enclosure;
    }
    
    /**
     * setEscape()
     * @access public
     * @param type $escape
     * @throws \Exception
     */
    public function setEscape($escape){
        if(empty($escape)){
            throw new \Exception('This method(' . __METHOD__ . ') cannot accpet empty parameter.');
        }
        $this->_escape = $escape;
    }
    
    /**
     * setFilename()
     * @access public
     * @param type $filename
     * @throws Exception
     * @throws \Exception
     */
    public function setFilename($filename){
        if(empty($filename)){
            throw new \Exception('This method(' . __METHOD__ . ') cannot accept empty parameter.');
        }
        if(!is_file($filename)){
            throw new \Exception('This filename(' . $filename . ') cannot exist.');
        }
        if(!is_readable($filename)){
            throw new \Exception('This filename(' . $filename . ') is not readable.');
        }
        $this->_filename = $filename;
    }
    
    /**
     * setHeading()
     * @access public
     * @param type $heading
     * @throws \Exception
     */
    public function setHeading($heading){
        if(!is_bool($heading)){
            throw new \Exception('This method(' . __METHOD__ . ') only accept boolean parameter.');
        }
        $this->_heading = $heading;
    }    
}
