<?php
####################################
### SEGURIDAD
####################################

require ("../../lib/aut_verifica.inc.php");


####################################

include '../../lib/lib.php';

ConectaDB_ptc();

if($estado == "SI"){
	actualizaCampoDB("componentes","id",$id,$campo,"NO");
}else{
	actualizaCampoDB("componentes","id",$id,$campo,"SI");
}

$fecha_actual=hoy_hora();
actualizaCampoDB("componentes","id",$id,"fechaactualiza","$fecha_actual");


DesconectaDB();

?>

<script>
	document.location.href='listado.php?id_programa=<?php echo $id_programa; ?>&mensaje= Registro ha cambiado de Estado !';
</script>
