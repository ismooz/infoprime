<?php

namespace library\forms;

/**
 * Class texField
 * @author Vazquez Luis
 * @copyright (c) 2015, Syntesis Management SA
 */
class textField extends field {
    
    /**
     * @access protected
     * @var type 
     */
    protected $_rows;
    
    /**
     * @access protected
     * @var type 
     */
    protected $_cols;
    
    /**
     * Constructor
     * @param array $options
     */
    public function __construct(array $options) {
        parent::__construct($options);
    }
      
    /**
     * getCols() -
     * @access public
     * @return type
     */
    public function getCols(){
        return $this->_cols;
    }
    
    /**
     * getRows() -
     * @access public
     * @return type
     */
    public function getRows(){
        return $this->_rows;
    }
    
    /**
     * setCols() -
     * @access public
     * @param type $cols
     */
    public function setCols($cols){
        $this->_cols = $cols;
    }
    
    /**
     * setRows() -
     * @access public
     * @param type $rows
     */
    public function setRows($rows){
        $this->_rows = $rows;
    }
}
