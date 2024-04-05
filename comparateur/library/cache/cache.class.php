<?php

interface iCache {	   
    public function destroy($aFilename);
    public function getCache($aFilename);
    public function isCached();
    public function setCache();
    public function setPath($aPath);
}

class cache implements iCache {
	   
	   private $_path = null;
	   
	   public function __construct() {
	   	   
	   	   
	   	   
	   }
	   
    // =========================================================
    // Function destroy                                         
    // ----------------                                         
    // Fonction permettant de supprimer le fichier mis en cache 
    // =========================================================
    // Argument : $aFile                                        
    // Valeur de retour : Aucune                                
    // ---------------------------------------------------------
	   public function destroy($aFilename) {
	   	   $filename = $this->_path . md5($aFile);
	   	   unlink($filename);
	   }
	   
    // ======================================================
    // Function getCache                                     
    // -----------------                                     
    // Fonction permettant de retourner la hauteur de l'image
    // ======================================================
    // Argument : Aucun                                      
    // Valeur de retour : Bool�en                            
    // ------------------------------------------------------
	   public function getCache($aFilename) {
	   	   
	   	   $filename = $this->_path . md5($aFilename);
	   	   
	   	   if(file_exists($filename)) {
	   	       
	   	       $content = file_get_contents($filename);
	   	       $content = unserialize($content);
	   	       
	   	       return $content;
	   	       
	   	   } else {
	   	   	   
	   	   	   return false;
	   	   	   
	   	   }
	   	   
           }
           
    /**
     * Méthode : isCached
     * Retourne
     * 
     * @return Booleen 
     */
    public function isCached() {
        return $this->_isCached;
    }
	   
    // ======================================================
    // Function setCache                                     
    // -----------------                                     
    // Fonction permettant de retourner la hauteur de l'image
    // ======================================================
    // Argument : Aucun                                      
    // Valeur de retour : Bool�en                            
    // ------------------------------------------------------
	   public function setCache() {
	   	   
	   	   
	   	   
	   }
	   
    // ======================================================
    // Function setCache                                     
    // -----------------                                     
    // Fonction permettant de retourner la hauteur de l'image
    // ======================================================
    // Argument : Aucun                                      
    // Valeur de retour : Bool�en                            
    // ------------------------------------------------------
	   public function setLifetime($aLifetime) {
	   	   
	   	   $this->_lifetime = intval($aLifetime);
	   	   
	   }
	   
    /**
    * @name setPath - Fonction permettant de modifier le chemin du cache
    * @param  $aPath
    * @return Null
    */
	   public function setPath($aPath) {
	   	   
	   	   
	   	   
	   }
	   
}

?>