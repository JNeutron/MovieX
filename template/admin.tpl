{include file='sections/main_header.tpl'}
            <hr />
            {if $isAdmin}
            {include file='admin/sidebar.tpl'}
            {/if}
            <div class="row">
            {if $action == 'login'}
            {include file='admin/login.tpl'}
            {else}
                <div class="span12">
                    {if $result}<div class="alert alert-success">{$result}</div>{/if}
                    {if $error}<div class="alert">{$error}</div>{/if}
                {if $action == ''}
                {include file='admin/home.tpl'}
                {elseif $action == 'config'}
                    {include file='admin/form_config.tpl'}
                {* LISTADOS *}
                {elseif $action == 'list'}
                    {if $do == 'movies'}{include file='admin/list_movies.tpl'}
                    {elseif $do == 'videos'}{include file='admin/list_videos.tpl'}
                    {elseif $do == 'links'}{include file='admin/list_links.tpl'}
                    {elseif $do == 'servers'}{include file='admin/list_servers.tpl'}
                    {/if}
                {* EDICION *}
                {elseif $action == 'edit'}
                    {if $do == 'movie'}{include file='admin/form_movie.tpl'}
                    {elseif $do == 'video'}{include file='admin/form_video.tpl'}
                    {elseif $do == 'link'}{include file='admin/form_link.tpl'}
                    {elseif $do == 'server'}{include file='admin/form_server.tpl'}
                    {/if}
                {* AGREGAR *}
                {elseif $action == 'add'}
                    {if $do == 'movie'}{include file='admin/form_movie.tpl'}
                    {elseif $do == 'video'}{include file='admin/form_video.tpl'}
                    {elseif $do == 'link'}{include file='admin/form_link.tpl'}
                    {elseif $do == 'server'}{include file='admin/form_server.tpl'}
                    {/if}
                {elseif $action == 'delete'}
                    {include file='admin/form_delete.tpl'}
                {elseif $action == 'ads'}
                    {include file='admin/form_ads.tpl'}
                {/if}
                </div>
            {/if}
            </div>
            <hr />
{include file='sections/main_footer.tpl'}