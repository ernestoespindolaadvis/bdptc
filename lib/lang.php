<?php

// Libreria control idioma / v2 / ago 2011


// Toma variable sesión del lenguaje seleccionado en Portada Principal
	session_start(); 
	
	$lang = $_SESSION["lang"];

// Por default español
if (!$lang || $lang == "ES")
	{
	
	
	$op_lang = "Español | <a href=\"././lib/langdef.php?lang=EN\">English</a>";
	
	$nombre_sitio = "Programas de transferencias condicionadas";
	$bajada_sitio = "Base de datos de programas de protección social no contributiva en América Latina y el Caribe";
	$menu_inicio ="Programas";
	$menu_glosario = "Glosario";
	$menu_acerca = "Acerca"; 
	
	$nav_ptc = "PTC"; 
	$nav_ps = "Pensiones sociales"; 
	
	// footer
	$imgfoot = "foot-logos.gif";
	
	$pg_acerca_titulo = "Acerca de la Base de Datos";
	$pg_acerca_cnt = "<p>Los programas de transferencias condicionadas (PTC) buscan reducir la pobreza y fortalecer las capacidades humanas de sus destinatarios. Esta base provee datos sobre gasto, cobertura y montos de las transferencias monetarias así como información detallada sobre los distintos componentes de los PTC en los países de América Latina y el Caribe.</p>
<p>Esta base de datos ha sido elaborada por la División de Desarrollo Social de la Comisión Económica para América Latina y el Caribe (CEPAL) en conjunto con la Deutsche Gesellschaft für Internationale Zusammenarbeit (GIZ), bajo financiamiento del proyecto &quot;Sustentabilidad de los programas de transferencias con corresponsabilidad&quot; (GER/001/09), y la Agencia Sueca de Cooperación Internacional para el Desarrollo (Asdi), bajo financiamiento del programa de cooperación “Protección e inclusión social en América Latina y el Caribe” (SWE/09/002). Los proyectos &quot;Time for equality: Strengthening the Institutional Framework of Social Policies&quot; (ROA 235-8) y &quot;Promoting equality: Strengthening the capacity of select developing countries to design and implement equality-oriented public policies and programmes&quot; (ROA 315-9) financiados por la Cuenta del Desarrollo de las Naciones Unidas contribuyen a la actualización de la información. El Centro Internacional de Políticas para el Crecimiento Inclusivo (IPC-IG) del Programa de las Naciones Unidas para el Desarrollo (PNUD) proveyó la traducción al inglés de los contenidos de la base. Se ha contado asimismo con la colaboración de la Red Interamericana de Protección Social de la Organización de los Estados Americanos (OEA) para la verificación de los datos.</p><p>Los datos han sido obtenidos de documentos oficiales de los pa&iacute;ses a menos que se indique lo contrario.</p>
<p>El documento de la CEPAL &quot;<a href=\"https://www.cepal.org/es/publicaciones/41811-programas-transferencias-condicionadas-america-latina-caribe-tendencias\">Programas de transferencias condicionadas en Am&eacute;rica Latina y el Caribe: tendencias de cobertura e inversi&oacute;n</a>&quot; analiza la evoluci&oacute;n de la cobertura poblacional y la inversi&oacute;n de estos programas hasta el 2016 y presenta la metodolog&iacute;a de armonizaci&oacute;n de las series de cobertura e inversi&oacute;n de los PTC de los pa&iacute;ses de la regi&oacute;n, as&iacute; como los pasos tomados para generar los agregados de cobertura e inversi&oacute;n regional. Asimismo, el documento de la CEPAL &quot;<a href=\"http://www.cepal.org/es/publicaciones/27854-programas-transferencias-condicionadas-balance-la-experiencia-reciente-america\">Programas de transferencias condicionadas: Balance de la experiencia reciente en América Latina y el Caribe</a>&quot; as&iacute; como la secci&oacute;n sobre &quot;<a href=\"http://repositorio.cepal.org/bitstream/handle/11362/36896/S2014311_es.pdf?sequence=1\">Programas de transferencias condicionadas y el mercado laboral&quot; del bolet&iacute;n Coyuntura laboral en Am&eacute;rica Latina y el Caribe no. 10 de la CEPAL y la OIT</a> han sido elaborados con información proveniente de esta base de datos.</p>
<p>Para citar favor utilizar &quot;Base de datos de programas de protecci&oacute;n social no contributiva en Am&eacute;rica Latina y el Caribe, Divisi&oacute;n de Desarrollo Social, CEPAL&quot;. </p>";
	
	$pg_glosario = "Glosario";
	$pg_glosario_b ="Este glosario define los términos utilizados en la sección \"Datos\" de la base.";
	
	$cont_titulo = "Programas";
	$cont_sub_titulo = "Buscar Programas";
	$cont_sub_pais = "Programas por pais";
	
	$frm_btn_buscar = "Buscar";
	$frm_btn_orden = "Ordenar";
	$frm_op_name ="Nombre";
	$frm_op_pais ="Pais";
	
	$nav_ant = "Anterior";
	$nav_sigue = "Siguiente";
	$nav_page = "Página";
	$nav_res = "Resultados";
	
	
	$foot_sitio = "2017 | División de Desarrollo Social <a href=\"http://www.cepal.org/dds\">DDS</a>, <a href=\"http://www.cepal.org/\">CEPAL</a>";
	$foot_sponsor = "Con la cooperación de: ";
	
	// ficha prog
	$tabcompon = "Componentes";
	$tabref = "Referencias";
	$imgexcel = "ExcelData_ES.gif";
	
	
	}

// Ingles

if ($lang == "EN")
	{
	
	$op_lang = "<a href=\"./lib/langdef.php?lang=ES\">Español</a> | English";
	
	$nombre_sitio = "Conditional Cash Transfer Programmes";
	$bajada_sitio = "Non-contributory social protection programmes in Latin America and the Caribbean database";
					
	$menu_inicio ="Programmes";
	$menu_glosario = "Glossary";
	$menu_acerca = "About"; 

	$nav_ptc = "CCTs"; 
	$nav_ps = "Social pensions"; 

	// footer
	$imgfoot = "foot-logosEN.gif";	
	
	$pg_acerca_titulo = "About this database";
	$pg_acerca_cnt = "<p>Conditional cash transfer (CCT) programmes try to reduce poverty and strengthen the human capacities of its recipients.  This database provides data on expenditure, coverage and amount of the monetary transfers, as well as detailed information on the different components of CCTs in Latin American and Caribbean countries.</p>
<p>This database has been developed by the Social Development Division of the Economic Commission for Latin America and the Caribbean (ECLAC) together with the Deutsche Gesellschaft für Internationale Zusammenarbeit (GIZ), which financed the project &quot;Sustainability of co-responsibility transfer programmes&quot; (GER/001/09), and the Swedish International Development Cooperation Agency (Sida), which financed the cooperation programme &quot;Social protection and inclusion in Latin America and the Caribbean&quot; (SWE/09/002). The &quot;Time for equality: Strengthening the Institutional Framework of Social Policies&quot; (ROA 235-8) and &quot;Promoting equality: Strengthening the capacity of select developing countries to design and implement equality-oriented public policies and programmes&quot; (ROA 315-9) projects financed by the United Nations Development Account are contributing to the update of the information. The United Nations Development Programme (UNDP) International Policy Centre for Inclusive Growth (IPC-IG) provided English translation of the contents of the database. The Inter-American Social Protection Network (IASPN) of the Organization of American States (OAS) collaborated with data quality checks.</p>
<p>Data have been obtained from official country documents, unless other sources are cited.</p>
<p>The ECLAC document &quot;<a href=\"https://www.cepal.org/en/publications/42109-conditional-cash-transfer-programmes-latin-america-and-caribbean-coverage-and\">Conditional cash transfer programmes in Latin America and the Caribbean: Coverage and investment trends</a>&quot; analyses the evolution of the population coverage and investment of these programmes up to 2016 and presents the methodology used to harmonize the CCT programme coverage and investment data series for the region&lsquo;s countries, as well as the steps taken to generate the aggregate data on regional coverage and investment. Furthermore, the ECLAC document &quot;<a href=\"http://www.cepal.org/en/publications/conditional-cash-transfer-programmes-recent-experience-latin-america-and-caribbean\">Conditional Cash Transfer Programmes: The recent experience in Latin America and the Caribbean</a>&quot; and the section on &quot;<a href=\"http://www.ilo.org/wcmsp5/groups/public/---americas/---ro-lima/documents/publication/wcms_244281.pdf\">Conditional cash transfer programmes and the labour market&quot; of the ECLAC-ILO bulletin no. 10 on the employment situation in Latin America and the Caribbean</a> have been prepared on the basis of information from this database</p>
<p>For citations, please refer to &quot;Non-contributory social protection programmes in Latin America and the Caribbean database, Social Development Division, ECLAC&quot;. </p>";
	
	$pg_glosario = "Glossary";
	$pg_glosario_b ="This glossary defines terms used in the \"Data\" section of the base.";
	
	$cont_titulo = "Programmes";
	$cont_sub_titulo = "Search programmes";
	$cont_sub_pais = "Programmes by country";
	
	$frm_btn_buscar = "Search";
	$frm_btn_orden = "Order";
	$frm_op_name ="Name";
	$frm_op_pais ="Country";
	
	$nav_ant = "Back";
	$nav_sigue = "Next";
	$nav_page = "Page";
	$nav_res = "Results";	
		
	
	$foot_sitio = "2017 | Social Development Division <a href=\"http://www.cepal.org/dds\">SDD</a>, <a href=\"http://www.cepal.org/\">ECLAC</a>";
	$foot_sponsor = "Cooperation with : "; 
	
	// ficha prog
	$tabcompon = "Components";
	$tabref = "References";
	$imgexcel = "ExcelData_EN.gif";
	
	
		
	}


?>
