<?php   
    require './include/conexao.php';
    require './include/config.php';
    require './include/funcoes.php';
	require './include/verifica_usuario.php';
	


    if(isset($_REQUEST)){

    	$data_inicio 			=   fncTrataDados(fnc_formata_data($_REQUEST["data_inicio"]));
		$data_fim			    =   fncTrataDados(fnc_formata_data($_REQUEST["data_fim"]));
		$paciente_id              =   fncTrataDados($_POST['paciente']);
		
	if(isset($_GET['paciente'])){
		$paciente_id = (int)$_GET['paciente'];
			
        $sql_paciente = "select * from tbl_paciente where paciente = $paciente_id ";
        $res_paciente = pg_query($con, $sql_paciente);
        if(pg_num_rows($res_paciente) > 0){
             $nome           = pg_fetch_result($res_paciente, 0, 'nome');
            
        }
		
	}
	
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
				<div class="nome_relatorio">Evoluções</div>
				<div><?php echo "<b>Paciente:</b> ".$nome ?></div>
				<div class="filtro_relatorio">
					<?php

						if(strlen(trim($data_inicio))>0 and strlen(trim($data_fim))>0){
							echo "<b>Período:</b> ".fnc_data_formatada($data_inicio). " - " .fnc_data_formatada($data_fim)." <br>";
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
	


        if(strlen(trim($erro)) == 0){
            $sql = "select procedimento, data, paciente_id, usuario_id, tbl_funcionario.nome from tbl_iteracao
					inner join tbl_usuario on tbl_usuario.usuario = tbl_iteracao.usuario_id
					inner join tbl_funcionario on tbl_funcionario.funcionario = tbl_usuario.funcionario_id
					where tbl_iteracao.empresa_id = ".EMPRESA." and data BETWEEN ('$data_inicio') 
					AND ('$data_fim') and paciente_id = $paciente_id
					ORDER BY data DESC ";     

				
            $res = pg_query($con, $sql);
			//echo $sql;	
            if(pg_num_rows($res)>0){
                echo "<div class='table-responsive'>
                        <table id='table'>
                            <thead>
                                <tr>
                                    <th class='col-md-1'>Data</th>
									<th class='col-md-3'>Profissional</th>
                                    <th class='col-md-6'>procedimento </th>
								
                                </tr>
                            </thead>
                            <body";
               for($i=0; $i<pg_num_rows($res); $i++){
				   
                    $data		        = fnc_data_formatada(pg_fetch_result($res, $i,'data'));
					$usuario_id         = pg_fetch_result($res, $i, 'usuario_id');
					$procedimento       = pg_fetch_result($res, $i, 'procedimento');
					$nome               = pg_fetch_result($res, $i, 'nome');
					
					
                    echo "<tr>";
                        echo "<td class='col-md-1'>$data</td>";
						echo "<td class='col-md-3'>$nome</td>";
						echo "<td class='col-md-6'>$procedimento</td>";
		
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