<?php

namespace applications\backend\modules\contacts;
use library\controllers\backController;
use library\request;
use library\entities\contactEntity;
use library\pagination;

/**
 * Class contactsController
 * @author Vazquez Luis
 * @copyright (c) 2015, Syntesis Management SA
 */
class contactsController extends backController {
    
    /**
     * executeIndex() - Exécute la page index
     * @access public
     * @return void
     */
    public function executeIndex(request $request){
        // Récupère les variables de l'application
        $nbContacts = $this->_application->_config->get('nbContacts');
        // Ajoute un titre à la page
        $this->_page->addVar('title', 'Demande de contacts');
        // Vérifie qu'une page soit demandée
        if($request->getExists('get', 'page')){
            // Récupère le numéro de la page
            $current_page = $request->getData('get', 'page');
            // calcul l'enregistrement de début
            $debut = ($current_page * $nbContacts) - $nbContacts;
        }else{
            $current_page = 1;
            $debut = 0;
        }
        // Récupère la liste des demandes de contacts
        $contacts = $this->_managers->getManagerOf('contacts')->getList($debut, $nbContacts);
        // Ajoute la variable $contacts à la page
        $this->_page->addVar('contacts', $contacts);
        // Récupère le nombre de contacts
        $nbContactsTotal = $this->_managers->getManagerOf('contacts')->count();        
        // Récupère la pagination
        $pagination = new pagination($nbContactsTotal, $nbContacts, $current_page, '/comparateur/admin/contacts/');
        // Ajoute la variable $pagination à la page
        $this->_page->addVar('pagination', $pagination);       
    }
    
    /**
     * executeDelete() - Execute la suppresssion d'une demande de contact
     * @access public
     * @param request $request
     * @return void
     */    
    public function executeDelete(request $request){
        $this->_managers->getManagerOf('contacts')->delete($request->getData('get', 'id'));
        $this->_application->getUser()->setFlash('Ce client à été correctement supprimée !');
        $this->_application->getResponse()->redirect('/comparateur/admin/contacts/');          
    }    
    
    /**
     * executeInsert() - Exécute la page d'insertion d'une demande de contact
     * @access public
     * @param request $request
     * @return void
     */
    public function executeInsert(request $request){
        // Vérifie que le formulaire soit posté
        if($request->getExists('post', 'nom')){
            $this->_processForm($request);
        }
        // Ajoute un titre à la page
        $this->_page->addVar('title', 'Insértion d\'une demande de contact');
        // Récupère la liste des types de contacts
        $contactsTypes = $this->_managers->getManagerOf('contactsTypes')->getList();
        // Ajoute de la variable $contactsTypes à la page
        $this->_page->addVar('contactsTypes', $contactsTypes);
        //Récupère la liste des types de contacts
        $contactsEtats = $this->_managers->getManagerOf('contactsEtats')->getList();
        // Ajoute de la variable $contactsTypes à la page
        $this->_page->addVar('contactsEtats', $contactsEtats);        
    }
    
    /**
     * executeUpdate() - Exécute la page de mise à jour d'une demande de contact
     * @access public
     * @param request $request
     * @return void
     */    
    public function executeUpdate(request $request){
        // Vérifie que le formulaire soit posté
        if($request->getExists('post', 'nom')){
            $this->_processForm($request);
        } else {
            $this->_page->addVar('contact', $this->_managers->getManagerOf('contacts')->getUnique($request->getData('get', 'id')));
        } 
        // Ajoute un titre à la page
        $this->_page->addVar('title', 'Modification d\'une demande de contact');
        //Récupère la liste des types de contacts
        $contactsTypes = $this->_managers->getManagerOf('contactsTypes')->getList();
        // Ajout de la variable $contactsTypes à la page
        $this->_page->addVar('contactsTypes', $contactsTypes);
        //Récupère la liste des types de contacts
        $contactsEtats = $this->_managers->getManagerOf('contactsEtats')->getList();
        // Ajout de la variable $contactsTypes à la page
        $this->_page->addVar('contactsEtats', $contactsEtats);
    }
    
    /**
     * _processForm() - Exécute la processus du formulaire
     * @access private
     * @param request $request
     * @return void
     */
    private function _processForm(request $request) {
        // Hydrate l'entité contact
        $contact = new contactEntity(array(
            'nom' => $request->getData('post', 'nom'),
            'email' => $request->getData('post', 'email'),
            'commentaire' => $request->getData('post', 'commentaire'),
            'typeId' => $request->getData('post', 'typeId'),
            'etatId' => $request->getData('post', 'etatId'),
            'dateCreation' => (new \DateTime)->setTimestamp($request->getData('post', 'dateCreation')),
            'dateModification' => (new \DateTime)->setTimestamp($request->getData('post', 'dateModification'))
        ));
        // Ajoute l'identifiant à l'entité contact
        if($request->getExists('post', 'id')){
            $contact->setId($request->getData('post', 'id'));
        }
        // Vérifie que l'entité contact soit valide
        if($contact->isValid()){
            $this->_managers->getManagerOf('contacts')->save($contact);
            $this->_application->getUser()->setFlash($contact->isNew()?'La demande de contact à bien été ajoutée.':'La demande de contact à bien été modifiée.');
            $this->_application->getResponse()->redirect('/comparateur/admin/contacts/');
        }else{
            $this->_page->addVar('erreurs', $contact->getErrors());
        }
        $this->_page->addVar('contact', $contact);
    }
}