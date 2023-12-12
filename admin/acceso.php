<?php

include '../lib/aut_mensaje_error.inc.php';

// No almacenar en el cache del navegador esta página.
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");             		// Expira en fecha pasada
	header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");		// Siempre página modificada
	header("Cache-Control: no-cache, must-revalidate");           		// HTTP/1.1
	header("Pragma: no-cache");                                   		// HTTP/1.0

	//if(!$src){$src="/dds/bdptc/admin/portada.php";} ## le asignamos un SRC por defecto LOCAL
	if(!$src){$src="/bdptc/admin/portada.php";} ## le asignamos un SRC por defecto SERVER

//Formamos el mensaje de error si existe
$mensaje_error="";
if($error_login)
{
	$mensaje_error=$error_login_ms[$error_login];
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
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
	/*width: 250px;*/
	padding: 20px;
	margin:0 auto;
   background:#E8EEF4;
	color:#000;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
}	 
</style>
<script language="JavaScript">
	function checkform(form1){
		if(form1.usr.value.length == 0) {
			alert ('Debe ingresar su nombre de usuario\n');
			return false;
		}
		if(form1.pass.value.length ==0) {
			alert ('Debe ingresar su clave\n');
			return false;
		}
		return true;
	}
</script>
<script language="Javascript1.2">
	function clave()
	{
		var LeftPosition = ((screen.width)?(screen.width-415)/2:100);
		var TopPosition = ((screen.height)?(screen.height-480)/2:100);
		window.open('http://www.eclac.cl/dds/mail/clave_risalc.htm','mywin',',status=no,toolbar=no,scrollbars=no,menubar=no,width=350,height=200,resizable=yes,top='+TopPosition + ',left=' + LeftPosition);
	}
</script>
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
<h1>Sistema de Administraci&oacute;n de Contenidos</h1>
<div id="menu">
<ul id="nav">
</ul> 
</div>
</div>
<div id="pagebody">
  <a href="../"><span class="Estilo6">Portal</span></a>
  <table width="100%"  border="0" cellspacing="0" cellpadding="5">
    <tr valign="top">
      <td>
<!-- local 
<form name="form1" method="post" action="/dds/bdptc/admin/portada.php" onsubmit="return checkform(this)">
-->

<!-- acceso server -->
<form name="form1" method="post" action="/bdptc/admin/portada.php" onsubmit="return checkform(this)"> 

 <table width="415" border="0" align="center" cellpadding="5" cellspacing="0">
     <tr> 
       <td colspan="2" align="center"><p align="left" class="Estilo6"> Acceso</p><font color=red><?php print "$mensaje_error"; ?></font></td>
     </tr>
     <tr> 
       <td><div align="right">Usuario</div></td>
       <td> <input name="usr" type="text" class="formulario" size="25" maxlength="15"></td>
     </tr>
     <tr> 
      <td><div align="right">Clave</div></td>
      <td><input name="pass" type="password" class="formulario" size="25" maxlength="15">
        <br>        </td>
     </tr>
      <tr>
        <td>&nbsp;</td>
        <td><input name="Button" type="submit" class="formulario" value="Ingresar"></td>
      </tr>
      <tr> 
        <td>&nbsp;</td>
        <td bgcolor="#EFEFEF">          
        <div align="center">
        	<strong>Nota</strong>:<br> Sistema de Administracion de Contenidos. 
        	<br />Base de Datos Programas de asistencia social. 
        </div>
        </td>
      </tr>
  </table>
</form>
		<!-- Fin acceso-->		</td>
    </tr>
  </table>
</div>


</body>
</html>
