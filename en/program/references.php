<?php

//VALIDACION
if (is_numeric($id)) { } else {	exit(); }

	session_start();
	$_SESSION["lang"] = "EN";

// library
	include '../../lib/lib.php';
	//error_reporting(E_ALL^E_NOTICE);
	
// connect mysql
	ConectaDB_ptc();
	
// Consult program

if($id)
{

// Q name programa
	$query="select * from programas where id=$id";
	$p=QueryDB($query);
	$row_prog=TraeArrayDB($p);

	// country name segun idioma
	if ($lang == 'ES' || $lang=='')
	{
		$qprog = $row_prog[nombreES];
		$pais=traeRegistroDB("paises","id","$row_prog[pais]","paisES");
		
	}else{
		
		$qprog = $row_prog[nombreEN];
		$pais=traeRegistroDB("paises","id","$row_prog[pais]","paisEN");
	}	

	// Datos
	if($row_prog[archivo_electronico]){$archivo="<a href=\"http://$URL_SITIO$PATH_ARCHIVOS_WEB_RECURSOS/$id/$row_prog[archivo_electronico]\"><img src=\"../../images/$imgexcel\" title=\"Expenditure data, coverage and amount of money transfers\" border=\"0\" align=\"absbottom\" /></a>";}
	
	
	
// Q num componentes
	$q_num_comp = "SELECT count(*) FROM componentes WHERE id_programa=$id";	
	$s=QueryDB($q_num_comp);
	$row_comp=TraeArrayDB($s);
	$total_comp = $row_comp[0];
	

// Q num Referencias
	$q_ref = "SELECT count(*) FROM referencias WHERE id_programa=$id";	
	$r=QueryDB($q_ref);
	$row_ref=TraeArrayDB($r);
	$total_ref = $row_ref[0];
	

// Block referencias
	$num1=0;
	$q_refe = "SELECT * FROM referencias WHERE id_programa=$id";
	$q=QueryDB($q_refe);

// Recorrido registros
	while($row=TraeArrayDB($q))
	{
		$num1++;
		// limpiamos variables para q no almacene registrso anteriores
		$fecha = "";
		$autor = "";
		$titulo = "";
		$datopub="";
		$link = "";
		$tema = "";

		// General	
		
		if ($lang == 'ES' || $lang=='')
		{
			
			$lblfecha = "Fecha";
			$lblautor = "Autor/es";
			$lbltitulo = "Título";
			$lbldatopub = "Datos de publicación";
			$lbltema = "Tema";
			
			$cfecha = $row[fechaES];
			$cautor = $row[autorES];
			$ctitulo = $row[tituloES];
			$cpub = $row[datopubES];
			$ctema = $row[temaES];
		}
		else
		{
			$lblfecha = "Date";
			$lblautor = "Author";
			$lbltitulo = "Title";
			$lbldatopub = "Publication info";
			$lbltema = "Topic";		
			
			$cfecha = $row[fechaEN];
			$cautor = $row[autorEN];
			$ctitulo = $row[tituloEN];
			$cpub = $row[datopubEN];
			$ctema = $row[temaEN];
		}	
		
		if($cfecha){$fecha = "<span class='subtitle'>$lblfecha</span>: <span class='txt-normal'>".$cfecha."</span><br>";}
		if($cautor){$autor = "<span class='subtitle'>$lblautor</span>: <span class='txt-normal'>".$cautor."</span><br>";}
		if($ctitulo){$titulo = "<span class='subtitle'>".$ctitulo."</span><br>";}
		if($cpub){$datopub="<span class='subtitle'>$lbldatopub</span>:<br> <span class='txt-normal'>".$cpub."</span><br>";}
		if($row[link]){$link = "<a href='".$row[link]."' target='_blank'>Link</a>";}
		if($ctema){$tema = "<span class='subtitle'>$lbltema</span>:<br><span class='txt-normal'>".$ctema."</span>";}
		
		$txt_referencias.=<<<END

		<ul class="list">
		<li>	
				<!-- $num1 - -->
				$titulo
				$autor
				$fecha
				$datopub | <strong>$link</strong><br>
				$tema
		</li>
		</ul>
END;
		$num++;
	}

}

// Close connect
	DesconectaDB();
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xml:lang="en" xmlns="http://www.w3.org/1999/xhtml" dir="ltr">
<head>
<title>Conditional Cash Transfer Programmes - Non-contributory social protection programmes in Latin America and the Caribbean database</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="../../css/style-bdptc.css" type="text/css" media="screen, projection">
<link rel="stylesheet" type="text/css" href="../../css/style.css" />
<link rel="stylesheet" type="text/css" href="../../css/menu-tab.css" />

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
	text-decoration:underline;
}
.linkstyle1 a:hover {
	color: #FFFFFF;
	text-decoration: none;
}
-->
</style>
</head>
<body>
<div id="container" class="doublecol">
  <table width="790" border="0" cellspacing="1" cellpadding="3" style="color: #FFFFFF; font-family:Arial, Helvetica, sans-serif; font-size:12px;" class="linkstyle1">
    <tr>
      <td width="82" align="center" bgcolor="#6AC0D2"><a href="../../../bpsnc/index-en.php">Home</a></td>
      <td width="227" align="center" bgcolor="#96BE58" ><strong>Conditional Cash Transfer<br />
      Programmes</strong></td>
      <td width="195" align="center" bgcolor="#EEA51E"><a href="../../../bdps/en">Social Pensions</a></td>
      <td width="262" align="center" bgcolor="#E9741D"><a href="../../../bdilp/en">Labour and Productive Inclusion <br />
      Programmes</a></td>
    </tr>
  </table>
  <div id="header">
    <h1><?php echo $nombre_sitio; ?></h1>
    <h3><?php echo $bajada_sitio; ?></h3>
  </div>

    <div id="navigation">
       <ul>
         <li><a href="../."><?php echo $menu_inicio; ?></a></li>
         <li><a href="../glossary.php"><?php echo $menu_glosario; ?></li>
         <li><a href="../contact.php"><?php echo $menu_acerca; ?></a></li>
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
        <h2><a href="#" title="Permalink"><?php echo $qprog; ?></a>
        <br><span class="txt-normal"><?php echo $pais; ?></span></h2>
        
   	  </div>
         <div id="page_contents">
         <table width="100%" border="0" height="43px">
           <tr>
             <td width="75%">
            <ul class="basictab">
                  <li><a href="./?id=<?php echo $id; ?>">General</a></li>
                  <li><a href="./components.php?id=<?php echo $id; ?>"><?php echo $tabcompon; ?> (<?php echo $total_comp; ?>)</a></li>
                  <li class="selected"><a href="#"><?php echo $tabref; ?>  (<?php echo $total_ref; ?>) </a></li>
              </ul> 
             </td>
             <td width="25%" align="center">
            <!-- ini file -->
            <?php echo $archivo;?>
           	<!-- fin file -->
            </td>
           </tr>
         </table>
         
        <!-- Program Data-->
	    <?php echo $txt_referencias;?>
        <!-- End program data -->
        
		<div style="text-align:right; border-top:1px solid #EFEFEF"><p><a href="#">Top</a></p></div>        
		
      </div>
  </div>

            <hr class="low">

            <div id="subcontent" class="column">
              <p class="opcion"><?php echo $cont_sub_titulo; ?></p>
  <form name="form1" method="post" action="../index.php">
                    <input type="text" name="q" value="" class="opform" />
                    <input type="hidden" name="lang" value="<?php echo $lang; ?>" />
                    <input type="submit" name="<?php echo $frm_btn_buscar; ?>" value="<?php echo $frm_btn_buscar; ?>" class="opform" />                    
              </form>
                
             <!-- 
             Ordenar por
                <form name="form2" method="post" action="index.php">
                    <select name="order" id="order" class="opform">
                      <option value="pais" <?php if($_REQUEST['order']=="pais") { echo "selected";} ?> >Pais</option>
                      <option value="nombre" <?php if($_REQUEST['order']=="nombre") { echo "selected";} ?> >Alfabetico</option>
                    </select>
                   <input type="submit" name="Ordenar" value="ordenar" class="opform" />
                </form>
              -->  
		</div>
<hr class="low">
            <div id="footer">
                <div id="footer-hack"></div>

                <p>
                <strong> <?php echo $foot_sitio; ?></strong>              </p>
                <p>
                <?php echo $foot_sponsor; ?>
                <img src="../../images/<? echo $imgfoot; ?>" border="0" align="absmiddle" usemap="#Map" />
                <map name="Map" id="Map">
                <area shape="rect" coords="-4,4,146,43" href="http://www.giz.de/en/" />
                <area shape="rect" coords="158,2,268,45" href="http://www.sida.se/English/" />
                <area shape="rect" coords="284,4,395,44" href="http://www.ipc-undp.org/" />
                </map>
                </p>	        <p><br>
		          <br>
  			      <br>
		          <!-- 
                    <a href="http://lettersandscience.net/Blix/"><strong>Blix</strong></a> theme.  Powered by 
                    <a href="http://wordpress.org/" title="Worpress"><strong>WordPress</strong></a> 2.9.2.
                 -->
		          <br>
		        </p>
  </div>
</div>
</body>
</html>