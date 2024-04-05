<?php

namespace applications\backend\modules\contactsTypes;
use library\controllers\backController;
use library\request;
use library\entities\contactTypeEntity;
use library\pagination;

/**
 * Class contactTypesController
 * @author Vazquez Luis
 * @copyright (c) 2015, Syntesis Management SA
 */
class contactsTypesController extends backController {   
    
    /**
     * executeInsert() - Exécute la page index des types de contacts
     * @access public
     * @param request $request
     * @return void
     */
    public function executeIndex(request $request){
        // Récupère les variables de l'application
        $nbContactsTypes = $this->_application->_config->get('nbContactsTypes');
        // Ajoute un titre à la page
        $this->_page->addVar('title', 'Clients types');
        // Vérifie qu'une page soit demandée
        if($request->getExists('get', 'page')){
            // Récupère le numéro de la page
            $current_page = $request->getData('get', 'page');
            // Calcul l'enregistrement de début
            $debut = ($current_page * $nbContactsTypes) - $nbContactsTypes;
        }else{
            // Définit la page courante
            $current_page = 1;
            // Définit le premier enregistrement
            $debut = 0;
        }
        // Récupère la liste des types de contacts
        $contactsTypes = $this->_managers->getManagerOf('contactsTypes')->getList($debut, $nbContactsTypes);
        // Ajoute la variable $contactTypes à la page
        $this->_page->addVar('contactsTypes', $contactsTypes);
        // Récupère le nombre de status de clients
        $nbContactTypesTotal = $this->_managers->getManagerOf('contactsTypes')->count();        
        // Récupère la pagination
        $pagination = new pagination($nbContactTypesTotal, $nbContactsTypes, $current_page, '/comparateur/admin/contactsTypes/');
        // Ajoute la variable $pagination à la page
        $this->_page->addVar('pagination', $pagination);      
    }
 
    /**
     * executeInsert() - Execute l'insertion d'un type de contact
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
        $this->_page->addVar('title', 'Insértion d\'un type de demande de contact');
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
            $this->_page->addVar('contactType', $this->_managers->getManagerOf('contactsTypes')->getUnique($request->getData('get', 'id')));
        }
        // Ajoute un titre à la page
        $this->_page->addVar('title', 'Modification d\'un type de demande de contact');      
    }     

    /**
     * executeDelete() - Supprime un type de contact
     * @access public
     * @param request $request
     * @return void
     */    
    public function executeDelete(request $request){
        // Supprime le type de demande de contact
        $this->_managers->getManagerOf('contactsTypes')->delete($request->getData('get', 'id'));
        // Définit le message utilisateur
        $this->_application->getUser()->setFlash('Ce type de demande de contact à été correctement supprimée !');
        // Redirige vers la page index des types de demandes de contact
        $this->_application->getResponse()->redirect('/comparateur/admin/contactsTypes/');          
    }
    
    /**
     * _processForm() - Exécute le processus formulaire
     * @access protected
     * @param request $request
     * @return void
     */
    private function _processForm(request $request){      
        // Définit les champs de l'entité contactType
        $contactType = new contactTypeEntity(array(
            'name' => $request->getData('post', 'name'),
            'dateCreation' => (new \DateTime)->setTimestamp($request->getData('post', 'dateCreation')),
            'dateModification' => (new \DateTime)->setTimestamp($request->getData('post', 'Modification'))
        ));
        // Ajoute l'identifiant à l'entité contactType
        if($request->getExists('post', 'id')){
            $contactType->setId($request->getData('post', 'id'));
        }
        // Vérifie que l'entité contactType soit valide
        if($contactType->isValid()){
            // Vérifie que ce soit un nouvel état de contact
            if($contactType->isNew()){
                // Recherche le nouvel état de contact
                $result = $this->_managers->getManagerOf('contactsTypes')->getUniqueName($contactType->getName());
                // Vérifie si le client status existe déjà
                if(!is_null($result)){
                    $contactType->setError(contactTypeEntity::INVALID_EXISTING_NAME);
                    $this->_page->addVar('erreurs', $contactType->getErrors());
                    $this->_page->addVar('contactType', $contactType);                
                }else{
                    $this->_managers->getManagerOf('contactsTypes')->save($contactType);
                    $this->_application->getUser()->setFlash('Le type de la demande de contact à bien été ajouté.');
                    $this->_application->getResponse()->redirect('/comparateur/admin/contactsTypes/');
                } 
            }else{
                $this->_managers->getManagerOf('contactsTypes')->save($contactType);
                $this->_application->getUser()->setFlash('Le type d\'état de la demande de contact à bien été modifié.');
                $this->_application->getResponse()->redirect('/comparateur/admin/contactsTypes/');                 
            }
        }else{
            $this->_page->addVar('erreurs', $contactType->getErrors());
            $this->_page->addVar('contactType', $contactType);
        }        
    }
}
