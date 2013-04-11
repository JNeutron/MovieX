{include file='sections/main_header.tpl'}
            <div class="row">
                <div class="span9">
                    {if $movie.info.pelicula_id}
                    {include file='modules/moviex_info.tpl'}
                    {else}
                    <div class="alert">La pel&iacute;cula seleccionada no existe o no esta disponible por el momento.</div>
                    {/if}
                </div>
                {include file='modules/global_sidebar.tpl'}
            </div>
{include file='sections/main_footer.tpl'}