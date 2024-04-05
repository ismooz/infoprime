<?php

$email = $_GET['email'];

// Vérifie que l'email soit un email valide
if(filter_var($email, FILTER_VALIDATE_EMAIL) === false){
    echo 'invalide';
}else{
    $split = explode('@', $email);
    $result = checkdnsrr(array_pop($split), 'MX');
    if($result){
        echo 'valide';
    }else{
        echo 'invalide';
    }
}