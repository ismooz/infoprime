<?php

session_start();

if($_POST['dateNaissance']){
    $_SESSION['comparateur']['formFirst'] = $_POST;
    header('location: http://economies.ch/assurance-maladie/comparateur/');
}else{
    header('location: http://economies.ch/');
}