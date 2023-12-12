<?php

####################################
### SEGURIDAD
####################################
include '../../lib/lib.php';
require ("../../lib/aut_verifica.inc.php");

$nivel_acceso=2;

if ($nivel_acceso < $_SESSION['usuario_nivel']){

	header ("Location: $redir?error_login=5");
	exit;
}


####################################

$link = Conectarse("bdptc");
if(isset($_GET['id'])){
	$id=$_GET['id'];
}
if(isset($_GET['id_programa'])){
	$id_programa=$_GET['id_programa'];
}
//Por seguridad antes de mostrar un registro comprobamos que el usuario se due�o del registro
//o que sea super usuario (nivel acceso = 1)

//recuperamos el ID del usuario de la sesion
$id_usr=$_SESSION['usuario_id'];

if($id_programa){

	//recuperamos el ID del usuario del registro
	$id_usr_reg=traeRegistroDB("programas","id","$id_programa","id_usr",$link);

	$fecha_ingreso = traeRegistroDB("programas","id",$id_programa,"fechaingreso",$link);
	$fecha_act = traeRegistroDB("programas","id",$id_programa,"fechaactualiza",$link);
	if($fecha_act == "0000-00-00 00:00:00"){$fecha_act="-";}
	if($fecha_act == ""){$fecha_act=$fecha_ingreso;}
	

}

// Menu relaciones programa
	$rel_prog = "<ul class=\"basictab\"><li><a href=\"../programas/ficha.php?id=$id_programa\">General</a></li><li class=\"selected\"><a href=\"listado.php?id_programa=$id_programa\">Componentes</a></li><li><a href=\"..//referencias/listado.php?id_programa=$id_programa\">Referencias</a></li></ul>"; 


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

<script>
function validar(){

	document.forms[0].submit();

}
</script>
<link href="../css/estilo.css" rel="stylesheet" type="text/css">
<link href="../css/BordesCorners.css" rel="stylesheet" type="text/css">
<link href="../../css/menu-tab.css" rel="stylesheet" type="text/css">

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
    <td width="10%"><div align="center"><span class="Estilo8">Ficha</span></div></td>
    <td width="90%" valign="top" class="Estilo6">&nbsp;</td>
  </tr>
</table>

  <table width="100%"  border="0" cellspacing="0" cellpadding="5">
    <tr valign="top">
      <td width="10%"><p align="center" class="Estilo8"><a href="listado.php"><img src="../img/Proyectos.gif" width="104" height="103" border="0"></a></p></td>
      <td width="90%" colspan="5">
      <?php echo $rel_prog; ?>
<div style="margin-left:0px">
<form method="post" action="up_sert.php" ENCTYPE="multipart/form-data">
<?php print formHidden("id","$id","");  ?>
<?php print formHidden("id_programa","$id_programa","");  ?>
        <table cellpadding="3">
<?php
	enTabla2("Nombre", formTextoDB("nombre_compes","componentes","id","$id","nombreES","","","","$ver","formulario",$link));
	enTabla2("<span class='eng'>NombreEN</span>", formTextoDB("nombre_compen","componentes","id","$id","nombreEN","","","","$ver","formulario",$link));
	
	enTabla2("Destinatarios", formTextoDB("destinatarios_compes","componentes","id","$id","destinatariosES","","","","$ver","formulario",$link));
	enTabla2("<span class='eng'>DestinatariosEN</span>", formTextoDB("destinatarios_compen","componentes","id","$id","destinatariosEN","","","","$ver","formulario",$link));
	
	enTabla2("Modalidad", formTextoDB("modalidad_compes","componentes","id","$id","modalidadES","","","","$ver","formulario",$link));
	enTabla2("<span class='eng'>ModalidadEN</span>", formTextoDB("modalidad_compen","componentes","id","$id","modalidadEN","","","","$ver","formulario",$link));
	
	enTabla2("Forma entrega", formTextoDB("formaentrega_compes","componentes","id","$id","formaentregaES","","","","$ver","formulario",$link));
	enTabla2("<span class='eng'>Forma entregaEN</span>", formTextoDB("formaentrega_compen","componentes","id","$id","formaentregaEN","","","","$ver","formulario",$link));
	
	enTabla2("Periodo entrega", formTextareaDB("periodoentrega_compes","componentes","id","$id","periodoentregaES","","","","$ver","formulario",$link));
	enTabla2("<span class='eng'>Periodo entregaEN</span>", formTextareaDB("periodoentrega_compen","componentes","id","$id","periodoentregaEN","","","","$ver","formulario",$link));
	
	enTabla2("Receptor", formTextareaDB("receptor_compes","componentes","id","$id","receptorES","","","","$ver","formulario",$link));
	enTabla2("<span class='eng'>ReceptorEN</span>", formTextareaDB("receptor_compen","componentes","id","$id","receptorEN","","","","$ver","formulario",$link));
	
	enTabla2("Limite familia", formTextareaDB("limitefamilia_compes","componentes","id","$id","limitefamiliaES","","","","$ver","formulario",$link));
	enTabla2("<span class='eng'>Limite familiaEN</span>", formTextareaDB("limitefamilia_compen","componentes","id","$id","limitefamiliaEN","","","","$ver","formulario",$link));
	
	enTabla2("Corresponsabilidad", formTextareaDB("corresponsabilidad_compes","componentes","id","$id","corresponsabilidadES","","","","$ver","formulario",$link));
	enTabla2("<span class='eng'>CorresponsabilidadEN</span>", formTextareaDB("corresponsabilidad_compen","componentes","id","$id","corresponsabilidadEN","","","","$ver","formulario",$link));
	
	enTabla2("Sanciones", formTextareaDB("sanciones_compes","componentes","id","$id","sancionesES","","","","$ver","formulario",$link));
	enTabla2("<span class='eng'>SancionesEN</span>", formTextareaDB("sanciones_compen","componentes","id","$id","sancionesEN","","","","$ver","formulario",$link));
	
	enTabla2("Comentarios", formTextareaDB("comentarios_compes","componentes","id","$id","comentariosES","","","","$ver","formulario",$link));
	enTabla2("<span class='eng'>ComentariosEN</span>", formTextareaDB("comentarios_compen","componentes","id","$id","comentariosEN","","","","$ver","formulario",$link));
	
	enTabla2("Descripcion", formTextareaDB("descripcion_compes","componentes","id","$id","descripcionES","","","","$ver","formulario",$link));
	enTabla2("<span class='eng'>DescripcionEN</span>", formTextareaDB("descripcion_compen","componentes","id","$id","descripcionEN","","","","$ver","formulario",$link));
	
	enTabla2("Montos", formTextareaDB("montos_compes","componentes","id","$id","montosES","","","","$ver","formulario",$link));
	enTabla2("<span class='eng'>MontosEN</span>", formTextareaDB("montos_compen","componentes","id","$id","montosEN","","","","$ver","formulario",$link));
	
	enTabla2("Tipo de Transferencia", formTextareaDB("tipo_transfes","componentes","id","$id","tipotransferES","","","","$ver","formulario",$link));
	enTabla2("<span class='eng'>Tipo TransferenciaEN</span>", formTextareaDB("tipo_transfen","componentes","id","$id","tipotransferEN","","","","$ver","formulario",$link));
	
	
	if($id)
	{
enTabla("Fecha de Ingreso","$fecha_ingreso");
enTabla("Fecha de Actualización","$fecha_act");
enTabla("Publicado", formRadioDB("componentes","publicar","id","$id","publicar","SI","NO--NO,SI--SI","1",$link));
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
