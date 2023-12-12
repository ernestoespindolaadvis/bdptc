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
	$id = siguienteID("id","referencias",$link);
}

$fecha_ingreso=hoy_hora();
$fecha_act=hoy_hora();

// Insertamos o Actualizamos loa datos segun corresponda




//PARA SOLUCIONAR PROBLEMA DE INGRESO DE APOSTROFES Y CREMILLAS
$search_txt  = array('\'', '"');
$replace_txt = array('&#39;', '&#34;');

$fecha_refes=str_replace($search_txt, $replace_txt, $fecha_refes);
$fecha_refen=str_replace($search_txt, $replace_txt, $fecha_refen);
$autor_refes=str_replace($search_txt, $replace_txt, $autor_refes);
$autor_refen=str_replace($search_txt, $replace_txt, $autor_refen);
$titulo_refes=str_replace($search_txt, $replace_txt, $titulo_refes);
$titulo_refen=str_replace($search_txt, $replace_txt, $titulo_refen);
$datopub_refes=str_replace($search_txt, $replace_txt, $datopub_refes);
$datopub_refen=str_replace($search_txt, $replace_txt, $datopub_refen);
$tema_refes=str_replace($search_txt, $replace_txt, $tema_refes);
$tema_refen=str_replace($search_txt, $replace_txt, $tema_refen);





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
	insert into referencias
	(
		id,
		id_programa,
		fechaES,
		fechaEN,
		autorES,
		autorEN,
		tituloES,
		tituloEN,
		datopubES,
		datopubEN,
		link,
		temaES,
		temaEN,
		fechaingreso,
		fechaactualiza,
		publicar
	)
	values
	(
	:id,
	:id_programa,
	:fecha_refes,
	:fecha_refen,
	:autor_refes,	
	:autor_refen,	
	:titulo_refes,	
	:titulo_refen,
	:datopub_refes,
	:datopub_refen,
	:link_ref,	
	:tema_refes,	
	:tema_refen,	
	:fecha_ingreso,
	:fecha_act,	
	:publicar
	)";
	$where_insert['id'] = $id == null ? '' : $id;
	$where_insert['id_programa'] = $id_programa == null ? '' : $id_programa;
	$where_insert['fecha_refes'] = $fecha_refes == null ? '' : $fecha_refes;
	$where_insert['fecha_refen'] = $fecha_refen == null ? '' : $fecha_refen;
	$where_insert['autor_refes'] = $autor_refes == null ? '' : $autor_refes;
	$where_insert['autor_refen'] = $autor_refen == null ? '' : $autor_refen;
	$where_insert['titulo_refes'] = $titulo_refes == null ? '' : $titulo_refes;
	$where_insert['titulo_refen'] = $titulo_refen == null ? '' : $titulo_refen;
	$where_insert['datopub_refes'] = $datopub_refes == null ? '' : $datopub_refes;
	$where_insert['datopub_refen'] = $datopub_refen == null ? '' : $datopub_refen;
	$where_insert['link_ref'] = $link_ref == null ? '' : $link_ref;
	$where_insert['tema_refes'] = $tema_refes == null ? '' : $tema_refes;
	$where_insert['tema_refen'] = $tema_refen == null ? '' : $tema_refen;
	$where_insert['fecha_ingreso'] = $fecha_ingreso == null ? '' : $fecha_ingreso;
	$where_insert['fecha_act'] = $fecha_act == null ? '' : $fecha_act;
	$where_insert['publicar'] = $publicar == null ? '' : $publicar;

	$msg = " Registro Ingresado ! " ;
	
	//Funcion mensaje Correo para avisar de movimiento de registros en RISALC
	//mail("marco.ortega@cepal.org,risalc@cepal.org","Nuevo programa en RISALC","Se ingreso/Actualizo En tabla Programas ID=".$id." | Nombre: " .$nombre_prog. "<br> Pais: ".$id_pais);

	QueryDBpdo($query,$con,[],$where_insert);

}else{
	if($fecha_refes){
		$query = "
		update referencias
		set
		fechaES = :fecha_refes,
	
		autorES = :autor_refes,
	
		tituloES = :titulo_refes,
	
		datopubES = :datopub_refes, 
	
		link = :link_ref,
		temaES = :tema_refes,
	
		fechaactualiza = :fecha_act
		where
		id = :id
		and 
		id_programa = :id_programa	
		";
		$where_update['fecha_refes'] = $fecha_refes == null ? '' : $fecha_refes;
		$where_update['autor_refes'] = $autor_refes == null ? '' : $autor_refes;
		$where_update['titulo_refes'] = $titulo_refes == null ? '' : $titulo_refes;
		$where_update['datopub_refes'] = $datopub_refes == null ? '' : $datopub_refes; 
		$where_update['link_ref'] = $link_ref == null ? '' : $link_ref;
		$where_update['tema_refes'] = $tema_refes == null ? '' : $tema_refes;
		$where_update['fecha_act'] = $fecha_act == null ? '' : $fecha_act;
		$where_update['id'] = $id == null ? '' : $id;
		$where_update['id_programa'] = $id_programa == null ? '' : $id_programa;
	}else{
		$query = "
		update referencias
		set
	
		fechaEN = :fecha_refen,
	
		autorEN = :autor_refen,
	
		tituloEN = :titulo_refen,
	
		datopubEN = :datopub_refen, 
	
	
		temaEN = :tema_refen,
		fechaactualiza = :fecha_act
		where
		id = :id
		and 
		id_programa = :id_programa	
		";
		$where_update['fecha_refen'] = $fecha_refen == null ? '' : $fecha_refen;
		$where_update['autor_refen'] = $autor_refen == null ? '' : $autor_refen;
		$where_update['titulo_refen'] = $titulo_refen == null ? '' : $titulo_refen;
		$where_update['datopub_refen'] = $datopub_refen == null ? '' : $datopub_refen; 
		$where_update['tema_refen'] = $tema_refen == null ? '' : $tema_refen;
		$where_update['fecha_act'] = $fecha_act == null ? '' : $fecha_act;
		$where_update['id'] = $id == null ? '' : $id;
		$where_update['id_programa'] = $id_programa == null ? '' : $id_programa;
	}



	
	$msg = " Registro Actualizado ! " ;

//echo"$query";

QueryDBpdo($query,$con,[],$where_update);

	
}




DesconectaDB($link);
$con = '';



?>

<script>
	document.location.href='listado.php?id_programa=<?php echo $id_programa; ?>&mensaje=<?php echo $msg; ?>';
</script>

