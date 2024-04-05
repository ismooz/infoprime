<?php

namespace library\models;
use library\models\primesManager;
use library\entities\primeEntity;

/**
 * Class primesManager_PDO
 * @author Vazquez Luis
 * @copyright (c) 2015, Syntesis Management SA
 */
class primesManager_PDO extends primesManager {
    
    /**
     * add() - Ajoute une prime
     * @access protected
     * @param primeEntity $prime
     */
    public function add(primeEntity $prime){
        $requete = $this->_dao->prepare('INSERT INTO primes SET assureurId = :assureurId, canton = :canton, exercice = :exercice, enquete = :enquete, region = :region, classe_age = :classe_age, etat_franchise = :etat_franchise, franchise = :franchise, prime = :prime, sorte = :sorte, estBaseP = :estBaseP, estBaseF = :estBaseF, nom_tarif = :nom_tarif');
        $requete->bindValue(':assureurId', $prime->getAssureurId());
        $requete->bindValue(':canton', $prime->getCanton());
        $requete->bindValue(':exercice', $prime->getExercice());
        $requete->bindValue(':enquete', $prime->getEnquete());
        $requete->bindValue(':region', $prime->getRegion());
        $requete->bindValue(':classe_age', $prime->getClasseAge());
        $requete->bindValue(':etat_franchise', $prime->getEtatFranchise());
        $requete->bindValue(':franchise', $prime->getFranchise());
        $requete->bindValue(':prime', $prime->getPrime());
        $requete->bindValue(':sorte', $prime->getSorte());
        $requete->bindValue(':estBaseP', $prime->getEstBaseP());
        $requete->bindValue(':estBaseF', $prime->getEstBaseF());
        $requete->bindValue(':nom_tarif', $prime->nom_tarif());
        $requete->execute();
    }    
    
    /**
     * count() - Retourne le nombre de primes
     * @access public
     * @param string - Condition de recherche
     * @return int - Nombre de primes
     */     
    public function count($condition = null){
        // Vérifie si une condition de recherche est demandée
        if(!is_null($condition)){
            return $this->_dao->query('SELECT COUNT(*) FROM primes ' . $condition)->fetchColumn();
        }else{
            return $this->_dao->query('SELECT COUNT(*) FROM primes')->fetchColumn();
        }
    }
    
    /**
     * delete() - Supprime une prime
     * @access public
     * @param int $id - Identifiant de la prime
     * @return void
     */
    public function delete($id) {
        $this->_dao->exec('DELETE FROM primes WHERE id = ' . (int) $id);
    }    
    
    /**
     * getUnique() - Retourne une prime
     * @access public 
     * @param int $id - Identifiant de la prime
     * @return primeEntity $prime ou null
     */
    public function getUnique($id){
        $prime = '';
        $requete = $this->_dao->prepare('SELECT * FROM primes WHERE id = :id');
        $requete->bindValue(':id', (int) $id, \PDO::PARAM_INT);
        $requete->execute();
        $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\library\entities\primeEntity');
        if(($prime = $requete->fetch())){
            $prime->setDateCreation(new \DateTime($prime->getDateCreation()));
            $prime->setDateModification(new \DateTime($prime->getDateModification()));
            return $prime;
        }else{
            return null;  
        }
    }    
    
    /**
     * getList() - Retourne la liste des primes
     * @access public
     * @param int $debut - Enregistrement de début
     * @param int $limite - Enregistrement de fin
     * @return array primeEntity $prime
     */
    public function getList($debut = -1, $limite = -1, $order = 'assureurId'){
        $sql = 'SELECT * FROM primes ORDER BY ' . $order;
		echo $sql;
        if ($debut != -1 || $limite != -1){
            $sql .= ' LIMIT '.(int) $limite.' OFFSET '.(int) $debut;
        }
        $requete = $this->_dao->query($sql);
        $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'library\entities\primeEntity');
        $primes = $requete->fetchAll();
//        foreach($primes as $prime){
//            $prime>setDateCreation(new \DateTime($prime->getDateCreation()));
//            $prime->setDateModification(new \DateTime($prime->getDateModification()));
//        }
        $requete->closeCursor();
        return $primes;
    }     
    
    /**
     * modify() - Modifie une prime
     * @access public
     * @param primeEntity $prime
     * @return void
     */
    public function modify(primeEntity $prime){
        $requete = $this->_dao->prepare('UPDATE clients SET assureurId = :assureurId, canton = :canton, exercice = :exercice, enquete = :enquete, region = :region, classe_age = :classe_age, accident = :accident, tarif = :tarif, tarif_type = :tarif_type, groupe_age = :groupe_age, etat_franchise = :etat_franchise, franchise = :franchise, prime = :prime, sorte = :sorte, estBaseP = :estBaseP, estBaseF = :estBaseF, nom_tarif = :nom_tarif WHERE id = :id');        
        $requete->bindValue(':assureurId', $prime->getAssureurId(), \PDO::PARAM_INT);
        $requete->bindValue(':canton', $prime->getCanton(), \PDO::PARAM_INT);
        $requete->bindValue(':exercice', $prime->getExercice(), \PDO::PARAM_INT);
        $requete->bindValue(':enquete', $prime->getEnquete(), \PDO::PARAM_STR);
        $requete->bindValue(':region', $prime->getRegion(), \PDO::PARAM_STR);
        $requete->bindValue(':classe_age', $prime->getClasseAge(), \PDO::PARAM_STR);
        $requete->bindValue(':accident', $prime->getAccident(), \PDO::PARAM_STR);
        $requete->bindValue(':tarif', $prime->getTarif(), \PDO::PARAM_STR);
        $requete->bindValue(':tarif_type', $prime->getTarifType(), \PDO::PARAM_STR);
        $requete->bindValue(':groupe_age', $prime->getGroupeAge(), \PDO::PARAM_STR);
        $requete->bindValue(':etat_franchise', $prime->getEtatFranchise()->format('U'), \PDO::PARAM_INT);
        $requete->bindValue(':franchise', $prime->getFranchise()->format('U'), \PDO::PARAM_INT);
        $requete->bindValue(':prime', $prime->getPrime()->format('U'), \PDO::PARAM_INT);
        $requete->bindValue(':sorte', $prime->getSorte()->format('U'), \PDO::PARAM_INT);
        $requete->bindValue(':estBaseP', $prime->getEstBaseP()->format('U'), \PDO::PARAM_INT);
        $requete->bindValue(':estBaseF', $prime->getEstBaseF()->format('U'), \PDO::PARAM_INT);
        $requete->bindValue(':nom_tarif', $prime->getNomTarif(), \PDO::PARAM_INT);
        $requete->bindValue(':id', $prime->getId(), \PDO::PARAM_INT); 
        $requete->execute();
    }   
}