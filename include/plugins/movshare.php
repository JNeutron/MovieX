<?php
/**
 * MovieX
 * 
 * @author      Ivan Molina Pavana <montemolina@live.com>
 * @copyright   Copyright (c) 2013, Ivan Molina Pavana <montemolina@live.com>
 * @license     GNU General Public License, version 3
 */
 
// ------------------------------------------------------------------------

/**
 * movshare.mvx.php
 * 
 * Plugin para MovShare
 * 
 * @version 1.0.0
 */
 
// ---------------------------------------------------------------

class MovShare extends Server {
    
    /**
     * Soporte para GK Plugin
     * 
     * @var bool
     */
    public $gkPlugin = true;
    
    /**
     * Obtener ID del video.
     * 
     * @param string $url
     * @return string ID
     */
    public function getId($url)
    {
        preg_match('/www\.movshare\.net\/video\/(.+)/i', $url, $videoId);
        
        return (count($videoId) > 0) ? end($videoId) : null;
    }
    
    /**
     * Generar código embed del video.
     * 
     * @param string $videoId
     * @return string Embed code
     */
    public function getEmbed($videoId)
    {
        return '<iframe width="100%" height="100%" frameborder="0" src="http://embed.movshare.net/embed.php?v='. $videoId .'&width=700&height=420" scrolling="no"></iframe>';
    }
    
    /**
     * Generar URL para gkplugin
     * 
     * @param string $videoId
     * @return string URL
     */
    public function getLink($videoId)
    {
        return 'http://www.movshare.net/video/' . $videoId;
    }
}