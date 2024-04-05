<?php

namespace applications\backend\modules\home;
use library\controllers\backController;
use library\request;
use library\entities\contactEntity;

/**
 * Class HomeController
 * @author Vazquez Luis
 * @copyright (c) 2015, Syntesis Management SA
 */
class homeController extends backController {
    
    /**
     * executeIndex() - Exécute la page index
     * @access public
     * @return void
     */
    public function executeIndex(){
        // Ajout d'un titre à la page
        $this->_page->addVar('title', 'Home');
        // Ajout des dernières demandes de contact
        $nbContacts = $this->_managers->getManagerOf('contacts')->count('WHERE etatId="1"');
        // Ajoute la variable $nbContacts à la page
        $this->_page->addVar('nbContacts', $nbContacts);
    }
    
    /**
     * executeContact - Exécute la page index d'une demande de contact
     * @access public
     * @param request $request
     * @return void
     */
    public function executeContact(request $request){
        // Vérifie que le formulaire soit posté
        if($request->getExists('post', 'nom')){
            $this->_processForm($request);
        }
        // Ajoute un titre à la page
        $this->_page->addVar('title', 'Contact');
    }

    /**
     * executeForgot() - Exécute la page d'oubli du mot de passe
     * @access public
     * @param request $request
     * @return void
     */
    public function executeForgot(request $request){
        // Vérifie que le formulaire soit posté
        if($request->getExists('post', 'login')){
            $this->_processForgotForm($request);
        }
        // Ajoute un tire à la page
        $this->_page->addVar('title', 'Mot de passe oublié');
    }    
    
    /**
     * _processForm() - Exécute le processus formulaire
     * @access private
     * @param request $request
     * @return void
     */
    private function _processForm(request $request){
        // Vérifie que la méthode du formulaire soit POST
        if($request->getData('method') == 'POST'){
            // Définit les champs de l'entité contact
            $contact = new contactEntity([
                'nom' => $request->getData('post', 'nom'),
                'email' => $request->getData('post', 'email'),
                'commentaire' => $request->getData('post', 'commentaire'),
                'type' => '1',
                'etat' => '1',
                'dateCreation' => new \DateTime($request->getData('post', 'dateCreation')),
                'dateModification' => new \DateTime($request->getData('post', 'dateModification'))
            ]);
            // Vérifie que l'entité contact soit valide
            if($contact->isValid()){
                $this->_managers->getManagerOf('contacts')->save($contact);
                $this->_application->getUser()->setFlash('La demande de contact à bien été enregistrée.');
                $this->_application->getResponse()->redirect('/comparateur/contacts/');
            }else{
                $this->_page->addVar('erreurs', $contact->getErrors());
                $this->_page->addVar('contactEntity', $contact);
            }
        }        
    }
    
    /**
     * _processForgotForm() - Execute le processus formulaire du mot de passe oublié
     * @access private
     * @param request $request
     */    
    private function _processForgotForm(request $request){
        // Définit le champ de l'entité user
        $user = new userEntity([
            'login' => $request->getData('post', 'login')
        ]);
        // Vérifie que l'entité user soit valid
        if($user->isValid()){
            // Définit le message utilisateur
            $this->_application->getUser()->setFlash('Votre mot de passe vous à été envoyé.');
            // Redirige vers la page index
            $this->_application->getResponse()->redirect('/comparateur/admin/');
        }else{
            // Ajoute la variable erreurs à la page
            $this->_page->addVar('erreurs', $user->getErrors());
        }
        // Ajoute une titre à la page
        $this->_page->addVar('userEntity', $user);       
    }    
}