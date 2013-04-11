{include file='sections/main_header.tpl'}
            <div class="row">
                <div class="span9">
                    <h3 class="mx_title" onclick="history.go(-1);">Descargar &raquo; <strong>{$dLink.p_titulo}</strong> de <strong>{$dLink.s_titulo}</strong></h3>
                    <hr />
                    <div class="row-fluid">
                        <div class="span8 offset2">
                            <ul class="nav nav-tabs nav-stacked">
                            {foreach from=$dLink.d_parts item=d key=part}
                            <li class="capitulo">
                                <a href="{$d}" target="_blank"><strong>Parte #{$part+1} : </strong>{$d}</a>
                            </li>
                            {/foreach}
                            </ul>
                            <p><a href="#" onclick="reportar({$dLink.descarga_id}, 'link'); return false;"><i class="icon-warning-sign"></i> Reportar enlace roto</a></p>
                        </div>
                    </div>
                    <hr />
                    <div style="text-align: center">
                        {$ads.ad300}
                    </div>
                    <hr />
                    <h3 class="mx_title">C&oacute;digo para gestores de descarga</h3>
                    <div class="row-fluid">
                        <textarea onclick="select(this);" rows="5" class="span12">{$dLink.d_source}</textarea>
                    </div>
                </div>
                {include file='modules/global_sidebar.tpl'}
            </div>
{include file='sections/main_footer.tpl'}