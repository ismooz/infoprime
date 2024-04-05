<?php

function my_error_handler($code, $message, $file, $line, $vars){
    $error = "<div class='box box-default box-theme-default'>\r\n";
    $error .= "<div class='box-header'>Erreur (<strong>$code</strong>)</div>\r\n";
    $error .= "<div class='box-body'>\r\n";
    $error .= "<p>ligne : <strong>$line</strong></p>\r\n";
    $error .= "<p style='white-space:wrap'>fichier : <strong>$file</strong></p>\r\n";
    $error .= "<p>$message</p>\r\n";
    $error .= "<pre>" . print_r($vars, 1) ."</pre>\r\n";
    $error .= "</div>\r\n"; 
    $error .= "</div>\r\n";
    echo $error;
}