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
	//$id_pais = traeRegistroDB("programas","id",$id,"pais",$link);
	//$id_red = traeRegistroDB("programas","id",$id,"red",$link);

	//$fecha_cambio_estado = traeRegistroDB("programas","id",$id,"fecha_cambio_estado",$link);
	//if($fecha_cambio_estado == "0000-00-00 00:00:00"){$fecha_cambio_estado="-";}
	

}

// Menu relaciones programa
	$rel_prog = "<ul class=\"basictab\"><li><a href=\"../programas/ficha.php?id=$id_programa\">General</a></li><li><a href=\"../componentes/listado.php?id_programa=$id_programa\">Componentes</a></li><li class=\"selected\"><a href=\"listado.php?id_programa=$id_programa\">Referencias</a></li></ul>"; 


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
	enTabla2("Fecha", formTextoDB("fecha_refes","referencias","id","$id","fechaES","","","","$ver","formulario",$link));
	enTabla2("<span class='eng'>FechaEN</span>", formTextoDB("fecha_refen","referencias","id","$id","fechaEN","","","","$ver","formulario",$link));
	
	enTabla2("Autor", formTextoDB("autor_refes","referencias","id","$id","autorES","","","","$ver","formulario",$link));
	enTabla2("<span class='eng'>AutorEN</span>", formTextoDB("autor_refen","referencias","id","$id","autorEN","","","","$ver","formulario",$link));
	
	enTabla2("Titulo", formTextoDB("titulo_refes","referencias","id","$id","tituloES","","","","$ver","formulario",$link));
	enTabla2("<span class='eng'>TituloEN</span>", formTextoDB("titulo_refen","referencias","id","$id","tituloEN","","","","$ver","formulario",$link));
	
	
	enTabla2("Dato publicacion", formTextoDB("datopub_refes","referencias","id","$id","datopubES","","","","$ver","formulario",$link));
	enTabla2("<span class='eng'>Dato publicacionEN</span>", formTextoDB("datopub_refen","referencias","id","$id","datopubEN","","","","$ver","formulario",$link));
	
	enTabla2("Link", formTextoDB("link_ref","referencias","id","$id","link","","","","$ver","formulario",$link));
	
	enTabla2("Tema", formTextareaDB("tema_refes","referencias","id","$id","temaES","","","","$ver","formulario",$link));
	enTabla2("<span class='eng'>TemaEN</span>", formTextareaDB("tema_refen","referencias","id","$id","temaEN","","","","$ver","formulario",$link));
	
			
	if($id)
	{
		enTabla("Fecha de Ingreso","$fecha_ingreso");
		enTabla("Fecha de Actualización","$fecha_act");
		enTabla("Publicado", formRadioDB("referencias","publicar","id","$id","publicar","SI","NO--NO,SI--SI","1",$link));
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
