<?php

/**
 * Database
 */

//define('DB_TYPE', 'mysql');
//define('DB_HOST', '127.0.0.1');
//define('DB_PORT', '21');
//define('DB_USER', 'root');
//define('DB_PASS', '');
//define('DB_NAME', 'economies');
//define('DB_DSN', DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME );
//define('DB_CHARSET', 'utf-8');

define('DB_TYPE', 'mysql');
define('DB_HOST', 'mysql.economies.ch');
define('DB_PORT', '21');
define('DB_USER', 'medt_ismael');
define('DB_PASS', 'IsmaeL_1983');
define('DB_NAME', 'medt_WP14675');
define('DB_DSN', DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME );
define('DB_CHARSET', 'utf-8');

/**
 * Directories
 */
define('DS', DIRECTORY_SEPARATOR);
define('DIR_ROOT', filter_input(INPUT_SERVER, 'DOCUMENT_ROOT') . '/comparateur/');
define('DIR_CSS', 'css');
define('DIR_IMAGES', 'images');
define('DIR_JS', 'js');
define('DIR_MODELS', 'models');
define('DIR_VIEWS', 'views');
define('DIR_CONTROLLERS', 'controllers');

/**
 * FTP 
 */
define('FTP_ENABLED', false);
define('FTP_HOST', 'ftp.pcsoft.fr');
define('FTP_PORT', '21');
define('FTP_USER', 'root');
define('FTP_PASS', '1234');

/**
 * SMTP
 */
define('SMTP_ENABLED', false);
define('SMTP_HOST', '');
define('SMTP_PORT', '25');
define('SMTP_USER', 'root');
define('SMTP_PASS', '1234');

/**
 * Debugging
 */
define('DEBUG_ENABLED', true);
define('DEBUG_LOG', false);

/**
 * Logging
 */
define('LOGS_ENABLED', false);
define('LOGS_PATH', 'logs');
define('LOGS_LIFETIME', 3600*24*7);
define('LOGS_ARCHIVES_PATH', 'archives' . DS . 'logs');

/**
 * Cache
 */
define('CACHE_ENABLED', false);
define('CACHE_PATH', '');
define('CACHE_LIFETIME', 3600);

/**
 * $_SESSION
 */
define('SESSION_NAME', 'MDT');
define('SESSION_LIFETIME', 60*20);

/**
 * Webmaster
 */
define('WEBMASTER_MAIL', '');
define('WEBMASTER_NAME', '');
