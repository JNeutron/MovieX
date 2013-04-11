<?php
/********************************************************************************
* index.php 	                                                                *
*********************************************************************************
* TScript: Desarrollado por CubeBox ®											*
* ==============================================================================*
* Software Version:           TS 1.0 BETA          								*
* Software by:                JNeutron			     							*
* Copyright 2010:     		  CubeBox ®											*
*********************************************************************************/


/**********************************\

*	(VARIABLES POR DEFAULT)		*

\*********************************/

	$page = "admin";	// page.tpl -> PLANTILLA PARA MOSTRAR CON ESTE ARCHIVO.
	
/*++++++++ = ++++++++*/

	include "../header.php"; // INCLUIR EL HEADER

	$title = 'Administrar Sitio - MovieX';

/*++++++++ = ++++++++*/

/**********************************\

* (VARIABLES LOCALES ESTE ARCHIVO)	*

\*********************************/
    include("../source/class_admin.php");
    $admin = new admin(); 
/**********************************\

*	(INSTRUCCIONES DE CODIGO)		*

\*********************************/

    $action = $_GET['action'];
    $do = $_GET['do'];
    // ACCION
    switch($action){
        case '':
            $html->assign("reports",$admin->getReports());
        break;
        case 'login':
            if($_POST['user']){
                $admin->adminLogin();
                $html->assign("error",$admin->error);
            }
        break;
        case 'logout':
            $_SESSION['moviex'] = null;
            $admin->message('Su sesi&oacute;n ha sido finalizada correctamente.', URL_SITE, 'Ir a p&aacute;gina de inicio');
        break;
        /** LISTADOS **/
        case 'list':
            # TIPO #
            switch($do){
                // PELICULAS
                case 'movies':
                    $html->assign("movies",$admin->getMovies());
                break;
                // VIDEOS
                case 'videos':
                    $movie = $admin->getMovie();
                    if(empty($movie)) {
                        $html->assign("error", "Esta pel&iacute;cula ya no existe.");
                        $movie = null;
                    }
                    $html->assign("movie", $movie);
                    $html->assign("videos", $admin->getMovieVideos());
                break;
                // LINKS
                case 'links':
                    $html->assign("links", $admin->getMovieLinks());
                    $html->assign("movie",$admin->getMovie());
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
                        $html->assign("error",$admin->error);
                    }
                    // DATA 
                    $html->assign("data", $admin->getCarData());
                break;
                // VIDEO
                case 'video':
                    // NUEVO
                    if($_POST['date']){
                        $admin->newVideo();
                        $html->assign("error",$admin->error);
                    }
                    $html->assign("movie",$admin->getMovie());
                    $html->assign("data", $admin->getCarData());
                break;
                // VIDEO
                case 'link':
                    // NUEVO
                    if($_POST['date']){
                        $result = $admin->newLink();
                        if(!$result)
                            $html->assign("error",$admin->error);
                        else $html->assign("result", $result);
                    }
                    $html->assign("movie",$admin->getMovie());
                    $html->assign("data", $admin->getCarData());
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
                            $html->assign("error",$admin->error);
                        else $html->assign("result", $result);
                    }
                    // CARGAR INFORMACION
                    $html->assign("movie",$admin->getMovie());
                    $html->assign("data", $admin->getCarData());
                break;
                // VIDEO
                case 'video':
                    // NUEVO
                    if($_POST['date']){
                        $result = $admin->editVideo();
                        if(!$result)
                            $html->assign("error",$admin->error);
                        else $html->assign("result", $result);
                    }
                    $html->assign("movie",$admin->getMovie());
                    $html->assign("video",$admin->getVideo($_GET['v']));
                    $html->assign("data", $admin->getCarData());
                break;
                // LINK
                case 'link':
                    // NUEVO
                    if($_POST['date']){
                        $result = $admin->editLink();
                        if(!$result)
                            $html->assign("error",$admin->error);
                        else $html->assign("result", $result);
                    }
                    $html->assign("movie",$admin->getMovie());
                    $html->assign("link",$admin->getLink($_GET['l']));
                    $html->assign("data", $admin->getCarData());
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
                            $html->assign("error",$admin->error);
                        else $html->assign("result", $result);
                    }
                break;
                // VIDEO
                case 'video':
                    $delType = 'un video';
                    //
                    if($delete){
                        $result = $admin->delVideo();
                        if(!$result)
                            $html->assign("error",$admin->error);
                        else $html->assign("result", $result);
                    }
                break;
                // ENLACE
                case 'link':
                    $delType = 'un enlace';
                    //
                    if($delete){
                        $result = $admin->delLink();
                        if(!$result)
                            $html->assign("error",$admin->error);
                        else $html->assign("result", $result);
                    }
                break;
            }
            //
            $html->assign("delType",$delType);
        break;
        /** ABRIR ENLACE **/
        case 'out':
            # TIPO #
            switch($do){
                // VIDEO
                case 'video':
                    $video = $admin->getVideo();
                    $source = $moviex->getVideoSource($video['v_source'], $video['v_servidor']);
                    if($source['type'] == 'remote') $admin->message('', "{$source['v_source']}", "{$source['v_source']}", 'Espere...');
                    elseif($source['type'] == 'local') {
                        $moviex->error_page('view_embed', '<div style="height:300px; margin-top:10px;">' . $video['v_source'] . '</div>', 'padding:10px;background:#FFF;');
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
                    $html->assign("error",$admin->error);
                else $html->assign("result", $result);
            }
            //
            $html->assign("adsA", $admin->getAds());
        break;
    }
    // EXTRA PAGES
    $html->assign("action",$action);
    $html->assign("do",$do);
/**********************************\

* (AGREGAR DATOS GENERADOS | SMARTY) *

\*********************************/

$html->assign("title",$title);	// AGREGAR EL TITULO DE LA PAGINA ACTUAL

/*++++++++ = ++++++++*/
include("../footer.php");
/*++++++++ = ++++++++*/

?>