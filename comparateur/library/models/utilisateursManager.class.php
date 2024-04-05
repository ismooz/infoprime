<?php

namespace library\models;
use library\managers\managers;
use library\entities\utilisateurEntity;

/**
 * Abstract class utilisateursManager
 * @abstract
 * @author Vazquez Luis
 * @copyright (c) 2015, Syntesis Management SA
 */
abstract class utilisateursManager extends managers {

    /**
     * add() - Ajoute un utilisateur 
     * @abstract
     * @access protected
     * @param clientEntity $utilisateur
     * @return void
     */    
    abstract public function add(utilisateurEntity $utilisateur);      
    
    /**
     * count() - Retourne le nombre d'utilisateurs
     * @abstract
     * @access public
     * @param string $condition - condition de recherche
     * @return int - nombre d'utilisateurs
     */    
    abstract public function count($condition);
    
    /**
     * delete() - Supprime un utilisateur
     * @abstract
     * @access public
     * @param int $id - identifiant de l'utilisateur
     * @return void
     */
    abstract public function delete($id);    
    
    /**
     * modifiy() - Modifie un utilisateur
     * @abstract
     * @access public
     * @param utilisateurEntity $utilisateur
     * @return void
     */
    abstract public function modify(utilisateurEntity $utilisateur);    
    
    /**
     * save() - Sauvegarde un utilisateur
     * @access public
     * @param utilisateurEntity $utilisateur
     * @throws \RuntimeException
     */
    public function save(utilisateurEntity $utilisateur){
        if($utilisateur->isValid()){
            $utilisateur->isNew() ? $this->add($utilisateur) : $this->modify($utilisateur);
        } else {
            throw new \RuntimeException('Cet utilisateur doit être valide avant d\'être enregistrée !');
        }
    }
}