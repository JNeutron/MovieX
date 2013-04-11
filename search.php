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
        'page' => 'search'
    ));
    
/*
 * ---------------------------------------------------------------
 *  Procesos del archivo
 * ---------------------------------------------------------------
 */
    $q = $_GET['qh'];
    $type = $_GET['do'];
    //
    switch($type){
        case 'search':
        $title .= 'Resultados para '.ucfirst($q); 
        break;
        case 'abc':
        $title .= 'Letra '.strtoupper($q); 
        break;
        case 'genero':
        $title .= 'Pel&iacute;culas de '.ucfirst($q); 
        break;
    }
    //
    $tpl->assign('title', $title);
    $tpl->assign("result",$moviex->getSearch($q, 16));
    $tpl->assign("q",$q);
    $tpl->assign("type",$type);
/*
 * ---------------------------------------------------------------
 *  Mostramos la plantilla
 * ---------------------------------------------------------------
 */
    $tpl->display('search.tpl');