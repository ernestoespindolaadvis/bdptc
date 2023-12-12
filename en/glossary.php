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
  background:white url(../images/container_bg.gif) 816px 0px repeat-y;
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
         <li class="selected"><a href="./glossary.php"><?php echo $menu_glosario; ?></a></li>
         <li><a href="./contact.php"><?php echo $menu_acerca; ?></a></li>
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
        <p>This glossary defines terms used in the sections (&ldquo;General&rdquo;, &ldquo;Components&rdquo;, &ldquo;References&rdquo; and &ldquo;Data&rdquo;) of the Non-contributory social protection programmes in Latin America and the Caribbean database.</p>
        <table width="100%" cellpadding="0" cellspacing="0" class="tablaglosario">
          <tr bgcolor="#CBDCA5">
            <td colspan="2" valign="top"><p align="center" class="td_titulo"> 1. General </p></td>
          </tr>
          <tr>
            <td width="14%" valign="top"><p> Date </p></td>
            <td width="86%" valign="top"><p> Start year and end year of the programme (if it is already closed). </p></td>
          </tr>
          <tr>
            <td valign="top"><p> Web </p></td>
            <td valign="top"><p> Link to the official website of the programme. </p></td>
          </tr>
          <tr>
            <td valign="top"><p> Description </p></td>
            <td valign="top"><p> General information on the programme, such as: objectives, recipients, year of launching, linkage with a comprehensive poverty reduction strategy or improvement of living conditions, among others. </p></td>
          </tr>
          <tr bgcolor="#FBF7E3">
            <td colspan="2" valign="top"><p align="center"><strong> Characteristics </strong></p>
</td>
          </tr>
          <tr>
            <td valign="top"><p> Target population </p></td>
            <td valign="top"><p> Target population, whose living conditions are sought to be improved through the programme. </p></td>
          </tr>
          <tr>
            <td valign="top"><p> Geographic scale </p></td>
            <td valign="top"><p> Geographical level at which the programme is implemented. </p></td>
          </tr>
          <tr>
            <td valign="top"><p> Targeting method </p></td>
            <td valign="top"><p> Mechanism used to select the recipients of the programme. </p></td>
          </tr>
          <tr>
            <td valign="top"><p> Instrument of selection </p></td>
            <td valign="top"><p> Instrument of selection (for instance, survey) applied to potentially recipient households. </p></td>
          </tr>
          <tr>
            <td valign="top"><p> Registry of recipients </p></td>
            <td valign="top"><p> Computer system with the lists of recipients of the programme or of several consolidated social protection programmes. </p></td>
          </tr>
          <tr>
            <td valign="top"><p> Exit strategies or criteria </p></td>
            <td valign="top"><p> Conditions under which families should leave the programme or lose their eligibility </p></td>
          </tr>
          <tr bgcolor="#FBF7E3">
            <td colspan="2" valign="top"><p align="center"><strong> Institutionality </strong></p>
</td>
          </tr>
          <tr>
            <td valign="top"><p> Legal framework </p></td>
            <td valign="top"><p> Laws, decrees, resolutions, that regulate the operation of the programme. </p></td>
          </tr>
          <tr>
            <td valign="top"><p> Responsible organization(s) </p></td>
            <td valign="top"><p> Ministry or other public organization responsible, by law or decree, for the programme. </p></td>
          </tr>
          <tr>
            <td valign="top"><p> Executing organization(s) </p></td>
            <td valign="top"><p> Ministry or organization in charge of executing the programme. </p></td>
          </tr>
          <tr>
            <td valign="top"><p>Responsible organization(s) for the registry of recipients</p></td>
            <td valign="top"><p>Ministry or agency responsible for the registry of recipients of the program.</p></td>
          </tr>
          <tr>
            <td valign="top"><p> Funding sources </p></td>
            <td valign="top"><p> Funding sources of the programmes, both public and private (as donations) as well as loans from international agencies or another international source. </p></td>
          </tr>
          <tr bgcolor="#CBDCA5">
            <td colspan="2" valign="top"><p align="center" class="td_titulo"> 2. Components </p>
                <p class="td_titulo_descripcion"> The components are different transfers or services offered by the programme. </p></td>
          </tr>
          <tr>
            <td valign="top"><p> Recipients </p></td>
            <td valign="top"><p> Individuals or households eligible for the transfer or a specific programme service. In the event that they match with the target population specified in the &quot;characteristics&quot; section (see part 1 of this glossary) then the phrase &quot;recipient(s) of the programme&quot; will be found. </p></td>
          </tr>
          <tr>
            <td valign="top"><p> Mode of transfer </p></td>
            <td valign="top"><p> Variations that can occur in the transfer amounts (in general, related to the characteristics of families and household members as well as the time spent in the programme). </p></td>
          </tr>
          <tr>
            <td valign="top"><p> Mode of delivery &nbsp; </p></td>
            <td valign="top"><p> Delivery method of the transfer (cash, bank account, magnetic cards, electronic wallet, vouchers and coupons, etc.). </p></td>
          </tr>
          <tr>
            <td valign="top"><p> Periodicity of delivery<a name="_GoBack" id="_GoBack"></a></p></td>
            <td valign="top"><p> Cash transfer frequency (monthly, bi-monthly, annual, one-time transfer, among others) </p></td>
          </tr>
          <tr>
            <td valign="top"><p> Recipient of the transfer <br />
                    <br />
            </p></td>
            <td valign="top"><p> Individual or household member that receives the transfer directly (head of households, parents, legal tutor, direct recipient, among others). </p></td>
          </tr>
          <tr>
            <td valign="top"><p> Maximum per household </p></td>
            <td valign="top"><p> Number or maximum amount of transfers that can be received, according to the number of children as well as any other criteria. </p></td>
          </tr>
          <tr>
            <td valign="top"><p> Conditionalities </p></td>
            <td valign="top"><p> Requirements that the programme stipulates in order to allow recipients to get the transfer. </p></td>
          </tr>
          <tr>
            <td valign="top"><p> Sanctions </p></td>
            <td valign="top"><p> Consequences for recipients who do not comply with the co-responsibilities (conditionalities), and who can be sanctioned by the programme according to the rules of operation. Usually, programmes have a system of penalties with different stages. </p></td>
          </tr>
          <tr>
            <td valign="top"><p> Amount&nbsp; </p></td>
            <td valign="top"><p> Amount of transfers, whose figures are contained in the Excel spreadsheet in the &quot;Data&quot; section (see section 4). </p></td>
          </tr>
          <tr>
            <td valign="top"><p> Comments </p></td>
            <td valign="top"><p> Underline any substantive change such as changes in the programme design, implementation of new components, recipients, among other features. </p></td>
          </tr>
          <tr bgcolor="#CBDCA5">
            <td colspan="2" valign="top"><p align="center" class="td_titulo"> 3. References </p>
                <p class="td_titulo_descripcion"> This section provides a repository of descriptive and evaluative documents about the programme. </p></td>
          </tr>
          <tr>
            <td valign="top"><p> Title </p></td>
            <td valign="top"><p> Title of the document </p></td>
          </tr>
          <tr>
            <td valign="top"><p> Author(s) </p></td>
            <td valign="top"><p> Name and surname of the author(s). </p></td>
          </tr>
          <tr>
            <td valign="top"><p> Date </p></td>
            <td valign="top"><p> Year of the publication </p></td>
          </tr>
          <tr>
            <td valign="top"><p> Publication info </p></td>
            <td valign="top"><p> Journal or newsletter issue, institution or unit, publishing house, etc. </p></td>
          </tr>
          <tr>
            <td valign="top"><p><span class="enlace_glosario">Link </span></p></td>
            <td valign="top"><p> Link to download the document<strong></strong></p></td>
          </tr>
          <tr>
            <td valign="top"><p> Topic </p></td>
            <td valign="top"><p> Keywords that summarize the information contained in the document </p></td>
          </tr>
          <tr bgcolor="#CBDCA5">
            <td colspan="2" valign="top"><p align="center" class="td_titulo"> 4. Data </p></td>
          </tr>
          <tr>
            <td valign="top"><p> &hellip; </p></td>
            <td valign="top"><p> No information available </p></td>
          </tr>
          <tr>
            <td valign="top"><p> -- </p></td>
            <td valign="top"><p> Not applicable </p></td>
          </tr>
          <tr>
            <td valign="top"><p> Budget </p></td>
            <td valign="top"><p> Budget allocated to the programme for the corresponding year. The figures are presented in local currency, US dollars and as percentage of GDP. </p></td>
          </tr>
          <tr>
            <td valign="top"><p> Expenditure </p></td>
            <td valign="top"><p> Executed budget for the corresponding year. The figures are presented in local currency, US dollars and as percentage of the GDP. </p></td>
          </tr>
          <tr>
            <td valign="top"><p> Coverage of households </p></td>
            <td valign="top"><p> Number of recipient households of the programme. </p></td>
          </tr>
          <tr>
            <td valign="top"><p> Coverage of persons </p></td>
            <td valign="top"><p> Number of persons participating in the programme. For programmes that do not report data on persons&rsquo; coverage, this value is obtained by multiplying the number of recipient households by the average number of members of households in the poorest quintile of the income distribution of the nearest available year. </p></td>
          </tr>
          <tr>
            <td valign="top"><p> Effective coverage </p></td>
            <td valign="top"><p> Coverage observed for the corresponding year. </p></td>
          </tr>
          <tr>
            <td valign="top"><p> Expected coverage </p></td>
            <td valign="top"><p> Coverage expected for the corresponding year </p></td>
          </tr>
          <tr>
            <td valign="top"><p> Monetary transfers </p></td>
            <td valign="top"><p> Monthly value of income transfers. If the transfer is done on a yearly basis, it is divided by 12 to obtain the corresponding monthly value. </p></td>
          </tr>
          <tr>
            <td valign="top"><p> Minimum amount per capita </p></td>
            <td valign="top"><p> Minimum transfer amount that a family can receive for each member. Where transfers vary according to the characteristics of the member, it considers the transfer with a smaller amount. Where transfers are made per family, the amount is divided by the average number of members of households in the poorest quintile of the income distribution of the nearest available year. </p></td>
          </tr>
          <tr>
            <td valign="top"><p> Maximum amount per household </p></td>
            <td valign="top"><p> Total amount that a family can receive in cash transfers. This can be specified as either a pre-determined ceiling amount or, in its absence, as the sum of all the transfers received by each member of the family. </p></td>
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
                <img src="../images/<? echo $imgfoot; ?>" border="0" align="absmiddle" usemap="#Map" />
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


