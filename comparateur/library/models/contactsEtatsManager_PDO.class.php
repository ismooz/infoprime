<?php

namespace library\models;
use library\models\contactsEtatsManager;
use library\entities\contactEtatEntity;

/**
 * Class contactsEtatsManager_PDO
 * @author Vazquez Luis
 * @copyright (c) 2015, Syntesis Management SA
 */
class contactsEtatsManager_PDO extends contactsEtatsManager {
    
    /**
     * add() - Ajoute un état demande de contact
     * @access protected
     * @param contactEtatEntity $contactEtat
     */
    public function add(contactEtatEntity $contactEtat){
        $requete = $this->_dao->prepare('INSERT INTO contacts_etats SET name = :name, dateCreation = NOW(), dateModification = NOW()');
        $requete->bindValue(':name', $contactEtat->getName());
        $requete->execute();
    }    
    
    /**
     * count() - Retourne le nombre d'états demande de contact
     * @access public
     * @param string - Condition de recherche
     * @return int - Nombre d'états demande de contact
     */     
    public function count($condition = null){
        // Vérifie si une condition de recherche est demandée
        if(!is_null($condition)){
            return $this->_dao->query('SELECT COUNT(*) FROM contacts_etats ' . $condition)->fetchColumn();
        }else{
            return $this->_dao->query('SELECT COUNT(*) FROM contacts_etats')->fetchColumn();
        }
    }
    
    /**
     * delete() - Supprime un état demande de contact
     * @access public
     * @param int $id - Identifiant de l'état demande de contact
     * @return void
     */
    public function delete($id) {
        $this->_dao->exec('DELETE FROM contacts_etats WHERE id = ' . (int) $id);
    }    
    
    /**
     * getUnique() - Retourne un état demande de contact
     * @access public 
     * @param int $id - Identifiant de l'état demande de contact
     * @return contactEtatEntity $contactEtst ou null
     */
    public function getUnique($id){
        $contactEtat = '';
        $requete = $this->_dao->prepare('SELECT * FROM contacts_etats WHERE id = :id');
        $requete->bindValue(':id', (int) $id, \PDO::PARAM_INT);
        $requete->execute();
        $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'library\entities\contactEtatEntity');
        if(($contactEtat = $requete->fetch())){
            $contactEtat->setDateCreation(new \DateTime($contactEtat->getDateCreation()));
            $contactEtat->setDateModification(new \DateTime($contactEtat->getDateModification()));
            return $contactEtat;
        }else{
            return null;
        }
    }    

    /**
     * getUniqueName() - Retourne le nom de l'état d'une demande de contact d'après son nom
     * @access public 
     * @param string $name - Nom de l'état d'une demande de contact
     * @return contactEtatEntity $contactEtst ou null
     */    
    public function getUniqueName($name){
        $contactEtat = '';
        $requete = $this->_dao->prepare('SELECT * FROM contacts_etats WHERE name = :name');
        $requete->bindValue(':name', $name, \PDO::PARAM_STR);
        $requete->execute();
        $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'library\entities\contactEtatEntity');
        if(($contactEtat = $requete->fetch())){
            $contactEtat->setDateCreation(new \DateTime($contactEtat->getDateCreation()));
            $contactEtat->setDateModification(new \DateTime($contactEtat->getDateModification()));
            return $contactEtat;
        }else{
            return null;
        }        
    }
    
    /**
     * getList() - Retourne la liste des états demande de contact
     * @access public
     * @param int $debut - Enregistrement de début
     * @param int $limite - Enregistrement de fin
     * @return array contactEtatEntity $contactsEtats
     */
    public function getList($debut = -1, $limite = -1, $order = 'id'){
        $sql = 'SELECT * FROM contacts_etats ORDER BY ' . $order;
        if ($debut != -1 || $limite != -1){
            $sql .= ' LIMIT '.(int) $limite.' OFFSET '.(int) $debut;
        }
        $requete = $this->_dao->query($sql);
        $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'library\entities\contactEtatEntity');
        $contactsEtats = $requete->fetchAll();
        foreach($contactsEtats as $contactEtat){
            $contactEtat->setDateCreation(new \DateTime($contactEtat->getDateCreation()));
            $contactEtat->setDateModification(new \DateTime($contactEtat->getDateModification()));
        }
        $requete->closeCursor();
        return $contactsEtats;
    }   

    /**
     * modify() - Modifie un état demande de contact
     * @access public
     * @param contactEtatEntity $contactEtat
     * @return void
     */
    public function modify(contactEtatEntity $contactEtat){
        $requete = $this->_dao->prepare('UPDATE contacts_etats SET name = :name WHERE id = :id');
        $requete->bindValue(':name', $contactEtat->getName(), \PDO::PARAM_STR);
        $requete->bindValue(':id', $contactEtat->getId(), \PDO::PARAM_INT); 
        $requete->execute();
    }   
}