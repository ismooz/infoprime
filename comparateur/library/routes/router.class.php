<?php

namespace library\routes;

/**
 * Class router
 * @author Vazquez Luis
 * @copyright (c) 2015, Syntesis Management SA
 */
class router {
    
    const NO_ROUTE = 1;
    
    /**
     * routes of the application
     * @access private
     * @var array
     */
    private $_routes;
    
    /**
     * Constructor
     */
    public function __construct($filename) {
        $this->_routes = array();
        $this->_load($filename);
    }

    /**
     * load() -
     * @access private
     * @param type $filename
     * @throws \RuntimeException
     */
    private function _load($filename){
        // On vérifie que le fichier existe
        if(!file_exists($filename)){
            throw new \RuntimeException('This file "' . $filename . '" cannot exists !');
        }
        // on vérifie que le fichier soit accessible
        if(!is_readable($filename)) {
            throw new \RuntimeException('This file "' . $filename . '" is not readable !');
        }         
        // 
        $xml = new \DOMDocument();
        $xml->load($filename);
        $routes = $xml->getElementsByTagName('route');
        
        foreach($routes as $route){
            $vars = array();
            // On regarde si des variables sont présentes dans l'URL.
            if ($route->hasAttribute('vars')){
              $vars = explode(',', $route->getAttribute('vars'));
            }
            $this->_add(new route($route->getAttribute('url'), $route->getAttribute('module'), $route->getAttribute('action'), $vars));
        }
    }     
    
    /**
     * Add route to routes array
     * @access private
     * @param route $route
     */
    private function _add(Route $route){
        if(!in_array($route, $this->_routes)){
            $this->_routes[] = $route;
        }
    }
    
    /**
     * @access public
     * @param string $url
     * @return object route
     * @throws \InvalidArgumentException
     */
    public function getRoute($url){
        // On parcours les routes
        foreach($this->_routes as $route){
            // On vérifie que l'url corresponde à la route
            $varsValues = $route->match($url);
            
            if($varsValues !== false){
                if($route->hasVars()){
                    $varsNames = $route->getVarsNames();
                    $listVars = array();
                    //var_dump($varsNames);
                    // On créé un nouveau tableau clé/valeur.
                    // (Clé = nom de la variable, valeur = sa valeur.)
                    foreach($varsValues as $key => $match){
                        // La première valeur contient entièrement la chaine capturée (voir la doc sur preg_match).
                        if ($key !== 0){
                            $listVars[$varsNames[$key - 1]] = $match;
                        }
                    }
                    // On assigne ce tableau de variables à la route.
                    $route->setVars($listVars);
                }
                return $route;
            }
        }
        throw new \InvalidArgumentException('Aucune route ne correspond à l\'Url', self::NO_ROUTE);
    }
}
