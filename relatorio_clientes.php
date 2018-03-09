<?php   
    require './include/conexao.php';
    require './include/config.php';
    require './include/funcoes.php';
	require './include/verifica_usuario.php';


    if(isset($_REQUEST)){

		$status 			    =   fncTrataDados($_REQUEST["status"]);
		
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
				<div class="nome_relatorio">Relatório de Clientes</div>
				<div class="filtro_relatorio">
					<?php

						if($status == "4"){
						    $status_final = 'Consultório';
						}elseif($status == '3'){
							$status_final = 'Residentes';
						}else{
							$status_final = "Inativos";
						}				

					

						if($status == "4"){
						        echo  '<b>Situação:</b> Consultório';
						}elseif($status == '3'){
							echo '<b>Situação:</b> Residentes';
						}else{
							echo "Inativos";
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
            $sql = "select nome, status_id from tbl_paciente where status_id = '$status'
					ORDER BY nome ";
            $res = pg_query($con, $sql);
           //echo $sql;			
            if(pg_num_rows($res)>0){
                echo "<div class='table-responsive'>
                        <table id='table'>
                            <thead>
                                <tr>
                                    <th class='col-md-1' align='center'>#</th>
                                    <th class='col-md-5'>Nome </th>
                                    <th class='col-md-2'>Status</th>
                                </tr>
                            </thead>
                            <body";
               for($i=0; $i<pg_num_rows($res); $i++){
				   
                    
					
					$nome       = pg_fetch_result($res, $i, 'nome');
                    $status     = pg_fetch_result($res, $i, 'status_id');	
				  

					
					if($status == "4"){
					        $status_final = 'Consultório';
					}elseif($status == '3'){
						$status_final = 'Residente';
					}else{
						$status_final = "Inativo";
					}
						
				
					
                    echo "<tr>";
                        echo "<td class='col-md-1'>".($i+1)."</td>";
						echo "<td class='col-md-5'>$nome</td>";
                        echo "<td class='col-md-2'>$status_final</td>";
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