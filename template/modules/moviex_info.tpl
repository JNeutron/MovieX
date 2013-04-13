                    <h2>{$movie.info.p_titulo}</h2>
                    <div class="row-fluid">
                        <div class="span4"><img src="{$url_cover}/{$movie.info.pelicula_id}.jpg" /></div>
                        <div class="span8">
                            <p>{$movie.info.p_sinopsis}</p>
                            <table class="table table-striped table-condensed">
                                <thead>
                                    <tr>
                                        <th>A&ntilde;o</th>
                                        <th>G&eacute;nero</th>
                                        <th>Agregado</th>
                                        <th>Visitas</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{$movie.info.p_ano}</td>
                                        <td>{$movie.info.g_titulo}</td>
                                        <td>{$movie.info.p_date|fecha}</td>
                                        <td>{$movie.info.p_hits}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <p>
                                <span class="label label-success"><i class="icon-thumbs-up icon-white"></i> {$movie.info.p_v_up}</span>
                                <span class="label label-important"><i class="icon-thumbs-down icon-white"></i> {$movie.info.p_v_down}</span>
                            </p>
                        </div>
                    </div>
                    <hr />
                    {if $movie.vids}
                    <h3 class="mx_title">Ver online <strong>{$movie.info.p_titulo}</strong></h3>
                    <div class="row-fluid">
                        <div class="span8 offset2">
                            <ul class="nav nav-tabs nav-stacked">
                            {foreach from=$movie.vids item=v key=id}
                            <li class="capitulo">
                                <a href="{$url}/{$movie.info.g_seo}/{$movie.info.p_seo}_{$v.i_titulo|seo}-{$v.c_titulo|seo}-{$v.video_id}.html">
                                    <span class="title">Mirror {$id+1} : {$v.s_titulo}</span>
                                    <span class="info">Calidad: {$v.c_titulo} | Idioma: {$v.i_titulo}</span>
                                    <span class="icon"><img src="{$url_static}/img/video.png" /></span>
                                </a>
                            </li>
                            {/foreach}
                            </ul>
                        </div>
                    </div>
                    <hr />
                    {/if}
                    {if $ads.ad300}
                    <div style="text-align: center">
                        {$ads.ad300}
                    </div>
                    <hr />
                    {/if}
                    {if $movie.downs}
                    <h3 class="mx_title">Descargar <strong>{$movie.info.p_titulo}</strong></h3>
                    <div class="row-fluid">
                        <div class="span8 offset2">
                            <ul class="nav nav-tabs nav-stacked">
                            {foreach from=$movie.downs item=d key=id}
                            <li class="capitulo">
                                <a href="{$url}/{$movie.info.g_seo}/{$movie.info.p_seo}_{$d.i_titulo|seo}-{$d.c_titulo|seo}-descargar-{$d.descarga_id}.html">
                                    <span class="title">Mirror {$id+1} : {$d.s_titulo} {if $d.d_parts > 1}: {$d.d_parts} Partes{/if}</span>
                                    <span class="info">Calidad: {$d.c_titulo} | Idioma: {$d.i_titulo}</span>
                                    <span class="icon"><img src="{$url_static}/img/save.png" /></span>
                                </a>
                            </li>
                            {/foreach}
                            </ul>
                        </div>
                    </div>
                    <hr />
                    {/if}
                    {if $movie.rels}
                    <h3 class="mx_title">Otras pel&iacute;culas que te van a interesar</h3>
                    <div class="row-fluid">
                        {foreach from=$movie.rels item=m}
                        <div class="span4">
                            <a href="{$url}/{$m.g_seo}/{$m.p_seo}.html" title="{$m.p_titulo}"><img src="{$url_cover}/{$m.pelicula_id}.jpg" /></a>
                            <span>{$m.p_titulo|truncate:50}</span>
                        </div>
                        {/foreach}
                    </div>
                    {/if}