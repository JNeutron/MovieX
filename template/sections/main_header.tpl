<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <title>{$title}</title>
    {if $mlink}<meta http-equiv="refresh" content="3;url={$mlink}" />{/if}
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link href="{$url_static}/css/bootstrap.min.css" rel="stylesheet" />
    <link href="{$url_static}/css/style.css" rel="stylesheet" />
    {if $page == 'admin' || $page == 'message'}
    <link rel="stylesheet" href="{$url_static}/js/jTable/style.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="{$url_static}/js/jTable/jquery-ui-1.8.14.custom.css" type="text/css" media="screen" />
    {/if}
</head>
<body>
    <div id="light"></div>
    <div id="fb-root"></div>
    {literal}
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/es_LA/all.js#xfbml=1&appId={/literal}{$config.fb_app_id}{literal}";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
    {/literal}
    <div class="container">
        <div class="header row-fluid">
            <div class="span4">
                <h3><a href="{$url}" class="muted">{$config.site_name}</a></h3>
            </div>
            <div class="span8">
                {if $page != 'admin' && $page != 'message'}
                <div class="row">
                    <div class="span12">
                        <div class="pull-right">
                            <form method="get" action="{$url}/search/" class="form-search" onsubmit="validar_search(); return false;">
                                <input type="text" id="s" name="qh" class="input-large search-query" value="" placeholder="Buscar película" />
                                <button type="submit" class="btn">Buscar</button>
                            </form>
                        </div>
                    </div>
                </div>
                {if $ads.ad468}
                <div class="row">
                    <div class="span12">
                        <div class="pull-right">
                            {$ads.ad468}
                        </div>
                    </div>
                </div>
                {/if}
                {/if}
            </div>
        </div>
        {if $page != 'admin' && $page != 'message'}{include file='sections/main_menu.tpl'}{/if}