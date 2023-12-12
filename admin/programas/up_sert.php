<?php

/*
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
*/

// seguridad
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
$recursos = variableEntorno("bdptc");

// flag action
$update = 0;

if($id != "") { 
	$update = 1; 
} else {
	// nuevo registro. taremos id
	$id = siguienteID("id","programas",$link);
}

// ** block archivo

#########################################################
#########        #############        ###################


### Subimos el archivo 
$nombre_arch = isset($_FILES['archivo_electronico']['name']) ? $_FILES['archivo_electronico']['name'] : '';
$archivo     = isset($_FILES['archivo_electronico']['tmp']) ? $_FILES['archivo_electronico']['tmp'] : '';

if( isset($_FILES['archivo_electronico']['tmp_name']) ) $archivo = $_FILES['archivo_electronico']['tmp_name'];

$archivo_old = $archivo_electronico_old;
$directorio  = $recursos['PATH_ARCHIVOS_RECURSOS'].'/'.$id;
$borr_archivo = $borr_archivo_electronico;

if(($archivo_old)&&($update)){
	$caso=1;
} else{
	$caso=0;
}

##print "A=$archivo NA=$nombre_arch D=$directorio C=$caso AO=$archivo_old<BR>\n";

if($archivo) {



	$mimes = array('application/vnd.ms-excel','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','text/csv','application/vnd.msexcel','text/csv');
	if(in_array($_FILES['archivo_electronico']['type'],$mimes)){

	$archivo = subirArchivo($archivo,$nombre_arch,$directorio,$caso,$archivo_old,"");

	} else {
	//no es excel
	}


} else {
	$nombre_arch = $archivo_old;
}


#### Borramos el archivo

#print "BORR_ARCH = $borr_archivo<br>\n";

if($borr_archivo){

	#print "BORRA PATH=$directorio ARCH=$archivo_old<br>\n";
	borra_archivo($directorio,$archivo_old);
	$archivo="";
	$nombre_arch = null;
}

$fecha_ingreso=hoy_hora();
$fecha_act=hoy_hora();

// Insertamos o Actualizamos loa datos segun corresponda





//PARA SOLUCIONAR PROBLEMA DE INGRESO DE APOSTROFES Y CREMILLAS
$search_txt  = array('\'', '"');
$replace_txt = array('&#39;', '&#34;');

$nombre_proges=str_replace($search_txt, $replace_txt, $nombre_proges);
$nombre_progen=str_replace($search_txt, $replace_txt, $nombre_progen);
$sigla_proges=str_replace($search_txt, $replace_txt, $sigla_proges);


$sigla_progen=str_replace($search_txt, $replace_txt, $sigla_progen);


$periodo_proges=str_replace($search_txt, $replace_txt, $periodo_proges);
$periodo_progen=str_replace($search_txt, $replace_txt, $periodo_progen);
$web_prog=str_replace($search_txt, $replace_txt, $web_prog);
$ambitoaccion_proges=str_replace($search_txt, $replace_txt, $ambitoaccion_proges);
$ambitoaccion_progen=str_replace($search_txt, $replace_txt, $ambitoaccion_progen);

$descripcion_proges=str_replace($search_txt, $replace_txt, $descripcion_proges);
$descripcion_progen=str_replace($search_txt, $replace_txt, $descripcion_progen);

$pobmeta_proges=str_replace($search_txt, $replace_txt, $pobmeta_proges);
$pobmeta_progen=str_replace($search_txt, $replace_txt, $pobmeta_progen);

$escalageo_proges=str_replace($search_txt, $replace_txt, $escalageo_proges);
$escalageo_progen=str_replace($search_txt, $replace_txt, $escalageo_progen);

$metodofocal_proges=str_replace($search_txt, $replace_txt, $metodofocal_proges);
$metodofocal_progen=str_replace($search_txt, $replace_txt, $metodofocal_progen);

$instrumentoselec_proges=str_replace($search_txt, $replace_txt, $instrumentoselec_proges);
$instrumentoselec_progen=str_replace($search_txt, $replace_txt, $instrumentoselec_progen);

$beneficiarios_proges=str_replace($search_txt, $replace_txt, $beneficiarios_proges);
$beneficiarios_progen=str_replace($search_txt, $replace_txt, $beneficiarios_progen);

$criteriosegreso_proges=str_replace($search_txt, $replace_txt, $criteriosegreso_proges);
$criteriosegreso_progen=str_replace($search_txt, $replace_txt, $criteriosegreso_progen);

$comentarios_proges=str_replace($search_txt, $replace_txt, $comentarios_proges);
$comentarios_progen=str_replace($search_txt, $replace_txt, $comentarios_progen);

$sanciones_proges=str_replace($search_txt, $replace_txt, $sanciones_proges);
$sanciones_progen=str_replace($search_txt, $replace_txt, $sanciones_progen);

$orcobertura_proges=str_replace($search_txt, $replace_txt, $orcobertura_proges);
$orcobertura_progen=str_replace($search_txt, $replace_txt, $orcobertura_progen);

$marcolegal_proges=str_replace($search_txt, $replace_txt, $marcolegal_proges);
$marcolegal_progen=str_replace($search_txt, $replace_txt, $marcolegal_progen);

$orgresponsable_proges=str_replace($search_txt, $replace_txt, $orgresponsable_proges);
$orgresponsable_progen=str_replace($search_txt, $replace_txt, $orgresponsable_progen);

$orgejecutor_proges=str_replace($search_txt, $replace_txt, $orgejecutor_proges);
$orgejecutor_progen=str_replace($search_txt, $replace_txt, $orgejecutor_progen);

$orgrespbenef_proges=str_replace($search_txt, $replace_txt, $orgrespbenef_proges);
$orgrespbenef_progen=str_replace($search_txt, $replace_txt, $orgrespbenef_progen);

$fuentefinan_proges=str_replace($search_txt, $replace_txt, $fuentefinan_proges);
$fuentefinan_progen=str_replace($search_txt, $replace_txt, $fuentefinan_progen);





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
	insert into programas
	(
		id,
		id_usr,
		nombreES,
		nombreEN,
		siglaES,
		siglaEN,
		pais,
		tipo,
		archivo_electronico,
		periodoES,
		periodoEN,
		web,
		ambitoaccionES,
		ambitoaccionEN,
		descripcionES,
		descripcionEN,
		pobmetaES,
		pobmetaEN,
		escalageoES,
		escalageoEN,
		metodofocalES,
		metodofocalEN,
		instrumentoselecES,
		instrumentoselecEN,
		beneficiariosES,
		beneficiariosEN,
		criteriosegresoES,
		criteriosegresoEN,
		comentariosES,
		comentariosEN,
		sancionesES,
		sancionesEN,
		orientacoberES,
		orientacoberEN,
		marcolegalES,
		marcolegalEN,
		orgresponsableES,
		orgresponsableEN,
		orgejecutorES,
		orgejecutorEN,

		orgrespbenefES,
		orgrespbenefEN,

		fuentefinanES,
		fuentefinanEN,
		fechaingreso,
		fechaactualiza,
		publicar
	)
	values
	(
	:id,
	:id_usr,
	:nombre_proges,
	:nombre_progen,
	:sigla_proges,
	:sigla_progen,
	:id_pais,	
	:id_tipo,
  	:archivo,
	:periodo_proges,
	:periodo_progen,
	:web_prog,
	:ambitoaccion_proges,
	:ambitoaccion_progen,	
	:descripcion_proges,
	:descripcion_progen,
	:pobmeta_proges,
	:pobmeta_progen,
	:escalageo_proges,
	:escalageo_progen,
	:metodofocal_proges,
	:metodofocal_progen,
	:instrumentoselec_proges,
	:instrumentoselec_progen,
	:beneficiarios_proges,
	:beneficiarios_progen,
	:criteriosegreso_proges,
	:criteriosegreso_progen,
	:comentarios_proges,
	:comentarios_progen,
	:sanciones_proges,
	:sanciones_progen,
	:orcobertura_proges,
	:orcobertura_progen,
	:marcolegal_proges,
	:marcolegal_progen,
	:orgresponsable_proges,
	:orgresponsable_progen,
	:orgejecutor_proges,
	:orgejecutor_progen,

	:orgrespbenef_proges,
	:orgrespbenef_progen,

	:fuentefinan_proges,
	:fuentefinan_progen,
	:fecha_ingreso,
	:fecha_act,	
	:publicar
	)";
	$where_insert['id'] = $id == null ? '' : $id;
	$where_insert['id_usr'] = $id_usr == null ? '' : $id_usr;
	$where_insert['nombre_proges'] = $nombre_proges == null ? '' : $nombre_proges;
	$where_insert['nombre_progen'] = $nombre_progen == null ? '' : $nombre_progen;
	$where_insert['sigla_proges'] = $sigla_proges == null ? '' : $sigla_proges;
	$where_insert['sigla_progen'] = $sigla_progen == null ? '' : $sigla_progen;
	$where_insert['id_pais'] = $id_pais == null ? '' : $id_pais;	
	$where_insert['id_tipo'] = $id_tipo == null ? '' : $id_tipo;
	$where_insert['archivo'] = $nombre_arch == null ? '' : $nombre_arch;
	$where_insert['periodo_proges'] = $periodo_proges == null ? '' : $periodo_proges;
	$where_insert['periodo_progen'] = $periodo_progen == null ? '' : $periodo_progen;
	$where_insert['web_prog'] = $web_prog == null ? '' : $web_prog;
	$where_insert['ambitoaccion_proges'] = $ambitoaccion_proges == null ? '' : $ambitoaccion_proges;
	$where_insert['ambitoaccion_progen'] = $ambitoaccion_progen == null ? '' : $ambitoaccion_progen;	
	$where_insert['descripcion_proges'] = $descripcion_proges == null ? '' : $descripcion_proges;
	$where_insert['descripcion_progen'] = $descripcion_progen == null ? '' : $descripcion_progen;
	$where_insert['pobmeta_proges'] = $pobmeta_proges == null ? '' : $pobmeta_proges;
	$where_insert['pobmeta_progen'] = $pobmeta_progen == null ? '' : $pobmeta_progen;
	$where_insert['escalageo_proges'] = $escalageo_proges == null ? '' : $escalageo_proges;
	$where_insert['escalageo_progen'] = $escalageo_progen == null ? '' : $escalageo_progen;
	$where_insert['metodofocal_proges'] = $metodofocal_proges == null ? '' : $metodofocal_proges;
	$where_insert['metodofocal_progen'] = $metodofocal_progen == null ? '' : $metodofocal_progen;
	$where_insert['instrumentoselec_proges'] = $instrumentoselec_proges == null ? '' : $instrumentoselec_proges;
	$where_insert['instrumentoselec_progen'] = $instrumentoselec_progen == null ? '' : $instrumentoselec_progen;
	$where_insert['beneficiarios_proges'] = $beneficiarios_proges == null ? '' : $beneficiarios_proges;
	$where_insert['beneficiarios_progen'] = $beneficiarios_progen == null ? '' : $beneficiarios_progen;
	$where_insert['criteriosegreso_proges'] = $criteriosegreso_proges == null ? '' : $criteriosegreso_proges;
	$where_insert['criteriosegreso_progen'] = $criteriosegreso_progen == null ? '' : $criteriosegreso_progen;
	$where_insert['comentarios_proges'] = $comentarios_proges == null ? '' : $comentarios_proges;
	$where_insert['comentarios_progen'] = $comentarios_progen == null ? '' : $comentarios_progen;
	$where_insert['sanciones_proges'] = $sanciones_proges == null ? '' : $sanciones_proges;
	$where_insert['sanciones_progen'] = $sanciones_progen == null ? '' : $sanciones_progen;
	$where_insert['orcobertura_proges'] = $orcobertura_proges == null ? '' : $orcobertura_proges;
	$where_insert['orcobertura_progen'] = $orcobertura_progen == null ? '' : $orcobertura_progen;
	$where_insert['marcolegal_proges'] = $marcolegal_proges == null ? '' : $marcolegal_proges;
	$where_insert['marcolegal_progen'] = $marcolegal_progen == null ? '' : $marcolegal_progen;
	$where_insert['orgresponsable_proges'] = $orgresponsable_proges == null ? '' : $orgresponsable_proges;
	$where_insert['orgresponsable_progen'] = $orgresponsable_progen == null ? '' : $orgresponsable_progen;
	$where_insert['orgejecutor_proges'] = $orgejecutor_proges == null ? '' : $orgejecutor_proges;
	$where_insert['orgejecutor_progen'] = $orgejecutor_progen == null ? '' : $orgejecutor_progen;

	$where_insert['orgrespbenef_proges'] = $orgrespbenef_proges == null ? '' : $orgrespbenef_proges;
	$where_insert['orgrespbenef_progen'] = $orgrespbenef_progen == null ? '' : $orgrespbenef_progen;

	$where_insert['fuentefinan_proges'] = $fuentefinan_proges == null ? '' : $fuentefinan_proges;
	$where_insert['fuentefinan_progen'] = $fuentefinan_progen == null ? '' : $fuentefinan_progen;
	$where_insert['fecha_ingreso'] = $fecha_ingreso == null ? '' : $fecha_ingreso;
	$where_insert['fecha_act'] = $fecha_act == null ? '' : $fecha_act;	
	$where_insert['publicar'] = $publicar == null ? '' : $publicar;
	$msg = " Registro Ingresado ! " ;
	
	QueryDBpdo($query,$con,[],$where_insert);	
	
	//Funcion mensaje Correo para avisar de movimiento de registros en RISALC
	//mail("marco.ortega@cepal.org,risalc@cepal.org","Nuevo programa en RISALC","Se ingreso/Actualizo En tabla Programas ID=".$id." | Nombre: " .$nombre_prog. "<br> Pais: ".$id_pais);

}else{

	$query = "
	update programas
	set
	nombreES = :nombre_proges,
	nombreEN = :nombre_progen,
	siglaES = :sigla_proges,
	siglaEN = :sigla_progen,
	pais = :id_pais,
	tipo = :id_tipo, 
	archivo_electronico= :archivo,
	periodoES = :periodo_proges,
	periodoEN = :periodo_progen,
	web = :web_prog,
	ambitoaccionES = :ambitoaccion_proges,
	ambitoaccionEN = :ambitoaccion_progen,
	descripcionES = :descripcion_proges,
	descripcionEN = :descripcion_progen,
	pobmetaES = :pobmeta_proges,
	pobmetaEN = :pobmeta_progen,
	escalageoES = :escalageo_proges,
	escalageoEN = :escalageo_progen,
	metodofocalES = :metodofocal_proges,
	metodofocalEN = :metodofocal_progen,
	instrumentoselecES = :instrumentoselec_proges,
	instrumentoselecEN = :instrumentoselec_progen,
	beneficiariosES = :beneficiarios_proges,
	beneficiariosEN = :beneficiarios_progen,
	criteriosegresoES = :criteriosegreso_proges,
	criteriosegresoEN = :criteriosegreso_progen,
	comentariosES = :comentarios_proges,
	comentariosEN = :comentarios_progen,
	sancionesES = :sanciones_proges,
	sancionesEN = :sanciones_progen,
	orientacoberES = :orcobertura_proges,
	orientacoberEN = :orcobertura_progen,
	marcolegalES = :marcolegal_proges,
	marcolegalEN = :marcolegal_progen,
	orgresponsableES = :orgresponsable_proges,
	orgresponsableEN = :orgresponsable_progen,
	orgejecutorES = :orgejecutor_proges,
	orgejecutorEN = :orgejecutor_progen,
	orgrespbenefES = :orgrespbenef_proges,
	orgrespbenefEN = :orgrespbenef_progen,
	fuentefinanES = :fuentefinan_proges,
	fuentefinanEN = :fuentefinan_progen,
	fechaactualiza= :fecha_act
	where
	id = :id
	";
	$where_update['nombre_proges'] = $nombre_proges == null ? '' : $nombre_proges;
	$where_update['nombre_progen'] = $nombre_progen == null ? '' : $nombre_progen;
	$where_update['sigla_proges'] = $sigla_proges == null ? '' : $sigla_proges;
	$where_update['sigla_progen'] = $sigla_progen == null ? '' : $sigla_progen;
	$where_update['id_pais'] = $id_pais == null ? '' : $id_pais;
	$where_update['id_tipo'] = $id_tipo == null ? '' : $id_tipo; 
	$where_update['archivo'] = $nombre_arch == null ? '' : $nombre_arch;
	$where_update['periodo_proges'] = $periodo_proges == null ? '' : $periodo_proges;
	$where_update['periodo_progen'] = $periodo_progen == null ? '' : $periodo_progen;
	$where_update['web_prog'] = $web_prog == null ? '' : $web_prog;
	$where_update['ambitoaccion_proges'] = $ambitoaccion_proges == null ? '' : $ambitoaccion_proges;
	$where_update['ambitoaccion_progen'] = $ambitoaccion_progen == null ? '' : $ambitoaccion_progen;
	$where_update['descripcion_proges'] = $descripcion_proges == null ? '' : $descripcion_proges;
	$where_update['descripcion_progen'] = $descripcion_progen == null ? '' : $descripcion_progen;
	$where_update['pobmeta_proges'] = $pobmeta_proges == null ? '' : $pobmeta_proges;
	$where_update['pobmeta_progen'] = $pobmeta_progen == null ? '' : $pobmeta_progen;
	$where_update['escalageo_proges'] = $escalageo_proges == null ? '' : $escalageo_proges;
	$where_update['escalageo_progen'] = $escalageo_progen == null ? '' : $escalageo_progen;
	$where_update['metodofocal_proges'] = $metodofocal_proges == null ? '' : $metodofocal_proges;
	$where_update['metodofocal_progen'] = $metodofocal_progen == null ? '' : $metodofocal_progen;
	$where_update['instrumentoselec_proges'] = $instrumentoselec_proges == null ? '' : $instrumentoselec_proges;
	$where_update['instrumentoselec_progen'] = $instrumentoselec_progen == null ? '' : $instrumentoselec_progen;
	$where_update['beneficiarios_proges'] = $beneficiarios_proges == null ? '' : $beneficiarios_proges;
	$where_update['beneficiarios_progen'] = $beneficiarios_progen == null ? '' : $beneficiarios_progen;
	$where_update['criteriosegreso_proges'] = $criteriosegreso_proges == null ? '' : $criteriosegreso_proges;
	$where_update['criteriosegreso_progen'] = $criteriosegreso_progen == null ? '' : $criteriosegreso_progen;
	$where_update['comentarios_proges'] = $comentarios_proges == null ? '' : $comentarios_proges;
	$where_update['comentarios_progen'] = $comentarios_progen == null ? '' : $comentarios_progen;
	$where_update['sanciones_proges'] = $sanciones_proges == null ? '' : $sanciones_proges;
	$where_update['sanciones_progen'] = $sanciones_progen == null ? '' : $sanciones_progen;
	$where_update['orcobertura_proges'] = $orcobertura_proges == null ? '' : $orcobertura_proges;
	$where_update['orcobertura_progen'] = $orcobertura_progen == null ? '' : $orcobertura_progen;
	$where_update['marcolegal_proges'] = $marcolegal_proges == null ? '' : $marcolegal_proges;
	$where_update['marcolegal_progen'] = $marcolegal_progen == null ? '' : $marcolegal_progen;
	$where_update['orgresponsable_proges'] = $orgresponsable_proges == null ? '' : $orgresponsable_proges;
	$where_update['orgresponsable_progen'] = $orgresponsable_progen == null ? '' : $orgresponsable_progen;
	$where_update['orgejecutor_proges'] = $orgejecutor_proges == null ? '' : $orgejecutor_proges;
	$where_update['orgejecutor_progen'] = $orgejecutor_progen == null ? '' : $orgejecutor_progen;
	$where_update['orgrespbenef_proges'] = $orgrespbenef_proges == null ? '' : $orgrespbenef_proges;
	$where_update['orgrespbenef_progen'] = $orgrespbenef_progen == null ? '' : $orgrespbenef_progen;
	$where_update['fuentefinan_proges'] = $fuentefinan_proges == null ? '' : $fuentefinan_proges;
	$where_update['fuentefinan_progen'] = $fuentefinan_progen == null ? '' : $fuentefinan_progen;
	$where_update['fecha_act'] = $fecha_act == null ? '' : $fecha_act;
	$where_update['id'] = $id == null ? '' : $id;
	$msg = " Registro Actualizado ! " ;

	QueryDBpdo($query,$con,[],$where_update);	
}



//printDB($query);

DesconectaDB($link);
$con = '';

?>

<script>
	document.location.href='listado.php?mensaje=<?php echo $msg; ?>';
</script>

