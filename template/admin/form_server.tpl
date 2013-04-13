                    <form method="post" action="" class="form-horizontal">
                        <fieldset>
                            <legend>{if $action == 'edit'}Editar servidor &raquo; {$server.s_titulo|truncate:41}{else}Agregar servidor{/if}</legend>
                            <div class="control-group">
                                <div class="control-label"><label for="titulo">Nombre:</label></div>
                                <div class="controls">
                                    <input type="text" name="titulo" value="{$server.s_titulo}" />
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="control-label"><label for="online">GK Plugin:</label></div>
                                <div class="controls">
                                    <label class="radio inline"><input name="plugin" type="radio" value="1" {if $server.s_plugin == 1}checked="checked"{/if} class="radio"/>S&iacute;</label>
                                    <label class="radio inline"><input name="plugin" type="radio" value="0" {if $server.s_plugin != 1}checked="checked"{/if} class="radio"/>No</label>
                                    <span class="help-block">Este servidor cuenta con soporte para GK Plugin.<span id="gkPlugin" class="hide"><br />Recuerda subir el plugin a <strong>/include/plugins/</strong></span></span>
                                </div>
                            </div>
                            <input type="hidden" name="date" value="{$smarty.now}" />
                            <div class="form-actions"><button type="submit" class="btn btn-success">{if $action == 'edit'}Guardar cambios{else}Agregar servidor{/if}</button></div>
                        </fieldset>
                    </form>