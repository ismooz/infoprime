<?php

namespace library\models;
use library\models\contactsTypesManager;
use library\entities\contactTypeEntity;

/**
 * Class contactsTypesManage_PDO
 * @author Vazquez Luis
 * @copyright (c) 2015, Syntesis Management SA
 */
class contactsTypesManager_PDO extends contactsTypesManager {
    
    /**
     * add() - Ajoute un type demande de contact
     * @access protected
     * @param contactEtatEntity $contactType
     */
    public function add(contactTypeEntity $contactType){
        $requete = $this->_dao->prepare('INSERT INTO contacts_types SET name = :name, dateCreation = NOW(), dateModification = NOW()');
        $requete->bindValue(':name', $contactType->getName());
        $requete->execute();
    }    
    
    /**
     * count() - Retourne le nombre de types demande de contact
     * @access public
     * @param string - Condition de recherche
     * @return int - Nombre de types demande de contact
     */     
    public function count($condition = null){
        // Vérifie si une condition de recherche est demandée
        if(!is_null($condition)){
            return $this->_dao->query('SELECT COUNT(*) FROM contacts_types ' . $condition)->fetchColumn();
        }else{
            return $this->_dao->query('SELECT COUNT(*) FROM contacts_types')->fetchColumn();
        }
    }
    
    /**
     * delete() - Supprime un type demande de contact
     * @access public
     * @param int $id - Identifiant du type demande de contact
     * @return void
     */
    public function delete($id) {
        $this->_dao->exec('DELETE FROM contacts_types WHERE id = ' . (int) $id);
    }    
    
    /**
     * getUnique() - Retourne un type demande de contact
     * @access public 
     * @param int $id - Identifiant du type demande de contact
     * @return contactTypeEntity $contactType ou null
     */
    public function getUnique($id){
        $contactType = '';
        $requete = $this->_dao->prepare('SELECT * FROM contacts_types WHERE id = :id');
        $requete->bindValue(':id', (int) $id, \PDO::PARAM_INT);
        $requete->execute();
        $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'library\entities\contactTypeEntity');
        if(($contactType = $requete->fetch())){
            $contactType->setDateCreation(new \DateTime($contactType->getDateCreation()));
            $contactType->setDateModification(new \DateTime($contactType->getDateModification()));
            return $contactType;
        }else{
            return null;
        }
    }    
    
    /**
     * getUnique() - Retourne le nom de type de la demande de contact
     * @access public 
     * @param string $name - Nom du type demande de contact
     * @return contactTypeEntity $contactType ou null
     */
    public function getUniqueName($name){
        $contactType = '';
        $requete = $this->_dao->prepare('SELECT * FROM contacts_types WHERE name = :name');
        $requete->bindValue(':name', $name, \PDO::PARAM_STR);
        $requete->execute();
        $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'library\entities\contactTypeEntity');
        if(($contactType = $requete->fetch())){
            $contactType->setDateCreation(new \DateTime($contactType->getDateCreation()));
            $contactType->setDateModification(new \DateTime($contactType->getDateModification()));
            return $contactType;
        }else{
            return null;
        }
    }    
    
    /**
     * getList() - Retourne la liste des types demande de contact
     * @access public
     * @param int $debut - Enregistrement de début
     * @param int $limite - Enregistrement de fin
     * @return array contactTypeEntity $contactsTypes
     */
    public function getList($debut = -1, $limite = -1, $order = 'id'){
        $sql = 'SELECT * FROM contacts_types ORDER BY ' . $order;
        if ($debut != -1 || $limite != -1){
            $sql .= ' LIMIT '.(int) $limite.' OFFSET '.(int) $debut;
        }
        $requete = $this->_dao->query($sql);
        $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'library\entities\contactTypeEntity');
        $contactsTypes = $requete->fetchAll();
        foreach($contactsTypes as $contactType){
            $contactType->setDateCreation(new \DateTime($contactType->getDateCreation()));
            $contactType->setDateModification(new \DateTime($contactType->getDateModification()));
        }
        $requete->closeCursor();
        return $contactsTypes;
    }   

    /**
     * modify() - Modifie un type demande de contact
     * @access public
     * @param contactTypeEntity $contactType
     * @return void
     */
    public function modify(contactTypeEntity $contactType){
        $requete = $this->_dao->prepare('UPDATE contacts_types SET name = :name WHERE id = :id');
        $requete->bindValue(':name', $contactType->getName(), \PDO::PARAM_STR);
        $requete->bindValue(':id', $contactType->getId(), \PDO::PARAM_INT); 
        $requete->execute();
    }   
}