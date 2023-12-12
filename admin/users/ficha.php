<?php
####################################
### SEGURIDAD
####################################

include '../../lib/lib.php';
require ("../../lib/aut_verifica.inc.php");

//$nivel_acceso=1;
$nivel_acceso=2; // para permitir que el Usuario vea su ficha y la Edite 

if ($nivel_acceso < $_SESSION['usuario_nivel']){

	header ("Location: $redir?error_login=5");
	exit;
}

if(isset($_GET['id'])){
	$id = $_GET['id'];
}
####################################

$link = Conectarse("bdptc");


//recuperamos el ID del usuario de la sesion
$id_usr=$_SESSION['usuario_id'];

if($id){
	$fecha_ingreso = traeRegistroDB("usr","id_usr",$id,"fecha_ingreso",$link);
	$fecha_act = traeRegistroDB("usr","id_usr",$id,"fecha_act",$link);
	if($fecha_act == "0000-00-00 00:00:00"){$fecha_act="-";}
	//$id_institucion = traeRegistroDB("usr","id_usr",$id,"id_institucion",$link);
	$id_pais = traeRegistroDB("usr","id_usr",$id,"pais",$link);
	//$id_red = traeRegistroDB("usr","id_usr",$id,"red",$link);

}
	
/**** funcion para Obtener la Lista de instituciones y vincular con el usuario **/
	//$select_institucion = formComboDB2("id_institucion","instituciones","idinst","NombreInst","$id_institucion","","type_text","10");

/*** Funcion para obtener el pais seleccionado**/
	$select_pais = formComboDB("id_pais","paises","id","paisES","$id_pais","","formulario",$link);
	
/************* 
	Agrego funcion para Red seleciionada
	***************/
	//$select_red = formComboRed("id_red","red","id_red","nombre_red","$id_red","","formulario");

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
      <td width="10%"><p align="center" class="Estilo8"><a href="listado.php"><img src="../img/Usuarios.gif" width="101" height="102" border="0"></a></p></td>
      <td width="90%" colspan="5">
		<div style="margin-left:25px">
		<form method="post" action="up_sert.php" ENCTYPE="multipart/form-data">
		  <?php print formHidden("id","$id","");  ?>
		  <?php print formHidden("id_padre","$id_usr","");  ?>
        <table cellpadding="3">
		  <?php
			//enTabla("Instituci�n <br> a la que pertenece", $select_institucion);
			enTabla2("Nombre", formTextoDB("nombre","usr","id_usr","$id","nombre","","","","$ver","formulario",$link));
			enTabla2("Usuario (login)", formTextoDB("nombre_login","usr","id_usr","$id","nombre_login","","","","$ver","formulario",$link));
			enTabla2("Clave (password)", formTextoDB("pass","usr","id_usr","$id","pass","","","","$ver","formulario",$link));
			enTabla2("Email", formTextoDB("email","usr","id_usr","$id","email","","","","$ver","formulario",$link));
			enTabla2("Email 2", formTextoDB("email2","usr","id_usr","$id","email2","","","","$ver","formulario",$link));
			enTabla2("Institucion", formTextoDB("institucion","usr","id_usr","$id","institucion","","","","$ver","formulario",$link));
			
			enTabla2("Pais", $select_pais);
			//enTabla2("Red", $select_red);
			
			if($id){
				enTabla2("Fecha de Ingreso","$fecha_ingreso");
				enTabla2("Fecha de Actualización","$fecha_act");
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
