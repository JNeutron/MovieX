{include file='sections/main_header.tpl'}
            <div class="row">
                <div class="span9">
                    {if $result}
                    <h3 class="mx_title">{if $type == 'search'}Resultados para{elseif $type == 'abc'}Pel&iacute;culas con la letra{else}Género{/if} &raquo; {$q|ucfirst}</h3>
                    {foreach from=$result item=m}
                    <hr />
                    <div class="row-fluid">
                        <div class="span2">
                            <a title="{$m.p_titulo}" href="{$url}/{$m.g_seo}/{$m.p_titulo|seo}.html"><img src="{$url_cover}/{$m.pelicula_id}.jpg" width="100" class="img-polaroid" /></a>
                        </div>
                        <div class="span10">
                            <h3 class="mx_title"><a href="{$url}/{$m.g_seo}/{$m.p_titulo|seo}.html">{$m.p_titulo|truncate:50}</a></h3>
                            <p>{$m.p_sinopsis|truncate:400}</p>
                            <table class="table table-striped table-condensed">
                                <thead>
                                    <tr>
                                        <th>G&eacute;nero</th>
                                        <th>Calidad</th>
                                        <th>Agregado</th>
                                        <th>Visitas</th>
                                        <th>Votos</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{$m.g_titulo}</td>
                                        <td>{$m.c_titulo}</td>
                                        <td>{$m.p_date|fecha}</td>
                                        <td>{$m.p_hits}</td>
                                        <td>{$m.p_v_up}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    {/foreach}
                    {else}
                    <div class="alert">{if $type == 'abc'}Lo sentimos pero a&uacute;n no tenemos pel&iacute;culas con la letra &quot;<i>{$q|upper}</i>&quot;{elseif $type == 'search'}Lo sentimos tu b&uacute;squeda &quot;<i>{$q}</i>&quot; no produjo resultados.{else}Lo sentimos pero a&uacute;n no tenemos pel&iacute;culas en este genero.{/if}</div>
                    {/if}
                    <hr />
                </div>
                {include file='modules/global_sidebar.tpl'}
            </div>
{include file='sections/main_footer.tpl'}