<?php

function fncTrataDados($dados){
	return $dados;
}

function jf_anti_injection($sql) {
    $sql = preg_replace(sql_regcase("/(from|select|insert|delete|where|drop table|show tables|#|*|--|\)/"),"",$sql);
    $sql = trim($sql);
    $sql = strip_tags($sql);
    $sql = addslashes($sql);
    return $sql;
}

function geraSaltAleatorio($tamanho = 22) {
    return substr(sha1(mt_rand()), 0, $tamanho);  
}

function fnc_maiusculas($str) {
	return strtr(strtoupper($str),"АЮЦБДИХКЙМЛОНСРЖУТЗЫЭШГ","аюцбдихкймлонсржутзыэшг");
}

function fnc_minusculas($str) {
	return strtr(strtolower($str),"аюцбдихкймлонсржутзыэшг", "aaaaaeeeeiiiiooooouuuuc");
}


function fnc_formata_data($data){
	$data2 = substr($data, 6, 4) . "-" . substr($data, 3, 2) . "-" . substr($data, 0, 2);	
	return $data2;
}

function fnc_data_formatada($data){
	$dia = substr($data, 8 , 2);
	$mes = substr($data, 5 , 2); 
    $ano = substr($data, 0 , 4); 
	return "$dia/$mes/$ano";
}
	
function converteSegundos($tempo){
    if($tempo != ""){
        $array = explode(":", $tempo); 
        $hor = $array[0]; 
        $min = $array[1]; 

        $horas_em_segundos = $hor * 3600; //transforma as horas em segundos 
        $minutos_em_segundos = $min * 60; //transforma os minutos em segundos 

        $tempo_em_segundos = $horas_em_segundos + $minutos_em_segundos; //soma todos os segundos 

        return $tempo_em_segundos;
    }
}

function converteHoras($segundos){
    $horas = 0;
    $horas = floor($segundos / 3600); 
    $segundos -= $horas * 3600; 
    $minutos = floor($segundos / 60); 
    $segundos -= $minutos * 60; 

    if ($horas < 10) $horas = "0".$horas; 
    if ($minutos < 10) $minutos = "0".$minutos; 

    return $horas.":".$minutos; 

}


function Mes($mes){
	switch($mes){
		case 01:
			$nome_mes = "Janeiro";
		break;
		case 02:
			$nome_mes = "Fevereiro";
		break;
		case 03:
			$nome_mes = "Marц╖o";
		break;
		case 04:
			$nome_mes = "Abril";
		break;
		case 05:
			$nome_mes = "Maio";
		break;
		case 06:
			$nome_mes = "Junho";
		break;
		case 07:
			$nome_mes = "Julho";
		break;
		case 08:
			$nome_mes = "Agosto";
		break;
		case 09:
			$nome_mes = "Setembro";
		break;
		case 10:
			$nome_mes = "Outubro";
		break;
		case 11:
			$nome_mes = "Novembro";
		break;
		case 12:
			$nome_mes = "Dezembro";
		break;
	}
	
	return $nome_mes;
	
	
	
}



?>