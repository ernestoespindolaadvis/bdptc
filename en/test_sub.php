<?php

$lang="EN";

// library
	include '../lib/lib.php';
	//error_reporting(E_ALL^E_NOTICE);
	
// include class 
	include('../class/pagination_class.php');
	
// connect mysql
	ConectaDB_ptc();
	
// sql query por default

if ($lang =='ES' || $lang =='')
{

	$qry = "SELECT pg.id, pg.nombreES, ps.paisES, pg.web 
	FROM programas pg, paises ps 
	WHERE pg.pais = ps.id 
	AND pg.tipo = 1
	ORDER BY ps.paisES, pg.nombreES ASC";

	// for search
	$q = "";
	if($_REQUEST['q']!="")
	{
		$q = $_REQUEST['q'];
		//$qry .=" where nombre like '%$q%'";
		$qry = "SELECT pg.id, pg.nombreES, ps.paisES, pg.web 
		FROM programas pg, paises ps 
		WHERE pg.nombreES like '%$q%'
		AND pg.tipo = 1
		AND pg.pais = ps.id 
		ORDER BY ps.paisES, pg.nombreES ASC";
		
		// msg criterio
		$msg = "Resultados para : '".$q."'";
	}

}
else
{

	
	$qry = "SELECT pg.id, pg.nombreEN, ps.paisEN, pg.web 
	FROM programas pg, paises ps 
	WHERE pg.pais = ps.id 
	AND pg.tipo = 1
	ORDER BY ps.paisES, pg.nombreES ASC";

	// for search
	$q = "";
	if($_REQUEST['q']!="")
	{
		$q = $_REQUEST['q'];
		//$qry .=" where nombre like '%$q%'";
		$qry = "SELECT pg.id, pg.nombreEN, ps.paisEN, pg.web FROM programas pg, paises ps 
		WHERE pg.nombreEN like '%$q%'
		AND pg.tipo = 1 
		AND pg.pais = ps.id 
		ORDER BY ps.paisEN, pg.nombreEN ASC";
		
		// msg criterio
		$msg = "Query result : '".$q."'";
	}

}


	
	//echo $qry;
//for pagination
if(isset($_GET['starting'])&& !isset($_REQUEST['submit'])){
	$starting=$_GET['starting'];
}else{
	$starting=0;
}
$recpage = 10;//number of records per page
	
$obj = new pagination_class($qry,$starting,$recpage);		
$result = $obj->result;

?>


<?php
	if(mysql_num_rows($result)!=0)
    {
    	$counter = $starting + 1;
        while($data = mysql_fetch_array($result)) 
        { 
			// country name
            //$pais=traeRegistroDB("paises","id","$data[pais]","pais");
			$pais=$data[2];
            echo $counter;
            echo " <a href='program/?id=".$data[0]."'>" .$data[1] . "</a> - <span class='txt-menor'>" .$pais."</span>";
            echo "<br><br>";
            $counter ++;
		}	
		
		echo $obj->anchors;
        echo $obj->total;	 
	}else{ 
		echo "No Data Found";
	}
?>
<!-- fin result -->
<?php DesconectaDB(); ?>
</div>
</body>
</html>

