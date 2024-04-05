<?php

// Fonction d'autochargement des classes
function autoload($class){
    //echo($class . '<br/>');
    //echo(DIR_ROOT . str_replace('\\', '/', $class) . '.class.php<br/>');
    require DIR_ROOT . str_replace('\\', '/', $class) . '.class.php';
}

// Enregistre une fonction comme autoload
spl_autoload_register('autoload');