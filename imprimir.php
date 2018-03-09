<?Php

		include "include/conexao.php";
		include "include/config.php";
		include "include/funcoes.php";
		include "include/verifica_usuario.php";
		
		if(isset($_GET['paciente'])){
        $paciente_id = (int)$_GET['paciente'];

        $sql_paciente = "select * from tbl_paciente where paciente = $paciente_id ";
        $res_paciente = pg_query($con, $sql_paciente);
        if(pg_num_rows($res_paciente) > 0){
            $nome           = pg_fetch_result($res_paciente, 0, 'nome');
			$rua_av         = pg_fetch_result($res_paciente, 0, 'rua_av');
			$numero         = pg_fetch_result($res_paciente, 0, 'numero');
			$complemento    = pg_fetch_result($res_paciente, 0, 'complemento');
			$bairro         = pg_fetch_result($res_paciente, 0, 'bairro');
			$cep            = pg_fetch_result($res_paciente, 0, 'cep');
			$cidade_id      = pg_fetch_result($res_paciente, 0, 'cidade_id');
			$ddd_tel        = pg_fetch_result($res_paciente, 0, 'ddd_tel');
			$telefone		= pg_fetch_result($res_paciente, 0, 'telefone');
			$ddd_cel        = pg_fetch_result($res_paciente, 0, 'ddd_cel');
			$celular        = pg_fetch_result($res_paciente, 0, 'celular');
			$rg             = pg_fetch_result($res_paciente, 0, 'rg');
			
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
	}	
?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">
		<title>Impressão da Ficha do Paciente</title>
		<link href="css/imprimi.css" rel="stylesheet">
		<script>
			function imprime(text){
				text=document
				print(text)
			}
			function voltei(text){
				text=documet
				voltar(text)
			}
		</script>
	</head>
	<body>
		<div id="page">
			<div id="cab">
				<div class="logo">
					<img src="images/logo3.png" width="120" height="120" alt="">
				</div>
				<div class="header">
					<h2>FICHA DO PACIENTE</h2>
				</div>
				<div class="paciente">
					<div class="nome">
						<strong>Nome: </strong><?php echo $nome?>
					</div>
					<div class="end">
						<strong>Endereço: </strong><?php echo $rua_av?>&nbsp;&nbsp;
						<strong>Nº: </strong><?php echo $numero?>&nbsp;&nbsp;
						<strong>CEP: </strong><?php echo $cep?>&nbsp;&nbsp;
						<strong>Bairro: </strong><?php echo $bairro?>&nbsp;&nbsp;
						<strong>Cidade: </strong><?php echo $cidade_id?>
					</div>
				</div>
			</div>
			<div id="conteudo">			
				<div class="caixa">
					<div class="av_paciente">
						<h4>AVALIAÇÃO DO PACIENTE</h4>
					</div>
					<div class="bloco">
						<div class="bloco_um">
							<strong>Peso: </strong><?php echo $peso?>&nbsp;
							<strong>Altura: </strong><?php echo $altura?>&nbsp;
							<strong>Calçado: </strong><?php echo $calcado?>&nbsp;
							<strong>Tipo de calçado: </strong><?php echo $tipo_calcado?>&nbsp;
							<strong>Pamilha: </strong><?php echo $pamilha?>&nbsp;
							<strong>Tipo de pamilha: </strong><?php echo $palmilha_obs?>&nbsp;	
						</div>
						<div class="bloco_dois">
							<strong>Esporte: </strong><?php echo $esporte?>&nbsp;
							<strong>Cirugia: </strong><?php echo $cirurgia?>&nbsp;
							<strong>Medicação: </strong><?php echo $medicacao?>&nbsp;
							<strong>Dor ou Queixa: </strong><?php echo $dor_queixa?>&nbsp;
						</div>
					</div>
				</div>

				<div class="caixa_A">
					<div class="pregressa">
						<h4>PATALOGIA PREGRESSA</h4>
					</div>
					<div class="bloco_A">
						<strong>Hipertensão: </strong><?php echo ($hipertensao == 't')?"Sim" : "Não";?>&nbsp;&nbsp;&nbsp;
						<strong>Vascular: </strong><?php echo ($vascular == 't')?"Sim" : "Não";?>&nbsp;&nbsp;&nbsp;
						<strong>Diabetes: </strong><?php echo ($diabetes == 't')?"Sim" : "Não";?>&nbsp;&nbsp;&nbsp;
						<strong>Alergia: </strong><?php echo ($alergia == 't')?"Sim" : "Não";?>&nbsp;&nbsp;&nbsp;
						<strong>Tabagismo: </strong><?php echo ($tabagismo == 't')?"Sim" : "Não";?>&nbsp;&nbsp;&nbsp;
						<strong>Neuropatias: </strong><?php echo ($neuropatias == 't')?"Sim" : "Não";?>
					</div>
				</div>

				<div class="caixa_B">
					<div class="meia">
						<h4>TIPO DE MEIAS</h4>
					</div>
					<div class="bloco_B">
						<strong>Algodão: </strong><?php echo ($meia_algodao == 't')?"Sim" : "Não";?>&nbsp;
						<strong>Sintética: </strong><?php echo ($meia_sintetica == 't')?"Sim" : "Não";?>
					</div>			
				</div>
				
				<div class="caixa_C">
					<div class="trab">
						<h4>TRABALHA</h4>
					</div>
					<div class="bloco_C">
						<strong>Sentado: </strong><?php echo ($trabalha_sentado == 't')?"Sim" : "Não";?>&nbsp;
						<strong>Em pé: </strong><?php echo ($trabalha_em_pe == 't')?"Sim" : "Não";?>&nbsp;
						<strong>Andando: </strong><?php echo ($trabalha_andando == 't')?"Sim" : "Não";?>
					</div>			
				</div>

				<div class="caixa_D">
					<div class="vacina">
						<h4>VACINAÇÃO</h4>
					</div>
					<div class="bloco_D">
						<strong>Antitétano: </strong><?php echo ($vacina_antitetano == 't')?"Sim" : "Não";?>
						<strong>Qto tempo: </strong><?php echo $vacina_antitetana_tempo?>&nbsp;
					</div>			
				</div>
				
				<div class="caixa_E">
					<div class="pe">
						<h4>PÉ</h4>
					</div>
					<div class="bloco_E">					
							<strong>Quadrado: </strong><?php echo ($quadrado == 't')?"Sim" : "Não";?>&nbsp;
							<strong>Plano: </strong><?php echo ($plano == 't')?"Sim" : "Não";?>&nbsp;						
							<strong>Varo: </strong><?php echo ($varo == 't')?"Sim" : "Não";?>&nbsp;
							<strong>Grego: </strong><?php echo ($grego == 't')?"Sim" : "Não";?>&nbsp;
							<strong>Cavo: </strong><?php echo ($cavo == 't')?"Sim" : "Não";?>&nbsp;
							<strong>Valgo: </strong><?php echo ($valgo == 't')?"Sim" : "Não";?>&nbsp;
							<strong>Egípcio:</strong><?php echo ($egipcio == 't')?"Sim" : "Não";?>&nbsp;
							<strong>Espalmado: </strong><?php echo ($espalmado == 't')?"Sim" : "Não";?>&nbsp;
							<strong>Equino:</strong><?php echo ($equino == 't')?"Sim" : "Não";?>&nbsp;
							<strong>Obs. Pé: </strong><?php echo $pe_obs?>
					</div>
				</div>

				<div class="caixa_F">
					<div class="artelhos">
						<h4>ARTELHOS</h4>
					</div>
					<div class="bloco_F">
							<strong>Martelo: </strong><?php echo ($martelo == 't')?"Sim" : "Não";?>&nbsp;
							<strong>Hálux Rigidus: </strong><?php echo ($halux_rigidus == 't')?"Sim" : "Não";?>&nbsp;			
							<strong>Hálux Valgus: </strong><?php echo ($halux_valgus == 't')?"Sim" : "Não";?>&nbsp;
							<strong>Garra: </strong><?php echo ($garra == 't')?"Sim" : "Não";?>&nbsp;
							<strong>Bunionete: </strong><?php echo ($bunionete == 't')?"Sim" : "Não";?>&nbsp;
							<strong>Golfe: </strong><?php echo ($golfe == 't')?"Sim" : "Não";?>&nbsp;
							<strong>Obs. Artelhos: </strong><?php echo $obs_artelho?>
					</div>
				</div>

				<div class="caixa_G">
					<div class="unhas">
						<h4>UNHAS</h4>
					</div>
					<div class="bloco_G">
						<div class="bloco_G_um">
							<strong>Normal: </strong><?php echo ($unhas_normal == 't')?"Sim" : "Não";?>&nbsp;&nbsp;
							<strong>Telha Provença: </strong><?php echo ($telha_provenca == 't')?"Sim" : "Não";?>&nbsp;&nbsp;				
							<strong>Involuta: </strong><?php echo ($involuta == 't')?"Sim" : "Não";?>&nbsp;&nbsp;
							<strong>Gancho: </strong><?php echo ($gancho == 't')?"Sim" : "Não";?>&nbsp;&nbsp;
							<strong>Telha: </strong><?php echo ($telha == 't')?"Sim" : "Não";?>&nbsp;&nbsp;
							<strong>Caracol: </strong><?php echo ($caracol == 't')?"Sim" : "Não";?>&nbsp;&nbsp;
							<strong>Afinilada: </strong><?php echo ($afunilada == 't')?"Sim" : "Não";?>
						</div>
						<div class="bloco_G_dois">
							<strong>Obs. Unhas: </strong><?php echo $obs_unhas?>&nbsp;&nbsp;&nbsp;
							<strong>Obs. Pele: </strong><?php echo $pele_obs?>
						</div>
					</div>
				</div>

				<div class="caixa_H">
					<div class="pulso">
						<h4>AVALIAÇÃO PULSO</h4>
					</div>
					<div class="bloco_H_um">
						<strong>Normal: </strong><?php echo ($pulso_normal == 't')?"Sim" : "Não";?>&nbsp;
						<strong>Bradicardia: </strong><?php echo ($bradicardia == 't')?"Sim" : "Não";?>&nbsp;
					</div>
					<div class="bloco_H_dois">
						<strong>Taquicardia: </strong><?php echo ($taquicardia == 't')?"Sim" : "Não";?>&nbsp;
					</div>
				</div>
				
				<div class="caixa_I">
					<div class="perfusao">
						<h4>AVALIAÇÃO PERFUSÃO</h4>
					</div>
					<div class="bloco_I_um">
						<strong>Normal: </strong><?php echo ($perfusao_normal == 't')?"Sim" : "Não";?>&nbsp;
						<strong>Pálido: </strong><?php echo ($cianotico == 't')?"Sim" : "Não";?>&nbsp;
					</div>
					<div class="bloco_I_dois">
						<strong>Cianótico: </strong><?php echo ($palido == 't')?"Sim" : "Não";?>&nbsp;
					</div>
				</div>	
				
				<div class="caixa_J">
					<div class="temp">
						<h4>AVALIAÇÃO TEMPERATURA</h4>
					</div>
					<div class="bloco_J_um">
						<strong>Normal: </strong><?php echo ($temp_normal == 't')?"Sim" : "Não";?>&nbsp;
						<strong>Fria: </strong><?php echo ($temp_fria == 't')?"Sim" : "Não";?>&nbsp;
						<strong>Febre: </strong><?php echo ($temp_febre == 't')?"Sim" : "Não";?>&nbsp;
					</div>
					<div class="bloco_J_dois">
						<strong>Arteial: </strong><?php echo $pressao_arterial?>&nbsp;
						<strong>Tibial: </strong><?php echo $pressao_tibial?>&nbsp;
					</div>		
				</div>

				<div class="caixa_K">
					<div class="patologia">
						<h4>PATOLOGIA</h4>
					</div>
					<div class="bloco_K_um">					
						<strong>Hiperidrose: </strong><?php echo ($hiperidrose == 't')?"Sim" : "Não";?>&nbsp;
						<strong>Anidrose: </strong><?php echo ($anidrose == 't')?"Sim" : "Não";?>&nbsp;			
						<strong>Bromidose: </strong><?php echo ($bromidose == 't')?"Sim" : "Não";?>&nbsp;
						<strong>Tinha Pédis: </strong><?php echo ($tinha_pedis == 't')?"Sim" : "Não";?>&nbsp;
						<strong>Tinha Interdigital: </strong><?php echo ($tinha_interdigital == 't')?"Sim" : "Não";?>&nbsp;
						<strong>Fissuras: </strong><?php echo ($fissuras == 't')?"Sim" : "Não";?>&nbsp;
						<strong>Onicólise: </strong><?php echo ($onicolise == 't')?"Sim" : "Não";?>&nbsp;
					</div>
					<div class="bloco_K_dois">					
						<strong>Onicoatrofia: </strong><?php echo ($onicoatrofia == 't')?"Sim" : "Não";?>&nbsp;			
						<strong>Onicogrifose: </strong><?php echo ($onicogrifose == 't')?"Sim" : "Não";?>&nbsp;			
						<strong>Onicoesclerose: </strong><?php echo ($onicoesclerose == 't')?"Sim" : "Não";?>&nbsp;
						<strong>Onicofose: </strong><?php echo ($onicofose == 't')?"Sim" : "Não";?>&nbsp;
						<strong>Onicomicose: </strong><?php echo ($onicomicose == 't')?"Sim" : "Não";?>&nbsp;
						<strong>Obs. Patológica: </strong><?php echo $obs_patologias?>						
					</div>
				</div>

				<div class="caixa_L">
					<div class="calos">
						<h4>CALOS</h4>
					</div>
					<div class="bloco_L">					
						<strong>Dorsal: </strong><?php echo ($dorsal == 't')?"Sim" : "Não";?>&nbsp;&nbsp;&nbsp;
						<strong>Interdigital: </strong><?php echo ($interdigital == 't')?"Sim" : "Não";?>&nbsp;&nbsp;&nbsp;			
						<strong>Plantar: </strong><?php echo ($plantar == 't')?"Sim" : "Não";?>&nbsp;&nbsp;&nbsp;
						<strong>Verrugas Plantar: </strong><?php echo ($verrugas_plantar == 't')?"Sim" : "Não";?>&nbsp;&nbsp;&nbsp;
						<strong>Tungiase: </strong><?php echo ($tungiase == 't')?"Sim" : "Não";?>&nbsp;&nbsp;&nbsp;
						<strong>Nevos: </strong><?php echo ($nevos == 't')?"Sim" : "Não";?>						
					</div>
				</div>

				<div class="caixa_M">
					<div class="hiper">
						<h4>HIPERQUERATOSE</h4>
					</div>
					<div class="bloco_M_um">					
						<strong>Ungueal: </strong><?php echo ($ungueal == 't')?"Sim" : "Não";?>&nbsp;
						<strong>Plantar: </strong><?php echo ($hiperqueratose_plantar == 't')?"Sim" : "Não";?>&nbsp;	
					</div>
					<div class="bloco_M_dois">		
						<strong>Obs. Hiperqueratose: </strong><?php echo $hiperqueratose_obs?>&nbsp;					
					</div>
				</div>

				<div class="caixa_N">
					<div class="onoco">
						<h4>ONOCOCRIPTOSE</h4>
					</div>
					<div class="bloco_N_um">					
						<strong>Edema: </strong><?php echo ($edema == 't')?"Sim" : "Não";?>&nbsp;
						<strong>Eritema: </strong><?php echo ($eritema == 't')?"Sim" : "Não";?>&nbsp;			
						<strong>Granuloma: </strong><?php echo ($granuloma == 't')?"Sim" : "Não";?>&nbsp;
						<strong>Pus: </strong><?php echo ($pus == 't')?"Sim" : "Não";?>&nbsp;
					</div>
					<div class="bloco_N_dois">
						<strong>Espicula: </strong><?php echo ($espicula == 't')?"Sim" : "Não";?>&nbsp;
						<strong>Obs. Onococriptose: </strong> <?php echo $observacao?>&nbsp;						
					</div>
				</div>
				
				<div class="caixa_P">
					<div class="podo">
						<strong>Já foi ao Pdólogo(a)?</strong> <?php echo ($ja_foi_podologo == 't')? "Sim" : "Não"; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<strong>Quanto Tempo Podólogo(a)? </strong><?php echo $quanto_tempo ?>
					</div>
					<div class="rg">
						<strong>RG: </strong><?php echo $rg ?>
					</div>
					<div class="data">
						<strong>___/___/___</strong>
					</div>
					<div class="ass">
						<strong>Assinatura:__________________________________________</strong>
					</div>
				</div>
				
				<div class="botao">
					<input class="button btn_1" href="imprimir.php?paciente=<?php echo $paciente_id?>"  value="Imprimir" onclick="imprime()">
					<a href="avaliacao.php?paciente=<?php echo $paciente_id?>" class="btn_2">Voltar</a>
                </div>
			</div>
		</div>
	</body>
</html>