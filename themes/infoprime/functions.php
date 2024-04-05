<?php

/**
 * Functions - Child theme custom functions
 */


/*****************************************************************************************************************
 ************************** Caution: do not remove or edit anything within this section **************************/

/**
 * Loads the Divi parent stylesheet.
 * Do not remove this or your child theme will not work unless you include a @import rule in your child stylesheet.
 */
function dce_load_divi_stylesheet()
{
    wp_enqueue_style('divi-parent-style', get_template_directory_uri() . '/style.css');
}
add_action('wp_enqueue_scripts', 'dce_load_divi_stylesheet');

/**
 * Makes the Divi Children Engine available for the child theme.
 * Do not remove this or you will lose all the customization capabilities created by Divi Children Engine.
 */
require_once('divi-children-engine/divi_children_engine.php');

/****************************************************************************************************************/

function enqueue_custom_styles_scripts()
{


    // Ajout du CSS de Bootstrap
    wp_enqueue_style('bootstrap-css', 'https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css');

    // Ajout de JavaScript de Bootstrap
    wp_enqueue_script('bootstrap-js', 'https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js', array('jquery'), '', true);
}

// Attachement de la fonction 'enqueue_custom_styles_scripts' à l'action 'wp_enqueue_scripts'
add_action('wp_enqueue_scripts', 'enqueue_custom_styles_scripts');

function enqueue_datatable_script()
{

    wp_enqueue_script('datatables', '//cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js', array('jquery'), null, true);
}

add_action('admin_enqueue_scripts', 'enqueue_datatable_script');

// Appelle le fichier lead-management
require_once 'lead-management.php';
