<?php
####################################
### SEGURIDAD
####################################
/*
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
*/
include '../../lib/lib.php';
require ("../../lib/aut_verifica.inc.php");

$nivel_acceso=2;

if ($nivel_acceso < $_SESSION['usuario_nivel']){

	header ("Location: $redir?&error_login=5");
	exit;
}


####################################

$con = ConectarBDpdoADM('bdptc');
$link = Conectarse("bdptc");
foreach ( $_GET as $k => $v) {
	${$k} = $v;
}

//Por seguridad antes de borrar un registro comprobamos que el usuario sea due�o del registro
//o que sea super usuario (nivel acceso = 1)

//recuperamos el ID del usuario de la sesion
$id_usr=$_SESSION['usuario_id'];

//recuperamos el ID del usuario del registro
$id_usr_reg=traeRegistroDB("programas","id","$id_programa","id_usr",$link);


if(($id_usr==$id_usr_reg)||($_SESSION['usuario_nivel']==1)||($_SESSION['usuario_nivel']==2))
{
	QueryDBpdo("DELETE FROM referencias where id = :id",$con,[],["id" => $id]);
}

DesconectaDB($link);
$con = '';

if($estado){
	print<<<END
	<script>

		document.location.href='listado.php?id_programa=$id_programa&mensaje= Registro borrado !';

	</script>
END;

}else{
	print<<<END
	<script>

		document.location.href='listado.php?id_programa=$id_programa&mensaje= Registro borrado !';

	</script>
END;
}
?>
