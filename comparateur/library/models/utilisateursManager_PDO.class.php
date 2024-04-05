<?php

namespace library\models;
use library\models\utilisateursManager;
use library\entities\utilisateurEntity;

/**
 * Class ustilisateursManager_PDO
 * @author Vazquez Luis
 * @copyright (c) 2015, Syntesis Management SA
 */
class utilisateursManager_PDO extends utilisateursManager {
    
    /**
     * add() - Ajoute un utilisateur
     * @access protected
     * @param utilisateurEntity $utilisateur
     */
    public function add(utilisateurEntity $utilisateur){
        $requete = $this->_dao->prepare('INSERT INTO users SET login = :login, password = :password, utilisateurGroupeId = :utilisateurGroupeId, state = :state, dateCreation = NOW(), dateModification = NOW()');
        $requete->bindValue(':login', $utilisateur->getLogin(), \PDO::PARAM_STR);
        $requete->bindValue(':password', $utilisateur->getPassword(), \PDO::PARAM_STR);
        $requete->bindValue(':utilisateurGroupeId', $utilisateur->getUtilisateurGroupeId(), \PDO::PARAM_INT);
        $requete->bindValue(':state', $utilisateur->getState(), \PDO::PARAM_INT);
        $requete->execute();
    }    
    
    /**
     * count() - Retourne le nombre d'utilisatteurs
     * @access public
     * @param string - Condition de recherche
     * @return int - Nombre d'utilisateurs
     */     
    public function count($condition = null){
        // Vérifie si une condition de recherche est demandée
        if(!is_null($condition)){
            return $this->_dao->query('SELECT COUNT(*) FROM users ' . $condition)->fetchColumn();
        }else{
            return $this->_dao->query('SELECT COUNT(*) FROM users')->fetchColumn();
        }
    }
    
    /**
     * delete() - Supprime un utilisateur
     * @access public
     * @param int $id - Identifiant de l'utilisateur
     * @return void
     */
    public function delete($id) {
        $this->_dao->exec('DELETE FROM users WHERE id = ' . (int) $id);
    }    
    
    /**
     * getUnique() - Retourne un utilisateur
     * @access public 
     * @param int $id - Identifiant de l'utilisateur
     * @return utilisateurEntity $utilisateur ou null
     */
    public function getUnique($id){
        $utilisateur = '';
        $requete = $this->_dao->prepare('SELECT * FROM users WHERE id = :id');
        $requete->bindValue(':id', (int) $id, \PDO::PARAM_INT);
        $requete->execute();
        $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\library\entities\utilisateurEntity');
        if(($utilisateur = $requete->fetch())){
            $utilisateur->setDateCreation(new \DateTime($utilisateur->getDateCreation()));
            $utilisateur->setDateModification(new \DateTime($utilisateur->getDateModification()));
            return $utilisateur;
        }else{
            return null;  
        }
    }    
    
    /**
     * getList() - Retourne la liste des utilisateurs
     * @access public
     * @param int $debut - Enregistrement de début
     * @param int $limite - Enregistrement de fin
     * @return array utilisateurEntity $utilisateur
     */
    public function getList($debut = -1, $limite = -1, $order = 'login'){
        $sql = 'SELECT users.id, users.login, users_groups.name as utilisateurGroupeName, users.password, users.state, users.dateCreation, users.dateModification FROM users LEFT JOIN users_groups as users_groups ON users.utilisateurGroupeId = users_groups.id ORDER BY ' . $order;
        if ($debut != -1 || $limite != -1){
            $sql .= ' LIMIT '.(int) $limite.' OFFSET '.(int) $debut;
        }
        $requete = $this->_dao->query($sql);
        $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'library\entities\utilisateurEntity');
        $utilisateurs = $requete->fetchAll();
        foreach($utilisateurs as $utilisateur){
            $utilisateur->setDateCreation(new \DateTime($utilisateur->getDateCreation()));
            $utilisateur->setDateModification(new \DateTime($utilisateur->getDateModification()));
        }
        $requete->closeCursor();
        return $utilisateurs;
    }    

    /**
     * getUniqueLogin() - Retourne un utilisateur à partir du login
     * @access public
     * @param int $debut - Enregistrement de début
     * @param int $limite - Enregistrement de fin
     * @return utilisateurEntity $utilisateur
     */    
    public function getUniqueLogin($login){
        $utilisateur = '';
        $requete = $this->_dao->prepare('SELECT * FROM users WHERE login = :login');
        $requete->bindValue(':login', $login, \PDO::PARAM_STR);
        $requete->execute();
        $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\library\entities\utilisateurEntity');
        if(($utilisateur = $requete->fetch())){
            $utilisateur->setDateCreation(new \DateTime($utilisateur->getDateCreation()));
            $utilisateur->setDateModification(new \DateTime($utilisateur->getDateModification()));
            return $utilisateur;
        }else{
            return null;
        }
    }
    
    /**
     * modify() - Modifie un utilisateur
     * @access public
     * @param utilisateurEntity $utilisateur
     * @return void
     */
    public function modify(utilisateurEntity $utilisateur){
        $requete = $this->_dao->prepare('UPDATE users SET login = :login, password = :password, utilisateurGroupeId = :utilisateurGroupeId, state = :state, dateModification = NOW() WHERE id = :id');
        $requete->bindValue(':login', $utilisateur->getLogin(), \PDO::PARAM_STR);
        $requete->bindValue(':password', $utilisateur->getPassword(), \PDO::PARAM_STR);
        $requete->bindValue(':utilisateurGroupeId', $utilisateur->getUtilisateurGroupeId(), \PDO::PARAM_INT);
        $requete->bindValue(':state', $utilisateur->getState(), \PDO::PARAM_INT);
        $requete->bindValue(':id', $utilisateur->getId(), \PDO::PARAM_INT); 
        $requete->execute();
    }   
}