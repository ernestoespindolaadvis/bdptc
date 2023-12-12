<?php

// Configura el idioma seleccionado por el usuario.

// Almacena el nombre URL de la página de procedencia
	$direccion = 'http://dds-d.cepal.org/bdptc/';	

// Toma el idioma seleccionado
	$lenguaje_get=$_GET['lang'];


// Almacena el idioma en una variable de Sesión
	if($lenguaje_get=='EN')
	{
	session_start();
	$_SESSION["lang"] = "EN";
	} 

// Redirige a la página de procedencia
	header("Location: $direccion");

?>
