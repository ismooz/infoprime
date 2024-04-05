<?php

namespace library\application;

/**
 * Class page
 * @author Vazquez Luis
 * @copyright (c) 2015, Syntesis Management SA
 */
class page extends applicationComponent {
    
    /**
     * @access private
     * @var type 
     */
    private $_filename;
    
    /**
     * @access private
     * @var array
     */
    private $_vars;
    
    /**
     * @access public
     * @param \Library\Application\Application $application
     */
    public function __construct(application $application) {
        parent::__construct($application);
        $this->_vars = array();
    }

    /**
     * @access public
     * @param type $var
     * @param type $value
     * @throws \InvalidArgumentException
     */
    public function addVar($var, $value){
        if (!is_string($var) || is_numeric($var) || empty($var)){
            throw new \InvalidArgumentException('Le nom de la variable doit être une chaine de caractère non nulle');
        }
        $this->_vars[$var] = $value;
    }    
    
    /**
     * @access public
     * @return type
     * @throws \InvalidArgumentException
     */
    public function render(){
        // On vériife que le fichier existe
        if (!file_exists($this->_filename)){
            throw new \InvalidArgumentException('La vue (' . $this->_filename . ') n\'existe pas');
        }
        //echo $this->_filename;
        $user = $this->_application->getUser();
        // This function treats keys as variable names and values as variable values
        extract($this->_vars);
        // Turn on output buffering
        ob_start();
        require_once $this->_filename;
        $content = ob_get_clean();
        ob_start();
        require_once __DIR__ . '/../../applications/' . $this->_application->getName() . '/templates/layout.php';
        return ob_get_clean();
    }
    
    /**
     * @access public
     * @param string $filename
     */
    public function setContent($filename){
        if (!is_string($filename) || empty($filename)){
            throw new \InvalidArgumentException('The specified view is invalid.');
        }
        $this->_filename = $filename;        
    }    
}