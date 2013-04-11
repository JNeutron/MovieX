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
 * admin.class.php
 * 
 * Administración del sitio.
 * 
 */
class Admin extends Database {
    /**
     * VARIABLES
     **/
    public $admin = array();
    private $session = '';
    public $error = '';
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
     public function __construct(){
        parent::__construct();
        //
        global $_CONF;
        
        $this->url = $_CONF['site.path'] . "/admin/index.php";
        
        if(empty($_SESSION['moviex'])) $this->loadSession($_SESSION['moviex']);
        //
     }
	/**
	 * CARGAR SESION DE USUARIO
	 * 
	 * @access	public
	 * @param	string
	 * @return	void
	 */
     public function loadSession($admin){
        if(!empty($admin)) $this->session = $_SESSION['moviex'];
        elseif($_GET['action'] != 'login') $this->message('Debes iniciar sesi&oacute;n para acceder a esta p&aacute;gina', "{$this->url}?action=login", 'Iniciar sesi&oacute;n');
     }
    /**
     * INICIAR SESION 
     *
     * @access public
     * @param none
     * @return void
     */
     public function adminLogin(){
        $user = strtolower($_POST['user']);
        $pass = $_POST['pass'];
        // EMCRYPT PASSWORD
        $key = md5($user.$pass);
        // ELEGIR USUARIO
        $query = $this->query("SELECT * FROM cb_admins WHERE LOWER(a_name) = '{$user}' AND a_password = '{$key}' LIMIT 1");
        $this->admin = $this->fetch_assoc($query);
        if($this->admin['admin_id']){
            $_SESSION['moviex'] = md5(time());
            // UPDATE
            $time = time();
            $this->update("cb_admins", "a_last_login = {$time}", "admin_id = {$this->admin['admin_id']}");
            // MENSAJE
            $this->message('Ha sido autentificado y ser&aacute; llevado al Panel de Administraci&oacute;n', "{$this->url}", 'Ir al Panel de Administraci&oacute;n');
        } else $this->error = 'No te puedo dejar entrar. Tus datos son incorrectos.';
     }
    /**
     * VIDEOS Y LINKS REPORTADOS POR LOS USUARIOS
     */
    public function getReports(){
        // VIDEOS
        $query = $this->query("SELECT v.*, m.p_titulo, c.c_titulo, i.i_titulo, s.s_titulo FROM cb_videos AS v LEFT JOIN cb_peliculas AS m ON v.pelicula_id = m.pelicula_id LEFT JOIN cb_calidades AS c ON v.v_calidad = c.calidad_id LEFT JOIN cb_idiomas AS i ON v.v_idioma = i.idioma_id LEFT JOIN cb_servidores AS s ON v.v_servidor = s.servidor_id WHERE v.v_reports > 0 ORDER BY v.v_reports DESC");
        $data['videos'] = $this->fetch_array($query);
        $this->free($query);
        // DESCARGAS
        $query = $this->query("SELECT d.*, m.p_titulo, c.c_titulo, i.i_titulo, s.s_titulo FROM cb_descargas AS d LEFT JOIN cb_peliculas AS m ON d.pelicula_id = m.pelicula_id LEFT JOIN cb_calidades AS c ON d.d_calidad = c.calidad_id LEFT JOIN cb_idiomas AS i ON d.d_idioma = i.idioma_id LEFT JOIN cb_servidores AS s ON d.d_servidor = s.servidor_id WHERE d.d_reports > 0 ORDER BY d.d_reports DESC");
        $data['downs'] = $this->fetch_array($query);
        $this->free($query);
        //
        return $data;
    }
    /**
     * Cargar todas las películas
     * 
     * @access public
     * @param none
     * @return array
     */
    public function getMovies(){
        $query = $this->query("SELECT m.*, g.g_titulo FROM cb_peliculas AS m LEFT JOIN cb_generos AS g ON m.p_genero = g.genero_id WHERE 1 ORDER BY pelicula_id DESC");
        $data = $this->fetch_array($query);
        $this->free($query);
        //
        return $data;
    }
    /**
     * Cargar generos, idiomas, calidades
     * 
     * @access public
     * @param none
     * @return array
     */
    public function getCarData(){
        // GENEROS
        $query = $this->query("SELECT * FROM cb_generos WHERE 1 ORDER BY g_titulo");
        $data['generos'] = $this->fetch_array($query);
        $this->free($query);
        // IDIOMAS
        $query = $this->query("SELECT * FROM cb_idiomas WHERE 1 ORDER BY i_titulo");
        $data['idiomas'] = $this->fetch_array($query);
        $this->free($query);
        // CALIDADES
        $query = $this->query("SELECT * FROM cb_calidades WHERE 1 ORDER BY c_titulo");
        $data['calidades'] = $this->fetch_array($query);
        $this->free($query);
        // SERVIDOR LINKS
        $query = $this->query("SELECT * FROM cb_servidores WHERE s_type = 2 ORDER BY s_titulo");
        $data['s_links'] = $this->fetch_array($query);
        $this->free($query);
        // SERVIDOR VIDEOS
        $query = $this->query("SELECT * FROM cb_servidores WHERE s_type = 1 ORDER BY s_titulo");
        $data['s_videos'] = $this->fetch_array($query);
        $this->free($query);        
        //
        return $data;
    }
    /**
     * Agregar nueva película
     * 
     * @access public
     * @param none
     * @return void
     **/
    public function newMovie(){
        $mData = $this->getMovieData();
        if(!$mData) return false;
        // CARGAMOS LA PORTADA
        $cover = $this->savePortada();
        // SI PORTADA AGREGAR A DB
        if(!empty($cover)){
            $this->insert("cb_peliculas", 
            "p_titulo, p_seo, p_sinopsis, p_ano, p_genero, p_idiomas, p_calidad, p_estreno, p_date, p_online",
            "'{$mData['p_titulo']}', '{$mData['p_seo']}', '{$mData['p_sinopsis']}', {$mData['p_ano']}, {$mData['p_genero']}, {$mData['p_idioma']}, {$mData['p_calidad']}, {$mData['p_estreno']}, {$mData['p_date']}, {$mData['p_online']}"
            );
            // MOVIE ID
            $movie_id = $this->insert_id();
            // RENOMBRAMOS COVER
            $this->renamePortada($cover, $movie_id);
            // LOCATION
            $this->message('La pel&iacute;cula <b>'.$mData['p_titulo'].'</b> fue agregada correctamente.', "{$this->url}?action=list&do=movies", 'Ir al listado de pel&iacute;culas.');
        } else return false;
    }
    /**
     * Cargar información de la película
     * 
     * @access public
     * @param none
     * @return array
     */
    public function getMovie(){
        $id = $_GET['id'];
        $query = $this->select("cb_peliculas","*","pelicula_id = {$id}","", 1);
        $data = $this->fetch_assoc($query);
        $this->free($query);
        return $data;
    }
    /**
     * Armar datos de una película resibidos por POST
     * 
     * @access private
     * @param none
     * @return array
     */
    private function getMovieData(){
        // VARIABLES
        $mData = array(
            'p_titulo' => empty($_POST['titulo']) ? null : $_POST['titulo'],
            'p_seo' => $this->setSeo($_POST['titulo']),
            'p_genero' => empty($_POST['genero']) ? null : $_POST['genero'],
            'p_idioma' => empty($_POST['idioma']) ? null : $_POST['idioma'],
            'p_calidad' => empty($_POST['calidad']) ? null : $_POST['calidad'],
            'p_ano' => empty($_POST['ano']) ? null : $_POST['ano'],
            'p_sinopsis' => empty($_POST['sinopsis']) ? null : $_POST['sinopsis'],
            'p_estreno' => empty($_POST['estreno']) ? 0 : 1,
            'p_online' => empty($_POST['online']) ? 0 : 1,
            'p_date' => time(), 
        );
        // VERIFICAR VACIOS
        foreach($mData as $key => $val){
            if(!isset($val)) {
                $this->error = 'Todos los campos son requeridos.';
                return false;
            }
        }
        //
        return $mData;
    }
    /**
     * EDITAR INFORMACION DE UNA PELICULA
     * 
     * @access public
     * @param none
     * @return void
     */
    public function editMovie(){
        $id = $_GET['id'];
        // CARGAR INFORMACION
        $mData = $this->getMovieData();
        if(!$mData) return false;
        // CARGAMOS LA PORTADA
        if(empty($_FILES['cover']['error'])){
            $cover = $this->savePortada($id);
        }
        // SI HAY ERRORES SALIMOS
        if($this->error) return false;
        // ACTUALIZAMOS DATOS
        extract($mData); // <= CONVERTIMOS EL ARRAY A VARIABLES PARA AHORRAR ESPACIO
        // UPDATE
        if($this->update("cb_peliculas",
        "p_titulo = '{$p_titulo}', p_seo = '{$p_seo}', p_sinopsis = '{$p_sinopsis}', p_genero = {$p_genero}, p_idiomas = '{$p_idioma}', p_calidad = {$p_calidad}, p_ano = {$p_ano}, p_estreno = {$p_estreno}, p_online = {$p_online}",
        "pelicula_id = {$id}")) return 'Pel&iacute;cula actualizada correctamente. <a href="'. $this->url . '?action=list&do=movies" />Ver lista de pel&iacute;culas</a>.';
    }
    /**
     * ELIMINAR UNA PELICULA
     * 
     * @access public
     * @param none
     * @return void
     */
    public function delMovie(){
        $id = (int) $_GET['id'];
        // DATOS
        $movie = $this->getMovie();
        // ELIMINAR DATOS
        $this->delete("cb_videos","pelicula_id = {$id}");
        $this->delete("cb_descargas","pelicula_id = {$id}");
        // ELIMINAMOS
        if(empty($movie)) {
            $this->error = 'No se ha podido eliminar la pel&iacute;cula debido a que no existe en la base de datos.';
            return false;
        }
        elseif($this->delete("cb_peliculas","pelicula_id = {$id}")) return 'La pel&iacute;cula <u>'.$movie['p_titulo'].'</u> asi como sus videos y enlaces fueron eliminados correctamente. Ir a p&aacute;gina <a href="'.$this->url.'">principal</a>.';
    }
    /**
     * Guardar portada de la película
     * 
     * @access private
     * @param int
     * @return string
     */
	private function savePortada($name = 0){
        // NOMBRE
        $name = empty($name) ? '0c_'. mt_rand(1, 9) : $name;
        // SETEAMOS
		$file = $_FILES['cover'];
		$maxFileSize = 1024 * 1024; // 1MB
		if($file['size'] > $maxFileSize) {
            $this->error = 'La imagen no debe pesar m&aacute;s de 1MB';
            return false; 
		}
    	//
		switch($file['type']){
			case 'image/jpeg':
			case 'image/jpg':
				$img = imagecreatefromjpeg($file['tmp_name']);
				break;
			case 'image/gif':
				$img = imagecreatefromgif($file['tmp_name']);
				break;
			case 'image/png':
				$img = imagecreatefrompng($file['tmp_name']);
				break;
            default:
                $this->error = 'El archivo no es una imagen v&aacute;lida, solo im&aacute;genes <u>jpg, png y gif</u>.';
                return false; 
            break;
		}
        // BORRAMOS LA ANTERIOR 
		$cover_file = FILE_PATH . 'cover' . DS . $name . '.jpg';
        if(file_exists($cover_file)){
            unlink($cover_file);
        }
		//
		if($img && empty($this->error)){
			//
			$width = imagesx($img);
			$height = imagesy($img); 
			//
			$new_width = 223;
			$new_height = 315;
			//
			$cover = imagecreatetruecolor($new_width, $new_height); 
			imagecopyresampled($cover, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height);			//
			//
			imagejpeg($cover,$cover_file,100);
			imagedestroy($img);
			imagedestroy($cover);
		} else {
            $this->error = 'Verifica que la carpeta <u>/file/cover/</u> tenga los permisos de escritura <u>777</u>';
		}
        // RETORNAMOS NOMBRE TEMPORAL
		return $name;
	}
    /**
     * RENOMBRAR PORTADA
     * 
     * @access private
     * @param string, int
     * @return void
     */
    private function renamePortada($old, $new){
        // NOMBRES
        $cover_old = FILE_PATH . 'cover' . DS . $old . '.jpg';
        $cover_new = FILE_PATH . 'cover' . DS . $new . '.jpg';
        rename($cover_old, $cover_new);
        //
        return true;
    }
    /**
     * CARGAR VIDEOS
     * 
     * @access public
     * @param none
     * @return array
     */
    // CAPITULOS
    public function getMovieVideos(){
        $id = $_GET['id'];
        $query = $this->query("SELECT v.*, c.c_titulo, i.i_titulo, s.s_titulo FROM cb_videos AS v LEFT JOIN cb_calidades AS c ON v.v_calidad = c.calidad_id LEFT JOIN cb_idiomas AS i ON v.v_idioma = i.idioma_id LEFT JOIN cb_servidores AS s ON v.v_servidor = s.servidor_id WHERE pelicula_id = {$id} ORDER BY video_id DESC");
        $data = $this->fetch_array($query);
        $this->free($query);
        //
        return $data;
    }
    /**
     * AGREGAR NUEVO VIDEO
     * 
     * @access public
     * @param none
     * @return void
     */
    public function newVideo(){
        $id = (int) $_GET['id'];
        // DATOS
        $vData = $this->getVideoData();
        if(!$vData) return false;
        // EXTRACT
        extract($vData);
        // SERVIDOR
        $server = $this->fetch_assoc($this->select("cb_servidores","*","servidor_id = {$v_servidor}", "", 1));
        $v_source = $this->getVideoID($v_source, $server);
        // VIDEO ID
        if(!$v_source) return false;
        if($this->insert("cb_videos", "pelicula_id, v_calidad, v_idioma, v_servidor, v_source, v_upload, v_online","{$pelicula_id}, {$v_calidad}, {$v_idioma}, {$v_servidor}, '{$v_source}', unix_timestamp(), {$v_online}")) {
            $this->message('El video fue agregado correctamente', "{$this->url}?action=list&do=videos&id={$id}", 'Regresar a lista de videos');
        }
    }
    /**
     * CARGAR INFORMACION DE UN VIDEO
     * 
     * @access public
     * @param none
     * @return void
     */
    public function getVideo($id = ''){
        $id = empty($id) ? $_GET['id'] : $id;
        //
        $query = $this->select("cb_videos","*","video_id = {$id}", null, 1);
        $data = $this->fetch_assoc($query);
        $this->free();
        return $data;
    }
    /**
     * ARMAR DATOS DE UN VIDEO
     * 
     * @access private
     * @param none
     * @return array
     */
    private function getVideoData(){
        //
        $vData = array(
            'pelicula_id' => empty($_GET['id']) ? null : $_GET['id'],
            'v_calidad' => empty($_POST['calidad']) ? null : $_POST['calidad'],
            'v_idioma' => empty($_POST['idioma']) ? null : $_POST['idioma'],
            'v_servidor' => empty($_POST['servidor']) ? null : $_POST['servidor'],
            'v_source' => ($_POST['servidor'] == 2) ? $_POST['embed'] : $_POST['source'],
            'v_upload' => $_POST['date'],
            'v_online' => empty($_POST['online']) ? 0 : 1,
            'v_reports' => empty($_POST['reports']) ? 0 : $_POST['reports']
        );
        //
        $vData['v_hack'] = empty($vData['v_source']) ? null : $vData['v_source']; // UN PEQUEÑO HACK PARA Q FUNCIONE XD
        // VERIFICAR VACIOS
        foreach($vData as $key => $val){
            if(!isset($val)) {
                $this->error = 'Todos los campos son requeridos.';
                return false;
            }
        }
        //
        return $vData;
    }
    /**
     * EDITAR VIDEO
     * 
     * @access public
     * @param none
     * @return void
     */
    public function editVideo(){
        $vid = (int) $_GET['v'];
        // DATOS
        $vData = $this->getVideoData();
        if(!$vData) return false;
        // EXTRACT
        extract($vData);
        // SERVIDOR
        $server = $this->fetch_assoc($this->select("cb_servidores","*","servidor_id = {$v_servidor}", "", 1));
        $v_source = $this->getVideoID($v_source, $server);
        // VIDEO ID
        if(!$v_source) return false;
        if($this->update("cb_videos", "v_calidad = {$v_calidad}, v_idioma = {$v_idioma}, v_servidor = {$v_servidor}, v_source = '{$v_source}', v_online = {$v_online}, v_reports = {$v_reports}", "video_id = {$vid}")) return 'Los datos del video fueron guardados correctamente.';
        else return $this->error();
    }
    /**
     * ELIMINAR UN VIDEO
     * 
     * @access public
     * @param none
     * @return void
     */
    public function delVideo(){
        $id = (int) $_GET['id'];
        // DATOS
        $video = $this->getVideo();
        // ELIMINAMOS
        if(empty($video)){
            $this->error = 'No se ha podido eliminar el video debido a que no existe en la base de datos.';
            return false;
        }
        elseif($this->delete("cb_videos","video_id = {$id}")) return 'El video fue eliminado correctamente. Ir al <a href="?action=list&do=videos&id=' . $video['pelicula_id'] .'">listado</a> de videos.';
    }
    /**
     * OBTENER ID DE UN VIDEO DESDE LA URL DEL MISMO
     * 
     * @access private
     * @param string, int
     * @return string
     */
    private function getVideoID($source, $server){
        switch($server['servidor_id']){
            # MEGAVIDEO #
            case 1: 
                // SOLO ES EL ID?
                if(strlen($source) == 8) return $source;
                else {
                    $video_id = explode('v=', $source);
                    $video_id = substr($video_id[1], 0 , 8);
                }
            break;
            # EMBED #
            case 2:
                $embed = htmlspecialchars_decode($source, ENT_QUOTES);
                $embed = str_replace("'",'"', $embed);
                $embed = preg_replace('/width="(\d+)"/i', 'width="100%"', $embed);
                $embed = preg_replace('/height="(\d+)"/i', 'height="100%"', $embed);
                $video_id = $embed;
            break;
            default:
                $this->error = 'El servidor elegido no existe.';
                return false;
            break;
        }
        //
        if(empty($video_id)) {
            $this->error = '<u>'.$source.'</u> no es un enlace v&aacute;lido de <u>'.$server['s_titulo'].'</u>.';
            return false;
        } else return $video_id;
    }
    /**
     * CARGAR ENLACES
     * 
     * @access public
     * @param none
     * @return array
     */
    // CAPITULOS
    public function getMovieLinks(){
        $id = (int) $_GET['id'];
        $query = $this->query("SELECT d.*, c.c_titulo, i.i_titulo, s.s_titulo FROM cb_descargas AS d LEFT JOIN cb_calidades AS c ON d.d_calidad = c.calidad_id LEFT JOIN cb_idiomas AS i ON d.d_idioma = i.idioma_id LEFT JOIN cb_servidores AS s ON d.d_servidor = s.servidor_id WHERE pelicula_id = {$id} ORDER BY descarga_id DESC");
        $data = $this->fetch_array($query);
        $this->free($query);
        //
        return $data;
    }
    /**
     * NUEVO ENLACE
     * 
     * @access public
     * @param none
     * @return array
     */
    public function newLink(){
        $id = (int) $_GET['id'];
        // DATOS
        $lData = $this->getLinkData();
        if(!$lData) return false;
        // EXTRACT
        extract($lData);
        // SERVIDOR
        $server = $this->fetch_assoc($this->select("cb_servidores","*","servidor_id = {$d_servidor}", "", 1));
        $d_source = $this->getLinkSource($d_source, $server);
        // LINK SOURCE
        if(!$d_source) return false;
        if($this->insert("cb_descargas", "pelicula_id, d_calidad, d_idioma, d_servidor, d_source, d_upload, d_online","{$pelicula_id}, {$d_calidad}, {$d_idioma}, {$d_servidor}, '{$d_source}', unix_timestamp(), {$d_online}")) {
            $this->message('El enlace fue agregado correctamente', "{$this->url}?action=list&do=links&id={$id}", 'Regresar a lista de enlaces');
        }   
    }
    /**
     * CARGAR INFORMACION DE UN ENLACE
     * 
     * @access public
     * @param none
     * @return void
     */
    public function getLink($id = ''){
        global $moviex;
        //
        $id = empty($id) ? $_GET['id'] : $id;
        //
        $query = $this->select("cb_descargas","*","descarga_id = {$id}", null, 1);
        $data = $this->fetch_assoc($query);
        $this->free();
        // EDIT
        $parts = explode("\n",$data['d_source']);
        foreach($parts as $part){
            $nSource .= $moviex->getLinkSource($part, $data['d_servidor'])."\n"; 
        }
        $data['d_source'] = substr($nSource, 0, -1);
        //
        return $data;
    }
    /**
     * EDITAR ENLACE
     * 
     * @access public
     * @param none
     * @return void
     */
    public function editLink(){
        $lid = (int) $_GET['l'];
        // DATOS
        $lData = $this->getLinkData();
        if(!$lData) return false;
        // EXTRACT
        extract($lData);
        // SERVIDOR
        $server = $this->fetch_assoc($this->select("cb_servidores","*","servidor_id = {$d_servidor}", "", 1));
        $d_source = $this->getLinkSource($d_source, $server);
        // VIDEO ID
        if(!$d_source) return false;
        if($this->update("cb_descargas", "d_calidad = {$d_calidad}, d_idioma = {$d_idioma}, d_servidor = {$d_servidor}, d_source = '{$d_source}', d_online = {$d_online}, d_reports = {$d_reports}", "descarga_id = {$lid}")) return 'Los datos del enlace fueron guardados correctamente.';
        else return $this->error();
    }
    /**
     * ELIMINAR UN ENLACE
     * 
     * @access public
     * @param none
     * @return void
     */
    public function delLink(){
        $id = (int) $_GET['id'];
        // DATOS
        $link = $this->getLink();
        // ELIMINAMOS
        if(empty($link['descarga_id'])){
            $this->error = 'No se ha podido eliminar el enlace debido a que no existe en la base de datos.';
            return false;
        }
        elseif($this->delete("cb_descargas","descarga_id = {$id}")) return 'El enlace fue eliminado correctamente. Ir al <a href="?action=list&do=links&id=' . $link['pelicula_id'] .'">listado</a> de enlaces.';
    }
    /**
     * ARMAR DATOS DE UN ENLACE
     * 
     * @access private
     * @param none
     * @return array
     */
    private function getLinkData(){
        //
        $lData = array(
            'pelicula_id' => empty($_GET['id']) ? null : $_GET['id'],
            'd_calidad' => empty($_POST['calidad']) ? null : $_POST['calidad'],
            'd_idioma' => empty($_POST['idioma']) ? null : $_POST['idioma'],
            'd_servidor' => empty($_POST['servidor']) ? null : $_POST['servidor'],
            'd_source' => empty($_POST['source']) ? null : $_POST['source'],
            'd_upload' => $_POST['date'],
            'd_online' => empty($_POST['online']) ? 0 : 1,
            'd_reports' => empty($_POST['reports']) ? 0 : $_POST['reports']
        );
        // VERIFICAR VACIOS
        foreach($lData as $key => $val){
            if(!isset($val)) {
                $this->error = 'Todos los campos son requeridos.';
                return false;
            }
        }
        //
        return $lData;
    }
    /**
     * VALIDAR EL ENLACE
     * 
     * @access private
     * @param string, int
     * @return string
     */
    private function getLinkSource($source, $server){
        // SERVERS
        $aData = array(
            3 => array('id' => 'megaupload.com', 'size' => 8, 'sep' => '?d='),
            4 => array('id' => 'mediafire.com', 'size' => 15, 'sep' => '?'),
            5 => array('id' => 'fileserve.com', 'size' => 7, 'sep' => 'file/')
        );
        // CUAL?
        $sData = $aData[$server['servidor_id']];
        // MULTIPARTES
        $parts = explode("\n",$source);
        foreach($parts as $key => $part){
            // PROCESAR.. COMPLICADO? NA FACIL JEJE
            $exists = strpos($part, $sData['id']);
            $count = strlen($part);
            // ELIMINAR CARACTERES RAROS
            $seo_id = $this->setSeo($part, '');
            // COMPROVACIONES
            if($exists !== false && $count != $sData['size']){
                $_id = explode($sData['sep'], $part);
                $_id = substr($_id[1], 0 , $sData['size']);
                // ELIMINAR CARACTERES RAROS
                $seo_id = $this->setSeo($_id, '');
                //
                if(strlen($seo_id) == $sData['size']) $link_id .= $_id."\n";
                else $eLinks .= '&bull; <a href="'.$part.'" target="_blank">' . $part . "</a><br/>";
                // 
            } 
            // SOLO EL ID
            elseif($count == $sData['size']) $link_id .= $part."\n";
            // NO ES SU SERVIDOR
            elseif($exists === false && !empty($seo_id)) $eLinks .= '&bull; <a href="'.$part.'" target="_blank">' . $part . "</a><br/>";
        }
        // MENOS 1
        $link_id = substr($link_id, 0, -1);
        if(!empty($eLinks)) {
            $this->error = 'Los siguientes enlaces no son v&aacute;lidos para <u>'.$server['s_titulo'].'</u>.<br/>'.$eLinks.'Los cambios no fueron guardados.';
            return false;
        } 
        else return $link_id;
    }
    /**
     * ++++++++++++++++++++++++++++++++++++++++++++++++++++++
     */
    /**
     * CARGAR PUBLICIDAD
     * 
     * @access public
     * @param none
     * @return array
     */
    public function getAds(){
        $query = $this->select("cb_publicidad","*","1");
        while($row = $this->fetch_assoc($query)){
            $data[$row['ad_key']] = htmlspecialchars_decode($row['ad_code'], ENT_QUOTES);
        }
        $this->free();
        //
        return $data;
    }
    /**
     * GUARDAR CAMBIOS EN PUBLICIDAD
     * 
     * @access public 
     * @param none
     * @return void
     */
    public function editAds(){
        // EXTRAEMOS
        $aData = array(
            'popup' => $_POST['popup'],
            'ad300' => $_POST['ad300'],
            'ad468' => $_POST['ad468'],
            'ad160' => $_POST['ad160'],
            'ad728' => $_POST['ad728']
        );
        // GUARDAMOS
        foreach($aData as $key => $val){
            if(!$this->update("cb_publicidad","ad_code = '{$val}'", "ad_key = '{$key}'")) {
                $this->error = $this->error();
                return false;
            }
        }
        //
        return 'Los datos fueron actualizados correctamente.';
    }
    /**
     * ++++++++++++++++++++++++++++++++++++++++++++++++++++++
     */
	/**
	 * SEO url
	 * 
	 * @access	public
	 * @param	string
	 * @return	string
	 */
	public function setSeo($string, $chsus = "-", $minus = true) {
		// ESPAÑOL
		$espanol = array('á','é','í','ó','ú','ñ');
		$ingles = array('a','e','i','o','u','n');
		$string = str_replace($espanol,$ingles,$string);
        // MINUSCULAS
        $string = ($minus == true) ? strtolower($string) : $string;
        // ALFANUMERIC
		$string = trim(preg_replace("/[^ A-Za-z0-9_]/i", $chsus, $string));
		$string = preg_replace("/[ \t\n\r]+/i", $chsus, $string);
		$string = str_replace(" ", $chsus, $string);
		$string = preg_replace("/[ -]+/i", $chsus, $string);
		//
		return $string;
	}
    /**
     * Current URL
     * 
     * @access public
     * @param none
     * @return string
     */
	public function currentUrl($status = ''){
		$current_url_domain = $_SERVER['HTTP_HOST'];
		$current_url_path = $_SERVER['REQUEST_URI'];
		$current_url_querystring = $_SERVER['QUERY_STRING'];
		$current_url = "http://".$current_url_domain.$current_url_path;
        // STATUS
        $current_url = preg_replace('/&s=(\w+)/i', "", $current_url);
        $current_url = $current_url.'&s='.$status;
        //
		return $current_url;
	}
    /**
     * MENSAJE
     * 
     * @access public
     * @param string
     * @return void
     */
    public function message($message = '', $mlink = '', $mlinktxt = '', $mtitle = ''){
        global $tpl;
        // DEFAULTS
        $mtitle = empty($mtitle) ? 'Informaci&oacute;n' : $mtitle;
        $message = empty($message) ? 'Ser&aacute; redireccionado en 3 segundos.' : $message;
        $mlink = empty($mlink) ? 'javascript:history.go(-1);' : $mlink;
        $mlinktxt = empty($mlinktxt) ? 'Clic si tu navegador no te redirecciona.' : $mlinktxt;
        //
        $tpl->assign("message", $message);
        $tpl->assign("mtitle", $mtitle);
        $tpl->assign("mlink", $mlink);
        $tpl->assign("mlinktxt", $mlinktxt);
        
        $tpl->display('message.tpl');
        
        exit;
    }
}