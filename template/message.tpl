{include file='sections/main_header.tpl'}
            <hr />  
            <div class="row">
                <div class="popover span6 offset3" style="position:relative; display:block; max-width: none;">
                    <h3 class="popover-title">{$mtitle}</h3>
                    <div class="popover-content">
                      <p>{$message}</p><br />
                      <p><a href="{$mlink}">{$mlinktxt}</a></p>
                    </div>
                </div>
            </div>
            <hr />
{include file='sections/main_footer.tpl'}