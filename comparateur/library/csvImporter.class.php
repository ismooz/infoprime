<?php

namespace library;

/**
 * Class csvImporter
 * @author Vazquez Luis
 * @copyright (c) 2015, Syntesis Management SA
 */
class csvImporter {
    
    private $_charset;
    
    /**
     * 
     * @var type 
     */
    private $_fp; 
    
    /**
     * 
     * @var type 
     */
    private $_parse_header; 
    
    /**
     *
     * @var type 
     */
    private $_header; 
    
    /**
     * Délimiteur de spéparation
     * @var type 
     */
    private $_delimiter; 
    
    /**
     *
     * @var type 
     */
    private $_length; 
    
    /**
     * 
     * @param type $file_name
     * @param type $parse_header
     * @param type $delimiter
     * @param type $length
     */
    public function __construct($file_name, $parse_header=false, $delimiter="\t", $length=8000){
        $this->_fp = fopen($file_name, "r"); 
        $this->_parse_header = $parse_header; 
        $this->_delimiter = $delimiter; 
        $this->_length = $length; 

        if ($this->_parse_header){ 
           $this->_header = fgetcsv($this->_fp, $this->_length, $this->_delimiter); 
        }
    } 
    
    /**
     * Destructor
     */
    public function __destruct(){ 
        if($this->_fp) { 
            fclose($this->_fp); 
        } 
    }
    
    private function _encoding(){
        
    }
    
    public function parse(){
        
    }
    
    /**
     * 
     * @param type $max_lines
     * @return type
     */
    public function get($max_lines = 0){ 
        //if $max_lines is set to 0, then get all the data 
        $data = array(); 

        if ($max_lines > 0){ 
            $line_count = 0; 
        }else{ 
            $line_count = -1; // so loop limit is ignored 
        }
        
        while ($line_count < $max_lines && ($row = fgetcsv($this->_fp, $this->_length, $this->_delimiter)) !== FALSE){ 
            if ($this->_parse_header) { 
                foreach($this->_header as $i=>$heading_i){ 
                    $row_new[$heading_i] = $row[$i]; 
                } 
                $data[] = $row_new; 
            }else{ 
                $data[] = $row; 
            } 

            if ($max_lines > 0){ 
                $line_count++; 
            }
        } 
        return $data; 
    } 
}