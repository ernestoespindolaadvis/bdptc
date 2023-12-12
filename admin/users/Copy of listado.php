<?
####################################
### SEGURIDAD

require ("../../../lib/aut_verifica.inc.php");

$nivel_acceso=1;

if ($nivel_acceso < $_SESSION['usuario_nivel']){

	header ("Location: $redir?error_login=5");
	exit;
}

########### Defino los mensajes de acuerdo a la operacion realizada
if ($mensaje)
{
	$display = "<span style=color:#ff0000;font-size:16px>".$mensaje."</span> <br><br>";
}

####################################
include '../../../lib/lib.php';
ConectaDB();

	$i=0;
	
	$txt =<<<END
		<tr bgcolor="#EFEFEF">
         <td width="4%"><div align="center">Nro</div></td>
         <td width="5%"><div align="center">Borrar</div></td>
         <td width="5%"><div align="center">Editar</div></td>
         <td width="3%"><div align="center">Ref</div></td>
         <td width="27%"><div align="center">Nombre</div></td>
         <td width="22%"><div align="center">Email</div></td>
         <td width="17%"><div align="center">Fecha Ingreso </div></td>
         <td width="17%"><div align="center">Fecha Actualizaci&oacute;n </div></td>
      </tr>
END;

if($orden)
	{
		$query = "select * from usr where nivel_acceso > 1 order by nombre";
	}
	else
	{
		$query = "select * from usr where nivel_acceso > 1 order by fecha_ingreso desc";
	}

	$p=QueryDB($query); 

	while($row=TraeArrayDB($p)){ //Generamos rutina para leer filas de la BD

		$i++;
		#print "COL $row[0] <br>";
		if($row[fecha_act]=="0000-00-00 00:00:00"){$row[fecha_act]="-";}
		$row[publicar]="SI"; ### Lo dejamos fijo

		$bgcolor="#FFFFFF";
		$txt.=<<<END
		<tr>
			<td><div align="right">$i</div></td>
			<td><div align="center"><a href="#" onClick="if(confirm('Desea borrar el registro $row[nombre]')){document.location.href='borra.php?id=$row[id_usr]'}"><img src="../img/delete.png" alt="Borrar" border="0"></a></div></td>
			<td><div align="center"><a href="ficha.php?id=$row[id_usr]"><img src="../img/edit.png" alt="Editar" border="0"></a></div></td>
			<td><div align="center"><img src="../img/link.gif" alt="Productos Relacionados"></div></td>
			<td>$row[nombre]</td>
			<td><a href="mailto:$row[email]">$row[email]</a></td>
			<td> <div align="right">$row[fecha_ingreso]</div></td>
			<td> <div align="right">$row[fecha_act]</div></td>
END;
		$txt .=	"</tr>";
}		

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>RISALC Sistema de Administraci&oacute;n de Contenidos</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
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
	margin:0 auto; /* Se alinea automaticamente */
   background:#E8EEF4;
	color:#666;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 18px;
	font-weight:bold
}	 
.linkboton{
	color:#666;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 18px;
	font-weight:bold
}
.formulario {
	font-family:Arial, Helvetica, sans-serif;
	color: #666; 
	font-size: 12px;
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
<h1>RISALC Sistema de Administraci&oacute;n de Contenidos</h1>
<div id="menu">
<ul id="nav">
  <li id="home" class="activelink"><a href="../portada.php">Portada</a></li>
</ul> 
  
</div>
</div>
<div id="pagebody">
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="11%"><div align="center"><span class="Estilo8">Listado</span></div></td>
    <td width="89%" valign="top">
	<div id="box"><a href="ficha.php"><p class="linkboton" align="center">Nuevo usuario</p></a></div></td>
  </tr>
</table>

  <table width="100%"  border="0" cellspacing="0" cellpadding="5">
    <tr valign="top">
      <td width="10%">		  <a href="listado.php"><img src="../img/Usuarios.gif" width="101" height="102" border="0"></a>
		</td>
      <td width="90%" colspan="5">
		<? echo $display;?>
		<table width="100%"  border="0" cellspacing="0" cellpadding="4">
		<? 
		####### Generamos la tabla con la lista de registros
		echo $txt; 
		?>
		</table>
		</td>
    </tr>
  </table>
</div>
<hr>
</body>
</html>
<? DesconectaDB();?>