                    <form method="post" action="" class="form-horizontal">
                        <fieldset>
                            <legend>Configuración del sitio</legend>
                            <div class="control-group">
                                <div class="control-label"><label for="titulo">Nombre:</label></div>
                                <div class="controls">
                                    <input type="text" name="config[site_name]" value="{$config.site_name}" />
                                    <span class="help-block">El nombre de tu sitio.</span>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="control-label"><label for="titulo">Slogan:</label></div>
                                <div class="controls">
                                    <input type="text" name="config[site_slogan]" value="{$config.site_slogan}" />
                                    <span class="help-block">Slogan de tu sitio.</span>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="control-label"><label for="titulo">URL:</label></div>
                                <div class="controls">
                                    <input type="text" name="config[site_path]" value="{$config.site_path}" />
                                    <span class="help-block">Dirección URL de tu sitio.</span>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="control-label"><label for="titulo">Facebook App ID:</label></div>
                                <div class="controls">
                                    <input type="text" name="config[fb_app_id]" value="{$config.site_path}" />
                                    <span class="help-block">Puedes crear una APP en Facebook y administrar los comentarios.</span>
                                </div>
                            </div>
                            <input type="hidden" name="date" value="{$smarty.now}" />
                            <div class="form-actions"><button type="submit" class="btn btn-success">Guardar cambios</button></div>
                        </fieldset>
                    </form>