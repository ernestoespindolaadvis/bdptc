<?php

function subirArchivo ($path_origen,$nombre_arch,$path_destino,$caso,$arch_old,$especial) { 

#Recibe cuatro parametros:
#arch: es la variable tipo file del formulario anterior.
#path: es el directorio en donde quedara el archivo
#caso: 0, es insertado por primera vez, 1: es modificado
#arch_old: es vacio si caso=0, y contiene el archivo anterior si caso=1.
#La funcion retorna el nombre del archivo.

#debemos crear el directorio, solo si es insertar
#y borrar archivo anterior si es modificar y borrar

	if($caso == "0"){
		if($especial == ""){ 
			if(is_dir($path_destino)){ 
				#print "Ya existe el Directorio $path_destino <br>";

			}else{
				#print "Creamos el Directorio $path_destino <br>";
				mkdir($path_destino,0755);
			}


			####mkdir($path_destino,0755);
			
		}
		chdir($path_destino);
	} else {

	
		#if(!(-e $path))      ### Definitivamente un parche feo
		if($path_destino){
			if(is_dir($path_destino)){ 
				#print "Ya existe el Directorio $path_destino <br>";

			}else{
				#print "Creamos el Directorio $path_destino <br>";
				mkdir($path_destino,0755);
			}
		#$isdir= is_file($path_destino);
		#print "ISDIR $isdir <br>\n";
		
		}

		chdir($path_destino);
		unlink($arch_old);
	}
	if(($caso == "0")||($caso == "1")){
		
		//print "ORIG $path_origen DEST $path_destino/$nombre_arch <br>\n";

		copy($path_origen, "$path_destino/$nombre_arch") or die("Imposible copiar archivo.");
		

		if($nombre_arch == ""){$nombre_arch = $arch_old;}
		
	} else {
		$nombre_arch = "";
	}
	return $nombre_arch;
}


function borra_archivo($path,$arch){

	chdir($path);
	if(unlink("$path/$arch")){
		//print "Borramos $arch";
	}
	#unlink("$path/$arch");
	
}

function hoy(){

	$hoy=date('Y-m-d'); ;
	return $hoy;
}

function hoy_hora(){

	$hoy_hra=date('Y-m-d H:i:s');
	return $hoy_hra;
}


?>
