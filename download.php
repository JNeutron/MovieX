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
        'page' => 'download'
    ));
    
/*
 * ---------------------------------------------------------------
 *  Procesos del archivo
 * ---------------------------------------------------------------
 */
    $dLink = $moviex->getDownloadLink();
    $tpl->assign('title', 'Descargar ' . $dLink['p_titulo'].' en '.$dLink['i_titulo'].' - '.$dLink['c_titulo'].' - '.$dLink['s_titulo'].' | ' . $_CONF['site_name']);
    $tpl->assign("dLink", $dLink);
/*
 * ---------------------------------------------------------------
 *  Mostramos la plantilla
 * ---------------------------------------------------------------
 */
    $tpl->display('download.tpl');