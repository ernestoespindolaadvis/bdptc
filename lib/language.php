<?php

// Libreria para el control del idioma del sitio / v1 / ene 2010

// Por default español
if (!$lang){
	$nombre_sitio = "Sistema Iberoamericano de Conocimiento en Juventud";
	$menu_inicio ="Portada";
	$menu_acerca = "Acerca";
	$menu_contacto = "Contacto"; 
}

// Portugues
if ($lang == "pt"){
	$nombre_sitio = "Conhecimento do Sistema Iberoamericana de Juventude";
	$menu_inicio ="Home";
	$menu_acerca = "Sobre";
	$menu_contacto = "Contato";
}


?>
