                    <form method="post" action="" class="form-horizontal">
                        <fieldset>
                            <legend>{if $action == 'edit'}Editar video &raquo; {$movie.p_titulo|truncate:41}{else}Agregar video{/if} <a href="{$url}/admin/index.php?action=list&do=videos&id={$movie.pelicula_id}">&laquo; Lista de videos</a></legend>
                            <div class="control-group">
                                <div class="control-label"><label for="titulo">Pel&iacute;cula:</label></div>
                                <div class="controls"><label class="radio"><strong>{$movie.p_titulo}</strong></label></div>
                            </div>
                            <div class="control-group">
                                <div class="control-label"><label for="servidor">Servidor:</label></div>
                                <div class="controls">
                                    <select id="servidor" name="servidor" onchange="chServer(this.value);"><option value="0">Seleccionar...</option>{foreach from=$data.s_videos item=s}<option value="{$s.servidor_id}"{if $video.v_servidor == $s.servidor_id} selected="true"{/if}>{$s.s_titulo}</option>{/foreach}</select>
                                    <span class="help-block">Servidor donde est&aacute; alojado el video &oacute; puedes agregar directamente el c&oacute;digo embed del video.</span>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="control-label"><label for="idioma">Idioma:</label></div>
                                <div class="controls">
                                    <select id="idioma" name="idioma"><option value="0">Seleccionar...</option>{foreach from=$data.idiomas item=i}<option value="{$i.idioma_id}"{if $video.v_idioma == $i.idioma_id} selected="true"{/if}>{$i.i_titulo}</option>{/foreach}</select>
                                    <span class="help-block">Idioma principal de esta pel&iacute;cula.</span>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="control-label"><label for="calidad">Calidad:</label></div>
                                <div class="controls">
                                    <select id="calidad" name="calidad"><option value="0">Seleccionar...</option>{foreach from=$data.calidades item=c}<option value="{$c.calidad_id}"{if $video.v_calidad == $c.calidad_id} selected="true"{/if}>{$c.c_titulo}</option>{/foreach}</select>
                                    <span class="help-block">Calidad principal de esta pel&iacute;cula.</span>
                                </div>
                            </div>
                            <div id="source" class="control-group focus"{if $video.v_servidor == 1} style="display:none"{/if}>
                                <div class="control-label" id="sourceFocus"><label for="source">Video Url:</label></div>
                                <div class="controls">
                                    <input type="text" name="source" value="{if $video.v_servidor != 1}{$video.v_source}{/if}" class="input-xxlarge" />
                                    <span class="help-block">Url del video, se obtendr&aacute;a el ID autom&aacute;ticamente dependiendo el servidor seleccionado.</span>
                                </div>
                            </div>
                            <div id="embed" class="control-group focus"{if $video.v_servidor != 1} style="display:none;"{/if}>
                                <div class="control-label" id="embedFocus"><label for="embed">C&oacute;digo:</label></div>
                                <div class="controls">
                                    <textarea name="embed" rows="5" class="input-xlarge">{if $video.v_servidor == 2}{$video.v_source}{/if}</textarea>
                                    <span class="help-block">C&oacute;digo embed del video.</span>
                                </div>
                            </div>
                            {if $action == 'edit'}
                            <div class="control-group">
                                <div class="control-label"><label for="reports">Reportes:</label></div>
                                <div class="controls">
                                    <input type="text" id="reports" name="reports" maxlength="4" value="{$video.v_reports}" style="width:10%" />
                                    <span class="help-block">Veces que ha sido reportado este video.</span>
                                </div>
                            </div>
                            {/if}
                            <div class="control-group">
                                <div class="control-label"><label for="online">Online:</label></div>
                                <div class="controls">
                                    <label class="radio inline"><input name="online" type="radio" value="1" {if $video.v_online == 1}checked="checked"{/if} class="radio"/>S&iacute;</label>
                                    <label class="radio inline"><input name="online" type="radio" value="0" {if $video.v_online != 1}checked="checked"{/if} class="radio"/>No</label>
                                    <span class="help-block">Este video es visible en la lista de videos de la pel&iacute;cula.</span>
                                </div>
                            </div>
                            <input type="hidden" name="date" value="{if $video.v_upload}{$video.v_upload}{else}{$smarty.now}{/if}" />
                            <div class="form-actions">
                                    <button type="submit" class="btn btn-success">{if $action == 'edit'}Guardar cambios{else}Agregar video{/if}</button>
                            </div>
                        </fieldset>
                    </form>