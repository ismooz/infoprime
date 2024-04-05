<?php

namespace library\entities;

/**
 * Abstract class entity
 * @author Vazquez Luis
 * @copyright (c) 2015, Syntesis Management SA
 */
abstract class entity implements \ArrayAccess {
    
    /**
     * @access protected
     * @var type 
     */
    protected $_errors;
    
    /**
     * @access prtected
     * @var type 
     */
    protected $id;
    
    /**
     * @access public
     * @param array $donnees
     */
    public function __construct(array $donnees = array()) {
        if(!empty($donnees)){
            $this->hydrate($donnees);
        }
    }
    
    /**
     * getErrors() - Return array of errors
     * @access public
     * @return array
     */
    public function getErrors(){
        return $this->_errors;
    }
    
    /**
     * getId() - Return id of entity
     * @access public
     * @return Integer
     */
    public function getId(){
        return $this->id;
    }
    
    /**
     * hydrate() -
     * @access public
     * @param array $donnees
     */
    public function hydrate(array $donnees){
        foreach ($donnees as $attribut => $valeur){
            $methode = 'set' . ucfirst($attribut);
            if(is_callable(array($this, $methode))){
                $this->$methode($valeur);
            }
        }
    }
    
    /**
     * isNew() -
     * @access public
     * @return type
     */
    public function isNew(){
        return empty($this->id);
    }
    
    /**
     * isValid() - Vérifie que l'entité soit valide
     * @access public
     * @return booléan
     */
    public function isValid(){
        return (count($this->_errors) < 1)?true:false;
    }    
    
    /**
     * setError() - Définit une erreur
     * @param int $error
     */
    public function setError($error){
        $this->_errors[] = (int) $error;
    }
    
    /**
     * setId() -
     * @access public
     * @param type $id
     * @throws \InvalidArgumentException
     */
    public function setId($id){
        if(empty($id)){
            throw new \InvalidArgumentException('This method ' . __METHOD__ . ' cannot accept empty parameter.');
        }
        $this->id = $id;
    }
    
    /**
     * offsetGet() -
     * @access public
     * @param type $var
     * @return type
     */
    public function offsetGet($var){
        if(!isset($this->$var) && is_callable($this, $var)){
            return $this->$var;
        }
    }
    
    public function offsetSet($var, $value){
        $method = 'set' . ucfirst($var);
        if(isset($this->$var) && is_callable($this, $method)){
            $this->$method($value);
        }
    }
    
    /**
     * offsetExists() -
     * @access public
     * @param type $var
     * @return type
     */
    public function offsetExists($var){
        return isset($this->$var) && is_callable($this, $var);
    }
    
    /**
     * offsetUnset() -
     * @access public
     * @throws \Exception
     */
    public function offsetUnset($var){
        throw new \Exception('Impossible de supprimer une quelconque valeur');
    }
}
