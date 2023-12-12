<?
####################################
### SEGURIDAD
####################################

require ("../../../lib/aut_verifica.inc.php");

$nivel_acceso=2;

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
         <td width="32%"><div align="center">Nombre</div></td>
         <td width="15%"><div align="center">Fecha Ingreso </div></td>
         <td width="8%"><div align="center">Ficha</div></td>
		 <td width="8%"><div align="center">Publicado</div></td>
      </tr>
END;

######################################
######################################
### vemos que mostramos segun el nivel de acceso del usuario

if($_SESSION['usuario_nivel'] == 1)
{
	if($orden)
	{
	$query  = "select * from programas order by fecha_control desc";
	}else
	{
	$query  = "select * from programas order by fecha_control desc";
	}
}

if($_SESSION['usuario_nivel'] == 2)
{
	$id_usr=$_SESSION['usuario_id'];
	$query  = "select * from programas where id_usr=$id_usr order by fecha_control desc";
	
	$txt_publicar=<<<END
	$row[publicar];
END;

}

	$p=QueryDB($query); 

	while($row=TraeArrayDB($p)){ //Generamos rutina para leer filas de la BD

		$i++;
		
		if($row[publicar] == "SI"){
			$class_sino="boton_si";
			#$bgcolor="#FFF7E5";
			$bgcolor="#FFFFFF";
		}else{
			$class_sino="boton_no";
			#$bgcolor="#93BEE2";
			$bgcolor="#DCEAF5";
		}

if($_SESSION['usuario_nivel'] == 1) // Si es el ADM imprimimos el Boton Estado
{
	$opcion = formCambiaEstadoRegistro($row[publicar],$row[0],"publicar",$class_sino);
	$txt_publicar=<<<END
	<div align="center">$opcion</div>
END;

}		

if($_SESSION['usuario_nivel'] == 2) // Si es usuario, imprimos 
{
	$txt_publicar=<<<END
	<div align="center">$row[publicar]</div>
END;

}		
		if($row[fechaactual] == "0000-00-00 00:00:00"){$row[fecha_actual]="-";}
		
		$txt.=<<<END
		<tr>
			<td><div align="right">$i</div></td>
			<td><div align="center"><a href="#" onClick="if(confirm('Desea borrar el registro $row[nombre_programa]')){document.location.href='borra.php?id=$row[id_programa]'}"><img src="../img/delete.png" alt="Borrar" border="0"></a></div></td>
			<td><div align="center"><a href="ficha.php?id=$row[id_programa]"><img src="../img/edit.png" alt="Editar" border="0"></a></div></td>
			<td><div align="center"><img src="../img/link.gif" alt="Productos Relacionados"></div></td>
			<td>$row[nombre_programa]</td>
			<td> <div align="right">$row[fecha_control]</div></td>
			<td><div align="center">
			<a href="/disalc/ficha.php?id=$row[id_programa]&es_programa=1" target=_blank>
			<img src="../img/link.gif" alt="Ficha" border="0"></a></div></td>
END;
		$txt .=	"<td>";
		//$txt .= formCambiaEstadoRegistro($row[publicar],$row[0],"publicar",$class_sino);
		$txt .= $txt_publicar;
		$txt .=	"</td>";
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
	<div id="box"><a href="ficha.php">
	<p class="linkboton" align="center">Nuevo Proyecto</p>
	</a></div></td>
  </tr>
</table>

  <table width="100%"  border="0" cellspacing="0" cellpadding="5">
    <tr valign="top">
      <td width="10%"><a href="listado.php"><img src="../img/Proyectos.gif" width="104" height="103" border="0"></a> </td>
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
