<?php

namespace applications\backend\modules\primes;
use library\controllers\backController;
use library\request;
use library\entities\primeEntity;
use library\pagination;

/**
 * Class primesController
 * @author Vazquez Luis
 * @copyright (c) 2015, Syntesis Management SA
 */
class primesController extends backController {

    /**
     * executeIndex() - Execute la page index
     * @access public
     */
    public function executeIndex(request $request){
        // Récupère le nombre de primes
        $nbPrimes = $this->_application->_config->get('nbPrimes');
        // Ajoute un titre à la page
        $this->_page->addVar('title', 'Primes');
        // Vérifie si une page est demandée
        if($request->getExists('get', 'page')){
            // Récupère le numéro de la page courante
            $current_page = $request->getData('get', 'page');
            // Calcul l'enregistrement de début
            $debut = ($current_page * $nbPrimes) - $nbPrimes;
        }else{
            // Définit la page courante
            $current_page = 1;
            // Définit l'enregistrement de début
            $debut = 0;
        }
        // Récupère la liste des primes
        $primes = $this->_managers->getManagerOf('primes')->getList($debut, $nbPrimes);
        // Ajoute la variable $primes à la page.
        $this->_page->addVar('primes', $primes);
        // Récupère le nombre de primes
        $nbPrimesTotal = $this->_managers->getManagerOf('primes')->count();        
        // Récupère la pagination
        $pagination = new pagination($nbPrimesTotal, $nbPrimes, $current_page, '/comparateur/admin/primes/');
        // Ajoute la variable $pagination à la page
        $this->_page->addVar('pagination', $pagination);  
    }   
    
    /**
     * executeInsert() - Exécute la page d'insertion d'une prime
     * @access public
     * @param request $request
     */
    public function executeInsert(request $request){
        // Vérifie que le formulaire soit posté
        if($request->getExists('post', '')){
            $this->_processForm($request);  
        }
        // Ajoute un tire à la page
        $this->_page->addVar('title', 'Insértion d\'une prime');
        // Récupère la liste des status clients
        $assureurs = $this->_managers->getManagerOf('assureurs')->getList();
        // Ajoute la variable $clientsStatus à la page
        $this->_page->addVar('assureurs', $assureurs);
    }
    
    /**
     * executePrimeUpdate() - Exécute la page de mise à jour d'une prime
     * @access public
     * @param request $request
     */
    public function executeUpdate(request $request){
        // Vérifie que le formaulaire soit posté
        if($request->getExists('post', 'assureurId')){
            $this->_processPrimeForm($request);
        }else{
            // Ajoute la prime à la page
            $this->_page->addVar('prime', $this->_managers->getManagerOf('primes')->getUnique($request->getData('get', 'id')));
        }
        // Ajoute un titre à la page
        $this->_page->addVar('title', 'Modification d\'une prime');
        // Récupère la liste des status clients
        $assureurs = $this->_managers->getManagerOf('assureurs')->getList();
        // Ajoute la variable $clientsStatus à la page
        $this->_page->addVar('assureurs', $assureurs);        
    }     
    
    /**
     * executeDelete() - Exécute la page de suppression d'une prime
     * @access public
     * @param request $request
     */
    public function executeDelete(request $request){
        // Supprime la prime
        $this->_managers->getManagerOf('primes')->delete($request->getGetData('id'));
        // Définit le message utilisateur
        $this->_application->getUser()->setFlash('Cette prime à été correctement supprimée !');
        // Redirige vers l'index des primes
        $this->_application->getResponse()->redirect('/comparateur/admin/primes/');        
    }
    
    /**
     * _processForm() - Exécute le processus formulaire
     * @access private
     * @param request $request
     */
    private function _processForm(request $request){
        // Vérifie que la méthode du formulaire soit POST
        if($request->getData('method') == 'POST'){
            // Définit les champs de l'entité primes
            $prime = new primeEntity(array(
                'assureurId' => $request->getData('post', 'assureurId'),
                'canton' => $request->getData('post', 'canton'),
                'exercice' => $request->getData('post', 'exercice'),
                'enquete' => $request->getData('post', 'enquete'),
                'region' => $request->getData('post', 'region'),
                'classe_age' => $request->getData('post', 'classe_age'),
                'accident' => $request->getData('post', 'accident'),
                'tarif' => $request->getData('post', 'tarif'),
                'tarif_type' => $request->getData('post', 'tarif_type'),
                'groupe_age' => $request->getData('post', 'groupe_age'),
                'etat_franchise' => $request->getData('post', 'etat_franchise'),
                'franchise' => $request->getData('post', 'franchise'),
                'prime' => $request->getData('post', 'prime'),
                'sorte' => $request->getData('post', 'sorte'),
                'estBaseP' => $request->getData('post', 'estBaseP'),
                'estBaseF' => $request->getData('post', 'estBaseF'),
                'nom_tarif' => $request->getData('post', 'nom_tarif'),
                'dateCreation' => (new \DateTime)->setTimestamp(strtotime($request->getData('post', 'dateCreation'))),
                'dateModification' => (new \DateTime)->setTimestamp(strtotime($request->getData('post', 'dateModification')))            
            ));
            // Ajoute l'identifiant à l'entité prime
            if($request->getExists('post', 'id')){
                $prime->setId($request->getData('post', 'id'));
            }
            // Vérifie que la prime soit valide
            if($prime->isValid()){
                // Sauvegarde la prime
                $this->_managers->getManagerOf('primes')->save($prime);
                // Définit le message utilisateur
                $this->_application->getUser()->setFlash($prime->isNew()?'La prime à bien été ajouté.':'La prime à bien été modifié.');
                // Redirige vers l'index des primes
                $this->_application->getResponse()->redirect('/comparateur/admin/primes/');
            }else{
                // Récupére les erreurs et les ajoutent à la page
                $this->_page->addVar('erreurs', $prime->erreurs());
                // Ajoute l'entité prime $ la page
                $this->_page->addVar('prime', $prime); 
            }
        }
    }
}
