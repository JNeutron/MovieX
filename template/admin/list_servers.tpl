                    <ul class="breadcrumb">
                        <li><a href="{$url}/admin/index.php">Panel</a> <span class="divider">/</span></li>
                        <li class="active">Servidores</li>
                    </ul>
                    <div class="adminHeader clearfix">
                        <h2 class="pull-left">Lista de servidores</h2>
                        <div class="pull-right btn-group">
                            <a href="{$url}/admin/index.php?action=add&do=server" class="btn btn-success btn-small"><i class="icon-plus icon-white"></i> Agregar servidor</a>
                        </div>
                    </div>
                    {if $servers}
                    <table class="table table-striped">
                    	<thead>
                            <th>ID</th>
                            <th>Servidor</th>
                            <th>Videos</th>
                            <th>GK Plugin</th>
                            <th>Acciones</th>
                        </thead>
                        <tbody>
                        	{foreach from=$servers item=s}
                            <tr>
                                <td>{$s.servidor_id}</td>
                                <td>{$s.s_titulo}</td>
                                <td>{$s.total}</td>
                                <td>{if $s.s_plugin}<span class="label label-success" style="width: 34px"><i class="icon-ok icon-white"></i> SI</span>{else}<span class="label label-important"><i class="icon-remove icon-white"></i> NO</span>{/if}</td>
                                <td>
                                    <div class="btn-group">
                                    <a href="{$url}/admin/index.php?action=edit&do=server&id={$s.servidor_id}" class="btn" title="Editar enlace"><i class="icon-edit"></i></a>
                                    <a href="{$url}/admin/index.php?action=delete&do=server&id={$s.servidor_id}" class="btn" title="Eliminar enlace"><i class="icon-trash"></i></a>
                                    </div>
                                </td>
                            </tr>
                            {/foreach}
                        </tbody>
                    </table>
                    {else}
                    <div class="alert">No se han agregado enlaces de descarga a esta pel&iacute;cula.</div>
                    {/if}