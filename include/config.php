<?php
    define('RAIZ', "./");
    define('TITLE_ADMIN', "");
  
    define("LOGO", "images/Logo.jpg");
    define("LOGO_FAVICON", "Logo.jpg");
	
	define("VALOR_CONSULTA", "300.00");
	define("ENDERECO", "R. São Luis, 201 Sala 9");
	define("TELEFONE", "(14) 3492-1497/ (14) 3492-3863");

    date_default_timezone_set('America/Sao_Paulo');

    $valorinicio = "09:10";
    $valorfim = "18:20";
    $valorsoma = "00:50";
	
	//clinica que trabalha com horarios fixos
	$horarios = array("09:10", "10:00", "10:50", "11:40", "12:30","13:20", "14:00", "14:50","15:40", "16:00", "16:30", "17:00", "17:20", "18:10");
	
	$_agenda_fitra_por = "Psiquiatra";

    $usa_campo_convenio = "t";

	$_upload_foto_paciente = true;

    $_clinica_atendente = "Secretária";

    $_clinica_medico = "Psiquiatra";

?>