<?php

	session_start();
	$_SESSION["lang"] = "EN";

// library
	include '../lib/lib.php';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xml:lang="en" xmlns="http://www.w3.org/1999/xhtml" dir="ltr">
<head>
<title>Conditional Cash Transfer Programmes - Non-contributory social protection programmes in Latin America and the Caribbean database</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="../css/style-bdptc.css" type="text/css" media="screen, projection">
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
      <td width="82" align="center" bgcolor="#6AC0D2"><a href="../../bpsnc/index-en.php">Home</a></td>
      <td width="227" align="center" bgcolor="#96BE58" ><strong>Conditional Cash Transfer<br />
      Programmes</strong></td>
      <td width="195" align="center" bgcolor="#EEA51E"><a href="../../bdps/en">Social Pensions</a></td>
      <td width="262" align="center" bgcolor="#E9741D"><a href="../../bdilp/en">Labour and Productive Inclusion <br />
      Programmes</a></td>
    </tr>
  </table>
  <div id="header">
    <h1><?php echo $nombre_sitio; ?></h1>
    <h3><?php echo $bajada_sitio; ?></h3>
  </div>

    <div id="navigation">
       <ul>
         <li><a href="./"><?php echo $menu_inicio; ?></a></li>
         <li><a href="./glossary.php"><?php echo $menu_glosario; ?></a></li>
         <li class="selected"><a href="./contact.php"><?php echo $menu_acerca; ?></a></li>
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
        <h2><a href="#" title="Permalink"><?php echo $pg_acerca_titulo; ?></a></h2>
   	  </div>
         <div id="page_contents">
           <table cellspacing="0" cellpadding="0">
             <col width="64" span="14" />
             <tr height="17">
               <td colspan="14" rowspan="5" height="85" width="896"><?php echo $pg_acerca_cnt; ?></td>
             </tr>
             <tr height="17"> </tr>
             <tr height="17"> </tr>
             <tr height="17"> </tr>
             <tr height="17"> </tr>
           </table>
         </div>
  </div>

            <hr class="low">

            <div id="subcontent" class="column">
            <!-- 
              <p class="opcion">Acceso</p>
                <form name="form1" method="post" action="index.php">
                    <input type="text" name="q" value="<?php echo $q; ?>" class="opform" />
                    <input type="submit" name="buscar" value="buscar" class="opform" />                    
              </form>
             --> 
                
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
                <strong><?php echo $foot_sitio; ?></p>
  			                    <p>
                <?php echo $foot_sponsor; ?>
                <img src="../images/<? echo $imgfoot; ?>" border="0" align="absmiddle" usemap="#Map" />
                <map name="Map" id="Map">
                <area shape="rect" coords="-4,4,146,43" href="http://www.giz.de/en/" />
                <area shape="rect" coords="158,2,268,45" href="http://www.sida.se/English/" />
                <area shape="rect" coords="284,4,395,44" href="http://www.ipc-undp.org/" />
                </map>
                </p> 
	        <p><br>
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