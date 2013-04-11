                    <div class="span9">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#last" data-toggle="tab">&Uacute;ltimas pel&iacute;culas</a></li>
                            <li><a href="#debut" data-toggle="tab">Estrenos</a></li>
                            <li><a href="#rank" data-toggle="tab">Las m&aacute;s votadas</a></li>
                            <li><a href="#top" data-toggle="tab">Las m&aacute;s vistas</a></li>
                        </ul>
                        <div class="tab-content">
                            <div id="last" class="tab-pane active">
                                <div>
                                {foreach from=$lastMoviex item=m key=key}
                                {if (($key+1)%3) == 1}</div><div class="row-fluid" style="margin-bottom:1em">{/if}
                                <div class="span4">
                                    <div class="thumbnail">
                                        <a title="{$m.p_titulo}" href="{$url}/{$m.g_seo}/{$m.p_titulo|seo}.html"><img src="{$url_cover}/{$m.pelicula_id}.jpg" /></a>
                                        <div class="caption">
                                            <h5><a title="{$m.p_titulo}" href="{$url}/{$m.g_seo}/{$m.p_titulo|seo}.html">{$m.p_titulo|truncate:50}</a></h5>
                                            <p><a href="{$url}/{$m.g_seo}">{$m.g_titulo}</a></p>
                                            <p>{$m.c_titulo}</p>
                                        </div>
                                    </div>
                                </div>
                                {foreachelse}
                                <div class="alert">No hay películas en esta categoría</div>
                                {/foreach}
                                </div>
                            </div>
                            <div id="debut" class="tab-pane">
                                <div>
                                {foreach from=$premiere item=m key=key}
                                {if (($key+1)%3) == 1}</div><div class="row-fluid" style="margin-bottom:1em">{/if}
                                <div class="span4">
                                    <div class="thumbnail">
                                        <a title="{$m.p_titulo}" href="{$url}/{$m.g_seo}/{$m.p_titulo|seo}.html"><img src="{$url_cover}/{$m.pelicula_id}.jpg" /></a>
                                        <div class="caption">
                                            <h5><a title="{$m.p_titulo}" href="{$url}/{$m.g_seo}/{$m.p_titulo|seo}.html">{$m.p_titulo|truncate:50}</a></h5>
                                            <p><a href="{$url}/{$m.g_seo}">{$m.g_titulo}</a></p>
                                            <p>{$m.c_titulo}</p>
                                        </div>
                                    </div>
                                </div>
                                {foreachelse}
                                <div class="alert">No hay películas en esta categoría</div>
                                {/foreach}
                                </div>
                            </div>
                            <div id="rank" class="tab-pane">
                                <div>
                                {foreach from=$rankMoviex item=m key=key}
                                {if (($key+1)%3) == 1}</div><div class="row-fluid" style="margin-bottom:1em">{/if}
                                <div class="span4">
                                    <div class="thumbnail">
                                        <a title="{$m.p_titulo}" href="{$url}/{$m.g_seo}/{$m.p_titulo|seo}.html"><img src="{$url_cover}/{$m.pelicula_id}.jpg" /></a>
                                        <div class="caption">
                                            <h5><a title="{$m.p_titulo}" href="{$url}/{$m.g_seo}/{$m.p_titulo|seo}.html">{$m.p_titulo|truncate:50}</a></h5>
                                            <p><a href="{$url}/{$m.g_seo}">{$m.g_titulo}</a></p>
                                            <p>{$m.c_titulo}</p>
                                        </div>
                                    </div>
                                </div>
                                {foreachelse}
                                <div class="alert">No hay películas en esta categoría</div>
                                {/foreach}
                                </div>
                            </div>
                            <div id="top" class="tab-pane">
                                <div>
                                {foreach from=$topMoviex item=m key=key}
                                {if (($key+1)%3) == 1}</div><div class="row-fluid" style="margin-bottom:1em">{/if}
                                <div class="span4">
                                    <div class="thumbnail">
                                        <a title="{$m.p_titulo}" href="{$url}/{$m.g_seo}/{$m.p_titulo|seo}.html"><img src="{$url_cover}/{$m.pelicula_id}.jpg" /></a>
                                        <div class="caption">
                                            <h5><a title="{$m.p_titulo}" href="{$url}/{$m.g_seo}/{$m.p_titulo|seo}.html">{$m.p_titulo|truncate:50}</a></h5>
                                            <p><a href="{$url}/{$m.g_seo}">{$m.g_titulo}</a></p>
                                            <p>{$m.c_titulo}</p>
                                        </div>
                                    </div>
                                </div>
                                {foreachelse}
                                <div class="alert">No hay películas en esta categoría</div>
                                {/foreach}
                                </div>
                            </div>
                        </div>
                    </div>