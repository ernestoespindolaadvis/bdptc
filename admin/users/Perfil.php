<?php

####################################
### SEGURIDAD
####################################

require ("../../lib/aut_verifica.inc.php");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//$nivel_acceso=1;
$nivel_acceso=2; // para permitir que el Usuario vea su ficha y la Edite 

if ($nivel_acceso < $_SESSION['usuario_nivel']){

	header ("Location: $redir?error_login=5");
	exit;
}


####################################

include '../../lib/lib.php';


ConectaDB_ptc();

if($id){
	$fecha_ingreso = traeRegistroDB("usr","id_usr",$id,"fecha_ingreso");
	$fecha_act = traeRegistroDB("usr","id_usr",$id,"fecha_act");
	if($fecha_act == "0000-00-00 00:00:00"){$fecha_act="-";}
	//$id_institucion = traeRegistroDB("usr","id_usr",$id,"id_institucion");
	$id_pais = traeRegistroDB("usr","id_usr",$id,"pais");
	//$id_red = traeRegistroDB("usr","id_usr",$id,"red");

}
	
/**** funcion para Obtener la Lista de instituciones y vincular con el usuario **/
	//$select_institucion = formComboDB2("id_institucion","instituciones","idinst","NombreInst","$id_institucion","","type_text","10");

/*** Funcion para obtener el pais seleccionado**/
	$select_pais = formComboDB("id_pais","paises","id","paisES","$id_pais","","formulario");
	
/************* 
	Agrego funcion para Red seleciionada
	***************/
	//$select_red = formComboRed("id_red","red","id_red","nombre_red","$id_red","","formulario");

######################## 
#### SALIDA HTML


if ($mensaje)
{
	$display = " <span style=color:#ff0000;font-size:16px>Su Perfil se ha actualizado correctamente !</span> <br><br>";
}

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
      <td width="10%"><p align="center" class="Estilo8"><img src="../img/Usuarios_Perfil.gif" width="101" height="102" border="0"></p></td>
      <td width="90%" colspan="5">
		<?php echo $display;?>
		<div style="margin-left:25px">
		<form method="post" action="up_sert_Perfil.php" ENCTYPE="multipart/form-data">
		  <?php print formHidden("id","$id","");  ?>
        <table cellpadding="3">
		  <?php
			//enTabla("Instituci�n <br> a la que pertenece", $select_institucion);
			enTabla2("Nombre", formTextoDB("nombre","usr","id_usr","$id","nombre","","","","$ver","formulario"));
			enTabla2("Usuario (login)", formTextoDB("nombre_login","usr","id_usr","$id","nombre_login","","","","$ver","formulario"));
			enTabla2("Clave (password)", formTextoDB("pass","usr","id_usr","$id","pass","","","","$ver","formulario"));
			enTabla2("Email", formTextoDB("email","usr","id_usr","$id","email","","","","$ver","formulario"));
			enTabla2("Email 2", formTextoDB("email2","usr","id_usr","$id","email2","","","","$ver","formulario"));
			enTabla2("Institucion", formTextoDB("institucion","usr","id_usr","$id","institucion","","","","$ver","formulario"));
			
			enTabla2("Pais", $select_pais);
			//enTabla2("Red", $select_red);
			
			if($id){
				enTabla2("Fecha de Ingreso","$fecha_ingreso");
				enTabla2("Fecha de Actualizaci�n","$fecha_act");
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
<?php DesconectaDB(); ?>
