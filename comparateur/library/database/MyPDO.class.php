<?php

namespace library\database;

/**
 * Class MyPDO
 * @author Ismaël gashi
 * @copyright (c) 2022, InfoPrime
*/
class MyPDO {
    
    /**
     * Instance de la class
     * @var object 
    */
    private static $_instance;
    
    /**
     * Instance de la class pdo
     * @var object
     */
    private $_pdoInstance;
    
    /**
     * options de la base de données
     * @var array 
     */
    private $_options = array(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    
    /**
     * Constructeur
     */
    private function __construct($dsn, $user, $password) {
        try{
            $this->_pdoInstance = new \PDO($dsn, $user, $password, $this->_options);
            $this->_pdoInstance->exec('SET NAMES utf8');
        }catch(PDOException $e){
            throw $e;
        }
    }
    
    /**
     * Exécute une requête SQL et retourne le nombre de lignes affectées
     * @param type $query
     * @return int 
     */
    public function exec($query){
        return $this->_pdoInstance->exec($query);
    }
    
    /**
     * Récupère un attribut d'une connexion à une base de données 
     * @param string $attribute
     * @return value of attribut or null
     */
    public function getAttribute($attribute){
        return $this->_pdoInstance->getAttribute($attribute);
    }
    
    /**
     * Singelton de la class
     * @param type $dsn
     * @param type $username
     * @param type $passwd
     * @param type $options
     * @return type
     */
    public static function getInstance($dsn, $user, $password){
        if(is_null(self::$_instance)){
            self::$_instance = new self($dsn, $user, $password);
        }
        return self::$_instance;
    }    
    
    /**
     * lastInsertId - retourne le dernier identifiant inséré
     * @param string $name
     * @return int
     */
    public function lastInsertId($name = null){
        return $this->_pdoInstance->lastInsertId($name);
    }
    
    /**
     * Prépare une requête à l'exécution et retourne un objet 
     * @param type $statement
     * @return object PDO statement or false
     */
    public function prepare($statement){
        return $this->_pdoInstance->prepare($statement);
    }    
    
    /**
     * Protège une chaîne pour l'utiliser dans une requête SQL PDO 
     * @param string $string
     * @return a quoted string or false
     */
    public function quote($string){
        return $this->_pdoInstance->quote($string);
    }
    
    /**
     * Configure un atribut PDO 
     * @param string $attribute
     * @param string $value
     * @return boolean true or false
     */
    public function setAttribute($attribute, $value){
        return $this->_pdoInstance->setAttribute($attribute, $value);
    }
    
    /**
     * Exécute une requête SQL, retourne un jeu de résultats en tant qu'objet PDOStatement 
     * @param string $statement
     * @return object PDO statement or false
     */
    public function query($statement){
        return $this->_pdoInstance->query($statement);
    }
}