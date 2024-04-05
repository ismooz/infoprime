<?php

namespace library\models;
use library\models\utilisateursGroupesManager;
use library\entities\utilisateurGroupeEntity;

/**
 * Class utilisaterusGroupesManage_PDO
 * @author Vazquez Luis
 * @copyright (c) 2015, Syntesis Management SA
 */
class utilisateursGroupesManager_PDO extends utilisateursGroupesManager {
    
    /**
     * add() - Ajoute un groupe d'utilisateurs
     * @access protected
     * @param utilisateurGroupeEntity $utilisateurGroupe
     */
    public function add(utilisateurGroupeEntity $utilisateurGroupe){
        $requete = $this->_dao->prepare('INSERT INTO users_groups SET name = :name, dateCreation = NOW(), dateModification = NOW()');
        $requete->bindValue(':name', $utilisateurGroupe->getName());
        $requete->execute();
    }    
    
    /**
     * count() - Retourne le nombre de goupes d'utilisateurs
     * @access public
     * @param string - Condition de recherche
     * @return int - Nombre de groupes d'utilisateurs
     */     
    public function count($condition = null){
        // Vérifie si une condition de recherche est demandée
        if(!is_null($condition)){
            return $this->_dao->query('SELECT COUNT(*) FROM usrs_groups ' . $condition)->fetchColumn();
        }else{
            return $this->_dao->query('SELECT COUNT(*) FROM users_groups')->fetchColumn();
        }
    }
    
    /**
     * delete() - Supprime un groupe d'utilisateurs
     * @access public
     * @param int $id - Identifiant du groupe d'utilisateurs
     * @return void
     */
    public function delete($id) {
        $this->_dao->exec('DELETE FROM users_groups WHERE id = ' . (int) $id);
    }    
    
    /**
     * getUnique() - Retourne un groupe d'utilisateurs
     * @access public 
     * @param int $id - Identifiant du groupe d'utilisateurs
     * @return utilisateurGroupeEntity $utilisateurGroupe ou null
     */
    public function getUnique($id){
        $utilisateurGroupe = '';
        $requete = $this->_dao->prepare('SELECT * FROM users_groups WHERE id = :id');
        $requete->bindValue(':id', (int) $id, \PDO::PARAM_INT);
        $requete->execute();
        $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'library\entities\utilisateurGroupeEntity');
        if(($utilisateurGroupe = $requete->fetch())){
            $utilisateurGroupe->setDateCreation(new \DateTime($utilisateurGroupe->getDateCreation()));
            $utilisateurGroupe->setDateModification(new \DateTime($utilisateurGroupe->getDateModification()));
            return $utilisateurGroupe;
        }else{
            return null;
        }
    }    
    
    /**
     * getUnique() - Retourne le groupe d'utilisateur d'après le nom
     * @access public 
     * @param string $name - Nom du groupe d'utilisateurs
     * @return utilisateurGroupeEntity $utilisateurGroupe ou null
     */
    public function getUniqueName($name){
        $utilisateurGroupe = '';
        $requete = $this->_dao->prepare('SELECT * FROM users_groups WHERE name = :name');
        $requete->bindValue(':name', $name, \PDO::PARAM_STR);
        $requete->execute();
        $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'library\entities\utilisateurGroupeEntity');
        if(($utilisateurGroupe = $requete->fetch())){
            $utilisateurGroupe->setDateCreation(new \DateTime($utilisateurGroupe->getDateCreation()));
            $utilisateurGroupe->setDateModification(new \DateTime($utilisateurGroupe->getDateModification()));
            return $utilisateurGroupe;
        }else{
            return null;
        }
    }    
    
    /**
     * getList() - Retourne la liste des groupes d'utilisateurs
     * @access public
     * @param int $debut - Enregistrement de début
     * @param int $limite - Enregistrement de fin
     * @return array utilisateursGroupeEntity $utilisateursGroupes
     */
    public function getList($debut = -1, $limite = -1, $order = 'id'){
        $sql = 'SELECT * FROM users_groups ORDER BY ' . $order;
        if ($debut != -1 || $limite != -1){
            $sql .= ' LIMIT '.(int) $limite.' OFFSET '.(int) $debut;
        }
        $requete = $this->_dao->query($sql);
        $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'library\entities\utilisateurGroupeEntity');
        $utilisateursGroupes = $requete->fetchAll();
        foreach($utilisateursGroupes as $utilisateurGroupe){
            $utilisateurGroupe->setDateCreation(new \DateTime($utilisateurGroupe->getDateCreation()));
            $utilisateurGroupe->setDateModification(new \DateTime($utilisateurGroupe->getDateModification()));
        }
        $requete->closeCursor();
        return $utilisateursGroupes;
    }   

    /**
     * modify() - Modifie un groupe d'utilisateurs
     * @access public
     * @param utilisateurGroupeEntity $utilisateurGroupe
     * @return void
     */
    public function modify(utilisateurGroupeEntity $utilisateurGroupe){
        $requete = $this->_dao->prepare('UPDATE users_groups SET name = :name WHERE id = :id');
        $requete->bindValue(':name', $utilisateurGroupe->getName(), \PDO::PARAM_STR);
        $requete->bindValue(':id', $utilisateurGroupe->getId(), \PDO::PARAM_INT); 
        $requete->execute();
    }   
}