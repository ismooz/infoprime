<?php

namespace applications\backend\modules\connexion;
use library\controllers\backController;
use library\request;

/**
 * Class connexionController
 * @author Vazquez Luis
 * @copyright (c) 2015, Syntesis Management SA
 */
class connexionController extends backController {
    
    /**
     * executeIndex() - Affiche la page index
     * @access public
     * @return void
     */
    public function executeIndex(request $request){
        if($request->getExists('post', 'login')){
            $this->_processForm($request);
        }
        // Ajout d'un titre à la page 
        $this->_page->addVar('title', 'Connexion');
    }
    
    /**
     * executeDeconnexion() - Execute la déconnexion de l'utilisateur 
     * @access public
     * @return void
     */
    public function executeDeconnexion(){
        // Définit l'utilisateur non authentifié
        $this->_application->getUser()->setAuthenticated(false);
        // Définit le message utilisateur
        $this->_application->getUser()->setFlash('Vous avez été correctement déconnecté !');
        // Redirige vers la page index de l'administration
        $this->_application->getResponse()->redirect('/comparateur/admin/');
    }
    
    /**
     * _processForm - Poste le formulaire
     * @access private
     * @param request $request
     * @return void
     */
    private function _processForm(request $request){
        if($request->getData('method') == 'POST'){
            // On récupère les information d'authentification
            $login = $request->getData('post', 'login');
            $password = $request->getData('post', 'password');
            // On récupère le manager
            $manager = $this->_managers->getManagerOf('connexion');
            // On récupère les information d'authentification
            $auth = $manager->getUser($login);
            // On vérifie l'authentification
            if($login === ''){
                $this->_application->getUser()->setFlash('Veuillez insérer un nom d\'utilisateur');
            }elseif(is_null($auth)){
                $this->_application->getUser()->setFlash('Le nom d\'utilisateur est incorrect');
            }elseif($password === ''){
                $this->_application->getUser()->setFlash('Veuillez insérer un mot de passe');
            }elseif($auth['password'] === $password) {
                $this->_application->getUser()->setAuthenticated(true);
                $this->_application->getResponse()->redirect('.');                
            }else{
                $this->_application->getUser()->setFlash('Le mot de passe est incorrect !');
            }
        }
    }
}
