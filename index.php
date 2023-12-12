<?php

	session_start();
	$_SESSION["lang"] = "ES";

// library
	include 'lib/lib.php';
	//error_reporting(E_ALL^E_NOTICE);
	
// include class 
	include('class/pagination_class.php');
	
// connect mysql
	ConectaDB_ptc();


//Control de actualiacion HTML CSS
	// Refresca página solo una vez por IP
	if (getenv("HTTP_X_FORWARDED_FOR")) { $IP_actual=getenv("HTTP_X_FORWARDED_FOR"); } else { $IP_actual=getenv("REMOTE_ADDR"); }
	$q_actualiza = "select ip from control_actualiza where version='1' and ip='$IP_actual' and pagina='bdptc' ";
	$p_actualiza=QueryDB($q_actualiza);
	While ($row_act=TraeArrayDB($p_actualiza))
	{
		$ip_basedato=$row_act[ip];
	}
	if($ip_basedato=='') 
	{ 
		$ejecuta_actualiza=1;
		$query_update = "insert into control_actualiza(ip,fecha,pagina,version) values ('$IP_actual',NOW(),'bdptc','1')";
		QueryDB($query_update);
	}
	else 
	{ 
		$ejecuta_actualiza=0;
	}	
//echo"$IP_actual / $ip_basedato / $ejecuta_actualiza "; //control
// FIN Control de actualiacion HTML CSS

	
// sql query por default

	// q segun lang
if ($lang =='ES' || $lang =='')
{
	
	// genero select pais
	$qpais = "select id, paisES from paises where id IN (select pais from programas) order by paisES ASC";
	$p=QueryDB($qpais);
	
	While ($row=TraeArrayDB($p))
	{
	
	if($row[id]){$idpais = $row[id];}
	if($row[paisES]){$pais = "<a href=./pais/?id=".$row[id].">".$row[paisES]."</a><br>";}

	$txt_general.=<<<END
		<span class="txt-menor">$pais</span>
END;
	}
	
	
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

	
	// genero select pais
	$qpais = "select id, paisEN from paises where id IN (select pais from programas) order by paisEN ASC";
	$p=QueryDB($qpais);
	
	While ($row=TraeArrayDB($p))
	{
	
	if($row[id]){$idpais = $row[id];}
	if($row[paisEN]){$pais = "<a href=./pais/?id=".$row[id].">".$row[paisEN]."</a><br>";}

	$txt_general.=<<<END
		<span class="txt-menor">$pais</span>
END;
	}	
	
	
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
	$starting=0;
	$recpage = 10; //number of records per page

	$obj = new pagination_class($qry,$starting,$recpage);		
	$result = $obj->result;
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xml:lang="en" xmlns="http://www.w3.org/1999/xhtml" dir="ltr">
<head>
<title>Programas de transferencias condicionadas - Base de datos de programas de asistencia social en Am&eacute;rica Latina y el Caribe</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="css/style-bdptc.css" type="text/css" media="screen, projection">
<script language="JavaScript" src="js/pagination.js"></script>
<link rel="stylesheet" type="text/css" href="css/style.css" />

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-344516-10']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<style type="text/css">
<!--
.linkstyle1 a:link, .linkstyle1 a:visited {
	color: #FFFFFF;
	text-decoration: underline;
}
.linkstyle1 a:hover {
	color: #FFFFFF;
	text-decoration: none;
}
-->
</style>
<script language="JavaScript" >
<!-- 
function LoadOnce() 
{ 
    if(!window.location.hash) {
        window.location.reload();
        window.location = window.location + '#es';
    }
} 
//-->
</script>
</head>
<meta http-equiv="refresh" content="0;URL=https://dds.cepal.org/bpsnc/ptc">
<body <?php if($ejecuta_actualiza==1) { ?>onLoad="LoadOnce()"<?php } else {} ?> >
<div id="container" class="doublecol">
  <table width="790" border="0" cellspacing="1" cellpadding="3" style="color: #FFFFFF; font-family:Arial, Helvetica, sans-serif; font-size:12px;" class="linkstyle1">
    <tr>
      <td width="4%" align="center" bgcolor="#6AC0D2"><a href="../bpsnc">Inicio</a></td>
      <td width="24%" align="center" bgcolor="#96BE58"><strong>Programas de transferencias condicionadas</strong></td>
      <td width="24%" align="center" bgcolor="#EEA51E"><a href="../bdps">Pensiones sociales</a></td>
      <td width="24%" align="center" bgcolor="#E9741D"><a href="../bdilp">Programas de inclusi&oacute;n laboral y productiva</a></td>

    </tr>
  </table>
  <div id="header">
    <h1><?php echo $nombre_sitio; ?></h1>
    <h3><?php echo $bajada_sitio; ?></h3>
  </div>

    <div id="navigation">
       <ul>
         <li class="selected"><a href="./"><?php echo $menu_inicio; ?></a></li>
         <li><a href="./glosario.php"><?php echo $menu_glosario; ?></a></li>
         <li><a href="./contacto.php"><?php echo $menu_acerca; ?></a></li>
         <?php if(1==2) { ?><li><a title="Base Datos Pensiones Sociales" href="../bdps"><?php echo $nav_ps; ?></a></li>
		 <li><a title="Base Datos Programas de inclusión laboral productiva" href="../bdilp">ILP</a></li><?php } else { } ?>
       </ul>
          <!-- 
                <form action="http://lettersandscience.net/Blix/" method="get">
                    <fieldset>
                        <input name="s" id="s">
                        <input value="Go!" id="searchbutton" type="submit">
                    </fieldset>
                </form>
           -->
    	<div style="clear: both;"></div>
    </div>

	<div id="content" class="column">
    	<div class="entry">
        <h2><a href="#" title="Permalink"><?php echo $cont_titulo; ?></a></h2>
        <?php echo $msg; ?>
   	  </div>
      <div id="page_contents">
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
                        echo " <a href='programa/?id=".$data[0]."'>" .$data[1] . "</a> - <span class='txt-menor'>" .$pais."</span>";
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
      </div>
	</div>

            <hr class="low">

            <div id="subcontent" class="column">
            	<!-- op idioma -->
            	<?php 
				//echo $op_lang; 
				?>
				Español | <a href="en/">English</a>
            	
              <p class="opcion"><?php echo $cont_sub_titulo; ?></p>
  			
  			<form name="form1" method="post" action="index.php">
                    <input type="text" name="q" value="<?php echo $q; ?>" class="opform" />
                    <input type="hidden" name="lang" value="<?php echo $lang; ?>" />
                    <input type="submit" name="<?php echo $frm_btn_buscar; ?>" value="<?php echo $frm_btn_buscar; ?>" class="opform" />                    
            </form>
                
           
           <!--
                <?php echo $frm_btn_orden; ?>
               
                <form name="form2" method="post" action="index.php">
                    <select name="order" id="order" class="opform">
                      <option value="pais" <?php if($_REQUEST['order']=="pais") { echo "selected";} ?>><?php echo $frm_op_pais; ?></option>
                      <option value="nombre" <?php if($_REQUEST['order']=="nombre") { echo "selected";}?>><?php echo $frm_op_name; ?></option>
                    </select>
                    <input type="submit" name="<?php echo $frm_btn_orden; ?>" value="<?php echo $frm_btn_orden; ?>" class="opform" />
                </form>
           -->     
              
                <div style="border-top:1px solid #EFEFEF">
                <p class="opcion"><?php echo $cont_sub_pais; ?></p>
                  <div align="justify"><?php echo $txt_general; ?></div>
                </div>
  </div>
<hr class="low">
            <div id="footer">
                <div id="footer-hack"></div>

                <p>
                <strong><?php echo $foot_sitio; ?></strong>
              </p>
                <p>
                
                <?php echo $foot_sponsor; ?>
                
                <img src="images/<? echo $imgfoot; ?>" border="0" align="absmiddle" usemap="#Map" />
                <map name="Map" id="Map">
                <area shape="rect" coords="-4,4,146,43" href="http://www.giz.de/en/" />
                <area shape="rect" coords="158,2,268,45" href="http://www.sida.se/English/" />
                <area shape="rect" coords="284,4,395,44" href="http://www.ipc-undp.org/" />
                </map>
                
                </p> 
              <p><a href="admin/acceso.php">CMS</a></p>
  </div>
</div>
</body>
</html>
<?php DesconectaDB(); ?>
