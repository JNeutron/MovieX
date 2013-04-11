<?php
/**
 * MovieX
 * 
 * @author      Ivan Molina Pavana <montemolina@live.com>
 * @copyright   Copyright (c) 2013, Ivan Molina Pavana <montemolina@live.com>
 * @license     GNU General Public License, version 3
 */
 
// ------------------------------------------------------------------------

/**
 * condig.php
 * 
 * Contiene las variables de configuración
 * 
 */
 
$_CONF = array();

/*
 * ---------------------------------------------------------------
 *  Base de datos.
 * ---------------------------------------------------------------
 */
    
    // Host de la BD
    $_CONF['db.host'] = '127.0.0.1';
    
    // Nombre de la BD
    $_CONF['db.name'] = 'test_tmp';
    
    // Usuario de la DB
    $_CONF['db.user'] = 'root';
    
    // Contraseña de la DB
    $_CONF['db.pass'] = '';
    
/*
 * ---------------------------------------------------------------
 *  Configuración del sitio.
 * ---------------------------------------------------------------
 */
 
    // Nombre de tu sitio.
    $_CONF['site.title'] = 'MovieX';
    
    // URL de tu sitio.
    $_CONF['site.path'] = 'http://www.example.com';
    
    // Slogan
    $_CONF['site.slogan'] = 'Películas gratis online';