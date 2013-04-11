        <!-- MENU -->
        <div class="pagination">
            <ul>
                <li{if $q|upper == '0-9'} class="active"{/if}><a title="Peliculas con n&uacute;meros" href="{$url}/letra/0-9/">0-9</a></li>
                {foreach from=$abc item=l}
				<li{if $q|upper == $l} class="active"{/if}><a title="Peliculas con la letra {$l}" href="{$url}/letra/{$l}/">{$l}</a></li>
                {/foreach}		
            </ul>
            <div class="clear"></div>
        </div>