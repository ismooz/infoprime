<?php

namespace applications\backend\modules\policesTypes;
use library\controllers\backController;
use library\request;
use library\entities\policeTypeEntity;
use library\pagination;

/**
 * Class contactTypesController
 * @author Vazquez Luis
 * @copyright (c) 2015, Syntesis Management SA
 */
class policesTypesController extends backController {   
    
    /**
     * executeInsert() - Exécute la page index des types de polices
     * @access public
     * @param request $request
     * @return void
     */
    public function executeIndex(request $request){
        // Récupère les variables de l'application
        $nbPolicesTypes = $this->_application->_config->get('nbPolicesTypes');
        // Ajoute un titre à la page
        $this->_page->addVar('title', 'Polices types');
        // Vérifie qu'une page soit demandée
        if($request->getExists('get', 'page')){
            // Récupère le numéro de la page
            $current_page = $request->getData('get', 'page');
            // Calcul l'enregistrement de début
            $debut = ($current_page * $nbPolicesTypes) - $nbPolicesTypes;
        }else{
            // Définit la page courante
            $current_page = 1;
            // Définit le premier enregistrement
            $debut = 0;
        }
        // Récupère la liste des types de police
        $policesTypes = $this->_managers->getManagerOf('policesTypes')->getList($debut, $nbPolicesTypes);
        // Ajoute la variable $policesTypes à la page
        $this->_page->addVar('policesTypes', $policesTypes);
        // Récupère le nombre de types de polices
        $nbPolicesTypesTotal = $this->_managers->getManagerOf('policesTypes')->count();        
        // Récupère la pagination
        $pagination = new pagination($nbPolicesTypesTotal, $nbPolicesTypes, $current_page, '/comparateur/admin/policesTypes/');
        // Ajoute la variable $pagination à la page
        $this->_page->addVar('pagination', $pagination);       
    }
 
    /**
     * executeInsert() - Execute l'insertion d'un type de police
     * @access public
     * @param request $request
     * @return void
     */
    public function executeInsert(request $request){
        // Vérifie que le formulaire soit posté
        if($request->getExists('post', 'name')){
            // Exécute le processus formulaire
            $this->_processForm($request);
        }
        // Ajoute un titre à la page
        $this->_page->addVar('title', 'Insértion d\'un type de police');
    }      
    
    /**
     * executeUpdate() - Exécute la mise à jour d'un type de contact
     * @access public
     * @param request $request
     * @return void
     */
    public function executeUpdate(request $request){
        // Vérifie que le formulaire soit posté
        if($request->getExists('post', 'name')){
            // Exécute le processus formulaire
            $this->_processForm($request);
        } else {
            // Ajoute la variable $contactType à la page
            $this->_page->addVar('policeType', $this->_managers->getManagerOf('policesTypes')->getUnique($request->getData('get', 'id')));
        }
        // Ajoute un titre à la page
        $this->_page->addVar('title', 'Modification d\'un type de police');      
    }     

    /**
     * executeDelete() - Supprime un type de contact
     * @access public
     * @param request $request
     * @return void
     */    
    public function executeDelete(request $request){
        // Supprime le type de police
        $this->_managers->getManagerOf('policesTypes')->delete($request->getData('get', 'id'));
        // Définit le message utilisateur
        $this->_application->getUser()->setFlash('Ce type de police à été correctement supprimée !');
        // Redirige vers la page index des types de police
        $this->_application->getResponse()->redirect('/comparateur/admin/policesTypes/');          
    }
    
    /**
     * _processForm() - Exécute le processus formulaire
     * @access protected
     * @param request $request
     * @return void
     */
    private function _processForm(request $request){
        // Vérifie que la méthode du formulaire soit POST
        if($request->getData('method') == 'POST'){
            // Définit les champs de l'entité contactType
            $policeType = new policeTypeEntity(array(
                'name' => $request->getData('post', 'name'),
                'dateCreation' => (new \DateTime)->setTimestamp($request->getData('post', 'dateCreation')),
                'dateModification' => (new \DateTime)->setTimestamp($request->getData('post', 'Modification'))
            ));
            // Ajoute l'identifiant à l'entité contactType
            if($request->getExists('post', 'id')){
                $policeType->setId($request->getData('post', 'id'));
            }
            // Vérifie que l'entité contactType soit valide
            if($policeType->isValid()){
                // Vérifie que ce soit un nouvel état de contact
                if($policeType->isNew()){
                    // Recherche le nouvel état de contact
                    $result = $this->_managers->getManagerOf('policesTypes')->getUniqueName($policeType->getName());
                    // Vérifie si le client status existe déjà
                    if(!is_null($result)){
                        $policeType->setError(policeTypeEntity::INVALID_EXISTING_NAME);
                        $this->_page->addVar('erreurs', $policeType->getErrors());
                        $this->_page->addVar('policeType', $policeType);                
                    }else{
                        $this->_managers->getManagerOf('policesTypes')->save($policeType);
                        $this->_application->getUser()->setFlash('Le type de la police à bien été ajouté.');
                        $this->_application->getResponse()->redirect('/comparateur/admin/policesTypes/');
                    } 
                }else{
                    $this->_managers->getManagerOf('policesTypes')->save($policeType);
                    $this->_application->getUser()->setFlash('Le type de police à bien été modifié.');
                    $this->_application->getResponse()->redirect('/comparateur/admin/policesTypes/');                 
                }
            }else{
                $this->_page->addVar('erreurs', $policeType->getErrors());
                $this->_page->addVar('policeType', $policeType);
            }
        }
    }
}
