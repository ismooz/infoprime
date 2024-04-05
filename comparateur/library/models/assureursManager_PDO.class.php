<?php

namespace library\models;
use library\models\assureursManager;
use library\entities\assureurEntity;

/**
 * Class clientsManager_PDO
 * @author Vazquez Luis
 * @copyright (c) 2015, Syntesis Management SA
 */
class assureursManager_PDO extends assureursManager {
    
    /**
     * add() - Ajoute un client
     * @access protected
     * @param clientEntity $assureur
     */
    public function add(assureurEntity $assureur){
        $requete = $this->_dao->prepare('INSERT INTO assureurs SET name = :name, dateCreation = NOW(), dateModification = NOW()');
        $requete->bindValue(':name', $assureur->getName());
        $requete->execute();
    }    
    
    /**
     * count() - Retourne le nombre d'assureurs
     * @access public
     * @param string - Condition de recherche
     * @return int - Nombre d'assureurs
     */     
    public function count($condition = null){
        // Vérifie si une condition de recherche est demandée
        if(!is_null($condition)){
            return $this->_dao->query('SELECT COUNT(*) FROM assureurs ' . $condition)->fetchColumn();
        }else{
            return $this->_dao->query('SELECT COUNT(*) FROM assureurs')->fetchColumn();
        }
    }
    
    /**
     * delete() - Supprime un assureur
     * @access public
     * @param int $id - Identifiant de l'assureur
     * @return void
     */
    public function delete($id) {
        $this->_dao->exec('DELETE FROM assureurs WHERE id = ' . (int) $id);
    }    
    
    /**
     * getUnique() - Retourne un client
     * @access public 
     * @param int $id - Identifiant du client
     * @return clientEntity $client ou null
     */
    public function getUnique($id){
        $assureur = '';
        $requete = $this->_dao->prepare('SELECT * FROM assureurs WHERE id = :id');
        $requete->bindValue(':id', (int) $id, \PDO::PARAM_INT);
        $requete->execute();
        $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\library\entities\assureurEntity');
        if(($assureur = $requete->fetch())){
            $assureur->setDateCreation(new \DateTime($assureur->getDateCreation()));
            $assureur->setDateModification(new \DateTime($assureur->getDateModification()));
            return $assureur;
        }
        return null;  
    }    

    /**
     * getUnique() - Retourne un assureur par son nom
     * @access public 
     * @param int $name - Identifiant de l'assureur
     * @return assureurEntity $assureur ou null
     */
    public function getUniqueName($name){
        $assureur = '';
        $requete = $this->_dao->prepare('SELECT * FROM assureurs WHERE name = :name');
        $requete->bindValue(':name', $name, \PDO::PARAM_STR);
        $requete->execute();
        $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\library\entities\assureurEntity');
        if(($assureur = $requete->fetch())){
            $assureur->setDateCreation(new \DateTime($assureur->getDateCreation()));
            $assureur->setDateModification(new \DateTime($assureur->getDateModification()));
            return $assureur;
        }
        return null;  
    }  
    
    /**
     * getList() - Retourne la liste des deamndes de contact
     * @access public
     * @param int $debut - Enregistrement de début
     * @param int $limite - Enregistrement de fin
     * @return array clientEntity $clients
     */
    public function getList($debut = -1, $limite = -1, $order = 'name'){
        $sql = 'SELECT * FROM assureurs ORDER BY ' . $order;
        if ($debut != -1 || $limite != -1){
            $sql .= ' LIMIT '.(int) $limite.' OFFSET '.(int) $debut;
        }
        $requete = $this->_dao->query($sql);
        $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'library\entities\assureurEntity');
        $assureurs = $requete->fetchAll();
        foreach($assureurs as $assureur){
            $assureur->setDateCreation(new \DateTime($assureur->getDateCreation()));
            $assureur->setDateModification(new \DateTime($assureur->getDateModification()));
        }
        $requete->closeCursor();
        return $assureurs;
    }    

    /**
     * modify() - Modifie un assureur
     * @access public
     * @param assureurEntity $assureur
     * @return void
     */
    public function modify(assureurEntity $assureur){
        $requete = $this->_dao->prepare('UPDATE assureurs SET name = :name, dateModification = NOW() WHERE id = :id');
        $requete->bindValue(':name', $assureur->getName(), \PDO::PARAM_INT);
        $requete->bindValue(':id', $assureur->getId(), \PDO::PARAM_INT); 
        $requete->execute();
    }   
}