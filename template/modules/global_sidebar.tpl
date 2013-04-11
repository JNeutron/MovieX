		<div class="span3">
            <div class="widget">
                <h4>Categor&iacute;as</h4>
                <ul class="nav nav-tabs nav-stacked">
                    {foreach from=$tags item=g}
                    <li><a title="Peliculas de {$g.g_titulo}" href="{$url}/{$g.g_seo}/">{$g.g_titulo}</a></li>
                    {/foreach}
                </ul>
            </div>
            {if $reports}
            <div class="content_bg">
    			<h4>Reportes</h4>
                <ul class="categories content_bg">
                    <li style="text-align:center">Los videos que aparecen a continuaci&oacute;n han sido reportados, ten paciencia los repondr&eacute;mos.</li>
                    {foreach from=$reports item=r}
                    <li class="cat-item cat-item-3"><a title="{$r.anime_title}" href="{$url}/{$r.anime_title|seo}/{$r.cap_id}/{$r.cap_title|seo}.html">{$r.anime_title} &raquo; {$r.cap_title}</a></li>
                    {/foreach}
                </ul>
            </div>
            {/if}
            {*include file='modules/hentai_chat.tpl'*}
        </div>