<?php

namespace library;

class comparateur {
    
    /**
     * @access private
     * @var object
     */
    private $_db;
    
    /**
     * @access private
     * @var int
     */
    private $_nbChildren;
    
    /**
     * @access private
     * @var array
     */
    private $_options;
    
    /**
     * @access private
     * @var array
     */
    private $_queries = array();
    
    /**
     * @access private
     * @var array -  
     */
    private $_region = array();
    
    /**
     * Constructor
     * @param array $options
     */
    public function __construct(array $options = array()) {
        $this->_db = database\MyPDO::getInstance(DB_DSN, DB_USER, DB_PASS);
        $this->_options = $options;
        $this->_region = $this->_getRegion($this->_options['idRegion']);
        $this->_children = $this->_countChildren();  
        $this->_buildQueries();
    }
    
    /**
     * _countChildren() - Calcule le nombre d'enfants
     */
    private function _countChildren(){
        for($i=1;$i<=$this->_options['nbAssures'];$i++){
            if($this->_getClasseAge($this->_options['naissance-' . $i]) === 'AKL-KIN'){
                $this->_nbChildren++;
            }
        }
    }     
    
    /**
     * _getAccident() - Retourne  
     * @param string $accident
     * @return string
     */
    public function _getAccident($accident){
        if($accident === 'avec'){
            return 'MIT-UNF';
        } else {
            return 'OHN-UNF';
        }
    }      
    
    /**
     * getAssureur() - Retourne le nom de l'assureur d'après son identifiant
     * @param int $id Identifiant de l'assureur
     * @return string Nom de l'assureur
     */
    public function getAssureur($id){
        $sql = 'SELECT name FROM assureurs WHERE id=' . $id;
        $stmt = $this->_db->query($sql);
        return $stmt->fetch(\PDO::FETCH_COLUMN);
    }
    
    /**
     * _getClasseAge() -
     * @param type $dateNaissance
     * @return string
     */
    private function _getClasseAge($dateNaissance){
        // Calcul de l'age de l'assuré
        $age = date('Y') - $dateNaissance;
        // Définition de la class d'age
        switch(true){
            case($age >= 26):
                return 'AKL-ERW';
            case($age < 26 & $age >= 19):
                return 'AKL-JUG';
            case($age < 19):
                return 'AKL-KIN';
        }        
    }
    
    /**
     * _getGroupeAge() - Retourne le groupe d'age
     * @access private
     * @return string
     */
    private function _getGroupeAge(){
        if($this->_options['assureurId'] == 1542){  // Spécifique à l'assureur assura
            switch(true){
                case($this->_children <= 1):
                    return "K1";
                case($this->_children <= 2):
                    return "K2";
                case($this->_children > 2):
                    return "K3";
                default:
                    return "";
            }
        }else{// Autre assureurs
            switch(true){
                case($this->_children <= 1):
                    return "K1";
                case($this->_children > 1):
                    return "K2";
                default:
                    return "";                    
            }
        }
    }    
    
    /**
     * getRegion() - Retourne tous les champs de la région
     * @param int $id - Identifiant de la région
     * @return array - Tableau contenant tous les champs de la région
     */
    private function _getRegion($id){
        $sql = 'SELECT * FROM regions WHERE id=' . $id;
        $stmt = $this->_db->query($sql);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
    
    /**
     * _getTarifType() - Retourne la condition selon les tarifs types sélectionnés
     * @access private
     * @return string
     */
    private function _getTarifType(){
        $condition = 'tarif_type=(';
        if(isset($this->_options['standard'])){
            $condition .= '"TAR-BASE" OR ';
        }
        if(isset($this->_options['autre']) OR isset($this->_options['telnet'])){
            $condition .= '"TAR-DIV" OR ';
        }        
        if(isset($this->_options['medecinFamille'])){
            $condition .= '"TAR-HAM" OR ';
        }
        if(isset($this->_options['hmo'])){
            $condition .= '"TAR-HMO" OR ';
        }
        return substr($condition, 0, strlen($condition) - 4) . ')';
    }
    
    private function _buildQueries(){
        $enfants = 0;
        for($i=1;$i<=$this->_options['nbAssures'];$i++){
            if($this->_getClasseAge($this->_options['naissance-' . $i]) !== 'AKL-KIN'){
                $this->_queries[] = 'SELECT "personne' . $i . '" personne, assureurId, accident, tarif, tarif_type, franchise, prime FROM primes WHERE canton="' . $this->_region['canton'] . '" AND region="PR-REG CH' . $this->_region['region'] . '" AND classe_age="' . $this->_getClasseAge($this->_options['naissance-' . $i]) . '" AND accident="' . $this->_getAccident($this->_options['accident-' . $i]) . '" AND ' . $this->_getTarifType() . ' AND franchise="FRA-' . $this->_options['franchise-' . $i] . '"';
            }else{
                $enfants++;
//                if($enfants <= 2){
//                    $query = 'SELECT personne' . $i . '_1.personne, personne' . $i . '_1.assureurId, personne' . $i . '_1.accident, personne' . $i . '_1.tarif, personne' . $i . '_1.tarif_type, personne' . $i . '_1.prime AS prime FROM';
//                }
//                if($enfants >= 3){
//                    $query = 'SELECT personne' . $i . '_1.personne, personne' . $i . '_1.assureurId, personne' . $i . '_1.accident, personne' . $i . '_1.tarif, personne' . $i . '_1.tarif_type, IF(personne' . $i . '_3.prime IS NULL, IF(personne' . $i . '_2.prime IS NULL, personne' . $i . '_1.prime, personne' . $i . '_2.prime), personne' . $i . '_3.prime) AS prime FROM';
//                }
                $query = 'SELECT personne' . $i . '_1.personne, personne' . $i . '_1.assureurId, personne' . $i . '_1.accident, personne' . $i . '_1.tarif, personne' . $i . '_1.tarif_type, personne' . $i . '_1.franchise, IF((' . $enfants . ' = 1) AND (' . $this->_nbChildren . ' = 1), personne' . $i . '_1.prime, IF((personne' . $i . '_1.assureurId = "1060") OR (personne' . $i . '_1.assureurId = "1509") OR (personne' . $i . '_1.assureurId = "1575"), IF(' . $enfants . ' = 1, personne' . $i . '_1.prime, personne' . $i . '_2.prime), IF(personne' . $i . '_1.assureurId = "1542", IF(' . $this->_nbChildren . ' = 2, personne' . $i . '_2.prime, personne' . $i . '_3.prime), IF((personne' . $i . '_1.assureurId = "290") OR (personne' . $i . '_1.assureurId = "1555") OR (personne' . $i . '_1.assureurId = "1568") OR (personne' . $i . '_1.assureurId = "1570") OR (personne' . $i . '_1.assureurId = "1384") OR (personne' . $i . '_1.assureurId = "1565") OR (personne' . $i . '_1.assureurId = "1566") OR (personne' . $i . '_1.assureurId = "994") OR (personne' . $i . '_1.assureurId = "881") OR (personne' . $i . '_1.assureurId = "455") OR (personne' . $i . '_1.assureurId = "182"), IF(' . $enfants . ' <= 2, personne' . $i . '_1.prime, personne' . $i . '_2.prime), personne' . $i . '_1.prime)))) AS prime FROM';
                $query .= ' (SELECT "personne' . $i . '" personne, assureurId, accident, tarif, tarif_type, franchise, prime FROM primes WHERE canton="' . $this->_region['canton'] . '" AND region="PR-REG CH' . $this->_region['region'] . '" AND classe_age="' . $this->_getClasseAge($this->_options['naissance-' . $i]) . '" AND accident="' . $this->_getAccident($this->_options['accident-' . $i]) . '" AND ' . $this->_getTarifType() . ' AND franchise="FRA-' . $this->_options['franchise-' . $i] . '" AND groupe_age="K1") AS personne' . $i . '_1'; 
                $query .= ' LEFT JOIN (SELECT "personne' . $i . '" personne, assureurId, accident, tarif, tarif_type, franchise, prime FROM primes WHERE canton="' . $this->_region['canton'] . '" AND region="PR-REG CH' . $this->_region['region'] . '" AND classe_age="' . $this->_getClasseAge($this->_options['naissance-' . $i]) . '" AND accident="' . $this->_getAccident($this->_options['accident-' . $i]) . '" AND ' . $this->_getTarifType() . ' AND franchise="FRA-' . $this->_options['franchise-' . $i] . '" AND groupe_age="K2") AS personne' . $i . '_2 ON personne' . $i . '_1.assureurId=personne' . $i . '_2.assureurId AND personne' . $i . '_1.tarif=personne' . $i . '_2.tarif AND personne' . $i . '_1.tarif_type=personne' . $i . '_2.tarif_type';  
                $query .= ' LEFT JOIN (SELECT "personne' . $i . '" personne, assureurId, accident, tarif, tarif_type, franchise, prime FROM primes WHERE canton="' . $this->_region['canton'] . '" AND region="PR-REG CH' . $this->_region['region'] . '" AND classe_age="' . $this->_getClasseAge($this->_options['naissance-' . $i]) . '" AND accident="' . $this->_getAccident($this->_options['accident-' . $i]) . '" AND ' . $this->_getTarifType() . ' AND franchise="FRA-' . $this->_options['franchise-' . $i] . '" AND groupe_age="K3") AS personne' . $i . '_3 ON personne' . $i . '_2.assureurId=personne' . $i . '_3.assureurId AND personne' . $i . '_2.tarif=personne' . $i . '_3.tarif AND personne' . $i . '_2.tarif_type=personne' . $i . '_2.tarif_type';
                //echo($query . '<br/><br/>');
                $this->_queries[] = $query;
            }
        }
    }
    
    /**
     * _mergeQueries() - Raccorde les requêtes pour chaque clients
     * @return string
     */
    private function _mergeQueries(){
        $sql = '';
        for($i=1;$i<=count($this->_queries);$i++){
            if($i == count($this->_queries)){
                $sql .= '(' . $this->_queries[$i - 1] . ') as personne_' . $i;
            }else{
                $sql .= '(' . $this->_queries[$i - 1] . ') as personne_' . $i . ' INNER JOIN ';
            }
        }
        return $sql;
    }
    
    /**
     * getCurrentPrime() - Retourne un tableau contenant la prime courante
     * @return array
     */
    public function getCurrentPrime(){
        $sql = 'SELECT * FROM (' . $this->queryTotal() . ') AS actuelle WHERE tarif_type="TAR-BASE" AND assureurID=' . $this->_options['assureur'];
        $stmt = $this->_db->query($sql);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }    
    
    /**
     * querieTotal() -
     * @return string
     */
    public function queryTotal(){
        
        $sql = 'SELECT "personneTotal_1" personne, personne_1.assureurId, personne_1.tarif, personne_1.tarif_type, ';
        
        if($this->_options['nbAssures'] == 1){
            $sql = "SELECT 'personneTotal_1' personne, personne_1.assureurId, personne_1.tarif, personne_1.tarif_type, personne_1.accident as accident_1, personne_1.prime as personne_1, personne_1.prime as personneTotal FROM (" . $this->_queries[0] . ") as personne_1 ORDER BY personneTotal";
        } else {
            for($i=1;$i<=$this->_options['nbAssures'];$i++){
                $sql .= 'personne_' . $i . '.accident as accident_' . $i . ', ';
            }
            for($i=1;$i<=$this->_options['nbAssures'];$i++){
                $sql .= 'personne_' . $i . '.prime as personne_' . $i . ', ';
            }
            for($i=1;$i<=$this->_options['nbAssures'];$i++){
                $sql .= 'personne_' . $i . '.prime';
                if($i != $this->_options['nbAssures']){
                    $sql .= '+';
                }
            }
            $sql .= ' as personneTotal ';
            $sql .= 'FROM ' . $this->_mergeQueries();
            $sql .= ' ON ';
            for($i=1;$i<=$this->_options['nbAssures'];$i++){
                $sql .= 'personne_1.assureurId = personne_' . $i . '.assureurId AND ';
            }
            for($i=1;$i<=$this->_options['nbAssures'];$i++){
                $sql .= 'personne_1.tarif_type = personne_' . $i . '.tarif_type AND ';
            }
            for($i=1;$i<=$this->_options['nbAssures'];$i++){
                $sql .= 'personne_1.tarif = personne_' . $i . '.tarif ';
                if($i != $this->_options['nbAssures']){
                    $sql .= 'AND ';
                }
            }
            $sql .= 'ORDER BY personneTotal';
        }
        return $sql;
    }    
}