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
 * server.class.php
 * 
 * Server Plugin
 */
abstract class Server {
    
    /**
     * Soporte para GK Plugin
     * 
     * @var bool
     */
    public $gkPlugin = false;
    
    /**
     * Obtener ID del video.
     * 
     * @param string $url
     * @return string ID
     */
    abstract public function getId($url);
    
    /**
     * Generar código embed del video.
     * 
     * @param string $videoId
     * @return string Embed code
     */
    abstract public function getEmbed($videoId);
    
    /**
     * Generar URL para gkplugin
     * 
     * @param string $videoId
     * @return string URL
     */
    abstract public function getLink($videoId);
    
    /**
     * Se instaló soporte para GK Plugins?
     * 
     * @return bool
     */
    public function isPlugin()
    {
        return $this->gkPlugin;
    }
}