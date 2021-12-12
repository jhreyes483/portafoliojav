function readCookie(name) {
	var nameEQ = name + "=";
	var ca = document.cookie.split(';');
	for(var i=0;i < ca.length;i++) {
		var c = ca[i];
		while (c.charAt(0)==' ') c = c.substring(1,c.length);
		if (c.indexOf(nameEQ) == 0) {
			var texto= c.substring(nameEQ.length,c.length);
			texto = unescape(texto.replace(/[+]/gi, ' '));
			return texto
		}
	}
	return null;
}


function PopupForm(a, h, nombre){ //evita q FF abra en ventana inicial cuando se abre desde frm
	nVentana('',1, a, h, nombre);
}


function nVentana(direc, res, w, h, nombre){
	if (!res) res="no";
	if(!nombre) nombre="inedITTo_Especial";
	nv=window.open(direc, nombre, 'toolbar=0,location=0,directories=0,status=0, menubar=0,scrollbars=1,resizable='+ res +', menubar=0,width=' + w + ', height='+ h +', left=100, top=100');
	if (nv && nv.open){
		nv.focus();
	}else{
		alert("Su sistema tiene un Bloqueador de Popups Activo\n\nEs necesario que habilite las ventanas emergentes para ineditto.com\npara esto, vaya al menu \"Herramientas/Opciones\" de su navegador\ny en la pestaña \"Contenido\", agregue como excepción a ineditto.com");
	}
}

function buscaParent(el, tipo){
   while (el.parentNode) {
      el = el.parentNode;
      if (el.nodeName== tipo) {
         return el;
      }
  }
  return null;
}

function alCambiar(id){
	self.location="?co="+id;
}


function redirect(pag, dest) {
	if (dest != undefined) {
		window.open(pag, dest);
	} else {
		window.location = pag;
	}
}

function fConfirma(texto){
	if (confirm(texto))
		return true;
	else
		return false;
}



function textarea() {
	var maximos = new Array ();
	$("textarea").attr("maxlength", function (i) {
		if (maximos[i] == this.getAttribute('maxlength')) {
			$(this).keypress(function(event) {
				return ((event.which == 8) || (event.which == 9) || (this.value.length < maximos[i]));
			});
		}
	});
}

function solonumeros(caja){
	numero = caja.value;
	if (!/^([0-9])*$/.test(numero)){
		alert ('Por favor ingrese un valor que contenga solo números');	
		caja.focus();
		return false;
	}
	return true;
}


function adicionaDir(id, idC){
	if (id=='nuevaDir') nVentana('/admin/ClientesActualizaDir.php?r=1&idC='+idC,1, 500,350,'Ineditto_Direcciones');
}

function marcarchk(){
	$("#checkAll").click(function(){
		var checked_status = this.checked;
		$("input:checkbox").each(function() {
			this.checked = checked_status;
		});
	});			
}

function formatNum(nNmb, dec){
	return $.number(nNmb, dec);
}

function desformatNum(texto, sep="."){
	if(texto != ''){
		var vSep = texto.split(sep);
		sRes = 	vSep.join('');
		return sRes;
	}
}