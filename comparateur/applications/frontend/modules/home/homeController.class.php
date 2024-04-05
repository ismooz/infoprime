<?php

namespace applications\frontend\modules\home;
use library\controllers\frontController;
use library\request;
use library\entities\clientEntity;
use library\entities\contactEntity;
use library\entities\utilisateurEntity;

/**
 * Class HomeController
 * @author Vazquez Luis
 * @copyright (c) 2015, Syntesis Management SA
 */
class homeController extends frontController {
    
    /**
     * executeIndex()
     * @access public
     * @param request $request
     * @return void
     */
    public function executeIndex(request $request){
        if($request->getExists('post', 'login')){
            $this->_processForm($request);
        }
        // Ajout d'un titre à la page
        $this->_page->addVar('title', 'Home');
    }
    
    /**
     * executeInfos() - Exécute la page d'informations utiles
     * @access public
     * @return void
     */
    public function executeInfos(){
        // Ajoute un titre à la page
        $this->_page->addVar('title', 'Information');
    }
    
    /**
     * executeContact()
     * @access public
     * @param request $request
     * @return void
     */
    public function executeContact(request $request){
        // Vérifie si le formulaire à été posté
        if($request->getExists('post', 'nom')){
            // Exécute le processus formulaire
            $this->_processContactForm($request);
        }
        // Ajoute un titre à la page
        $this->_page->addVar('title', 'Contact');
    }    
    
    /**
     * executeForgot() - Exécute la page d'oublis du mot de passe
     * @access public
     * @param request $request
     * @return void
     */
    public function executeForgot(request $request){
        // Vérifie si le formulaire à été posté
        if($request->getExists('post', 'login')){
            // Exécute le processus formulaire
            $this->_processForgotForm($request);
        }
        // Ajoute un titre à la page
        $this->_page->addVar('title', 'Mot de passe oublié');
    }    
    
    /**
     * executeInscription() - Exécute la page d'inscription
     * @access public
     * @param request $request
     * @return void
     */
    public function executeInscription(request $request){
        if($request->getExists('post', 'nom')){
            $this->_processInscriptionForm($request);
        }
        $langues = $this->_managers->getManagerOf('langues')->getList();
        $this->_page->addVar('langues', $langues);        
        $nationalites = $this->_managers->getManagerOf('nationalites')->getList();
        $this->_page->addVar('nationalites', $nationalites);        
        $this->_page->addVar('title', 'Insctipion');
    }    
    
    /**
     * executeDeconnexion() - Execute la déconnexion de l'utilisateur
     * @access public
     * @return void
     */
    public function executeDeconnexion(){
        // Définit l'uitilisateur non authentifié
        $this->_application->getUser()->setAuthenticated(false);
        // Défiinit le message utilisateur
        $this->_application->getUser()->setFlash('Vous avez été correctement déconnecté !');
        // Redirige vers la page index
        $this->_application->getResponse()->redirect('/comparateur/');        
    }
    
    /**
     * _processForm() - Exécute le processus formulaire
     * @access private
     * @param request $request
     * @return void
     */
    private function _processForm(request $request){
        if($request->getData('method') == 'POST'){
            $user = new utilisateurEntity(array(
                'login' => $request->getData('post', 'login'),
                'password' => $request->getData('post', 'password')
            ));
            // Récupère le manager de la connexion
            $manager = $this->_managers->getManagerOf('connexion');
            // Récupère les information d'authentification
            $auth = $manager->getUser($user->getLogin());
            // Vérifie l'authentification
            if($user->getLogin() == ''){
                $this->_application->getUser()->setFlash('Veuillez insérer un nom d\'utilisateur');
            }elseif(is_null($auth)){
                $this->_application->getUser()->setFlash('Le nom d\'utilisateur est incorrect');
            }elseif($user->getPassword() == ''){
                $this->_application->getUser()->setFlash('Veuillez insérer un mot de passe');
            }elseif($auth['password'] !== $user->getPassword()) {
                $this->_application->getUser()->setFlash('Le mot de passe est incorrect !');
            }else{
                $this->_application->getUser()->setAttribute('userId', $auth['id']);
                $this->_application->getUser()->setAuthenticated();
                $this->_application->getResponse()->redirect('.');       
            }
            $this->_page->addVar('userEntity', $user);
        }        
    }
    
    /**
     * _processContactForm() - Exécute le processus formulaire de la demande de contact
     * @access private
     * @param request $request
     * @return void
     */
    private function _processContactForm(request $request) {
        // Vérifie que la méthode du formulaire soit POST
        if($request->getData('method') == 'POST'){
            // Hydrate l'entité contact
            $contact = new contactEntity(array(
                'nom' => $request->getData('post', 'nom'),
                'email' => $request->getData('post', 'email'),
                'commentaire' => $request->getData('post', 'commentaire'),
                'type' => '2',
                'etat' => '1',
                'dateCreation' => new \DateTime($request->getData('post', 'dateCreation')),
                'dateModification' => new \DateTime($request->getData('post', 'dateModification'))
            ));
            // Ajoute l'identifiant au contact
            if($request->getExists('post', 'id')){
                $contact->setId($request->getData('post', 'id'));
            }            
            // Vérifie que le contact soit valide
            if($contact->isValid()){
                $this->_managers->getManagerOf('contacts')->save($contact);
                $this->_application->getUser()->setFlash('La demande de contact à bien été enregistrée.');
                $this->_application->getResponse()->redirect('/comparateur/');
            }else{
                $this->_page->addVar('erreurs', $contact->getErrors());
                $this->_page->addVar('contactEntity', $contact);
            }
        }
    }    
    
    /**
     * _processInscriptionForm() - Exécute le processus formulaire d'inscription
     * @access private
     * @param request $request
     * @return void
     */
    private function _processInscriptionForm(request $request){
        // Vérifie que la méthode du formulaire soit POST
        if($request->getData('method') == 'POST'){
            // Hydrate l'entité utilisateurEntity
            $userEntity = new utilisateurEntity(array(
                'login' => $request->getData('post', 'login'),
                'password' => $request->getData('post', 'password'),
                'passwordValidate' => $request->getData('post', 'passwordValidate')
            ));
            // Hydrate l'entité clientEntity
            $clientEntity = new clientEntity(array(
                'langueCorrespondanceId' => $request->getData('post', 'langueCorrespondanceId'),
                'nationaliteId' => $request->getData('post', 'nationaliteId'),
                'userId' => null,
                'nom' => $request->getData('post', 'nom'),
                'prenom' => $request->getData('post', 'prenom'),
                'adresse' => $request->getData('post', 'adresse'),
                'npa' => $request->getData('post', 'npa'),
                'ville' => $request->getData('post', 'ville'),
                'telephone' => $request->getData('post', 'telephone'),
                'email' => $request->getData('post', 'email'),
                'image' => $request->getData('post', 'image'),
                'dateNaissance' => new \DateTime
            ));
            // Vérifie que les infoirmation d'inscription soit valide
            if($userEntity->isValid() && $clientEntity->isValid()){
                $this->_application->getUser()->setFlash('Vous avez été correctement inscrit.');
                $this->_application->getResponse()->redirect('/comparateur/');            
            }
            // Vérifie que l'utilisateur soit valide
            if(!$userEntity->isValid()){
                $this->_page->addVar('erreursUser', $userEntity->getErrors());
            }
            // Vérifie que le client soit valide
            if(!$clientEntity->isValid()){
                $this->_page->addVar('erreursClient', $clientEntity->getErrors());
            }
            // Ajoute l'entité userEntity à la page
            $this->_page->addVar('userEntity', $userEntity);
            // Ajoute l'entité clientEntity à la page
            $this->_page->addVar('clientEntity', $clientEntity);
        }
    }
    
    /**
     * _processForgotForm() - Exécute le processus formulaire d'oubli du mot de passe
     * @access private
     * @param request $request
     * @return void
     */    
    private function _processForgotForm(request $request){
        // Vérifie que la méthode du formulaire soit POST
        if($request->getData('method') == 'POST'){
            // Définit le champs de l'entité utilisateur
            $user = new utilisateurEntity(array(
                'login' => $request->getData('post', 'login')
            ));
            if($user->isValid()){
                $result = $this->_managers->getManagerOf('utilisateurs')->getUniqueLogin($user->getLogin());
                if(is_null($result)){
                    $this->_application->getUser()->setFlash('Votre login n\'a pas été trouvé, veuillez le vérifier !');
                }else{
                    $this->_application->getUser()->setFlash('Votre mot de passe vous à été envoyé.');
                    $this->_application->getResponse()->redirect('/comparateur/');
                }
            }else{
                $this->_page->addVar('erreurs', $user->getErrors());
            }
            $this->_page->addVar('userEntity', $user);
        }
    }
}