<?php

namespace library\application;
use library\application\application;
use library\application\applicationComponent;

/**
 * Class Configuration
 * @author Vazquez Luis
 * @copyright (c) 2015, Syntesis Management SA
 */
class configuration extends applicationComponent {
    
    /**
     *
     * @var type 
     */
    protected $_vars = array();
    
    /**
     * Constructor
     * @param \Library\Application $application
     */
    public function __construct(application $application) {
        parent::__construct($application);
    }
    
    /**
     * 
     * @param type $property
     * @return type
     */
    public function __get($property){
        if(property_exists($this, $property)){
            return $this->$property;
        }
    }
    
    /**
     * 
     * @param type $property
     * @param type $value
     */
    public function __set($property, $value){
        if(property_exists($this, $property)){
            $this->$property = $value;
        }
    }
    
    /**
     * load() - Load a configuration file
     * @access public
     * @param String $filename
     */
    public function load($filename){
        $xml = new \DOMDocument();
        $xml->load($filename);
        $elements = $xml->getElementsByTagName('define');
        foreach($elements as $element){
            $this->_vars[$element->getAttribute('var')] = $element->getAttribute('value');
        }
    }
    
    /**
     * get() -
     * @access public
     * @param type $key
     * @return type
     * @throws \OutOfRangeException
     */
    public function get($key){
        $this->load(__DIR__ . '/../../applications/' . $this->_application->getName() . '/config/application.xml');
        if(!array_key_exists($key, $this->_vars)){
            throw new \OutOfRangeException('This configuration var cannot exits');
        }
        return $this->_vars[$key];
    }
    
    /**
     * set() -
     * @access public
     * @param type $key
     * @param type $value
     */
    public function set($key, $value){
        $this->_vars[$key] = $value;
    }
    
}
