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
 * install.php
 * 
 * Instalador
 * 
 */
 
/*
 * ---------------------------------------------------------------
 *  Cargamos bootstrap
 * ---------------------------------------------------------------
 */

    require '../include/bootstrap.php';
    
/*
 * ---------------------------------------------------------------
 *  Procesos del archivo
 * ---------------------------------------------------------------
 */
 
    if($_POST['uname'] && $_POST['upass'] && $_POST['umail']){
        extract($_POST);
        // PASSWORD
        if($upass != $rupass) die('Las contrase&ntilde;as no coinciden.');
        $key = md5(strtolower($uname).$rupass);
        $query = $moviex->select("cb_admins","*","1");
        $exists = $moviex->num_rows($query);
        if(empty($exists)){  
            if($moviex->insert("cb_admins","a_name, a_password, a_email","'{$uname}', '{$key}', '{$umail}'")){
                header("Location: " . "index.php?action=login");
            } else $result = 'Verifica que los datos de conexi&oacute;n a la base de datos sean correctos.';
        } else $result = 'El script ya ha sido instalado, si desea re-instalar vaci&eacute; la tabla <strong>cb_admins</strong>.';
    }
    
    $tpl->assign('result', $result);
    
/*
 * ---------------------------------------------------------------
 *  Mostramos la plantilla
 * ---------------------------------------------------------------
 */
    $tpl->display('install.tpl');