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

$con = ConectarBDpdoADM('bdptc');
$fecha_actual=hoy_hora();

if($_GET['estado'] == "SI"){
	QueryDBpdo("UPDATE programas SET publicar = :publicar ,fechaactualiza = :fechaactualiza WHERE id = :id",$con,[],['publicar' => 'NO' ,'fechaactualiza' => $fecha_actual ,'id' => $_GET['id']]);
}else{
	QueryDBpdo("UPDATE programas SET publicar = :publicar ,fechaactualiza = :fechaactualiza WHERE id = :id",$con,[],['publicar' => 'SI' ,'fechaactualiza' => $fecha_actual ,'id' => $_GET['id']]);
}

$con = '';

?>

<script>
	document.location.href='listado.php?mensaje= Registro ha cambiado de Estado !';
</script>
