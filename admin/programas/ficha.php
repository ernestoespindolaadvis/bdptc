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
	
	header ("Location: $redir?error_login=5");
	exit;
}

$variablesUploads = variableEntorno("bdptc");

if(isset($_GET['id'])){
	$id=$_GET['id'];
}
####################################

$link = Conectarse("bdptc");

//Por seguridad antes de mostrar un registro comprobamos que el usuario se due�o del registro
//o que sea super usuario (nivel acceso = 1)

//recuperamos el ID del usuario de la sesion
$id_usr=$_SESSION['usuario_id'];

if($id){

	//recuperamos el ID del usuario del registro
	$id_usr_reg=traeRegistroDB("programas","id","$id","id_usr",$link);

	$fecha_ingreso = traeRegistroDB("programas","id",$id,"fechaingreso",$link);
	$fecha_act = traeRegistroDB("programas","id",$id,"fechaactualiza",$link);
	if($fecha_act == "0000-00-00 00:00:00"){$fecha_act="-";}
	if($fecha_act == ""){$fecha_act=$fecha_ingreso;}
	
	$id_pais = traeRegistroDB("programas","id",$id,"pais",$link);
	$id_tipo = traeRegistroDB("programas","id",$id,"tipo",$link);

	//$fecha_cambio_estado = traeRegistroDB("programas","id",$id,"fecha_cambio_estado");
	//if($fecha_cambio_estado == "0000-00-00 00:00:00"){$fecha_cambio_estado="-";}
	
	// Menu relaciones programa
	$rel_prog = "<ul class=\"basictab\"><li class=\"selected\"><a href=\"#\">General</a></li><li><a href=\"../componentes/listado.php?id_programa=$id\">Componentes</a></li><li><a href=\"../referencias/listado.php?id_programa=$id\">Referencias</a></li></ul>"; 

}

	// select db pais
	$select_pais = formComboDB("id_pais","paises","id","paisES","$id_pais","","formulario",$link);

	// select db tipo prog
	$select_tipo = formComboDB("id_tipo","tipoprogramas","idTipoProgramas","TipoProgramaES","$id_tipo","","formulario",$link);	
	
if(($id_usr==$id_usr_reg)||($_SESSION['usuario_nivel']==1)||($_SESSION['usuario_nivel']==2)||(!$id)){

######################## 
#### SALIDA HTML
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Sistema de Administraci&oacute;n de Contenidos</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<?php print javascript_ventana_tesauro(); ?>
<?php //print javascript_ventana_relacionador(); ?>
<?php print javascript_ventana_relacionador_GS(); ?>

<script>
function validar(){

	document.forms[0].submit();

}
</script>
<link href="../css/estilo.css" rel="stylesheet" type="text/css">
<link href="../css/BordesCorners.css" rel="stylesheet" type="text/css">
<style type="text/css">
div#rss{
	/*width: 250px;*/
	padding: 20px;
	margin:0 auto; 
   background:#EFEFEF;
	color:#000;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
}	 
div#box{
	width: 200px;
	padding: 20px;
	margin:0 auto; /* Se alinea automaticaente */
   background:#E8EEF4;
	color:#666;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 18px;
	font-weight:bold

}	 


</style>
<script type="text/javascript" src="../js/Bordes.js"></script>
<script type="text/javascript">
window.onload=function(){
Nifty("div#box","big");
Nifty("div#rss","big");
Nifty("div#menu a","small transparent top");
}
</script>
<link href="../../css/menu-tab.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="header">
<h1>Sistema de Administraci&oacute;n de Contenidos</h1>
<div id="menu">
<ul id="nav">
  <li id="home" class="activelink"><a href="../portada.php">Portada</a></li>
</ul> 
 
</div>
</div>
<div id="pagebody">
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="12%"><div align="center"><span class="Estilo8">Ficha</span></div></td>
    <td width="88%" valign="top" class="Estilo6"><?php echo $rel_prog; ?></td>
  </tr>
</table>

  <table width="100%"  border="0" cellspacing="0" cellpadding="5">
    <tr valign="top">
      <td width="10%"><p align="center" class="Estilo8"><a href="listado.php"><img src="../img/Proyectos.gif" width="104" height="103" border="0"></a></p></td>
      <td width="90%" colspan="5">
		<div style="margin-left:0px">
		<form method="post" action="up_sert.php" ENCTYPE="multipart/form-data">
		<?php print formHidden("id","$id","");  ?>
        <table cellpadding="3">
<?php

	enTabla2("<strong>Tipo Programa</strong>", $select_tipo);	

	enTabla2("Nombre", formTextoDB("nombre_proges","programas","id","$id","nombreES","","","","$ver","formulario",$link));
	enTabla2("<span class='eng'>NombreEN</span>", formTextoDB("nombre_progen","programas","id","$id","nombreEN","","","","$ver","formulario",$link));
	
	enTabla2("Sigla", formTextoDB("sigla_proges","programas","id","$id","siglaES","","","","$ver","formulario",$link));
	enTabla2("<span class='eng'>SiglaEN</span>", formTextoDB("sigla_progen","programas","id","$id","siglaEN","","","","$ver","formulario",$link));
	
	// selec pais
	enTabla2("Pais", $select_pais);
	
	// file 
	// Original
	enTabla2("Archivo", formArchivoDB("programas","archivo_electronico","id",$id,"","archivo_electronico",$variablesUploads['PATH_ARCHIVOS_RECURSOS']."/".$id,"1","","formulario",$link));
	// Fin Original	
	
	enTabla2("Periodo", formTextoDB("periodo_proges","programas","id","$id","periodoES","","","","$ver","formulario",$link));		
	enTabla2("<span class='eng'>PeriodoEN</span>", formTextoDB("periodo_progen","programas","id","$id","periodoEN","","","","$ver","formulario",$link));		
	
	enTabla2("Web", formTextoDB("web_prog","programas","id","$id","web","","","","$ver","formulario",$link));


	enTabla2("Ambito de acción", formTextareaDB("ambitoaccion_proges","programas","id","$id","ambitoaccionES","","","","$ver","formulario",$link));
	enTabla2("<span class='eng'>Area of intervention</span>", formTextareaDB("ambitoaccion_progen","programas","id","$id","ambitoaccionEN","","","","$ver","formulario",$link));
	
	enTabla2("Descripcion", formTextareaDB("descripcion_proges","programas","id","$id","descripcionES","","","","$ver","formulario",$link));
	enTabla2("<span class='eng'>DescripcionEN</span>", formTextareaDB("descripcion_progen","programas","id","$id","descripcionEN","","","","$ver","formulario",$link));
	
	
	enTabla2("Poblacion meta", formTextareaDB("pobmeta_proges","programas","id","$id","pobmetaES","","","","$ver","formulario",$link));
	enTabla2("<span class='eng'>Poblacion metaEN</span>", formTextareaDB("pobmeta_progen","programas","id","$id","pobmetaEN","","","","$ver","formulario",$link));
	
	enTabla2("Escala geografica", formTextareaDB("escalageo_proges","programas","id","$id","escalageoES","","","","$ver","formulario",$link));
	enTabla2("<span class='eng'>Escala geograficaEN</span>", formTextareaDB("escalageo_progen","programas","id","$id","escalageoEN","","","","$ver","formulario",$link));
	
	enTabla2("Metodo focalizacion", formTextareaDB("metodofocal_proges","programas","id","$id","metodofocalES","","","","$ver","formulario",$link));
	enTabla2("<span class='eng'>Metodo focalizacionEN</span>", formTextareaDB("metodofocal_progen","programas","id","$id","metodofocalEN","","","","$ver","formulario",$link));
	
	enTabla2("Instrumento de seleccion", formTextareaDB("instrumentoselec_proges","programas","id","$id","instrumentoselecES","","","","$ver","formulario",$link));
	enTabla2("<span class='eng'>Instrumento de seleccionEN</span>", formTextareaDB("instrumentoselec_progen","programas","id","$id","instrumentoselecEN","","","","$ver","formulario",$link));
	
	enTabla2("Registro de Destinatarios", formTextareaDB("beneficiarios_proges","programas","id","$id","beneficiariosES","","","","$ver","formulario",$link));
	enTabla2("<span class='eng'>Registry of recipients</span>", formTextareaDB("beneficiarios_progen","programas","id","$id","beneficiariosEN","","","","$ver","formulario",$link));
	
	enTabla2("Criterios egreso", formTextareaDB("criteriosegreso_proges","programas","id","$id","criteriosegresoES","","","","$ver","formulario",$link));
	enTabla2("<span class='eng'>Criterios egresoEN</span>", formTextareaDB("criteriosegreso_progen","programas","id","$id","criteriosegresoEN","","","","$ver","formulario",$link));
		
	enTabla2("Comentarios", formTextareaDB("comentarios_proges","programas","id","$id","comentariosES","","","","$ver","formulario",$link));
	enTabla2("<span class='eng'>ComentariosEN</span>", formTextareaDB("comentarios_progen","programas","id","$id","comentariosEN","","","","$ver","formulario",$link));
	
	enTabla2("Sanciones", formTextareaDB("sanciones_proges","programas","id","$id","sancionesES","","","","$ver","formulario",$link));
	enTabla2("<span class='eng'>SancionesEN</span>", formTextareaDB("sanciones_progen","programas","id","$id","sancionesEN","","","","$ver","formulario",$link));
	
	enTabla2("Orientación cobertura", formTextareaDB("orcobertura_proges","programas","id","$id","orientacoberES","","","","$ver","formulario",$link));
	enTabla2("<span class='eng'>Orientation coverageEN</span>", formTextareaDB("orcobertura_progen","programas","id","$id","orientacoberEN","","","","$ver","formulario",$link));

	enTabla2("Marco legal", formTextareaDB("marcolegal_proges","programas","id","$id","marcolegalES","","","","$ver","formulario",$link));
	enTabla2("<span class='eng'>Marco legalEN</span>", formTextareaDB("marcolegal_progen","programas","id","$id","marcolegalEN","","","","$ver","formulario",$link));
	
	enTabla2("Organismo responsable", formTextareaDB("orgresponsable_proges","programas","id","$id","orgresponsableES","","","","$ver","formulario",$link));
	enTabla2("<span class='eng'>Organismo responsableEN</span>", formTextareaDB("orgresponsable_progen","programas","id","$id","orgresponsableEN","","","","$ver","formulario",$link));
	
	enTabla2("Organismo ejecutor", formTextareaDB("orgejecutor_proges","programas","id","$id","orgejecutorES","","","","$ver","formulario",$link));
	enTabla2("<span class='eng'>Organismo ejecutorEN</span>", formTextareaDB("orgejecutor_progen","programas","id","$id","orgejecutorEN","","","","$ver","formulario",$link));

	enTabla2("Organismo responsable del registro de usuarios", formTextareaDB("orgrespbenef_proges","programas","id","$id","orgrespbenefES","","","","$ver","formulario",$link));
	enTabla2("<span class='eng'>Organismo responsable del registro de usuarios EN</span>", formTextareaDB("orgrespbenef_progen","programas","id","$id","orgrespbenefEN","","","","$ver","formulario",$link));

	
	enTabla2("Fuente financiamiento", formTextareaDB("fuentefinan_proges","programas","id","$id","fuentefinanES","","","","$ver","formulario",$link));
	enTabla2("<span class='eng'>Fuente financiamiento</span>", formTextareaDB("fuentefinan_progen","programas","id","$id","fuentefinanEN","","","","$ver","formulario",$link));
	
	
			
	if($id)
	{
		enTabla("Fecha de Ingreso","$fecha_ingreso");
		enTabla("Fecha de Actualización","$fecha_act");
		enTabla("Publicado", formRadioDB("programas","publicar","id","$id","publicar","SI","NO--NO,SI--SI","1",$link));
	}
		enTabla2("",formSubmit("Grabar","","","formulario"));
?>
        </table>
      </form>
		</div>		
		</td>
    </tr>
  </table>
</div>
</body>
</html>
<?php 
}else{
?>
	<h3 class="texto">No está autorizado para editar este registro</h3>
<?php
}

DesconectaDB($link); 
?>
