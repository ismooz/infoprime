<?php

namespace applications\backend\modules\regions;
use library\controllers\backController;
use library\request;
use library\entities\regionEntity;
use library\pagination;

/**
 * Class regionsController
 * @author Vazquez Luis
 * @copyright (c) 2015, Syntesis Management SA
 */
class regionsController extends backController {
    
    /**
     * executeIndex() - Execute la page index des régions
     * @access public
     */
    public function executeIndex(request $request){
        // Récupère le nombre de régions
        $nbRegions = $this->_application->_config->get('nbRegions');
        // Ajoute un titre à la page
        $this->_page->addVar('title', 'Régions');
        // Vérifie qu'une page soit demandée
        if($request->getExists('get', 'page')){
            // On récupère le numéro de la page
            $current_page = $request->getData('get', 'page');
            // On calcul l'enregistrement de début
            $debut = ($current_page * $nbRegions) - $nbRegions;
        }else{
            $current_page = 1;
            $debut = 0;
        }       
        // Récupère la liste des régions
        $regions = $this->_managers->getManagerOf('regions')->getList($debut, $nbRegions);
        // Ajoute la variable $regions à la vue.
        $this->_page->addVar('regions', $regions);
        // Récupère le nombre de régions
        $nbRegionsTotal = $this->_managers->getManagerOf('regions')->count();
        // Récupère la pagination
        $pagination = new pagination($nbRegionsTotal, $nbRegions, $current_page, '/comparateur/admin/regions/');
        // Ajoute la variable $pagination à la page
        $this->_page->addVar('pagination', $pagination);
    }    
    
    /**
     * executeInsert() - Execute la page d'insertion d'une région
     * @access public
     * @param request $request
     */
    public function executeInsert(request $request){
        // Vérifie que le formulaire soit posté
        if($request->getExists('post', 'npa')){
            $this->_processForm($request);
        }
        // Ajoute un titre à la page
        $this->_page->addVar('title', 'Insértion d\'une région');
    }    
    
    /**
     * executeUpdate() - Execute la page de mise à jour d'une région
     * @access public
     * @param request $request
     */
    public function executeUpdate(request $request){
        // Vérifie que le formulaire soit posté
        if($request->getExists('post', 'npa')){
            $this->_processForm($request);
        } else {
            // Ajoute l'entité région à la page
            $this->_page->addVar('region', $this->_managers->getManagerOf('regions')->getUnique($request->getData('get', 'id')));
        }
        // Ajoute un titre à la page
        $this->_page->addVar('title', 'Modification d\'une région');
    }
    
    /**
     * executeDelete() - Execute la suppression d'une région
     * @access public
     * @param request $request
     */
    public function executeDelete(request $request){
        // Supprime la région
        $this->_managers->getManagerOf('regions')->delete($request->getData('get', 'id'));
        // Définit le message utilisateur
        $this->_application->getUser()->setFlash('Cette région à été correctement supprimée !');
        // Redirige vers la page index des régions
        $this->_application->getResponse()->redirect('/comparateur/admin/regions/');        
    }
    
    /**
     * _processForm() - Exécute la processus formulaire
     * @access private
     * @param request $request
     */
    private function _processForm(request $request){
        // Vérifie que la méthode du formulaire soit POST
        if($request->getData('method') == 'POST'){
            // Définit les champs de l'entité région
            $region = new regionEntity(array(
                'npa' => $request->getData('post', 'npa'),
                'localite' => $request->getData('post', 'localite'),
                'canton' => $request->getData('post', 'canton'),
                'region' => $request->getData('post', 'region'),
                'no_ofs' => $request->getData('post', 'no_ofs'),
                'commune' => $request->getData('post', 'commune'),
                'district' => $request->getData('post', 'district'),
                'dateCreation' => (new \DateTime)->setTimestamp(strtotime($request->getData('post', 'dateCreation'))),
                'dateModification' => (new \DateTime)->setTimestamp(strtotime($request->getData('post', 'dateModification')))
            ));
            // Ajout l'identifiant de l'entité région
            if($request->getExists('post', 'id')){
                $region->setId($request->getData('post', 'id'));
            }
            // Vérifie que l'entité région soit valide
            if($region->isValid()){
                // Sauvegarde la région
                $this->_managers->getManagerOf('regions')->save($region);
                // Définit le message utilisateur
                $this->_application->getUser()->setFlash($region->isNew()?'La région à bien été ajouté.':'La région à bien été modifié.');
                // Redirige vers la page index des régions
                $this->_application->getResponse()->redirect('/comparateur/admin/regions/');
            }else{
                // Ajoute les erreurs à la page
                $this->_page->addVar('erreurs', $region->erreurs());
                // Ajoute l'entité région à la page
                $this->_page->addVar('region', $region); 
            }
        }
    }
}
