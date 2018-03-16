<?php
    define('RAIZ', "./");
    define('TITLE_ADMIN', "");
  
    define("LOGO", "images/Logo.png");
    define("LOGO_FAVICON", "Logo.png");
	
	define("VALOR_CONSULTA", "300.00");
	define("ENDERECO", "R. São Tomé, 592");
	define("TELEFONE", "(14) 99828-1218");

    date_default_timezone_set('America/Sao_Paulo');

    $valorinicio = "08:00";
    $valorfim = "18:00";
    $valorsoma = "01:00";
	
	//clinica que trabalha com horarios fixos
	$horarios = array("08:00", "09:00", "10:00", "11:00", "12:00","13:00", "14:00", "15:00","16:00", "17:00", "18:00");
	
	$_agenda_fitra_por = "Psiquiatra";

    $usa_campo_convenio = "t";

	$_upload_foto_paciente = true;

    $_clinica_atendente = "Secretária";

    $_clinica_medico = "Psiquiatra";

?>