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
 * moviex.class.php
 * 
 * Contiene todas las funciones para que el script funcione.
 * 
 */
class Moviex extends Database {
    /**
    * Url de trabajo
    *
    * @access	private
    * @var		object
    */
    private $url;
	/**
	 * Constructor
	 * 
	 * @access	public
	 * @param	none
	 * @return	void
	 */
     public function __construct()
     {
        global $_CONF;
        parent::__construct();
        // Configuraciones
        $query = $this->query('SELECT * FROM cb_config');
        while($row = $this->fetch_assoc($query))
        {
            $_CONF[$row['var']] = $row['value'];
        }
        //
        $this->url = $_CONF['site.url'];
     }
    /**
     * MOVIEX INSTALADO?
     * 
     * @access public
     * @param none
     * @return void
     */
    public function isInstalled(){
        $script = explode('/', $_SERVER['SCRIPT_NAME']);
        $script = end($script);
        $query = $this->select("cb_admins","*","1");
        $install = $this->num_rows($query);
        if(!$install && $script != 'install.php') header("Location: admin/install.php");
        else return true;
    }
    /**
     * Cargar publicidad
     * 
     * @access public
     * @param none(
     * @return array
     */
    public function getAds(){
        $query = $this->query("SELECT * FROM cb_publicidad WHERE 1");
        while($row = $this->fetch_assoc($query)){
            $ads[$row['ad_key']] = htmlspecialchars_decode($row['ad_code'], ENT_QUOTES);
        }
        //
        return $ads;
    }
	/**
	 * Cargar lista de películas
	 * 
	 * @access	public
	 * @param	string
	 * @return	void
	 */
     public function getMovies($type = 'rand', $limit = 20){
        // ORDENAR POR...
        if($type == 'debut') {$where = 'AND p_estreno = 1'; $order = 'p_date DESC';}
        elseif($type == 'last') $order = 'p_date DESC';
        elseif($type == 'top') $order = 'p_hits DESC';
        elseif($type == 'rank') $order = 'p_v_up DESC';
        else $order = 'RAND()';
        //
        $query = $this->query("SELECT p.*, g.g_titulo, g.g_seo, c.c_titulo  FROM cb_peliculas AS p LEFT JOIN cb_generos AS g ON p.p_genero = g.genero_id LEFT JOIN cb_calidades AS c ON p.p_calidad = c.calidad_id WHERE p.p_online = 1 {$where} ORDER BY {$order} LIMIT {$limit}");
        echo $this->error();
        $data = $this->fetch_array($query);
        $this->free($query);
        //print_r($data);
        //die;
        //
        return $data;
     }
	/**
	 * TAGS
	 * 
	 * @access	public
	 * @param	void
	 * @return	array
	 */
     public function getTags(){
        $query = $this->query("SELECT * FROM cb_generos WHERE 1 ORDER BY g_titulo");
        $data = $this->fetch_array($query);
        $this->free($query);
        //
        return $data;
     }
	/**
	 * Videos reportados
	 * 
	 * @access	public
	 * @param	string
	 * @return	void
	 */
    public function getReports(){
        $query = $this->query("SELECT c.cap_id, c.cap_title, a.anime_title FROM a_capitulos AS c LEFT JOIN a_animes AS a ON c.anime_id = a.anime_id WHERE c.cap_reports > 2 ORDER BY c.cap_reports DESC LIMIT 15");
        $data = $this->fetch_array($query);
        $this->free($query);
        //
        return $data;
    }
	/**
	 * Movie information
	 * 
	 * @access	public
	 * @param	void
	 * @return	array
	 */
     public function getMovieInfo(){
        $movieID = strtolower($_GET['mid']);
        // INFORMACION
        $query = $this->query("SELECT p.*, g.g_titulo, g.g_seo, c.c_titulo  FROM cb_peliculas AS p LEFT JOIN cb_generos AS g ON p.p_genero = g.genero_id LEFT JOIN cb_calidades AS c ON p.p_calidad = c.calidad_id WHERE p.p_seo = '{$movieID}' LIMIT 1");
        $data['info'] = $this->fetch_assoc($query);
        $this->free($query);
        // VIDEOS
        $query = $this->query("SELECT v.video_id, v.v_servidor, c.c_titulo, i.i_titulo, s.s_titulo FROM cb_videos AS v LEFT JOIN cb_calidades AS c ON v.v_calidad = c.calidad_id LEFT JOIN cb_idiomas AS i ON v.v_idioma = i.idioma_id LEFT JOIN cb_servidores AS s ON v.v_servidor = s.servidor_id WHERE v.pelicula_id = {$data['info']['pelicula_id']} AND v.v_online = 1 ORDER BY v.video_id DESC");
        $data['vids'] = $this->fetch_array($query);
        $this->free($query);
        // DESCARGAS
        $query = $this->query("SELECT d.descarga_id, d.d_servidor, d.d_source, c.c_titulo, i.i_titulo, s.s_titulo FROM cb_descargas AS d LEFT JOIN cb_calidades AS c ON d.d_calidad = c.calidad_id LEFT JOIN cb_idiomas AS i ON d.d_idioma = i.idioma_id LEFT JOIN cb_servidores AS s ON d.d_servidor = s.servidor_id WHERE d.pelicula_id = {$data['info']['pelicula_id']} AND d.d_online = 1 ORDER BY d.descarga_id DESC");
        while($row = $this->fetch_assoc($query)){
            $parts = explode("\n",$row['d_source']);
            $row['d_parts'] = count($parts);
            // DATOS
            $data['downs'][] = $row;
        }
        $this->free($query);
        // RELACIONADOS
        $tags = explode(' ', $data['info']['p_titulo']);
		$tags = implode(", ",$tags);
        $data['rels'] = $this->getSearch($tags, 4, true);
        // UPDAYE
        if(!empty($data['info'])) $this->countHit('p', $data['info']['pelicula_id']);
        //
        return $data;
     }
	/**
	 * Búsqueda
	 * 
	 * @access	public
	 * @param	string | array
	 * @return	array
	 */
     public function getSearch($q, $limit = 4, $random = false){
        //
        $do = $_GET['do'];
        //
        if($do == 'abc'){
            if($q == '0-9'){
    			for ($i = 97; $i < 123; $i++){
    				$sql_where .= " AND p.p_titulo NOT LIKE '" . chr($i) . "%'";
    			}
            } else $sql_where = "AND p.p_titulo LIKE '{$q}%'";
            //
            $query = $this->query("SELECT p.*, g.g_titulo, g.g_seo, c.c_titulo  FROM cb_peliculas AS p LEFT JOIN cb_generos AS g ON p.p_genero = g.genero_id LEFT JOIN cb_calidades AS c ON p.p_calidad = c.calidad_id WHERE p.p_online = 1 {$sql_where} ORDER BY p.p_titulo LIMIT 20");
            //
        } elseif($do == 'genero') {
            $g = $this->fetch_assoc($this->query("SELECT * FROM cb_generos WHERE g_seo = '{$q}' LIMIT 1"));
            if($g['genero_id']){
                $query = $this->query("SELECT p.*, g.g_titulo, g.g_seo, c.c_titulo  FROM cb_peliculas AS p LEFT JOIN cb_generos AS g ON p.p_genero = g.genero_id LEFT JOIN cb_calidades AS c ON p.p_calidad = c.calidad_id WHERE p.p_genero = {$g['genero_id']} AND p.p_online = 1 ORDER BY p.p_titulo LIMIT 20");
            } else return false;
        } else {
            $order_by = ($random == true) ? 'RAND()' : 'p.p_titulo';
            $query = $this->query("SELECT DISTINCT p.*, g.g_titulo, g.g_seo, c.c_titulo FROM cb_peliculas AS p LEFT JOIN cb_generos AS g ON p.p_genero = g.genero_id LEFT JOIN cb_calidades AS c ON p.p_calidad = c.calidad_id WHERE MATCH (p.p_titulo) AGAINST ('{$q}' IN BOOLEAN MODE) AND p.p_online = 1 ORDER BY {$order_by} LIMIT {$limit}");
        }
        // 
        $data = $this->fetch_array($query);
        $this->free($query);
        //
        return $data;
     }
	/**
	 * Hentai video
	 * 
	 * @access	public
	 * @param	void
	 * @return	array
	 */
     public function getMovieVideo(){
        // VARS
        $vid = (int) $_GET['id'];
        // CARGAMOS INFORMACION DEL VIDEO
        $query = $this->query("SELECT m.p_titulo, m.p_date, m.p_v_up, m.p_v_down, g.g_titulo, v.*, c.c_titulo, i.i_titulo, s.s_titulo FROM cb_peliculas AS m LEFT JOIN cb_videos AS v ON m.pelicula_id = v.pelicula_id LEFT JOIN cb_generos AS g ON m.p_genero = g.genero_id LEFT JOIN cb_calidades AS c ON v.v_calidad = c.calidad_id LEFT JOIN cb_idiomas AS i ON v.v_idioma = i.idioma_id LEFT JOIN cb_servidores AS s ON v.v_servidor = s.servidor_id WHERE v.video_id = {$vid} LIMIT 1");
        $data = $this->fetch_assoc($query);
        $this->free($query);
        
        //
        if ($data['s_plugin'] || $data['v_embed'])
        {
            $serverName = (empty($data['v_embed']) ? $data['s_titulo'] : 'embed');
            //
            $plugin = $this->plugin($serverName);
            //
            $data['plugin'] = $plugin->isPlugin();
            $data['source'] = $plugin->getLink($data['v_source']);
            $data['embed'] = $plugin->getEmbed($data['v_source']);
        }
        else
        {
            $data['plugin'] = false;
            $data['source'] = false;
            $data['embed'] = $data['v_source'];   
        }
        // UPDATE
        if(!empty($data)) $this->countHit('v', $data['video_id']);
        //
        return $data;
     }
    /**
     * Embed of Video
     * 
     * @access private
     * @param string | int
     * @return string
     */
    private function getEmbedVideo($source, $server){
        // TIPO DE SERVIDOR
        switch($server){
            # MEGAVIDEO
            case 1:
                $return['link'] = 'http://www.megavideo.com/?v='.$source;
                $return['code'] = '<embed width="100%" height="100%" allowfullscreen="true" type="application/x-shockwave-flash" src="http://wwwstatic.megavideo.com/mv_player.swf?image=http://caratulas.cinetube.es/img/cont/movie.jpg&amp;v='.$source.'">';
            break;
            # EMBED
            case 2:
                $return['link'] = '#';
                $return['code'] = htmlspecialchars_decode($source, ENT_QUOTES);
            break;
        }
        //
        return $return;
    }
    /**
     * GENERAR LINK ORIGINAL DE UN VIDEO
     * 
     * @access public
     * @param string, int
     * @return none
     */
    public function getVideoSource($source, $server){
        switch($server){
            # MEGAVIDEO #
            case 1:
                $data['v_source'] = 'http://www.megavideo.com/?v='.$source;
                $data['type'] = 'remote';
            break;
            # EMBED #
            case 2:
                $data['type'] = 'local';
            break;
        }
        //
        return $data;
    }
    /**
     * GENERAR LINK ORIGINAL DE UN VIDEO
     * 
     * @access public
     * @param string, int
     * @return none
     */
    public function getLinkSource($source, $server){
        switch($server){
            # MEGAUPLOAD #
            case 3:
                return 'http://www.megaupload.com/?d='.$source;
            break;
            # MEDIAFIRE #
            case 4:
                return 'http://www.mediafire.com/?'. $source;
            break;
            # FileServe #
            case 5:
                return 'http://www.fileserve.com/file/'.$source.'/';
            break;
        }
    }
    /**
     * Download movie
     * 
     * @access public
     * @param none
     * @return array
     */
    public function getDownloadLink(){
        $did = (int) $_GET['id'];
        // CARGAMOS INFORMACION DE LA DESCARGA
        $query = $this->query("SELECT m.p_titulo, d.*, c.c_titulo, i.i_titulo, s.s_titulo FROM cb_peliculas AS m LEFT JOIN cb_descargas AS d ON m.pelicula_id = d.pelicula_id LEFT JOIN cb_calidades AS c ON d.d_calidad = c.calidad_id LEFT JOIN cb_idiomas AS i ON d.d_idioma = i.idioma_id LEFT JOIN cb_servidores AS s ON d.d_servidor = s.servidor_id WHERE d.descarga_id = {$did} LIMIT 1");
        $data = $this->fetch_assoc($query);
        $this->free($query);
        // EDIT
        $parts = explode("\n",$data['d_source']);
        foreach($parts as $part){
            $source = $this->getLinkSource($part, $data['d_servidor']);
            // ASSIGN
            $data['d_parts'][] = $source;
            $nSource .= $source."\n"; 
        }
        $data['d_source'] = substr($nSource, 0, -1);
        // UPDATE
        if(!empty($data)) $this->countHit('d', $data['descarga_id']);
        //
        return $data;
    }
    /**
     * PAGINA DE ERRROR
     * 
     * @access public
     * @param string
     * @return void
     */
    public function error_page($type, $message = '', $style = ''){
        global $tpl, $_CONF;
        // PAGINA DE ERROR
        switch($type){
            case 'not_fund':
                $title = 'Error 404 - '. $_CONF['site.title'];                
            break;
            case 'view_embed':
                $title = 'Vista previa - '. $_CONF['site.title'];
                $mtitle = 'Vista previa del video';
            break;
            case 'view_links':
                $title = 'Lista de enlaces - '. $_CONF['site.title'];
                $mtitle = 'Enlace dividido en partes';
            break;
        }
        // ERROR
        $message = empty($message) ? 'La p&aacute;gina solicidata no ha sido encontrada.' : $message;
        $mtitle = empty($mtitle) ? 'Error 404' : $mtitle;
        $tpl->assign("message", $message);
        $tpl->assign("mtitle", $mtitle);
        $tpl->assign("style", $style);
        
        $tpl->display('404.tpl');
        exit;
    }
	/**
	 * Extra report
	 * 
	 * @access	public
	 * @param	void
	 * @return	void
	 */
     public function setReport(){
        $id = $_POST['id'];
        $type = ($_POST['type'] == 'link') ? 'link' : 'video';  
        $pre = ($type == 'link') ? 'd_' : 'v_';
        $db = ($type == 'link') ? 'descarga' : 'video';
        // BUSCAMOS
        $cookie = unserialize(base64_decode($_COOKIE['moviex_reports_' . $type]));
        if(empty($cookie)) $cookie = array();
        if(in_array($id, $cookie)) return '0: Ya has reportado esta película.';
        
        if($this->update("cb_{$db}s","{$pre}reports = {$pre}reports + 1","{$db}_id = {$id}")){
            array_push($cookie, $id);
            $cookie = base64_encode(serialize($cookie));
            setcookie('moviex_reports_' . $type,$cookie, time()+16070400,'/');
            return '1: Gracias por tu reporte. Lo atenderemos lo antes posible.';
        } else return '0: Error';
        return true;
     }
	/**
	 * Extra voto
	 * 
	 * @access	public
	 * @param	
	 * @return	void
	 */
     public function votar(){
        $mid = $_POST['mid'];
        $voto = $_POST['voto'];
        // BUSCAMOS
        $cookie = unserialize(base64_decode($_COOKIE['moviex_votos']));
        if(empty($cookie)) $cookie = array();
        if(in_array($mid, $cookie)) return '0: Ya has votado esta película.';
        // 
        $where = ($voto == 'pos') ? 'p_v_up' : 'p_v_down';
        if($this->update("cb_peliculas","{$where} = {$where} + 1","pelicula_id = {$mid}")){
            array_push($cookie, $mid);
            $cookie = base64_encode(serialize($cookie));
            setcookie('moviex_votos',$cookie, time()+16070400,'/');
            return '1: Gracias por tu voto!';
        }
     }
    /**
     * CARGAR PAGINA
     * 
     * @access public
     * @param string
     * @return array
     */
    public function getPage($mypage){
        global $_CONF;
        //
        $query = $this->select("cb_paginas","*","page_key = '{$mypage}'", "", 1);
        $data = $this->fetch_assoc($query);
        $this->free();
        // EDITAR
        $data['page_title'] = str_replace('$site', $_CONF['site.title'], $data['page_title']);
        $data['page_content'] = str_replace('$site', $_CONF['site.title'], $data['page_content']);
        //
        if(empty($data)) $this->error_page('not_found');
        else return $data;
    }
    /**
     * Current URL
     * 
     * @access public
     * @param none
     * @return string
     */
	public function currentUrl(){
		$current_url_domain = $_SERVER['HTTP_HOST'];
		$current_url_path = $_SERVER['REQUEST_URI'];
		$current_url_querystring = $_SERVER['QUERY_STRING'];
		$current_url = "http://".$current_url_domain.$current_url_path;
		//$current_url = urlencode($current_url);
		return $current_url;
	}
    
    /**
     * Contar Visita
     * 
     * @access public
     * @param $table
     * @param $id
     * @return void
     */
    public function countHit($type, $id)
    {
        $hash = substr(md5($table . $id), 0, 10);
        
        if ( ! isset($_SESSION['count'][$hash]))
        {
            $table = array(
                'p' => array(
                    'table' => 'cb_pelicuas',
                    'col' => 'p_hits',
                    'cond' => 'pelicula_id'
                ),
                'v' => array(
                    'table' => 'cb_videos',
                    'col' => 'v_hits',
                    'cond' => 'video_id'
                ),
                'd' => array(
                    'table' => 'cb_descargas',
                    'col' => 'd_hits',
                    'cond' => 'descarga_id'
                )
            );
            
            //
            $col = $table[$type]['col'];
            $cond = $table[$type]['cond'];
            $table = $table[$type]['table'];
            
            $this->query("UPDATE {$table} SET {$col} = {$col} + 1 WHERE {$cond} = {$id}");
            
            $_SESSION['count'][$hash] = true;
        }
    }
    
    /**
     * Cargar Plugin de Servidor
     * 
     * @param string $serverName
     * @return void
     */
    public function &plugin($serverName)
    {
        if (file_exists($filePath = INC_PATH . 'plugins' . DS . strtolower($serverName) . '.php'))
        {
            require_once $filePath;
            
            if (class_exists($serverName))
            {
                return new $serverName();
            }
        }
        
        return false;
    }
 }