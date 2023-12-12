<?php

//VALIDACION
if (is_numeric($id)) { } else {	exit(); }

// library
	include '../lib/lib.php';
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
	} else {
		$qprog = $row_prog[nombreEN];
		$pais=traeRegistroDB("paises","id","$row_prog[pais]","paisEN");
	}
	
	
	
	
	// Datos
	if($row_prog[archivo_electronico]){$archivo="<a href=\"http://$URL_SITIO$PATH_ARCHIVOS_WEB_RECURSOS/$id/$row_prog[archivo_electronico]\"><img src=\"../images/$imgexcel\" alt=\"Datos sobre gasto, cobertura y monto de las transferencias monetarias\" title=\"Datos sobre gasto, cobertura y monto de las transferencias monetarias\" border=\"0\" align=\"absbottom\" /></a>";}
	

	
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
	

// block componentes
	$num1=0;
	if($id==30 or $id==27 or $id==39 or $id==151 or $id==52 or $id==150 or $id==153 ){
	$q_comp = "SELECT cp.* FROM componentes cp, programas p WHERE cp.id_programa = p.id and p.id=$id  order by cp.nombreES asc";
	} else {
	$q_comp = "SELECT cp.* FROM componentes cp, programas p WHERE cp.id_programa = p.id and p.id=$id  ";
	}
	$q=QueryDB($q_comp);
	//$row=TraeArrayDB($q);

// Recorrido registros
	while($row=TraeArrayDB($q))
	{
		
		$num1++;
		// limpiamos variables para q no almacene registrso anteriores
		$nombre ='';
		$destinatarios ='';
		$modalidad = '';
		$formaentrega = '';
		$periodoentrega = '';
		$receptor = '';
		$limitefamilia = '';
		$corresponsabilidad  = '';
		$sanciones  = '';
		$comentarios = '';
		$descripcion = '';
		$montos = '';

		
		// General	
		if ($lang=='ES' || $lang=='')
		{
			
			$lblbene = "Destinatarios";
			$lblmod = "Modalidad de transferencia";
			$lblentre = "Forma de entrega";
			$lblperiod = "Periodicidad de entrega";
			$lblmax = "Máximo por familia";
			$lblcorres = "Corresponsabilidades";
			$lblsancion = "Sanciones";
			$lblcoment = "Comentarios";
			$lbldescrip = "Descripción";
			$lblmonto = "Montos";
			
			$cname = $row[nombreES];
			$cdestina = $row[destinatariosES];
			$cmodal = $row[modalidadES];
			$cfentrega = $row[formaentregaES];
			$cpentrega =$row[periodoentregaES];
			$crecep = $row[receptorES];
			$climite = $row[limitefamiliaES];
			$ccorres = $row[corresponsabilidadES];
			$csancion = $row[sancionesES];
			$ccoment = $row[comentariosES];
			$cdescrip = $row[descripcionES];
			$cmontos = $row[montosES];
		}
		else
		{
			
			$lblbene = "Recipient(s)";
			$lblmod = "Mode of transfer";
			$lblentre = "Mode of delivery";
			$lblperiod = "Periodicity of delivery";
			$lblmax = "Maximum per household";
			$lblcorres = "Conditionalities";
			$lblsancion = "Sanctions";
			$lblcoment = "Comments";
			$lbldescrip = "Description";
			$lblmonto = "Amount";
			
			$cname = $row[nombreEN];
			$cdestina = $row[destinatariosEN];
			$cmodal = $row[modalidadEN];
			$cfentrega = $row[formaentregaEN];
			$cpentrega =$row[periodoentregaEN];
			$crecep = $row[receptorEN];
			$climite = $row[limitefamiliaEN];
			$ccorres = $row[corresponsabilidadEN];
			$csancion = $row[sancionesEN];
			$ccoment = $row[comentariosEN];
			$cdescrip = $row[descripcionEN];
			$cmontos = $row[montosEN];
		}	
		
		if($cname){$nombre = "<strong>".$cname."</strong>";}
		if($cdestina){$destinatarios = "<span class='subtitle'>$lblbene</span>:<br><span class='txt-normal'>".$cdestina."</span>";}
		if($cmodal){$modalidad = "<span class='subtitle'>$lblmod</span>:<br><span class='txt-normal'>".$cmodal."</span><br />";}
		if($cfentrega){$formaentrega="<span class='subtitle'>$lblentre</span>: <span class='txt-normal'>".$cfentrega."</span><br />";}
		if($cpentrega){$periodoentrega = "<span class='subtitle'>$lblperiod</span>: <span class='txt-normal'>".$cpentrega."</span><br />";}
		if($crecep){$receptor = "<span class='subtitle'>Receptor/a</span>: <span class='txt-normal'>".$crecep."</span><br />";}
		if($climite){$limitefamilia = "<span class='subtitle'>$lblmax</span>: <span class='txt-normal'>".$climite."</span><br />";}
		if($ccorres){$corresponsabilidad = "<span class='subtitle'>$lblcorres</span>:<br><span class='txt-normal'>".$ccorres."</span><br />";}
		if($csancion){$sanciones = "<span class='subtitle'>$lblsancion</span>:<br><span class='txt-normal'>".$csancion."</span><br />";}
		if($ccoment){$comentarios = "<span class='subtitle'>$lblcoment</span>:<br><span class='txt-normal'>".$ccoment."</span><br />";}
		if($cdescrip){$descripcion = "<span class='subtitle'>$lbldescrip</span>:<br><span class='txt-normal'>".$cdescrip."</span><br />";}
		if($cmontos){$montos = "<span class='subtitle'>$lblmonto </span>:<span class='txt-normal'>".$cmontos."</span>";}
		
		$txt_componentes.=<<<END

		<ul class="list">
		<li>	
				<!-- $num1 - -->
				$nombre<br />
				$destinatarios<br />
				$modalidad				
				$formaentrega
				$periodoentrega
				$receptor
				$limitefamilia
				$corresponsabilidad
				$sanciones
				$comentarios
				$descripcion
				$montos				
		</li>
		</ul>
END;
	}

}

// Close connect
	DesconectaDB();
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xml:lang="en" xmlns="http://www.w3.org/1999/xhtml" dir="ltr">
<head>
<title>Programas de transferencias condicionadas - Base de datos de programas de asistencia social en Am&eacute;rica Latina y el Caribe</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="../css/style-bdptc.css" type="text/css" media="screen, projection">
<link rel="stylesheet" type="text/css" href="../../css/style.css" />
<link rel="stylesheet" type="text/css" href="../css/menu-tab.css" />

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
</head>
<body>
<div id="container" class="doublecol">
  <table width="790" border="0" cellspacing="1" cellpadding="3" style="color: #FFFFFF; font-family:Arial, Helvetica, sans-serif; font-size:12px;" class="linkstyle1">
    <tr>
      <td width="82" align="center" bgcolor="#6AC0D2"><a href="../../bpsnc">Inicio</a></td>
      <td width="224" align="center" bgcolor="#96BE58"><strong>Programas de transferencias condicionadas</strong></td>
      <td width="189" align="center" bgcolor="#EEA51E"><a href="../../bdps">Pensiones sociales</a></td>
      <td width="271" align="center" bgcolor="#E9741D"><a href="../../bdilp">Programas de inclusi&oacute;n laboral y productiva</a></td>
    </tr>
  </table>
  <div id="header">
    <h1><?php echo $nombre_sitio; ?></h1>
    <h3><?php echo $bajada_sitio; ?></h3>
  </div>

    <div id="navigation">
       <ul>
         <li><a href="../."><?php echo $menu_inicio; ?></a></li>
         <li><a href="../glosario.php"><?php echo $menu_glosario; ?></li>
         <li><a href="../contacto.php"><?php echo $menu_acerca; ?></a></li>
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
             <td width="79%">
<ul class="basictab">
                  <li><a href="./?id=<?php echo $id; ?>">General</a></li>
                  <li class="selected"><a href="#"><?php echo $tabcompon; ?>(<?php echo $total_comp; ?>)</a></li>
                  <li><a href="./referencias.php?id=<?php echo $id; ?>"><?php echo $tabref; ?> (<?php echo $total_ref; ?>) </a></li>
              </ul> 
             </td>
             <td width="21%" align="center">
            <!-- ini file -->
            <?php echo $archivo;?>
           	<!-- fin file -->
            </a>
            </td>
           </tr>
         </table>
         
        <!-- Program Data-->
    	<?php echo $txt_componentes;?>
        <!-- End program data -->

		<div style="text-align:right; border-top:1px solid #EFEFEF"><p><a href="#">Subir</a></p></div>
		
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
                <img src="../images/<? echo $imgfoot; ?>" border="0" align="absmiddle" usemap="#Map" />
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


