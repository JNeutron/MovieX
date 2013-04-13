                {if $movie}
                    <ul class="breadcrumb">
                        <li><a href="{$url}/admin/index.php">Panel</a> <span class="divider">/</span></li>
                        <li><a href="{$url}/admin/index.php?action=list&do=movies">Películas</a> <span class="divider">/</span></li>
                        <li class="active">{$movie.p_titulo}</li>
                    </ul>
                    <div class="adminHeader clearfix">
                        <h2 class="pull-left">Lista de videos</h2>
                        <div class="pull-right btn-group">
                            <a href="{$url}/admin/index.php?action=list&do=links&id={$movie.pelicula_id}" class="btn btn-small"><i class="icon-list"></i> Ver enlaces</a>
                            <a href="{$url}/admin/index.php?action=add&do=video&id={$movie.pelicula_id}" class="btn btn-success btn-small"><i class="icon-plus icon-white"></i> Agregar video</a>
                        </div>
                    </div>
                    {if $videos}
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
                        	{foreach from=$videos item=v}
                            <tr>
                                <td>{$v.video_id}</td>
                                <td>{$v.s_titulo}</td>
                                <td>{$v.i_titulo}</td>
                                <td>{$v.c_titulo}</td>
                                <td>{$v.v_upload|date_format:"%d/%m/%Y"}</td>
                                <td>{$v.v_hits}</td>
                                <td>{$v.v_reports}</td>
                                <td><span class="label label-{if $v.v_online == 1}success{else}important{/if}">{if $v.v_online == 1}On{else}Off{/if}line</span></td>
                                <td>
                                    <div class="btn-group">
                                    <a href="{$url}/admin/index.php?action=out&do=video&id={$v.video_id}" target="_blank" class="btn" title="Ver video"><i class="icon-share"></i></a>
                                    <a href="{$url}/admin/index.php?action=edit&do=video&id={$v.pelicula_id}&v={$v.video_id}" class="btn" title="Editar video"><i class="icon-edit"></i></a>
                                    <a href="{$url}/admin/index.php?action=delete&do=video&id={$v.video_id}" class="btn" title="Eliminar video"><i class="icon-trash"></i></a>
                                    </div>
                                </td>
                            </tr>
                            {/foreach}
                        </tbody>
                    </table>
                    {else}
                    <div class="alert">No se han agregado videos a esta pel&iacute;cula.</div>
                    {/if}
                {/if}