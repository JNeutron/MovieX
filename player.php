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
        'page' => 'player'
    ));
    
/*
 * ---------------------------------------------------------------
 *  Procesos del archivo
 * ---------------------------------------------------------------
 */
    $video_info = $moviex->getMovieVideo();
    $tpl->assign('title', 'Ver '. $video_info['p_titulo'].' online en '.$video_info['i_titulo'].' - '.$video_info['c_titulo'].' - '.$video_info['s_titulo'].' | ' . $_CONF['site.title']);
    $tpl->assign("video", $video_info);
/*
 * ---------------------------------------------------------------
 *  Mostramos la plantilla
 * ---------------------------------------------------------------
 */
    $tpl->display('player.tpl');