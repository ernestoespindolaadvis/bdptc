<?php

// Cargamos variables
require ("aut_config.inc.php");
// le damos un mobre a la sesion (por si quisieramos identificarla)
session_name($usuarios_sesion);
// iniciamos sesiones
session_start();
// destruimos la session de usuarios.
session_destroy();
?>
<html>
<head>
<title>Salir</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<body>


<script>
	//document.location.href('index.php');
</script>

</body>
</html>
