function class_activo(elem)
	{
	clear_menu();
	window.document.getElementById(elem).className='activelink'
	}

function clear_menu(){

	window.document.getElementById('home').className='';
	window.document.getElementById('pub').className='';
	window.document.getElementById('ind').className='';
}

function navegacion()
{

var esc_head  
	 
esc_head = "<ul id='nav'>"
esc_head = esc_head + "<li id='home'><a href='./'>Portada</a></li>"
esc_head = esc_head + "<li id='pub'><a href='Publicaciones.htm'>Publicaciones</a></li>"
esc_head = esc_head + "<li id='ind'><a href='Indicadores.htm'>Indicadores</a></li>"
esc_head = esc_head + "<li><a href='mailto:ernesto.espindola@cepal.org'>Contacto</a></li>"
esc_head = esc_head + "</ul>"

return esc_head
}

document.write(navegacion())

