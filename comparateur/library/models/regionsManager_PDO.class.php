<?php

namespace library\models;
use library\models\regionsManager;
use library\entities\regionEntity;

/**
 * Class regionsManager_PDO
 * @author Vazquez Luis
 * @copyright (c) 2015, Syntesis Management SA
 */
class regionsManager_PDO extends regionsManager {
    
    /**
     * add() - Ajoute une région
     * @access protected
     * @param regionEntity $region
     * @return void
     */
    public function add(regionEntity $region){
        $requete = $this->_dao->prepare('INSERT INTO regions SET npa = :npa, localite = :localite, canton = :canton, region = :region, no = :ville, dateCreation = NOW(), dateModification = NOW()');
        $requete->bindValue(':npa', $region->getNpa());
        $requete->bindValue(':localite', $region->getLocalite());
        $requete->bindValue(':canton', $region->getCanton());
        $requete->bindValue(':region', $region->getRegion());
        $requete->bindValue(':no_ofs', $region->getNoOfs());
        $requete->bindValue(':commune', $region->getCommune());
        $requete->bindValue(':district', $region->getDistrict());
        $requete->execute();
    }    
    
    /**
     * count() - Retourne le nombre de régions
     * @access public
     * @param string - Condition de recherche
     * @return int - Nombre de régions
     */     
    public function count($condition = null){
        // Vérifie si une condition de recherche est demandée
        if(!is_null($condition)){
            return $this->_dao->query('SELECT COUNT(*) FROM regions ' . $condition)->fetchColumn();
        }else{
            return $this->_dao->query('SELECT COUNT(*) FROM regions')->fetchColumn();
        }
    }
    
    /**
     * delete() - Supprime une région
     * @access public
     * @param int $id - Identifiant de la région
     * @return void
     */
    public function delete($id) {
        $this->_dao->exec('DELETE FROM regions WHERE id = ' . (int) $id);
    }    
    
    /**
     * getUnique() - Retourne une région
     * @access public 
     * @param int $id - Identifiant de la région
     * @return regionEntity $region ou null
     */
    public function getUnique($id){
        $region = '';
        $requete = $this->_dao->prepare('SELECT * FROM regions WHERE id = :id');
        $requete->bindValue(':id', (int) $id, \PDO::PARAM_INT);
        $requete->execute();
        $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\library\entities\regionEntity');
        if(($region = $requete->fetch())){
            $region->setDateCreation(new \DateTime($region->getDateCreation()));
            $region->setDateModification(new \DateTime($region->getDateModification()));
            return $region;
        }else{
            return null;
        }
    }    
    
    /**
     * getList() - Retourne la liste des régions
     * @access public
     * @param int $debut - Enregistrement de début
     * @param int $limite - Enregistrement de fin
     * @param string $order - Ordre de tri
     * @return array clientEntity $clients
     */
    public function getList($debut = -1, $limite = -1, $order = 'npa ASC'){
        $sql = 'SELECT * FROM regions ORDER BY ' . $order;
        if ($debut != -1 || $limite != -1){
            $sql .= ' LIMIT '.(int) $limite.' OFFSET '.(int) $debut;
        }
        $requete = $this->_dao->query($sql);
        $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'library\entities\regionEntity');
        $regions = $requete->fetchAll();
        foreach($regions as $region){
            $region->setDateCreation(new \DateTime($region->getDateCreation()));
            $region->setDateModification(new \DateTime($region->getDateModification()));
        }
        $requete->closeCursor();
        return $regions;
    }
    
    /**
     * modify() - Modifie une région
     * @access public
     * @param regionEntity $region
     * @return void
     */
    public function modify(regionEntity $region){
        $requete = $this->_dao->prepare('UPDATE regions SET npa = :npa, localite = :localite, canton = :canton, region = :region, no_ofs = :no_ofs, commune = :commune, district = :district, dateModification = NOW() WHERE id = :id');
        $requete->bindValue(':npa', $region->getNpa());
        $requete->bindValue(':localite', $region->getLocalite());
        $requete->bindValue(':canton', $region->getCanton());
        $requete->bindValue(':region', $region->getRegion());
        $requete->bindValue(':no_ofs', $region->getNoOfs());
        $requete->bindValue(':commune', $region->getCommune());
        $requete->bindValue(':district', $region->getDistrict());
        $requete->bindValue(':id', $region->getId(), \PDO::PARAM_INT); 
        $requete->execute();
    }   
}
