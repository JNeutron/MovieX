                    <ul class="breadcrumb">
                        <li><a href="{$url}/admin/index.php">Panel</a> <span class="divider">/</span></li>
                        <li class="active">Películas</li>
                    </ul>
                    <div class="adminHeader clearfix">
                        <h2>Películas</h2>
                    </div>
                    <table class="table table-striped">
                    	<thead>
                            <th>ID</th>
                        	<th>T&iacute;tulo</th>
                            <th>Genero</th>
                            <th>Fecha</th>
                            <th>Visitas</th>
                            <th>Status</th>
                            <th style="width: 153px">&nbsp;</th>
                        </thead>
                        <tbody>
                        	{foreach from=$movies item=m}
                            <tr>
                                <td>{$m.pelicula_id}</td>
                            	<td style="text-align: left;">{$m.p_titulo}</td>
                                <td>{$m.g_titulo}</td>
                                <td>{$m.p_date|date_format:"%d/%m/%Y"}</td>
                                <td>{$m.p_hits}</td>
                                <td><span class="label label-{if $m.p_online == 1}success{else}important{/if}">{if $m.p_online == 1}On{else}Off{/if}line</span></td>
                                <td>
                                    <div class="btn-group">
                                    <a href="{$url}/admin/index.php?action=edit&do=movie&id={$m.pelicula_id}" class="btn" data-toggle="tooltip" title="Editar"><i class="icon-edit"></i></a>
                                    <a href="{$url}/admin/index.php?action=list&do=videos&id={$m.pelicula_id}" class="btn" title="Videos de la pel&iacute;cula"><i class="icon-film"></i></a>
                                    <a href="{$url}/admin/index.php?action=list&do=links&id={$m.pelicula_id}" class="btn" title="Enlaces de descarga"><i class="icon-globe"></i></a>
                                    <a href="{$url}/admin/index.php?action=delete&do=movie&id={$m.pelicula_id}" class="btn" title="Eliminar pel&iacute;cula"><i class="icon-trash"></i></a>
                                    </div>
                                </td>
                            </tr>
                            {/foreach}
                        </tbody>
                    </table>
