<?php
####################################
### SEGURIDAD
####################################
include '../../lib/lib.php';
require ("../../lib/aut_verifica.inc.php");
foreach ( $_POST as $k => $v) {
	${$k} = $v;
}
$nivel_acceso=1;

if ($nivel_acceso < $_SESSION['usuario_nivel']){

	header ("Location: $redir?error_login=5");
	exit;
}

####################################

$nombre = escapa($nombre);

$con = ConectarBDpdoADM('bdptc');

$update = 0;

if(!$id_institucion){$id_institucion=0;}

if($id != "") { 
	$update = 1; 
} else {
	//$id = siguienteID("id_usr","usr");
}


$fecha_ingreso=hoy_hora();
$fecha_act=hoy_hora();

// nuevos  usr tendr�n Nivel Acceso 2 adm bd - pueden publicar 
$niv_acceso=2;

### Insertamos o Actualizamos loa datos segun corresponda

if(!$update)
{
	$query = "
	insert into usr
	(
	id_padre,
	nombre,
	nombre_login,
	pass,
	nivel_acceso,
	fecha_ingreso,
	pais,
    email,
	email2,
	institucion
	)
	values
	(
	:id_padre,
	:nombre,
	:nombre_login,
	:pass,
	:niv_acceso,
	:fecha_ingreso,
	:id_pais,	
	:email,
	:email2,	
	:institucion
	)";
	$where_insert['id_padre'] = $id_padre == null ? '' : $id_padre;
	$where_insert['nombre'] = $nombre == null ? '' : $nombre;
	$where_insert['nombre_login'] = $nombre_login == null ? '' : $nombre_login;
	$where_insert['pass'] = $pass == null ? '' : $pass;
	$where_insert['niv_acceso'] = $niv_acceso == null ? '' : $niv_acceso;
	$where_insert['fecha_ingreso'] = $fecha_ingreso == null ? '' : $fecha_ingreso;
	$where_insert['id_pais'] = $id_pais == null ? '' : $id_pais;
	$where_insert['email'] = $email == null ? '' : $email;
	$where_insert['email2'] = $email2 == null ? '' : $email2;
	$where_insert['institucion'] = $institucion == null ? '' : $institucion;
	QueryDBpdo($query,$con,null,$where_insert);
	$msg = ' Registro Ingresado ! ' ;

}else{

	$query = "
	update usr
	set
	id_padre = :id_padre,
	nombre = :nombre,
	nombre_login = :nombre_login,
	pass = :pass,
	fecha_act = :fecha_act,
	email = :email,
	email2 = :email2,
	institucion = :institucion,
	pais = :id_pais
	where
	id_usr = :id
	";
	$where_update['id_padre'] = $id_padre == null ? '' : $id_padre;
	$where_update['nombre'] = $nombre == null ? '' : $nombre;
	$where_update['nombre_login'] = $nombre_login == null ? '' : $nombre_login;
	$where_update['pass'] = $pass == null ? '' : $pass;
	$where_update['fecha_act'] = $fecha_act == null ? '' : $fecha_act;
	$where_update['email'] = $email == null ? '' : $email;
	$where_update['email2'] = $email2 == null ? '' : $email2;
	$where_update['institucion'] = $institucion == null ? '' : $institucion;
	$where_update['id_pais'] = $id_pais == null ? '' : $id_pais;
	$where_update['id'] = $id == null ? '' : $id;
	QueryDBpdo($query,$con,null,$where_update);
	$msg = ' Registro Actualizado ! ' ;
}


//printDB($query);
$con = '';
?>
<script>
	document.location.href='listado.php?mensaje=<?php echo $msg; ?>';
</script>

