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
 * index.php
 * 
 * Página de inicio.
 * 
 */
 
/*
 * ---------------------------------------------------------------
 *  Cargamos bootstrap
 * ---------------------------------------------------------------
 */

    require './include/bootstrap.php';
    
    // Página & Título
    $tpl->assign(array(
        'page' => 'home',
        'title' => $_CONF['site_name'] . ' - ' . $_CONF['site_slogan']
    ));
    
/*
 * ---------------------------------------------------------------
 *  Procesos del archivo
 * ---------------------------------------------------------------
 */
    // ESTRENOS
    $tpl->assign("premiere",$moviex->getMovies('debut'));
    // ULTIMAS AGREGADAS
    $tpl->assign("lastMoviex",$moviex->getMovies('last'));
    // TOP PELICULAS
    $tpl->assign("topMoviex",$moviex->getMovies('top'));
    // MAS VOTADAS
    $tpl->assign("rankMoviex",$moviex->getMovies('rank'));
/*
 * ---------------------------------------------------------------
 *  Mostramos la plantilla
 * ---------------------------------------------------------------
 */
    $tpl->display('home.tpl');