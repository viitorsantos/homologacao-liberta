// JavaScript Document
//adiciona mascara de cnpj
function MascaraCNPJ(cnpj){
        if(mascaraInteiro(cnpj)==false){
                event.returnValue = false;
        }       
        return formataCampo(cnpj, '00.000.000/0000-00', event);
}

function MascaraCRM(crm){
	if(mascaraInteiro(crm)==false){
		event.returnValue = false;
	}
	return formataCampo(crm, '0000000/**', event);
}

//adiciona mascara de cep
function MascaraCep(cep){
                if(mascaraInteiro(cep)==false){
                event.returnValue = false;
        }       
        return formataCampo(cep, '00000-000', event);
}

//adiciona mascara de data
function MascaraData(data){
        if(mascaraInteiro(data)==false){
                event.returnValue = false;
        }       
        return formataCampo(data, '00/00/0000', event);
}

//adiciona mascara ao telefone
function MascaraTelefone(tel){  
        if(mascaraInteiro(tel)==false){
                event.returnValue = false;
        }       
        return formataCampo(tel, '(00) 0000-0000', event);
}
 
function MascaraCelularDDD(tel){  
        if(mascaraInteiro(tel)==false){
                event.returnValue = false;
        }       
        return formataCampo(tel, '(00) 00000-0000', event);
}

//adiciona mascara ao ddd_telefone
function MascaraDDD(ddd_tel){
    if(mascaraInteiro(ddd_tel)==false){
        event.returnValue = false;
    }
    return formataCampo(ddd_tel, '(00)', event);
}

//adiciona mascara ao telefone sem ddd
function MascaraTel(telefone){  
        if(mascaraInteiro(telefone)==false){
                event.returnValue = false;
        }       
        return formataCampo(telefone, '0000-0000', event);
}

//adiciona mascara ao ddd_celular
function MascaraDDD(ddd_cel){
    if(mascaraInteiro(ddd_cel)==false){
        event.returnValue = false;
    }
    return formataCampo(ddd_cel, '(00)', event);
}

//adiciona mascara ao celular
function MascaraCel(celular){  
        if(mascaraInteiro(celular)==false){
                event.returnValue = false;
        }       
        return formataCampo(celular, '00000-0000', event);
}

//adiciona mascara de rg
function MascaraRG(rg){
    if(mascaraInteiro(rg)==false){
        event.returnValue = false;
    }
    return formataCampo(rg, '00.000.000-*', event);
}

//adiciona mascara ao CPF
function MascaraCPF(cpf){
        if(mascaraInteiro(cpf)==false){
                event.returnValue = false;
        }       
        return formataCampo(cpf, '000.000.000-00', event);
}

//valida telefone
function ValidaTelefone(tel){
        exp = /\(\d{2}\)\ \d{4}\-\d{4}/
        if(!exp.test(tel.value))
                alert('Numero de Telefone Invalido!');
}

//valida ddd_telefone
function ValidaDDD(ddd_tel){
    exp = /\d{2}/
    if(!exp.test(ddd_tel.value))
        alert('Numero do DDD Invalido');
}

//valida telefone sem ddd
function ValidaTel(telefone){
        exp = /\d{4}\-\d{4}/
        if(!exp.test(telelefone.value))
                alert('Numero de Telefone Invalido!');
}

//valida ddd_celular
function ValidaDDD(ddd_cel){
    exp = /\d{2}/
    if(!exp.test(ddd_cel.value))
        alert('Numero do DDD Invalido');
}

//valida Celular
function ValidaCel(celular){
	exp = /\d{4}\-\d{4}/
	if(!exp.test(celular.value))
		alert('Numero de celular invalido!');
}

//valida CEP
function ValidaCep(cep){
        exp = /\d{2}\.\d{3}\-\d{3}/
        if(!exp.test(cep.value))
                alert('Numero de Cep Invalido!');               
}

//valida data
function ValidaData(data){
        exp = /\d{2}\/\d{2}\/\d{4}/
        if(!exp.test(data.value))
                alert('Data Invalida!');                        
}

//valida o CPF digitado
function ValidarCPF(Objcpf){
        var cpf = Objcpf.value;
        exp = /\.|\-/g
        cpf = cpf.toString().replace( exp, "" ); 
        var digitoDigitado = eval(cpf.charAt(9)+cpf.charAt(10));
        var soma1=0, soma2=0;
        var vlr =11;

        for(i=0;i<9;i++){
                soma1+=eval(cpf.charAt(i)*(vlr-1));
                soma2+=eval(cpf.charAt(i)*vlr);
                vlr--;
        }       
        soma1 = (((soma1*10)%11)==10 ? 0:((soma1*10)%11));
        soma2=(((soma2+(2*soma1))*10)%11);

        var digitoGerado=(soma1*10)+soma2;
        if(digitoGerado!=digitoDigitado)        
                alert('CPF Invalido!');         
}

//valida numero inteiro com mascara
function mascaraInteiro(){
        if (event.keyCode < 48 || event.keyCode > 57){
                event.returnValue = false;
                return false;
        }
        return true;
}

//valida o CNPJ digitado
function ValidarCNPJ(ObjCnpj){
        var cnpj = ObjCnpj.value;
        var valida = new Array(6,5,4,3,2,9,8,7,6,5,4,3,2);
        var dig1= new Number;
        var dig2= new Number;

        exp = /\.|\-|\//g
        cnpj = cnpj.toString().replace( exp, "" ); 
        var digito = new Number(eval(cnpj.charAt(12)+cnpj.charAt(13)));

        for(i = 0; i<valida.length; i++){
                dig1 += (i>0? (cnpj.charAt(i-1)*valida[i]):0);  
                dig2 += cnpj.charAt(i)*valida[i];       
        }
        dig1 = (((dig1%11)<2)? 0:(11-(dig1%11)));
        dig2 = (((dig2%11)<2)? 0:(11-(dig2%11)));

        if(((dig1*10)+dig2) != digito)  
                alert('CNPJ Invalido!');

}

//formata de forma generica os campos
function formataCampo(campo, Mascara, evento) { 
        var boleanoMascara; 

        var Digitato = evento.keyCode;
        exp = /\-|\.|\/|\(|\)| /g
        campoSoNumeros = campo.value.toString().replace( exp, "" ); 

        var posicaoCampo = 0;    
        var NovoValorCampo="";
        var TamanhoMascara = campoSoNumeros.length;; 

        if (Digitato != 8) { // backspace 
                for(i=0; i<= TamanhoMascara; i++) { 
                        boleanoMascara  = ((Mascara.charAt(i) == "-") || (Mascara.charAt(i) == ".")
                                                                || (Mascara.charAt(i) == "/")) 
                        boleanoMascara  = boleanoMascara || ((Mascara.charAt(i) == "(") 
                                                                || (Mascara.charAt(i) == ")") || (Mascara.charAt(i) == " ")) 
                        if (boleanoMascara) { 
                                NovoValorCampo += Mascara.charAt(i); 
                                  TamanhoMascara++;
                        }else { 
                                NovoValorCampo += campoSoNumeros.charAt(posicaoCampo); 
                                posicaoCampo++; 
                          }              
                  }      
                campo.value = NovoValorCampo;
                  return true; 
        }else { 
                return true; 
        }
}