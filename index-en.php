<?php

// Configura el idioma seleccionado por el usuario.

// Almacena el nombre URL de la p�gina de procedencia
	$direccion = 'http://dds-d.cepal.org/bdptc/';	

// Toma el idioma seleccionado
	$lenguaje_get=$_GET['lang'];


// Almacena el idioma en una variable de Sesi�n
	if($lenguaje_get=='EN')
	{
	session_start();
	$_SESSION["lang"] = "EN";
	} 

// Redirige a la p�gina de procedencia
	header("Location: $direccion");

?>
