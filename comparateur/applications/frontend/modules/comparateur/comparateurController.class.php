<?php

namespace applications\frontend\modules\comparateur;
use library\controllers\frontController;
use library\request;

/**
 * Class HomeController
 */
class comparateurController extends frontController {
    
    /**
     * executeIndex()
     * @access public
     */
    public function executeIndex(){
        // Ajout d'un titre à la page
        $this->_page->addVar('title', 'Contact');
    }
    
    /**
     * executeComparaisons() -
     * @access public
     */
    public function executeComparaisons(request $request){
        // On récupère les variables de l'application
        $nbComparaisons = $this->_application->_config->get('nbComparaisons');
        // Ajout d'un titre à la page
        $this->_page->addVar('title', 'Mes comparaisons');
        
        if($request->getExists('get', 'page')){
            // On récupère le numéro de la page
            $current_page = $request->getData('get', 'page');
            // On clacul l'enregistrement de début
            $debut = ($current_page * $nbComparaisons) - $nbComparaisons;
        }else{
            $current_page = 1;
            $debut = 0;
        }
        // On récupère le manager des news
        $manager = $this->_managers->getManagerOf('clients');
        // On récupère la liste des langues
        $comparaisons = $manager->getList($debut, $nbComparaisons);
        // On ajoute la variable $langues à la vue.
        $this->_page->addVar('comparaisons', $comparaisons);
        // on ajoute la variable $nbLangues à la page
        $this->_page->addVar('nbComparaisons', $nbComparaisons);      
    }
    
    /**
     * executeIndex()
     * @access public
     */
    public function executeFormSecond(request $request){
        // Ajout d'un titre à la page
        $this->_page->addVar('title', 'Formulaire 2');
        // Récupère la liste des status clients
        $assureurs = $this->_managers->getManagerOf('assureurs')->getList();
        // Ajoute la variable $clientsStatus à la page
        $this->_page->addVar('assureurs', $assureurs);
        // Récupère la date de naissance
        $dateNaissance = $request->getData('post', 'dateNaissance');
        // Ajoute la variable $dateNaissance à la page
        $this->_page->addVar('dateNaissance', $dateNaissance);
        // Récupère l'identifiant de la région
        $idRegion = $request->getData('post', 'idRegion');
        // Ajoute la variable $dateNaissance à la page
        $this->_page->addVar('idRegion', $idRegion); 
        // Récupère l'identifiant de la région
        $adresse = $request->getData('post', 'adresse');        
        // Ajoute la variable $adresse à la page
        $this->_page->addVar('adresse', $adresse);       
    }
    
    /**
     * executeIndex()
     * @access public
     */
    public function executeFormThird(){
        // Ajout d'un titre à la page
        $this->_page->addVar('title', 'Formulaire 3');
    }
    
    public function executeProcess(){
        // Ajout d'un titre à la page
        $this->_page->addVar('title', 'Remerciements');
    }

    public function executeProcessFirst(){
        // Ajout d'un titre à la page
        $this->_page->addVar('title', 'Remerciements');
    }
    
    /**
     * executeIndex()
     * @access public
     */
    public function executeFormFourth(){
        // Ajout d'un titre à la page
        $this->_page->addVar('title', 'Formulaire 4');
        // Récupère la liste des langues
        $langues = $this->_managers->getManagerOf('langues')->getList();
        // Ajoute la variable $langues à la page
        $this->_page->addVar('langues', $langues);
        // Récupère la liste des nationalités
        $nationalites = $this->_managers->getManagerOf('nationalites')->getList();
        // Ajoute la variable $nationalites à la page
        $this->_page->addVar('nationalites', $nationalites);        
    }
    
    public function executeProfil(){
        // Ajout d'un titre à la page
        $this->_page->addVar('title', 'Profil');        
    }
    
    private function _process(request $request){
        if($request->getData('method') == 'POST'){
            
        }
    }
}