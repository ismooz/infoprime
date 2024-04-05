<?php

namespace library\models;
use library\models\contactsManager;
use library\entities\contactEntity;

/**
 * Class contactsManager_PDO
 * @author Vazquez Luis
 * @copyright (c) 2015, Syntesis Management SA
 */
class contactsManager_PDO extends contactsManager {
    
    /**
     * add() - Ajoute une demande de contact
     * @access protected
     * @param contactEntity $contact
     */
    public function add(contactEntity $contact){
        $requete = $this->_dao->prepare('INSERT INTO contacts SET nom = :nom, email = :email, commentaire = :commentaire, typeId = :typeId, etatId = :etatId, dateCreation = NOW(), dateModification = NOW()');
        $requete->bindValue(':nom', $contact->getNom());
        $requete->bindValue(':email', $contact->getEmail());
        $requete->bindValue(':commentaire', $contact->getCommentaire());
        $requete->bindValue(':typeId', $contact->getTypeId());
        $requete->bindValue(':etatId', $contact->getEtatId());
        $requete->execute();
    }    
    
    /**
     * cout() - Retourne le nombre de demandes de contact
     * @access public
     * @return int
     */     
    public function count($condition = null){
        if(!is_null($condition)){
            return $this->_dao->query('SELECT COUNT(*) FROM contacts ' . $condition)->fetchColumn();
        }else{
            return $this->_dao->query('SELECT COUNT(*) FROM contacts')->fetchColumn();
        }
    }
    
    /**
     * delete() - Supprime une demande de contact
     * @access public
     * @param int $id
     */
    public function delete($id) {
        $this->_dao->exec('DELETE FROM contacts WHERE id = ' . (int) $id);
    }    
    
    /**
     * getUnique() - Retourne une demande de contact
     * @access public 
     * @param int $id
     * @return null
     */
    public function getUnique($id){
        $contact = '';
        $requete = $this->_dao->prepare('SELECT * FROM contacts WHERE id = :id');
        $requete->bindValue(':id', (int) $id, \PDO::PARAM_INT);
        $requete->execute();
        $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'library\entities\contactEntity');
        if(($contact = $requete->fetch())){
            $contact->setDateCreation(new \DateTime($contact->getDateCreation()));
            $contact->setDateModification(new \DateTime($contact->getDateModification()));
            return $contact;
        }
        return null;   
    }    
    
    /**
     * getList() - Retourne la liste des deamndes de contact
     * @access public
     * @param int $debut
     * @param int $limite
     * @return clientEntity
     */
    public function getList($debut = -1, $limite = -1, $order = 'dateModification DESC'){
        $sql = 'SELECT contacts.id, contacts.etatId, contacts.typeId, etats.name as nomEtat, types.name as nomType, contacts.nom, contacts.email, contacts.commentaire, contacts.dateCreation, contacts.dateModification FROM contacts LEFT JOIN contacts_etats as etats ON contacts.etatId = etats.id LEFT JOIN contacts_types as types ON contacts.typeId = types.id ORDER BY ' . $order;
        if ($debut != -1 || $limite != -1){
            $sql .= ' LIMIT '.(int) $limite.' OFFSET '.(int) $debut;
        }
        $requete = $this->_dao->query($sql);
        $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'library\entities\contactEntity');
        $contacts = $requete->fetchAll();
        foreach($contacts as $contact){
            $contact->setDateCreation(new \DateTime($contact->getDateCreation()));
            $contact->setDateModification(new \DateTime($contact->getDateModification()));
        }
        $requete->closeCursor();
        return $contacts;
    }     
    
    /**
     * modify() - Modifie une demande de contact
     * @access public
     * @param contactEntity $contact
     */
    public function modify(contactEntity $contact){
        $requete = $this->_dao->prepare('UPDATE contacts SET nom = :nom, email = :email, commentaire = :commentaire, typeId = :typeId, etatId = :etatId, dateModification = NOW() WHERE id = :id');
        $requete->bindValue(':nom', $contact->getNom(), \PDO::PARAM_STR);
        $requete->bindValue(':email', $contact->getEmail(), \PDO::PARAM_STR);
        $requete->bindValue(':commentaire', $contact->getCommentaire(), \PDO::PARAM_STR);
        $requete->bindValue(':typeId', $contact->getTypeId(), \PDO::PARAM_INT);
        $requete->bindValue(':etatId', $contact->getEtatId(), \PDO::PARAM_INT);
        $requete->bindValue(':id', $contact->getId(), \PDO::PARAM_INT);
        $requete->execute();
    }   
}