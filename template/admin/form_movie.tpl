                    <ul class="breadcrumb">
                        <li><a href="{$url}/admin/index.php">Panel</a> <span class="divider">/</span></li>
                        <li><a href="{$url}/admin/index.php?action=list&do=movies">Películas</a> <span class="divider">/</span></li>
                        <li class="active">Película</li>
                    </ul>
                    <form method="post" action="" class="form-horizontal" enctype="multipart/form-data">
                        <fieldset>
                            <legend>{if $action == 'edit'}Editar &raquo; {$movie.p_titulo}{else}Agregar pel&iacute;cula{/if}</legend>
                            <div class="control-group">
                                <div class="control-label"><label for="titulo">T&iacute;tulo:</label></div>
                                <div class="controls">
                                    <input type="text" id="titulo" name="titulo" maxlength="60" value="{$movie.p_titulo}" class="input-xlarge" />
                                </div>
                            </div>
                            {if $action == 'edit'}
                            <div class="control-group">
                                <div class="control-label"><label for="pass">Portada actual:</label></div>
                                <div class="controls">
                                    <img src="{$url_cover}/{$movie.pelicula_id}.jpg" style="max-width: 130px" />
                                </div>
                            </div>
                            {/if}
                            <div class="control-group">
                                <div class="control-label"><label for="pass">Portada{if $action == 'edit'} nueva{/if}:</label></div>
                                <div class="controls">
                                    <input type="file" name="cover" />
                                    <span class="help-block muted">Imagen del DVD, no importa el tama&ntilde;o ser&aacute; cambiado autom&aacute;ticamente.</span>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="control-label"><label for="genero">Genero:</label></div>
                                <div class="controls">
                                    <select id="genero" name="genero"><option value="0">Seleccionar...</option>{foreach from=$data.generos item=g}<option value="{$g.genero_id}"{if $movie.p_genero == $g.genero_id} selected="true"{/if}>{$g.g_titulo}</option>{/foreach}</select>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="control-label"><label for="idioma">Idioma:</label></div>
                                <div class="controls">
                                    <select id="idioma" name="idioma"><option value="0">Seleccionar...</option>{foreach from=$data.idiomas item=i}<option value="{$i.idioma_id}"{if $movie.p_idiomas == $i.idioma_id} selected="true"{/if}>{$i.i_titulo}</option>{/foreach}</select>
                                    <span class="help-block muted">Idioma principal de esta pel&iacute;cula.</span>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="control-label"><label for="calidad">Calidad:</label></div>
                                <div class="controls">
                                    <select id="calidad" name="calidad"><option value="0">Seleccionar...</option>{foreach from=$data.calidades item=c}<option value="{$c.calidad_id}"{if $movie.p_calidad == $c.calidad_id} selected="true"{/if}>{$c.c_titulo}</option>{/foreach}</select>
                                    <span class="help-block muted">Calidad principal de esta pel&iacute;cula.</span>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="control-label"><label for="ano">A&ntilde;o:</label></div>
                                <div class="controls">
                                    <input type="text" id="ano" name="ano" maxlength="4" value="{$movie.p_ano}" class="span1" />
                                    <span class="help-block muted">A&ntilde;o en que se estrenó esta pel&iacute;cula.</span>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="control-label"><label for="desc">Sinopsis:</label></div>
                                <div class="controls">
                                    <textarea name="sinopsis" id="desc" rows="8" class="input-xxlarge">{$movie.p_sinopsis}</textarea>
                                    <span class="help-block muted">Breve rese&ntilde;a de la pel&iacute;cula.</span>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="control-label"><label for="estreno">Estreno:</label></div>
                                <div class="controls">
                                    <label class="radio inline"><input name="estreno" type="radio" value="1" {if $movie.p_estreno == 1}checked="checked"{/if} class="radio"/>S&iacute;</label>
                                    <label class="radio inline"><input name="estreno" type="radio" value="0" {if $movie.p_estreno != 1}checked="checked"{/if} class="radio"/>No</label>
                                    <span class="help-block muted">Si elige esta opci&oacute;n la pel&iacute;cula aparecer&aacute; en la categoria <em>Estrenos</em></span>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="control-label"><label for="online">Online:</label></div>
                                <div class="controls">
                                    <label class="radio inline"><input name="online" type="radio" value="1" {if $movie.p_online == 1}checked="checked"{/if} class="radio"/>S&iacute;</label>
                                    <label class="radio inline"><input name="online" type="radio" value="0" {if $movie.p_online != 1}checked="checked"{/if} class="radio"/>No</label>
                                    <span class="help-block muted">Esta pel&iacute;cula es visible en el sitio.</span>
                                </div>
                            </div>
                            <input type="hidden" name="date" value="{if $movie.p_date}{$movie.p_date}{else}{$smarty.now}{/if}" />
                            <div class="form-actions">
                                <button type="submit" name="save" class="btn btn-primary">{if $action == 'edit'}Guardar cambios{else}Agregar pel&iacute;cula {/if}</button>
                            </div>
                        </fieldset>
                    </form>