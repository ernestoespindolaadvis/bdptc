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

########### Defino los mensajes de acuerdo a la operacion realizada
if ($_GET['mensaje'])
{
	$display = "<span style=color:#ff0000;font-size:16px>".$_GET['mensaje']."</span> <br><br>";
}

####################################

$link = Conectarse("bdptc");

	$i=0;
	
	$txt =<<<END
		<tr bgcolor="#EFEFEF">
         <td width="4%"><div align="center">Nro</div></td>
         <td width="5%"><div align="center">Borrar</div></td>
         <td width="5%"><div align="center">Editar</div></td>
         <td width="3%"><div align="center">Tipo</div></td>
         <td width="32%"><div align="left">Nombre</div></td>
         <td width="15%"><div align="center">Fecha Ingreso </div></td>
         <td width="8%"><div align="center">Ver Ficha</div></td>
		 <td width="8%"><div align="center">Publicado</div></td>
      </tr>
END;

### vemos que mostramos segun el nivel de acceso del usuario

if($_SESSION['usuario_nivel'] == 1) // adm portal
{
	if($todos)
	{
	$query  = "select * from programas order by fechaingreso desc";
	}else
	{
	$query  = "select * from programas order by fechaingreso desc LIMIT 0,300";
	}
}

if($_SESSION['usuario_nivel'] == 2) // adm bd
{
	$id_usr=$_SESSION['usuario_id'];
	
	// lista programas ingresados por el usuario
	//$query  = "select * from programas where id_usr=$id_usr order by fecha_control desc";
	
	// lista todos los programas para usarios de nivel 2 - adminstrador BD
	$query  = "select * from programas order by fechaingreso desc"; 
	
	$txt_publicar=<<<END
	$row[publicar];
END;

}

if($_SESSION['usuario_nivel'] == 3) // simple usr
{
	$id_usr=$_SESSION['usuario_id'];
	
	// lista programas ingresados por el usuario
	//$query  = "select * from programas where id_usr=$id_usr order by fecha_control desc";
	
	// lista todos los programas para usarios de nivel 2 - adminstrador BD
	$query  = "select * from programas order by fechaingreso desc"; 
	
	$txt_publicar=<<<END
	$row[publicar];
END;

}
	$p=QueryDB($query,$link); 

	while($row=TraeArrayDB($p)){ //Generamos rutina para leer filas de la BD

		$i++;
		
		if($row["publicar"] == "SI"){
			$class_sino="boton_si";
			#$bgcolor="#FFF7E5";
			$bgcolor="#FFFFFF";
		}else{
			$class_sino="boton_no";
			#$bgcolor="#93BEE2";
			$bgcolor="#DCEAF5";
		}

if($_SESSION['usuario_nivel'] == 1) // Si es el ADM portal
{
	$opcion = formCambiaEstadoRegistro($row["publicar"],$row[0],"publicar",$class_sino);
	$txt_publicar=<<<END
	<div align="center">$opcion</div>
END;

$opcion_borrar_admin=<<<END
<a href="#" onClick="if(confirm('Desea borrar el registro $row[nombreES]')){document.location.href='borra.php?id=$row[id]'}"><img src="../img/delete.png" alt="Borrar" border="0"></a>
END;

}		

if($_SESSION['usuario_nivel'] == 2) // Si es adm bd imprimimos el Boton Estado
{
	$opcion = formCambiaEstadoRegistro($row["publicar"],$row[0],"publicar",$class_sino);
	$txt_publicar=<<<END
	<div align="center">$opcion</div>
END;

$opcion_borrar_admin="";

}

if($_SESSION['usuario_nivel'] == 3) // Si es usuario simple, 
{
	$txt_publicar=<<<END
	<div align="center">$row[publicar]</div>
END;

}		
		if($row["fechaactualiza"] == "0000-00-00 00:00:00"){$row["fechaactualiza"]="-";}


	$ide_prog=$row["id"];
	 if($row["tipo"]==1) { $txt_url_vistaprevia="https://dds.cepal.org/bdptc/programa/?id=$ide_prog"; $txt_tipo_1="PTC"; }
else if($row["tipo"]==2) { $txt_url_vistaprevia="https://dds.cepal.org/bdps/programa/?id=$ide_prog"; $txt_tipo_1="PS"; }
else if($row["tipo"]==3) { $txt_url_vistaprevia="https://dds.cepal.org/bdilp/programa/?id=$ide_prog";  $txt_tipo_1="ILP"; }


		
		$txt.=<<<END
		<tr>
			<td><div align="right">$i</div></td>
			<td><div align="center">$opcion_borrar_admin</div></td>
			<td><div align="center"><a href="ficha.php?id=$row[id]"><img src="../img/edit.png" alt="Editar" border="0"></a></div></td>
			<td><div align="center">$txt_tipo_1</div></td>
			<td>$row[nombreES]</td>
			<td> <div align="right">$row[fechaingreso]</div></td>
			<td><div align="center">
			<a href="$txt_url_vistaprevia" target=_blank>
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
<title>Sistema de Administraci&oacute;n de Contenidos</title>
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
      <?php if (!$todos){ print '<a href="?todos=1">Ver todos</a><br>';}  ?> 
		<?php echo $display;?>
		<table width="100%"  border="0" cellspacing="0" cellpadding="4">
		<?php 
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
<?php DesconectaDB($link);?>
