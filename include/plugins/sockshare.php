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
 * sockshare.php
 * 
 * Plugin para SockShare
 * 
 * @version 1.0.0
 */
 
// ---------------------------------------------------------------

class SockShare extends Server {
    
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
        preg_match('/sockshare\.com\/file\/(.+)/i', $url, $videoId);
        
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
        return '<iframe src="http://www.sockshare.com/embed/' . $videoId . '" width="100%" height="100%" frameborder="0" scrolling="no"></iframe>';
    }
    
    /**
     * Generar URL para gkplugin
     * 
     * @param string $videoId
     * @return string URL
     */
    public function getLink($videoId)
    {
        return 'http://www.sockshare.com/file/' . $videoId;
    }
}