<?php

include 'db-lib.php';

function formPass ($nombre, $largo, $max, $value, $class) {

	if(!$nombre){$nombre = "";}
	if(!$largo){$largo = "50";}
	if(!$max){$max = "";}
	if(!$value){$value = "";}	
	if($class) {$class = " class=\"$class\" ";}


	$html = "<INPUT TYPE=\"password\" NAME=\"$nombre\" ";

	if($largo) {
		$html.= " SIZE=\"$largo\" ";
	}
	if($max) {
	        $html .= " MAXLENGTH=\"$max\" ";
	}
	if($value != "") {

	        $html .= " VALUE=\"$value\" ";
	}
	if($class) {
	        $html .= $class;
	}

	$html .= ">\n";
        return $html;
}

function formTexto ($nombre, $largo, $max, $value, $class) {

	if(!$nombre){$nombre = "";}
	if(!$largo){$largo = "50";}
	if(!$max){$max = "";}
	if(!$value){$value = "";}

	$html = "<INPUT TYPE=\"text\" NAME=\"$nombre\" ";

	if($largo) {
		$html.= " SIZE=\"$largo\" ";
	}
	if($max) {
	        $html .= " MAXLENGTH=\"$max\" ";
	}
	if($value != "") {

		$value= preg_replace("/\"/","&#147;",$value);
		##print "VALUE $value "; ## D-BUG!

	        $html .= " VALUE=\"$value\" ";
	}
	if($class != "") {
	        $html .= " class=\"$class\" ";
	}
	$html .= ">\n";
        return $html;
}

function formTextoDB($nombre,$tabla,$key,$id,$campo,$largo,$max,$valor,$ver,$class) {
	
	$cond=$id."=".$key;

	if(($id != "")&&($valor == "")){

		$query = "select $campo from $tabla where $cond";

		#printDB($query);

		$res = QueryDB($query);
		
		$campos = TraeDB($res);
		$value = $campos[0];
	} else {
		$value=$valor;
	}
	if($ver == "1"){
		print $value;
	} else {
	return formTexto($nombre, $largo, $max, $value, $class);
	}
}

function formTextoDB2($nombre,$tabla,$key,$id,$campo,$largo,$max,$valor,$ver,$class,$condicion) {
	
	$cond=$id."=".$key;
	if($condicion){$cond.=" ".$condicion." ";}

	if(($id != "")&&($valor == "")){

		$query = "select $campo from $tabla where $cond";

		#printDB($query);

		$res = QueryDB($query);
		
		$campos = TraeDB($res);
		$value = $campos[0];
	} else {
		$value=$valor;
	}
	if($ver == "1"){
		print $value;
	} else {
	return formTexto($nombre, $largo, $max, $value, $class);
	}
}

function formTextarea ($nombre, $rows, $cols, $value, $class) {
	if(!$nombre){$nombre = "";}
	if(!$rows){$rows = "5";}
	if(!$cols){$cols = "50";}
	if(!$value){$value = "";}

	if($class) {
	        $class = " class=\"$class\" ";
	}
	#$html = "<TEXTAREA ROWS=\"$rows\" COLS=\"$cols\" NAME=\"$nombre\" WRAP=\"off\">
	#$value</TEXTAREA>\n";
	$html = "<TEXTAREA ROWS=\"$rows\" COLS=\"$cols\" NAME=\"$nombre\" $class>$value</TEXTAREA>\n";
	return $html;
}

function formTextarea2 ($nombre, $rows, $cols, $value, $class) {
	if(!$nombre){$nombre = "";}
	if(!$rows){$rows = "5";}
	if(!$cols){$cols = "50";}
	if(!$value){$value = "";}

	if($class) {
	        $class = " class=\"$class\" ";
	}
	#$html = "<TEXTAREA ROWS=\"$rows\" COLS=\"$cols\" NAME=\"$nombre\" WRAP=\"off\">
	#$value</TEXTAREA>\n";
	$html = "<TEXTAREA ROWS=\"$rows\" COLS=\"$cols\" NAME=\"$nombre\" $class onKeyDown=\"textCounter(this.form.$nombre,this.form.remLen,255);\" onKeyUp=\"textCounter(this.form.$nombre,this.form.remLen,255);\">$value</TEXTAREA>\n";
	return $html;
}


function formTextarea_disabled ($nombre, $rows, $cols, $value, $class) {
	if(!$nombre){$nombre = "";}
	if(!$rows){$rows = "5";}
	if(!$cols){$cols = "50";}
	if(!$value){$value = "";}

	if($class) {
	        $class = " class=\"$class\" ";
	}
	#$html = "<TEXTAREA ROWS=\"$rows\" COLS=\"$cols\" NAME=\"$nombre\" WRAP=\"off\">
	#$value</TEXTAREA>\n";
	$html = "<TEXTAREA ROWS=\"$rows\" COLS=\"$cols\" NAME=\"$nombre\" $class DISABLED>$value</TEXTAREA>\n";
	return $html;
}
									

function formTextareaDB($nombre,$tabla,$key,$id,$campo,$rows,$cols,$valor,$ver,$class){
	
	$cond=$id."=".$key;

	if(($id != "")&&($valor == "")){

		$query = "select $campo from $tabla where $cond";

		$res = QueryDB($query);
		
		$campos = TraeDB($res);
		$value = $campos[0];
	} else {
		$value=$valor;
	}
	if($ver == "1"){
		print $value;
	} else {
	return formTextarea($nombre, $rows, $cols, $value, $class);
	}
}
function formTextareaDB2($nombre,$tabla,$key,$id,$campo,$rows,$cols,$valor,$ver,$class){
	
	$cond=$id."=".$key;

	if(($id != "")&&($valor == "")){

		$query = "select $campo from $tabla where $cond";

		$res = QueryDB($query);
		
		$campos = TraeDB($res);
		$value = $campos[0];
	} else {
		$value=$valor;
	}
	if($ver == "1"){
		print $value;
	} else {
	return formTextarea2($nombre, $rows, $cols, $value, $class);
	}
}


function enTabla ($nombre, $nombre2) {
	
	$html="<tr bgcolor=\"#FFFFFF\"><td><b>$nombre</b></td><td>$nombre2</td></tr>";
	print $html;

}

function enTabla2($nombre, $nombre2) {
	$html="<tr><td><div align=\"right\">$nombre</div></td><td>$nombre2</td></tr>";
	print $html;
}

function form_checkbox($nombre, $value) { ##COMPATIBILIDAD CON DBARCHIVO, NO USAR
	
	$html = "<INPUT TYPE=\"checkbox\" NAME=\"$nombre\" ";
	if($value == 1) {
		$html .= " checked ";
	}
	$html .= ">";
	return $html;
}


function formArchivo($nombre, $value, $path, $tipo, $ver) {

	if(!$nombre){$nombre = "";}
	if(!$value){$value = "";}
	if(!$path){$path = "";}
	if(!$tipo){$tipo = "1";} #1:archivo normal; 2:foto

	if($value)
	{
		if($tipo==1){
			$html .= "<tr><td><FONT SIZE=\"-1\">Actual: <B><a href=\"$path/$value\" target=_NEW>$value</a></B></FONT></td></tr>\n";
		} else {
			$html .= "<tr><td><FONT SIZE=\"-1\">Actual: <B>$value <a href=\"$path/$value\" target=_NEW><img src=\"$path/$value\" width=30 border=1></a></FONT></td></tr>\n";
		}
	}
	if($ver != "1"){
		$html .= "<tr><td><INPUT TYPE=\"file\" NAME=\"$nombre\"></td></tr>";
		$html .= "\n<INPUT TYPE=\"hidden\" NAME =\"$nombre"."_old"."\" VALUE=\"$value\"></td></tr>\n";
		if($value)
		{
			$html .= "<tr><td>".form_checkbox("borr_$nombre",0);
			$html .= "<FONT SIZE = \"-1\">Borrar Archivo</FONT></td></tr>\n";
		}
	}
	$html="<table border=0>$html</table>";
	return $html;
}

function formArchivoDB($tabla, $campo, $key, $id, $valor, $nombre, $path, $tipo, $ver, $class1) {


	global $PATH_ARCHIVOS_WEB;
	#print "PATH_ARCHIVOS_WEB -$PATH_ARCHIVOS_WEB-<br>";

	if(!$nombre){$nombre = "";}
	#if(!$value){$value = "";}
	if(!$path){$path = "";}
	if(!$tipo){$tipo = "1";} #1:archivo normal; 2:foto
	if($class1){$class = "class=\"$class1\"";}

        $cond=$id."=".$key;

	if(($id != "")&&($valor == "")){
		$query = "select $campo from $tabla where $cond";
		#printDB($query);
		$res = QueryDB($query);
		$campos = TraeDB($res);
		$value = $campos[0];
	} else {
		$value=$valor;
	}

	if($value)
	{
		if($tipo==1){
			#$html .= "<tr><td><FONT SIZE=\"-1\">Actual: <B><a href=\"$PATH_ARCHIVOS_WEB/$path/$value\" target=_NEW>$value</a></B></FONT></td></tr>\n";
			$html .= "<tr><td><FONT SIZE=\"-1\">Actual: <B><a href=\"$path/$value\" target=_NEW>$value</a></B></FONT></td></tr>\n";
		} else {
			#$html .= "<tr><td><FONT SIZE=\"-1\">Actual: <B>$value <a href=\"$PATH_ARCHIVOS_WEB/$path/$value\" target=_NEW><img src=\"$PATH_ARCHIVOS_WEB/$path/$value\" width=30 border=1></a></FONT></td></tr>\n";
			$html .= "<tr><td><FONT SIZE=\"-1\">Actual: <B>$value <a href=\"$path/$value\" target=_NEW><img src=\"$path/$value\" width=30 border=1></a></FONT></td></tr>\n";
		}
	}
	if($ver != "1"){
		$html .= "<tr><td><INPUT TYPE=\"file\" NAME=\"$nombre\" $class></td></tr>";
		$html .= "\n<INPUT TYPE=\"hidden\" NAME=\"$nombre"."_old"."\" VALUE=\"$value\"></td></tr>\n";
		if($value)
		{
			$html .= "<tr><td>".form_checkbox("borr_$nombre",0);
			$html .= "<FONT SIZE=\"-1\">Borrar Archivo</FONT></td></tr>\n";
		}
	}
	$html="<table border=0>$html</table>";
	return $html;

}


function formFecha($nombre,$valor_dia,$valor_mes,$valor_ano,$class1) {

	$html = formTexto("dia_$nombre",2,2,$valor_dia,$class1)."/".formTexto("mes_$nombre ",2,2,$valor_mes,$class1)."/".formTexto("ano_$nombre",4,4,$valor_ano,$class1);

	return $html;
}


function formFechaDB($nombre,$tabla,$id,$key,$campo,$valor_dia,$valor_mes,$valor_ano,$validar,$hormin,$valor_hora,$valor_min,$ver,$class1) {

	if(!$validar){$validar = "0";}

	if($hormin){
		$hora = formTextoDB("hora_$nombre",$tabla,$id,$key,dbHora($campo,""),2,2,$valor_hora,"$ver",$class1);
		$min = formTextoDB("min_$nombre",$tabla,$id,$key,dbMin($campo,""),2,2,$valor_min,"$ver",$class1);
	}
	
	$dia = formTextoDB("dia_$nombre",$tabla,$id,$key,dbDia($campo,""),2,2,$valor_dia,"$ver",$class1);
	$mes = formTextoDB("mes_$nombre",$tabla,$id,$key,dbMes($campo,""),2,2,$valor_mes,"$ver",$class1);
	$ano = formTextoDB("ano_$nombre",$tabla,$id,$key,dbAno($campo,""),4,4,$valor_ano,"$ver",$class1);
	
	if($validar)
	{
		$dia= ereg_replace("([^>]+)>","$1 OnBlur=\"compdiames(this,'dia')\" >",$dia);
		$mes= ereg_replace("([^>]+)>","$1 OnBlur=\"compdiames(this,'mes')\" >",$mes);
		$ano= ereg_replace("([^>]+)>","$1 OnBlur=\"compano(this)\" >",$ano);
		#$dia =~ s/([^>]+)>/$1 OnBlur="compdiames(this,'dia')" >/;
		#$mes =~ s/([^>]+)>/$1 OnBlur="compdiames(this,'mes')" >/;
		#$ano =~ s/([^>]+)>/$1 OnBlur="compano(this)" >/;
	}
	$txt = $dia." / ".$mes." / ".$ano;

	if($hormin){
		#$txt = $ano." / ".$mes." / ".$dia." &nbsp;&nbsp;&nbsp;&nbsp; ".$hora." : ".$min;
		$txt = $dia." / ".$mes." / ".$ano." &nbsp;&nbsp; - &nbsp;&nbsp; ".$hora." : ".$min;
	}
	return $txt;
}
					      

function formSubmit($nombre_submit,$nombre_reset,$ver,$class1) {

	if(!$nombre_submit){$nombre_submit = "Siguiente >>";}
	if(!$nombre_reset){$nombre_reset = "Deshacer Cambios";}
	if($class1){$class = "class=\"$class1\"";}

	$html = "<input type=\"button\" value=\"<< Volver\" onClick=\"history.back()\" $class>\n";
	$html .= "<input type=\"reset\" value=\"$nombre_reset\" $class>\n";
	$html .= "<input type=\"button\" value=\"$nombre_submit\" onClick=\"validar()\" $class>\n";
	if($ver == "1"){
		$html = "<input type=\"button\" value=\"<< Volver\" onClick=\"history.back()\" $class>\n";
	} 
	if($ver == "2"){
		$html = "<input type=\"button\" value=\"$nombre_submit\" onClick=\"validar()\" $class>\n";
	} 
	return $html;
}

function formBotonIr($nombre_boton,$direccion,$ver,$class1) {

	if(!$nombre_boton){$nombre_boton = "Siguiente >>";}
	if($class1){$class = "class=\"$class1\"";}

	$html = "<input type=\"button\" value=\"$nombre_boton\" onClick=\"document.location.href='$direccion'\" $class>\n";
	if($ver == "1"){
		$html = "<input type=\"button\" value=\"<< Volver\" onClick=\"history.back()\" $class>\n";
	} 
	return $html;
}

function formHidden($nombre,$value,$extra) {
	$HTML="<input type=\"hidden\" name=\"$nombre\" value=\"$value\" $extra>";
	return $HTML;
	}

function ini($var){
  #my($var) = $_[0];
    if($var == "" && $var != "0"){ $var = ""; }  ##linea modificada por Pa-T! 04/03/2001
      return $var;
      }  ##linea modificada por Pa-T! 04/03/2001


function formRadio($nombre,$valor,$opciones,$ver) {

#forma varios radios, uno debe ingresar
#$nombre el nombre del radio
#$valor  define cual es el valor elegido (nulo si no hay ninguno)
#define las opciones del tipo radio y se separan asi "opcion1".$sp."1,opcion2".$ sp."2,etc"
#el string $sp que es igual a la variable $gral_lib::FORM_SEPARADOR separa el no mbre de
#la opcion con el valor de esta
#la "," (coma) separa cada par (opcion,valor)
#ADDS ON: Si se le agrega al final de cada par (opcion, valor) 
#otro separador y el string "checked" 
#ese valor quedara checkeado por defecto si el $valor es nulo 


	$op=split("\,",$opciones);

	$nombre=ini($nombre);

	for($i = 0; $i < count($op); $i++){
		$val = split("-",$op[$i]);
		$value=ini($val[0]);
		$checked=ini($val[1]);
		$option=ini($val[2]);
		if($valor != ""){
			$checked="";
		}
		if($valor == $value){
			$checked="checked";
		}
		if($ver == "1"){
			if($checked){
				$html = $html."$option<br>\n";
			}
		} else {
			$html = $html."<input type=radio name=$nombre value=\"$value\" $checked> $option<br>\n";
		}
	}
	return $html;
}



function formRadioDB($tabla,$campo,$key,$id,$nombre,$valor_ext,$opciones,$ver) {

# LEER EXPLICACION FUNCION "formRadio"


        $cond=$id."=".$key;

	#if(($id != "")&&($valor_ext == "")){
	if($id != ""){
		$query = "select $campo from $tabla where $cond";
		#printDB($query);
		$res = QueryDB($query);
		$campos = TraeDB($res);
		#$value = $campos[0];
		$valor = $campos[0];
	#}
	} else {
		$valor=$valor_ext;
	}


	$op=split("\,",$opciones);

	$nombre=ini($nombre);

	for($i = 0; $i < count($op); $i++){
		$val = split("-",$op[$i]);
		$value=ini($val[0]);
		$checked=ini($val[1]);
		$option=ini($val[2]);
		if($valor != ""){
			$checked="";
		}

		if($valor == $value){
			$checked="checked";
		}
		if($ver == "1"){
			if($checked){
				$html = $html."$option<br>\n";
			}
		} else {
			$html = $html."<input type=radio name=$nombre value=\"$value\" $checked> $option<br>\n";
		}
	}
	return $html;
}

function formBorraRegistro($nombre,$id,$value1,$class1) {

	if($class1){$class = "class=\"$class1\"";}
	if(!$value1){
		$value = "BORRAR";
	}else{
		$value = $value1;
	}

	$html="<input type=\"button\" value=\"$value\" onClick=\"if(confirm('Desea borrar el registro \'$nombre\'?')){document.location.href='borra.php?id=$id'}\" $class>";
	return $html;
}

function formBorraRegistro2($nombre,$id,$value1,$class1,$name,$valor) {

	if($class1){$class = "class=\"$class1\"";}
	if(!$value1){
		$value = "BORRAR";
	}else{
		$value = $value1;
	}

	$html="<input type=\"button\" value=\"$value\" onClick=\"if(confirm('Desea borrar el registro \'$nombre\'?')){document.location.href='borra.php?id=$id&$name=$valor'}\" $class>";
	return $html;
}

function formBorraRegistro3($nombre,$value1,$class1,$postfields) {

	if($class1){$class = "class=\"$class1\"";}
	if(!$value1){
		$value = "BORRAR";
	}else{
		$value = $value1;
	}

	$html="<input type=\"button\" value=\"$value\" onClick=\"if(confirm('Desea borrar relación con el registro \'$nombre\'?')){document.location.href='borra.php?id=$id&$postfields'}\" $class>";
	return $html;
}

function formCambiaEstadoRegistro($estado,$id,$campo,$class1) {
	
	if($class1){$class = "class=\"$class1\"";}
	
	$html="<input type=\"button\" value=\"$estado\" onClick=\"document.location.href='cambia_estado.php?id=$id&estado=$estado&campo=$campo'\" $class>";
	return $html;
}



function formArchivoDB2($tabla, $campo, $key, $id, $valor, $nombre, $path, $tipo, $ver, $class1) {


	global $PATH_ARCHIVOS2_WEB;
	#print "PATH_ARCHIVOS_WEB -$PATH_ARCHIVOS_WEB-<br>";

	if(!$nombre){$nombre = "";}
	#if(!$value){$value = "";}
	if(!$path){$path = "";}
	if(!$tipo){$tipo = "1";} #1:archivo normal; 2:foto
	if($class1){$class = "class=\"$class1\"";}

        $cond=$id."=".$key;

	if(($id != "")&&($valor == "")){
		$query = "select $campo from $tabla where $cond";
		#printDB($query);
		$res = QueryDB($query);
		$campos = TraeDB($res);
		$value = $campos[0];
	} else {
		$value=$valor;
	}

	if($value)
	{
		if($tipo==1){
			$html .= "<tr><td><FONT SIZE=\"-1\">Actual: <B><a href=\"$PATH_ARCHIVOS2_WEB/$path/$value\" target=_NEW>$value</a></B></FONT></td></tr>\n";
		} else {
			$html .= "<tr><td><FONT SIZE=\"-1\">Actual: <B>$value <a href=\"$PATH_ARCHIVOS2_WEB/$path/$value\" target=_NEW><img src=\"$PATH_ARCHIVOS2_WEB/$path/$value\" width=30 border=1></a></FONT></td></tr>\n";
		}
	}
	if($ver != "1"){
		$html .= "<tr><td><INPUT TYPE=\"file\" NAME=\"$nombre\" $class></td></tr>";
		$html .= "\n<INPUT TYPE=\"hidden\" NAME =\"$nombre"."_old"."\" VALUE=\"$value\"></td></tr>\n";
		if($value)
		{
			$html .= "<tr><td>".form_checkbox("borr_$nombre",0);
			$html .= "<FONT SIZE = \"-1\">Borrar Archivo</FONT></td></tr>\n";
		}
	}
	$html="<table border=0>$html</table>";
	return $html;

}

function formBotonVerRegistro($href,$id,$class1) {
	
	if($class1){$class = "class=\"$class1\"";
	}else{
		$class = "class=\"boton_accion\"";
	}
	
	$html="<input type=\"button\" value=\">>\" onClick=\"document.location.href='$href?id=$id'\" $class>";
	return $html;
}


function formBotonVerRegistro2($href,$id,$class1,$nombre,$valor) {
	
	if($class1){$class = "class=\"$class1\"";
	}else{
		$class = "class=\"boton_accion\"";
	}
	
	$html="<input type=\"button\" value=\">>\" onClick=\"document.location.href='$href?id=$id&$nombre=$valor'\" $class>";
	return $html;
}

function formBotonVerRegistro3($href,$class1,$postfields) {
	
	if($class1){$class = "class=\"$class1\"";
	}else{
		$class = "class=\"boton_accion\"";
	}
	
	$html="<input type=\"button\" value=\">>\" onClick=\"document.location.href='$href?$postfields'\" $class>";
	return $html;
}


function formTesauroDB($nombre,$tabla,$key,$id,$campo,$rows,$cols,$valor,$ver,$class){


	$cond=$id."=".$key;


	if(($id != "")&&($valor == "")){

		$query = "select $campo from $tabla where $cond";

		$res = QueryDB($query);

		$campos = TraeDB($res);

		$value = $campos[0];

	} else {
		$value=$valor;
	}

	// Ventana Tesauro recibe: tabla, key y valor de key
	$boton_ventana_tesauro=<<<END
		<input type="button"  value="Asignar temas" class="boton_accion" onClick="ventana_tesauro('$tabla','$id','$key')"><br><br>
END;

	if($ver == "1"){
		print $value;

	} else {
		//$html= formTextarea_disabled($nombre, $rows, $cols, $value, $class);
		$html= formTextarea($nombre, $rows, $cols, $value, $class);
		$html.= $boton_ventana_tesauro;

		return $html;

	}

}


function javascript_ventana_tesauro()
{
	$html=<<<END
	<script>
	function ventana_tesauro(tabla,id,key)
	{
		var url;
		url='/tesauro/ficha.php?tabla='+tabla+'&id='+id+'&key='+key;
		window.open(url,'Tesauro','scrollbars=yes,resizable=yes,toolbar=no,HEIGHT=400,WIDTH=510');
	}
	</script>
END;

	return $html;
}


function formComboDB($nombre,$tabla,$key,$nombre_campo,$valor,$ver,$class) {
	
	if(!$nombre){$nombre=$key;}

	if($nombre_campo != ""){

		$query = "select $key, $nombre_campo
		from $tabla
		order by $nombre_campo";

		//print "$query";

		$p=QueryDB($query);
		
		$txt="<select name=\"$nombre\" class=\"$class\">";

		$selected="";

		while($row=TraeArrayDB($p)){
			if($valor==$row[$key]){
				$selected="selected";
				$nombre_select=$row[$nombre_campo];
			}

			$txt .=<<<END
			<option value="$row[$key]" $selected >$row[$nombre_campo]
END;
			$selected="";
		}

		$txt .="</select>";

	}
	if($ver == "1"){
		print $nombre_select;
	} else {
		return $txt;
	}

}

function formComboRed($nombre,$tabla,$key,$nombre_campo,$valor,$ver,$class) {
	
	if(!$nombre){$nombre=$key;}

	if($nombre_campo != ""){

		$query = "select $key, $nombre_campo
		from $tabla
		order by $nombre_campo";

		//print "$query";

		$p=QueryDB($query);
		
		$txt="<select name=\"$nombre\" class=\"$class\">";
		$txt.="<option value=\"\">Seleccione una opción</option>";

		$selected="";

		while($row=TraeArrayDB($p)){
			if($valor==$row[$key]){
				$selected="selected";
				$nombre_select=$row[$nombre_campo];
			}

			$txt .=<<<END
			<option value="$row[$key]" $selected >$row[$nombre_campo]
END;
			$selected="";
		}

		$txt .="</select>";

	}
	if($ver == "1"){
		print $nombre_select;
	} else {
		return $txt;
	}

}

function formComboDB2($nombre,$tabla,$key,$nombre_campo,$valor,$ver,$class,$size) {
//Agregamos el parámetro size
	if(!$size){$size=1;}
		
	if(!$nombre){$nombre=$key;}

	if($nombre_campo != ""){

		$query = "select $key, $nombre_campo
		from $tabla
		order by $nombre_campo";

		//print "$query";

		$p=QueryDB($query);

		$txt="<select name=\"$nombre\" class=\"$class\" size=\"$size\">";

		$selected="";

		while($row=TraeArrayDB($p)){
			if($valor==$row[$key]){
				$selected="selected";
				$nombre_select=$row[$nombre_campo];
			}

			$txt .=<<<END
 			<option value="$row[$key]" $selected >$row[$nombre_campo]
END;
			$selected="";
		}

		$txt .="</select>";

	}
	if($ver == "1"){
		print $nombre_select;
	} else {
		return $txt;
	}

}


function formRelacionadorDB($nombre,$tabla,$key,$id,$campo,$rows,$cols,$valor,$ver,$class,$postfields){

	if($postfields){

		$params=split('[\&]',$postfields);

		for($i=0;$i<=count($params);$i++){
			list($key,$val)= split('=',$params[$i]);
			$reg[$key]=$val;
			
		}

		$query = "select t2.$reg[id_tabla2],t2.$reg[campo_tabla2]
			from $reg[tabla2] t2, $reg[tabla_rel] tr 
			where tr.$reg[id_tabla]=$id and 
			tr.$reg[id_tabla2]=t2.$reg[id_tabla2]
			order by t2.$reg[campo_tabla2]";


		$res = QueryDB($query);

		while($campos = TraeDB($res)){

			$value .="$campos[1]\n";
		}
		if(!$value){$value="No existe relación";}
	} else {
		$value=$valor;
	}

	// Ventana Relacionador recibe: $posfields
	$boton_ventana_relacionador=<<<END
		<input type="button"  value="Relacionar..." class="formulario" onClick="ventana_relacionador('$postfields')"><br><br>
END;

	if($ver == "1"){
		print $value;

	} else {
		$html= formTextarea($nombre, $rows, $cols, $value, $class);
		$html.= $boton_ventana_relacionador;

		return $html;

	}

}


function javascript_ventana_relacionador()
{
	$html=<<<END
	<script>
	function ventana_relacionador(postfields)
	{
		var url;
		url='/admin/relacionador/listado.php?' + postfields;
		window.open(url,'Relacionador','scrollbars=yes,resizable=yes,toolbar=no,HEIGHT=400,WIDTH=450');
	}
	</script>
END;

	return $html;
}

function formRelacionadorDB_GS($nombre,$tabla,$key,$id,$campo,$rows,$cols,$valor,$ver,$class,$postfields){

	if($postfields){

		$params=split('[\&]',$postfields);

		for($i=0;$i<=count($params);$i++){
			list($key,$val)= split('=',$params[$i]);
			$reg[$key]=$val;
			
		}

		$query = "select t2.$reg[id_tabla2],t2.$reg[campo_tabla2]
			from $reg[tabla2] t2, $reg[tabla_rel] tr 
			where tr.$reg[id_tabla]=$id and 
			tr.$reg[id_tabla2]=t2.$reg[id_tabla2]
			order by t2.$reg[campo_tabla2]";


		$res = QueryDB($query);

		while($campos = TraeDB($res)){

			$value .="$campos[1]\n";
		}
		if(!$value){$value="No existe relación";}
	} else {
		$value=$valor;
	}

	// Ventana Relacionador recibe: $posfields
	$boton_ventana_relacionador=<<<END
		<input type="button"  value="Relacionar..." class="formulario" onClick="ventana_relacionador_GS('$postfields')"><br><br>
END;

	if($ver == "1"){
		print $value;

	} else {
		$html= formTextarea($nombre, $rows, $cols, $value, $class);
		$html.= $boton_ventana_relacionador;

		return $html;

	}

}


function javascript_ventana_relacionador_GS()
{
	$html=<<<END
	<script>
	function ventana_relacionador_GS(postfields)
	{
		var url;
		url='/admin/relacionador/listado.php?' + postfields;
		window.open(url,'Relacionador','scrollbars=yes,resizable=yes,toolbar=no,HEIGHT=400,WIDTH=450');
	}
	</script>
END;

	return $html;
}

?>
