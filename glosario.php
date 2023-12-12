<?php

// library
	include 'lib/lib.php';
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xml:lang="en" xmlns="http://www.w3.org/1999/xhtml" dir="ltr">
<head>
<title>Programas de transferencias condicionadas - Base de datos de programas de asistencia social en Am&eacute;rica Latina y el Caribe</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="css/style-bdptc.css" type="text/css" media="screen, projection">
<script language="JavaScript" src="../js/pagination.js"></script>
<link rel="stylesheet" type="text/css" href="../css/style.css" />
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
.td_titulo {	color: #333333;
	font-family:Arial, Helvetica, sans-serif;
	font-size:16px;
	font-weight:bold;
}
.td_titulo_descripcion {	color: #333333;
	font-family:Arial, Helvetica, sans-serif;
	font-size:14px;
}
.tablaglosario td {
	color: #333333;
	border-bottom:1px solid #dddddd;
	font-family:Arial, Helvetica, sans-serif;
	font-size:12px;
	padding:10px 20px 0 20px;
}
#container {
  background:white url(images/container_bg.gif) 816px 0px repeat-y;
}
.enlace_glosario {	font-weight: bold;
	color: #78992B;
}
-->
</style>
</head>
<body>
<div id="container" class="doublecol">
  <table width="790" border="0" cellspacing="1" cellpadding="3" style="color: #FFFFFF; font-family:Arial, Helvetica, sans-serif; font-size:12px;" class="linkstyle1">
    <tr>
      <td width="82" align="center" bgcolor="#6AC0D2"><a href="../bpsnc">Inicio</a></td>
      <td width="224" align="center" bgcolor="#96BE58"><strong>Programas de transferencias condicionadas</strong></td>
      <td width="189" align="center" bgcolor="#EEA51E"><a href="../bdps">Pensiones sociales</a></td>
      <td width="271" align="center" bgcolor="#E9741D"><a href="../bdilp">Programas de inclusi&oacute;n laboral y productiva</a></td>
    </tr>
  </table>
  <div id="header">
    <h1><?php echo $nombre_sitio; ?></h1>
    <h3><?php echo $bajada_sitio; ?></h3>
  </div>

    <div id="navigation">
       <ul>
         <li><a href="./"><?php echo $menu_inicio; ?></a></li>
         <li class="selected"><a href="./glosario.php"><?php echo $menu_glosario; ?></a></li>
         <li><a href="./contacto.php"><?php echo $menu_acerca; ?></a></li>
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

	<div id="content" class="column" style="width:750px;">
    	<div class="entry">
        <h2><a href="#" title="Permalink"><?php echo $pg_glosario; ?></a></h2>

        <p>Este glosario define los t&eacute;rminos utilizados en las distintas secciones (&ldquo;General&rdquo;, &ldquo;Componentes&rdquo;, &ldquo;Referencias&rdquo; y &quot;Datos en Excel&quot;) de la Base de datos de los programas de protecci&oacute;n social no contributiva en Am&eacute;rica Latina y el Caribe. </p>
        <table width="100%" cellpadding="0" cellspacing="0" class="tablaglosario">
          <tr bgcolor="#CBDCA5">
            <td colspan="2" valign="top"><p align="center" class="td_titulo">1. General </p></td>
          </tr>
          <tr>
            <td width="14%" valign="top"><p> Periodo </p></td>
            <td width="86%" valign="top"><p> A&ntilde;o de inicio y cierre del programa (si es que no se encuentra en implementaci&oacute;n). </p></td>
          </tr>
          <tr>
            <td valign="top"><p> Web </p></td>
            <td valign="top"><p> Enlace a la p&aacute;gina web oficial del programa. </p></td>
          </tr>
          <tr>
            <td valign="top"><p> Descripci&oacute;n </p></td>
            <td valign="top"><p> Informaci&oacute;n general del programa, tal como: objetivos, destinatarios, a&ntilde;o de creaci&oacute;n, vinculaci&oacute;n con alguna estrategia global de reducci&oacute;n de pobreza o de mejoramiento de las condiciones de vida, entre otros aspectos. </p></td>
          </tr>
          <tr bgcolor="#FBF7E3">
            <td colspan="2" valign="top"><p align="center"><strong> Caracter&iacute;sticas </strong></p></td>
          </tr>
          <tr>
            <td valign="top"><p> Poblaci&oacute;n meta </p></td>
            <td valign="top"><p> Poblaci&oacute;n objetivo, cuyas condiciones de vida se buscan mejorar a trav&eacute;s del programa. </p></td>
          </tr>
          <tr>
            <td valign="top"><p> &Aacute;mbito de acci&oacute;n </p></td>
            <td valign="top"><p> Incluye los posibles &aacute;mbitos de acci&oacute;n de acci&oacute;n de acuerdo con las caracter&iacute;sticas del programa (capacitaci&oacute;n t&eacute;cnica y profesional, nivelaci&oacute;n de estudios y retenci&oacute;n escolar, servicios de intermediaci&oacute;n laboral generaci&oacute;n directa de empleo, generaci&oacute;n indirecta de empleo y apoyo al trabajo independiente). </p></td>
          </tr>
          <tr>
            <td valign="top"><p> Escala geogr&aacute;fica </p></td>
            <td valign="top"><p> Nivel geogr&aacute;fico en el cual se implementa el programa. </p></td>
          </tr>
          <tr>
            <td valign="top"><p> M&eacute;todo de focalizaci&oacute;n </p></td>
            <td valign="top"><p> Mecanismo utilizado para seleccionar a los destinatarios del programa. </p></td>
          </tr>
          <tr>
            <td valign="top"><p> Instrumento selecci&oacute;n </p></td>
            <td valign="top"><p> Instrumento de selecci&oacute;n (por ejemplo, cuestionario) que es aplicado en los hogares potencialmente destinatarios. </p></td>
          </tr>
          <tr>
            <td valign="top"><p> Registro de destinatarios </p></td>
            <td valign="top"><p> Sistema inform&aacute;tico del padr&oacute;n de destinatarios del programa o donde est&aacute;n consolidados los padrones de destinatarios de distintos programas de protecci&oacute;n social. </p></td>
          </tr>
          <tr>
            <td valign="top"><p> Criterios de egreso o salida </p></td>
            <td valign="top"><p> Condiciones bajo las cuales las familias salen del programa o pierden las condiciones de elegibilidad. </p></td>
          </tr>
          <tr bgcolor="#FBF7E3">
            <td colspan="2" valign="top"><p align="center"><strong> Institucionalidad </strong></p></td>
          </tr>
          <tr>
            <td valign="top"><p> Marco legal </p></td>
            <td valign="top"><p> Leyes, decretos, resoluciones, que regulan la operaci&oacute;n del programa. </p></td>
          </tr>
          <tr>
            <td valign="top"><p> Organismo responsable </p></td>
            <td valign="top"><p> Ministerio u otra agencia p&uacute;blica que es la encargada, por ley o decreto, del programa . </p></td>
          </tr>
          <tr>
            <td valign="top"><p> Organismo(s) ejecutor(es) </p></td>
            <td valign="top"><p> Ministerio o agencia encargada de la implementaci&oacute;n del programa. </p></td>
          </tr>
          <tr>
            <td valign="top"><p> Organismo responsable del registro de usuarios</p></td>
            <td valign="top"><p>Ministerio o agencia encargada del registro de los usuarios del programa.</p></td>
          </tr>
          <tr>
            <td valign="top"><p> Fuentes de financiamiento </p></td>
            <td valign="top"><p> Recursos que financian los programas, tanto p&uacute;blicos como provenientes de donaciones o cr&eacute;ditos de agencias internacionales o de otra fuente internacional. </p></td>
          </tr>
          <tr bgcolor="#CBDCA5">
            <td colspan="2" valign="top"><p align="center" class="td_titulo"> 2. Componentes</p>
                <p class="td_titulo_descripcion"> Los componentes son las distintas transferencias o servicios que ofrece el programa. </p></td>
          </tr>
          <tr>
            <td valign="top"><p> Destinatarios/as </p></td>
            <td valign="top"><p> Personas o familias a quienes est&aacute;n dirigidas las transferencias o servicios espec&iacute;ficos del programa. En el caso de que coincida con la poblaci&oacute;n meta del programa especificada en la secci&oacute;n &ldquo;caracter&iacute;sticas&rdquo; del apartado 1 de este glosario, entonces se encontrar&aacute; la frase &ldquo;destinatarios/as del programa&rdquo;. </p></td>
          </tr>
          <tr>
            <td valign="top"><p> Modalidad de transferencia </p></td>
            <td valign="top"><p> Variaciones que pueden presentarse en los montos de las transferencias (generalmente, seg&uacute;n las caracter&iacute;sticas de las familias y de los miembros del hogar, as&iacute; como el tiempo de permanencia en el programa). </p></td>
          </tr>
          <tr>
            <td valign="top"><p> Forma de entrega </p></td>
            <td valign="top"><p> Forma de entrega de la transferencia (efectivo, cuenta bancaria, tarjetas magn&eacute;ticas, billetera electr&oacute;nica, vales y cupones, etc.). </p></td>
          </tr>
          <tr>
            <td valign="top"><p> Periodicidad de entrega </p></td>
            <td valign="top"><p> P eriodicidad en que se realizan las transferencias monetarias (mensual, bimestral, anual, transferencia &uacute;nica, entre otras). </p></td>
          </tr>
          <tr>
            <td valign="top"><p> Receptor/a </p></td>
            <td valign="top"><p> P ersona o miembro del hogar que recibe directamente la transferencia (jefe/a de hogar, padres, tutores, destinatario/a directo/a, entre otros). </p></td>
          </tr>
          <tr>
            <td valign="top"><p> M&aacute;ximo por familia </p></td>
            <td valign="top"><p> N&uacute; mero y/o monto m&aacute;ximo de transferencias que se pueden recibir, seg&uacute;n el n&uacute;mero de hijos/as u otro criterio de composici&oacute;n del grupo familiar. </p></td>
          </tr>
          <tr>
            <td valign="top"><p> Corresponsabilidades </p></td>
            <td valign="top"><p> Requerimientos que el programa estipula para que los destinatarios puedan cobrar la transferencia. Tambi&eacute;n son conocidas como condicionalidades o contrapartidas. </p></td>
          </tr>
          <tr>
            <td valign="top"><p> Descripci&oacute;n </p></td>
            <td valign="top"><p> Breve descripci&oacute;n del componente y sus destinatarios . </p></td>
          </tr>
          <tr>
            <td valign="top"><p> Sanciones </p></td>
            <td valign="top"><p> Consecuencias por las faltas cometidas por los destinatarios en relaci&oacute;n con las corresponsabilidades (condicionalidades) y que son sancionadas por el programa seg&uacute;n las reglas de operaci&oacute;n. Por lo general, los programas tienen un esquema de sanciones en distintas etapas. </p></td>
          </tr>
          <tr>
            <td valign="top"><p> Montos </p></td>
            <td valign="top"><p> Montos de las transferencias, cuyos valores se encuentran en la planilla Excel de la secci&oacute;n &ldquo;Datos&rdquo; (v&eacute;ase apartado 4 de este glosario).<strong></strong></p></td>
          </tr>
          <tr>
            <td valign="top"><p> Comentarios </p></td>
            <td valign="top"><p> Destacan alguna modificaci&oacute;n sustantiva, por ejemplo, al dise&ntilde;o del programa, inclusi&oacute;n de nuevos componentes, destinatarios, entre otras caracter&iacute;sticas. </p></td>
          </tr>
          <tr bgcolor="#CBDCA5">
            <td colspan="2" valign="top"><p align="center" class="td_titulo"> 3. Referencias </p>
                <p class="td_titulo_descripcion">Esta secci&oacute;n ofrece un repositorio de documentos descriptivos y evaluativos sobre el programa.</p></td>
          </tr>
          <tr>
            <td valign="top"><p> Titulo </p></td>
            <td valign="top"><p> T&iacute;tulo del documento. </p></td>
          </tr>
          <tr>
            <td valign="top"><p> Autor/es </p></td>
            <td valign="top"><p> Nombre y apellido del autor o autores. </p></td>
          </tr>
          <tr>
            <td valign="top"><p> Fecha </p></td>
            <td valign="top"><p> A&ntilde;o de publicaci&oacute;n. </p></td>
          </tr>
          <tr>
            <td valign="top"><p> Datos de publicaci&oacute;n </p></td>
            <td valign="top"><p> R evista o el n&uacute;mero del bolet&iacute;n, dependencia institucional, editorial, etc. </p></td>
          </tr>
          <tr>
            <td valign="top"><p><span class="enlace_glosario">Link </span></p></td>
            <td valign="top"><p> Enlace al documento para su descarga. </p></td>
          </tr>
          <tr>
            <td valign="top"><p> Tema </p></td>
            <td valign="top"><p> Palabras claves que sintetizan la informaci&oacute;n el documento. </p></td>
          </tr>
          <tr bgcolor="#CBDCA5">
            <td colspan="2" valign="top"><p align="center" class="td_titulo"> 4. Datos </p></td>
          </tr>
          <tr>
            <td valign="top"><p> &hellip; </p></td>
            <td valign="top"><p> No se encontr&oacute; informaci&oacute;n. </p></td>
          </tr>
          <tr>
            <td valign="top"><p> -- </p></td>
            <td valign="top"><p> No corresponde. </p></td>
          </tr>
          <tr>
            <td valign="top"><p> Presupuesto </p></td>
            <td valign="top"><p> Presupuesto asignado al programa para el a&ntilde;o correspondiente. Los valores se presentan en moneda nacional, en d&oacute;lares y como porcentaje del PIB. </p></td>
          </tr>
          <tr>
            <td valign="top"><p> Gasto </p></td>
            <td valign="top"><p> Presupuesto ejecutado al a&ntilde;o correspondiente. Los valores se presentan en moneda nacional, en d&oacute;lares y como porcentaje del PIB. </p></td>
          </tr>
          <tr>
            <td valign="top"><p> Cobertura de hogares </p></td>
            <td valign="top"><p> N&uacute;mero de hogares destinatarios del programa. </p></td>
          </tr>
          <tr>
            <td valign="top"><p> Cobertura de personas </p></td>
            <td valign="top"><p> N&uacute;mero de personas destinatarias del programa. Para los programas que no reportan datos de cobertura para personas, este valor se obtiene multiplicando el n&uacute;mero de hogares destinatarios por el promedio de integrantes de los hogares del quintil m&aacute;s pobre de la distribuci&oacute;n del ingreso del a&ntilde;o m&aacute;s cercano. </p></td>
          </tr>
          <tr>
            <td valign="top"><p> Cobertura efectiva </p></td>
            <td valign="top"><p> Cobertura poblacional observada para el a&ntilde;o correspondiente. </p></td>
          </tr>
          <tr>
            <td valign="top"><p> Cobertura programada </p></td>
            <td valign="top"><p> Cobertura poblacional esperada para el a&ntilde;o correspondiente. </p></td>
          </tr>
          <tr>
            <td valign="top"><p> Transferencias monetarias </p></td>
            <td valign="top"><p> Valor mensual de las transferencias de ingreso. Donde la transferencia se calcula como un monto anual, se dividi&oacute; por 12 meses para obtener el monto mensual aproximado.&nbsp; </p></td>
          </tr>
          <tr>
            <td valign="top"><p> Monto m&iacute;nimo per c&aacute;pita </p></td>
            <td valign="top"><p> Monto m&iacute;nimo de la transferencia que puede recibir una familia por cada miembro. Donde las transferencias var&iacute;an seg&uacute;n las caracter&iacute;sticas de los miembros, se considera la transferencia de monto menor. Donde las transferencias se realizan por familia, el monto se divide por el n&uacute;mero promedio de miembros de los hogares del quintil m&aacute;s pobre de la distribuci&oacute;n del ingreso del a&ntilde;o m&aacute;s cercano. </p></td>
          </tr>
          <tr>
            <td valign="top"><p> Monto m&aacute;ximo por familia </p></td>
            <td valign="top"><p> Monto total que puede recibir una familia en transferencias monetarias. Este puede estar especificado como un monto tope predeterminado, o en la ausencia de este, corresponde a la suma de todos los beneficios recibidos por cada beneficiario de la familia. </p></td>
          </tr>
        </table>


   	  </div>

  </div>

            <hr class="low">

            <div id="subcontent" class="column">
  
		</div>
           <hr class="low">
            <div id="footer">
                <div id="footer-hack"></div>

                <p>
                <strong><?php echo $foot_sitio; ?></strong></p>
                
                <p>
                <?php echo $foot_sponsor; ?>
                <img src="images/<? echo $imgfoot; ?>" border="0" align="absmiddle" usemap="#Map" />
                <map name="Map" id="Map">
                <area shape="rect" coords="-4,4,146,43" href="http://www.giz.de/en/" />
                <area shape="rect" coords="158,2,268,45" href="http://www.sida.se/English/" />
                <area shape="rect" coords="284,4,395,44" href="http://www.ipc-undp.org/" />
                </map>
                </p> 
				  <br>
		          <br>
  			      <br>
		          <br>
		        
  </div>
</div>
</body>
</html>