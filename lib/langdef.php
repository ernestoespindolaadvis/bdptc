<?php

// Configura el idioma seleccionado por el usuario.

// Almacena el nombre URL de la p�gina de procedencia
	$direccion = $_SERVER['HTTP_REFERER'];	

// Toma el idioma seleccionado
	$lenguaje_get=$_GET['lang'];


// Almacena el idioma en una variable de Sesi�n
	if($lenguaje_get=='ES')
	{
	session_start();
	$_SESSION["lang"] = "ES";
	} 
	else if($lenguaje_get=='EN')
	{
	session_start();
	$_SESSION["lang"] = "EN";
	}
	else { }

// Redirige a la p�gina de procedencia
	header("Location: $direccion");

?>
