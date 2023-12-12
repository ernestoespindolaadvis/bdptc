<?php

// library
	include '../lib/lib.php';
	//error_reporting(E_ALL^E_NOTICE);
	
// connect mysql
	ConectaDB_ptc();
	
// sql query por default
	$qry = "SELECT pg.id, pg.nombre, ps.pais, pg.web 
	FROM programas pg, paises ps 
	WHERE pg.pais = ps.id ORDER BY ps.pais, pg.nombre ASC";

// for search
	$q = "";
	if($_REQUEST['q']!="")
	{
		$q = $_REQUEST['q'];
		//$qry .=" where nombre like '%$q%'";
		$qry = "SELECT pg.id, pg.nombre, ps.pais, pg.web FROM programas pg, paises ps 
		WHERE pg.nombre like '%$q%'
		and pg.pais = ps.id 
		ORDER BY ps.pais, pg.nombre ASC";
		
		// msg criterio
		$msg = "Resultados para : '".$q."'";
	}
    
// ejecuto q
	$result=QueryDB($qry);    

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Base de datos de programas de protecci&oacute;n social no contributiva Am&eacute;rica Latina y el Caribe </title>
<style type="text/css">
<!--
.style1 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 14px;
	color: #0099FF;
}
.style2 {
	font-family: Arial, Helvetica, sans-serif;
	color: #666666;
	font-weight: bold;
}
.style4 {
	font-family: Arial, Helvetica, sans-serif;
	color: #666666;
	font-size: 12px;
}
.style5 {
	font-family: Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: 14px;
}
-->
</style>
</head>

<body>
<span class="style2">Base de datos de programas de protecci&oacute;n social no contributiva Am&eacute;rica Latina y el Caribe</span>
<br />
<span class="style4">Divisi&oacute;n de Desarrollo Social, CEPAL</span>
<br />
<p class="style1">Web API. v.1 - marzo 2011</p>
<p>
<!-- ini result -->
<span class="style5">Programas</span></p>
	<p class="style4"><?php echo $msg; ?></p>
<div class="style4">
<?php 
	if(mysql_num_rows($result)!=0)
    {
    	$counter = $starting + 1;
        while($data = mysql_fetch_array($result)) 
        { 
		$pais=$data['pais'];
        echo $counter;
        echo " <a href='/bdptc/programa/?id=".$data['id']."'>" .$data['nombre'] . "</a> - ".$pais;
        echo "<br><br>";
        $counter ++;
        }
     }else{ 
        echo "No Data Found";
     }
?>
<!-- fin result -->    
</div>
</body>
</html>
<?php DesconectaDB(); ?>
