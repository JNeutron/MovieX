{include file='sections/main_header.tpl'}
        <div class="row">
            <div class="span9">
                <h3 class="mx_title">{$pageInfo.page_title}</h3>
                {$pageInfo.page_content|nl2br}
            </div>
            {include file='modules/global_sidebar.tpl'}
        </div>
{include file='sections/main_footer.tpl'}