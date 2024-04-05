<?php

namespace library\models;
use library\managers\managers;
use library\entities\utilisateurGroupeEntity;

/**
 * Abstract class utilisateursGroupesManager
 * @abstract
 * @author Vazquez Luis
 * @copyright (c) 2015, Syntesis Management SA
 */
abstract class utilisateursGroupesManager extends managers {

    /**
     * add() - Ajoute un groupe d'utilisateurs
     * @abstract
     * @access protected
     * @param utilisateurGroupeEntity $utilisateurGroupe
     * @return void
     */    
    abstract public function add(utilisateurGroupeEntity $utilisateurGroupe);      
    
    /**
     * count() - Retourne le nombre de groupes d'utilisateurs
     * @abstract
     * @access public
     * @param string $condition - condition de recherche
     * @return int - nombre de groupes d'utilisateurs
     */    
    abstract public function count($condition);
    
    /**
     * delete() - Supprime un groupe d'utilisateurs
     * @abstract
     * @access public
     * @param int $id - identifiant du groupe d'utilisateurs
     * @return void
     */
    abstract public function delete($id);    
    
    /**
     * modifiy() - Modifie un groupe d'utilisateurs
     * @abstract
     * @access public
     * @param utilisateurGroupeEntity $utilisateurGroupe
     * @return void
     */
    abstract public function modify(utilisateurGroupeEntity $utilisateurGroupe);    
    
    /**
     * save() - Sauvegarde un groupe d'utilisateurs
     * @access public
     * @param utilisateurGroupeEntiy $utilisateurGroupe
     * @throws \RuntimeException
     */
    public function save(utilisateurGroupeEntity $utilisateurGroupe){
        if($utilisateurGroupe->isValid()){
            $utilisateurGroupe->isNew() ? $this->add($utilisateurGroupe) : $this->modify($utilisateurGroupe);
        } else {
            throw new \RuntimeException('Ce groupe d\'utilisateurs doit être valide avant d\'être enregistrée !');
        }
    }
}