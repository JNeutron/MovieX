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
        'page' => 'ficha'
    ));
    
/*
 * ---------------------------------------------------------------
 *  Procesos del archivo
 * ---------------------------------------------------------------
 */
    $info = $moviex->getMovieInfo();
    
    $tpl->assign('title', 'Ver online ' . $info['info']['p_titulo'].' | ' . $_CONF['site.title']);
    $tpl->assign("movie",$info);
    $tpl->assign("fburl",$moviex->currentUrl());
/*
 * ---------------------------------------------------------------
 *  Mostramos la plantilla
 * ---------------------------------------------------------------
 */
    $tpl->display('ficha.tpl');