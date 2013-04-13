                    <ul class="breadcrumb">
                        <li><a href="{$url}/admin/index.php">Panel</a> <span class="divider">/</span></li>
                        <li><a href="{$url}/admin/index.php?action=list&do=movies">Películas</a> <span class="divider">/</span></li>
                        <li><a href="{$url}/admin/index.php?action=list&do=links&id={$movie.pelicula_id}">{$movie.p_titulo}</a> <span class="divider">/</span></li>
                        <li class="active">Enlace</li>
                    </ul>
                    <form method="post" action="" class="form-horizontal">
                        <fieldset>
                            <legend>{if $action == 'edit'}Editar enlace &raquo; {$movie.p_titulo|truncate:41}{else}Agregar enlace{/if}</legend>
                            <div class="control-group">
                                <div class="control-label"><label for="titulo">Pel&iacute;cula:</label></div>
                                <div class="controls"><strong class="radio inline">{$movie.p_titulo}</strong></div>
                            </div>
                            <div class="control-group">
                                <div class="control-label"><label for="servidor">Servidor:</label></div>
                                <div class="controls">
                                    <select id="servidor" name="servidor" onchange="chServer(this.value);"><option value="0">Seleccionar...</option>{foreach from=$data.servers item=s}<option value="{$s.servidor_id}"{if $link.d_servidor == $s.servidor_id} selected="true"{/if}>{$s.s_titulo}</option>{/foreach}</select>
                                    <span class="help-block">Servidor donde est&aacute; alojado el archivo.</span>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="control-label"><label for="idioma">Idioma:</label></div>
                                <div class="controls">
                                    <select id="idioma" name="idioma"><option value="0">Seleccionar...</option>{foreach from=$data.idiomas item=i}<option value="{$i.idioma_id}"{if $link.d_idioma == $i.idioma_id} selected="true"{/if}>{$i.i_titulo}</option>{/foreach}</select>
                                    <span class="help-block">Idioma de este archivo.</span>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="control-label"><label for="calidad">Calidad:</label></div>
                                <div class="controls"> 
                                    <select id="calidad" name="calidad"><option value="0">Seleccionar...</option>{foreach from=$data.calidades item=c}<option value="{$c.calidad_id}"{if $link.d_calidad == $c.calidad_id} selected="true"{/if}>{$c.c_titulo}</option>{/foreach}</select>
                                    <span class="help-block">Calidad de este archivo.</span>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="control-label" id="source"><label for="source">Direcci&oacute;n del enlace:</label></div>
                                <div class="controls">
                                    <textarea name="source" id="source" rows="5" class="input-xlarge">{$link.d_source}</textarea>
                                    <span class="help-block">Si el archivo se encuentra dividido en partes agrega un enlace por cada linea.</span>
                                </div>
                            </div>
                            {if $action == 'edit'}
                            <div class="control-group">
                                <div class="control-label"><label for="reports">Reportes:</label></div>
                                <div class="controls">
                                    <input type="text" id="reports" name="reports" maxlength="4" value="{$link.d_reports}" style="width:10%" />
                                    <span class="help-block">Veces que ha sido reportado este archivo.</span>
                                </div>
                            </div>
                            {/if}
                            <div class="control-group">
                                <div class="control-label"><label for="online">Online:</label></div>
                                <div class="controls">
                                    <label class="radio inline"><input name="online" type="radio" value="1" {if $link.d_online == 1}checked="checked"{/if} class="radio"/>S&iacute;</label>
                                    <label class="radio inline"><input name="online" type="radio" value="0" {if $link.d_online != 1}checked="checked"{/if} class="radio"/>No</label>
                                    <span class="help-block">Este enlace es visible en la lista de la pel&iacute;cula.</span>
                                </div>
                            </div>
                            <input type="hidden" name="date" value="{if $link.d_upload}{$link.d_upload}{else}{$smarty.now}{/if}" />
                            <div class="form-actions"><button type="submit" class="btn btn-primary">{if $action == 'edit'}Guardar cambios{else}Agregar archivo{/if}</button></div>
                        </fieldset>
                    </form>