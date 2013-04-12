<object id="flashplayer" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="100%" height="100%">
    <param name="movie" value="{$url_static}/player/player.swf" />
    <param name="allowFullScreen" value="true" />
    <param name="allowScriptAccess" value="always" />
    <param name="flashvars" value="plugins={$url_static}/player/plugins/proxy.swf&proxy.link={$video.source}&skin={$url_static}/player/slim.zip&controlbar.position=over" />
    <embed name="flashplayer" src="{$url_static}/player/player.swf" flashvars="plugins={$url_static}/player/plugins/proxy.swf&proxy.link={$video.source}&skin={$url_static}/player/slim.zip&controlbar.position=over" type="application/x-shockwave-flash" allowfullscreen="true" allowScriptAccess="always" width="100%" height="100%" />
</object>