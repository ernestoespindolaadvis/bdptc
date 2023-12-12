<?php 
// VARIABLES

include 'params.php';

#$TIPO_DB='mysql';

// SUBRUTINAS

function ConectaDB_ptc(){
global $SERVER_DB2,$USER_DB2,$PASS_DB2,$NAME_DB2;

  #print "CONECTANDO A $SERVER_DB,$NAME_DB,$USER_DB,$PASS_DB\n<br>";
  mysql_connect($SERVER_DB2,$USER_DB2,$PASS_DB2);
  mysql_select_db($NAME_DB2);
}

function DesconectaDB(){
  mysql_close();
}

function QueryDB($input){
  $ret=mysql_query($input);
  if(mysql_errno()!=0){
    print "<br><br><table border=1 cellpadding=10 cellspacing=0><tr><td>ERROR MySQL ".mysql_errno().": ".mysql_error()."<br>";
    print "EN QUERY <b>".$input."</b></td></tr></table><br><br>";
  }
  return $ret;
}

function TraeDB($input){
  $ret=mysql_fetch_row($input);
  return $ret;
}

function TraeArrayDB($input){
  $ret=mysql_fetch_array($input);
  return $ret;
}

function to_date($ano,$mes,$dia,$hh,$mm,$ss){
  $fecha="''";
  if(($ano!="")&&($mes!="")&&($dia!="")){
    $fecha="$ano-$mes-$dia";
    if(($hh!="")&&($mm!="")&&($ss!="")){
      $fecha.=" $hh:$mm:$ss";
    }
  }
  return "'$fecha'";
}

function printDB($query){
  print<<<EOF
  <table border="1"><tr><td>$query</td></tr></table>
EOF;
}

function hoyDB(){
  return "SYSDATE()";
}

function siguienteID($id,$tabla){
  #suponemos que ya esta conectado
  #vemos cuantas filas hay, si no existen filas (count=0) el max(id) es NULL y no sirve sumarle 1
  $query="select count($id) from $tabla";
  #printDB($query);
  $p=QueryDB($query);
  while($col=TraeDB($p)){
    $cuanto=$col[0];
  }
  #si cuanto es distinto de cero entonces buscamos el mayor y le sumamos 1
  if($cuanto!=0){
    $query="select max($id)+1 from $tabla";
    $p=QueryDB($query);
    while($col=TraeDB($p)){
      $idn=$col[0];
    }
  } else {#si no, significa que no hay filas ingresadas asi que comenzamos del numero 1
    $idn=1;
  }
  return $idn;
}


function to_char($fecha,$formato) {

	#if($TIPO_DB == "mysql")
	#{
		$formato= ereg_replace("MI","%i",$formato);
		$formato= ereg_replace("HH24","%H",$formato);
		$formato= ereg_replace("DD","%d",$formato);
		$formato= ereg_replace("MM","%m",$formato);
		$formato= ereg_replace("YYYY","%Y",$formato);
		$fecha="date_format($fecha,'$formato')";
	#}
	#elseif ($TIPO_DB == "oracle")
	#{
	#	$fecha="TO_CHAR($fecha,'$formato')";
	#}
	return $fecha;
}


function dbMin($fecha,$tipo) {
	#if(!$tipo){$tipo = $TIPO_DB;}
	#if($tipo == "mysql")
	#{
		return to_char($fecha,"MI");
	#}
}

function dbHora($fecha,$tipo)
{
	#if(!$tipo){$tipo = $TIPO_DB;}
	#if($tipo == "mysql")
	#{
		return to_char($fecha,"HH24");
	#}
}

function dbDia($fecha,$tipo)
{
	#if(!$tipo){$tipo = $TIPO_DB;}
	#if($tipo == "mysql")
	#{
		return to_char($fecha,"DD");
	#}
}

function dbMes($fecha,$tipo)
{
	#if(!$tipo){$tipo = $TIPO_DB;}
	#if($tipo == "mysql")
	#{
		return to_char($fecha,"MM");
	#}
}

function dbAno($fecha,$tipo) {
	#if(!$tipo){$tipo = $TIPO_DB;}
	#if($tipo == "mysql")
	#{
		return to_char($fecha,"YYYY");
	#}
}

function escapa($que) {

	#if(!$tipo){$tipo = $TIPO_DB;}

	$ret = $que;
	#if($tipo eq "mysql")
	#{

		$ret = ereg_replace("'","\\'",$ret);
	#}
	return $ret;
}

function desescapa($que) { 

	#if(!$tipo){$tipo = $TIPO_DB;}
	
	$ret = $que;
	#if($tipo eq "mysql")
	#{
		$ret = ereg_replace("\\'","'",$ret);
	#}
	return $ret;
}


function borraRegistroDB($tabla,$key,$id) {

	$cond=$key."=".$id;

	if($id != ""){
		$query = "delete from $tabla where $cond";
		#printDB($query);
		$res = QueryDB($query);
	} else {
		print "ERROR: ID no ingresado.";
		return false;	
	}

	return true;
}

function actualizaCampoDB($tabla,$key,$id,$campo,$valor_campo) {

	$cond=$key."=".$id;

	if($id != ""){
		$query = "update $tabla set $campo='$valor_campo' where $cond";
		#printDB($query);
		$res = QueryDB($query);
	} else {
		print "ERROR: ID no ingresado.";
		return false;	
	}

	return true;
}

function traeRegistroDB($tabla,$key,$id,$campo) {

	$cond=$key."="."'".$id."'";

	if($id != ""){
		$query = "select $campo from $tabla where $cond";
		#printDB($query);
		$res = QueryDB($query);
		$row = TraeDB($res);
	} else {
		print "ERROR: ID no ingresado.";
		return false;	
	}

	return $row[0];
}

function datopaisred($pais,$fuente,$red) {
 //$cond=$key."="."'".$id."'";
 
 if($pais != ""){
  $query = "select pais from paises where idpais = '$pais'";
  //printDB($query);
  $res = QueryDB($query);
  $row = TraeDB($res);
  
  $salida = $row[0]; // . " ( num )";
 } else {
  print "ERROR: ID no ingresado.";
  return false; 
 }
 if($fuente != "" && $fuente =="inst" && $red != ""){
	  $query = "select count(*) from instituciones where idpais = '$pais' and publicar='SI' and red=$red";
	  //printDB($query);
	  $res = QueryDB($query);
	  $row = TraeDB($res);
	  $num = $row[0]; // . " ( num )";
	
	 if ($num!= 0)
	 {
	 //return "<li>" . $salida ." (".$num.") </li>"; //$row[0];
	 return "<li>". $salida ." (<a href='Fuentes_listadoPaises.php?id_pais=$pais&es_institucion=1&num_reg=".$num."'>".$num."</a>)</li>"; //$row[0];
	 //print $salida ." (".$num.")";
	 }
	 } 
}

function datopais($pais,$fuente) {

### 22-12-2008 modifciacion de url para lista de paises. version portal 2009
 //$cond=$key."="."'".$id."'";
 
 if($pais != ""){
  $query = "select pais from paises where idpais = '$pais'";
  //printDB($query);
  $res = QueryDB($query);
  $row = TraeDB($res);
  
  $salida = $row[0]; // . " ( num )";
 } else {
  print "ERROR: ID no ingresado.";
  return false; 
 }
 if($fuente != "" && $fuente =="inst"){
	  $query = "select count(*) from instituciones where idpais = '$pais' and publicar='SI'";
	  //printDB($query);
	  $res = QueryDB($query);
	  $row = TraeDB($res);
	  $num = $row[0]; // . " ( num )";
	
	 if ($num!= 0)
	 {
	 //return "<li>" . $salida ." (".$num.") </li>"; //$row[0];
	 return "<li>". $salida ." (<a href='lista-pais.php?id_pais=$pais&es_institucion=1&num_reg=".$num."'>".$num."</a>)</li>"; //$row[0];
	 //print $salida ." (".$num.")";
	 }
	 } 

 if($fuente != "" && $fuente =="prog"){
	  $query = "select count(*) from programas where id_pais = '$pais' and publicar='SI'";
	  //printDB($query);
	  $res = QueryDB($query);
	  $row = TraeDB($res);
	  $num = $row[0]; // . " ( num )";
	
	 if ($num!= 0)
	 {
	 //return "<li>" . $salida ." (".$num.") </li>"; //$row[0];
	 return "<li>". $salida ." (<a href='lista-pais.php?id_pais=$pais&es_proyecto=1&num_reg=".$num."'>".$num."</a>)</li>"; //$row[0];
	 //print $salida ." (".$num.")";
	 }
	 } 
 if($fuente != "" && $fuente =="espec"){
	  $query = "select count(*) from especialistas where Idpais = '$pais' and publicar='SI'";
	  //printDB($query);
	  $res = QueryDB($query);
	  $row = TraeDB($res);
	  $num = $row[0]; // . " ( num )";
	
	 if ($num!= 0)
	 {
	 //return "<li>" . $salida ." (".$num.") </li>"; //$row[0];
	 return "<li>". $salida ." (<a href='listado_ipe2.php?id_area=&id_pais=$pais&es_especialista=1&num_reg=".$num."'>".$num."</a>)</li>"; //$row[0];
	 //print $salida ." (".$num.")";
	 }
	 } 
//Para obtener boletines por Pais
 if($fuente != "" && $fuente =="boletin"){
	  $query = "select count(*) from recursos where id_pais = '$pais' and publicar='SI' and tipo_recurso=25";
	  //printDB($query);
	  $res = QueryDB($query);
	  $row = TraeDB($res);
	  $num = $row[0]; // . " ( num )";
	
	 if ($num!= 0)
	 {
	 //return "<li>" . $salida ." (".$num.") </li>"; //$row[0];
	 return "<li>". $salida ." (<a href='listado_boletines.php?id_pais=$pais&es_boletin=1&num_reg=".$num."'>".$num."</a>)</li>"; //$row[0];
	 //print $salida ." (".$num.")";
	 }
	 } 
}
?>
