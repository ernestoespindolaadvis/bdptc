<?php
####################################
### SEGURIDAD
####################################
include '../../lib/lib.php';
require ("../../lib/aut_verifica.inc.php");

$nivel_acceso=1;

if ($nivel_acceso < $_SESSION['usuario_nivel']){

	header ("Location: $redir?error_login=5");
	exit;
}


####################################

$con = ConectarBDpdoADM('bdptc');

QueryDBpdo("DELETE FROM usr WHERE id_usr = :id",$con,null,['id' => $_GET['id']]);

$con = ''

?>
<script>

	document.location.href='listado.php?mensaje= Registro borrado !';

</script>
