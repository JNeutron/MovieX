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
 * bootstrap.php
 * 
 * Inicializa todas las clases requeridas.
 * 
 */
 
 
/*
 * ---------------------------------------------------------------
 *  Configuraciones iniciales.
 * ---------------------------------------------------------------
 */
 
    session_start();
    
    define( 'M_SCRIPT', 'public' );
    
    error_reporting(E_ALL ^ E_WARNING ^ E_NOTICE);
    ini_set('display_errors', TRUE);
    
    // Se usa para separar los directorios.
    define('DS', DIRECTORY_SEPARATOR);

    // Ruta principal del framework.
    define('ROOT', dirname(dirname((__FILE__))));
    
    // Ruta de includes
    define('INC_PATH', ROOT . DS . 'include' . DS);
    
    // Ruta de las librerías
    define('LIB_PATH', INC_PATH . 'lib' . DS);
    
    // Ruta de archivos
    define('FILE_PATH', ROOT . DS . 'file' . DS);
    
/*
 * ---------------------------------------------------------------
 *  Archivos de configuración.
 * ---------------------------------------------------------------
 */
 
    require INC_PATH . 'config.php';
    
/*
 * ---------------------------------------------------------------
 *  Clases del núcleo
 * ---------------------------------------------------------------
 */
 
    // Filtrar variables
    require LIB_PATH . 'filter.class.php';
    
    // Base de Datos
    require LIB_PATH . 'database.class.php';
    
    // Clase núcleo
    require LIB_PATH . 'moviex.class.php';
    
    // Clase Server
    require LIB_PATH . 'server.class.php';
    
    // Smarty
    require INC_PATH . 'smarty' . DS . 'Smarty.class.php';
    
/*
 * ---------------------------------------------------------------
 *  Inicializamos objetos
 * ---------------------------------------------------------------
 */
    
    // Filtro
    $filter = new Filter();
    $filter->cleanRequest();
    
    // Moviex
    $moviex = new Moviex();
    $moviex->isInstalled();
    
    // Smarty
    $tpl = new Smarty();
    $tpl->template_dir = ROOT . DS . 'template' . DS;
    $tpl->compile_dir = FILE_PATH . 'cache' . DS;
    
    // Detectar URL
    if ( ! isset($_CONF['site_path']) || empty($_CONF['site_path']))
    {
			if (isset($_SERVER['HTTP_HOST']))
			{
				$base_url = isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off' ? 'https' : 'http';
				$base_url .= '://'. $_SERVER['HTTP_HOST'];
				$base_url .= str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);
			}

			else
			{
				$base_url = 'http://localhost/';
			}
            
            // Asignamos
            $_CONF['site_path'] = rtrim(str_replace('/admin', '', $base_url), '/');
    } 
    
/*
 * ---------------------------------------------------------------
 *  Asignaciones generales
 * ---------------------------------------------------------------
 */
 
    $tpl->assign(array(
        'url' => $_CONF['site_path'],
        'url_cover' => $_CONF['site_path'] . '/file/cover',
        'url_static' => $_CONF['site_path'] . '/static',
        
        'config' => &$_CONF,
        
        // Películas aleatorias
        'randMoviex' => $moviex->getMovies(),
        
        // Tags
        'tags' => $moviex->getTags(),
        
        // ABC
        'abc' => range('A', 'Z'),
        
        // Publicidad
        'ads' => $moviex->getAds()
    ));