<?php
####################################
### SEGURIDAD
####################################
include '../../lib/lib.php';
require ("../../lib/aut_verifica.inc.php");

/*
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
*/

$nivel_acceso=2;

if ($nivel_acceso < $_SESSION['usuario_nivel']){

	header ("Location: $redir?&error_login=5");
	exit;
}

if(isset($_GET['id'])){
	$id = $_GET['id'];
}
####################################

$con = ConectarBDpdoADM('bdptc');
$link = Conectarse("bdptc");

//Por seguridad antes de borrar un registro comprobamos que el usuario sea due�o del registro
//o que sea super usuario (nivel acceso = 1)

//recuperamos el ID del usuario de la sesion
$id_usr=$_SESSION['usuario_id'];

//recuperamos el ID del usuario del registro
$id_usr_reg=traeRegistroDB("programas","id","$id","id_usr",$link);


if(($id_usr==$id_usr_reg)||($_SESSION['usuario_nivel']==1)||($_SESSION['usuario_nivel']==2))
{
	QueryDBpdo("DELETE FROM programas WHERE id = :id",$con,[],['id' => $id]);
}

DesconectaDB($link);
$con = '';

if($estado){
	print<<<END
	<script>

		document.location.href='listado.php?mensaje= Registro borrado !';

	</script>
END;

}else{
	print<<<END
	<script>

		document.location.href='listado.php?mensaje= Registro borrado !';

	</script>
END;
}
?>
