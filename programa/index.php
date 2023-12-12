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

// Q programa
	$query="select * from programas where id=$id";
	$p=QueryDB($query);
	$row=TraeArrayDB($p);
	// country name
	$pais=traeRegistroDB("paises","id","$row[pais]","paisES");


// Q componentes
	$q_comp = "SELECT count(*) FROM componentes WHERE id_programa=$id";
	$q=QueryDB($q_comp);
	$row_comp=TraeArrayDB($q);
	$total_comp = $row_comp[0];
	
// Q Referencias
	$q_ref = "SELECT count(*) FROM referencias WHERE id_programa=$id";	
	$r=QueryDB($q_ref);
	$row_ref=TraeArrayDB($r);
	$total_ref = $row_ref[0];
	

// General config campos segun idioma

	if ($lang =='ES' || $lang =='') 
	{ 


		$lbldate = "Periodo";
		$lbldesc = "Descripción";
		$lblpob = "Población meta";
		$lblgeo = "Escala geográfica";
		$lblfoc = "Método de focalización";
		$lblsel = "Instrumento selección";
		$lblreg = "Registro de Destinatarios";
		$lblcrit = "Criterios de egreso o salida";
		$lblcom = "Comentarios";
		$lblsan = "Sanciones";
		$lblleg = "Marco legal";
		$lblorgr = "Organismo responsable";
		$lblorge = "Organismo(s) ejecutor(es)";
		$lblorgrbenef = "Organismo responsable del registro de usuarios";
		$lblfuen = "Fuentes de financiamiento";
		$lblcarac = "Características";
		$lblinsti = "Institucionalidad";
		
				
		$encabezado = $row[nombreES];
		$progdate = $row[periodoES];
		$prgdescrip = $row[descripcionES];
		$prgmeta = $row[pobmetaES];
		$prgescala = $row[escalageoES];
		$prgfocal = $row[metodofocalES];
		$prgselec = $row[instrumentoselecES];
		$prgbenefi = $row[beneficiariosES];
		$prgegreso = $row[criteriosegresoES];
		$prgcomen = $row[comentariosES];
		$prgsancion = $row[sancionesES];
		$prglegal = $row[marcolegalES];
		$prgresp = $row[orgresponsableES];
		$prgejec = $row[orgejecutorES];
		$prgrespbenef = $row[orgrespbenefES];
		$prgfte = $row[fuentefinanES];
		
	} 
	else 
	{
		
		$lbldate = "Date";
		$lbldesc = "Description";
		$lblpob = "Target population";
		$lblgeo = "Geographic scale";
		$lblfoc = "Targeting method";
		$lblsel = "Instrument of selection";
		$lblreg = "Registry of beneficiaries";
		$lblcrit = "Exit strategies or criteria";
		$lblcom = "Comments";
		$lblsan = "Sanctions";
		$lblleg = "Legal framework";
		$lblorgr = "Responsible organization(s)";
		$lblorge = "Executing organization(s)";
		$lblorgrbenef = "Responsible organization(s) for the registry of recipients";
		$lblfuen = "Source of funding";
		$lblcarac = "Characteristics";
		$lblinsti = "Institutionality";
		
		
		$encabezado=$row[nombreEN];
		$progdate = $row[periodoEN];
		$prgdescrip = $row[descripcionEN];
		$prgmeta = $row[pobmetaEN];
		$prgescala = $row[escalageoEN];
		$prgfocal = $row[metodofocalEN];
		$prgselec = $row[instrumentoselecEN];
		$prgbenefi = $row[beneficiariosEN];
		$prgegreso = $row[criteriosegresoEN];
		$prgcomen = $row[comentariosEN];
		$prgsancion = $row[sancionesEN];
		$prglegal = $row[marcolegalEN];
		$prgresp = $row[orgresponsableEN];
		$prgejec = $row[orgejecutorEN];
		$prgrespbenef = $row[orgrespbenefEN];
		$prgfte = $row[fuentefinanEN];
		
	}	
	
	
	// Datos
	if($row[archivo_electronico]){$archivo="<a href=\"http://$URL_SITIO$PATH_ARCHIVOS_WEB_RECURSOS/$id/$row[archivo_electronico]\"><img src=\"../images/$imgexcel\" alt=\"Datos sobre gasto, cobertura y monto de las transferencias monetarias\" title=\"Datos sobre gasto, cobertura y monto de las transferencias monetarias\" border=\"0\" align=\"absbottom\" /></a>";}
	if($progdate){$periodo = "<span class='subtitle'>$lbldate</span>: <span class='txt-normal'>".$progdate."</span><br>";}
	if($row[web]){$web_program = "<a href=".$row[web]." target='_blank'><strong>Web</strong></a><br>";}
	if($prgdescrip){$describe_program = "<span class='subtitle'>$lbldesc</span>:<br><span class='txt-normal'>".$prgdescrip."</span><br>";}

	$txt_general.=<<<END

		<ul class="list">
		<li>	
				$periodo				
				$web_program
				$grupo_objetivo
				$describe_program
		</li>
		</ul>
END;

// Caracts
	if($prgmeta){$pobmeta = "<span class='subtitle'>$lblpob</span>:<br> <span class='txt-normal'>".$prgmeta."</span><br>";}
	if($prgescala){$escalageo = "<span class='subtitle'>$lblgeo</span>:<br><span class='txt-normal'>".$prgescala."</span><br>";}
	if($prgfocal){$metodofocal = "<span class='subtitle'>$lblfoc</span>:<br> <span class='txt-normal'>".$prgfocal."</span><br>";}
	if($prgselec){$instrumentoselec = "<span class='subtitle'>$lblsel</span>:<br><span class='txt-normal'>".$prgselec."</span><br>";}
	if($prgbenefi){$beneficiarios="<span class='subtitle'>$lblreg</span>:<br> <span class='txt-normal'>".$prgbenefi."</span><br>";}
	if($prgegreso){$criteriosegreso = "<span class='subtitle'>$lblcrit</span>:<br><span class='txt-normal'>".$prgegreso."</span><br>";}
	if($prgcomen){$comentarios = "<span class='subtitle'>$lblcom</span>:<br><span class='txt-normal'>".$prgcomen."</span><br>";}
	if($prgsancion){$sanciones = "<span class='subtitle'>$lblsan</span>:<br><span class='txt-normal'>".$prgsancion."</span><br>";}

	$txt_caracts.=<<<END

		<ul class="list">
		<li>	
				$pobmeta
				$escalageo
				$metodofocal
				$instrumentoselec				
				$beneficiarios
				$criteriosegreso
				$comentarios
				$sanciones
		</li>
		</ul>
END;

// Institucionalidad
	if($prglegal){$marcolegal = "<span class='subtitle'>$lblleg</span>:<br><span class='txt-normal'>".$prglegal."</span><br>";}
	if($prgresp){$orgresponsable = "<span class='subtitle'>$lblorgr</span>:<br> <span class='txt-normal'>".$prgresp."</span><br>";}
	if($prgejec){$orgejecutor = "<span class='subtitle'>$lblorge</span>:<br><span class='txt-normal'>".$prgejec."</span><br>";}
		if($prgrespbenef){$orgrespbeneficiarios = "<span class='subtitle'>$lblorgrbenef</span>:<br><span class='txt-normal'>".$prgrespbenef."</span><br>";}
	if($prgfte){$fuentefinan = "<span class='subtitle'>$lblfuen</span>:<br><span class='txt-normal'>".$prgfte."</span><br>";}

	$txt_institucionalidad.=<<<END

		<ul class="list">
		<li>	
				$marcolegal
				$orgresponsable
				$orgejecutor
					$orgrespbeneficiarios
				$fuentefinan
		</li>
		</ul>
END;

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
         <li><a href="../glosario.php"><?php echo $menu_glosario; ?></a></li>
         <li><a href="../contacto.php"><?php echo $menu_acerca; ?></a></li>
      </ul>

    	<div style="clear: both;"></div>
    </div>

	<div id="content" class="column">
    	<div class="entry">
        <h2><a href="#" title="Permalink"><?php echo $encabezado; ?></a>
        <br><span class="txt-normal"><?php echo $pais; ?></span></h2>
        
   	  </div>
         <div id="page_contents">
         <table width="100%" border="0" height="43px">
           <tr>
             <td width="75%">
    <ul class="basictab">
                  <li class="selected"><a href="#">General</a></li>
                  <li><a href="./componentes.php?id=<?php echo $id; ?>"><?php echo $tabcompon; ?> (<?php echo $total_comp; ?>)</a></li>
                  <li><a href="./referencias.php?id=<?php echo $id; ?>"><?php echo $tabref; ?> (<?php echo $total_ref; ?>) </a></li>
              </ul> 
             </td>
            <td width="25%" align="center" valign="top">
            <!-- ini file -->
            <?php echo $archivo; ?>
           	<!-- fin file -->
           	
           	</td>
           </tr>
         </table>
         
        <!-- Program Data-->
            <?php echo $txt_general;?>
            
            <strong><?php echo $lblcarac; ?> : </strong>
            <?php echo $txt_caracts; ?>
            
            <strong><?php echo $lblinsti; ?> : </strong>
            <?php echo $txt_institucionalidad; ?>
            
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
                

		</div>
<hr class="low">
            <div id="footer">
                <div id="footer-hack"></div>

                <p><strong> <?php echo $foot_sitio; ?></p>
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


