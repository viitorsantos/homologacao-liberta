function Formatadata(Campo, teclapres){
	var tecla = teclapres.keyCode;
	var vr = new String(Campo.value);
	vr = vr.replace("/", "");
	vr = vr.replace("/", "");
	vr = vr.replace("/", "");
	tam = vr.length + 1;
	if (tecla != 8 && tecla != 8)
	{
		if (tam > 0 && tam < 2)
			Campo.value = vr.substr(0, 2) ;
		if (tam > 2 && tam < 4)
			Campo.value = vr.substr(0, 2) + '/' + vr.substr(2, 2);
		if (tam > 4 && tam < 7)
			Campo.value = vr.substr(0, 2) + '/' + vr.substr(2, 2) + '/' + vr.substr(4, 7);
	}
}



function Mascara_Hora(campo, name, teclapres){

	var tecla = teclapres.keyCode;
	var hora01 = ''; 
	hora01 = hora01 + campo;
	if((tecla != 8) && (tecla != 46)){
		if (hora01.length == 2){ 
		hora01 = hora01 + ':'; 
		//document.forms[0].elements(name).value = hora01; 
		document.getElementById(name).value = hora01;
		}
		var aux = hora01.length;
	}
	if (hora01.length == 5){
	Verifica_Hora(campo, name); 
	} 
} 
   

function Verifica_Hora(campo, name){

	hrs = (campo.substring(0,2)); 

	min = (campo.substring(3,5)); 

					   

	estado = "";

	if ((hrs < 00 ) || (hrs > 23) || ( min < 00) ||( min > 59)){ 

	estado = "errada"; 

	

	} 

				   

	if (name.value == "") { 

		estado = "errada"; 

	} 



	if (estado == "errada") { 

	alert("Hora inválida!");

	document.getElementById(name).value = '';//linha para apagar todo o campo e o usuário poder digitar nova hora 

	name.focus();

	} 

}



function SomenteNumero(e){

	var tecla=(window.event)?event.keyCode:e.which;   

	if((tecla>47 && tecla<58)) return true;

	else{

		if (tecla==8 || tecla==0) return true;

	else  return false;

	}

}


function FormataReais(fld, milSep, decSep, e) {

	var sep = 0;

	var key = '';

	var i = j = 0;

	var len = len2 = 0;

	var strCheck = '0123456789';

	var aux = aux2 = '';

	var whichCode = (window.Event) ? e.which : e.keyCode;

	if (whichCode == 13) return true;

	key = String.fromCharCode(whichCode);  // Valor para o código da Chave

	if (strCheck.indexOf(key) == -1) return false;  // Chave inválida

	len = fld.value.length;

	for(i = 0; i < len; i++)

	if ((fld.value.charAt(i) != '0') && (fld.value.charAt(i) != decSep)) break;

	aux = '';

	for(; i < len; i++)

	if (strCheck.indexOf(fld.value.charAt(i))!=-1) aux += fld.value.charAt(i);

	aux += key;

	len = aux.length;

	if (len == 0) fld.value = '';

	if (len == 1) fld.value = '0'+ decSep + '0' + aux;

	if (len == 2) fld.value = '0'+ decSep + aux;

	if (len > 2) {

	aux2 = '';

	for (j = 0, i = len - 3; i >= 0; i--) {

	if (j == 3) {

	aux2 += milSep;

	j = 0;

	}

	aux2 += aux.charAt(i);

	j++;

	}

	fld.value = '';

	len2 = aux2.length;

	for (i = len2 - 1; i >= 0; i--)

	fld.value += aux2.charAt(i);

	fld.value += decSep + aux.substr(len - 2, len);

	}

	return false;

}

//Fim da Função FormataReais -->

