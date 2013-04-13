		<div class="span3">
            <div class="widget">
                <h4>Categor&iacute;as</h4>
                <ul class="nav nav-tabs nav-stacked">
                    {foreach from=$tags item=g}
                    <li><a title="Peliculas de {$g.g_titulo}" href="{$url}/{$g.g_seo}/">{$g.g_titulo}</a></li>
                    {/foreach}
                </ul>
            </div>
            {if $ads.ad160}
            <div style="text-align: center;">
                {$ads.ad160}
            </div>
            {/if}
        </div>