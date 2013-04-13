<!DOCTYPE html>
<html lang="es">
<head>
    <title>Instalar MovieX</title>
    <link href="../static/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="span6 offset3">
                {if empty($result)}
                <div class="page-header">
                    <h1>Instalar MovieX <small>v 1.0.0</small></h1>
                </div>
                <p><strong>Paso #1</strong>: Dar permisos de escritura <strong>777</strong> a los directorios:
                    <ol>
                        <li><strong>/file/cache/</strong></li>
                        <li><strong>/file/cover/</strong></li>
                    </ol>
                </p>
                <p><strong>Paso #2</strong>: Subir a tu base de datos el archivo <strong>moviex.sql</strong></p>
                <p><strong>Paso #3</strong>: Editar el archivo <strong>/include/config.php</strong></p>
                <p><strong>Paso #4</strong>: Ingresar los siguientes datos del administrador:</p>
                <hr />
                <form method="post" action="" class="form-horizontal">
                    <div class="control-group">
                        <div class="control-label">Nombre de usuario:</div>
                        <div class="controls">
                            <input type="text" name="uname" />
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="control-label">Contrase&ntilde;a:</div>
                        <div class="controls">
                            <input type="password" name="upass" />
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="control-label">Repetir contrase&ntilde;a:</div>
                        <div class="controls">
                            <input type="password" name="rupass" />
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="control-label">Email:</div>
                        <div class="controls">
                            <input type="text" name="umail" />
                        </div>
                    </div>
                    <hr />
                    <div class="form-actions">
                        <input type="submit" value="Instalar MovieX" class="btn btn-primary" />
                    </div>
                </form>
                <hr />
                <p><strong>Paso #5</strong>: Eliminar el archivo <strong>/admin/install.php</strong></p>
                <p><strong>Paso #6</strong>: Ingresa a la p&aacute;gina de <a href="index.php">administraci&oacute;n</a> y comienza a usar tu sitio.</p>
                {else}
                <h3>{$result}</h3>
                {/if}
            </div>
        </div>
    </div>
</body>
</html>