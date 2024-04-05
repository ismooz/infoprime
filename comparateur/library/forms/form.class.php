<?php

namespace library\forms;

/**
 * Class From
 * @author Vazquez Luis
 * @copyright (c) 2015, Syntesis Management SA
 */
class form {
    
    /**
     * @access protected
     * @var type 
     */
    protected $_entity;
    
    /**
     * @access protected
     * @var type 
     */
    protected $_fields;
    
    /**
     * Constructor
     */
    public function __construct(Entity $entity) {
        $this->_fields = array();
        $this->setEntity($entity);
    }
    
    public function add(Field $field){
        // Récupération du nom du champ
        $nom = 'get' . ucfirst($field->getName());
        // Assignation de la valeur correspondante au champ
        $field->setValue($this->_entity->$nom());
        // Ajout du champ passé en argument $ la liste des champs
        $this->_fields[] = $field;
        return $this;
    }
    
    public function createView(){
        
    }
    
    /**
     * getEntity() -
     * @access public
     * @return type
     */
    public function getEntity(){
        return $this->_entity;
    }
    
    /**
     * isValid() -
     * @access public
     * @return boolean
     */
    public function isValid(){
        $valid = true;
        // on vérifie que tous les champs soit valides
        foreach($this->_fields as $field){
            if(!$field->isValid()){
                $valid = false;
            }
        }
        return $valid;
    }
    
    /**
     * setEntity() -
     * @access public
     * @param \Library\Entity $entity
     */
    public function setEntity(Entity $entity){
        $this->_entity = $entity;
    }
}
