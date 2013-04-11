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
        'page' => 'pages'
    ));
    
/*
 * ---------------------------------------------------------------
 *  Procesos del archivo
 * ---------------------------------------------------------------
 */
    $mypage = $_GET['page'];
    $pageInfo = $moviex->getPage($mypage);
    //
    $tpl->assign('title', $pageInfo['page_title'] . ' &bull; ' . $_CONF['site.title']);
    $tpl->assign("pageInfo", $pageInfo);
/*
 * ---------------------------------------------------------------
 *  Mostramos la plantilla
 * ---------------------------------------------------------------
 */
    $tpl->display('pages.tpl');