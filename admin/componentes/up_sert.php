<?php

// seguridad
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
foreach ( $_POST as $k => $v) {
	${$k} = $v;
}
####################################

//recuperamos el ID del usuario de la sesion
$id_usr=$_SESSION['usuario_id'];


// connect mysql
$con = ConectarBDpdoADM('bdptc');
$link = Conectarse("bdptc");

// flag action
$update = 0;

if($id != "") { 
	$update = 1; 
} else {
	// nuevo registro. traemos id
	$id = siguienteID("id","componentes",$link);
}

$fecha_ingreso=hoy_hora();
$fecha_act=hoy_hora();

// Insertamos o Actualizamos los datos segun corresponda.


//PARA SOLUCIONAR PROBLEMA DE INGRESO DE APOSTROFES Y CREMILLAS
$search_txt  = array('\'', '"');
$replace_txt = array('&#39;', '&#34;');


$nombre_compes=str_replace($search_txt, $replace_txt, $nombre_compes);
$nombre_compen=str_replace($search_txt, $replace_txt, $nombre_compen);
$destinatarios_compes=str_replace($search_txt, $replace_txt, $destinatarios_compes);
$destinatarios_compen=str_replace($search_txt, $replace_txt, $destinatarios_compen);
$modalidad_compes=str_replace($search_txt, $replace_txt, $modalidad_compes);
$modalidad_compen=str_replace($search_txt, $replace_txt, $modalidad_compen);

$formaentrega_compes=str_replace($search_txt, $replace_txt, $formaentrega_compes);
$formaentrega_compen=str_replace($search_txt, $replace_txt, $formaentrega_compen);
$periodoentrega_compes=str_replace($search_txt, $replace_txt, $periodoentrega_compes);
$periodoentrega_compen=str_replace($search_txt, $replace_txt, $periodoentrega_compen);

$receptor_compes=str_replace($search_txt, $replace_txt, $receptor_compes);
$receptor_compen=str_replace($search_txt, $replace_txt, $receptor_compen);

$limitefamilia_compes=str_replace($search_txt, $replace_txt, $limitefamilia_compes);
$limitefamilia_compen=str_replace($search_txt, $replace_txt, $limitefamilia_compen);
$corresponsabilidad_compes=str_replace($search_txt, $replace_txt, $corresponsabilidad_compes);
$corresponsabilidad_compen=str_replace($search_txt, $replace_txt, $corresponsabilidad_compen);
$sanciones_compes=str_replace($search_txt, $replace_txt, $sanciones_compes);
$sanciones_compen=str_replace($search_txt, $replace_txt, $sanciones_compen);

$comentarios_compes=str_replace($search_txt, $replace_txt, $comentarios_compes);
$comentarios_compen=str_replace($search_txt, $replace_txt, $comentarios_compen);
$descripcion_compes=str_replace($search_txt, $replace_txt, $descripcion_compes);
$descripcion_compen=str_replace($search_txt, $replace_txt, $descripcion_compen);

$montos_compes=str_replace($search_txt, $replace_txt, $montos_compes);
$montos_compen=str_replace($search_txt, $replace_txt, $montos_compen);
$tipo_transfes=str_replace($search_txt, $replace_txt, $tipo_transfes);
$tipo_transfen=str_replace($search_txt, $replace_txt, $tipo_transfen);







if(!$update)
{

	//Si es superusuario el estado "publicar" de un nuevo registro  es siempre SI
	//Si es usuario comun(nivel 2) el estado "publicar" de un nuevo registro  es siempre NO

	if($_SESSION['usuario_nivel']==1){
		$publicar = "SI";
	}
	if($_SESSION['usuario_nivel']==2){
		$publicar = "SI";
	}	
	if($_SESSION['usuario_nivel']==3){
		$publicar = "NO";
	}


	$query = "
	insert into componentes
	(
		id,
		id_programa,
		nombreES,
		nombreEN,
		destinatariosES,
		destinatariosEN,
		modalidadES,
		modalidadEN,
		formaentregaES,
		formaentregaEN,
		periodoentregaES,
		periodoentregaEN,
		receptorES,
		receptorEN,
		limitefamiliaES,
		limitefamiliaEN,
		corresponsabilidadES,
		corresponsabilidadEN,
		sancionesES,
		sancionesEN,
		comentariosES,
		comentariosEN,
		descripcionES,
		descripcionEN,
		montosES,
		montosEN,
		tipotransferES,
		tipotransferEN,
		fechaingreso,
		fechaactualiza,
		publicar
	)
	values
	(
	:id,
	:id_programa,
	:nombre_compes,
	:nombre_compen,
	:destinatarios_compes,
	:destinatarios_compen,
	:modalidad_compes,	
	:modalidad_compen,	
	:formaentrega_compes,
	:formaentrega_compen,
  	:periodoentrega_compes,
  	:periodoentrega_compen,
	:receptor_compes,
	:receptor_compen,
	:limitefamilia_compes,
	:limitefamilia_compen,
	:corresponsabilidad_compes,
	:corresponsabilidad_compen,
	:sanciones_compes,
	:sanciones_compen,
	:comentarios_compes,
	:comentarios_compen,
	:descripcion_compes,
	:descripcion_compen,
	:montos_compes,
	:montos_compen,
	:tipo_transfes,
	:tipo_transfen,
	:fecha_ingreso,
	:fecha_act,	
	:publicar
	)";
	$where_insert['id'] = $id == null ? '' : $id;
	$where_insert['id_programa'] = $id_programa == null ? '' : $id_programa;
	$where_insert['nombre_compes'] = $nombre_compes == null ? '' : $nombre_compes;
	$where_insert['nombre_compen'] = $nombre_compen == null ? '' : $nombre_compen;
	$where_insert['destinatarios_compes'] = $destinatarios_compes == null ? '' : $destinatarios_compes;
	$where_insert['destinatarios_compen'] = $destinatarios_compen == null ? '' : $destinatarios_compen;
	$where_insert['modalidad_compes'] = $modalidad_compes == null ? '' : $modalidad_compes;	
	$where_insert['modalidad_compen'] = $modalidad_compen == null ? '' : $modalidad_compen;	
	$where_insert['formaentrega_compes'] = $formaentrega_compes == null ? '' : $formaentrega_compes;
	$where_insert['formaentrega_compen'] = $formaentrega_compen == null ? '' : $formaentrega_compen;
	$where_insert['periodoentrega_compes'] = $periodoentrega_compes == null ? '' : $periodoentrega_compes;
	$where_insert['periodoentrega_compen'] = $periodoentrega_compen == null ? '' : $periodoentrega_compen;
	$where_insert['receptor_compes'] = $receptor_compes == null ? '' : $receptor_compes;
	$where_insert['receptor_compen'] = $receptor_compen == null ? '' : $receptor_compen;
	$where_insert['limitefamilia_compes'] = $limitefamilia_compes == null ? '' : $limitefamilia_compes;
	$where_insert['limitefamilia_compen'] = $limitefamilia_compen == null ? '' : $limitefamilia_compen;
	$where_insert['corresponsabilidad_compes'] = $corresponsabilidad_compes == null ? '' : $corresponsabilidad_compes;
	$where_insert['corresponsabilidad_compen'] = $corresponsabilidad_compen == null ? '' : $corresponsabilidad_compen;
	$where_insert['sanciones_compes'] = $sanciones_compes == null ? '' : $sanciones_compes;
	$where_insert['sanciones_compen'] = $sanciones_compen == null ? '' : $sanciones_compen;
	$where_insert['comentarios_compes'] = $comentarios_compes == null ? '' : $comentarios_compes;
	$where_insert['comentarios_compen'] = $comentarios_compen == null ? '' : $comentarios_compen;
	$where_insert['descripcion_compes'] = $descripcion_compes == null ? '' : $descripcion_compes;
	$where_insert['descripcion_compen'] = $descripcion_compen == null ? '' : $descripcion_compen;
	$where_insert['montos_compes'] = $montos_compes == null ? '' : $montos_compes;
	$where_insert['montos_compen'] = $montos_compen == null ? '' : $montos_compen;
	$where_insert['tipo_transfes'] = $tipo_transfes == null ? '' : $tipo_transfes;
	$where_insert['tipo_transfen'] = $tipo_transfen == null ? '' : $tipo_transfen;
	$where_insert['fecha_ingreso'] = $fecha_ingreso == null ? '' : $fecha_ingreso;
	$where_insert['fecha_act'] = $fecha_act == null ? '' : $fecha_act;	
	$where_insert['publicar'] = $publicar == null ? '' : $publicar;
	
	$msg = " Registro Ingresado ! " ;

	QueryDBpdo($query,$con,[],$where_insert);
	
	//Funcion mensaje Correo para avisar de movimiento de registros en RISALC
	//mail("marco.ortega@cepal.org,risalc@cepal.org","Nuevo programa en RISALC","Se ingreso/Actualizo En tabla Programas ID=".$id." | Nombre: " .$nombre_prog. "<br> Pais: ".$id_pais);

}else{

	$query = "
	update componentes
	set
	nombreES = :nombre_compes,
	nombreEN = :nombre_compen,
	destinatariosES = :destinatarios_compes,
	destinatariosEN = :destinatarios_compen,
	modalidadES = :modalidad_compes,
	modalidadEN = :modalidad_compen,
	formaentregaES = :formaentrega_compes, 
	formaentregaEN = :formaentrega_compen, 
	periodoentregaES = :periodoentrega_compes,
	periodoentregaEN = :periodoentrega_compen,
	receptorES = :receptor_compes,
	receptorEN = :receptor_compen,
	limitefamiliaES = :limitefamilia_compes,
	limitefamiliaEN = :limitefamilia_compen,
	corresponsabilidadES = :corresponsabilidad_compes,
	corresponsabilidadEN = :corresponsabilidad_compen,
	sancionesES = :sanciones_compes,
	sancionesEN = :sanciones_compen,
	comentariosES = :comentarios_compes,
	comentariosEN = :comentarios_compen,
	descripcionES = :descripcion_compes,
	descripcionEN = :descripcion_compen,
	montosES = :montos_compes,
	montosEN = :montos_compen,
	tipotransferES = :tipo_transfes,
	tipotransferEN = :tipo_transfen,
	fechaactualiza = :fecha_act
	where
	id = :id
	and 
	id_programa = :id_programa	
	";
	$where_update['nombre_compes'] = $nombre_compes == null ? '' : $nombre_compes;
	$where_update['nombre_compen'] = $nombre_compen == null ? '' : $nombre_compen;
	$where_update['destinatarios_compes'] = $destinatarios_compes == null ? '' : $destinatarios_compes;
	$where_update['destinatarios_compen'] = $destinatarios_compen == null ? '' : $destinatarios_compen;
	$where_update['modalidad_compes'] = $modalidad_compes == null ? '' : $modalidad_compes;
	$where_update['modalidad_compen'] = $modalidad_compen == null ? '' : $modalidad_compen;
	$where_update['formaentrega_compes'] = $formaentrega_compes == null ? '' : $formaentrega_compes; 
	$where_update['formaentrega_compen'] = $formaentrega_compen == null ? '' : $formaentrega_compen; 
	$where_update['periodoentrega_compes'] = $periodoentrega_compes == null ? '' : $periodoentrega_compes;
	$where_update['periodoentrega_compen'] = $periodoentrega_compen == null ? '' : $periodoentrega_compen;
	$where_update['receptor_compes'] = $receptor_compes == null ? '' : $receptor_compes;
	$where_update['receptor_compen'] = $receptor_compen == null ? '' : $receptor_compen;
	$where_update['limitefamilia_compes'] = $limitefamilia_compes == null ? '' : $limitefamilia_compes;
	$where_update['limitefamilia_compen'] = $limitefamilia_compen == null ? '' : $limitefamilia_compen;
	$where_update['corresponsabilidad_compes'] = $corresponsabilidad_compes == null ? '' : $corresponsabilidad_compes;
	$where_update['corresponsabilidad_compen'] = $corresponsabilidad_compen == null ? '' : $corresponsabilidad_compen;
	$where_update['sanciones_compes'] = $sanciones_compes == null ? '' : $sanciones_compes;
	$where_update['sanciones_compen'] = $sanciones_compen == null ? '' : $sanciones_compen;
	$where_update['comentarios_compes'] = $comentarios_compes == null ? '' : $comentarios_compes;
	$where_update['comentarios_compen'] = $comentarios_compen == null ? '' : $comentarios_compen;
	$where_update['descripcion_compes'] = $descripcion_compes == null ? '' : $descripcion_compes;
	$where_update['descripcion_compen'] = $descripcion_compen == null ? '' : $descripcion_compen;
	$where_update['montos_compes'] = $montos_compes == null ? '' : $montos_compes;
	$where_update['montos_compen'] = $montos_compen == null ? '' : $montos_compen;
	$where_update['tipo_transfes'] = $tipo_transfes == null ? '' : $tipo_transfes;
	$where_update['tipo_transfen'] = $tipo_transfen == null ? '' : $tipo_transfen;
	$where_update['fecha_act'] = $fecha_act == null ? '' : $fecha_act;
	$where_update['id'] = $id == null ? '' : $id;
	$where_update['id_programa'] = $id_programa == null ? '' : $id_programa;

	$msg = " Registro Actualizado ! " ;
	
	QueryDBpdo($query,$con,[],$where_update);

}


	
	//printDB($query);

	DesconectaDB($link);
	$con = '';

?>

<script>
	document.location.href='listado.php?id_programa=<?php echo $id_programa; ?>&mensaje=<?php echo $msg; ?>';
</script>

