<?php   
    require './include/conexao.php';
    require './include/config.php';
    require './include/funcoes.php';
	


    if(isset($_REQUEST)){

    	$data_inicio 			=   fncTrataDados(fnc_formata_data($_REQUEST["data_inicio"]));
		$data_fim			    =   fncTrataDados(fnc_formata_data($_REQUEST["data_fim"]));
		$status 			    =   fncTrataDados($_REQUEST["status"]);
		$convenio_id 			    =   (int)$_REQUEST["convenio_id"];
    }


?>
<!DOCTYPE html>
<html lang="PT-BR">
<head>
	  <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
	  <title></title>
</head>	

	
<style>
	
    div#interface{
    	margin: 0 auto;
    	padding: 0px;
    	width: 900px;
    }
    #logo{
    	float: left;
    	width: 150px;
    	height: 100px;
    }
	img#logo{
		width: 100px;
		height: 100px;
	}
	#cabecalho{
		float: left;
		font-family: arial, sans-serif;
		text-align: center;		
		width: 600px;
		padding-top: 30px;
	}
	.nome_relatorio{
		font-size: 25px;
	}
	#data_emissao{
		padding-top: 50px;
		float: left;
		width: 150px;
		font-size: 10px;
	}
	#clear{
		clear:both;
		height: 10px;
	}
	#table{
		width: 900px;
		border-top: 1px solid #000000;
	}
	#table th {
		text-transform: uppercase;
		font-size: 12px;
		font-family: tahoma;
		 background-color: white;
	}
	#table td {		
		font-size: 11px;
		font-family: tahoma;
		text-align: center;
		border-bottom: 1px solid #f8f8f8;
	}
	tr:nth-child(2n+1) {
    background-color: #cccccc;
}
	
</style>

<body>
	<div id="interface">
		<header>
			<div id="logo">
				<img src="<?php echo LOGO ?>" id="logo">
			</div>
			<div id="cabecalho">				
				<div class="nome_relatorio">Relatório do Agendamento</div>
				<div class="filtro_relatorio">
					<?php

						if($status == "t"){
						        $status_final = 'Confirmado';
						}elseif($status == 'f'){
							$status_final = 'Cancelado';
						}else{
							$status_final = "Aguard. Confirmação";
						}				

						if(strlen(trim($data_inicio))>0 and strlen(trim($data_fim))>0){
							echo "<b>Período:</b> ".fnc_data_formatada($data_inicio). " - " .fnc_data_formatada($data_fim)." <br>";
						}

						if($convenio_id >0){
							$sql_convenio = "SELECT descricao from tbl_convenio where convenio = $convenio_id";
							$res_convenio = pg_query($con, $sql_convenio);
							if(pg_num_rows($res_convenio)>0){
								$nome_convenio = pg_fetch_result($res_convenio, 0, descricao);
								echo "<b>Convênio:</b> $nome_convenio <br>";
							}							
						}

						if($status == "t"){
						        echo  '<b>Situação:</b> Confirmado';
						}elseif($status == 'f'){
							echo '<b>Situação:</b> Cancelado';
						}else{
							echo "Aguard. Confirmação";
						}

					?>

				</div>

			</div>
			<div id='data_emissao'>
				<div class="data"><?php echo date("d/m/Y")?></div>
				<div class="hora"><?php echo date("H:i")?></div>
			</div>
			<div id="clear"></div>
		</header>
		<section>
			<table id="table">
				<?php
	if(isset($_REQUEST)){	

		if(strlen(trim($status))>0){
			$cond_status = " AND tbl_agendamento.confirmado = '$status' ";
		}else{
			$cond_status = " ";
		}

		if($convenio_id > 0){
			$cond_convenio = " AND tbl_agendamento.convenio_id = $convenio_id ";
		}else{
			$cond_convenio = " ";
		}


        if(strlen(trim($erro)) == 0){
            $sql = "select data, horario, tbl_funcionario.nome as medico, tbl_agendamento.nome as paciente, tbl_agendamento.finalizado, tbl_agendamento.convenio_id, tbl_agendamento.confirmado 
					from tbl_agendamento 
					inner join tbl_funcionario on tbl_funcionario.funcionario = tbl_agendamento.medico and empresa_id = ".EMPRESA."
					where empresa_id = ".EMPRESA." and data BETWEEN ('$data_inicio') 
					AND ('$data_fim') 
						$cond_status 
						$cond_convenio
					ORDER BY data ";
            $res = pg_query($con, $sql);		
            if(pg_num_rows($res)>0){
                echo "<div class='table-responsive'>
                        <table id='table'>
                            <thead>
                                <tr>
                                    <th class='col-md-1' align='center'>#</th>
                                    <th class='col-md-2'>Data/Hora </th>
									<th class='col-md-3'>Psiquiatra</th>
									<th class='col-md-3'>Paciente</th>
									<th class='col-md-2'>Realizada</th>
                                    <th class='col-md-1'>Status</th>
                                </tr>
                            </thead>
                            <body";
               for($i=0; $i<pg_num_rows($res); $i++){
				   
                    $data		= fnc_data_formatada(pg_fetch_result($res, $i,'data'));
					$hora       = pg_fetch_result($res, $i, 'horario');
					$nome       = pg_fetch_result($res, $i, 'paciente');
					$finalizado	= pg_fetch_result($res, $i,'finalizado');
                    $status  = pg_fetch_result($res, $i, 'confirmado');	
				    $medico  = pg_fetch_result($res, $i, 'medico');

				    if(strlen(trim($finalizado))>0){
				    	$finalizado = fnc_data_formatada($finalizado);
				    }
					
					if($status == "t"){
					        $status_final = 'Confirmado';
					}elseif($status == 'f'){
						$status_final = 'Cancelado';
					}else{
						$status_final = "Aguard. Confirmação";
					}
						
					 $hora_formatada = substr($hora,0,5);
					
                    echo "<tr>";
                        echo "<td class='col-md-1'>".($i+1)."</td>";
                        echo "<td class='col-md-2'>$data - $hora_formatada</td>";
						echo "<td class='col-md-1'>$medico</td>";
						echo "<td class='col-md-3'>$nome</td>";
						echo "<td class='col-md-2'>$finalizado</td>";
                        echo "<td class='col-md-1'>$status_final</td>";
                    echo "</tr>";
                }
                echo "</body>";
                echo "</table>";
                echo "</div>";
			} 
        }else{
            echo "<div class='alert alert-danger'>$erro</div>";
        }
		
      
    }
					
				?>
			</table>
		</section>			
	</div>
</body>
</html>