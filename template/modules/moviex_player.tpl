                    <h3 class="mx_title"><a href="{$url}/{$video.g_titulo|seo}/" title="Regresar a {$video.g_titulo}" class="qtip">{$video.g_titulo}</a> &raquo; <a href="{$url}/{$video.g_titulo|seo}/{$video.p_titulo|seo}.html" title="Regresar a {$video.p_titulo}" class="qtip">{$video.p_titulo}</a></h3>
                    <div class="row-fluid">
                        <div class="span12">
                            <div class="player_content">
                                <div class="player_embed">
                                    {$video.embed.code}
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr />
                    <div class="clearfix">
                        <div class="pull-left">
                            <p><strong>Subido el {$video.p_date|date_format:"%d/%m/%Y"}</strong></p>
                            <p><b>{$video.v_hits}</b> reproducciones</p>
                        </div>
                        <div class="pull-right">
                            <div class="btn-group">
                                <a href="#" data-toggle="toltip" class="btn" title="Apagar luces" id="light_switch"><i class="icon-adjust"></i></a>
                                <a href="#" data-toggle="toltip" class="btn" title="Reportar este video" onclick="reportar({$video.video_id}); return false;"><i class="icon-warning-sign"></i></a>
                                <a href="#" data-toggle="toltip" class="btn" title="Compartir pel&iacute;cula" onclick="shareFB('{$url}/{$video.g_titulo|seo}/{$video.p_titulo|seo}.html'); return false;"><i class="icon-retweet"></i></a>
                                <a href="{$video.embed.link}" target="_blank" data-toggle="toltip" class="btn" title="Ver en {$video.s_titulo}"><i class="icon-share-alt"></i></a>
                                <a href="#" data-toggle="toltip" class="btn btn-success" title="Me gusta" onclick="votar('pos', {$video.pelicula_id}); return false"><i class="icon-thumbs-up icon-white"></i> +{$video.p_v_up}</a>
                                <a href="#" data-toggle="toltip" class="btn btn-danger" title="No me gusta" onclick="votar('neg', {$video.pelicula_id}); return false"><i class="icon-thumbs-down icon-white"></i> -{$video.p_v_down}</a>
                            </div>
                        </div>
                    </div>
                    <hr />
                    <h3 class="mx_title"><fb:comments-count href="{$url}/{$video.g_titulo|seo}/{$video.p_titulo|seo}.html">0</fb:comments-count> comentarios</h3>
                    {if $video.cap_no > 1}<a href="{$url}/ajax.php?do=prev&aid={$video.anime_id}&ncp={$video.cap_no-1}" title="Video anterior" class="prev qtip">&nbsp;</a>{/if}
                    {if $video.anime_caps > $video.cap_no}<a href="{$url}/ajax.php?do=next&aid={$video.anime_id}&ncp={$video.cap_no+1}" title="Siguiente video" class="next qtip">&nbsp;</a>{/if}
                    <div class="fb-comments" data-href="{$url}/{$video.g_titulo|seo}/{$video.p_titulo|seo}.html" data-width="700" data-num-posts="10"></div>