<?php 
// VARIABLES
include 'params.php';

#  PDO   #############################################################
if (!function_exists('ConectarBDpdo'))   {

	function ConectarBDpdo($BASE){
		$conexion = parameter($BASE);

		$host = $conexion["SERVER_DB"];
		$db   = $conexion["NAME_DB"];
		$user = $conexion["USER_BD"];
		$pass = $conexion["PASS_DB"];
		$charset = 'utf8';
		$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
		$options = [
			PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
			PDO::ATTR_EMULATE_PREPARES   => false,
		];
		$email = 1;
		try {
			$pdo = new PDO($dsn, $user, $pass, $options);
			return $pdo;
		} catch (\PDOException $e) {
			throw new \PDOException($e->getMessage(), (int)$e->getCode());
		}
	
	}
}
if (!function_exists('ConectarBDpdoADM'))   {
	function ConectarBDpdoADM($BASE,$HACER = null){
		$conexion = parameterAdmin($BASE,$HACER);


		$host = $conexion["SERVER_DB"];
		$db   = $conexion["NAME_DB"];
		$user = $conexion["USER_BD"];
		$pass = $conexion["PASS_DB"];
		$charset = 'utf8mb4';
		$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

		$options = [
			PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
			PDO::ATTR_EMULATE_PREPARES   => false,
		];
		$email = 1;
		try {
			$pdo = new PDO($dsn, $user, $pass, $options);
			return $pdo;
		} catch (\PDOException $e) {
			//var_dump($e->getMessage());
			throw new \PDOException($e->getMessage(), (int)$e->getCode());
		}
	
	}
}
if (!function_exists('QueryDBpdo'))   {
	function QueryDBpdo($sql = null,$link = null,$where_fields = '',$paramValue = '',$orden = null, $prueba = null){
		try { 
			if(Count($where_fields)>1 && !empty($where_fields)){
				$sql= $sql .(count($paramValue)>0 ? ' AND '.implode(' AND ',$where_fields).' '. $orden : ' '. $orden);
			}elseif(Count($where_fields) <= 1 && !empty($where_fields)){
				$sql= $sql . implode(' ',$where_fields) . $orden;
			}
			if($prueba == 2){
				var_dump(Count($where_fields));
				var_dump($paramValue);
				//var_dump($where_fields);
				//var_dump($paramValue);
				$prueba = $link->prepare($sql);
				$prueba->execute($paramValue);
				// var_dump($link->prepare($sql));
				var_dump($prueba->errorInfo());
				die();
			}
			$stmt = $link->prepare($sql);
			//var_dump($stmt);
			//die();
			//var_dump($paramValue);
			// die();
			$paramValue <> null ? $stmt->execute($paramValue) : $stmt->execute();
			return $stmt;

		} catch(Exception $e) {
			throw $e;
		}
	}
}

#  MYSQLI   #############################################################
if (!function_exists('Conectarse'))   {
	function Conectarse($BASE) 
	{ 
	$CadenaConexion = parameter($BASE);
	$host = $CadenaConexion["SERVER_DB"];
	$db   = $CadenaConexion["NAME_DB"];
	$user = $CadenaConexion["USER_BD"];
	$pass = $CadenaConexion["PASS_DB"];
	$mysqli =  new mysqli ($host,$user,$pass,$db);
		if ($mysqli->connect_errno) 
	{ 
		echo "Error conectando a la base de datos."; 
		exit(); 
	} 
	$mysqli->set_charset("utf8");
	return $mysqli; 
	}
}
# PROBLEMAS CON MYSQLI_RESULT ##############################################

if (!function_exists('mysqli_result')) {
	function mysqli_result($res, $row, $field=0) {
	  $res->data_seek($row);
	  $datarow = $res->fetch_array();
	  return $datarow[$field];
	}
}
if (!function_exists('QueryDB'))   {
	function QueryDB($input,$mysqli){
		$ret=$mysqli->query($input);
		return $ret;
	}
}
if (!function_exists('traeRegistroDB'))   {
	function traeRegistroDB($tabla,$key,$id,$campo,$link) {
		$cond=$key."="."'".$id."'";

		if($id != ""){
			$query = "select $campo from $tabla where $cond";
			#printDB($query);
			$res = QueryDB($query,$link);
			$row = TraeArrayDB($res);
		} else {
			print "ERROR: ID no ingresado.";
			return false;	
		}

		return $row[0];
	}
}
if (!function_exists('TraeDB'))   {
	function TraeDB($input){
		$ret=mysqli_fetch_row($input);
		return $ret;
	}
}
if (!function_exists('TraeArrayDB'))   {
	function TraeArrayDB($input){
		$ret=mysqli_fetch_array($input);
		return $ret;
	}
}
if (!function_exists('DesconectaDB'))   {
	function DesconectaDB($mysqli){
		mysqli_close($mysqli);
	}
}
if (!function_exists('siguienteID'))   {
	function siguienteID($id,$tabla,$link = null){
		#suponemos que ya esta conectado
		#vemos cuantas filas hay, si no existen filas (count=0) el max(id) es NULL y no sirve sumarle 1
		$query="select count($id) from $tabla";
		#printDB($query);
		$p=QueryDB($query,$link);
		$cuanto = false;
		while($col=TraeDB($p)){
			$cuanto=$col[0];
		}
		#si cuanto es distinto de cero entonces buscamos el mayor y le sumamos 1
		if($cuanto!=0){
			$query="select max($id)+1 from $tabla";
			$p=QueryDB($query,$link);
			while($col=TraeDB($p)){
			$idn=$col[0];
			}
		} else {#si no, significa que no hay filas ingresadas asi que comenzamos del numero 1
			$idn=1;
		}
		return $idn;
	}
}
if (!function_exists('escapa'))   {
	function escapa($que) {

		#if(!$tipo){$tipo = $TIPO_DB;}

		$ret = $que;
		#if($tipo eq "mysql")
		#{

			$ret = addslashes($ret);
		#}
		return $ret;
	}
}
if (!function_exists('mysqli_field_name'))   {
	function mysqli_field_name($result, $field_offset)
	{
		$properties = mysqli_fetch_field_direct($result, $field_offset);
		return is_object($properties) ? $properties->name : null;
	}
}
if (!function_exists('borraRegistroDB'))   {
	function borraRegistroDB($tabla,$key,$id,$link = null) {
		$cond=$key."=".$id;

		if($id != ""){
			$query = "delete from $tabla where $cond";
			//printDB($query);	
			$res = QueryDB($query,$link);
		} else {
			//print "ERROR: ID no ingresado.";
			return false;	
		}

		return true;
	}
}