                <form method="post" action="" class="span4 offset4 form-vertical">
                    <h2>Iniciar sesi&oacute;n</h2>
                    {if $error}<div class="alert">{$error}</div>{/if}
                    <fieldset>
                        <div class="control-group">
                            <div class="control-label"><label for="user">Administrador:</label></div>
                            <div class="controls"><input type="text" id="user" name="user" maxlength="24" style="width:90%" /></div>
                        </div>
                        <div class="control-group">
                            <div class="control-label"><label for="user">Contrase&ntilde;a:</label></div>
                            <div class="controls"><input type="password" id="pass" name="pass" maxlength="24" style="width:90%" /></div>
                        </div>
                        <p><input type="submit" name="save" value="Ingresar" class="btn btn-primary" /></p>
                    </fieldset>
                </form>