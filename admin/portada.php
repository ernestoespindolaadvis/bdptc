<?php
include '../lib/lib.php';
require '../lib/aut_verifica.inc.php';
####################################
### SEGURIDAD
####################################

$nivel_acceso=2;

if ($nivel_acceso < $_SESSION['usuario_nivel']){

	header ("Location: $redir?error_login=5");
	exit;
}

####################################
$link = Conectarse("bdptc");
//Imprimimos la portada para usuarios de nivel 1 (administradores internos)
if($_SESSION['usuario_nivel'] == 1)
{
print<<<END
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Sistema de Administraci&oacute;n de Contenidos</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<link href="css/BordesCorners.css" rel="stylesheet" type="text/css">
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
	width: 100px;
	padding: 10px;
	/*margin:0 auto; /* Se alinea automaticamente */
   background:#E8EEF4;
	color:#666;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 18px;
	font-weight:bold
}	 
.linkboton {	color:#666;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 18px;
	font-weight:bold
}
</style>
<script type="text/javascript" src="js/Bordes.js"></script>
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
<h1>Sistema de administracion de contenidos</h1>
<div id="menu">
	<ul id="nav">
	  <li id="home" class="activelink"><a href="./portada.php">Portada</a></li>
	  <li><a href="#" onClick="if(confirm('Desea Salir del sistema ?')){document.location.href='logout.php';}">S A L I R</a></li>
	</ul> 
</div>
</div>
<div id="pagebody">
  <p class="Estilo6">Portada</p>
<table width="100%"  border="0" cellspacing="0" cellpadding="5">
    <tr valign="top" align="center">
      <td><a href="users/listado.php"><img src="img/Usuarios.gif" border="0"></a> </td>
      <td><a href="programas/listado.php"><img src="img/Proyectos.gif" width="104" height="103" border="0"></a></td>
  </table>
<p>&nbsp;</p>
<div id="foot">
	<!--
    <p class="Estilo8">Consejos</p>
    <table width="100%"  border="0" cellpadding="5">
      <tr>
        <td width="27%" valign="top"><p><strong>Publicaciones.<br>
        </strong>Para  subir archivos en formato PDF, es recomendable utilizar nombres de  archivos sin espacios en blancos y sin caracteres extra&ntilde;os. Use solo letras o n&uacute;meros. </p>        </td>
        <td width="41%" valign="top"><strong>Temas o palabras claves.<br>
        </strong> Al ingresar una instituci&oacute;n, proyecto o publicaci&oacute;n, en el formulario se le solicitar&aacute; ingresar los temas o palabras claves vinculados a cada fuente. La importancia de completar este campo, se debe a  que le permitir&aacute; que sus fuentes puedan ser encontradas por otros usuarios a trav&eacute;s del sistema de b&uacute;squeda de RISALC. </td>
        <td width="32%" valign="top"><strong>Opciones avanzadas. <br>
        </strong> Para aquellas Instituciones (o usuarios), Redes u Organizaciones que cuenten con Bases de datos, ya sean de acceso p&uacute;blico en linea a trav&eacute;s de sitios Web, o bien est&eacute;n almacendas en otros formatos, y desean compartir esta informaci&oacute;n, existe la posibilidad de realizar protocolos de comunicaci&oacute;n con RISALC. <br>
        <br>
        * Los protocolos se  realizar&aacute;n previo a un estudio de factibilidad. <br>
        <br>
        M&aacute;s informaci&oacute;n :<br>
        Email:        <a href="mailto:marco.ortega@cepal.org">marco.ortega@cepal.org </a><br>
        Tel: ( 56 2) 2102272     , ( 56 2) 2102297<br>
        Lunes a Viernes de 9:00 a 18:00 hrs (de Chile) </td>
      </tr>
    </table>
    -->
  </div>  
</div>
</body>
</html>
END;
}

//Imprimimos la portada para usuarios de nivel 2 (usuarios de instituciones externas)

if($_SESSION['usuario_nivel'] == 2)
{
	$id_usr=$_SESSION['usuario_id'];
	$nombre_usuario=traeRegistroDB("usr","id_usr","$id_usr","nombre",$link);

print<<<END
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
	<html>
	<head>
	<title>Sistema de Administraci&oacute;n de Contenidos</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<link href="css/estilo.css" rel="stylesheet" type="text/css">
	<link href="css/BordesCorners.css" rel="stylesheet" type="text/css">
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
		width: 100px;
		padding: 10px;
		/*margin:0 auto; /* Se alinea automaticamente */
		background:#E8EEF4;
		color:#666;
		font-family: Arial, Helvetica, sans-serif;
		font-size: 18px;
		font-weight:bold
	}	 
	.linkboton {	
		color:#666;
		font-family: Arial, Helvetica, sans-serif;
		font-size: 18px;
		font-weight:bold
	}
	</style>

	<script type="text/javascript" src="js/Bordes.js"></script>
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
	<h1>Sistema de administracion de contenidos</h1>
	<div id="menu">
	<ul id="nav">
	  <li id="home" class="activelink"><a href="./portada.php">Portada</a></li>
	  <li><a href="#" onClick="if(confirm('Desea Salir del sistema ?')){document.location.href='logout.php';}">S A L I R</a></li>
	</ul> 
	</div>
	</div>
	<div id="pagebody">
	  <p class="Estilo6">Usuario : $nombre_usuario </p>
	  <table width="100%"  border="0" cellspacing="0" cellpadding="5">
		 <tr valign="top">
		 <td><a href="users/Perfil.php?id=$id_usr"><img src="img/Usuarios_Perfil.gif" width="101" height="102" border="0"></a> </td>
      <td><a href="programas/listado.php"><img src="img/Proyectos.gif" width="104" height="103" border="0"></a></td>
	  </table>
<p>&nbsp;</p>	  
<div id="foot">
<!-- 
    <p class="Estilo8">Consejos</p>
    <table width="100%"  border="0" cellpadding="5">
      <tr>
        <td width="27%" valign="top"><p><strong>Publicaciones.<br>
        </strong>Para  subir archivos en formato PDF, es recomendable utilizar nombres de  archivos sin espacios en blancos y sin caracteres extra&ntilde;os. Use solo letras o n&uacute;meros. </p>        </td>
        <td width="41%" valign="top"><strong>Temas o palabras claves.<br>
        </strong> Al ingresar una instituci&oacute;n, proyecto o publicaci&oacute;n, en el formulario se le solicitar&aacute; ingresar los temas o palabras claves vinculados a cada fuente. La importancia de completar este campo, se debe a  que le permitir&aacute; que sus fuentes puedan ser encontradas por otros usuarios a trav&eacute;s del sistema de b&uacute;squeda de RISALC. </td>
        <td width="32%" valign="top"><strong>Opciones avanzadas. <br>
        </strong> Para aquellas Instituciones (o usuarios), Redes u Organizaciones que cuenten con Bases de datos, ya sean de acceso p&uacute;blico en linea a trav&eacute;s de sitios Web, o bien est&eacute;n almacendas en otros formatos, y desean compartir esta informaci&oacute;n, existe la posibilidad de realizar protocolos de comunicaci&oacute;n con RISALC. <br>
        <br>
        * Los protocolos se  realizar&aacute;n previo a un estudio de factibilidad. <br>
        <br>
        M&aacute;s informaci&oacute;n :<br>
        Email:        <a href="mailto:marco.ortega@cepal.org">marco.ortega@cepal.org </a><br>
        Tel: ( 56 2) 2102272     , ( 56 2) 2102297<br>
        Lunes a Viernes de 9:00 a 18:00 hrs (de Chile) </td>
      </tr>
    </table>
    <p class="Estilo8">&nbsp;</p>
-->    
  </div>	  
	</div>
	</body>
	</html>

END;
}

DesconectaDB($link);

?>		

