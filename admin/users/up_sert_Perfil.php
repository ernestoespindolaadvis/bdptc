<?php
####################################
### SEGURIDAD
####################################

require ("../../lib/aut_verifica.inc.php");

//$nivel_acceso=1;
$nivel_acceso=2; // para permitir que el Usuario vea su ficha y la Edite 

if ($nivel_acceso < $_SESSION['usuario_nivel']){

	header ("Location: $redir?error_login=5");
	exit;
}



####################################

include '../../lib/lib.php';

$nombre = escapa($nombre);

ConectaDB_ptc();

$update = 0;

//if(!$id_institucion){$id_institucion=0;}



if($id != "") { 
	$update = 1; 
} else {
	//$id = siguienteID("id_usr","usr");
}


$fecha_ingreso=hoy_hora();
$fecha_act=hoy_hora();

/// Todos los usr que ingresemos tendrán Nivel Acceso 2 (por seguridad)
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
	'$id_padre',
	'$nombre',
	'$nombre_login',
	'$pass',
	$niv_acceso,
	'$fecha_ingreso',
	'$id_pais',	
	'$email',
	'$email2',	
	'$institucion'
	)";

}else{

	$query = "
	update usr
	set
	id_padre = '$id_padre',
	nombre = '$nombre',
	nombre_login = '$nombre_login',
	pass = '$pass',
	fecha_act = '$fecha_act',
	email = '$email',
	email2 = '$email2',
	institucion = '$institucion',
	pais = '$id_pais'
	where
	id_usr = $id
	";
}

QueryDB($query);

//printDB($query);




DesconectaDB();

?>

<script>
	<!-- document.write (" Su perfil se ha actualizado !")document.write (" <hr> <input type='button' Onclick='document.location.href=../' value='volver'>")-->
	document.location.href='Perfil.php?id=<?php print $id; ?>&mensaje=1';
</script>

