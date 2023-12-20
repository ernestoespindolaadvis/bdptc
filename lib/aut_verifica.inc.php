<?php
// Motor autentificaci�n usuarios.

// Cargar datos conexion y otras variables.
require ("aut_config.inc.php");

// chequear p�gina que lo llama para devolver errores a dicha p�gina.
##$url = explode("?",$_SERVER['HTTP_REFERER']);
##$pag_referida=$url[0];
##$redir=$pag_referida;


#print "REDIR $redir<br>";
$pag=$_SERVER['PHP_SELF'];

// $redir="/dds/bdptc/admin/acceso.php?src=$pag"; // src local
$redir="/bdptc/admin/acceso.php?src=$pag"; // src publico

// chequear si se llama directo al script.

##if ($_SERVER['HTTP_REFERER'] == ""){
##	die ("Error cod.:1 - Acceso incorrecto!");
##	exit;
##}


// Chequeamos si se esta autentificandose un usuario por medio del formulario
if (isset($_POST['usr']) && isset($_POST['pass'])) {

	// sanitizamos
	$qusr=htmlspecialchars($_POST['usr']);
	$qpas=htmlspecialchars($_POST['usr']);

	// Conexion base de datos.
	// si no se puede conectar a la BD salimos del script con error 0 y redireccionamos a la pagina de error.
	$link = Conectarse("bdptc");
	
	// realizamos la consulta a la BD para chequear datos del Usuario.
	//$usuario_consulta = $link->query("SELECT id_usr,nombre_login,pass,nivel_acceso FROM usr WHERE nombre_login='".$_POST['usr']."'") or die(header ("Location:  $redir?&error_login=1"));
	$usuario_consulta = $link->query("SELECT id_usr,nombre_login,pass,nivel_acceso FROM usr WHERE nombre_login='".$qusr."'") or die(header ("Location:  $redir?&error_login=1"));
	
 	// miramos el total de resultado de la consulta (si es distinto de 0 es que existe el usuario)

 	if (mysqli_num_rows($usuario_consulta) != 0) {

    		// eliminamos barras invertidas y dobles en sencillas
    		//$login = stripslashes($_POST['usr']);
 			$login = stripslashes($qusr);

//print "LOGIN $login<br>";

    		// encriptamos el password en formato md5 irreversible.
    		//$password = md5($_POST['pass']);
    		//$password = $_POST['pass'];
    		$password = $qpas;

//print "PASS $password<br>";

    		// almacenamos datos del Usuario en un array para empezar a chequear.
 		$usuario_datos = mysqli_fetch_array($usuario_consulta);
  
    		// liberamos la memoria usada por la consulta, ya que tenemos estos datos en el Array.
    		mysqli_free_result($usuario_consulta);
    		// cerramos la Base de dtos.
    		//mysqli_close($db_conexion);
			mysqli_close($link);
			
    
    		// chequeamos el nombre del usuario otra vez contrastandolo con la BD
    		// esta vez sin barras invertidas, etc ...
    		// si no es correcto, salimos del script con error 4 y redireccionamos a la
    		// p�gina de error.

    		if ($login != $usuario_datos['nombre_login']) {
       			Header ("Location: $redir?&error_login=4");
			exit;}


    		// si el password no es correcto ..
		// salimos del script con error 3 y redireccinamos hacia la p�gina de error


//print "CLAVE $usuario_datos['pass']<br>";

    		if ($password != $usuario_datos['pass']) {
        		Header ("Location: $redir?&error_login=3");
	    		exit;}

    		// Paranoia: destruimos las variables login y password usadas
    		unset($login);
    		unset($password);

    		// En este punto, el usuario ya esta validado.
    		// Grabamos los datos del usuario en una sesion.
    
     		// le damos un mobre a la sesion.
    		session_name($usuarios_sesion);
     		// incia sessiones
    		session_start();

    		// Paranoia: decimos al navegador que no "cachee" esta p�gina.
    		session_cache_limiter('nocache,private');
    
    		// Asignamos variables de sesi�n con datos del Usuario para el uso en el
    		// resto de p�ginas autentificadas.

    		// definimos usuarios_id como IDentificador del usuario en nuestra BD de usuarios
    		$_SESSION['usuario_id']=$usuario_datos['id_usr'];
    
    		// definimos usuario_nivel con el Nivel de acceso del usuario de nuestra BD de usuarios
    		$_SESSION['usuario_nivel']=$usuario_datos['nivel_acceso'];
    
    		//definimos usuario_nivel con el Nivel de acceso del usuario de nuestra BD de usuarios
    		$_SESSION['usuario_login']=$usuario_datos['nombre_login'];

    		//definimos usuario_password con el password del usuario de la sesi�n actual (formato md5 encriptado)
    		$_SESSION['usuario_password']=$usuario_datos['pass'];

    		//definimos usuario_id_institucion con el id_institucion del usuario de la sesi�n actual
    		$_SESSION['usuario_id_institucion']=$usuario_datos['id_institucion'];

//print "333<br>";
//print "SES $_SESSION['usuario_password']"

    		// Hacemos una llamada a si mismo (scritp) para que queden disponibles
    		// las variables de session en el array asociado $HTTP_...
    		$pag=$_SERVER['PHP_SELF'];
    		Header ("Location: $pag?");
    		exit;
    
	} else {

      	// si no esta el nombre de usuario en la BD o el password ..
      	// se devuelve a pagina q lo llamo con error
      	Header ("Location: $redir?&error_login=2");
      	exit;}

} else {

	
	// -------- Chequear sesi�n existe -------

	// usamos la sesion de nombre definido.
	// Iniciamos el uso de sesiones
	session_start();
	// Chequeamos si estan creadas las variables de sesi�n de identificaci�n del usuario,
	// El caso mas comun es el de una vez "matado" la sesion se intenta volver hacia atras
	// con el navegador.

	if (!isset($_SESSION['usuario_login']) && !isset($_SESSION['usuario_password'])){

		// Borramos la sesion creada por el inicio de session anterior
		session_destroy();
		//die ("Error cod.: 2 - Acceso incorrecto!");

    	$pag=$_SERVER['PHP_SELF'];
		//$redir="/dds/bdptc/admin/acceso.php?src=$pag"; // src local
		$redir="/bdptc/admin/acceso.php?src=$pag"; // src publico
		Header ("Location: $redir");

		exit;
	}
}
?>
