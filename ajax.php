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
    
/*
 * ---------------------------------------------------------------
 *  Procesos del archivo
 * ---------------------------------------------------------------
 */
        $do = $_GET['do'];
        switch($do)
        {
            case 'report':
                echo $moviex->setReport();
            break;
            case 'votar':
                echo $moviex->votar();
            break;
            default:
                echo '0: La acci&oacute;n requerida no est&aacute; disponible.';
            break;
        }
        exit;