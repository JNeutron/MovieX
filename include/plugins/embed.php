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
 * embed.php
 * 
 * Plugin para código embed
 * 
 * @version 1.0.0
 */
 
// ---------------------------------------------------------------

class Embed extends Server {
    
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
    public function getId($source)
    {
        $embed = htmlspecialchars_decode($source, ENT_QUOTES);
        $embed = str_replace("'",'"', $embed);
        $embed = preg_replace('/width="(\d+)"/i', 'width="100%"', $embed);
        $embed = preg_replace('/height="(\d+)"/i', 'height="100%"', $embed);
        
        return $embed;
    }
    
    /**
     * Generar código embed del video.
     * 
     * @param string $videoId
     * @return string Embed code
     */
    public function getEmbed($source)
    {
        return $source;
    }
    
    /**
     * Generar URL para gkplugin
     * 
     * @param string $videoId
     * @return string URL
     */
    public function getLink($source)
    {
        return $source;
    }
}