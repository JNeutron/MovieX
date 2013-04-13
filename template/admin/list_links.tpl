                {if $movie}
                    <ul class="breadcrumb">
                        <li><a href="{$url}/admin/index.php">Panel</a> <span class="divider">/</span></li>
                        <li><a href="{$url}/admin/index.php?action=list&do=movies">Películas</a> <span class="divider">/</span></li>
                        <li class="active">{$movie.p_titulo}</li>
                    </ul>
                    <div class="adminHeader clearfix">
                        <h2 class="pull-left">Lista de enlaces</h2>
                        <div class="pull-right btn-group">
                            <a href="{$url}/admin/index.php?action=list&do=videos&id={$movie.pelicula_id}" class="btn btn-small"><i class="icon-list"></i> Ver videos</a>
                            <a href="{$url}/admin/index.php?action=add&do=link&id={$movie.pelicula_id}" class="btn btn-success btn-small"><i class="icon-plus icon-white"></i> Agregar enlace</a>
                        </div>
                    </div>
                    {if $links}
                    <table class="table table-striped">
                    	<thead>
                            <th>ID</th>
                            <th>Servidor</th>
                            <th>Idioma</th>
                            <th>Calidad</th>
                            <th>Agregado</th>
                            <th>Visitas</th>
                            <th>Reportes</th>
                            <th>Status</th>
                            <th style="width: 116px">&nbsp;</th>
                        </thead>
                        <tbody>
                        	{foreach from=$links item=d}
                            <tr>
                                <td>{$d.descarga_id}</td>
                                <td>{$d.s_titulo}</td>
                                <td>{$d.i_titulo}</td>
                                <td>{$d.c_titulo}</td>
                                <td>{$d.d_upload|date_format:"%d/%m/%Y"}</td>
                                <td>{$d.d_hits}</td>
                                <td>{$d.d_reports}</td>
                                <td><span class="label label-{if $d.d_online == 1}success{else}important{/if}">{if $d.d_online == 1}On{else}Off{/if}line</span></td>
                                <td>
                                    <div class="btn-group">
                                    <a href="{$url}/admin/index.php?action=out&do=link&id={$d.descarga_id}" target="_blank" class="btn" title="Ver enlace"><i class="icon-share"></i></a>
                                    <a href="{$url}/admin/index.php?action=edit&do=link&id={$d.pelicula_id}&l={$d.descarga_id}" class="btn" title="Editar enlace"><i class="icon-edit"></i></a>
                                    <a href="{$url}/admin/index.php?action=delete&do=link&id={$d.descarga_id}" class="btn" title="Eliminar enlace"><i class="icon-trash"></i></a>
                                    </div>
                                </td>
                            </tr>
                            {/foreach}
                        </tbody>
                    </table>
                    {else}
                    <div class="alert">No se han agregado enlaces de descarga a esta pel&iacute;cula.</div>
                    {/if}
                {/if}