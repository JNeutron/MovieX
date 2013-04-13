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
 * database.class.php
 * 
 * Manejar base de datos.
 * 
 */
class Database {
	var $dbhost;
	var $dbname;
	var $dbuser;
	var $dbpass;
	var $dbpersist;
	var $dblink;

	// ESTE ES EL CONSTRUCTOR
	// CONECTA Y SELECCIONA UNA BASE DE DATOS
	// INPUT: VOID
	// OUTPUT: $dblink
	function __construct(){
        global $_CONF;
		// DEFINICION DE VARIABLES
		$this->dbhost = $_CONF['db.host'];
		$this->dbname = $_CONF['db.name'];
		$this->dbuser = $_CONF['db.user'];
		$this->dbpass = $_CONF['db.pass'];
		// CONECTAR
		$this->dblink = $this->connect();
		return $this->dblink;
		
	}
	// METODO PARA CONECTAR A LA BASE DE DATOS
	// INPUT: void
	// OUTPUT: $db_link
	function connect() {
		// CONEXION
        $db_link = mysql_connect($this->dbhost, $this->dbuser, $this->dbpass);
		// SELECCIONAR BASE DE DATOS
		if ( !@mysql_select_db($this->dbname)) return false;
		// ASIGNAR CONDIFICACION
		@mysql_query("set names 'utf8'");
		@mysql_query("set character set utf8");
		// REGRESAR LA CONEXCION
		return $db_link;
	}
	// METODO PARA HACER UNA CONSULTA
	// INPUT: $query
	// OUTPUT: $result
	function query($q){
		// HACIENDO CONSULTA Y RETORNANDO
		return mysql_query($q);
	}
	// METODO PARA HACER UN SELECT
	// INPUT: 
	// 		$table | NOMBRE DE LA TABLA
	//		$fields | CAMPOS A SELECCIONAR DE LA TABLA
	//		$where | CONDICION DE LA CONSULTA
	//		$order | ORDEN DE LOS RESULTADOS
	//		$limit | LIMITE DE RESULTADOS
	// OUTPUT: $result
	function select($table, $fields, $where = NULL, $order = NULL, $limit = NULL){
		// CREANDO LA CONSULTA
		$q = 'SELECT '.$fields.' FROM '.$table;
		if($where) $q .= ' WHERE '.$where;
		if($order) $q .= ' ORDER BY '.$order;
		if($limit) $q .= ' LIMIT '.$limit;
		// HACIENDO CONSULTA Y RETORNANDO
		return mysql_query($q);
	}
	// METODO PARA HACER UN UPDATE
	// INPUT: 
	// 		$table | NOMBRE DE LA TABLA
	//		$pairs | CAMPOS Y VALORES A ACTUALIZAR
	//		$where | CONDICION DE LA CONSULTA
	// OUTPUT: status
	function update($table, $pairs, $where){
		// DESCOMPONER CAMPOS DE UN ARRAY
		if(is_array($pairs)) $fields = implode(", ", $pairs);
		else $fields = $pairs;
		// ARMANDO CONSULTA
		$q = 'UPDATE '.$table.' SET '.$fields.' WHERE '.$where;
		// REALIZANDO CONSULTA
		$result = mysql_query($q);
		// RETORNANDO ESTADO
		if($result) return true;
		else return false;
	}
	// METODO PARA HACER UN REPLACE
	// INPUT: 
	// 		$table | NOMBRE DE LA TABLA
	//		$fields | CAMPOS A REEMPLAZAR
	//		$values | VALORES A REEMPLAZAR
	// OUTPUT: status
	function replace($table, $fields, $values){
		// ARMANDO CONSULTA
		$q = "REPLACE INTO $table ($fields) VALUES ($values)";
		// REALIZANDO CONSULTA
		$result = mysql_query($q);
		// RETORNANDO ESTADO
		if($result) return true;
		else return false;
	}
	// METODO PARA HACER UN INSERT
	// INPUT: 
	// 		$table | NOMBRE DE LA TABLA
	//		$fields | CAMPOS
	//		$values | VALORES
	// OUTPUT: status
	function insert($table, $fields, $values){
		// ARMANDO CONSULTA
		$q = 'INSERT INTO '.$table.' ('.$fields.') VALUES ('.$values.')';
		// REALIZANDO CONSULTA
		$result = mysql_query($q);
		// RETORNANDO ESTADO
		if($result) return true;
		else return false;
	}
	// METODO PARA HACER UN DELETE
	// INPUT: 
	// 		$table | NOMBRE DE LA TABLA
	//		$where | CONDICION
	// OUTPUT: status
	function delete($table, $where){
		// ARMANDO CONSULTA
		$q = 'DELETE FROM '.$table.' WHERE '.$where;
		// REALIZANDO CONSULTA
		$result = mysql_query($q);
		// RETORNANDO ESTADO
		if($result) return true;
		else return false;
	}
	// METODO PARA HACER UNA CONSULTA Y OBTENER OBJETOS
	// INPUT: 
	// 		$table | NOMBRE DE LA TABLA
	//		$fields | CAMPOS A SELECCIONAR DE LA TABLA
	//		$where | CONDICION DE LA CONSULTA
	//		$order | ORDEN DE LOS RESULTADOS
	//		$limit | LIMITE DE RESULTADOS
	// OUTPUT: $result
	function data($table, $fields, $where =NULL, $order = NULL, $limit = NULL){
		// CREANDO LA CONSULTA
		$q = 'SELECT '.$fields.' FROM '.$table;
		if($where) $q .= ' WHERE '.$where;
		if($order) $q .= ' ORDER BY '.$order;
		if($limit) $q .= ' LIMIT '.$limit;
		// HACIENDO CONSULTA
		$result = mysql_query($q);
		// CREANDO Y RETORNANDO OBJETOS
		if($result) return mysql_fetch_object($result);
		else return false;
	}
	// METODO PARA CREAR OBJETOS DESDE UNA CONSULTA
	// INPUT: $result
	// OUTPUT: $objs
	function fetch_objects($result){
		if(!is_resource($result)) return false;
		while($obj = mysql_fetch_object($result)) $objs[] = $obj;
		return $objs;
	}
	// METODO PARA CREAR ARRAY DESDE UNA CONSULTA
	// INPUT: $result
	// OUTPUT: array
	function fetch_assoc($result){
		if(!is_resource($result)) return false;
		return mysql_fetch_assoc($result);
	}
	// METODO PARA CREAR ARRAY DESDE UNA CONSULTA
	// INPUT: $result
	// OUTPUT: array
	function fetch_array($result){
		if(!is_resource($result)) return false;
		while($row = mysql_fetch_assoc($result)) $array[] = $row;
		return $array;
	}
	// METODO PARA OBTENER EL VALOR DE UNA ROW
	// INPUT: $result
	// OUTPUT: array
	function fetch_row($result){
		return mysql_fetch_row($result);
	}
	// METODO PARA CONTAR EL NUMERO DE RESULTADOS
	// INPUT: $result
	// OUTPUT: num_rows	
	function num_rows($result){
		if(!is_resource($result)) return false;
		return mysql_num_rows($result);
	}
	// METODO PARA LIBERAR MEMORIA
	// INPUT: $result
	// OUTPUT: void	
	function free($result){
		return mysql_free_result($result);
	}
	// METODO PARA RETORNAR EL ULTIMO ID DE UN INSERT
	// INPUT: void
	// OUTPUT: status
	function insert_id(){
	  return mysql_insert_id($this->dblink);
	}
	// METODO PARA RETORNAR LOS ERRORES
	// INPUT: void
	// OUTPUT: status
	function error(){
	  return mysql_error($this->dblink);
	}
}