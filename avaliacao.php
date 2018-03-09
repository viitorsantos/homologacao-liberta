<?php
    include "include/conexao.php";
    include "include/config.php";
    include "include/funcoes.php";
	include "include/verifica_usuario.php";

    if(isset($_POST["btnacao"])){
		
		// add cliente nas tables	
        
		$avaliacao_id		= 		fncTrataDados($_POST["avaliacao_id"]); 
		$peso 				= 		fncTrataDados($_POST["peso"]);
		$altura				= 		fncTrataDados($_POST["altura"]);
		$calcado 			= 		fncTrataDados($_POST["calcado"]);
		$tipo_calcado 		= 		fncTrataDados($_POST["tipo_calcado"]);
		$cirurgia 			= 		fncTrataDados($_POST["cirurgia"]);
		$esporte 			= 		fncTrataDados($_POST["esporte"]);
		$medicacao			= 		fncTrataDados($_POST["medicacao"]);
		$dor_queixa 		= 		fncTrataDados($_POST["dor_queixa"]);
		$hipertensao 		= 		(fncTrataDados($_POST["hipertensao"]) == 't') ? 't' : 'f';
		$vascular 			= 		(fncTrataDados($_POST["vascular"]) == 't') ? 't' : 'f';
		$diabetes 			= 		(fncTrataDados($_POST["diabetes"]) == 't') ? 't' : 'f';
		$alergia			= 		(fncTrataDados($_POST["alergia"]) == 't') ? 't' : 'f';
		$tabagismo			= 		(fncTrataDados($_POST["tabagismo"]) == 't') ? 't' : 'f';
		$neuropatias		= 		(fncTrataDados($_POST["neuropatias"]) == 't') ? 't' : 'f';
		$meia_algodao		= 		(fncTrataDados($_POST["meia_algodao"]) == 't') ? 't' : 'f';
		$meia_sintetica		= 		(fncTrataDados($_POST["meia_sintetica"]) == 't') ? 't' : 'f';
		$trabalha_sentado   = 		(fncTrataDados($_POST["trabalha_sentado"]) == 't') ? 't' : 'f'; 
		$trabalha_em_pe     = 		(fncTrataDados($_POST["trabalha_em_pe"]) == 't') ? 't' : 'f';
		$trabalha_andando 	= 		(fncTrataDados($_POST["trabalha_andando"]) == 't') ? 't' : 'f';
		$vacina_antitetano  = 		(fncTrataDados($_POST["vacina_antitetano"]) == 't') ? 't' : 'f';
		$vacina_antitetana_tempo =  fncTrataDados($_POST["vacina_antitetana_tempo"]);
		$ja_foi_podologo    = 		(fncTrataDados($_POST["ja_foi_podologo"]) == 't') ? 't' : 'f';
		$quanto_tempo       = 		fncTrataDados($_POST["quanta_tempo"]);
		$palmilha			= 		(fncTrataDados($_POST["palmilha"]) == 't') ? 't' : 'f'; 
		$palmilha_obs 		= 		fncTrataDados($_POST["palmilha_obs"]); 
		
		$paciente_id		= 		fncTrataDados($_POST["paciente_id"]); 
		
		$anamnese_id		= 		fncTrataDados($_POST["anamnese_id"]);
		$quadrado			= 		(fncTrataDados($_POST["pe_quadrado"]) == 't') ? 't' : 'f';
		$plano				= 		(fncTrataDados($_POST["pe_plano"]) == 't') ? 't' : 'f';
		$varo				= 		(fncTrataDados($_POST["pe_varo"]) == 't') ? 't' : 'f';
		$grego				= 		(fncTrataDados($_POST["pe_grego"]) == 't') ? 't' : 'f';
		$cavo				= 		(fncTrataDados($_POST["pe_cavo"]) == 't') ? 't' : 'f';
		$valgo				= 		(fncTrataDados($_POST["pe_valgo"]) == 't') ? 't' : 'f';
		$egipcio			= 		(fncTrataDados($_POST["pe_egipcio"]) == 't') ? 't' : 'f';
		$espalmado			= 		(fncTrataDados($_POST["pe_espalmado"]) == 't') ? 't' : 'f';
		$equino				= 		(fncTrataDados($_POST["pe_equino"]) == 't') ? 't' : 'f';
		$pe_obs				= 		fncTrataDados($_POST["pe_obs"]);
		$martelo			= 		(fncTrataDados($_POST["artelho_martelo"]) == 't') ? 't' : 'f';
		$halux_rigidus		= 		(fncTrataDados($_POST["artelho_halux_rigidus"]) == 't') ? 't' : 'f';
		$halux_valgus		= 		(fncTrataDados($_POST["artelho_halux_valgus"]) == 't') ? 't' : 'f';
		$garra				= 		(fncTrataDados($_POST["artelho_garra"]) == 't') ? 't' : 'f';
		$bunionete			= 		(fncTrataDados($_POST["artelho_bunionete"]) == 't') ? 't' : 'f';
		$golfe				= 		(fncTrataDados($_POST["artelho_golfe"]) == 't') ? 't' : 'f';
		$obs_artelho		= 		fncTrataDados($_POST["artelho_obs"]);
		$unhas_normal		= 		(fncTrataDados($_POST["unha_normal"]) == 't') ? 't' : 'f';
		$telha_provenca		= 		(fncTrataDados($_POST["unha_telha_provenca"]) == 't') ? 't' : 'f';
		$involuta			= 		(fncTrataDados($_POST["unha_involuta"]) == 't') ? 't' : 'f';
		$gancho				= 		(fncTrataDados($_POST["unha_gancho"]) == 't') ? 't' : 'f';
		$telha				= 		(fncTrataDados($_POST["unha_telha"]) == 't') ? 't' : 'f';
		$caracol			= 		(fncTrataDados($_POST["unha_caracol"]) == 't') ? 't' : 'f';
		$afunilada          = 		(fncTrataDados($_POST["unha_afunilada"]) == 't') ? 't' : 'f';
		$obs_unhas			= 		fncTrataDados($_POST["unha_obs"]);
		$pele_obs			= 		fncTrataDados($_POST['pele_obs']);
		$pulso_normal		= 		(fncTrataDados($_POST["pulso_normal"]) == 't') ? 't' : 'f';
		$bradicardia		= 		(fncTrataDados($_POST["pulso_bradicardia"]) == 't') ? 't' : 'f';
		$taquicardia		= 		(fncTrataDados($_POST["pulso_taquicardia"]) == 't') ? 't' : 'f';
		$perfusao_normal	= 		(fncTrataDados($_POST["perfusao_normal"]) == 't') ? 't' : 'f';
		$cianotico			= 		(fncTrataDados($_POST["perfusao_cianotica"]) == 't') ? 't' : 'f';
		$palido				= 		(fncTrataDados($_POST["perfusao_palido"]) == 't') ? 't' : 'f';
		$temp_normal		= 		(fncTrataDados($_POST["temp_normal"]) == 't') ? 't' : 'f';
		$temp_fria			= 		(fncTrataDados($_POST["temp_fria"]) == 't') ? 't' : 'f';
		$temp_febre			= 		(fncTrataDados($_POST["temp_febre"]) == 't') ? 't' : 'f';
		$pressao_arterial 	= 		fncTrataDados($_POST["pressao_arterial"]);
		$pressao_tibial		= 		fncTrataDados($_POST["pressao_tibial"]);
		$hiperidrose		= 		(fncTrataDados($_POST["hiperidrose"]) == 't') ? 't' : 'f';
		$anidrose			= 		(fncTrataDados($_POST["anidrose"]) == 't') ? 't' : 'f';
		$bromidose			= 		(fncTrataDados($_POST["bromidose"]) == 't') ? 't' : 'f';
		$tinha_pedis		= 		(fncTrataDados($_POST["tinha_pedis"]) == 't') ? 't' : 'f';
		$tinha_interdigital = 		(fncTrataDados($_POST["tinha_interdigital"]) == 't') ? 't' : 'f';
		$fissuras           = 		(fncTrataDados($_POST["fissuras"]) == 't') ? 't' : 'f';
		$onicolise			= 		(fncTrataDados($_POST["onicolise"]) == 't') ? 't' : 'f';
		$onicoatrofia		= 		(fncTrataDados($_POST["onicoatrofia"]) == 't') ? 't' : 'f';
		$onicogrifose		= 		(fncTrataDados($_POST["onicogrifose"]) == 't') ? 't' : 'f';
		$onicoesclerose		= 		(fncTrataDados($_POST["onicoesclerose"]) == 't') ? 't' : 'f';
		$onicofose			= 		(fncTrataDados($_POST["onicofose"]) == 't') ? 't' : 'f';
		$onicomicose		= 		(fncTrataDados($_POST["onicomicose"]) == 't') ? 't' : 'f';
		$obs_patologias		= 		fncTrataDados($_POST["patologia_obs"]);
		$dorsal				= 		(fncTrataDados($_POST["calos_dorsal"]) == 't') ? 't' : 'f';
		$interdigital		= 		(fncTrataDados($_POST["calos_interdigital"]) == 't') ? 't' : 'f';
		$plantar			= 		(fncTrataDados($_POST["calos_plantar"]) == 't') ? 't' : 'f';
		$verrugas_plantar	= 		(fncTrataDados($_POST["calos_verruga_plantar"]) == 't') ? 't' : 'f';
		$tungiase			= 		(fncTrataDados($_POST["calos_tungiase"]) == 't') ? 't' : 'f';
		$nevos				= 		(fncTrataDados($_POST["calos_nevos"]) == 't') ? 't' : 'f';
		$ungueal			= 		(fncTrataDados($_POST["hiperqueratose_ungueal"]) == 't') ? 't' : 'f';
		$hiperqueratose_plantar	 =  (fncTrataDados($_POST["hiperqueratose_plantar"]) == 't') ? 't' : 'f';
		$hiperqueratose_obs	= 		fncTrataDados($_POST["hiperqueratose_obs"]);
		$edema			    = 		(fncTrataDados($_POST["onococriptose_edema"]) == 't') ? 't' : 'f';
		$eritema			= 		(fncTrataDados($_POST["onococriptose_eritema"]) == 't') ? 't' : 'f';
		$granuloma			= 		(fncTrataDados($_POST["onococriptose_granuloma"]) == 't') ? 't' : 'f';
		$pus				= 		(fncTrataDados($_POST["onococriptose_pus"]) == 't') ? 't' : 'f';
		$espicula			= 		(fncTrataDados($_POST["onococriptose_espicula"]) == 't') ? 't' : 'f';
		$observacao			= 		fncTrataDados($_POST["observacao"]);		
		
        if(empty($erro)){
            if($avaliacao_id == 0 and anamnese_id == 0){// verifica os dois.
                $sql_avaliacao = "INSERT INTO tbl_avaliacao
						(
							peso,
							altura,
							trabalha_sentado,
							trabalha_em_pe,
							trabalha_andando,
							esporte,
							calcado,
							tipo_calcado,
							meia_algodao,
							meia_sintetica,
							hipertensao,
							vascular,
							diabetes,
							alergia,
							tabagismo,
							neuropatias,
							cirurgia,
							vacina_antitetano,
							vacina_antitetana_tempo,
							medicacao,
							dor_queixa,
							ja_foi_podologo,
							quanta_tempo,
							palmilha,
							palmilha_obs,
							paciente_id,
							empresa_id
						)
						values
						(
							'$peso',
							'$altura',
							'$trabalha_sentado',
							'$trabalha_em_pe',
							'$trabalha_andando',
							'$esporte',
							'$calcado',
							'$tipo_calcado',
							'$meia_algodao',
							'$meia_sintetica',
							'$hipertensao',
							'$vascular',
							'$diabetes',
							'$alergia',
							'$tabagismo',
							'$neuropatias',
							'$cirurgia',
							'$vacina_antitetano',
							'$vacina_antitetana_tempo',
							'$medicacao',
							'$dor_queixa',
							'$ja_foi_podologo',
							'$quanto_tempo',
							'$palmilha',
							'$palmilha_obs',
							'$paciente_id',
							".EMPRESA."	)";
						
						
						$sql_anamnese = "INSERT INTO tbl_anammnese (pe_quadrado,
							pe_plano,
							pe_varo,
							pe_grego,
							pe_cavo,
							pe_valgo,
							pe_egipcio,
							pe_espalmado,
							pe_equino,
							pe_obs,
							artelho_martelo,
							artelho_halux_rigidus,
							artelho_halux_valgus,
							artelho_garra,
							artelho_bunionete,
							artelho_golfe,
							artelho_obs,
							unha_normal,
							unha_telha_provenca,
							unha_involuta,
							unha_gancho,
							unha_telha,
							unha_caracol,
							unha_afunilada,
							unha_obs,
							pele_obs,
							pulso_normal,
							pulso_bradicardia,
							pulso_taquicardia,
							perfusao_normal,
							perfusao_cianotica,
							perfusao_palido,
							temp_normal,
							temp_fria,
							temp_febre,
							pressao_arterial,
							pressao_tibial,
							hiperidrose,
							anidrose,
							bromidose,
							onicolise,
							onicoatrofia,
							onicogrifose,
							onicoesclerose,
							onicofose,
							tinha_pedis,
							tinha_interdigital,
							fissuras,
							onicomicose,
							patologia_obs,
							calos_dorsal,
							calos_interdigital,
							calos_plantar,
							calos_verruga_plantar,
							calos_tungiase,
							calos_nevos,
							hiperqueratose_ungueal,
							hiperqueratose_plantar,
							hiperqueratose_obs,
							onococriptose_edema,
							onococriptose_eritema,
							onococriptose_granuloma,
							onococriptose_pus,
							onococriptose_espicula,
							observacao,
							paciente_id,
							empresa_id) 
							
							VALUES ('$quadrado',
								'$plano',
								'$varo',
								'$grego',
								'$cavo',
								'$valgo',
								'$egipcio',
								'$espalmado',
								'$equino',
								'$pe_obs',
								'$martelo',
								'$halux_rigidus',
								'$halux_valgus',
								'$garra',
								'$bunionete',
								'$golfe',
								'$obs_artelho',
								'$unhas_normal',
								'$telha_provenca',
								'$involuta',
								'$gancho',
								'$telha',
								'$caracol',
								'$afunilada',
							    '$obs_unhas',
							    '$pele_obs',
								'$pulso_normal',
								'$bradicardia',
								'$taquicardia',
								'$perfusao_normal',
								'$cianotico',
								'$palido',
								'$temp_normal',
								'$temp_fria',
								'$temp_febre',
								'$pressao_arterial',
								'$pressao_tibial',
								'$hiperidrose',
								'$anidrose',
								'$bromidose',
								'$onicolise',
								'$onicoatrofia',
								'$onicogrifose',
								'$onicoesclerose',
								'$onicofose',	
								'$tinha_pedis',
								'$tinha_interdigital',
								'$fissuras',
								'$onicomicose',
								'$obs_patologias',
								'$dorsal',
								'$interdigital',
								'$plantar',
								'$verrugas_plantar',
								'$tungiase',
								'$nevos',
								'$ungueal',
								'$hiperqueratose_plantar',
								'$hiperqueratose_obs',
								'$edema',
								'$eritema',
								'$granuloma',
								'$pus',
								'$espicula',
								'$observacao',
								'$paciente_id',
							    ".EMPRESA.")";		
            }else{
                $sql_avaliacao = "UPDATE tbl_avaliacao SET peso = '$peso',
                								 altura = '$altura',
                								 trabalha_sentado = '$trabalha_sentado',
												 trabalha_em_pe = '$trabalha_em_pe',
												 trabalha_andando = '$trabalha_andando',
												 esporte = '$esporte',
												 calcado = '$calcado',
												 tipo_calcado = '$tipo_calcado',
												 meia_algodao = '$meia_algodao',
												 meia_sintetica = '$meia_sintetica',
												 hipertensao = '$hipertensao',
												 vascular = '$vascular',
												 diabetes = '$diabetes',
												 alergia = '$alergia',
										 		 tabagismo = '$tabagismo',
												 neuropatias = '$neuropatias',					 
												 cirurgia = '$cirurgia',
												 vacina_antitetano = '$vacina_antitetano',
												 vacina_antitetana_tempo = '$vacina_antitetana_tempo',
												 medicacao = '$medicacao',
												 dor_queixa = '$dor_queixa',
												 ja_foi_podologo = '$ja_foi_podologo',
												 quanta_tempo = '$quanto_tempo',
												 palmilha = '$palmilha',
												 palmilha_obs = '$palmilha_obs',
												 paciente_id = '$paciente_id',
												 empresa_id = ".EMPRESA."
												 WHERE avaliacao = $avaliacao_id and empresa_id = ".EMPRESA;
												

				$sql_anamnese = "UPDATE tbl_anammnese SET pe_quadrado = '$quadrado',		  
														  pe_plano = '$plano',
														  pe_varo = '$varo',
														  pe_grego = '$grego',
														  pe_cavo = '$cavo',
														  pe_valgo = '$valgo',
														  pe_egipcio = '$egipcio',
														  pe_espalmado = '$espalmado',
														  pe_equino = '$equino',
														  pe_obs = '$pe_obs',
														  artelho_martelo = '$martelo',
														  artelho_halux_rigidus = '$halux_rigidus',
														  artelho_halux_valgus = '$halux_valgus',
														  artelho_garra = '$garra',
														  artelho_bunionete = '$bunionete',
														  artelho_golfe = '$golfe',
														  artelho_obs = '$obs_artelho',
										          		  unha_normal = '$unhas_normal',
														  unha_telha_provenca = '$telha_provenca',
												          unha_involuta = '$involuta',
												          unha_gancho = '$gancho',
												          unha_telha = '$telha',
												          unha_caracol = '$caracol',
												          unha_afunilada = '$afunilada',
												          unha_obs = '$obs_unhas',
												          pele_obs = '$pele_obs',
												          pulso_normal = '$pulso_normal',
														  pulso_bradicardia = '$bradicardia',
														  pulso_taquicardia = '$taquicardia',
														  perfusao_normal = '$perfusao_normal',
														  perfusao_cianotica = '$cianotico',
														  perfusao_palido = '$palido',
														  temp_normal = '$temp_normal',
														  temp_fria = '$temp_fria',
														  temp_febre = '$temp_febre',
														  pressao_arterial = '$pressao_arterial',
														  pressao_tibial = '$pressao_tibial',
														  hiperidrose = '$hiperidrose',
														  anidrose = '$anidrose',
														  bromidose = '$bromidose',
														  onicolise = '$onicolise',							  
														  onicoatrofia = '$onicoatrofia',
														  onicogrifose = '$onicogrifose',
														  onicoesclerose = '$onicoesclerose',							  
														  onicofose = '$onicofose',
														  tinha_pedis = '$tinha_pedis',
														  tinha_interdigital = '$tinha_interdigital',
														  fissuras = '$fissuras',
														  onicomicose = '$onicomicose',
														  patologia_obs = '$obs_patologias',
														  calos_dorsal = '$dorsal',
														  calos_interdigital = '$interdigital',
														  calos_plantar = '$plantar',
														  calos_verruga_plantar = '$verrugas_plantar',
														  calos_tungiase = '$tungiase',
														  calos_nevos = '$nevos',
														  hiperqueratose_ungueal = '$ungueal',
														  hiperqueratose_plantar = '$hiperqueratose_plantar',
														  hiperqueratose_obs = '$hiperqueratose_obs',
														  onococriptose_edema = '$edema',
														  onococriptose_eritema = '$eritema',
														  onococriptose_granuloma = '$granuloma',
														  onococriptose_pus = '$pus',
														  onococriptose_espicula = '$espicula',
														  observacao = '$observacao',
														  paciente_id = '$paciente_id',
														  empresa_id = ".EMPRESA."
														  WHERE anamnese = $anamnese_id and empresa_id = ".EMPRESA;
            }
			
			$res = pg_query($con, $sql_avaliacao);
			$res = pg_query($con, $sql_anamnese);
			//echo  $sql_avaliacao;
			//echo  $sql_anamnese;
            if(strlen(trim(pg_last_error($con))) == 0 and empty($erro)){
                $ok .= "Cadastro Realizado com Sucesso.";
				header("Location: imprimir.php?paciente=$paciente_id");
				 //header('Location: imprimir.php?paciente=$paciente_id');
            }
        }
    }

   if(isset($_GET['paciente'])){
        $paciente_id = (int)$_GET['paciente'];
        $sql_avaliacao = "select * from tbl_avaliacao where paciente_id = $paciente_id and empresa_id = ". EMPRESA;	
        $res_avaliacao = pg_query($con, $sql_avaliacao);
		if(pg_num_rows($res_avaliacao)>0){		
            $peso                    = pg_fetch_result($res_avaliacao, 0, 'peso');
            $altura                  = pg_fetch_result($res_avaliacao, 0, 'altura');
            $calcado                 = pg_fetch_result($res_avaliacao, 0, 'calcado');
            $tipo_calcado            = pg_fetch_result($res_avaliacao, 0, 'tipo_calcado'); 
            $cirurgia                = pg_fetch_result($res_avaliacao, 0, 'cirurgia');
            $esporte                 = pg_fetch_result($res_avaliacao, 0, 'esporte');
            $medicacao               = pg_fetch_result($res_avaliacao, 0, 'medicacao');
            $dor_queixa              = pg_fetch_result($res_avaliacao, 0, 'dor_queixa');
            $hipertensao             = pg_fetch_result($res_avaliacao, 0, 'hipertensao');
            $vascular                = pg_fetch_result($res_avaliacao, 0, 'vascular');
            $diabetes                = pg_fetch_result($res_avaliacao, 0, 'diabetes');
            $alergia                 = pg_fetch_result($res_avaliacao, 0, 'alergia');
            $tabagismo               = pg_fetch_result($res_avaliacao, 0, 'tabagismo');
            $neuropatias             = pg_fetch_result($res_avaliacao, 0, 'neuropatias');
            $meia_algodao            = pg_fetch_result($res_avaliacao, 0, 'meia_algodao');
            $meia_sintetica          = pg_fetch_result($res_avaliacao, 0, 'meia_sintetica');
            $trabalha_sentado        = pg_fetch_result($res_avaliacao, 0, 'trabalha_sentado');
            $trabalha_em_pe          = pg_fetch_result($res_avaliacao, 0, 'trabalha_em_pe');
            $trabalha_andando        = pg_fetch_result($res_avaliacao, 0, 'trabalha_andando');
            $vacina_antitetano       = pg_fetch_result($res_avaliacao, 0, 'vacina_antitetano');
            $vacina_antitetana_tempo = pg_fetch_result($res_avaliacao, 0, 'vacina_antitetana_tempo');
            $ja_foi_podologo         = pg_fetch_result($res_avaliacao, 0, 'ja_foi_podologo');
            $quanto_tempo            = pg_fetch_result($res_avaliacao, 0, 'quanta_tempo');
            $palmilha                = pg_fetch_result($res_avaliacao, 0, 'palmilha');
            $palmilha_obs            = pg_fetch_result($res_avaliacao, 0, 'palmilha_obs');
			$paciente_id             = pg_fetch_result($res_avaliacao, 0, 'paciente_id');
			$avaliacao_id            = pg_fetch_result($res_avaliacao, 0, 'avaliacao');
		}

            $sql_anamnese = "select * from tbl_anammnese where paciente_id = $paciente_id and empresa_id = ". EMPRESA;
        	$res_anamnese = pg_query($con, $sql_anamnese); 
			if(pg_num_rows($res_anamnese)>0){	
				$anamnese_id            = pg_fetch_result($res_anamnese, 0, 'anamnese');
				$quadrado               = pg_fetch_result($res_anamnese, 0, 'pe_quadrado');
				$plano                  = pg_fetch_result($res_anamnese, 0, 'pe_plano');
				$varo                   = pg_fetch_result($res_anamnese, 0, 'pe_varo');
				$grego                  = pg_fetch_result($res_anamnese, 0, 'pe_grego'); 
				$cavo                   = pg_fetch_result($res_anamnese, 0, 'pe_cavo');
				$valgo                  = pg_fetch_result($res_anamnese, 0, 'pe_valgo');
				$egipcio                = pg_fetch_result($res_anamnese, 0, 'pe_egipcio');
				$espalmado              = pg_fetch_result($res_anamnese, 0, 'pe_espalmado');
				$equino                 = pg_fetch_result($res_anamnese, 0, 'pe_equino');
				$pe_obs                 = pg_fetch_result($res_anamnese, 0, 'pe_obs');
				$martelo                = pg_fetch_result($res_anamnese, 0, 'artelho_martelo');
				$halux_rigidus          = pg_fetch_result($res_anamnese, 0, 'artelho_halux_rigidus');
				$halux_valgus           = pg_fetch_result($res_anamnese, 0, 'artelho_halux_valgus');
				$garra                  = pg_fetch_result($res_anamnese, 0, 'artelho_garra');
				$bunionete              = pg_fetch_result($res_anamnese, 0, 'artelho_bunionete');
				$golfe                  = pg_fetch_result($res_anamnese, 0, 'artelho_golfe');
				$obs_artelho            = pg_fetch_result($res_anamnese, 0, 'artelho_obs');
				$unhas_normal           = pg_fetch_result($res_anamnese, 0, 'unha_normal');
				$telha_provenca         = pg_fetch_result($res_anamnese, 0, 'unha_telha_provenca');
				$involuta               = pg_fetch_result($res_anamnese, 0, 'unha_involuta');
				$gancho                 = pg_fetch_result($res_anamnese, 0, 'unha_gancho');
				$telha                  = pg_fetch_result($res_anamnese, 0, 'unha_telha');
				$caracol                = pg_fetch_result($res_anamnese, 0, 'unha_caracol');
				$afunilada              = pg_fetch_result($res_anamnese, 0, 'unha_afunilada');
				$obs_unhas              = pg_fetch_result($res_anamnese, 0, 'unha_obs');
				$pele_obs               = pg_fetch_result($res_anamnese, 0, 'pele_obs');
				$pulso_normal           = pg_fetch_result($res_anamnese, 0, 'pulso_normal');
				$bradicardia            = pg_fetch_result($res_anamnese, 0, 'pulso_bradicardia');
				$taquicardia            = pg_fetch_result($res_anamnese, 0, 'pulso_taquicardia');
				$perfusao_normal        = pg_fetch_result($res_anamnese, 0, 'perfusao_normal');
				$cianotico              = pg_fetch_result($res_anamnese, 0, 'perfusao_cianotica');
				$palido                 = pg_fetch_result($res_anamnese, 0, 'perfusao_palido');
				$temp_normal            = pg_fetch_result($res_anamnese, 0, 'temp_normal');
				$temp_fria              = pg_fetch_result($res_anamnese, 0, 'temp_fria');
				$temp_febre             = pg_fetch_result($res_anamnese, 0, 'temp_febre');
				$pressao_arterial       = pg_fetch_result($res_anamnese, 0, 'pressao_arterial');
				$pressao_tibial         = pg_fetch_result($res_anamnese, 0, 'pressao_tibial');
				$hiperidrose            = pg_fetch_result($res_anamnese, 0, 'hiperidrose');
				$anidrose               = pg_fetch_result($res_anamnese, 0, 'anidrose');
				$bromidose              = pg_fetch_result($res_anamnese, 0, 'bromidose');
				$onicolise              = pg_fetch_result($res_anamnese, 0, 'onicolise');
				$onicoatrofia           = pg_fetch_result($res_anamnese, 0, 'onicoatrofia');
				$onicogrifose           = pg_fetch_result($res_anamnese, 0, 'onicogrifose');
				$onicoesclerose         = pg_fetch_result($res_anamnese, 0, 'onicoesclerose');
				$onicofose              = pg_fetch_result($res_anamnese, 0, 'onicofose');
				$tinha_pedis            = pg_fetch_result($res_anamnese, 0, 'tinha_pedis');
				$tinha_interdigital     = pg_fetch_result($res_anamnese, 0, 'tinha_interdigital');
				$fissuras               = pg_fetch_result($res_anamnese, 0, 'fissuras');
				$onicomicose            = pg_fetch_result($res_anamnese, 0, 'onicomicose');
				$obs_patologias         = pg_fetch_result($res_anamnese, 0, 'patologia_obs');
				$dorsal                 = pg_fetch_result($res_anamnese, 0, 'calos_dorsal');
				$interdigital           = pg_fetch_result($res_anamnese, 0, 'calos_interdigital');
				$plantar                = pg_fetch_result($res_anamnese, 0, 'calos_plantar');
				$verrugas_plantar       = pg_fetch_result($res_anamnese, 0, 'calos_verruga_plantar');
				$tungiase               = pg_fetch_result($res_anamnese, 0, 'calos_tungiase');
				$nevos                  = pg_fetch_result($res_anamnese, 0, 'calos_nevos');
				$ungueal                = pg_fetch_result($res_anamnese, 0, 'hiperqueratose_ungueal');
				$hiperqueratose_plantar = pg_fetch_result($res_anamnese, 0, 'hiperqueratose_plantar');
				$hiperqueratose_obs     = pg_fetch_result($res_anamnese, 0, 'hiperqueratose_obs');
				$edema                  = pg_fetch_result($res_anamnese, 0, 'onococriptose_edema');
				$eritema                = pg_fetch_result($res_anamnese, 0, 'onococriptose_eritema');
				$granuloma              = pg_fetch_result($res_anamnese, 0, 'onococriptose_granuloma');
				$pus                    = pg_fetch_result($res_anamnese, 0, 'onococriptose_pus');
				$espicula               = pg_fetch_result($res_anamnese, 0, 'onococriptose_espicula');
				$observacao             = pg_fetch_result($res_anamnese, 0, 'observacao');	
                $paciente_id            = pg_fetch_result($res_anamnese, 0, 'paciente_id');				
			}
          
    }


   /*  if(isset($_GET['excluir'])){
        $avaliacao = (int)$_GET['excluir'];

        $sql = "DELETE from tbl_avaliacao where avaliacao = $avaliacao_id";
        $res = pg_query($con, $sql);

        if(strlen(trim(pg_last_error($con))) == 0 and empty($erro)){
            $ok .= "Avaliação excluída com Sucesso.";
        }else{
            $erro .= "Falha ao excluir a avaliação. <br>Consulte o administrador do sistema. ";
        }


    }*/


?>
<!DOCTYPE html>
<html lang="PT-BR">
    <head> 
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="<?php echo AUTOR ?>">
        <meta charset="UTF-8">
       <title><?php echo TITLE_ADMIN ?></title>
        <!-- Bootstrap core CSS -->
        <link href="<?php echo RAIZ ?>/css/bootstrap.css" rel="stylesheet">
		<link rel="shortcut icon" href="<?php echo RAIZ?>/images/<?php echo LOGO_FAVICON ?>" type="image/x-icon" />
        <!-- Custom styles for this template -->
        <link href="<?php echo RAIZ ?>css/dashboard.css" rel="stylesheet">
        <link href="<?php echo RAIZ ?>css/style.css" rel="stylesheet">
        <link href="<?php echo RAIZ ?>css/style_admin.css" rel="stylesheet">
        <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
        
        <!-- Just for debugging purposes. Don't actually copy this line! -->
        <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
       <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]--> 
        <script src="include/funcoes.js"></script>
        <script src="js/script.js" ></script>
		<script>
			function imprime(text){
				text=document
				print(text)
			}
		</script>
    </head>
    <body>
        <div class="container">
            <div class="container-fluid">
                <div class="row">
                   <?php include RAIZ."include/cabecalho.php" ?>
                    <div class="col-md-2">
                        <?php include RAIZ."include/menu_admin.php" ?>
                    </div>
                    <div class="col-md-10 corpo" >
                        <div class="page-header">
                            <div class=" col-md-9 titulo_tela" >Avaliação do Cliente</div>
                            <div class="col-md-1 link_tela">
                                <a href="ficha_medica.php?paciente=<?php echo $paciente_id?>" class="btn btn-info btn-sm">
									<i class="fa fa-list-alt"></i>Paciente
								</a>								
                            </div>
							<div class="col-md-1 link_tela">
                                <a href="imprimir.php?paciente=<?php echo $paciente_id?>" class="btn btn-info btn-sm">
									<i class="fa fa-list-alt"></i>Imprimir
								</a>								
                            </div>
                        </div>
                        <?php if (strlen(trim($erro)) > 0): ?>
                            <div class="alert alert-danger">
                                <i class="icon-remove-sign"></i>
                                <?php echo $erro ?>
                            </div>
                        <?php endif; ?>
                        <?php if (strlen(trim($ok)) > 0): ?>
                            <div class="alert alert-success">
                                <i class="icon-ok"></i>
                                <?php echo $ok ?>
                            </div>
                        <?php endif; ?>
                        <div class="conteudo">
                            <div class="col-md-12" id="home">
                                   <form name="frm_tipo_imovel" id="frm_tipo_imovel" method="POST" action="avaliacao.php">
                                        <div id="funcionario_2">
                                            <div class='row'>
                                                <div class="col-md-1">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Peso</label>
                                                        <input type="text" name="peso" value="<?php echo $peso ?>" maxlength="4" class="form-control" id="exampleInputEmail1" >
                                                    </div>
                                                </div>
												<div class="col-md-1">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Altura</label>
                                                        <input type="text" name="altura" value="<?php echo $altura ?>" maxlength="5" class="form-control" id="exampleInputEmail1" >
                                                    </div>
                                                </div>
												<div class="col-md-1">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Calçado</label>
                                                        <input type="text" name="calcado" value="<?php echo $calcado ?>" maxlength="3" class="form-control" id="exampleInputEmail1" placeholder="Nº">
                                                    </div>
                                                </div>
												<div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Tipo Calçado</label>
                                                        <input type="text" name="tipo_calcado" value="<?php echo $tipo_calcado ?>" maxlength="30" class="form-control" id="exampleInputEmail1">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Cirurgia</label>
                                                        <input type="text" name="cirurgia" value="<?php echo $cirurgia?>" maxlength="50"   class="form-control" id="exampleInputEmail1">
                                                    </div>
                                                </div>
												<div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Esporte</label>
                                                        <input type="text" name="esporte" value="<?php echo $esporte?>" maxlength="14"   class="form-control" id="exampleInputEmail1">
                                                    </div>
                                                </div>
                                            </div>
											<div class="row">
												<div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Medicação</label>
                                                        <input type="text" name="medicacao" value="<?php echo $medicacao?>" maxlength="50"   class="form-control" id="exampleInputEmail1">
                                                    </div>
                                                </div>
												<div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Dor ou Queixa</label>
                                                        <input type="text" name="dor_queixa" value="<?php echo $dor_queixa?>"    class="form-control" id="exampleInputEmail1">
                                                    </div>
                                                </div>
											</div>
											<div class="row">
												<div class="col-md-12">
													<fieldset class="scheduler-border">
														<legend class="scheduler-border">Patologia Pregressa</legend>
														<div class="checkbox disabled">
															<label>
																<input type="checkbox" name="hipertensao" value="t" <?php if($hipertensao == 't') echo " checked "?>">
																Hipertensão
															</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
															<label>
																<input type="checkbox" name="vascular" value="t" <?php if($vascular == 't') echo " checked "?>>
																Vascular
															</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
															<label>
																<input type="checkbox" name="diabetes" value="t" <?php if($diabetes == 't') echo " checked "?>>
																Diabetes
															</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
															<label>
																<input type="checkbox" name="alergia" value="t" <?php if($alergia == 't') echo " checked "?>>
																Alergia
															</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
															<label>
																<input type="checkbox" name="tabagismo" value="t" <?php if($tabagismo == 't') echo " checked "?>>
																Tabagismo
															</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
															<label>
																<input type="checkbox" name="neuropatias" value="t" <?php if($neuropatias == 't') echo " checked "?>>
																Neuropatias
															</label>
														</div>

													</fieldset>
												</div>
											</div>
											<div class="row">
												<div class="col-md-3">
													<fieldset class="scheduler-border">
														<legend class="scheduler-border">Meias</legend>
														<div class="checkbox disabled">
															<label>
																<input type="checkbox" name="meia_algodao" value="t" <?php if($meia_algodao == 't') echo " checked "?> >
																Algodão
															</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
															<label>
																<input type="checkbox" name="meia_sintetica" value="t" <?php if($meia_sintetica == 't') echo " checked "?>>
																Sintética
															</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
														</div>
													</fieldset>
												</div>
												<div class="col-md-4">
													<fieldset class="scheduler-border">
														<legend class="scheduler-border">Trabalha em</legend>
														<div class="checkbox disabled">
															<label>
																<input type="checkbox" name="trabalha_sentado" value="t" <?php if($trabalha_sentado == 't') echo " checked "?>>
																Sentado
															</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
															<label>
																<input type="checkbox" name="trabalha_em_pe" value="t" <?php if($trabalha_em_pe == 't') echo " checked "?>>
																Em Pé
															</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
															<label>
																<input type="checkbox" name="trabalha_andando" value="t" <?php if($trabalha_andando == 't')echo "checked " ?> >
																Andando
															</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
														</div>
													</fieldset>
												</div>
												<div class="col-md-5">
													<fieldset class="scheduler-border">
														<legend class="scheduler-border">Vacinação</legend>
														<div class="checkbox disabled">
															<label>
																<input type="checkbox" name="vacina_antitetano" value="t" <?php if($vacina_antitetano == 't') echo " checked "?>>
																Antitétano
															</label>
															<label>
																<input type="text" class="form-control" name="vacina_antitetana_tempo" value="<?php echo $vacina_antitetana_tempo?>" placeholder="Quanto Tempo?">
															</label>
														</div>
													</fieldset>
												</div>
                                            </div>
											<div class="row">
												<div class="col-md-9">
													<fieldset class="scheduler-border">
														<legend class="scheduler-border"></legend>
														<div class="checkbox disabled">
															<label>
																<input type="checkbox" name="ja_foi_podologo" value="t" <?php if($ja_foi_podologo == 't') echo " checked "?>>
																Já foi ao Podólogo
															</label>&nbsp;
															<label>
																<input type="text" class="form-control" name="quanta_tempo" value="<?php echo $quanto_tempo?>" placeholder="Quanto Tempo Podólogo?">
															</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
															<label>
																<input type="checkbox" name="palmilha" value="t" <?php if($palmilha == 't') echo " checked "?>>
																Palmilha
															</label>&nbsp;															
															<label>
																<input type="text" class="form-control" name="palmilha_obs" value="<?php echo $palmilha_obs?>" placeholder="Tipo Palmilha?">
															</label>
														</div>
													</fieldset>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12">
													<fieldset class="scheduler-border">
														<legend class="scheduler-border">Pé</legend>
														<div class="checkbox disabled">
															<label>
																<input type="checkbox" name="pe_quadrado" value="t" <?php if($quadrado == 't') echo " checked "?>>
																Quadrado
															</label>&nbsp;&nbsp;&nbsp;&nbsp;
															<label>
																<input type="checkbox" name="pe_plano" value="t" <?php if($plano == 't') echo " checked "?>>
																plano
															</label>&nbsp;&nbsp;&nbsp;&nbsp;														
															<label>
																<input type="checkbox" name="pe_varo" value="t" <?php if($varo == 't') echo " checked "?>>
																Varo
															</label>&nbsp;&nbsp;&nbsp;&nbsp;
															<label>
																<input type="checkbox" name="pe_grego" value="t" <?php if($grego == 't') echo " checked "?>>
																Grego
															</label>&nbsp;&nbsp;&nbsp;&nbsp;
															<label>
																<input type="checkbox" name="pe_cavo" value="t" <?php if($cavo == 't') echo " checked "?>>
																Cavo
															</label>&nbsp;&nbsp;&nbsp;&nbsp;
															<label>
																<input type="checkbox" name="pe_valgo" value="t" <?php if($valgo == 't') echo " checked "?>>
																Valgo
															</label>&nbsp;&nbsp;&nbsp;&nbsp;
															<label>
																<input type="checkbox" name="pe_egipcio" value="t" <?php if($egipcio == 't') echo " checked "?>>
																Egípcio
															</label>&nbsp;&nbsp;&nbsp;&nbsp;
															<label>
																<input type="checkbox" name="pe_espalmado" value="t" <?php if($espalmado == 't') echo " checked "?>>
																Espalmado
															</label>&nbsp;&nbsp;&nbsp;&nbsp;
															<label>
																<input type="checkbox" name="pe_equino" value="t" <?php if($equino == 't') echo " checked "?>>
																Equino
															</label>&nbsp;&nbsp;&nbsp;
															<label>
																<input type="text" class="form-control" name="pe_obs" value="<?php echo $pe_obs?>" placeholder="Observação Pé">
															</label>
														</div>
													</fieldset>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12">
													<fieldset class="scheduler-border">
														<legend class="scheduler-border">Artelhos</legend>
														<div class="checkbox disabled">
															<label>
																<input type="checkbox" name="artelho_martelo" value="t" <?php if($martelo == 't') echo " checked "?>>
																Martelo
															</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
															<label>
																<input type="checkbox" name="artelho_halux_rigidus" value="t" <?php if($halux_rigidus == 't') echo " checked "?>>
																Hálux Rigidus
															</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;															
															<label>
																<input type="checkbox" name="artelho_halux_valgus" value="t" <?php if($halux_valgus == 't') echo " checked "?>>
																Hálux Valgus
															</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
															<label>
																<input type="checkbox" name="artelho_garra" value="t" <?php if($garra == 't') echo " checked "?>>
																Garra
															</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
															<label>
																<input type="checkbox" name="artelho_bunionete" value="t" <?php if($bunionete == 't') echo " checked "?>>
																Bunionete
															</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
															<label>
																<input type="checkbox" name="artelho_golfe" value="t" <?php if($golfe == 't') echo " checked "?>>
																Golfe
															</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
															<label>
																<input type="text" class="form-control" name="artelho_obs" value="<?php echo $obs_artelho?>" placeholder="Observação Artelhos">
															</label>
														</div>
													</fieldset>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12">
													<fieldset class="scheduler-border">
														<legend class="scheduler-border">Unhas</legend>
														<div class="checkbox disabled">
															<label>
																<input type="checkbox" name="unha_normal" value="t" <?php if($unhas_normal == 't') echo " checked "?>>
																Normal
															</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
															<label>
																<input type="checkbox" name="unha_telha_provenca" value="t" <?php if($telha_provenca == 't') echo " checked "?>>
																Telha Provença
															</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
															<label>
																<input type="checkbox" name="unha_involuta" value="t" <?php if($involuta == 't') echo " checked "?>>
																Involuta
															</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
															<label>
																<input type="checkbox" name="unha_gancho" value="t" <?php if($gancho == 't') echo " checked "?>>
																Gancho
															</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
															<label>
																<input type="checkbox" name="unha_telha" value="t" <?php if($telha == 't') echo " checked "?>>
																telha
															</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
															<label>
																<input type="checkbox" name="unha_caracol" value="t" <?php if($caracol == 't') echo " checked "?>>
																Caracol
															</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
															<label>
																<input type="checkbox" name="unha_afunilada" value="t" <?php if($afunilada == 't') echo " checked "?>>
																Afunilada
															</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
															<label>
																<input type="text" class="form-control" name="unha_obs" value="<?php echo $obs_unhas?>" placeholder="Observação Unhas">
															</label>
															<label>
																<input type="text" class="form-control" name="pele_obs" value="<?php echo $pele_obs?>" placeholder="Observação Pele">
															</label>
														</div>
													</fieldset>
												</div>
											</div>
											<div class="row">
												<div class="col-md-4">
													<fieldset class="scheduler-border">
														<legend class="scheduler-border">Avaliação Pulso</legend>
														<div class="checkbox disabled">
															<label>
																<input type="checkbox" name="pulso_normal" value="t" <?php if($pulso_normal == 't') echo " checked "?>>
																Normal
															</label>&nbsp;&nbsp;&nbsp;&nbsp;
															<label>
																<input type="checkbox" name="pulso_bradicardia" value="t" <?php if($bradicardia == 't') echo " checked "?>>
																Bradicardia
															</label>&nbsp;&nbsp;&nbsp;&nbsp;
															<label>
																<input type="checkbox" name="pulso_taquicardia" value="t" <?php if($taquicardia == 't') echo " checked "?>>
																Taquicardia
															</label>&nbsp;&nbsp;&nbsp;&nbsp;
															
														</div>
													</fieldset>
												</div>
												<div class="col-md-3">
													<fieldset class="scheduler-border">
														<legend class="scheduler-border">Avaliação Perfusão</legend>
														<div class="checkbox disabled">
															<label>
																<input type="checkbox" name="perfusao_normal" value="t" <?php if($perfusao_normal == 't') echo " checked "?>>
																Normal
															</label>&nbsp;&nbsp;&nbsp;
															<label>
																<input type="checkbox" name="perfusao_cianotica" value="t" <?php if($cianotico == 't') echo " checked "?>>
																Cianotico
															</label>&nbsp;&nbsp;&nbsp;
															<label>
																<input type="checkbox" name="perfusao_palido" value="t" <?php if($palido == 't') echo " checked "?>>
																Pálido
															</label>&nbsp;&nbsp;&nbsp;															
														</div>
													</fieldset>
												</div>
												<div class="col-md-5">
													<fieldset class="scheduler-border">
														<legend class="scheduler-border">Avaliação Temperatura</legend>
														<div class="checkbox disabled">
															<label>
																<input type="checkbox" name="temp_normal" value="t" <?php if($temp_normal == 't') echo " checked "?>>
																Normal
															</label>&nbsp;&nbsp;&nbsp;
															<label>
																<input type="checkbox" name="temp_fria" value="t" <?php if($temp_fria == 't') echo " checked "?>>
																Fria
															</label>&nbsp;&nbsp;&nbsp;
															<label>
																<input type="checkbox" name="temp_febre" value="t" <?php if($temp_febre == 't') echo " checked "?>>
																Febre
															</label>&nbsp;&nbsp;&nbsp;
															<label>
																<input type="text" class="form-control" size='2' name="pressao_arterial" value="<?php echo $pressao_arterial?>" placeholder="Arterial">
															</label>
															<label>
																<input type="text" class="form-control" size='2' name="pressao_tibial" value="<?php echo $pressao_tibial?>" placeholder="Tibial">
															</label>															
														</div>
													</fieldset>
												</div>
											</div>
											<div class='row'>
												<div class="col-md-12">
													<fieldset class="scheduler-border">
														<legend class="scheduler-border">Patologias</legend>
														<div class="checkbox disabled">
															<label>
																<input type="checkbox" name="hiperidrose" value="t" <?php if($hiperidrose == 't') echo " checked "?>>
																Hiperidrose
															</label>&nbsp;&nbsp;&nbsp;
															<label>
																<input type="checkbox" name="anidrose" value="t" <?php if($anidrose == 't') echo " checked "?>>
																Anidrose
															</label>&nbsp;&nbsp;&nbsp;
															<label>
																<input type="checkbox" name="bromidose" value="t" <?php if($bromidose == 't') echo " checked "?>>
																Bromidose
															</label>&nbsp;&nbsp;&nbsp;
															<label>
																<input type="checkbox" name="tinha_pedis" value="t" <?php if($tinha_pedis == 't') echo " checked "?>>
																Tinha Pédis
															</label>&nbsp;&nbsp;&nbsp;
															<label>
																<input type="checkbox" name="tinha_interdigital" value="t" <?php if($tinha_interdigital == 't') echo " checked "?>>
																Tinha Interdigital
															</label>&nbsp;&nbsp;&nbsp;
															<label>
																<input type="checkbox" name="fissuras" value="t" <?php if($fissuras == 't') echo " checked "?>>
																Fissuras
															</label>&nbsp;&nbsp;&nbsp;																													
															<label>
																<input type="checkbox" name="onicolise" value="t" <?php if($onicolise == 't') echo " checked "?>>
																Onicólise
															</label>&nbsp;&nbsp;&nbsp;<label>
																<input type="checkbox" name="onicoatrofia" value="t" <?php if($onicoatrofia == 't') echo " checked "?>>
																Onicoatrofia
															</label>&nbsp;&nbsp;&nbsp;<label>
																<input type="checkbox" name="onicogrifose" value="t" <?php if($onicogrifose == 't') echo " checked "?>>
																Onicogrifose
															</label>&nbsp;&nbsp;&nbsp;<label>
																<input type="checkbox" name="onicoesclerose" value="t" <?php if($onicoesclerose == 't') echo " checked "?>>
																Onicoesclerose
															</label>&nbsp;&nbsp;&nbsp;<label>
																<input type="checkbox" name="onicofose" value="t" <?php if($onicofose == 't') echo " checked "?>>
																Onicofose
															</label>&nbsp;&nbsp;&nbsp;<label>
																<input type="checkbox" name="onicomicose" value="t" <?php if($onicomicose == 't') echo " checked "?>>
																Onicomicose
															</label>
															<label>
																<input type="text" class="form-control" name="patologia_obs" value="<?php echo $obs_patologias?>" placeholder="Observação Patológica">
															</label>
														</div>
													</fieldset>
												</div>										
											</div>
											<div class='row'>
												<div class="col-md-7">
													<fieldset class="scheduler-border">
														<legend class="scheduler-border">Calos</legend>
														<div class="checkbox disabled">
															<label>
																<input type="checkbox" name="calos_dorsal" value="t" <?php if($dorsal == 't') echo " checked "?>>
																Dorsal
															</label>&nbsp;&nbsp;&nbsp;
															<label>
																<input type="checkbox" name="calos_interdigital" value="t" <?php if($interdigital == 't') echo " checked "?>>
																Interdigital
															</label>&nbsp;&nbsp;&nbsp;
															<label>
																<input type="checkbox" name="calos_plantar" value="t" <?php if($plantar == 't') echo " checked "?>>
																Plantar
															</label>&nbsp;&nbsp;&nbsp;
															<label>
																<input type="checkbox" name="calos_verruga_plantar" value="t" <?php if($verrugas_plantar == 't') echo " checked "?>>
																Verrugas Plantar
															</label>&nbsp;&nbsp;&nbsp;
															<label>
																<input type="checkbox" name="calos_tungiase" value="t" <?php if($tungiase == 't') echo " checked "?>>
																Tungiase
															</label>&nbsp;&nbsp;&nbsp;
															<label>
																<input type="checkbox" name="calos_nevos" value="t" <?php if($nevos == 't') echo " checked "?>>
																Nevos
															</label>&nbsp;&nbsp;&nbsp;
																														
														</div>
													</fieldset>
												</div>											
											</div>
											<div class='row'>
												<div class="col-md-7">
													<fieldset class="scheduler-border">
														<legend class="scheduler-border">Hiperqueratose</legend>
														<div class="checkbox disabled">
															<label>
																<input type="checkbox" name="hiperqueratose_ungueal" value="t" <?php if($ungueal == 't') echo " checked "?>>
																Ungueal
															</label>&nbsp;&nbsp;&nbsp;
															<label>
																<input type="checkbox" name="hiperqueratose_plantar" value="t" <?php if($hiperqueratose_plantar == 't') echo " checked "?>>
																Plantar
															</label>&nbsp;&nbsp;&nbsp;
															<label>
																<input type="text" class="form-control" name="hiperqueratose_obs" value="<?php echo $hiperqueratose_obs?>" placeholder="Observação Hiperqueratose">
															</label>									
														</div>
													</fieldset>
												</div>											
											</div>
											<div class='row'>
												<div class="col-md-5">
													<fieldset class="scheduler-border">
														<legend class="scheduler-border">Onococriptose</legend>
														<div class="checkbox disabled">
															<label>
																<input type="checkbox" name="onococriptose_edema" value="t" <?php if($edema == 't') echo " checked "?>> 
																Edema
															</label>&nbsp;&nbsp;&nbsp;
															<label>
																<input type="checkbox" name="onococriptose_eritema" value="t" <?php if($eritema == 't') echo " checked "?>>
																Eritema
															</label>&nbsp;&nbsp;&nbsp;
															<label>
																<input type="checkbox" name="onococriptose_granuloma" value="t" <?php if($granuloma == 't') echo " checked "?>>
																Granuloma
															</label>&nbsp;&nbsp;&nbsp;
															<label>
																<input type="checkbox" name="onococriptose_pus" value="t" <?php if($pus == 't') echo " checked "?>>
																Pus
															</label>&nbsp;&nbsp;&nbsp;
															<label>
																<input type="checkbox" name="onococriptose_espicula" value="t" <?php if($espicula == 't') echo " checked "?>>
																Espicula
															</label>&nbsp;&nbsp;&nbsp;
																								
														</div>
													</fieldset>
												</div>											
											</div>
											<div class="row">
												<div class="col-md-4">
													<fieldset class="scheduler-border">
														<label>
															<input type="text" class="form-control" name="observacao" value="<?php echo $observacao?>" placeholder="Observações">
														</label>
													</fieldset>
												</div>
											</div>
                                        </div>
                                        <br>

                                    <div class="row">
                                    <div class="col-md-12 botao">
                                        <input class="btn btn-info" type="submit" name="btnacao" value="Gravar">
                                        <input type="hidden" name="avaliacao_id" value="<?php echo $avaliacao_id ?>">
										<input type="hidden" name="paciente_id" value="<?php echo $paciente_id ?>">
										<input type="hidden" name="anamnese_id" value="<?php echo $anamnese_id ?>">
                
                               </form>

                            </div>
                       </div>
                    </div>
                </div>
                <div class="row">
                    <?php include RAIZ."include/footer.php" ?>
                </div>
            </div>
            <!-- Bootstrap core JavaScript
            ================================================== -->
            <!-- Placed at the end of the document so the pages load faster -->
            <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>-->
            <script src="<?php echo RAIZ ?>js/bootstrap.min.js"></script>
            <script src="<?php echo RAIZ ?>js/docs.min.js"></script>
        </div>
    </body>
</html>