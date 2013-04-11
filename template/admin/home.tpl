                    {if $reports.videos}
                    <legend>&Uacute;ltimos videos reportados</legend>
                    <table class="table table-striped">
                    	<thead>
                            <th>No. Reportes</th>
                        	<th>Pel&iacute;cula</th>
                            <th>Servidor</th>
                            <th>Idioma</th>
                            <th>Calidad</th>
                            <th>Visitas</th>
                            <th>Agregado</th>
                            <th>Acciones</th>
                        </thead>
                        <tbody>
                        	{foreach from=$reports.videos item=r}
                            <tr>
                                <td>{$r.v_reports}</td>
                            	<td>{$r.p_titulo}</td>
                                <td>{$r.s_titulo}</td>
                                <td>{$r.i_titulo}</td>
                                <td>{$r.c_titulo}</td>
                                <td>{$r.v_hits}</td>
                                <td>{$r.v_upload|date_format:"%d/%m/%Y"}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{$url}/admin/index.php?action=out&do=video&id={$r.video_id}" target="_blank" class="btn" title="Ver video"><i class="icon-share-alt"></i></a>
                                        <a href="{$url}/admin/index.php?action=edit&do=video&id={$r.pelicula_id}&v={$r.video_id}" class="btn" title="Editar video"><i class="icon-edit"></i></a>
                                        <a href="{$url}/admin/index.php?action=delete&do=video&id={$r.video_id}" class="btn" title="Eliminar video"><i class="icon-trash"></i></a>
                                    </div>
                                </td>
                            </tr>
                            {/foreach}
                        </tbody>
                    </table>
                    {else}
                    <div class="alert">No ha sido reportado ningun video.</div>
                    {/if}
                    {if $reports.downs}
                    <legend>&Uacute;ltimos enlaces reportados</legend>
                    <table class="table table-striped">
                    	<thead>
                            <th>No. Reportes</th>
                        	<th>Pel&iacute;cula</th>
                            <th>Servidor</th>
                            <th>Idioma</th>
                            <th>Calidad</th>
                            <th>Visitas</th>
                            <th>Agregado</th>
                            <th>Acciones</th>
                        </thead>
                        <tbody>
                        	{foreach from=$reports.downs item=r}
                            <tr>
                                <td>{$r.d_reports}</td>
                            	<td>{$r.p_titulo}</td>
                                <td>{$r.s_titulo}</td>
                                <td>{$r.i_titulo}</td>
                                <td>{$r.c_titulo}</td>
                                <td>{$r.d_hits}</td>
                                <td>{$r.d_upload|date_format:"%d/%m/%Y"}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{$url}/admin/index.php?action=out&do=link&id={$r.descarga_id}" target="_blank" class="btn" title="Ver enlace"><i class="icon-share-alt"></i></a>
                                        <a href="{$url}/admin/index.php?action=edit&do=link&id={$r.pelicula_id}&l={$r.descarga_id}" class="btn" title="Editar enlace"><i class="icon-edit"></i></a>
                                        <a href="{$url}/admin/index.php?action=delete&do=link&id={$r.descarga_id}" class="btn" title="Eliminar enlace"><i class="icon-trash"></i></a>
                                    </div>
                                </td>
                            </tr>
                            {/foreach}
                        </tbody>
                    </table>
                    {else}
                    <div class="alert">No ha sido reportado ningun enlace de descarga.</div>
                    {/if}