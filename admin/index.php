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

    require '../include/bootstrap.php';
    
    // Página & Título
    $tpl->assign(array(
        'page' => 'admin',
        'title' => 'Administrar Sitio - MovieX'
    ));
    
/*
 * ---------------------------------------------------------------
 *  Clase Admin
 * ---------------------------------------------------------------
 */
    require LIB_PATH . 'admin.class.php';
    $admin = new Admin();
/*
 * ---------------------------------------------------------------
 *  Procesos del archivo
 * ---------------------------------------------------------------
 */
    $action = $_GET['action'];
    $do = $_GET['do'];
    // ACCION
    switch($action){
        case '':
            $tpl->assign("reports",$admin->getReports());
        break;
        case 'login':
            if($_POST['user']){
                $admin->adminLogin();
                $tpl->assign("error",$admin->error);
            }
        break;
        case 'logout':
            $_SESSION['moviex'] = null;
            $admin->message('Su sesi&oacute;n ha sido finalizada correctamente.', $_CONF['site_path'] . '?action=login', 'Ir a p&aacute;gina de inicio');
        break;
        case 'config':
            if($_POST['date'])
            {
                $result = $admin->editConfig();
                if(!$result)
                    $tpl->assign("error",$admin->error);
                else $tpl->assign("result", $result);
            }
        break;
        /** LISTADOS **/
        case 'list':
            # TIPO #
            switch($do){
                // PELICULAS
                case 'movies':
                    $tpl->assign("movies",$admin->getMovies());
                break;
                // VIDEOS
                case 'videos':
                    $movie = $admin->getMovie();
                    if(empty($movie)) {
                        $tpl->assign("error", "Esta pel&iacute;cula ya no existe.");
                        $movie = null;
                    }
                    $tpl->assign("movie", $movie);
                    $tpl->assign("videos", $admin->getMovieVideos());
                break;
                // LINKS
                case 'links':
                    $tpl->assign("links", $admin->getMovieLinks());
                    $tpl->assign("movie",$admin->getMovie());
                break;
                // SERVERS
                case 'servers':
                    $tpl->assign('servers', $admin->getServers());
                break;
            }
        break;
        /** AGREGAR **/
        case 'add':
            # TIPO #
            switch($do){
                case 'movie':
                    if($_POST['titulo']){
                        $admin->newMovie();
                        $tpl->assign("error",$admin->error);
                    }
                    // DATA 
                    $tpl->assign("data", $admin->getCarData());
                break;
                // VIDEO
                case 'video':
                    // NUEVO
                    if($_POST['date']){
                        $admin->newVideo();
                        $tpl->assign("error",$admin->error);
                    }
                    $tpl->assign("movie",$admin->getMovie());
                    $tpl->assign("data", $admin->getCarData());
                break;
                // VIDEO
                case 'link':
                    // NUEVO
                    if($_POST['date']){
                        $result = $admin->newLink();
                        if(!$result)
                            $tpl->assign("error",$admin->error);
                        else $tpl->assign("result", $result);
                    }
                    $tpl->assign("movie",$admin->getMovie());
                    $tpl->assign("data", $admin->getCarData());
                break;
                // SERVER
                case 'server':
                    // NUEVO
                    if ($_POST['date'])
                    {
                        $result = $admin->newServer();
                        if( ! $result)
                            $tpl->assign('error', $admin->error);
                        else $tpl->assign('result', $result);
                    }
                break;
            }
        break;
        /** EDICION **/
        case 'edit':
            # TIPO #
            switch($do){
                // MOVIE
                case 'movie':
                    if($_POST['date']){
                        $result = $admin->editMovie();
                        if(!$result)
                            $tpl->assign("error",$admin->error);
                        else $tpl->assign("result", $result);
                    }
                    // CARGAR INFORMACION
                    $tpl->assign("movie",$admin->getMovie());
                    $tpl->assign("data", $admin->getCarData());
                break;
                // VIDEO
                case 'video':
                    // NUEVO
                    if($_POST['date']){
                        $result = $admin->editVideo();
                        if(!$result)
                            $tpl->assign("error",$admin->error);
                        else $tpl->assign("result", $result);
                    }
                    $tpl->assign("movie",$admin->getMovie());
                    $tpl->assign("video",$admin->getVideo($_GET['v']));
                    $tpl->assign("data", $admin->getCarData());
                break;
                // LINK
                case 'link':
                    // NUEVO
                    if($_POST['date']){
                        $result = $admin->editLink();
                        if(!$result)
                            $tpl->assign("error",$admin->error);
                        else $tpl->assign("result", $result);
                    }
                    $tpl->assign("movie",$admin->getMovie());
                    $tpl->assign("link",$admin->getLink($_GET['l']));
                    $tpl->assign("data", $admin->getCarData());
                break;
                // SERVIDOR
                case 'server':
                    if($_POST['date'])
                    {
                        $result = $admin->editServer();
                        if ( ! $result)
                            $tpl->assign('error', $admin->error);
                        else $tpl->assign('result', $result);
                    }
                    $tpl->assign('server', $admin->getServer());
                break;
            }
        break;
        /** ELIMINAR **/
        case 'delete':
            //
            $delete = ($_POST['delete'] == 'Eliminar') ? true : false;
            # TIPO #
            switch($do){
                case 'movie':
                    $mInfo = $admin->getMovie();
                    $delType = 'la pel&iacute;cula <u>'.$mInfo['p_titulo'].'</u>';
                    //
                    if($delete){
                        $result = $admin->delMovie();
                        if(!$result)
                            $tpl->assign("error",$admin->error);
                        else $tpl->assign("result", $result);
                    }
                break;
                // VIDEO
                case 'video':
                    $delType = 'un video';
                    //
                    if($delete){
                        $result = $admin->delVideo();
                        if(!$result)
                            $tpl->assign("error",$admin->error);
                        else $tpl->assign("result", $result);
                    }
                break;
                // ENLACE
                case 'link':
                    $delType = 'un enlace';
                    //
                    if($delete){
                        $result = $admin->delLink();
                        if(!$result)
                            $tpl->assign("error",$admin->error);
                        else $tpl->assign("result", $result);
                    }
                break;
                // SERVIDOR
                case 'server':
                    $delType = 'un servidor';
                    //
                    if($delete){
                        $result = $admin->delServer();
                        if(!$result)
                            $tpl->assign("error",$admin->error);
                        else $tpl->assign("result", $result);
                    }
                break;
            }
            //
            $tpl->assign("delType",$delType);
        break;
        /** ABRIR ENLACE **/
        case 'out':
            # TIPO #
            switch($do){
                // VIDEO
                case 'video':
                    $video = $admin->getVideo();
                    $type = 'remote';
                    // Creando embed...
                    if ($video['s_plugin'] || $video['v_embed'])
                    {
                        $serverName = (empty($video['v_embed']) ? $video['s_titulo'] : 'embed');
                        $plugin = $moviex->plugin($serverName);
                        
                        $source = $plugin->getEmbed($plugin->getId($video['v_source']));
                        $type = 'local';   
                    }
                    
                    if($type == 'remote') $admin->message('', "{$source['v_source']}", "{$source['v_source']}", 'Espere...');
                    elseif($type == 'local') {
                        $moviex->error_page('view_embed', '<div style="height:300px; margin-top:10px;">' . $source . '</div>', 'padding:10px;background:#FFF;');
                    }
                    else $moviex->error_page('not_found', 'El enlace al que desea ir no es v&aacute;lido y no pudo ser redireccionado.');
                break;
                // ENLACE
                case 'link':
                    $link = $admin->getLink();
                    $parts = explode("\n", $link['d_source']);
                    if(count($parts) == 1) $admin->message('', "{$link['d_source']}", "{$link['d_source']}", 'Espere...');
                    elseif(count($parts) > 1) {
                        $dLinks = '';
                        foreach($parts as $key => $part){
                            $dLinks .= '&bull; Parte #'.($key+1).' <a href="'.$part.'">'.$part.'</a><br/>';
                        }
                        $moviex->error_page('view_links', $dLinks, 'padding:10px;background:#FFF;');
                    }
                    else $moviex->error_page('not_found', 'El enlace al que desea ir no es v&aacute;lido y no pudo ser redireccionado.');
                break;
            }
        break;
        // PUBLICIDAD
        case 'ads':
            if($_POST['save']){
                $result = $admin->editAds();
                if(!$result)
                    $tpl->assign("error",$admin->error);
                else $tpl->assign("result", $result);
            }
            //
            $tpl->assign("adsA", $admin->getAds());
        break;
    }
    // EXTRA PAGES
    $tpl->assign('isAdmin', (isset($_SESSION['moviex']) ? true : false));
    $tpl->assign("action",$action);
    $tpl->assign("do",$do);
/*
 * ---------------------------------------------------------------
 *  Mostramos la plantilla
 * ---------------------------------------------------------------
 */
    $tpl->display('admin.tpl');